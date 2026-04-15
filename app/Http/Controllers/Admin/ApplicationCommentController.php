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

        ApplicationComment::create([
            'application_id' => $application->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
