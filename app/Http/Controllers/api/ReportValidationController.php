<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ReportValidationRequest;
use App\Models\ReportValidation;
use Illuminate\Http\JsonResponse;

class ReportValidationController extends Controller
{
    public function store(ReportValidationRequest $request): JsonResponse
    {
        // Os dados já estão validados no $request automaticamente
        $validatedData = $request->validated();

        // Cria a validação do relatório no banco
        $reportValidation = ReportValidation::create($validatedData);

        // Retorna a resposta JSON com status 201 Created
        return response()->json($reportValidation, 201);
    }
}
