@extends('layouts.admin')

@section('title', 'Edit Pemesanan')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Pemesanan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemesanans.update', $pemesanan->id_pemesanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h5>Detail Pemesanan ID: {{ $pemesanan->id_pemesanan }}</h5>
            </div>
            <div class="card-body">
                <!-- User Information -->
                <div class="form-group">
                    <label for="user_id">User</label>
                    <p>{{ $pemesanan->user->name }}</p>
                </div>

                <!-- Tanggal Pemesanan (Read-only) -->
                <div class="form-group">
                    <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                    <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" value="{{ $pemesanan->tanggal_pemesanan }}" disabled>
                </div>

                <!-- Waktu Pemesanan (Read-only) -->
                <div class="form-group">
                    <label for="waktu_pemesanan">Waktu Pemesanan</label>
                    <input type="time" name="waktu_pemesanan" id="waktu_pemesanan" class="form-control" value="{{ $pemesanan->waktu_pemesanan }}" disabled>
                </div>

                <!-- Metode Pembayaran (Read-only) -->
                <div class="form-group">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" id="metode_pembayaran" class="form-control" value="{{ $pemesanan->metode_pembayaran }}" disabled>
                </div>

                <!-- Status Pemesanan (Editable) -->
                <div class="form-group">
                    <label for="status">Status Pemesanan</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $pemesanan->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $pemesanan->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Total Pembayaran (Read-only) -->
                <div class="form-group">
                    <label for="total_pembayaran">Total Pembayaran</label>
                    <input type="number" name="total_pembayaran" id="total_pembayaran" class="form-control" value="{{ $pemesanan->total_pembayaran }}" disabled>
                </div>

                <!-- Pengantaran Pesanan (Read-only) -->
                <div class="form-group">
                    <label for="pengantaran_pesanan">Pengantaran Pesanan</label>
                    <select name="pengantaran_pesanan" id="pengantaran_pesanan" class="form-control" disabled>
                        <option value="Antar Ke rumah" {{ $pemesanan->pengantaran_pesanan == 'Antar Ke rumah' ? 'selected' : '' }}>Antar Ke rumah</option>
                        <option value="Ambil Di Tempat" {{ $pemesanan->pengantaran_pesanan == 'Ambil Di Tempat' ? 'selected' : '' }}>Ambil Di Tempat</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan dan Batal -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.pemesanans.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
