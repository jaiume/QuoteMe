<?php

namespace App\Events;

use App\Models\CreditTransaction;
use App\Models\Supplier;
use App\Utils\SettingsUtils;
use Illuminate\Foundation\Events\Dispatchable;

class TransactionCreated
{
    use Dispatchable;

    public CreditTransaction $transaction;

    public function __construct(CreditTransaction $transaction)
    {
        $this->transaction = $transaction;

        /* Calculate current credits amount and compare it with the threshold value */
        $supplier = Supplier::find($this->transaction->user->id);
        if ($supplier) {
            $lowCreditThreshold = SettingsUtils::get('low_credit_threshold', 0);

            \Log::debug(sprintf('Checking the credits amount: %s, threshold: %s', $supplier->getWalletBalance(), $lowCreditThreshold));

            if ($supplier->getWalletBalance() < $lowCreditThreshold) {
                event(new CreditsLow($supplier));
            }
        }
    }
}
