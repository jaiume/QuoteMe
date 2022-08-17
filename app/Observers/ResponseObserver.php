<?php

namespace App\Observers;

use App\Events\ResponseCreated;
use App\Models\Response;

class ResponseObserver
{
    public function created(Response $response): void
    {
        event(new ResponseCreated($response));
    }
}
