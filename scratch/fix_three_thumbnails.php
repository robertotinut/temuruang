<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$dir = storage_path('app/public/templates/thumbnails');

$fixList = [
    'wedding-12' => [
        'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=400', // Modern wedding (known working)
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
    ],
    'wedding-20' => [
        'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400', // Editorial wedding (known working)
        'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?q=80&w=400',
    ],
    'wisuda-01' => [
        'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=400', // Graduation cap (famous working)
        'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=400',
    ]
];

foreach ($fixList as $slug => $urls) {
    $template = Template::where('slug', $slug)->first();
    if (!$template) {
        echo "Template $slug not found in DB.\n";
        continue;
    }

    $success = false;
    foreach ($urls as $url) {
        echo "Attempting to download for $slug from: $url\n";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200 && strlen($data) > 1000) {
            $filename = "{$slug}.jpg";
            $path = "{$dir}/{$filename}";
            file_put_contents($path, $data);
            
            $dbPath = "templates/thumbnails/{$filename}";
            $template->thumbnail = $dbPath;
            $template->save();
            
            echo "Successfully saved thumbnail for $slug (" . strlen($data) . " bytes)\n";
            $success = true;
            break;
        } else {
            echo "Failed with HTTP code $httpCode, length " . strlen($data) . "\n";
        }
    }

    if (!$success) {
        echo "Could not download a valid thumbnail for $slug.\n";
    }
}
