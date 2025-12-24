<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\PemesananMenu;
use App\Models\PemesananPaket;
use App\Models\Menu;
use App\Models\User;
use App\Models\PaketHemat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\IntegrityService;


class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Ambil semua pemesanan, bisa ditambah relasi jika dibutuhkan
    $pemesanans = Pemesanan::with(['menus', 'paketHemats', 'user'])->paginate(10); // Paginasi 10 per halaman

    // Cek role pengguna yang sedang login
    if (Auth::user()->hasRole('admin')) {
        return view('admin.pemesanans.index', compact('pemesanans')); // Halaman untuk admin
    }

    if (Auth::user() && Auth::user()->hasRole('user')) {
        return view('user.pemesanans.index', compact('pemesanans')); // Menggunakan $pemesanan untuk view user
    }

    abort(403, 'Access denied.');
}


public function create()
{
    if (!Auth::check() || !Auth::user()->hasRole('user')) {
        abort(403, 'Hanya User yang dapat menambahkan pesanan');
    }
    $menus = Menu::all();
    $paketHemats = PaketHemat::all();

    return view('user.pemesanans.create', compact('menus', 'paketHemats'));
}

    public function store(Request $request)
    {
        // Validasi data request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal_pemesanan' => 'required|date|before_or_equal:today',
            'waktu_pemesanan' => 'required|date_format:H:i',
            'total_pembayaran' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:Dana,Shopeepay,Gopay,Transfer Bank,Tunai',
            'pengantaran_pesanan' => 'required|in:Antar Ke rumah,Ambil Di Tempat',
            'status' => 'required|in:pending,in_progress,completed',
            'id_menu' => 'nullable|array',
            'kuantitas_menu' => 'nullable|array',
            'id_paket' => 'nullable|exists:paket_hemats,id_paket',
            'kuantitas_paket' => 'nullable|array',
        ]);
    
        // Remove id_menu and id_paket from validated data
        $pemesananData = $validated;
        unset($pemesananData['id_menu'], $pemesananData['id_paket'], $pemesananData['kuantitas_menu'], $pemesananData['kuantitas_paket']);
    
        // Membuat pemesanan baru
        $pemesanan = Pemesanan::create($pemesananData);
    
        // Menyimpan pemesanan menu jika ada yang dipilih
        if (!empty($validated['id_menu'])) {
            foreach ($validated['id_menu'] as $index => $menuId) {
                PemesananMenu::create([
                    'pemesanan_id' => $pemesanan->id_pemesanan,
                    'menu_id' => $menuId,
                    'kuantitas' => $validated['kuantitas_menu'][$index] ?? 1,
                ]);
            }
        }
    
        // Menyimpan pemesanan paket hemat jika ada yang dipilih
        if (!empty($validated['id_paket'])) {
            foreach ($validated['id_paket'] as $index => $paketId) {
                PemesananPaket::create([
                    'pemesanan_id' => $pemesanan->id_pemesanan,
                    'paket_hemat_id' => $paketId,
                    'kuantitas' => $validated['kuantitas_paket'][$index] ?? 1,
                ]);
            }
        }
    
        // Redirect dengan pesan sukses
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Memuat data pemesanan termasuk menu dan paket hemat
        $pemesanan = Pemesanan::with(['menus', 'paketHemats', 'user'])->findOrFail($id);

        // Menentukan apakah user adalah admin atau user biasa
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return view('admin.pemesanans.show', compact('pemesanan')); // Menggunakan $pemesanan untuk view admin
        }

        if (Auth::user() && Auth::user()->hasRole('user')) {
            return view('user.pemesanans.show', compact('pemesanan')); // Menggunakan $pemesanan untuk view user
        }

        abort(403, 'Access denied.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{

    $pemesanan = Pemesanan::findOrFail($id);
    $menus = Menu::all();
    $paketHemats = PaketHemat::all();
    $users = User::all();

    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        abort(403, 'Hanya admin yang dapat mengedit pesanan');
    }

    return view('admin.pemesanans.edit', compact('pemesanan', 'menus', 'paketHemats', 'users'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);
    
        $pemesanan->update($validated);
    
        return redirect()->route('admin.pemesanans.index')->with('success', 'Status berhasil diperbarui.');
    }
    

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan deleted successfully!');
    }

    public function softDelete($id)
    {
        $pemesanan = Pemesanan::find($id);
        if ($pemesanan) {
            $pemesanan->delete();
            return redirect()->back()->with('message', 'Pemesanan berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Pemesanan tidak ditemukan.');
    }

    public function restore($id)
    {
        $pemesanan = Pemesanan::withTrashed()->find($id);
        if ($pemesanan) {
            $pemesanan->restore();
            return redirect()->back()->with('message', 'Pemesanan berhasil dipulihkan.');
        }
        return redirect()->back()->with('error', 'Pemesanan tidak ditemukan.');
    }

    public function forceDelete($id)
    {
        $pemesanan = Pemesanan::withTrashed()->find($id);
        if ($pemesanan) {
            $pemesanan->forceDelete();
            return redirect()->back()->with('message', 'Pemesanan dihapus secara permanen.');
        }
        return redirect()->back()->with('error', 'Pemesanan tidak ditemukan.');
    }

    public function indexWithTrashed()
    {
        $pemesanans = Pemesanan::withTrashed()->get();
        return view('admin.pemesanans.indexWithTrashed', compact('pemesanans'));
    }
    public function onlyTrashed()
    {
        $pemesanans = Pemesanan::onlyTrashed()->get();
        return view('admin.pemesanans.onlyTrashed', compact('pemesanans'));
    }
}
