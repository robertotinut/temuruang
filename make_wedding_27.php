<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 27 | Vintage Hexagon (Indoinvite Style)</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/photograph-signature" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-1: #fdf9f6;
            --bg-2: #B3A99C;
            --bg-3: #e1d6c7;
            --accent: #928573;
            --text-dark: #303333;
            --font-sig: 'Photograph Signature', sans-serif;
            --font-head: 'Averia Serif Libre', cursive;
            --font-body: 'Playfair Display', serif;
        }

        body {
            margin: 0; padding: 0;
            font-family: var(--font-body);
            color: var(--text-dark);
            background: #222;
        }

        .container-mobile {
            max-width: 480px;
            margin: 0 auto;
            background: var(--bg-1);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
            overflow: hidden;
        }

        h1, h2 { font-family: var(--font-sig); font-weight: normal; color: var(--accent); }
        h3, h4 { font-family: var(--font-head); color: var(--accent); }

        /* Cover */
        .cover {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800&auto=format&fit=crop') center/cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            z-index: 10;
        }
        .cover h3 { color: white; font-size: 1.2rem; letter-spacing: 2px; margin-bottom: 20px; }
        .cover h1 { color: white; font-size: 4rem; line-height: 1; margin: 10px 0; }

        /* Sections */
        .section-1 { background-color: var(--bg-1); padding: 60px 20px; text-align: center; }
        .section-2 { background-color: var(--bg-2); padding: 60px 20px; text-align: center; color: white; }
        .section-3 { background-color: var(--bg-3); padding: 60px 20px; text-align: center; }
        
        .section-1 p { color: var(--text-dark); line-height: 1.8; }
        .section-2 h2 { color: white; }

        /* Hexagon Profile */
        .hex-wrap {
            margin: 30px auto;
            width: 200px;
            height: 175px;
            background: var(--accent);
            position: relative;
            clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
        }
        .hex-inner {
            position: absolute;
            top: 3px; left: 3px; right: 3px; bottom: 3px;
            background: url('https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop') center/cover;
            clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
        }
        .hex-inner-2 {
            background-image: url('https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop');
        }

        .couple-name { font-family: var(--font-head); font-size: 1.8rem; margin-top: 10px; }
        .couple-parent { font-size: 0.9rem; color: #555; }
        
        .amp { font-family: var(--font-sig); font-size: 3.5rem; color: var(--accent); margin: 20px 0; }

        /* Event Box */
        .event-box {
            background: white;
            padding: 30px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .event-box h3 { font-size: 2rem; margin-bottom: 15px; color: var(--text-dark); }
        .event-box p { margin-bottom: 5px; }
        .btn-vintage {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            font-family: var(--font-head);
            letter-spacing: 1px;
        }

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 30px;
        }
        .gallery-grid img { width: 100%; height: 150px; object-fit: cover; border-radius: 5px; }

        /* Forms */
        .form-control {
            width: 100%; padding: 12px; margin-bottom: 15px;
            border: 1px solid #ccc; border-radius: 5px;
            font-family: var(--font-body);
        }
        .btn-submit {
            width: 100%; padding: 12px;
            background: var(--accent); color: white;
            border: none; border-radius: 5px;
            font-family: var(--font-head); font-size: 1.1rem;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container-mobile">
    
    <div class="cover">
        <h3>THE WEDDING OF</h3>
        <h1>Justin & Sisca</h1>
        <p style="letter-spacing: 2px; margin-top: 20px;">12 . 12 . 2026</p>
    </div>

    <div class="section-1">
        <img src="https://indoinvite.com/nikah/template/bee-classic/Bismillah.png" style="width: 200px; margin-bottom: 30px;" alt="Bismillah">
        <p>Assalamu’alaikum Warahmatullahi Wabarakatuh<br><br>Maha suci Allah SWT yang telah menciptakan makhluk-Nya berpasang-pasangan.<br>Ya Allah, perkenankanlah kami merangkaikan kasih sayang yang Kau ciptakan di antara putra-putri kami:</p>

        <div class="hex-wrap">
            <div class="hex-inner"></div>
        </div>
        <div class="couple-name">Sisca</div>
        <div class="couple-parent">Putri Bpk. Budi & Ibu Ani</div>

        <div class="amp">and</div>

        <div class="hex-wrap">
            <div class="hex-inner hex-inner-2"></div>
        </div>
        <div class="couple-name">Justin</div>
        <div class="couple-parent">Putra Bpk. Joko & Ibu Rina</div>
    </div>

    <div class="section-2">
        <h2 style="font-size: 3.5rem; margin-bottom: 30px;">Acara Kami</h2>
        
        <div class="event-box">
            <h3>Akad Nikah</h3>
            <p><strong>Minggu, 12 Desember 2026</strong></p>
            <p>Pukul 09.00 - Selesai</p>
            <p style="margin-top: 15px;"><strong>Hotel Mulia Senayan</strong></p>
            <a href="#" class="btn-vintage">Google Maps</a>
        </div>

        <div class="event-box">
            <h3>Resepsi</h3>
            <p><strong>Minggu, 12 Desember 2026</strong></p>
            <p>Pukul 19.00 - Selesai</p>
            <p style="margin-top: 15px;"><strong>Hotel Mulia Senayan</strong></p>
            <a href="#" class="btn-vintage">Google Maps</a>
        </div>
    </div>

    <div class="section-3">
        <h2 style="font-size: 3.5rem; margin-bottom: 20px;">Galeri Kami</h2>
        <div class="gallery-grid">
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400&auto=format&fit=crop">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400&auto=format&fit=crop">
            <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=400&auto=format&fit=crop">
            <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop">
        </div>
    </div>

    <div class="section-1">
        <h2 style="font-size: 3.5rem; margin-bottom: 20px;">RSVP</h2>
        <p style="margin-bottom: 30px;">Kehadiran Anda adalah kado terindah bagi kami.</p>
        
        <form style="text-align: left;">
            <input type="text" class="form-control" placeholder="Nama Anda" required>
            <select class="form-control" required>
                <option value="">Kehadiran</option>
                <option value="1">Hadir</option>
                <option value="0">Tidak Hadir</option>
            </select>
            <textarea rows="4" class="form-control" placeholder="Tulis Ucapan & Doa" required></textarea>
            <button type="button" class="btn-submit">Kirim RSVP</button>
        </form>
    </div>

</div>

</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-27.blade.php', $content);

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::firstOrCreate(
        ['slug' => 'wedding-27'],
        [
            'event_type_id' => $et->id,
            'name' => 'Wedding 27 (Vintage Hexagon / Indoinvite Clone)',
            'description' => 'Terinspirasi dari desain vintage elegan dengan bingkai foto segi enam (hexagon), font signature klasik, dan paduan warna earth-tone (Beige/Taupe).',
            'is_premium' => true,
            'is_active' => true
        ]
    );
    echo "wedding-27 template created and inserted.\n";
}
