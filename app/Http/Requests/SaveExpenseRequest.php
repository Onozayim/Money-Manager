<?php

namespace App\Http\Requests;

use App\Traits\Utils;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveExpenseRequest extends FormRequest
{
    use Utils;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => 'required|numeric|decimal:0,2|min:0.1',
            'description' => 'required|string|min:1|max:150',
            'sub_category_id' => 'required|numeric|exists:sub_categories,id'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationErrors($validator->errors()));
    }
}
