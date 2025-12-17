<?php

use App\Jobs\SyncMagPreciosCategorias;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SyncMagPreciosCategorias())
    ->timezone('America/Argentina/Buenos_Aires')
    ->tuesdays()
    ->wednesdays()
    ->fridays()
    ->at('12:00')
    ->withoutOverlapping();