<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Grand Emerald Vintage Wedding',
    'event_type_id' => 1,
    'slug' => 'wedding-01',
    'description' => 'Estetika vintage bernuansa hijau emerald (forest green), krem kertas antik (natural paper), aksen lilin segel merah, dekorasi perangko pos jadul, dan bingkai film analog 35mm yang mewah.',
    'is_premium' => true,
    'is_active' => true,
    'theme_category' => 'Vintage & Retro'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated Template: " . $t['name'] . "\n";
