<?php 

namespace App\Services\Mag;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MagClient
{
  public function fetchPreciosCategorias(string $fechaDMY, int $faenaInvernada = 1): array
  {
      $cfg = config('services.mag');

      try {
          $res = Http::withBasicAuth($cfg['user'], $cfg['password'])
              ->acceptJson()
              ->timeout($cfg['timeout'])
              ->withOptions(['verify' => $cfg['verify_ssl']])
              ->get($cfg['base_url'] . '/api/operaciones/precios_categorias', [
                  'fecha' => $fechaDMY,
                  'faenainvernada' => $faenaInvernada,
              ]);

          Log::info('[MAG] API Response', [
              'successful' => $res->successful(),
              'url' => $cfg['base_url'] . '/api/operaciones/precios_categorias',
          ]);

          $res->throw();

          return $res->json();
          
      } catch (\Exception $e) {
          Log::error('[MAG] API Error', [
              'message' => $e->getMessage(),
              'url' => $cfg['base_url'] ?? 'N/A',
              'fecha' => $fechaDMY,
          ]);
          throw $e;
      }
  }
}
