<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->slug,          // coherente con Category y GeneralCategory
            'title' => $this->name,
            'slug' => $this->slug,

            'category' => $this->category?->slug,
            'generalCategory' => $this->category?->generalCategory?->slug,

            'icon' => $this->icon_url,
            'iconAlt' => $this->icon_alt,

            'href' => '/' .
                $this->category?->generalCategory?->slug . '/' .
                $this->category?->slug . '/' .
                $this->slug,
        ];
    }
}
