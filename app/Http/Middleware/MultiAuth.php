<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuth
{
    protected $guards = ['admin', 'kader'];

    public function handle(Request $request, Closure $next)
    {
        foreach ($this->guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::shouldUse($guard);
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
