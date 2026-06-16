<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$mapping = [
    'Tradisional (Jawa, Sunda, dll)' => [
        'wedding-09', // Traditional Javanese/Batik
        'wedding-11', // Blue Rustic Premium / edited to Vintage Jawa 03
        'wedding-12', // Javanese Heritage
        'wedding-13', // Sundanese Wedding
        'wedding-14', // Sundanese Wedding
        'wedding-15', // Sundanese Maroon Gen Z
        'wedding-31', // Javanese themed
    ],
    'Modern & Elegan' => [
        'wedding-03', // Modern Minimalist Capsule
        'wedding-05', // Botanical Watercolor
        'wedding-07', // Classic Premium Card
        'wedding-16', // Modern Elegan - Arthur & Josephine
        'wedding-17', // Elegant Blue Floral - Adrian & Seraphina
        'wedding-18', // Global Royal Wedding - Arthur & Eleanor
        'wedding-19', // Royal Wedding - Textured Background Version
        'wedding-20', // Royal Navy & Gold Wedding Invitation
        'wedding-22', // Emerald Festive Wedding Design
        'wedding-23', 
        'wedding-24',
        'wedding-25',
    ],
    'Minimalis & Klasik' => [
        'wedding-10', // Minimalist Monochrome
    ],
    'Rustic & Nature' => [
        'wedding-04', // Full-Screen Snap-Scroll
        'wedding-08', // Modern Minimalist Capsule
    ],
    'Vintage & Retro' => [
        'wedding-01', // Grand Emerald Vintage
        'wedding-02', // Festive Emerald Vintage
        'wedding-30', // Grand Vintage Maroon
    ],
    'Religi / Islami' => [
        // Islamic Elegance moved
    ],
    'Unik & Kreatif' => [
        'wedding-06', // Asymmetric Editorial Grid / Ultra Modern Dark Gold
        'wedding-21', // Undangan Pernikahan Royal Maroon Gala
        'wedding-26', // Asymmetric Editorial Grid
        'wedding-27', // Festive Greenery Wedding System
        'wedding-28', // Royal Emerald & Golden Glassmorphic
        'wedding-29', // Emerald Festive Wedding System
    ],
];

echo "Starting templates reclassification...\n";

$updatedCount = 0;
foreach ($mapping as $category => $slugs) {
    foreach ($slugs as $slug) {
        $template = Template::where('slug', $slug)->first();
        if ($template) {
            $template->theme_category = $category;
            $template->save();
            echo "Updated {$slug} to '{$category}'\n";
            $updatedCount++;
        } else {
            echo "Warning: Template with slug {$slug} not found.\n";
        }
    }
}

// Any other wedding template not in the list should default to 'Modern & Elegan'
$otherWeddingTemplates = Template::where('slug', 'like', 'wedding-%')
    ->whereNotIn('slug', array_merge(...array_values($mapping)))
    ->get();

foreach ($otherWeddingTemplates as $template) {
    $template->theme_category = 'Modern & Elegan';
    $template->save();
    echo "Defaulted {$template->slug} to 'Modern & Elegan'\n";
    $updatedCount++;
}

echo "Successfully reclassified {$updatedCount} templates.\n";
