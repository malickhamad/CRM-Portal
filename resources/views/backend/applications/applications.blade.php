@extends('backend.layouts.app')

@section('content')
    <style>
        #dataTable tbody tr {
            transition: all 0.2s ease-in-out;
        }

        #dataTable tbody tr:hover {
            background-color: #eaf7ef !important;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(80, 78, 78, 0.08);
            transform: scale(1.005);
        }

        /* IMPORTANT: override Bootstrap table-striped or background cells */
        #dataTable tbody tr:hover td {
            background-color: transparent !important;
        }
    </style>


    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

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

                                <div class="table-responsive scroll-lg">
                                    <table class="table bordered-table mb-0 text-start table-hover table-sm" id="dataTable"
                                        data-page-length='10'>
                                        <thead>
                                            <tr>

                                                <th> No</th>
                                                <th>Action</th>
                                                <th class="text-start">Date</th>
                                                <th>Sale By</th>
                                                <th>Status</th>
                                                <th>Company / Merchant</th>
                                                <th>Product / Brand</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $rows = [
                                                    [
                                                        'date' => '2026-04-01',
                                                        'sale_by' => 'Ali Ahmed',
                                                        'status' => 'Active',
                                                        'company' => 'ABC Traders ',
                                                        'product' => 'Nike Shoes',
                                                        'qty' => 5,
                                                    ],
                                                    [
                                                        'date' => '2026-04-02',
                                                        'sale_by' => 'Usman Khan',
                                                        'status' => 'Pending',
                                                        'company' => 'XYZ Mart',
                                                        'product' => 'Adidas T-Shirt',
                                                        'qty' => 3,
                                                    ],
                                                    [
                                                        'date' => '2026-04-03',
                                                        'sale_by' => 'Sara Malik',
                                                        'status' => 'Inactive',
                                                        'company' => 'Global Store',
                                                        'product' => 'Samsung Mobile',
                                                        'qty' => 2,
                                                    ],
                                                    [
                                                        'date' => '2026-04-04',
                                                        'sale_by' => 'Ahmed Raza',
                                                        'status' => 'Active',
                                                        'company' => 'Tech Hub',
                                                        'product' => 'Dell Laptop',
                                                        'qty' => 1,
                                                    ],
                                                    [
                                                        'date' => '2026-04-05',
                                                        'sale_by' => 'Hina Noor',
                                                        'status' => 'Pending',
                                                        'company' => 'City Mall',
                                                        'product' => 'Apple iPhone',
                                                        'qty' => 4,
                                                    ],
                                                    [
                                                        'date' => '2026-04-01',
                                                        'sale_by' => 'Ali Ahmed',
                                                        'status' => 'Active',
                                                        'company' => 'ABC Traders',
                                                        'product' => 'Nike Shoes',
                                                        'qty' => 5,
                                                    ],
                                                    [
                                                        'date' => '2026-04-02',
                                                        'sale_by' => 'Usman Khan',
                                                        'status' => 'Pending',
                                                        'company' => 'XYZ Mart',
                                                        'product' => 'Adidas T-Shirt',
                                                        'qty' => 3,
                                                    ],
                                                    [
                                                        'date' => '2026-04-03',
                                                        'sale_by' => 'Sara Malik',
                                                        'status' => 'Inactive',
                                                        'company' => 'Global Store',
                                                        'product' => 'Samsung Mobile',
                                                        'qty' => 2,
                                                    ],
                                                    [
                                                        'date' => '2026-04-04',
                                                        'sale_by' => 'Ahmed Raza',
                                                        'status' => 'Active',
                                                        'company' => 'Tech Hub',
                                                        'product' => 'Dell Laptop',
                                                        'qty' => 1,
                                                    ],
                                                    [
                                                        'date' => '2026-04-05',
                                                        'sale_by' => 'Hina Noor',
                                                        'status' => 'Pending',
                                                        'company' => 'City Mall',
                                                        'product' => 'Apple iPhone',
                                                        'qty' => 4,
                                                    ],
                                                    [
                                                        'date' => '2026-04-01',
                                                        'sale_by' => 'Ali Ahmed',
                                                        'status' => 'Active',
                                                        'company' => 'ABC Traders',
                                                        'product' => 'Nike Shoes',
                                                        'qty' => 5,
                                                    ],
                                                    [
                                                        'date' => '2026-04-02',
                                                        'sale_by' => 'Usman Khan',
                                                        'status' => 'Pending',
                                                        'company' => 'XYZ Mart',
                                                        'product' => 'Adidas T-Shirt',
                                                        'qty' => 3,
                                                    ],
                                                    [
                                                        'date' => '2026-04-03',
                                                        'sale_by' => 'Sara Malik',
                                                        'status' => 'Inactive',
                                                        'company' => 'Global Store',
                                                        'product' => 'Samsung Mobile',
                                                        'qty' => 2,
                                                    ],
                                                    [
                                                        'date' => '2026-04-04',
                                                        'sale_by' => 'Ahmed Raza',
                                                        'status' => 'Active',
                                                        'company' => 'Tech Hub',
                                                        'product' => 'Dell Laptop',
                                                        'qty' => 1,
                                                    ],
                                                    [
                                                        'date' => '2026-04-05',
                                                        'sale_by' => 'Hina Noor',
                                                        'status' => 'Pending',
                                                        'company' => 'City Mall',
                                                        'product' => 'Apple iPhone',
                                                        'qty' => 4,
                                                    ],
                                                ];
                                            @endphp

                                            @foreach ($rows as $index => $row)
                                                <tr>
                                                    <td class= "text-nowrap">{{ $index + 1 }}</td>

                                                    <td class= "text-nowrap d-flex gap-1">
                                                        <a href="#"
                                                            class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="lucide:eye"></iconify-icon>
                                                        </a>
                                                        <a href="#"
                                                            class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                                        </a>
                                                        <a href="#"
                                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                        </a>
                                                    </td>

                                                    <td class= "text-nowrap">{{ $row['date'] }}</td>
                                                    <td class= "text-nowrap">{{ $row['sale_by'] }}</td>

                                                    <td class= "text-nowrap">
                                                        <span
                                                            class="badge bg-{{ $row['status'] == 'Active' ? 'success' : ($row['status'] == 'Pending' ? 'warning' : 'danger') }}">
                                                            {{ $row['status'] }}
                                                        </span>
                                                    </td>

                                                    <td class= "text-nowrap">{{ $row['company'] }}</td>
                                                    <td class= "text-nowrap">{{ $row['product'] }}</td>
                                                    <td class= "text-nowrap">{{ $row['qty'] }}</td>
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
    @endsection
