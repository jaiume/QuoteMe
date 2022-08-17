<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\Supplier;
use App\Models\User;
use App\Utils\CacheUtils;
use App\Utils\PermissionUtils;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

/**
 * Class RequestPolicy
 *
 * @package App\Policies
 */
class RequestPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->canAny(['viewAdminDashboard', 'viewSupplierDashboardVerified'], User::class);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return bool
     */
    public function view(User $user, Request $request): bool
    {
        return Cache::tags([
            CacheUtils::getUserCacheTag($user),
            CacheUtils::getRequestCacheTag($request)
        ])->remember(
            CacheUtils::getUserCanViewRequestCacheName($user, $request),
            config('cache.ttl'),
            function () use ($user, $request) {
                try {
                    $supplier = Supplier::findOrFail($user->id);

                    $hasCategory = $supplier->categories()->withTrashed()->get()->contains($request->category);
                    $hasArea = $supplier->areas()->withTrashed()->get()->contains($request->area);

                    return $hasCategory && $hasArea;
                } catch (ModelNotFoundException $e) {
                    return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS);
                }
            }
        );
    }

    /**
     * @return bool
     */
    public function create(): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
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
     * @param User $user
     * @param Request $request
     * @return bool
     */
    public function respondToRequests(User $user, Request $request): bool
    {
        try {
            $supplier = Supplier::findOrFail($user->id);

            $hasCategory = $supplier->categories->contains($request->category);
            $hasArea = $supplier->areas->contains($request->area);

            return $hasCategory && $hasArea;
        } catch (ModelNotFoundException $e) {
            // Do nothing
        }

        return false;
    }
}
