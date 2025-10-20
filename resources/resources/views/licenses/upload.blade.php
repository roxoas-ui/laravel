@extends('layouts.app')

@section('content')
<h1>Upload de Documentos</h1>
<form action="/attachments" class="dropzone" id="documents-dropzone" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="attachable_type" value="License" />
    <input type="hidden" name="attachable_id" value="1" />
</form>

<div class="mt-3">
    <a href="/licenses" class="btn btn-secondary">Voltar</a>
</div>
@endsection