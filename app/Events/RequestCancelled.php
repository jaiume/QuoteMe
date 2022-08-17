<?php

namespace App\Events;

use App\Models\Request;
use App\Utils\EventUtils;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestCancelled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        \Log::debug(sprintf('Request #%d cancelled', $request->id), ['REQUEST']);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel(EventUtils::CHANNEL_REQUEST);
    }
}
