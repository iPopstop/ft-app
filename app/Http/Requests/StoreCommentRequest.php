<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'message' => 'required',
            'employee_id' => 'required'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
