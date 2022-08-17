<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Plan
 *
 * @property int $id
 * @property string|null $name
 * @property float $price
 * @property int $credits_amount
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class Plan extends Model
{
    use HasFactory;
    use Searchable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'credits_amount',
        'price',
    ];

    protected $casts = [
        'credits_amount' => 'integer',
        'price' => MoneyCast::class,
    ];

    public function toSearchableArray(): array
    {
        return $this->only('id', 'name');
    }
}
