<?php

namespace App\Listeners;

use App\Events\ResponseCreated;
use App\Events\ResponseNotificationSent;
use App\Notifications\CustomerQuickNotification;
use App\Notifications\CustomerResponseNotification;
use App\Utils\MessageUtils;

class NotifyCustomerOnRequestResponded
{
    public function handle(ResponseCreated $event): void
    {
        $response = $event->response;

        $customer = $response->request->customer;

        $customer->notify(
            new CustomerResponseNotification(
                MessageUtils::getNormalReplyEmail($response)
            )
        );

        if ($response->quick) {
            $customer->notify(
                new CustomerQuickNotification(
                    MessageUtils::getQuickReplySms($response)
                )
            );
        }

        event(new ResponseNotificationSent($response));
    }
}
