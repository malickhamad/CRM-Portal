<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\StripePayment;
use App\Models\SubscribtionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Mail\NewSubscriptionMail;
use App\Models\PaymentStandard;
use App\Models\upgrade_plan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        configure_stripe_from_db();
    }

    public function checkout(Request $request, $planId)
    {
        $user = Auth::user();
        $plan = SubscribtionPlan::findOrFail($planId);

        // Check if user has an active subscription (regardless of plan)
        $activeSubscription = StripePayment::where('user_id', $user->id)
            ->where('is_active', true)
            ->first();

        if ($activeSubscription) {
            // Redirect to upgrade request page (NO direct purchases allowed)
            return redirect()->route('user.upgrade.index')->with(
                'error',
                'You already have an active subscription. Please request an upgrade instead.'
            );
        }

        // Only allow checkout if no active subscription exists
        Stripe::setApiKey(config('services.stripe.secret'));

        // Save selected standards in session temporarily
        session(['selected_standards' => $request->standards]);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'mode' => 'subscription',
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $plan->name,
                        'description' => 'Subscription Plan - ' . ucfirst($plan->name),
                    ],
                    'unit_amount' => $plan->price * 100,
                    'recurring' => [
                        'interval' => $this->convertBillingCycle($plan->billing_cycle),
                    ],
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'plan_id' => $plan->id,
                'user_id' => $user->id,
            ],
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }
    public function success(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        if (!$request->has('session_id')) {
            return redirect()->route('user.dashboard')->with('error', 'Session ID is missing.');
        }

        try {
            $session = \Stripe\Checkout\Session::retrieve($request->session_id);
            $subscription = \Stripe\Subscription::retrieve($session->subscription);
        } catch (\Exception $e) {
            return redirect()->route('user.dashboard')->with('error', 'Invalid session ID.');
        }

        $user = Auth::user();
        $plan = SubscribtionPlan::findOrFail($session->metadata->plan_id);

        // Check if this is an upgrade request
        $upgradeRequest = upgrade_plan::where('user_id', $user->id)
            ->where('requested_plan_id', $plan->id)
            ->where('status', 'approved')
            ->first();

        // Deactivate any existing active subscriptions
        StripePayment::where('user_id', $user->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        // Create new active subscription
        $stripePayment = StripePayment::create([
            'user_id' => $user->id,
            'subscribtion_plan_id' => $plan->id,
            'session_id' => $session->id,
            'amount' => $session->amount_total / 100,
            'currency' => $session->currency,
            'stripe_subscription_id' => $session->subscription,
            'stripe_customer_id' => $session->customer,
            'starts_at' => now(),
            'ends_at' => now()->add($this->getSubscriptionDuration($plan->billing_cycle)),
            'is_active' => true,
            'is_upgrade' => $upgradeRequest ? true : false
        ]);



        // Attach selected standards from session
        $selectedStandards = session('selected_standards', []);
        if (!empty($selectedStandards)) {
            foreach ($selectedStandards as $standardId) {
                PaymentStandard::create([
                    'user_id' => $user->id,
                    'stripe_payment_id' => $stripePayment->id,
                    'standard_id' => $standardId
                ]);
            }
            session()->forget('selected_standards');
        }

        return redirect()->route('user.dashboard')->with(
            'success',
            $upgradeRequest
                ? 'Subscription upgraded successfully!'
                : 'Subscription activated successfully!'
        );
    }

    public function cancel()
    {
        return redirect()->route('frontend.home')->with('error', 'Subscription process was canceled.');
    }

    private function convertBillingCycle($cycle)
    {
        $mapping = [
            'daily' => 'day',
            'weekly' => 'week',
            'monthly' => 'month',
            'yearly' => 'year'
        ];
        return $mapping[strtolower($cycle)] ?? 'month';
    }

    private function getSubscriptionDuration($billingCycle)
    {
        $durations = [
            'daily' => '1 day',
            'weekly' => '1 week',
            'monthly' => '1 month',
            'yearly' => '1 year'
        ];
        return $durations[strtolower($billingCycle)] ?? '1 month';
    }
}
