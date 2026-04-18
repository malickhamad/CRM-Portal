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
        $applications = Application::with('user')->get();
    // Get the current application counts
    $totalApplications = Application::count();
    $pendingApplications = Application::where('status', 'pending')->count();
    $liveApplications = Application::where('status', 'live')->count();
    $rejectedApplications = Application::where('status', 'rejected')->count();

    // Get the previous month's application counts
    // This is just an example. You might calculate it differently, depending on your database structure.
    $prevMonthTotalApplications = Application::whereMonth('created_at', now()->subMonth()->month)->count();
    $prevMonthPendingApplications = Application::where('status', 'pending')
        ->whereMonth('created_at', now()->subMonth()->month)->count();
    $prevMonthLiveApplications = Application::where('status', 'live')
        ->whereMonth('created_at', now()->subMonth()->month)->count();
    $prevMonthRejectedApplications = Application::where('status', 'rejected')
        ->whereMonth('created_at', now()->subMonth()->month)->count();

    // Calculate the percentage change
    $totalApplicationsChange = $this->calculatePercentageChange($totalApplications, $prevMonthTotalApplications);
    $pendingApplicationsChange = $this->calculatePercentageChange($pendingApplications, $prevMonthPendingApplications);
    $liveApplicationsChange = $this->calculatePercentageChange($liveApplications, $prevMonthLiveApplications);
    $rejectedApplicationsChange = $this->calculatePercentageChange($rejectedApplications, $prevMonthRejectedApplications);

 // Get the distinct months from the created_at column for the last 6 months
    $months = [];
    $monthLabels = [];

    // Get the last 6 months dynamically
    for ($i = 5; $i >= 0; $i--) {
        $month = Carbon::now()->subMonths($i);
        $months[] = $month->month;
        $monthLabels[] = $month->format('F');  // Get the month name (e.g., January, February, etc.)
    }

    // Now fetch the counts for each status (Pending, Live, Rejected) for the last 6 months
    $pendingData = [];
    $liveData = [];
    $rejectedData = [];

    foreach ($months as $month) {
        $pendingData[] = Application::where('status', 'pending')
            ->whereMonth('created_at', $month)
            ->count();
        $liveData[] = Application::where('status', 'live')
            ->whereMonth('created_at', $month)
            ->count();
        $rejectedData[] = Application::where('status', 'rejected')
            ->whereMonth('created_at', $month)
            ->count();
    }

    return view('backend.admindashboard', compact(
        'totalApplications', 'pendingApplications', 'liveApplications', 'rejectedApplications',
        'totalApplicationsChange', 'pendingApplicationsChange', 'liveApplicationsChange', 'rejectedApplicationsChange', 'applications','monthLabels', 'pendingData', 'liveData', 'rejectedData'
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
