<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use App\Models\StripePayment;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        $payments = StripePayment::where('user_id', $id)->with('subscriptionPlan')->latest()->get();

        return view('backend.user.subscription.show', compact('user', 'payments'));
    }

}
