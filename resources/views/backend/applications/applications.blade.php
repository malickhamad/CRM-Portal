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
                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card" data-filter="live"
                    style="background-color: #e0f2fe; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Live Applications</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">{{ $liveApplications }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    data-filter="pending"
                    style="background-color: #f3e5ab; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Pending Applications</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">{{ $pendingApplications }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    data-filter="completed"
                    style="background-color: #d4e7c5; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Completed Applications</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">{{ $completedApplications }}</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    data-filter="rejected"
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
                                            {{ $selectedUserId ? $users->where('id', $selectedUserId)->first()->name ?? 'Select User' : 'All Users' }}
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-hover">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.applications') }}">
                                                    All users
                                                </a>
                                            </li>

                                            @foreach ($users as $user)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.applications', ['user_id' => $user->id]) }}">
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
                                .dropdown-hover:hover>.dropdown-menu-hover {
                                    display: block;
                                }

                                /* Menu ki alignment fix karne ke liye */
                                .dropdown-menu-hover {
                                    margin-top: 0;
                                    /* Gap khatam karne ke liye */
                                    right: 0 !important;
                                    /* Right side se align karega taake screen se bahar na jaye */
                                    left: auto !important;
                                    /* Left auto rakhein */
                                }

                                .dropdown-hover>.dropdown-toggle:active {
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
                                            <tr data-status="{{ $item->status }}">
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
                                                        @if (auth()->user()->hasRole('Admin'))
                                                            <button type="button"
                                                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center border-0"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#commissionModal{{ $item->id }}"
                                                                title="Add Commission">
                                                                <iconify-icon icon="mdi:cash-plus"></iconify-icon>
                                                            </button>
                                                        @endif
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

                                                        {{-- <form action="{{ route('admin.applications.destroy', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0">
                                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                            </button>
                                                        </form> --}}
                                                        {{-- KYC Documents Button --}}
                                                        <button type="button"
                                                            class="w-32-px h-32-px bg-primary-focus text-primary-main rounded-circle d-inline-flex align-items-center justify-content-center border-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kycModal{{ $item->id }}"
                                                            title="View KYC Documents">
                                                            <iconify-icon
                                                                icon="mdi:file-document-multiple-outline"></iconify-icon>
                                                        </button>
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


                                            {{-- Comment Modal --}}
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
                                                                                    <h6
                                                                                        class="mb-1 fw-bold text-primary green_color">
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


                                              {{-- KYC Documents Modal --}}
            {{-- <div class="modal fade" id="kycModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="kycModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content border-0 shadow-lg">

                        <div class="modal-header bg-white border-bottom py-3 px-4">
                            <div>
                                <h6 class="fw-semibold mb-0 text-success-1000" id="kycModalLabel{{ $item->id }}">
                                    <i class="bi bi-shield-check me-2"></i>KYC Documents - {{ $item->application_num }}
                                </h6>
                                <small class="text-muted">{{ $item->company_name }} /
                                    {{ $item->merchant_full_name }}</small>
                            </div>
                            <button type="button" class="btn-close fs-6" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body bg-light-subtle p-4">

                            @php
                                $kycSections = [
                                    'picture_id' => [
                                        'icon' => 'bi-person-badge',
                                        'color' => 'primary',
                                        'label' => 'Picture ID',
                                    ],
                                    'inside_outside_pics' => [
                                        'icon' => 'bi-building',
                                        'color' => 'success',
                                        'label' => 'Inside/Outside Pics',
                                    ],
                                    'bill_upload' => [
                                        'icon' => 'bi-receipt',
                                        'color' => 'warning',
                                        'label' => 'Bill',
                                    ],
                                    'bank_statement' => [
                                        'icon' => 'bi-bank',
                                        'color' => 'info',
                                        'label' => 'Bank Statement',
                                    ],
                                    'additional_uploads' => [
                                        'icon' => 'bi-upload',
                                        'color' => 'secondary',
                                        'label' => 'Additional Uploads',
                                    ],
                                ];
                            @endphp

                            @foreach ($kycSections as $field => $section)
                                @php
                                    $files = !empty($item->$field) ? explode(',', $item->$field) : [];
                                @endphp

                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header bg-white border-bottom py-3">
                                        <h6 class="mb-0">
                                            <i class="bi {{ $section['icon'] }} me-2 text-{{ $section['color'] }}"></i>
                                            {{ $section['label'] }}
                                            @if (count($files) > 0)
                                                <span class="badge bg-{{ $section['color'] }} ms-2">{{ count($files) }}
                                                    file(s)</span>
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        @if (count($files) > 0)
                                            <div class="row g-3">
                                                @foreach ($files as $file)
                                                    @php
                                                        $filePath = trim($file);
                                                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                                        $isImage = in_array(strtolower($fileExtension), [
                                                            'jpg',
                                                            'jpeg',
                                                            'png',
                                                            'gif',
                                                            'webp',
                                                        ]);
                                                    @endphp

                                                    <div class="col-md-3 col-sm-4 col-6">
                                                        <div class="border rounded-3 bg-white p-2 position-relative h-100">

                                                            @if ($isImage)
                                                                <a href="{{ asset('storage/' . $filePath) }}"
                                                                    target="_blank" class="d-block">
                                                                    <img src="{{ asset('storage/' . $filePath) }}"
                                                                        alt="KYC Document"
                                                                        class="img-fluid rounded-2 w-100"
                                                                        style="height: 150px; object-fit: cover;">
                                                                </a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $filePath) }}"
                                                                    target="_blank"
                                                                    class="d-flex flex-column align-items-center justify-content-center text-decoration-none"
                                                                    style="height: 150px;">
                                                                    <i
                                                                        class="bi bi-file-earmark-pdf display-4 text-danger mb-2"></i>
                                                                    <span class="small text-muted text-center text-break">
                                                                        {{ basename($filePath) }}
                                                                    </span>
                                                                </a>
                                                            @endif

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-2 px-1">
                                                                <small class="text-muted text-truncate"
                                                                    style="max-width: 120px;"
                                                                    title="{{ basename($filePath) }}">
                                                                    {{ \Illuminate\Support\Str::limit(basename($filePath), 15) }}
                                                                </small>

                                                                <div class="d-flex gap-1">
                                                                    <a href="{{ asset('storage/' . $filePath) }}" download
                                                                        class="btn btn-sm btn-light rounded-circle p-1"
                                                                        title="Download">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>

                                                                    @if (auth()->user()->hasRole('Admin'))
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-light rounded-circle p-1 text-danger delete-kyc-file"
                                                                            data-file="{{ $filePath }}"
                                                                            data-application-id="{{ $item->id }}"
                                                                            title="Delete">
                                                                            <i class="bi bi-trash"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="bi bi-folder2-open display-4 text-muted mb-2"></i>
                                                <p class="text-muted mb-0">No files uploaded yet</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="modal-footer bg-white border-top px-4 py-3">
                            <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">
                                Close
                            </button>
                            <a href="{{ route('admin.applications.print', $item->id) }}" target="_blank"
                                class="btn btn-primary rounded-3 px-4">
                                <i class="bi bi-printer me-1"></i> Print Application
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}


             <div class="modal fade" id="kycModal{{ $item->id }}" tabindex="-1">

                                                <div class="modal-dialog modal-xl modal-dialog-scrollable">

                                                    <div class="modal-content border-0 shadow-lg rounded-4">


                                                        <div class="modal-header bg-white">

                                                            <div>
                                                                <h5 class="fw-bold text-success mb-1">
                                                                    <i class="bi bi-shield-check me-2"></i>
                                                                    KYC Documents
                                                                </h5>

                                                                <small class="text-muted">
                                                                    {{ $item->application_num }} |
                                                                    {{ $item->company_name }}
                                                                </small>

                                                            </div>

                                                            <button class="btn-close" data-bs-dismiss="modal"></button>

                                                        </div>



                                                        <div class="modal-body bg-light">


                                                            @php

                                                                $sections = [
                                                                    'picture_id' => 'Picture ID',
                                                                    'inside_outside_pics' => 'Inside / Outside Pics',
                                                                    'bill_upload' => 'Bills',
                                                                    'bank_statement' => 'Bank Statement',
                                                                    'additional_uploads' => 'Additional Files',
                                                                ];

                                                            @endphp



                                                            @foreach ($sections as $field => $title)
                                                                @php

                                                                    $files = !empty($item->$field)
                                                                        ? explode(',', $item->$field)
                                                                        : [];

                                                                @endphp



                                                                <div class="card border-0 shadow-sm rounded-4 mb-3">


                                                                    <div class="card-header bg-white py-3">

                                                                        <strong>
                                                                            <i
                                                                                class="bi bi-folder2-open text-success me-2"></i>
                                                                            {{ $title }}
                                                                        </strong>

                                                                        <span class="badge bg-success ms-2">
                                                                            {{ count($files) }}
                                                                        </span>

                                                                    </div>



                                                                    <div class="card-body">


                                                                        @if (count($files))
                                                                            <div class="row g-3">


                                                                                @foreach ($files as $file)
                                                                                    @php

                                                                                        $file = trim($file);

                                                                                        $extension = strtolower(
                                                                                            pathinfo(
                                                                                                $file,
                                                                                                PATHINFO_EXTENSION,
                                                                                            ),
                                                                                        );

                                                                                        $isImage = in_array(
                                                                                            $extension,
                                                                                            [
                                                                                                'jpg',
                                                                                                'jpeg',
                                                                                                'png',
                                                                                                'webp',
                                                                                                'gif',
                                                                                            ],
                                                                                        );

                                                                                        $fileIcon = match ($extension) {
                                                                                            'pdf'
                                                                                                => 'bi-file-earmark-pdf text-danger',

                                                                                            'doc',
                                                                                            'docx'
                                                                                                => 'bi-file-earmark-word text-primary',

                                                                                            'xls',
                                                                                            'xlsx'
                                                                                                => 'bi-file-earmark-excel text-success',

                                                                                            default
                                                                                                => 'bi-file-earmark-text text-secondary',
                                                                                        };

                                                                                    @endphp



                                                                                    <div
                                                                                        class="col-xl-3 col-lg-4 col-md-6">


                                                                                        <div
                                                                                            class="card border rounded-3 h-100">


                                                                                            <div
                                                                                                class="text-center bg-light rounded-top">


                                                                                                @if ($isImage)
                                                                                                    <a href="{{ asset('storage/' . $file) }}"
                                                                                                        target="_blank">


                                                                                                        <img src="{{ asset('storage/' . $file) }}"
                                                                                                            class="img-fluid rounded-top"
                                                                                                            style="height:120px;width:100%;object-fit:cover;">

                                                                                                    </a>
                                                                                                @else
                                                                                                    <div class="d-flex justify-content-center align-items-center"
                                                                                                        style="height:120px">


                                                                                                        <i class="bi {{ $fileIcon }}"
                                                                                                            style="font-size:45px"></i>


                                                                                                    </div>
                                                                                                @endif


                                                                                            </div>




                                                                                            <div class="card-body p-2">


                                                                                                <div class="small text-truncate fw-semibold"
                                                                                                    title="{{ basename($file) }}">

                                                                                                    {{ basename($file) }}

                                                                                                </div>



                                                                                                <a href="{{ asset('storage/' . $file) }}"
                                                                                                    target="_blank"
                                                                                                    class="btn btn-sm btn-outline-success w-100 mt-2">


                                                                                                    <i
                                                                                                        class="bi bi-eye"></i>
                                                                                                    View

                                                                                                </a>


                                                                                            </div>



                                                                                        </div>


                                                                                    </div>
                                                                                @endforeach


                                                                            </div>
                                                                        @else
                                                                            <div class="text-center text-muted py-3">

                                                                                <i class="bi bi-folder-x fs-3"></i>

                                                                                <br>
                                                                                No files available

                                                                            </div>
                                                                        @endif


                                                                    </div>


                                                                </div>
                                                            @endforeach



                                                        </div>



                                                        <div class="modal-footer">

                                                            <button class="btn btn-secondary rounded-3"
                                                                data-bs-dismiss="modal">

                                                                Close

                                                            </button>

                                                        </div>


                                                    </div>

                                                </div>

                                            </div>
                                            

                                            {{-- Commission Modal --}}
                                            <div class="modal fade" id="commissionModal{{ $item->id }}"
                                                tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content border-0 shadow-lg">
                                                        <form
                                                            action="{{ route('admin.applications.commission.update', $item->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            <div class="modal-header">
                                                                <h6 class="modal-title">Add Commission -
                                                                    {{ $item->application_num }}</h6>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Commission Amount</label>
                                                                    <input type="number" step="0.01"
                                                                        name="commission_amount"
                                                                        value="{{ $item->commission_amount }}"
                                                                        class="form-control" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Mature Date</label>
                                                                    <input type="date" name="mature_date"
                                                                        value="{{ $item->mature_date }}"
                                                                        class="form-control">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Paid Date</label>
                                                                    <input type="date" name="paid_date"
                                                                        value="{{ $item->paid_date }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-success">Save Commission</button>
                                                            </div>
                                                        </form>
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
                document.addEventListener('DOMContentLoaded', function() {
                    // Handle KYC file deletion
                    document.querySelectorAll('.delete-kyc-file').forEach(button => {
                        button.addEventListener('click', function() {
                            const file = this.getAttribute('data-file');
                            const applicationId = this.getAttribute('data-application-id');

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
                                    // Create form and submit
                                    const form = document.createElement('form');
                                    form.method = 'POST';
                                    form.action =
                                    `/admin/applications/${applicationId}/delete-file`;

                                    const csrfToken = document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content');

                                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="file" value="${file}">
                    `;

                                    document.body.appendChild(form);
                                    form.submit();
                                }
                            });
                        });
                    });
                });
            </script>



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




            {{-- script for filtering completed pending and rejected  --}}

            <script>
                document.querySelectorAll('.stat-card').forEach(card => {
                    card.style.cursor = 'pointer';

                    card.addEventListener('click', function() {
                        let filter = this.getAttribute('data-filter');

                        document.querySelectorAll('#dataTable tbody tr').forEach(row => {
                            let dropdown = row.querySelector('.status-dropdown');
                            let status = dropdown ? dropdown.value : row.getAttribute('data-status');

                            // Status ko trim karke lowercase kar rahe hain taake spelling/case ka koi rona na rahe
                            status = status ? status.trim().toLowerCase() : '';

                            if (filter === 'pending') {
                                // Purana solid logic: Jo rejected, paid, completed ya live nahi hai, woh sab pending hai
                                row.style.display = (status !== 'rejected' && status !== 'paid' &&
                                    status !== 'completed' && status !== 'live') ? '' : 'none';

                            } else if (filter === 'completed') {
                                // Agar status 'paid' ya 'completed' ho
                                row.style.display = (status === 'paid' || status === 'completed' ||
                                    status === 'live') ? '' : 'none';

                            } else if (filter === 'rejected') {
                                // Agar status 'rejected' ho
                                row.style.display = (status === 'rejected') ? '' : 'none';

                            } else if (filter === 'live') {
                                // Naya Live filter
                                row.style.display = (status === 'live') ? '' : 'none';
                            }
                        });
                    });
                });
            </script>
        </div>
    @endsection
