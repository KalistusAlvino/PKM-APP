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
            $table->uuid('id_judul');
            $table->uuid('id_user');
            $table->string('komentar');
            $table->enum('status',['perlu perbaikan','diterima']);
            $table->timestamps();

            $table->foreign('id_judul')->references('id')->on('judul');
            $table->foreign('id_user')->references('id')->on('user');
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
