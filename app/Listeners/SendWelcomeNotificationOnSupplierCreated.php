<?php

namespace App\Listeners;

use App\Events\SupplierCreated;
use App\Notifications\SupplierWelcomeNotification;
use App\Utils\MessageUtils;

class SendWelcomeNotificationOnSupplierCreated
{
    public function handle(SupplierCreated $event): void
    {
        $event->supplier->notify(
            new SupplierWelcomeNotification(
                MessageUtils::getSupplierWelcomeEmail($event->supplier)
            )
        );
    }
}
