<?php
$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::firstOrCreate(
        ['slug' => 'wedding-03'],
        [
            'event_type_id' => $et->id,
            'name' => 'Wedding 03 (Sage Minimalist)',
            'description' => 'Tema minimalis modern dengan aksen sage green',
            'is_premium' => false,
            'is_active' => true
        ]
    );
    echo "wedding-03 template added to database.\n";
} else {
    echo "Pernikahan event type not found!\n";
}
