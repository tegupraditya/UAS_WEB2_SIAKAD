@extends('layouts.app')

@section('title', 'Daftar Akun Dosen')

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
    <h1>Daftar Akun Dosen</h1>

    <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary mb-3">Tambah Dosen</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>NIDN</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dosens as $dosen)
            <tr>
                <td>{{ $dosen->name }}</td>
                <td>{{ $dosen->email }}</td>
                <td>{{ $dosen->nidn }}</td>
                <td>
                    <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
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
