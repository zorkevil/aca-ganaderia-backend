<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AuctionModality extends Model
{
    use HasFactory;
    
    protected $table = 'auction_modalities';

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
}
