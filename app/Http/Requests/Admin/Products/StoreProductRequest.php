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

            // Semillas
            'ciclo'                             => ['nullable', 'string', 'max:255'],
            'aptitud_de_uso'                    => ['nullable', 'string', 'max:255'],
            'contenido_de_tanino'               => ['nullable', 'string', 'max:255'],
            'calidad_de_ms'                     => ['nullable', 'string', 'max:255'],
            'perfil_sanitario'                  => ['nullable', 'string'],
            'altura_cm'                         => ['nullable', 'string', 'max:255'],
            'despeje_de_panoja'                 => ['nullable', 'string', 'max:255'],
            'bmr'                               => ['nullable', 'string', 'max:255'],
            'porcentaje_de_panoja'              => ['nullable', 'string', 'max:255'],
            'zona_de_adaptacion'                => ['nullable', 'string', 'max:255'],
            'densidad_de_siembra'               => ['nullable', 'string', 'max:255'],
            'tecnologia'                        => ['nullable', 'string', 'max:255'],
            'madurez_relativa'                  => ['nullable', 'string', 'max:255'],
            'comportamiento_a_vuelco_y_quebrado'=> ['nullable', 'string', 'max:255'],
            'velocidad_de_secado'               => ['nullable', 'string', 'max:255'],
            'textura_de_grano'                  => ['nullable', 'string', 'max:255'],

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
