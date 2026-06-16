<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;
use Illuminate\Support\Facades\Storage;

$thumbnails = [
    'wedding-01' => 'https://lh3.googleusercontent.com/aida/AP1WRLtynh46buXmtuTQkUA-um9C5VdBW2QRTEw2cI6wfFfXtmQl7kwUnNej14Jxfe6OiI5sg5ARO3Lw5XAuJhbQBvzoYTUuEEaEovND0V0C-lUs-40Bav-KAXWGuJ9nqC9t05k-3p4FQkSqH4u8FdI_l-bcHZF7cYil1GYGbtyG_0gVIyIWu-dXaJN4NddIMDBqiWQrXRpToODTP03y5cvs9ZQE6eXYGHHJ9Jw5qvlDTKU0PnO15LdiB99pNew',
    'wedding-02' => 'https://lh3.googleusercontent.com/aida/AP1WRLv_6NPRxnOaT8kE1DQ0yhS1GXK_gvHYXwVPPjJ4nNc_EOV3Vl3xMljw9l_sjtecNC-35jJoxacQROYhD6FEoFbKgI55UoAfuo7xeeyIABZ4M_3awdwY2qxqhXXQ88slaQIrM8ry3PKSrTMHyQ3x89o8CQxYaVtSgSWcCAQJ_0Ndm4OlKNOjHv0Jif-8DWxJG_YkQZZTz8wEaregZevyK8cI4wagXFb42Dik4vmYBg2fmiAoRdg4tLZVvXI',
    'wedding-26' => 'https://lh3.googleusercontent.com/aida/AP1WRLs9cK4lktY0CuPeF5BwNTg0z3j3L3SYhIlaa-i-l5cSQuMKCl5obx78ZxPeDFV89YdQ9RHNIR01QIA3Z7ginpoa6qQW9l0KaqUASN3yGZ-7TPELkX5Y0WHS6gGMFjWIH6qOzOQZyVaUi2_I0Nj_yilMFB04qHUrrqCyKZ821sB-151EDWmXIam75o771bP9R7wjOBsRea8NOGud5DKVntwaSMDytzJp_jb6sCaVI_YFSwsx7UR_icqNRw',
    'wedding-29' => 'https://lh3.googleusercontent.com/aida/AP1WRLutqFs6abmRJLrFbg_TuDr0HwhqKM3X3CMaf4SeLa0CG1wZMuzdGXNXe1_cBFRBq2XjHRqgvjn13sL9Gut-75c73m7s1w9iOdkrXs5fcFF0Ot01AD4NueELKDxUUqMcZECDfTpXzCyNEKyAYHIQ3Iry34amSB9EZRQtS4Kr1xyous9zEArbQXYUYHyLLhQzYc0grHAzlueU6FEQlXCXB9L6Gz3wtD-XBpbMswL8iEdMjfls0Ojn-ZzAqg8T',
    'wedding-30' => 'https://lh3.googleusercontent.com/aida/AP1WRLttwUWC8ufZGjMIbieIE0VDsD8yQIgCoY8izHNR0soNuN6yXorsvTLiFh7sHmCEh3u7YNrhknYygQ5ExQnyKP6v5dSV-XRcSBCqlYSgC1zgApCbtvWmyYkkBVWPx4v1qZOr7jWz6UhMVaUJ-eLdNcPcPQbN_Um-IP3ZYu0zZRuowTecmem4mJa_c5kF8RvPL0TUhojdCgDyNnc92_25eQAWU1yGbf-R9jwMwL8d581cCs0ovqg1XSWWhZI',
];

$dir = storage_path('app/public/templates/thumbnails');
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "Created directory: $dir\n";
}

// Ensure the storage symlink exists
$link = public_path('storage');
if (!file_exists($link)) {
    echo "Symlink public/storage does not exist, attempting to create...\n";
    try {
        Artisan::call('storage:link');
        echo "Artisan storage:link output: " . Artisan::output() . "\n";
    } catch (\Exception $e) {
        echo "Failed to create symlink: " . $e->getMessage() . "\n";
    }
}

foreach ($thumbnails as $slug => $url) {
    $template = Template::where('slug', $slug)->first();
    if (!$template) {
        echo "Template $slug not found in database.\n";
        continue;
    }

    $filename = "{$slug}.jpg";
    $path = "{$dir}/{$filename}";

    echo "Downloading thumbnail for {$slug}...\n";
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

echo "Thumbnail set completed.\n";
