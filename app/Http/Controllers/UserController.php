<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua pengguna dari database
        return view('user.dashboard', compact('users')); // Kembalikan ke view users.index
    }

    public function dashboard()
{
    return view('user.dashboard');  // Halaman dashboard admin
}

public function storeAdmin()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin');
        $user->update(['role_id' => \Spatie\Permission\Models\Role::where('name', 'admin')->first()->id]);

        return response()->json(['message' => 'Admin created successfully!', 'user' => $user]);
    }
}
