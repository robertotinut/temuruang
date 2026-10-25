<?php
ini_set('memory_limit', '512M');

$brainDir = 'C:/Users/Bagaskara/.gemini/antigravity/brain/7c5b246e-e9ac-4c34-ae90-df0bd505121e';
$targetDir = __DIR__ . '/../public/assets/templates/wedding-01/ornaments';

$towerRaw = $brainDir . '/luxury_dutch_windmill_tower_raw_jpg_1792930909899.jpg';
$tImg = imagecreatefromjpeg($towerRaw);
$tw = imagesx($tImg);
$th = imagesy($tImg);

$tOut = imagecreatetruecolor($tw, $th);
imagealphablending($tOut, false);
imagesavealpha($tOut, true);
$transparent = imagecolorallocatealpha($tOut, 0, 0, 0, 127);
imagefilledrectangle($tOut, 0, 0, $tw, $th, $transparent);

// Flood-fill from outer edges to find only the black background outside the tower
$visited = array_fill(0, $tw * $th, 0);
$queue = [];

for ($x = 0; $x < $tw; $x++) {
    $queue[] = [$x, 0];
    $queue[] = [$x, $th - 1];
    $visited[0 * $tw + $x] = 1;
    $visited[($th - 1) * $tw + $x] = 1;
}
for ($y = 0; $y < $th; $y++) {
    $queue[] = [0, $y];
    $queue[] = [$tw - 1, $y];
    $visited[$y * $tw + 0] = 1;
    $visited[$y * $tw + ($tw - 1)] = 1;
}

$head = 0;
while ($head < count($queue)) {
    [$cx, $cy] = $queue[$head++];
    $neighbors = [
        [$cx + 1, $cy], [$cx - 1, $cy],
        [$cx, $cy + 1], [$cx, $cy - 1]
    ];
    foreach ($neighbors as [$nx, $ny]) {
        if ($nx >= 0 && $nx < $tw && $ny >= 0 && $ny < $th) {
            $idx = $ny * $tw + $nx;
            if ($visited[$idx] === 0) {
                $rgb = imagecolorat($tImg, $nx, $ny);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $brightness = max($r, max($g, $b));
                // Background is pitch black < 18
                if ($brightness <= 18) {
                    $visited[$idx] = 1;
                    $queue[] = [$nx, $ny];
                }
            }
        }
    }
}

// Render: only visited pixels are transparent
for ($y = 0; $y < $th; $y++) {
    for ($x = 0; $x < $tw; $x++) {
        $idx = $y * $tw + $x;
        if ($visited[$idx] === 1) {
            imagesetpixel($tOut, $x, $y, $transparent);
        } else {
            $rgb = imagecolorat($tImg, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            
            // Antialias edge
            $isEdge = false;
            for ($dy = -1; $dy <= 1; $dy++) {
                for ($dx = -1; $dx <= 1; $dx++) {
                    $ex = $x + $dx; $ey = $y + $dy;
                    if ($ex >= 0 && $ex < $tw && $ey >= 0 && $ey < $th && $visited[$ey * $tw + $ex] === 1) {
                        $isEdge = true;
                        break 2;
                    }
                }
            }
            if ($isEdge) {
                $val = max($r, max($g, $b));
                $alpha = (int)(127 * (1.0 - min(1.0, $val / 50.0)));
                imagesetpixel($tOut, $x, $y, imagecolorallocatealpha($tOut, $r, $g, $b, $alpha));
            } else {
                imagesetpixel($tOut, $x, $y, imagecolorallocatealpha($tOut, $r, $g, $b, 0));
            }
        }
    }
}

imagepng($tOut, $targetDir . '/windmill-tower.png', 9);
imagedestroy($tImg);
imagedestroy($tOut);
echo "Perfect windmill tower saved!\n";
