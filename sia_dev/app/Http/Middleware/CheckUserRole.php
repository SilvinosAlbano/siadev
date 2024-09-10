<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, $role, $module = null)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();

        // Check if the user has the specified role
        if (!$user->hasRole($role)) {
            return redirect('/')->with('error', 'You do not have the required role.'); // Redirect with error
        }

        // Optional: Check if the user has access to a specific module
        if ($module && !$user->hasModuleAccess($module)) {
            return redirect('/')->with('error', 'You do not have access to this module.'); // Redirect with error
        }

        return $next($request); // Proceed to the next request
    }
}
