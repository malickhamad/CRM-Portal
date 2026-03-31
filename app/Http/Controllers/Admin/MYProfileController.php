<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MYProfileController extends Controller

    {
        // Show My Profile
        public function showProfile()
        {
            $user = Auth::user();
            return view('backend.my-profile.my-profile', compact('user'));
        }

        // Update My Profile
        public function updateProfile(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
            ]);

            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('admin.my-profile')->with('success', 'Profile updated successfully.');
        }

        // Show Account Settings
        public function showAccountSettings()
        {
            return view('backend.my-profile.account-settings');
        }

        // Update Password
        public function updatePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.account-settings')->with('success', 'Password updated successfully.');
        }
    }


