<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiHomeSliderController;
use App\Http\Controllers\Api\ApiReportController;
use App\Http\Controllers\Api\MagController;
use App\Http\Controllers\Api\ApiMarketPresenterController;
use App\Http\Controllers\Api\ApiMainBannerController;
use App\Http\Controllers\Api\ApiContactController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Http\Controllers\Api\ApiAllianceController;
use App\Http\Controllers\Api\ApiGeneralCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiSubcategoryController;
use App\Http\Controllers\Api\ApiAuctionController;
use App\Http\Controllers\Api\ApiAuctionModalityController;
use App\Http\Controllers\Api\ApiAuctionTypeController;
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

    // Market Presenter (Informes)
    Route::get('/market-presenter', [ApiMarketPresenterController::class, 'show']);

    // Main Banners por sección
    Route::get('/main-banners/{section}', [ApiMainBannerController::class, 'show']);

    // Contactos WhatsApp
    Route::get('/contacts', [ApiContactController::class, 'index']);

    // Servicios por sección
    Route::get('/services/{section}', [ApiServiceController::class, 'bySection']);

    //Alianzas
    Route::get('/alliances', [ApiAllianceController::class, 'index']);

    //Servicios Principales     
    Route::get('/general-categories', [ApiGeneralCategoryController::class, 'index']);

    //Productos 
    Route::get('/products', [ApiProductController::class, 'index']);
    Route::get('/products/{slug}', [ApiProductController::class, 'show']);
    
    //Categorias de Productos
    Route::get('/categories', [ApiCategoryController::class, 'index']);

    //Subcategorias de Productos
    Route::get('/subcategories', [ApiSubcategoryController::class, 'index']);

    //Remates
    Route::get('/auctions', [ApiAuctionController::class, 'index']);

    //Modalidades de Remates
    Route::get('/auctions-modalities', [ApiAuctionModalityController::class, 'index']);

    //Tipos de Remates
    Route::get('/auctions-types', [ApiAuctionTypeController::class, 'index']);

    //MAG
    Route::get('/mag/precios', [MagController::class, 'precios']);
});