@extends('layouts.admin')

@section('content')
<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="id">Category ID</label>
        <input type="text" id="id" class="form-control" value="{{ $category->id }}" readonly>
    </div>

    <div class="form-group mt-3">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
    </div>

    <div class="form-group mt-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3">{{ $category->description }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update Category</button>
</form>
@endsection
