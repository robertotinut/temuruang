<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Tasyakuran Wisuda</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --color-black: #1a1a1a;
            --color-gold: #D4AF37;
            --color-gold-light: #F3E5AB;
            --color-white: #ffffff;
            
            --font-display: 'Cinzel', serif;
            --font-body: 'Lora', serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--color-white);
            color: var(--color-black);
            overflow-x: hidden;
            padding-bottom: 70px;
        }

        h1, h2, h3 {
            font-family: var(--font-display);
        }

        /* Hero */
        #hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background: linear-gradient(to right, rgba(26, 26, 26, 0.9), rgba(26, 26, 26, 0.7)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed;
            color: var(--color-gold);
        }

        .hero-content {
            border: 1px solid var(--color-gold);
            padding: 4rem 2rem;
            max-width: 600px;
            width: 90%;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
            position: relative;
        }

        .hero-content::before {
            content: '';
            position: absolute;
            top: 5px; left: 5px; right: 5px; bottom: 5px;
            border: 1px dashed var(--color-gold);
            pointer-events: none;
        }

        .hero-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: var(--color-gold);
        }

        .hero-title {
            font-size: 2.5rem;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            color: var(--color-white);
        }

        .hero-name {
            font-size: 3.5rem;
            color: var(--color-gold);
            margin: 1rem 0;
            font-weight: 700;
        }

        .hero-degree {
            font-size: 1.2rem;
            letter-spacing: 3px;
            color: var(--color-gold-light);
        }

        /* Profile & Quote */
        #profile {
            padding: 100px 20px;
            text-align: center;
            background: var(--color-white);
        }

        .quote {
            font-size: 1.5rem;
            font-style: italic;
            color: var(--color-black);
            max-width: 700px;
            margin: 0 auto 3rem auto;
            line-height: 1.6;
            position: relative;
        }

        .quote::before {
            content: '"';
            font-size: 4rem;
            color: var(--color-gold);
            position: absolute;
            top: -20px; left: -30px;
            font-family: var(--font-display);
            opacity: 0.5;
        }

        .grad-img {
            width: 250px;
            height: 350px;
            object-fit: cover;
            border: 10px solid var(--color-white);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            border-radius: 5px;
        }

        /* Event Details */
        #event {
            padding: 80px 20px;
            background: var(--color-black);
            color: var(--color-white);
            text-align: center;
            position: relative;
        }

        #event::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 5px;
            background: linear-gradient(90deg, var(--color-gold), transparent, var(--color-gold));
        }

        .section-title {
            font-size: 2.5rem;
            color: var(--color-gold);
            margin-bottom: 3rem;
            letter-spacing: 2px;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .event-card {
            border: 1px solid rgba(212, 175, 55, 0.3);
            padding: 3rem 2rem;
            background: rgba(255,255,255,0.02);
            transition: 0.3s;
        }

        .event-card:hover {
            border-color: var(--color-gold);
            background: rgba(212, 175, 55, 0.05);
        }

        .event-card i {
            font-size: 2.5rem;
            color: var(--color-gold);
            margin-bottom: 1.5rem;
        }

        .event-card h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--color-white);
        }

        .event-card p {
            color: #ccc;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .btn-gold {
            display: inline-block;
            margin-top: 2rem;
            padding: 12px 35px;
            background: transparent;
            color: var(--color-gold);
            border: 1px solid var(--color-gold);
            text-decoration: none;
            font-family: var(--font-display);
            font-weight: 600;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-gold:hover {
            background: var(--color-gold);
            color: var(--color-black);
        }

        /* Nav */
        .bottom-nav {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 70px;
            background: var(--color-black);
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 999;
            border-top: 1px solid #333;
        }

        .nav-item {
            color: #666;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.75rem;
            font-family: var(--font-display);
            font-weight: 600;
            transition: 0.3s;
        }

        .nav-item.active, .nav-item:hover {
            color: var(--color-gold);
        }

        .nav-item i {
            font-size: 1.4rem;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

    <div id="hero">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
            <i class="fas fa-graduation-cap hero-icon"></i>
            <h1 class="hero-title">Tasyakuran Kelulusan</h1>
            <p style="font-style: italic; color: var(--color-gold-light);">Atas berkat rahmat Allah SWT</p>
            <h2 class="hero-name">Aditya Pratama</h2>
            <p class="hero-degree">S.Kom., M.T.</p>
        </div>
    </div>

    <div id="profile">
        <p class="quote" data-aos="fade-up">"Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia." <br><span style="font-size: 1rem; color: #666;">- Nelson Mandela</span></p>
        
        <div data-aos="zoom-in" data-aos-delay="200">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Graduate" class="grad-img">
            <h3 style="font-size: 2rem;">Universitas Indonesia</h3>
            <p style="color: #666; margin-top: 10px;">Fakultas Ilmu Komputer - Lulusan Terbaik 2026</p>
        </div>
    </div>

    <div id="event">
        <h2 class="section-title" data-aos="fade-up">Jadwal Acara</h2>
        
        <div class="event-grid">
            <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-calendar-day"></i>
                <h3>Waktu Pelaksanaan</h3>
                <p>Minggu, 20 Oktober 2026</p>
                <p>10.00 WIB - Selesai</p>
            </div>
            <div class="event-card" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Lokasi Acara</h3>
                <p>Kediaman Keluarga Bapak Budi</p>
                <p style="font-size: 0.9rem; margin-top: 10px;">Jl. Merdeka Raya No. 45, Jakarta Selatan</p>
                <a href="#" class="btn-gold">Buka Google Maps</a>
            </div>
        </div>
    </div>

    <audio id="bgMusic" loop>
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-15.mp3" type="audio/mpeg">
    </audio>

    <nav class="bottom-nav">
        <a href="#hero" class="nav-item active"><i class="fas fa-home"></i><span>Beranda</span></a>
        <a href="#profile" class="nav-item"><i class="fas fa-user-graduate"></i><span>Profil</span></a>
        <a href="#event" class="nav-item"><i class="fas fa-glass-cheers"></i><span>Acara</span></a>
        <a href="javascript:void(0)" class="nav-item" id="musicToggle"><i class="fas fa-music" id="musicIcon"></i><span>Musik</span></a>
    </nav>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
        
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            if(item.id !== 'musicToggle') {
                item.addEventListener('click', function() {
                    navItems.forEach(n => { if(n.id !== 'musicToggle') n.classList.remove('active') });
                    this.classList.add('active');
                });
            }
        });

        // Music Logic
        const musicToggle = document.getElementById('musicToggle');
        const musicIcon = document.getElementById('musicIcon');
        const bgMusic = document.getElementById('bgMusic');
        let isPlaying = false;

        musicToggle.addEventListener('click', () => {
            if (isPlaying) {
                bgMusic.pause();
                musicIcon.classList.remove('fa-pause-circle');
                musicIcon.classList.add('fa-music');
            } else {
                bgMusic.play();
                musicIcon.classList.remove('fa-music');
                musicIcon.classList.add('fa-pause-circle');
            }
            isPlaying = !isPlaying;
        });
    </script>
</body>
</html>
