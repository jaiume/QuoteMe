<?php

namespace App\Nova\Actions;

use App\Models\CreditTransaction;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;

class ComplimentaryCredits extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $failed = false;

        foreach ($models as $model) {
            /* @var Customer $model */
            $amount = (int)$fields->amount;

            if ($amount > 0) {
                CreditTransaction::make([
                    'description' => 'Complimentary credits',
                    'amount' => $amount,
                    'successful' => true,
                ])
                    ->user()
                    ->associate($model)
                    ->save();
            } else {
                $failed = true;
            }

            if (!$failed) {
                return Action::message('Successfully added');
            }

            return Action::danger('Incorrect amount');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Number::make('Credits Amount', 'amount')
                  ->min(0)
                  ->step(1),
        ];
    }
}
