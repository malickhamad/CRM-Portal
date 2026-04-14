@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')


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
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="icon-box bg-total">
                                    <iconify-icon icon="ph:files-bold"></iconify-icon>
                                </div>
                                <div class="data-section">
                                    <span class="stat-label">Total Applications</span>
                                    <div class="stat-number">45</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="icon-box bg-pending">
                                    <iconify-icon icon="ph:timer-bold"></iconify-icon>
                                </div>
                                <div class="data-section">
                                    <span class="stat-label">Total Applications</span>
                                    <div class="stat-number">434</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="icon-box bg-live">
                                    <iconify-icon icon="ph:broadcast-bold"></iconify-icon>
                                </div>
                                <div class="data-section">
                                    <span class="stat-label">Live Applications</span>
                                    <div class="stat-number">30</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="premium-card">
                                <div class="icon-box bg-rejected">
                                    <iconify-icon icon="ph:x-circle-bold"></iconify-icon>
                                </div>
                                <div class="data-section">
                                    <span class="stat-label">Rejected Applications</span>
                                    <div class="stat-number">0</div>
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
            'step'  => 1,
        ],
        'Docs Required' => [
            'class' => 'status-docs',
            'width' => '15%',
            'step'  => 2,
        ],
        'Cot in process' => [
            'class' => 'status-cot',
            'width' => '25%',
            'step'  => 3,
        ],
        'Awaiting Signature' => [
            'class' => 'status-await',
            'width' => '35%',
            'step'  => 4,
        ],
        'Cot Done' => [
            'class' => 'status-done',
            'width' => '45%',
            'step'  => 5,
        ],
        'Signed' => [
            'class' => 'status-signed',
            'width' => '55%',
            'step'  => 6,
        ],
        'Submitted to Supplier' => [
            'class' => 'status-submit',
            'width' => '70%',
            'step'  => 7,
        ],
        'Cost Objected' => [
            'class' => 'status-object',
            'width' => '80%',
            'step'  => 8,
        ],
        'Live' => [
            'class' => 'status-live',
            'width' => '90%',
            'step'  => 9,
        ],
        'Rejected' => [
            'class' => 'status-reject',
            'width' => '100%',
            'step'  => 10,
        ],
        'Paid' => [
            'class' => 'status-paid',
            'width' => '100%',
            'step'  => 11,
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
        @foreach($applications as $item)
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
                    <div class="progress-bar-custom {{ $currentStatus['class'] }}" style="width:{{ $currentStatus['width'] }}"></div>
                </div>

                <div class="status-labels">
                    @foreach($statusLabels as $index => $label)
                        <span class="{{ ($index + 1) == $currentStatus['step'] ? 'status-active' : '' }}">
                            {{ $label }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>  





                {{-- Charts Section --}}
                <div class="col-md-6 col-12">
                    <div class="card p-24 shadow-sm">
                        <h6 class="fw-semibold mb-4 text-success-1000">Applications Line Chart</h6>
                        <canvas id="applicationsLineChart"></canvas>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card p-24 shadow-sm">
                        <h6 class="fw-semibold mb-4 text-success-1000">Applications Bar Chart</h6>
                        <canvas id="applicationsBarChart"></canvas>
                    </div>
                </div>


            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const labels = ['October', 'November', 'December', 'January', 'February', 'March'];

            const pendingData = [0, 0, 0, 2, 18, 10];
            const liveData = [0, 0, 0, 1, 6, 1];
            const rejectedData = [0, 0, 0, 0, 1, 0];

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
    if(section.classList.contains('fullscreen-mode')) {
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
