<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::updateOrCreate(
        ['slug' => 'wedding-23'],
        [
            'event_type_id' => $et->id,
            'name' => 'Vibrant Lime Wedding System',
            'description' => 'Kombinasi eksklusif warna lime vibrant, emerald gelap, dan ornamen emas mewah (Bodoni Moda & Cinzel).',
            'is_premium' => true,
            'is_active' => true,
            'theme_category' => 'Modern & Elegan'
        ]
    );
    echo "wedding-23 template updated in database.\n";
} else {
    echo "Pernikahan event type not found!\n";
}
