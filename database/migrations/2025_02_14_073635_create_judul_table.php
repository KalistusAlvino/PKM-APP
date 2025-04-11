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
            $table->foreignUuid('id_kelompok')->references('id')->on('kelompok')->onDelete('cascade');
            $table->foreignUuid('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->string('detail_judul');
            $table->foreignUuid('id_skema')->references('id')->on('skema_pkm')->onDelete('cascade');
            $table->boolean('is_proposal')->default(false);
            $table->timestamps();
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
