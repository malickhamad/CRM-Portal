<?php

namespace App\Http\Controllers\Subuser;

use App\Http\Controllers\Controller;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subuser = Auth::user();
        $parentUser = User::find($subuser->parent_id);

        // Get standards assigned to this subuser
        $standards = $subuser->standards()
            ->with(['sections.questions.userAnswers'])
            ->get();

        // Prepare completion data combining both parent and subuser progress
        $completionData = $this->getCompletionData($subuser, $parentUser);

        return view('backend.subuser.subuserdashboard', [
            'completionData' => $completionData,
            'standards' => $standards
        ]);
    }

    protected function getCompletionData($subuser, $parentUser)
    {
        $userIds = [$subuser->id, $parentUser->id];

        // Get all standards the subuser has access to
        $standards = $subuser->standards()
            ->with(['sections.questions.userAnswers'])
            ->get();

        $completionData = [];

        foreach ($standards as $standard) {
            $totalQuestions = $standard->sections->sum(function ($section) {
                return $section->questions->count();
            });

            $answeredQuestions = $standard->sections->sum(function ($section) use ($userIds) {
                return $section->questions->sum(function ($question) use ($userIds) {
                    return $question->userAnswers->whereIn('user_id', $userIds)->count() > 0 ? 1 : 0;
                });
            });

            $percentage = $totalQuestions > 0 ? round(($answeredQuestions / $totalQuestions) * 100) : 0;

            $completionData[$standard->id] = [
                'name' => $standard->name,
                'percentage' => $percentage
            ];
        }

        return $completionData;
    }
}
