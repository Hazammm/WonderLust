<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@wanderlust.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@wanderlust.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );
    }
}
