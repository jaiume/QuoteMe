<?php

namespace App\Listeners;

use App\Events\CreditsLow;
use App\Notifications\SupplierLowCreditNotification;
use App\Utils\MessageUtils;

class NotifySupplierOnCreditsLow
{
    public function handle(CreditsLow $event): void
    {
        $event->supplier->notify(
            new SupplierLowCreditNotification(
                MessageUtils::getSupplierLowCreditEmail($event->supplier)
            )
        );
    }
}
