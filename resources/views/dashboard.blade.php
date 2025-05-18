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

        @if ($role === 'dosen')
        <li class="breadcrumb-item dropdown">
            <a class="dropdown-toggle text-decoration-none" href="#" id="dosenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dosen
            </a>
            <ul class="dropdown-menu" aria-labelledby="dosenDropdown">
                <li><a class="dropdown-item" href="{{ url('jadwal') }}">Jadwal Mata Kuliah</a></li>
                <li><a class="dropdown-item" href="{{ url('Absensi') }}">Absensi</a></li>
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
    @elseif ($role === 'dosen')
        <div class="alert alert-success">Ini adalah panel dashboard untuk <strong>Dosen</strong>.</div>
    @elseif ($role === 'mahasiswa')
        <div class="alert alert-info">Ini adalah panel dashboard untuk <strong>Mahasiswa</strong>.</div>
    @else
        <div class="alert alert-danger">Role tidak dikenali.</div>
    @endif
</div>
@endsection     
