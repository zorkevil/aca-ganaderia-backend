<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GeneralCategory;
use Illuminate\Database\Seeder;

class IdentificacionElectronicaSeeder extends Seeder
{
    public function run(): void
    {
        $sanidad = GeneralCategory::where('slug', 'sanidad')->firstOrFail();

        $category = Category::firstOrCreate(
            ['slug' => 'identificacion-electronica'],
            [
                'general_category_id' => $sanidad->id,
                'name'       => 'Identificación Electrónica',
                'icon_path'  => null,
                'icon_alt'   => null,
                'is_active'  => true,
            ]
        );

        $this->command->info('--- Identificación Electrónica ---');
        $this->command->info("GeneralCategory Sanidad  ID: {$sanidad->id}");
        $this->command->info("Category Ident. Electrónica ID: {$category->id}");
        $this->command->info('Guardá estos IDs para hardcodear en el frontend.');
    }
}
