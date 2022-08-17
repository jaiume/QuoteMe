<?php

namespace App\Listeners;

use App\Events\CreditsPurchased;
use App\Models\Supplier;
use App\Notifications\AdminCreditsPurchasedNotification;
use App\Utils\MessageUtils;
use Illuminate\Support\Facades\Notification;

class SendNotificationOnCreditsPurchased
{
    public function handle(CreditsPurchased $event): void
    {
        Notification::route('mail', config('app.admin_email'))
                    ->notify(
                        new AdminCreditsPurchasedNotification(
                            MessageUtils::getAdminPurchaseEmail(Supplier::find($event->transaction->user->id))
                        )
                    );
    }
}
