<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMenuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MenuController extends Controller
{
    // Menampilkan semua menu
    public function index()
    {
        $menus = Menu::paginate(10); // 10 menu per halaman
        
        if (Auth::user() && Auth::user()->hasRole('admin'))  {
            return view('admin.menus.index', compact('menus'));
        }
        if (Auth::user() && Auth::user()->hasRole('user')) {
            return view('user.menus.index', compact('menus'));
        }
    
        abort(403, 'Access denied.');
    }
    

    // Menampilkan form untuk membuat menu baru
    public function create()
    {
        $categories = Category::all(); 
        return view('admin.menus.create', compact('categories'));
    }

    // Menyimpan menu baru ke database
    public function store(StoreMenuRequest $request)
    {
        DB::beginTransaction();
        try {
            // Create a new menu with category_id
            Menu::create([
                'nama_menu' => $request->nama_menu,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'category_id' => $request->category_id, // Menyimpan category_id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create menu: ' . $e->getMessage());
        }

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    // Menampilkan detail menu
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            abort(404, 'Menu not found.');
        }

        return view('menus.show', compact('menu'));
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::all(); 
        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', 
        ]);

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'category_id' => $request->category_id, 
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function softDelete($id)
{
    $menu = Menu::findOrFail($id); 
    $menu->delete(); 
    return redirect()->back()->with('success', 'Menu berhasil dihapus sementara.');
}

    
    public function restore($id)
    {
        $menu = Menu::withTrashed()->find($id);
        if ($menu) {
            $menu->restore();
            return redirect()->back()->with('message', 'Menu berhasil dipulihkan.');
        }
        return redirect()->back()->with('error', 'Menu not found.');
    }

    // Menghapus menu secara permanen
    public function forceDelete($id)
    {
        $menu = Menu::withTrashed()->find($id);
        if ($menu) {
            $menu->forceDelete();
            return redirect()->back()->with('message', 'Menu dihapus secara permanen.');
        }
        return redirect()->back()->with('error', 'Menu not found.');
    }

    // Menampilkan semua menu termasuk yang dihapus
    public function indexWithTrashed()
    {
        $menus = Menu::withTrashed()->get();
    return view('admin.menus.withTrashed', compact('menus'));
    }

    // Menampilkan hanya menu yang dihapus
    public function onlyTrashed()
    {
        $menus = Menu::onlyTrashed()->get();
    return view('admin.menus.archived', compact('menus'));
    }
}
