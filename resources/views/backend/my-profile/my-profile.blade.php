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
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">My Profile</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-success-1000 ">Profile Information</h4>
                    </div>
                <div class="card-body">
                        <!-- Read-only view -->
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6 mb-3">
                                <p class="form-label">Full Name</p>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->name }}</div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->email }}</div>
                            </div>

                            <!-- Business Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Name</label>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->business_name ?? 'N/A' }}</div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->phone ?? 'N/A' }}</div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <div class="form-control  form-control-sm-plaintext">
                                    {{ $user->street_address ?? 'N/A' }},
                                    {{ $user->city ?? '' }},
                                    {{ $user->state ?? '' }},
                                    {{ $user->country ?? '' }}
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            @if ($user->profile_picture)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Profile Picture</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                            width="120" class="img-thumbnail">
                                    </div>
                                </div>
                            @endif
                        </div>
{{--

                        <div class="alert alert-info mt-4">

                            Your profile has been completed and cannot be edited.
                            Please contact support if you need to make changes.
                        </div> --}}



                         <h6 class="mt-5 mb-3  text-success-1000 ">Commission Details</h6>


                         <h4 class="mt-3 mb-3 card-title text-success-1000 ">APRIL 2026</h4>

                                {{-- show here logs --}}
                                <div class="table-responsive basic-data-table ">
                                   <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
    <thead>
        <tr>
            <th scope="col">Sr</th>
            <th scope="col">Sale Num</th>
            <th scope="col">Sale Date</th>
            <th scope="col">Mature Date</th>
            <th scope="col">Paid Date</th>
            <th scope="col">Agent</th>
            <th scope="col">Buisness Name</th>
            <th scope="col">Service</th>
            <th scope="col">Commission</th>
            <th scope="col">Payout</th>
            <th scope="col">Amount Transfer</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>550</td>
            <td>28-01-2026</td>
            <td>23-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>RAJ INTERNATIONAL STORE LTD</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 76,230</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
        <tr>
            <td>2</td>
            <td>577</td>
            <td>06-02-2026</td>
            <td>26-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>TV MANCHESTER LTD</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 93,654</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
        <tr>
            <td>3</td>
            <td>578</td>
            <td>06-02-2026</td>
            <td>26-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>TV MANCHESTER LTD</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 93,654</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
        <tr>
            <td>4</td>
            <td>658</td>
            <td>24-02-2026</td>
            <td>26-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>K & B Food And Wine</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 93,654</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
    </tbody>
    <tfoot>
        <tr class="bg-light">
            <td colspan="8" class="text-center"><strong>Total</strong></td>
            <td colspan="3"><strong>PKR 357,192</strong></td>
        </tr>
    </tfoot>
</table>
                                </div>


                                  <h4 class="mt-3 mb-3 card-title text-success-1000 ">APRIL 2026</h4>

                                {{-- show here logs --}}
                                <div class="table-responsive basic-data-table ">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
    <thead>
        <tr>
            <th scope="col">Sr</th>
            <th scope="col">Sale Num</th>
            <th scope="col">Sale Date</th>
            <th scope="col">Mature Date</th>
            <th scope="col">Paid Date</th>
            <th scope="col">Agent</th>
            <th scope="col">Buisness Name</th>
            <th scope="col">Service</th>
            <th scope="col">Commission</th>
            <th scope="col">Payout</th>
            <th scope="col">Amount Transfer</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>550</td>
            <td>28-01-2026</td>
            <td>23-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>RAJ INTERNATIONAL STORE LTD</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 76,230</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
        <tr>
            <td>2</td>
            <td>577</td>
            <td>06-02-2026</td>
            <td>26-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>TV MANCHESTER LTD</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 93,654</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
        <tr>
            <td>3</td>
            <td>578</td>
            <td>06-02-2026</td>
            <td>26-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>TV MANCHESTER LTD</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 93,654</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
        <tr>
            <td>4</td>
            <td>658</td>
            <td>24-02-2026</td>
            <td>26-02-2026</td>
            <td>02-03-2026</td>
            <td>Shoaib Shah</td>
            <td>K & B Food And Wine</td>
            <td>Card Machine (1)</td>
            <td><strong>PKR 93,654</strong></td>
            <td><span class="badge bg-success-focus text-success-main px-2 py-1">Finalized</span></td>
            <td>Transferred</td>
        </tr>
    </tbody>
    <tfoot>
        <tr class="bg-light">
            <td colspan="8" class="text-center"><strong>Total</strong></td>
            <td colspan="3"><strong>PKR 357,192</strong></td>
        </tr>
    </tfoot>
</table>
                                </div>
                                <!-- Clear All Logs Button -->

                                    <button type="submit" class="btn btn-warning"
                                        onclick="return confirm('Are you sure you want to clear all logs?')">
                                        Clear All Logs
                                    </button>




                </div>
            </div>
        </div>
    @endsection
