<?php

namespace App\Http\Controllers\Dosen; // Pastikan namespace ini sesuai dengan lokasi folder Anda

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth Facade
use App\Models\Khs;
use App\Models\Pengampu;
use App\Models\Mahasiswa;
use App\Models\MataKuliah; // Import MataKuliah model

class KhsController extends Controller
{
    /**
     * Menampilkan daftar mata kuliah yang diampu oleh dosen yang login.
     */
    public function index()
    {
        $user = Auth::user(); // Dapatkan user yang sedang login
        
        // Pastikan user adalah dosen dan memiliki data dosen terkait
        if (!$user || $user->role !== 'dosen' || !$user->dosen) {
            abort(403, 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Ambil semua record pengampu yang terkait dengan dosen yang login
        $pengampu = Pengampu::where('dosen_id', $user->dosen->id)
            ->with('mataKuliah') // Eager load detail mata kuliah
            ->get();

        return view('dosen.khs.index', compact('pengampu'));
    }

    /**
     * Menampilkan form untuk menginput nilai KHS untuk mata kuliah tertentu.
     */
    public function showForm(Pengampu $pengampu) // Gunakan Route Model Binding
    {
        // Eager load relasi mataKuliah untuk mendapatkan detail semester
        $pengampu->load('mataKuliah');

        // Ambil mahasiswa yang mengambil mata kuliah ini di semester ini (melalui KRS)
        // Kita perlu mencari KRS yang sesuai dengan mata_kuliah_id dan semester dari pengampu
        $mahasiswas = Mahasiswa::whereHas('krs', function ($query) use ($pengampu) {
            $query->where('mata_kuliah_id', $pengampu->mata_kuliah_id);
            // Asumsi kolom 'semester' di tabel 'mata_kuliahs' (melalui pengampu)
            // mewakili semester sesi pengajaran yang relevan
            $query->where('semester', $pengampu->semester); 
        })
        ->with(['user', 'khs' => function($query) use ($pengampu) {
            // Eager load nilai KHS yang sudah ada untuk mata kuliah dan semester ini
            $query->where('mata_kuliah_id', $pengampu->mata_kuliah_id)
                  ->where('semester', $pengampu->semester);
        }])
        ->get();

        return view('dosen.khs.form', compact('pengampu', 'mahasiswas'));
    }

    /**
     * Menyimpan atau memperbarui nilai KHS mahasiswa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'semester' => 'required|string',
            'mahasiswa_id' => 'required|array',
            'mahasiswa_id.*' => 'exists:mahasiswa,id',
            'nilai_akhir' => 'nullable|array',
            'nilai_akhir.*' => 'nullable|numeric|min:0|max:100',
            'grade' => 'nullable|array',
            'grade.*' => 'nullable|string|max:2',
        ]);

        // Loop melalui setiap mahasiswa yang dikirimkan
        foreach ($request->mahasiswa_id as $key => $mahasiswaId) {
            // Pastikan nilai dan grade ada untuk index ini
            $nilaiAkhir = $request->nilai_akhir[$key] ?? null;
            $grade = $request->grade[$key] ?? null;

            // Gunakan updateOrCreate untuk menyimpan atau memperbarui nilai KHS
            Khs::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswaId,
                    'mata_kuliah_id' => $request->mata_kuliah_id,
                    'semester' => $request->semester,
                ],
                [
                    'nilai_akhir' => $nilaiAkhir,
                    'grade' => $grade,
                ]
            );
        }

        return redirect()->route('dosen.khs.index')->with('success', 'Nilai KHS berhasil disimpan.');
    }
}
