<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Admin',
                'phonenumber' => fake()->phoneNumber(),
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => '$2y$12$qUzNVYvfBHfDi13insS0juZo3grgM/8IVVx0HDdSrqmomU8mC86Y6',
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]
        );
    }
}
