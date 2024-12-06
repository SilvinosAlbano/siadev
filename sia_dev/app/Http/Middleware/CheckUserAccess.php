<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $module
     * @param  string|null  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $module = null, $permission = null)
    {
        // dd('Middleware Loaded');
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
