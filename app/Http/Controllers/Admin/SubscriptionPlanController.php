<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscribtionPlan;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\NewPlanCreatedMail;
use Illuminate\Support\Facades\Log;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = SubscribtionPlan::all();
        return view('backend.subscription_plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('backend.subscription_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'no_of_standards' => 'required|integer|min:1',
            'billing_cycle' => 'required|in:monthly,yearly',
            'is_popular' => 'nullable|boolean',
            'icon' => 'required|string',
        ]);

        $plan = SubscribtionPlan::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'billing_cycle' => $request->billing_cycle,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'icon' => $request->icon,
            'no_of_standards' => $request->no_of_standards,
        ]);

        // Notify all admins safely
        // $admins = User::role('admin')->get();
        // $failedEmails = [];

        // foreach ($admins as $admin) {
        //     try {
        //         Mail::to($admin->email)->send(new NewPlanCreatedMail($plan));
        //     } catch (\Exception $e) {
        //         Log::error("Failed to send email to {$admin->email}: " . $e->getMessage());
        //         $failedEmails[] = $admin->email;
        //     }
        // }

        // Optionally notify about email failures
        // if (!empty($failedEmails)) {
        //     return redirect()->route('admin.subscription-plans.index')
        //         ->with('warning', 'Plan created, but email failed for: ' . implode(', ', $failedEmails));
        // }

        return redirect()->route('admin.subscription-plans.index')
            ->with('success', 'Subscription plan created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribtionPlan $subscriptionPlan)
    {

        return view('backend.subscription_plans.edit', compact('subscriptionPlan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribtionPlan $subscriptionPlan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric',
            'no_of_standards' => 'required|integer|min:1',
            'billing_cycle' => 'required|in:monthly,yearly',
            'is_popular' => 'nullable|boolean',
            'icon' => 'required|string',
        ]);

        $subscriptionPlan->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'billing_cycle' => $request->billing_cycle,
            'is_popular' => $request->has('is_popular') ? 1 : 0,
            'icon' => $request->icon,
            'no_of_standards' => $request->no_of_standards,
        ]);

        return redirect()->route('admin.subscription-plans.index')->with('success', 'Subscription plan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribtionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();

        return redirect()->route('admin.subscription-plans.index')->with('success', 'Subscription plan deleted successfully!');
    }
}
