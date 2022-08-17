<?php

namespace App\Policies;

use App\Models\User;
use App\Utils\PermissionUtils;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ResourcePolicy
 * @package App\Policies
 */
class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @param User $user
     * @param mixed ...$args
     * @return bool
     */
    public function update(User $user, ...$args): bool
    {
        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @return bool
     */
    public function forceDelete(): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }
}
