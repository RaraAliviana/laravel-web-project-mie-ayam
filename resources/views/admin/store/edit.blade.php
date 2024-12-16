@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Store Profile</h2>

        <!-- Form -->
        <form action="{{ route('store.update', ['store' => $store->id]) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <!-- Store Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-600">Store Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $store->name) }}" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-gray-600">Address</label>
                <textarea name="address" id="address" rows="4" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">{{ old('address', $store->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-600">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $store->phone) }}" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-600">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $store->email) }}" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection
