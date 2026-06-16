<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Package;

// Update existing packages or create if they don't exist
$packagesConfig = [
    1 => [
        'name' => 'Free (Trial)',
        'price' => 0,
        'duration_days' => 7,
        'max_guest' => 100,
        'max_gallery' => 999999,
        'max_template' => 999999,
        'is_active' => true
    ],
    2 => [
        'name' => 'Basic',
        'price' => 49000,
        'duration_days' => 90,
        'max_guest' => 500,
        'max_gallery' => 999999,
        'max_template' => 999999,
        'is_active' => true
    ],
    3 => [
        'name' => 'Premium',
        'price' => 149000,
        'duration_days' => 365,
        'max_guest' => 999999,
        'max_gallery' => 999999,
        'max_template' => 999999,
        'is_active' => true
    ]
];

foreach ($packagesConfig as $id => $config) {
    $package = Package::find($id);
    if ($package) {
        $package->update($config);
        echo "Updated package ID {$id}: '{$config['name']}'\n";
    } else {
        Package::create(array_merge(['id' => $id], $config));
        echo "Created package ID {$id}: '{$config['name']}'\n";
    }
}

echo "Database packages updated successfully.\n";
