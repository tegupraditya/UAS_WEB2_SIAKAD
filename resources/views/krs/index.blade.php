@extends('layouts.app')

@section('title', 'Kartu Rencana Studi (KRS)')

@section('content')
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
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
            <form class="row g-3">
                <div class="col-md-2">
                    <label>Semester Akademik</label>
                    <input type="text" class="form-control" value="20242" >
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-danger">Search</button>
                </div>
            </form>

            {{-- Biodata Mahasiswa --}}
            <input type="text" class="form-control" value="{{ $mahasiswa['nim'] }}" readonly>
            <input type="text" class="form-control" value="{{ $mahasiswa['nama'] }}" readonly>
            <input type="text" class="form-control" value="{{ $mahasiswa['jurusan'] }}" readonly>
            <input type="text" class="form-control" value="{{ $mahasiswa['program'] }}" readonly>
            <input type="text" class="form-control" value="{{ $mahasiswa['dosen'] }}" readonly>

        </div>
    </div>

    {{-- Keterangan Merah --}}
    <div class="alert alert-danger">
        <ul class="mb-0">
            <li>Fitur ini digunakan untuk menampilkan dan mengelola KRS per mahasiswa</li>
            <li>Cek data di PDDIKTI link: <a href="#" class="text-white"><u>PDDIKTI Kemdikbud</u></a></li>
            <li>Pastikan setiap semesternya data terdapat di PDDIKTI</li>
        </ul>
    </div>

    {{-- Kuesioner Biru --}}
    <div class="alert alert-info">
        <strong>Kuesioner :</strong> Bagi seluruh mahasiswa Universitas Tadulako, diharapkan untuk mengisi
        kuesioner survey kepuasan mahasiswa atas layanan Universitas Tadulako. <br>
        Link: <a href="#" class="text-dark"><u>Link Kuesioner</u></a>
    </div>

    {{-- Tombol Cetak --}}
    <div class="mb-3">
        <button class="btn btn-info">Cetak KRS</button>
        <button class="btn btn-success">Cetak Kartu Ujian</button>
        <button class="btn btn-danger">Cetak Transkrip</button>
        <button class="btn btn-dark">Cek Data</button>
    </div>

    {{-- Tabel KRS --}}
    <div class="card">
        <div class="card-header bg-secondary text-white">Kartu Rencana Studi</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0 table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th>#</th>
                        <th>KodeMK</th>
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
                        <th>Tgl Input</th>
                        <th>Validasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $index => $mk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mk['kode'] }}</td>
                        <td>{{ $mk['nama'] }}</td>
                        <td>{{ $mk['sks'] }}</td>
                        <td>{{ $mk['dosen'] }}</td>
                        <td>{{ $mk['hari'] }}</td>
                        <td>{{ $mk['mulai'] }}</td>
                        <td>{{ $mk['selesai'] }}</td>
                        <td>{{ $mk['ruang'] }}</td>
                        <td>{{ $mk['kelas'] }}</td>
                        <td>{{ $mk['pernah_ambil'] }}</td>
                        <td class="text-danger">{{ number_format($mk['kehadiran'], 2) }}</td>
                        <td>{{ $mk['tgl_input'] }}</td>
                        <td class="text-success">{{ $mk['validasi'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer Table --}}
    <div class="d-flex justify-content-between mt-3">
        <div>
            <span><strong>Total SKS yang diambil      :</strong> {{ $total_sks }}</span><br>
            <span><strong>Maximum SKS yg boleh diambil:</strong> 24</span>
        </div>
        <div>
            <button class="btn btn-secondary">Refresh SKS MAX</button>
        </div>
    </div>
@endsection
