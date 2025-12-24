@extends('layouts.admin')

@section('title', 'Integrity Checker')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">🔒 Blockchain Integrity Checker</h2>

    {{-- STATUS GLOBAL --}}
    <div class="alert {{ $isChainValid ? 'alert-success' : 'alert-danger' }}">
        <h4 class="mb-0">
            {{ $isChainValid ? 'SEMUA BLOK VALID ✔️' : 'TERDETEKSI PERUBAHAN DATA ❌' }}
        </h4>
        <small>
            {{ $isChainValid ? 'Tidak ada modifikasi ilegal yang terdeteksi.' : 'Salah satu blok dalam chain telah dimodifikasi.' }}
        </small>
    </div>

    {{-- TABEL DETAIL BLOK --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Detail Blockchain Ledger</strong>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Timestamp</th>
                        <th>Payload</th>
                        <th>Previous Hash</th>
                        <th>Current Hash</th>
                        <th>Re-Hashed</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)
                        <tr class="{{ $item['valid'] ? 'table-success' : 'table-danger' }}">
                            <td>{{ $item['block']->id }}</td>
                            <td>{{ $item['block']->created_at }}</td>

                            {{-- PAYLOAD JSON --}}
                            <td style="max-width: 300px;">
                                <pre class="small mb-0">
{{ json_encode($item['block']->payload, JSON_PRETTY_PRINT) }}
                                </pre>
                            </td>

                            <td class="small">{{ $item['block']->previous_hash }}</td>
                            <td class="small">{{ $item['block']->hash }}</td>
                            <td class="small">{{ $item['rehashed'] }}</td>

                            <td>
                                @if ($item['valid'])
                                    <span class="badge bg-success">VALID</span>
                                @else
                                    <span class="badge bg-danger">TAMPERED</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
