@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Customer</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Create Customer</li>
                </ul>
            </div>


            <!-- Tabs Navigation -->
            <ul class="nav nav-pills nav-fill mb-4" id="customerTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane"
                        type="button" role="tab" aria-controls="account-tab-pane" aria-selected="true">
                        Account Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments-tab-pane"
                        type="button" role="tab" aria-controls="payments-tab-pane" aria-selected="false">
                        Payment History
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="subusers-tab" data-bs-toggle="tab" data-bs-target="#subusers-tab-pane"
                        type="button" role="tab" aria-controls="subusers-tab-pane" aria-selected="false">
                        Subuser Details
                    </button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="customerTabsContent">
                <!-- Account Info Tab -->
                <div class="tab-pane fade show active" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab"
                    tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-success-1000 ">Account Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Business Name </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->business_name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->phone }}</p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label"> Country </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->country }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"> State </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->state }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"> City </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->city }}</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label"> Street Address </label>
                                    <p class="fw-medium mb-0 text-dark">{{ $user->street_address }}</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Status </label><br>
                                    <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment History Tab -->
                <div class="tab-pane fade" id="payments-tab-pane" role="tabpanel" aria-labelledby="payments-tab"
                    tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-success-1000 ">Payment History</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th class='fw-semibold text-md'>Plan</th>
                                        <th class='fw-semibold text-md'>Amount</th>
                                        <th class='fw-semibold text-md'>Payment Method</th>
                                        <th class='fw-semibold text-md'>Date</th>
                                        <th class='fw-semibold text-md'>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        @php
                                            $isActive = $payment->is_active; // First check the is_active flag

                                            // Only check expiration date if it's marked as active
if ($isActive && $payment->subscriptionPlan && $payment->created_at) {
    $startDate = Carbon\Carbon::parse($payment->created_at);
    $expirationDate = match ($payment->subscriptionPlan->billing_cycle) {
        'monthly' => $startDate->copy()->addMonth(),
        'yearly' => $startDate->copy()->addYear(),
        'weekly' => $startDate->copy()->addWeek(),
        'daily' => $startDate->copy()->addDay(),
        default => $startDate->copy()->addMonth(),
    };

    // Update isActive based on expiration date
    $isActive = !now()->greaterThan($expirationDate);

    // Automatically deactivate if expired
    if (!$isActive) {
        $payment->update(['is_active' => false]);
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <strong>{{ $payment->subscriptionPlan->name ?? 'N/A' }}</strong><br>
                                                <small
                                                    class="text-muted">{{ $payment->subscriptionPlan->billing_cycle ?? '' }}</small>
                                            </td>
                                            <td>${{ number_format($payment->amount, 2) }}</td>
                                            <td>
                                                @php
                                                    $latestPayment = $user->stripePayments->sortByDesc('created_at')->first();
                                                @endphp

                                                @if ($latestPayment)
                                                    <span class="badge bg-primary">
                                                        {{ ucfirst($latestPayment->payment_method ?? 'Stripe') }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge {{ $isActive ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $isActive ? 'Active' : ($payment->is_active ? 'Expired' : 'Inactive') }}
                                                </span>
                                                @if ($isActive)
                                                    <small class="d-block text-muted">Expires:
                                                        {{ $expirationDate->format('M d, Y') }}</small>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Subuser Details Tab -->
                <div class="tab-pane fade" id="subusers-tab-pane" role="tabpanel" aria-labelledby="subusers-tab"
                    tabindex="0">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-success-1000">Subuser Details</h4>
                        </div>
                        <div class="card-body">
                            @if ($user->subusers->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->subusers as $subuser)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $subuser->name }}</td>
                                                    <td>{{ $subuser->email }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $subuser->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                            {{ ucfirst($subuser->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $subuser->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No subusers found for this account.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @endsection
</main>

<!-- Fixed Footer -->
