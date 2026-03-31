<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Models\Standard;
use Illuminate\Support\Facades\Hash;

class SubuserController extends Controller
{
    // Display all subusers for the authenticated user
 public function index()
{
    $subusers = auth()->user()->subusers()
        ->with(['paymentStandards', 'standards', 'permissions']) // Load both
        ->get();

    return view('backend.user.users.index', compact('subusers'));
}

public function create()
{
    $permissions = auth()->user()->permissions;
    $standards = auth()->user()->paymentStandards; // صرف active plans واپس آن گے
    return view('backend.user.users.create', compact('permissions', 'standards'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'permissions' => 'required|array',
            'standards' => 'required|array',
            'status' => 'required|in:active,inactive',
        ]);

        $subuser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'parent_id' => auth()->id(),
            'created_by' => auth()->user()->name,
            'status' => $request->status,
        ]);

        // Assign Subuser role
        $subuserRole = Role::firstOrCreate(['name' => 'Subuser', 'guard_name' => 'web']);
        $subuser->assignRole($subuserRole);

        // Assign permissions
        $selectedPermissions = $request->permissions ?? [];
        $allowedPermissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();
        $validPermissions = array_intersect($selectedPermissions, $allowedPermissions);
        $subuser->syncPermissions($validPermissions);

        // Assign standards
        if ($request->has('standards')) {
            $subuser->standards()->sync(ids: $request->standards);
        }

        return redirect()->route('user.subusers.index')->with('success', 'Subuser created successfully with permissions and standards.');
    }

    public function edit(User $subuser)
    {
        $permissions = auth()->user()->permissions;
        $standards = auth()->user()->paymentStandards;
        $userStandards = $subuser->standards->pluck('id')->toArray();

        return view('backend.user.users.edit', compact('subuser', 'permissions', 'standards', 'userStandards'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'permissions' => 'required|array',
            'standards' => 'required|array',
            'status' => 'required|in:active,inactive',
        ]);

        $subuser = User::findOrFail($id);
        $subuser->name = $request->name;
        $subuser->email = $request->email;
        $subuser->status = $request->status;

        if ($request->filled('password')) {
            $subuser->password = Hash::make($request->password);
        }

        $subuser->save();

        // Sync permissions
        $selectedPermissions = $request->permissions ?? [];
        $allowedPermissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();
        $validPermissions = array_intersect($selectedPermissions, $allowedPermissions);
        $subuser->syncPermissions($validPermissions);

        // Sync standards
        $subuser->standards()->sync($request->input('standards', []));

        return redirect()->route('user.subusers.index')->with('success', 'Subuser updated successfully.');
    }
    // Delete a subuser
    public function destroy(User $subuser)
    {
        $subuser->delete();
        return redirect()->route('user.subusers.index')->with('success', 'Subuser deleted successfully.');
    }
}
