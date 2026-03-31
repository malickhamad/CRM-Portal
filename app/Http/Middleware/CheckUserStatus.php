<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    // app/Http/Middleware/CheckUserStatus.php

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Check if user is inactive
            if ($user->status === 'inactive') {
                auth()->logout();
                return redirect()->route('login')
                    ->with('error', 'Your account is inactive. Please contact the administrator.');
            }

            // Check if parent user is inactive (for subusers)
            if ($user->parent && $user->parent->status === 'inactive') {
                auth()->logout();
                return redirect()->route('login')
                    ->with('error', 'Your parent account is inactive. Please contact the administrator.');
            }
        }

        return $next($request);
    }
}
