@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Header -->
            <div class="page-header d-print-none mb-3">
                {{-- <div class="row align-items-center">
                <div class="col">
                    <h6 class="page-title">Upgrade Request #{{ $request->id }}</h6>
                    <div class="text-muted mt-1">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted hover-primary">Dashboard</a>
                        <span class="mx-2">/</span>
                        <a href="{{ route('admin.upgrade-requests.index') }}" class="text-muted hover-primary">Upgrade Requests</a>
                        <span class="mx-2">/</span>
                        <span class="text-primary">Details</span>
                    </div>
                </div>
                <div class="col-auto">
                    <span class="badge bg-{{ $request->status == 'pending' ? 'orange' : ($request->status == 'approved' ? 'green' : 'red') }}-lt">
                        {{ ucfirst($request->status) }}
                    </span>
                </div>
            </div> --}}
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 ">
                    <h6 class="fw-semibold mb-0">Upgrade Requests #{{ $request->id }}</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('admin.dashboard') }}"
                                class="d-flex align-items-center gap-1 hover-text-primary">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium">Upgrade Requests</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Request Summary Card -->
                    <div class="card card-lg mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Request Summary</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label text-muted fs-6">Request Date</label>
                                        <div class="text-body">{{ $request->created_at->format('M d, Y H:i') }}</div>
                                    </div>
                                    @if ($request->status != 'pending')
                                        <div class="mb-4">
                                            <label class="form-label text-muted">Processed At</label>
                                            <div class="text-body">{{ $request->processed_at->format('M d, Y H:i') }}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label text-muted fs-6">Customer</label>
                                        <div class="d-flex align-items-center">

                                            <div>
                                                <div class="text-body">{{ $request->user->name }}</div>
                                                <div class="text-muted">{{ $request->user->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($request->status != 'pending')
                                        <div class="mb-4">
                                            <label class="form-label text-muted">Processed By</label>
                                            <div class="text-body">{{ $request->processedBy->name }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="hr-text hr-text-left my-4">Plan Comparison</div>

                            <div class="row">
                                <!-- Current Active Plan -->
                                <div class="col-md-6">
                                    <div class="card card-sm border border-primary">
                                        <div class="card-status-top bg-primary"></div>
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Current Active Plan</h4>
                                            <small class="text-muted">Existing subscription</small>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                          
                                                <h4 class="card-title mb-0">{{ $request->currentPlan->name }}</h4>
                                                <span
                                                    class="bg-primary-lt">${{ number_format($request->currentPlan->price, 2) }}/{{ $request->currentPlan->billing_cycle }}</span>
                                            </div>
                                            <ul class="list-unstyled space-y-2">
                                                @foreach (explode("\n", $request->currentPlan->description) as $feature)
                                                    <li class="d-flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green mr-2"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12l5 5l10 -10" />
                                                        </svg>
                                                        {{ trim($feature) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Requested Upgrade Plan -->
                                <div class="col-md-6">
                                    <div class="card card-sm border border-success">
                                        <div class="card-status-top bg-success"></div>
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Requested Upgrade Plan</h4>
                                            <small class="text-muted">The plan want to upgrade to</small>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <h4 class="card-title mb-0">{{ $request->requestedPlan->name }}</h4>
                                                <span
                                                    class=" bg-success-lt">${{ number_format($request->requestedPlan->price, 2) }}/{{ $request->requestedPlan->billing_cycle }}</span>
                                            </div>
                                            <ul class="list-unstyled space-y-2">
                                                @foreach (explode("\n", $request->requestedPlan->description) as $feature)
                                                    <li class="d-flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-green mr-2"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M5 12l5 5l10 -10" />
                                                        </svg>
                                                        {{ trim($feature) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-text hr-text-left my-4 pt-3">Reason for Upgrade</div>
                            <div class="markdown">
                                <div class="card card-sm bg-gray-lt">
                                    <div class="card-body">
                                        {{ $request->reason ?: 'No reason provided' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <!-- Action Card -->
                    @if ($request->status == 'pending')
                        <div class="card card-lg mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Process Request</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.upgrade-requests.approve', $request->id) }}" method="POST"
                                    class="mb-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Admin Notes <span
                                                class="text-muted">(Optional)</span></label>
                                        <textarea class="form-control" name="admin_notes" rows="3" placeholder="Add approval notes"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                        Approve Request
                                    </button>
                                </form>

                                <form action="{{ route('admin.upgrade-requests.reject', $request->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Rejection Reason <span
                                                class="text-muted">(Required)</span></label>
                                        <textarea class="form-control" name="admin_notes" rows="3" required placeholder="Explain rejection reason"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                        Reject Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="card card-lg">
                            <div class="card-header">
                                <h3 class="card-title">Processing Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Admin Notes</label>
                                    <div class="card card-sm bg-gray-lt">
                                        <div class="card-body">
                                            {{ $request->admin_notes ?: 'No notes provided' }}
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('admin.upgrade-requests.index') }}" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                    </svg>
                                    Back to Requests
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    @push('custom-css')
        <style>
            .page-header {
                padding-bottom: 1.5rem;
                border-bottom: 1px solid rgba(0, 40, 100, 0.12);
            }

            .page-title {
                font-size: 1.25rem;
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .card-lg {
                border-radius: 8px;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .card-title {
                font-size: 1rem;
                font-weight: 600;
                color: #495057;
            }

            .card-status-top {
                height: 3px;
                border-radius: 8px 8px 0 0;
            }

            .hr-text {
                font-size: 0.75rem;
                font-weight: 600;
                color: #495057;
                text-transform: uppercase;
            }

            .hr-text:after {
                content: "";
                display: inline-block;
                width: 100%;
                height: 1px;
                background: rgba(0, 40, 100, 0.12);
                position: relative;
                top: -4px;
                margin-left: 1rem;
            }

            .hr-text-left:after {
                margin-left: 0.5rem;
            }

            .bg-gray-lt {
                background-color: #f8f9fa;
            }

            .bg-blue-lt {
                background-color: rgba(70, 127, 207, 0.1);
                color: #467fcf;
            }

            .bg-green-lt {
                background-color: rgba(50, 178, 121, 0.1);
                color: #32b279;
            }

            .bg-orange-lt {
                background-color: rgba(253, 126, 20, 0.1);
                color: #fd7e14;
            }

            .bg-red-lt {
                background-color: rgba(220, 53, 69, 0.1);
                color: #dc3545;
            }

            .hover-primary:hover {
                color: #467fcf !important;
            }

            .space-y-2>*+* {
                margin-top: 0.5rem;
            }
        </style>
    @endpush
