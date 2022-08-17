<?php

namespace App\Observers;

use App\Events\TransactionCreated;
use App\Models\CreditTransaction;

class TransactionObserver
{
    public function created(CreditTransaction $creditTransaction): void
    {
        CreditTransaction::clearCache($creditTransaction);

        event(new TransactionCreated($creditTransaction));
    }

    public function updated(CreditTransaction $creditTransaction): void
    {
        CreditTransaction::clearCache($creditTransaction);
    }

    public function saved(CreditTransaction $creditTransaction): void
    {
        CreditTransaction::clearCache($creditTransaction);
    }

    public function deleted(CreditTransaction $creditTransaction): void
    {
        CreditTransaction::clearCache($creditTransaction);
    }
}
