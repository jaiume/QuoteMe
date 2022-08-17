<?php

namespace App\Policies;

use App\Models\QuickContact;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuickContactPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        try {
            $supplier = Supplier::findOrFail($user->id);
            return $supplier->isEnabled();
        } catch (ModelNotFoundException $e) {
            // Do nothing
        }

        return false;
    }

    /**
     * @param User $user
     * @param QuickContact $quickContact
     * @return bool
     */
    public function view(User $user, QuickContact $quickContact): bool
    {
        return optional($quickContact->supplier)->id === $user->id;
    }
}
