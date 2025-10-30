@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Manajemen Role Pengguna</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role Saat Ini</th>
                <th>Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->roles->isNotEmpty())
                            <span class="badge bg-success">{{ $user->roles->pluck('name')->implode(', ') }}</span>
                        @else
                            <span class="badge bg-secondary">Tidak Ada Role</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.roles.updateUserRole', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex">
                                <select name="role" class="form-select form-select-sm me-2">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
