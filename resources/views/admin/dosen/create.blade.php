@extends('layouts.app')

@section('title', 'Tambah Akun Dosen')

@section('content')
<div class="container">
    <h1>Tambah Akun Dosen</h1>

    <form action="{{ route('admin.dosen.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" class="form-control" id="nidn" name="nidn" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
