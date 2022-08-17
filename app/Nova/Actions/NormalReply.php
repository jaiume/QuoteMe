<?php

namespace App\Nova\Actions;

use App\Models\Request;
use App\Models\Response;
use App\Models\Supplier;
use App\Utils\SettingsUtils;
use Brick\Money\Money;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;

class NormalReply extends Action
{
    use InteractsWithQueue, Queueable;

    public function __construct($name = null)
    {
        $this->name = $name ?? __('Normal Response');
    }

    /**
     * Get the URI key for the action.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'normal-reply';
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

            $normalReplyCost = Money::of(
                SettingsUtils::get('normal_reply'),
                config('currency.default')
            );

            $hasEnoughMoneyToNormalReply = optional($supplier)->hasEnoughMoney($normalReplyCost);
            if (!$hasEnoughMoneyToNormalReply) {
                return Action::push('/resources/credit-transactions', [
                    'viaResource' => 'requests',
                    'viaResourceId' => $request->id,
                ]);
            }

            /* @var Request $request */
            $response = Response::make([
                'price' => $fields->price,
                'text' => $fields->text,
            ]);

            $response->supplier()->associate($supplier);
            $response->request()->associate($request);

            if ($response->save()) {
                return Action::message('Respond sent successfully!');
            }
        }

        return Action::danger('Something went wrong!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Currency::make('Price', 'price'),

            Textarea::make('Text', 'text'),
        ];
    }
}
