<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuditLogController;
use App\Http\Controllers\api\ReportController;
use App\Http\Controllers\api\ReportSignatureController;
use App\Http\Controllers\api\ReportValidationController;
use App\Http\Controllers\api\RoleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', UserController::class);
Route::get('/audit-logs', [AuditLogController::class, 'index']);
Route::get('/reports', [ReportController::class, 'index']);
Route::get('/report-signatures', [ReportSignatureController::class, 'index']);
Route::post('/report-validations', [ReportValidationController::class, 'store']);
Route::apiResource('roles', RoleController::class);




