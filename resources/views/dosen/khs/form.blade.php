@extends('layouts.app')

@section('title', 'Input Nilai KHS')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-white px-0">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dosen.khs.index') }}">Kelola KHS</a></li>
        <li class="breadcrumb-item active" aria-current="page">Input Nilai</li>
    </ol>
</nav>

<h4 class="mb-3">Input Nilai Kartu Hasil Studi (KHS)</h4>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">Detail Mata Kuliah</div>
    <div class="card-body">
        <p><strong>Mata Kuliah:</strong> {{ $pengampu->mataKuliah->nama }} ({{ $pengampu->mataKuliah->kode_mk }})</p>
        <p><strong>SKS:</strong> {{ $pengampu->mataKuliah->sks }}</p>
        <p><strong>Semester:</strong> {{ $pengampu->semester }}</p>
        <p><strong>Hari:</strong> {{ $pengampu->hari }}</p>
        <p><strong>Jam:</strong> {{ $pengampu->jam_mulai }} - {{ $pengampu->jam_selesai }}</p>
        <p><strong>Ruang:</strong> {{ $pengampu->ruang }}</p>
        <p><strong>Kelas:</strong> {{ $pengampu->kelas }}</p>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('dosen.khs.store') }}" method="POST">
    @csrf
    <input type="hidden" name="mata_kuliah_id" value="{{ $pengampu->mataKuliah->id }}">
    <input type="hidden" name="semester" value="{{ $pengampu->semester }}">

    <div class="card">
        <div class="card-header bg-success text-white">Daftar Mahasiswa</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->user->name }}</td>
                            <td>
                                <input type="number" class="form-control form-control-sm nilai-input" name="nilai_akhir[{{ $index }}]" value="{{ old('nilai_akhir.' . $index, $mahasiswa->khs->first()->nilai_akhir ?? '') }}" min="0" max="100" step="0.01" data-index="{{ $index }}">
                                <input type="hidden" name="mahasiswa_id[{{ $index }}]" value="{{ $mahasiswa->id }}">
                            </td>
                            <td>
                                <span id="huruf-{{ $index }}" class="badge bg-secondary">{{ old('grade.' . $index, $mahasiswa->khs->first()->grade ?? '-') }}</span>
                                <input type="hidden" name="grade[{{ $index }}]" id="grade-{{ $index }}" value="{{ old('grade.' . $index, $mahasiswa->khs->first()->grade ?? '') }}">
                            </td>
                            <td>
                                <span id="status-{{ $index }}">
                                    {{ $mahasiswa->khs->first()->nilai_akhir ? 'Sudah Dinilai' : 'Belum Dinilai' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Tidak ada mahasiswa yang mengambil mata kuliah ini di semester ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <button type="submit" class="btn btn-success mt-3">Simpan Nilai</button>
    <a href="{{ route('dosen.khs.index') }}" class="btn btn-secondary mt-3">Batal</a>
</form>
</div>

<script>
    const nilaiInputs = document.querySelectorAll('.nilai-input');

    nilaiInputs.forEach(input => {
        input.addEventListener('input', function() {
            const index = this.dataset.index;
            const nilai = parseFloat(this.value);
            const hurufSpan = document.getElementById(`huruf-${index}`);
            const hurufInput = document.getElementById(`grade-${index}`);
            const statusSpan = document.getElementById(`status-${index}`);

            if (!isNaN(nilai)) {
                let huruf, badgeClass;

                if (nilai >= 85) {
                    huruf = 'A';
                    badgeClass = 'bg-success';
                } else if (nilai >= 70) {
                    huruf = 'B';
                    badgeClass = 'bg-info';
                } else if (nilai >= 55) {
                    huruf = 'C';
                    badgeClass = 'bg-warning';
                } else if (nilai >= 40) {
                    huruf = 'D';
                    badgeClass = 'bg-danger';
                } else {
                    huruf = 'E';
                    badgeClass = 'bg-dark';
                }

                hurufSpan.textContent = huruf;
                hurufSpan.className = `badge ${badgeClass}`;
                hurufInput.value = huruf;
                statusSpan.textContent = 'Sudah Dinilai'; // Ubah status menjadi "Sudah Dinilai"
            } else {
                hurufSpan.textContent = '-';
                hurufSpan.className = 'badge bg-secondary';
                hurufInput.value = '';
                statusSpan.textContent = 'Belum Dinilai'; // Ubah status menjadi "Belum Dinilai" jika nilai dihapus
            }
        });
    });
</script>
@endsection