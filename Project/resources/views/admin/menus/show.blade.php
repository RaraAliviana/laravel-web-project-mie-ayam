@extends('layouts.admin')

@section('title', 'Menu Details')

@section('content')
<div class="container">
    <h1 class="my-4">Menu Details</h1>
    <div class="card">
        <div class="card-header">
            <h3>{{ $menu->nama_menu }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Price:</strong> Rp {{ number_format($menu->harga, 2, ',', '.') }}</p>
            <p><strong>Description:</strong> {{ $menu->deskripsi ?? 'No description available.' }}</p>
            <p><strong>Category:</strong> {{ $menu->category ? $menu->category->name : 'No category assigned' }}</p>
        </div>
    </div>
    <a href="{{ route('menus.index') }}" class="btn btn-secondary mt-3">Back to Menu List</a>
</div>
@endsection
