<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Reuni Akbar</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Roboto+Mono:wght@400;600&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --color-maroon: #800000;
            --color-gold: #F2C94C;
            --color-cream: #FDFBF7;
            --color-dark: #333333;
            
            --font-display: 'Permanent Marker', cursive;
            --font-body: 'Roboto', sans-serif;
            --font-mono: 'Roboto Mono', monospace;
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
            background-color: var(--color-cream);
            color: var(--color-dark);
            overflow-x: hidden;
            padding-bottom: 70px;
            /* Paper texture */
            background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');
        }

        h1, h2, h3 {
            font-family: var(--font-display);
            color: var(--color-maroon);
        }

        /* Hero */
        #hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background: linear-gradient(rgba(128, 0, 0, 0.7), rgba(128, 0, 0, 0.8)), url('https://images.unsplash.com/photo-1523580494112-071d192c9c11?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover fixed;
            color: #fff;
        }

        .hero-border {
            border: 4px solid var(--color-gold);
            padding: 3rem;
            max-width: 800px;
            width: 90%;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(3px);
            transform: rotate(-2deg);
        }

        .hero-title {
            font-size: 5rem;
            color: var(--color-gold);
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
            letter-spacing: 3px;
        }

        .hero-subtitle {
            font-family: var(--font-mono);
            font-size: 1.5rem;
            letter-spacing: 5px;
            margin-bottom: 2rem;
        }

        /* Countdown */
        .countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 2rem;
            font-family: var(--font-mono);
        }

        .time-box {
            background: var(--color-gold);
            color: var(--color-maroon);
            padding: 15px;
            border-radius: 5px;
            min-width: 80px;
            box-shadow: 3px 3px 0 rgba(0,0,0,0.3);
        }

        .time-box span {
            display: block;
            font-size: 2rem;
            font-weight: bold;
        }

        .time-box small {
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        /* Message */
        #message {
            padding: 80px 20px;
            text-align: center;
        }

        .polaroid-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        .polaroid {
            background: #fff;
            padding: 15px 15px 40px 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transform: rotate(3deg);
            transition: 0.3s;
        }

        .polaroid:nth-child(even) {
            transform: rotate(-4deg);
        }

        .polaroid:hover {
            transform: scale(1.05) rotate(0);
            z-index: 10;
        }

        .polaroid img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            filter: sepia(0.6) contrast(1.2);
        }

        .polaroid p {
            font-family: var(--font-display);
            margin-top: 15px;
            font-size: 1.2rem;
            color: #555;
        }

        /* Event Details */
        #event {
            padding: 80px 20px;
            background: var(--color-maroon);
            color: #fff;
            text-align: center;
            background-image: url('https://www.transparenttextures.com/patterns/diagmonds-light.png');
        }

        #event h2 {
            color: var(--color-gold);
        }

        .ticket-box {
            background: #fff;
            color: var(--color-dark);
            max-width: 600px;
            margin: 3rem auto;
            border-radius: 10px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .ticket-left {
            background: var(--color-gold);
            padding: 30px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-right: 2px dashed var(--color-maroon);
        }

        .ticket-right {
            padding: 40px;
            flex-grow: 1;
            text-align: left;
        }

        .btn-rsvp {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 12px 30px;
            background: var(--color-maroon);
            color: var(--color-gold);
            text-decoration: none;
            font-family: var(--font-mono);
            font-weight: bold;
            font-size: 1.1rem;
            transition: 0.3s;
            border: 2px solid var(--color-maroon);
        }

        .btn-rsvp:hover {
            background: #fff;
            color: var(--color-maroon);
        }

        /* Nav */
        .bottom-nav {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 70px;
            background: var(--color-maroon);
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 999;
            border-top: 3px solid var(--color-gold);
        }

        .nav-item {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.75rem;
            font-family: var(--font-mono);
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
        <div class="hero-border" data-aos="zoom-in" data-aos-duration="1500">
            <h1 class="hero-title">REUNI AKBAR</h1>
            <p class="hero-subtitle">ANGKATAN 2016</p>
            <p style="font-family: var(--font-body); font-size: 1.2rem; font-style: italic;">"Satu Dekade Kenangan, Selamanya Persahabatan"</p>
            
            <div class="countdown">
                <div class="time-box">
                    <span>14</span>
                    <small>Hari</small>
                </div>
                <div class="time-box">
                    <span>08</span>
                    <small>Jam</small>
                </div>
                <div class="time-box">
                    <span>45</span>
                    <small>Menit</small>
                </div>
            </div>
        </div>
    </div>

    <div id="message">
        <h2 style="font-size: 3rem;" data-aos="fade-up">Masih Ingat Masa Itu?</h2>
        <p style="font-size: 1.2rem; max-width: 600px; margin: 1rem auto; line-height: 1.6;" data-aos="fade-up" data-aos-delay="100">
            Sudah 10 tahun berlalu sejak kita lulus. Beragam cerita, canda, dan tawa pernah kita ukir bersama. Mari kembali berkumpul, bernostalgia, dan merajut kembali tali silaturahmi yang mungkin sempat terputus oleh jarak dan kesibukan.
        </p>

        <div class="polaroid-container">
            <div class="polaroid" data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1523580494112-071d192c9c11?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Memory">
                <p>Kelas XII IPA 2</p>
            </div>
            <div class="polaroid" data-aos="fade-up" data-aos-delay="400">
                <img src="https://images.unsplash.com/photo-1511629091441-ee46146481b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Memory">
                <p>Pensi 2015</p>
            </div>
        </div>
    </div>

    <div id="event">
        <h2 style="font-size: 3rem;" data-aos="fade-up">Detail Acara</h2>
        
        <div class="ticket-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="ticket-left">
                <i class="fas fa-ticket-alt" style="font-size: 3rem; color: var(--color-maroon); margin-bottom: 10px;"></i>
                <span style="font-family: var(--font-mono); font-weight: bold; color: var(--color-maroon);">TICKET PASS</span>
            </div>
            <div class="ticket-right">
                <h3 style="font-family: var(--font-body); font-weight: bold; font-size: 1.5rem; margin-bottom: 15px;">Malam Keakraban 2016</h3>
                <p style="margin-bottom: 8px;"><i class="fas fa-calendar-alt" style="width: 25px; color: var(--color-maroon);"></i> Sabtu, 20 Agustus 2026</p>
                <p style="margin-bottom: 8px;"><i class="fas fa-clock" style="width: 25px; color: var(--color-maroon);"></i> 18:00 WIB - Selesai</p>
                <p style="margin-bottom: 20px;"><i class="fas fa-map-marker-alt" style="width: 25px; color: var(--color-maroon);"></i> Hotel Grand Mercure, Lt. 5</p>
                
                <p style="font-size: 0.9rem; color: #666; font-style: italic; margin-bottom: 10px;">Dresscode: Smart Casual (Nuansa Putih/Maroon)</p>
                
                <a href="#" class="btn-rsvp">Konfirmasi Kehadiran</a>
            </div>
        </div>
    </div>

    <audio id="bgMusic" loop>
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-14.mp3" type="audio/mpeg">
    </audio>

    <nav class="bottom-nav">
        <a href="#hero" class="nav-item active"><i class="fas fa-home"></i><span>Beranda</span></a>
        <a href="#message" class="nav-item"><i class="fas fa-images"></i><span>Memori</span></a>
        <a href="#event" class="nav-item"><i class="fas fa-calendar-check"></i><span>Acara</span></a>
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
