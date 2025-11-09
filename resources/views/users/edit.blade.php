@extends('layouts.app')

@section('content')
<h1>Editar Usuário</h1>

<form action="{{ route('users.update', $user) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label>Senha (deixe em branco para não alterar)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-select" required>
            <option value="">Selecione a Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $user->cpf) }}">
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
    </div>

    <div class="mb-3">
        <label>Ativo</label>
        <select name="is_active" class="form-select">
            <option value="1" @selected(old('is_active', $user->is_active) == '1')>Sim</option>
            <option value="0" @selected(old('is_active', $user->is_active) == '0')>Não</option>
        </select>
    </div>

    <!-- Outros campos -->

    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
@endsection
