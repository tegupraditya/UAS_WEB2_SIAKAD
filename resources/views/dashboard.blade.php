@extends('layouts.app')

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white px-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>

        {{-- Tampilkan submenu hanya untuk mahasiswa --}}
        @if ($role === 'mahasiswa')
        <li class="breadcrumb-item dropdown">
            <a class="dropdown-toggle text-decoration-none" href="#" id="mahasiswaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <a class="dropdown-toggle text-decoration-none" href="#" id="dosenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            <a class="dropdown-toggle text-decoration-none" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin
            </a>
            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.mata-kuliah.index') }}">Mata Kuliah</a></li>
            </ul>
        </li>

        <li class="breadcrumb-item dropdown">
            <a class="dropdown-toggle text-decoration-none" href="#" id="akunDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <h2>Selamat Datang, {{ $user->name }}</h2>
    <p>Anda login sebagai <strong>{{ ucfirst($role) }}</strong></p>

    @if ($role === 'admin')
        <div class="alert alert-primary">Ini adalah panel dashboard untuk <strong>Admin</strong>.</div>
        {{-- Bisa tambah tombol atau shortcut cepat ke fitur admin di sini
        <div class="list-group">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="list-group-item list-group-item-action">Kelola Mata Kuliah</a>
            <a href="{{ route('admin.akun.index') }}" class="list-group-item list-group-item-action">Kelola Akun Mahasiswa & Dosen</a>
            <a href="{{ route('admin.semester.index') }}" class="list-group-item list-group-item-action">Kelola Semester Aktif</a>
        </div> --}}
    @elseif ($role === 'dosen')
        <div class="alert alert-success">Ini adalah panel dashboard untuk <strong>Dosen</strong>.</div>
    @elseif ($role === 'mahasiswa')
        <div class="alert alert-info">Ini adalah panel dashboard untuk <strong>Mahasiswa</strong>.</div>
    @else
        <div class="alert alert-danger">Role tidak dikenali.</div>
    @endif
</div>
@endsection
