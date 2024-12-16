@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <!-- Heading Section -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 text-primary">Dashboard Admin</h1>
            <p class="lead">Selamat datang, <strong>{{ Auth::check() ? Auth::user()->name : 'Guest' }}</strong>!</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row">
        <!-- Card 1: User Overview -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title text-success">Total Users</h3>
                    <p class="card-text"><strong>{{ \App\Models\User::count() }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Card 2: Pemesanan Overview -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title text-info">Total Pemesanan</h3>
                    <p class="card-text"><strong>{{ \App\Models\Pemesanan::count() }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Card 3: Paket Hemat Overview -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title text-warning">Paket Hemat</h3>
                    <p class="card-text"><strong>{{ \App\Models\PaketHemat::count() }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Card 4: Menu Orders Overview -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title text-primary">Total Menu</h3>
                    <p class="card-text"><strong>{{ \App\Models\Menu::count() }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Card 5: Category Overview -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title text-secondary">Total Pemesanan</h3>
                    <p class="card-text"><strong>{{ \App\Models\Category::count() }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
