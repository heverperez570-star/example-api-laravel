<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'role_id' => [
                'required',
                'integer',
                'exists:roles,id'
            ],
            'names' => [
                'required',
                'string',
                'max:175'
            ],
            'last_names' => [
                'required',
                'string',
                'max:200'
            ],
            'username' => [
                'required',
                'string',
                'max:100',
                'unique:users,username'
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed' // La contraseña debe ser confirmada
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
            'names.required' => 'El campo nombres es obligatorio.',
            'names.string' => 'El campo nombres debe ser una cadena de texto.',
            'names.max' => 'El campo nombres no debe exceder los 175 caracteres.',

            'last_names.required' => 'El campo apellidos es obligatorio.',
            'last_names.string' => 'El campo apellidos debe ser una cadena de texto.',
            'last_names.max' => 'El campo apellidos no debe exceder los 200 caracteres.',

            'username.required' => 'El campo nombre de usuario es obligatorio.',
            'username.string' => 'El campo nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El campo nombre de usuario no debe exceder los 100 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',

            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'El campo contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
    }
}
