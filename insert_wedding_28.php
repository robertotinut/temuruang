<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$t = [
    'name' => 'Wedding 28 (Royal Emerald & Golden Glassmorphic)',
    'event_type_id' => 1,
    'slug' => 'wedding-28',
    'description' => 'Mahakarya kemewahan kelas atas, perpaduan warna hijau emerald kebesaran dan emas champagne yang elegan, dilengkapi dengan animasi pintu lipat 3D pembuka undangan.',
    'is_premium' => true,
    'is_active' => true,
    'theme_category' => 'Unik & Kreatif'
];

Template::updateOrCreate(['slug' => $t['slug']], $t);
echo "Inserted/Updated: " . $t['name'] . "\n";
