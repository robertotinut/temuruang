<?php
$content = file_get_contents('d:/Project/temuruang/resources/views/templates/wedding/Untitled-8.html');
preg_match_all('/(?:themes|images)\/[^\'\"\s<>)]+/i', $content, $matches);
$paths = array_unique($matches[0]);
asort($paths);
foreach ($paths as $path) {
    echo $path . "\n";
}
?>
