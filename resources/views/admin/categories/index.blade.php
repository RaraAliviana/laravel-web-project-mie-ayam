@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="my-4">Categories</h1>

    {{-- Action Buttons --}}
    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
    </div>

    {{-- Categories Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td> 
                        <td>
                            {{-- Edit Button --}}
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>

                            {{-- Delete Button --}}
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
