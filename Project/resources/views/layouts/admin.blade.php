<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles (Optional) -->
    <style>
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #000;
            margin-bottom: 5px;
        }
        .sidebar a:hover {
            background-color: #e2e6ea;
        }
        .dashboard {
            padding: 20px;
        }
        .logout-form {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <h3 class="text-center">Admin</h3>
                <div class="list-group">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item">Dashboard</a>
                    <a href="{{ route('admin.menus.index') }}" class="list-group-item">Menus</a>
                    <a href="{{ route('admin.pakethemats.index') }}" class="list-group-item">Paket Hemat</a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item">Categories</a>
                    <a href="{{ route('admin.pemesanans.index') }}" class="list-group-item">Pemesanan</a>
                    <a href="{{ route('admin.roles.index') }}" class="list-group-item">Roles User</a>
                    <a href="{{ route('admin.store.profile') }}" class="list-group-item">Store Profile</a>
                    <a href="{{ route('admin.integrity.index') }}" class="list-group-item">integrity check</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="logout-form">
                    <span class="me-3">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
