<?php

namespace App\Casts;

use App\Exceptions\InvalidMoneyValue;
use Brick\Math\BigNumber;
use Brick\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param BigNumber|int|float|string $value
     * @param array $attributes
     * @return float
     */
    public function get($model, $key, $value, $attributes): ?float
    {
        if (!$value) {
            return Money::of(0, config('currency.default'))->getAmount()->toFloat();
        }

        return Money::of($value, config('currency.default'))->getAmount()->toFloat();
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param float|int $value
     * @param array $attributes
     * @return string
     * @throws InvalidMoneyValue
     */
    public function set($model, $key, $value, $attributes): string
    {
        if (is_numeric($value)) {
            return Money::of($value, config('currency.default'))->getAmount();
        }

        throw new InvalidMoneyValue('The given value is not numeric');
    }
}
