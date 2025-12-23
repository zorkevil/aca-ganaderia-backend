<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Home\HomeSliderController;
use App\Http\Controllers\Admin\Reports\ReportController;
use App\Http\Controllers\Admin\Reports\MarketPresenterController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Configuration\ConfigurationController;
use App\Http\Controllers\Admin\Configuration\GeneralCategoryController;
use App\Http\Controllers\Admin\Configuration\CategoryController;
use App\Http\Controllers\Admin\Configuration\SubcategoryController;
use App\Http\Controllers\Admin\Configuration\MainBannerController;
use App\Http\Controllers\Admin\Configuration\ServiceController;
use App\Http\Controllers\Admin\Configuration\ContactController;
use App\Http\Controllers\Admin\Sections\NutritionController;
use App\Http\Controllers\Admin\Sections\SanidadController;
use App\Http\Controllers\Admin\Sections\ProductionController;
use App\Http\Controllers\Admin\Sections\HaciendaController;
use App\Http\Controllers\Admin\Configuration\AllianceTextController;
use App\Http\Controllers\Admin\Configuration\AllianceController;
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

        // BLOQUE PRODUCTOS
        Route::get('/productos', [ProductController::class, 'index'])
            ->name('products.index');

        Route::post('/productos', [ProductController::class, 'store'])
            ->name('products.store');

        Route::put('/productos/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/productos/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');

        // BLOQUE CONFIGURACIÓN (index general)
        Route::get('/configuracion', [ConfigurationController::class, 'index'])
            ->name('configuration.index');    

        Route::prefix('configuration')
            ->name('configuration.')
            ->group(function () {
                // GENERAL CATEGORIES
                Route::post('/general-categories', [GeneralCategoryController::class, 'store'])
                    ->name('general-categories.store');

                Route::put('/general-categories/{generalCategory}', [GeneralCategoryController::class, 'update'])
                    ->name('general-categories.update');

                Route::delete('/general-categories/{generalCategory}', [GeneralCategoryController::class, 'destroy'])
                    ->name('general-categories.destroy');

                // CATEGORIES
                Route::post('/categories', [CategoryController::class, 'store'])
                    ->name('categories.store');

                Route::put('/categories/{category}', [CategoryController::class, 'update'])
                    ->name('categories.update');

                Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
                    ->name('categories.destroy');

                // SUBCATEGORIES
                Route::post('/subcategories', [SubcategoryController::class, 'store'])
                    ->name('subcategories.store');

                Route::put('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])
                    ->name('subcategories.update');

                Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])
                    ->name('subcategories.destroy');                

                // CONTACTOS
                Route::post('/contacts', [ContactController::class, 'store'])
                    ->name('contacts.store');

                Route::put('/contacts/{contact}', [ContactController::class, 'update'])
                    ->name('contacts.update');

                Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])
                    ->name('contacts.destroy');

                // TEXTO ALIANZAS
                Route::put(
                    '/alliances/text/{allianceText}',
                    [AllianceTextController::class, 'update']
                )->name('alliances.text.update');

                // ALIANZAS
                Route::post('/alliances', [AllianceController::class, 'store'])
                    ->name('alliances.store');

                Route::put('/alliances/{alliance}', [AllianceController::class, 'update'])
                    ->name('alliances.update');

                Route::delete('/alliances/{alliance}', [AllianceController::class, 'destroy'])
                    ->name('alliances.destroy');
            });

        //BLOQUE BANNERS PRINCIPALES
        Route::put('/sections/{section}/banner-principal', [MainBannerController::class, 'update'])
            ->name('sections.main-banner.update');

        //BLOQUE SERVICIOS   
        Route::post('/sections/{section}/services', [ServiceController::class, 'store'])
            ->name('sections.services.store');

        Route::put('/sections/{section}/services/{sectionService}', [ServiceController::class, 'update'])
            ->name('sections.services.update');

        Route::delete('/sections/{section}/services/{sectionService}', [ServiceController::class, 'destroy'])
            ->name('sections.services.destroy');

        //BLOQUE SECCIONES PRINCIPALES    
        Route::get('/nutricion', [NutritionController::class, 'index'])
            ->name('sections.nutrition.index');

        Route::get('/sanidad', [SanidadController::class, 'index'])
            ->name('sections.sanidad.index');

        Route::get('/produccion', [ProductionController::class, 'index'])
            ->name('sections.production.index');

        Route::get('/hacienda', [HaciendaController::class, 'index'])
            ->name('sections.hacienda.index');
    });

require __DIR__.'/auth.php';
