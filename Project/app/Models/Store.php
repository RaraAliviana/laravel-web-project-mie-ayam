<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    // Define the table, if it's not the default 'stores' table
    protected $table = 'stores'; 

    // Specify any other fields that you want to fill, if needed
    protected $fillable = ['name', 'address', 'phone', 'email'];
}
