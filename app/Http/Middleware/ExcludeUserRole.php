<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ExcludeUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and does not have the "User" role
        if (Auth::check() && !Auth::user()->hasRole('User')) {
            return $next($request);
        }else {
            abort(403);
        }

        // Redirect to home if the user has the "User" role
        return redirect('/');
    }

}
