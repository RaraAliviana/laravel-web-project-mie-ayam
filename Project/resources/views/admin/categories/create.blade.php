@extends('layouts.admin')

@section('content')
<h1>Create New Category</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group mt-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Create Category</button>
</form>
@endsection
