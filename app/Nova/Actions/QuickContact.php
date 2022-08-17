<?php

namespace App\Nova\Actions;

use App\Models\Request;
use App\Models\Supplier;
use App\Utils\SettingsUtils;
use Brick\Money\Money;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Nova;

class QuickContact extends Action
{
    use InteractsWithQueue, Queueable;

    public function __construct($name = null)
    {
        $this->name = $name ?? __('Quick Contact');
    }

    /**
     * Get the URI key for the action.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'quick-contact';
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $supplier = Supplier::find(\Auth::id());

        if ($supplier) {
            $request = $models->first();
            /* @var Request $request */

            try {
                /* If the user already paid for the QuickContact on this request */
                $quickContact = \App\Models\QuickContact
                    ::whereHas('request', function (Builder $query) use ($request) {
                        $query->where('id', $request->id);
                    })
                    ->whereHas('supplier', function (Builder $query) use ($supplier) {
                        $query->where('id', $supplier->id);
                    })
                    ->firstOrFail();
            } catch (ModelNotFoundException $e) {
                /* If the user isn't payed */

                /* Check if user don't have enough money */
                $quickContactCost = Money::of(
                    SettingsUtils::get('quick_contact'),
                    config('currency.default')
                )->plus($request->getTotalPremium());

                $hasEnoughMoneyToQuickContact = optional($supplier)->hasEnoughMoney($quickContactCost);

                if (!$hasEnoughMoneyToQuickContact) {
                    return Action::push('/resources/credit-transactions', [
                        'viaResource' => 'requests',
                        'viaResourceId' => $request->id,
                    ]);
                }

                /* User has enough money => create new QuickContact record */
                $quickContact = \App\Models\QuickContact::make();
                $quickContact->request()->associate($request);
                $quickContact->supplier()->associate($supplier);
            }

            if ($quickContact->save()) {
                return Action::push(sprintf('/resources/quick-contacts/%s', $quickContact->id), [
                    'viaResource' => 'requests',
                    'viaResourceId' => $request->id,
                ]);
            }
        }

        return Action::danger('Something went wrong!');
    }
}
