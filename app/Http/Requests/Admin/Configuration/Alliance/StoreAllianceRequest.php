<?php

namespace App\Http\Requests\Admin\Configuration\Alliance;

use Illuminate\Foundation\Http\FormRequest;

class StoreAllianceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'icon'      => 'required|file|mimes:svg,svg+xml,jpg,jpeg,png,webp',
            'name'      => 'required|string|max:255',
            'alt'       => 'required|string|max:255',
            'link'      => 'nullable|url',
            'is_active' => 'boolean',
        ];
    }
}
