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
        <input type="hidden" name="mata_kuliah_id" value="{{ $pengampu->mata_kuliah_id }}">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswas as $index => $mahasiswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->user->name }}</td>
                                <td>
                                    {{-- Cek apakah sudah ada nilai sebelumnya --}}
                                    @php
                                        $existingKhs = $mahasiswa->khs->first();
                                        $oldNilaiAkhir = old('nilai_akhir.' . $index, $existingKhs ? $existingKhs->nilai_akhir : '');
                                        $oldGrade = old('grade.' . $index, $existingKhs ? $existingKhs->grade : '');
                                    @endphp
                                    <input type="number" class="form-control form-control-sm @error('nilai_akhir.' . $index) is-invalid @enderror" 
                                           name="nilai_akhir[{{ $index }}]" value="{{ $oldNilaiAkhir }}" 
                                           min="0" max="100" step="0.01">
                                    @error('nilai_akhir.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="mahasiswa_id[{{ $index }}]" value="{{ $mahasiswa->id }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm @error('grade.' . $index) is-invalid @enderror" 
                                           name="grade[{{ $index }}]" value="{{ $oldGrade }}" 
                                           maxlength="2">
                                    @error('grade.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">Tidak ada mahasiswa yang mengambil mata kuliah ini di semester ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Nilai</button>
        <a href="{{ route('dosen.khs.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
    