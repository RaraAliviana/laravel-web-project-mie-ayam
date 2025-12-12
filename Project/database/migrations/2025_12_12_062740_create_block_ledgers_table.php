<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('block_ledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('data')->nullable(); // JSON/text of the recorded data
            $table->timestamp('block_timestamp')->useCurrent(); // timestamp of block creation
            $table->string('previous_hash', 128)->nullable();
            $table->string('current_hash', 128)->nullable();
            $table->unsignedBigInteger('model_id')->nullable(); // optional: id of related model
            $table->string('model_type')->nullable(); // optional: class name of related model
            $table->timestamps();

            $table->index(['block_timestamp']);
            $table->index(['current_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('block_ledgers');
    }
};
