<?php

namespace App\Nova\Metrics;

use App\Models\Admin;
use App\Models\Request;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class PendingRequests extends CustomValueMetrics
{
    public function calculate(NovaRequest $request)
    {
        /* @var User | null $user*/
        $user = $request->user();

        if (Admin::where('id', optional($user)->id)->exists()) {
            return $this->result(Request::pending()->count());
        }

        if ($supplier = Supplier::find(optional($user)->id)) {
            $timezone = Nova::resolveUserTimezone($request) ?? $request->timezone;

            $count = Request::findBySupplier($supplier)
                            ->whereBetween('created_at', $this->currentRange($request->range, $timezone))
                            ->get()
                            ->filter(fn (Request $request) => !$request->responses()->where('user_id', $supplier->id)->exists())
                            ->count();

            $previous = Request::findBySupplier($supplier)
                               ->whereBetween('created_at', $this->previousRange($request->range, $timezone))
                               ->get()
                               ->filter(fn (Request $request) => !$request->responses()->where('user_id', $supplier->id)->exists())
                               ->count();

            return $this->result(round($count, $this->precision))
                        ->previous(round($previous, $this->precision));
        }

        return $this->result(0);
    }

    public function uriKey()
    {
        return 'pending-requests';
    }

    public function cacheFor()
    {
//        return now()->addMinutes(5);
    }
}
