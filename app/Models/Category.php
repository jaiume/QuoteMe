<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Utils\CacheUtils;
use Brick\Money\Money;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

/**
 * Class Category
 *
 * @property int $id
 * @property string $name
 * @property float $premium_amount
 * @property-read bool $has_suppliers
 *
 * @mixin Eloquent
 * @package App\Models
 */
class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'premium_amount',
    ];

    protected $casts = [
        'premium_amount' => MoneyCast::class,
    ];

    public static function clearCache(): bool
    {
        if (Cache::supportsTags()) {
            $status = Cache::tags([CacheUtils::TAG_CATEGORY])->flush();

            if ($status !== false) {
                \Log::debug('Flush categories cache: OK', ['CACHE']);
            } else {
                \Log::error('Flush categories cache: FAILED', ['CACHE']);
            }

            return $status;
        }

        return true;
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'suppliers_categories', 'category_id', 'user_id');
    }

    public function toSearchableArray(): array
    {
        return $this->only('id', 'name');
    }

    public function getPremium(): Money
    {
        return $this->premium_amount
            ? Money::of($this->premium_amount, config('currency.default'))
            : Money::of(0, config('currency.default'));
    }

    protected function getEnabledCategories(): Collection
    {
        if (!Cache::supportsTags()) {
            return DB::table('categories as c')
                     ->select('id')
                     ->join('suppliers_categories as sc', 'c.id', '=', 'sc.category_id')
                     ->pluck('id');
        }

        return Cache::tags([CacheUtils::TAG_CATEGORY, CacheUtils::TAG_SUPPLIER])
                    ->rememberForever('enabled_categories', function () {
                        return DB::table('categories as c')
                                 ->select('id')
                                 ->join('suppliers_categories as sc', 'c.id', '=', 'sc.category_id')
                                 ->pluck('id');
                    });
    }

    public function getHasSuppliersAttribute(): bool
    {
        return $this->getEnabledCategories()->contains($this->id);
    }
}
