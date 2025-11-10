<!-- resources/views/logs/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Logs do Sistema</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($logs->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensagem</th>
                    <th>Data e Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->message }}</td>
                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $logs->links() }}
    @else
        <p>Nenhum log encontrado.</p>
    @endif
</div>
@endsection
