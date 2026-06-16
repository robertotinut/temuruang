<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Festive Greenery Wedding System',
    'event_type_id' => 1,
    'slug' => 'wedding-27',
    'description' => 'Kemegahan natural modern bertema hutan hijau meriah dengan detail foil emas, tata letak kolase asimetris editorial, serta bingkai foto polaroid dan lingkaran elegan.',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Unik & Kreatif'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted: " . $t['name'] . "\n";
