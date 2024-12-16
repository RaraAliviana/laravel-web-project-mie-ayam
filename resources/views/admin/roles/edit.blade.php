@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Role: {{ $role->name }}</h2>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="permissions">Permissions</label><br>
            @foreach ($permissions as $permission)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        @if($role->hasPermissionTo($permission)) checked @endif>
                    {{ $permission->name }}
                </label><br>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Role</button>
    </form>
</div>
@endsection
