<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    /**
     * Tampilkan semua user dan role-nya
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('admin.roles.index', compact('users', 'roles'));
    }

    /**
     * Ubah role user tertentu
     */
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.roles.index')->with('success', 'Role user berhasil diperbarui.');
    }
}
