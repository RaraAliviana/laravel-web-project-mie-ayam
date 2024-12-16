<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PemesananMenu;
use App\Models\PemesananPaket;

class PemesananController extends Controller
{
    /**
     * Menampilkan semua data pemesanan (GET).
     */
    public function index()
    {
        $data = Pemesanan::with(['menus', 'paketHemats', 'user'])->latest()->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar Pemesanan berhasil diambil',
            'data' => $data
        ], 200);
    }

    /**
     * Menyimpan data pemesanan baru (POST).
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'tanggal_pemesanan' => 'required|date|before_or_equal:today',
            'waktu_pemesanan' => 'required|date_format:H:i',
            'total_pembayaran' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:Dana,Shopeepay,Gopay,Transfer Bank,Tunai',
            'pengantaran_pesanan' => 'required|in:Antar Ke rumah,Ambil Di Tempat',
            'status' => 'required|in:pending,in_progress,completed',
            'id_menu' => 'nullable|array',
            'kuantitas_menu' => 'nullable|array',
            'id_paket' => 'nullable|array',
            'kuantitas_paket' => 'nullable|array',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data pemesanan
        $pemesanan = Pemesanan::create($request->except(['id_menu', 'kuantitas_menu', 'id_paket', 'kuantitas_paket']));

        // Menyimpan detail menu
        if ($request->has('id_menu')) {
            foreach ($request->id_menu as $index => $menuId) {
                PemesananMenu::create([
                    'pemesanan_id' => $pemesanan->id_pemesanan,
                    'menu_id' => $menuId,
                    'kuantitas' => $request->kuantitas_menu[$index] ?? 1,
                ]);
            }
        }

        // Menyimpan detail paket hemat
        if ($request->has('id_paket')) {
            foreach ($request->id_paket as $index => $paketId) {
                PemesananPaket::create([
                    'pemesanan_id' => $pemesanan->id_pemesanan,
                    'paket_hemat_id' => $paketId,
                    'kuantitas' => $request->kuantitas_paket[$index] ?? 1,
                ]);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Pemesanan berhasil ditambahkan',
            'data' => $pemesanan
        ], 201);
    }

    /**
     * Menampilkan detail data pemesanan tertentu (GET).
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['menus', 'paketHemats', 'user'])->find($id);

        if (!$pemesanan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pemesanan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Pemesanan berhasil diambil',
            'data' => $pemesanan
        ], 200);
    }

    /**
     * Memperbarui data pemesanan tertentu (PUT/PATCH).
     */
    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::find($id);

        if (!$pemesanan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pemesanan tidak ditemukan'
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'tanggal_pemesanan' => 'required|date',
            'waktu_pemesanan' => 'required|date_format:H:i',
            'total_pembayaran' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:Dana,Shopeepay,Gopay,Transfer Bank,Tunai',
            'pengantaran_pesanan' => 'required|in:Antar Ke rumah,Ambil Di Tempat',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $pemesanan->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Pemesanan berhasil diperbarui',
            'data' => $pemesanan
        ], 200);
    }

    /**
     * Menghapus data pemesanan tertentu (DELETE).
     */
    public function destroy($id)
    {
        $pemesanan = Pemesanan::find($id);

        if (!$pemesanan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pemesanan tidak ditemukan'
            ], 404);
        }

        $pemesanan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Pemesanan berhasil dihapus'
        ], 200);
    }
}
