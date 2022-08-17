<?php

namespace Tests\Feature;

use App\Exceptions\InvalidMoneyValue;
use App\Models\Category;
use Brick\Money\Money;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoneyCastTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testSuccessful(): void
    {
        /* @var Category $category */
        $category = Category::factory()->state([
            'premium_amount' => Money::of('123.4', config('currency.default'))->getAmount()->toFloat(),
        ])->create();

        $this->assertIsNumeric($category->premium_amount);

        $this->assertDatabaseHas('categories', [
            'premium_amount' => '123.40'
        ]);
    }

    /**
     * @return void
     */
    public function testException(): void
    {
        /* @var Category $category */
        $category = Category::factory()->create();

        $this->expectException(InvalidMoneyValue::class);
        $category->premium_amount = 'will fail';
    }
}
