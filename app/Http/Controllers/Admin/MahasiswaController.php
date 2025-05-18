<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nim' => 'required|unique:users,nim',
            'jurusan' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'dosen_pembimbing' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'mahasiswa',
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'program' => $request->program,
            'dosen_pembimbing' => $request->dosen_pembimbing,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Akun mahasiswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = User::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->id,
            'nim' => 'required|unique:users,nim,' . $mahasiswa->id,
            'password' => 'nullable|min:6',
            'jurusan' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'dosen_pembimbing' => 'required|string|max:255',
            
        ]);

        $mahasiswa->update([
            'name' => $request->nama,
            'email' => $request->email,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'program' => $request->program,
            'dosen_pembimbing' => $request->dosen_pembimbing,
            'password' => $request->password ? bcrypt($request->password) : $mahasiswa->password,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = User::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Akun mahasiswa berhasil dihapus.');
    }
}
