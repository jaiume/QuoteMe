<?php

namespace Database\Factories;

use App\Models\Category;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'premium_amount' => Money::of(
                random_int(0, 100) . '.' . random_int(0, 99),
                config('currency.default')
            )->getAmount()->toFloat(),
        ];
    }
}
