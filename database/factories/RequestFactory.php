<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'text' => $this->faker->paragraph,
            'url' => random_int(0, 10) > 5 ? $this->faker->imageUrl() : null,
            'user_id' => User::factory(),
            'area_id' => Area::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
