<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationComment;
use Illuminate\Http\Request;

class ApplicationCommentController extends Controller
{
    public function store(Request $request, $applicationId)
    {
        $request->validate([
            'comment' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if (!$request->filled('comment') && !$request->hasFile('image')) {
            return back()->with('error', 'Please enter comment or upload image.');
        }

        $application = Application::findOrFail($applicationId);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('application-comments', 'public');
        }

       $comment =   ApplicationComment::create([
            'application_id' => $application->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'image' => $imagePath,
        ]);

          // Activity log for adding the comment
        activity()
            ->causedBy(auth()->user())  // The user who added the comment
            ->performedOn($application)  // The application being commented on
            ->withProperties([
                'comment_id' => $comment->id,  // Optional: Log the comment ID if needed
                'comment' => $request->comment,  // The actual comment content
                'image' => $imagePath,  // Path to the uploaded image (if any)
            ])
            ->log("Added comment to application: {$application->application_num}");


        return back()->with('success', 'Comment added successfully.');
    }
}
