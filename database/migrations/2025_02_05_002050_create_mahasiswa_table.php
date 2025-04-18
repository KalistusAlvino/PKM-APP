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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('userId')->onDelete('cascade');
            $table->string('name');
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('email');
            $table->string('no_wa');
            $table->timestamps();

            $table->foreign('userId')->references(columns: 'id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
