@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Customers History</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Customer History</li>
                </ul>
            </div>



            <!-- Payment History Table -->
            <div class="row mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title text-success-1000 ">Customers List</h4>
                                <!-- You can add a create button here if needed -->
                                <!-- <a href="#" class="btn btn-primary">+ Create Payment</a> -->
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
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
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

                                                                            $isExpired = now()->greaterThan($expirationDate);
                                                                            $isExpiringSoon = now()->diffInDays($expirationDate, false) <= 7 && !$isExpired;
                                                                        @endphp

                                                                        @if ($isExpired)
                                                                            <span class="badge bg-danger">Expired</span>
                                                                            <small class="text-muted d-block">Since {{ $expirationDate->format('M j, Y') }}</small>
                                                                        @elseif($isExpiringSoon)
                                                                            <span class="badge bg-warning text-dark">Expiring Soon</span>
                                                                            <small class="text-muted d-block">{{ $expirationDate->diffForHumans() }}</small>
                                                                        @else
                                                                            <span class="badge bg-success">Active</span>
                                                                            <small class="text-muted d-block">Expires {{ $expirationDate->format('M j, Y') }}</small>
                                                                        @endif
                                                                    @else
                                                                        <span class="badge bg-secondary">Unknown</span>
                                                                        <small class="text-muted d-block">No plan data</small>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <a href="{{ route('admin.customers.show', $payment->user_id) }}"
                                                                       class="btn btn-sm btn-info">
                                                                        Show More
                                                                    </a>
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
