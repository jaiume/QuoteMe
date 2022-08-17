<?php

namespace App\Listeners;

use App\Events\RequestCreated;
use App\Jobs\SupplierNormalNotify;
use App\Jobs\SupplierQuickNotify;
use App\Models\CreditTransaction;
use App\Models\Request;
use App\Models\Supplier;
use App\Utils\SettingsUtils;
use Illuminate\Database\Eloquent\Builder;

class NotifySuppliersOnRequestCreated
{
    public function handle(RequestCreated $event): void
    {
        $request = $event->request;

        $quickNotifyEnabled = SettingsUtils::get('quick_notify_enabled', false);
        $headStartEnabled = SettingsUtils::get('head_start_enabled', false);
        $headStartDuration = (int)SettingsUtils::get('head_start', 0);

        $quickNotifyTransactionsExists = CreditTransaction
            ::where('description', 'Quick Notify')
            ->where('successful', true)
            ->whereHasMorph('transactionable', [Request::class], function (Builder $q) use ($request) {
                $q->where('id', $request->id);
            })
            ->whereHas('user', function (Builder $q) {
                $q->where('disabled', false);
            })
            ->exists();

        if ($quickNotifyEnabled && $quickNotifyTransactionsExists) {
            \Log::info(
                sprintf(
                    '(Request #%d): Quick Notifications found. Sending Quick Notification and Normal Notifications w/ headstart.',
                    $request->id,
                ),
                ['NOTIFICATIONS']
            );

            // Send all the suppliers with successful Quick-Notify transactions a Quick-Notify SMS and an Email immediately
            $quickTransactions = CreditTransaction
                ::where('description', 'Quick Notify')
                ->where('successful', true)
                ->whereHasMorph('transactionable', [Request::class], function ($query) use ($request) {
                    $query->where('id', $request->id);
                })
                ->whereHas('user', function (Builder $q) {
                    $q->where('disabled', false);
                })
                ->get();

            $quickTransactions->each(function (CreditTransaction $transaction) use ($request) {
                \Log::info(
                    sprintf(
                        'Sending quick notification for the supplier (#%d). (Request #%d).',
                        $transaction->user->id ?? -1,
                        $request->id,
                    ),
                    ['NOTIFICATIONS']
                );

                SupplierQuickNotify::dispatch($request, $transaction->user);
                SupplierNormalNotify::dispatch($request, $transaction->user);
            });


            // Queue a normal email notification for all the suppliers with a successful normal transaction to be sent after the headstart period
            $normalTransactions = CreditTransaction
                ::where('description', 'Normal Request Receipt')
                ->where('successful', true)
                ->whereHasMorph('transactionable', [Request::class], function ($query) use ($request) {
                    $query->where('id', $request->id);
                })
                ->whereHas('user', function (Builder $q) {
                    $q->where('disabled', false);
                })
                ->get();

            $normalTransactions->each(function (CreditTransaction $transaction) use ($request, $headStartEnabled, $headStartDuration) {
                if ($headStartEnabled && $headStartDuration > 0) {
                    \Log::info(
                        sprintf(
                            'Sending normal notification delayed for the %d minutes for the supplier (#%d). (Request #%d).',
                            $headStartDuration,
                            $supplier->id ?? -1,
                            $request->id,
                        ),
                        ['NOTIFICATIONS']
                    );

                    SupplierNormalNotify::dispatch($request, $transaction->user)
                                        ->delay(now()->addMinutes($headStartDuration));
                } else {
                    \Log::info(
                        sprintf(
                            'Sending normal notification w/o headstart (because it\'s turned off) for the supplier (#%d). (Request #%d).',
                            $supplier->id ?? -1,
                            $request->id,
                        ),
                        ['NOTIFICATIONS']
                    );

                    SupplierNormalNotify::dispatch($request, $transaction->user);
                }
            });
        } else {
            \Log::info(
                sprintf(
                    '(Request #%d): No quick notification found for the request. Sending normal notifications only, but w/o headstart.',
                    $request->id,
                ),
                ['NOTIFICATIONS']
            );

            $normalTransactions = CreditTransaction
                ::where('description', 'Normal Request Receipt')
                ->where('successful', true)
                ->whereHasMorph('transactionable', [Request::class], function ($query) use ($request) {
                    $query->where('id', $request->id);
                })
                ->whereHas('user', function (Builder $q) {
                    $q->where('disabled', false);
                })
                ->get();

            // Send all suppliers with a successful normal transaction and email notification immediately.
            $normalTransactions->each(function (CreditTransaction $transaction) use ($request) {
                \Log::info(
                    sprintf(
                        'Sending normal notification without the headstart for the supplier (#%d). (Request #%d).',
                        $transaction->user->id ?? -1,
                        $request->id,
                    ),
                    ['NOTIFICATIONS']
                );

                SupplierNormalNotify::dispatch($request, $transaction->user);
            });
        }
    }
}
