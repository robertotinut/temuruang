<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 25 | Dark Luxury</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Lato:wght@300;400&display=swap" rel="stylesheet">
    
    <!-- Icons & Animation -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0A0A0A;
            --bg-card: #141414;
            --gold: #D4AF37;
            --text-light: #E0E0E0;
            --font-title: 'Cinzel', serif;
            --font-body: 'Lato', sans-serif;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            background-color: #000;
            color: var(--text-light);
            font-family: var(--font-body);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            max-width: 430px;
            margin: 0 auto;
            background-color: var(--bg-dark);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 50px rgba(212, 175, 55, 0.05);
        }

        /* Sticky Header */
        .header {
            position: fixed;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 430px;
            padding: 20px 0;
            text-align: center;
            background: linear-gradient(to bottom, rgba(10,10,10,0.9), transparent);
            z-index: 100;
            font-family: var(--font-title);
            color: var(--gold);
            letter-spacing: 4px;
            font-size: 0.8rem;
            pointer-events: none;
        }

        h1, h2, h3, h4 { font-family: var(--font-title); color: var(--gold); font-weight: 400; }
        p { line-height: 1.7; font-size: 0.95rem; color: #BBB; }
        
        .btn-gold {
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            padding: 14px 35px;
            font-family: var(--font-title);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.8rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            width: 100%;
        }
        .btn-gold:hover { background: rgba(212, 175, 55, 0.1); }

        .divider {
            width: 1px;
            height: 60px;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
            margin: 0 auto 40px;
        }

        .section { padding: 80px 25px; text-align: center; }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800&auto=format&fit=crop') center/cover no-repeat;
            position: relative;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle, rgba(10,10,10,0.4) 0%, rgba(10,10,10,0.95) 100%);
        }
        .hero-inner {
            position: relative;
            z-index: 10;
            border: 1px solid rgba(212, 175, 55, 0.4);
            padding: 50px 30px;
            background: rgba(10,10,10,0.6);
            backdrop-filter: blur(8px);
            width: 85%;
        }
        .hero h1 { font-size: 3.2rem; margin: 20px 0; line-height: 1.1; }
        .hero .subtitle { letter-spacing: 3px; font-size: 0.8rem; text-transform: uppercase; color: #FFF; }

        /* Couple Section */
        .couple-card {
            background: var(--bg-card);
            padding: 40px 20px;
            border: 1px solid rgba(255,255,255,0.05);
            margin-bottom: 20px;
            position: relative;
        }
        .couple-card::after {
            content: '';
            position: absolute;
            top: 10px; left: 10px; right: 10px; bottom: 10px;
            border: 1px solid rgba(212, 175, 55, 0.15);
            pointer-events: none;
        }
        .couple-img {
            width: 120px; height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold);
            margin-bottom: 20px;
        }
        .couple-card h2 { font-size: 2rem; margin-bottom: 10px; }

        /* Gallery Horizontal Scroll */
        .gallery-wrap {
            margin: 0 -25px; /* Pull out of section padding */
            padding: 0 25px;
        }
        .gallery-scroll {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 20px;
            padding-bottom: 30px;
            scrollbar-width: none;
        }
        .gallery-scroll::-webkit-scrollbar { display: none; }
        
        .gallery-item {
            flex: 0 0 85%;
            scroll-snap-align: center;
            height: 450px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            padding: 10px;
            background: var(--bg-dark);
        }
        .gallery-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            filter: grayscale(100%) brightness(0.8);
            transition: 0.5s;
        }
        .gallery-item img:hover { filter: grayscale(0%) brightness(1); }

        /* Form */
        .form-group { position: relative; margin-bottom: 30px; }
        input, select, textarea {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 10px 0;
            color: white;
            font-family: var(--font-body);
            border-radius: 0;
            -webkit-appearance: none;
        }
        input:focus, select:focus, textarea:focus {
            outline: none; border-bottom-color: var(--gold);
        }
        select option { background: var(--bg-card); color: white; }

        /* Music Floating Button */
        .music-btn {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(150px);
            width: 50px; height: 50px;
            border-radius: 50%;
            background: rgba(10,10,10,0.8);
            border: 1px solid var(--gold);
            color: var(--gold);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            z-index: 100;
            cursor: pointer;
            backdrop-filter: blur(5px);
        }
        @media (max-width: 430px) {
            .music-btn { left: auto; right: 20px; transform: none; }
        }
    </style>
</head>
<body>

