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
        @elseif(request('nim'))
            <div class="alert alert-warning mt-4">
                NIM yang Anda masukkan tidak ditemukan.
            </div>
        @else
            <div class="alert alert-info mt-4">
                Silakan masukkan NIM untuk melihat KHS.
            </div>
        @endif

    </div>
</div>

{{-- Tombol Aksi (Cetak KHS) --}}
@if(request('nim') && isset($mahasiswa))
    <div class="mb-3 mt-3">
        <a href="{{ route('mahasiswa.khs.cetak-pdf', ['nim' => request('nim')]) }}" class="btn btn-info" target="_blank">Cetak KHS</a>
        {{-- Anda bisa menambahkan tombol lain di sini jika diperlukan --}}
    </div>
@endif

{{-- Tabel KHS hanya muncul jika NIM sudah dicari DAN data KHS ada --}}
@if(request('nim') && $khsData && $khsData->count() > 0)
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
                            <td>
                                @php
                                    $dosenPengampu = $khs->mataKuliah->pengampu->firstWhere('semester', $khs->semester);
                                @endphp
                                {{ $dosenPengampu->dosen->user->name ?? '-' }}
                            </td>
                            <td>{{ $khs->nilai_akhir ?? '-' }}</td>
                            <td>{{ $khs->grade ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data KHS untuk NIM ini.</td>
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
        </div>
        <div>
        </div>
    </div>
@elseif(request('nim') && (!isset($mahasiswa) || $khsData->count() === 0))
    <div class="alert alert-warning mt-4">
        Tidak ada data KHS untuk NIM ini.
    </div>
@endif
@endsection
