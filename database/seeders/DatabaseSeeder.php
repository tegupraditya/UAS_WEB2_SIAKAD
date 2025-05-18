<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('112233'),
            'role' => 'admin',
        ]);

        // Dosen
        User::create([
            'name' => 'Dosen Satu',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('dosen123'),
            'role' => 'dosen',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Mahasiswa Satu',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Teguh Praditya',
            'email' => 'Teguh@gmail.com',
            'password' => bcrypt('Teguh123'),
            'role' => 'mahasiswa',
        ]);
    }
}
