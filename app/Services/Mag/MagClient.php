<?php 

namespace App\Services\Mag;

use Illuminate\Support\Facades\Http;

class MagClient
{
  public function fetchPreciosCategorias(string $fechaDMY, int $faenaInvernada = 1): array
  {
    $cfg = config('services.mag');

    $res = Http::withBasicAuth($cfg['user'], $cfg['password'])
      ->acceptJson()
      ->timeout($cfg['timeout'])
      ->withOptions(['verify' => $cfg['verify_ssl']])
      ->get($cfg['base_url'] . '/api/operaciones/precios_categorias', [
        'fecha' => $fechaDMY,
        'faenainvernada' => $faenaInvernada,
      ]);

    $res->throw(); // si 401/500/etc, tira excepción

    return $res->json();
  }
}
