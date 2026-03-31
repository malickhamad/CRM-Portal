<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::latest()->get(); // Gets all FAQs in descending order
        return view('backend.faqs.index', compact('faqs'));

    }
    public function create()
    {
        return view('backend.faqs.create');

    }
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::create($request->all());

        if (!$faq) {
            return back()->with('error', 'Failed to create FAQ.');
        }

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function showfaq()
    {
        $faqs = Faq::all();
        // dd($faqs);
        return view('frontend.faq', compact('faqs'));
    }

    public function edit(Faq $faq)
    {

        return view('backend.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
