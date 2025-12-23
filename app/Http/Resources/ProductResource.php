<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'sku'   => $this->sku,
            'slug'  => $this->slug,
            'name'  => $this->name,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,

            // General category
            'generalCategory' => $this->generalCategory?->slug,
            'generalCategoryName' => $this->generalCategory?->name,

            // Category / Subcategory
            'category' => $this->category?->name,
            'subcategory' => $this->subcategory?->name,

            'iconCategory' => $this->category?->icon_url,
            'iconSubcategory' => $this->subcategory?->icon_url,

            // Contenido
            'secondCategory' => $this->second_category,
            'presentation' => $this->presentation,
            'formula' => $this->formula,
            'administration' => $this->administration,
            'dosage' => $this->dosage,
            'senasa' => $this->senasa,
            'especieAnimal' => $this->especie_animal,

            // Media
            'image' => $this->image_url,
            'imageAlt' => $this->image_alt,

            // Comercial
            'price' => (float) $this->price,
            'sales' => (int) $this->sales,

            // Fechas / estado
            'date' => optional($this->date)->toDateString(),
            'isActive' => $this->is_active,
        ];
    }
}
