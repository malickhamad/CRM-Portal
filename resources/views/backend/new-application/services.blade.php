@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card basic-data-table">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000 ">Services </h4>
                         </div>
                                <div class="card-body  ">
                                    {{-- show here services --}}
                                    <div class="d-flex  justify-content-center min-vh-100">

                                        <div class="text-center ">

                                            <!-- Heading -->
                                            <h4 class="fw-semibold mb-0 text-success-1000">Our Services</h4>
                                            <p class="text-muted mb-5">Select a service to continue</p>

                                            <!-- Hidden Input -->
                                            <input type="hidden" id="selectedService">

                                            <!-- Cards -->
                                            <div class="d-flex justify-content-center gap-5 flex-wrap mb-4">

                                                <!-- Finance -->
                                                <div class="card border-0 shadow-sm service-card" data-service="finance">

                                                    <div class="service-img-box">
                                                        <img src="{{ asset('asset/crm/services/finance.png') }}"
                                                            class="img-fluid service-img">
                                                    </div>
                                                    <h6 class="fw-semibold text-secondary small mb-0">Finance</h6>
                                                </div>

                                                <!-- Utilities -->
                                                <div class="card border-0 shadow-sm service-card" data-service="utilities">

                                                    <div class="service-img-box">
                                                        <img src="{{ asset('asset/crm/services/Utilities.png') }}"
                                                            class="img-fluid service-img">
                                                    </div>
                                                    <h6 class="fw-semibold text-secondary small mb-0">Utilities</h6>
                                                </div>

                                            </div>

                                            <!-- Next Button -->
                                                <div class="mt-5">
                                                    <button
                                                        class="btn btn-brand-1 float-right next-btn">
                                                        Next →
                                                    </button>
                                                </div>


                                        </div>

                                    </div>

                                </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        </div>


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

       <script>
$(document).ready(function() {

    $(".service-card").click(function() {

        let service = $(this).data("service");
        $("#selectedService").val(service);

        $(".service-card").removeClass("selected");
        $(this).addClass("selected");

    });

    $(".next-btn").click(function() {

        let service = $("#selectedService").val();

        if (!service) {
            // SweetAlert instead of default alert
            Swal.fire({
                icon: 'warning',
                title: 'Oops!',
                text: 'Please select a service first!',
                confirmButtonText: 'OK'
            });
            return;
        }

        if (service === "finance") {
            window.location.href = "{{ route('admin.finance_services') }}";
        }

        if (service === "utilities") {
            window.location.href = "{{ route('admin.utilities_services') }}";
        }
    });

});
</script>

        <!-- Minimal Glass CSS -->
        <style>
            .service-card {
                width: 200px;
                height: 250px;
                border-radius: 16px;
                cursor: pointer;
                padding: 18px;
                transition: all 0.25s ease;

                /* ⭐ Glass effect */
                background: transparent;
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.4);
            }

            .service-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12) !important;
                background: transparent;
            }

            .service-img-box {
                height: 170px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .service-img {
                max-height: 200px;
                max-width: 100%;
                object-fit: contain;
                filter: grayscale(100%);
                transition: all 0.25s ease;
            }

            .service-card:hover .service-img {
                filter: grayscale(0%);
                transform: scale(1.08);
            }

            /* ⭐ Selected state */
            .service-card.selected {
                border: 2px solid #0d6efd;
                transform: scale(1.05);
                box-shadow: 0 12px 25px rgba(13, 110, 253, 0.25) !important;
            }

            .service-card.selected .service-img {
                filter: grayscale(0%);
                transform: scale(1.12);
            }
        </style>
    @endsection
