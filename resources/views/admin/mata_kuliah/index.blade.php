@extends('layouts.app') {{-- Layout admin, sesuaikan dengan layout yang kamu punya --}}

@section('title', 'Daftar Mata Kuliah')

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
    <h1>Daftar Mata Kuliah</h1>
    <a href="{{ route('admin.mata-kuliah.create') }}" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>KodeMK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Hari</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Ruang</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mataKuliahs as $mk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->dosen }}</td>
                    <td>{{ $mk->hari }}</td>
                    <td>{{ $mk->mulai }}</td>
                    <td>{{ $mk->selesai }}</td>
                    <td>{{ $mk->ruang }}</td>
                    <td>{{ $mk->kelas }}</td>
                    <td>
                        <a href="{{ route('admin.mata-kuliah.edit', $mk->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.mata-kuliah.destroy', $mk->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="11" class="text-center">Data Mata Kuliah kosong</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
