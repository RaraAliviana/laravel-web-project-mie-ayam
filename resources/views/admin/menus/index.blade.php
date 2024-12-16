@extends('layouts.admin')

@section('title', 'Menu List')

@section('content')
<div class="container">
    <h1 class="my-4">Menu List</h1>

    {{-- Success or Error Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Action Buttons --}}
    <div class="mb-3">
        <a href="{{ route('menus.create') }}" class="btn btn-primary">Create New Menu</a>
        <a href="{{ route('admin.menus.withtrashed') }}" class="btn btn-secondary">With Trashed</a>
        <a href="{{ route('admin.menus.onlyTrashed') }}" class="btn btn-info">Archived Menus</a>
    </div>

    {{-- Menus Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
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
                        {{-- Action Buttons --}}
                        <a href="{{ route('menus.show', $menu->id_menu) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('menus.edit', $menu->id_menu) }}" class="btn btn-warning btn-sm">Edit</a>

                        {{-- Soft Delete Form --}}
                        <form action="{{ route('admin.menus.softDelete', $menu->id_menu) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to soft delete this menu?')">Soft Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
