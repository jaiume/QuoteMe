<?php

namespace App\Models;

use App\Events\RequestCancelled;
use App\Events\RequestCreated;
use App\Traits\HasHumanReadableTimestamps;
use App\Utils\CacheUtils;
use App\Utils\RequestStatus;
use Brick\Money\Exception\MoneyMismatchException;
use Brick\Money\Money;
use Envant\Fireable\FireableAttributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Request
 *
 * @property string $text
 * @property string $url
 * @property bool $cancelled
 * @property bool $quick_reply
 * @property bool $quick_contact
 * @property Customer $customer
 * @property Category $category
 * @property Area $area
 * @property Collection|Response[] $responses
 * @property Collection|Response[] $unfiltered_responses
 * @property-read string $status
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder published() Published scope
 * @method static Builder unpublished() Unpublished scope
 * @method static Builder pending() Pending scope
 * @method static Builder responded() Responded scope
 * @method static Builder cancelled() Cancelled scope
 * @method static Builder active() Active scope
 *
 * @mixin \Eloquent
 * @package App\Models
 *
 * @noinspection PhpSuperClassIncompatibleWithInterfaceInspection
 */
class Request extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use InteractsWithMedia;
    use HasHumanReadableTimestamps;
    use FireableAttributes;

    protected $fillable = [
        'text',
        'url',
        'quick_contact',
        'quick_reply',
        'cancelled',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
        'cancelled' => 'boolean',
        'quick_contact' => 'boolean',
        'quick_reply' => 'boolean',
    ];

    protected $with = [
        'responses'
    ];

    protected $fireableAttributes = [
        'cancelled' => [
            true => RequestCancelled::class
        ],
    ];

    public static function clearCache(Request $request): bool
    {
        $status = Cache::tags([
            CacheUtils::TAG_REQUEST,
            CacheUtils::getRequestCacheTag($request),
        ])->flush();

        if ($status !== false) {
            \Log::debug('Flush requests cache: OK', ['CACHE']);
        } else {
            \Log::error('Flush requests cache: FAILED', ['CACHE']);
        }

        return $status;
    }

    /**
     * Response count builder
     *
     * @return \Illuminate\Database\Query\Builder
     */
    private static function getResponseCountBuilder(): \Illuminate\Database\Query\Builder
    {
        return DB::table('requests')
                 ->select(DB::raw('requests.id as id, count(responses.id) as response_count'))
                 ->leftJoin('responses', 'requests.id', '=', 'responses.request_id')
                 ->groupBy('requests.id');
    }

    /**
     * Scope a query to only include pending requests.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopePending(Builder $builder): Builder
    {
        $responseCount = self::getResponseCountBuilder();

        return $builder->joinSub($responseCount, 'response_count', function ($join) {
            $join->on('requests.id', '=', 'response_count.id');
        })->where('response_count', '=', 0)
          ->where('cancelled', false);
    }

    /**
     * Scope a query to only include pending requests.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeResponded(Builder $builder): Builder
    {
        $responseCount = self::getResponseCountBuilder();

        return $builder->joinSub($responseCount, 'response_count', function ($join) {
            $join->on('requests.id', '=', 'response_count.id');
        })->where('response_count', '>', 0);
    }

    /**
     * Scope a query to only include cancelled requests.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeCancelled(Builder $builder): Builder
    {
        return $builder->where('cancelled', true);
    }

    /**
     * Scope a query to only include NOT cancelled requests.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('cancelled', false)
                       ->where('published', true);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopePublished(Builder $builder): Builder
    {
        return $builder->where('published', true);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeUnpublished(Builder $builder): Builder
    {
        return $builder->where('published', false);
    }

    public function isCancelled(): bool
    {
        return $this->cancelled;
    }

    public function isNotCancelled(): bool
    {
        return !$this->cancelled;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id')->withTrashed();
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class)
                    ->whereHas('supplier', function (Builder $query) {
                        $query->where('disabled', false);
                    })
                    ->whereHas('request', function (Builder $query) {
                        $query->where(function (Builder $q) {
                            $q->where('requests.cancelled', true)
                              ->whereNotNull('responses.viewed_at');
                        })
                              ->orWhere('requests.cancelled', false);
                    })
                    ->orderByDesc('created_at');
    }

    public function unfilteredResponses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public function quickContacts(): HasMany
    {
        return $this->hasMany(QuickContact::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->queued()
             ->width(130)
             ->height(130)
             ->optimize()
             ->quality(80)
             ->crop(Manipulations::CROP_CENTER, 130, 130);

        $this->addMediaConversion('card')
             ->queued()
             ->width(300)
             ->height(200)
             ->optimize()
             ->quality(90)
             ->crop(Manipulations::CROP_CENTER, 300, 200);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }

    public static function findBySupplier(Supplier $supplier)
    {
        return self
            ::whereHas('area', function (Builder $query) use ($supplier) {
                $query->whereIn('id', $supplier->areas()->pluck('id'));
            })
            ->whereHas('category', function (Builder $query) use ($supplier) {
                $query->whereIn('id', $supplier->categories()->pluck('id'));
            });
    }

    public function responseCount(bool $unreadOnly = false): int
    {
        $responseList = $this->responses;

        if ($unreadOnly) {
            $responseList = $responseList->filter(fn(Response $response) => $response->viewed_at === null);
        }

        return $responseList->count();
    }

    public function hasResponses(bool $unreadOnly = false): bool
    {
        return $this->responseCount($unreadOnly) > 0;
    }

    public function hasViewedResponses(): bool
    {
        return $this->responses->filter(function (Response $response) {
            return $response->viewed_at !== null;
        })->isNotEmpty();
    }

    public function hasListedResponses(): bool
    {
        return $this->responses->filter(function (Response $response) {
            return $response->listed_at !== null;
        })->isNotEmpty();
    }

    public function getStatusAttribute(): string
    {
        if ($this->cancelled) {
            return RequestStatus::CANCELLED;
        }

        if ($this->hasViewedResponses()) {
            return RequestStatus::VIEWED;
        }

        if ($this->hasListedResponses()) {
            return RequestStatus::LISTED;
        }

        if ($this->unfilteredResponses()->count() > 0) {
            return RequestStatus::RESPONDED;
        }

        return RequestStatus::NEW;
    }

    /**
     * @param Response|null $response
     * @return string
     */
    public function getStatusForResponse(?Response $response): string
    {
        if ($this->cancelled) {
            return RequestStatus::CANCELLED;
        }

        return $response->status ?? RequestStatus::NEW;
    }

    public function getTotalPremium(): Money
    {
        $areaAmount = optional($this->area)->getPremium() ?? Money::of(0, config('currency.default'));
        $categoryAmount = optional($this->category)->getPremium() ?? Money::of(0, config('currency.default'));

        try {
            return Money::total($areaAmount, $categoryAmount);
        } catch (MoneyMismatchException $e) {
            return Money::of(0, config('currency.default'));
        }
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(CreditTransaction::class, 'model');
    }

    public function toSearchableArray(): array
    {
        return $this->only('id', 'text');
    }
}
