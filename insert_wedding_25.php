<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::updateOrCreate(
        ['slug' => 'wedding-25'],
        [
            'event_type_id' => $et->id,
            'name' => 'Grand Navy Wedding System',
            'description' => 'Kemegahan galeri seni modern dengan perpaduan warna navy aristokrat, detail emas mewah, serta kolase foto polaroid editorial chic.',
            'is_premium' => true,
            'is_active' => true,
            'theme_category' => 'Modern & Elegan'
        ]
    );
    echo "wedding-25 template updated in database.\n";
} else {
    echo "Pernikahan event type not found!\n";
}
