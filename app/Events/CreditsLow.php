<?php

namespace App\Events;

use App\Models\Supplier;
use Illuminate\Foundation\Events\Dispatchable;

class CreditsLow
{
    use Dispatchable;

    public Supplier $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }
}
