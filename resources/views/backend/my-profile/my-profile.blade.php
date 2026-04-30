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
                    <a href="{{ route('admin.edit-profile') }}"
                        class="btn btn-primary text-white d-flex align-items-center gap-2 bg_green_color">
                        <iconify-icon icon="fa:edit" class="icon text-white"></iconify-icon>
                        Edit Profile
                    </a>
                </div>
                <div class="card-body">

                    <style>
                        .profile-info-table {
                            width: 100%;
                            border-collapse: collapse;
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            font-size: 16px;
                            /* Mobile par text thora chota behtar lagta hai */
                            margin-top: 20px;
                        }

                        .profile-info-table td {
                            border: 1px solid #dee2e6;
                            padding: 8px 10px;
                            vertical-align: middle;
                            background-color: #fff;
                        }

                        .field-label {
                            font-weight: 700;
                            color: #004d4d;
                            text-transform: uppercase;
                            margin-right: 5px;
                            display: block;
                            /* Mobile par label ko value ke upar lane ke liye */
                            font-size: 16px;
                        }

                        .field-value {
                            color: #333;
                            word-break: break-all;
                            /* Mobile par lambi email ya data line break ho jaye */
                        }

                        /* Mobile View Fix: 2 Columns */
                        @media screen and (max-width: 768px) {
                            .profile-info-table tbody {
                                display: flex;
                                flex-wrap: wrap;
                            }

                            .profile-info-table tr {
                                display: contents;
                                /* Table rows ko hatakar cells ko wrap hone dega */
                            }

                            .profile-info-table td {
                                flex: 0 0 50%;
                                /* Har cell 50% width lega (yani 1 line mein 2) */
                                box-sizing: border-box;
                                display: flex;
                                flex-direction: column;
                                justify-content: center;
                                min-height: 60px;
                            }

                            /* Address field ko full width (100%) karne ke liye */
                            .profile-info-table td[colspan="3"] {
                                flex: 0 0 100%;
                            }

                            .px-5.mx-5 {
                                padding-left: 10px !important;
                                padding-right: 10px !important;
                                margin-left: 0 !important;
                                margin-right: 0 !important;
                            }
                        }

                        /* Desktop per labels ko wapis side pe karne ke liye */
                        @media screen and (min-width: 769px) {
                            .field-label {
                                display: inline-block;
                                font-size: 15px;
                                min-width: 80px;
                            }
                        }
                    </style>

                    <div class="px-5 mx-5 mb-5">
                        <table class="profile-info-table">
                            <tbody>
                                <tr>
                                    <td width="33.33%">
                                        <span class="field-label">NAME:</span>
                                        <span class="field-value">{{ $profile->name ?? 'Admin' }}</span>
                                    </td>
                                    <td width="33.33%">
                                        <span class="field-label">CODE:</span>
                                        <span class="field-value">{{ $profile->code ?? '34066' }}</span>
                                    </td>
                                    <td width="33.33%">
                                        <span class="field-label">DESIGNATION:</span>
                                        <span class="field-value">{{ $profile->designation ?? 'CEO' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">STATUS:</span>
                                        <span class="field-value">{{ $profile->status ?? 'Manager' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">CNIC NO:</span>
                                        <span class="field-value">{{ $profile->cnic_no ?? '33230993020' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">MOBILE NO:</span>
                                        <span class="field-value">{{ $profile->mobile_no ?? '3290312099320' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">EMAIL:</span>
                                        <span class="field-value">{{ $profile->email ?? 'admin@gmail.com' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">MARITAL STATUS:</span>
                                        <span class="field-value">{{ $profile->marital_status ?? 'Married' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">DATE OF BIRTH:</span>
                                        <span class="field-value">{{ $profile->dob ?? '2026-04-17' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">RELIGION:</span>
                                        <span class="field-value">{{ $profile->religion ?? 'Islam' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">FLOOR:</span>
                                        <span class="field-value">{{ $profile->floor ?? '1' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">SHIFT:</span>
                                        <span class="field-value">{{ $profile->shift ?? 'Night' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">DEPARTMENT:</span>
                                        <span class="field-value">{{ $profile->department ?? 'NO' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">ACCOUNT TITLE:</span>
                                        <span class="field-value">{{ $profile->account_title ?? 'NO' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">ACCOUNT NUMBER:</span>
                                        <span class="field-value">{{ $profile->account_number ?? 'NIII' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span class="field-label">ADDRESS:</span>
                                        <span class="field-value">{{ $profile->address ?? 'Nill' }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-40 mb-20">
                <h6 class="fw-semibold mb-0 text-success-1000 ">Commissions Details
                </h6>


            </div>

            {{-- Commission Details Section --}}

            <div class="table-wrapper">

                <!-- FEBRUARY -->
                <div class="commission-card">
                    <div class="month-title">February 2026</div>

                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Sale No</th>
                                    <th>Sale Date</th>
                                    <th>Mature Date</th>
                                    <th>Paid Date</th>
                                    <th>Agent</th>
                                    <th>Business Name</th>
                                    <th>Service</th>
                                    <th>Commission</th>
                                    <th>Payout</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td data-label="Sr">1</td>
                                    <td data-label="Sale No">#550</td>
                                    <td data-label="Sale Date">28-01-2026</td>
                                    <td data-label="Mature Date">23-02-2026</td>
                                    <td data-label="Paid Date">02-03-2026</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">RAJ INTERNATIONAL STORE LTD</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 76,230</td>
                                    <td data-label="Payout"><span class="badge success">Finalized</span></td>
                                    <td data-label="Status"><span class="badge transferred">Transferred</span></td>
                                </tr>

                                <tr>
                                    <td data-label="Sr">2</td>
                                    <td data-label="Sale No">#577</td>
                                    <td data-label="Sale Date">06-02-2026</td>
                                    <td data-label="Mature Date">26-02-2026</td>
                                    <td data-label="Paid Date">02-03-2026</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">JTV MANCHESTER LTD</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 93,654</td>
                                    <td data-label="Payout"><span class="badge success">Finalized</span></td>
                                    <td data-label="Status"><span class="badge transferred">Transferred</span></td>
                                </tr>

                                <tr>
                                    <td data-label="Sr">3</td>
                                    <td data-label="Sale No">#578</td>
                                    <td data-label="Sale Date">06-02-2026</td>
                                    <td data-label="Mature Date">26-02-2026</td>
                                    <td data-label="Paid Date">02-03-2026</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">JTV MANCHESTER LTD</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 93,654</td>
                                    <td data-label="Payout"><span class="badge success">Finalized</span></td>
                                    <td data-label="Status"><span class="badge transferred">Transferred</span></td>
                                </tr>

                                <tr>
                                    <td data-label="Sr">4</td>
                                    <td data-label="Sale No">#658</td>
                                    <td data-label="Sale Date">24-02-2026</td>
                                    <td data-label="Mature Date">26-02-2026</td>
                                    <td data-label="Paid Date">02-03-2026</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">K & B Food And Wine</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 93,654</td>
                                    <td data-label="Payout"><span class="badge success">Finalized</span></td>
                                    <td data-label="Status"><span class="badge transferred">Transferred</span></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="8">Total</td>
                                    <td colspan="3">PKR 357,192</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- MARCH -->
                <div class="commission-card">
                    <div class="month-title">March 2026</div>

                    <div class="table-responsive">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Sale No</th>
                                    <th>Sale Date</th>
                                    <th>Mature Date</th>
                                    <th>Paid Date</th>
                                    <th>Agent</th>
                                    <th>Business Name</th>
                                    <th>Service</th>
                                    <th>Commission</th>
                                    <th>Payout</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td data-label="Sr">1</td>
                                    <td data-label="Sale No">#592</td>
                                    <td data-label="Sale Date">11-02-2026</td>
                                    <td data-label="Mature Date">11-03-2026</td>
                                    <td data-label="Paid Date">-</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">NSEJAS CALABAR KITCHEN</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 89,298</td>
                                    <td data-label="Payout"><span class="badge pending">Finalize for Payout</span></td>
                                    <td data-label="Status"><span class="badge pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td data-label="Sr">2</td>
                                    <td data-label="Sale No">#595</td>
                                    <td data-label="Sale Date">11-02-2026</td>
                                    <td data-label="Mature Date">11-03-2026</td>
                                    <td data-label="Paid Date">-</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">Budleigh Mini Super Market</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 89,298</td>
                                    <td data-label="Payout"><span class="badge pending">Finalize for Payout</span></td>
                                    <td data-label="Status"><span class="badge pending">Pending</span></td>
                                </tr>

                                <tr>
                                    <td data-label="Sr">3</td>
                                    <td data-label="Sale No">#619</td>
                                    <td data-label="Sale Date">16-02-2026</td>
                                    <td data-label="Mature Date">11-03-2026</td>
                                    <td data-label="Paid Date">-</td>
                                    <td data-label="Agent">Shoaib Shah</td>
                                    <td data-label="Business Name">HOMEBAZAARUK LTD</td>
                                    <td data-label="Service">Card Machine</td>
                                    <td data-label="Commission" class="amount">PKR 89,298</td>
                                    <td data-label="Payout"><span class="badge pending">Finalize for Payout</span></td>
                                    <td data-label="Status"><span class="badge pending">Pending</span></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="8">Total</td>
                                    <td colspan="3">PKR 267,894</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <style>
                * {
                    box-sizing: border-box;
                }

                body {
                    margin: 0;
                    background: #f3f4f6;
                    font-family: Arial, Helvetica, sans-serif;
                    color: #111827;
                }

                .table-wrapper {
                    width: 100%;
                    /* padding: 24px; */
                }

                .commission-card {
                    background: #ffffff;
                    border-radius: 18px;
                    padding: 24px;
                    margin-bottom: 35px;
                    box-shadow: 0 12px 35px rgba(15, 23, 42, .08);
                }

                .month-title {
                    display: inline-block;
                    background: #111827;
                    color: #fff;
                    padding: 9px 18px;
                    border-radius: 30px;
                    font-size: 16px;
                    font-weight: 700;
                    margin-bottom: 18px;
                }

                .table-responsive {
                    width: 100%;
                    overflow-x: auto;
                }

                .modern-table {
                    width: 100%;
                    min-width: 1050px;
                    border-collapse: separate;
                    border-spacing: 0;
                    overflow: hidden;
                    border-radius: 12px;
                    font-size: 14px;
                }

                .modern-table th {
                    background: #f9fafb;
                    color: #111827;
                    padding: 15px;
                    text-align: left;
                    border-bottom: 1px solid #e5e7eb;
                    white-space: nowrap;
                }

                .modern-table td {
                    padding: 15px;
                    border-bottom: 1px solid #edf2f7;
                    color: #475569;
                    vertical-align: middle;
                    white-space: nowrap;
                }

                .modern-table tbody tr:hover {
                    background: #f8fafc;
                }

                .amount {
                    color: #059669 !important;
                    font-weight: 800;
                }

                .badge {
                    padding: 7px 13px;
                    border-radius: 30px;
                    font-size: 12px;
                    font-weight: 700;
                    display: inline-block;
                    white-space: nowrap;
                }

                .success {
                    background: #dcfce7;
                    color: #166534;
                }

                .pending {
                    background: #fef3c7;
                    color: #92400e;
                }

                .transferred {
                    background: #e0f2fe;
                    color: #0369a1;
                }

                .modern-table tfoot td {
                    background: #111827;
                    color: #fff;
                    font-size: 15px;
                    font-weight: 800;
                }

                /* MOBILE RESPONSIVE CARD VIEW */
                @media (max-width:768px) {

                    .table-wrapper {
                        padding: 14px;
                    }

                    .commission-card {
                        padding: 16px;
                        border-radius: 14px;
                    }

                    .table-responsive {
                        overflow-x: visible;
                    }

                    .modern-table {
                        min-width: 100%;
                        border-collapse: collapse;
                    }

                    .modern-table thead {
                        display: none;
                    }

                    .modern-table,
                    .modern-table tbody,
                    .modern-table tr,
                    .modern-table td {
                        display: block;
                        width: 100%;
                    }

                    .modern-table tr {
                        margin-bottom: 15px;
                        background: #fff;
                        border-radius: 12px;
                        padding: 10px;
                        box-shadow: 0 5px 15px rgba(0, 0, 0, .06);
                    }

                    .modern-table td {
                        text-align: right;
                        padding: 10px 10px 10px 45%;
                        position: relative;
                        border-bottom: 1px solid #f1f5f9;
                        white-space: normal;
                    }

                    .modern-table td::before {
                        content: attr(data-label);
                        position: absolute;
                        left: 10px;
                        width: 40%;
                        font-weight: 700;
                        color: #6b7280;
                        text-align: left;
                    }

                    .modern-table tfoot tr {
                        background: #111827;
                    }

                    .modern-table tfoot td {
                        display: block;
                        width: 100%;
                        text-align: right;
                        border: none;
                    }
                }
            </style>



        </div>


        </div>
    @endsection
