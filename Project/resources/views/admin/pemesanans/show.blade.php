@extends('layouts.admin')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container">
    <h1 class="my-4">Detail Pemesanan</h1>

    <!-- Display Pemesanan Details -->
    <div class="card">
        <div class="card-header">
            <h5>Pemesanan ID: {{ $pemesanan->id_pemesanan }}</h5>
        </div>
        <div class="card-body">
            <!-- Check if user is not null before displaying name -->
            <h5 class="card-title">User: {{ optional($pemesanan->user)->name }}</h5>
            <p><strong>Tanggal Pemesanan:</strong> {{ $pemesanan->tanggal_pemesanan }}</p>
            <p><strong>Waktu Pemesanan:</strong> {{ $pemesanan->waktu_pemesanan }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $pemesanan->metode_pembayaran }}</p>
            <p><strong>Status Pemesanan:</strong> {{ ucfirst($pemesanan->status) }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</p>
        </div>
    </div>

    <h3 class="my-4">Detail Menu Pemesanan</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Kuantitas</th>
                <th>Harga per Item</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @if($pemesanan->menus && $pemesanan->menus->isNotEmpty())
                @foreach ($pemesanan->menus as $menu)
                    <tr>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>{{ $menu->pivot->kuantitas }}</td>
                        <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($menu->harga * $menu->pivot->kuantitas, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Tidak ada menu terkait</td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3 class="my-4">Detail Paket Hemat Pemesanan</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Paket Hemat</th>
                <th>Kuantitas</th>
                <th>Harga per Item</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @if($pemesanan->paketHemats && $pemesanan->paketHemats->isNotEmpty())
                @foreach ($pemesanan->paketHemats as $paket)
                    <tr>
                        <td>{{ $paket->nama_paket }}</td>
                        <td>{{ $paket->pivot->kuantitas }}</td>
                        <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($paket->harga * $paket->pivot->kuantitas, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Tidak ada paket hemat terkait</td>
                </tr>
            @endif
        </tbody>
    </table>

    <a href="{{ route('admin.pemesanans.index') }}" class="btn btn-primary">Back to Pemesanan List</a>
</div>
@endsection