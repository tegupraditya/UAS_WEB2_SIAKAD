@extends('layouts.app')

@section('title', 'Edit Dosen Pengampu')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-white px-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pengampu.index') }}">Kelola Dosen Pengampu</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</nav>

<div class="container">
    <h1>Edit Dosen Pengampu</h1>
    <form action="{{ route('admin.pengampu.update', $pengampu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen</label>
            <select class="form-control" id="dosen_id" name="dosen_id" required>
                <option value="">-- Pilih Dosen --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ $pengampu->dosen_id == $dosen->id ? 'selected' : '' }}>{{ $dosen->user->name }} ({{ $dosen->nidn }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
            <select class="form-control" id="mata_kuliah_id" name="mata_kuliah_id" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($mataKuliahs as $mk)
                    <option value="{{ $mk->id }}" {{ $pengampu->mata_kuliah_id == $mk->id ? 'selected' : '' }}>{{ $mk->nama }} ({{ $mk->kode_mk }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <input type="text" class="form-control @error('hari') is-invalid @enderror" id="hari" name="hari" value="{{ old('hari', $pengampu->hari) }}" required>
            @error('hari')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', \Carbon\Carbon::parse($pengampu->jam_mulai)->format('H:i')) }}" required>
            @error('jam_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', \Carbon\Carbon::parse($pengampu->jam_selesai)->format('H:i')) }}" required>
            @error('jam_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ruang" class="form-label">Ruang</label>
            <input type="text" class="form-control @error('ruang') is-invalid @enderror" id="ruang" name="ruang" value="{{ old('ruang', $pengampu->ruang) }}" required>
            @error('ruang')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas', $pengampu->kelas) }}" required>
            @error('kelas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester', $pengampu->semester) }}" required>
            @error('semester')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.pengampu.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection