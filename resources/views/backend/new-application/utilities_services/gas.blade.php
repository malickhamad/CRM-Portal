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
                <div class="mb-3 px-3 py-2 bg-white border rounded" >
                    <h6 class="fw-bold mb-0 green_color">
                        <i class="bi bi-ui-checks-grid me-1"></i> Application Form (Gas)
                    </h6>
                </div>

                <form>
                    <!-- APPLICATION INFORMATION -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Information</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 "><label>Application Agent *</label></div>
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

                    <!-- CUSTOMER DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Details</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter company name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter trading name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shop"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option>Select</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Business Nature *</label></div>

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
                            <div class="col-md-2"><label>Title *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0">
                                    <option>Mr</option>
                                    <option>Mrs</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="Enter full name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position *</label></div>

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

                            <div class="col-md-2"><label>Email *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" class="form-control border-end-0" placeholder="example@email.com">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Phone *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" placeholder="03XXXXXXXXX">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT / TAX Number</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-receipt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address</label></div>

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

                            <div class="row g-3 align-items-center mb-2 pb-2">
                                <div class="col-md-2"><label>Director Name</label></div>
                                <div class="col-md-4 d-flex align-items-center">
                                    <input class="form-control border-end-0" placeholder="Enter Director Name">
                                    <span class="icon-box border-start-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                </div>

                                <div class="col-md-2"><label>Date Of Birth</label></div>
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

                                <div class="col-md-2"><label>Email Address</label></div>
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

                        </div>
                    </div>

                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Number *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" value="AUTO-001" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" value="Gas" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Renewal Date *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Brand *</label></div>

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

                            <div class="col-md-2"><label>Qty *</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-123"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Delivery Address</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0"></input>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0"></input>
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
                                        name="epos_system" value="1">
                                    <label class="form-check-label ms-2 text-muted" for="eposSystem">
                                        Enable
                                    </label>
                                </div>
                            </div>


                        </div>
                    </div>



                    <!-- MONTHLY RENTAL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Monthly Rental</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Debit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0" placeholder="Enter Debit Card">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Credit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0" placeholder="Enter Credit Card">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Commercial Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0"
                                    placeholder="Enter Commercial Card">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Authentication Fee</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0"
                                    placeholder="Enter Authentication Fee">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>PCI</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0" placeholder="Enter PCI">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Rental</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" class="form-control border-end-0" placeholder="Enter Rental">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-cash"></i>
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
                        <button class="btn btn-primary">
                            <i class="bi bi-send me-1"></i> Submit Application
                        </button>
                    </div>





                </form>


            </div>
        </div>

        <style>
       
            .green_color {
                color: #14532d !important;
            }

              .bg_green_color {
                background-color: #14532d !important;
                color: white !important;
            }
            

            .form-section {
                background: #fff;
                border: 1px solid #e2e5ea;
                border-radius: 6px;
                padding: 12px;
            }

            .section-title {
                position: relative;
                text-align: center;
                font-size: 17px;
                font-weight: 700;
                color: #2f3e5c;
                margin-bottom: 14px;
            }

            .section-title::before,
            .section-title::after {
                content: "";
                position: absolute;
                top: 50%;
                width: 32%;
                height: 1px;
                background: #dcdfe4;
            }

            .section-title::before {
                left: 0;
            }

            .section-title::after {
                right: 0;
            }

            .section-title span {
                background: #fff;
                padding: 0 12px;
                color: #14532d;
            }

            .form-control,
            .form-select {
                height: 32px !important;
                min-height: 32px !important;
                padding: 4px 8px !important;
                font-size: 12px;
            }

            textarea.form-control {
                height: 64px !important;
                resize: none;
            }

            label {
                font-size: 14px;
                font-weight: 600;
                color: #444;
                margin-bottom: 0;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #14532d;
                box-shadow: 0 0 0 2px rgba(54, 177, 85, 0.25) !important;
            }

            .btn-primary {
                background: #14532d;
                border: none;
                font-size: 14px;
                padding: 9px;
                font-weight: 600;
            }

            .form-control.border-end-0 {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }

            .icon-box {
                background: #f1f3f5;
                border: 1px solid #ced4da;
                border-left: none;
                padding: 0 8px;
                height: 32px;
                display: flex;
                align-items: center;
                border-radius: 0 4px 4px 0;
                font-size: 12px;
            }

            .switcBtn {
                height: 16px;
                width: 30px;
            }

            .kyc-upload-box {
                height: 170px;
                border: 2px dashed #dcdcdc;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: repeating-linear-gradient(45deg,
                        #fafafa,
                        #fafafa 10px,
                        #f5f5f5 10px,
                        #f5f5f5 20px);
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .kyc-upload-box:hover {
                border-color: #14532d;
                background: #fafffc;
            }
        </style>
    @endsection
