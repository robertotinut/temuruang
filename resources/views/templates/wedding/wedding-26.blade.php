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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Montserrat:wght@300;400;500;600&family=Pinyon+Script&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #c5a880; 
            --primary-dark: #a98c64;
            --accent: #333333; 
            --bg-dark: #121212; 
            --text-dark: #2c2d2c;
            --text-light: #5a5d5a;
            --font-serif: 'Cinzel', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Pinyon Script', cursive;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: var(--accent); min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding-bottom: 80px; border-left: 1px solid rgba(0,0,0,0.1); border-right: 1px solid rgba(0,0,0,0.1); }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.8)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 60px 30px; color: white; text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-title { font-family: var(--font-serif); font-size: 2.8rem; letter-spacing: 2px; text-transform: uppercase; color: white; margin: 15px 0; font-weight: 300; }
        .cover-guest-card { background: transparent; border: 1px solid rgba(255,255,255,0.4); padding: 25px 20px; width: 100%; margin-bottom: 30px; }
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: white; color: black; font-family: var(--font-sans); font-weight: 600; font-size: 0.8rem; letter-spacing: 3px; padding: 14px 30px; border: none; cursor: pointer; transition: all 0.3s; }

        /* Asymmetric vertical grid lines */
        .wrapper::before { content: ''; position: absolute; top: 0; left: 30px; bottom: 0; width: 1px; background: rgba(0,0,0,0.04); z-index: 0; pointer-events: none; }

        /* Minimalist bottom nav with text links */
        .bottom-nav-text { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; background: var(--bg-dark); border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-around; padding: 18px 0; z-index: 1000; opacity: 0; visibility: hidden; transition: opacity 0.5s, visibility 0.5s; }
        .bottom-nav-text.visible { opacity: 1; visibility: visible; }
        .nav-item { color: #888; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; font-family: var(--font-sans); transition: color 0.3s; }
        .nav-item.active { color: var(--primary); font-weight: 600; }

        section { padding: 70px 25px 50px; position: relative; text-align: left; z-index: 1; }

        .section-subtitle { font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 15px; font-weight: 600; display: block; }
        .section-title { font-family: var(--font-serif); font-size: 2.2rem; color: var(--text-dark); margin-bottom: 30px; font-weight: 300; text-transform: uppercase; border-bottom: 1px solid rgba(0,0,0,0.06); padding-bottom: 10px; }
        
        /* Polaroid asymmetrically aligned */
        .couple-wrapper { margin: 40px 0; }
        .polaroid-frame { background: white; padding: 15px 15px 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); display: inline-block; width: 85%; transform: rotate(-2deg); }
        .couple-wrapper.bride-side { text-align: right; }
        .couple-wrapper.bride-side .polaroid-frame { transform: rotate(2deg); }
        .polaroid-img { width: 100%; aspect-ratio: 1; background-size: cover; background-position: center; border: 1px solid #eee; margin-bottom: 15px; }

        .couple-name { font-family: var(--font-serif); font-size: 1.5rem; color: var(--text-dark); margin-bottom: 6px; font-weight: 400; }
        .couple-parent { font-size: 0.75rem; color: var(--text-light); line-height: 1.5; }

        .event-card { border: 1px solid rgba(0,0,0,0.1); padding: 30px 20px; margin-bottom: 20px; }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.25rem; font-weight: 400; color: var(--text-dark); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .btn-action { display: inline-block; background: transparent; color: var(--text-dark); border-bottom: 1.5px solid var(--primary); text-decoration: none; font-size: 0.8rem; font-weight: 600; padding: 3px 0; margin-top: 15px; }

        .countdown-container { display: flex; gap: 8px; margin: 25px 0; }
        .countdown-box { background: white; border: 1px solid rgba(0,0,0,0.1); width: 60px; height: 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .countdown-box span:first-child { font-size: 1.25rem; font-family: var(--font-serif); font-weight: 600; }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; color: var(--text-light); }

        .story-timeline { text-align: left; }
        .story-item { margin-bottom: 30px; position: relative; }
        .story-date { font-weight: 600; font-size: 0.85rem; color: var(--primary); margin-bottom: 5px; font-family: var(--font-sans); }
        .story-title { font-family: var(--font-serif); font-size: 1.2rem; font-weight: 400; margin-bottom: 8px; }
        .story-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.6; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .gallery-item { border-radius: 4px; overflow: hidden; aspect-ratio: 0.8; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        .gift-box { border: 1px solid rgba(0,0,0,0.1); padding: 30px 20px; margin-top: 20px; }
        .btn-copy { background: var(--text-dark); color: white; border: none; padding: 10px 25px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 15px; letter-spacing: 1px; }

        .form-wrap { border: 1px solid rgba(0,0,0,0.1); padding: 30px 20px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .form-input { width: 100%; padding: 12px; border: 1px solid #bbb; font-size: 0.85rem; background: transparent; }
        .btn-submit { width: 100%; padding: 14px; background: var(--text-dark); color: white; border: none; font-weight: 600; cursor: pointer; letter-spacing: 2px; text-transform: uppercase; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; }
        .wish-card { border-bottom: 1px solid rgba(0,0,0,0.1); padding: 15px 0; }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; color: var(--text-dark); }
        .wish-status { color: var(--primary); font-weight: 600; }
        .wish-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 75px; right: 20px; }
        .scroll-control { bottom: 135px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--text-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 2px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p style="letter-spacing: 5px; font-size: 0.7rem; text-transform: uppercase;">Undangan Acara</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; color: #ccc;">Yth:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.4rem; font-weight: 300; margin-top: 5px;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3" type="audio/mpeg">
        </audio>

        <!-- HERO -->
        <section id="home" style="min-height: 70vh; display: flex; flex-direction: column; justify-content: center;">
            <span class="section-subtitle">The Marriage Celebration</span>
            <h1 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300;">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
            <h4 style="font-family: var(--font-sans); font-size: 0.85rem; font-weight: 600; letter-spacing: 3px; margin-top: 15px; text-transform: uppercase;">
                {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}
            </h4>
        </section>

        <!-- MEMPELAI -->
        <section id="couple-sec">
            <span class="section-subtitle">The Bride & Groom</span>
            <h2 class="section-title">Mempelai</h2>

            <div class="couple-wrapper" data-aos="fade-up">
                <div class="polaroid-frame">
                    <div class="polaroid-img" style="background-image: url('{{ $bg['groom'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                    <p class="couple-parent">Putra dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                </div>
            </div>

            <div class="couple-wrapper bride-side" data-aos="fade-up">
                <div class="polaroid-frame">
                    <div class="polaroid-img" style="background-image: url('{{ $bg['bride'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                    <p class="couple-parent">Putri dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                </div>
            </div>
        </section>

        <!-- ACARA -->
        <section id="event-sec">
            <span class="section-subtitle">Save The Date</span>
            <h2 class="section-title">Acara Kami</h2>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[0]['title'] }}</h3>
                <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 5px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[0]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[0]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[1]['title'] }}</h3>
                <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 5px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[1]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[1]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <p style="font-weight: 600; font-size: 0.85rem; margin-bottom: 5px; text-transform: uppercase;">{{ $event['location'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.5;">{{ $event['address'] }}</p>
                <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">LIHAT LOKASI</a>
            </div>

            <div class="countdown-container" data-aos="fade-up">
                <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
            </div>
        </section>

        <!-- STORY -->
        <section id="story-sec">
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
        </section>

        <!-- GALERI -->
        <section id="gallery-sec">
            <span class="section-subtitle">Memories</span>
            <h2 class="section-title">Galeri Foto</h2>

            <div class="gallery-grid">
                @foreach($gallery as $img)
                <div class="gallery-item" data-aos="zoom-in">
                    <img src="{{ $img }}" alt="Galeri">
                </div>
                @endforeach
            </div>
        </section>

        <!-- GIFT -->
        <section id="gift-sec">
            <span class="section-subtitle">Share Love</span>
            <h2 class="section-title">Hadiah</h2>

            <div class="gift-box" data-aos="fade-up">
                <p style="font-weight: 600; font-size: 0.8rem;">BCA TRANSFER</p>
                <h3 style="font-family: var(--font-serif); font-size: 1.3rem; margin: 5px 0;">123-456-7890</h3>
                <p style="font-size: 0.8rem; color: var(--text-light);">a.n. {{ $couple['groom'] }}</p>
                <button class="btn-copy" onclick="copyRek('123-456-7890')">SALIN REKENING</button>
            </div>
        </section>

        <!-- RSVP -->
        <section id="rsvp-sec">
            <span class="section-subtitle">Response</span>
            <h2 class="section-title">RSVP</h2>

            <div class="form-wrap" data-aos="fade-up">
                <form id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div class="form-group">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" id="nama" class="form-input" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kehadiran</label>
                        <select id="kehadiran" class="form-input" required>
                            <option value="Hadir">Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ucapan & Doa</label>
                        <textarea id="pesan" class="form-input" rows="3" placeholder="Doa Restu Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
                </form>
            </div>

            <div class="wish-list">
                <div class="wish-card">
                    <div class="wish-header">
                        <span class="wish-name">Ari & Dinda</span>
                        <span class="wish-status">Hadir</span>
                    </div>
                    <p class="wish-content">Selamat berbahagia! Doa kami menyertai langkah kalian berdua.</p>
                </div>
                <div id="wishList"></div>
            </div>
        </section>

        <div style="text-align: center; padding: 20px 0; font-size: 0.7rem; color: var(--text-light);">
            Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
        </div>
    </div>

    <!-- Textual Bottom Nav -->
    <div class="bottom-nav-text" id="bottomNav">
        <a href="#home" class="nav-item active">Home</a>
        <a href="#couple-sec" class="nav-item">Mempelai</a>
        <a href="#event-sec" class="nav-item">Acara</a>
        <a href="#story-sec" class="nav-item">Cerita</a>
        <a href="#rsvp-sec" class="nav-item">RSVP</a>
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