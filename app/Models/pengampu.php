<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'mata_kuliah_id',
    ];

    // Relasi ke User (dosen)
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    // Relasi ke MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
