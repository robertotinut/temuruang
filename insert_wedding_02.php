<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Festive Emerald Vintage Wedding',
    'event_type_id' => 1,
    'slug' => 'wedding-02',
    'description' => 'Undangan pernikahan premium bernuansa klasik emerald dengan amplop interaktif wax seal, aksen kertas usang (torn edge), scrapbook polaroid antik, dan musik latar romantis.',
    'is_premium' => true,
    'is_active' => true,
    'theme_category' => 'Vintage & Retro'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated Template: " . $t['name'] . "\n";