<div class="wrapper">
    
    <div class="header">THE WEDDING</div>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-inner" data-aos="zoom-in" data-aos-duration="2000">
            <div class="subtitle">We Are Getting Married</div>
            <h1>Raka<br>&<br>Nadya</h1>
            <p style="color:var(--gold); letter-spacing:2px; margin-top:20px; font-size:0.85rem;">12 . 12 . 2026</p>
        </div>
    </section>

    <!-- Couple -->
    <section class="section">
        <div data-aos="fade-up">
            <h2 style="font-size: 2.2rem; margin-bottom: 10px;">The Bride & Groom</h2>
            <p class="mb-5">Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan pernikahan kami.</p>
            
            <div class="couple-card">
                <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop" class="couple-img" alt="Bride">
                <h2>Nadya</h2>
                <p>Putri dari Bpk. Setiawan<br>& Ibu Ratna</p>
            </div>
            
            <div class="divider" style="height: 30px; margin: 20px auto;"></div>
            
            <div class="couple-card">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop" class="couple-img" alt="Groom">
                <h2>Raka</h2>
                <p>Putra dari Bpk. Budi<br>& Ibu Siti</p>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- Event -->
    <section class="section">
        <div data-aos="fade-up">
            <h2 style="font-size: 2.2rem; margin-bottom: 40px;">Save The Date</h2>
            
            <div style="border: 1px solid rgba(212, 175, 55, 0.3); padding: 40px 20px; margin-bottom: 30px; background: var(--bg-card);">
                <i class="bi bi-calendar-heart" style="font-size: 2rem; color: var(--gold); margin-bottom: 15px; display: block;"></i>
                <h3 style="font-size: 1.8rem; margin-bottom: 15px;">Akad Nikah</h3>
                <p style="color: #FFF; font-weight: bold;">Sabtu, 12 Desember 2026</p>
                <p>Pukul 09:00 WIB</p>
                <p class="mt-3"><strong>Hotel Mulia Senayan</strong><br>Jl. Asia Afrika, Jakarta</p>
                <a href="#" class="btn-gold mt-4" style="padding: 10px 20px; font-size: 0.7rem;"><i class="bi bi-geo-alt me-2"></i> Lokasi</a>
            </div>

            <div style="border: 1px solid rgba(212, 175, 55, 0.3); padding: 40px 20px; background: var(--bg-card);">
                <i class="bi bi-stars" style="font-size: 2rem; color: var(--gold); margin-bottom: 15px; display: block;"></i>
                <h3 style="font-size: 1.8rem; margin-bottom: 15px;">Resepsi</h3>
                <p style="color: #FFF; font-weight: bold;">Sabtu, 12 Desember 2026</p>
                <p>Pukul 19:00 WIB</p>
                <p class="mt-3"><strong>Hotel Mulia Senayan</strong><br>Jl. Asia Afrika, Jakarta</p>
                <a href="#" class="btn-gold mt-4" style="padding: 10px 20px; font-size: 0.7rem;"><i class="bi bi-geo-alt me-2"></i> Lokasi</a>
            </div>
        </div>
    </section>

    <div class="divider"></div>

    <!-- Gallery -->
    <section class="section">
        <div data-aos="fade-up">
            <h2 style="font-size: 2.2rem; margin-bottom: 30px;">Our Moments</h2>
            <div class="gallery-wrap">
                <div class="gallery-scroll">
                    <div class="gallery-item"><img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800&auto=format&fit=crop" alt="Gallery 1"></div>
                    <div class="gallery-item"><img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800&auto=format&fit=crop" alt="Gallery 2"></div>
                    <div class="gallery-item"><img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=800&auto=format&fit=crop" alt="Gallery 3"></div>
                </div>
            </div>
            <p style="font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; margin-top: 20px;">Swipe &rarr;</p>
        </div>
    </section>

    <div class="divider"></div>

    <!-- RSVP -->
    <section class="section" style="padding-bottom: 100px;">
        <div data-aos="fade-up">
            <h2 style="font-size: 2.2rem; margin-bottom: 30px;">RSVP</h2>
            <form>
                <input type="text" placeholder="Nama Lengkap" required>
                <select required>
                    <option value="" disabled selected>Kehadiran</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak">Tidak Hadir</option>
                </select>
                <textarea rows="3" placeholder="Pesan untuk mempelai" required></textarea>
                <button type="button" class="btn-gold mt-4">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- Floating Music Btn -->
    <button class="music-btn"><i class="bi bi-music-note"></i></button>

</div>

<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000, offset: 50 });
</script>
</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-25.blade.php', $content);

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::firstOrCreate(
        ['slug' => 'wedding-25'],
        [
            'event_type_id' => $et->id,
            'name' => 'Wedding 25 (Dark Luxury Night)',
            'description' => 'Tema elegan dengan perpaduan warna hitam dan emas. Galeri menggunakan scroll horizontal bergaya kartu.',
            'is_premium' => true,
            'is_active' => true
        ]
    );
    echo "wedding-25 template created and inserted.\n";
}
