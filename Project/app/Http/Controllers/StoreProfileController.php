<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreProfileController extends Controller
{
    public function profile()
    {
        // Ambil data store dari database
        $store = Store::first(); // Sesuaikan logika ini dengan kebutuhan
        
    // Check if the user has the 'admin' role and return appropriate view
    if (Auth::user() && Auth::user()->hasRole('admin')) {
        return view('admin.store.profile', compact('store'));
    }

    // If the user is a regular 'user', return the user-specific view
    if (Auth::user() && Auth::user()->hasRole('user')) {
        return view('user.store.profile', compact('store'));
    }

    // If no role, abort with a 403 forbidden error
    abort(403, 'Access denied.');
    

    }

    public function create()
{
    // Menampilkan form pembuatan store baru
    return view('admin.store.create'); // Pastikan ada view 'admin.store.create'
}

public function store(Request $request)
{
    // Validasi data yang dimasukkan oleh pengguna
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
    ]);

    // Membuat data store baru di database
    Store::create($validated);

    // Redirect setelah berhasil menyimpan dengan pesan sukses
    return redirect()->route('admin.store.profile')->with('success', 'Store created successfully!');
}

    public function show()
    {
        $store = Store::first(); // Ambil data store pertama (sesuaikan dengan kebutuhan)
        return view('store.profile', compact('store')); // Pastikan view 'store.profile' ada
    }

    // Show the form to edit the store profile
    public function edit()
    {
        $store = Store::first(); // Atau sesuaikan dengan kondisi
        return view('admin.store.edit', compact('store'));
    }

    // Memproses update store profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $store = Store::first(); // Sesuaikan dengan kebutuhan
        $store->update($request->all());

        return redirect()->route('admin.store.profile')->with('success', 'Store profile updated successfully!');
    }
}