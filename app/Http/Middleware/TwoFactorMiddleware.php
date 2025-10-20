<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->two_fa_enabled && !$request->session()->get('2fa_passed')) {
            return redirect('/2fa');
        }
        return $next($request);
    }
}
