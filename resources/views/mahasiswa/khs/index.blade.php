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
            <label for="semester" class="col-sm-2 col-form-label ">Semester Akademik</label>
            <div class="col-sm-4">
                <input type="text" name="semester" id="semester" class="form-control" value="{{ request('semester') }}" placeholder="cth: 20242">
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-danger">Search</button>
            </div>
        </form>

        {{-- Tampilkan biodata mahasiswa --}}
        @if(isset($mahasiswa))
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $mahasiswa['nim'] }}" readonly>
                </div>
            </div>
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
            {{-- Dosen Wali di KHS mungkin tidak selalu relevan, tapi saya sertakan jika diperlukan --}}
            {{-- <div class="row mb-2">
                <label class="col-sm-2 col-form-label">Dosen Wali</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $mahasiswa['dosen'] ?? '-' }}" readonly>
                </div>
            </div> --}}
        @endif

    </div>
</div>

{{-- Tabel KHS --}}
@if($khsData && $khsData->count() > 0)
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">Kartu Hasil Studi Anda</div>
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
                            <td>{{ $khs->mataKuliah->dosen }}</td>
                            <td>{{ $khs->nilai_akhir ?? '-' }}</td>
                            <td>{{ $khs->grade ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data KHS belum tersedia untuk semester ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer Tabel (Total SKS) --}}
    <div class="d-flex justify-content-between mt-3">
        <div>
            {{-- Total SKS di KHS biasanya adalah SKS yang lulus, atau total SKS yang diambil --}}
            {{-- Anda bisa menghitung total SKS dari $khsData yang ditampilkan --}}
            <span><strong>Total SKS yang diambil di semester ini:</strong> {{ $khsData->sum('mataKuliah.sks') }}</span><br>
            {{-- IPK bisa dihitung di controller dan ditampilkan di sini --}}
            {{-- <span><strong>Indeks Prestasi Kumulatif (IPK):</strong> {{ $ipk ?? 'N/A' }}</span> --}}
        </div>
        <div>
            {{-- Tombol atau informasi tambahan jika diperlukan --}}
        </div>
    </div>
@else
    <div class="alert alert-info mt-4">
        Silakan masukkan Semester Akademik untuk melihat KHS.
    </div>
@endif
@endsection
