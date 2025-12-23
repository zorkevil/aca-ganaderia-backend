<?php

namespace Database\Seeders;

use App\Models\MainBanner;
use Illuminate\Database\Seeder;

class MainBannerSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            'nutricion' => 'Banner principal de Nutrición',
            'sanidad'  => 'Banner principal de Sanidad',
            'hacienda'  => 'Banner principal de Hacienda',
            'produccion'  => 'Banner principal de Producción',
            'informes'  => 'Banner principal de Informes',
            'contacto'  => 'Banner principal de Contacto',
        ];

        foreach ($sections as $section => $alt) {
            MainBanner::firstOrCreate(
                ['section' => $section],
                [
                    'image_path' => null,
                    'image_alt'  => $alt,
                ]
            );
        }
    }
}
