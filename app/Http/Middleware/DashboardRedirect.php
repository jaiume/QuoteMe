<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Utils\PermissionUtils;

class DashboardRedirect {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, \Closure $next, ...$guards) {
        /* @var User|null $user */
        $user = \Auth::user();

        if ($user) {
            if (!$request->routeIs('nova*') && !$user->hasAnyRole([PermissionUtils::ROLE_CUSTOMER, PermissionUtils::ROLE_SUPPLIER])) {
                return redirect(config('nova.path'));
            }

            if ($request->routeIs('nova*') && !$user->hasPermissionTo(PermissionUtils::NOVA_ACCESS)) {
                return redirect()->route('customer.home');
            }
        }

        return $next($request);
    }
}
