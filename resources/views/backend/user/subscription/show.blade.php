@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000 ">Subscription History</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Subscription History</li>
                </ul>
            </div>



            <!-- Payment History Table -->
            <div class="row mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title text-success-1000 ">Subscription History</h4>

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- Table for Payments -->
                                    <div class="card basic-data-table">
                                        <div class="card-body p-24">
                                            <div class="table-responsive scroll-lg">
                                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="text-start w-110-px"> <!-- Aligns left -->
                                                                <div>
                                                                    <label class="form-check-label">S.L</label>
                                                                </div>
                                                            </th>
                                                            <th scope="col"> Name</th>
                                                            <th scope="col">Plan Name</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Purchase Date</th>
                                                            <th scope="col">Expiration Date</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payments as $payment)
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check style-check d-flex align-items-center">
                                                                        <label class="form-check-label">{{ $loop->iteration }}</label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{ $payment->user->company_name ?? ($payment->user->name ?? 'N/A') }}<br>
                                                                    <small class="text-muted">{{ $payment->user->email ?? '' }}</small>
                                                                </td>
                                                                <td>
                                                                    {{ $payment->subscriptionPlan->name ?? 'N/A' }}<br>
                                                                    <small class="text-muted">
                                                                        {{ $payment->subscriptionPlan ? ucfirst($payment->subscriptionPlan->billing_cycle) : '' }}
                                                                    </small>
                                                                </td>
                                                                <td>
                                                                    ${{ number_format($payment->amount, 2) }}<br>
                                                                    <small class="text-muted">{{ strtoupper($payment->currency) }}</small>
                                                                </td>
                                                                <td>
                                                                    {{ $payment->created_at->format('Y-m-d') }}<br>
                                                                    <small class="text-muted">{{ $payment->created_at->diffForHumans() }}</small>
                                                                </td>
                                                                <td>
                                                                    @if ($payment->subscriptionPlan && $payment->created_at)
                                                                        @php
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
                                                                        @endphp
                                                                        {{ $expirationDate->format('Y-m-d') }}<br>
                                                                        <small class="text-muted">{{ $expirationDate->diffForHumans() }}</small>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        // Convert string dates to Carbon objects
                                                                        $startsAt = \Carbon\Carbon::parse($payment->starts_at);
                                                                        $endsAt = \Carbon\Carbon::parse($payment->ends_at);
                                                                        $now = now();

                                                                        // Check if active
                                                                        $isActive = $payment->is_active &&
                                                                                    $startsAt &&
                                                                                    $endsAt &&
                                                                                    $now->between($startsAt, $endsAt);
                                                                    @endphp

                                                                    <span class="badge bg-{{ $isActive ? 'success' : 'danger' }}">
                                                                        {{ $isActive ? 'Active' : 'Expired' }}
                                                                    </span>
                                                                    <br>
                                                                    <small class="text-muted">
                                                                        @if($isActive)
                                                                            Expires in {{ $endsAt->diffForHumans() }}
                                                                        @elseif($endsAt)
                                                                            Expired {{ $endsAt->diffForHumans() }}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </small>
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
