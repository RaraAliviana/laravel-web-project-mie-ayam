@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Pemesanan</h1>

    <form action="{{ route('pemesanans.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" name="user_id" id="user_id" class="form-control" value="{{ auth()->user()->id }}" readonly>
        </div>

        <div class="form-group">
            <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
            <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="waktu_pemesanan">Waktu Pemesanan</label>
            <input type="time" name="waktu_pemesanan" id="waktu_pemesanan" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Pilih Menu</label>
            @foreach($menus as $menu)
                <div class="d-flex align-items-center mb-2">
                    <input type="checkbox" name="id_menu[]" value="{{ $menu->id_menu }}" data-harga="{{ $menu->harga }}">
                    {{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 2) }}
                    <input type="number" name="quantitas_menu[{{ $menu->id_menu }}]" value="1" class="form-control ml-2" style="width: 80px;">
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Pilih Paket Hemat</label>
            @foreach($paketHemats as $paket)
                <div class="d-flex align-items-center mb-2">
                    <input type="checkbox" name="id_paket[]" value="{{ $paket->id_paket }}" data-harga="{{ $paket->harga_paket }}">
                    {{ $paket->nama_paket }} - Rp{{ number_format($paket->harga_paket, 2) }}
                    <input type="number" name="quantitas_paket[{{ $paket->id_paket }}]" value="1" class="form-control ml-2" style="width: 80px;">
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="total_pembayaran">Total Pembayaran</label>
            <input type="number" name="total_pembayaran" id="total_pembayaran" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control">
                <option value="Dana">Dana</option>
                <option value="Shopeepay">Shopeepay</option>
                <option value="Gopay">Gopay</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="Tunai">Tunai</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pengantaran_pesanan">Pengantaran Pesanan</label>
            <select name="pengantaran_pesanan" id="pengantaran_pesanan" class="form-control">
                <option value="Antar Ke rumah">Antar Ke rumah</option>
                <option value="Ambil Di Tempat">Ambil Di Tempat</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Pemesanan</button>
    </form>
</div>

{{-- Tambahkan script ini setelah tag form di file create.blade.php --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calculateTotal = () => {
            let totalPembayaran = 0;

            // Menghitung total menu
            document.querySelectorAll('input[name="id_menu[]"]:checked').forEach((checkbox) => {
                const harga = checkbox.getAttribute('data-harga');
                const quantitas = document.querySelector(`input[name="quantitas_menu[${checkbox.value}]"]`).value;
                totalPembayaran += harga * quantitas;
            });

            // Menghitung total paket
            document.querySelectorAll('input[name="id_paket[]"]:checked').forEach((checkbox) => {
                const harga = checkbox.getAttribute('data-harga');
                const quantitas = document.querySelector(`input[name="quantitas_paket[${checkbox.value}]"]`).value;
                totalPembayaran += harga * quantitas;
            });

            document.getElementById('total_pembayaran').value = totalPembayaran;
        };

        document.querySelectorAll('input[name="quantitas_menu[]"], input[name="quantitas_paket[]"]').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        document.querySelectorAll('input[name="id_menu[]"], input[name="id_paket[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });
    });
</script>
@endsection