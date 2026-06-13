<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 27 | Classic Elegance</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Work+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/photograph-signature" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #ae8f7a; /* Warm Taupe/Gold */
            --bg-light: #fdf9f6;
            --bg-dark: #303333;
            --text-main: #2e2e2e;
            --font-sig: 'Photograph Signature', sans-serif;
            --font-accent: 'Great Vibes', cursive;
            --font-body: 'Work Sans', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-body);
            color: var(--text-main);
            background-color: var(--bg-dark); /* Desktop background */
            -webkit-font-smoothing: antialiased;
        }

        .container-app {
            max-width: 480px;
            margin: 0 auto;
            background-color: var(--bg-light);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
            overflow-x: hidden;
        }

        h1, h2, h3, h4 { font-weight: normal; }

        /* Typography */
        .title-sig { font-family: var(--font-sig); color: var(--primary); font-size: 3.5rem; line-height: 1.2; }
        .title-accent { font-family: var(--font-accent); color: var(--primary); font-size: 2.5rem; }
        .subtitle { font-size: 0.85rem; letter-spacing: 3px; text-transform: uppercase; color: #777; margin-bottom: 10px; display: block; }

        /* Fullscreen Hero */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800&auto=format&fit=crop') center/cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 20px;
        }
        .hero .title-sig { color: white; font-size: 4.5rem; margin: 15px 0; }
        .hero .subtitle { color: #ddd; letter-spacing: 4px; }
        
        .section { padding: 80px 25px; text-align: center; }
        
        /* Bismillah & Opening */
        .bismillah-img { width: 180px; margin: 0 auto 30px; display: block; opacity: 0.8; }
        .opening-text { font-size: 0.9rem; line-height: 1.8; color: var(--text-main); margin-bottom: 50px; }

        /* Hexagon Shape */
        .hex-container {
            width: 220px;
            height: 250px;
            margin: 0 auto 20px;
            background-color: var(--primary);
            position: relative;
            -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hex-inner {
            width: 210px;
            height: 240px;
            background: url('https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop') center/cover;
            -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        }
        .hex-inner-groom { background-image: url('https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop'); }

        .couple-name { font-family: var(--font-body); font-weight: 600; font-size: 1.5rem; color: var(--primary); margin-top: 15px; }
        .couple-parent { font-size: 0.85rem; color: #666; margin-top: 5px; }
        .ampersand { font-family: var(--font-accent); font-size: 4rem; color: var(--primary); margin: 30px 0; }

        /* Event Box */
        .event-section { background-color: #fff; padding-top: 80px; padding-bottom: 80px; }
        .event-card {
            background: var(--bg-light);
            border: 1px solid rgba(174, 143, 122, 0.3);
            border-radius: 15px;
            padding: 40px 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            position: relative;
        }
        .event-card h3 { font-family: var(--font-body); font-weight: 600; font-size: 1.8rem; color: var(--primary); margin-bottom: 15px; }
        .event-card p { font-size: 0.95rem; margin-bottom: 8px; }
        .btn-primary {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 0.85rem;
            letter-spacing: 1px;
            margin-top: 20px;
            transition: 0.3s;
            border: 2px solid var(--primary);
        }
        .btn-primary:hover { background: transparent; color: var(--primary); }

        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 40px;
        }
        .gallery-item { width: 100%; height: 200px; object-fit: cover; border-radius: 10px; }

        /* RSVP */
        .rsvp-section { background-color: var(--primary); color: white; }
        .rsvp-section .title-sig { color: white; }
        .form-control {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            color: white;
            font-family: var(--font-body);
        }
        .form-control::placeholder { color: rgba(255,255,255,0.7); }
        .form-control:focus { outline: none; background: rgba(255,255,255,0.2); }
        .form-control option { color: var(--text-main); }
        
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: white;
            color: var(--primary);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            font-family: var(--font-body);
        }

        .footer { padding: 40px; text-align: center; background: #fff; font-size: 0.8rem; color: #999; }
        
        /* Floating Leaves Decoration */
        .leaf-decor { position: absolute; width: 120px; opacity: 0.6; pointer-events: none; }
        .leaf-top-left { top: -20px; left: -20px; transform: rotate(45deg); }
        .leaf-bottom-right { bottom: -20px; right: -20px; transform: rotate(-135deg); }
    </style>
</head>
<body>

<div class="container-app">
    
    <div class="hero">
        <span class="subtitle" data-aos="fade-down">The Wedding Of</span>
        <h1 class="title-sig" data-aos="zoom-in" data-aos-duration="1500">Nadya & Raka</h1>
        <span class="subtitle" data-aos="fade-up" style="margin-top: 20px;">12 . 12 . 2026</span>
    </div>

    <div class="section" style="position: relative; overflow: hidden;">
        <!-- Placeholder for leaf decor -->
        <div style="position: absolute; top: 0; left: 0; width: 150px; height: 150px; background: radial-gradient(circle, rgba(174,143,122,0.1) 0%, transparent 70%);"></div>

        <img src="https://indoinvite.com/nikah/template/bee-classic/Bismillah.png" alt="Bismillah" class="bismillah-img" data-aos="fade-up">
        
        <p class="opening-text" data-aos="fade-up">
            Maha suci Allah SWT yang telah menciptakan makhluk-Nya berpasang-pasangan.<br>
            Ya Allah, perkenankanlah kami merangkaikan kasih sayang yang Kau ciptakan di antara putra-putri kami:
        </p>

        <div data-aos="fade-up">
            <div class="hex-container">
                <div class="hex-inner"></div>
            </div>
            <h2 class="couple-name">Nadya Maharani</h2>
            <p class="couple-parent">Putri Pertama Bpk. Setiawan & Ibu Ratna</p>
        </div>

        <div class="ampersand" data-aos="zoom-in">&</div>

        <div data-aos="fade-up">
            <div class="hex-container">
                <div class="hex-inner hex-inner-groom"></div>
            </div>
            <h2 class="couple-name">Raka Pratama</h2>
            <p class="couple-parent">Putra Kedua Bpk. Budi & Ibu Siti</p>
        </div>
    </div>

    <div class="section event-section">
        <span class="subtitle" data-aos="fade-up">Save The Date</span>
        <h2 class="title-sig" data-aos="fade-up" style="margin-bottom: 40px;">Acara Kami</h2>
        
        <div class="event-card" data-aos="fade-up">
            <h3>Akad Nikah</h3>
            <p><strong>Minggu, 12 Desember 2026</strong></p>
            <p>09.00 WIB - Selesai</p>
            <hr style="border: 0; border-top: 1px solid rgba(174,143,122,0.3); margin: 15px 0;">
            <p style="font-weight: 600;">Hotel Mulia Senayan</p>
            <p style="font-size: 0.8rem; color: #777;">Jl. Asia Afrika, Senayan, Jakarta</p>
            <a href="#" class="btn-primary"><i class="bi bi-geo-alt me-2"></i>Google Maps</a>
        </div>

        <div class="event-card" data-aos="fade-up">
            <h3>Resepsi</h3>
            <p><strong>Minggu, 12 Desember 2026</strong></p>
            <p>19.00 WIB - Selesai</p>
            <hr style="border: 0; border-top: 1px solid rgba(174,143,122,0.3); margin: 15px 0;">
            <p style="font-weight: 600;">Hotel Mulia Senayan</p>
            <p style="font-size: 0.8rem; color: #777;">Jl. Asia Afrika, Senayan, Jakarta</p>
            <a href="#" class="btn-primary"><i class="bi bi-geo-alt me-2"></i>Google Maps</a>
        </div>
    </div>

    <div class="section">
        <span class="subtitle" data-aos="fade-up">Our Moments</span>
        <h2 class="title-sig" data-aos="fade-up">Galeri</h2>
        
        <div class="gallery-grid">
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400&auto=format&fit=crop" class="gallery-item" data-aos="fade-up" data-aos-delay="100">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400&auto=format&fit=crop" class="gallery-item" data-aos="fade-up" data-aos-delay="200">
            <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=400&auto=format&fit=crop" class="gallery-item" data-aos="fade-up" data-aos-delay="300">
            <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop" class="gallery-item" data-aos="fade-up" data-aos-delay="400">
        </div>
    </div>

    <div class="section rsvp-section">
        <span class="subtitle" style="color: rgba(255,255,255,0.7);" data-aos="fade-up">Kehadiran</span>
        <h2 class="title-sig" data-aos="fade-up" style="margin-bottom: 30px;">Buku Tamu</h2>
        
        <form style="text-align: left;" data-aos="fade-up">
            <input type="text" class="form-control" placeholder="Nama Lengkap Anda" required>
            <select class="form-control" required>
                <option value="" disabled selected>Konfirmasi Kehadiran</option>
                <option value="hadir">Ya, Saya Akan Hadir</option>
                <option value="tidak">Maaf, Tidak Bisa Hadir</option>
            </select>
            <textarea rows="4" class="form-control" placeholder="Berikan Ucapan & Doa" required></textarea>
            <button type="button" class="btn-submit">Kirim Ucapan</button>
        </form>
    </div>

    <div class="footer">
        <p>Made with ♥ by TemuRuang</p>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000, offset: 50 });
</script>
</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-27.blade.php', $content);

echo "wedding-27 clean rewritten.\n";
