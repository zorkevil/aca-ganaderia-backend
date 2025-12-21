<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'href' => $this->link,
            'image' => $this->image_url,
            'imageAlt' => $this->alt,
            'date' => $this->date->format('Y-m-d'),
            'dateFormatted' => $this->date->format('d/m/Y'),
        ];
    }
}