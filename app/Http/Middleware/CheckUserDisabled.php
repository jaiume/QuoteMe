<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserDisabled
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
        if (\Auth::check() && \Auth::user() !== null && \Auth::user()->isDisabled()) {
            \Auth::logout();

            $message = 'Your account has been suspended. Please contact administrator.';
            return redirect()->route('login')
                             ->withErrors(['message' => $message]);
        }

        return $next($request);
    }
}
