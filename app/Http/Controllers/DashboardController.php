<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // ambil user yang login
        $role = $user->role;

        // Kirim data role ke view
        return view('dashboard', compact('user', 'role'));
    }
}
