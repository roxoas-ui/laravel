@extends('layouts.app')

@section('content')
<h1>Licenças</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Número</th>
            <th>Órgão</th>
            <th>Emissão</th>
            <th>Validade</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($licenses ?? [] as $license)
        <tr>
            <td>{{ $license->number }}</td>
            <td>{{ $license->issuer }}</td>
            <td>{{ optional($license->issued_at)->format('d/m/Y') }}</td>
            <td>{{ optional($license->expires_at)->format('d/m/Y') }}</td>
            <td>{{ $license->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection