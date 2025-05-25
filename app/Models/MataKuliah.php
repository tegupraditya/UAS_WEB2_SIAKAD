<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'kode_mk',
        'nama',
        'sks',
        'dosen', // Ingat, ini string sesuai permintaan Anda
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang',
        'kelas',
        'semester',
    ];

    public function pengampu()
    {
        return $this->hasMany(Pengampu::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function khs()
    {
        return $this->hasMany(Khs::class);
    }
}