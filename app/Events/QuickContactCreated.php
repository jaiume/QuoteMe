<?php

namespace App\Events;

use App\Models\QuickContact;
use App\Utils\EventUtils;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuickContactCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public QuickContact $quickContact;

    public function __construct(QuickContact $quickContact)
    {
        $this->quickContact = $quickContact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel(EventUtils::CHANNEL_RESPONSE);
    }
}
