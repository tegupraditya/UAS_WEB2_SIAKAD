@extends('layouts.app')

@section('title', 'Kelola KHS Dosen')

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-white px-0">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item dropdown">
                <a class="dropdown-toggle text-decoration-none" href="#" id="dosenDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Dosen
                </a>
                <ul class="dropdown-menu" aria-labelledby="dosenDropdown">
                    {{-- <li><a class="dropdown-item" href="{{ url('jadwal') }}">Jadwal Mata Kuliah</a></li>
                        <li><a class="dropdown-item" href="{{ url('absensi') }}">Absensi</a></li> --}}
                    <li><a class="dropdown-item" href="{{ route('dosen.khs.index') }}">Kelola KHS</a></li>
                </ul>
            </li>
        </ol>
    </nav>

    <h4 class="mb-3">Kelola Kartu Hasil Studi (KHS)</h4>

    <div class="card">
        <div class="card-header bg-primary text-white">Daftar Mata Kuliah yang Anda Ampu</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengampu as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->mataKuliah->kode_mk }}</td>
                            <td>{{ $item->mataKuliah->nama }}</td>
                            <td>{{ $item->mataKuliah->sks }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>
                                <a href="{{ route('dosen.khs.form', $item->id) }}" class="btn btn-sm btn-info">Input
                                    Nilai</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada mata kuliah yang Anda ampu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
