<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Javanese Royal Gunungan',
    'event_type_id' => 1,
    'slug' => 'wedding-31',
    'description' => 'Keindahan sakral pernikahan adat Jawa klasik berhiaskan corak batik heritage, gunungan wayang yang ikonik, dan aksen emas khas keraton yang agung.',
    'is_premium' => true,
    'is_active' => true,
    'theme_category' => 'Tradisional (Jawa, Sunda, dll)'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated Template: " . $t['name'] . "\n";
