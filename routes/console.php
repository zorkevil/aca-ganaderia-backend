<?php

use App\Jobs\SyncMagPreciosCategorias;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SyncMagPreciosCategorias())
    ->timezone('America/Argentina/Buenos_Aires')
    ->daysOfWeek([2, 3, 5]) // Martes, Miércoles, Viernes
    ->at('12:00')
    ->withoutOverlapping()
    ->runInBackground();