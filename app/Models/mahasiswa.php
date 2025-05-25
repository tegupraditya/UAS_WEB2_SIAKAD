<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Pastikan nama tabel sesuai dengan migrasi Anda

    protected $fillable = [
        'user_id',
        'nim',
        'jurusan',
        'program',
        'dosen_pembimbing_id',
    ];

    /**
     * Get the user that owns the Mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the dosen pembimbing for the Mahasiswa.
     */
    public function dosenPembimbing()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing_id');
    }

    /**
     * Get all the krs records for the Mahasiswa.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    /**
     * Get all the khs records for the Mahasiswa.
     */
    public function khs()
    {
        return $this->hasMany(Khs::class);
    }
}