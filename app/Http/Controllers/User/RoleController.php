<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class RoleController extends Controller
{
    public function index(Request $request): View
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('backend.user.roles.index', ['roles' => $roles]);
    }

    public function create(): View
    {
        $permissions = Permission::get();
        return view('backend.user.roles.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $permissionsID = array_map(
            function ($value) {
                return (int) $value;
            },
            $request->input('permission')
        );

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);

        // Log role creation with IP address
        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->withProperties([
                'role_name' => $role->name,
                'ip_address' => $request->ip(),
            ])
            ->log("Created role: {$role->name}");

        return redirect()->route('user.roles.index')->with('success', 'Role created successfully!');
    }

    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('backend.user.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id): View
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('backend.user.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $oldName = $role->name;
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(
            function ($value) {
                return (int) $value;
            },
            $request->input('permission')
        );

        $role->syncPermissions($permissionsID);

        // Log role update with IP address
        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->withProperties([
                'old_role_name' => $oldName,
                'new_role_name' => $role->name,
                'ip_address' => $request->ip(),
            ])
            ->log("Updated role: {$oldName} to {$role->name}");

        return redirect()->route('user.roles.index')->with('success', 'Role updated successfully!');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $role = Role::findOrFail($id);
        $roleName = $role->name;

        // Log role deletion with IP address before deleting
        activity()
            ->causedBy(Auth::user())
            ->performedOn($role)
            ->withProperties([
                'role_name' => $roleName,
                'ip_address' => $request->ip(),
            ])
            ->log("Deleted role: {$roleName}");

        DB::table("roles")->where('id', $id)->delete();

        return redirect()->route('user.roles.index')->with('success', 'Role deleted successfully!');
    }
}
