@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create New Store</h2>

    <form action="{{ route('admin.store.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Store Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Store Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Store</button>
    </form>
</div>
@endsection