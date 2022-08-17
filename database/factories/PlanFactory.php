<?php

namespace Database\Factories;

use App\Models\Plan;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->colorName,
            'credits_amount' => $this->faker->numberBetween(10, 500),
            'price' => Money::of(
                random_int(0, 100) . '.0',
                config('currency.default')
            )->getAmount()->toFloat(),
        ];
    }
}
