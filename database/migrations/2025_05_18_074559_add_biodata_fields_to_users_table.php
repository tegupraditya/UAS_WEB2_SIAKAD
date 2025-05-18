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
        Schema::table('users', function (Blueprint $table) {
            $table->string('jurusan')->nullable();
            $table->string('program')->nullable();
            $table->string('dosen_pembimbing')->nullable();
            $table->string('semester')->nullable(); // kalau diperlukan
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['jurusan', 'program', 'dosen_pembimbing', 'semester']);
        });
    }

};
