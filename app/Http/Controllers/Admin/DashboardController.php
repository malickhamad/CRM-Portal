<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\StripePayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
{
    $query = Application::query();

    if (!auth()->user()->hasRole('Admin')) {
        $query->where('user_id', auth()->id());
    }

    $applications = (clone $query)->with('user')->get();

    $totalApplications = (clone $query)->count();
    $pendingApplications = (clone $query)->where('status', 'pending')->count();
    $liveApplications = (clone $query)->where('status', 'live')->count();
    $rejectedApplications = (clone $query)->where('status', 'rejected')->count();

    $prevMonthTotalApplications = (clone $query)
        ->whereMonth('created_at', now()->subMonth()->month)
        ->count();

    $prevMonthPendingApplications = (clone $query)
        ->where('status', 'pending')
        ->whereMonth('created_at', now()->subMonth()->month)
        ->count();

    $prevMonthLiveApplications = (clone $query)
        ->where('status', 'live')
        ->whereMonth('created_at', now()->subMonth()->month)
        ->count();

    $prevMonthRejectedApplications = (clone $query)
        ->where('status', 'rejected')
        ->whereMonth('created_at', now()->subMonth()->month)
        ->count();

    $totalApplicationsChange = $this->calculatePercentageChange($totalApplications, $prevMonthTotalApplications);
    $pendingApplicationsChange = $this->calculatePercentageChange($pendingApplications, $prevMonthPendingApplications);
    $liveApplicationsChange = $this->calculatePercentageChange($liveApplications, $prevMonthLiveApplications);
    $rejectedApplicationsChange = $this->calculatePercentageChange($rejectedApplications, $prevMonthRejectedApplications);

    $months = [];
    $monthLabels = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i);
        $months[] = $month->month;
        $monthLabels[] = $month->format('F');
    }

    $pendingData = [];
    $liveData = [];
    $rejectedData = [];

    foreach ($months as $month) {
        $pendingData[] = (clone $query)
            ->where('status', 'pending')
            ->whereMonth('created_at', $month)
            ->count();

        $liveData[] = (clone $query)
            ->where('status', 'live')
            ->whereMonth('created_at', $month)
            ->count();

        $rejectedData[] = (clone $query)
            ->where('status', 'rejected')
            ->whereMonth('created_at', $month)
            ->count();
    }

    return view('backend.admindashboard', compact(
        'totalApplications',
        'pendingApplications',
        'liveApplications',
        'rejectedApplications',
        'totalApplicationsChange',
        'pendingApplicationsChange',
        'liveApplicationsChange',
        'rejectedApplicationsChange',
        'applications',
        'monthLabels',
        'pendingData',
        'liveData',
        'rejectedData'
    ));
}
private function calculatePercentageChange($current, $previous)
{
    if ($previous == 0) {
        return $current > 0 ? 100 : 0; // Prevent division by zero, assume 100% increase if the previous count was 0
    }
    return round((($current - $previous) / $previous) * 100, 2);
}

}
