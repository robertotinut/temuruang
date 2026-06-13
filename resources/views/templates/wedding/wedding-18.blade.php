@php
    $couple = $couple ?? [
        'groom' => 'Arkan',
        'bride' => 'Nabila',
        'parents' => [
            'groom' => 'Bpk. Herman & Ibu Siti',
            'bride' => 'Bpk. Joko & Ibu Wati',
        ],
    ];

    $event = $event ?? [
        'date_iso' => '2026-12-12',
        'time' => '10:00',
        'location' => 'Grand Ballroom, Hotel Harmoni',
        'address' => 'Jl. Kebangsaan No. 45, Bandung',
        'maps_url' => 'https://maps.google.com/?q=Bandung',
    ];

    $schedule = $schedule ?? [
        ['title' => 'Akad Nikah', 'time' => '10:00 - 11:30', 'note' => 'Ruang Tulip'],
        ['title' => 'Resepsi Pernikahan', 'time' => '12:00 - 15:00', 'note' => 'Ballroom Utama'],
    ];

    $stories = $stories ?? [
        ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di bangku perkuliahan, kami menyadari banyak hal menarik yang membuat kami dekat.'],
        ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
        ['title' => 'Menuju Pernikahan', 'date' => 'Desember 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
    ];

    $gallery = $gallery ?? [
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
        'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400'
    ];

    $bg = $bg ?? [
        'cover' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800',
        'groom' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400',
        'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #c05c3c; 
            --primary-dark: #8c3b22;
            --accent: #faf5f2; 
            --bg-dark: #230b05; 
            --text-dark: #2A2C2A;
            --text-light: #6E726E;
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Alex Brush', cursive;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: var(--accent); min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding-bottom: 40px; }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: white; text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-title { font-family: var(--font-script); font-size: 3.5rem; color: var(--primary); margin: 10px 0; }
        .cover-guest-card { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); padding: 25px 20px; border-radius: 20px; width: 100%; margin-bottom: 30px; }
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: var(--primary); color: white; font-family: var(--font-sans); font-weight: 600; font-size: 0.85rem; letter-spacing: 2px; padding: 14px 30px; border-radius: 50px; border: none; cursor: pointer; transition: all 0.3s; }

        /* Floating hamburger trigger instead of bottom nav */
        .menu-trigger { position: fixed; top: 20px; right: 20px; width: 45px; height: 45px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.15); opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .menu-trigger.visible { opacity: 1; visibility: visible; }
        
        .overlay-menu { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; background: rgba(0, 0, 0, 0.95); z-index: 9999; display: flex; flex-direction: column; justify-content: center; align-items: center; opacity: 0; visibility: hidden; transition: all 0.4s ease; }
        .overlay-menu.open { opacity: 1; visibility: visible; }
        .close-trigger { position: absolute; top: 20px; right: 20px; font-size: 2rem; color: white; cursor: pointer; }
        .menu-links { display: flex; flex-direction: column; gap: 25px; text-align: center; }
        .menu-links a { font-family: var(--font-serif); font-size: 1.5rem; color: #bbb; text-decoration: none; letter-spacing: 2px; transition: color 0.3s; }
        .menu-links a:hover { color: var(--primary); }

        section { padding: 60px 20px; position: relative; text-align: center; }
        
        .section-subtitle { font-size: 0.75rem; letter-spacing: 4px; text-transform: uppercase; color: var(--primary); margin-bottom: 10px; font-weight: 600; display: block; }
        .section-title { font-family: var(--font-serif); font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 25px; font-weight: 400; text-transform: uppercase; }
        .script-divider { font-family: var(--font-script); font-size: 2.5rem; color: var(--primary); margin: 20px 0; }

        /* Modern capsule images */
        .couple-wrapper { margin: 40px 0; background: white; border-radius: 30px; padding: 30px 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .capsule-photo { width: 150px; height: 230px; margin: 0 auto 20px; border-radius: 75px; background-size: cover; background-position: center; border: 4px solid var(--accent); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }

        .couple-name { font-family: var(--font-serif); font-size: 1.6rem; color: var(--primary-dark); margin-bottom: 6px; }
        .couple-parent { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .event-card { background: white; border-radius: 24px; padding: 35px 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); margin-bottom: 25px; text-align: center; border: 1px solid rgba(0,0,0,0.02); }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.4rem; color: var(--primary-dark); margin-bottom: 12px; font-weight: 600; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: white; padding: 10px 25px; border-radius: 30px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-top: 15px; transition: all 0.3s; }

        .countdown-container { display: flex; justify-content: center; gap: 12px; margin: 25px 0; }
        .countdown-box { background: var(--primary-dark); border-radius: 12px; width: 65px; height: 65px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; }
        .countdown-box span:first-child { font-size: 1.3rem; font-family: var(--font-serif); font-weight: 600; }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; opacity: 0.85; }

        .story-timeline { text-align: center; margin-top: 25px; }
        .story-item { background: white; border-radius: 20px; padding: 25px; margin-bottom: 25px; box-shadow: 0 8px 25px rgba(0,0,0,0.02); }
        .story-date { font-weight: 600; font-size: 0.8rem; color: var(--primary); margin-bottom: 8px; }
        .story-title { font-family: var(--font-serif); font-size: 1.2rem; margin-bottom: 8px; color: var(--primary-dark); }
        .story-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .gallery-item { border-radius: 16px; overflow: hidden; aspect-ratio: 1; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }

        .gift-box { background: white; padding: 30px; border-radius: 24px; margin-top: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.02); }
        .btn-copy { background: var(--primary-dark); color: white; border: none; padding: 10px 25px; border-radius: 30px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 15px; }

        .form-wrap { background: white; padding: 30px 20px; border-radius: 24px; text-align: left; box-shadow: 0 8px 25px rgba(0,0,0,0.02); }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; color: var(--primary-dark); }
        .form-input { width: 100%; padding: 12px; border: 1px solid #e2ded8; border-radius: 8px; font-size: 0.85rem; background: var(--accent); }
        .btn-submit { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; letter-spacing: 1px; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; }
        .wish-card { background: white; padding: 15px; border-radius: 16px; margin-bottom: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); text-align: left; }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; color: var(--primary-dark); }
        .wish-status { background: var(--accent); padding: 2px 8px; border-radius: 10px; font-size: 0.65rem; }
        .wish-content { font-size: 0.75rem; color: var(--text-light); }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 25px; left: 20px; }
        .scroll-control { bottom: 25px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p style="letter-spacing: 3px; font-size: 0.75rem; text-transform: uppercase;">Undangan Pernikahan</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.7rem; color: #ccc; letter-spacing: 1px;">Kpd. Yth Bapak/Ibu/Saudara/i:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.4rem; color: white; margin-top: 5px;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            BUKA UNDANGAN <i class="bi bi-arrow-right"></i>
        </button>
    </div>

    <!-- Slide-out overlay menu triggered by top hamburger -->
    <div class="overlay-menu" id="overlayMenu">
        <div class="close-trigger" onclick="toggleOverlayMenu()"><i class="bi bi-x"></i></div>
        <div class="menu-links">
            <a href="#home" onclick="toggleOverlayMenu()">HOME</a>
            <a href="#couple-sec" onclick="toggleOverlayMenu()">MEMPELAI</a>
            <a href="#event-sec" onclick="toggleOverlayMenu()">ACARA</a>
            <a href="#story-sec" onclick="toggleOverlayMenu()">KISAH KAMI</a>
            <a href="#gallery-sec" onclick="toggleOverlayMenu()">GALERI</a>
            <a href="#rsvp-sec" onclick="toggleOverlayMenu()">RSVP</a>
        </div>
    </div>

    <!-- Top floating hamburger menu -->
    <div class="menu-trigger" id="menuTrigger" onclick="toggleOverlayMenu()">
        <i class="bi bi-list"></i>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" type="audio/mpeg">
        </audio>

        <!-- HERO -->
        <section id="home" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
            <span class="section-subtitle">The Marriage Celebration</span>
            <h1 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300; text-transform: uppercase; color: var(--primary-dark);">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
            <div class="script-divider">Love Begins</div>
            <h4 style="font-family: var(--font-sans); font-size: 0.9rem; letter-spacing: 2px; font-weight: 600;">
                {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
            </h4>
        </section>

        <!-- MEMPELAI -->
        <section id="couple-sec">
            <span class="section-subtitle">Meet The Couple</span>
            <h2 class="section-title">Mempelai</h2>
            
            <div class="couple-wrapper" data-aos="fade-up">
                <div class="capsule-photo" style="background-image: url('{{ $bg['groom'] }}');"></div>
                <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                <p class="couple-parent">Putra dari Pasangan<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
            </div>

            <div class="couple-wrapper" data-aos="fade-up">
                <div class="capsule-photo" style="background-image: url('{{ $bg['bride'] }}');"></div>
                <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                <p class="couple-parent">Putri dari Pasangan<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
            </div>
        </section>

        <!-- ACARA -->
        <section id="event-sec">
            <span class="section-subtitle">Save The Time</span>
            <h2 class="section-title">Acara</h2>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[0]['title'] }}</h3>
                <p style="font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.85rem;"><i class="bi bi-clock"></i> {{ $schedule[0]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">{{ $schedule[0]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[1]['title'] }}</h3>
                <p style="font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.85rem;"><i class="bi bi-clock"></i> {{ $schedule[1]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">{{ $schedule[1]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <p style="font-weight: 600; margin-bottom: 5px;">{{ $event['location'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light);">{{ $event['address'] }}</p>
                <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">
                    <i class="bi bi-geo-alt"></i> Buka Google Maps
                </a>
            </div>

            <div class="countdown-container" data-aos="fade-up">
                <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
            </div>
        </section>

        <!-- TIMELINE KISAH -->
        <section id="story-sec">
            <span class="section-subtitle">Our Timeline</span>
            <h2 class="section-title">Cerita Kami</h2>

            <div class="story-timeline">
                @foreach($stories as $s)
                <div class="story-item" data-aos="fade-up">
                    <div class="story-date">{{ $s['date'] }}</div>
                    <h4 class="story-title">{{ $s['title'] }}</h4>
                    <p class="story-content">{{ $s['text'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- GALERI -->
        <section id="gallery-sec">
            <span class="section-subtitle">Photo Gallery</span>
            <h2 class="section-title">Galeri</h2>

            <div class="gallery-grid">
                @foreach($gallery as $img)
                <div class="gallery-item" data-aos="zoom-in">
                    <img src="{{ $img }}" alt="Gallery Image">
                </div>
                @endforeach
            </div>
        </section>

        <!-- HADIAH -->
        <section id="gift-sec">
            <span class="section-subtitle">Share Blessings</span>
            <h2 class="section-title">Hadiah</h2>

            <div class="gift-box" data-aos="fade-up">
                <p style="font-weight: bold; font-size: 0.8rem; color: var(--primary);">TRANSFER BANK</p>
                <h3 style="font-family: var(--font-serif); margin: 5px 0;">123-456-7890</h3>
                <p style="font-size: 0.8rem; color: var(--text-light); mb-2">BCA a.n. {{ $couple['groom'] }}</p>
                <button class="btn-copy" onclick="copyRek('123-456-7890')">SALIN REKENING</button>
            </div>
        </section>

        <!-- RSVP -->
        <section id="rsvp-sec">
            <span class="section-subtitle">Be Our Guest</span>
            <h2 class="section-title">RSVP</h2>

            <div class="form-wrap" data-aos="fade-up">
                <form id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div class="form-group">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" id="nama" class="form-input" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kehadiran</label>
                        <select id="kehadiran" class="form-input" required>
                            <option value="Hadir">Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ucapan & Doa Restu</label>
                        <textarea id="pesan" class="form-input" rows="3" placeholder="Tulis doa restu Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">KIRIM UCAPAN</button>
                </form>
            </div>

            <div class="wish-list">
                <div class="wish-card">
                    <div class="wish-header">
                        <span class="wish-name">Hendra</span>
                        <span class="wish-status">Hadir</span>
                    </div>
                    <p class="wish-content">Selamat Raka & Nadya! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.</p>
                </div>
                <div id="wishList"></div>
            </div>
        </section>

        <div style="text-align: center; font-size: 0.7rem; color: var(--text-light); margin-top: 30px;">
            Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
        </div>
    </div>

    <!-- Floating controls -->
    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
        <div class="scroll-control" id="scrollControl" onclick="toggleAutoscroll()">
            <i class="bi bi-chevron-double-down"></i>
            <span class="scroll-badge">Auto Scroll</span>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50 });

        let isAutoscrolling = false;
        let autoscrollSpeed = 0.6;

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio play blocked."));
            document.getElementById('menuTrigger').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        function toggleOverlayMenu() {
            document.getElementById('overlayMenu').classList.toggle('open');
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); ctrl.classList.add('playing'); }
            else { audio.pause(); ctrl.classList.remove('playing'); }
        }

        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            const current = window.innerHeight + window.pageYOffset;
            if (current >= (document.documentElement.scrollHeight - 5)) { stopAutoscroll(); return; }
            requestAnimationFrame(scrollStep);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.add('active');
            ctrl.querySelector('i').className = 'bi bi-pause-fill';
            requestAnimationFrame(scrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.remove('active');
            ctrl.querySelector('i').className = 'bi bi-chevron-double-down';
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = 'hidden';
            initCountdown();
            ['wheel', 'touchstart'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });
        });

        function initCountdown() {
            const target = new Date("{{ $event['date_iso'] ?? '2026-12-12' }}T09:00:00").getTime();
            setInterval(() => {
                const now = new Date().getTime();
                const diff = target - now;
                if (diff <= 0) return;
                document.getElementById('days').innerText = String(Math.floor(diff / 86400000)).padStart(2, '0');
                document.getElementById('hours').innerText = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                document.getElementById('minutes').innerText = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                document.getElementById('seconds').innerText = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
            }, 1000);
        }

        function copyRek(num) {
            navigator.clipboard.writeText(num);
            alert("Nomor rekening berhasil disalin!");
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const status = document.getElementById('kehadiran').value;
            const msg = document.getElementById('pesan').value;
            const card = document.createElement('div');
            card.className = 'wish-card';
            card.innerHTML = `<div class="wish-header"><span class="wish-name">${name}</span><span class="wish-status">${status}</span></div><p class="wish-content">${msg}</p>`;
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP berhasil dikirim!");
        }
    </script>
</body>
</html>