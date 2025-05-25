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
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->string('semester'); // Mengacu ke semester perkuliahan
            $table->float('nilai_akhir')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();

            // Unique constraint agar seorang mahasiswa tidak memiliki hasil studi ganda untuk mata kuliah yang sama di semester yang sama
            $table->unique(['mahasiswa_id', 'mata_kuliah_id', 'semester']);
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
