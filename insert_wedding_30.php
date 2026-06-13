<?php
// Script to insert wedding 30 to the database
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
        $eventTypeId = 1;
    }

    $t = [
        'name' => 'Wedding 30 (Chic Noir & Interactive Envelope)',
        'slug' => 'wedding-30',
        'description' => 'Tema retro modern dengan kontras tinggi hitam-putih, aksen garis-garis piano, foto polaroid estetik, dan pembuka undangan interaktif berupa amplop surat 3D.',
        'thumbnail' => null,
        'is_premium' => true,
        'is_active' => true,
        'event_type_id' => $eventTypeId
    ];

    // check if exists
    $check = $pdo->prepare("SELECT id FROM templates WHERE slug = ?");
    $check->execute([$t['slug']]);
    if (!$check->fetchColumn()) {
        $insert = $pdo->prepare("INSERT INTO templates (name, slug, description, thumbnail, is_premium, is_active, event_type_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $insert->execute([$t['name'], $t['slug'], $t['description'], $t['thumbnail'], $t['is_premium'] ? 1 : 0, $t['is_active'] ? 1 : 0, $t['event_type_id']]);
        echo "Successfully Inserted: " . $t['name'] . "\n";
    } else {
        // Update it
        $update = $pdo->prepare("UPDATE templates SET name = ?, description = ? WHERE slug = ?");
        $update->execute([$t['name'], $t['description'], $t['slug']]);
        echo "Updated: " . $t['name'] . "\n";
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
