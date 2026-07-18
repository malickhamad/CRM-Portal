
<div class="row g-3 flex-grow-1">
    <div class="col-md-3">
        <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
            style="background: linear-gradient(90deg, #bbd2ff 0%, #97abff 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
            <span class="fw-bold text-white" style="font-size: 13px;">Today</span>
            <span class="fw-bold text-white" style="font-size: 16px;">{{ $todayApplications ?? 0 }}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
            style="background: linear-gradient(90deg, #aff1da 0%, #11d39d 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
            <span class="fw-bold text-white" style="font-size: 13px;">This Week</span>
            <span class="fw-bold text-white" style="font-size: 16px;">{{ $thisWeekApplications ?? 0 }}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
            style="background: linear-gradient(90deg, #ffdde1 0%, #ee9ca7 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
            <span class="fw-bold text-white" style="font-size: 13px;">This Month</span>
            <span class="fw-bold text-white" style="font-size: 16px;">{{ $thisMonthApplications ?? 0 }}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="d-flex align-items-center justify-content-between shadow-sm stat-card"
            style="background: linear-gradient(90deg, #fff1eb 0%, #fdbb2d 100%); padding: 12px 25px; border-radius: 12px; border: none; height: 45px;">
            <span class="fw-bold text-white" style="font-size: 13px;">All</span>
            <span class="fw-bold text-white" style="font-size: 16px;">{{ $allApplications ?? 0 }}</span>
        </div>
    </div>
</div>
