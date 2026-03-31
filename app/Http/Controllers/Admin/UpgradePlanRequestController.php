<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UpgradeRequest;
use App\Models\StripePayment;
use App\Models\SubscribtionPlan;
use Illuminate\Http\Request;
use App\Mail\UpgradeRequestApproved;
use App\Mail\UpgradeRequestRejected;
use App\Models\upgrade_plan;
use Illuminate\Support\Facades\Mail;

class UpgradePlanRequestController extends Controller
{
    public function index()
    {
        $requests = upgrade_plan::with(['user', 'currentPlan', 'requestedPlan'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('backend.upgrade-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $request = upgrade_plan::with(['user', 'currentPlan', 'requestedPlan'])->findOrFail($id);
        return view('backend.upgrade-requests.show', compact('request'));
    }

    public function approve(Request $request, $id)
    {
        $upgradeRequest = upgrade_plan::findOrFail($id);
        $user = $upgradeRequest->user;

        // Deactivate current subscription
        StripePayment::where('user_id', $user->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        // Update the request
        $upgradeRequest->update([
            'status' => 'approved',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'admin_notes' => $request->admin_notes
        ]);

        // Send approval email
        // Mail::to($user->email)->send(new UpgradeRequestApproved($upgradeRequest));

        return redirect()->route('admin.upgrade-requests.index')
            ->with('success', 'Upgrade request approved successfully.');
    }

    /**
     * Calculate subscription end date based on plan's billing cycle
     */
    protected function calculateEndDate($planId)
    {
        $plan = SubscribtionPlan::findOrFail($planId);
        $now = now();

        switch (strtolower($plan->billing_cycle)) {
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
    public function reject(Request $request, $id)
    {
        $upgradeRequest = upgrade_plan::findOrFail($id);

        $upgradeRequest->update([
            'status' => 'rejected',
            'processed_by' => auth()->id(),
            'processed_at' => now(),
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->route('admin.upgrade-requests.index')
            ->with('success', 'Upgrade request rejected successfully.');
    }
}
