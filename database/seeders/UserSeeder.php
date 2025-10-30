<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'username' => 'admin',
            'email' => 'admin@gbismojoagung.org',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Member User
        User::create([
            'username' => 'member',
            'email' => 'member@gbismojoagung.org',
            'password' => Hash::make('member123'),
            'role' => 'member',
        ]);
    }
}