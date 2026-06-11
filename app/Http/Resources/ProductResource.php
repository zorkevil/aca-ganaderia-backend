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
			
			// Semillas
			'aptitud_de_uso' => $this->aptitud_de_uso,
			'ciclo' => $this->ciclo,
			'contenido_de_tanino' => $this->contenido_de_tanino,
			'altura_cm' => $this->altura_cm,
			'despeje_de_panoja' => $this->despeje_de_panoja,
			'calidad_de_ms' => $this->calidad_de_ms,
			'perfil_sanitario' => $this->perfil_sanitario,
			'bmr' => $this->bmr,
			'porcentaje_de_panoja' => $this->porcentaje_de_panoja,
			'zona_de_adaptacion' => $this->zona_de_adaptacion,
			'densidad_de_siembra' => $this->densidad_de_siembra,
			'tecnologia' => $this->tecnologia,
			'madurez_relativa' => $this->madurez_relativa,
			'comportamiento_a_vuelco_y_quebrado' => $this->comportamiento_a_vuelco_y_quebrado,
			'velocidad_de_secado' => $this->velocidad_de_secado,
			'textura_de_grano' => $this->textura_de_grano,

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
