<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->slug,
            'title' => $this->name,
            'description' => $this->description,
            'bgClass' => $this->bgclass,
            'icon' => $this->icon_url,
            'href' => '/' . $this->slug,
        ];
    }
}
