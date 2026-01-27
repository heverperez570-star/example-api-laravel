<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        $rules = array(
            'token' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
                'exists:users,email', // Verifica que el correo exista en la tabla users
            ],
            'password' => [
                'required',
                'string',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', // Al menos una mayúscula, una minúscula, un número y un carácter especial
                'min:8', // La contraseña debe tener al menos 8 caracteres
                'confirmed', // Verifica que el campo password_confirmation coincida
            ],
        );

        return $rules;
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $messages = array(
            'token.required' => 'El token de restablecimiento es obligatorio.',
            'token.string' => 'El token de restablecimiento debe ser una cadena de texto válida.',
            
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'email.exists' => 'No se encontró ningún usuario con este correo electrónico.',
            
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto válida.',
            // 'password.regex' => 'La contraseña debe tener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        );

        return $messages;
    }
}
