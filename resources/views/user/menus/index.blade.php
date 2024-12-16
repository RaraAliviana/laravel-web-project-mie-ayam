@extends('layouts.user')

@section('title', 'Menu List')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Menu</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menu List -->
    <div class="row">
        @foreach($menus as $menu)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Display Image if Available -->
                <div class="card-body">
                    <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                    <p class="card-text">{{ Str::limit($menu->deskripsi, 100) }}</p>
                    <p class="card-text"><strong>Rp {{ number_format($menu->harga, 0, ',', '.') }}</strong></p>
                    <a href="{{ route('user.pemesanans.create', ['menu_id' => $menu->id_menu]) }}" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $menus->links() }}
</div>
@endsection
