<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@acacoop.com.ar',
            'is_admin' => true,
            'password' => Hash::make('admin123'),
        ]);

        User::factory()->create([
            'name' => 'Aideas',
            'email' => 'marketing@aideas.com.ar',
            'is_admin' => true,
            'is_creador' => true,
            'password' => Hash::make('creador123'),
        ]);

        $this->call([
            HomeSliderSeeder::class,            
            MainBannerSeeder::class,
        ]);
    }
}
