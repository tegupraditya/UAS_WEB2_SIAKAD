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
    Schema::table('mata_kuliahs', function (Blueprint $table) {
        $table->string('semester')->nullable()->after('kelas');
    });
}

public function down(): void
{
    Schema::table('mata_kuliahs', function (Blueprint $table) {
        $table->dropColumn('semester');
    });
}

};
