<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Package;
use Illuminate\Support\Facades\Schema;

$columns = Schema::getColumnListing('packages');
echo "Columns in packages: " . implode(', ', $columns) . "\n\n";

$packages = Package::all();
foreach ($packages as $p) {
    echo "ID: {$p->id} | Name: {$p->name} | Price: {$p->price} | Duration Days: {$p->duration_days} | Max Guest: {$p->max_guest} | Max Gallery: {$p->max_gallery} | Max Template: {$p->max_template}\n";
}
