@extends('layouts.app')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white px-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>

            {{-- Tampilkan submenu hanya untuk mahasiswa --}}
            @if ($role === 'mahasiswa')
                <li class="breadcrumb-item dropdown">
                    <a class="dropdown-toggle text-decoration-none" href="#" id="mahasiswaDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Mahasiswa
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="mahasiswaDropdown">
                        <li><a class="dropdown-item" href="{{ url('krs') }}">KRS</a></li>
                        <li><a class="dropdown-item" href="{{ url('khs') }}">KHS</a></li>
                    </ul>
                </li>
            @endif

            {{-- Tampilkan submenu hanya untuk dosen --}}
            @if ($role === 'dosen')
                <li class="breadcrumb-item dropdown">
                    <a class="dropdown-toggle text-decoration-none" href="#" id="dosenDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dosen
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dosenDropdown">
                        <li><a class="dropdown-item" href="{{ url('jadwal') }}">Jadwal Mata Kuliah</a></li>
                        <li><a class="dropdown-item" href="{{ url('absensi') }}">Absensi</a></li>
                    </ul>
                </li>
            @endif

            {{-- Tambahkan submenu admin --}}
            @if ($role === 'admin')
                <li class="breadcrumb-item dropdown">
                    <a class="dropdown-toggle text-decoration-none" href="#" id="adminDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.mata-kuliah.index') }}">Mata Kuliah</a></li>
                    </ul>
                </li>

                <li class="breadcrumb-item dropdown">
                    <a class="dropdown-toggle text-decoration-none" href="#" id="akunDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kelola Akun
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="akunDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.dosen.index') }}">Dosen</a></li>
                    </ul>
                </li>
            @endif
        </ol>
    </nav>

    {{-- Konten Utama Berdasarkan Role --}}
    <div class="container mt-3">
        @if ($role === 'admin')
            {{-- TAMPILAM DASHBOARD ADMIN START --}}
            <h2>Selamat Datang, {{ $user->name }}</h2>

            <div class="row mt-4">
                {{-- Kartu Statistik --}}
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Mahasiswa</h5>
                            <p class="card-text display-6">{{ $totalMahasiswa ?? '-' }}</p>
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-outline-secondary btn-sm">Lihat
                                Data</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Dosen</h5>
                            <p class="card-text display-6">{{ $totalDosen ?? '-' }}</p>
                            <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary btn-sm">Lihat
                                Data</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Mata Kuliah Terdaftar</h5>
                            <p class="card-text display-6">{{ $totalMatkul ?? '-' }}</p>
                            <a href="{{ route('admin.mata-kuliah.index') }}" class="btn  btn-outline-secondary btn-sm">Lihat
                                Data</a>
                        </div>
                    </div>
                </div>
                
            </div>

            {{-- Quick Actions --}}
            <div class="mt-5">
                <h4>Aksi Cepat</h4>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('admin.mahasiswa.create') }}" class="btn" style="background-color: #02709b; color: white;" >+ Tambah Mahasiswa</a>
                    <a href="{{ route('admin.dosen.create') }}" class="btn" style="background-color: #02709b; color: white;" >+ Tambah dosen</a>
                    <a href="{{ route('admin.mata-kuliah.create') }}" class="btn" style="background-color: #02709b; color: white;" >+ Tambah Mata Kuliah</a>
                </div>
            </div>
            {{-- TAMPILAM DASHBOARD ADMIN END --}}
        @elseif ($role === 'dosen')
            <h2>Selamat Datang, {{ $user->name }}</h2>
            <p>Anda login sebagai <strong>{{ ucfirst($role) }}</strong></p>
            <div class="alert alert-success">Ini adalah panel dashboard untuk <strong>Dosen</strong>.</div>
        @elseif ($role === 'mahasiswa')
            <h2>Selamat Datang, {{ $user->name }}</h2>
            <p>Anda login sebagai <strong>{{ ucfirst($role) }}</strong>
            <div class="alert alert-info">Ini adalah panel dashboard untuk <strong>Mahasiswa</strong>.</div>
        @else
            <div class="alert alert-danger">Role tidak dikenali.</div>
        @endif
    </div>
@endsection
