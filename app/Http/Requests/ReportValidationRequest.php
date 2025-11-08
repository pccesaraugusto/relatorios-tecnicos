<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReportValidationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'report_id'    => 'required|exists:reports,id',
            'validator_id' => 'required|exists:users,id',
            'action'       => 'required|string',
            'status_to'    => 'required|string',
        ];
    }

    /**
     * Sobrescreve o método padrão para retornar erros no formato JSON com status HTTP 422.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
