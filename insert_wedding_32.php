<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Wedding 32',
    'event_type_id' => 1,
    'slug' => 'wedding-32',
    'description' => 'Template Undangan Pernikahan Elegan Wedding 32.',
    'is_premium' => true,
    'is_active' => true,
    'theme_category' => 'Elegan'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated Template: " . $t['name'] . "\n";
