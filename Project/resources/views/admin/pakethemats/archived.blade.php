@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Archived Paket Hemats</h1>

    {{-- Success or Error Message --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('admin.pakethemats.index') }}" class="btn btn-primary mb-3">Back to Paket Hemat List</a>

    {{-- Paket Hemats Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Paket</th>
                <th>Deskripsi Paket</th>
                <th>Harga Paket</th>
                <th>Menu</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paketHemats as $paketHemat)
                <tr>
                    <td>{{ $paketHemat->id_paket }}</td>
                    <td>{{ $paketHemat->nama_paket }}</td>
                    <td>{{ $paketHemat->deskripsi_paket }}</td>
                    <td>Rp {{ number_format($paketHemat->harga_paket, 2, ',', '.') }}</td>
                    <td>
                        @foreach ($paketHemat->menus as $menu)
                            <span class="badge bg-primary">{{ $menu->nama_menu }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        {{-- Restore Button --}}
                        <form action="{{ route('admin.pakethemats.restore', $paketHemat->id_paket) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                        </form>
                        
                        {{-- Force Delete Button --}}
                        <form action="{{ route('admin.pakethemats.forceDelete', $paketHemat->id_paket) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this permanently?')">Force Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No archived Paket Hemats available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
