<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$data = [
    'name' => 'Sunda Parahyangan Emerald',
    'event_type_id' => 1,
    'slug' => 'wedding-34',
    'description' => 'Kemewahan adat Sunda bernuansa sage emerald & antique gold, dihiasi ornamen Mahkota Siger bertabur ronce melati, kujang kembar, serta gapura ukir khas Parahyangan yang sakral dan anggun.',
    'thumbnail' => 'templates/thumbnails/wedding-34.jpg',
    'preview_image' => 'templates/thumbnails/wedding-34.jpg',
    'is_premium' => true,
    'is_active' => true,
    'theme_category' => 'Tradisional (Jawa, Sunda, dll)'
];

$template = Template::updateOrCreate(['slug' => $data['slug']], $data);
echo "Inserted/Updated Template ID: " . $template->id . " (" . $template->slug . ")\n";
