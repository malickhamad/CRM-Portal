<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Log; // ✅ Added for logging

class RegisterController extends Controller
{
    use RegistersUsers;

    // protected function redirectTo()
    // {
    //     if (Auth::check() && Auth::user()->hasRole('User','subuser')) {
    //         return '/user/dashboard';
    //     } elseif (Auth::check() && Auth::user()->roles->isNotEmpty() && !Auth::user()->hasRole('User')) {
    //         return '/admin/dashboard';
    //     }
    //     return '/';
    // }

    protected function redirectTo()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('Subuser')) {
                return '/user/dashboard'; // Redirect subusers to user dashboard
            }

            if ($user->hasRole('User')) {
                return '/user/profile'; // Redirect users to user dashboard
            }

            if ($user->hasRole('Admin')) {
                return '/admin/dashboard'; // Redirect admin to admin dashboard
            }
        }

        return '/'; // Default fallback
    }


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign "User" role (create if missing)
        if (!Role::where('name', 'User')->exists()) {
            Role::create(['name' => 'User']);
        }
        $user->assignRole('User');

        // Try to send welcome email
        configure_smtp_from_db();
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            Log::error("Failed to send welcome email to {$user->email}: " . $e->getMessage());
        }

        // Log user registration
        Log::info('User Registered:', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => request()->ip(),
        ]);

        return $user;
    }
}
