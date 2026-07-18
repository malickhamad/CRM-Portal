<?php

namespace App\Http\Controllers;

use App\Models\Notepad;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotepadController extends Controller
{
    public function index()
    {
        $notepads = Notepad::latest()->get();
        return view('backend.notepad.notepad', compact('notepads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Notepad::create([
            'file_name'   => $request->file_name,
            'description' => $request->description ?? '',
        ]);

        return back()->with('success', 'Notepad created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $notepad = Notepad::findOrFail($id);

        $oldDescription = $notepad->description ?? '';
        $newDescription = $request->description ?? '';

        $this->deleteRemovedImages($oldDescription, $newDescription);

        $notepad->update([
            'file_name'   => $request->file_name,
            'description' => $newDescription,
        ]);

        return back()->with('success', 'Notepad updated successfully');
    }

    public function destroy($id)
    {
        $notepad = Notepad::findOrFail($id);

        $this->deleteAllImagesFromDescription($notepad->description);

        $notepad->delete();

        return back()->with('success', 'Notepad deleted successfully');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        $file = $request->file('upload');
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        $destinationPath = public_path('notepad');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $fileName);

        $url = asset('notepad/' . $fileName);
        $funcNum = $request->input('CKEditorFuncNum');

        return response("
            <script>
                window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', 'Image uploaded successfully');
            </script>
        ")->header('Content-Type', 'text/html');
    }

    private function extractImagePaths($html)
    {
        $paths = [];

        if (empty($html)) {
            return $paths;
        }

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        foreach ($dom->getElementsByTagName('img') as $img) {
            $src = $img->getAttribute('src');

            if (!$src) {
                continue;
            }

            $prefix = asset('notepad') . '/';

            if (str_starts_with($src, $prefix)) {
                $paths[] = str_replace($prefix, '', $src);
            }
        }

        libxml_clear_errors();

        return array_unique($paths);
    }

    private function deleteRemovedImages($oldHtml, $newHtml)
    {
        $oldPaths = $this->extractImagePaths($oldHtml);
        $newPaths = $this->extractImagePaths($newHtml);

        $removed = array_diff($oldPaths, $newPaths);

        foreach ($removed as $file) {
            $fullPath = public_path('notepad/' . $file);

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }

    private function deleteAllImagesFromDescription($html)
    {
        $paths = $this->extractImagePaths($html);

        foreach ($paths as $file) {
            $fullPath = public_path('notepad/' . $file);

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
