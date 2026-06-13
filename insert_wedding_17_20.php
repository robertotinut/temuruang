<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

// ID Event Type untuk Pernikahan biasanya = 1
$templates = [
    [
        'name' => 'Gothic Romance',
        'event_type_id' => 1,
        'slug' => 'wedding-17',
        'description' => 'Desain gelap dan dramatis ala era Victoria/Gothic. Menggunakan kombinasi warna hitam dan merah darah untuk nuansa cinta abadi.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Modern & Unique'
    ],
    [
        'name' => 'Tropical Beach',
        'event_type_id' => 1,
        'slug' => 'wedding-18',
        'description' => 'Sangat cocok untuk pernikahan di pinggir pantai. Menampilkan animasi deburan ombak dan daun palem tropis.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Rustic & Nature'
    ],
    [
        'name' => 'Whimsical Fairytale',
        'event_type_id' => 1,
        'slug' => 'wedding-19',
        'description' => 'Wujudkan pernikahan layaknya negeri dongeng. Dilengkapi dengan animasi debu peri berkilau dan buku cerita romantis.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Soft & Elegant'
    ],
    [
        'name' => 'Cinematic Poster',
        'event_type_id' => 1,
        'slug' => 'wedding-20',
        'description' => 'Undangan unik berformat seperti poster rilis film bioskop layar lebar. Ada credit title dan tata letak sinematik.',
        'is_premium' => false,
        'is_active' => true,
        'theme_category' => 'Modern & Unique'
    ]
];

foreach ($templates as $t) {
    Template::updateOrCreate(['slug' => $t['slug']], $t);
    echo "Inserted: " . $t['name'] . "\n";
}

echo "Wedding 17-20 inserted successfully.\n";
