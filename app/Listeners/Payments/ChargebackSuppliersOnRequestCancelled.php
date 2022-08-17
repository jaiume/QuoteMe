<?php

namespace App\Listeners\Payments;

use App\Events\RequestCancelled;
use App\Models\CreditTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChargebackSuppliersOnRequestCancelled
{
    public function handle(RequestCancelled $event): void
    {
        $request = $event->request;

        foreach ($request->responses as $response) {
            if ($response->viewed_at) {
                /* Skipping already viewed actions */
                continue;
            }

            /*
             * If response is not viewed at the moment of request cancellation
             * we should chargeback the supplier who created that response
             */
            foreach ($response->transactions as $transaction) {
                $chargeback = CreditTransaction::make([
                    'description' => __('Chargeback for transaction #:id', ['id' => $transaction->id]),
                    'amount' => -1 * $transaction->amount,
                    'successful' => true,
                ]);

                $chargeback->user()->associate($transaction->user);
                $chargeback->transactionable()->associate($transaction->transactionable);

                $status = $chargeback->save();

                \Log::info(
                    sprintf(
                        'Chargeback the supplier (#%d) for transaction (#%d) due the request cancellation. Status: %s',
                        optional($chargeback->user)->id ?? -1,
                        $chargeback->id,
                        $status ? 'success' : 'failed'
                    ),
                    ['PAYMENTS']
                );
            }
        }
    }
}
