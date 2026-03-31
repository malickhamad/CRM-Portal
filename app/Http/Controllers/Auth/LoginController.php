<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard';
    // Define the redirect path based on the user role
    protected function redirectTo()
    {
        if (Auth::check()) {
            // Redirect 'User' role and 'SubUser' role to /user/dashboard
            if (Auth::user()->hasAnyRole('Subuser')) {
                return '/user/subuserdashboard';
            }

            if (Auth::user()->hasRole('User')) {
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
