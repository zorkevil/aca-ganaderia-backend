<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Controller;
use App\Models\MainBanner;
use App\Models\Service;
use Illuminate\View\View;

class NutritionController extends Controller
{
    /**
     * Vista principal de la sección Nutrición
     */
    public function index(): View
    {
        // Identificador único de la sección
        $section = 'nutricion';

        /**
         * Banner principal
         * Se crea automáticamente si no existe
         */
        $banner = MainBanner::firstOrCreate(
            ['section' => $section],
            [
                'image_path' => null,
                'image_alt'  => '',
            ]
        );

        $services = Service::where('section', $section)
            ->orderBy('title')
            ->get();

        return view('admin.sections.nutrition.index', compact(
            'section',
            'banner',
            'services',
        ));
    }
}
