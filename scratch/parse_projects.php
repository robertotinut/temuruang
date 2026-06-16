<?php

$filePath = 'C:/Users/LENOVO/.gemini/antigravity-ide/brain/190fdde9-fadd-448e-a4cb-08dc8e84781a/.system_generated/steps/1322/output.txt';
if (!file_exists($filePath)) {
    die("File not found at $filePath\n");
}

$data = json_decode(file_get_contents($filePath), true);
if (!$data || !isset($data['projects'])) {
    die("Invalid JSON data or projects key not found\n");
}

echo "Found " . count($data['projects']) . " projects:\n\n";

foreach ($data['projects'] as $p) {
    $title = $p['title'] ?? 'No Title';
    $name = $p['name'] ?? 'No Name';
    $downloadUrl = $p['thumbnailScreenshot']['downloadUrl'] ?? 'No Screenshot';
    
    echo "Title: $title\n";
    echo "Name: $name\n";
    echo "Download URL: $downloadUrl\n";
    echo "--------------------------------------------------\n";
}
