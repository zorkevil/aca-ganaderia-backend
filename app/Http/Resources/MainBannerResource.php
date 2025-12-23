<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MainBannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'section'   => $this->section,
            'image'     => $this->image_url,
            'imageAlt'  => $this->image_alt,
        ];
    }
}
