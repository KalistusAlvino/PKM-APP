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
        Schema::create('dosen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('userId')->references('id')->on('user')->onDelete('cascade');
            $table->bigInteger('nip');
            $table->string('name');
            $table->string('fakultas');
            $table->string('program_studi');
            $table->string('no_wa');
            $table->string('ketertarikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
