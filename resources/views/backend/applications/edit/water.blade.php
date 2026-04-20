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
        ? collect(old('director_name'))->map(function ($name, $index) {
            return [
                'director_name' => $name,
                'date_of_birth' => old('director_dob_array.' . $index),
                'phone_no' => old('director_phone.' . $index),
                'email_address' => old('director_email.' . $index),
                'home_address' => old('director_home_address.' . $index),
            ];
        })->values()->all()
        : ($application->directors->map(function ($director) {
            return [
                'director_name' => $director->director_name,
                'date_of_birth' => $director->date_of_birth,
                'phone_no' => $director->phone_no,
                'email_address' => $director->email_address,
                'home_address' => $director->home_address,
            ];
        })->values()->all() ?: [[
            'director_name' => '',
            'date_of_birth' => '',
            'phone_no' => '',
            'email_address' => '',
            'home_address' => '',
        ]]);

    $gasMeters = old('meters')
        ?: ($application->meters->where('meter_type', 'gas')->map(function ($meter) {
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
        })->values()->toArray() ?: [[
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
        ]]);

    $elecMeters = old('elec_meters')
        ?: ($application->meters->where('meter_type', 'electricity')->map(function ($meter) {
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
        })->values()->toArray() ?: [[
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
        ]]);
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
                        <i class="bi bi-ui-checks-grid me-1"></i>Edit Application (Water)
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




                <form id="waterForm" action="{{ route('admin.applications.update', $application->id) }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- APPLICATION Form -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 ">
                                <label>Application Agent <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="application_agent" required>
                                    <option disabled {{ $appValue('application_agent') ? '' : 'selected' }}>Select Agent</option>
                                    <option {{ (string) $appValue('application_agent') === 'Ali Hassan' ? 'selected' : '' }}>Ali Hassan</option>
                                    <option {{ (string) $appValue('application_agent') === 'Usman Khan' ? 'selected' : '' }}>Usman Khan</option>
                                    <option {{ (string) $appValue('application_agent') === 'Sara Ahmed' ? 'selected' : '' }}>Sara Ahmed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CUSTOMER DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Detail</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="company_name" class="form-control border-end-0"
                                    placeholder="Enter company name" required value="{{ $appValue('company_name') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Landline No <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="landline_no" class="form-control border-end-0"
                                    placeholder="Enter landline number" required value="{{ $appValue('landline_no') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Contact Person Name <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="contact_person_name" class="form-control border-end-0"
                                    placeholder="Enter person name" required value="{{ $appValue('contact_person_name') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Company Reg No <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="company_reg_no" class="form-control border-end-0"
                                    placeholder="Enter company reg no" required value="{{ $appValue('company_reg_no') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Address <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="business_address" class="form-control border-end-0"
                                    placeholder="Enter business address" required value="{{ $appValue('business_address') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" name="email_address" class="form-control border-end-0"
                                    placeholder="example@email.com" required value="{{ $appValue('email_address') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Unit <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="unit" class="form-control border-end-0"
                                    placeholder="Enter unit" required value="{{ $appValue('unit') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Home Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="home_address" class="form-control border-end-0"
                                    placeholder="Enter home address" required value="{{ $appValue('home_address') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-house"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Director DOB <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="director_dob_single" class="form-control border-end-0" required value="{{ $appValue('director_dob_single') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Mobile No <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="mobile_no" class="form-control border-end-0"
                                    placeholder="03XXXXXXXXX" required value="{{ $appValue('mobile_no') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Number <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="application_num" class="form-control border-end-0"
                                    readonly required value="{{ $appValue('application_num') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" name="service_type"
                                    readonly required value="{{ $appValue('service_type') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="application_date" class="form-control border-end-0" required value="{{ $appValue('application_date') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>SPID <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="spid" class="form-control border-end-0" required value="{{ $appValue('spid') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-123"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0" name="brand" required>
                                    <option disabled {{ $appValue('brand') ? '' : 'selected' }}>Select Brand</option>
                                    <option {{ (string) $appValue('brand') === 'Verifone' ? 'selected' : '' }}>Verifone</option>
                                    <option {{ (string) $appValue('brand') === 'Ingenico' ? 'selected' : '' }}>Ingenico</option>
                                    <option {{ (string) $appValue('brand') === 'PAX' ? 'selected' : '' }}>PAX</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-10 d-flex align-items-center">
                                <input type="text" name="comment" class="form-control border-end-0" value="{{ $appValue('comment') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-chat-left-text"></i>
                                </span>
                            </div>
                        </div>

                    </div>

                    <!-- BANK DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Bank Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Name On Account</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="name_on_account" class="form-control border-end-0"
                                    placeholder="Enter Name On Account" required value="{{ $appValue('name_on_account') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="account_number" class="form-control border-end-0"
                                    placeholder="Enter Account Number" required value="{{ $appValue('account_number') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="sort_code" class="form-control border-end-0" placeholder="Enter Sort Code"
                                    required value="{{ $appValue('sort_code') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="iban" class="form-control border-end-0" placeholder="Enter IBAN"
                                    required value="{{ $appValue('iban') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="bic" class="form-control border-end-0" placeholder="Enter BIC" value="{{ $appValue('bic') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="name_of_bank" class="form-control border-end-0"
                                    placeholder="Enter Bank Name" required value="{{ $appValue('name_of_bank') }}">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    <!-- KYC -->
                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-body">

                            <div class="section-title"><span>KYC Verification</span></div>

                            <div class="row g-4">

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Picture ID</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="pictureId" name="picture_id" hidden>
                                    </div>
                                    @if ($application->picture_id)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->picture_id) }}" target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Inside/Outside pics</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="insidePics" name="inside_outside_pics" hidden>
                                    </div>
                                    @if ($application->inside_outside_pics)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->inside_outside_pics) }}" target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Bill</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="billUpload" name="bill_upload" hidden>
                                    </div>
                                    @if ($application->bill_upload)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->bill_upload) }}" target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Bank Statement</label>
                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('bankStatement').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="bankStatement" name="bank_statement" hidden>
                                    </div>
                                    @if ($application->bank_statement)
                                        <div class="mt-2">
                                            <a href="{{ $storedFile($application->bank_statement) }}" target="_blank">View Current File</a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="mt-3 ">
                        <button class="btn btn-primary bg_green_color">
                            <i class="bi bi-send me-1"></i> Update
                        </button>
                    </div>

                </form>


            </div>



            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        </div>
    @endsection
