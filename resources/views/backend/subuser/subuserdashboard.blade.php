@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="container-fluid py-5">

            {{-- standards assigned by Owner --}}
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm border">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Standards Assigned By Owner</h6>
                        </div>
                        <div class="card-body">
                            @if (count($standards) > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Standard</th>
                                                <th>Description</th>
                                                <th>Sections</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($standards as $standard)
                                                <tr>
                                                    <td>{{ $standard->name }}</td>
                                                    <td>{{ Str::limit($standard->description, 50) }}</td>
                                                    <td>{{ $standard->sections->count() }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    No standards have been assigned to you yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Standards Completion Progress Section -->
            <div class="row ">
                <div class="col-12">
                    <div class="card shadow-sm border">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="m-0 font-weight-bold text-primary">My Standards Completion Progress</h6>
                        </div>
                        <div class="card-body">
                            @foreach ($completionData as $data)
                                <div class="mb-5">
                                    <h5 class="mb-3">{{ $data['name'] }}</h5>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3 mb-4">
                                            <div class="card h-100 border-0 shadow-sm">
                                                <div class="card-body text-center">
                                                    <div class="position-relative mx-auto"
                                                        style="width: 180px; height: 180px;">
                                                        <canvas id="progress-{{ $data['id'] }}" width="180"
                                                            height="180"></canvas>
                                                        <div
                                                            class="position-absolute top-50 start-50 translate-middle text-center">
                                                            <span
                                                                class="h4 font-weight-bold">{{ $data['percentage'] }}%</span>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <small class="text-muted">
                                                            {{ $data['completed_questions'] }} of
                                                            {{ $data['total_questions'] }} questions answered
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr class="my-4">
                                @endif
                            @endforeach

                            @if (count($completionData) === 0)
                                <div class="alert alert-warning mb-0">
                                    No standards assigned or completion data available
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection
    @push('custom-js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize progress charts
                @foreach ($completionData as $data)
                    new Chart(
                        document.getElementById('progress-{{ $data['id'] }}').getContext('2d'), {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [{{ $data['percentage'] }}, {{ 100 - $data['percentage'] }}],
                                    backgroundColor: ['#1cc88a', '#f8f9fa'],
                                    borderWidth: 0,
                                    borderRadius: 100
                                }]
                            },
                            options: {
                                cutout: '75%',
                                rotation: 0,
                                circumference: 360,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        enabled: false
                                    }
                                },
                                animation: {
                                    animateScale: true,
                                    animateRotate: true
                                },
                                responsive: true,
                                maintainAspectRatio: false
                            }
                        }
                    );
                @endforeach
            });
        </script>
    @endpush
