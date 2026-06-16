<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Basic',
                'price' => 49000,
                'duration_days' => 90,
                'max_guest' => 999999,
                'max_gallery' => 999999,
                'max_template' => 2,
            ],
            [
                'name' => 'Plus',
                'price' => 89000,
                'duration_days' => 180,
                'max_guest' => 999999,
                'max_gallery' => 999999,
                'max_template' => 10,
            ],
            [
                'name' => 'Premium',
                'price' => 199000,
                'duration_days' => 365,
                'max_guest' => 999999,
                'max_gallery' => 999999,
                'max_template' => 20,
            ]
        ];

        foreach ($packages as $package) {
            \App\Models\Package::create($package);
        }
    }
}
