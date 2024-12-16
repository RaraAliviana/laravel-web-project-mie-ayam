<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_paket_hemat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_hemat_id');
            $table->unsignedBigInteger('menu_id');
            $table->timestamps();

            // Menambahkan foreign key
            $table->foreign('paket_hemat_id')->references('id_paket')->on('paket_hemats')->onDelete('cascade');
            $table->foreign('menu_id')->references('id_menu')->on('menus')->onDelete('cascade');
            
            // Menambahkan unique constraint untuk mencegah duplikasi
            $table->unique(['paket_hemat_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_paket_hemat');
    }
};
