@extends('layouts.app')

@section('title', 'Edit Akun Mahasiswa')

@section('content')
<div class="container">
    <h1>Edit Akun Mahasiswa</h1>

    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $mahasiswa->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $mahasiswa->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" id="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="program" class="form-label">Program</label>
            <input type="text" class="form-control" name="program" id="program" value="{{ old('program', $mahasiswa->program) }}" required>
        </div>

        <div class="mb-3">
            <label for="dosen_pembimbing" class="form-label">Dosen Wali</label>
            <input type="text" class="form-control" name="dosen_pembimbing" id="dosen_pembimbing" value="{{ old('dosen_pembimbing', $mahasiswa->dosen_pembimbing) }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (kosongkan jika tidak diganti)</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
