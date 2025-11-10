<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log; // Certifique-se que criou o model Log

class LogController extends Controller
{
    public function index()
    {
        // Busca logs paginados, ordenados pela data mais recente
        $logs = Log::orderBy('created_at', 'desc')->paginate(20);

        // Retorna a view passando a variável $logs
        return view('logs.index', compact('logs'));
    }
}
