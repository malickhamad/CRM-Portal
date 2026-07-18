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
                        <i class="bi bi-ui-checks-grid me-1"></i>New Application (Broadband)
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



                <form id="broadbrandForm" action="{{ route('admin.applications.store') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf

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
                                <input type="text" name="company_name" class="form-control border-end-0"
                                    placeholder="Enter company name" required>
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>

                            <div class="col-md-2"><label>Landline No <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="landline_no" class="form-control border-end-0"
                                    placeholder="Enter landline number" required>
                                <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Contact Person Name <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="contact_person_name" class="form-control border-end-0"
                                    placeholder="Enter person name" required>
                                <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                            </div>

                            <div class="col-md-2"><label>Company Reg No <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="company_reg_no" class="form-control border-end-0"
                                    placeholder="Enter company reg no" required>
                                <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Address <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="business_address" class="form-control border-end-0"
                                    placeholder="Enter business address" required>
                                <span class="icon-box border-start-0"><i class="bi bi-geo-alt"></i></span>
                            </div>

                            <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" name="email_address" class="form-control border-end-0"
                                    placeholder="Enter email" required>
                                <span class="icon-box border-start-0"><i class="bi bi-envelope"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Unit <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="unit" class="form-control border-end-0"
                                    placeholder="Enter unit" required>
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>

                            <div class="col-md-2"><label>Home Address <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="home_address" class="form-control border-end-0"
                                    placeholder="Enter home address" required>
                                <span class="icon-box border-start-0"><i class="bi bi-house"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Director DOB <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="director_dob_single" class="form-control border-end-0"
                                    required>
                                <span class="icon-box border-start-0"><i class="bi bi-calendar"></i></span>
                            </div>

                            <div class="col-md-2"><label>Mobile No <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="mobile_no" class="form-control border-end-0"
                                    placeholder="03XXXXXXXXX" required>
                                <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
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
                                <input type="text" name="service_type" class="form-control border-end-0"
                                    value="Broadband" readonly required>
                                <span class="icon-box border-start-0"><i class="bi bi-credit-card"></i></span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="application_date" class="form-control border-end-0" required>
                                <span class="icon-box border-start-0"><i class="bi bi-calendar"></i></span>
                            </div>

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
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Comment</label></div>
                            <div class="col-md-10 d-flex align-items-center">
                                <input type="text" name="comment" class="form-control border-end-0">
                                <span class="icon-box border-start-0"><i class="bi bi-chat-left-text"></i></span>
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
                                    placeholder="Enter Name On Account">
                                <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="account_number" class="form-control border-end-0"
                                    placeholder="Enter Account Number">
                                <span class="icon-box border-start-0"><i class="bi bi-hash"></i></span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="sort_code" class="form-control border-end-0" placeholder="Enter Sort Code">
                                <span class="icon-box border-start-0"><i class="bi bi-diagram-3"></i></span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="iban" class="form-control border-end-0" placeholder="Enter IBAN">
                                <span class="icon-box border-start-0"><i class="bi bi-credit-card-2-front"></i></span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="bic" class="form-control border-end-0" placeholder="Enter BIC">
                                <span class="icon-box border-start-0"><i class="bi bi-bank"></i></span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input name="name_of_bank" class="form-control border-end-0"
                                    placeholder="Enter Bank Name">
                                <span class="icon-box border-start-0"><i class="bi bi-building"></i></span>
                            </div>

                        </div>
                    </div>

                      {{-- KYC Section --}}
                    @include('backend.new-application.kyc_section')


                    <!-- SUBMIT -->
                    <div class="mt-3">
                        <button class="btn btn-primary bg_green_color" type="submit">
                            <i class="bi bi-send me-1"></i> Save
                        </button>
                    </div>

                </form>



            </div>



            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


        </div>
    @endsection
