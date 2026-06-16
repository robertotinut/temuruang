<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;
use Illuminate\Support\Facades\Storage;

$fallbacks = [
    'wedding-03' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=400', // Modern minimal
    'wedding-04' => 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=400', // Rustic forest
    'wedding-05' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=400', // Botanical bouquet
    'wedding-06' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400', // Editorial grid
    'wedding-07' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400', // Classic premium
    'wedding-08' => 'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?q=80&w=400', // Minimal bride/groom details
    'wedding-10' => 'https://images.unsplash.com/photo-1546842931-886c185b4c8c?q=80&w=400', // Monochrome/Watercolor
    'wedding-12' => 'https://images.unsplash.com/photo-1509924603848-0c648cfc03b5?q=80&w=400', // Autumn parallax
    'wedding-19' => 'https://images.unsplash.com/photo-1523438885200-e635ba2c371e?q=80&w=400', // Elegant dress detail
    'wedding-20' => 'https://images.unsplash.com/photo-1519225495810-7512c696505a?q=80&w=400', // Elegant table setting
    'wedding-28' => 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?q=80&w=400', // Emerald and gold
    'birthday-01' => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=400', // Colorful balloons
    'seminar-01' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=400', // Corporate tech seminar
    'reuni-01' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=400', // Nostalgia reunion
    'wisuda-01' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=400', // Graduation gold
];

$dir = storage_path('app/public/templates/thumbnails');
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

foreach ($fallbacks as $slug => $url) {
    $template = Template::where('slug', $slug)->first();
    if (!$template) {
        echo "Template $slug not found in database.\n";
        continue;
    }

    $extension = 'jpg';
    $filename = "{$slug}.{$extension}";
    $path = "{$dir}/{$filename}";

    echo "Downloading fallback thumbnail for {$slug}...\n";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    $data = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo "Error downloading for {$slug}: " . curl_error($ch) . "\n";
    } else {
        file_put_contents($path, $data);
        $dbPath = "templates/thumbnails/{$filename}";
        $template->thumbnail = $dbPath;
        $template->save();
        echo "Saved to $path and updated DB for {$slug} (" . strlen($data) . " bytes)\n";
    }
    curl_close($ch);
}

echo "All fallback thumbnails updated successfully.\n";
