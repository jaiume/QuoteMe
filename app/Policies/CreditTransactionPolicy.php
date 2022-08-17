<?php

namespace App\Policies;

use App\Models\CreditTransaction;
use App\Models\Supplier;
use App\Models\User;
use App\Utils\CacheUtils;
use App\Utils\PermissionUtils;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;

/**
 * Class CreditTransactionPolicy
 * @package App\Policies
 */
class CreditTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * @return bool
     */
    public function create(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function update(): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @param CreditTransaction $transaction
     * @return bool
     */
    public function view(User $user, CreditTransaction $transaction): bool
    {
        return Cache::tags([
            CacheUtils::getUserCacheTag($user),
            CacheUtils::getTransactionCacheTag($transaction)
        ])->remember(
            CacheUtils::getUserCanViewTransactionCacheName($user, $transaction),
            config('cache.ttl'),
            function () use ($user, $transaction) {
                return $user->hasPermissionTo(PermissionUtils::NOVA_RES_USERS_ACCESS)
                    || optional($transaction->user)->id === $user->id;
            });
    }

    public function viewAny(User $user): bool
    {
        return $user->canAny(['viewAdminDashboard', 'viewSupplierDashboardVerified'], User::class);
    }
}
