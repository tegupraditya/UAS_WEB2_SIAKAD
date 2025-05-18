<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',   // untuk mahasiswa
        'nidn', // untuk dosen
        'jurusan',
        'program',
        'dosen_pembimbing',
        'semester',
          
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function krs()
    {
        return $this->hasMany(Krs::class, 'mahasiswa_id');
    }

    public function khs()
    {
        return $this->hasMany(Khs::class, 'mahasiswa_id');
    }

    public function pengampu()
    {
        return $this->hasMany(Pengampu::class, 'dosen_id');
    }
}
