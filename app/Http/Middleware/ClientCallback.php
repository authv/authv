<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ClientCallback
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Route::getCurrentRoute()->getName() == 'discourse-sso') {
            return $next($request);
        }
        if (Auth::guard($guard)->check()) {
            if ($request->session()->has('client_id')) {
                return redirect()->route('discourse-sso');
            }

            return $next($request);
        }

        return $next($request);
    }
}
