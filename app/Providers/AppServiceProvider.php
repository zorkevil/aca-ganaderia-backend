<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use App\Models\GeneralCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale('es');
        Config::set('app.locale', 'es');

        View::composer('admin.partials.sidebar', function ($view) {
            $sections = GeneralCategory::whereIn('slug', [
                'nutricion',
                'sanidad',
                'hacienda',
                'produccion',
            ])
            ->where('is_active', true)
            ->get()
            ->keyBy('slug');

            $view->with('sidebarSections', $sections);
        });
    }
}
