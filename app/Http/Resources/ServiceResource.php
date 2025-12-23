<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'section' => $this->section,
            'icon'    => $this->icon_url,
            'title'   => $this->title,
        ];
    }
}
