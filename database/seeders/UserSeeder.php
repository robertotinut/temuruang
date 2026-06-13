<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Owner',
            'email' => 'owner@temuruang.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'Owner',
        ]);

        \App\Models\User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@temuruang.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'Admin',
        ]);

        \App\Models\User::create([
            'name' => 'Customer Satu',
            'email' => 'customer@temuruang.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'Customer',
        ]);
    }
}
