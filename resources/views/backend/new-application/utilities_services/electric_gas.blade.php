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
                        <i class="bi bi-ui-checks-grid me-1"></i> Application Form (Electric Gas)
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
                                <input type="text" class="form-control border-end-0" value="Electric Gas" readonly>
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

                        <!-- Row 1 -->
                        <div class="row gy-1 gx-3 align-items-center">

                                 <div class="row">
                                <div class="col-auto">
                                    <p class="bg-dark fs-14 text-white fw-semibold px-3 py-1 rounded mb-0">
                                        Meter #1
                                    </p>
                                </div>
                            </div>

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


                    <!-- Gas DETAILS -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Gas Details</span></div>

                        <div class="row gy-1 gx-3 align-items-center">

                            <div class="row">
                                <div class="col-auto">
                                    <p class="bg-dark fs-14 text-white fw-semibold px-3 py-1 rounded mb-0">
                                        Meter #1
                                    </p>
                                </div>
                            </div>
                            <!-- Supplier Name -->
                            <div class="col-md-2"><label>Supplier Name</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <!-- MPRN No -->
                            <div class="col-md-2"><label>MPRN No</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <!-- Offer Rate -->
                            <div class="col-md-2"><label>Offer Rate</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-tag"></i>
                                </span>
                            </div>

                            <!-- Contract Duration -->
                            <div class="col-md-2"><label>Con. Duration</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-clock"></i>
                                </span>
                            </div>

                            <!-- Uplift -->
                            <div class="col-md-2"><label>Uplift</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-percent"></i>
                                </span>
                            </div>

                            <!-- Customer No -->
                            <div class="col-md-2"><label>Customer No</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>

                            <!-- Name Appears On Bill -->
                            <div class="col-md-2"><label>Name Appears On Bill</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <!-- Current Meter Read -->
                            <div class="col-md-2"><label>Current Meter Read</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-droplet"></i>
                                </span>
                            </div>

                            <!-- Meter Serial No -->
                            <div class="col-md-2"><label>Meter Serial No</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-upc-scan"></i>
                                </span>
                            </div>

                            <!-- Last Bill Amount -->
                            <div class="col-md-2"><label>Last Bill Amount</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                            </div>

                            <!-- Mode -->
                            <div class="col-md-2"><label>Mode</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>


                            <div class="mt-3">
                                <button type="button" class="btn btn-primary bg_green_color">
                                    <i class="bi bi-plus-circle me-1"></i> Add More Meter
                                </button>
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
