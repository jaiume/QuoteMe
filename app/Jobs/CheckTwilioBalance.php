<?php

namespace App\Jobs;

use App\Notifications\AdminSmsLowNotification;
use App\Utils\MessageUtils;
use App\Utils\SettingsUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

/**
 * Class CheckTwilioBalance
 *
 * Checks Twilio account balance using the Twilio API
 * (docs can be found here: https://support.twilio.com/hc/en-us/articles/360025294494-Check-Your-Twilio-Project-Balance)
 *
 * @package App\Jobs
 */
class CheckTwilioBalance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function middleware(): array
    {
        return [(new WithoutOverlapping('twilio_balance'))->releaseAfter(60)];
    }

    public static function getBalanceValue()
    {
        return Cache::remember('twilio_balance', \DateInterval::createFromDateString('10 minutes'), function () {
            $sid = config('twilio-notification-channel.account_sid');
            $token = config('twilio-notification-channel.auth_token');

            $response = Http::withBasicAuth($sid, $token)
                            ->get("https://api.twilio.com/2010-04-01/Accounts/${sid}/Balance.json");

            if (!$response->successful()) {
                \Log::error(
                    sprintf(
                        'Twilio API reported: (%s %s)',
                        $response->object()->status,
                        $response->object()->message
                    )
                );

                /* Return max value to prevent false-positive notification about low balance */
                return PHP_INT_MAX;
            }

            $responseBody = $response->json();
            $response = (float)$responseBody['balance'];

            \Log::info(sprintf('Twilio account balance: %f %s', $responseBody['balance'], $responseBody['currency']), ['TWILIO_BALANCE']);
            return $response;
        });
    }

    public function handle(): void
    {
        $balance = self::getBalanceValue();

        $smsLowThreshold = SettingsUtils::get('sms_low_threshold', 0);
        if ($balance < $smsLowThreshold) {
            Notification::route('mail', config('app.admin_email'))
                        ->notify(
                            new AdminSmsLowNotification(
                                MessageUtils::getAdminSmsLowEmail()
                            )
                        );
        }
    }
}
