{{-- resources/views/admin/menus/withTrashed.blade.php --}}

@extends('layouts.admin')

@section('title', 'All Menus (With Trashed)')

@section('content')
<div class="container">
    <h1 class="my-4">All Menus (With Trashed)</h1>

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

    <a href="{{ route('admin.menus.index') }}" class="btn btn-primary mb-3">Back to Menu List</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->id_menu }}</td>
                    <td>{{ $menu->nama_menu }}</td>
                    <td>{{ $menu->category->name ?? 'No category' }}</td>
                    <td>Rp {{ number_format($menu->harga, 2, ',', '.') }}</td>
                    <td>{{ $menu->deskripsi ?? 'No description' }}</td>
                    <td>
                        @if($menu->trashed())
                            <span class="badge badge-warning">Deleted</span>
                        @else
                            <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td>
                        @if($menu->trashed())
                            {{-- Restore Button --}}
                            <form action="{{ route('admin.menus.restore', $menu->id_menu) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            {{-- Force Delete Button --}}
                            <form action="{{ route('admin.menus.forceDelete', $menu->id_menu) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this permanently?')">Force Delete</button>
                            </form>
                        @else
                            {{-- Soft Delete Button --}}
                            <form action="{{ route('admin.menus.softDelete', $menu->id_menu) }}" method="POST" style="display:inline-block;">
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
