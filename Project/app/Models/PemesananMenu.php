<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemesananMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemesanan_menu';
    protected $fillable = ['pemesanan_id', 'menu_id', 'kuantitas'];

    // Relasi dengan Pemesanan
    public function pemesanans()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    // Relasi dengan Menu
    public function menus()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}