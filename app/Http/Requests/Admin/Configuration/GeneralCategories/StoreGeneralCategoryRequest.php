<?php

namespace App\Http\Requests\Admin\Configuration\GeneralCategories;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', 'max:255', 'unique:general_categories,slug'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],

            'bgclass' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:50'],

            'icon_alt' => ['nullable', 'string', 'max:125'],
            'is_active' => ['required', 'boolean'],

            'icon' => ['nullable', 'file', 'mimes:svg,svg+xml,jpg,jpeg,png,webp', 'max:5120'],
        ];
    }
}
