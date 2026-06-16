<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Emerald Festive Wedding Design',
    'event_type_id' => 1,
    'slug' => 'wedding-22',
    'description' => 'Nuansa hijau emerald dan emas mewah dengan glassmorphism premium.',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Modern & Elegan'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted: " . $t['name'] . "\n";
