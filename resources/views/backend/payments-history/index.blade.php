@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Payment History</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Payment History</li>
                </ul>
            </div>

            <!-- Stats Section -->
            <div class="row">
                <div class="col-md-4  mb-3">
                    <div class="card p-3 shadow-sm radius-8 border bg-gradient-end-1">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-md text-success-1000 fw-semibold mb-2">Plan Purchased</p>
                                <h5 class="mb-0 text-center">{{ $stats['totalPayments'] }}</h5>
                            </div>
                            <iconify-icon icon="ic:outline-shopping-bag" class="icon text-primary fs-2"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card p-3 shadow-sm radius-8 border bg-gradient-end-2">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-md text-success-1000 fw-semibold mb-2">Total Payments</p>
                                <h5 class="mb-0 text-center">${{ number_format($stats['totalRevenue'], 2) }}</h5>
                            </div>
                            <iconify-icon icon="ic:outline-bar-chart" class="icon text-success fs-2"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card p-3 shadow-sm radius-8 border bg-gradient-end-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-md text-success-1000 fw-semibold mb-2">Active Subscriptions</p>
                                <h5 class="mb-0 text-center">{{ $payments->where('is_active', true)->count() }}</h5>
                            </div>
                            <iconify-icon icon="mdi:account-check" class="icon text-info fs-2"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment History Table -->
            <div class="row mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title text-success-1000 ">Payments List</h4>
                                <!-- You can add a create button here if needed -->
                                <!-- <a href="#" class="btn btn-primary">+ Create Payment</a> -->
                            </div>


                            <!-- Filter Card -->
                            <div class="mb-4">
                                <div class="card-body">
                                    <form action="{{ route('admin.payments-history.index') }}" method="GET"
                                        class="row g-3 align-items-end">
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label for="from_date" class="form-label">From Date</label>
                                                <input type="date" class="form-control  form-control-sm" id="from_date" name="from_date"
                                                    value="{{ request('from_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label for="to_date" class="form-label">To Date</label>
                                                <input type="date" class="form-control  form-control-sm" id="to_date" name="to_date"
                                                    value="{{ request('to_date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label for="plan" class="form-label">Plan</label>
                                                <select class="form-select" id="plan" name="plan">
                                                    <option value="">All Plans</option>
                                                    @foreach ($plans as $plan)
                                                        <option value="{{ $plan->id }}"
                                                            {{ request('plan') == $plan->id ? 'selected' : '' }}>
                                                            {{ $plan->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-0">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="">All Statuses</option>
                                                    <option value="active"
                                                        {{ request('status') == 'active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="expired"
                                                        {{ request('status') == 'expired' ? 'selected' : '' }}>Expired
                                                    </option>
                                                    <option value="expiring_soon"
                                                        {{ request('status') == 'expiring_soon' ? 'selected' : '' }}>
                                                        Expiring Soon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-0 ">
                                                <label class="form-label d-block">&nbsp;</label>
                                                <div class="btn-group w-100 flex-wrap flex-md-nowrap gap-md-0 gap-3 ">
                                                    <button type="submit"
                                                        class="btn btn-primary form-control  form-control-sm d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mi:filter" class="me-1"></iconify-icon> Filter
                                                    </button>
                                                    <a href="{{ route('admin.payments-history.index') }}"
                                                        class="btn btn-outline-secondary form-control  form-control-sm d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mdi:refresh" class="me-1"></iconify-icon>
                                                        Reset
                                                    </a>
                                                    <button type="submit" name="export" value="1"
                                                        class="btn btn-success form-control  form-control-sm d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mdi:file-excel" class="me-1"></iconify-icon>
                                                        Export
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- Table for Payments -->
                                    <div class="card basic-data-table">
                                        <div class="card-body p-24">
                                            <div class="table-responsive scroll-lg">
                                                <table class="table bordered-table mb-0 text-start" id="dataTable"
                                                    data-page-length='10'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="text-start w-110-px"> <!-- Aligns left -->
                                                                <div>
                                                                    <label class="form-check-label">S.L</label>
                                                                </div>
                                                            </th>
                                                            <th scope="col">Company Name</th>
                                                            <th scope="col">Plan Name</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Purchase Date</th>
                                                            <th scope="col">Expiration Date</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payments as $payment)
                                                            @php
                                                                // Calculate expiration date if subscription plan exists
                                                                $expirationDate = null;
                                                                $isActive = false;
                                                                $isExpired = false;
                                                                $isExpiringSoon = false;

                                                                if (
                                                                    $payment->subscriptionPlan &&
                                                                    $payment->created_at
                                                                ) {
                                                                    $expirationDate = $payment->created_at->copy();
                                                                    switch ($payment->subscriptionPlan->billing_cycle) {
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

                                                                    // Check if payment is marked as active in database
                                                                    $isActive = $payment->is_active;

                                                                    // Check expiration status
                                                                    $isExpired = now()->greaterThan($expirationDate);
                                                                    $isExpiringSoon =
                                                                        !$isExpired &&
                                                                        now()->diffInDays($expirationDate, false) <= 7;

                                                                    // If payment is active but expired, update status
                                                                    if ($isActive && $isExpired) {
                                                                        $payment->update(['is_active' => false]);
                                                                        $isActive = false;
                                                                    }
                                                                }
                                                            @endphp

                                                            <tr>
                                                                <td>
                                                                    <div
                                                                        class="form-check style-check d-flex align-items-center">
                                                                        <label
                                                                            class="form-check-label">{{ $loop->iteration }}</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{ $payment->user->company_name ?? ($payment->user->name ?? 'N/A') }}<br>
                                                                    <small
                                                                        class="text-muted">{{ $payment->user->email ?? '' }}</small>
                                                                </td>
                                                                <td>
                                                                    {{ $payment->subscriptionPlan->name ?? 'N/A' }}<br>
                                                                    <small class="text-muted">
                                                                        {{ $payment->subscriptionPlan ? ucfirst($payment->subscriptionPlan->billing_cycle) : '' }}
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    ${{ number_format($payment->amount, 2) }}<br>
                                                                    <small
                                                                        class="text-muted">{{ strtoupper($payment->currency) }}</small>
                                                                </td>
                                                                <td>
                                                                    {{ $payment->created_at->format('Y-m-d') }}<br>
                                                                    <small
                                                                        class="text-muted">{{ $payment->created_at->diffForHumans() }}</small>
                                                                </td>
                                                                <td>
                                                                    @if ($expirationDate)
                                                                        {{ $expirationDate->format('Y-m-d') }}<br>
                                                                        <small
                                                                            class="text-muted">{{ $expirationDate->diffForHumans() }}</small>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($payment->subscriptionPlan && $payment->created_at)
                                                                        @if ($isActive)
                                                                            @if ($isExpiringSoon)
                                                                                <span
                                                                                    class="badge bg-warning text-dark">Expiring
                                                                                    Soon</span>
                                                                                <small
                                                                                    class="text-muted d-block">{{ $expirationDate->diffForHumans() }}</small>
                                                                            @else
                                                                                <span
                                                                                    class="badge bg-success">Active</span>
                                                                                <small class="text-muted d-block">Expires
                                                                                    {{ $expirationDate->format('M j, Y') }}</small>
                                                                            @endif
                                                                        @else
                                                                            <span class="badge bg-danger">Expired</span>
                                                                            <small class="text-muted d-block">Since
                                                                                {{ $expirationDate->format('M j, Y') }}</small>
                                                                        @endif
                                                                    @else
                                                                        <span class="badge bg-secondary">Unknown</span>
                                                                        <small class="text-muted d-block">No plan
                                                                            data</small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
