<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MainBanner extends Model
{
    use HasFactory;
    
    protected $table = 'main_banners';

    protected $fillable = [
        'section',
        'image_path',
        'image_alt',
    ];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) return null;
        return Storage::disk('images')->url($this->image_path);
    }
}
