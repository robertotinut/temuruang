<?php
ini_set('memory_limit', '512M');
$path = __DIR__ . '/../public/assets/templates/wedding-34/ornaments/sunda-siger-gold.png';
$src = imagecreatefrompng($path);
$w = imagesx($src);
$h = imagesy($src);

$dst = imagecreatetruecolor($w, $h);
imagealphablending($dst, false);
imagesavealpha($dst, true);
$trans = imagecolorallocatealpha($dst, 0, 0, 0, 127);
imagefilledrectangle($dst, 0, 0, $w, $h, $trans);

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $rgba = imagecolorat($src, $x, $y);
        $a = ($rgba >> 24) & 0x7F;
        if ($a == 127) {
            imagesetpixel($dst, $x, $y, $trans);
            continue;
        }
        $r = ($rgba >> 16) & 0xFF;
        $g = ($rgba >> 8) & 0xFF;
        $b = $rgba & 0xFF;
        $bright = ($r * 299 + $g * 587 + $b * 114) / 1000;

        // If very dark, make transparent
        if ($bright < 22) {
            imagesetpixel($dst, $x, $y, $trans);
        } elseif ($bright < 45) {
            $alpha = (int)(127 * (1 - ($bright - 22) / 23));
            $col = imagecolorallocatealpha($dst, $r, $g, $b, max(0, min(127, $alpha)));
            imagesetpixel($dst, $x, $y, $col);
        } else {
            $col = imagecolorallocatealpha($dst, $r, $g, $b, $a);
            imagesetpixel($dst, $x, $y, $col);
        }
    }
}

imagepng($dst, $path, 8);
imagedestroy($dst);
imagedestroy($src);
echo "Siger refined successfully!\n";
