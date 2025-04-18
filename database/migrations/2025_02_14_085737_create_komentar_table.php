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
        Schema::create('komentar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_judul')->references('id')->on('judul')->onDelete('cascade');
            $table->foreignUuid('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->text('komentar');
            $table->enum('status',['perlu perbaikan','diterima']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
