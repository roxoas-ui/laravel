<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|file|max:20480',
            'attachable_type' => 'required|string',
            'attachable_id' => 'required|integer',
        ];
    }
}
