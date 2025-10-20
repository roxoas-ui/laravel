<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'project_id' => 'required|exists:projects,id',
            'number' => 'required|string',
            'issuer' => 'required|string',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'type' => 'nullable|string',
            'status' => 'nullable|string',
        ];
    }
}
