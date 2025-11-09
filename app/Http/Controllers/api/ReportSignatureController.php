<?php

namespace App\Http\Controllers\api;

use App\Models\ReportSignature;
use Illuminate\Http\Request;

class ReportSignatureController extends Controller
{
    public function index()
    {
        $signatures = ReportSignature::all();
        return response()->json($signatures);
    }

    public function show($id)
    {
        return ReportSignature::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'report_id' => 'required|exists:reports,id',
            'signer_id' => 'required|exists:users,id',
            'signer_role' => 'required|in:technician,supervisor,admin',
            'signature_type' => 'nullable|in:digital_certificate,system_signature',
            'signature_hash' => 'required|string',
            'signed_at' => 'nullable|date',
            'icp_validated' => 'boolean',
            // outros campos conforme necessidade
        ]);

        return ReportSignature::create($data);
    }

    public function update(Request $request, $id)
    {
        $signature = ReportSignature::findOrFail($id);
        $data = $request->validate([
            'signature_hash' => 'sometimes|required|string',
            'icp_validated' => 'boolean',
        ]);
        $signature->update($data);
        return $signature;
    }

    public function destroy($id)
    {
        ReportSignature::destroy($id);
        return response()->noContent();
    }
}
