<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MYProfileController extends Controller

{
    // Show My Profile


  public function showProfile()
{
    $user = Auth::user();
    $profile = $user->profile ?? new Profile();

    $query = Application::with('user')
        ->whereNotNull('commission_amount');

    if (!auth()->user()->hasRole('Admin')) {
        $query->where('user_id', auth()->id());
    }

    $commissions = (clone $query)
        ->orderBy('mature_date', 'desc')
        ->get()
        ->groupBy(function ($item) {
            return optional($item->mature_date)->format('F Y')
                ?? $item->created_at->format('F Y');
        });

    return view('backend.my-profile.my-profile', compact('commissions', 'user', 'profile'));
}
    // Show Edit Profile (allow modification)
    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile(); // Fetch profile or create a new empty one.
        return view('backend.my-profile.edit-profile', compact('user', 'profile'));
    }


    public function updateProfile(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'code' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'cnic_no' => 'nullable|string|max:255',
            'mobile_no' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'religion' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'account_title' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        // Get the current authenticated user
        $user = Auth::user();

        // Update user's name and email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save(); // Save user data

        // If the user doesn't have a profile, create a new one; otherwise, update the existing one
        $profile = $user->profile ?? new Profile();

        // Ensure the user_id is set for the profile
        $profile->user_id = $user->id;  // Set the user_id to associate the profile with the user

        // Update the profile with the new data from the form
        $profile->name = $request->name;
        $profile->code = $request->code;
        $profile->designation = $request->designation;
        $profile->status = $request->status;
        $profile->cnic_no = $request->cnic_no;
        $profile->mobile_no = $request->mobile_no;
        $profile->email = $request->email; // Ensure the profile email is updated if needed
        $profile->marital_status = $request->marital_status;
        $profile->dob = $request->dob;
        $profile->religion = $request->religion;
        $profile->floor = $request->floor;
        $profile->shift = $request->shift;
        $profile->department = $request->department;
        $profile->account_title = $request->account_title;
        $profile->account_number = $request->account_number;
        $profile->address = $request->address;

        // Save the profile (this will insert a new profile or update the existing one)
        $profile->save();

        // Redirect to the profile page with a success message
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
