@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Bem-vindo, {{ auth()->user()->name }}!</h2>

    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestão de Relatórios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @if(auth()->user()->hasRole('tecnico'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.upload') }}">Enviar Relatório</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.my') }}">Meus Relatórios</a>
                    </li>
                    @endif

                    @if(auth()->user()->hasRole('supervisor'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.validation') }}">Validar Relatórios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.validated') }}">Relatórios Validados</a>
                    </li>
                    @endif

                    @if(auth()->user()->hasRole('administrador'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Gestão de Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logs.index') }}">Logs de Auditoria</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <p>Selecione uma opção no menu acima para iniciar.</p>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
@endsection
