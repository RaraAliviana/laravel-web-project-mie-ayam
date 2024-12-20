@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $paketHemat->nama_paket }}</h1>

    <p><strong>Deskripsi:</strong> {{ $paketHemat->deskripsi_paket }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($paketHemat->harga_paket, 2) }}</p>
    <p><strong>Menu:</strong></p>
    @if ($paketHemat->menus->isNotEmpty())
        <ul>
            @foreach ($paketHemat->menus as $menu)
                <li>{{ $menu->nama_menu }}</li>
            @endforeach
        </ul>
    @else
        <p>No Menu</p>
    @endif

    <a href="{{ route('pakethemats.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('pakethemats.edit', $paketHemat->id_paket) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('pakethemats.destroy', $paketHemat->id_paket) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
