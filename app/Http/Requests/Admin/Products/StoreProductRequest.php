<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],

            'general_category_id' => ['required', 'exists:general_categories,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['nullable', 'exists:subcategories,id'],
            'second_category' => ['nullable', 'string'],

            'presentation' => ['nullable', 'string'],
            'formula' => ['nullable', 'string'],
            'administration' => ['nullable', 'string'],
            'dosage' => ['nullable', 'string'],

            'senasa' => ['nullable', 'string', 'max:255'],
            'especie_animal' => ['nullable', 'string', 'max:255'],

            'price' => ['nullable', 'numeric'],
            'date' => ['required', 'date'],
            'is_active' => ['required', 'boolean'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_alt' => ['required', 'string', 'max:125'],
        ];
    }
    
    protected function prepareForValidation()
    {
        if ($this->has('especie_animal')) {

            $especies = array_map(function ($especie) {
                return ucfirst(strtolower($especie));
            }, (array) $this->especie_animal);

            $this->merge([
                'especie_animal' => implode(', ', $especies),
            ]);
        }
    }

}
