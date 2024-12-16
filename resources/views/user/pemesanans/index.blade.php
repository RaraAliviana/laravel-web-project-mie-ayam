@extends('layouts.user')

@section('title', 'Daftar Pemesanan')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Pemesanan Anda</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Pemesanan List -->
    @if($pemesanans->isEmpty())
        <div class="alert alert-info">Anda belum memiliki pemesanan.</div>
    @else
    <a href="{{ route('pemesanans.create') }}" class="btn btn-primary mb-3">Buat Pemesanan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanans as $pemesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($pemesanan->total_pembayaran, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($pemesanan->status) }}</td>
                    <td>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('user.pemesanans.destroy', $pemesanan->id_pemesanan) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Pagination if needed -->
    {{ $pemesanans->links() }}
</div>
@endsection
