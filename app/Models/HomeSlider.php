<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HomeSlider extends Model
{
  use HasFactory;

  protected $fillable = [
    'sort_order',
    'text',
    'alt',
    'link',
    'image_path',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
    'sort_order' => 'integer',
  ];

  public function getImageUrlAttribute(): ?string
  {
    if (!$this->image_path) return null;
    return Storage::disk('images')->url($this->image_path);
  }
}
