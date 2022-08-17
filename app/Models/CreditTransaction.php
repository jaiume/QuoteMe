<?php

namespace App\Models;

use App\Events\TransactionAuthorizedChanged;
use App\Utils\CacheUtils;
use Eloquent;
use Envant\Fireable\FireableAttributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * Class CreditTransaction
 *
 * @property int $id
 * @property int $amount
 * @property bool $successful
 * @property string $description
 * @property User $user
 * @property Model[] $transactionable
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin Eloquent
 * @package App\Models
 */
class CreditTransaction extends Model
{
    use FireableAttributes;

    protected $fillable = [
        'amount',
        'description',
        'successful',
    ];

    protected $casts = [
        'amount' => 'integer',
        'successful' => 'boolean',
    ];

    protected $fireableAttributes = [
        'successful' => TransactionAuthorizedChanged::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactionable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function scopeSuccessful(Builder $builder): Builder
    {
        return $builder->where('successful', true);
    }

    public function scopeUnsuccessful(Builder $builder): Builder
    {
        return $builder->where('successful', false);
    }

    public static function clearCache(CreditTransaction $transaction): bool
    {
        Cache::forget(CacheUtils::getUserWalletBalanceCacheName(optional($transaction->user)->id ?? 0));

        $status = Cache::tags([
            CacheUtils::TAG_TRANSACTION,
            CacheUtils::getTransactionCacheTag($transaction)
        ])->flush();

        if ($status === false) {
            \Log::error('Flush transactions cache: FAILED', ['CACHE']);
        } else {
            \Log::debug('Flush transactions cache: OK', ['CACHE']);
        }

        return $status;
    }
}
