@extends('backend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body bg-light position-relative pt-5">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">New Application</h6>
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
                        <i class="bi bi-ui-checks-grid me-1"></i>New Application (Gas)
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




                <form id="applicationForm" action="{{ route('admin.applications.store') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- APPLICATION Form -->
                    <input type="hidden" name="service_type" value="Gas">

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
                                    name="company_name" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="trading_name" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-pencil"></i>
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
                                <input type="text" class="form-control" name="phone_number" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span
                                        class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="companies_house_number" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="vat_tax_number" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="trading_address" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Postal Code <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <input type="text" class="form-control" name="postal_code" required>
                            </div>
                        </div>

                    </div>


                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Num <span class="text-danger">:*</span></label></div>

                           <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="application_num" class="form-control border-end-0"
                                    value="{{ $nextNum }}" readonly required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" value="Gas" name="service_type" readonly
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control" name="application_date" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Annual Consumption <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="annual_consumption" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lightning"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <input type="date" class="form-control" name="renewal_date" required>
                            </div>

                            <div class="col-md-2"><label>Gas Email <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" class="form-control" name="utility_email" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Company Registration No <span
                                        class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="company_reg_no" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Commercial/Resident <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" name="commercial_resident" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
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
                                <input type="text" class="form-control" name="comment">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-chat-left-text"></i>
                                </span>
                            </div>
                        </div>

                    </div>


                    <!-- GAS DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Gas Details</span></div>

                        <div id="meter-container">
                            <div class="meter-block mb-3 border-bottom pb-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p class="bg-dark fs-14 text-white fw-semibold px-3 py-1 rounded mb-0 meter-label">
                                        Meter #1
                                    </p>
                                    <button type="button" class="btn btn-danger btn-sm remove-meter-btn d-none"
                                        style="padding: 2px 8px; font-size: 12px;">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>

                                <div class="row align-items-center">

 <div class="col-md-2"><label>Meter Type</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control" value="gas" name="meters[0][meter_type]" readonly
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>


                                    <div class="col-md-2"><label class="mb-0">Supplier Name</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][supplier_name]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">MPRN No</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][mprn_no]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Offer Rate</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][offer_rate]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-tag"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Con. Duration</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][contract_duration]"
                                            required>
                                        <span class="icon-box border-start-0"><i class="bi bi-clock"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Uplift</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][uplift]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-percent"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Customer No</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][customer_no]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-card-text"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Name Appears On Bill</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][bill_name]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Current Meter Read</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][current_meter_read]"
                                            required>
                                        <span class="icon-box border-start-0"><i class="bi bi-droplet"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Meter Serial No</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][meter_serial_no]"
                                            required>
                                        <span class="icon-box border-start-0"><i class="bi bi-upc-scan"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Last Bill Amount</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][last_bill_amount]"
                                            required>
                                        <span class="icon-box border-start-0"><i class="bi bi-currency-dollar"></i></span>
                                    </div>

                                    <div class="col-md-2"><label class="mb-0">Mode</label></div>
                                    <div class="col-md-4 d-flex align-items-center mb-1">
                                        <input class="form-control border-end-0" name="meters[0][mode]" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-credit-card"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="button" id="add-meter-btn" class="btn btn-primary bg_green_color">
                                <i class="bi bi-plus-circle me-1"></i> Add More Meter
                            </button>
                        </div>
                    </div>


                    <!-- BANK DETAILS AT BOTTOM -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Bank Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Name On Account</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" placeholder="Enter Name On Account" name="name_on_account"
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" placeholder="Enter Account Number" name="account_number"
                                    required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" placeholder="Enter Sort Code" name="sort_code">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" placeholder="Enter IBAN" name="iban">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" placeholder="Enter BIC" name="bic">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" placeholder="Enter Bank Name" name="name_of_bank">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                        </div>
                    </div>


                    <!-- OTHER DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Other Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>Bill Payment Method</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="bill_payment_method">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Landlord Name</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="landlord_name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Director D.O.B</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control" name="director_dob_single">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of New Customer</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="name_of_new_customer" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Status Taken Date</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control" name="status_taken_date">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-check"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Password</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="password" class="form-control" name="password">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Customer History</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control" name="customer_history">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-clock-history"></i>
                                </span>
                            </div>

                        </div>
                    </div>


                    <!-- KYC VERIFICATION SECTION -->
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
                                        <input type="file" id="pictureId" name="picture_id" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-building me-1 text-success"></i> Inside/Outside pics
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="insidePics" name="inside_outside_pics" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-receipt me-1 text-warning"></i> Bill
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="billUpload" name="bill_upload" hidden>
                                    </div>
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
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-bank me-1 text-info"></i> Additional Uploads
                                    </label>

                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('additionalUploads').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="additionalUploads" name="additional_uploads" hidden
                                            required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- SUBMIT BUTTON -->
                    <div class="mt-3 ">
                        <button class="btn btn-primary bg_green_color" required>
                            <i class="bi bi-send me-1"></i> Save
                        </button>
                    </div>

                </form>

            </div>
            <script>
                document.getElementById('add-meter-btn').addEventListener('click', function() {
    const container = document.getElementById('meter-container');
    const firstBlock = container.querySelector('.meter-block');

    // Clone
    const newBlock = firstBlock.cloneNode(true);

    // Reset values for all inputs in the cloned block
    newBlock.querySelectorAll('input').forEach(input => {
        input.value = ''; // Clear the input fields
    });

    // Set the default 'gas' value for the meter type in the cloned block
    const meterTypeInput = newBlock.querySelector('input[name^="meters"][name$="[meter_type]"]');
    if (meterTypeInput) {
        meterTypeInput.value = 'gas'; // Set the 'gas' value to the cloned meter type input
    }

    // Manage Remove Button
    const removeBtn = newBlock.querySelector('.remove-meter-btn');
    removeBtn.classList.remove('d-none');
    removeBtn.onclick = function() {
        newBlock.remove();
        updateMeterIndexes();
    };

    container.appendChild(newBlock);
    updateMeterIndexes();
});

function updateMeterIndexes() {
    const blocks = document.querySelectorAll('.meter-block');
    blocks.forEach((block, index) => {
        // Update Label (Meter #1, Meter #2...)
        block.querySelector('.meter-label').innerText = `Meter #${index + 1}`;

        // Update Input Names (meters[0], meters[1]...)
        block.querySelectorAll('input').forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                // This regex will replace the index [0], [1], etc. in the input's name
                const newName = name.replace(/meters\[\d+\]/, `meters[${index}]`);
                input.setAttribute('name', newName);
            }
        });
    });
}
            </script>

            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        </div>
    @endsection
