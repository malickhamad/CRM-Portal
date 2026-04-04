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

@endsection
