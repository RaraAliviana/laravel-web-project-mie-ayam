<?php

namespace App\Http\Controllers;

use App\Models\PaketHemat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketHematController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        // Fetch Paket Hemats with their associated menus
        $paketHemats = PaketHemat::with('menus')->paginate(10); // Use pagination here

        if (Auth::user()->hasRole('admin')) {
            return view('admin.pakethemats.index', compact('paketHemats'));
        }
        if (Auth::user()->hasRole('user')) {
            return view('user.pakethemats.index', compact('paketHemats'));
        }


        abort(403, 'Access denied.');
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.pakethemats.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi_paket' => 'required|string',
            'harga_paket' => 'required|numeric|min:0',
            'id_menu' => 'nullable|array', // Ensure this is an array
            'id_menu.*' => 'exists:menus,id_menu', // Validate each id_menu
        ]);

        // Create new Paket Hemat
        $paketHemat = PaketHemat::create([
            'nama_paket' => $validated['nama_paket'],
            'deskripsi_paket' => $validated['deskripsi_paket'],
            'harga_paket' => $validated['harga_paket'],
        ]);

        // Sync the many-to-many relationship with menus if any menus are selected
        if (isset($validated['id_menu'])) {
            $paketHemat->menus()->sync($validated['id_menu']);
        }

        // Redirect with success message
        return redirect()->route('admin.pakethemats.index')->with('success', 'Paket Hemat created successfully!');
    }

    // Display the specified resource
    public function show($id_paket)
    {
        $paketHemat = PaketHemat::findOrFail($id_paket);

        // Return the view with the specified Paket Hemat
        return view('pakethemats.show', compact('paketHemat'));
    }

    // Show the form for editing the specified resource
    public function edit($id_paket)
    {
        $paketHemat = PaketHemat::findOrFail($id_paket);

        // Return the view for editing
        return view('admin.pakethemats.edit', compact('paketHemat'));
    }

    // Update the specified resource in storage
    public function update(Request $request, PaketHemat $paketHemat)
    {
        // Validate the request input
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi_paket' => 'required|string',
            'harga_paket' => 'required|numeric|min:0',
            'id_menu' => 'nullable|array',
            'id_menu.*' => 'exists:menus,id_menu',
        ]);

        // Update the Paket Hemat
        $paketHemat->update($validated);

        // Sync the menus relationship if menus are provided
        if ($request->has('id_menu')) {
            $paketHemat->menus()->sync($request->id_menu);
        }

        // Redirect with success message
        return redirect()->route('admin.pakethemats.index')->with('success', 'Paket Hemat updated successfully!');
    }

    // Remove the specified resource from storage
    public function destroy($id_paket)
    {
        // Find Paket Hemat by ID
        $paketHemat = PaketHemat::findOrFail($id_paket);

        // Delete the Paket Hemat
        $paketHemat->delete();

        // Redirect with success message
        return redirect()->route('admin.pakethemats.index')->with('success', 'Paket Hemat deleted successfully!');
    }
    public function softDelete($id_paket)
    {
        $paketHemat = PaketHemat::find($id_paket);
        if ($paketHemat) {
            $paketHemat->delete();
            return redirect()->back()->with('message', 'Paket Hemat berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Paket Hemat tidak ditemukan.');
    }

    // Restore a soft deleted Paket Hemat
    public function restore($id_paket)
    {
        $paketHemat = PaketHemat::withTrashed()->find($id_paket);
        if ($paketHemat) {
            $paketHemat->restore();
            return redirect()->back()->with('message', 'Paket Hemat berhasil dipulihkan.');
        }
        return redirect()->back()->with('error', 'Paket Hemat tidak ditemukan.');
    }

    // Force delete a Paket Hemat (permanently remove it)
    public function forceDelete($id_paket)
    {
        $paketHemat = PaketHemat::withTrashed()->find($id_paket);
        if ($paketHemat) {
            $paketHemat->forceDelete();
            return redirect()->back()->with('message', 'Paket Hemat dihapus secara permanen.');
        }
        return redirect()->back()->with('error', 'Paket Hemat tidak ditemukan.');
    }

    public function withTrashed()
    {
        // Mendapatkan semua paket yang termasuk yang sudah dihapus (soft deleted)
        $paketHemats = PaketHemat::withTrashed()->get();
    
        return view('admin.pakethemats.withTrashed', compact('paketHemats'));
    }


    // Display only soft deleted Paket Hemats
    public function onlyTrashed()
    {
        $paketHemats = PaketHemat::onlyTrashed()->get();
        return view('admin.pakethemats.index', compact('paketHemats'));
    }
}
