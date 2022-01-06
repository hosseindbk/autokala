<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;

use Illuminate\Support\Facades\Auth;

class CheckUserLogin

{

    public function handle($request, Closure $next, $guard = null)
    {
        if (! Auth::guard($guard)->check()) {
            return redirect('login');
        }

        return $next($request);
    }
}

