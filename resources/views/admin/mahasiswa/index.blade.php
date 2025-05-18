@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white px-0">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>

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
    </ol>
</nav>

<div class="container">
    <h1>Daftar Mahasiswa</h1>

    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Program</th>
                <th>Dosen Wali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $mhs)
                <tr>
                    <td>{{ $mhs->name }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>{{ $mhs->jurusan }}</td>
                    <td>{{ $mhs->program }}</td>
                    <td>{{ $mhs->dosen_pembimbing }}</td>
                    <td>
                        <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
