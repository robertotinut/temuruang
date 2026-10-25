<?php

$srcFile = __DIR__ . '/../public/assets/templates/wedding-34/images/sunda-couple-full.jpg';
$outDir = __DIR__ . '/../public/assets/templates/wedding-34/images';

if (file_exists($srcFile)) {
    $src = imagecreatefromjpeg($srcFile);
    $w = imagesx($src);
    $h = imagesy($src);

    // Gallery 1: Full
    imagejpeg($src, $outDir . '/gallery-1.jpg', 90);

    // Gallery 2: Siger bride
    $c2 = imagecrop($src, ['x' => (int)($w * 0.44), 'y' => (int)($h * 0.28), 'width' => (int)($w * 0.45), 'height' => (int)($w * 0.45)]);
    if ($c2) { imagejpeg($c2, $outDir . '/gallery-2.jpg', 90); imagedestroy($c2); }

    // Gallery 3: Groom
    $c3 = imagecrop($src, ['x' => (int)($w * 0.18), 'y' => (int)($h * 0.30), 'width' => (int)($w * 0.45), 'height' => (int)($w * 0.45)]);
    if ($c3) { imagejpeg($c3, $outDir . '/gallery-3.jpg', 90); imagedestroy($c3); }

    // Gallery 4: Couple upper half
    $c4 = imagecrop($src, ['x' => (int)($w * 0.15), 'y' => (int)($h * 0.26), 'width' => (int)($w * 0.70), 'height' => (int)($w * 0.60)]);
    if ($c4) { imagejpeg($c4, $outDir . '/gallery-4.jpg', 90); imagedestroy($c4); }

    // Gallery 5: Holding hands & bouquet
    $c5 = imagecrop($src, ['x' => (int)($w * 0.35), 'y' => (int)($h * 0.45), 'width' => (int)($w * 0.40), 'height' => (int)($w * 0.40)]);
    if ($c5) { imagejpeg($c5, $outDir . '/gallery-5.jpg', 90); imagedestroy($c5); }

    // Gallery 6: Glasshouse greenhouse ceiling & orchids
    $c6 = imagecrop($src, ['x' => (int)($w * 0.10), 'y' => 0, 'width' => (int)($w * 0.80), 'height' => (int)($h * 0.35)]);
    if ($c6) { imagejpeg($c6, $outDir . '/gallery-6.jpg', 90); imagedestroy($c6); }

    imagedestroy($src);
    echo "Created gallery-1 to 6\n";
}
