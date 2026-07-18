<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
