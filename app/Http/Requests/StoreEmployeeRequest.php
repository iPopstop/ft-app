<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'mobile_number' => 'required|min:10',
            'email' => 'sometimes',
            'first_name' => 'required|min:2|max:30',
            'middle_name' => 'nullable',
            'last_name' => 'required|min:2|max:30',
            'position_id' => 'sometimes'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
