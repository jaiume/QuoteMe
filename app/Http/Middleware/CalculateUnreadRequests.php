<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class CalculateUnreadRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /* @var Customer|null $customer */
        $customer = $request->customer;

        if ($customer) {
            $unreadResponsesCount = $customer->unread_responses->count();

            $request->merge([
                'unread_responses' => $unreadResponsesCount,
            ]);
        }

        return $next($request);
    }
}
