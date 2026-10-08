<?php

namespace App\Models;

use App\Enums\ContactFormSection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'section',
        'is_active',
    ];

    protected $casts = [
        'section' => ContactFormSection::class,
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Solo puede haber un email activo por sección
    public static function activeInSection(string $section, ?int $exceptId = null): ?self
    {
        return static::active()
            ->where('section', $section)
            ->when($exceptId, fn ($q) => $q->whereKeyNot($exceptId))
            ->first();
    }
}
