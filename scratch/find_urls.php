<?php
$content = file_get_contents('d:/Project/temuruang/resources/views/templates/wedding/Untitled-8.html');
preg_match_all('/https?:\/\/[^\'\"\s<>]+/i', $content, $matches);
$urls = array_unique($matches[0]);
asort($urls);
foreach ($urls as $url) {
    echo $url . "\n";
}
?>
