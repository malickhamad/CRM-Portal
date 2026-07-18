@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Request Plan Upgrade</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Plan Upgrade</li>
                </ul>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <!-- Upgrade Request Form -->
                    <div class="card mb-5">
                        <div class="card-header">
                            <h4 class="card-title mb-0 text-success-1000 ">Request a Plan Upgrade</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.upgrade.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="requested_plan_id" class="form-label">Select Plan</label>
                                        <select class="form-select" id="requested_plan_id" name="requested_plan_id" required>
                                            <option value="">-- Select Plan --</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}" data-price="{{ $plan->price }}" data-cycle="{{ $plan->billing_cycle }}">
                                                    {{ $plan->name }} - ${{ number_format($plan->price, 2) }}/{{ $plan->billing_cycle }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="reason" class="form-label">Reason (Optional)</label>
                                        <textarea class="form-control  form-control-sm" id="reason" name="reason" rows="1" placeholder="Explain why you need this upgrade"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-brand-1">Submit</button>
                            </form>
                        </div>
                    </div>

                    <!-- Previous Upgrade Requests -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Your Upgrade Requests</h4>
                        </div>
                        <div class="card-body basic-data-table">
                            @if ($requests->isEmpty())
                                <div class="alert alert-info mb-0">You haven't made any upgrade requests yet.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                        <thead>
                                            <tr>
                                                <th class="text-start">S.L</th>
                                                <th class="text-start">Request Date</th>
                                                <th class="text-start">Current Plan</th>
                                                <th class="text-start">Requested Plan</th>
                                                <th class="text-start">Status</th>
                                                <th class="text-start">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $key => $request)
                                                <tr>
                                                    <td class="text-start">{{ $key + 1 }}</td>
                                                    <td class="text-start">{{ $request->created_at->format('M d, Y H:i') }}</td>
                                                    <td class="text-start">
                                                        <span class="badge bg-light text-dark">{{ $request->currentPlan->name }}</span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="badge bg-primary">{{ $request->requestedPlan->name }}</span>
                                                    </td>
                                                    <td class="text-start">
                                                        @if ($request->status == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($request->status == 'approved')
                                                            <span class="badge bg-success">Approved</span>
                                                        @else
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-start">
                                                        @if ($request->status == 'pending')
                                                            <form action="{{ route('user.upgrade.cancel', $request->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm btn-outline-secondary" disabled>No Action</button>
                                                        @endif
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
    </main>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        $('#requested_plan_id').change(function() {
            const selectedOption = $(this).find('option:selected');
            if (selectedOption.val()) {
                $('#modalPlanName').text(selectedOption.text().split(' - ')[0]);
                $('#modalPlanPrice').text(selectedOption.data('price'));
                $('#modalPlanCycle').text(selectedOption.data('cycle'));
                $('#modalPlanDescription').text('Full plan details would be shown here...');
                $('#planDetailsModal').modal('show');
            }
        });
    });
</script>
@endsection

@push('custom-css')
<style>
    .badge {
        font-weight: 500;
        padding: 5px 10px;
    }
</style>
@endpush
