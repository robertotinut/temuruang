<?php
$assets = [
    'public/themes/boho-wedding/frame-bl.png' => 'https://satumomen.com/themes/boho-wedding/frame-bl.png',
    'public/themes/boho-wedding/frame-tr.png' => 'https://satumomen.com/themes/boho-wedding/frame-tr.png',
    'public/themes/boho-wedding/boho-wedding.jpg' => 'https://satumomen.com/themes/boho-wedding/boho-wedding.jpg',
    'public/themes/boho-wedding/couple-main.webp' => 'https://assets.satumomen.com/images/galleries/143221-gallery-1693586643.webp',
    'public/themes/boho-wedding/couple-secondary.jpg' => 'https://assets.satumomen.com/images/invitation/secondary_image-1432211693586982.jpg',
    'public/musics/boho-wedding-bg.mp3' => 'https://assets.satumomen.com/musics/every-day-i-love-you-boyzone-piano-cover-by-riyandi-kusuma.mp3'
];

$themeDir = 'public/themes/boho-wedding';
if (!is_dir($themeDir)) {
    mkdir($themeDir, 0777, true);
}

echo "Downloading Boho Wedding theme assets...\n";
foreach ($assets as $targetPath => $url) {
    $dir = dirname($targetPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    $cmd = 'curl.exe -s -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" -L "' . $url . '" -o "' . $targetPath . '"';
    
    exec($cmd, $output, $returnVar);
    if ($returnVar === 0 && file_exists($targetPath) && filesize($targetPath) > 0) {
        echo "Downloaded: " . basename($targetPath) . " (Size: " . filesize($targetPath) . " bytes)\n";
    } else {
        echo "FAILED: " . basename($targetPath) . " (Return code: $returnVar)\n";
    }
}
?>
