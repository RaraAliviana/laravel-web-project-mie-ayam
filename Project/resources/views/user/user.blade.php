<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'User Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body>

    <!-- Header -->
    <header class="bg-primary text-white">
        <div class="container py-3">
            <div class="row">
                <div class="col-6">
                    <h2>User Dashboard</h2>
                </div>

                <div class="col-6 text-end">
                    <!-- User Info & Logout -->
                    <div class="d-flex align-items-center justify-content-end">

                        <!-- 🔥 Nama User Bisa Diklik Menuju Profile -->
                        <a href="{{ route('user.profile') }}" class="me-3 text-white fw-bold" style="text-decoration: none;">
                            {{ auth()->user()->name }}
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">Dashboard</a>

            <button class="navbar-toggler" type="button" 
                    data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" 
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.pemesanans.index') }}">
                            <i class="fas fa-list"></i> Daftar Pemesanan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.menus.index') }}">
                            <i class="fas fa-utensils"></i> Menu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.pakethemats.index') }}">
                            <i class="fas fa-box"></i> Paket Hemat
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.store.profile') }}">
                            <i class="fas fa-store"></i> Store
                        </a>
                    </li>

                    <!-- 🔥 Tambahan: Link Profile di Navbar juga -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.profile') }}">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <main class="col-12 px-4 py-5">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Mie Ayam Gapuro. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>