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
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,600;1,400&family=Italianno&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #8a73b2; 
            --primary-dark: #624f85;
            --accent: #f5f3f9; 
            --bg-dark: #160f22; 
            --bg-light: #fcfbf9; 
            --text-dark: #3a3834;
            --text-light: #7e7870;
            --font-serif: 'Bodoni Moda', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Italianno', cursive;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: url('https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?q=80&w=600&auto=format&fit=crop') repeat; min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding: 12px; padding-bottom: 90px; }
        .inner-wrapper { border: 2px solid var(--primary); outline: 1px solid var(--primary); outline-offset: -6px; min-height: calc(100vh - 24px); width: 100%; border-radius: 4px; background: rgba(252, 251, 249, 0.5); backdrop-filter: blur(2px); }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.75)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: white; text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-header p { font-size: 0.8rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); margin-bottom: 15px; }
        .cover-title { font-family: var(--font-script); font-size: 3.5rem; color: var(--primary); margin: 10px 0; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .cover-guest-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 25px 20px; border-radius: 12px; width: 100%; margin-bottom: 30px; }
        .cover-guest-card span { font-size: 0.75rem; color: #ddd; text-transform: uppercase; letter-spacing: 2px; }
        .cover-guest-card h3 { font-family: var(--font-serif); font-size: 1.3rem; color: white; margin: 10px 0; font-weight: 400; }
        
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: var(--primary); color: white; font-family: var(--font-sans); font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; padding: 12px 25px; border-radius: 30px; border: none; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: all 0.3s ease; animation: pulse 2s infinite; }
        .btn-open:hover { background-color: white; color: var(--text-dark); }
        @keyframes pulse { 0% { transform: scale(1); } 70% { transform: scale(1.03); } 100% { transform: scale(1); } }

        .bottom-nav { position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: calc(100% - 40px); max-width: 440px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(197, 168, 128, 0.3); border-radius: 40px; display: flex; justify-content: space-around; padding: 10px 15px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); z-index: 999; opacity: 0; visibility: hidden; transition: opacity 0.5s ease, visibility 0.5s ease; }
        .bottom-nav.visible { opacity: 1; visibility: visible; }
        .nav-item { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: var(--text-light); font-size: 0.65rem; font-weight: 500; transition: color 0.3s; }
        .nav-item i { font-size: 1.1rem; margin-bottom: 2px; }
        .nav-item.active { color: var(--primary-dark); }

        section { padding: 50px 15px; position: relative; text-align: center; }
        .section-frame { border: 1px solid rgba(197, 168, 128, 0.25); padding: 40px 20px; position: relative; border-radius: 12px; background: rgba(255, 255, 255, 0.88); box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        
        .corner-ornament { position: absolute; width: 35px; height: 35px; }
        .corner-tl { top: 12px; left: 12px; }
        .corner-tr { top: 12px; right: 12px; transform: scaleX(-1); }
        .corner-bl { bottom: 12px; left: 12px; transform: scaleY(-1); }
        .corner-br { bottom: 12px; right: 12px; transform: scale(-1); }

        .section-subtitle { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 10px; font-weight: 600; display: block; }
        .section-title { font-family: var(--font-serif); font-size: 2rem; color: var(--text-dark); margin-bottom: 25px; font-weight: 400; }
        .script-divider { font-family: var(--font-script); font-size: 2.2rem; color: var(--primary); margin: 15px 0; }

        .couple-wrapper { margin: 35px 0; }
        .photo-container { position: relative; width: 160px; height: 180px; margin: 0 auto 15px; filter: drop-shadow(0 8px 12px rgba(0,0,0,0.12)); display: flex; align-items: center; justify-content: center; }
        .photo-border { width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; display: flex; align-items: center; justify-content: center; }
        .photo-img { border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; width: 95%; height: 95%; background-size: cover; background-position: center; }

        .couple-name { font-family: var(--font-serif); font-size: 1.5rem; color: var(--text-dark); margin-bottom: 6px; }
        .couple-parent { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .event-card { background: white; border: 1px solid rgba(197, 168, 128, 0.2); padding: 25px 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-bottom: 25px; }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.3rem; color: var(--text-dark); margin-bottom: 12px; font-weight: 400; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: var(--primary-dark); border: 1.5px solid var(--primary); padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-top: 15px; transition: all 0.3s; }
        .btn-action:hover { background: var(--primary); color: white; }

        .countdown-container { display: flex; justify-content: center; gap: 10px; margin: 20px 0; }
        .countdown-box { background: white; border: 1px solid rgba(197, 168, 128, 0.2); border-radius: 8px; width: 60px; height: 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .countdown-box span:first-child { font-size: 1.2rem; font-family: var(--font-serif); font-weight: 600; color: var(--primary-dark); }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; color: var(--text-light); }

        .story-timeline { text-align: left; padding-left: 20px; border-left: 2px solid var(--accent); margin-top: 25px; }
        .story-item { position: relative; margin-bottom: 30px; }
        .story-item::before { content: ''; position: absolute; left: -27px; top: 4px; width: 12px; height: 12px; border-radius: 50%; background: var(--primary); border: 2px solid white; }
        .story-date { font-weight: 600; font-size: 0.8rem; color: var(--primary-dark); margin-bottom: 5px; }
        .story-title { font-family: var(--font-serif); font-size: 1.1rem; margin-bottom: 8px; }
        .story-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .gallery-item { border-radius: 8px; overflow: hidden; aspect-ratio: 1; box-shadow: 0 4px 10px rgba(0,0,0,0.03); }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .gallery-item:hover img { transform: scale(1.1); }

        .gift-box { background: white; border: 1px dashed var(--primary); padding: 25px; border-radius: 12px; margin-top: 20px; }
        .btn-copy { background: var(--primary); color: white; border: none; padding: 8px 20px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 10px; }

        .form-wrap { background: white; border: 1px solid rgba(197, 168, 128, 0.2); padding: 25px 15px; border-radius: 12px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.85rem; }
        .btn-submit { width: 100%; padding: 12px; background: var(--primary); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; text-align: left; }
        .wish-card { background: white; padding: 12px; border-radius: 8px; border-left: 4px solid var(--primary); margin-bottom: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; }
        .wish-status { background: #f0ebe4; padding: 2px 8px; border-radius: 10px; font-size: 0.65rem; }
        .wish-content { font-size: 0.75rem; color: var(--text-light); }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 95px; right: 20px; }
        .scroll-control { bottom: 155px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-control.active i { color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p>The Wedding Invitation of</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span>Kepada Yth. Bapak/Ibu/Saudara/i:</span>
            <h3>{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
            <p style="font-size: 0.7rem; color: #ddd; margin-top: 5px;">Kami memohon kehadiran Anda di hari bahagia kami</p>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            <i class="bi bi-envelope-open"></i> BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <div class="inner-wrapper">
            <audio id="bg-audio" loop preload="auto">
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
            </audio>

            <!-- HERO -->
            <section id="home">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    
                    <span class="section-subtitle">Save The Date</span>
                    <h2>{{ $couple['groom'] }} & {{ $couple['bride'] }}</h2>
                    <div class="script-divider">The Wedding</div>
                    <h4 style="font-family: var(--font-serif); font-size: 1.1rem; font-weight: 400; margin-top: 15px;">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}
                    </h4>
                </div>
            </section>

            <!-- MEMPELAI -->
            <section id="couple-sec">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    
                    <span class="section-subtitle">Groom & Bride</span>
                    <h2 class="section-title">Mempelai</h2>
                    <p style="font-size: 0.8rem; line-height: 1.6; color: var(--text-light); margin-bottom: 25px;">
                        Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Dengan memohon rahmat dan ridho-Mu, kami mengundang Anda menghadiri hari bahagia kami:
                    </p>

                    <div class="couple-wrapper" data-aos="fade-up">
                        <div class="photo-container">
                            <div class="photo-border">
                                <div class="photo-img" style="background-image: url('{{ $bg['groom'] }}');"></div>
                            </div>
                        </div>
                        <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                        <p class="couple-parent">Putra Kedua dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                    </div>

                    <div class="script-divider">&</div>

                    <div class="couple-wrapper" data-aos="fade-up">
                        <div class="photo-container">
                            <div class="photo-border">
                                <div class="photo-img" style="background-image: url('{{ $bg['bride'] }}');"></div>
                            </div>
                        </div>
                        <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                        <p class="couple-parent">Putri Pertama dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                    </div>
                </div>
            </section>

            <!-- ACARA -->
            <section id="event-sec">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    
                    <span class="section-subtitle">Save The Date</span>
                    <h2 class="section-title">Acara Pernikahan</h2>

                    <div class="event-card" data-aos="fade-up">
                        <h3>{{ $schedule[0]['title'] }}</h3>
                        <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                            {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                        </p>
                        <p style="font-size: 0.8rem; margin-bottom: 12px;"><i class="bi bi-clock"></i> Pukul {{ $schedule[0]['time'] }}</p>
                        <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[0]['note'] }}</p>
                    </div>

                    <div class="event-card" data-aos="fade-up">
                        <h3>{{ $schedule[1]['title'] }}</h3>
                        <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                            {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                        </p>
                        <p style="font-size: 0.8rem; margin-bottom: 12px;"><i class="bi bi-clock"></i> Pukul {{ $schedule[1]['time'] }}</p>
                        <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[1]['note'] }}</p>
                    </div>

                    <div class="event-card" data-aos="fade-up">
                        <p style="font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">{{ $event['location'] }}</p>
                        <p style="font-size: 0.75rem; color: var(--text-light); line-height: 1.5;">{{ $event['address'] }}</p>
                        <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">
                            <i class="bi bi-geo-alt"></i> LIHAT PETA LOKASI
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
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <span class="section-subtitle">Our Love Journey</span>
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
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" /></svg>
                    <span class="section-subtitle">Our Memories</span>
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

            <!-- GIFT / DOMPET -->
            <section id="gift-sec">
                <div class="section-frame">
                    <span class="section-subtitle">Share Love</span>
                    <h2 class="section-title">Kirim Hadiah</h2>
                    <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.6;">
                        Bagi keluarga dan sahabat yang ingin mengirimkan hadiah, dapat mengirimkan secara non-tunai melalui rekening berikut:
                    </p>

                    <div class="gift-box" data-aos="fade-up">
                        <p style="font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; color: var(--primary-dark);">BANK BCA</p>
                        <h3 style="font-family: var(--font-serif); margin: 8px 0; font-size: 1.4rem;">123-456-7890</h3>
                        <p style="font-size: 0.8rem; color: var(--text-light);">a.n. {{ $couple['groom'] }}</p>
                        <button class="btn-copy" onclick="copyRek('123-456-7890')">SALIN REKENING</button>
                    </div>
                </div>
            </section>

            <!-- RSVP -->
            <section id="rsvp-sec">
                <div class="section-frame">
                    <span class="section-subtitle">Join Our Joy</span>
                    <h2 class="section-title">RSVP & Ucapan</h2>

                    <div class="form-wrap" data-aos="fade-up">
                        <form id="rsvp-form" onsubmit="submitRsvp(event)">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" class="form-input" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Kehadiran</label>
                                <select id="kehadiran" class="form-input" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Tidak Hadir">Berhalangan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ucapan & Doa</label>
                                <textarea id="pesan" class="form-input" rows="4" placeholder="Tulis ucapan selamat Anda" required></textarea>
                            </div>
                            <button type="submit" class="btn-submit">KIRIM KONFIRMASI</button>
                        </form>
                    </div>

                    <div class="wish-list">
                        <div class="wish-card">
                            <div class="wish-header">
                                <span class="wish-name">Rian & Keluarga</span>
                                <span class="wish-status">Hadir</span>
                            </div>
                            <p class="wish-content">Selamat menempuh hidup baru! Semoga lancar dan berkah selalu.</p>
                        </div>
                        <div class="wish-card">
                            <div class="wish-header">
                                <span class="wish-name">Siti</span>
                                <span class="wish-status">Berhalangan</span>
                            </div>
                            <p class="wish-content">Maaf berhalangan hadir. Selamat berbahagia ya, doa terbaik untuk kalian!</p>
                        </div>
                        <div id="wishList"></div>
                    </div>
                </div>
            </section>

            <div style="text-align: center; padding: 30px; font-size: 0.7rem; color: var(--text-light);">
                Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
            </div>
        </div>
    </div>

    <!-- Navigasi Bawah -->
    <div class="bottom-nav" id="bottomNav">
        <a href="#home" class="nav-item active"><i class="bi bi-house-door"></i><span>Home</span></a>
        <a href="#couple-sec" class="nav-item"><i class="bi bi-heart"></i><span>Mempelai</span></a>
        <a href="#event-sec" class="nav-item"><i class="bi bi-calendar-event"></i><span>Acara</span></a>
        <a href="#story-sec" class="nav-item"><i class="bi bi-book"></i><span>Cerita</span></a>
        <a href="#rsvp-sec" class="nav-item"><i class="bi bi-envelope"></i><span>RSVP</span></a>
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
            }).catch(err => console.log("Autoplay blocked. User interaction required."));
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const control = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); control.classList.add('playing'); }
            else { audio.pause(); control.classList.remove('playing'); }
        }

        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            const currentScroll = window.innerHeight + window.pageYOffset;
            const bottomLimit = document.documentElement.scrollHeight - 5;
            if (currentScroll >= bottomLimit) { stopAutoscroll(); return; }
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
            alert(" RSVP berhasil dikirim!");
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