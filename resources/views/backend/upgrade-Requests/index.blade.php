@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Customers</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Upgrade Requests</li>
                </ul>
            </div>

            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000 ">Upgrade Requests</h4>
                        </div>
                        <div class="card-body basic-data-table">
                            @if($requests->isEmpty())
                                <div class="alert alert-info">No pending upgrade requests found.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                        <thead>
                                            <tr>
                                                <th class="text-start">S.L</th>
                                                <th class="text-start">Customer</th>
                                                <th class="text-start">Current Plan</th>
                                                <th class="text-start">Requested Plan</th>
                                                <th class="text-start">Status</th>
                                                <th class="text-start">Request Date</th>
                                                <th class="text-start">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($requests as $key => $request)
                                                <tr>
                                                    <td class="text-start">{{ $key + 1 }}</td>
                                                    <td class="text-start">
                                                        <div class="d-flex align-items-center gap-2">

                                                            <div>
                                                                <p class="mb-0 fs-6">{{ $request->user->name }}</p>
                                                                <small class="text-muted">{{ $request->user->email }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class=" text-dark fs-6">{{ $request->currentPlan->name }}</span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="badge bg-primary">{{ $request->requestedPlan->name }}</span>
                                                    </td>
                                                    <td class="text-start">
                                                        @if($request->status == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($request->status == 'approved')
                                                            <span class="badge bg-success">Approved</span>
                                                        @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-start">{{ $request->created_at->format('M d, Y H:i') }}</td>
                                                    <td class="d-flex">
                                                        <a href="{{ route('admin.apgrade-requests.show', $request->id) }}"
                                                           class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                                                            <iconify-icon icon="solar:eye-linear"></iconify-icon>
                                                            <span>View</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


