<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\StripePayment;
use App\Models\SubscribtionPlan;
use Illuminate\Http\Request;
use App\Models\upgrade_plan;

use Illuminate\Support\Facades\Auth;

class UpgradePlanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get current active subscription with plan
        $currentSubscription = StripePayment::with('subscriptionPlan')
            ->where('user_id', $user->id)
            ->where('is_active', true)
            ->latest()
            ->first();

        $currentPlan = $currentSubscription->subscriptionPlan ?? null;

        // Get all plans except current one
        $plans = SubscribtionPlan::when($currentPlan, function($query) use ($currentPlan) {
                $query->where('id', '!=', $currentPlan->id);
            })
            ->get();

        // Get upgrade requests
        $requests = upgrade_plan::with(['currentPlan', 'requestedPlan'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('backend.user.upgrade-plans.index', compact('currentPlan', 'plans', 'requests'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'requested_plan_id' => 'required|exists:subscribtion_plans,id',
            'reason' => 'nullable|string|max:500'
        ]);

        $currentPlan = $user->activeSubscription->subscriptionPlan ?? null;

        if (!$currentPlan) {
            return redirect()->back()->with('error', 'You must have an active subscription to request an upgrade.');
        }

        $upgradeRequest = upgrade_plan::create([
            'user_id' => $user->id,
            'current_plan_id' => $currentPlan->id,
            'requested_plan_id' => $request->requested_plan_id,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);


        return redirect()->back()->with('success', 'Upgrade request submitted successfully!');
    }

    public function cancel($id)
    {
        $request = upgrade_plan::where('user_id', Auth::id())
                    ->where('id', $id)
                    ->where('status', 'pending')
                    ->firstOrFail();

        $request->delete();

        return redirect()->back()->with('success', 'Upgrade request canceled successfully.');
    }
}
