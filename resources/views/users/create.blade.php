@extends('layouts.app')

@section('content')
<h1>Criar Usuário</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Confirmar Senha</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-select" required>
            <option value="">Selecione a Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}">
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
    </div>

    <div class="mb-3">
        <label>Ativo</label>
        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Sim</option>
            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Não</option>
        </select>
    </div>

    <!-- Adicione outros campos conforme necessário -->

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
@endsection
