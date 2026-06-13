<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$templates = [
    [
        'name' => 'Corporate Tech Seminar',
        'event_type_id' => 5, // Seminar
        'slug' => 'seminar-01',
        'description' => 'Desain profesional untuk acara korporat, seminar, atau peluncuran produk dengan jadwal acara dan profil pembicara.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Corporate & Formal'
    ],
    [
        'name' => 'Sweet 17 Colorful',
        'event_type_id' => 3, // Ulang Tahun
        'slug' => 'birthday-01',
        'description' => 'Desain ceria dan penuh warna dengan animasi konfeti, sangat cocok untuk perayaan ulang tahun atau pesta santai.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Playful & Colorful'
    ],
    [
        'name' => 'Nostalgia Reuni Akbar',
        'event_type_id' => 2, // Reuni
        'slug' => 'reuni-01',
        'description' => 'Membangkitkan kenangan lama dengan galeri foto gaya polaroid dan desain bernuansa almamater klasik.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Vintage & Retro'
    ],
    [
        'name' => 'Graduation Gold Elegance',
        'event_type_id' => 4, // Wisuda
        'slug' => 'wisuda-01',
        'description' => 'Perayaan kelulusan bergaya elegan dengan paduan warna hitam dan emas, menonjolkan profil sang wisudawan.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Classic & Minimalist'
    ]
];

foreach ($templates as $t) {
    Template::updateOrCreate(['slug' => $t['slug']], $t);
    echo "Inserted: " . $t['name'] . "\n";
}

echo "All non-wedding templates inserted successfully.\n";
