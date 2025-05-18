@extends('layouts.app')

@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="container">
    <h1>Edit Mata Kuliah</h1>

    <form action="{{ route('admin.mata-kuliah.update', $mataKuliah->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode_mk" class="form-label">Kode Mata Kuliah</label>
            <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" id="kode_mk" name="kode_mk" value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" required>
            @error('kode_mk')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mata Kuliah</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $mataKuliah->nama) }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sks" class="form-label">SKS</label>
            <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" value="{{ old('sks', $mataKuliah->sks) }}" min="1" max="6" required>
            @error('sks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Input lain sama seperti create --}}
        <div class="mb-3">
            <label for="dosen" class="form-label">Dosen</label>
            <input type="text" class="form-control" id="dosen" name="dosen" value="{{ old('dosen', $mataKuliah->dosen) }}">
        </div>

        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <input type="text" class="form-control" id="hari" name="hari" value="{{ old('hari', $mataKuliah->hari) }}">
        </div>

        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Mulai</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('mulai', $mataKuliah->mulai) }}">
        </div>

        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Selesai</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ old('selesai', $mataKuliah->selesai) }}">
        </div>

        <div class="mb-3">
            <label for="ruang" class="form-label">Ruang</label>
            <input type="text" class="form-control" id="ruang" name="ruang" value="{{ old('ruang', $mataKuliah->ruang) }}">
        </div>

        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas', $mataKuliah->kelas) }}">
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" class="form-control" id="semester" name="semester" value="{{ old('semester', $mataKuliah->semester) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.mata-kuliah.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
