@extends('backend.layouts.app')

@section('content')
<main class="dashboard-main">
    @include('backend.layouts.partials.header')


    @if (auth::user()->hasRole('User'))

    <div class="mt-5 mx-4">
    <!-- Welcome Section -->
    <div class="welcome-section  text-white py-4 px-4 mb-4 rounded-3 mx-3 ">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1 fw-bold">Welcome back, {{ auth::user()->name }}! 👋</h5>
                <p class="mb-0 opacity-75">Here's what's happening with your business today</p>
            </div>
            <div class="d-none d-md-block">
                <span class="badge bg-light text-dark p-3">
                    <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('l, d M Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-4 mb-4 px-3">
        <!-- Total Sales Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-primary rounded-circle p-3 me-3">
                            <i class="fas fa-shopping-cart fa-2x text-primary"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Today's Sales</p>
                            <h6 class="fw-bold mb-0">Rs. 45,678</h6>
                            <small class="text-success"><i class="fas fa-arrow-up me-1"></i>+12.5%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Purchases Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-success rounded-circle p-3 me-3">
                            <i class="fas fa-truck fa-2x text-success"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Today's Purchases</p>
                            <h6 class="fw-bold mb-0">Rs. 32,890</h6>
                            <small class="text-danger"><i class="fas fa-arrow-down me-1"></i>-5.2%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Value Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-warning rounded-circle p-3 me-3">
                            <i class="fas fa-boxes fa-2x text-warning"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Stock Value</p>
                            <h6 class="fw-bold mb-0">Rs. 2.45M</h6>
                            <small class="text-info"><i class="fas fa-minus me-1"></i>Stable</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-info rounded-circle p-3 me-3">
                            <i class="fas fa-clipboard-list fa-2x text-info"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Pending Orders</p>
                            <h6 class="fw-bold mb-0">24</h6>
                            <small class="text-warning"><i class="fas fa-clock me-1"></i>Need attention</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats Cards -->
    <div class="row g-4 mb-4 px-3">
        <!-- Total Customers -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-purple rounded-circle p-3 me-3" style="background: rgba(111, 66, 193, 0.1);">
                            <i class="fas fa-users fa-2x" style="color: #6f42c1;"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Total Customers</p>
                            <h6 class="fw-bold mb-0">{{ $subusersCount ?? 1,284 }}</h6>
                            <small class="text-success"><i class="fas fa-user-plus me-1"></i>+48 new</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-danger rounded-circle p-3 me-3" style="background: rgba(220, 53, 69, 0.1);">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Low Stock Items</p>
                            <h6 class="fw-bold mb-0">12</h6>
    6                       <sma6l class="text-danger"><i class="fas fa-arrow-up me-1"></i>+3 today</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Profit -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-success rounded-circle p-3 me-3" style="background: rgba(40, 167, 69, 0.1);">
                            <i class="fas fa-chart-line fa-2x text-success"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Today's Profit</p>
                            <h6 class="fw-bold mb-0">Rs. 12,788</66>
                            <sma6l class="text-success"><i class="fas fa-arrow-up me-1"></i>+8.3%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Order Value -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-soft-secondary rounded-circle p-3 me-3" style="background: rgba(108, 117, 125, 0.1);">
                            <i class="fas fa-calculator fa-2x text-secondary"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-1">Avg. Order Value</p>
                            <h6 class="fw-bold mb-0">Rs. 3,450</h6>
                            <small class="text-success"><i class="fas fa-arrow-up me-1"></i>+5%</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mt-4 mb-4 px-3">
        <!-- Sales & Purchases Chart -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Sales & Purchases Overview</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary active">Week</button>
                            <button type="button" class="btn btn-sm btn-outline-primary">Month</button>
                            <button type="button" class="btn btn-sm btn-outline-primary">Year</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="salesPurchasesChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="col-xl-4 ">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="fw-bold mb-0">Top Selling Products</h5>
                </div>
                <div class="card-body">
                    <div class="top-products-list">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <img src="https://via.placeholder.com/40" class="rounded" alt="product">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1"><b>iPhone 13 Pro</b> </p>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" style="width: 85%"></div>
                                </div>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold">85</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <img src="https://via.placeholder.com/40" class="rounded" alt="product">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Samsung TV 55"</h6>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-info" style="width: 70%"></div>
                                </div>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold">70</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <img src="https://via.placeholder.com/40" class="rounded" alt="product">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Nike Air Max</h6>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-warning" style="width: 65%"></div>
                                </div>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold">65</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <img src="https://via.placeholder.com/40" class="rounded" alt="product">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">MacBook Pro</h6>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-danger" style="width: 50%"></div>
                                </div>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold">50</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Stock Status -->
    <div class="row g-4 mt-4 mb-4 px-3">
        <!-- Recent Orders -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Orders</h5>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Products</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="fw-bold">#ORD-001</span></td>
                                    <td>John Doe</td>
                                    <td>iPhone 13, Case</td>
                                    <td>Rs. 154,999</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>10 min ago</td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">#ORD-002</span></td>
                                    <td>Jane Smith</td>
                                    <td>Samsung TV, Stand</td>
                                    <td>Rs. 89,999</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                    <td>25 min ago</td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">#ORD-003</span></td>
                                    <td>Mike Johnson</td>
                                    <td>Nike Shoes, Socks</td>
                                    <td>Rs. 12,999</td>
                                    <td><span class="badge bg-info">Processing</span></td>
                                    <td>1 hour ago</td>
                                </tr>
                                <tr>
                                    <td><span class="fw-bold">#ORD-004</span></td>
                                    <td>Sarah Wilson</td>
                                    <td>MacBook Pro</td>
                                    <td>Rs. 249,999</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>2 hours ago</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Status -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="fw-bold mb-0">Stock Status</h5>
                </div>
                <div class="card-body">
                    <div class="stock-items">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <i class="fas fa-circle text-success me-2" style="font-size: 8px;"></i>
                                <span>In Stock</span>
                            </div>
                            <span class="fw-bold">1,245 items</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <i class="fas fa-circle text-warning me-2" style="font-size: 8px;"></i>
                                <span>Low Stock</span>
                            </div>
                            <span class="fw-bold">12 items</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <i class="fas fa-circle text-danger me-2" style="font-size: 8px;"></i>
                                <span>Out of Stock</span>
                            </div>
                            <span class="fw-bold">8 items</span>
                        </div>
                    </div>

                    <hr>

                    <h6 class="fw-bold mt-3">Low Stock Alert</h6>
                    <div class="alert alert-warning py-2 mb-2">
                        <small><i class="fas fa-exclamation-triangle me-2"></i>iPhone 13 Pro - Only 2 left</small>
                    </div>
                    <div class="alert alert-warning py-2 mb-2">
                        <small><i class="fas fa-exclamation-triangle me-2"></i>Samsung TV - Only 1 left</small>
                    </div>
                    <div class="alert alert-warning py-2 mb-0">
                        <small><i class="fas fa-exclamation-triangle me-2"></i>Nike Air Max - Only 3 left</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Activity & Payment Methods -->
    <div class="row g-4 mb-4 px-3">
        <!-- Recent Customers -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Customers</h5>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="customer-list">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="customer">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">John Doe</h6>
                                <small class="text-muted">john@example.com</small>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark">12 orders</span>
                                <small class="text-muted ms-2">Rs. 45,678</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="customer">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Jane Smith</h6>
                                <small class="text-muted">jane@example.com</small>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark">8 orders</span>
                                <small class="text-muted ms-2">Rs. 32,890</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="customer">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Mike Johnson</h6>
                                <small class="text-muted">mike@example.com</small>
                            </div>
                            <div>
                                <span class="badge bg-light text-dark">5 orders</span>
                                <small class="text-muted ms-2">Rs. 15,450</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="fw-bold mb-0">Payment Methods</h5>
                </div>
                <div class="card-body">
                    <canvas id="paymentChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif


@endsection

@push('custom-css')
<style>
    /* Custom Styles */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-soft-primary {
        background: rgba(13, 110, 253, 0.1);
    }

    .bg-soft-success {
        background: rgba(25, 135, 84, 0.1);
    }

    .bg-soft-warning {
        background: rgba(255, 193, 7, 0.1);
    }

    .bg-soft-info {
        background: rgba(13, 202, 240, 0.1);
    }

    .bg-soft-danger {
        background: rgba(220, 53, 69, 0.1);
    }

    .bg-soft-purple {
        background: rgba(111, 66, 193, 0.1);
    }

    .bg-soft-secondary {
        background: rgba(108, 117, 125, 0.1);
    }

    .card {
        border-radius: 15px;
    }

    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
    }

    .badge {
        padding: 8px 12px;
        font-weight: 500;
    }

    .progress {
        border-radius: 10px;
        background-color: #e9ecef;
    }

    .progress-bar {
        border-radius: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .welcome-section {
            text-align: center;
        }

        .stat-card .card-body {
            padding: 1.25rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
        }

        .stat-icon i {
            font-size: 1.5rem;
        }

        h3.fw-bold {
            font-size: 1.5rem;
        }
    }

    /* Chart container */
    canvas {
        max-height: 100%;
        width: 100% !important;
    }

    /* Smooth transitions */
    .btn-group .btn {
        transition: all 0.3s ease;
    }

    .btn-group .btn:hover {
        transform: translateY(-2px);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Animation for cards */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card, .card {
        animation: fadeInUp 0.5s ease forwards;
    }

    /* Stagger animation for cards */
    .col-xl-3:nth-child(1) .stat-card { animation-delay: 0.1s; }
    .col-xl-3:nth-child(2) .stat-card { animation-delay: 0.2s; }
    .col-xl-3:nth-child(3) .stat-card { animation-delay: 0.3s; }
    .col-xl-3:nth-child(4) .stat-card { animation-delay: 0.4s; }
</style>
@endpush

@push('custom-js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sales & Purchases Chart
        const ctx1 = document.getElementById('salesPurchasesChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales',
                    data: [45000, 52000, 48000, 58000, 62000, 55000, 68000],
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Purchases',
                    data: [38000, 42000, 45000, 48000, 50000, 47000, 52000],
                    borderColor: '#FF9800',
                    backgroundColor: 'rgba(255, 152, 0, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rs. ' + value;
                            }
                        }
                    }
                }
            }
        });

        // Payment Methods Chart
        const ctx2 = document.getElementById('paymentChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Cash', 'Card', 'Online Transfer', 'Mobile Payment'],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: [
                        '#4CAF50',
                        '#FF9800',
                        '#2196F3',
                        '#9C27B0'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endpush
