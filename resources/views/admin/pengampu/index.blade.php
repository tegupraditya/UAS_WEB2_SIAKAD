@extends('layouts.app')

@section('title', 'Kelola Dosen Pengampu')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white px-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item dropdown">
                <a class="dropdown-toggle text-decoration-none" href="#" id="adminDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Admin
                </a>
                <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.mata-kuliah.index') }}">Mata Kuliah</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.pengampu.index') }}">Dosen Pengampu</a></li>
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
        </ol>
    </nav>

    <div class="container">
        <h1>Kelola Dosen Pengampu</h1>
        <a href="{{ route('admin.pengampu.create') }}" class="btn btn-primary mb-3">Tambah Dosen Pengampu</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Ruang</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengampus as $pengampu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengampu->dosen->user->name ?? '-' }} ({{ $pengampu->dosen->nidn ?? '-' }})</td>
                        <td>{{ $pengampu->mataKuliah->nama ?? '-' }} ({{ $pengampu->mataKuliah->kode_mk ?? '-' }})</td>
                        <td>{{ $pengampu->hari ?? '-' }}</td>
                        <td>{{ $pengampu->jam_mulai ? \Carbon\Carbon::parse($pengampu->jam_mulai)->format('H:i') : '-' }}
                        </td>
                        <td>{{ $pengampu->jam_selesai ? \Carbon\Carbon::parse($pengampu->jam_selesai)->format('H:i') : '-' }}
                        </td>
                        <td>{{ $pengampu->ruang ?? '-' }}</td>
                        <td>{{ $pengampu->kelas ?? '-' }}</td>
                        <td>{{ $pengampu->semester ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.pengampu.edit', $pengampu->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.pengampu.destroy', $pengampu->id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirm('Yakin hapus data pengampu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Data Dosen Pengampu kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
