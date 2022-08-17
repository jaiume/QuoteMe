<?php

namespace App\Policies;

use App\Models\User;
use App\Utils\PermissionUtils;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function create(): bool
    {
        return false;
    }

    public function update(User $user): bool
    {
        return $user->hasAnyRole([PermissionUtils::ROLE_ADMIN, PermissionUtils::ROLE_SUPERADMIN]);
    }

    public function delete(): bool
    {
        return false;
    }

    public function view(User $user): bool
    {
        return $user->hasAnyRole([PermissionUtils::ROLE_ADMIN, PermissionUtils::ROLE_SUPERADMIN]);
    }

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole([PermissionUtils::ROLE_ADMIN, PermissionUtils::ROLE_SUPERADMIN]);
    }
}
