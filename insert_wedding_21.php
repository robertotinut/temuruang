<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Elegant Festive Maroon Wedding',
    'event_type_id' => 1,
    'slug' => 'wedding-21',
    'description' => 'Desain undangan pernikahan dengan nuansa merah marun megah yang berpadu serasi dengan detail emas berkilau dan efek glassmorphism yang premium.',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Unik & Kreatif'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted: " . $t['name'] . "\n";
