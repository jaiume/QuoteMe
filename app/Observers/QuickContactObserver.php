<?php

namespace App\Observers;

use App\Events\QuickContactCreated;
use App\Models\QuickContact;

class QuickContactObserver
{
    public function created(QuickContact $quickContact): void
    {
        event(new QuickContactCreated($quickContact));
    }
}
