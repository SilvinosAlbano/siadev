<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }

        // Check if the user has the required role (if specified)
        if ($role && Auth::user()->role !== $role) {
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }

        // Proceed to the next middleware/request
        return $next($request);
    }
}
