@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Enviar Relatório</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reports.upload.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="report" class="form-label">Selecione o arquivo do relatório (PDF):</label>
            <input type="file" name="report" id="report" class="form-control" accept=".pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
