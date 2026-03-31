@extends('backend.layouts.app')

@section('content')

<main class="dashboard-main">
    @include('backend.layouts.partials.header')

    <div class="dashboard-main-body bg-light">

        <div class="d-flex align-items-center justify-content-center min-vh-100">

            <div class="text-center w-100 px-3">

                <!-- Heading -->
                <h4 class="fw-bold mb-1 text-dark">Our utilities_services</h4>
                <p class="text-muted mb-5">Select a service to continue</p>

                <!-- Cards -->
                <div class="d-flex justify-content-center gap-5 flex-wrap mb-4">

                    <!-- Card 1 -->
                    <div class="card border-0 shadow-sm service-card bg-white">
                        <div class="service-img-box">
                            <img src="{{asset('asset/crm/services/finance.png')}}" class="img-fluid service-img">
                        </div>
                        <h6 class="fw-semibold text-secondary small mb-0">Finance</h6>
                    </div>

                    <!-- Card 2 -->
                    <div class="card border-0 shadow-sm service-card bg-white">
                        <div class="service-img-box">
                            <img src="{{asset('asset/crm/services/Utilities.png')}}" class="img-fluid service-img">
                        </div>
                        <h6 class="fw-semibold text-secondary small mb-0">Utilities</h6>
                    </div>

                </div>

                <!-- Next Button -->
                   <!-- Next Button -->
                <div class="mt-5">
                    <button class="btn btn-primary px-5 py-2 rounded-pill shadow-lg fw-semibold next-btn">
                        Next →
                    </button>
                </div>

            </div>

        </div>

    </div>

<!-- CSS -->
<style>
    .service-card {
        width: 200px;
        height: 250px;
        border-radius: 16px;
        transition: all 0.25s ease;
        cursor: pointer;
        padding: 18px;
    }

    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0,0,0,0.12) !important;
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

</style>

@endsection