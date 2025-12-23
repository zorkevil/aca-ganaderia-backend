<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'section' => $this->generalCategory?->slug,
            'phone'   => $this->phone,
            'label'   => $this->name,
        ];
    }
}
