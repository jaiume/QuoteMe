<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\CancelledRequests;
use App\Nova\Metrics\PendingRequests;
use App\Nova\Metrics\RequestCount;
use App\Nova\Metrics\RequestDistribution;
use App\Nova\Metrics\RespondedRequests;
use Laravel\Nova\Dashboard;

class Requests extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            (new RequestDistribution),
            (new RequestCount),
            (new PendingRequests),
            (new RespondedRequests),
            (new CancelledRequests),
        ];
    }

    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public static function label()
    {
        return __('Requests');
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'requests';
    }
}
