<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'slug',
        'name',
        'description',
        'title',
        'subtitle',

        'general_category_id',
        'category_id',
        'subcategory_id',
        'second_category',

        'presentation',
        'formula',
        'administration',
        'dosage',

        'senasa',
        'especie_animal',

        // Semillas
        'ciclo',
        'aptitud_de_uso',
        'contenido_de_tanino',
        'calidad_de_ms',
        'perfil_sanitario',
        'altura_cm',
        'despeje_de_panoja',
        'bmr',
        'porcentaje_de_panoja',
        'zona_de_adaptacion',
        'densidad_de_siembra',
        'tecnologia',
        'madurez_relativa',
        'comportamiento_a_vuelco_y_quebrado',
        'velocidad_de_secado',
        'textura_de_grano',

        'image_path',
        'image_alt',
        'price',
        'sales',
        'date',
        'is_active',
    ];

    protected $casts = [
        'sales' => 'integer',
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    public function generalCategory()
    {
        return $this->belongsTo(GeneralCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
  
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) return null;
        return Storage::disk('images')->url($this->image_path);
    }
}
