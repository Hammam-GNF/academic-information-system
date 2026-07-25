<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            [
                'email' => 'user@gmail.com',
            ],
            [
                'name' => 'Demo User',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole('user');
    }
}
