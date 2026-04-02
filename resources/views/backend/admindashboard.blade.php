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
                                    <div class="stat-number">{{ number_format($totalUsers) }}</div>
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


                {{-- Pending sales status  --}}
                <div id="pendingSalesSection" class=" mb-4">

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
                        <div class="app-box-item">
                            <div class="app-header">
                                <strong>Application #632</strong>
                                <span>(19 Feb, 2026)</span>
                                <span class="status-badge status-docs">Docs Required</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar-custom status-paid" style="width:15%"></div>
                            </div>
                            <div class="status-labels">
                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                <span>Live</span><span>Rejected</span><span>Paid</span>
                            </div>
                        </div>

                        <div class="app-box-item">
                            <div class="app-header">
                                <strong>Application #635</strong>
                                <span>(18 Feb, 2026)</span>
                                <span class="status-badge status-object">Cot Done</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar-custom status-object" style="width:45%"></div>
                            </div>
                            <div class="status-labels">
                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                <span>Live</span><span>Rejected</span><span>Paid</span>
                            </div>
                        </div>
                        <div class="app-box-item">
                            <div class="app-header">
                                <strong>Application #22</strong>
                                <span>(19 Feb, 2026)</span>
                                <span class="status-badge status-reject">Docs Required</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar-custom status-reject" style="width:90%"></div>
                            </div>
                            <div class="status-labels">
                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                <span>Live</span><span>Reject</span><span>Paid</span>
                            </div>
                        </div>
                        <div class="app-box-item">
                            <div class="app-header">
                                <strong>Application #635</strong>
                                <span>(18 Feb, 2026)</span>
                                <span class="status-badge status-done">Object</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar-custom status-done" style="width:45%"></div>
                            </div>
                            <div class="status-labels">
                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                <span>Live</span><span>Rejected</span><span>Paid</span>
                            </div>
                        </div>
                        <div class="app-box-item">
                            <div class="app-header">
                                <strong>Application #6344</strong>
                                <span>(19 Feb, 2026)</span>
                                <span class="status-badge status-paid">Docs Required</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar-custom status-paid " style="width:100%"></div>
                            </div>
                            <div class="status-labels">
                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                <span>Live</span><span>Rejected</span><span>Paid</span>
                            </div>
                        </div>
                        <div class="app-box-item">
                            <div class="app-header">
                                <strong>Application #635</strong>
                                <span>(18 Feb, 2026)</span>
                                <span class="status-badge status-done">Cot Done</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar-custom status-done" style="width:45%"></div>
                            </div>
                            <div class="status-labels">
                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                <span>Live</span><span>Rejected</span><span>Paid</span>
                            </div>
                        </div>
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
