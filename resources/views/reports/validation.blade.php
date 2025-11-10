@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Voltar</a>

    <h2>Validação de Relatórios Pendentes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reports->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Arquivo</th>
                    <th>Enviado por</th>
                    <th>Data de Envio</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ basename($report->file_path) }}</td>
                    <td>{{ $report->user->name ?? 'Desconhecido' }}</td>
                    <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('reports.validate', $report->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Validar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reports->links() }}
    @else
        <p>Não há relatórios pendentes para validação.</p>
    @endif
</div>
@endsection
