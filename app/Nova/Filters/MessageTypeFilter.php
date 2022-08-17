<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class MessageTypeFilter extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if (!$value['sms'] || !$value['email']) {
            return $query->where('sms', $value['sms'])
                         ->where('sms', !$value['email']);
        }

        return $query;
    }

    public function default(): array
    {
        return [
            'sms' => 1,
            'email' => 1,
        ];
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            __('SMS') => 'sms',
            __('Email') => 'email',
        ];
    }
}
