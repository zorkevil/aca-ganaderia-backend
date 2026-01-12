<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'auction_modality_id',
        'auction_type_id',
        'date',
        'time',
        'description',
        'image_path',
        'image_alt',
        'is_active',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    // -------------------------
    // Relaciones
    // -------------------------
    public function modality()
    {
        return $this->belongsTo(AuctionModality::class, 'auction_modality_id');
    }

    public function type()
    {
        return $this->belongsTo(AuctionType::class, 'auction_type_id');
    }

    // -------------------------
    // Accessors
    // -------------------------
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) return null;
        return Storage::disk('images')->url($this->image_path);
    }
}
