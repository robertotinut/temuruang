<?php
$content = file_get_contents('d:/Project/temuruang/download version/index.html');
$content = preg_replace('/(href|src)="assets\/([^"]+)"/', '$1="{{ asset(\'assets_landingpage/$2\') }}"', $content);
$content = preg_replace('/(data-bg-src)="assets\/([^"]+)"/', '$1="{{ asset(\'assets_landingpage/$2\') }}"', $content);
file_put_contents('d:/Project/temuruang/resources/views/welcome.blade.php', $content);
echo "Done";
