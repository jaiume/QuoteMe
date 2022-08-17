<?php

namespace Quoteme\BuyCreditsCard;

use App\Models\Plan;
use Illuminate\Support\Str;
use Laravel\Nova\Card;

/**
 * Class BuyCreditsCard
 * @package Quoteme\BuyCreditsCard
 */
class BuyCreditsCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'buy-credits-card';
    }

    /**
     * @return BuyCreditsCard
     */
    public function withPlans(): BuyCreditsCard
    {
        $plans = Plan::all()->map(function ($plan) {
            /* @var Plan $plan */
            $label = $plan->name
                ? sprintf(
                    __('%s: %d %s for %.2f %s'),
                    $plan->name,
                    $plan->credits_amount,
                    Str::plural(__('credit'), $plan->credits_amount),
                    $plan->price,
                    config('currency.default')
                )
                : sprintf(
                    __('%d %s for %.2f %s'),
                    $plan->credits_amount,
                    Str::plural(__('credit'), $plan->credits_amount),
                    $plan->price,
                    config('currency.default')
                );

            return [
                'label' => $label,
                'value' => $plan->id,
                'creditsAmount' => $plan->credits_amount,
                'price' => $plan->price,
            ];
        });

        return $this->withMeta([
            'plans' => $plans,
        ]);
    }

    /**
     * @param string|null $currency
     * @return BuyCreditsCard
     */
    public function withCurrency(?string $currency): BuyCreditsCard
    {
        return $this->withMeta([
            'currency' => $currency ?? config('currency.default')
        ]);
    }

    /**
     * @param int $amount
     * @return BuyCreditsCard
     */
    public function creditsAmount(int $amount = 0): BuyCreditsCard
    {
        return $this->withMeta([
            'amount' => $amount
        ]);
    }
}
