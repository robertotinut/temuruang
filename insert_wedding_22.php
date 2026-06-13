<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Pink Watercolor Floral',
    'event_type_id' => 1,
    'slug' => 'wedding-22',
    'description' => 'Desain romantis dengan bingkai segi enam emas, bunga cat air pink/peach, dan halaman sampul "Buka Undangan".',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Soft & Elegant'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted: " . $t['name'] . "\n";
