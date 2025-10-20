<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceSanctumGuard
{
    /**
     * Handle an incoming request.
     * Force the default auth guard to 'sanctum' for the duration of the request.
     */
    public function handle(Request $request, Closure $next)
    {
        // temporarily set the default guard to sanctum so packages like Spatie use the correct guard
        config(['auth.defaults.guard' => 'sanctum']);

        return $next($request);
    }
}
