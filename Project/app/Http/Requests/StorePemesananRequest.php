<?php
// app/Http/Requests/StorePemesananRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemesananRequest extends FormRequest
{
    public function rules()
    {
        return [
            'tanggal_pemesanan' => 'required|date',
            'waktu_pemesanan' => 'required|date_format:H:i',
            'user_id' => 'required|integer|exists:users,id',
            'id_menu' => 'required|array',
            'id_paket' => 'required|array',
            'total_pembayaran' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
            'pengantaran_pesanan' => 'required|string',
            'status' => 'required|string|in:pending,in_progress,completed',
            'quantitas_menu.*' => 'required|integer|min:1',
            'quantitas_paket.*' => 'required|integer|min:1',
        ];
    }

    public function authorize()
    {
        return true;
    }
}