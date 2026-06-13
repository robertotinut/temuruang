<?php
$host = '127.0.0.1';
$db   = 'db_temuruang';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $categories = [
        'Classic & Minimalist' => ['wedding-01', 'wedding-02', 'wedding-10'],
        'Modern & Unique'      => ['wedding-03', 'wedding-13'],
        'Rustic & Nature'      => ['wedding-04', 'wedding-08', 'wedding-12'],
        'Soft & Elegant'       => ['wedding-05', 'wedding-07', 'wedding-11', 'wedding-15'],
        'Cultural & Religious' => ['wedding-09', 'wedding-16'],
        'Vintage & Retro'      => ['wedding-14'],
        'Uncategorized'        => ['wedding-06'] // wait, 06 is Ultra Modern Dark Gold. I'll put it in Modern & Unique.
    ];
    $categories['Modern & Unique'][] = 'wedding-06';

    foreach ($categories as $cat => $slugs) {
        $inQuery = implode(',', array_fill(0, count($slugs), '?'));
        $stmt = $pdo->prepare("UPDATE templates SET theme_category = ? WHERE slug IN ($inQuery)");
        $params = array_merge([$cat], $slugs);
        $stmt->execute($params);
    }
    
    // For 13 to 16, they might not be inserted yet if I haven't run the insert script for them!
    // Let me also make sure 13, 14, 15, 16 are actually in the DB.
    $templates = [
        [
            'name' => 'Wedding 13 (Neon Cyberpunk)',
            'slug' => 'wedding-13',
            'description' => 'Tema hacker/gamer dengan glitch effect dan warna neon.',
            'is_premium' => 1,
            'event_type_id' => 1,
            'theme_category' => 'Modern & Unique'
        ],
        [
            'name' => 'Wedding 14 (Vintage Newspaper)',
            'slug' => 'wedding-14',
            'description' => 'Tema koran klasik tahun 1920-an warna sepia.',
            'is_premium' => 1,
            'event_type_id' => 1,
            'theme_category' => 'Vintage & Retro'
        ],
        [
            'name' => 'Wedding 15 (Ethereal Clouds)',
            'slug' => 'wedding-15',
            'description' => 'Nuansa surgawi dengan awan yang bergerak halus.',
            'is_premium' => 1,
            'event_type_id' => 1,
            'theme_category' => 'Soft & Elegant'
        ],
        [
            'name' => 'Wedding 16 (Islamic Elegance)',
            'slug' => 'wedding-16',
            'description' => 'Tema hijau zamrud dan emas dengan ornamen Arabesque.',
            'is_premium' => 1,
            'event_type_id' => 1,
            'theme_category' => 'Cultural & Religious'
        ]
    ];

    foreach ($templates as $t) {
        $check = $pdo->prepare("SELECT id FROM templates WHERE slug = ?");
        $check->execute([$t['slug']]);
        if (!$check->fetchColumn()) {
            $insert = $pdo->prepare("INSERT INTO templates (name, slug, description, is_premium, is_active, event_type_id, theme_category, created_at, updated_at) VALUES (?, ?, ?, ?, 1, ?, ?, NOW(), NOW())");
            $insert->execute([$t['name'], $t['slug'], $t['description'], $t['is_premium'], $t['event_type_id'], $t['theme_category']]);
            echo "Inserted: " . $t['name'] . "\n";
        }
    }
    
    echo "Categories updated.\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
