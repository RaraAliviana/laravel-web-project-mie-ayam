@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Profil Saya</h4>
                </div>

                <div class="card-body">

                    {{-- Nama User --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>

                    {{-- Email User --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="text" class="form-control" value="{{ $decryptedEmail }}" disabled>
                    </div>

                    {{-- Role (jika kamu punya role di table users) --}}
                    @if(auth()->user()->role ?? false)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->role }}" disabled>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between mt-4">
                        {{-- Back ke Dashboard --}}
                        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        {{-- Tombol Edit Profil --}}
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-user-edit"></i> Edit Profil
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection