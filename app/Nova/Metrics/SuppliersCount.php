<?php

namespace App\Nova\Metrics;

use App\Models\Supplier;
use Laravel\Nova\Http\Requests\NovaRequest;

class SuppliersCount extends CustomValueMetrics
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Supplier::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            'ALL_TIME' => __('Total'),
        ];
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'total-suppliers';
    }
}
