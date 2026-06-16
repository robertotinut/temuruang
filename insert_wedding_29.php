<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Emerald Festive Wedding System',
    'event_type_id' => 1,
    'slug' => 'wedding-29',
    'description' => 'Kemegahan agung bernuansa hijau zamrud (emerald) dan kilau debu emas (gold dust), berhiaskan polaroid dengan selotip washi bergaya scrapbook, serta kolase foto editorial yang memukau.',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Unik & Kreatif'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated: " . $t['name'] . "\n";
