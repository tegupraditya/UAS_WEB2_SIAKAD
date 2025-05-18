@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah ke KRS')

@section('content')
<h3>Tambah Mata Kuliah ke KRS</h3>

<form method="POST" action="{{ route('mahasiswa.krs.store') }}">
    @csrf
    <input type="hidden" name="semester" value="{{ request('semester') }}">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pilih</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matakuliah as $mk)
                <tr>
                    <td><input type="checkbox" name="mata_kuliah_ids[]" value="{{ $mk->id }}"></td>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->sks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Tambah ke KRS</button>
    <a href="{{ route('mahasiswa.krs.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
