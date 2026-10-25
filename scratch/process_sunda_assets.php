<?php
ini_set('memory_limit', '512M');

$brainDir = 'C:/Users/Bagaskara/.gemini/antigravity/brain/7c5b246e-e9ac-4c34-ae90-df0bd505121e';
$targetDir = __DIR__ . '/../public/assets/templates/wedding-34/ornaments';
$imagesDir = __DIR__ . '/../public/assets/templates/wedding-34/images';

if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
if (!file_exists($imagesDir)) mkdir($imagesDir, 0777, true);

// 1. Process Sunda Siger Crown -> Transparent PNG
$sigerRawPath = $brainDir . '/sunda_siger_gold_raw_1792933723361.jpg';
if (file_exists($sigerRawPath)) {
    echo "Processing Sunda Siger...\n";
    $src = imagecreatefromjpeg($sigerRawPath);
    $w = imagesx($src);
    $h = imagesy($src);

    $dst = imagecreatetruecolor($w, $h);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    $trans = imagecolorallocatealpha($dst, 0, 0, 0, 127);
    imagefilledrectangle($dst, 0, 0, $w, $h, $trans);

    // Flood fill from borders to clear black background
    $visited = array_fill(0, $h, array_fill(0, $w, false));
    $queue = [];

    // Enqueue 4 borders
    for ($x = 0; $x < $w; $x++) {
        $queue[] = [$x, 0];
        $queue[] = [$x, $h - 1];
        $visited[0][$x] = true;
        $visited[$h - 1][$x] = true;
    }
    for ($y = 0; $y < $h; $y++) {
        $queue[] = [0, $y];
        $queue[] = [$w - 1, $y];
        $visited[$y][0] = true;
        $visited[$y][$w - 1] = true;
    }

    $qHead = 0;
    while ($qHead < count($queue)) {
        [$cx, $cy] = $queue[$qHead++];
        $rgb = imagecolorat($src, $cx, $cy);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $bright = ($r * 299 + $g * 587 + $b * 114) / 1000;

        if ($bright < 35) {
            // It's background
            $neighbors = [
                [$cx + 1, $cy], [$cx - 1, $cy],
                [$cx, $cy + 1], [$cx, $cy - 1]
            ];
            foreach ($neighbors as [$nx, $ny]) {
                if ($nx >= 0 && $nx < $w && $ny >= 0 && $ny < $h && !$visited[$ny][$nx]) {
                    $visited[$ny][$nx] = true;
                    $queue[] = [$nx, $ny];
                }
            }
        }
    }

    // Now copy pixels: if visited and dark, transparent. Otherwise copy pixel.
    // Also anti-alias the transition edge!
    for ($y = 0; $y < $h; $y++) {
        for ($x = 0; $x < $w; $x++) {
            $rgb = imagecolorat($src, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $bright = ($r * 299 + $g * 587 + $b * 114) / 1000;

            if ($visited[$y][$x] && $bright < 20) {
                imagesetpixel($dst, $x, $y, $trans);
            } elseif ($visited[$y][$x] && $bright < 60) {
                // Edge feathering
                $alpha = (int)(127 * (1 - ($bright - 20) / 40));
                $col = imagecolorallocatealpha($dst, $r, $g, $b, max(0, min(127, $alpha)));
                imagesetpixel($dst, $x, $y, $col);
            } else {
                $col = imagecolorallocatealpha($dst, $r, $g, $b, 0);
                imagesetpixel($dst, $x, $y, $col);
            }
        }
    }

    imagepng($dst, $targetDir . '/sunda-siger-gold.png', 8);
    imagedestroy($dst);
    imagedestroy($src);
    echo "Saved: " . $targetDir . "/sunda-siger-gold.png\n";
}

// 2. Process Kujang Pasundan Crest -> Transparent PNG
$kujangRawPath = $brainDir . '/sunda_kujang_gold_raw_1792933739514.jpg';
if (file_exists($kujangRawPath)) {
    echo "Processing Kujang Pasundan...\n";
    $src = imagecreatefromjpeg($kujangRawPath);
    $w = imagesx($src);
    $h = imagesy($src);

    $dst = imagecreatetruecolor($w, $h);
    imagealphablending($dst, false);
    imagesavealpha($dst, true);
    $trans = imagecolorallocatealpha($dst, 0, 0, 0, 127);
    imagefilledrectangle($dst, 0, 0, $w, $h, $trans);

    $visited = array_fill(0, $h, array_fill(0, $w, false));
    $queue = [];

    for ($x = 0; $x < $w; $x++) {
        $queue[] = [$x, 0];
        $queue[] = [$x, $h - 1];
        $visited[0][$x] = true;
        $visited[$h - 1][$x] = true;
    }
    for ($y = 0; $y < $h; $y++) {
        $queue[] = [0, $y];
        $queue[] = [$w - 1, $y];
        $visited[$y][0] = true;
        $visited[$y][$w - 1] = true;
    }

    $qHead = 0;
    while ($qHead < count($queue)) {
        [$cx, $cy] = $queue[$qHead++];
        $rgb = imagecolorat($src, $cx, $cy);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $bright = ($r * 299 + $g * 587 + $b * 114) / 1000;

        if ($bright < 35) {
            $neighbors = [
                [$cx + 1, $cy], [$cx - 1, $cy],
                [$cx, $cy + 1], [$cx, $cy - 1]
            ];
            foreach ($neighbors as [$nx, $ny]) {
                if ($nx >= 0 && $nx < $w && $ny >= 0 && $ny < $h && !$visited[$ny][$nx]) {
                    $visited[$ny][$nx] = true;
                    $queue[] = [$nx, $ny];
                }
            }
        }
    }

    for ($y = 0; $y < $h; $y++) {
        for ($x = 0; $x < $w; $x++) {
            $rgb = imagecolorat($src, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $bright = ($r * 299 + $g * 587 + $b * 114) / 1000;

            if ($visited[$y][$x] && $bright < 20) {
                imagesetpixel($dst, $x, $y, $trans);
            } elseif ($visited[$y][$x] && $bright < 60) {
                $alpha = (int)(127 * (1 - ($bright - 20) / 40));
                $col = imagecolorallocatealpha($dst, $r, $g, $b, max(0, min(127, $alpha)));
                imagesetpixel($dst, $x, $y, $col);
            } else {
                $col = imagecolorallocatealpha($dst, $r, $g, $b, 0);
                imagesetpixel($dst, $x, $y, $col);
            }
        }
    }

    imagepng($dst, $targetDir . '/sunda-kujang-gold.png', 8);
    imagedestroy($dst);
    imagedestroy($src);
    echo "Saved: " . $targetDir . "/sunda-kujang-gold.png\n";
}

// 3. Process Wedding Couple Portrait & Crops
$coupleRawPath = $brainDir . '/sunda_couple_emerald_1792933758620.jpg';
if (file_exists($coupleRawPath)) {
    echo "Processing Sunda Couple portraits...\n";
    $src = imagecreatefromjpeg($coupleRawPath);
    $w = imagesx($src);
    $h = imagesy($src);

    // Save full couple photo
    imagejpeg($src, $imagesDir . '/sunda-couple-full.jpg', 92);

    // Crop Cover Arch Portrait (Top 70% centered on couple)
    $archCrop = imagecrop($src, ['x' => (int)($w * 0.1), 'y' => 0, 'width' => (int)($w * 0.8), 'height' => (int)($h * 0.85)]);
    if ($archCrop) {
        imagejpeg($archCrop, $imagesDir . '/sunda-couple-arch.jpg', 92);
        imagedestroy($archCrop);
    }

    // Crop Groom (Left side upper body)
    $groomCrop = imagecrop($src, [
        'x' => (int)($w * 0.22),
        'y' => (int)($h * 0.30),
        'width' => (int)($w * 0.36),
        'height' => (int)($w * 0.44)
    ]);
    if ($groomCrop) {
        imagejpeg($groomCrop, $imagesDir . '/sunda-groom.jpg', 92);
        imagedestroy($groomCrop);
    }

    // Crop Bride (Right side upper body)
    $brideCrop = imagecrop($src, [
        'x' => (int)($w * 0.46),
        'y' => (int)($h * 0.28),
        'width' => (int)($w * 0.36),
        'height' => (int)($w * 0.44)
    ]);
    if ($brideCrop) {
        imagejpeg($brideCrop, $imagesDir . '/sunda-bride.jpg', 92);
        imagedestroy($brideCrop);
    }

    imagedestroy($src);
    echo "Saved portraits in " . $imagesDir . "\n";
}

// 4. Create Jasmine Petal Particle PNG
$petW = 48;
$petH = 48;
$petal = imagecreatetruecolor($petW, $petH);
imagealphablending($petal, false);
imagesavealpha($petal, true);
$trans = imagecolorallocatealpha($petal, 0, 0, 0, 127);
imagefilledrectangle($petal, 0, 0, $petW, $petH, $trans);
imagealphablending($petal, true);

// Draw delicate white-ivory jasmine blossom with 5 oval petals
$white = imagecolorallocatealpha($petal, 255, 253, 248, 10);
$centerGold = imagecolorallocatealpha($petal, 226, 199, 138, 20);

for ($i = 0; $i < 5; $i++) {
    $angle = $i * (360 / 5) * (M_PI / 180);
    $px = 24 + cos($angle) * 11;
    $py = 24 + sin($angle) * 11;
    imagefilledellipse($petal, (int)$px, (int)$py, 14, 8, $white);
}
imagefilledellipse($petal, 24, 24, 8, 8, $centerGold);

imagepng($petal, $targetDir . '/jasmine-petal.png', 8);
imagedestroy($petal);
echo "Saved: " . $targetDir . "/jasmine-petal.png\n";

echo "All assets processed successfully!\n";
