@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Dashboard</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="dashboard" class="d-flex align-items-center gap-1 fw-semibold text-md hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-semibold text-md text-success-1000">CRM</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-12">
                    <div class="row gy-4">
                        <!-- Standardized Box 1: Total Standards -->
                        <div class="col-xxl-3 col-sm-3">
                            <div class="card p-24 radius-8 border-0 shadow-sm h-100 bg-gradient-end-1">
                                <div class="card-body p-0 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-16">
                                        <div class="d-flex gap-12">
                                            <div
                                                class="w-48-px h-48-px bg-primary-light text-primary-main rounded-circle d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="mingcute:star-fill" width="24"></iconify-icon>
                                            </div>
                                            <div class='text-center'>
                                                <p class="text-sm  fw-semibold text-success-1000 mb-0">Total Standards</p>
                                                <h4 class="fw-semibold mb-0">Total Standards</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <p class="text-sm mb-0 text-neutral-500">Consistently maintaining <span
                                                class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm">high
                                                standards</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Standardized Box 2: Total Companies -->
                        <div class="col-xxl-3 col-sm-3">
                            <div class="card p-24 radius-8 border-0 shadow-sm h-100 bg-gradient-end-2">
                                <div class="card-body p-0 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-16">
                                        <div class="d-flex  gap-12">
                                            <div
                                                class="w-50-px h-50-px bg-primary-light rounded-circle d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="mingcute:user-follow-fill" class=" text-2xl mb-0"
                                                    width="24"></iconify-icon>
                                            </div>
                                            <div class='text-center'>
                                                <p class="text-sm text-success-1000 fw-semibold mb-2">Total Companies</p>
                                                <h4 class="fw-semibold mb-0">{{ number_format($totalUsers) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success-light text-success-main">
                                                <iconify-icon icon="heroicons:arrow-trending-up"
                                                    width="16"></iconify-icon>
                                                +{{ $newUsersThisWeek }}
                                            </span>
                                            <span class="text-sm text-neutral-500">this week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Standardized Box 3: Total Subscriptions -->
                        <div class="col-xxl-3 col-sm-3">
                            <div class="card p-24 radius-8 border-0 shadow-sm h-100 bg-gradient-end-3">
                                <div class="card-body p-0 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-16">
                                        <div class="d-flex  gap-12">
                                            <div
                                                class="w-48-px h-48-px bg-purple-light text-purple-main rounded-circle d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="iconamoon:discount-fill" width="24"></iconify-icon>
                                            </div>
                                            <div class='text-center'>
                                                <p class="text-sm text-success-1000 fw-semibold mb-2">Total Subscriptions</p>
                                                <h4 class="fw-semibold mb-0">{{ $payments->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center gap-2">
                                            @php
                                                $currentWeekCount = $payments
                                                    ->whereBetween('created_at', [
                                                        now()->startOfWeek(),
                                                        now()->endOfWeek(),
                                                    ])
                                                    ->count();
                                                $lastWeekCount = $payments
                                                    ->whereBetween('created_at', [
                                                        now()->subWeek()->startOfWeek(),
                                                        now()->subWeek()->endOfWeek(),
                                                    ])
                                                    ->count();
                                                $percentageChange =
                                                    $lastWeekCount > 0
                                                        ? round(
                                                            (($currentWeekCount - $lastWeekCount) / $lastWeekCount) *
                                                                100,
                                                            1,
                                                        )
                                                        : 100;
                                                $isPositive = $percentageChange >= 0;
                                            @endphp
                                            <span
                                                class="badge {{ $isPositive ? 'bg-success-light text-success-main' : 'bg-danger-light text-danger-main' }}">
                                                <iconify-icon
                                                    icon="heroicons:arrow-trending-{{ $isPositive ? 'up' : 'down' }}"
                                                    width="16"></iconify-icon>
                                                {{ abs($percentageChange) }}%
                                            </span>
                                            <span class="text-sm text-neutral-500">vs last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Standardized Box 4: Active Subscriptions -->
                        <div class="col-xxl-3 col-sm-3">
                            <div class="card p-24 radius-8 border-0 shadow-sm h-100 bg-gradient-end-4">
                                <div class="card-body p-0 d-flex flex-column h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-16">
                                        <div class="d-flex  gap-12">
                                            <div
                                                class="w-48-px h-48-px bg-purple-light text-purple-main rounded-circle d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="fa-solid:award"
                                                    width="24"></iconify-icon>
                                            </div>
                                            <div class='text-center'>
                                                <p class="text-sm text-success-1000 fw-semibold mb-2">Active Subscriptions</p>
                                                <h4 class="fw-semibold mb-0">
                                                    {{ $payments->where('is_active', true)->count() }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto">
                                        <div class="d-flex align-items-center gap-2">
                                            @php
                                                $currentWeekActive = $payments
                                                    ->where('is_active', true)
                                                    ->whereBetween('created_at', [
                                                        now()->startOfWeek(),
                                                        now()->endOfWeek(),
                                                    ])
                                                    ->count();
                                                $lastWeekActive = $payments
                                                    ->where('is_active', true)
                                                    ->whereBetween('created_at', [
                                                        now()->subWeek()->startOfWeek(),
                                                        now()->subWeek()->endOfWeek(),
                                                    ])
                                                    ->count();
                                                $percentageChange =
                                                    $lastWeekActive > 0
                                                        ? round(
                                                            (($currentWeekActive - $lastWeekActive) / $lastWeekActive) *
                                                                100,
                                                            1,
                                                        )
                                                        : 100;
                                                $isPositive = $percentageChange >= 0;
                                            @endphp
                                            <span
                                                class="badge {{ $isPositive ? 'bg-success-light text-success-main' : 'bg-danger-light text-danger-main' }}">
                                                <iconify-icon
                                                    icon="heroicons:arrow-trending-{{ $isPositive ? 'up' : 'down' }}"
                                                    width="16"></iconify-icon>
                                                {{ abs($percentageChange) }}%
                                            </span>
                                            <span class="text-sm text-neutral-500">vs last week</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card p-24 shadow-sm">
                        <h6 class="fw-semibold mb-4 text-success-1000">Income Chart </h6>
                        <canvas id="incomeChart"></canvas>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card p-24 shadow-sm">
                        <h6 class="fw-semibold mb-4 text-success-1000">Subscription Chart </h6>
                        <canvas id="subscriptionChart"></canvas>
                    </div>
                </div>


            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const incomeData = @json($incomeChartData['monthly']);
            const subscriptionData = @json($subscriptionChartData['monthly']);

            const incomeCtx = document.getElementById('incomeChart').getContext('2d');
            new Chart(incomeCtx, {
                type: 'line',
                data: {
                    labels: Object.keys(incomeData),
                    datasets: [{
                        label: 'Income',
                        data: Object.values(incomeData),
                        borderColor: '#4CAF50',
                        backgroundColor: 'rgba(76, 175, 80, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                }
            });

            const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
            new Chart(subscriptionCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(subscriptionData),
                    datasets: [{
                        label: 'Subscriptions',
                        data: Object.values(subscriptionData),
                        backgroundColor: '#2196F3'
                    }]
                }
            });
        </script>
    @endsection
