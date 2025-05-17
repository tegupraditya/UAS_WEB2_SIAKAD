@extends('layouts.app')

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

<p>ini adalah khs</p>
@endsection