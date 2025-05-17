<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KrsController extends Controller
{
    public function index()
    {
        // Data biodata dan mata kuliah dummy
        $mahasiswa = [
            'semester' => '20242',
            'nim' => 'F55123054',
            'nama' => 'SYAHRIL FITRAWAN ABADI',
            'jurusan' => 'F551 - TEKNIK INFORMATIKA',
            'program' => 'REG',
            'dosen' => 'Ir. SYAHRUL S.Kom, M.Kom'
        ];

        $matakuliah = [
            [
                'kode' => 'F09170201',
                'nama' => 'PEMROGRAMAN WEB II',
                'sks' => 3,
                'dosen' => 'Dr. Ir. H. M. Yazid Pusadan',
                'hari' => 'Senin',
                'mulai' => '07:30',
                'selesai' => '10:00',
                'ruang' => 'F.11',
                'kelas' => 'B',
                'pernah_ambil' => 0,
                'kehadiran' => 0.00,
                'tgl_input' => '2025-02-09 18:14:26',
                'validasi' => 'MataKuliah telah disetujui'
            ],
            // Tambahkan data lainnya...
        ];

        $total_sks = collect($matakuliah)->sum('sks');

        return view('krs.index', compact('mahasiswa', 'matakuliah', 'total_sks'));
    }
}
