@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Paket Hemat List</h1>

    {{-- Success message if available --}}
    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Action Buttons --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('pakethemats.create') }}" class="btn btn-primary">Create New Paket Hemat</a>
            <a href="{{ route('admin.pakethemats.withtrashed') }}" class="btn btn-secondary">With Trashed</a>
            <a href="{{ route('admin.pakethemats.onlyTrashed') }}" class="btn btn-info">Archived Paket Hemats</a>
        </div>
    </div>

    {{-- Paket Hemat Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
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
                            {{-- Action Buttons --}}
                            <a href="{{ route('pakethemats.show', $paketHemat->id_paket) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('pakethemats.edit', $paketHemat->id_paket) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.pakethemats.softDelete', $paketHemat->id_paket) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure to soft delete this?')">Soft Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Paket Hemat available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
