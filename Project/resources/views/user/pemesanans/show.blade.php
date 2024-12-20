@extends('layouts.user')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Detail Pemesanan</h1>

    <div class="card">
        <div class="card-header">
            <strong>ID Pemesanan:</strong> {{ $pemesanan->id_pemesanan }}
        </div>
        <div class="card-body">
            <p><strong>Tanggal Pemesanan:</strong> {{ $pemesanan->tanggal_pemesanan }}</p>
            <p><strong>Waktu Pemesanan:</strong> {{ $pemesanan->waktu_pemesanan }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $pemesanan->metode_pembayaran }}</p>
            <p><strong>Status:</strong> {{ ucfirst($pemesanan->status) }}</p>
            <p><strong>Pengantaran Pesanan:</strong> {{ $pemesanan->pengantaran_pesanan }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h3>Detail Menu</h3>
        @if($pemesanan->menus->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan->menus as $menu)
                            <tr>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ $menu->pivot->kuantitas }}</td>
                                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($menu->pivot->kuantitas * $menu->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Tidak ada menu dalam pemesanan ini.</p>
        @endif
    </div>

    <div class="mt-4">
        <h3>Detail Paket Hemat</h3>
        @if($pemesanan->paketHemats->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan->paketHemats as $paket)
                            <tr>
                                <td>{{ $paket->nama_paket }}</td>
                                <td>{{ $paket->pivot->kuantitas }}</td>
                                <td>Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($paket->pivot->kuantitas * $paket->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Tidak ada paket hemat dalam pemesanan ini.</p>
        @endif
    </div>

    <div class="mt-4">
        <a href="{{ route('user.pemesanans.index') }}" class="btn btn-secondary">Kembali ke Daftar Pemesanan</a>
    </div>
</div>
@endsection
