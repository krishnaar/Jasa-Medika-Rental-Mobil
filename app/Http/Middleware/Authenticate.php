<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (Auth::guard($guard)->check() && Auth::user()->role->id == 1) {
          return redirect()->route('admin.dashboard');
        }elseif (Auth::guard($guard)->check() && Auth::user()->role->id == 2) {
          return redirect()->route('user.car.index');
        }else {
          return $next($request);
        }
    }
}
