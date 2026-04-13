@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')


        <style>


.status-badge {
    border: none;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    outline: none;
    cursor: pointer;
    appearance: none;
    text-align: center;
}

/* Pending */
.status-badge[value="Pending"],
.status-badge option[value="Pending"]:checked {
    background: #fff3cd;
    color: #856404;
}

/* Approved */
.status-badge[value="Approved"],
.status-badge option[value="Approved"]:checked {
    background: #d1e7dd;
    color: #0f5132;
}

/* Rejected */
.status-badge[value="Rejected"],
.status-badge option[value="Rejected"]:checked {
    background: #f8d7da;
    color: #842029;
}


        </style>
        <div class="dashboard-main-body bg-light position-relative pt-5">

            <!-- ⭐ Attractive Back Button (Bootstrap only) -->
            <div class="position-absolute top-0 start-0 mt-3 ms-3">
                <a href="javascript:history.back()"
                    class="btn btn-light border shadow-sm rounded-pill px-3 py-2 fw-semibold
                      d-flex align-items-center gap-2 bg_green_color">
                    ← Back
                </a>
            </div>

            <div class="container-fluid bg-white px-3 py-5">

                <!-- HEADER -->
                <div class="mb-3 px-3 py-2 bg-white border rounded">
                    <h6 class="fw-bold mb-0 green_color">
                        <i class="bi bi-ui-checks-grid me-1"></i> Applications
                    </h6>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card basic-data-table">
                            {{-- <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title text-success green_color-1000">Add User</h4>
                                    <a href="#" class="btn btn-brand-1">+ Add</a>
                                </div> --}}

                            <div class="card-body">


                                <div class="d-flex align-items-center mb-3">

                                    <div class="btn-group border rounded-pill overflow-hidden shadow-sm bg-white"
                                        role="group">

                                        <button type="button"
                                            class="btn btn-sm fw-semibold px-3 py-1 btn-success bg_green_color active-tab">
                                            All
                                        </button>

                                        <button type="button"
                                            class="btn btn-sm btn-light fw-semibold px-3 py-1 border-start text-success green_color">
                                            Pending
                                        </button>

                                        <button type="button"
                                            class="btn btn-sm btn-light fw-semibold px-3 py-1 border-start text-success green_color">
                                            Complete
                                        </button>

                                        <button type="button"
                                            class="btn btn-sm btn-light fw-semibold px-3 py-1 border-start text-success green_color">
                                            Approved
                                        </button>

                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table bordered-table mb-0 text-start" id="dataTable"
                                        data-page-length='10'>
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-start">
                                                    <label class="form-check-label">S.L</label>
                                                </th>
                                                <th>App #</th>
                                                <th>Action</th>
                                                <th>Date</th>
                                                <th>Service</th> {{-- Naya Column --}}
                                                <th>Sale By</th>
                                                <th>Status</th>
                                                <th>Company / Merchant</th>
                                                <th>Product / Brand</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($applications as $key => $item)
                                                <tr>
                                                    {{-- Serial Number --}}
                                                    <td class="text-start">{{ $key + 1 }}</td>

                                                    {{-- 1. Application Number --}}
                                                    <td class="text-start fw-bold text-primary-600">
                                                        {{ $item->application_num }}
                                                    </td>

                                                    {{-- 2. Action --}}
                                                    <td class="text-start">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <a href="{{ route('admin.applications.edit', $item->id) }}"
                                                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                                data-bs-toggle="tooltip" title="View">
                                                                <iconify-icon icon="lucide:eye"></iconify-icon>
                                                            </a>

                                                            <form
                                                                action="{{ route('admin.applications.destroy', $item->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    <iconify-icon
                                                                        icon="mingcute:delete-2-line"></iconify-icon>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>

                                                    {{-- 3. Date --}}
                                                    <td class="text-start text-nowrap">
                                                        {{ $item->created_at->format('d-m-Y') }}
                                                    </td>

                                                    {{-- 4. Service (Identifies the form type) --}}
                                                    <td class="text-start">
                                                        <span class="badge bg-info-focus text-info-main px-2 py-1">
                                                            {{ $item->service_type }}
                                                        </span>
                                                    </td>

                                                    {{-- 5. Sale By --}}
                                                    <td class="text-start">
                                                        {{ $item->application_agent ?? 'N/A' }}
                                                    </td>

                                                    {{-- 6. Status --}}
                                                   <td class="text-start">
    <select class="status-badge status-dropdown"
            data-id="{{ $item->id }}">

        <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="Approved" {{ $item->status == 'Approved' ? 'selected' : '' }}>
            Approved
        </option>

        <option value="Rejected" {{ $item->status == 'Rejected' ? 'selected' : '' }}>
            Rejected
        </option>
    </select>
</td>

                                                    {{-- 7. Company / Merchant --}}
                                                    <td class="text-start">
                                                        {{ $item->company_name ?? $item->merchant_full_name }}
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

        <script>
            document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
                dropdown.addEventListener('change', function() {
                    let status = this.value;
                    let id = this.getAttribute('data-id');

                    fetch(`/applications/${id}/status`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // optional UI feedback
                                console.log('Status updated');
                            }
                        })
                        .catch(err => {
                            alert('Error updating status');
                        });
                });
            });
        </script>
    @endsection
