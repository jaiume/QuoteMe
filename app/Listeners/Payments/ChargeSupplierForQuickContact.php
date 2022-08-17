<?php

namespace App\Listeners\Payments;

use App\Events\QuickContactCreated;
use App\Models\CreditTransaction;
use App\Utils\SettingsUtils;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChargeSupplierForQuickContact
{
    public function handle(QuickContactCreated $event): void
    {
        $quickContactCost = SettingsUtils::get('quick_contact', 0);

        $quickContact = $event->quickContact;

        $transaction = CreditTransaction::make([
            'description' => __('Quick Contact'),
            'amount' => -1 * $quickContactCost,
            'successful' => true,
        ]);

        $transaction->user()->associate($quickContact->supplier);

        $transaction->transactionable()->associate($quickContact);

        $status = $transaction->save();

        \Log::info(
            sprintf(
                'Charge the supplier (#%d) for quick contact (#%d). Status: %s',
                optional($quickContact->supplier)->id ?? -1,
                $quickContact->id,
                $status ? 'success' : 'failed'
            ),
            ['PAYMENTS']
        );
    }
}
