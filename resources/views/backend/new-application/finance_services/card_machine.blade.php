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
                        <i class="bi bi-ui-checks-grid me-1"></i>New Application (Card Machine)
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


                {{-- <form id="applicationForm" action="{{ route('admin.applications.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 "><label>Application Agent <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-9">
                                <select name="application_agent" class="form-select">
                                    <option disabled selected>Select Agent</option>
                                    <option value="Ali Hassan">Ali Hassan</option>
                                    <option value="Usman Khan">Usman Khan</option>
                                    <option value="Sara Ahmed">Sara Ahmed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Detail</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="company_name" class="form-control border-end-0"
                                    placeholder="Enter company name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="trading_name" class="form-control border-end-0"
                                    placeholder="Enter trading name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shop"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="business_entity" class="form-select border-end-0">
                                    <option disabled selected>Select</option>
                                    <option value="Sole Trader">Sole Trader</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Limited Company">Limited Company</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Business Nature <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="business_nature" class="form-select border-end-0">
                                    <option disabled selected>Select</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Wholesale">Wholesale</option>
                                    <option value="Services">Services</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-briefcase"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Title <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="title" class="form-select border-end-0">
                                    <option disabled selected>Select Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Ms</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name<span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="merchant_full_name" class="form-control border-end-0"
                                    placeholder="Enter full name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="position" class="form-select border-end-0">
                                    <option disabled selected>Select Position</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Director">Director</option>
                                    <option value="Manager">Manager</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-people"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" name="email_address" class="form-control border-end-0"
                                    placeholder="example@email.com">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Phone Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="phone_number" class="form-control border-end-0"
                                    placeholder="03XXXXXXXXX">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span
                                        class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="companies_house_number" class="form-control border-end-0"
                                    placeholder="Enter House Number">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="vat_tax_number" class="form-control border-end-0"
                                    placeholder="Enter VAT/TAX Number">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-receipt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="trading_address" class="form-control border-end-0"
                                    placeholder="Enter Trading Address">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-section mb-3">
                        <div class="section-title"><span>Director Detail</span></div>

                        <div id="director-container">
                            <div class="director-block mb-4 border-bottom pb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p
                                        class="bg-dark fs-14 text-white fw-semibold px-3 py-2 d-inline-block rounded director-label mb-0">
                                        Director #1
                                    </p>
                                    <button type="button" class="btn btn-danger btn-sm remove-director-btn d-none">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Director Name <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="text" name="director_name[]" class="form-control border-end-0"
                                            placeholder="Enter Director Name">
                                        <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                                    </div>
                                    <div class="col-md-2"><label>Date Of Birth <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="date" name="director_dob_array[]"
                                            class="form-control border-end-0">
                                        <span class="icon-box border-start-0"><i class="bi bi-calendar-date"></i></span>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Phone No <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="text" name="director_phone[]" class="form-control border-end-0"
                                            placeholder="Enter Phone Number">
                                        <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
                                    </div>
                                    <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="email" name="director_email[]" class="form-control border-end-0"
                                            placeholder="Enter Email">
                                        <span class="icon-box border-start-0"><i class="bi bi-envelope"></i></span>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Home Address <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <input type="text" name="director_home_address[]"
                                            class="form-control border-end-0" placeholder="Enter Home Address">
                                        <span class="icon-box border-start-0"><i class="bi bi-geo-alt"></i></span>
                                    </div>
                                </div>
                            </div>
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
                                <input type="text" name="application_num" class="form-control border-end-0"
                                    value="{{ $nextNum }}" readonly> <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="service_type" class="form-control border-end-0"
                                    value="Card Machine" readonly>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="application_date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="renewal_date" class="form-control border-end-0">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="brand" class="form-select border-end-0">
                                    <option disabled selected>Select Brand</option>
                                    <option value="Verifone">Verifone</option>
                                    <option value="Ingenico">Ingenico</option>
                                    <option value="PAX">PAX</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Qty <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="qty" class="form-control border-end-0"
                                    placeholder="Enter Quantity">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-123"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Delivery Address</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="delivery_address" class="form-control border-end-0"
                                    placeholder="Enter Delivery Address">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="comment" class="form-control border-end-0"
                                    placeholder="Enter Comments">
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



                    <div class="form-section mb-3">
                        <div class="section-title"><span>Monthly Rental</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Debit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="debit_card" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter Debit Card">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Credit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="credit_card" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Credit Card">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Commercial Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="commercial_card" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Commercial Card">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Authentication Fee</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="authentication_fee" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Authentication Fee">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>PCI</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="pci" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter PCI">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Rental</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="rental" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter Rental">
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
                                    placeholder="Enter Name On Account">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="account_number" class="form-control border-end-0"
                                    placeholder="Enter Account Number">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="sort_code" class="form-control border-end-0"
                                    placeholder="Enter Sort Code">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="iban" class="form-control border-end-0"
                                    placeholder="Enter IBAN">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="bic" class="form-control border-end-0"
                                    placeholder="Enter BIC">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="name_of_bank" class="form-control border-end-0"
                                    placeholder="Enter Bank Name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                        </div>
                    </div>


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
                                        <input type="file" id="additionalUploads" name="additional_uploads" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-3 ">
                        <button type="submit" class="btn btn-primary bg_green_color">
                            <i class="bi bi-send me-1"></i> Save
                        </button>
                    </div>

                </form> --}}

                <form id="applicationForm" action="{{ route('admin.applications.store') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 "><label>Application Agent <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-9">
                                <select name="application_agent" class="form-select" required>
                                    <option disabled selected>Select Agent</option>
                                    <option value="Ali Hassan">Ali Hassan</option>
                                    <option value="Usman Khan">Usman Khan</option>
                                    <option value="Sara Ahmed">Sara Ahmed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Customer Detail</span></div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Company Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="company_name" class="form-control border-end-0"
                                    placeholder="Enter company name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="trading_name" class="form-control border-end-0"
                                    placeholder="Enter trading name" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shop"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="business_entity" class="form-select border-end-0" required>
                                    <option disabled selected>Select</option>
                                    <option value="Sole Trader">Sole Trader</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Limited Company">Limited Company</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Business Nature <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="business_nature" class="form-select border-end-0" required>
                                    <option disabled selected>Select</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Wholesale">Wholesale</option>
                                    <option value="Services">Services</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-briefcase"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Title <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="title" class="form-select border-end-0" required>
                                    <option disabled selected>Select Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Ms</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name<span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="merchant_full_name" class="form-control border-end-0"
                                    placeholder="Enter full name" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="position" class="form-select border-end-0" required>
                                    <option disabled selected>Select Position</option>
                                    <option value="Owner">Owner</option>
                                    <option value="Director">Director</option>
                                    <option value="Manager">Manager</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-people"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="email" name="email_address" class="form-control border-end-0"
                                    placeholder="example@email.com" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Phone Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="phone_number" class="form-control border-end-0"
                                    placeholder="03XXXXXXXXX" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span
                                        class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="companies_house_number" class="form-control border-end-0"
                                    placeholder="Enter House Number" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="vat_tax_number" class="form-control border-end-0"
                                    placeholder="Enter VAT/TAX Number" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-receipt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="trading_address" class="form-control border-end-0"
                                    placeholder="Enter Trading Address" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Director Detail</span></div>

                        <div id="director-container">
                            <div class="director-block mb-4 border-bottom pb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <p
                                        class="bg-dark fs-14 text-white fw-semibold px-3 py-2 d-inline-block rounded director-label mb-0">
                                        Director #1
                                    </p>
                                    <button type="button" class="btn btn-danger btn-sm remove-director-btn d-none">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Director Name <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="text" name="director_name[]" class="form-control border-end-0"
                                            placeholder="Enter Director Name" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                                    </div>
                                    <div class="col-md-2"><label>Date Of Birth <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="date" name="director_dob_array[]"
                                            class="form-control border-end-0" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-calendar-date"></i></span>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Phone No <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="text" name="director_phone[]" class="form-control border-end-0"
                                            placeholder="Enter Phone Number" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
                                    </div>
                                    <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="email" name="director_email[]" class="form-control border-end-0"
                                            placeholder="Enter Email" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-envelope"></i></span>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Home Address <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <input type="text" name="director_home_address[]"
                                            class="form-control border-end-0" placeholder="Enter Home Address" required>
                                        <span class="icon-box border-start-0"><i class="bi bi-geo-alt"></i></span>
                                    </div>
                                </div>
                            </div>
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
                                <input type="text" name="application_num" class="form-control border-end-0"
                                    value="{{ $nextNum }}" readonly required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="service_type" class="form-control border-end-0"
                                    value="Card Machine" readonly required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="application_date" class="form-control border-end-0" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" name="renewal_date" class="form-control border-end-0" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select name="brand" class="form-select border-end-0" required>
                                    <option disabled selected>Select Brand</option>
                                    <option value="Verifone">Verifone</option>
                                    <option value="Ingenico">Ingenico</option>
                                    <option value="PAX">PAX</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Qty <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="qty" class="form-control border-end-0"
                                    placeholder="Enter Quantity" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-123"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Delivery Address</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="delivery_address" class="form-control border-end-0"
                                    placeholder="Enter Delivery Address" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Comment</label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="comment" class="form-control border-end-0"
                                    placeholder="Enter Comments" required>
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

                    <div class="form-section mb-3">
                        <div class="section-title"><span>Monthly Rental</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Debit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="debit_card" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter Debit Card" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Credit Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="credit_card" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Credit Card" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Commercial Card</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="commercial_card" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Commercial Card" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Authentication Fee</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="authentication_fee" step="0.01"
                                    class="form-control border-end-0" placeholder="Enter Authentication Fee" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>PCI</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="pci" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter PCI" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Rental</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="number" name="rental" step="0.01" class="form-control border-end-0"
                                    placeholder="Enter Rental" required>
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
                                    placeholder="Enter Name On Account" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="account_number" class="form-control border-end-0"
                                    placeholder="Enter Account Number" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="sort_code" class="form-control border-end-0"
                                    placeholder="Enter Sort Code" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="iban" class="form-control border-end-0"
                                    placeholder="Enter IBAN" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="bic" class="form-control border-end-0"
                                    placeholder="Enter BIC" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="text" name="name_of_bank" class="form-control border-end-0"
                                    placeholder="Enter Bank Name" required>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                        </div>
                    </div>

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
                                        <input type="file" id="additionalUploads" name="additional_uploads" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 ">
                        <button type="submit" class="btn btn-primary bg_green_color">
                            <i class="bi bi-send me-1"></i> Save
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


            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



        </div>
    @endsection
