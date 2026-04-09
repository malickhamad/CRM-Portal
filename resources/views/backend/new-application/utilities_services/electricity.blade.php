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
                        <i class="bi bi-ui-checks-grid me-1"></i> Application Form (Electricity)
                    </h6>
                </div>

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

                            <div class="col-md-2"><label>Trading Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-pencil"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <select class="form-select">
                                    <option disabled selected>Please Select</option>
                                </select>
                            </div>

                            <div class="col-md-2"><label>Business Nature <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <input type="text" class="form-control border-end-0">
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Title <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <select class="form-select">
                                    <option disabled selected>Please Select</option>
                                </select>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4">
                                <input type="text" class="form-control border-end-0">
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <select class="form-select">
                                    <option disabled selected>Please Select</option>
                                </select>
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
                            <div class="col-md-2"><label>Phone Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Postal Code <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <input type="text" class="form-control border-end-0">
                            </div>
                        </div>

                    </div>


                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Num <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" value="AUTO-001" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" value="Electricity" readonly>
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

                            <div class="col-md-2"><label>Annual Consumption <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lightning"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <input type="date" class="form-control border-end-0">
                            </div>

                            <div class="col-md-2"><label>Electric Email <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Company Registration No <span
                                        class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Commercial/Resident <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4">
                                <select class="form-select">
                                    <option disabled selected>Select Brand</option>
                                    <option>Verifone</option>
                                    <option>Ingenico</option>
                                    <option>PAX</option>
                                </select>
                            </div>

                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-10 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-chat-left-text"></i>
                                </span>
                            </div>
                        </div>

                    </div>



                    <!-- Electricity DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Electricity Details</span></div>

                        <div class="row">
                            <div class="col-auto">
                                <p class="bg-dark fs-14 text-white fw-semibold px-3 py-1 rounded mb-0">
                                    Meter #1
                                </p>
                            </div>
                        </div>
                        <!-- Row 1 -->
                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Supplier Name *</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>MPAN Top Line</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="col-md-2"><label>MPAN Bottom Line</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>


                            <div class="col-md-2"><label>Con. Duration</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-clock"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Offer Rate</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-tag"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Appears On Bill</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Customer No.</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Meter Serial No.</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-upc-scan"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Row 5 -->
                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Current Meter Read</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lightning"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Mode</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <!-- Row 6 -->
                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Last Bill Amount</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-primary bg_green_color">
                                <i class="bi bi-plus-circle me-1"></i> Add More Meter
                            </button>
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





                    <!-- OTHER DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Other Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Bill Payment Method</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Landlord Name</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Director D.O.B</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of New Customer</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row gy-1 gx-3 align-items-center">
                            <div class="col-md-2"><label>Status Taken Date</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-check"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Password</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="password" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Customer History</label></div>
                            <div class="col-md-10 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-clock-history"></i>
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
