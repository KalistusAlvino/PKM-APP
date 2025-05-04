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
        Schema::create('invite_dospem', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('inviterId')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->foreignUuid('dospemId')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreignUuid('kelompokId')->references('id')->on('kelompok')->onDelete('cascade');
            $table->enum('status',['menunggu','ditolak'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invite_dospem');
    }
};
