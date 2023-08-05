<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()|| Auth::user()->level !== 'admin') {
            abort(403);
        }
        return $next($request);
    }
}
