<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\MarketPresenterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // HOME (pantalla principal)
        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');

        // BLOQUE SLIDERS
        Route::post('/home/sliders', [HomeSliderController::class, 'store'])
            ->name('home.sliders.store');

        Route::put('/home/sliders/{homeSlider}', [HomeSliderController::class, 'update'])
            ->name('home.sliders.update');

        Route::delete('/home/sliders/{homeSlider}', [HomeSliderController::class, 'destroy'])
            ->name('home.sliders.destroy');
        
        // BLOQUE INFORMES
        Route::get('/informes', [ReportController::class, 'index'])
            ->name('reports.index');

        Route::post('/informes', [ReportController::class, 'store'])
            ->name('reports.store');

        Route::put('/informes/{report}', [ReportController::class, 'update'])
            ->name('reports.update');

        Route::delete('/informes/{report}', [ReportController::class, 'destroy'])
            ->name('reports.destroy');

        Route::put('/market-presenter/{marketPresenter}', [MarketPresenterController::class, 'update'])->name('market-presenter.update');    
    });


require __DIR__.'/auth.php';
