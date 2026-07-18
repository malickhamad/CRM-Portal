@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000 ">Edit Profile</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}"
                            class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Edit Profile</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    {{-- <h3 class="card-title green_color">Edit Profile</h3> --}}

                </div>
                <div class="card-body">
                    <div id="error-messages" class="alert alert-danger" style="display:none;"></div>



                    <form action="{{ route('admin.update-profile') }}" method="POST" enctype="multipart/form-data"
                        id="editProfileForm">
                        @csrf
                        <div class="row table-view">
                            <!-- Name -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $profile->name) }}">
                            </div>
                            <!-- Code -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CODE:</label>
                                <input type="text" class="form-control" name="code"
                                    value="{{ old('code', $profile->code) }}">
                            </div>

                            <!-- Designation -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">DESIGNATION:</label>
                                <input type="text" class="form-control" name="designation"
                                    value="{{ old('designation', $profile->designation) }}">
                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">STATUS:</label>
                                <input type="text" class="form-control" name="status"
                                    value="{{ old('status', $profile->status) }}">
                            </div>

                            <!-- CNIC NO -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CNIC NO:</label>
                                <input type="text" class="form-control" name="cnic_no"
                                    value="{{ old('cnic_no', $profile->cnic_no) }}">
                            </div>

                            <!-- Mobile No -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">MOBILE NO:</label>
                                <input type="text" class="form-control" name="mobile_no"
                                    value="{{ old('mobile_no', $profile->mobile_no) }}">
                            </div>

                            <!-- Email -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">EMAIL:</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $profile->email) }}">
                            </div>

                            <!-- Marital Status -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">MARITAL STATUS:</label>
                                <input type="text" class="form-control" name="marital_status"
                                    value="{{ old('marital_status', $profile->marital_status) }}">
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">DATE OF BIRTH:</label>
                                <input type="date" class="form-control" name="dob"
                                    value="{{ old('dob', $profile->dob) }}">
                            </div>

                            <!-- Religion -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">RELIGION:</label>
                                <input type="text" class="form-control" name="religion"
                                    value="{{ old('religion', $profile->religion) }}">
                            </div>

                            <!-- Floor -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">FLOOR:</label>
                                <input type="text" class="form-control" name="floor"
                                    value="{{ old('floor', $profile->floor) }}">
                            </div>

                            <!-- Shift -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">SHIFT:</label>
                                <input type="text" class="form-control" name="shift"
                                    value="{{ old('shift', $profile->shift) }}">
                            </div>

                            <!-- Department -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">DEPARTMENT:</label>
                                <input type="text" class="form-control" name="department"
                                    value="{{ old('department', $profile->department) }}">
                            </div>

                            <!-- Account Title -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Account Title:</label>
                                <input type="text" class="form-control" name="account_title"
                                    value="{{ old('account_title', $profile->account_title) }}">
                            </div>

                            <!-- Account Number -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Account Number:</label>
                                <input type="text" class="form-control" name="account_number"
                                    value="{{ old('account_number', $profile->account_number) }}">
                            </div>

                            <!-- Address -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">ADDRESS:</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ old('address', $profile->address) }}">
                            </div>
                        </div>

                            <!-- Submit Button -->
                            <div class="col-md-12 mb-3 text-end">
                                <button type="submit" class="btn btn-success bg_green_color">Update Profile</button>
                            </div>
                    </form>


                </div>




                <style>
                    /* Naye widget ke liye extra styles */
                    .month-label {
                        font-weight: 800;
                        color: #333;
                        background: #f0f2f5;
                        padding: 5px 10px;
                        border-radius: 4px;
                        margin-bottom: 15px;
                        font-size: 12px;
                    }

                    .comm-details-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                        gap: 10px;
                        margin-top: 10px;
                        font-size: 12px;
                    }

                    .detail-item {
                        color: #666;
                    }

                    .border-left-finalized {
                        border-left: 4px solid #66bb6a;
                    }

                    .border-left-pending {
                        border-left: 4px solid #ffa726;
                    }

                    .bg-light-success {
                        background: #e8f5e9;
                        padding: 2px 8px;
                        border-radius: 4px;
                    }

                    .bg-light-warning {
                        background: #fff3e0;
                        padding: 2px 8px;
                        border-radius: 4px;
                    }

                    /* Fullscreen support */
                    #commissionSection.fullscreen-mode {
                        position: fixed !important;
                        top: 0 !important;
                        left: 0 !important;
                        width: 100vw !important;
                        height: 100vh !important;
                        z-index: 999999 !important;
                        background: white !important;
                        margin: 0 !important;
                        display: flex;
                        flex-direction: column;
                    }

                    .swal-title-custom {
                        font-size: 1.25rem !important;
                        font-weight: 600 !important;
                    }

                    .swal-text-custom {
                        font-size: 0.9rem !important;
                    }
                </style>


            </div>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    console.log('startssssssssss');
                    // Submit the form using AJAX
                    $('#editProfileForm').submit(function(e) {
                        e.preventDefault(); // Prevent page refresh

                        let formData = new FormData(this); // Get form data

                        $.ajax({
                            url: "{{ route('admin.update-profile') }}", // Form submission URL
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                // alert("Profile updated successfully.");
                                    window.location.href = "{{ route('admin.my-profile') }}"; // Replace 'profile' with your actual route name if needed

                            },
                          
                            // ERROR RESPONSE
                            error: function(xhr) {
                                let $form = $('#editProfileForm'); // Define the form variable

                                $form.find("button[type='submit']").prop("disabled", false);

                                // VALIDATION ERRORS (422)
                                if (xhr.status === 422) {

                                    let errors = xhr.responseJSON.errors;
                                    let errorMsg = "";

                                    $.each(errors, function(field, messages) {

                                        errorMsg += messages[0] + "\n";

                                        // HIGHLIGHT INVALID FIELD
                                        let $input = $form.find(`[name="${field}"]`);
                                        if ($input.length) {
                                            $input.addClass("is-invalid");
                                        }
                                    });

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validation Error',
                                        text: errorMsg
                                    });

                                } else {
                                    // GENERIC SERVER ERROR
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Something went wrong. Please try again.'
                                    });
                                }
                            }

                        });
                    });
                });
            </script>
        @endsection
