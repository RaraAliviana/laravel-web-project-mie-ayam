<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Menampilkan semua data menu (GET).
     */
    public function index()
    {
        $data = Menu::latest()->paginate(10);

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar Menu berhasil diambil',
            'data' => $data
        ], 200);
    }

    /**
     * Menyimpan data menu baru (POST).
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_menu'   => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Simpan data menu
        $menu = Menu::create([
            'nama_menu'   => $request->nama_menu,
            'category_id' => $request->category_id,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu berhasil ditambahkan',
            'data' => $menu
        ], 201);
    }

    /**
     * Menampilkan detail data menu tertentu (GET).
     */
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'status' => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Menu berhasil diambil',
            'data' => $menu
        ], 200);
    }

    /**
     * Memperbarui data menu tertentu (PUT/PATCH).
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'status' => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_menu'   => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric|min:0',
            'deskripsi'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Perbarui data menu
        $menu->update([
            'nama_menu'   => $request->nama_menu,
            'category_id' => $request->category_id,
            'harga'       => $request->harga,
            'deskripsi'   => $request->deskripsi,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu berhasil diperbarui',
            'data' => $menu
        ], 200);
    }

    /**
     * Menghapus data menu tertentu (DELETE).
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'status' => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        $menu->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Menu berhasil dihapus'
        ], 200);
    }
}
