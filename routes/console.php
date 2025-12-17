<?php

use App\Jobs\SyncMagPreciosCategorias;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SyncMagPreciosCategorias())
    ->timezone('America/Argentina/Buenos_Aires')
    ->days(['tuesday', 'wednesday', 'friday'])
    ->at('12:00')
    ->withoutOverlapping();