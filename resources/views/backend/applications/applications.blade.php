@extends('backend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body bg-light position-relative pt-5">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Find Application</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}"
                            class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Application</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />


            {{-- leads and sales info --}}
            <div class="d-flex flex-wrap gap-3 mb-24">

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    style="background-color: #f3e5ab; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Pending Applications</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">{{ $pendingApplications }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    style="background-color: #d4e7c5; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Completed Applications</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">{{ $completedApplications }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    style="background-color: #d1d9e9; padding: 10px 20px; border-radius: 12px; min-width: 320px">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Rejected Applications</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">{{ $rejectedApplications }}</span>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12">
                    <div class="card basic-data-table">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <h4 class="card-title text-success-1000 mb-0">All Applications</h4>

                         @if (auth()->user()->hasRole('Admin'))
<div class="d-flex justify-content-center">
    <div class="dropdown dropdown-hover position-relative">

        <button class="btn btn-success dropdown-toggle" type="button">
            {{ $selectedUserId
                ? $users->where('id', $selectedUserId)->first()->name ?? 'Select User'
                : 'All Users' }}
        </button>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-hover">
            <li>
                <a class="dropdown-item" href="{{ route('admin.applications') }}">
                   All users
                </a>
            </li>

            @foreach ($users as $user)
                <li>
                    <a class="dropdown-item" href="{{ route('admin.applications', ['user_id' => $user->id]) }}">
                       {{ $user->name }}
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</div>
@endif

<style>
/* Hover par show karne ke liye */
.dropdown-hover:hover > .dropdown-menu-hover {
    display: block;
}

/* Menu ki alignment fix karne ke liye */
.dropdown-menu-hover {
    margin-top: 0; /* Gap khatam karne ke liye */
    right: 0 !important; /* Right side se align karega taake screen se bahar na jaye */
    left: auto !important; /* Left auto rakhein */
}

.dropdown-hover > .dropdown-toggle:active {
    pointer-events: none;
}
</style>
                        </div>

                        <div class="card-body  ">
                            {{-- show here logs --}}
                            <div class="table-responsive">
                                <table class="table bordered-table mb-0 text-start" id="dataTable">
                                    <thead>
                                        <tr>

                                            <th>App #</th>
                                            <th>Action</th>
                                            <th>Date</th>
                                            <th>Product/Brand</th>
                                            <th>Sale By</th>
                                            <th>Status</th>
                                            <th>Company / Merchant</th>
                                            <th>Product / Brand</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $statusClasses = [
                                                'App Sent' => 'status-app',
                                                'Docs Required' => 'status-docs',
                                                'Cot in process' => 'status-cot',
                                                'Awaiting Signature' => 'status-await',
                                                'Cot Done' => 'status-done',
                                                'Signed' => 'status-signed',
                                                'Submitted to Supplier' => 'status-submit',
                                                'Cost Objected' => 'status-object',
                                                'Live' => 'status-live',
                                                'Rejected' => 'status-reject',
                                                'Paid' => 'status-paid',
                                            ];
                                        @endphp
                                        @foreach ($applications as $key => $item)
                                            <tr>
                                                {{-- Serial Number --}}

                                                {{-- 1. Application Number --}}
                                                <td class="text-start fw-bold text-primary-600">
                                                    {{ $item->application_num }}
                                                </td>

                                                {{-- 2. Action --}}
                                                <td class="text-start">
                                                    <div class="d-flex align-items-center gap-2">
                                                      @can('edit-application')
                                                        <a href="{{ route('admin.applications.edit', $item->id) }}"
    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
    data-bs-toggle="tooltip" title="Edit">
    <iconify-icon icon="lucide:edit"></iconify-icon>
</a>
@endcan

                                                        <button type="button"
                                                            class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center border-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#commentModal{{ $item->id }}"
                                                            title="Comments">
                                                            <iconify-icon icon="mdi:comment-text-outline"></iconify-icon>
                                                        </button>
                                                        {{-- Print Button --}}
                                                        <a href="{{ route('admin.applications.print', $item->id) }}"
                                                            target="_blank"
                                                            class="w-32-px h-32-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                            data-bs-toggle="tooltip" title="Print PDF">
                                                            <iconify-icon icon="mdi:printer-outline"></iconify-icon>
                                                        </a>

                                                        <form action="{{ route('admin.applications.destroy', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0">
                                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                                {{-- 3. Date --}}
                                                <td class="text-start text-nowrap">
                                                    {{ $item->created_at->format('d-m-Y') }}
                                                </td>

                                                {{-- 4. product/brand --}}
                                                <td class="text-start">
                                                    {{ $item->service_type }}/{{ $item->brand ?? 'N/A' }}
                                                </td>

                                                {{-- 5. Sale By --}}
                                                <td class="text-start">
                                                    {{ $item->application_agent ?? 'N/A' }}
                                                </td>

                                                {{-- status --}}
                                                <td class="text-start">
                                                    <select
                                                        class="status-dropdown {{ $statusClasses[$item->status] ?? '' }}"
                                                        data-id="{{ $item->id }}"
                                                        data-old-status="{{ $item->status }}">
                                                        <option value="App Sent"
                                                            {{ $item->status == 'App Sent' ? 'selected' : '' }}>App
                                                            Sent</option>
                                                        <option value="Docs Required"
                                                            {{ $item->status == 'Docs Required' ? 'selected' : '' }}>
                                                            Docs Required</option>
                                                        <option value="Cot in process"
                                                            {{ $item->status == 'Cot in process' ? 'selected' : '' }}>
                                                            Cot in process</option>
                                                        <option value="Awaiting Signature"
                                                            {{ $item->status == 'Awaiting Signature' ? 'selected' : '' }}>
                                                            Awaiting Signature</option>
                                                        <option value="Cot Done"
                                                            {{ $item->status == 'Cot Done' ? 'selected' : '' }}>Cot
                                                            Done</option>
                                                        <option value="Signed"
                                                            {{ $item->status == 'Signed' ? 'selected' : '' }}>Signed
                                                        </option>
                                                        <option value="Submitted to Supplier"
                                                            {{ $item->status ==
                                                            'Submitted to
                                                                                                                                                                                                                                                                                                                                                                                                                        Supplier'
                                                                ? 'selected'
                                                                : '' }}>
                                                            Submitted to Supplier</option>
                                                        <option value="Cost Objected"
                                                            {{ $item->status == 'Cost Objected' ? 'selected' : '' }}>
                                                            Cost Objected</option>
                                                        <option value="Live"
                                                            {{ $item->status == 'Live' ? 'selected' : '' }}>Live
                                                        </option>
                                                        <option value="Rejected"
                                                            {{ $item->status == 'Rejected' ? 'selected' : '' }}>
                                                            Rejected</option>
                                                        <option value="Paid"
                                                            {{ $item->status == 'Paid' ? 'selected' : '' }}>Paid
                                                        </option>
                                                    </select>
                                                </td>
                                                {{-- 7. Company / Merchant --}}
                                                <td class="text-start">
                                                    {{ $item->company_name }} / {{ $item->merchant_full_name }}
                                                </td>

                                                {{-- 8. Product / Brand --}}
                                                <td class="text-start">
                                                    {{ $item->brand ?? 'N/A' }}
                                                </td>

                                                {{-- 9. Quantity --}}
                                                <td class="text-start">
                                                    {{ $item->qty ?? '1' }}
                                                </td>
                                            </tr>



                                            <div class="modal fade" id="commentModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="commentModalLabel{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content border-0 shadow-lg  overflow-hidden">

                                                        <div class="modal-header bg-white border-bottom py-3 px-4">
                                                            <div>
                                                                <h6 class="fw-semibold mb-0 text-success-1000"
                                                                    id="commentModalLabel{{ $item->id }}">
                                                                    Comments - {{ $item->application_num }}
                                                                </h6>
                                                            </div>
                                                            <button type="button" class="btn-close fs-6"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body bg-light-subtle" style="padding: 10px">

                                                            <form
                                                                action="{{ route('admin.applications.comments.store', $item->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="row g-3 align-items-start mb-4">
                                                                    <div class="col-md-7">
                                                                        <label
                                                                            class="form-label fw-semibold text-success-1000 mb-2">Comments</label>
                                                                        <textarea name="comment" class="form-control rounded-3 shadow-sm" rows="3"
                                                                            placeholder="Write comment here..."></textarea>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <label
                                                                            class="form-label fw-semibold text-success-1000 mb-2">Image</label>

                                                                        <input type="file" name="image"
                                                                            class="form-control rounded-3 shadow-sm comment-image-input"
                                                                            accept="image/*"
                                                                            data-preview="#previewImage{{ $item->id }}"
                                                                            data-wrapper="#previewWrapper{{ $item->id }}">

                                                                        <div id="previewWrapper{{ $item->id }}"
                                                                            class="mt-3 d-none">
                                                                            <div
                                                                                class="border rounded-3 bg-white p-2 text-center shadow-sm">
                                                                                <img id="previewImage{{ $item->id }}"
                                                                                    src="" alt="Preview"
                                                                                    class="img-fluid rounded-3"
                                                                                    style="max-height: 120px; object-fit: cover;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 d-flex align-items-start pt-md-4">
                                                                        <button type="submit"
                                                                            class="btn btn-primary rounded-3 w-100 py-1 fw-semibold shadow-smm bg_green_color">
                                                                            Add Comment
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                            <div class="border-top pt-3"
                                                                style="max-height: 420px; overflow-y: auto;">
                                                                @forelse($item->comments as $comment)
                                                                    <div
                                                                        class="bg-white rounded-4 shadow-sm border p-3 mb-3">

                                                                        <div
                                                                            class="d-flex justify-content-between align-items-start gap-3">
                                                                            <div class="d-flex align-items-start gap-3">
                                                                                @php
                                                                                    $profileImage =
                                                                                        $comment->user &&
                                                                                        $comment->user->profile_picture
                                                                                            ? asset(
                                                                                                'storage/' .
                                                                                                    $comment->user
                                                                                                        ->profile_picture,
                                                                                            )
                                                                                            : 'https://ui-avatars.com/api/?name=' .
                                                                                                urlencode(
                                                                                                    $comment->user
                                                                                                        ->name ??
                                                                                                        'User',
                                                                                                ) .
                                                                                                '&background=0D8ABC&color=fff';
                                                                                @endphp

                                                                                <img src="{{ $profileImage }}"
                                                                                    alt="{{ $comment->user->name ?? 'User' }}"
                                                                                    class="rounded-circle border shadow-sm"
                                                                                    style="width: 48px; height: 48px; object-fit: cover;">

                                                                                <div>
                                                                                    <h6 class="mb-1 fw-bold text-primary green_color">
                                                                                        {{ $comment->user->name ?? 'User' }}
                                                                                    </h6>

                                                                                    @if (!empty($comment->comment))
                                                                                        <p class="mb-2 text-dark"
                                                                                            style="line-height: 1.6;">
                                                                                            {{ $comment->comment }}
                                                                                        </p>
                                                                                    @endif

                                                                                    @if (!empty($comment->image))
                                                                                        <a href="{{ asset('storage/' . $comment->image) }}"
                                                                                            target="_blank"
                                                                                            class="d-inline-block mt-1">
                                                                                            <img src="{{ asset('storage/' . $comment->image) }}"
                                                                                                alt="comment image"
                                                                                                class="rounded-3 border shadow-sm"
                                                                                                style="width: 120px; height: 120px; object-fit: cover;">
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <small class="text-muted text-nowrap">
                                                                                {{ $comment->created_at->format('d-m-Y h:i A') }}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="text-center py-5">
                                                                        <div class="text-muted fw-medium">No comments found
                                                                            for this application.</div>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer bg-white border-top px-4 py-3">
                                                            <button type="button"
                                                                class="btn btn-warning rounded-3 px-3 fw-semibold"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>



                        </div>
                    </div>
                </div>


            </div>
            <script>
                document.addEventListener('change', function(e) {
                    if (e.target.classList.contains('comment-image-input')) {
                        const input = e.target;
                        const file = input.files[0];
                        const previewSelector = input.getAttribute('data-preview');
                        const wrapperSelector = input.getAttribute('data-wrapper');
                        const previewImage = document.querySelector(previewSelector);
                        const previewWrapper = document.querySelector(wrapperSelector);

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                previewImage.src = event.target.result;
                                previewWrapper.classList.remove('d-none');
                            };
                            reader.readAsDataURL(file);
                        } else {
                            previewImage.src = '';
                            previewWrapper.classList.add('d-none');
                        }
                    }
                });
            </script>
            <script>
                document.querySelectorAll('.btn-delete').forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();

                        let form = this.closest('form');

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });

                const statusClassMap = {
                    'App Sent': 'status-app',
                    'Docs Required': 'status-docs',
                    'Cot in process': 'status-cot',
                    'Awaiting Signature': 'status-await',
                    'Cot Done': 'status-done',
                    'Signed': 'status-signed',
                    'Submitted to Supplier': 'status-submit',
                    'Cost Objected': 'status-object',
                    'Live': 'status-live',
                    'Rejected': 'status-reject',
                    'Paid': 'status-paid'
                };

                function updateDropdownColor(dropdown, status) {
                    dropdown.classList.remove(
                        'status-app',
                        'status-docs',
                        'status-cot',
                        'status-await',
                        'status-done',
                        'status-signed',
                        'status-submit',
                        'status-object',
                        'status-live',
                        'status-reject',
                        'status-paid'
                    );

                    if (statusClassMap[status]) {
                        dropdown.classList.add(statusClassMap[status]);
                    }
                }

                document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
                    dropdown.addEventListener('change', function() {
                        let selectedDropdown = this;
                        let newStatus = selectedDropdown.value;
                        let oldStatus = selectedDropdown.getAttribute('data-old-status') || newStatus;
                        let id = selectedDropdown.getAttribute('data-id');
                        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                        updateDropdownColor(selectedDropdown, newStatus);

                        fetch(`/admin/applications/${id}/status`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    status: newStatus
                                })
                            })
                            .then(async response => {
                                const data = await response.json();

                                if (!response.ok) {
                                    selectedDropdown.value = oldStatus;
                                    updateDropdownColor(selectedDropdown, oldStatus);

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message || 'Error updating status'
                                    });
                                    return;
                                }

                                selectedDropdown.setAttribute('data-old-status', newStatus);

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: data.message || 'Status updated successfully',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            })
                            .catch(error => {
                                console.error(error);

                                selectedDropdown.value = oldStatus;
                                updateDropdownColor(selectedDropdown, oldStatus);

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error updating status'
                                });
                            });
                    });
                });
            </script>


        </div>
    @endsection
