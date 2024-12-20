@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Store Profile</h2>

        <!-- Tombol untuk menambahkan store baru -->
        <div class="mb-4">
            <a href="{{ route('admin.store.create') }}" class="btn btn-primary">
                Add New Store
            </a>
        </div>

        @if ($store)
            <p><strong>Name:</strong> {{ $store->name }}</p>
            <p><strong>Address:</strong> {{ $store->address }}</p>
            <p><strong>Phone:</strong> {{ $store->phone }}</p>
            <p><strong>Email:</strong> {{ $store->email }}</p>
        @else
            <p class="text-red-500">Store profile not available.</p>
        @endif

        <!-- Tombol untuk mengedit store -->
        @if ($store)
            <a href="{{ route('admin.store.edit', $store->id) }}" class="btn btn-warning btn-sm mt-4">
                Edit
            </a>
        @endif
    </div>
</div>
@endsection