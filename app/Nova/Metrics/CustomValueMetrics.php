<?php


namespace App\Nova\Metrics;


use Carbon\Carbon;
use Laravel\Nova\Metrics\Value;

class CustomValueMetrics extends Value
{
    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            'ALL_TIME' => __('All Time'),
            'MTD' => __('This Month'),
            'YTD' => __('This Year'),
            'TODAY' => __('Today'),
            'YESTERDAY' => __('Yesterday'),
            'LAST_WEEK' => __('Last Week'),
        ];
    }

    /**
     * Calculate the previous range and calculate any short-cuts.
     *
     * @param string|int $range
     * @param string $timezone
     * @return array
     */
    protected function previousRange($range, $timezone)
    {
        if ($range === 'YESTERDAY') {
            return [
                now($timezone)->subDays(2)->startOfDay(),
                now($timezone)->subDays(2)->endOfDay(),
            ];
        }

        if ($range === 'LAST_WEEK') {
            return [
                now($timezone)->subWeeks(2)->startOfWeek(),
                now($timezone)->subWeeks(2)->endOfWeek(),
            ];
        }

        if ($range === 'ALL_TIME') {
            return [
                Carbon::createFromTimestamp(0),
                now($timezone),
            ];
        }

        return parent::previousRange($range, $timezone);
    }

    /**
     * Calculate the current range and calculate any short-cuts.
     *
     * @param string|int $range
     * @param string $timezone
     * @return array
     */
    protected function currentRange($range, $timezone)
    {
        if ($range === 'YESTERDAY') {
            return [
                now($timezone)->subDays(1)->startOfDay(),
                now($timezone)->subDays(1)->endOfDay(),
            ];
        }

        if ($range === 'LAST_WEEK') {
            return [
                now($timezone)->subWeek()->startOfWeek(),
                now($timezone)->subWeek()->endOfWeek(),
            ];

        }

        if ($range === 'ALL_TIME') {
            return [
                Carbon::createFromTimestamp(0),
                now($timezone),
            ];
        }

        return parent::currentRange($range, $timezone);
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
}
