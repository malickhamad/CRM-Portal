<?php

namespace App\Http\Middleware;

use App\Models\StripePayment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // 1. Allow only users with 'User' or 'Subuser' roles
        if (!$user->hasRole('User') && !$user->hasRole('Subuser')) {
            abort(403, 'Only User or Subuser can access this feature');
        }

        // 2. If the user is a subuser, check parent subscription
        if ($user->parent_id) {
            $parentHasActiveSubscription = StripePayment::where('user_id', $user->parent_id)
                ->where('is_active', true)
                ->where('ends_at', '>=', now())
                ->exists();

            if ($parentHasActiveSubscription) {
                return $next($request); // Allow subuser if parent has active subscription
            }
        }

        // 3. Check if the user has an active subscription
        $user = Auth::user();
        $hasActiveSubscription = StripePayment::where('user_id', $user->id)
            ->where('is_active', true)
            ->where('ends_at', '>=', now())
            ->exists();

        if ($hasActiveSubscription) {
            return $next($request); // Allow main user
        }

        // 4. If neither user nor parent has active subscription
        return redirect()->route('user.dashboard')->with('error', 'Your subscription is inactive or expired.');
    }
}
