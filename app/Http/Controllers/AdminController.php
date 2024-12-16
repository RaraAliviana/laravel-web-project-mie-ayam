<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\PaketHemat;
use App\Models\Category;
use App\Models\Pemesanan;
use App\Models\Store;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan dasbor admin
    public function index()
{
    // Assuming you want to return the dashboard or some overview page
    return view('admin.dashboard');
}
public function dashboard()
{
    return view('admin.dashboard');  // Halaman dashboard admin
}


    // Menampilkan daftar menu
    public function menusIndex()
    {
        $menus = Menu::all();
        return view('admin.menus.index', compact('menus'));
    }

    // Menampilkan form untuk membuat menu
    public function menusCreate()
    {
        return view('admin.menus.create');
    }

    // Menyimpan menu baru
    public function menusStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully!');
    }

    // Menampilkan form untuk mengedit menu
    public function menusEdit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menus.edit', compact('menu'));
    }

    // Memperbarui menu
    public function menusUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully!');
    }

    // Menampilkan detail menu
    public function menusShow($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.show', compact('menu'));
    }

    // Menghapus menu
    public function menusDestroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully!');
    }

    // Menampilkan daftar paket hemat
    public function pakethematsIndex()
    {
        $pakethemats = PaketHemat::all();
        return view('admin.pakethemats.index', compact('pakethemats'));
    }

    // Menampilkan form untuk membuat paket hemat
    public function pakethematsCreate()
    {
        return view('admin.pakethemats.create');
    }

    // Menyimpan paket hemat baru
    public function pakethematsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        PaketHemat::create($request->all());

        return redirect()->route('admin.pakethemats.index')->with('success', 'Paket Hemat created successfully!');
    }

    // Menampilkan form untuk mengedit paket hemat
    public function pakethematsEdit($id)
    {
        $pakethemat = PaketHemat::findOrFail($id);
        return view('admin.pakethemats.edit', compact('pakethemat'));
    }

    // Memperbarui paket hemat
    public function pakethematsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $pakethemat = PaketHemat::findOrFail($id);
        $pakethemat->update($request->all());

        return redirect()->route('admin.pakethemats.index')->with('success', 'Paket Hemat updated successfully!');
    }

    // Menampilkan detail paket hemat
    public function pakethematsShow($id)
    {
        $pakethemat = PaketHemat::findOrFail($id);
        return view('admin.pakethemats.show', compact('pakethemat'));
    }

    // Menghapus paket hemat
    public function pakethematsDestroy($id)
    {
        $pakethemat = PaketHemat::findOrFail($id);
        $pakethemat->delete();

        return redirect()->route('admin.pakethemats.index')->with('success', 'Paket Hemat deleted successfully!');
    }

    // Menampilkan daftar kategori
    public function categoriesIndex()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori
    public function categoriesCreate()
    {
        return view('admin.categories.create');
    }

    // Menyimpan kategori baru
    public function categoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    // Menampilkan form untuk mengedit kategori
    public function categoriesEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Memperbarui kategori
    public function categoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    // Menampilkan detail kategori
    public function categoriesShow($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    // Menghapus kategori
    public function categoriesDestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }

    // Menampilkan daftar pemesanan
    public function pemesanans()
    {
        $pemesanans = Pemesanan::all();
        return view('admin.pemesanans.index', compact('pemesanans'));
    }

    // Menampilkan detail pemesanan
    public function pemesanansShow($id)
    {
        $pemesanan = Pemesanan::with(['menus', 'paketHemats', 'user'])->findOrFail($id);
        return view('admin.pemesanans.show', compact('pemesanan'));
    }

    // Menampilkan daftar store profile
    public function storesIndex()
    {
        $store = Store::first();
        return view('admin.stores.index', compact('store'));
    }

    // Menampilkan form untuk mengedit store profile
    public function storesEdit()
    {
        $store = Store::first();
        return view('admin.stores.edit', compact('store'));
    }

    // Memperbarui store profile
    public function storesUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $store = Store::first();
        $store->update($request->all());

        return redirect()->route('admin.stores.index')->with('success', 'Store profile updated successfully!');
    }
}