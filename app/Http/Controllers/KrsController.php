<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Krs;          // model KRS
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

        // Biodata mahasiswa
        $mahasiswa = [
            'semester' => '20242', // sementara static, bisa sesuaikan
            'nim' => $user->nim,
            'nama' => $user->name,
            'jurusan' => $user->jurusan ?? '-',
            'program' => $user->program ?? '-',
            'dosen' => $user->dosen_pembimbing ?? '-'
        ];

        $matakuliah = collect();
        $total_sks = 0;
        $krsTerpilih = collect();

        if ($semesterInput === $mahasiswa['semester']) {
            // Semua matakuliah di semester itu
            $matakuliah = MataKuliah::where('semester', $semesterInput)->get();

            // Ambil matakuliah KRS yang sudah diambil mahasiswa (relasi dengan matakuliah)
            $krsTerpilih = Krs::with('matakuliah')
                ->where('mahasiswa_id', $user->id)
                ->where('semester', $semesterInput)
                ->get();

            // Hitung total SKS dari KRS mahasiswa
            $total_sks = $krsTerpilih->sum(function($krs) {
                return $krs->matakuliah->sks ?? 0;
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

        // Cek duplikat berdasarkan mahasiswa_id, semester, dan kode (karena kolom kode yang tersedia)
        $exists = Krs::where('mahasiswa_id', $user->id)
            ->where('semester', $semester)
            ->where('kode_mk', $matkul->kode_mk)
            ->exists();

        if (!$exists) {
            Krs::create([
                'mahasiswa_id' => $user->id,
                'semester' => $semester,
                'kode_mk' => $matkul->kode_mk,
                'nama' => $matkul->nama,
                'sks' => $matkul->sks,
                'dosen' => $matkul->dosen,
                'hari' => $matkul->hari,
                'jam_mulai' => $matkul->jam_mulai,
                'jam_selesai' => $matkul->jam_selesai,
                'ruang' => $matkul->ruang,
                'kelas' => $matkul->kelas,
                'pernah_ambil' => 0,
                'kehadiran' => 0,
                'validasi' => null,
                'tgl_input' => now(), // optional
            ]);
        }
    }

    return redirect()->route('mahasiswa.krs.index', ['semester' => $semester])
        ->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
}


}
