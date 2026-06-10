@extends('backend.layouts.app')

@section('content')
    @php
        $fieldMap = [
            'new_customer_name' => 'name_of_new_customer',
        ];

        $appValue = function ($name, $default = null) use ($application, $fieldMap) {
            $attribute = $fieldMap[$name] ?? $name;
            return old($name, data_get($application, $attribute, $default));
        };

        $storedFile = function ($path) {
            return $path ? asset('storage/' . ltrim($path, '/')) : null;
        };

        $directorEntries = old('director_name')
            ? collect(old('director_name'))
                ->map(function ($name, $index) {
                    return [
                        'director_name' => $name,
                        'date_of_birth' => old('director_dob_array.' . $index),
                        'phone_no' => old('director_phone.' . $index),
                        'email_address' => old('director_email.' . $index),
                        'home_address' => old('director_home_address.' . $index),
                    ];
                })
                ->values()
                ->all()
            : ($application->directors
                ->map(function ($director) {
                    return [
                        'director_name' => $director->director_name,
                        'date_of_birth' => $director->date_of_birth,
                        'phone_no' => $director->phone_no,
                        'email_address' => $director->email_address,
                        'home_address' => $director->home_address,
                    ];
                })
                ->values()
                ->all() ?: [
                [
                    'director_name' => '',
                    'date_of_birth' => '',
                    'phone_no' => '',
                    'email_address' => '',
                    'home_address' => '',
                ],
            ]);

        $gasMeters =
            old('meters') ?:
            ($application->meters
                ->where('meter_type', 'gas')
                ->map(function ($meter) {
                    return [
                        'supplier_name' => $meter->supplier_name,
                        'mprn_no' => $meter->mprn_no,
                        'offer_rate' => $meter->offer_rate,
                        'contract_duration' => $meter->contract_duration,
                        'uplift' => $meter->uplift,
                        'customer_no' => $meter->customer_no,
                        'bill_name' => $meter->name_appears_on_bill,
                        'current_meter_read' => $meter->current_meter_read,
                        'meter_serial_no' => $meter->meter_serial_no,
                        'last_bill_amount' => $meter->last_bill_amount,
                        'mode' => $meter->mode,
                    ];
                })
                ->values()
                ->toArray() ?: [
                [
                    'supplier_name' => '',
                    'mprn_no' => '',
                    'offer_rate' => '',
                    'contract_duration' => '',
                    'uplift' => '',
                    'customer_no' => '',
                    'bill_name' => '',
                    'current_meter_read' => '',
                    'meter_serial_no' => '',
                    'last_bill_amount' => '',
                    'mode' => '',
                ],
            ]);

        $elecMeters =
            old('elec_meters') ?:
            ($application->meters
                ->where('meter_type', 'electricity')
                ->map(function ($meter) {
                    return [
                        'supplier_name' => $meter->supplier_name,
                        'mpan_top_line' => $meter->mpan_top,
                        'mpan_bottom_line' => $meter->mpan_bottom,
                        'con_duration' => $meter->contract_duration,
                        'offer_rate' => $meter->offer_rate,
                        'name_on_bill' => $meter->name_appears_on_bill,
                        'customer_no' => $meter->customer_no,
                        'meter_serial_no' => $meter->meter_serial_no,
                        'current_meter_read' => $meter->current_meter_read,
                        'mode' => $meter->mode,
                        'last_bill_amount' => $meter->last_bill_amount,
                    ];
                })
                ->values()
                ->toArray() ?: [
                [
                    'supplier_name' => '',
                    'mpan_top_line' => '',
                    'mpan_bottom_line' => '',
                    'con_duration' => '',
                    'offer_rate' => '',
                    'name_on_bill' => '',
                    'customer_no' => '',
                    'meter_serial_no' => '',
                    'current_meter_read' => '',
                    'mode' => '',
                    'last_bill_amount' => '',
                ],
            ]);
    @endphp

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body bg-light position-relative pt-5">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Edit Application</h6>
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
            @include('backend.layouts.partials.leads-sales-cards')


            <div class="container-fluid bg-white px-3 py-5">

                <div class="mb-5  py-2 bg-white ">

                    <h6 class="fw-bold mb-0 green_color">
                        <i class="bi bi-ui-checks-grid me-1"></i>Edit Application (Electricity)
                    </h6>
                </div>

                <div class="d-flex align-items-center gap-3 mb-24 flex-wrap">

                    <div class="mt-0">
                        <a href="javascript:history.back()"
                            class="btn p-0 fw-semibold d-flex align-items-center gap-1 text-dark hover-text-success">
                            <iconify-icon icon="solar:alt-arrow-left-outline" class="text-xl"></iconify-icon>
                            Back
                        </a>
                    </div>

                    @include('backend.layouts.partials.application-summary-cards')
                </div>
                <!-- HEADER -->



                <form id="electricityForm" action="{{ route('admin.applications.update', $application->id) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- APPLICATION Form -->
                     <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center mb-2 pb-2">

                            <div class="col-md-2">
                                <label>Application Agent <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="application_agent" class="form-control"
                                    placeholder="Enter Agent Name"
                                    value="{{ old('application_agent', $application->application_agent ?? '') }}" required>
                            </div>
                            <div class="col-md-2">
                                <label>Sale Closer <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="sale_closer" class="form-control"
                                    placeholder="Enter Sale Closer Name"
                                    value="{{ old('sale_closer', $application->sale_closer ?? '') }}" required>
                            </div>
                        </div>

                    </div>

                    <!-- CUSTOMER DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Detail</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" placeholder="Enter company name"
                                    name="company_name" required value="{{ $appValue('company_name') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>

                            <div class="col-md-2"><label>Trading Name <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="trading_name" required
                                    value="{{ $appValue('trading_name') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-pencil"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="business_entity" class="form-control border-end-0"
                                    placeholder="Enter business entity "
                                    value="{{ old('business_entity', $application->business_entity ?? '') }}" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Business Nature <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="business_nature" class="form-control border-end-0"
                                    placeholder="Enter business nature "
                                    value="{{ old('business_nature', $application->business_nature ?? '') }}" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-briefcase"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Title <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="title" class="form-control border-end-0"
                                    placeholder="Enter title " value="{{ old('title', $application->title ?? '') }}"
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name<span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="merchant_full_name" class="form-control border-end-0"
                                    placeholder="Enter full name"
                                    value="{{ old('merchant_full_name', $application->merchant_full_name ?? '') }}"
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="position" class="form-control border-end-0"
                                    placeholder="Enter position "
                                    value="{{ old('position', $application->position ?? '') }}" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-people"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" name="email_address" class="form-control border-end-0"
                                    placeholder="Enter email"
                                    value="{{ old('email_address', $application->email_address ?? '') }}" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Phone Number <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="phone_number" required
                                    value="{{ $appValue('phone_number') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span
                                        class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="companies_house_number" required
                                    value="{{ $appValue('companies_house_number') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="vat_tax_number" required
                                    value="{{ $appValue('vat_tax_number') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="trading_address" required
                                    value="{{ $appValue('trading_address') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-geo-alt"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Postal Code <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="postal_code" required
                                    value="{{ $appValue('postal_code') }}">
                            </div>
                        </div>
                    </div>

                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Num <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" readonly name="application_num" required
                                    value="{{ $appValue('application_num') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" readonly name="service_type" required
                                    value="{{ $appValue('service_type') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-credit-card"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="application_date" class="form-control border-end-0"
                                    value="{{ \Carbon\Carbon::parse($appValue('application_date'))->format('Y-m-d') }}"
                                    required>
                                <span class="icon-box border-start-0">
                                    <span class="icon-box border-start-0"><i class="bi bi-calendar"></i></span>
                            </div>

                            <div class="col-md-2"><label>Annual Consumption <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="annual_consumption" required
                                    value="{{ $appValue('annual_consumption') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-lightning"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4">
                                <input type="date" name="renewal_date" class="form-control border-end-0"
                                    value="{{ \Carbon\Carbon::parse($appValue('renewal_date'))->format('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="col-md-2"><label>Electric Email <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" class="form-control" name="utility_email" required
                                    value="{{ $appValue('utility_email') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-envelope"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Company Registration No <span
                                        class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="company_reg_no" required
                                    value="{{ $appValue('company_reg_no') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                            </div>

                            <div class="col-md-2"><label>Commercial/Resident <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="commercial_resident" required
                                    value="{{ $appValue('commercial_resident') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                                 <div class="col-md-2">
    <label>Brand <span class="text-danger">:*</span></label>
