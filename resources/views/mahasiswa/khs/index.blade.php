@extends('layouts.app')

@section('title', 'Kartu Hasil Studi (KHS)')

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-white px-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item dropdown">
            <a class="dropdown-toggle text-decoration-none" href="#" id="mahasiswaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mahasiswa
            </a>
            <ul class="dropdown-menu" aria-labelledby="mahasiswaDropdown">
                <li><a class="dropdown-item" href="{{ route('mahasiswa.krs.index') }}">KRS</a></li>
                <li><a class="dropdown-item" href="{{ route('mahasiswa.khs.index') }}">KHS</a></li>
            </ul>
        </li>
    </ol>
</nav>

<h4 class="mb-3">Kartu Hasil Studi (KHS)</h4>

{{-- Form Pencarian --}}
<div class="card mb-4">
    <div class="card-body">
        <form class="row mb-2" method="GET" action="{{ route('mahasiswa.khs.index') }}">
            <label for="nim" class="col-sm-2 col-form-label ">NIM</label>
            <div class="col-sm-4">
                <input type="text" name="nim" id="nim" class="form-control" value="{{ request('nim') }}" placeholder="cth: F55123046">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-danger">Search</button>
            </div>
        </form>

        {{-- Tampilkan biodata mahasiswa --}}
        @if(isset($mahasiswa))
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $mahasiswa['nama'] }}" readonly>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $mahasiswa['jurusan'] }}" readonly>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $mahasiswa['program'] }}" readonly>
                </div>
            </div>
        @else
            <div class="alert alert-info mt-4">
                Silakan masukkan NIM untuk melihat KHS.
            </div>
        @endif

    </div>
</div>

{{-- Tabel KHS --}}
@if($khsData && $khsData->count() > 0)
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">Kartu Hasil Studi</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0 table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Semester</th>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($khsData as $index => $khs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $khs->semester }}</td>
                            <td>{{ $khs->mataKuliah->kode_mk }}</td>
                            <td>{{ $khs->mataKuliah->nama }}</td>
                            <td>{{ $khs->mataKuliah->sks }}</td>
                            <td>{{ $khs->pengampu->dosen_id}}</td>
                            <td>{{ $khs->nilai_akhir ?? '-' }}</td>
                            <td>{{ $khs->grade ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data KHS tidak ditemukan untuk NIM ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer Tabel (Total SKS) --}}
    <div class="d-flex justify-content-between mt-3">
        <div>
            <span><strong>Total SKS:</strong> {{ $khsData->sum('mataKuliah.sks') }}</span>
            {{-- Anda bisa menambahkan IPK di sini jika sudah dihitung di controller --}}
        </div>
        <div>
            {{-- Tombol atau informasi tambahan jika diperlukan --}}
        </div>
    </div>
@endif
@endsection