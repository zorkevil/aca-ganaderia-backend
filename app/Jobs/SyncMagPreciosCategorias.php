<?php

namespace App\Jobs;

use App\Models\MagPrice;
use App\Services\Mag\MagClient;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncMagPreciosCategorias implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public function __construct(
    public ?string $fechaYmd = null, // '2025-12-16' opcional
    public int $faenaInvernada = 1
  ) {}

  public function handle(MagClient $client): void
  {
    $fecha = $this->fechaYmd
      ? Carbon::createFromFormat('Y-m-d', $this->fechaYmd)
      : now();

    $fechaDMY = $fecha->format('d/m/Y');

    Log::info('[MAG] Sync start', ['fecha' => $fechaDMY, 'faenaInvernada' => $this->faenaInvernada]);

    $json = $client->fetchPreciosCategorias($fechaDMY, $this->faenaInvernada);

    // OJO: acá tenés que adaptar según la estructura real del JSON de MAG.
    // La idea es terminar con un array de filas normalizadas.
    $rows = $this->normalize($json);

    foreach ($rows as $row) {
      MagPrice::updateOrCreate(
        ['fecha' => $fecha->toDateString(), 'categoria' => $row['categoria']],
        [
          'maximo' => $row['maximo'],
          'minimo' => $row['minimo'],
          'promedio' => $row['promedio'],
          'promedio_kgs' => $row['promedioKgs'],
        ]
      );
    }

    Log::info('[MAG] Sync done', ['fecha' => $fechaDMY, 'count' => count($rows)]);
  }

  private function normalize(array $json): array
  {
      if (!isset($json['precios']) || !is_array($json['precios'])) {
          return [];
      }

      return collect($json['precios'])
          ->map(function (array $item) {
              return [
                  'categoria' => trim($item['Categoria'] ?? ''),
                  'maximo' => isset($item['Maximo']) ? (float) $item['Maximo'] : null,
                  'minimo' => isset($item['Minimo']) ? (float) $item['Minimo'] : null,
                  'promedio' => isset($item['Promedio']) ? (float) $item['Promedio'] : null,
                  'promedioKgs' => isset($item['PromedioKgs'])
                      ? (int) $item['PromedioKgs']
                      : null,
              ];
          })
          ->filter(fn ($row) => $row['categoria'] !== '')
          ->values()
          ->all();
  }
}