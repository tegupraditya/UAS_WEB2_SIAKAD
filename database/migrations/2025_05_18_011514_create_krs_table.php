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
        Schema::create('krs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
        $table->string('semester');
        $table->string('kode');
        $table->string('nama');
        $table->integer('sks');
        $table->string('dosen');
        $table->string('hari');
        $table->time('mulai');
        $table->time('selesai');
        $table->string('ruang');
        $table->string('kelas');
        $table->integer('pernah_ambil')->default(0);
        $table->float('kehadiran')->default(0);
        $table->timestamp('tgl_input')->nullable();
        $table->string('validasi')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
