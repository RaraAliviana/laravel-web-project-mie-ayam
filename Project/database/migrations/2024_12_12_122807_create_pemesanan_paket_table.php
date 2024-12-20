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
        Schema::create('pemesanan_paket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->unsignedBigInteger('paket_hemat_id');
            $table->integer('kuantitas')->default(1); // Default kuantitas to 1
            $table->timestamps();

            // Foreign keys
            $table->foreign('pemesanan_id')->references('id_pemesanan')->on('pemesanans')->onDelete('cascade');
            $table->foreign('paket_hemat_id')->references('id_paket')->on('paket_hemats')->onDelete('cascade');

            // Unique constraint
            $table->unique(['pemesanan_id', 'paket_hemat_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_paket');
    }
};