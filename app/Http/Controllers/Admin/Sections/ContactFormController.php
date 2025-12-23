<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Controller;
use App\Models\MainBanner;
use Illuminate\View\View;

class ContactFormController extends Controller
{
    public function index(): View
    {
        // Identificador único de la sección
        $section = 'contacto';

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

        return view('admin.sections.contact.index', compact(
            'section',
            'banner'
        ));
    }
}
