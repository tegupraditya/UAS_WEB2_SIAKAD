<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIAKAD - KRS')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #e91e63;
            color: white;
        }
        .navbar-custom a {
            color: white;
        }
        .card-header-custom {
            background-color: #e91e63;
            color: white;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom px-4">
    <div class="container-fluid">
        <span class="navbar-brand">SIAKAD</span>
        <div class="ms-auto dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="path/to/user-image.jpg" alt="User Image" width="32" height="32" class="rounded-circle">
                <strong class="ms-2">SYAHRIL FITRAWAN ABADI</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="profile">Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>


    {{-- Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center mt-5 mb-3 text-muted small">
        Copyright © {{ date('Y') }} UPA TIK. Universitas Tadulako. | Version - 3.0.0
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
