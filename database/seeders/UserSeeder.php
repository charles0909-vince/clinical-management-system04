<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Doctor User',
            'email' => 'doctor@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Patient User',
            'email' => 'patient@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'patient',
            'remember_token' => Str::random(10),
        ]);
    }
}
