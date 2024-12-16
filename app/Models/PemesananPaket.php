<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananPaket extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_paket';
    protected $fillable = ['pemesanan_id', 'paket_hemat_id', 'kuantitas'];

    // Relasi dengan Pemesanan
    public function pemesanans()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    // Relasi dengan Paket Hemat
    public function paketHemats()
    {
        return $this->belongsTo(PaketHemat::class, 'paket_hemat_id');
    }
}