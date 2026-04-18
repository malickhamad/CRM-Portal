@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
<style>
      /* Card Main Container */
                    .premium-card {
                        background: #ffffff;
                        border-radius: 16px;
                        padding: 16px 20px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                        /* Soft Shadow */
                        border: none;
                    }

                    /* Label Styling (Top text) */
                    .stat-label {
                        color: #67748e;
                        font-size: 14px;
                        font-weight: 600;
                        display: block;
                        margin-bottom: 4px;
                    }

                    /* Number Styling */
                    .stat-number {
                        color: #252f40;
                        font-size: 20px;
                        font-weight: 700;
                        display: flex;
                        align-items: center;
                    }

                    /* Percentage Badges */
                    .percentage {
                        font-size: 13px;
                        margin-left: 8px;
                        font-weight: 700;
                    }

                    .positive {
                        color: #82d616;
                    }

                    .negative {
                        color: #ea0606;
                    }

                    /* Gradient Icon Box Styling */
                    .icon-box {
                        width: 48px;
                        height: 48px;
                        background: linear-gradient(310deg, #7928ca 0%, #ff0080 100%);
                        border-radius: 12px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        color: white;
                        font-size: 22px;
                        box-shadow: 0 4px 10px rgba(234, 6, 6, 0.2);
                    }

                    /* Iconify Icon Adjustment */
                    iconify-icon {
                        display: block;
                    }
</style>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Dashboard</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="dashboard"
                            class="d-flex align-items-center gap-1 fw-semibold text-md hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-semibold text-md text-success-1000">CRM</li>
                </ul>
            </div>

            <div class="row gy-4">

                {{-- Total Applications section --}}
                <div class="container-fluid py-4">
                    <div class="row g-4 mt-2">
                        <!-- Total Applications Card -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="data-section">
                                    <span class="stat-label">Total Applications</span>
                                    <div class="stat-number">{{ $totalApplications }}
                                        <span
                                            class="percentage {{ $totalApplicationsChange > 0 ? 'positive' : 'negative' }}">
                                            {{ $totalApplicationsChange > 0 ? '+' : '' }}{{ $totalApplicationsChange }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <iconify-icon icon="ph:wallet-fill"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Applications Card -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="data-section">
                                    <span class="stat-label">Pending</span>
                                    <div class="stat-number">{{ $pendingApplications }}
                                        <span
                                            class="percentage {{ $pendingApplicationsChange > 0 ? 'positive' : 'negative' }}">
                                            {{ $pendingApplicationsChange > 0 ? '+' : '' }}{{ $pendingApplicationsChange }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <iconify-icon icon="ph:globe-hemisphere-west-fill"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <!-- Live Applications Card -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="data-section">
                                    <span class="stat-label">Live Applications</span>
                                    <div class="stat-number">{{ $liveApplications }}
                                        <span
                                            class="percentage {{ $liveApplicationsChange > 0 ? 'positive' : 'negative' }}">
                                            {{ $liveApplicationsChange > 0 ? '+' : '' }}{{ $liveApplicationsChange }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <iconify-icon icon="ph:file-text-fill"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        <!-- Rejected Applications Card -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="data-section">
                                    <span class="stat-label">Rejected</span>
                                    <div class="stat-number">{{ $rejectedApplications }}
                                        <span
                                            class="percentage {{ $rejectedApplicationsChange > 0 ? 'positive' : 'negative' }}">
                                            {{ $rejectedApplicationsChange > 0 ? '+' : '' }}{{ $rejectedApplicationsChange }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="icon-box">
                                    <iconify-icon icon="ph:flag-fill"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                @php
                    $statusMap = [
                        'App Sent' => [
                            'class' => 'status-app',
                            'width' => '8%',
                            'step' => 1,
                        ],
                        'Docs Required' => [
                            'class' => 'status-docs',
                            'width' => '15%',
                            'step' => 2,
                        ],
                        'Cot in process' => [
                            'class' => 'status-cot',
                            'width' => '25%',
                            'step' => 3,
                        ],
                        'Awaiting Signature' => [
                            'class' => 'status-await',
                            'width' => '35%',
                            'step' => 4,
                        ],
                        'Cot Done' => [
                            'class' => 'status-done',
                            'width' => '45%',
                            'step' => 5,
                        ],
                        'Signed' => [
                            'class' => 'status-signed',
                            'width' => '55%',
                            'step' => 6,
                        ],
                        'Submitted to Supplier' => [
                            'class' => 'status-submit',
                            'width' => '70%',
                            'step' => 7,
                        ],
                        'Cost Objected' => [
                            'class' => 'status-object',
                            'width' => '80%',
                            'step' => 8,
                        ],
                        'Live' => [
                            'class' => 'status-live',
                            'width' => '90%',
                            'step' => 9,
                        ],
                        'Rejected' => [
                            'class' => 'status-reject',
                            'width' => '100%',
                            'step' => 10,
                        ],
                        'Paid' => [
                            'class' => 'status-paid',
                            'width' => '100%',
                            'step' => 11,
                        ],
                    ];

                    $statusLabels = [
                        'App Sent',
                        'Docs Required',
                        'Cot in process',
                        'Awaiting Signature',
                        'Cot Done',
                        'Signed',
                        'Submitted to Supplier',
                        'Cost Objected',
                        'Live',
                        'Rejected',
                        'Paid',
                    ];
                @endphp
                {{-- Pending sales status  --}}
                <div id="pendingSalesSection" class="mb-4">
                    <div class="custom-card-header">
                        <div class="header-left">
                            <i class="fas fa-list-alt"></i>
                            <span class="header-title">Pending Sales Status</span>
                        </div>
                        <div class="header-right">
                            <button class="header-btn" title="Settings">&#9881;</button>
                            <button class="header-btn" onclick="toggleMinimize()" title="Minimize">&#8211;</button>
                            <button class="header-btn" onclick="toggleFullscreen()" title="Full View">&#9723;</button>
                            <button class="header-btn close-btn" onclick="closeWidget()" title="Close">&#10005;</button>
                        </div>
                    </div>

                    <div id="scrollContainer" class="applications-container">
                        @foreach ($applications as $item)
                            @php
                                $currentStatus = $statusMap[$item->status] ?? [
                                    'class' => 'inactive',
                                    'width' => '0%',
                                    'step' => 0,
                                ];
                            @endphp

                            <div class="app-box-item">
                                <div class="app-header">
                                    <strong>Application #{{ $item->id }}</strong>
                                    <span>({{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }})</span>
                                    <span class="status-badge {{ $currentStatus['class'] }}">{{ $item->status }}</span>
                                </div>

                                <div class="progress-track">
                                    <div class="progress-bar-custom {{ $currentStatus['class'] }}"
                                        style="width:{{ $currentStatus['width'] }}"></div>
                                </div>

                                <div class="status-labels">
                                    @foreach ($statusLabels as $index => $label)
                                        <span class="{{ $index + 1 == $currentStatus['step'] ? 'status-active' : '' }}">
                                            {{ $label }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>





                {{-- Charts Section --}}
                <div class="container-fluid py-4">
                    <div class="row g-4 mt-2">
                        <!-- Total Applications Line Chart -->
                        <div class="col-md-6 col-12">
                            <div class="card p-24 shadow-sm">
                                <h6 class="fw-semibold mb-4 text-success-1000">Applications Line Chart</h6>
                                <canvas id="applicationsLineChart"></canvas>
                            </div>
                        </div>

                        <!-- Applications Bar Chart -->
                        <div class="col-md-6 col-12">
                            <div class="card p-24 shadow-sm">
                                <h6 class="fw-semibold mb-4 text-success-1000">Applications Bar Chart</h6>
                                <canvas id="applicationsBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Dynamically passed data from the backend (Laravel)
   const labels = @json($monthLabels);  // Get the dynamic month names from the backend

const pendingData = @json($pendingData);  // Dynamic data for pending applications
const liveData = @json($liveData);  // Dynamic data for live applications
const rejectedData = @json($rejectedData);  // Dynamic data for rejected applications

// ✅ LINE CHART
const lineCtx = document.getElementById('applicationsLineChart').getContext('2d');
new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
                label: 'Pending',
                data: pendingData,
                borderColor: '#9C27B0',
                backgroundColor: 'rgba(156, 39, 176, 0.2)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Live',
                data: liveData,
                borderColor: '#2196F3',
                backgroundColor: 'rgba(33, 150, 243, 0.2)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Rejected',
                data: rejectedData,
                borderColor: '#FF9800',
                backgroundColor: 'rgba(255, 152, 0, 0.2)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});

// ✅ BAR CHART
const barCtx = document.getElementById('applicationsBarChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
                label: 'Pending',
                data: pendingData,
                backgroundColor: '#E0E0E0'
            },
            {
                label: 'Live',
                data: liveData,
                backgroundColor: '#90CAF9'
            },
            {
                label: 'Rejected',
                data: rejectedData,
                backgroundColor: '#B0BEC5'
            }
        ]
    },
    options: {
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>



        {{-- pending sales status section script --}}

        <script>
            function toggleMinimize() {
                const container = document.getElementById('scrollContainer');
                if (container.style.display === "none") {
                    container.style.display = "block";
                } else {
                    container.style.display = "none";
                }
            }

            function toggleFullscreen() {
                // Sirf is specific section ko target karna hai
                const section = document.getElementById('pendingSalesSection');
                section.classList.toggle('fullscreen-mode');

                // Dashboard ke baaki content ko disturb kiye baghair scroll lock karna
                if (section.classList.contains('fullscreen-mode')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            }

            function closeWidget() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to close the Pending Sales Status section?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, close it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const section = document.getElementById('pendingSalesSection');

                        // Adding a smooth fade-out effect
                        section.style.transition = "opacity 0.4s ease";
                        section.style.opacity = "0";

                        setTimeout(() => {
                            section.style.display = 'none';
                            document.body.style.overflow = 'auto'; // Reset scroll if closed in fullscreen
                        }, 400);

                        // Success message
                        Swal.fire(
                            'Closed!',
                            'The section has been hidden.',
                            'success'
                        )
                    }
                })
            }
        </script>
    @endsection
