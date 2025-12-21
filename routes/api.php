<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiHomeSliderController;
use App\Http\Controllers\Api\ApiReportController;
use App\Http\Controllers\Api\MagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas de autenticación (sin protección)
Route::prefix('auth')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
});

// Rutas protegidas por autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [ApiAuthController::class, 'logout']);
        Route::post('/logout-all', [ApiAuthController::class, 'logoutAll']);
        Route::get('/me', [ApiAuthController::class, 'me']);
    });

    // Home
    Route::prefix('home')->group(function () {
        // Sliders del home
        Route::get('/sliders', [ApiHomeSliderController::class, 'index']);
        Route::get('/sliders/{homeSlider}', [ApiHomeSliderController::class, 'show']);
    });

    // Informes
    Route::get('/reports', [ApiReportController::class, 'index']);
    Route::get('/reports/{report}', [ApiReportController::class, 'show']);

    //MAG
    Route::get('/mag/precios', [MagController::class, 'precios']);
    
});