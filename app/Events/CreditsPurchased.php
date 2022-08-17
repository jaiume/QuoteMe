<?php

namespace App\Events;

use App\Models\CreditTransaction;
use Illuminate\Foundation\Events\Dispatchable;

class CreditsPurchased
{
    use Dispatchable;

    public CreditTransaction $transaction;

    public function __construct(CreditTransaction $transaction)
    {
        $this->transaction = $transaction;
    }
}
