@extends('layouts.user')

@section('content')
<div class="dashboard">
    <h1>Dashboard User</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="user-actions">
        <div class="action-card">
            <h2>Menus</h2>
            <p>Lihat daftar menu yang tersedia.</p>
            <a href="{{ route('user.menus.index') }}" class="btn btn-primary">Lihat Menu</a>
        </div>
        <div class="action-card">
            <h2>Paket Hemat</h2>
            <p>Lihat paket hemat untuk hemat lebih banyak.</p>
            <a href="{{ route('user.pakethemats.index') }}" class="btn btn-primary">Lihat Paket Hemat</a>
        </div>
        <div class="action-card">
            <h2>Pemesanan</h2>
            <p>Kelola pesanan Anda.</p>
            <a href="{{ route('user.pemesanans.index') }}" class="btn btn-primary">Lihat Pemesanan</a>
        </div>
        <div class="action-card">
            <h2>Stores</h2>
            <p>Lihat daftar toko kami.</p>
            <a href="{{ route('user.store.profile') }}" class="btn btn-primary">Lihat Toko</a>
        </div>
    </div>
</div>
@endsection
