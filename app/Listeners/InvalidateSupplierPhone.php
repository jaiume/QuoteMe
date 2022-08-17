<?php

namespace App\Listeners;

use App\Events\SupplierPhoneChanged;
use App\Models\Supplier;

class InvalidateSupplierPhone
{
    public function handle(SupplierPhoneChanged $event): void
    {
        optional(Supplier::find($event->supplier->id))->forceFill([
            'phone_verified_at' => null,
        ])->save();
    }
}
