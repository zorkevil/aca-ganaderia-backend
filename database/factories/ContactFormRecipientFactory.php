<?php

namespace Database\Factories;

use App\Enums\ContactFormSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactFormRecipient>
 */
class ContactFormRecipientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => fake()->safeEmail(),
            'section' => fake()->randomElement(ContactFormSection::cases()),
            'is_active' => true,
        ];
    }
}
