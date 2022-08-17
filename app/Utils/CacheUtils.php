<?php

namespace App\Utils;

use App\Models\CreditTransaction;
use App\Models\Request;
use App\Models\Supplier;
use App\Models\User;

class CacheUtils
{
    public const TAG_SETTINGS = 'settings';
    public const TAG_USER = 'user';
    public const TAG_SUPPLIER = 'supplier';
    public const TAG_REQUEST = 'request';
    public const TAG_TRANSACTION = 'transaction';
    public const TAG_AREA = 'area';
    public const TAG_CATEGORY = 'category';

    /*
     * ========================================
     * ==                TAGS                ==
     * ========================================
     */
    public static function getUserCacheTag(User $user): string
    {
        return sprintf('%s:%d', self::TAG_USER, $user->id);
    }

    public static function getSupplierCacheTag(Supplier $supplier): string
    {
        return sprintf('%s:%d', self::TAG_SUPPLIER, $supplier->id);
    }

    public static function getRequestCacheTag(Request $request): string
    {
        return sprintf('%s:%d', self::TAG_REQUEST, $request->id);
    }

    public static function getTransactionCacheTag(CreditTransaction $transaction): string
    {
        return sprintf('%s:%d', self::TAG_TRANSACTION, $transaction->id);
    }

    /*
     * ========================================
     * ==            CACHE  NAMES            ==
     * ========================================
     */

    public static function getUserWalletBalanceCacheName(int $userId): string
    {
        return sprintf('user:%s.wallet.balance', $userId);
    }

    public static function getUserCanViewRequestCacheName(User $user, Request $request): string
    {
        return sprintf('user:%d.can.view.request:%d', $user->id, $request->id);
    }

    public static function getUserCanViewTransactionCacheName(User $user, CreditTransaction $transaction): string
    {
        return sprintf('user:%d.can.view.transaction:%d', $user->id, $transaction->id);
    }

    public static function getSettingsCacheName(string $key): string
    {
        return sprintf('settings:%s', $key);
    }
}
