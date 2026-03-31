<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    public function index()
{
    $logs = \Spatie\Activitylog\Models\Activity::latest()->get(); // Fetch all logs, paginated

    return view('backend.logs.logs', compact('logs'));
}


public function destroy($id)
{
    $log = Activity::findOrFail($id);
    $log->delete();

    return redirect()->route('admin.logs.logs')
        ->with('success', 'Log deleted successfully');
}

// Clear All Logs
public function clearAll()
{
    Activity::truncate(); // Deletes all logs

    return redirect()->route('admin.logs.logs')
        ->with('success', 'All logs have been cleared!');
}

}
