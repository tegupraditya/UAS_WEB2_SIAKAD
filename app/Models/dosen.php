<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen'; // Pastikan nama tabel sesuai dengan migrasi Anda

    protected $fillable = [
        'user_id',
        'nidn',
    ];

    /**
     * Get the user that owns the Dosen.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the pengampu records for the Dosen.
     */
    public function pengampu()
    {
        return $this->hasMany(Pengampu::class);
    }
}
