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
        font-size: 12px; /* Mobile par text thora chota behtar lagta hai */
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
        display: block; /* Mobile par label ko value ke upar lane ke liye */
        font-size: 10px;
    }

    .field-value {
        color: #333;
        word-break: break-all; /* Mobile par lambi email ya data line break ho jaye */
    }

    /* Mobile View Fix: 2 Columns */
    @media screen and (max-width: 768px) {
        .profile-info-table tbody {
            display: flex;
            flex-wrap: wrap;
        }

        .profile-info-table tr {
            display: contents; /* Table rows ko hatakar cells ko wrap hone dega */
        }

        .profile-info-table td {
            flex: 0 0 50%; /* Har cell 50% width lega (yani 1 line mein 2) */
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
            font-size: 13px;
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





        </div>


        </div>
    @endsection
