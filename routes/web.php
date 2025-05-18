<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('can:isAdmin');

    Route::get('/dashboard/dosen', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('can:isDosen');

    Route::get('/dashboard/mahasiswa', function () {
        return view('krs.index');
    })->name('dashboard')->middleware('can:isMahasiswa');
});


Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

use App\Http\Controllers\KrsController;
use App\Http\Controllers\KhsController;

Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
Route::get('/khs', [KhsController::class, 'index'])->name('khs.index');
