<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LogController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas de relatórios
    Route::get('/reports/upload', [ReportController::class, 'uploadForm'])->name('reports.upload');
    Route::post('/reports/upload', [ReportController::class, 'upload'])->name('reports.upload.post');
    Route::get('/reports/my', [ReportController::class, 'myReports'])->name('reports.my');
    Route::get('/reports/validated', [ReportController::class, 'validatedList'])->name('reports.validated');
    Route::get('/reports/validation', [ReportController::class, 'validationList'])->name('reports.validation');
    Route::post('/reports/validation/{id}/validate', [ReportController::class, 'validateReport'])->name('reports.validate');
    Route::middleware('auth')->get('/reports/{id}/download', [ReportController::class, 'download'])->name('reports.download');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');
    Route::get('reports/validation/{id}/validate', [ReportController::class, 'validateReport'])->name('reports.validate');
    Route::post('reports/validated/{id}/cancel', [ReportController::class, 'cancelValidation'])->name('reports.cancelValidation');


    // Rotas para logs
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});

// Rotas de autenticação fora do grupo auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
