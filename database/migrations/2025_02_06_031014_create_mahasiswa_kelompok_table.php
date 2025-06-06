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
        Schema::create('mahasiswa_kelompok', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kelompokId')->onDelete('cascade');
            $table->foreignUuid('mahasiswaId')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->enum('status_mahasiswa',['ketua','anggota']);
            $table->year('tahun_daftar');
            $table->timestamps();

            $table->foreign('kelompokId')->references('id')->on('kelompok');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_kelompok');
    }
};
