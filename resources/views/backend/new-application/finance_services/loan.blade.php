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
                        <i class="bi bi-ui-checks-grid me-1"></i>New Application (Loan)
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
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Form</span></div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-3 "><label>Application Agent <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-select" name="application_agent" required>
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
                                <input class="form-control border-end-0" name="company_name" required
                                    placeholder="Enter company name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Name<span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="trading_name" required
                                    placeholder="Enter trading name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-shop"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Business Entity<span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0" name="business_entity" required>
                                    <option>Select</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Business Nature <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0" name="business_nature" required>
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
                                <select class="form-select border-end-0" name="title" required>
                                    <option>Mr</option>
                                    <option>Mrs</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person-badge"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Merchant Full Name <span class="text-danger">:*</span></label>
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="merchant_full_name" required
                                    placeholder="Enter full name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Position <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0" name="position" required>
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
                                <input type="email" class="form-control border-end-0" name="email_address" required
                                    placeholder="example@email.com">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>Phone Number<span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="phone_number" required
                                    placeholder="03XXXXXXXXX">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Companies House Number <span
                                        class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="companies_house_number" required
                                    placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-card-text"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2 pb-2">
                            <div class="col-md-2"><label>VAT/TAX Number <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="vat_tax_number" required placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-receipt"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Trading Address <span class="text-danger">:*</span></label></div>

                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="trading_address" required placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- DIRECTOR DETAIL -->
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
                                        <input class="form-control border-end-0" name="director_name[]" required
                                            placeholder="Enter Director Name">
                                        <span class="icon-box border-start-0"><i class="bi bi-person"></i></span>
                                    </div>

                                    <div class="col-md-2"><label>Date Of Birth <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="date" class="form-control border-end-0" name="director_dob_array[]"
                                            required>
                                        <span class="icon-box border-start-0"><i class="bi bi-calendar-date"></i></span>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Phone No <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input class="form-control border-end-0" name="director_phone[]" required
                                            placeholder="Enter Phone Number">
                                        <span class="icon-box border-start-0"><i class="bi bi-telephone"></i></span>
                                    </div>

                                    <div class="col-md-2"><label>Email Address <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center">
                                        <input type="email" class="form-control border-end-0" name="director_email[]"
                                            required placeholder="Enter Email">
                                        <span class="icon-box border-start-0"><i class="bi bi-envelope"></i></span>
                                    </div>
                                </div>

                                <div class="row g-3 align-items-center mb-2 pb-2">
                                    <div class="col-md-2"><label>Home Address <span class="text-danger">:*</span></label>
                                    </div>
                                    <div class="col-md-10 d-flex align-items-center">
                                        <input class="form-control border-end-0" name="director_home_address[]" required
                                            placeholder="Enter Home Address">
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

                    <!-- APPLICATION DETAIL -->
                    <div class="form-section mb-3">
                        <div class="section-title"><span>Application Detail</span></div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Num <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="application_num" value="AUTO-001" readonly
                                    required placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Service</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="service_type" value="Loan" readonly
                                    required placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Application Date <span class="text-danger">:*</span></label>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0" name="application_date" required
                                    placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Renewal Date <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input type="date" class="form-control border-end-0" name="renewal_date" required
                                    placeholder="">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-calendar-event"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Brand <span class="text-danger">:*</span></label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <select class="form-select border-end-0" name="brand" required>
                                    <option disabled selected>Please Select</option>
                                    <option>Verifone</option>
                                    <option>Ingenico</option>
                                    <option>PAX</option>
                                </select>
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bag"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Card Machine Details</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="card_machine_details"
                                    placeholder="Which one are you using?">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-cpu"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Existing Funding</label></div>
                            <div class="col-md-10 d-flex align-items-center">
                                <input type="text" class="form-control border-end-0" name="existing_funding"
                                    placeholder="If yes, how much?">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-currency-dollar"></i>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-md-2"><label>Comment</label></div>
                            <div class="col-md-10 d-flex align-items-center">
                                <input class="form-control border-end-0" name="comment"
                                    placeholder="Enter your comments">
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

                            <div class="col-md-2"><label>Name On Account</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="name_on_account"
                                    placeholder="Enter Name On Account">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-person"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Account Number</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="account_number"
                                    placeholder="Enter Account Number">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Sort Code</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="sort_code"
                                    placeholder="Enter Sort Code">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>IBAN</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="iban"
                                    placeholder="Enter IBAN">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>BIC</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="bic" placeholder="Enter BIC">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-bank"></i>
                                </span>
                            </div>

                            <div class="col-md-2"><label>Name Of Bank</label></div>
                            <div class="col-md-4 d-flex align-items-center">
                                <input class="form-control border-end-0" name="name_of_bank"
                                    placeholder="Enter Bank Name">
                                <span class="icon-box border-start-0">
                                    <i class="bi bi-building"></i>
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
                                    <label class="fw-semibold mb-2">Picture ID</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="pictureId" name="picture_id" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Inside/Outside pics</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="insidePics" name="inside_outside_pics" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Bill</label>
                                    <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="billUpload" name="bill_upload" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Bank Statement</label>
                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('bankStatement').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="bankStatement" name="bank_statement" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-semibold mb-2">Additional Uploads</label>
                                    <div class="kyc-upload-box"
                                        onclick="document.getElementById('additionalUploads').click();">
                                        <p class="text-muted mb-0">Drop files here to upload</p>
                                        <input type="file" id="additionalUploads" name="additional_uploads"
                                            hidden>
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
