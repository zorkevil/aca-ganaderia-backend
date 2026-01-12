<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // viene desde Next, no hay auth
    }

    public function rules(): array
    {
        return [
            'nombre'     => ['required', 'string'],
            'apellido'   => ['nullable', 'string'],
            'email'      => ['required', 'email'],
            'telefono'   => ['nullable', 'string'],
            'rol'        => ['nullable', 'string'],
            'otro_rol'   => ['nullable', 'string'],
            'localidad'  => ['nullable', 'string'],
            'area'       => ['nullable', 'string'],
            'mensaje'    => ['required', 'string'],
            'section'    => ['nullable', 'string'],
        ];
    }
}
