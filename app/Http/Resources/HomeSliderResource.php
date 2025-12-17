<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSliderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image_url,
            'imageAlt' => $this->alt,
            'titleHtml' => $this->text,
            'link' => $this->link,
            'sortOrder' => $this->sort_order,
        ];
    }
}