<?php

namespace App\Nova\Metrics;

use App\Models\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class CancelledRequests extends CustomValueMetrics
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Request::cancelled());
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'cancelled-requests';
    }
}
