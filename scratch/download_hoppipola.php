<?php
$baseUrl = 'https://satumomen.com/fonts/hoppipola/';
$files = [
    'fonts.css',
    'hoppipola-regular-400.woff2',
    'hoppipola-regular-400.woff',
    'hoppipola-regular-400.ttf',
    'hoppipola-regular-400.eot',
    'hoppipola-regular-400.svg'
];

$fontDir = 'public/fonts/hoppipola';
if (!is_dir($fontDir)) {
    mkdir($fontDir, 0777, true);
}

echo "Downloading Hoppipola font files...\n";
foreach ($files as $file) {
    $url = $baseUrl . $file;
    $targetPath = $fontDir . '/' . $file;
    
    $cmd = 'curl.exe -s -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" -L "' . $url . '" -o "' . $targetPath . '"';
    
    exec($cmd, $output, $returnVar);
    if ($returnVar === 0 && file_exists($targetPath) && filesize($targetPath) > 0) {
        echo "Downloaded: $file (Size: " . filesize($targetPath) . " bytes)\n";
    } else {
        echo "FAILED: $file (Return code: $returnVar)\n";
    }
}
?>
