<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El campo de correo electrónico debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El campo de correo electrónico no debe exceder los 255 caracteres.',
            
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'El campo de contraseña debe ser una cadena de texto.',
            'password.min' => 'El campo de contraseña debe tener al menos 6 caracteres.',
        ];
    }
}
