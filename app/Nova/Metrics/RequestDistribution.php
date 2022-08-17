<?php

namespace App\Nova\Metrics;

use App\Models\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class RequestDistribution extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this
            ->result([
                'Pending' => Request::pending()->count(),
                'Responded' => Request::responded()->count(),
                'Cancelled' => Request::cancelled()->count(),
            ])
            ->colors([
                'Pending' => 'var(--primary-dark)',
                'Responded' => 'var(--success)',
                'Cancelled' => 'var(--danger)',
            ]);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
//         return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'request-distribution';
    }
}
