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
}
