@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Meus Relatórios</h2>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Voltar</a>

    @if ($reports->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Nome do Arquivo</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->title }}</td>
                        <td>{{ $report->original_filename ?? basename($report->file_path) }}</td>
                        <td>{{ ucfirst($report->status) }}</td>
                        <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if ($report->file_path)
                                <a href="{{ route('reports.download', $report->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                    Download
                                </a>
                            @else
                                <span class="text-muted">Arquivo indisponível</span>
                            @endif

                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirma exclusão do relatório?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $reports->links() }}
    @else
        <p>Você ainda não enviou nenhum relatório.</p>
    @endif
</div>
@endsection
