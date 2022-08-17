<?php

namespace App\Listeners;

use App\Events\AuthTokenCreated;
use App\Notifications\CustomerReload;
use App\Utils\MessageUtils;

class SendAuthLinkOnAuthTokenCreated
{
    public function handle(AuthTokenCreated $event)
    {
        $event->customer->notify(
            new CustomerReload(
                MessageUtils::getCustomerReloadEmail($event->customer)
            )
        );
    }
}
