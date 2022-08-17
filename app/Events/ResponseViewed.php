<?php

namespace App\Events;

use App\Models\Response;
use App\Utils\EventUtils;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResponseViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        \Log::debug(sprintf('Response #%d viewed', $response->id), ['RESPONSE']);
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
