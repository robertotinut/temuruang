<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::updateOrCreate(
        ['slug' => 'wedding-24'],
        [
            'event_type_id' => $et->id,
            'name' => 'Grand Maroon Wedding Design',
            'description' => 'Kemegahan aristokrat dengan perpaduan warna maroon beludru, ornamen emas metalik, serta kolase foto polaroid artistik.',
            'is_premium' => true,
            'is_active' => true,
            'theme_category' => 'Modern & Elegan'
        ]
    );
    echo "wedding-24 template updated in database.\n";
} else {
    echo "Pernikahan event type not found!\n";
}
