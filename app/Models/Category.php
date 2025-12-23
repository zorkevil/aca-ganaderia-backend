<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'general_category_id',
        'slug',
        'name',
        'icon_path',
        'icon_alt',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function generalCategory()
    {
        return $this->belongsTo(GeneralCategory::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getIconUrlAttribute(): ?string
    {
        if (!$this->icon_path) return null;
        return Storage::disk('images')->url($this->icon_path);
    }
}
