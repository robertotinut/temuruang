<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::updateOrCreate(
        ['slug' => 'wedding-26'],
        [
            'event_type_id' => $et->id,
            'name' => 'Festive Brown Wedding System',
            'description' => 'Kemegahan modern bertema cokelat meriah dengan ornamen foil emas, dekorasi botanical cat air, dan tata letak kolase asimetris.',
            'is_premium' => true,
            'is_active' => true,
            'theme_category' => 'Unik & Kreatif'
        ]
    );
    echo "wedding-26 template updated in database.\n";
} else {
    echo "Pernikahan event type not found!\n";
}
?>
