<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Dosen; // Import model Dosen
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('user')->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nidn' => 'required|unique:dosen,nidn',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'dosen',
            ]);

            Dosen::create([
                'user_id' => $user->id,
                'nidn' => $request->nidn,
            ]);

            DB::commit();
            return redirect()->route('admin.dosen.index')->with('success', 'Akun dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan akun dosen: ' . $e->getMessage()]);
        }
    }

    public function edit(Dosen $dosen)
    {
        $dosen->load('user');
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dosen->user->id,
            'nidn' => 'required|unique:dosen,nidn,' . $dosen->id,
            'password' => 'nullable|min:6',
        ]);

        DB::beginTransaction();
        try {
            $dosen->user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $dosen->user->password,
            ]);

            $dosen->update([
                'nidn' => $request->nidn,
            ]);

            DB::commit();
            return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui data dosen: ' . $e->getMessage()]);
        }
    }

    public function destroy(Dosen $dosen)
    {
        DB::beginTransaction();
        try {
            $dosen->user->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Akun dosen berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus akun dosen: ' . $e->getMessage()]);
        }
    }
}