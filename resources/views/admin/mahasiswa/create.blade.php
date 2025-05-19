@extends('layouts.app')

@section('title', 'Tambah Akun Mahasiswa')

@section('content')
<div class="container">
    <h1>Tambah Akun Mahasiswa</h1>

    <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ old('nim') }}" required>
            @error('nim')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan" value="{{ old('jurusan') }}" required>
            @error('jurusan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="program" class="form-label">Program Studi</label>
            <select class="form-control @error('program') is-invalid @enderror" name="program" id="program" required>
                <option value="">-- Pilih Program Studi --</option>
                <option value="S1 Teknik Informatika" {{ old('program') == 'S1 Teknik Informatika' ? 'selected' : '' }}>S1 Teknik Informatika</option>
                <option value="S1 Sistem Informasi" {{ old('program') == 'S1 Sistem Informasi' ? 'selected' : '' }}>S1 Sistem Informasi</option>
            </select>
            @error('program')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dosen_pembimbing" class="form-label">Dosen Wali</label>
            <input type="text" class="form-control @error('dosen_pembimbing') is-invalid @enderror" name="dosen_pembimbing" id="dosen_pembimbing" value="{{ old('dosen_pembimbing') }}" required>
            @error('dosen_pembimbing')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
