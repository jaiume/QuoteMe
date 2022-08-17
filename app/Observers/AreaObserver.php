<?php

namespace App\Observers;

use App\Models\Area;

class AreaObserver
{
    public function created(Area $area): void
    {
        Area::clearCache();
    }

    public function updated(Area $area): void
    {
        Area::clearCache();
    }

    public function saved(Area $area): void
    {
        Area::clearCache();
    }

    public function deleted(Area $area): void
    {
        Area::clearCache();
    }
}
