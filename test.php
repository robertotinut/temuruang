<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(Illuminate\Http\Request::capture());
try {
    echo view('templates.wedding.wedding-11-no-php')->render();
} catch (\Throwable $e) {
    $prev = $e->getPrevious();
    if ($prev) {
        echo "\nREAL ERROR: " . $prev->getMessage() . " in " . $prev->getFile() . " on line " . $prev->getLine() . "\n";
    } else {
        echo "\nNO PREV ERROR: " . $e->getMessage() . "\n";
    }
}
