@extends('layouts.user')

@section('title', 'Daftar Paket Hemat')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Paket Hemat</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Paket Hemat List -->
    <div class="row">
        @foreach($paketHemats as $paketHemat)
        <div class="col-md-4 mb-4">
            <div class="card">
                <!-- Display Image if available -->
                <img src="{{ asset('storage/' . $paketHemat->image) }}" class="card-img-top" alt="{{ $paketHemat->nama_paket }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $paketHemat->nama_paket }}</h5>
                    <p class="card-text">{{ Str::limit($paketHemat->deskripsi_paket, 100) }}</p>
                    <p class="card-text"><strong>Rp {{ number_format($paketHemat->harga_paket, 0, ',', '.') }}</strong></p>
                    <!-- Link to Order Form -->
                    <a href="{{ route('user.pemesanans.create', ['paket_id' => $paketHemat->id_paket]) }}" class="btn btn-primary">Pesan Sekarang</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination if needed -->
    {{ $paketHemats->links() }}
</div>
@endsection
