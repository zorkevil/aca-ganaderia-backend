<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagPrice extends Model
{
  protected $fillable = [
    'fecha',
    'categoria',
    'maximo',
    'minimo',
    'promedio',
    'promedio_kgs',
  ];

  protected $casts = [
    'fecha' => 'date',
    'maximo' => 'float',
    'minimo' => 'float',
    'promedio' => 'float',
    'promedio_kgs' => 'float',
  ];
}

