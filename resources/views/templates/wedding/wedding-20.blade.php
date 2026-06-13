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
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #8a1c14; 
            --primary-dark: #66100a;
            --accent: #f5eae9; 
            --bg-dark: #1f0806; 
            --text-dark: #3a3b3a;
            --text-light: #707570;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Great Vibes', cursive;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: var(--accent); min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding: 15px; padding-bottom: 95px; }

        /* Delicate watercolor background elements */
        .watercolor-bg-1, .watercolor-bg-2 { position: absolute; width: 250px; height: 250px; border-radius: 50%; filter: blur(60px); z-index: 0; opacity: 0.6; pointer-events: none; }
        .watercolor-bg-1 { top: 100px; left: -80px; background: radial-gradient(circle, var(--primary) 0%, transparent 70%); }
        .watercolor-bg-2 { bottom: 400px; right: -80px; background: radial-gradient(circle, var(--primary-dark) 0%, transparent 70%); }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.85)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: var(--text-dark); text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-title { font-family: var(--font-script); font-size: 3.5rem; color: var(--primary-dark); margin: 15px 0; }
        .cover-guest-card { background: rgba(255, 255, 255, 0.85); border: 1px solid var(--primary); padding: 25px 20px; border-radius: 30px; width: 100%; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: var(--primary-dark); color: white; font-family: var(--font-sans); font-weight: 600; font-size: 0.85rem; letter-spacing: 1.5px; padding: 12px 25px; border-radius: 30px; border: none; cursor: pointer; transition: all 0.3s; }

        /* Floating pill-shaped bottom nav */
        .bottom-nav-pill { position: fixed; bottom: 25px; left: 50%; transform: translateX(-50%); width: 85%; max-width: 380px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-radius: 50px; display: flex; justify-content: space-around; padding: 10px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08); z-index: 1000; opacity: 0; visibility: hidden; transition: opacity 0.5s, visibility 0.5s; border: 1px solid rgba(255,255,255,0.4); }
        .bottom-nav-pill.visible { opacity: 1; visibility: visible; }
        .nav-item { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: var(--text-light); font-size: 0.65rem; transition: color 0.3s; }
        .nav-item i { font-size: 1.1rem; margin-bottom: 2px; }
        .nav-item.active { color: var(--primary-dark); font-weight: bold; }

        section { padding: 50px 10px; position: relative; text-align: center; z-index: 1; }
        .section-frame { border: 1px solid rgba(255, 255, 255, 0.8); background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(10px); padding: 40px 15px; border-radius: 30px; box-shadow: 0 4px 25px rgba(0,0,0,0.02); }

        .section-subtitle { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 8px; font-weight: 600; }
        .section-title { font-family: var(--font-serif); font-size: 1.8rem; color: var(--text-dark); margin-bottom: 25px; font-weight: 400; }
        .script-divider { font-family: var(--font-script); font-size: 2.2rem; color: var(--primary-dark); margin: 15px 0; }

        /* Botanical circle frames */
        .couple-wrapper { margin: 35px 0; }
        .circle-photo { width: 140px; height: 140px; border-radius: 50%; margin: 0 auto 15px; border: 4px solid white; box-shadow: 0 6px 20px rgba(0,0,0,0.06); background-size: cover; background-position: center; }

        .couple-name { font-family: var(--font-serif); font-size: 1.4rem; color: var(--text-dark); margin-bottom: 5px; }
        .couple-parent { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .event-card { background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(255, 255, 255, 0.9); padding: 25px 20px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.01); margin-bottom: 20px; }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.2rem; color: var(--text-dark); margin-bottom: 8px; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; background: var(--primary-dark); color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-top: 10px; }

        .countdown-container { display: flex; justify-content: center; gap: 10px; margin: 20px 0; }
        .countdown-box { background: white; border: 1px solid rgba(255,255,255,0.8); border-radius: 50%; width: 60px; height: 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .countdown-box span:first-child { font-size: 1.15rem; font-family: var(--font-serif); font-weight: 600; color: var(--primary-dark); }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; color: var(--text-light); }

        .story-timeline { text-align: left; padding-left: 15px; border-left: 2px solid var(--primary); margin-top: 25px; }
        .story-item { position: relative; margin-bottom: 25px; }
        .story-item::before { content: ''; position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background: var(--primary); }
        .story-date { font-weight: 600; font-size: 0.8rem; color: var(--primary-dark); margin-bottom: 3px; }
        .story-title { font-family: var(--font-serif); font-size: 1rem; margin-bottom: 5px; }
        .story-content { font-size: 0.75rem; color: var(--text-light); line-height: 1.5; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; }
        .gallery-item { border-radius: 20px; overflow: hidden; aspect-ratio: 1; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        .gift-box { background: rgba(255, 255, 255, 0.8); padding: 25px; border-radius: 20px; margin-top: 20px; border: 1px solid rgba(255,255,255,0.9); }
        .btn-copy { background: var(--primary-dark); color: white; border: none; padding: 8px 20px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 10px; }

        .form-wrap { background: rgba(255,255,255,0.8); padding: 25px 15px; border-radius: 20px; text-align: left; border: 1px solid rgba(255,255,255,0.9); }
        .form-group { margin-bottom: 12px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 4px; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.85rem; background: white; }
        .btn-submit { width: 100%; padding: 12px; background: var(--primary-dark); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; text-align: left; }
        .wish-card { background: white; padding: 12px; border-radius: 12px; border-left: 4px solid var(--primary); margin-bottom: 10px; }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; }
        .wish-status { background: var(--accent); padding: 2px 8px; border-radius: 10px; font-size: 0.65rem; }
        .wish-content { font-size: 0.75rem; color: var(--text-light); }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 95px; right: 20px; }
        .scroll-control { bottom: 155px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary-dark); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p style="font-size: 0.75rem; letter-spacing: 3px;">WEDDING INVITATION</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.7rem; color: var(--text-light); letter-spacing: 1px;">Kpd. Yth Bapak/Ibu/Saudara/i:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.3rem; margin-top: 5px;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            <i class="bi bi-heart"></i> BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <div class="watercolor-bg-1"></div>
        <div class="watercolor-bg-2"></div>

        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3" type="audio/mpeg">
        </audio>

        <!-- HERO -->
        <section id="home">
            <div class="section-frame">
                <span class="section-subtitle">Save The Date</span>
                <h2>{{ $couple['groom'] }} & {{ $couple['bride'] }}</h2>
                <div class="script-divider">The Wedding Ceremony</div>
                <h4 style="font-family: var(--font-serif); font-size: 1rem; font-weight: 400; margin-top: 15px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d.m.y') }}
                </h4>
            </div>
        </section>

        <!-- MEMPELAI -->
        <section id="couple-sec">
            <div class="section-frame">
                <span class="section-subtitle">Groom & Bride</span>
                <h2 class="section-title">Mempelai</h2>

                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="circle-photo" style="background-image: url('{{ $bg['groom'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                    <p class="couple-parent">Putra dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                </div>

                <div class="script-divider">&</div>

                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="circle-photo" style="background-image: url('{{ $bg['bride'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                    <p class="couple-parent">Putri dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                </div>
            </div>
        </section>

        <!-- ACARA -->
        <section id="event-sec">
            <div class="section-frame">
                <span class="section-subtitle">Wedding Events</span>
                <h2 class="section-title">Waktu & Tempat</h2>

                <div class="event-card" data-aos="fade-up">
                    <h3>{{ $schedule[0]['title'] }}</h3>
                    <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary-dark); margin-bottom: 8px;">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[0]['time'] }}</p>
                    <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[0]['note'] }}</p>
                </div>

                <div class="event-card" data-aos="fade-up">
                    <h3>{{ $schedule[1]['title'] }}</h3>
                    <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary-dark); margin-bottom: 8px;">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[1]['time'] }}</p>
                    <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[1]['note'] }}</p>
                </div>

                <div class="event-card" data-aos="fade-up">
                    <p style="font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">{{ $event['location'] }}</p>
                    <p style="font-size: 0.75rem; color: var(--text-light); line-height: 1.5;">{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">
                        <i class="bi bi-geo-alt"></i> Petunjuk Arah
                    </a>
                </div>

                <div class="countdown-container" data-aos="fade-up">
                    <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                    <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                    <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                    <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
                </div>
            </div>
        </section>

        <!-- STORIES -->
        <section id="story-sec">
            <div class="section-frame">
                <span class="section-subtitle">Our Journey</span>
                <h2 class="section-title">Kisah Cinta</h2>

                <div class="story-timeline">
                    @foreach($stories as $s)
                    <div class="story-item" data-aos="fade-up">
                        <div class="story-date">{{ $s['date'] }}</div>
                        <h4 class="story-title">{{ $s['title'] }}</h4>
                        <p class="story-content">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- GALERI -->
        <section id="gallery-sec">
            <div class="section-frame">
                <span class="section-subtitle">Memories</span>
                <h2 class="section-title">Galeri Foto</h2>

                <div class="gallery-grid">
                    @foreach($gallery as $img)
                    <div class="gallery-item" data-aos="zoom-in">
                        <img src="{{ $img }}" alt="Galeri">
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- RSVP -->
        <section id="rsvp-sec">
            <div class="section-frame">
                <span class="section-subtitle">Presence</span>
                <h2 class="section-title">Konfirmasi & Ucapan</h2>

                <div class="form-wrap" data-aos="fade-up">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <label class="form-label">Nama Anda</label>
                            <input type="text" id="nama" class="form-input" placeholder="Masukkan nama" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kehadiran</label>
                            <select id="kehadiran" class="form-input" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Tidak Hadir">Berhalangan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Doa & Ucapan</label>
                            <textarea id="pesan" class="form-input" rows="3" placeholder="Tulis ucapan selamat Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">KIRIM</button>
                    </form>
                </div>

                <div class="wish-list">
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Fajar</span>
                            <span class="wish-status">Hadir</span>
                        </div>
                        <p class="wish-content">Lancar jaya berkah melimpah sakinah warahmah selamanya!</p>
                    </div>
                    <div id="wishList"></div>
                </div>
            </div>
        </section>

        <div style="text-align: center; padding: 20px 0; font-size: 0.75rem; color: var(--text-light);">
            Created with <i class="bi bi-heart-fill" style="color: var(--primary-dark);"></i> TemuRuang
        </div>
    </div>

    <!-- Floating Pill Navigation Bar -->
    <div class="bottom-nav-pill" id="bottomNav">
        <a href="#home" class="nav-item active"><i class="bi bi-house"></i><span>Home</span></a>
        <a href="#couple-sec" class="nav-item"><i class="bi bi-heart"></i><span>Mempelai</span></a>
        <a href="#event-sec" class="nav-item"><i class="bi bi-calendar"></i><span>Acara</span></a>
        <a href="#story-sec" class="nav-item"><i class="bi bi-clock-history"></i><span>Kisah</span></a>
        <a href="#rsvp-sec" class="nav-item"><i class="bi bi-chat-text"></i><span>RSVP</span></a>
    </div>

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
            }).catch(err => console.log("Blocked."));
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
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

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const items = document.querySelectorAll('.nav-item');
            let current = '';
            sections.forEach(sec => {
                if (pageYOffset >= (sec.offsetTop - 250)) current = sec.getAttribute('id');
            });
            items.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) item.classList.add('active');
            });
        });
    </script>
</body>
</html>