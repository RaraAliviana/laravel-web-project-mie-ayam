@extends('layouts.admin')

@section('title', 'All Paket Hemats (With Trashed)')

@section('content')
<div class="container">
    <h1 class="my-4">All Paket Hemats (With Trashed)</h1>

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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Paket</th>
                <th>Deskripsi Paket</th>
                <th>Harga Paket</th>
                <th>Menu</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paketHemats as $paketHemat)
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
                        @if($paketHemat->trashed())
                            <span class="badge badge-warning">Deleted</span>
                        @else
                            <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td>
                        @if($paketHemat->trashed())
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
                        @else
                            {{-- Soft Delete Button --}}
                            <form action="{{ route('admin.pakethemats.softDelete', $paketHemat->id_paket) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure to soft delete this?')">Soft Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
