<?php

namespace App\Listeners\Payments;

use App\Events\ResponseCreated;
use App\Events\ResponseNotificationSent;
use App\Models\CreditTransaction;
use App\Utils\SettingsUtils;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChargeSupplierForResponse
{
    public function handle(ResponseNotificationSent $event): void
    {
        $normalReplyCost = SettingsUtils::get('normal_reply', 0);
        $quickReplyCost = SettingsUtils::get('quick_reply', 0);

        $response = $event->response;

        $transaction = CreditTransaction::make([
            'description' => $response->quick ? __('Quick Reply') : __('Normal Reply'),
            'amount' => -1 * ($response->quick ? $quickReplyCost : $normalReplyCost),
            'successful' => true,
        ]);

        $transaction->user()->associate($response->supplier);

        $transaction->transactionable()->associate($response);

        $status = $transaction->save();

        \Log::info(
            sprintf(
                'Charge the supplier (#%d) for %s response (#%d). Status: %s',
                optional($response->supplier)->id ?? -1,
                $response->quick ? 'quick' : 'normal',
                $response->id,
                $status ? 'success' : 'failed'
            ),
            ['PAYMENTS']
        );
    }
}
