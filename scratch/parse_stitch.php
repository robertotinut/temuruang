<?php

$file = __DIR__ . '/../C:/Users/LENOVO/.gemini/antigravity-ide/brain/190fdde9-fadd-448e-a4cb-08dc8e84781a/.system_generated/steps/1263/output.txt';
if (!file_exists($file)) {
    // try absolute
    $file = 'C:/Users/LENOVO/.gemini/antigravity-ide/brain/190fdde9-fadd-448e-a4cb-08dc8e84781a/.system_generated/steps/1263/output.txt';
}

if (!file_exists($file)) {
    die("File not found: $file\n");
}

$data = json_decode(file_get_contents($file), true);
if (!$data || !isset($data['projects'])) {
    die("Invalid JSON data\n");
}

foreach ($data['projects'] as $p) {
    echo "========================================\n";
    echo "PROJECT: {$p['title']} ({$p['name']})\n";
    if (isset($p['thumbnailScreenshot'])) {
        echo "  Project Thumbnail: {$p['thumbnailScreenshot']['downloadUrl']}\n";
    }
    if (isset($p['screenInstances'])) {
        foreach ($p['screenInstances'] as $s) {
            if (isset($s['sourceScreen'])) {
                echo "  Screen Instance: {$s['id']} | Source: {$s['sourceScreen']}\n";
            }
        }
    }
}
