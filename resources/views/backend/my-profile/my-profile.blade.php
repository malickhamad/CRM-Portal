@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000 ">My Profile Information</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}"
                            class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">My Profile</li>
                </ul>
            </div>

            <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="card-title text-success-1000">Profile Information</h4>
    <!-- Edit Profile Button -->
    <a href="{{ route('admin.edit-profile') }}" class="btn btn-primary text-white d-flex align-items-center gap-2 bg_green_color">
        <iconify-icon icon="fa:edit" class="icon text-white"></iconify-icon>
        Edit Profile
    </a>
</div>
                <div class="card-body">
                    {{-- <div class="row table-view">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">CODE:</label>
                            <div class="form-control form-control-sm-plaintext data-field">104</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">DESIGNATION:</label>
                            <div class="form-control form-control-sm-plaintext data-field">Out Source</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">STATUS:</label>
                            <div class="form-control form-control-sm-plaintext data-field">Working</div>
                        </div>

                        <div class="col-md-4 mb-3 ">
                            <label class="form-label">CNIC NO:</label>
                            <div class="form-control form-control-sm-plaintext data-field">00000-0000000-0</div>
                        </div>
                        <div class="col-md-4 mb-3 ">
                            <label class="form-label">MOBILE NO:</label>
                            <div class="form-control form-control-sm-plaintext data-field">03427635722</div>
                        </div>
                        <div class="col-md-4 mb-3 ">
                            <label class="form-label">EMAIL:</label>
                            <div class="form-control form-control-sm-plaintext data-field"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">MARITAL STATUS:</label>
                            <div class="form-control form-control-sm-plaintext data-field">Married</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">DATE OF BIRTH:</label>
                            <div class="form-control form-control-sm-plaintext data-field">13-10-2025</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">RELIGION:</label>
                            <div class="form-control form-control-sm-plaintext data-field"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">FLOOR:</label>
                            <div class="form-control form-control-sm-plaintext data-field">Out source</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">SHIFT:</label>
                            <div class="form-control form-control-sm-plaintext data-field"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">DEPARTMENT:</label>
                            <div class="form-control form-control-sm-plaintext data-field">Out Source</div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Account Title:</label>
                            <div class="form-control form-control-sm-plaintext data-field"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Account Number:</label>
                            <div class="form-control form-control-sm-plaintext data-field"></div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">ADDRESS:</label>
                            <div class="form-control form-control-sm-plaintext data-field">
                                139B ali mall d ground faisalabad
                            </div>
                        </div>

                    </div> --}}






                    <div class="row table-view">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Name:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->name ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CODE:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->code ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">DESIGNATION:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->designation ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">STATUS:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->status ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CNIC NO:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->cnic_no ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">MOBILE NO:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->mobile_no ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">EMAIL:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->email ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">MARITAL STATUS:</label>
                            <div class="form-control form-control-sm-plaintext data-field">
                                {{ $profile->marital_status ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">DATE OF BIRTH:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->dob ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">RELIGION:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->religion ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">FLOOR:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->floor ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">SHIFT:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->shift ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">DEPARTMENT:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->department ?? '' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Account Title:</label>
                            <div class="form-control form-control-sm-plaintext data-field">
                                {{ $profile->account_title ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Account Number:</label>
                            <div class="form-control form-control-sm-plaintext data-field">
                                {{ $profile->account_number ?? '' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">ADDRESS:</label>
                            <div class="form-control form-control-sm-plaintext data-field">{{ $profile->address ?? '' }}
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Button -->
                    <a href="{{ route('admin.edit-profile') }}" class="btn btn-primary">Edit Profile</a>





                    {{--  <div class="alert alert-info mt-4">

                            Your profile has been completed and cannot be edited.
                            Please contact support if you need to make changes.
                        </div> --}}


                    {{-- Commission Details Section --}}
                    <div id="commissionSection" class="mb-4">
                        <div class="custom-card-header">
                            <div class="header-left">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <span class="header-title">Commissions Details</span>
                            </div>
                            <div class="header-right">
                                <button class="header-btn" onclick="toggleMinimizeComm()" title="Minimize">&#8211;</button>
                                <button class="header-btn" onclick="toggleFullscreenComm()"
                                    title="Full View">&#9723;</button>
                                <button class="header-btn close-btn" onclick="closeWidgetComm()"
                                    title="Close">&#10005;</button>
                            </div>
                        </div>

                        <div id="commScrollContainer" class="applications-container">

                            {{-- February Section --}}
                            <h6 class="month-label">FEB 2026</h6>

                            <div class="app-box-item border-left-finalized">
                                <div class="app-header">
                                    <strong>Sale #550 - RAJ INTERNATIONAL STORE LTD</strong>
                                    <span>(28-01-2026)</span>
                                    <span class="status-badge status-paid">Finalized</span>
                                </div>
                                <div class="comm-details-grid">
                                    <div class="detail-item"><strong>Agent:</strong> Shoaib Shah</div>
                                    <div class="detail-item"><strong>Mature:</strong> 23-02-2026</div>
                                    <div class="detail-item"><strong>Commission:</strong> <span class="text-success">PKR
                                            76,230</span></div>
                                    <div class="detail-item"><strong>Transfer:</strong> <span
                                            class="badge bg-light-success text-success">Transferred</span></div>
                                </div>
                            </div>
                            <div class="app-box-item border-left-pending">
                                <div class="app-header">
                                    <strong>Sale #592 - NSEJAS CALABAR KITCHEN</strong>
                                    <span>(11-02-2026)</span>
                                    <span class="status-badge status-await">Finalize For Payout</span>
                                </div>
                                <div class="comm-details-grid">
                                    <div class="detail-item"><strong>Agent:</strong> Shoaib Shah</div>
                                    <div class="detail-item"><strong>Mature:</strong> 11-03-2026</div>
                                    <div class="detail-item"><strong>Commission:</strong> <span class="text-primary">PKR
                                            89,298</span></div>
                                    <div class="detail-item"><strong>Transfer:</strong> <span
                                            class="badge bg-light-warning text-warning">Pending</span></div>
                                </div>
                            </div>

                            <div class="app-box-item border-left-finalized">
                                <div class="app-header">
                                    <strong>Sale #577 - JTV MANCHESTER LTD</strong>
                                    <span>(06-02-2026)</span>
                                    <span class="status-badge status-paid">Finalized</span>
                                </div>
                                <div class="comm-details-grid">
                                    <div class="detail-item"><strong>Agent:</strong> Shoaib Shah</div>
                                    <div class="detail-item"><strong>Mature:</strong> 26-02-2026</div>
                                    <div class="detail-item"><strong>Commission:</strong> <span class="text-success">PKR
                                            93,654</span></div>
                                    <div class="detail-item"><strong>Transfer:</strong> <span
                                            class="badge bg-light-success text-success">Transferred</span></div>
                                </div>
                            </div>

                            {{-- March Section --}}
                            <hr>
                            <h6 class="month-label mt-3">MARCH 2026</h6>

                            <div class="app-box-item border-left-pending">
                                <div class="app-header">
                                    <strong>Sale #592 - NSEJAS CALABAR KITCHEN</strong>
                                    <span>(11-02-2026)</span>
                                    <span class="status-badge status-await">Finalize For Payout</span>
                                </div>
                                <div class="comm-details-grid">
                                    <div class="detail-item"><strong>Agent:</strong> Shoaib Shah</div>
                                    <div class="detail-item"><strong>Mature:</strong> 11-03-2026</div>
                                    <div class="detail-item"><strong>Commission:</strong> <span class="text-primary">PKR
                                            89,298</span></div>
                                    <div class="detail-item"><strong>Transfer:</strong> <span
                                            class="badge bg-light-warning text-warning">Pending</span></div>
                                </div>
                            </div>
                            <div class="app-box-item border-left-finalized">
                                <div class="app-header">
                                    <strong>Sale #577 - JTV MANCHESTER LTD</strong>
                                    <span>(06-02-2026)</span>
                                    <span class="status-badge status-paid">Finalized</span>
                                </div>
                                <div class="comm-details-grid">
                                    <div class="detail-item"><strong>Agent:</strong> Shoaib Shah</div>
                                    <div class="detail-item"><strong>Mature:</strong> 26-02-2026</div>
                                    <div class="detail-item"><strong>Commission:</strong> <span class="text-success">PKR
                                            93,654</span></div>
                                    <div class="detail-item"><strong>Transfer:</strong> <span
                                            class="badge bg-light-success text-success">Transferred</span></div>
                                </div>
                            </div>
                            <div class="app-box-item border-left-finalized">
                                <div class="app-header">
                                    <strong>Sale #577 - JTV MANCHESTER LTD</strong>
                                    <span>(06-02-2026)</span>
                                    <span class="status-badge status-paid">Finalized</span>
                                </div>
                                <div class="comm-details-grid">
                                    <div class="detail-item"><strong>Agent:</strong> Shoaib Shah</div>
                                    <div class="detail-item"><strong>Mature:</strong> 26-02-2026</div>
                                    <div class="detail-item"><strong>Commission:</strong> <span class="text-success">PKR
                                            93,654</span></div>
                                    <div class="detail-item"><strong>Transfer:</strong> <span
                                            class="badge bg-light-success text-success">Transferred</span></div>
                                </div>
                            </div>

                        </div>
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

                    <script>
                        function toggleMinimizeComm() {
                            const container = document.getElementById('commScrollContainer');
                            container.style.display = (container.style.display === "none") ? "block" : "none";
                        }

                        function toggleFullscreenComm() {
                            const section = document.getElementById('commissionSection');
                            section.classList.toggle('fullscreen-mode');
                            document.body.style.overflow = section.classList.contains('fullscreen-mode') ? 'hidden' : 'auto';
                        }

                        function closeWidgetComm() {
                            Swal.fire({
                                title: 'Close Section?',
                                text: 'Are you sure you want to hide this?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, close it!',
                                cancelButtonText: 'Cancel',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                width: '400px', // Isse alert ki width control hogi
                                padding: '1.5rem',
                                customClass: {
                                    title: 'swal-title-custom',
                                    content: 'swal-text-custom'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const section = document.getElementById('commissionSection');
                                    section.style.transition = "opacity 0.4s ease";
                                    section.style.opacity = "0";
                                    setTimeout(() => {
                                        section.style.display = 'none';
                                    }, 400);

                                    // Optional: Success message bhi compact dikhayein
                                    Swal.fire({
                                        title: 'Closed!',
                                        icon: 'success',
                                        width: '300px',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                }
                            })
                        }
                    </script>





                </div>
            </div>
        </div>
    @endsection
