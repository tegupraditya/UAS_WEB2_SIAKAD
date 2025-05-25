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
       Schema::create('mata_kuliahs', function (Blueprint $table) {
        $table->id();
        $table->string('kode_mk')->unique();
        $table->string('nama');
        $table->integer('sks');
        $table->string('dosen');
        $table->string('hari');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->string('ruang');
        $table->string('kelas');
        $table->string('semester');
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
