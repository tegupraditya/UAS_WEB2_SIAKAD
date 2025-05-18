<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahs = MataKuliah::all();
        return view('admin.mata_kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('admin.mata_kuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs',
            'nama' => 'required',
            'sks' => 'required|integer',
            'dosen' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required',
            'kelas' => 'required',
            'semester' => 'required',

        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function edit(MataKuliah $mataKuliah)
    {
        return view('admin.mata_kuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliahs,kode_mk,' . $mataKuliah->id,
            'nama' => 'required',
            'sks' => 'required|integer',
            'dosen' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}
