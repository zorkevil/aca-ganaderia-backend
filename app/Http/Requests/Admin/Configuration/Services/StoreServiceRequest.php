<?php

namespace App\Http\Requests\Admin\Configuration\Services;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'section'   => 'required|string|max:255',
            'title'     => 'required|string|max:255',
            'icon'      => 'nullable|file|mimes:svg,png,jpg,jpeg,webp',
            'icon_alt'  => 'nullable|string|max:125',
            'is_active' => 'required|boolean',
        ];
    }
}
