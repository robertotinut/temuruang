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
                'name' => 'Free',
                'price' => 0,
                'max_guest' => 100,
                'max_gallery' => 5,
                'max_template' => 1,
            ],
            [
                'name' => 'Basic',
                'price' => 50000,
                'max_guest' => 500,
                'max_gallery' => 20,
                'max_template' => 5,
            ],
            [
                'name' => 'Premium',
                'price' => 150000,
                'max_guest' => 999999, // unlimited representation
                'max_gallery' => 999999,
                'max_template' => 999999,
            ]
        ];

        foreach ($packages as $package) {
            \App\Models\Package::create($package);
        }
    }
}
