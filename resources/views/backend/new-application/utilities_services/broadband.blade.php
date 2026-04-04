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
            <div class="d-flex flex-wrap gap-3 mb-24">

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    style="background-color: #f3e5ab; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">Remaining Leads</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">0</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    style="background-color: #d4e7c5; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">All Sales</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">0</span>
                </div>

                <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
                    style="background-color: #d1d9e9; padding: 10px 20px; border-radius: 12px; min-width: 320px">
                    <span class="fw-semibold text-dark" style="font-size: 15px;">This Month Sales</span>
                    <span class="fw-bold text-dark" style="font-size: 18px;">0</span>
                </div>
            </div>

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

                    <div class="row g-3 flex-grow-1">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
                                style="background: linear-gradient(90deg, #bbd2ff 0%, #97abff 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
                                <span class="fw-bold text-white" style="font-size: 13px;">Today</span>
                                <span class="fw-bold text-white" style="font-size: 16px;">0</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
                                style="background: linear-gradient(90deg, #aff1da 0%, #11d39d 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
                                <span class="fw-bold text-white" style="font-size: 13px;">This Week</span>
                                <span class="fw-bold text-white" style="font-size: 16px;">0</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
                                style="background: linear-gradient(90deg, #ffdde1 0%, #ee9ca7 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
                                <span class="fw-bold text-white" style="font-size: 13px;">This Month</span>
                                <span class="fw-bold text-white" style="font-size: 16px;">0</span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
                                style="background: linear-gradient(90deg, #fff1eb 0%, #fdbb2d 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
                                <span class="fw-bold text-white" style="font-size: 13px;">All</span>
                                <span class="fw-bold text-white" style="font-size: 16px;">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- HEADER -->

  <form>
                    <!-- APPLICATION Form -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 "><label>Application Agent <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select">
                                    <option disabled selected>Select Agent</option>
                                    <option>Ali Hassan</option>
                                    <option>Usman Khan</option>
                                    <option>Sara Ahmed</option>
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
                                <input type="text" class="form-control border-end-0" placeholder="Enter company name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Landline No <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" placeholder="Enter landline number">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Contact Person Name <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" placeholder="Enter person name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Company Reg No <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" placeholder="Enter company reg no">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Address <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0"
                                    placeholder="Enter business address">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" class="form-control border-end-0" placeholder="example@email.com">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Unit <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" placeholder="Enter unit">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Home Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" placeholder="Enter home address">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-house"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Director DOB <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Mobile No <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" placeholder="03XXXXXXXXX">
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
                            <div class="col-md-2"><label>Application Num <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" value="AUTO-001" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" value="Broadband" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                           <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option disabled selected>Select Brand</option>
                                    <option>Verifone</option>
                                    <option>Ingenico</option>
                                    <option>PAX</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>
                        </div>



                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-10 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-chat-left-text"></i>
                                </span>
                            </div>
                        </div>

                    </div>





                    <!-- BANK DETAILS AT BOTTOM -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Bank Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <!-- Name On Account -->
                            <div class="col-md-2"><label>Name On Account</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter Name On Account">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <!-- Account Number -->
                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter Account Number">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <!-- Sort Code -->
                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter Sort Code">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <!-- IBAN -->
                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter IBAN">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <!-- BIC -->
                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter BIC">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <!-- Name Of Bank -->
                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter Bank Name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                        </div>
                    </div>


                    <!-- KYC VERIFICATION SECTION -->
                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-body">

                            <!-- Title -->
                            <div class="section-title"><span>KYC Verification</span></div>

                            <div class="row g-4">

                                <!-- Picture ID -->
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="pictureId" name="picture_id" hidden>
                                    </div>
                                </div>

                                <!-- Inside/Outside Pics -->
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-building me-1 text-success"></i> Inside/Outside pics
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="insidePics" name="inside_outside_pics" hidden>
                                    </div>
                                </div>

                                <!-- Bill -->
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-receipt me-1 text-warning"></i> Bill
                                    </label>

                                    <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="billUpload" name="bill" hidden>
                                    </div>
                                </div>

                                <!-- Bank Statement -->
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

                            </div>
                        </div>
                    </div>


                    <!-- SUBMIT BUTTON -->
                    <div class="mt-3 ">
                        <button class="btn btn-primary bg_green_color">
                            <i class="bi bi-send me-1"></i> Save
                        </button>
                    </div>





                </form>





            </div>





        </div>
    @endsection
