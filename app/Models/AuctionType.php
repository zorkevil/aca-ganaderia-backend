<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AuctionType extends Model
{
    use HasFactory;
    
    protected $table = 'auction_types';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon_path',
        'icon_alt',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getIconUrlAttribute(): ?string
    {
        if (!$this->icon_path) return null;
        return Storage::disk('images')->url($this->icon_path);
    }
}
