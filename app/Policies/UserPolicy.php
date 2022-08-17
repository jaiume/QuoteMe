<?php

namespace App\Policies;

use App\Models\Supplier;
use App\Models\User;
use App\Utils\PermissionUtils;
use App\Utils\SettingsUtils;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
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
     * @param User $targetUser
     * @return bool
     */
    public function update(User $user, User $targetUser): bool
    {
        if (optional(User::find(optional($targetUser)->id))->hasRole(PermissionUtils::ROLE_SUPERADMIN)) {
            /* Only superadmin can edit superadmin */
            return $user->hasRole(PermissionUtils::ROLE_SUPERADMIN);
        }

        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function delete(User $user, User $targetUser): bool
    {
        if ($targetUser->hasRole(PermissionUtils::ROLE_SUPERADMIN)) {
            /* Only superadmin can edit superadmin */
            return $user->hasRole(PermissionUtils::ROLE_SUPERADMIN);
        }

        return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function viewRespondButton(User $user): bool
    {
        return $user->hasRole(PermissionUtils::ROLE_SUPPLIER);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function viewSupplierDashboardVerified(User $user): bool
    {
        return \Cache::remember("view_supplier_dashboard_without_verification:{$user->id}", 5, function () use ($user) {
            $emailVerificationEnabled = SettingsUtils::get('supplier_email_verification_enabled', false);
            $phoneVerificationEnabled = SettingsUtils::get('supplier_phone_verification_enabled', false);

            $supplier = Supplier::find($user->id);

            if ($supplier) {
                $emailVerified = (!$emailVerificationEnabled || $supplier->hasVerifiedEmail());
                $phoneVerified = (!$phoneVerificationEnabled || $supplier->hasVerifiedPhone());

                return $emailVerified && $phoneVerified;
            }

            return true;
        });
    }

    public function viewSupplierDashboard(User $user): bool
    {
        return $user->hasRole(PermissionUtils::ROLE_SUPPLIER);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function viewAdminDashboard(User $user): bool
    {
        return $user->hasRole(PermissionUtils::ROLE_ADMIN);
    }
}
