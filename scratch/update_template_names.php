<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$updates = [
    'wedding-03' => 'Modern Minimalist Capsule',
    'wedding-04' => 'Full-Screen Snap-Scroll',
    'wedding-05' => 'Botanical Watercolor',
    'wedding-06' => 'Asymmetric Editorial Grid',
    'wedding-07' => 'Classic Premium Card',
    'wedding-08' => 'Modern Minimalist Capsule',
    'wedding-09' => 'Traditional Javanese Batik',
    'wedding-10' => 'Minimalist Monochrome',
    'wedding-11' => 'Royal Navy Elegance',
    'wedding-12' => 'Autumn Parallax',
    'wedding-13' => 'Sunda Classic - Siti & Asep',
    'wedding-14' => 'Sunda Elegant - Sakti & Asri',
    'wedding-15' => 'Sunda Maroon - Arjuna & Srikandi',
    'wedding-16' => 'Modern Elegan - Arthur & Josephine',
    'wedding-17' => 'Modern Elegan - Adrian & Seraphina',
    'wedding-18' => 'Modern Elegan - Arthur & Eleanor',
    'wedding-19' => 'Modern Elegan - Adrian & Julia',
    'wedding-20' => 'Modern Elegan - Julian & Aria',
    'wedding-24' => 'Grand Maroon Wedding Design',
    'wedding-30' => 'Grand Vintage Maroon Wedding', // Distinguishing from wedding-24
];

foreach ($updates as $slug => $newName) {
    $template = Template::where('slug', $slug)->first();
    if ($template) {
        $oldName = $template->name;
        $template->name = $newName;
        $template->save();
        echo "Updated $slug: '$oldName' -> '$newName'\n";
    } else {
        echo "Template $slug not found.\n";
    }
}

echo "Template names update completed successfully.\n";
