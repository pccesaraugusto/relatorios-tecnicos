<?php

namespace App\Http\Controllers\api;

use App\Models\AuditLog;
use Illuminate\Http\JsonResponse;

class AuditLogController extends Controller
{
    public function index(): JsonResponse
    {
        $logs = AuditLog::all();
        return response()->json($logs);
    }
}