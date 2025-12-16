<?php

namespace Database\Seeders;

use App\Models\HomeSlider;
use Illuminate\Database\Seeder;

class HomeSliderSeeder extends Seeder
{
  public function run(): void
  {
    HomeSlider::query()->delete();

    HomeSlider::factory()->count(3)->create([
      'is_active' => true,
    ]);

    HomeSlider::factory()->count(2)->create([
      'is_active' => false,
    ]);
  }
}
