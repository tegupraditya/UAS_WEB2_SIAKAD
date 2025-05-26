<!DOCTYPE html>
<html>
<head>
    <title>KHS Mahasiswa: {{ $mahasiswa['nama'] }}</title>
    <style>
        body { font-family: sans-serif; font-size: 10pt; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .info { margin-bottom: 20px; }
        .info p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU HASIL STUDI (KHS)</h1>
        <h2>UNIVERSITAS TADULAKO</h2>
    </div>

    <div class="info">
        <p><strong>NIM:</strong> {{ $mahasiswa['nim'] }}</p>
        <p><strong>Nama:</strong> {{ $mahasiswa['nama'] }}</p>
        <p><strong>Jurusan:</strong> {{ $mahasiswa['jurusan'] }}</p>
        <p><strong>Program Studi:</strong> {{ $mahasiswa['program'] }}</p>
    </div>

    <table>
        <thead>
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
                    <td colspan="8" style="text-align: center;">Tidak ada data KHS.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 30px;">Palu, {{ date('d F Y') }}</p>
    <p style="text-align: right; margin-top: 50px;">(Tanda Tangan Dosen Wali)</p>
</body>
</html>
