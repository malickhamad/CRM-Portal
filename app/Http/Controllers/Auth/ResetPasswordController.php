<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';
    // Define the redirect path based on the user role
    protected function redirectTo()
    {

        if (Auth::check()) {
            // Redirect 'User' role and 'SubUser' role to /user/dashboard
            if (Auth::user()->hasAnyRole(['User', 'Subuser'])) {
                return '/user/dashboard';
            }

            // Redirect 'Admin' role to /admin/dashboard
            if (Auth::user()->hasRole('Admin')) {
                return '/admin/dashboard';
            }

            // Fallback for users with no roles assigned
            return '/user-has-no-role'; // Update this route as per your requirements
        }

        // Default fallback if no conditions are met
        return '/';
    }
}
