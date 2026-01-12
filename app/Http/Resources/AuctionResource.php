<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'modalidad' => $this->modality?->name,
            'tipo' => $this->type?->name,
            'date' => optional($this->date)->toDateString(),
            'time' => $this->time,
            'description' => $this->description,
            'image' => $this->image_url,
            'href' => $this->link,
        ];
    }
}
