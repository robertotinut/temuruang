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
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=DM+Serif+Display:ital@0;1&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #1b365d; 
            --primary-dark: #0e1e36;
            --accent: #f2f5f9; 
            --bg-dark: #070e1a; 
            --text-dark: #333;
            --text-light: #666;
            --font-serif: 'DM Serif Display', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Allura', cursive;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow: hidden; }

        .wrapper { width: 100%; max-width: 480px; height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); background: var(--accent); }
        
        /* CSS Snap scroll container */
        .snap-container { height: 100%; overflow-y: scroll; scroll-snap-type: y mandatory; scroll-behavior: smooth; -webkit-overflow-scrolling: touch; scrollbar-width: none; }
        .snap-container::-webkit-scrollbar { width: 0; height: 0; }

        section { height: 100vh; scroll-snap-align: start; padding: 50px 25px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; position: relative; box-sizing: border-box; }
        section::before { content: ''; position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1603486002664-a7319421e133?q=80&w=600&auto=format&fit=crop') repeat; opacity: 0.15; z-index: -1; }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: white; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }

        .section-subtitle { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 10px; font-weight: 600; }
        .section-title { font-family: var(--font-serif); font-size: 2rem; color: var(--primary-dark); margin-bottom: 20px; font-weight: 400; }
        .script-divider { font-family: var(--font-script); font-size: 2.3rem; color: var(--primary); margin: 10px 0; }

        /* Side navigation dots */
        .side-dots { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); display: flex; flex-direction: column; gap: 12px; z-index: 100; opacity: 0; visibility: hidden; transition: opacity 0.5s; }
        .side-dots.visible { opacity: 1; visibility: visible; }
        .dot { width: 8px; height: 8px; border-radius: 50%; border: 1.5px solid var(--primary-dark); background: transparent; cursor: pointer; transition: all 0.3s; }
        .dot.active { background: var(--primary-dark); transform: scale(1.4); }

        .couple-photo { width: 120px; height: 120px; border-radius: 50%; background-size: cover; background-position: center; margin: 0 auto 15px; border: 3px solid var(--primary); box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .couple-name { font-family: var(--font-serif); font-size: 1.3rem; color: var(--primary-dark); }
        
        .event-box { background: white; border-radius: 16px; padding: 25px 20px; width: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-top: 15px; border: 1px solid rgba(0,0,0,0.03); }
        .countdown-container { display: flex; justify-content: center; gap: 8px; margin-top: 15px; }
        .countdown-box { background: var(--primary); border-radius: 8px; width: 50px; height: 50px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; }
        .countdown-box span:first-child { font-size: 1.1rem; font-family: var(--font-serif); font-weight: 600; }
        .countdown-box span:last-child { font-size: 0.5rem; text-transform: uppercase; }

        .story-timeline { text-align: left; max-height: 250px; overflow-y: auto; padding-right: 5px; width: 100%; }
        .story-item { border-left: 2px solid var(--primary); padding-left: 15px; position: relative; margin-bottom: 20px; }
        .story-item::before { content: ''; position: absolute; left: -6px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background: var(--primary-dark); }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; width: 100%; }
        .gallery-item { border-radius: 12px; overflow: hidden; aspect-ratio: 1; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        .form-wrap { background: white; padding: 20px 15px; border-radius: 16px; width: 100%; text-align: left; border: 1px solid rgba(0,0,0,0.02); }
        .form-group { margin-bottom: 10px; }
        .form-label { font-size: 0.75rem; font-weight: 600; display: block; margin-bottom: 3px; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.8rem; }

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
        <div>
            <p style="letter-spacing: 4px; font-size: 0.75rem; text-transform: uppercase;">Undangan Pernikahan</p>
            <h1 style="font-family: var(--font-script); font-size: 3rem; color: var(--primary); margin: 15px 0;">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.75rem; text-transform: uppercase;">Kpd. Yth:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.3rem; margin: 5px 0;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()" style="padding: 12px 30px; border-radius: 30px; background: var(--primary); color: white; border: none; font-weight: 600; letter-spacing: 1px; cursor: pointer;">
            BUKA UNDANGAN
        </button>
    </div>

    <!-- Side dots navigation -->
    <div class="side-dots" id="sideDots">
        <div class="dot active" onclick="scrollToSection('home')"></div>
        <div class="dot" onclick="scrollToSection('couple-sec')"></div>
        <div class="dot" onclick="scrollToSection('event-sec')"></div>
        <div class="dot" onclick="scrollToSection('story-sec')"></div>
        <div class="dot" onclick="scrollToSection('gallery-sec')"></div>
        <div class="dot" onclick="scrollToSection('rsvp-sec')"></div>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3" type="audio/mpeg">
        </audio>

        <div class="snap-container" id="snapContainer">
            <!-- HERO -->
            <section id="home">
                <span class="section-subtitle">Save The Date</span>
                <h1 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300;">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
                <div class="script-divider">The Marriage</div>
                <h4 style="font-family: var(--font-sans); font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; margin-top: 10px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}
                </h4>
            </section>

            <!-- MEMPELAI -->
            <section id="couple-sec">
                <span class="section-subtitle">Groom & Bride</span>
                <h2 class="section-title">Mempelai</h2>
                
                <div style="width: 100%; display: flex; justify-content: space-around; gap: 10px; margin-top: 10px;">
                    <div style="flex: 1;">
                        <div class="couple-photo" style="background-image: url('{{ $bg['groom'] }}');"></div>
                        <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                        <p style="font-size: 0.7rem; color: var(--text-light); margin-top: 5px;">{{ $couple['parents']['groom'] }}</p>
                    </div>
                    <div style="flex: 1;">
                        <div class="couple-photo" style="background-image: url('{{ $bg['bride'] }}');"></div>
                        <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                        <p style="font-size: 0.7rem; color: var(--text-light); margin-top: 5px;">{{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </section>

            <!-- ACARA -->
            <section id="event-sec">
                <span class="section-subtitle">The Ceremony</span>
                <h2 class="section-title">Waktu & Lokasi</h2>

                <div class="event-box">
                    <p style="font-size: 0.8rem; font-weight: 600; color: var(--primary);">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p style="font-size: 0.75rem; margin-top: 5px;"><strong>{{ $schedule[0]['title'] }}:</strong> {{ $schedule[0]['time'] }}</p>
                    <p style="font-size: 0.75rem;"><strong>{{ $schedule[1]['title'] }}:</strong> {{ $schedule[1]['time'] }}</p>
                    <p style="font-size: 0.75rem; margin-top: 5px; color: var(--text-light);">{{ $event['location'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">Maps</a>
                </div>

                <div class="countdown-container">
                    <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                    <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                    <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                    <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
                </div>
            </section>

            <!-- STORIES -->
            <section id="story-sec">
                <span class="section-subtitle">Our Timeline</span>
                <h2 class="section-title">Cerita</h2>

                <div class="story-timeline">
                    @foreach($stories as $s)
                    <div class="story-item">
                        <p style="font-size: 0.75rem; font-weight: 600; color: var(--primary);">{{ $s['date'] }} - {{ $s['title'] }}</p>
                        <p style="font-size: 0.75rem; color: var(--text-light); margin-top: 2px;">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- GALERI -->
            <section id="gallery-sec">
                <span class="section-subtitle">Memories</span>
                <h2 class="section-title">Galeri</h2>

                <div class="gallery-grid">
                    @foreach($gallery as $img)
                    <div class="gallery-item">
                        <img src="{{ $img }}" alt="Gallery Image">
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- RSVP -->
            <section id="rsvp-sec">
                <span class="section-subtitle">Join Us</span>
                <h2 class="section-title">RSVP</h2>

                <div class="form-wrap">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <input type="text" id="nama" class="form-input" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <select id="kehadiran" class="form-input" required>
                                <option value="Hadir">Saya Akan Hadir</option>
                                <option value="Tidak Hadir">Berhalangan Hadir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea id="pesan" class="form-input" rows="2" placeholder="Doa Restu & Ucapan" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit" style="padding: 10px;">KIRIM</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Floating controllers directly under body to keep fixed coordinates stable in snap context -->
    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
        <div class="scroll-control" id="scrollControl" onclick="toggleAutoscroll()">
            <i class="bi bi-chevron-double-down"></i>
            <span class="scroll-badge">Auto Play</span>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        let isAutoscrolling = false;
        let autoAdvanceInterval;

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio block."));
            document.getElementById('sideDots').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        function scrollToSection(id) {
            const el = document.getElementById(id);
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); ctrl.classList.add('playing'); }
            else { audio.pause(); ctrl.classList.remove('playing'); }
        }

        // Snap Scroll Auto-Advance periodically
        function advanceSection() {
            const sections = ['home', 'couple-sec', 'event-sec', 'story-sec', 'gallery-sec', 'rsvp-sec'];
            const container = document.getElementById('snapContainer');
            
            // Find which section is currently visible based on scroll position
            const scrollPos = container.scrollTop;
            const height = container.clientHeight;
            let currentIdx = Math.round(scrollPos / height);
            
            let nextIdx = (currentIdx + 1) % sections.length;
            scrollToSection(sections[nextIdx]);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.add('active');
            ctrl.querySelector('i').className = 'bi bi-pause-fill';
            
            autoAdvanceInterval = setInterval(advanceSection, 6000);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.remove('active');
            ctrl.querySelector('i').className = 'bi bi-chevron-double-down';
            
            clearInterval(autoAdvanceInterval);
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        document.addEventListener("DOMContentLoaded", function() {
            initCountdown();
            
            // Stop auto advance if user touches/scrolls the container
            const container = document.getElementById('snapContainer');
            ['touchstart', 'wheel'].forEach(evt => {
                container.addEventListener(evt, () => {
                    if (isAutoscrolling) stopAutoscroll();
                }, { passive: true });
            });

            // Intersection Observer to highlight active dots
            const sections = document.querySelectorAll('section');
            const dots = document.querySelectorAll('.dot');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        dots.forEach(dot => {
                            dot.classList.remove('active');
                            if (dot.getAttribute('onclick').includes(id)) {
                                dot.classList.add('active');
                            }
                        });
                    }
                });
            }, {
                root: container,
                threshold: 0.5
            });
            sections.forEach(sec => observer.observe(sec));
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
            alert("RSVP berhasil dikirim!");
            document.getElementById('rsvp-form').reset();
        }
    </script>
</body>
</html>