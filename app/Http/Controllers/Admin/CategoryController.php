<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Fetch all categories
        return view('backend.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name', // Validate the name field
        ]);

        $category = Category::create([
            'name' => $request->name, // Only store the name
        ]);

        // Log category creation with IP address
        activity()
            ->causedBy(Auth::user())
            ->performedOn($category)
            ->withProperties([
                'category_name' => $category->name,
                'ip_address' => $request->ip(),
            ])
            ->log("Created category: {$category->name}");


        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id, // Validate the name field
        ]);

        $oldName = $category->name;
        $category->update([
            'name' => $request->name, // Only update the name
        ]);

        // Log category update with IP address
        activity()
            ->causedBy(Auth::user())
            ->performedOn($category)
            ->withProperties([
                'old_category_name' => $oldName,
                'new_category_name' => $category->name,
                'ip_address' => $request->ip(),
            ])
            ->log("Updated category: {$oldName} to {$category->name}");


        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request, Category $category)
    {
        $categoryName = $category->name;

        // Log category deletion with IP address before deleting
        activity()
            ->causedBy(Auth::user())
            ->performedOn($category)
            ->withProperties([
                'category_name' => $categoryName,
                'ip_address' => $request->ip(),
            ])
            ->log("Deleted category: {$categoryName}");

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
