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
        Schema::create('pengampu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');

            $table->string('hari', 50)->nullable(); // Contoh panjang 50
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('ruang', 100)->nullable(); // Contoh panjang 100
            $table->string('kelas', 50)->nullable(); // Contoh panjang 50
            $table->string('semester', 100)->nullable(); // Contoh panjang 100

            // Unique constraint dengan panjang indeks yang lebih pendek untuk kolom string
            $table->unique(
                ['dosen_id', 'mata_kuliah_id', 'semester', 'hari', 'jam_mulai', 'ruang', 'kelas'],
                'pengampu_unique_session'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengampu');
    }
};