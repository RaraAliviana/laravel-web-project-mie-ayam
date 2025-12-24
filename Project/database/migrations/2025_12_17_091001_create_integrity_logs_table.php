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
            Schema::create('integrity_logs', function (Blueprint $table) {
        $table->id();
        $table->json('payload');           // data asli
        $table->string('hash');            // hash sekarang
        $table->string('previous_hash')->nullable();  // hash blok sebelumnya
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrity_logs');
    }
};
