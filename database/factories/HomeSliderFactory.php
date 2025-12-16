<?php

namespace Database\Factories;

use App\Models\HomeSlider;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeSliderFactory extends Factory
{
  protected $model = HomeSlider::class;

  public function definition(): array
  {
    return [
      'sort_order' => $this->faker->numberBetween(1, 5),
      'text' => $this->faker->sentence(6),
      'alt' => $this->faker->sentence(6),
      'link' => $this->faker->boolean(50) ? $this->faker->url() : null,
      'image_path' => null, // en seed real podrías copiar imágenes si querés
      'is_active' => $this->faker->boolean(70),
    ];
  }
}
