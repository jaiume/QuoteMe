<?php

namespace App\Events;

use App\Models\Response;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResponseNotificationSent
{
    use Dispatchable, SerializesModels;

    public Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
