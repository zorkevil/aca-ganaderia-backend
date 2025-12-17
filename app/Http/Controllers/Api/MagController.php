<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MagPrice;
use Illuminate\Http\Request;

class MagController extends Controller
{
  public function precios(Request $request)
  {
      // Fecha pedida explícitamente (opcional)
      $requestedFecha = $request->query('fecha'); // YYYY-MM-DD

      // Fecha efectiva a usar
      $fecha = $requestedFecha
          ? $requestedFecha
          : MagPrice::query()->max('fecha'); // último día disponible REAL

      if (!$fecha) {
          // No hay datos en la base
          return response()->json([
              'fecha' => null,
              'data' => [],
          ]);
      }

      $rows = MagPrice::query()
          ->whereDate('fecha', $fecha)
          ->orderBy('categoria')
          ->get([
              'categoria',
              'maximo',
              'minimo',
              'promedio',
              'promedio_kgs as promedioKgs',
          ]);

      return response()->json([
          'fecha' => $fecha,
          'data' => $rows,
      ]);
  }

}

