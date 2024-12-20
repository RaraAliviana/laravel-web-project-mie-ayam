{{-- resources/views/pemesanan/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Pemesanan</h1>

    <a href="{{ route('pemesanans.create') }}" class="btn btn-primary mb-3">Buat Pemesanan</a>
    @if($pemesanans->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Waktu Pemesanan</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Pengantaran Pesanan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $pemesanan->id_pemesanan }}</td>
                        <td>{{ $pemesanan->user_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pemesanan->waktu_pemesanan)->format('H:i') }}</td>
                        <td>{{ $pemesanan->total_pembayaran }}</td>
                        <td>{{ $pemesanan->metode_pembayaran }}</td>
                        <td>{{ $pemesanan->pengantaran_pesanan }}</td>
                        <td>{{ $pemesanan->status }}</td>
                        <td>
                            <a href="{{ route('pemesanans.show', $pemesanan->id_pemesanan) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('pemesanans.edit', $pemesanan->id_pemesanan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pemesanans.destroy', $pemesanan->id_pemesanan) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada pemesanan.</p>
    @endif
</div>
@endsection