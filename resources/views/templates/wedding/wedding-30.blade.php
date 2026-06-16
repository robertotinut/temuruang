@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Adrian');
        $brideName = trim($names[1] ?? 'Evelyn');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Arthur Sterling & Ibu Martha Sterling',
                'bride' => 'Bpk. Benjamin Rosewood & Ibu Clara Rosewood',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-12-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '10:00',
            'location' => $invitation->location ?? 'The Sterling Royal Ballroom',
            'address' => $invitation->address ?? 'Jl. Vintage Regency No. 10, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Sterling Royal Ballroom, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Sacred Covenant',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '10:00') . ' - 12:00 WIB',
                'note' => $invitation->location ?? 'The Grand Cathedral of St. James'
            ],
            [
                'title' => 'The Reception Gala',
                'time' => '18:00 WIB - Selesai',
                'note' => $invitation->address ?? 'The Sterling Royal Ballroom, Jakarta'
            ]
        ];

        if (isset($invitation->stories) && $invitation->stories->count() > 0) {
            $stories = [];
            foreach ($invitation->stories as $story) {
                $stories[] = [
                    'title' => $story->title,
                    'date' => $story->date,
                    'text' => $story->content
                ];
            }
        } else {
            $stories = [
                ['title' => 'The First Encounter', 'date' => 'Gugur 2018', 'text' => 'Pertemuan tak sengaja di sebuah toko buku tua di Paris saat hujan sore hari.'],
                ['title' => 'The Promise', 'date' => 'Dingin 2021', 'text' => 'Di bawah gemerlap lampu kota Venesia, sebuah komitmen suci mulai terukir.'],
                ['title' => 'The Eternal Union', 'date' => 'Desember 2026', 'text' => 'Dua jalan yang berbeda kini menyatu menjadi satu perjalanan abadi yang diberkati.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-30/images/image_4.jpg'), // Polaroid 1
                asset('assets/templates/wedding-30/images/image_5.jpg'), // Filmstrip 1
                asset('assets/templates/wedding-30/images/image_6.jpg'), // Filmstrip 2
                asset('assets/templates/wedding-30/images/image_7.jpg'), // Gold Frame 1
                asset('assets/templates/wedding-30/images/image_8.jpg'), // Polaroid 2
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-30/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-30/images/image_1.jpg'),
            'bride' => asset('assets/templates/wedding-30/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-30/images/image_3.jpg'),
        ];

        if (isset($invitation->comments)) {
            $wishes = [];
            foreach ($invitation->comments as $comment) {
                $wishes[] = [
                    'name' => $comment->name,
                    'status' => $comment->status,
                    'message' => $comment->message
                ];
            }
        } else {
            $wishes = [
                ['name' => 'Keluarga Wijaya', 'status' => 'Hadir', 'message' => 'Selamat ya Adrian & Evelyn! Semoga acaranya sukses dan menjadi keluarga sakinah mawaddah warahmah.'],
                ['name' => 'Putra & Sisca', 'status' => 'Hadir', 'message' => 'Happy Wedding guys! Doa terbaik selalu menyertai perjalanan baru kalian berdua.'],
                ['name' => 'Sarah Amanda', 'status' => 'Tidak Hadir', 'message' => 'Selamat berbahagia! Mohon maaf belum bisa berpartisipasi langsung.'],
            ];
        }

        if (isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0) {
            $gifts = [];
            foreach ($invitation->bankAccounts as $bank) {
                $gifts[] = [
                    'bank' => $bank->bank_name,
                    'name' => $bank->account_name,
                    'account' => $bank->account_number
                ];
            }
        } else {
            $gifts = [
                ['bank' => 'Bank Central Asia', 'name' => 'Adrian Sterling', 'account' => '123-456-7890'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Adrian',
            'bride' => 'Evelyn',
            'parents' => [
                'groom' => 'Bpk. Arthur Sterling & Ibu Martha Sterling',
                'bride' => 'Bpk. Benjamin Rosewood & Ibu Clara Rosewood',
            ],
        ];

        $event = [
            'date_iso' => '2026-12-12',
            'time' => '10:00',
            'location' => 'The Sterling Royal Ballroom',
            'address' => 'Jl. Vintage Regency No. 10, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=The+Sterling+Royal+Ballroom',
        ];

        $schedule = [
            ['title' => 'Sacred Covenant', 'time' => '10:00 - 12:00 WIB', 'note' => 'The Grand Cathedral of St. James'],
            ['title' => 'The Reception Gala', 'time' => '18:00 WIB - Selesai', 'note' => 'The Sterling Royal Ballroom, Jakarta'],
        ];

        $stories = [
            ['title' => 'The First Encounter', 'date' => 'Gugur 2018', 'text' => 'Pertemuan tak sengaja di sebuah toko buku tua di Paris saat hujan sore hari.'],
            ['title' => 'The Promise', 'date' => 'Dingin 2021', 'text' => 'Di bawah gemerlap lampu kota Venesia, sebuah komitmen suci mulai terukir.'],
            ['title' => 'The Eternal Union', 'date' => 'Desember 2026', 'text' => 'Dua jalan yang berbeda kini menyatu menjadi satu perjalanan abadi yang diberkati.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-30/images/image_4.jpg'),
            asset('assets/templates/wedding-30/images/image_5.jpg'),
            asset('assets/templates/wedding-30/images/image_6.jpg'),
            asset('assets/templates/wedding-30/images/image_7.jpg'),
            asset('assets/templates/wedding-30/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-30/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-30/images/image_1.jpg'),
            'bride' => asset('assets/templates/wedding-30/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-30/images/image_3.jpg'),
        ];

        $wishes = [
            ['name' => 'Keluarga Wijaya', 'status' => 'Hadir', 'message' => 'Selamat ya Adrian & Evelyn! Semoga acaranya sukses dan menjadi keluarga sakinah mawaddah warahmah.'],
            ['name' => 'Putra & Sisca', 'status' => 'Hadir', 'message' => 'Happy Wedding guys! Doa terbaik selalu menyertai perjalanan baru kalian berdua.'],
            ['name' => 'Sarah Amanda', 'status' => 'Tidak Hadir', 'message' => 'Selamat berbahagia! Mohon maaf belum bisa berpartisipasi langsung.'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia', 'name' => 'Adrian Sterling', 'account' => '123-456-7890'],
        ];

        $musicUrl = asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Undangan Pernikahan | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,900&amp;family=Source+Serif+4:ital,wght@0,400;0,700;1,400&amp;family=Courier+Prime:ital,wght@0,400;0,700;1,400&amp;family=Special+Elite&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-container": "#fed65b",
                        "inverse-on-surface": "#feeedb",
                        "on-primary-fixed": "#410000",
                        "primary-fixed-dim": "#ffb4a8",
                        "surface-container-highest": "#efe0cd",
                        "secondary-fixed-dim": "#e9c349",
                        "primary-fixed": "#ffdad4",
                        "on-secondary-container": "#745c00",
                        "on-error": "#ffffff",
                        "surface-variant": "#efe0cd",
                        "on-primary": "#ffffff",
                        "surface-dim": "#e7d8c5",
                        "on-secondary-fixed": "#241a00",
                        "parchment-light": "#FAF6F0",
                        "surface": "#fff8f3",
                        "on-error-container": "#93000a",
                        "secondary-fixed": "#ffe088",
                        "background": "#fff8f3",
                        "surface-container-high": "#f5e6d3",
                        "on-surface-variant": "#5a413d",
                        "tertiary": "#162b1d",
                        "on-secondary-fixed-variant": "#574500",
                        "on-surface": "#221a0f",
                        "on-primary-container": "#ff8371",
                        "surface-container": "#fbecd8",
                        "on-tertiary-container": "#95ad99",
                        "wax-seal-red": "#960018",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-container-low": "#fff2e2",
                        "tertiary-fixed": "#d0e9d4",
                        "tertiary-fixed-dim": "#b4cdb8",
                        "tertiary-container": "#2c4132",
                        "surface-container-lowest": "#ffffff",
                        "inverse-surface": "#382f22",
                        "surface-tint": "#b22b1d",
                        "on-primary-fixed-variant": "#8f0f07",
                        "primary": "#570000",
                        "on-tertiary-fixed-variant": "#364c3c",
                        "outline-variant": "#e2bfb9",
                        "on-background": "#221a0f",
                        "on-tertiary-fixed": "#0b2013",
                        "secondary": "#735c00",
                        "espresso-dark": "#2B1B17",
                        "outline": "#8e706c",
                        "primary-container": "#800000",
                        "error": "#ba1a1a",
                        "burnt-orange": "#CC5500",
                        "inverse-primary": "#ffb4a8",
                        "surface-bright": "#fff8f3",
                        "error-container": "#ffdad6"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "margin-mobile": "20px",
                        "unit": "8px",
                        "container-max": "1200px",
                        "stack-overlap": "-40px",
                        "gutter": "24px"
                    },
                    fontFamily: {
                        "display-lg-mobile": ["Playfair Display"],
                        "body-md": ["\"Source Serif 4\""],
                        "label-md": ["Courier Prime"],
                        "headline-md": ["Playfair Display"],
                        "body-lg": ["\"Source Serif 4\""],
                        "display-lg": ["Playfair Display"],
                        "label-sm": ["Courier Prime"],
                        "headline-lg": ["Playfair Display"]
                    },
                    fontSize: {
                        "display-lg-mobile": ["48px", {"lineHeight": "56px", "fontWeight": "900"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "400"}],
                        "headline-md": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "body-lg": ["20px", {"lineHeight": "32px", "fontWeight": "400"}],
                        "display-lg": ["72px", {"lineHeight": "80px", "letterSpacing": "-0.02em", "fontWeight": "900"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "700"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "fontWeight": "800"}]
                    }
                }
            }
        }
    </script>
    
    <!-- AOS.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
    
    <style>
        .ornament-corner-gold {
            background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0C60 0 120 60 120 120V0H0Z' fill='%23fed65b' fill-opacity='0.25'/%3E%3Cpath d='M15 15C45 15 75 45 75 75M30 15C50 15 65 30 65 50M10 10L25 25M120 0L110 10M0 120L10 110' stroke='%23fed65b' stroke-width='2.5'/%3E%3Ccircle cx='15' cy='15' r='3' fill='%23fed65b'/%3E%3C/svg%3E");
            background-size: 100px 100px;
            background-repeat: no-repeat;
        }
        .aged-parchment {
            background-image: url("https://www.transparenttextures.com/patterns/handmade-paper.png"), url("https://www.transparenttextures.com/patterns/parchment.png");
            background-color: #fbecd8;
        }
        .damask-watermark {
            background-image: url("https://www.transparenttextures.com/patterns/damask-weave.png");
            background-blend-mode: overlay;
        }
        .film-grain {
            position: relative;
        }
        .film-grain::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("https://www.transparenttextures.com/patterns/stardust.png");
            opacity: 0.4;
            pointer-events: none;
            z-index: 1;
        }
        .section-divider-luxe {
            height: 40px;
            background: linear-gradient(to right, transparent, #fed65b, #b22b1d, #fed65b, transparent);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .section-divider-luxe::after {
            content: "❈";
            color: #fed65b;
            font-size: 24px;
            background: #221a0f;
            padding: 0 15px;
            border: 2px solid #fed65b;
            border-radius: 50%;
        }
        .ornate-container {
            border: 8px double #fed65b;
            box-shadow: 0 0 0 4px #570000, 10px 10px 20px rgba(0,0,0,0.2);
            background-image: url("https://www.transparenttextures.com/patterns/paper-fibers.png");
        }
        .paper-texture {
            background-image: url("https://www.transparenttextures.com/patterns/paper-fibers.png");
        }
        .wax-seal {
            background: radial-gradient(circle, #b22b1d 0%, #960018 100%);
            box-shadow: 4px 4px 0px rgba(43, 27, 23, 0.4), inset -2px -2px 4px rgba(0,0,0,0.3);
        }
        .marquee-text {
            text-shadow: 2px 2px 0px #2B1B17, 0 0 15px rgba(254, 214, 91, 0.5);
        }
        .polaroid {
            background: white;
            padding: 1rem 1rem 3rem 1rem;
            box-shadow: 6px 6px 0px rgba(43, 27, 23, 0.2);
            transition: transform 0.3s ease;
            border: 1px solid #ddd;
        }
        .polaroid:hover { transform: scale(1.05) rotate(0deg) !important; z-index: 50; }
        .ticket-cutout {
            mask-image: radial-gradient(circle at 0 50%, transparent 15px, black 16px), radial-gradient(circle at 100% 50%, transparent 15px, black 16px);
            -webkit-mask-image: radial-gradient(circle at 0 50%, transparent 15px, black 16px), radial-gradient(circle at 100% 50%, transparent 15px, black 16px);
        }
        body.cover-active {
            overflow: hidden;
            height: 100vh;
        }
        #wishes-container::-webkit-scrollbar {
            width: 4px;
        }
        #wishes-container::-webkit-scrollbar-track {
            background: transparent;
        }
        #wishes-container::-webkit-scrollbar-thumb {
            background: #221a0f;
            border-radius: 4px;
        }

        /* Floating action controls */
        .floater-container {
            position: fixed;
            bottom: 110px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            z-index: 90;
            display: none;
            pointer-events: none;
        }
        .floater-container.visible { display: block; }
        .floater-inner {
            position: absolute;
            right: 20px;
            bottom: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: center;
            pointer-events: auto;
        }
        .float-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(43, 27, 23, 0.9);
            backdrop-filter: blur(10px);
            border: 2px solid #fed65b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fed65b;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }
        .float-btn:hover { background: #fed65b; color: #570000; }
        .float-btn.paused .material-symbols-outlined { color: #8e706c; }
        .float-btn.scrolling { background: #fed65b; color: #570000; }
        
        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: rotate-slow 20s linear infinite; }

        /* Lightbox modal centering */
        #lightbox {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
        }

        /* Pulsing loop animation for gold wax seal button */
        @keyframes seal-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .seal-pulse {
            animation: seal-pulse 2.5s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-surface text-on-surface aged-parchment selection:bg-wax-seal-red selection:text-white film-grain max-w-[480px] w-full mx-auto shadow-2xl border-x border-espresso-dark relative cover-active font-body-md">

    <!-- Audio Element -->
    <audio id="bg-music" loop preload="auto">
        <source src="{{ $musicUrl }}" type="audio/mpeg"/>
    </audio>

    <!-- ==================== OVERLAY LOADER / COVER ==================== -->
    <div class="fixed inset-y-0 left-1/2 w-full max-w-[480px] h-screen bg-surface aged-parchment damask-watermark flex flex-col justify-center items-center py-16 px-6 shadow-2xl transition-transform duration-[1000ms] ease-in-out transform -translate-x-1/2 z-[100] overflow-hidden" id="cover">
        <div class="absolute top-0 left-0 w-48 h-48 ornament-corner-gold"></div>
        <div class="absolute top-0 right-0 w-48 h-48 ornament-corner-gold rotate-90"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 ornament-corner-gold -rotate-90"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 ornament-corner-gold rotate-180"></div>
        
        <!-- Large Center Filigree -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 20 C 140 20 180 60 180 100 C 180 140 140 180 100 180 C 60 180 20 140 20 100 C 20 60 60 20 100 20 M100 40 C 70 40 40 70 40 100 C 40 130 70 160 100 160 C 130 160 160 130 160 100 C 160 70 130 40 100 40" fill="none" stroke="#fed65b" stroke-width="0.5"></path>
            </svg>
        </div>

        <!-- Center Envelope Card Area -->
        <div class="flex flex-col items-center justify-center relative z-10 space-y-6">
            <span class="font-label-md text-xs text-espresso-dark tracking-[0.4em] uppercase font-bold">The Grand Wedding of</span>
            <h1 class="font-display-lg-mobile text-4xl text-primary italic px-4 font-bold text-center">
                {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}
            </h1>
            <p class="font-body-md text-sm text-espresso-dark/80 max-w-xs mx-auto italic leading-relaxed text-center">
                A celebration of timeless devotion and classical romance.
            </p>

            <!-- Guest info section -->
            <div class="pt-2 text-center flex flex-col items-center">
                <span class="text-[8px] uppercase tracking-widest text-espresso-dark/50 font-bold block mb-1">Dear Special Guest</span>
                <div class="bg-[#570000]/5 backdrop-blur-md border border-[#570000]/20 shadow-sm py-2 px-6 rounded-lg max-w-[240px]">
                    <span class="font-serif text-sm text-primary font-bold">
                        {{ request()->get('kpd', request()->get('to', 'Sahabat & Keluarga Tercinta')) }}
                    </span>
                </div>
            </div>

            <button class="seal-pulse group relative inline-flex items-center justify-center p-8 mt-6 wax-seal rounded-full transition-all active:scale-95 hover:scale-105 cursor-pointer" onclick="openInvitation()">
                <div class="absolute inset-0 rounded-full border-4 border-double border-secondary-fixed/30 group-hover:border-secondary-fixed transition-colors"></div>
                <span class="font-label-md text-xs text-secondary-fixed font-bold tracking-widest">BUKA UNDANGAN</span>
            </button>
        </div>
    </div>

    <!-- ==================== TOP APP BAR ==================== -->
    <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 flex justify-between items-center px-6 py-4 bg-surface/95 backdrop-blur-sm border-b-4 border-double border-espresso-dark hidden" id="main-nav">
        <div class="font-display-lg-mobile text-lg text-wax-seal-red font-bold italic">Our Grand Union</div>
        <div class="flex gap-4">
            <span class="material-symbols-outlined text-wax-seal-red">history_edu</span>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="w-full relative pt-0 pb-24 overflow-hidden hidden" id="main-content">
        
        <!-- HERO SECTION -->
        <section class="min-h-screen flex flex-col items-center justify-center text-center px-6 pt-24 space-y-8 relative" id="hero">
            <div class="absolute top-0 left-0 w-32 h-32 ornament-corner-gold opacity-40"></div>
            <div class="absolute top-0 right-0 w-32 h-32 ornament-corner-gold rotate-90 opacity-40"></div>
            
            <div class="relative w-full max-w-sm ornate-container p-2">
                <div class="absolute inset-0 bg-espresso-dark/5 mix-blend-multiply"></div>
                <img class="w-full aspect-[4/5] object-cover grayscale brightness-90 border-4 border-espresso-dark" src="{{ $bg['hero'] }}" alt="Vintage Prewedding"/>
                
                <div class="absolute -bottom-6 -right-2 bg-parchment-light p-4 border-4 border-double border-secondary-fixed shadow-xl max-w-[260px] text-right">
                    <p class="font-serif text-sm text-wax-seal-red italic leading-tight">"In all the world, there is no heart for me like yours."</p>
                    <span class="font-label-sm text-[8px] text-on-surface-variant block mt-1">— Maya Angelou</span>
                </div>
            </div>
            
            <div class="pt-12 relative w-full">
                <h2 class="font-label-md text-xs uppercase tracking-widest text-on-surface-variant font-bold">Counting Down to the Gala</h2>
                
                <!-- Countdown Timer Card -->
                <div class="grid grid-cols-4 gap-3 max-w-[280px] mx-auto mt-4" id="countdown-timer">
                    <div class="bg-white/80 border border-espresso-dark/20 rounded-xl py-2 px-1 text-center shadow-sm">
                        <span id="days" class="text-xl font-serif font-bold text-espresso-dark">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-500 block mt-0.5 font-bold">Hari</span>
                    </div>
                    <div class="bg-white/80 border border-espresso-dark/20 rounded-xl py-2 px-1 text-center shadow-sm">
                        <span id="hours" class="text-xl font-serif font-bold text-espresso-dark">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-500 block mt-0.5 font-bold">Jam</span>
                    </div>
                    <div class="bg-white/80 border border-espresso-dark/20 rounded-xl py-2 px-1 text-center shadow-sm">
                        <span id="minutes" class="text-xl font-serif font-bold text-espresso-dark">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-500 block mt-0.5 font-bold">Menit</span>
                    </div>
                    <div class="bg-white/80 border border-espresso-dark/20 rounded-xl py-2 px-1 text-center shadow-sm">
                        <span id="seconds" class="text-xl font-serif font-bold text-wax-seal-red">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-500 block mt-0.5 font-bold">Detik</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="section-divider-luxe"></div>

        <!-- MEMPELAI (PROFILES) -->
        <section class="py-20 px-6 flex flex-col items-center relative space-y-16" id="mempelai">
            <div class="absolute bottom-0 left-0 w-32 h-32 ornament-corner-gold -rotate-90 opacity-30"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 ornament-corner-gold rotate-180 opacity-30"></div>
            
            <div class="text-center w-full" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1 block">Introducing</span>
                <h2 class="font-serif text-3xl text-black font-bold italic">Kedua Mempelai</h2>
                <div class="w-12 h-[1.5px] bg-black mx-auto mt-4"></div>
            </div>

            <!-- Bride -->
            <div class="flex flex-col items-center text-center space-y-6 w-full">
                <div class="relative group" data-aos="fade-up">
                    <div class="absolute -inset-2.5 border-4 border-double border-secondary-container rounded-lg rotate-3 group-hover:rotate-0 transition-transform"></div>
                    <div class="ornate-container p-1 rotate-1 group-hover:rotate-0 transition-transform w-52 h-64">
                        <img class="w-full h-full object-cover border border-espresso-dark rounded-sm" src="{{ $bg['bride'] }}" alt="Evelyn Rosewood"/>
                    </div>
                </div>
                <div class="space-y-2" data-aos="fade-up">
                    <h3 class="font-display-lg-mobile text-2xl text-wax-seal-red italic font-bold">{{ $couple['bride'] }} Rosewood</h3>
                    <p class="font-body-md text-xs text-on-surface max-w-xs leading-relaxed italic mx-auto">
                        Putri tercinta dari Bpk. Benjamin &amp; Ibu Clara Rosewood. Jiwa yang terikat pada keindahan seni dan sastra klasik.
                    </p>
                    <p class="font-sans font-bold text-black text-[10px] uppercase tracking-wider block pt-1">{{ $couple['parents']['bride'] }}</p>
                </div>
            </div>

            <!-- Divider -->
            <div class="flex items-center justify-center w-full py-4" data-aos="zoom-in">
                <span class="material-symbols-outlined text-secondary text-4xl rotate-45">all_inclusive</span>
            </div>

            <!-- Groom -->
            <div class="flex flex-col items-center text-center space-y-6 w-full">
                <div class="relative group" data-aos="fade-up">
                    <div class="absolute -inset-2.5 border-4 border-double border-secondary-container rounded-lg -rotate-3 group-hover:rotate-0 transition-transform"></div>
                    <div class="ornate-container p-1 -rotate-1 group-hover:rotate-0 transition-transform w-52 h-64">
                        <img class="w-full h-full object-cover border border-espresso-dark rounded-sm" src="{{ $bg['groom'] }}" alt="Adrian Sterling"/>
                    </div>
                </div>
                <div class="space-y-2" data-aos="fade-up">
                    <h3 class="font-display-lg-mobile text-2xl text-wax-seal-red italic font-bold">{{ $couple['groom'] }} Sterling</h3>
                    <p class="font-body-md text-xs text-on-surface max-w-xs leading-relaxed italic mx-auto">
                        Putra tercinta dari Bpk. Arthur &amp; Ibu Martha Sterling. Pelindung keteguhan tradisi dan perancang mimpi masa depan.
                    </p>
                    <p class="font-sans font-bold text-black text-[10px] uppercase tracking-wider block pt-1">{{ $couple['parents']['groom'] }}</p>
                </div>
            </div>
        </section>

        <div class="section-divider-luxe"></div>

        <!-- ACARA (THE TICKET) -->
        <section class="py-20 px-6 relative" id="acara">
            <div class="absolute top-0 left-0 w-48 h-48 ornament-corner-gold opacity-20"></div>
            
            <div class="bg-primary damask-watermark p-2 rounded-sm shadow-2xl relative" data-aos="fade-up">
                <div class="absolute inset-0 border-4 border-double border-secondary-fixed/30 pointer-events-none"></div>
                <div class="bg-surface-container border-2 border-dashed border-espresso-dark ticket-cutout relative overflow-hidden">
                    <div class="p-6 flex flex-col gap-8 relative z-10">
                        
                        <div class="border-b border-dashed border-espresso-dark pb-6 text-center">
                            <span class="font-label-sm text-[9px] text-on-surface-variant font-bold tracking-widest block uppercase">ADMISSION TICKET</span>
                            <h2 class="font-display-lg-mobile text-2xl text-wax-seal-red mt-2 italic font-bold">The Wedding Ceremony</h2>
                            <div class="mt-4 flex items-center justify-center gap-2 opacity-50">
                                <span class="material-symbols-outlined text-2xl">local_post_office</span>
                                <span class="font-label-sm text-[8px] font-bold">OFFICIAL STAMP MMXXVI</span>
                            </div>
                        </div>

                        <div class="space-y-6 text-left">
                            <div class="border-b border-espresso-dark/20 pb-4">
                                <h4 class="font-label-md text-xs text-wax-seal-red font-bold uppercase tracking-wider">SACRED COVENANT</h4>
                                <p class="mt-2 font-body-lg text-sm font-bold text-espresso-dark">Pukul {{ $schedule[0]['time'] }}</p>
                                <p class="font-body-md text-xs text-gray-700 mt-1 font-bold">{{ $schedule[0]['note'] }}</p>
                                <p class="font-label-sm text-[8px] text-on-surface-variant block mt-1 italic opacity-75">Strictly Formal Attire</p>
                            </div>
                            
                            <div>
                                <h4 class="font-label-md text-xs text-wax-seal-red font-bold uppercase tracking-wider">THE RECEPTION GALA</h4>
                                <p class="mt-2 font-body-lg text-sm font-bold text-espresso-dark">Pukul {{ $schedule[1]['time'] }}</p>
                                <p class="font-body-md text-xs text-gray-700 mt-1 font-bold">{{ $schedule[1]['note'] }}</p>
                                <p class="font-label-sm text-[8px] text-on-surface-variant block mt-1 italic opacity-75">Dinner &amp; Dancing Follows</p>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-double border-espresso-dark flex flex-col gap-3">
                            <a class="inline-flex items-center justify-center gap-1.5 font-label-md text-[10px] text-espresso-dark hover:text-wax-seal-red transition-colors underline decoration-double font-bold" href="{{ $event['maps_url'] }}" target="_blank">
                                <span class="material-symbols-outlined text-sm">map</span> LIHAT LOKASI MAPS
                            </a>
                        </div>
                    </div>
                    
                    <!-- film strip border -->
                    <div class="h-3.5 bg-espresso-dark flex justify-around items-center px-4 overflow-hidden opacity-50">
                        <div class="w-2.5 h-1.5 bg-surface"></div><div class="w-2.5 h-1.5 bg-surface"></div><div class="w-2.5 h-1.5 bg-surface"></div>
                        <div class="w-2.5 h-1.5 bg-surface"></div><div class="w-2.5 h-1.5 bg-surface"></div><div class="w-2.5 h-1.5 bg-surface"></div>
                        <div class="w-2.5 h-1.5 bg-surface"></div><div class="w-2.5 h-1.5 bg-surface"></div><div class="w-2.5 h-1.5 bg-surface"></div>
                    </div>
                </div>
            </div>
        </section>

        <div class="section-divider-luxe"></div>

        <!-- TIMELINE (Kisah Cinta) -->
        <section class="py-20 px-6 flex flex-col items-center relative" id="story">
            <div class="absolute top-0 right-0 w-32 h-32 ornament-corner-gold rotate-90 opacity-20"></div>
            
            <h2 class="font-display-lg-mobile text-3xl text-wax-seal-red text-center italic font-bold mb-12 relative" data-aos="fade-up">
                The Chapter of Us
                <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-20 h-[2px] bg-secondary-fixed/50"></div>
            </h2>

            <div class="relative w-full max-w-xs">
                <!-- Center Line -->
                <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-0.5 border-l-2 border-dashed border-wax-seal-red/30"></div>
                
                <div class="space-y-16 relative">
                    @foreach($stories as $i => $s)
                    <!-- Entry -->
                    <div class="relative flex items-center justify-between">
                        @if($i % 2 == 0)
                        <div class="w-[45%] text-right pr-3" data-aos="fade-right">
                            <span class="font-label-sm text-[8px] text-on-surface-variant font-bold italic uppercase block">{{ $s['date'] }}</span>
                            <h4 class="font-headline-md text-xs text-espresso-dark leading-tight font-bold mt-0.5">{{ $s['title'] }}</h4>
                            <p class="font-body-md text-[10px] text-gray-600 mt-1 leading-relaxed">{{ $s['text'] }}</p>
                        </div>
                        <div class="absolute left-1/2 -translate-x-1/2 w-8 h-8 bg-surface border-2 border-wax-seal-red rounded-full flex items-center justify-center z-10 shadow-sm">
                            <span class="material-symbols-outlined text-wax-seal-red text-xs">history_edu</span>
                        </div>
                        <div class="w-[45%]"></div>
                        @else
                        <div class="w-[45%]"></div>
                        <div class="absolute left-1/2 -translate-x-1/2 w-8 h-8 bg-surface border-2 border-wax-seal-red rounded-full flex items-center justify-center z-10 shadow-sm">
                            <span class="material-symbols-outlined text-wax-seal-red text-xs">favorite</span>
                        </div>
                        <div class="w-[45%] text-left pl-3" data-aos="fade-left">
                            <span class="font-label-sm text-[8px] text-on-surface-variant font-bold italic uppercase block">{{ $s['date'] }}</span>
                            <h4 class="font-headline-md text-xs text-espresso-dark leading-tight font-bold mt-0.5">{{ $s['title'] }}</h4>
                            <p class="font-body-md text-[10px] text-gray-600 mt-1 leading-relaxed">{{ $s['text'] }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="section-divider-luxe"></div>

        <!-- GALLERY COLLAGE -->
        <section class="py-20 px-6 bg-espresso-dark/5 relative overflow-visible" id="gallery">
            <div class="absolute inset-0 damask-watermark opacity-5 pointer-events-none"></div>
            <h2 class="font-display-lg-mobile text-3xl text-wax-seal-red text-center italic font-bold mb-16 relative" data-aos="fade-up">Captured Devotion</h2>
            
            <div class="relative w-full max-w-sm mx-auto flex flex-col gap-6">
                <!-- Polaroid 1 -->
                <div class="polaroid -rotate-3 w-64 mx-auto border border-espresso-dark/10 cursor-zoom-in" onclick="openLightbox('{{ $gallery[0] }}')" data-aos="fade-up">
                    <img class="w-full h-auto object-cover grayscale hover:grayscale-0 transition duration-300" src="{{ $gallery[0] }}" alt="Gallery 1"/>
                    <p class="mt-4 font-label-md text-xs italic text-center text-espresso-dark">Paris, 2018</p>
                </div>
                
                <!-- Film Strip Collage -->
                <div class="flex gap-3 justify-center py-4 bg-espresso-dark/95 p-3 rounded-lg shadow-xl" data-aos="fade-up">
                    <div class="w-24 h-24 overflow-hidden border border-white/20 relative cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                        <img class="object-cover w-full h-full grayscale hover:grayscale-0 transition duration-300" src="{{ $gallery[1] }}" alt="Gallery Film 1"/>
                    </div>
                    <div class="w-24 h-24 overflow-hidden border border-white/20 relative cursor-zoom-in" onclick="openLightbox('{{ $gallery[2] }}')">
                        <img class="object-cover w-full h-full grayscale hover:grayscale-0 transition duration-300" src="{{ $gallery[2] }}" alt="Gallery Film 2"/>
                    </div>
                </div>

                <!-- Gold Frame 1 -->
                <div class="p-4 bg-secondary-fixed shadow-lg border-4 border-double border-espresso-dark cursor-zoom-in max-w-xs mx-auto" onclick="openLightbox('{{ $gallery[3] }}')" data-aos="fade-up">
                    <div class="border-2 border-espresso-dark p-0.5 bg-surface-container">
                        <img class="w-full aspect-video object-cover" src="{{ $gallery[3] }}" alt="Gallery Gold 1"/>
                    </div>
                </div>

                <!-- Polaroid 2 -->
                <div class="polaroid rotate-3 w-64 mx-auto border border-espresso-dark/10 cursor-zoom-in" onclick="openLightbox('{{ $gallery[4] ?? $gallery[0] }}')" data-aos="fade-up">
                    <img class="w-full h-auto object-cover" src="{{ $gallery[4] ?? $gallery[0] }}" alt="Gallery 2"/>
                    <p class="mt-4 font-label-md text-xs italic text-center text-espresso-dark">Summer Solstice</p>
                </div>
            </div>
        </section>

        <div class="section-divider-luxe"></div>

        <!-- RSVP & KADO (POSTCARD STYLE) -->
        <section class="py-20 px-6 relative overflow-hidden" id="rsvp">
            <div class="absolute inset-0 damask-watermark opacity-20 pointer-events-none"></div>
            
            <div class="max-w-sm mx-auto ornate-container relative z-10 flex flex-col gap-0 overflow-hidden">
                <!-- RSVP Form -->
                <div class="p-6 bg-surface border-b-4 border-double border-espresso-dark">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="font-display-lg-mobile text-2xl text-wax-seal-red italic font-bold">R.S.V.P.</h2>
                            <p class="font-label-sm text-[9px] mt-1 uppercase tracking-widest font-bold">Kindly Respond</p>
                        </div>
                        <div class="w-16 h-20 border border-espresso-dark/40 flex flex-col items-center justify-center opacity-40 bg-parchment-light">
                            <span class="font-label-sm text-[8px] text-center p-1 font-bold leading-tight">PLACE STAMP HERE</span>
                        </div>
                    </div>
                    
                    <form class="space-y-4 text-left" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="border-b border-espresso-dark pb-1">
                            <label class="font-label-sm text-[9px] font-bold opacity-60">GUEST NAME</label>
                            <input class="w-full bg-transparent border-none focus:ring-0 font-label-md text-xs placeholder:opacity-30 px-0 py-1" placeholder="Your name here..." type="text" id="rsvp-nama" required/>
                        </div>
                        <div class="border-b border-espresso-dark pb-1">
                            <label class="font-label-sm text-[9px] font-bold opacity-60">ATTENDANCE</label>
                            <select class="w-full bg-transparent border-none focus:ring-0 font-label-md text-xs px-0 py-1" id="rsvp-kehadiran">
                                <option value="Hadir">Joyfully Accepts</option>
                                <option value="Tidak Hadir">Regretfully Declines</option>
                            </select>
                        </div>
                        <div class="border-b border-espresso-dark pb-1">
                            <label class="font-label-sm text-[9px] font-bold opacity-60">PESAN &amp; DOA RESTU</label>
                            <textarea class="w-full bg-transparent border-none focus:ring-0 font-label-md text-xs placeholder:opacity-30 px-0 py-1 resize-none h-16" placeholder="Tuliskan ucapan selamat..." id="rsvp-pesan" required></textarea>
                        </div>
                        <button class="w-full py-3 bg-wax-seal-red text-secondary-fixed font-label-md text-[10px] tracking-widest font-bold uppercase hover:bg-espresso-dark transition-colors border border-secondary-fixed shadow-md cursor-pointer" type="submit">
                            Send RSVP
                        </button>
                    </form>
                </div>

                <!-- Digital Registry (Kado) -->
                <div class="p-6 flex flex-col justify-between bg-parchment-light/80">
                    <div class="text-left">
                        <h2 class="font-display-lg-mobile text-xl text-espresso-dark italic mb-4 font-bold">Wedding Registry</h2>
                        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed mb-6 italic">
                            Kehadiran Anda adalah kado terindah. Namun jika Anda ingin mengirimkan tanda kasih secara digital, silakan transfer melalui rekening berikut:
                        </p>
                        
                        <div class="space-y-4">
                            @foreach($gifts as $g)
                            <div onclick="copyAccount('{{ $g['account'] }}', this)" class="bg-surface p-4 border-2 border-double border-espresso-dark/30 flex justify-between items-center group cursor-pointer hover:border-wax-seal-red transition-all">
                                <div>
                                    <p class="font-label-sm text-[8px] font-bold opacity-50 uppercase">{{ $g['bank'] }}</p>
                                    <p class="font-label-md text-xs font-bold text-espresso-dark mt-0.5">{{ $g['account'] }}</p>
                                    <p class="font-body-md text-[10px] text-gray-500 italic mt-0.5">a.n {{ $g['name'] }}</p>
                                </div>
                                <span class="material-symbols-outlined text-wax-seal-red group-hover:scale-125 transition-transform text-lg">content_copy</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishes board feed -->
            <div class="max-w-sm mx-auto text-left mt-10" data-aos="fade-up">
                <h3 class="font-serif text-sm text-black font-bold mb-4 pb-2 border-b border-black/10 uppercase tracking-wider">Doa Dari Kerabat</h3>
                <div class="space-y-3 max-h-[300px] overflow-y-auto pr-1" id="wishes-container">
                    @foreach($wishes as $w)
                    <div class="bg-white p-4 border border-black/10 text-left relative shadow-sm">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-serif font-bold text-black text-xs">{{ $w['name'] }}</span>
                            <span class="text-[7px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border {{ $w['status'] == 'Hadir' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200' }}">{{ $w['status'] }}</span>
                        </div>
                        <p class="text-[11px] text-gray-600 leading-relaxed font-sans">"{{ $w['message'] }}"</p>
                    </div>
                    @endforeach
                    <div id="wishList" class="space-y-3"></div>
                </div>
            </div>
        </section>

        <div class="section-divider-luxe"></div>

        <!-- FOOTER -->
        <footer class="py-16 px-6 text-center relative">
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-full damask-watermark opacity-5 pointer-events-none"></div>
            <div class="max-w-xs mx-auto space-y-8 relative z-10">
                <div class="flex items-center justify-center gap-3">
                    <div class="h-[1px] w-12 bg-gradient-to-r from-transparent to-wax-seal-red"></div>
                    <span class="material-symbols-outlined text-wax-seal-red text-2xl">favorite</span>
                    <div class="h-[1px] w-12 bg-gradient-to-l from-transparent to-wax-seal-red"></div>
                </div>
                <div class="space-y-3">
                    <h2 class="font-display-lg-mobile text-2xl text-wax-seal-red italic font-bold">Thank You</h2>
                    <p class="font-body-lg text-xs italic text-on-surface-variant max-w-[200px] mx-auto leading-relaxed">"True love is a story that never ends, yet it begins anew every single day."</p>
                </div>
                <div class="pt-6 border-t border-double border-espresso-dark/20 w-28 mx-auto">
                    <p class="font-label-md text-xs text-espresso-dark font-bold uppercase tracking-[0.5em]">{{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}</p>
                    <p class="font-label-sm text-[8px] mt-2 opacity-50">A.D. MMXXVI | TemuRuang</p>
                </div>
            </div>
        </footer>
    </main>

    <!-- ==================== BOTTOM NAV ==================== -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[80] bg-espresso-dark/95 backdrop-blur-md px-6 py-3 rounded-full border-2 border-secondary-fixed shadow-[0_10px_40px_rgba(0,0,0,0.5)] flex gap-8 items-center hidden w-[320px] justify-around" id="bottom-nav">
        <a class="flex flex-col items-center text-secondary-fixed hover:text-wax-seal-red transition-all scale-110" href="#hero" onclick="smoothScroll(event, '#hero', this)">
            <span class="material-symbols-outlined text-2xl">mail</span>
            <span class="text-[7px] font-label-sm tracking-widest mt-0.5 font-bold">INVITE</span>
        </a>
        <a class="flex flex-col items-center text-secondary-fixed/60 hover:text-wax-seal-red transition-all" href="#gallery" onclick="smoothScroll(event, '#gallery', this)">
            <span class="material-symbols-outlined text-2xl">photo_library</span>
            <span class="text-[7px] font-label-sm tracking-widest mt-0.5 font-bold">GALLERY</span>
        </a>
        <a class="flex flex-col items-center text-secondary-fixed/60 hover:text-wax-seal-red transition-all" href="#rsvp" onclick="smoothScroll(event, '#rsvp', this)">
            <span class="material-symbols-outlined text-2xl">edit_note</span>
            <span class="text-[7px] font-label-sm tracking-widest mt-0.5 font-bold">RSVP</span>
        </a>
    </nav>

    <!-- Floating Action Controls (Music and Scroll) -->
    <div class="floater-container" id="floaterContainer">
        <div class="floater-inner">
            <!-- Autoscroll Control -->
            <button class="float-btn" id="scrollControl" onclick="toggleAutoscroll()" title="Mulai Autoscroll">
                <span class="material-symbols-outlined">keyboard_double_arrow_down</span>
            </button>
            <!-- Music Control -->
            <button class="float-btn animate-spin-slow" id="musicControl" onclick="toggleMusic()" title="Pause Music">
                <span class="material-symbols-outlined">music_note</span>
            </button>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div class="fixed inset-0 bg-black/95 z-[200] hidden flex-col items-center justify-center p-4 transition-opacity duration-300 opacity-0" id="lightbox" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors cursor-pointer" onclick="closeLightbox()">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <img class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl" id="lightbox-img" src="" alt="Zoomed Momen"/>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        let isAutoscrolling = false;
        let scrollSpeed = 0.65; 

        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, scrollSpeed);
            if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
                stopAutoscroll();
            } else {
                requestAnimationFrame(scrollStep);
            }
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.add('scrolling');
            ctrl.querySelector('.material-symbols-outlined').textContent = 'pause';
            requestAnimationFrame(scrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.remove('scrolling');
            ctrl.querySelector('.material-symbols-outlined').textContent = 'keyboard_double_arrow_down';
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        function openInvitation() {
            const cover = document.getElementById('cover');
            const main = document.getElementById('main-content');
            const mainNav = document.getElementById('main-nav');
            const bottomNav = document.getElementById('bottom-nav');
            const floater = document.getElementById('floaterContainer');
            const music = document.getElementById('bg-music');

            // Play music
            music.play().catch(e => console.log("Audio autoplay blocked"));

            cover.classList.add('transition-transform', 'duration-[1000ms]', 'ease-in-out', '-translate-y-full');
            
            setTimeout(() => {
                cover.style.display = 'none';
                main.classList.remove('hidden');
                mainNav.classList.remove('hidden');
                bottomNav.classList.remove('hidden');
                document.body.classList.remove('cover-active');
                floater.classList.add('visible');
                
                // Initialize AOS
                AOS.init({ duration: 1000, once: true });
            }, 1000);
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-music');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) {
                audio.play();
                ctrl.querySelector('.material-symbols-outlined').textContent = 'music_note';
                ctrl.classList.remove('paused');
                ctrl.classList.add('animate-spin-slow');
            } else {
                audio.pause();
                ctrl.querySelector('.material-symbols-outlined').textContent = 'music_off';
                ctrl.classList.add('paused');
                ctrl.classList.remove('animate-spin-slow');
            }
        }

        function copyAccount(text, el) {
            navigator.clipboard.writeText(text.replace(/-/g, '').trim()).then(() => {
                const checkIcon = el.querySelector('.material-symbols-outlined');
                if (checkIcon) {
                    checkIcon.textContent = 'check';
                    setTimeout(() => {
                        checkIcon.textContent = 'content_copy';
                    }, 2000);
                }
                alert('Nomor rekening berhasil disalin!');
            });
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-nama').value;
            const status = document.getElementById('rsvp-kehadiran').value;
            const msg = document.getElementById('rsvp-pesan').value;

            const card = document.createElement('div');
            card.className = 'bg-white p-4 border border-black/10 text-left relative shadow-sm';
            
            const badgeClass = status === 'Hadir' 
                ? 'bg-green-50 text-green-700 border-green-200' 
                : 'bg-red-50 text-red-700 border-red-200';
                
            card.innerHTML = `
                <div class="flex items-center justify-between mb-1">
                    <span class="font-serif font-bold text-black text-xs">${name}</span>
                    <span class="text-[7px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border ${badgeClass}">${status}</span>
                </div>
                <p class="text-[11px] text-gray-600 leading-relaxed font-sans">"${msg}"</p>
            `;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert('Terima kasih! RSVP dan doa ucapan Anda berhasil dikirim.');
        }

        function openLightbox(src) {
            stopAutoscroll();
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.add('opacity-100');
            }, 50);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('opacity-100');
            setTimeout(() => {
                lightbox.classList.add('hidden');
            }, 300);
        }

        function smoothScroll(e, selector, el) {
            e.preventDefault();
            stopAutoscroll();
            
            document.querySelectorAll('#bottom-nav a').forEach(a => {
                a.classList.remove('text-wax-seal-red', 'scale-110');
                a.classList.add('text-secondary-fixed/60');
            });
            el.classList.remove('text-secondary-fixed/60');
            el.classList.add('text-wax-seal-red', 'scale-110');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });

            // Navigation highlight on scroll
            window.addEventListener('scroll', () => {
                let current = "";
                const sections = document.querySelectorAll("section");
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 250) {
                        current = section.getAttribute("id") || "";
                    }
                });

                document.querySelectorAll('#bottom-nav a').forEach((a) => {
                    a.classList.remove('text-wax-seal-red', 'scale-110');
                    a.classList.add('text-secondary-fixed/60');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-secondary-fixed/60');
                        a.classList.add('text-wax-seal-red', 'scale-110');
                    }
                });
            });
        });
    </script>
</body>
</html>
