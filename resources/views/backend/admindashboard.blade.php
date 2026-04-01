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


                <div class="card-body  ">
                    {{-- show here logs --}}
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='5'>
                            <thead>
                                <tr>
                                    <th style="width:80px;">S.L</th>
                                    <th>Applications</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!-- 2 -->

                                 <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #632</strong>
                                                <span>(19 Feb, 2026)</span>
                                                <span class="status-text">Docs Required</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-docs" style="width:15%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>






                                <!-- 5 -->
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #635</strong>
                                                <span>(18 Feb, 2026)</span>
                                                <span class="status-text">Cot Done</span>
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
                                    </td>
                                </tr>


                                  <!-- 10 -->
                                <tr>
                                    <td>10</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #640</strong>
                                                <span>(16 Feb, 2026)</span>
                                                <span class="status-text">Rejected</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-reject" style="width:95%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <!-- 6 -->
                                <tr>
                                    <td>6</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #636</strong>
                                                <span>(18 Feb, 2026)</span>
                                                <span class="status-text">Signed</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-signed" style="width:55%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                   <!-- 3 -->
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #633</strong>
                                                <span>(19 Feb, 2026)</span>
                                                <span class="status-text">Cot in process</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-cot" style="width:25%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- 4 -->
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #634</strong>
                                                <span>(18 Feb, 2026)</span>
                                                <span class="status-text">Awaiting Signature</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-await" style="width:35%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- 7 -->
                                <tr>
                                    <td>7</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #637</strong>
                                                <span>(17 Feb, 2026)</span>
                                                <span class="status-text">Submitted to Supplier</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-submit" style="width:65%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                 <!-- 1 -->
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #631</strong>
                                                <span>(19 Feb, 2026)</span>
                                                <span class="status-text">App Sent</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-app" style="width:5%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- 8 -->
                                <tr>
                                    <td>8</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #638</strong>
                                                <span>(17 Feb, 2026)</span>
                                                <span class="status-text">Cost Objected</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-object" style="width:75%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- 9 -->
                                <tr>
                                    <td>9</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #639</strong>
                                                <span>(16 Feb, 2026)</span>
                                                <span class="status-text">Live</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-live" style="width:85%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <!-- 11 -->
                                <tr>
                                    <td>11</td>
                                    <td>
                                        <div class="app-box">
                                            <div class="app-header">
                                                <strong>Application #641</strong>
                                                <span>(15 Feb, 2026)</span>
                                                <span class="status-text">Paid</span>
                                            </div>
                                            <div class="progress-track">
                                                <div class="progress-bar-custom status-paid" style="width:100%"></div>
                                            </div>
                                            <div class="status-labels">
                                                <span>App Sent</span><span>Docs Required</span><span>Cot in process</span>
                                                <span>Awaiting Signature</span><span>Cot Done</span><span>Signed</span>
                                                <span>Submitted to Supplier</span><span>Cost Objected</span>
                                                <span>Live</span><span>Rejected</span><span>Paid</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>



                <style>
                    /* ===== Application Box ===== */
                    .app-box {
                        padding: 10px 0;
                    }

                    /* ===== Header ===== */
                    .app-header {
                        display: flex;
                        gap: 10px;
                        align-items: center;
                        font-size: 13px;
                        margin-bottom: 6px;
                    }

                    .app-header .status-text {
                        margin-left: auto;
                        font-weight: 600;
                        color: #444;
                    }

                    /* ===== Progress Bar ===== */
                    .progress-track {
                        width: 100%;
                        height: 12px;
                        background: #e5e5e5;
                        border-radius: 20px;
                        overflow: hidden;
                        margin-bottom: 6px;
                    }

                    /* Default Grey (completed/inactive look) */
                    .progress-bar-custom {
                        height: 100%;
                        background: repeating-linear-gradient(45deg,
                                #bdbdbd,
                                #bdbdbd 8px,
                                #9e9e9e 8px,
                                #9e9e9e 16px);
                    }

                    /* Active (Purple striped like image) */
                    .progress-bar-custom.active {
                        background: repeating-linear-gradient(45deg,
                                #d05ce3,
                                #d05ce3 8px,
                                #ba68c8 8px,
                                #ba68c8 16px);
                    }

                    /* Base Style */
                    .progress-bar-custom {
                        height: 100%;
                        transition: background 0.3s ease;
                        /* Smooth color change */
                    }

                    /* 1. App Sent - Light Blue */
                    .progress-bar-custom.status-app {
                        background: repeating-linear-gradient(45deg, #4fc3f7, #4fc3f7 8px, #29b6f6 8px, #29b6f6 16px);
                    }

                    /* 2. Docs Required - Amber/Yellow */
                    .progress-bar-custom.status-docs {
                        background: repeating-linear-gradient(45deg, #ffd54f, #ffd54f 8px, #ffca28 8px, #ffca28 16px);
                    }

                    /* 3. Cot in process - Purple */
                    .progress-bar-custom.status-cot {
                        background: repeating-linear-gradient(45deg, #ba68c8, #ba68c8 8px, #ab47bc 8px, #ab47bc 16px);
                    }

                    /* 4. Awaiting Signature - Orange */
                    .progress-bar-custom.status-await {
                        background: repeating-linear-gradient(45deg, #ffb74d, #ffb74d 8px, #ffa726 8px, #ffa726 16px);
                    }

                    /* 5. Cot Done - Teal */
                    .progress-bar-custom.status-done {
                        background: repeating-linear-gradient(45deg, #4db6ac, #4db6ac 8px, #26a69a 8px, #26a69a 16px);
                    }

                    /* 6. Signed - Indigo */
                    .progress-bar-custom.status-signed {
                        background: repeating-linear-gradient(45deg, #7986cb, #7986cb 8px, #5c6bc0 8px, #5c6bc0 16px);
                    }

                    /* 7. Submitted to Supplier - Deep Blue */
                    .progress-bar-custom.status-submit {
                        background: repeating-linear-gradient(45deg, #64b5f6, #64b5f6 8px, #42a5f5 8px, #42a5f5 16px);
                    }

                    /* 8. Cost Objected - Pink/Alert */
                    .progress-bar-custom.status-object {
                        background: repeating-linear-gradient(45deg, #f06292, #f06292 8px, #ec407a 8px, #ec407a 16px);
                    }

                    /* 9. Live - Green (Success) */
                    .progress-bar-custom.status-live {
                        background: repeating-linear-gradient(45deg, #81c784, #81c784 8px, #66bb6a 8px, #66bb6a 16px);
                    }

                    /* 10. Rejected - Red (Error) */
                    .progress-bar-custom.status-reject {
                        background: repeating-linear-gradient(45deg, #e57373, #e57373 8px, #ef5350 8px, #ef5350 16px);
                    }

                    /* 11. Paid - Gold/Bright Green */
                    .progress-bar-custom.status-paid {
                        background: repeating-linear-gradient(45deg, #aed581, #aed581 8px, #9ccc65 8px, #9ccc65 16px);
                    }

                    /* Default Grey (Inactive) */
                    .progress-bar-custom.inactive {
                        background: repeating-linear-gradient(45deg, #bdbdbd, #bdbdbd 8px, #9e9e9e 8px, #9e9e9e 16px);
                    }

                    /* ===== Status Labels ===== */
                    .status-labels {
                        display: flex;
                        justify-content: space-between;
                        font-size: 10px;
                        flex-wrap: wrap;
                        gap: 5px;
                    }

                    /* ===== Optional: Active Highlight ===== */
                    .status-active {
                        font-weight: 700;
                        text-decoration: underline;
                    }
                </style>



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

        <style>
            /* Premium Minimalist Dashboard V3 */
            .premium-card {
                background: #ffffff;
                border-radius: 12px;
                padding: 1.5rem;
                border: 1px solid #f0f2f5;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                height: 100%;
                display: flex;
                align-items: center;
                gap: 1.25rem;
            }

            .premium-card:hover {
                box-shadow: 0 10px 30px -10px rgba(0, 155, 64, 0.63);
                transform: translateY(-3px);
                rgba(8, 177, 78, 0.15)rgb(8, 177, 78)rgb(38, 255, 129)
            }

            /* Icon Box: Rounded Square (Not Circle) for Modern Look */
            .icon-box {
                width: 56px;
                height: 56px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                font-size: 24px;
            }

            .data-section {
                flex-grow: 1;
            }

            .stat-label {
                color: #64748b;
                font-size: 0.85rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.8px;
                margin-bottom: 4px;
                display: block;
            }

            .stat-number {
                font-size: 1.75rem;
                font-weight: 700;
                color: #0f172a;
                line-height: 1.2;
            }

            /* Professional Muted Colors */
            .bg-total {
                background-color: #f1f5f9;
                color: #0e522a;
            }

            /* Neutral Greenish Gray */
            .bg-pending {
                background-color: #fff7ed;
                color: #f59e0b;
            }

            /* Soft Amber */
            .bg-live {
                background-color: #f0fdf4;
                color: #10b981;
            }

            /* Soft Emerald */
            .bg-rejected {
                background-color: #fef2f2;
                color: #ef4444;
            }

            /* Soft Rose */

            /* Small Trend Indicator (Optional but looks premium) */
            .trend-text {
                font-size: 0.75rem;
                font-weight: 600;
                margin-top: 4px;
                display: flex;
                align-items: center;
                gap: 4px;
            }
        </style>
    @endsection
