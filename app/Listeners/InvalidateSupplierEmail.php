<?php

namespace App\Listeners;

use App\Events\SupplierEmailChanged;
use App\Models\Supplier;

class InvalidateSupplierEmail
{
    public function handle(SupplierEmailChanged $event): void
    {
        optional(Supplier::find($event->supplier->id))->forceFill([
            'email_verified_at' => null,
        ])->save();
    }
}
