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

        // if ($permission && !$user->canAccess($permission, $module)) {
        //     return redirect('/')->with('error', 'You do not have permission to access this module.');
        // }

        // if (!$user->hasModuleAccess($module)) {
        //     return redirect('/')->with('error', 'You do not have access to this module.');
        // }

        return $next($request);
    }
}
