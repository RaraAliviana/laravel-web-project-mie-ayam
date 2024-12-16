@extends('layouts.user')

@section('title', 'Buat Pemesanan')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Buat Pemesanan Baru</h1>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.pemesanans.store') }}" method="POST">
        @csrf

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <!-- Tanggal Pemesanan -->
        <div class="form-group mb-3">
            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
            <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" required>
        </div>

        <!-- Waktu Pemesanan -->
        <div class="form-group mb-3">
            <label for="waktu_pemesanan" class="form-label">Waktu Pemesanan</label>
            <input type="time" name="waktu_pemesanan" id="waktu_pemesanan" class="form-control" required>
        </div>

        <!-- Pilih Menu -->
        <div class="form-group mb-3">
            <label for="menu" class="form-label">Pilih Menu</label>
            @foreach($menus as $menu)
                <div class="d-flex align-items-center mb-2">
                    <input type="checkbox" name="id_menu[]" value="{{ $menu->id_menu }}" data-harga="{{ $menu->harga }}" class="form-check-input me-2">
                    <span>{{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 2) }}</span>
                    <input type="number" name="quantitas_menu[{{ $menu->id_menu }}]" value="1" class="form-control ms-3" style="width: 80px;">
                </div>
            @endforeach
        </div>

        <!-- Pilih Paket Hemat -->
        <div class="form-group mb-3">
            <label for="paket" class="form-label">Pilih Paket Hemat</label>
            @foreach($paketHemats as $paket)
                <div class="d-flex align-items-center mb-2">
                    <input type="checkbox" name="id_paket[]" value="{{ $paket->id_paket }}" data-harga="{{ $paket->harga_paket }}" class="form-check-input me-2">
                    <span>{{ $paket->nama_paket }} - Rp{{ number_format($paket->harga_paket, 2) }}</span>
                    <input type="number" name="quantitas_paket[{{ $paket->id_paket }}]" value="1" class="form-control ms-3" style="width: 80px;">
                </div>
            @endforeach
        </div>

        <!-- Total Pembayaran -->
        <div class="form-group mb-3">
            <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
            <input type="number" name="total_pembayaran" id="total_pembayaran" class="form-control" readonly>
        </div>

        <!-- Metode Pembayaran -->
        <div class="form-group mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                <option value="Dana">Dana</option>
                <option value="Shopeepay">Shopeepay</option>
                <option value="Gopay">Gopay</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="Tunai">Tunai</option>
            </select>
        </div>

        <!-- Pengantaran Pesanan -->
        <div class="form-group mb-3">
            <label for="pengantaran_pesanan" class="form-label">Pengantaran Pesanan</label>
            <select name="pengantaran_pesanan" id="pengantaran_pesanan" class="form-control">
                <option value="Antar Ke Rumah">Antar Ke Rumah</option>
                <option value="Ambil Di Tempat">Ambil Di Tempat</option>
            </select>
        </div>

        <div class="form-group" style="display: none;">
    <label for="status">Status</label>
    <input type="text" name="status" id="status" value="pending" class="form-control">
</div>

        <button type="submit" class="btn btn-primary">Simpan Pemesanan</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calculateTotal = () => {
            let totalPembayaran = 0;

            // Menghitung total menu
            document.querySelectorAll('input[name="id_menu[]"]:checked').forEach((checkbox) => {
                const harga = parseFloat(checkbox.getAttribute('data-harga'));
                const quantitas = parseInt(document.querySelector(`input[name="quantitas_menu[${checkbox.value}]"]`).value);
                totalPembayaran += harga * quantitas;
            });

            // Menghitung total paket
            document.querySelectorAll('input[name="id_paket[]"]:checked').forEach((checkbox) => {
                const harga = parseFloat(checkbox.getAttribute('data-harga'));
                const quantitas = parseInt(document.querySelector(`input[name="quantitas_paket[${checkbox.value}]"]`).value);
                totalPembayaran += harga * quantitas;
            });

            document.getElementById('total_pembayaran').value = totalPembayaran;
        };

        // Event listeners untuk checkbox dan input jumlah
        document.querySelectorAll('input[name="quantitas_menu[]"], input[name="quantitas_paket[]"]').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        document.querySelectorAll('input[name="id_menu[]"], input[name="id_paket[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });
    });
</script>
@endsection
