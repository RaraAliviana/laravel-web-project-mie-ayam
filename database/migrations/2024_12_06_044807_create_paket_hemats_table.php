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
        Schema::create('paket_hemats', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket');
            $table->text('deskripsi_paket');
            $table->decimal('harga_paket', 10, 2); // 10 digits, 2 decimal places
            // Kolom 'id_menu' sebagai foreign key yang nullable
            $table->unsignedBigInteger('id_menu')->nullable(); // id_menu merujuk ke tabel menus
            $table->timestamps();

            $table->foreign('id_menu')
                ->references('id_menu')->on('menus')
                ->onDelete('set null'); // Menghindari referensi yang salah jika menu dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_hemats');
    }
};