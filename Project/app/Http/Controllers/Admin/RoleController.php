<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role; // Import Spatie's Role model
use Spatie\Permission\Models\Permission; // Import Spatie's Permission model
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    // Display the list of roles
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Show the form to create a new role
    public function create()
    {
        $permissions = Permission::all(); // Fetch all permissions
        return view('admin.roles.create', compact('permissions'));
    }

    // Process creating a new role
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles',
        'permissions' => 'array',
        'permissions.*' => 'exists:permissions,id', // Ensure permission IDs are valid
    ]);

    // Create a new role
    $role = Role::create(['name' => $request->name]);

    // Convert permission IDs to Permission models or names
    if ($request->permissions) {
        $permissions = Permission::whereIn('id', $request->permissions)->get(); // Retrieve permission models
        $role->syncPermissions($permissions); // Sync using models
    }

    return redirect()->route('admin.roles.index')->with('success', 'Role created successfully!');
}


    // Show the form to edit an existing role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Process updating a role
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name,' . $id,
        'permissions' => 'array',
        'permissions.*' => 'exists:permissions,id', // Ensure permission IDs are valid
    ]);

    $role = Role::findOrFail($id);

    // Update role name
    $role->update(['name' => $request->name]);

    // Convert permission IDs to Permission models or names
    if ($request->permissions) {
        $permissions = Permission::whereIn('id', $request->permissions)->get(); // Retrieve permission models
        $role->syncPermissions($permissions); // Sync using models
    }

    return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
}


    // Delete a role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully!');
    }
}
