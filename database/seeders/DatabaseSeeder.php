<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Seed all data
        $this->call([
            ServiceSeeder::class,
            DoctorSeeder::class,
            TestimonialSeeder::class,
            PostSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
