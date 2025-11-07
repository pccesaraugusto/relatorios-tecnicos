<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        return AuditLog::all();
    }

    public function show($id)
    {
        return AuditLog::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'event_type' => 'required|string',
            'auditable_type' => 'nullable|string',
            'auditable_id' => 'nullable|integer',
            'action' => 'required|string',
            'description' => 'nullable|string',
            'ip_address' => 'nullable|ip',
            'severity' => 'nullable|in:low,medium,high,critical',
            // demais campos
        ]);

        return AuditLog::create($data);
    }

    public function update(Request $request, $id)
    {
        $log = AuditLog::findOrFail($id);
        $data = $request->validate([
            'description' => 'nullable|string',
            'severity' => 'nullable|in:low,medium,high,critical',
        ]);

        $log->update($data);
        return $log;
    }

    public function destroy($id)
    {
        AuditLog::destroy($id);
        return response()->noContent();
    }
}
