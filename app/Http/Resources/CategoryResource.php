<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->slug,
            'name' => $this->name,
            'slug' => $this->slug,

            'generalCategory' => $this->generalCategory?->slug,

            'icon' => $this->icon_url,
            'iconAlt' => $this->icon_alt,

            'href' => '/' . $this->generalCategory?->slug . '/' . $this->slug,
        ];
    }
}
