<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();



        // Get subusers data
        $subusers = User::where('parent_id', $user->id)
            ->get();




        // Prepare subusers data for view
        $subusersGraphData = [
            'labels' => [],
            'datasets' => []
        ];

        // Get subusers creation months
        $subusersMonths = $subusers->groupBy(function ($subuser) {
            return $subuser->created_at->format('Y-m');
        })->sortKeys();

        $subusersGraphData['labels'] = $subusersMonths->keys()->toArray();
        $subusersGraphData['datasets'][] = [
            'label' => 'Subusers Created',
            'data' => $subusersMonths->map->count()->values()->toArray(),
            'backgroundColor' => '#6f42c1',
            'borderColor' => '#6f42c1',
            'borderWidth' => 1
        ];

        // Get completion data for owner and subusers

        return view('backend.user.userdashboard', [
            'subusersCount' => $subusers->count(),
            'activeSubusersCount' => $subusers->where('status', 'active')->count(),
            'subusersGraphData' => $subusersGraphData,

        ]);
    }

}

