<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MataKuliah;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil user yang login
        $role = $user->role;

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMatkul = MataKuliah::count();

        // Kirim data role ke view
        return view('dashboard', compact('user', 'role','totalMahasiswa', 'totalDosen', 'totalMatkul',));
        // return view('dashboard', [
        //     'totalMahasiswa' => $totalMahasiswa,
        //     'totalDosen' => $totalDosen,
        //     'totalAdmin' => $totalAdmin,
        //     'role' => $role,
        //     'user' => $user,
        // ]);
    }
}
