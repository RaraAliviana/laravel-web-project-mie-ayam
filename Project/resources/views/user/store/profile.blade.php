@extends('layouts.user')

@section('content')
<div class="container">
    <h1>Store Profile</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $store->name }}</h5>
            <p><strong>Address:</strong> {{ $store->address }}</p>
            <p><strong>Phone:</strong> {{ $store->phone }}</p>
            <p><strong>Email:</strong> {{ $store->email }}</p>
        </div>
    </div>
</div>
@endsection
