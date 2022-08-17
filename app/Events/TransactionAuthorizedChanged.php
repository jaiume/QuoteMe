<?php

namespace App\Events;

use App\Models\CreditTransaction;
use Illuminate\Foundation\Events\Dispatchable;

class TransactionAuthorizedChanged
{
    use Dispatchable;

    public CreditTransaction $transaction;

    public function __construct(CreditTransaction $transaction)
    {
        $this->transaction = $transaction;

        if ($transaction->successful && $transaction->amount > 0) {
            event(new CreditsPurchased($transaction));
        }
    }
}
