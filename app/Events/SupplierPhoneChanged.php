<?php

namespace App\Events;

use App\Models\Supplier;
use Illuminate\Foundation\Events\Dispatchable;

class SupplierPhoneChanged
{
    use Dispatchable;

    public Supplier $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier->withoutRelations();
    }
}
