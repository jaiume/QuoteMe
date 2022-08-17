<?php

namespace App\Listeners\Payments;

use App\Events\RequestCreated;
use App\Models\CreditTransaction;
use App\Models\Supplier;
use App\Utils\SettingsUtils;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Queue\InteractsWithQueue;

class ChargeSuppliersForQuickNotify
{
    public function handle(RequestCreated $event): void
    {
        $request = $event->request;
        $requestAreaId = optional($request->area)->id;
        $requestCategoryId = optional($request->category)->id;

        $suppliers = Supplier
            ::where('disabled', false)
            ->whereHas('areas', function (Builder $query) use ($requestAreaId) {
                $query->where('id', $requestAreaId);
            })
            ->whereHas('categories', function (Builder $query) use ($requestCategoryId) {
                $query->where('id', $requestCategoryId);
            })
            ->get();

        $quickNotifyEnabled = SettingsUtils::get('quick_notify_enabled', false);
        $quickNotifyCost = (int)SettingsUtils::get('quick_notify', 0);
        $normalNotifyCost = (int)SettingsUtils::get('normal_request_receipt', 0);

        $suppliers->each(function (Supplier $supplier) use ($request, $quickNotifyEnabled, $quickNotifyCost, $normalNotifyCost) {
            if ($quickNotifyEnabled && $supplier->quick_notify) {
                if (!$supplier->hasEnoughCredits($quickNotifyCost) && $supplier->hasEnoughCredits($normalNotifyCost)) {
                    $transaction = CreditTransaction::make([
                        'description' => 'Normal Request Receipt',
                        'amount' => -1 * $normalNotifyCost,
                        'successful' => $supplier->hasEnoughCredits($normalNotifyCost),
                    ]);
                } else {
                    $transaction = CreditTransaction::make([
                        'description' => 'Quick Notify',
                        'amount' => -1 * $quickNotifyCost,
                        'successful' => $supplier->hasEnoughCredits($quickNotifyCost),
                    ]);
                }

                $transaction->user()->associate($supplier);
                $transaction->transactionable()->associate($request);
                $transaction->save();

                \Log::info(
                    sprintf(
                        'Charge the supplier #%d (%s, Request #%d). Status: %s',
                        $supplier->id ?? -1,
                        $transaction->description,
                        $request->id,
                        $transaction->successful ? 'success' : 'failed'
                    ),
                    ['PAYMENTS']
                );
            } else {
                $transaction = CreditTransaction::make([
                    'description' => 'Normal Request Receipt',
                    'amount' => -1 * $normalNotifyCost,
                    'successful' => $supplier->hasEnoughCredits($normalNotifyCost),
                ]);

                $transaction->user()->associate($supplier);
                $transaction->transactionable()->associate($request);
                $transaction->save();

                \Log::info(
                    sprintf(
                        'Charge the supplier (#%d) for normal notify (Request #%d). Status: %s',
                        $supplier->id ?? -1,
                        $request->id,
                        $transaction->successful ? 'success' : 'failed'
                    ),
                    ['PAYMENTS']
                );
            }
        });
    }
}
