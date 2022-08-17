<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Carbon;

class UpdateLastLoginOnAuthenticated
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event): void
    {
        /* @var User|null $user */
        $user = $event->user;

        if (!$user) {
            return;
        }

        $user->last_logged_in = Carbon::now();
        $user->save();
    }
}
