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
        Schema::create('judul', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_kelompok');
            $table->uuid('id_user');
            $table->string('detail_judul');
            $table->uuid('id_skema');
            $table->enum('keterangan',['Diterima','Ditolak'])->nullable()->default(null);
            $table->timestamps();

            $table->foreign('id_kelompok')->references('id')->on('kelompok');
            $table->foreign('id_skema')->references('id')->on('skema_pkm');
            $table->foreign('id_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judul');
    }
};
