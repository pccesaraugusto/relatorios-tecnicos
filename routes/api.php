<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportSignatureController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::get('/audit-logs', [AuditLogController::class, 'index']);
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/report-signatures', [ReportSignatureController::class, 'index']);


/*Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});*/

// Alternativamente, se você quiser criar rotas CRUD automáticas, pode usar
// Route::resource('users', UserController::class);

