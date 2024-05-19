<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
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
