<?php

namespace App\Http\Requests;

use App\Rules\StrongPassword;
use App\Traits\Utils;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    use Utils;

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255|unique:users,name',
            'email' => 'required|string|email|min:1|max:255|unique:users,email',
            'password' => ['required', 'string', 'confirmed', new StrongPassword()]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationErrors($validator->errors()));
    }
}
