<?php

namespace App\Casts;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PhoneNumberCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        if (!$value) {
            return null;
        }

        return self::removeNonNumericCharacters($value);
    }

    /**
     * Returns $value string with only numeric characters in it.
     * Removes spaces, dashes, etc
     *
     * @param string $value
     * @return string
     */
    public static function removeNonNumericCharacters(string $value): string
    {
        return preg_replace('/[^\d+]/', '', $value);
    }

    /**
     * @param string|null $value
     * @return string|null
     */
    public static function format(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        try {
            return (string) PhoneNumber::make($value)
                                       ->ofCountry('TT')
                                       ->formatInternational();
        } catch (\Exception $e) {
            return $value;
        }
    }
}
