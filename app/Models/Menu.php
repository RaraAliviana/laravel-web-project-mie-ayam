<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    // Tentukan nama tabel yang digunakan
    protected $table = 'menus';

    // Tentukan primary key yang digunakan
    protected $primaryKey = 'id_menu';

    // Tentukan kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'nama_menu',
        'category_id',
        'harga',
        'deskripsi',
    ];

    // Tentukan kolom yang tidak boleh diisi (untuk proteksi mass assignment)
    protected $guarded = [];

    // Tentukan tipe data untuk kolom tertentu
    protected $casts = [
        'harga' => 'decimal:2', // Pastikan harga disimpan sebagai decimal dengan 2 angka desimal
    ];

    // Relasi dengan tabel user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan tabel category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function paketHemats()
    {
        return $this->belongsToMany(PaketHemat::class, 'menu_paket_hemat', 'menu_id', 'paket_hemat_id');
    }
    

    // Scope untuk filter berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }



    public function pemesanans()
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_menu', 'menu_id', 'pemesanan_id')
            ->withPivot('kuantitas')
            ->withTimestamps();
    }
}

