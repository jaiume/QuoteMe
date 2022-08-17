<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthorizeCustomer
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
        if (\Auth::check()) {
            return $next($request);
        }

        $token = $request->query('auth_token', $request->cookie('auth_token'));

        $user = Customer::whereNotNull('auth_token')
                        ->where('auth_token', $token)
                        ->where('disabled', false)
                        ->first();

        if ($user instanceof Customer) {
            \Auth::login($user);
        }

        return $next($request)->withCookie(Cookie::forever('auth_token', $token));
    }
}
