<?php

namespace App\Http\Controllers; // Ubah namespace sesuai struktur folder Anda

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Khs;

class KhsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswaData = $user->mahasiswa;

        $mahasiswa = [
            'nim' => $mahasiswaData->nim ?? '-',
            'nama' => $user->name,
            'jurusan' => $mahasiswaData->jurusan ?? '-',
            'program' => $mahasiswaData->program ?? '-',
        ];

        $khsData = Khs::where('mahasiswa_id', $mahasiswaData->id)
            ->with('mataKuliah')
            ->orderBy('semester')
            ->get();

        return view('mahasiswa.khs.index', compact('mahasiswa', 'khsData'));
    }

    // Anda bisa menambahkan method lain untuk CRUD KHS jika diperlukan
}