<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mahasiswa; // Import model Mahasiswa
use App\Models\Dosen;     // Import model Dosen
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('user', 'dosenPembimbing.user')->get();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::with('user')->get();
        return view('admin.mahasiswa.create', compact('dosens'));
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
            'nim' => 'required|unique:mahasiswa,nim',
            'jurusan' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'dosen_pembimbing_id' => 'required|exists:dosen,id',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'jurusan' => $request->jurusan,
                'program' => $request->program,
                'dosen_pembimbing_id' => $request->dosen_pembimbing_id,
            ]);

            DB::commit();
            return redirect()->route('admin.mahasiswa.index')->with('success', 'Akun mahasiswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan akun mahasiswa: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user', 'dosenPembimbing.user');
        $dosens = Dosen::with('user')->get();
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user->id,
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'password' => 'nullable|min:6',
            'jurusan' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'dosen_pembimbing_id' => 'required|exists:dosen,id',
        ]);

        DB::beginTransaction();
        try {
            $mahasiswa->user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $mahasiswa->user->password,
            ]);

            $mahasiswa->update([
                'nim' => $request->nim,
                'jurusan' => $request->jurusan,
                'program' => $request->program,
                'dosen_pembimbing_id' => $request->dosen_pembimbing_id,
            ]);

            DB::commit();
            return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui data mahasiswa: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::beginTransaction();
        try {
            $mahasiswa->user->delete();
            DB::commit();
            return redirect()->route('admin.mahasiswa.index')->with('success', 'Akun mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus akun mahasiswa: ' . $e->getMessage()]);
        }
    }
}