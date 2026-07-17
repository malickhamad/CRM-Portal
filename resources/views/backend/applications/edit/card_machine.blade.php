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
                        <i class="bi bi-ui-checks-grid me-1"></i>Edit Application (Card Machine)
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


                <form id="applicationForm" action="{{ route('admin.applications.update', $application->id) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

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


                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Detail</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="company_name" class="form-control border-end-0"
                                    placeholder="Enter company name" value="{{ $appValue('company_name') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="trading_name" class="form-control border-end-0"
                                    placeholder="Enter trading name" required value="{{ $appValue('trading_name') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shop"></i>
                                </span>
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
                                <input type="text" name="phone_number" class="form-control border-end-0"
                                    placeholder="03XXXXXXXXX" required value="{{ $appValue('phone_number') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span
                                        class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="companies_house_number" class="form-control border-end-0"
                                    placeholder="Enter House Number" required
                                    value="{{ $appValue('companies_house_number') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="vat_tax_number" class="form-control border-end-0"
                                    placeholder="Enter VAT/TAX Number" required
                                    value="{{ $appValue('vat_tax_number') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-receipt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="trading_address" class="form-control border-end-0"
                                    placeholder="Enter Trading Address" required
                                    value="{{ $appValue('trading_address') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Director Detail</span></div>

                        <div id="director-container">
                            @foreach ($directorEntries as $index => $director)
                                <div class="director-block mb-4 border-bottom pb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <p
                                            class="bg-dark fs-14 text-white fw-semibold px-3 py-2 d-inline-block rounded director-label mb-0">
                                            Director #{{ $index + 1 }}
                                        </p>
                                        <button type="button"
                                            class="btn btn-danger btn-sm remove-director-btn {{ $index === 0 ? 'd-none' : '' }}">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </div>

                                    <div class="row g-3 align-items-center mb-2 pb-2">
                                        <div class="col-md-2"><label>Director Name <span
                                                    class="text-danger">:*</span></label>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="text" name="director_name[]"
                                                class="form-control border-end-0" placeholder="Enter Director Name"
                                                value="{{ $director['director_name'] ?? '' }}" required>
                                            <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                                        </div>
                                        <div class="col-md-2"><label>Date Of Birth <span
                                                    class="text-danger">:*</span></label>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="date" name="director_dob_array[]"
                                                class="form-control border-end-0"
                                                value="{{ \Carbon\Carbon::parse($director['date_of_birth'])->format('Y-m-d') ?? '' }}"
                                                required>
                                            <span class="icon-box border-start-0"><i
                                                    class="bi bi-calendar-date"></i></span>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-items-center mb-2 pb-2">
                                        <div class="col-md-2"><label>Phone No <span class="text-danger">:*</span></label>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="text" name="director_phone[]"
                                                class="form-control border-end-0" placeholder="Enter Phone Number"
                                                value="{{ $director['phone_no'] ?? '' }}" required>
                                            <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
                                        </div>
                                        <div class="col-md-2"><label>Email Address <span
                                                    class="text-danger">:*</span></label>
                                        </div>
                                        <div class="col-md-4 d-flex align-items-center">
                                            <input type="email" name="director_email[]"
                                                class="form-control border-end-0" placeholder="Enter Email"
                                                value="{{ $director['email_address'] ?? '' }}" required>
                                            <span class="icon-box border-start-0"><i class="bi bi-envelope"></i></span>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-items-center mb-2 pb-2">
                                        <div class="col-md-2"><label>Home Address <span
                                                    class="text-danger">:*</span></label>
                                        </div>
                                        <div class="col-md-10 d-flex align-items-center">
                                            <input type="text" name="director_home_address[]"
                                                class="form-control border-end-0" placeholder="Enter Home Address"
                                                value="{{ $director['home_address'] ?? '' }}" required>
                                            <span class="icon-box border-start-0"><i class="bi bi-geo-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <button type="button" id="add-director-btn" class="btn btn-primary bg_green_color">
                                <i class="bi bi-plus-circle me-1"></i> Add Director
                            </button>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Number <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="application_num" class="form-control border-end-0" readonly
                                    required value="{{ $appValue('application_num') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="service_type" class="form-control border-end-0" readonly
                                    required value="{{ $appValue('service_type') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="application_date" class="form-control border-end-0"
                                    value="{{ \Carbon\Carbon::parse($appValue('application_date'))->format('Y-m-d') }}"
                                    required>
                                <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="renewal_date" class="form-control border-end-0"
                                    value="{{ \Carbon\Carbon::parse($appValue('renewal_date'))->format('Y-m-d') }}"
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2">
                                <label>Brand <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="brand" class="form-control border-end-0"
                                    placeholder="Enter Brand " value="{{ old('brand', $application->brand ?? '') }}"
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Qty <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="qty" class="form-control border-end-0"
                                    placeholder="Enter Quantity" required value="{{ $appValue('qty') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-123"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Delivery Address</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="delivery_address" class="form-control border-end-0"
                                    placeholder="Enter Delivery Address" required
                                    value="{{ $appValue('delivery_address') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="comment" class="form-control border-end-0"
                                    placeholder="Enter Comments" required value="{{ $appValue('comment') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-chat-left-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center pt-1 mb-2">
                            <div class="col-md-2">
                                <label>EPOS System</label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <div class="form-check form-switch ms-1">
                                    <input class="form-check-input switcBtn mt-1" type="checkbox" id="eposSystem"
                                        name="epos_system" {{ $appValue('epos_system') ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2 text-muted" for="eposSystem">
                                        Enable
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Monthly Rental</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Debit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="debit_card" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter Debit Card" required value="{{ $appValue('debit_card') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Credit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="credit_card" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Credit Card" required
                                    value="{{ $appValue('credit_card') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Commercial Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="commercial_card" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Commercial Card" required
                                    value="{{ $appValue('commercial_card') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Authentication Fee</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="authentication_fee" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Authentication Fee" required
                                    value="{{ $appValue('authentication_fee') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>PCI</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="pci" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter PCI" required value="{{ $appValue('pci') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Rental</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="rental" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter Rental" required value="{{ $appValue('rental') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-cash"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Bank Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Name On Account</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="name_on_account" class="form-control border-end-0"
                                    placeholder="Enter Name On Account" required
                                    value="{{ $appValue('name_on_account') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="account_number" class="form-control border-end-0"
                                    placeholder="Enter Account Number" required
                                    value="{{ $appValue('account_number') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="sort_code" class="form-control border-end-0"
                                    placeholder="Enter Sort Code" required value="{{ $appValue('sort_code') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="iban" class="form-control border-end-0"
                                    placeholder="Enter IBAN" required value="{{ $appValue('iban') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="bic" class="form-control border-end-0"
                                    placeholder="Enter BIC" required value="{{ $appValue('bic') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="name_of_bank" class="form-control border-end-0"
                                    placeholder="Enter Bank Name" required value="{{ $appValue('name_of_bank') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    {{-- <div class="card shadow-sm border-0 mt-4">
                        <div class="card-body">

                            <div class="section-title"><span>KYC Verification</span></div>

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                                    </label>

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
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-building me-1 text-success"></i> Inside/Outside pics
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="insidePics" name="inside_outside_pics" hidden>
                                    </div>
                                    @if ($application->inside_outside_pics)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->inside_outside_pics) }}"
                                                target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-receipt me-1 text-warning"></i> Bill
                                    </label>

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
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-bank me-1 text-info"></i> Bank Statement
                                    </label>

                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('bankStatement').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="bankStatement" name="bank_statement" hidden>
                                    </div>
                                    @if ($application->bank_statement)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->bank_statement) }}"
                                                target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-bank me-1 text-info"></i> Additional Uploads
                                    </label>

                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('additionalUploads').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="additionalUploads" name="additional_uploads" hidden>
                                    </div>
                                    @if ($application->additional_uploads)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->additional_uploads) }}"
                                                target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}




                    {{-- 
                    <div class="card shadow-sm border-0 mt-4">
    <div class="card-body">

        <div class="section-title"><span>KYC Verification</span></div>

        <div class="row g-4">

            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="pictureId" name="picture_id[]" multiple hidden>
                </div>

                @if ($application->picture_id)
                    <div class="mt-2 text-muted small">
                        <div class="fw-semibold mb-1">Existing Files:</div>
                        @foreach (explode(',', $application->picture_id) as $file)
                            <div>{{ basename(trim($file)) }}</div>
                        @endforeach
                    </div>
                @endif
            </div>


            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-building me-1 text-success"></i> Inside/Outside pics
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="insidePics" name="inside_outside_pics[]" multiple hidden>
                </div>

                @if ($application->inside_outside_pics)
                    <div class="mt-2 text-muted small">
                        <div class="fw-semibold mb-1">Existing Files:</div>
                        @foreach (explode(',', $application->inside_outside_pics) as $file)
                            <div>{{ basename(trim($file)) }}</div>
                        @endforeach
                    </div>
                @endif
            </div>


            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-receipt me-1 text-warning"></i> Bill
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="billUpload" name="bill_upload[]" multiple hidden>
                </div>

                @if ($application->bill_upload)
                    <div class="mt-2 text-muted small">
                        <div class="fw-semibold mb-1">Existing Files:</div>
                        @foreach (explode(',', $application->bill_upload) as $file)
                            <div>{{ basename(trim($file)) }}</div>
                        @endforeach
                    </div>
                @endif
            </div>


            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-bank me-1 text-info"></i> Bank Statement
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('bankStatement').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="bankStatement" name="bank_statement[]" multiple hidden>
                </div>

                @if ($application->bank_statement)
                    <div class="mt-2 text-muted small">
                        <div class="fw-semibold mb-1">Existing Files:</div>
                        @foreach (explode(',', $application->bank_statement) as $file)
                            <div>{{ basename(trim($file)) }}</div>
                        @endforeach
                    </div>
                @endif
            </div>


            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-upload me-1 text-info"></i> Additional Uploads
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('additionalUploads').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="additionalUploads" name="additional_uploads[]" multiple hidden>
                </div>

                @if ($application->additional_uploads)
                    <div class="mt-2 text-muted small">
                        <div class="fw-semibold mb-1">Existing Files:</div>
                        @foreach (explode(',', $application->additional_uploads) as $file)
                            <div>{{ basename(trim($file)) }}</div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

 --}}


                    {{-- <div class="card shadow-sm border-0 mt-4">
    <div class="card-body">

        <div class="section-title"><span>KYC Verification</span></div>

        <div class="row g-4">


            <!-- Picture ID -->
            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="pictureId" name="picture_id[]" multiple hidden>
                </div>

                @if ($application->picture_id)

                <div class="mt-3 small">
                    <div class="fw-semibold mb-2">Existing Files:</div>

                    @foreach (explode(',', $application->picture_id) as $file)

                    @php
                        $file = trim($file);
                        $name = basename($file);
                    @endphp

                    <div class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                        <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-decoration-none text-dark text-truncate" style="max-width:75%">
                            <i class="bi bi-file-earmark text-primary"></i>
                            {{ strlen($name) > 25 ? substr($name,0,22).'...' : $name }}
                        </a>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger delete-existing-file"
                                data-column="picture_id"
                                data-file="{{ $file }}">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                    @endforeach

                </div>

                @endif
            </div>



            <!-- Inside Outside Pics -->
            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-building me-1 text-success"></i> Inside/Outside pics
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="insidePics" name="inside_outside_pics[]" multiple hidden>
                </div>

                @if ($application->inside_outside_pics)

                <div class="mt-3 small">
                    <div class="fw-semibold mb-2">Existing Files:</div>

                    @foreach (explode(',', $application->inside_outside_pics) as $file)

                    @php
                        $file = trim($file);
                        $name = basename($file);
                    @endphp

                    <div class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                        <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-decoration-none text-dark text-truncate" style="max-width:75%">
                            <i class="bi bi-file-earmark text-primary"></i>
                            {{ strlen($name) > 25 ? substr($name,0,22).'...' : $name }}
                        </a>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger delete-existing-file"
                                data-column="inside_outside_pics"
                                data-file="{{ $file }}">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                    @endforeach

                </div>

                @endif
            </div>



            <!-- Bill -->
            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-receipt me-1 text-warning"></i> Bill
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="billUpload" name="bill_upload[]" multiple hidden>
                </div>

                @if ($application->bill_upload)

                <div class="mt-3 small">
                    <div class="fw-semibold mb-2">Existing Files:</div>

                    @foreach (explode(',', $application->bill_upload) as $file)

                    @php
                        $file = trim($file);
                        $name = basename($file);
                    @endphp

                    <div class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                        <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-decoration-none text-dark text-truncate" style="max-width:75%">
                            <i class="bi bi-file-earmark text-primary"></i>
                            {{ strlen($name) > 25 ? substr($name,0,22).'...' : $name }}
                        </a>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger delete-existing-file"
                                data-column="bill_upload"
                                data-file="{{ $file }}">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                    @endforeach

                </div>

                @endif
            </div>



            <!-- Bank Statement -->
            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-bank me-1 text-info"></i> Bank Statement
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('bankStatement').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="bankStatement" name="bank_statement[]" multiple hidden>
                </div>

                @if ($application->bank_statement)

                <div class="mt-3 small">
                    <div class="fw-semibold mb-2">Existing Files:</div>

                    @foreach (explode(',', $application->bank_statement) as $file)

                    @php
                        $file = trim($file);
                        $name = basename($file);
                    @endphp

                    <div class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                        <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-decoration-none text-dark text-truncate" style="max-width:75%">
                            <i class="bi bi-file-earmark text-primary"></i>
                            {{ strlen($name) > 25 ? substr($name,0,22).'...' : $name }}
                        </a>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger delete-existing-file"
                                data-column="bank_statement"
                                data-file="{{ $file }}">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                    @endforeach

                </div>

                @endif
            </div>



            <!-- Additional Uploads -->
            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-upload me-1 text-info"></i> Additional Uploads
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('additionalUploads').click();">
                    <p class="text-muted mb-0">Drop files here to upload</p>
                    <input type="file" id="additionalUploads" name="additional_uploads[]" multiple hidden>
                </div>

                @if ($application->additional_uploads)

                <div class="mt-3 small">
                    <div class="fw-semibold mb-2">Existing Files:</div>

                    @foreach (explode(',', $application->additional_uploads) as $file)

                    @php
                        $file = trim($file);
                        $name = basename($file);
                    @endphp

                    <div class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                        <a href="{{ asset('storage/'.$file) }}" target="_blank" class="text-decoration-none text-dark text-truncate" style="max-width:75%">
                            <i class="bi bi-file-earmark text-primary"></i>
                            {{ strlen($name) > 25 ? substr($name,0,22).'...' : $name }}
                        </a>

                        <button type="button"
                                class="btn btn-sm btn-outline-danger delete-existing-file"
                                data-column="additional_uploads"
                                data-file="{{ $file }}">
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                    @endforeach

                </div>

                @endif
            </div>


        </div>
    </div>
</div> --}}

                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-body">

                            <div class="section-title"><span>KYC Verification</span></div>

                            <div class="row g-4">


                                <!-- Picture ID -->
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                                        <p class="text-muted mb-0" id="pictureIdText">Drop files here to upload</p>

                                        <input type="file" id="pictureId" name="picture_id[]" multiple hidden
                                            onchange="showFiles(this,'pictureIdPreview','pictureIdText')">
                                    </div>

                                    <!-- New Selected Files -->
                                    <div id="pictureIdPreview" class="mt-2"></div>

                                    <!-- Existing Files -->
                                    @if ($application->picture_id)
                                        <div class="mt-3 small">

                                            <div class="fw-semibold mb-2">
                                                Existing Files:
                                            </div>

                                            @foreach (explode(',', $application->picture_id) as $file)
                                                @php
                                                    $file = trim($file);
                                                    $name = basename($file);
                                                @endphp

                                                @if ($file)
                                                    <div
                                                        class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                            class="text-decoration-none text-dark text-truncate"
                                                            style="max-width:75%;">

                                                            <i class="bi bi-file-earmark text-primary me-1"></i>

                                                            {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete-existing-file"
                                                            data-column="picture_id" data-file="{{ $file }}">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                </div>



                                <!-- Inside Outside Pics -->
                                <div class="col-md-6">

                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-building me-1 text-success"></i>
                                        Inside/Outside Pics
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">

                                        <p class="text-muted mb-0" id="insidePicsText">
                                            Drop files here to upload
                                        </p>

                                        <input type="file" id="insidePics" name="inside_outside_pics[]" multiple
                                            hidden onchange="showFiles(this,'insidePicsPreview','insidePicsText')">

                                    </div>

                                    <!-- New Selected Files -->
                                    <div id="insidePicsPreview" class="mt-2"></div>

                                    <!-- Existing Files -->
                                    @if ($application->inside_outside_pics)
                                        <div class="mt-3 small">

                                            <div class="fw-semibold mb-2">
                                                Existing Files:
                                            </div>

                                            @foreach (explode(',', $application->inside_outside_pics) as $file)
                                                @php
                                                    $file = trim($file);
                                                    $name = basename($file);
                                                @endphp

                                                @if ($file)
                                                    <div
                                                        class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                            class="text-decoration-none text-dark text-truncate"
                                                            style="max-width:75%;">

                                                            <i class="bi bi-file-earmark text-primary me-1"></i>

                                                            {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete-existing-file"
                                                            data-column="inside_outside_pics"
                                                            data-file="{{ $file }}">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                </div>



                                <!-- Bill -->
                                <div class="col-md-6">

                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-receipt me-1 text-warning"></i> Bill
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">

                                        <p class="text-muted mb-0" id="billUploadText">
                                            Drop files here to upload
                                        </p>

                                        <input type="file" id="billUpload" name="bill_upload[]" multiple hidden
                                            onchange="showFiles(this,'billUploadPreview','billUploadText')">

                                    </div>

                                    <!-- Newly Selected Files -->
                                    <div id="billUploadPreview" class="mt-2"></div>

                                    <!-- Existing Files -->
                                    @if ($application->bill_upload)
                                        <div class="mt-3 small">

                                            <div class="fw-semibold mb-2">
                                                Existing Files:
                                            </div>

                                            @foreach (explode(',', $application->bill_upload) as $file)
                                                @php
                                                    $file = trim($file);
                                                    $name = basename($file);
                                                @endphp

                                                @if ($file)
                                                    <div
                                                        class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                            class="text-decoration-none text-dark text-truncate"
                                                            style="max-width:75%;">

                                                            <i class="bi bi-file-earmark text-primary me-1"></i>

                                                            {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete-existing-file"
                                                            data-column="bill_upload" data-file="{{ $file }}">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                </div>



                                <!-- Bank Statement -->
                                <div class="col-md-6">

                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-bank me-1 text-info"></i> Bank Statement
                                    </label>

                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('bankStatement').click();">

                                        <p class="text-muted mb-0" id="bankStatementText">
                                            Drop files here to upload
                                        </p>

                                        <input type="file" id="bankStatement" name="bank_statement[]" multiple hidden
                                            onchange="showFiles(this,'bankStatementPreview','bankStatementText')">

                                    </div>

                                    <!-- Newly Selected Files -->
                                    <div id="bankStatementPreview" class="mt-2"></div>

                                    <!-- Existing Files -->
                                    @if ($application->bank_statement)
                                        <div class="mt-3 small">

                                            <div class="fw-semibold mb-2">
                                                Existing Files:
                                            </div>

                                            @foreach (explode(',', $application->bank_statement) as $file)
                                                @php
                                                    $file = trim($file);
                                                    $name = basename($file);
                                                @endphp

                                                @if ($file)
                                                    <div
                                                        class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                            class="text-decoration-none text-dark text-truncate"
                                                            style="max-width:75%;">

                                                            <i class="bi bi-file-earmark text-primary me-1"></i>

                                                            {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete-existing-file"
                                                            data-column="bank_statement" data-file="{{ $file }}">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                </div>


                                <!-- Additional Uploads -->
                                <div class="col-md-6">

                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-upload me-1 text-info"></i>
                                        Additional Uploads
                                    </label>

                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('additionalUploads').click();">

                                        <p class="text-muted mb-0" id="additionalUploadsText">
                                            Drop files here to upload
                                        </p>

                                        <input type="file" id="additionalUploads" name="additional_uploads[]" multiple
                                            hidden
                                            onchange="showFiles(this,'additionalUploadsPreview','additionalUploadsText')">

                                    </div>

                                    <!-- New Files -->
                                    <div id="additionalUploadsPreview" class="mt-2"></div>

                                    <!-- Existing Files -->

                                    @if ($application->additional_uploads)
                                        <div class="mt-3 small">

                                            <div class="fw-semibold mb-2">
                                                Existing Files:
                                            </div>

                                            @foreach (explode(',', $application->additional_uploads) as $file)
                                                @php
                                                    $file = trim($file);
                                                    $name = basename($file);
                                                @endphp

                                                @if ($file)
                                                    <div
                                                        class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                                        <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                            class="text-decoration-none text-dark text-truncate"
                                                            style="max-width:75%">

                                                            <i class="bi bi-file-earmark text-primary me-1"></i>

                                                            {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete-existing-file"
                                                            data-column="additional_uploads"
                                                            data-file="{{ $file }}">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    @endif

                                </div>


                            </div>
                        </div>
                    </div>





                    <div class="mt-3 ">
                        <button type="submit" class="btn btn-primary bg_green_color">
                            <i class="bi bi-send me-1"></i> Update
                        </button>
                    </div>

                </form>


            </div>


            <script>
                // Add Director Logic
                document.getElementById('add-director-btn').addEventListener('click', function() {
                    const container = document.getElementById('director-container');
                    const firstBlock = container.querySelector('.director-block');

                    // Clone logic
                    const newBlock = firstBlock.cloneNode(true);

                    newBlock.querySelectorAll('input').forEach(input => input.value = '');

                    const removeBtn = newBlock.querySelector('.remove-director-btn');
                    removeBtn.classList.remove('d-none');

                    // Remove button click event
                    removeBtn.addEventListener('click', function() {
                        newBlock.remove();
                        updateIndexes(); // Numbers update karein
                    });

                    container.appendChild(newBlock);
                    updateIndexes();
                });


                function updateIndexes() {
                    const blocks = document.querySelectorAll('.director-block');
                    blocks.forEach((block, index) => {
                        block.querySelector('.director-label').innerText = `Director #${index + 1}`;
                    });
                }
            </script>







            <script>
                document.addEventListener("click", function(e) {

                    let btn = e.target.closest(".delete-existing-file");

                    if (!btn) return;

                    if (!confirm("Delete this file?")) return;


                    fetch("{{ route('admin.applications.delete.file', $application->id) }}", {

                            method: "DELETE",

                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json",
                                "Content-Type": "application/json"
                            },

                            body: JSON.stringify({

                                column: btn.dataset.column,

                                file: btn.dataset.file

                            })

                        })

                        .then(res => res.json())

                        .then(function(res) {

                            if (res.success) {

                                btn.closest(".existing-file-item").remove();

                            } else {

                                alert("Unable to delete file.");

                            }

                        })

                        .catch(function() {

                            alert("Something went wrong.");

                        });

                });



                let fileStore = {};

                function showFiles(input, previewId, textId) {

                    const inputId = input.id;

                    if (!fileStore[inputId]) {
                        fileStore[inputId] = [];
                    }

                    Array.from(input.files).forEach(file => {

                        fileStore[inputId].push(file);

                    });

                    renderFiles(inputId, previewId, textId);
                }

                function renderFiles(inputId, previewId, textId) {

                    const preview = document.getElementById(previewId);

                    const text = document.getElementById(textId);

                    preview.innerHTML = "";

                    if (!fileStore[inputId] || fileStore[inputId].length === 0) {

                        text.innerHTML = "Drop files here to upload";

                        return;
                    }

                    text.innerHTML = fileStore[inputId].length + " file(s) selected";

                    let dataTransfer = new DataTransfer();

                    fileStore[inputId].forEach(function(file, index) {

                        dataTransfer.items.add(file);

                        let row = document.createElement("div");

                        row.className = "d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2";

                        let fileName = file.name.length > 25 ?
                            file.name.substring(0, 22) + "..." :
                            file.name;

                        row.innerHTML = `
                                        <span class="text-truncate" style="max-width:75%">
                                        <i class="bi bi-file-earmark text-success me-1"></i>
                                        ${fileName}
                                    </span>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="removeFile('${inputId}',${index},'${previewId}','${textId}')">

                                        <i class="bi bi-x-lg"></i>

                                    </button>
                                `;

                        preview.appendChild(row);

                    });

                    document.getElementById(inputId).files = dataTransfer.files;

                }

                function removeFile(inputId, index, previewId, textId) {

                    fileStore[inputId].splice(index, 1);

                    let dataTransfer = new DataTransfer();

                    fileStore[inputId].forEach(file => {

                        dataTransfer.items.add(file);

                    });

                    document.getElementById(inputId).files = dataTransfer.files;

                    renderFiles(inputId, previewId, textId);

                }
            </script>




            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



        </div>
    @endsection
