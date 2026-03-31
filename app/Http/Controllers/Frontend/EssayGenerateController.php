<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EssayGenerateController extends Controller
{
    // Show the form page
    public function showForm()
    {
        return view('frontend.eassayDetails'); // Ensure this matches your Blade file name
    }

    // Handle form submission and call the API
    public function generateEssay(Request $request)
{
    try {
        $request->validate([
            'topic' => 'required|string',
            'academic_level' => 'required|string',
            'essay_type' => 'required|string',
            'essay_length' => 'required|string',
            'add_reference' => 'required|string',
        ]);

        // Handle Custom Length
        $essayLength = $request->essay_length === 'custom' ? (string) $request->custom_length : $request->essay_length;

        $apiUrl = "http://167.71.111.139:8776/generate-essay/";

        $payload = [
            "topic" => $request->topic,
            "academic_level" => $request->academic_level,
            "essay_type" => $request->essay_type,
            "essay_length" => $essayLength, // Handle custom length
            "add_reference" => $request->add_reference
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(60) // Increase timeout to 60 seconds
            ->post($apiUrl, $payload);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'essay' => nl2br(e($response->json()['essay'] ?? 'Essay generated successfully!'))
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Failed to generate essay. API Error: ' . $response->body(),
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => 'Server Error: ' . $e->getMessage(),
        ]);
    }
}

}
