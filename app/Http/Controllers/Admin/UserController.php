<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Standard;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    // Display a listing of the resource.
    public function index(Request $request): View
    {
        $users = User::with(['roles', 'parent'])
            ->where('created_by', true)
            ->latest()
            ->get();

        return view('backend.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        // $standards = Standard::all(); // Get all standards
        return view('backend.users.create', compact('roles'));
    }


    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'roles' => 'required|array',
            'status' => 'required|in:active,inactive',
            // 'standards' => 'nullable|array', // Add validation for standards
        ]);

        $input = $request->except('roles', 'standards');
        $input['password'] = Hash::make($input['password']);
        $input['parent_id'] = Auth::id();
        $input['created_by'] = true;
        $user = User::create($input);
        $user->assignRole($request->input('roles'));



        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log("Created user: {$user->name}");

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }
   // Display the specified resource.

    public function show($id): View
    {
        $user = User::find($id);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log("Viewed user profile: {$user->name}");

        return view('backend.users.show', compact('user'));
    }

    // Show the form for editing the specified resource.

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $standards = Standard::all(); // Get all standards
        $userStandards = $user->standards->pluck('id')->toArray(); // Get user's standards

        return view('backend.users.edit', compact('user', 'roles', 'userRole', 'standards', 'userStandards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|min:8',
            'roles' => 'required|array',
            'status' => 'required|in:active,inactive',
            // 'standards' => 'nullable|array', // Add validation for standards
        ]);

        $user = User::findOrFail($id);
        $oldData = $user->getOriginal();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        $user->syncRoles($request->roles);

        // Sync standards
        // $user->standards()->sync($request->input('standards', []));

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->withProperties(['old' => $oldData, 'new' => $user->toArray()])
            ->log("Updated user: {$user->name}");


        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log("Deleted user: {$user->name}");

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }

}
