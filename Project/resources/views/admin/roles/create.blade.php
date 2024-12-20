@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create New Role</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>

        <div class="form-group mt-3">
            <label for="permissions">Permissions</label><br>
            @foreach ($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                    {{ $permission->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Role</button>
    </form>
</div>
@endsection
