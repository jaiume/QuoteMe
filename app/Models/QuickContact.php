<?php

namespace App\Models;

use App\Events\QuickContactCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class QuickContact
 *
 * @property Request $request
 * @property Supplier $supplier
 *
 * @property int $id
 * @property Carbon|null $created_at
 *
 * @mixin \Eloquent
 * @package App\Models
 */
class QuickContact extends Model
{
    public const UPDATED_AT = null;

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
