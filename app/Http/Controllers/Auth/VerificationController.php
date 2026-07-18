<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';
    // Define the redirect path based on the user role
    protected function redirectTo()
{
    // Check if the user is authenticated
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

    // Default fallback if no conditions are met
    return '/';
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
