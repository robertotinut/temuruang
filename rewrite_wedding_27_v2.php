<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 27 | Classic Pandora</title>
    
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
            background-color: #222; /* Desktop background */
            -webkit-font-smoothing: antialiased;
        }

        .mob-con {
            max-width: 480px;
            margin: 0 auto;
            background: url('https://indoinvite.com/nikah/template/pandora/pandora-classic/PC-BG.webp') repeat center;
            background-color: var(--bg-light);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
            overflow-x: hidden;
        }

        h1, h2, h3, h4 { font-weight: normal; margin: 0; }

        /* Typography */
        .title-sig { font-family: var(--font-sig); color: var(--primary); font-size: 3rem; line-height: 1.2; }
        .title-accent { font-family: var(--font-accent); color: var(--primary); font-size: 2.5rem; }
        .title-accent-white { font-family: var(--font-accent); color: white; font-size: 2.5rem; }
        .subtitle { font-size: 0.85rem; letter-spacing: 3px; text-transform: uppercase; color: #777; margin-bottom: 10px; display: block; }

        /* Fullscreen Hero (Cover) */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800&auto=format&fit=crop') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 20px;
            position: relative;
        }
        .hero .title-sig { color: var(--primary); font-size: 4rem; margin: 10px 0; }
        .hero .subtitle { color: #ddd; letter-spacing: 2px; }

        /* Ornaments */
        .ornament-tl { position: absolute; top: 0; left: 0; width: 150px; z-index: 10; pointer-events: none; }
        .ornament-tr { position: absolute; top: 0; right: 0; width: 150px; z-index: 10; pointer-events: none; }
        .ornament-br { position: absolute; bottom: 0; right: 0; width: 150px; z-index: 10; pointer-events: none; transform: rotate(180deg); }
        .ornament-bl { position: absolute; bottom: 0; left: 0; width: 150px; z-index: 10; pointer-events: none; transform: rotate(180deg); }

        /* Sections */
        .box-section {
            padding: 80px 20px;
            text-align: center;
            position: relative;
            background: url('https://indoinvite.com/nikah/template/pandora/pandora-classic/PC-BG.webp') repeat center;
        }
        
        .box-primary {
            background-color: var(--primary);
            color: white;
        }

        /* Profile Hexagon */
        .hex-wrap {
            margin: 20px auto;
            width: 220px;
            height: 250px;
            background: var(--primary);
            position: relative;
            -webkit-clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
            clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hex-inner {
            width: 210px;
            height: 240px;
            background: url('https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop') center/cover;
            -webkit-clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
            clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
        }
        .hex-inner-2 { background-image: url('https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop'); }

        .nama-mempelai { font-family: var(--font-body); font-size: 1.5rem; font-weight: 600; color: var(--primary); margin-top: 10px; }
        .ortu-mempelai { font-size: 0.85rem; color: #555; }
        .ampersand { font-family: var(--font-accent); font-size: 4rem; color: var(--primary); margin: 20px 0; }

        /* Acara Box */
        .acara-box {
            background: white;
            padding: 30px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border: 1px solid rgba(174,143,122,0.3);
        }
        .acara-box h3 { font-family: var(--font-body); font-size: 1.5rem; font-weight: 600; color: var(--primary); margin-bottom: 15px; }
        .btn-custom {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.85rem;
            margin-top: 15px;
            transition: 0.3s;
            border: 1px solid var(--primary);
        }
        .btn-custom:hover { background: transparent; color: var(--primary); }

        /* RSVP Form */
        .form-control {
            width: 100%; padding: 12px; margin-bottom: 15px;
            border: 1px solid #ccc; border-radius: 5px;
            font-family: var(--font-body); background: transparent;
        }
        .form-control:focus { outline: none; border-color: var(--primary); }
        .btn-submit {
            width: 100%; padding: 12px; background: var(--primary); color: white;
            border: none; border-radius: 5px; font-family: var(--font-body); font-size: 1rem; cursor: pointer;
        }

        /* Gallery Grid */
        .gallery-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 20px; }
        .gallery-grid img { width: 100%; height: 150px; object-fit: cover; border-radius: 5px; }
    </style>
</head>
<body>

<div class="mob-con">
    
    <!-- HERO COVER -->
    <div class="hero">
        <h3 class="title-accent-white" data-aos="fade-down">The Wedding Of</h3>
        <h1 class="title-sig" data-aos="zoom-in" data-aos-duration="1500">Justin & Sisca</h1>
        <p style="letter-spacing: 2px; margin-top: 10px; font-size: 0.9rem;" data-aos="fade-up">12 . 12 . 2026</p>
    </div>

    <!-- SECTION 1: PEMBUKAAN & MEMPELAI -->
    <div class="box-section">
        <img src="https://indoinvite.com/nikah/template/pandora/pandora-classic/PC-AKR.webp" class="ornament-tl" alt="">
        <img src="https://indoinvite.com/nikah/template/pandora/pandora-classic/PC-AKN.webp" class="ornament-tr" alt="">

        <img src="https://indoinvite.com/nikah/template/bee-classic/Bismillah.png" style="width: 180px; margin-bottom: 20px;" alt="Bismillah" data-aos="fade-up">
        
        <p style="font-size: 0.9rem; line-height: 1.8; margin-bottom: 40px;" data-aos="fade-up">
            Assalamu’alaikum Warahmatullahi Wabarakatuh<br>
            Maha suci Allah SWT yang telah menciptakan makhluk-Nya berpasang-pasangan.<br>
            Ya Allah, perkenankanlah kami merangkaikan kasih sayang yang Kau ciptakan di antara putra-putri kami:
        </p>

        <div data-aos="fade-up">
            <div class="hex-wrap">
                <div class="hex-inner"></div>
            </div>
            <h2 class="nama-mempelai">Sisca Anastasya</h2>
            <p class="ortu-mempelai">Putri Bpk. Budi & Ibu Ani</p>
        </div>

        <div class="ampersand" data-aos="zoom-in">&</div>

        <div data-aos="fade-up">
            <div class="hex-wrap">
                <div class="hex-inner hex-inner-2"></div>
            </div>
            <h2 class="nama-mempelai">Justin Pratama</h2>
            <p class="ortu-mempelai">Putra Bpk. Joko & Ibu Rina</p>
        </div>
    </div>

    <!-- SECTION 2: ACARA -->
    <div class="box-section box-primary">
        <h2 class="title-accent-white" data-aos="fade-up" style="margin-bottom: 30px;">Save The Date</h2>

        <div class="acara-box" data-aos="fade-up">
            <h3>Akad Nikah</h3>
            <p style="margin-bottom: 5px;"><strong>Minggu, 12 Desember 2026</strong></p>
            <p style="margin-bottom: 10px;">Pukul 09.00 - Selesai</p>
            <hr style="border:0; border-top: 1px solid rgba(0,0,0,0.1); margin: 15px 0;">
            <p style="font-weight: 600;">Hotel Mulia Senayan</p>
            <p style="font-size: 0.8rem; color: #777;">Jl. Asia Afrika, Jakarta</p>
            <a href="#" class="btn-custom">Google Maps</a>
        </div>

        <div class="acara-box" data-aos="fade-up" data-aos-delay="100">
            <h3>Resepsi</h3>
            <p style="margin-bottom: 5px;"><strong>Minggu, 12 Desember 2026</strong></p>
            <p style="margin-bottom: 10px;">Pukul 19.00 - Selesai</p>
            <hr style="border:0; border-top: 1px solid rgba(0,0,0,0.1); margin: 15px 0;">
            <p style="font-weight: 600;">Hotel Mulia Senayan</p>
            <p style="font-size: 0.8rem; color: #777;">Jl. Asia Afrika, Jakarta</p>
            <a href="#" class="btn-custom">Google Maps</a>
        </div>
    </div>

    <!-- SECTION 3: GALERI -->
    <div class="box-section">
        <h2 class="title-accent" data-aos="fade-up">Our Gallery</h2>
        <div class="gallery-grid">
            <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400&auto=format&fit=crop" data-aos="fade-up" data-aos-delay="100">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400&auto=format&fit=crop" data-aos="fade-up" data-aos-delay="200">
            <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=400&auto=format&fit=crop" data-aos="fade-up" data-aos-delay="300">
            <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop" data-aos="fade-up" data-aos-delay="400">
        </div>
    </div>

    <!-- SECTION 4: RSVP -->
    <div class="box-section">
        <img src="https://indoinvite.com/nikah/template/pandora/pandora-classic/PC-AKR.webp" class="ornament-bl" alt="">
        <img src="https://indoinvite.com/nikah/template/pandora/pandora-classic/PC-AKN.webp" class="ornament-br" alt="">

        <h2 class="title-accent" data-aos="fade-up" style="margin-bottom: 20px;">Kehadiran</h2>
        <p style="font-size: 0.9rem; margin-bottom: 30px;" data-aos="fade-up">Doa Restu Anda merupakan karunia yang sangat berarti bagi kami.</p>
        
        <form style="text-align: left; position: relative; z-index: 20;" data-aos="fade-up">
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

    <div style="text-align: center; padding: 30px; background: white; font-size: 0.8rem; color: #999;">
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
echo "wedding-27 completely rewritten to perfectly mimic the reference.\n";
