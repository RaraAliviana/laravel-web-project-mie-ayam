<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PaketHemat extends Model
{
    use HasFactory, SoftDeletes;

    // Table name (optional, since it can be inferred from the class name)
    protected $table = 'paket_hemats';

    // Primary key (optional, if it's 'id' it is inferred automatically)
    protected $primaryKey = 'id_paket';

    // Indicate if the primary key is auto-incrementing (optional, it's true by default)
    public $incrementing = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'nama_paket',
        'deskripsi_paket',
        'harga_paket',
    ];

    // The attributes that should be cast to native types (optional)
    protected $casts = [
        'harga_paket' => 'decimal:2', // ensures 'harga_paket' is cast to a decimal with 2 decimal places
    ];

    // Define the relationship to the Menu model (many-to-many)
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_paket_hemat', 'paket_hemat_id', 'menu_id');
    }

    // Define the relationship to the Pemesanan model (many-to-many)
    public function pemesanans()
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_paket', 'paket_hemat_id', 'pemesanan_id')
            ->withPivot('kuantitas')
            ->withTimestamps();
    }
}
