<?php

namespace App\Models;

use App\Events\SupplierEmailChanged;
use App\Events\SupplierPhoneChanged;
use App\Traits\MustVerifyPhone;
use App\Utils\CacheUtils;
use App\Utils\PermissionUtils;
use App\Utils\UserMetaUtils;
use Envant\Fireable\FireableAttributes;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

/**
 * Class Supplier
 *
 * @property-read string $display_name
 * @property-read Collection|Supplier[] $suppliers
 * @property bool $quick_notify
 * @property Collection|Category[] $categories
 * @property Collection|Area[] $areas
 *
 * @method static Builder enabled()
 * @method static Builder disabled()
 *
 * @mixin \App\Models\User
 * @package App\Models
 */
class Supplier extends User
{
    use HasFactory;
    use Searchable;
    use MustVerifyEmail;
    use MustVerifyPhone;
    use FireableAttributes;

    protected $table = 'users';

    protected $fireableAttributes = [
        'phone' => SupplierPhoneChanged::class,
        'email' => SupplierEmailChanged::class,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable([
            'quick_notify',
        ]);
    }

    public function scopeEnabled(Builder $builder): Builder
    {
        return $builder->where('disabled', false);
    }

    public function scopeDisabled(Builder $builder): Builder
    {
        return $builder->where('disabled', true);
    }

    protected static function booted(): void
    {
        static::addGlobalScope('supplier', function (Builder $builder) {
            $suppliers = DB::table('users')
                ->select('users.id as s_id')
                ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->where('model_has_roles.model_type', User::class)
                ->where('roles.name', PermissionUtils::ROLE_SUPPLIER);

            $builder->select(['users.*'])
                    ->joinSub($suppliers, 'suppliers', function ($join) {
                        $join->on('users.id', '=', 'suppliers.s_id');
                    });
        });

        parent::booted();
    }

    /**
     * Clear model cache
     *
     * @param Supplier $supplier
     * @return bool
     */
    public static function clearCache(Supplier $supplier): bool
    {
        $status = Cache::tags([
            CacheUtils::TAG_SUPPLIER,
            CacheUtils::getSupplierCacheTag($supplier),
            CacheUtils::getUserCacheTag($supplier),
        ])->flush();

        if ($status !== false) {
            \Log::debug('Flush suppliers cache: OK', ['CACHE']);
        } else {
            \Log::error('Flush suppliers cache: FAILED', ['CACHE']);
        }

        return $status;
    }

    /**
     * Supplier's categories
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'suppliers_categories', 'user_id', 'category_id')
                    ->orderBy('name')
                    ->withTrashed();
    }

    /**
     * Supplier's areas
     *
     * @return BelongsToMany
     */
    public function areas(): BelongsToMany
    {
        return $this->belongsToMany(Area::class, 'suppliers_areas', 'user_id', 'area_id')
                    ->orderBy('name')
                    ->withTrashed();
    }

    /**
     * Supplier's QuickContacts
     *
     * @return HasMany
     */
    public function quickContacts(): HasMany
    {
        return $this->hasMany(QuickContact::class);
    }

    /**
     * Returns the name if exists or email if not
     *
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?? $this->email;
    }

    /**
     * Get QuickNotify setting enabled status
     *
     * @return bool
     */
    public function getQuickNotifyAttribute(): bool
    {
        $query = DB::table('users_meta')
                   ->select('value')
                   ->where('key', UserMetaUtils::QUICK_NOTIFY)
                   ->where('user_id', $this->id)
                   ->pluck('value');

        return $query->first() === '1';
    }

    /**
     * Set QuickNotify setting enabled status
     *
     * @param bool $value
     */
    public function setQuickNotifyAttribute(bool $value): void
    {
        DB::table('users_meta')
          ->updateOrInsert(
              [
                  'key' => UserMetaUtils::QUICK_NOTIFY,
                  'user_id' => $this->id,
              ],
              [
                  'value' => $value ? '1' : '0',
                  'created_at' => DB::raw('IFNULL(users_meta.created_at, NOW())'),
                  'updated_at' => Carbon::now(),
              ],
          );
    }

    /**
     * @inheritDoc
     */
    public function toSearchableArray(): array
    {
        return array_merge(
            parent::toSearchableArray(),
            [
                'area' => $this->areas->map(fn ($item) => $item->name)->join('|'),
                'category' => $this->categories->map(fn ($item) => $item->name)->join('|'),
            ]
        );
    }
}
