<?php

namespace App\Observers;

use App\Events\RequestCreated;
use App\Models\Request;

class RequestObserver
{
    public function created(Request $request): void
    {
        Request::clearCache($request);

        event(new RequestCreated($request));
    }

    public function updated(Request $request): void
    {
        Request::clearCache($request);
    }

    public function saved(Request $request): void
    {
        Request::clearCache($request);
    }

    public function deleted(Request $request): void
    {
        Request::clearCache($request);
    }
}
