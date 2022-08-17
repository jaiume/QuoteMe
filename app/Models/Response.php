<?php

namespace App\Models;

use App\Events\ResponseListed;
use App\Events\ResponseViewed;
use App\Traits\HasHumanReadableTimestamps;
use App\Utils\RequestStatus;
use Envant\Fireable\FireableAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Laravel\Scout\Searchable;

/**
 * Class Request
 *
 * @property float $price
 * @property string $text
 * @property bool $quick
 * @property Supplier $supplier
 * @property Request $request
 * @property string $status
 * @property Carbon|null $listed_at
 * @property Carbon|null $viewed_at
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class Response extends Model
{
    use HasFactory;
    use Searchable;
    use HasHumanReadableTimestamps;
    use FireableAttributes;

    protected $fillable = [
        'price',
        'text',
        'quick',
        'viewed_at',
        'listed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
        'listed_at' => 'datetime',
    ];

    protected $fireableAttributes = [
        'listed_at' => ResponseListed::class,
        'viewed_at' => ResponseViewed::class,
    ];

    public function getStatusAttribute(): string
    {
        if ($this->viewed_at) {
            return RequestStatus::VIEWED;
        }

        if ($this->listed_at) {
            return RequestStatus::LISTED;
        }

        return RequestStatus::RESPONDED;
    }


    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'user_id');
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class, 'request_id');
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
