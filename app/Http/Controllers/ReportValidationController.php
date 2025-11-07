<?php

namespace App\Http\Controllers;

use App\Models\ReportValidation;
use Illuminate\Http\Request;

class ReportValidationController extends Controller
{
    public function index()
    {
        return ReportValidation::all();
    }

    public function show($id)
    {
        return ReportValidation::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'validator_id' => 'required|exists:users,id',
            'action' => 'required|in:submitted,validated,rejected,revision_requested',
            'status_from' => 'nullable|in:pending,validated,rejected,archived',
            'status_to' => 'required|in:pending,validated,rejected,archived',
            'notification_sent' => 'boolean',
            // demais campos opcionais
        ]);

        return ReportValidation::create($data);
    }

    public function update(Request $request, $id)
    {
        $validation = ReportValidation::findOrFail($id);
        $data = $request->validate([
            'notes' => 'nullable|string',
            'rejection_reason' => 'nullable|string',
            'required_changes' => 'nullable|json',
        ]);
        $validation->update($data);
        return $validation;
    }

    public function destroy($id)
    {
        ReportValidation::destroy($id);
        return response()->noContent();
    }
}
