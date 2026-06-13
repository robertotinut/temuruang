<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Golden Floral Minimalist',
    'event_type_id' => 1,
    'slug' => 'wedding-21',
    'description' => 'Desain elegan, bersih, dan modern dengan ornamen floral warna emas. Sangat cocok untuk pasangan yang menyukai kesederhanaan mewah.',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Soft & Elegant'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted: " . $t['name'] . "\n";
