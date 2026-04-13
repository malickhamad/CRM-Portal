<?php

namespace App\Http\Controllers;

use App\Models\Notepad;
use Illuminate\Http\Request;

class NotepadController extends Controller
{
    public function index()
    {
        $notepads = Notepad::latest()->get();
        return view('backend.notepad.notepad', compact('notepads'));
    }

    public function store(Request $request)
    {
        Notepad::create($request->only('file_name','description'));

        return back()->with('success', 'Notepad created successfully');
    }

    public function update(Request $request, $id)
    {
        Notepad::findOrFail($id)
            ->update($request->only('file_name','description'));

        return back()->with('success', 'Notepad updated successfully');
    }

    public function destroy($id)
    {
        Notepad::findOrFail($id)->delete();

        return back()->with('success', 'Notepad deleted successfully');
    }
}