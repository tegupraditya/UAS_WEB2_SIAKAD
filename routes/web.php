<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DosenMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
});

Route::get('/krs', [KrsController::class, 'index'])->name('mahasiswa.krs.index');
Route::get('/khs', [KhsController::class, 'index'])->name('mahasiswa.khs.index');
Route::get('/mahasiswa/khs/cetak-pdf', [KhsController::class, 'cetakPdf'])->name('mahasiswa.khs.cetak-pdf');
Route::get('mahasiswa/krs/create', [KrsController::class, 'create'])->name('mahasiswa.krs.create');
Route::post('mahasiswa/krs', [KrsController::class, 'store'])->name('mahasiswa.krs.store');

Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('mata-kuliah', MataKuliahController::class);
        Route::resource('/mahasiswa', App\Http\Controllers\Admin\MahasiswaController::class);
        // Route::resource('admin/mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class)->names('mahasiswa');
        Route::resource('dosen', App\Http\Controllers\Admin\DosenController::class);
        Route::resource('pengampu', App\Http\Controllers\Admin\PengampuController::class);
    });

use App\Http\Controllers\Dosen\KhsController as DosenKhsController;

Route::middleware(['auth', DosenMiddleware::class])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {
        Route::get('khs', [DosenKhsController::class, 'index'])->name('khs.index');
        Route::get('khs/form/{pengampu}', [DosenKhsController::class, 'showForm'])->name('khs.form');
        Route::post('khs/store', [DosenKhsController::class, 'store'])->name('khs.store');
    });





    


