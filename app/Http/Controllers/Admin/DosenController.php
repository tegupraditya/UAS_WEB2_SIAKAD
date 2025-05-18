<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = User::where('role', 'dosen')->get();
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
            'nidn' => 'required|unique:users,nidn',
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'dosen',
            'nidn' => $request->nidn,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Akun dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = User::where('id', $id)->where('role', 'dosen')->firstOrFail();
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = User::where('id', $id)->where('role', 'dosen')->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dosen->id,
            'nidn' => 'required|unique:users,nidn,' . $dosen->id,
            'password' => 'nullable|min:6',
        ]);

        $dosen->name = $request->nama;
        $dosen->email = $request->email;
        $dosen->nidn = $request->nidn;

        if ($request->filled('password')) {
            $dosen->password = bcrypt($request->password);
        }

        $dosen->save();

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::where('id', $id)->where('role', 'dosen')->delete();
        return redirect()->back()->with('success', 'Akun dosen berhasil dihapus.');
    }
}
