<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs'; // Jika nama tabel bukan plural default (optional)

    protected $fillable = [
        'mahasiswa_id',   // FK ke users.id dengan role mahasiswa
        'semester',
        'kode_mk',        // ganti 'kode' jadi 'kode_mk' supaya konsisten sama kolom di DB dan view
        'nama',
        'sks',
        'dosen',
        'hari',
        'jam_mulai',          // ganti 'mulai' jadi 'jam_mulai' agar konsisten dengan view/index blade
        'jam_selesai',        // ganti 'selesai' jadi 'jam_selesai' agar konsisten dengan view/index blade
        'ruang',
        'kelas',
        'pernah_ambil',
        'kehadiran',
        'validasi',
    ];

    protected $casts = [
        'kehadiran' => 'float',
    ];

    // Relasi ke User yang bertindak sebagai mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Relasi opsional ke model MataKuliah, jika kamu ingin akses detail matkul
    // dengan foreign key kode_mk pada krs dan primary key kode pada mata_kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mkgit');
    }
}
