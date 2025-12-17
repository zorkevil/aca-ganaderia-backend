<?php

use App\Jobs\SyncMagPreciosCategorias;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SyncMagPreciosCategorias())
    ->timezone('America/Argentina/Buenos_Aires')
    ->weeklyOn([2, 3, 5], '12:00') // Mar, Mié, Vie
    ->withoutOverlapping();