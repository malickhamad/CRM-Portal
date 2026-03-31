<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function assesments()
    {
        $assesments = Contact::latest()->get();
        return view('backend.assesments.index', compact('assesments'));
    }


    // Show all messages in the admin panel
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('backend.contacts.index', compact('contacts'));
    }


    public function sendContactEmail(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'company', 'subject', 'message']);

        try {
            // Attempt to send the email
            Mail::to('malikhamad0786m@gmail.com')->send(mailable: new ContactUsMail($data));

            // If email is sent successfully, store the data
            $this->store(new Request(query: $data));

            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error(message: 'Contact Email Failed: ' . $e->getMessage());

            return back()->with('error', 'Failed to send your message. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        // Validate Request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'company' => 'nullable|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Store Contact Message in Database
        $contact = Contact::create($request->all());

        return response()->json(['message' => 'Message sent successfully!'], 200);
    }


    // delete the contact message

    public function destroy($id)
    {
        $contact = contact::findOrFail($id); // Find the contact by ID

        $contact->delete(); // Delete the contact

        return redirect()->route('admin.contacts.index')->with('success', 'contact deleted successfully.');
    }

}
