<?php

namespace App\Http\Controllers\api;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return Report::all();
    }

    public function show($id)
    {
        return Report::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'uuid' => 'required|unique:reports,uuid',
            'technician_id' => 'required|exists:users,id',
            'supervisor_id' => 'nullable|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'report_type' => 'nullable|string',
            'client_name' => 'nullable|string',
            'client_document' => 'nullable|string',
            'service_order' => 'nullable|string',
            'original_filename' => 'required|string',
            'original_file_path' => 'required|string',
            'original_file_size' => 'required|integer',
            'original_file_hash' => 'required|string',
            'original_mime_type' => 'nullable|string',
            'qr_code' => 'required|unique:reports,qr_code',
            'status' => 'nullable|in:pending,validated,rejected,archived',
            'is_public' => 'boolean',
            // acrescentar outras validações conforme os campos
        ]);

        return Report::create($data);
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'status' => 'nullable|in:pending,validated,rejected,archived',
            'is_public' => 'boolean',
            // ajustar conforme campos editáveis
        ]);

        $report->update($data);
        return $report;
    }

    public function destroy($id)
    {
        Report::destroy($id);
        return response()->noContent();
    }
}