</div>
<div class="col-md-4 d-flex align-items-center">
    <input type="text" name="brand" class="form-control border-end-0"
        placeholder="Enter Brand "
        value="{{ old('brand', $application->brand ?? '') }}" required>
    <span class="icon-box border-start-0">
        <i class="bi bi-bag"></i>
    </span>
</div>

                            <div class="col-md-2"><label>Comment</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="comment"
                                    value="{{ $appValue('comment') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-chat-left-text"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- Electricity DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Electricity Details</span></div>

                        <div id="elec-meter-container">
                            @foreach ($elecMeters as $index => $meter)
                                <div class="elec-meter-block mb-4 border-bottom pb-3">
                                    <div class="row mb-2">
                                        <div class="col-auto d-flex align-items-center">
                                            <p
                                                class="bg-dark fs-14 text-white fw-semibold px-3 py-1 rounded mb-0 elec-meter-label">
                                                Meter #{{ $index + 1 }}
                                            </p>
                                            <button type="button"
                                                class="btn btn-danger btn-sm ms-2 remove-elec-btn {{ $index === 0 ? 'd-none' : '' }}"
                                                style="padding: 2px 8px; font-size: 12px;">
                                                <i class="bi bi-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row gy-1 gx-3 align-items-center">
                                        <div class="col-md-2"><label>Meter Type</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="text" class="form-control" value="electricity"
                                                name="elec_meters[{{ $index }}][meter_type]" readonly required>
                                            <span class="icon-box border-start-0"><i class="bi bi-credit-card"></i></span>
                                        </div>

                                        <div class="col-md-2"><label>Supplier Name *</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][supplier_name]"
                                                value="{{ $meter['supplier_name'] ?? '' }}" required>
                                        </div>
                                    </div>

                                    <div class="row gy-1 gx-3 align-items-center">
                                        <div class="col-md-2"><label>MPAN Top Line</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][mpan_top_line]"
                                                value="{{ $meter['mpan_top_line'] ?? '' }}" required>
                                        </div>

                                        <div class="col-md-2"><label>MPAN Bottom Line</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][mpan_bottom_line]"
                                                value="{{ $meter['mpan_bottom_line'] ?? '' }}" required>
                                        </div>
                                    </div>

                                    <div class="row gy-1 gx-3 align-items-center">
                                        <div class="col-md-2"><label>Con. Duration</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][con_duration]"
                                                value="{{ $meter['con_duration'] ?? '' }}" required>
                                        </div>

                                        <div class="col-md-2"><label>Offer Rate</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][offer_rate]"
                                                value="{{ $meter['offer_rate'] ?? '' }}" required>
                                        </div>
                                    </div>

                                    <div class="row gy-1 gx-3 align-items-center">
                                        <div class="col-md-2"><label>Name Appears On Bill</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][name_on_bill]"
                                                value="{{ $meter['name_on_bill'] ?? '' }}" required>
                                        </div>

                                        <div class="col-md-2"><label>Customer No.</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][customer_no]"
                                                value="{{ $meter['customer_no'] ?? '' }}" required>
                                        </div>
                                    </div>

                                    <div class="row gy-1 gx-3 align-items-center">
                                        <div class="col-md-2"><label>Meter Serial No.</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][meter_serial_no]"
                                                value="{{ $meter['meter_serial_no'] ?? '' }}" required>
                                        </div>

                                        <div class="col-md-2"><label>Current Meter Read</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][current_meter_read]"
                                                value="{{ $meter['current_meter_read'] ?? '' }}" required>
                                        </div>
                                    </div>

                                    <div class="row gy-1 gx-3 align-items-center">
                                        <div class="col-md-2"><label>Mode</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control" name="elec_meters[{{ $index }}][mode]"
                                                value="{{ $meter['mode'] ?? '' }}" required>
                                        </div>

                                        <div class="col-md-2"><label>Last Bill Amount</label></div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input class="form-control"
                                                name="elec_meters[{{ $index }}][last_bill_amount]"
                                                value="{{ $meter['last_bill_amount'] ?? '' }}" required>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <button type="button" id="add-elec-meter-btn" class="btn btn-primary bg_green_color">
                                <i class="bi bi-plus-circle me-1"></i> Add More Meter
                            </button>
                        </div>
                    </div>

                    <!-- BANK DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Bank Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Name On Account</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="name_on_account"
                                    value="{{ $appValue('name_on_account') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="account_number"
                                    value="{{ $appValue('account_number') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="sort_code" value="{{ $appValue('sort_code') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-diagram-3"></i></span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="iban" value="{{ $appValue('iban') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-credit-card-2-front"></i></span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="bic" value="{{ $appValue('bic') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-bank"></i></span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="name_of_bank" value="{{ $appValue('name_of_bank') }}">
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>

                        </div>
                    </div>

                    <!-- OTHER DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Other Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Bill Payment Method</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="bill_payment_method"
                                    value="{{ $appValue('bill_payment_method') }}">
                            </div>

                            <div class="col-md-2"><label>Landlord Name</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="landlord_name"
                                    value="{{ $appValue('landlord_name') }}">
                            </div>
                        </div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Director D.O.B</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="director_dob_single" class="form-control border-end-0"
                                    value="{{ \Carbon\Carbon::parse($appValue('director_dob_single'))->format('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="col-md-2"><label>Name Of New Customer</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="new_customer_name" required
                                    value="{{ $appValue('new_customer_name') }}">
                            </div>
                        </div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Status Taken Date</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="status_taken_date" class="form-control border-end-0"
                                    value="{{ \Carbon\Carbon::parse($appValue('status_taken_date'))->format('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="col-md-2"><label>Password</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="password" class="form-control" name="password"
                                    value="{{ $appValue('password') }}">
                            </div>

                            <div class="col-md-2"><label>Customer History</label></div>
                            <div class="col-md-10 d-flex align-items-center">
                                <input class="form-control" name="customer_history"
                                    value="{{ $appValue('customer_history') }}">
                            </div>

                        </div>
                    </div>

                    <!-- KYC -->
                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-body">

                            <div class="section-title"><span>KYC Verification</span></div>

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label>Picture ID</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="pictureId" name="picture_id" hidden>
                                    </div>
                                    @if ($application->picture_id)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->picture_id) }}" target="_blank">View
                                                Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label>Inside/Outside pics</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="insidePics" name="inside_outside_pics" hidden>
                                    </div>
                                    @if ($application->inside_outside_pics)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->inside_outside_pics) }}"
                                                target="_blank">View
                                                Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label>Bill</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="billUpload" name="bill_upload" hidden>
                                    </div>
                                    @if ($application->bill_upload)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->bill_upload) }}" target="_blank">View
                                                Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label>Bank Statement</label>
                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('bankStatement').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="bankStatement" name="bank_statement" hidden>
                                    </div>
                                    @if ($application->bank_statement)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->bank_statement) }}"
                                                target="_blank">View
                                                Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label>Additional Uploads</label>
                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('additionalUploads').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="additionalUploads" name="additional_uploads" hidden>
                                    </div>
                                    @if ($application->additional_uploads)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->additional_uploads) }}"
                                                target="_blank">View
                                                Current File</a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="mt-3">
                        <button class="btn btn-primary bg_green_color" type="submit">
                            <i class="bi bi-send me-1"></i> Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <script>
            document.getElementById('add-elec-meter-btn').addEventListener('click', function() {
                const container = document.getElementById('elec-meter-container');
                const firstBlock = container.querySelector('.elec-meter-block');

                // Clone the first block and reset the values for all inputs in the cloned block
                const newBlock = firstBlock.cloneNode(true);

                // Reset values for all input fields in the cloned block
                newBlock.querySelectorAll('input').forEach(input => {
                    input.value = ''; // Clear the input fields
                });

                // Set the default 'electricity' value for the meter type in the cloned block
                const meterTypeInput = newBlock.querySelector('input[name^="elec_meters"][name$="[meter_type]"]');
                if (meterTypeInput) {
                    meterTypeInput.value = 'electricity'; // Set the 'electricity' value to the cloned meter type input
                }

                // Manage Remove Button
                const removeBtn = newBlock.querySelector('.remove-elec-btn');
                removeBtn.classList.remove('d-none'); // Show the remove button for the cloned block

                // Add click event for remove button
                removeBtn.onclick = function() {
                    newBlock.remove();
                    updateMeterIndexes(); // Update indexes after removing the block
                };

                // Append the cloned block to the container
                container.appendChild(newBlock);
                updateMeterIndexes(); // Update the meter indexes after adding a new block
            });

            // Use event delegation for the remove button
            document.getElementById('elec-meter-container').addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('remove-elec-btn')) {
                    const meterBlock = event.target.closest('.elec-meter-block');
                    if (meterBlock) {
                        meterBlock.remove();
                        updateMeterIndexes();
                    }
                }
            });

            function updateMeterIndexes() {
                const blocks = document.querySelectorAll('.elec-meter-block');
                blocks.forEach((block, index) => {
                    // Update Meter Label (Meter #1, Meter #2...)
                    block.querySelector('.elec-meter-label').innerText = `Meter #${index + 1}`;

                    // Update Input Names (elec_meters[0], elec_meters[1]...)
                    block.querySelectorAll('input').forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            // This regex will replace the index [0], [1], etc. in the input's name
                            const newName = name.replace(/elec_meters\[\d+\]/, `elec_meters[${index}]`);
                            input.setAttribute('name', newName);
                        }
                    });
                });
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



        </div>
    @endsection
