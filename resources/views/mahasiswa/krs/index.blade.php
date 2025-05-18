@extends('layouts.app')

@section('title', 'Kartu Rencana Studi (KRS)')

@section('content')
{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-white px-0">
        <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
        <li class="breadcrumb-item dropdown">
            <a class="dropdown-toggle text-decoration-none" href="#" id="mahasiswaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mahasiswa
            </a>
            <ul class="dropdown-menu" aria-labelledby="mahasiswaDropdown">
                <li><a class="dropdown-item" href="krs">KRS</a></li>
                <li><a class="dropdown-item" href="khs">KHS</a></li>
            </ul>
        </li>
    </ol>
</nav>

<h4 class="mb-3">Kartu Rencana Studi (KRS)</h4>

{{-- Form Pencarian --}}
<div class="card mb-4">
    <div class="card-body">
        <form class="row mb-2" method="GET" action="{{ route('mahasiswa.krs.index') }}">
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
            <div class="row mb-2">
                <label class="col-sm-2 col-form-label">Dosen Wali</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $mahasiswa['dosen'] }}" readonly>
                </div>
            </div>
        @endif

    </div>
</div>

{{-- Tombol Aksi --}}
@if(request('semester') && isset($mahasiswa))
    <div class="mb-3 mt-3">
        <button class="btn btn-info">Cetak KRS</button>
        <a href="{{ route('mahasiswa.krs.create', ['semester' => request('semester')]) }}" class="btn btn-warning">+ Tambah Mata Kuliah</a>
    </div>
@endif

{{-- Tabel KRS --}}
@if($krsTerpilih && $krsTerpilih->count() > 0)
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">Kartu Rencana Studi Anda</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0 table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Ruang</th>
                        <th>Kelas</th>
                        <th>Pernah Ambil</th>
                        <th>Kehadiran</th>
                        <th>Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($krsTerpilih as $index => $krs)
                    @php $mk = $krs->matakuliah; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mk->kode_mk }}</td>
                        <td>{{ $mk->nama }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->dosen }}</td>
                        <td>{{ $mk->hari }}</td>
                        <td>{{ $mk->jam_mulai }}</td>
                        <td>{{ $mk->jam_selesai }}</td>
                        <td>{{ $mk->ruang }}</td>
                        <td>{{ $mk->kelas }}</td>
                        <td>{{ $krs->pernah_ambil ?? '-' }}</td>
                        <td class="text-danger">{{ number_format($krs->kehadiran ?? 0, 2) }}</td>
                        <td class="text-success">{{ $krs->validasi ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer Tabel --}}
    <div class="d-flex justify-content-between mt-3">
        <div>
            <span><strong>Total SKS yang diambil :</strong> {{ $total_sks }}</span><br>
            <span><strong>Maximum SKS yg boleh diambil:</strong> 24</span>
        </div>
        <div>
            <button class="btn btn-secondary">Refresh SKS MAX</button>
        </div>
    </div>
@endif
@endsection
