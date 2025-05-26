<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengampu;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class PengampuController extends Controller
{
    public function index()
    {
        $pengampus = Pengampu::with('dosen.user', 'mataKuliah')->get();
        return view('admin.pengampu.index', compact('pengampus'));
    }

    public function create()
    {
        $dosens = Dosen::with('user')->get();
        $mataKuliahs = MataKuliah::all();
        return view('admin.pengampu.create', compact('dosens', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruang' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ]);

        Pengampu::create($request->all());

        return redirect()->route('admin.pengampu.index')->with('success', 'Data Dosen Pengampu berhasil ditambahkan.');
    }

    public function edit(Pengampu $pengampu)
    {
        $dosens = Dosen::with('user')->get();
        $mataKuliahs = MataKuliah::all();
        return view('admin.pengampu.edit', compact('pengampu', 'dosens', 'mataKuliahs'));
    }

    public function update(Request $request, Pengampu $pengampu)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruang' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ]);

        $pengampu->update($request->all());

        return redirect()->route('admin.pengampu.index')->with('success', 'Data Dosen Pengampu berhasil diperbarui.');
    }

    public function destroy(Pengampu $pengampu)
    {
        $pengampu->delete();
        return redirect()->route('admin.pengampu.index')->with('success', 'Data Dosen Pengampu berhasil dihapus.');
    }
}