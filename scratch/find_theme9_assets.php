<?php
$content = file_get_contents('d:/Project/temuruang/resources/views/templates/wedding/Untitled-9.html');
preg_match_all('/https?:\/\/[^\'\"\s<>()]+/i', $content, $matches);
$urls = array_unique($matches[0]);
sort($urls);

echo "=== ALL EXTERNAL URLs (" . count($urls) . " unique) ===\n\n";

$categories = [
    'indoinvite.com images/assets' => [],
    'media.indoinvite.com' => [],
    'Google Fonts' => [],
    'CDN/External libs' => [],
    'YouTube' => [],
    'Maps' => [],
    'Other' => [],
];

foreach ($urls as $url) {
    if (strpos($url, 'media.indoinvite.com') !== false) {
        $categories['media.indoinvite.com'][] = $url;
    } elseif (strpos($url, 'fonts.googleapis.com') !== false || strpos($url, 'fonts.gstatic.com') !== false || strpos($url, 'fonts.cdnfonts.com') !== false) {
        $categories['Google Fonts'][] = $url;
    } elseif (preg_match('/indoinvite\.com.*(\.jpg|\.jpeg|\.png|\.gif|\.svg|\.webp|\.mp3|\.mp4|\.ico)/i', $url)) {
        $categories['indoinvite.com images/assets'][] = $url;
    } elseif (strpos($url, 'indoinvite.com') !== false) {
        $categories['CDN/External libs'][] = $url;
    } elseif (strpos($url, 'youtube') !== false || strpos($url, 'youtu.be') !== false) {
        $categories['YouTube'][] = $url;
    } elseif (strpos($url, 'maps.google') !== false || strpos($url, 'google.com/maps') !== false) {
        $categories['Maps'][] = $url;
    } else {
        $categories['Other'][] = $url;
    }
}

foreach ($categories as $cat => $catUrls) {
    if (count($catUrls) > 0) {
        echo "--- $cat (" . count($catUrls) . ") ---\n";
        foreach ($catUrls as $u) {
            echo "  $u\n";
        }
        echo "\n";
    }
}
?>
