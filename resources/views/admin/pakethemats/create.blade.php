
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create New Paket Hemat</h1>

    <form action="{{ route('pakethemats.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" id="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required>
            @error('nama_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi_paket">Deskripsi Paket</label>
            <textarea name="deskripsi_paket" id="deskripsi_paket" class="form-control" rows="4" required>{{ old('deskripsi_paket') }}</textarea>
            @error('deskripsi_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="harga_paket">Harga Paket</label>
            <input type="number" name="harga_paket" id="harga_paket" class="form-control" value="{{ old('harga_paket') }}" required min="0" step="0.01">
            @error('harga_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_menu">Menu</label><br>
            @foreach (\App\Models\Menu::all() as $menu)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="id_menu[]" value="{{ $menu->id_menu }}" id="menu_{{ $menu->id_menu }}" {{ in_array($menu->id_menu, old('id_menu', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="menu_{{ $menu->id_menu }}">
                        {{ $menu->nama_menu }}
                    </label>
                </div>
            @endforeach
            @error('id_menu')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
