<?php

namespace App\Notifications;

use App\Dto\MessageData;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twilio\TwilioChannel;
use NotificationChannels\Twilio\TwilioSmsMessage;

class CustomerQuickNotification extends Notification
{
    use Queueable;

    private MessageData $message;

    public function __construct(MessageData $data)
    {
        $this->message = $data;
    }

    public function via($notifiable): array
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable)
    {
        return (new TwilioSmsMessage())->content($this->message->text);
    }

    public function toArray($notifiable): array
    {
        return $this->message->toArray();
    }
}
