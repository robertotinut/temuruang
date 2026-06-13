<?php
$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::firstOrCreate(
        ['slug' => 'wedding-23'],
        [
            'event_type_id' => $et->id,
            'name' => 'Wedding 23 (iPhone Mockup)',
            'description' => 'Template dengan overlay frame iPhone 13 Pro',
            'is_premium' => true,
            'is_active' => true
        ]
    );
    echo "wedding-23 template added to database.\n";
} else {
    echo "Pernikahan event type not found!\n";
}
