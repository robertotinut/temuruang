<?php
$et = \App\Models\EventType::firstOrCreate(['name' => 'Pernikahan'], ['description' => 'Kategori untuk undangan pernikahan', 'is_active' => true]);
\App\Models\Template::whereIn('slug', ['wedding-01', 'wedding-02'])->update(['event_type_id' => $et->id]);
\App\Models\Template::whereNotIn('slug', ['wedding-01', 'wedding-02'])->delete();
echo "Data cleanup done.\n";
