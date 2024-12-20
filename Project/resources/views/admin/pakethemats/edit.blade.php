@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Paket Hemat</h1>

    <form action="{{ route('pakethemats.update', $paketHemat->id_paket) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" id="nama_paket" class="form-control" value="{{ old('nama_paket', $paketHemat->nama_paket) }}" required>
            @error('nama_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi_paket">Deskripsi Paket</label>
            <textarea name="deskripsi_paket" id="deskripsi_paket" class="form-control" rows="4" required>{{ old('deskripsi_paket', $paketHemat->deskripsi_paket) }}</textarea>
            @error('deskripsi_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="harga_paket">Harga Paket</label>
            <input type="number" name="harga_paket" id="harga_paket" class="form-control" value="{{ old('harga_paket', $paketHemat->harga_paket) }}" required min="0" step="0.01">
            @error('harga_paket')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_menu">Menu</label>
            <select name="id_menu" id="id_menu" class="form-control">
                <option value="">Select Menu</option>
                @foreach (\App\Models\Menu::all() as $menu)
                    <option value="{{ $menu->id_menu }}" {{ old('id_menu', $paketHemat->id_menu) == $menu->id_menu ? 'selected' : '' }}>{{ $menu->nama_menu }}</option>
                @endforeach
            </select>
            @error('id_menu')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
