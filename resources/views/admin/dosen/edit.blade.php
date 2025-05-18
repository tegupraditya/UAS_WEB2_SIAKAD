@extends('layouts.app')

@section('title', 'Edit Akun Dosen')

@section('content')
<div class="container">
    <h1>Edit Akun Dosen</h1>

    <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dosen->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $dosen->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" class="form-control" id="nidn" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengganti)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
