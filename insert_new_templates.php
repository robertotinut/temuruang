<?php
// Script to insert wedding 09, 10, 11, 12 to the database using PDO
$host = '127.0.0.1';
$db   = 'db_temuruang';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get event_type_id for Pernikahan
    $stmt = $pdo->prepare("SELECT id FROM event_types WHERE name = 'Pernikahan' LIMIT 1");
    $stmt->execute();
    $eventTypeId = $stmt->fetchColumn();

    if (!$eventTypeId) {
        $eventTypeId = 1; // Default
    }

    $templates = [
        [
            'name' => 'Wedding 09 (Traditional Javanese/Batik)',
            'slug' => 'wedding-09',
            'description' => 'Tema Adat Nusantara klasik dengan hiasan Batik dan Gunungan.',
            'thumbnail' => null,
            'is_premium' => true,
            'is_active' => true,
            'event_type_id' => $eventTypeId
        ],
        [
            'name' => 'Wedding 10 (Minimalist Monochrome)',
            'slug' => 'wedding-10',
            'description' => 'Tema brutalist estetik hanya hitam putih, tipografi raksasa ala majalah fesyen.',
            'thumbnail' => null,
            'is_premium' => true,
            'is_active' => true,
            'event_type_id' => $eventTypeId
        ],
        [
            'name' => 'Wedding 11 (Royal Navy Elegance)',
            'slug' => 'wedding-11',
            'description' => 'Sangat berkelas, nuansa biru tua dan perak dengan animasi kilauan cahaya bertaburan.',
            'thumbnail' => null,
            'is_premium' => true,
            'is_active' => true,
            'event_type_id' => $eventTypeId
        ],
        [
            'name' => 'Wedding 12 (Autumn Parallax)',
            'slug' => 'wedding-12',
            'description' => 'Hangat ala musim gugur dengan efek spesial daun berguguran dari atas layar.',
            'thumbnail' => null,
            'is_premium' => true,
            'is_active' => true,
            'event_type_id' => $eventTypeId
        ]
    ];

    foreach ($templates as $t) {
        // check if exists
        $check = $pdo->prepare("SELECT id FROM templates WHERE slug = ?");
        $check->execute([$t['slug']]);
        if (!$check->fetchColumn()) {
            $insert = $pdo->prepare("INSERT INTO templates (name, slug, description, thumbnail, is_premium, is_active, event_type_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
            $insert->execute([$t['name'], $t['slug'], $t['description'], $t['thumbnail'], $t['is_premium'] ? 1 : 0, $t['is_active'] ? 1 : 0, $t['event_type_id']]);
            echo "Inserted: " . $t['name'] . "\n";
        } else {
            echo "Already exists: " . $t['name'] . "\n";
        }
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
