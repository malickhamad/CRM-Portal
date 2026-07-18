<div class="d-flex flex-wrap gap-3 mb-24">
    <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
        style="background-color: #f3e5ab; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
        <span class="fw-semibold text-dark" style="font-size: 15px;">Remaining Leads</span>
        <span class="fw-bold text-dark" style="font-size: 18px;">{{ $remainingLeads ?? 0 }}</span>
    </div>

    <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
        style="background-color: #d4e7c5; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
        <span class="fw-semibold text-dark" style="font-size: 15px;">All Sales</span>
        <span class="fw-bold text-dark" style="font-size: 18px;">{{ $allSales ?? 0 }}</span>
    </div>

    <div class="d-flex align-items-center justify-content-between shadow-sm border stat-card"
        style="background-color: #d1d9e9; padding: 10px 20px; border-radius: 12px; min-width: 320px;">
        <span class="fw-semibold text-dark" style="font-size: 15px;">This Month Sales</span>
        <span class="fw-bold text-dark" style="font-size: 18px;">{{ $thisMonthSales ?? 0 }}</span>
    </div>
</div>

