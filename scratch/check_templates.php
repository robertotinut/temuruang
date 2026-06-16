<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;

$templates = Template::all();
foreach ($templates as $t) {
    echo "Slug: {$t->slug} | Name: {$t->name} | Thumbnail: {$t->thumbnail} | Category: {$t->theme_category}\n";
}
