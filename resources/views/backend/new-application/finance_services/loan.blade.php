@extends('backend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
                        <i class="bi bi-ui-checks-grid me-1"></i> Application Form (Loan)
                    </h6>
                </div>

                <form>
                    <!-- APPLICATION Form -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 "><label>Application Agent <span class="text-danger">:*</span></label></div>
                            <div class="col-md-9">
                                <select class="form-select">
                                    <option disabled selected>Please Select</option>
                                    <option>Ali Hassan</option>
                                    <option>Usman Khan</option>
                                    <option>Sara Ahmed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CUSTOMER DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Details</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter company name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name<span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter trading name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shop"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity<span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option>Select</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Business Nature <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option>Select</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-briefcase"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Title <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option>Mr</option>
                                    <option>Mrs</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter full name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option>Owner</option>
                                    <option>Director</option>
                                    <option>Manager</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-people"></i>
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
                            <div class="col-md-2"><label>Phone Number<span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="03XXXXXXXXX">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-receipt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <!-- DIRECTOR DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Director Details</span></div>

                        <div class="director-block">

                            <p class="bg-dark fs-14 text-white fw-semibold px-3 py-2 d-inline-block rounded">
                                Director #1
                            </p>
                            <div class="row g-3 align-items-center mb-2 pb-2">
                                <div class="col-md-2"><label>Director Name</label></div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <input class="form-control border-end-0" placeholder="Enter Director Name">
                                    <span class="icon-box border-start-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                </div>

                                <div class="col-md-2"><label>Date Of Birth <span class="text-danger">:*</span></label></div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <input type="date" class="form-control border-end-0">
                                    <span class="icon-box border-start-0">
                                        <i class="bi bi-calendar-date"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center mb-2 pb-2">
                                <div class="col-md-2"><label>Phone No</label></div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <input class="form-control border-end-0" placeholder="Enter Phone Number">
                                    <span class="icon-box border-start-0">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                </div>

                                <div class="col-md-2"><label>Email </label></div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <input type="email" class="form-control border-end-0" placeholder="Enter Email">
                                    <span class="icon-box border-start-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center mb-2 pb-2">
                                <div class="col-md-2"><label>Home Address</label></div>
                                <div class="col-md-10 d-flex align-items-center">
                                    <input class="form-control border-end-0" placeholder="Enter Home Address">
                                    <span class="icon-box border-start-0">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                </div>
                            </div>


                            <div class="mt-3">
                                <button type="button" class="btn btn-primary bg_green_color">
                                    <i class="bi bi-plus-circle me-1"></i> Add Director
                                </button>
                            </div>


                        </div>
                    </div>

                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Num <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" value="AUTO-001" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" value="Loan" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mb-2">

                            <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option disabled selected>Please Select</option>
                                    <option>Verifone</option>
                                    <option>Ingenico</option>
                                    <option>PAX</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>


                        </div>


                        <p class="fs-13 my-2"> Have you using Card Machine.If yes which one</p>

                        <div class="row g-3 align-items-center mb-2">


                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-10 d-flex align-items-center">
                                <input class="form-control border-end-0">
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

                                <!-- Additional Uploads Statement -->
                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">
                                        <i class="bi bi-bank me-1 text-info"></i> Additional Uploads
                                    </label>

                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('additionalUploads').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="additionalUploads" name="bank_statement" hidden>
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
