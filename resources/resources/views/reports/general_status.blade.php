<h1>Relatório de Licenças</h1>
<table border="1" cellspacing="0" cellpadding="5">
<tr><th>ID</th><th>Número</th><th>Órgão</th><th>Emissão</th><th>Validade</th><th>Status</th></tr>
@foreach($licenses as $l)
<tr>
<td>{{ $l->id }}</td>
<td>{{ $l->number }}</td>
<td>{{ $l->issuer }}</td>
<td>{{ optional($l->issued_at)->format('d/m/Y') }}</td>
<td>{{ optional($l->expires_at)->format('d/m/Y') }}</td>
<td>{{ $l->status }}</td>
</tr>
@endforeach
</table>