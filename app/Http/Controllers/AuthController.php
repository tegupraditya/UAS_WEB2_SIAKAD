<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        // Karena Auth::attempt hanya menerima email dan password, kita harus pisahkan cek role setelah login berhasil
        $email = $credentials['email'];
        $password = $credentials['password'];
        $role = $credentials['role'];

        // Coba login hanya dengan email dan password
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Cek apakah role user sesuai dengan input role
            if (Auth::user()->role !== $role) {
                Auth::logout();
                return back()->withErrors([
                    'role' => 'Role yang dipilih tidak sesuai dengan akun.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            // Arahkan ke dashboard sesuai role
            if ($role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($role === 'dosen') {
                return redirect()->route('dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->route('dashboard');
            }

            // Default fallback
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("auth.login");
    }
}
