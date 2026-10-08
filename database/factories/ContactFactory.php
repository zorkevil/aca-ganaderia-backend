<?php

namespace Database\Factories;

use App\Models\GeneralCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'general_category_id' => GeneralCategory::factory(),
            'is_active' => true,
        ];
    }
}
