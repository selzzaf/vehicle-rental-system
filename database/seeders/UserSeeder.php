<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('00000000'),
            'is_admin' => true,
        ]);

        // Create regular users
        $users = [
            [
                'name' => 'Client',
                'email' => 'Client@gmail.com',
                'password' => Hash::make('00000000'),
                'is_admin' => false,
            ],
            [
                'name' => 'yasmine',
                'email' => 'yasmine13@gmail.com',
                'password' => Hash::make('00000000'),
                'is_admin' => false,
            ],
            [
                'name' => 'Amina',
                'email' => 'AminaSf12@gmail.com',
                'password' => Hash::make('00000000'),
                'is_admin' => false,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
} 