<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Grand Maroon Wedding Design',
    'event_type_id' => 1,
    'slug' => 'wedding-30',
    'description' => 'Keanggunan klasik retro bermaterialkan kertas antik (aged parchment), segel lilin merah (wax seal), ornamen sudut emas filigri, dan kolase film seluloid hitam-putih yang memukau.',
    'is_premium' => false,
    'is_active' => true,
    'theme_category' => 'Vintage & Retro'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated: " . $t['name'] . "\n";
