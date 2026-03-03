<?php

use App\Jobs\SyncMagPreciosCategorias;
use App\Jobs\ProcessContactForms;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SyncMagPreciosCategorias())
    ->timezone('America/Argentina/Buenos_Aires')
    ->weeklyOn([2, 3, 5], '13:00') // Mar, Mié, Vie a las 13:00
    ->withoutOverlapping();

Schedule::job(new ProcessContactForms())
    ->timezone('America/Argentina/Buenos_Aires')
    ->everyFiveMinutes()
    ->withoutOverlapping();