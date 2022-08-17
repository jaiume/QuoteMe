<?php

namespace App\Observers;

use App\Events\SupplierCreated;
use App\Models\Supplier;
use App\Models\User;
use App\Utils\PermissionUtils;

class SupplierObserver
{
    public function created(Supplier $supplier): void
    {
        $user = User::find($supplier->id);
        $user->assignRole(PermissionUtils::ROLE_SUPPLIER);

        Supplier::clearCache($supplier);

        event(new SupplierCreated($supplier));
    }

    public function updated(Supplier $supplier): void
    {
        Supplier::clearCache($supplier);
    }

    public function saved(Supplier $supplier): void
    {
        Supplier::clearCache($supplier);
    }

    public function deleted(Supplier $supplier): void
    {
        Supplier::clearCache($supplier);
    }
}
