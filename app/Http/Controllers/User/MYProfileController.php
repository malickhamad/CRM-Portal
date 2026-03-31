<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StripePayment;
use App\Models\Standard;
use App\Models\SubscribtionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

class MYProfileController extends Controller
{
    // Show Profile Page
    public function showProfile()
    {
        $user = Auth::user();

        return view('backend.user.my-profile.profile', compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    // Check if profile is already completed
    if ($user->profile_completed) {
        return redirect()->route('user.profile')->with('error', 'Your profile has already been completed and cannot be edited further.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => [
            'required',
            'string',
            'max:20',
            'regex:/^(\+|00)\d{6,20}$/'
        ],
        'street_address' => 'nullable|string|max:500',
        'country' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'city' => 'nullable|string|max:100',
        'business_address' => 'nullable|string|max:1000',
        'password' => 'nullable|min:8|confirmed',
        'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,bmp', 'max:5120'],
    ], [
        'phone.required' => 'We need your phone number to contact you.',
        'phone.string' => 'Please enter a valid phone number.',
        'phone.max' => 'Phone number is too long (max 20 digits).',
        'phone.regex' => 'Please enter a valid international number starting with + or 00 (e.g., +44123456789 or 0044123456789).',
        'profile_picture.mimes' => 'Only jpeg, png, jpg, gif, webp, and bmp image formats are supported.',
    ]);

    // Update user data
    $user->name = $request->name;
    $user->email = $request->email;
    $user->business_name = $request->business_name;
    $user->phone = $request->phone;
    $user->street_address = $request->street_address;
    $user->country = $request->country;
    $user->state = $request->state;
    $user->city = $request->city;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        // Delete old profile picture if exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $path;
    }

    // Mark profile as completed
    $user->profile_completed = true;
    $user->save();

    return redirect()->route('user.profile')->with('success', 'Profile completed successfully!');
}

    // Show Subscription Page
    public function showSubscription(Request $request)
    {
        $user = Auth::user();
        $standards = Standard::all();
        $plans = SubscribtionPlan::all();
        $currentPayment = StripePayment::where('user_id', $user->id)->latest()->first();
        $selectedStandards = $currentPayment ? $currentPayment->standards->pluck('id')->toArray() : [];

        // 👇 یہ add کریں:
        $selectedPlan = null;
        if ($request->has('plan_id')) {
            $selectedPlan = SubscribtionPlan::find($request->plan_id);
        }

        return view('backend.user.my-profile.subscription', compact(
            'user',
            'standards',
            'plans',
            'currentPayment',
            'selectedStandards',
            'selectedPlan' // 👈 یہ بھی ساتھ بھیجیں
        ));
    }


    // Update Subscription
    public function updateSubscription(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:subscribtion_plans,id',
            'standards' => 'required|array',
            'standards.*' => 'exists:standards,id',
            'payment_method' => 'required|in:online,cheque',
            'transaction_reference' => 'required_if:payment_method,online',
            'cheque_number' => 'required_if:payment_method,cheque',
        ]);

        $user = Auth::user();

        // Deactivate any existing active subscriptions
        StripePayment::where('user_id', $user->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $payment = StripePayment::create([
            'user_id' => $user->id,
            'subscribtion_plan_id' => $request->plan_id,
            'currency' => 'USD',
            'is_active' => true,
            'starts_at' => now(),
            'ends_at' => $this->calculateEndDate($request->plan_id),
            'payment_method' => $request->payment_method,
            'transaction_reference' => $request->transaction_reference,
            'cheque_number' => $request->cheque_number,
        ]);

        // Attach standards
        $standardsWithUser = [];
        foreach ($request->standards as $standardId) {
            $standardsWithUser[$standardId] = ['user_id' => $user->id];
        }
        $payment->standards()->sync($standardsWithUser);


        return redirect()->route('user.subscription')->with('success', 'Subscription updated successfully!');
    }

    protected function calculateEndDate($planId)
    {
        $plan = SubscribtionPlan::findOrFail($planId);
        $now = now();

        switch ($plan->billing_cycle) {
            case 'monthly':
                return $now->addMonth();
            case 'yearly':
                return $now->addYear();
            case 'weekly':
                return $now->addWeek();
            case 'daily':
                return $now->addDay();
            default:
                return $now->addMonth();
        }
    }


    // Show Account Settings
    public function showAccountSettings()
    {
        return view('backend.user.my-profile.account-settings');
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

        return redirect()->route('user.account-settings')->with('success', 'Password updated successfully.');
    }
}
