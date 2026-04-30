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
                                        <span class="field-value">{{ $profile->name ?? 'N/A' }}</span>
                                    </td>
                                    <td width="33.33%">
                                        <span class="field-label">CODE:</span>
                                        <span class="field-value">{{ $profile->code ?? 'N/A' }}</span>
                                    </td>
                                    <td width="33.33%">
                                        <span class="field-label">DESIGNATION:</span>
                                        <span class="field-value">{{ $profile->designation ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">STATUS:</span>
                                        <span class="field-value">{{ $profile->status ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">CNIC NO:</span>
                                        <span class="field-value">{{ $profile->cnic_no ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">MOBILE NO:</span>
                                        <span class="field-value">{{ $profile->mobile_no ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">EMAIL:</span>
                                        <span class="field-value">{{ $profile->email ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">MARITAL STATUS:</span>
                                        <span class="field-value">{{ $profile->marital_status ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">DATE OF BIRTH:</span>
                                        <span class="field-value">{{ $profile->dob ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">RELIGION:</span>
                                        <span class="field-value">{{ $profile->religion ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">FLOOR:</span>
                                        <span class="field-value">{{ $profile->floor ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">SHIFT:</span>
                                        <span class="field-value">{{ $profile->shift ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="field-label">DEPARTMENT:</span>
                                        <span class="field-value">{{ $profile->department ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">ACCOUNT TITLE:</span>
                                        <span class="field-value">{{ $profile->account_title ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="field-label">ACCOUNT NUMBER:</span>
                                        <span class="field-value">{{ $profile->account_number ?? 'N/A' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span class="field-label">ADDRESS:</span>
                                        <span class="field-value">{{ $profile->address ?? 'N/A' }}</span>
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

                @forelse($commissions as $month => $items)
                    <div class="commission-card">
                        <div class="month-title">{{ $month }}</div>

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
                                    @foreach ($items as $key => $item)
                                        <tr>
                                            <td data-label="Sr">{{ $key + 1 }}</td>
                                            <td data-label="Sale No">{{ $item->application_num }}</td>
                                            <td data-label="Sale Date">
                                                {{ $item->application_date ? \Carbon\Carbon::parse($item->application_date)->format('d-m-Y') : $item->created_at->format('d-m-Y') }}
                                            </td>
                                            <td data-label="Mature Date">
                                                {{ $item->mature_date ? \Carbon\Carbon::parse($item->mature_date)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td data-label="Paid Date">
                                                {{ $item->paid_date ? \Carbon\Carbon::parse($item->paid_date)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td data-label="Agent">
                                                {{ $item->application_agent ?? ($item->user->name ?? 'N/A') }}</td>
                                            <td data-label="Business Name">{{ $item->company_name ?? 'N/A' }}</td>
                                            <td data-label="Service">{{ $item->service_type }}</td>
                                            <td data-label="Commission" class="amount">
                                                PKR {{ number_format($item->commission_amount, 0) }}
                                            </td>

                                            <td data-label="Payout">
                                                @if ($item->payout_status === 'transferred')
                                                    <span class="badge success">Finalized</span>
                                                @else
                                                    <form
                                                        action="{{ route('admin.user.commissions.finalize', $item->id) }}"
                                                        method="POST" class="d-inline payout-form">
                                                        @csrf
                                                        <button type="button"
                                                            class="badge pending border-0 btn-payout-confirm">
                                                            Finalize for Payout
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <script>
                                                document.querySelectorAll('.btn-payout-confirm').forEach(function(button) {
                                                    button.addEventListener('click', function(e) {
                                                        e.preventDefault();

                                                        let form = this.closest('form');

                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: "Do you want to finalize this payout?",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#16a34a',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, Finalize It!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                form.submit();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>

                                            <td data-label="Status">
                                                @if ($item->payout_status === 'transferred')
                                                    <span class="badge transferred">Transferred</span>
                                                @else
                                                    <span class="badge pending">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="8">Total</td>
                                        <td colspan="3">PKR {{ number_format($items->sum('commission_amount'), 0) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="commission-card">
                        <h5>No commission found.</h5>
                    </div>
                @endforelse

            </div>


            <style>
                .table-wrapper {
                    width: 100%;
                }

                .commission-card {
                    background: #fff;
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

                @media(max-width:768px) {
                    .table-wrapper {
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
