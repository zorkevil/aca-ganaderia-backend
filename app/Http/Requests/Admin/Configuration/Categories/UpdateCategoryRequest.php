<?php

namespace App\Http\Requests\Admin\Configuration\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'general_category_id' => ['required', 'exists:general_categories,id'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($this->category->id),
            ],
            'name' => ['required', 'string', 'max:255'],

            'icon_alt' => ['nullable', 'string', 'max:125'],
            'is_active' => ['required', 'boolean'],

            'icon' => ['nullable', 'file', 'mimes:svg,svg+xml,jpg,jpeg,png,webp', 'max:5120'],
        ];
    }
}
