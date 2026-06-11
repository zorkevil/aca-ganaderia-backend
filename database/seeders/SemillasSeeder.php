<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\GeneralCategory;
use Illuminate\Database\Seeder;

class SemillasSeeder extends Seeder
{
    public function run(): void
    {
        $sanidad = GeneralCategory::where('slug', 'sanidad')->firstOrFail();

        $category = Category::firstOrCreate(
            ['slug' => 'semillas'],
            [
                'general_category_id' => $sanidad->id,
                'name'       => 'Semillas',
                'icon_path'  => null,
                'icon_alt'   => null,
                'is_active'  => true,
            ]
        );

        $this->command->info('--- Semillas ---');
        $this->command->info("GeneralCategory Sanidad ID: {$sanidad->id}");
        $this->command->info("Category Semillas      ID: {$category->id}");
        $this->command->info('Guardá estos IDs para hardcodear en el frontend.');
    }
}
