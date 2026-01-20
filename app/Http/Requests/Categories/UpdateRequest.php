<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'slug' => [
                'required', // El dato es obligatorio
                'string', // Debe ser una cadena de texto
                'min:4', // Longitud mínima de 4 caracteres
                'max:100', // Longitud máxima de 100 caracteres
                'unique:categories,slug,' . $this->route('id'), // Debe ser único en la tabla categories, excepto el actual
            ],
            'name'=> [
                'required',
                'string',
                'min:5', // Longitud mínima de 5 caracteres
                'max:150', // Longitud máxima de 150 caracteres
            ],
            'description' => [
                'nullable', // El dato es opcional
                'string', // Debe ser una cadena de texto
            ],
        );

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $messages = array(
            'slug.required' => "El slug es obligatorio.",
            'slug.string' => "El slug debe ser una cadena de texto.",
            'slug.min' => "El slug debe tener al menos 4 caracteres.",
            'slug.max' => "El slug no debe exceder los 100 caracteres.",
            'slug.unique' => "El slug ya se encuentra en uso por otra categoría.",

            'name.required' => "El nombre es obligatorio.",
            'name.string' => "El nombre debe ser una cadena de texto.",
            'name.min' => "El nombre debe tener al menos 5 caracteres.",
            'name.max' => "El nombre no debe exceder los 150 caracteres.",

            'description.string' => "La descripción debe ser una cadena de texto.",
        );

        return $messages;
    }
}
