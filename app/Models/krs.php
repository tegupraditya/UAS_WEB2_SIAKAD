<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $fillable = [
        'mahasiswa_id', // FK ke users.id dengan role mahasiswa
        'semester',
        'kode',
        'nama',
        'sks',
        'dosen',
        'hari',
        'mulai',
        'selesai',
        'ruang',
        'kelas',
        'pernah_ambil',
        'kehadiran',
        'tgl_input',
        'validasi',
    ];

    protected $casts = [
        'kehadiran' => 'float',
        'tgl_input' => 'datetime',
    ];

    // Relasi ke User yang bertindak sebagai mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Jika kamu punya model Dosen, bisa buat relasi seperti ini:
    // public function dosen()
    // {
    //     return $this->belongsTo(User::class, 'dosen_id'); // misal FK dosen_id
    // }

    // Jika kamu punya model MataKuliah, bisa buat relasi seperti ini:
    // public function mataKuliah()
    // {
    //     return $this->belongsTo(MataKuliah::class, 'kode', 'kode'); // misal kode sbg FK
    // }
}
