<?php
$images = [
    'bg-section.jpg' => 'https://assets.satumomen.com/images/invitation/bg-section-28134081708790756.jpg',
    'cover_custom.jpg' => 'https://assets.satumomen.com/images/galleries/244875-gallery-TJgT6OTZaZ.jpg',
    'groom_custom.jpg' => 'https://assets.satumomen.com/images/galleries/244875-gallery-t0VEMgVuSk.jpg',
    'bride_custom.jpg' => 'https://assets.satumomen.com/images/galleries/244875-gallery-m2rYx7KbWA.jpg',
    'gallery_1.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902522.jpg',
    'gallery_2.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902529.jpg',
    'gallery_3.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902534.jpg',
    'gallery_4.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1697018895.jpg',
    'gallery_5.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693900773.jpg',
    'gallery_6.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902840.jpg',
    'gallery_7.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693901608.jpg',
    'gallery_8.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902710.jpg',
    'gallery_9.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902647.jpg',
    'gallery_10.jpg' => 'https://assets.satumomen.com/images/galleries/147961-gallery-1693902643.jpg'
];

$themeDir = 'public/themes/chinese-wedding';
if (!is_dir($themeDir)) {
    mkdir($themeDir, 0777, true);
}

echo "Downloading Chinese Wedding theme assets...\n";
foreach ($images as $filename => $url) {
    $targetPath = $themeDir . '/' . $filename;
    
    $cmd = 'curl.exe -s -H "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" -L "' . $url . '" -o "' . $targetPath . '"';
    
    exec($cmd, $output, $returnVar);
    if ($returnVar === 0 && file_exists($targetPath) && filesize($targetPath) > 0) {
        echo "Downloaded: $filename (Size: " . filesize($targetPath) . " bytes)\n";
    } else {
        echo "FAILED: $filename (Return code: $returnVar)\n";
    }
}
?>
