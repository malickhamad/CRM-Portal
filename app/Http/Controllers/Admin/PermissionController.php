<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class PermissionController extends Controller
{
    // Show the permissions page
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        return view('backend.permissions.index', ['permissions' => $permissions]);
    }

    // Show create permission page
    public function create()
    {
        return view('backend.permissions.create');
    }

    // Insert a permission into the database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3|max:200'
        ]);

        if ($validator->passes()) {
            $permission = Permission::create(['name' => $request->name]);

            // Log permission creation with IP address
            activity()
                ->causedBy(Auth::user())
                ->performedOn($permission)
                ->withProperties([
                    'permission_name' => $permission->name,
                    'ip_address' => $request->ip(),
                ])
                ->log("Created permission: {$permission->name}");

            return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully!');
        } else {
            return redirect()->route('admin.permissions.create')->withInput()->withErrors($validator);
        }
    }

    // Show edit permission page
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.permissions.edit', compact('permission'));
    }

    // Update a permission
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $oldName = $permission->name;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.permissions.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        $permission->name = $request->name;
        $permission->save();

        // Log permission update with IP address
        activity()
            ->causedBy(Auth::user())
            ->performedOn($permission)
            ->withProperties([
                'old_permission_name' => $oldName,
                'new_permission_name' => $permission->name,
                'ip_address' => $request->ip(),
            ])
            ->log("Updated permission: {$oldName} to {$permission->name}");

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully!');
    }

    // Delete a permission from the database
    public function destroy(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permissionName = $permission->name;

        // Log permission deletion with IP address before deleting
        activity()
            ->causedBy(Auth::user())
            ->performedOn($permission)
            ->withProperties([
                'permission_name' => $permissionName,
                'ip_address' => $request->ip(),
            ])
            ->log("Deleted permission: {$permissionName}");

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
