<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_jenis')->references('id')->on('jenis')->onDelete('cascade');
            $table->foreignUuid('id_file')->nullable();
            $table->foreign('id_file')
                ->references('id')
                ->on('proposal_final')
                ->onDelete('set null');
            $table->foreignUuid('id_kelompok')->references('id')->on('kelompok')->onDelete('cascade');
            $table->foreignUuid('id_mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->string('nama_kegiatan');
            $table->string('kegiatan_inggris');
            $table->date('tanggal');
            $table->enum('status', ['acc', 'menunggu']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
