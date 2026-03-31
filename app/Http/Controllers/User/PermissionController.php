<?php

namespace App\Http\Controllers\User;

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
    $user = Auth::user();

    // Get the permissions assigned to the user
    $permissions = $user->getAllPermissions();

    return view('backend.user.permissions.index', ['permissions' => $permissions]);
}



public function assignPermissionsToSubuser(Request $request, $subuserId)
{
    $user = Auth::user();
    $subuser = User::findOrFail($subuserId);

    // Validate that the permissions being assigned are within the user's permissions
    $request->validate([
        'permissions' => 'array|required',
    ]);

    $permissions = $request->permissions;

    // Check if the selected permissions are within the user's assigned permissions
    $invalidPermissions = array_diff($permissions, $user->getAllPermissions()->pluck('name')->toArray());
    if (!empty($invalidPermissions)) {
        return redirect()->back()->with('error', 'You can only assign permissions that you have.');
    }

    // Assign the permissions to the subuser
    $subuser->syncPermissions($permissions);

    return redirect()->back()->with('success', 'Permissions assigned to subuser successfully.');
}

    // Show create permission page
    public function create()
    {
        return view('backend.user.permissions.create');
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

            return redirect()->route('user.permissions.index')->with('sweetalert', [
                'type' => 'success',
                'message' => 'Permission created successfully!',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('user.permissions.create')->withInput()->withErrors($validator);
        }
    }

    // Show edit permission page
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.user.permissions.edit', compact('permission'));
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
            return redirect()->route('user.permissions.edit', $id)
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

        return redirect()->route('user.permissions.index')->with(success, 'Permission updated successfully!');
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

        return redirect()->route('user.permissions.index')->with('success', 'Permission deleted successfully!');
    }
}
