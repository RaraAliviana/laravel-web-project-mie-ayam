<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        // Migration untuk tabel pemesanans
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id('id_pemesanan');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('tanggal_pemesanan');
            $table->time('waktu_pemesanan');
            $table->unsignedBigInteger('id_menu')->nullable(); // Optional, for multi-menu selection
            $table->unsignedBigInteger('id_paket')->nullable(); // Optional, for multi-package selection
            $table->decimal('total_pembayaran', 10, 2); 
            $table->enum('metode_pembayaran', ['Dana', 'Shopeepay', 'Gopay', 'Transfer Bank', 'Tunai']);
            $table->enum('pengantaran_pesanan', ['Antar Ke rumah', 'Ambil Di Tempat']);
            $table->enum('status', ['pending', 'in_progress', 'completed']);
            $table->timestamps();

            // Foreign key for menu
            $table->foreign('id_menu')
                ->references('id_menu')->on('menus')
                ->onDelete('set null') // Untuk menghindari referensi yang salah
                ->onUpdate('cascade'); // Untuk memastikan referensi tetap valid jika data menu diupdate

            // Foreign key for paket hemat
            $table->foreign('id_paket')
                ->references('id_paket')->on('paket_hemats')
                ->onDelete('set null') // Untuk menghindari referensi yang salah
                ->onUpdate('cascade'); // Untuk memastikan referensi tetap valid jika data paket hemat diupdate
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};