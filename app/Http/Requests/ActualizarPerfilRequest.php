<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarPerfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitimos la validación
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional de min 8 letras
        ];
    }
}