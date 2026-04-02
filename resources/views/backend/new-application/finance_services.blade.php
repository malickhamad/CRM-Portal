@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body bg-light position-relative">

            <!-- ⭐ Attractive Back Button (Bootstrap only) -->
            <div class="position-absolute top-0 start-0 mt-3 ms-3">
                <a href="javascript:history.back()"
                    class="btn btn-light border shadow-sm rounded-pill px-3 py-2 fw-semibold
                      d-flex align-items-center gap-2 bg_green_color">
                    ← Back
                </a>
            </div>
            <div class="d-flex align-items-center justify-content-center min-vh-100">

                <div class="text-center w-100 px-3">


                    <!-- Heading -->
                    <h4 class="fw-bold mb-1 green_color">Our Finance
                        Services</h4>
                    <p class="text-muted mb-5">Select a service to continue</p>

                    <!-- Hidden Input -->
                    <input type="hidden" id="selectedService">

                    <!-- Cards -->
                    <div class="d-flex justify-content-center gap-5 flex-wrap mb-4">

                        <!-- Finance -->
                        <div class="card border-0 shadow-sm service-card" data-service="card_machine">

                            <div class="service-img-box">
                                <img src="{{ asset('asset/crm/services/card_machine.png') }}" class="img-fluid service-img">
                            </div>
                            <h6 class="fw-semibold text-secondary small mb-0">Card Machine</h6>
                        </div>

                        <!-- Finance -->
                        <div class="card border-0 shadow-sm service-card" data-service="loan">

                            <div class="service-img-box">
                                <img src="{{ asset('asset/crm/services/loan.png') }}" class="img-fluid service-img">
                            </div>
                            <h6 class="fw-semibold text-secondary small mb-0">Loan</h6>
                        </div>

                        <!-- Utilities -->
                        <div class="card border-0 shadow-sm service-card" data-service="open_banking">

                            <div class="service-img-box">
                                <img src="{{ asset('asset/crm/services/open_banking.png') }}" class="img-fluid service-img">
                            </div>
                            <h6 class="fw-semibold text-secondary small mb-0">Open Banking</h6>
                        </div>

                    </div>

                    <!-- Next Button -->
                    <div class="mt-5">
                        <button class="btn btn-brand-1 float-right px-5 rounded-pill shadow-lg fw-semibold next-btn bg_green_color">
                            Next →
                        </button>
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
                    alert("Please select a service first!");
                    return;
                }

                if (service === "loan") {
                    window.location.href = "{{ route('admin.loan') }}";
                }
                if (service === "card_machine") {
                    window.location.href = "{{ route('admin.card_machine') }}";
                }

                if (service === "open_banking") {
                    window.location.href = "{{ route('admin.open_banking') }}";
                }
            });

        });
    </script>

    <!-- Minimal Glass CSS -->
    <style>
          .green_color {
                color: #14532d !important;
            }
             .bg_green_color {
                background-color: #14532d !important;
                color: white !important;
            }
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
            border: 2px solid #14532d;
            background: rgb(184 213 191 / 25%);
            transform: scale(1.05);
            box-shadow: 0 12px 25px rgba(54, 177, 85, 0.25) !important;
        }

        .service-card.selected .service-img {
            filter: grayscale(0%);
            transform: scale(1.12);
        }
    </style>
@endsection
