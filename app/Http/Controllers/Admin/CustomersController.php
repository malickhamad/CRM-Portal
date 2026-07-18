<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomersExport;
use App\Http\Controllers\Controller;
use App\Models\StripePayment;
use App\Models\User;
use App\Models\Standard;
use App\Models\SubscribtionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{

    public function index(Request $request)
    {
        $users = User::role('user')
            ->with(['stripePayments.subscriptionPlan'])
            ->when($request->filled('plan'), function ($query) use ($request) {
                $query->whereHas('stripePayments.subscriptionPlan', function ($q) use ($request) {
                    $q->where('id', $request->plan);
                });
            })
            ->when($request->filled('from_date') && $request->filled('to_date'), function ($query) use ($request) {
                $query->whereBetween('created_at', [
                    Carbon::parse($request->from_date)->startOfDay(),
                    Carbon::parse($request->to_date)->endOfDay()
                ]);
            })
            ->latest()
            ->get();

        $plans = SubscribtionPlan::all(); // For filter dropdown

        if ($request->has('export')) {
            return Excel::download(new CustomersExport($users), 'customers-' . now()->format('Y-m-d') . '.xlsx');
        }

        return view('backend.customers.index', compact('users', 'plans'));
    }
    public function create()
    {
        return view('backend.customers.create-step1');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (str_starts_with($value, ' ')) {
                        $fail('The email should not start with a space.');
                    }
                    if (!filter_var(trim($value), FILTER_VALIDATE_EMAIL)) {
                        $fail('Please enter a valid email address.');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Rules\Password::defaults(),
            ],
            'business_name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\+|00)\d{6,20}$/',
                function ($attribute, $value, $fail) {
                    if (preg_match('/[a-zA-Z]/', $value)) {
                        $fail('The phone number should not contain letters.');
                    }
                }
            ],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'street_address' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,bmp', 'max:5120'],
        ], [
            'phone.required' => 'We need your phone number to contact you.',
            'phone.string' => 'Please enter a valid phone number.',
            'phone.max' => 'Phone number is too long (max 20 digits).',
            'phone.regex' => 'Please enter a valid international number (e.g., +44123456789 or 0044123456789)',
            'profile_picture.mimes' => 'Only jpeg, png, jpg, gif, webp, and bmp image formats are supported.',
        ]);
        $imagePath = null;

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('profile_pictures', $imageName, 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'business_name' => $request->business_name,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'profile_picture' => $imagePath,
            'status' => 'active',
        ]);

        $user->assignRole('user');

        // Check if the request is coming from the "Save" or "Next" button
        if ($request->has('save_and_next')) {
            return redirect()->route('admin.customers.payment', $user->id)
                ->with('success', 'Customer created successfully! Please add payment details.');
        }

        return back()->with('success', 'Customer created successfully!');
    }

    public function editStep1($id)
    {
        $user = User::findOrFail($id);
        return view('backend.customers.edit-step1', compact('user'));
    }


    public function updateStep1(Request $request, $id)
    {
        $user = User::findOrFail($id);

     $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('users')->ignore($user->id),
        function ($attribute, $value, $fail) {
            if (str_starts_with($value, ' ')) {
                $fail('The email should not start with a space.');
            }
            if (!filter_var(trim($value), FILTER_VALIDATE_EMAIL)) {
                $fail('Please enter a valid email address.');
            }
        }
    ],
    'password' => [
        'nullable',
        'string',
        'min:8',
        'confirmed',
        Rules\Password::defaults(),
    ],
    'business_name' => ['required', 'string', 'max:255'],
    'phone' => [
        'required',
        'string',
        'max:20',
        'regex:/^(\+|00)\d{6,20}$/',
        function ($attribute, $value, $fail) {
            if (preg_match('/[a-zA-Z]/', $value)) {
                $fail('The phone number should not contain letters.');
            }
        }
    ],
    'country' => ['required', 'string', 'max:255'],
    'state' => ['required', 'string', 'max:255'],
    'city' => ['required', 'string', 'max:255'],
    'street_address' => ['required', 'string', 'max:255'],
    'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,bmp', 'max:5120'],
], [
    'phone.required' => 'We need your phone number to contact you.',
    'phone.string' => 'Please enter a valid phone number.',
    'phone.max' => 'Phone number is too long (max 20 digits).',
    'phone.regex' => 'Please enter a valid international number (e.g., +44123456789 or 0044123456789)',
    'profile_picture.mimes' => 'Only jpeg, png, jpg, gif, webp, and bmp image formats are supported.',
]);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'business_name' => $request->business_name,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'status' => $request->status,
            'profile_picture' => $user->profile_picture, // Default to current picture
        ];

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('profile_pictures', $imageName, 'public');
            $updateData['profile_picture'] = $imagePath; // Update with new picture
        }

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);
        return back()->with('success', 'customer updated successfully!');

        // return redirect()->intended(route('admin.customers.edit.step2', $user->id));
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive'
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    public function editStep2($id)
    {
        $user = User::findOrFail($id);
        $standards = Standard::all();
        $plans = SubscribtionPlan::all();
        $currentPayment = StripePayment::where('user_id', $id)->latest()->first();
        $selectedStandards = $currentPayment ? $currentPayment->standards->pluck('id')->toArray() : [];

        return view('backend.customers.edit-step2', compact('user', 'standards', 'plans', 'currentPayment', 'selectedStandards'));
    }

    public function updateStep2(Request $request, $id)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:subscribtion_plans,id',
            'standards' => 'required|array|min:1',
            'standards.*' => 'exists:standards,id',
            'payment_method' => 'required|in:online,cheque',
            'transaction_reference' => [
                'required_if:payment_method,online',
                'nullable',
                'string',
                'max:255'
            ],
            'cheque_number' => [
                'required_if:payment_method,cheque',
                'nullable',
                'string',
                'max:255'
            ],
        ]);

        $plan = SubscribtionPlan::findOrFail($validated['plan_id']);
        if (count($validated['standards']) > $plan->no_of_standards) {
            return back()->withErrors([
                'standards' => 'Selected standards exceed the allowed limit for this plan'
            ])->withInput();
        }

        StripePayment::where('user_id', $id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $payment = StripePayment::updateOrCreate(
            ['user_id' => $id],
            [
                'subscribtion_plan_id' => $validated['plan_id'],
                'currency' => 'USD',
                'is_active' => true,
                'starts_at' => now(),
                'ends_at' => $this->calculateEndDate($validated['plan_id']),
                'payment_method' => $validated['payment_method'],
                'transaction_reference' => $validated['transaction_reference'] ?? null,
                'cheque_number' => $validated['cheque_number'] ?? null,
            ]
        );

        $standardsWithUser = [];
        foreach ($validated['standards'] as $standardId) {
            $standardsWithUser[$standardId] = ['user_id' => $id];
        }
        $payment->standards()->sync($standardsWithUser);

        return redirect()->intended(route('admin.customers.index'))
            ->with('success', 'Customer payment details updated successfully!');
    }

    public function payment($id)
    {
        $user = User::findOrFail($id);
        $standards = Standard::all();
        $plans = SubscribtionPlan::all();

        return view('backend.customers.create-step2', compact('user', 'standards', 'plans'));
    }

    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'plan_id' => 'required|exists:subscribtion_plans,id',
            'standards' => 'required|array',
            'standards.*' => 'exists:standards,id',
            'payment_method' => 'required|in:online,cheque',
            'transaction_reference' => $request->payment_method === 'online' ? 'required' : 'nullable',
            'cheque_number' => $request->payment_method === 'cheque' ? 'required' : 'nullable',
        ]);

        StripePayment::where('user_id', $id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $payment = StripePayment::create([
            'user_id' => $id,
            'subscribtion_plan_id' => $request->plan_id,
            'amount' => SubscribtionPlan::findOrFail($request->plan_id)->price,
            'currency' => 'USD',
            'is_active' => true,
            'starts_at' => now(),
            'ends_at' => $this->calculateEndDate($request->plan_id),
            'payment_method' => $request->payment_method,
            'transaction_reference' => $request->transaction_reference,
            'cheque_number' => $request->cheque_number,
        ]);
        $standardsWithUser = [];
        foreach ($request->standards as $standardId) {
            $standardsWithUser[$standardId] = ['user_id' => $id];
        }
        $payment->standards()->sync($standardsWithUser);

        return redirect()->intended(route('admin.customers.index'))->with('success', 'Customer created successfully!');
    }

    protected function calculateExpirationDate($startDate, $billingCycle)
    {
        $expirationDate = $startDate->copy();

        switch ($billingCycle) {
            case 'monthly':
                $expirationDate->addMonth();
                break;
            case 'yearly':
                $expirationDate->addYear();
                break;
            case 'weekly':
                $expirationDate->addWeek();
                break;
            case 'daily':
                $expirationDate->addDay();
                break;
            default:
                $expirationDate->addMonth();
        }

        return $expirationDate;
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


    public function show($id)
    {
        $user = User::findOrFail($id);
        $payments = StripePayment::where('user_id', $id)->with('subscriptionPlan')->latest()->get();
        // Fetch subusers that belong to the current authenticated user
        $subusers = User::where('parent_id', auth()->id())->get();
        return view('backend.customers.show', compact('user', 'payments', 'subusers'));
    }

    public static function calculateExpirationDateStatic($startDate, $billingCycle)
    {
        $startDate = Carbon::parse($startDate);
        $expirationDate = $startDate->copy();

        switch ($billingCycle) {
            case 'monthly':
                $expirationDate->addMonth();
                break;
            case 'yearly':
                $expirationDate->addYear();
                break;
            case 'weekly':
                $expirationDate->addWeek();
                break;
            case 'daily':
                $expirationDate->addDay();
                break;
            default:
                $expirationDate->addMonth();
        }

        return $expirationDate;
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            StripePayment::where('user_id', $id)->delete();
            $user->delete();

            return redirect()->intended(route('admin.customers.index'))
                ->with('success', 'Customer and all related data deleted successfully');
        } catch (\Exception $e) {
            return redirect()->intended(route('admin.customers.index'))
                ->with('error', 'Error deleting customer: ' . $e->getMessage());
        }
    }
}
