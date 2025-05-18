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
        Schema::create('khs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
        $table->string('nilai'); // bisa A, B, C atau nilai angka
        $table->string('semester'); // kode semester, atau foreign key ke tabel semester kalau mau konsisten
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khs');
    }
};
