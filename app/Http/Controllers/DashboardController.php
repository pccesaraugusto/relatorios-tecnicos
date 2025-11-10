<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Aplica middleware auth para proteger a rota
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Método que retorna a view do dashboard
    public function index()
    {
        return view('dashboard');
    }
}
