<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pemesanan';
    protected $fillable = [
        'user_id',
        'tanggal_pemesanan',
        'waktu_pemesanan',
        'total_pembayaran',
        'metode_pembayaran',
        'pengantaran_pesanan',
        'status',
        'id_menu',
        'id_paket'
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'pemesanan_menu', 'pemesanan_id', 'menu_id')
                    ->withPivot('kuantitas');
    }

    public function paketHemats()
    {
        return $this->belongsToMany(PaketHemat::class, 'pemesanan_paket', 'pemesanan_id', 'paket_hemat_id')
                    ->withPivot('kuantitas');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}