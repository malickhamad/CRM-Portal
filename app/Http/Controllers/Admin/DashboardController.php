<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StripePayment;
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
    $payments = StripePayment::with(['user', 'subscriptionPlan'])->latest()->get();
    $totalUsers = User::role('user')->count();
    $newUsersThisWeek = User::role('user')
        ->whereNull('deleted_at')
        ->where('created_at', '>=', now()->startOfWeek())
        ->count();

    // Chart Data
    $incomeChartData = $this->generateIncomeChartData();
    $subscriptionChartData = $this->generateSubscriptionChartData();

    return view('backend.admindashboard', compact(

        'totalUsers',
        'newUsersThisWeek',
        'payments',
        'incomeChartData',
        'subscriptionChartData'
    ));
}

private function generateIncomeChartData()
{
    return [
        'weekly' => $this->getWeeklyIncome(),
        'monthly' => $this->getMonthlyIncome(),
        'yearly' => $this->getYearlyIncome()
    ];
}

private function generateSubscriptionChartData()
{
    return [
        'weekly' => $this->getWeeklySubscriptions(),
        'monthly' => $this->getMonthlySubscriptions(),
        'yearly' => $this->getYearlySubscriptions()
    ];
}

// INCOME HELPERS
private function getWeeklyIncome()
{
    return StripePayment::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('total', 'date')
        ->toArray();
}

private function getMonthlyIncome()
{
    return StripePayment::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(amount) as total'))
        ->groupBy('month')
        ->orderBy('month', 'DESC')
        ->limit(12)
        ->pluck('total', 'month')
        ->toArray();
}

private function getYearlyIncome()
{
    return StripePayment::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(amount) as total'))
        ->groupBy('year')
        ->orderBy('year', 'DESC')
        ->limit(5)
        ->pluck('total', 'year')
        ->toArray();
}

// SUBSCRIPTION HELPERS
private function getWeeklySubscriptions()
{
    return StripePayment::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('total', 'date')
        ->toArray();
}

private function getMonthlySubscriptions()
{
    return StripePayment::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total'))
        ->groupBy('month')
        ->orderBy('month', 'DESC')
        ->limit(12)
        ->pluck('total', 'month')
        ->toArray();
}

private function getYearlySubscriptions()
{
    return StripePayment::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
        ->groupBy('year')
        ->orderBy('year', 'DESC')
        ->limit(5)
        ->pluck('total', 'year')
        ->toArray();
}

}
