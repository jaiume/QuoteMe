<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveAuthTokenOnLogout
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /* @var User|null $user */
        $user = $event->user;

        $user->setAttribute('auth_token', null)->save();
        \Cookie::queue(\Cookie::forget('auth_user'));
    }
}
