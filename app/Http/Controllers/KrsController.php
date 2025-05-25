<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Krs;         // model KRS
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index(Request $request)
    {
        $semesterInput = $request->input('semester');
        $user = Auth::user();

        if ($user->role !== 'mahasiswa') {
            abort(403, 'Unauthorized');
        }

        // Biodata mahasiswa (gunakan relasi jika sudah diatur di model User)
        $mahasiswaData = $user->mahasiswa;
        $mahasiswa = [
            'semester' => '20242', // sementara static, bisa sesuaikan
            'nim' => $mahasiswaData->nim ?? '-',
            'nama' => $user->name,
            'jurusan' => $mahasiswaData->jurusan ?? '-',
            'program' => $mahasiswaData->program ?? '-',
            'dosen' => $mahasiswaData->dosenPembimbing->user->name ?? '-' // akses melalui relasi
        ];

        $matakuliah = collect();
        $total_sks = 0;
        $krsTerpilih = collect();

        if ($semesterInput === $mahasiswa['semester']) {
            // Semua matakuliah di semester itu
            $matakuliah = MataKuliah::where('semester', $semesterInput)->get();

            // Ambil matakuliah KRS yang sudah diambil mahasiswa (relasi dengan matakuliah)
            $krsTerpilih = Krs::with('mataKuliah')
                ->where('mahasiswa_id', $mahasiswaData->id) // gunakan ID dari model Mahasiswa
                ->where('semester', $semesterInput)
                ->get();

            // Hitung total SKS dari KRS mahasiswa
            $total_sks = $krsTerpilih->sum(function($krs) {
                return $krs->mataKuliah->sks ?? 0;
            });
        }

        return view('mahasiswa.krs.index', compact('mahasiswa', 'matakuliah', 'krsTerpilih', 'total_sks', 'semesterInput'));
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->role !== 'mahasiswa') {
            abort(403, 'Unauthorized');
        }

        // Ambil daftar matakuliah yang bisa dipilih untuk tambah KRS
        $matakuliah = MataKuliah::all(); // bisa disaring sesuai kebutuhan

        return view('mahasiswa.krs.create', compact('matakuliah'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $mahasiswaData = $user->mahasiswa; // Ambil data mahasiswa

        $request->validate([
            'semester' => 'required|string',
            'mata_kuliah_ids' => 'required|array',
            'mata_kuliah_ids.*' => 'exists:mata_kuliahs,id',
        ]);

        $semester = $request->semester;
        $mataKuliahIds = $request->mata_kuliah_ids;

        foreach ($mataKuliahIds as $mk_id) {
            $matkul = MataKuliah::find($mk_id);
            if (!$matkul) continue;

            // Cek duplikat berdasarkan mahasiswa_id, semester, dan mata_kuliah_id
            $exists = Krs::where('mahasiswa_id', $mahasiswaData->id) // gunakan ID dari model Mahasiswa
                ->where('semester', $semester)
                ->where('mata_kuliah_id', $mk_id)
                ->exists();

            if (!$exists) {
                Krs::create([
                    'mahasiswa_id' => $mahasiswaData->id, // gunakan ID dari model Mahasiswa
                    'semester' => $semester,
                    'mata_kuliah_id' => $mk_id,
                    'pernah_ambil' => 0,
                    'kehadiran' => 0,
                    'validasi' => null,
                    // 'tgl_input' => now(), // optional
                ]);
            }
        }

        return redirect()->route('mahasiswa.krs.index', ['semester' => $semester])
            ->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function show(Krs $krs)
    {
        // Implementasikan logika untuk menampilkan detail KRS jika diperlukan
    }

    public function edit(Krs $krs)
    {
        // Implementasikan logika untuk mengedit KRS jika diperlukan
    }

    public function update(Request $request, Krs $krs)
    {
        // Implementasikan logika untuk memperbarui KRS jika diperlukan
    }

    public function destroy(Krs $krs)
    {
        // Implementasikan logika untuk menghapus KRS jika diperlukan
    }
}