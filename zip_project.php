<?php
$source = "d:/Project/temuruang";
$destination = "d:/Project/temuruang/temuruang_deploy.zip";

$zip = new ZipArchive();
if ($zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    die("Failed to create zip");
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$exclude_dirs = ['vendor', 'node_modules', '.git', '.idea'];

foreach ($iterator as $file) {
    $path = $file->getRealPath();
    // Calculate relative path
    $relativePath = substr($path, strlen($source) + 1);
    
    $exclude = false;
    foreach ($exclude_dirs as $ed) {
        if (strpos($relativePath, $ed . DIRECTORY_SEPARATOR) === 0 || $relativePath === $ed) {
            $exclude = true;
            break;
        }
    }
    
    if ($exclude) continue;

    if ($file->isDir()) {
        $zip->addEmptyDir($relativePath);
    } else {
        $zip->addFile($path, $relativePath);
    }
}

$zip->close();
rename($destination, "d:/Project/temuruang/temuruang.zip");
echo "Zipped successfully to temuruang.zip\n";
?>
