<?php

namespace App\Notifications;

use App\Dto\MessageData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupplierLowCreditNotification extends Notification
{
    use Queueable;

    private MessageData $message;

    public function __construct(MessageData $data)
    {
        $this->message = $data;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->message->subject)
                    ->line($this->message->text);
    }

    public function toArray($notifiable): array
    {
        return $this->message->toArray();
    }
}
