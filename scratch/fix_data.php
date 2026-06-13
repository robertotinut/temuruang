<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$invitation = \App\Models\Invitation::find(1);
if ($invitation) {
    $invitation->custom_view_path = 'customer-01';
    $invitation->save();
    echo "Fixed data for invitation 1\n";
} else {
    echo "Invitation 1 not found\n";
}
