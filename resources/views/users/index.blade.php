@extends('layouts.app')

@section('content')
<h1>Usuários</h1>

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Novo Usuário</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Role</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ativo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role ? $user->role->name : 'Sem role' }}</td>
            <td>{{ $user->cpf }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->is_active ? 'Sim' : 'Não' }}</td>
            <td>
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Confirma exclusão?')" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Paginação -->
<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
