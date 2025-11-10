@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Voltar</a>

    <h2>Relatórios Validados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($reports->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Relatório</th>
                    <th>Data de Validação</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->name ?? 'Sem nome' }}</td>
                    <td>{{ $report->validated_at ? $report->validated_at->format('d/m/Y H:i') : 'Não validado' }}</td>
                    <td>{{ ucfirst($report->status) }}</td>
                    <td>
                        <form action="{{ route('reports.cancelValidation', $report->id) }}" method="POST" onsubmit="return confirm('Deseja realmente cancelar a validação deste relatório?');">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Cancelar Validação</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reports->links() }}
    @else
        <p>Não há relatórios validados para exibir.</p>
    @endif

</div>
@endsection
