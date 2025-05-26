<?php

namespace App\Http\Controllers; // Pastikan namespace ini sesuai dengan lokasi file Anda

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Penting: Import kelas Request
use Illuminate\Support\Facades\Auth;
use App\Models\Khs;
use App\Models\Mahasiswa; // Penting: Import model Mahasiswa
use App\Models\User;     // Penting: Import model User (sudah ada, tapi pastikan)
use App\Models\Dosen;    // Penting: Import model Dosen (untuk relasi dosen pembimbing)

class KhsController extends Controller
{
    public function index(Request $request) // Tambahkan parameter Request
    {
        $nim = $request->input('nim'); // Ambil NIM dari input form
        $mahasiswa = null; // Inisialisasi variabel mahasiswa
        $khsData = collect(); // Inisialisasi koleksi KHS

        // Jika NIM dimasukkan di form pencarian
        if ($nim) {
            // Cari data mahasiswa berdasarkan NIM, eager load user dan dosen pembimbing
            $mahasiswaData = Mahasiswa::where('nim', $nim)
                                ->with('user') // Tidak perlu eager load dosenPembimbing.user jika tidak ditampilkan
                                ->first();

            // Jika data mahasiswa ditemukan
            if ($mahasiswaData) {
                // Populate array $mahasiswa dengan data yang ditemukan
                $mahasiswa = [
                    'nim' => $mahasiswaData->nim ?? '-',
                    'nama' => $mahasiswaData->user->name ?? '-', // Ambil nama dari relasi user
                    'jurusan' => $mahasiswaData->jurusan ?? '-',
                    'program' => $mahasiswaData->program ?? '-',
                ];

                // Ambil data KHS untuk mahasiswa yang ditemukan
                $khsData = Khs::where('mahasiswa_id', $mahasiswaData->id)
                    ->with('mataKuliah') // Eager load detail mata kuliah
                    ->orderBy('semester')
                    ->get();
            } else {
                // Jika NIM tidak ditemukan, Anda bisa menambahkan pesan error
                // Contoh: return view('mahasiswa.khs.index', compact('mahasiswa', 'khsData'))->withErrors(['nim' => 'NIM tidak ditemukan.']);
                // Untuk saat ini, kita biarkan $mahasiswa dan $khsData tetap null/kosong
            }
        } else {
            // Jika tidak ada NIM yang dimasukkan, dan user adalah mahasiswa yang login
            // Tampilkan KHS untuk mahasiswa yang sedang login secara default
            $loggedInUser = Auth::user();
            if ($loggedInUser && $loggedInUser->role === 'mahasiswa') {
                $mahasiswaData = $loggedInUser->mahasiswa;

                if ($mahasiswaData) {
                    $mahasiswa = [
                        'nim' => $mahasiswaData->nim ?? '-',
                        'nama' => $loggedInUser->name,
                        'jurusan' => $mahasiswaData->jurusan ?? '-',
                        'program' => $mahasiswaData->program ?? '-',
                    ];

                    $khsData = Khs::where('mahasiswa_id', $mahasiswaData->id)
                        ->with('mataKuliah')
                        ->orderBy('semester')
                        ->get();
                }
            }
        }

        // Kirimkan variabel $mahasiswa (bisa null/kosong jika NIM tidak ditemukan/tidak diisi)
        // dan $khsData (bisa kosong) ke view
        return view('mahasiswa.khs.index', compact('mahasiswa', 'khsData'));
    }

    // Anda bisa menambahkan method lain untuk CRUD KHS jika diperlukan
}
