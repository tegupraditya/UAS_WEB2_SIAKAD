<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'nilai',
        'semester',
    ];

    // Relasi ke User (mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Relasi ke MataKuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}
        