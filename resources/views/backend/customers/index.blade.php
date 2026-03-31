@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Customers </h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Customers</li>
                </ul>
            </div>


            <!-- Customers Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title text-success-1000 ">Customers</h4>
                    <a href="{{ route('admin.customers.create') }}"
                        class="btn btn-brand-1 d-inline-flex align-items-center">
                        <span>+ Add</span>
                    </a>
                </div>
                <!-- Filter Card -->
                <div class="mb-4">
                    <div class="card-body">
                        <form action="{{ route('admin.customers.index') }}" method="GET" class="row g-3 align-items-end">
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
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label class="form-label d-block">&nbsp;</label>
                                    <div class="btn-group w-100">
                                        <button type="submit"
                                            class="btn btn-primary form-control  form-control-sm d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mi:filter" class="me-1"></iconify-icon> Filter
                                        </button>
                                        <a href="{{ route('admin.customers.index') }}"
                                            class="btn btn-outline-secondary form-control  form-control-sm d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mdi:refresh" class="me-1"></iconify-icon> Reset
                                        </a>
                                        <button type="submit" name="export" value="1"
                                            class="btn btn-success form-control  form-control-sm d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="mdi:file-excel" class="me-1"></iconify-icon> Export
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



                <div class="card-body basic-data-table mt-3">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col" class="text-start w-110-px">
                                        <div>
                                            <label class="form-check-label">S.L</label>
                                        </div>
                                    </th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Business</th>
                                    <th scope="col">Plan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="form-check style-check d-flex align-items-center">
                                                <label class="form-check-label">{{ $loop->iteration }}</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0">{{ $user->name }}</p>
                                                   
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->business_name ?? 'N/A' }}</td>
                                        <td>
                                            @if ($user->stripePayments->first())
                                                {{ $user->stripePayments->first()->subscriptionPlan->name ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-switch switch-success d-flex align-items-center gap-3">
                                       
                                                    <input type="checkbox" class="form-check-input status-toggle"
                                                        data-user-id="{{ $user->id }}"
                                                        id="status-toggle-{{ $user->id }}"
                                                        {{ $user->status == 'active' ? 'checked' : '' }}>
                                         
                                                <span
                                                    class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-start d-flex align-items-center">
                                            <a href="{{ route('admin.customers.show', $user->id) }}"
                                                class="w-32-px h-32-px bg-info-subtle text-info rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                                data-bs-toggle="tooltip" title="View Details">
                                                <iconify-icon icon="solar:eye-outline"></iconify-icon>
                                            </a>

                                            <a href="{{ route('admin.customers.edit.step1', $user->id) }}"
                                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                                data-bs-toggle="tooltip" title="Edit Customer">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>

                                            <form action="{{ route('admin.customers.destroy', $user->id) }}"
                                                method="POST" class="d-inline delete-form mx-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center "
                                                    data-bs-toggle="tooltip" title="Delete Customer">
                                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('custom-js')
    <script>
        $(document).ready(function() {
            // Handle status toggle changes
            $('.status-toggle').change(function() {
                const userId = $(this).data('user-id');
                const isActive = $(this).is(':checked') ? 'active' : 'inactive';
                const $badge = $(this).closest('td').find('.badge');
                const $toggle = $(this);

                $.ajax({
                    url: '{{ route('admin.customers.update-status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: userId,
                        status: isActive
                    },
                    success: function(response) {
                        // Update the badge
                        $badge.removeClass('bg-success bg-danger')
                            .addClass(isActive === 'active' ? 'bg-success' : 'bg-danger')
                            .text(isActive.charAt(0).toUpperCase() + isActive.slice(1));
                        // Show success toast
                        toastr.success('Status updated successfully');
                    },
                    error: function(xhr) {
                        // Show error toast
                        toastr.error('Error updating status');
                        // Revert the toggle if there's an error
                        $toggle.prop('checked', !$toggle.is(':checked'));
                    }
                });
            });

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Delete confirmation
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
