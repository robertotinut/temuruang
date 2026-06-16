@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Bima');
        $brideName = trim($names[1] ?? 'Aria');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Suherman & Ibu Ani',
                'bride' => 'Bpk. Hartono & Ibu Sri',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-12-20',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Hotel Indonesia Kempinski, Jakarta',
            'address' => $invitation->address ?? 'Hotel Indonesia Kempinski, Jl. M.H. Thamrin No.1, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Hotel Indonesia Kempinski, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Hotel Indonesia Kempinski, Jakarta'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '11:00 - Selesai',
                'note' => $invitation->address ?? 'Hotel Indonesia Kempinski, Jakarta'
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
                ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di bangku perkuliahan, kami menyadari banyak hal menarik yang membuat kami dekat.'],
                ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
                ['title' => 'Menuju Pernikahan', 'date' => 'Desember 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-26/images/image_6.jpg'),
                asset('assets/templates/wedding-26/images/image_7.jpg'),
                asset('assets/templates/wedding-26/images/image_8.jpg'),
                asset('assets/templates/wedding-26/images/image_9.jpg'),
                asset('assets/templates/wedding-26/images/image_10.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-26/images/image_3.jpg');
        $bg = [
            'cover_pattern' => asset('assets/templates/wedding-26/images/image_1.jpg'),
            'gold_corners' => asset('assets/templates/wedding-26/images/image_2.jpg'),
            'hero' => $coverUrl,
            'bride' => asset('assets/templates/wedding-26/images/image_4.jpg'),
            'groom' => asset('assets/templates/wedding-26/images/image_5.jpg'),
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
                ['name' => 'Ari & Dinda', 'status' => 'Hadir', 'message' => 'Selamat berbahagia! Doa kami menyertai langkah kalian berdua.'],
                ['name' => 'Siti & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru. Semoga menjadi keluarga sakinah mawaddah warahmah.'],
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
                ['bank' => 'BCA', 'name' => 'Bima Pratama', 'account' => '123-456-7890'],
                ['bank' => 'Mandiri', 'name' => 'Aria Kusuma', 'account' => '987-654-3210'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Bima',
            'bride' => 'Aria',
            'parents' => [
                'groom' => 'Bpk. Suherman & Ibu Ani',
                'bride' => 'Bpk. Hartono & Ibu Sri',
            ],
        ];

        $event = [
            'date_iso' => '2024-12-20',
            'time' => '08:00',
            'location' => 'Hotel Indonesia Kempinski, Jakarta',
            'address' => 'Hotel Indonesia Kempinski, Jl. M.H. Thamrin No.1, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=Hotel+Indonesia+Kempinski+Jakarta',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'Hotel Indonesia Kempinski, Jakarta'],
            ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - Selesai', 'note' => 'Hotel Indonesia Kempinski, Jakarta'],
        ];

        $stories = [
            ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di bangku perkuliahan, kami menyadari banyak hal menarik yang membuat kami dekat.'],
            ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
            ['title' => 'Menuju Pernikahan', 'date' => 'Desember 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-26/images/image_6.jpg'),
            asset('assets/templates/wedding-26/images/image_7.jpg'),
            asset('assets/templates/wedding-26/images/image_8.jpg'),
            asset('assets/templates/wedding-26/images/image_9.jpg'),
            asset('assets/templates/wedding-26/images/image_10.jpg'),
        ];

        $bg = [
            'cover_pattern' => asset('assets/templates/wedding-26/images/image_1.jpg'),
            'gold_corners' => asset('assets/templates/wedding-26/images/image_2.jpg'),
            'hero' => asset('assets/templates/wedding-26/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-26/images/image_4.jpg'),
            'groom' => asset('assets/templates/wedding-26/images/image_5.jpg'),
        ];

        $wishes = [
            ['name' => 'Ari & Dinda', 'status' => 'Hadir', 'message' => 'Selamat berbahagia! Doa kami menyertai langkah kalian berdua.'],
            ['name' => 'Siti & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru. Semoga menjadi keluarga sakinah mawaddah warahmah.'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Bima Pratama', 'account' => '123-456-7890'],
            ['bank' => 'Mandiri', 'name' => 'Aria Kusuma', 'account' => '987-654-3210'],
        ];

        $musicUrl = asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    }
@endphp
<!DOCTYPE html>
<html class="light scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Undangan Pernikahan | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&amp;family=Outfit:wght@300;400;500;700&amp;family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#32170d",
                        "primary-fixed": "#ffdbce",
                        "on-primary-fixed-variant": "#613e31",
                        "tertiary-fixed": "#ffdbcf",
                        "surface-container-highest": "#e3e2e0",
                        "inverse-primary": "#ecbcaa",
                        "tertiary-fixed-dim": "#e1bfb3",
                        "on-surface": "#1a1c1a",
                        "surface-tint": "#7b5647",
                        "primary-fixed-dim": "#ecbcaa",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "gold-foil-light": "#F9E498",
                        "inverse-surface": "#2f312f",
                        "error": "#ba1a1a",
                        "on-secondary-fixed-variant": "#574500",
                        "secondary": "#735c00",
                        "secondary-fixed": "#ffe088",
                        "tertiary-container": "#452f27",
                        "deep-espresso": "#26140D",
                        "creamy-alabaster": "#FAF9F6",
                        "on-secondary-container": "#745c00",
                        "surface-container": "#efeeeb",
                        "on-tertiary-fixed": "#291710",
                        "secondary-fixed-dim": "#e9c349",
                        "on-secondary-fixed": "#241a00",
                        "inverse-on-surface": "#f2f1ee",
                        "on-primary-container": "#bf9282",
                        "surface-variant": "#e3e2e0",
                        "outline-variant": "#d5c3bd",
                        "on-primary-fixed": "#2e140a",
                        "on-primary": "#ffffff",
                        "metallic-gold": "#D4AF37",
                        "on-secondary": "#ffffff",
                        "on-error": "#ffffff",
                        "surface-container-high": "#e9e8e5",
                        "primary-container": "#4b2c20",
                        "on-error-container": "#93000a",
                        "surface-bright": "#faf9f6",
                        "outline": "#83746f",
                        "on-tertiary-container": "#b5968b",
                        "surface": "#faf9f6",
                        "on-background": "#1a1c1a",
                        "background": "#faf9f6",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#fed65b",
                        "festive-accent": "#8B0000",
                        "surface-container-low": "#f4f3f1",
                        "rich-chocolate": "#4B2C20",
                        "on-surface-variant": "#504440",
                        "surface-dim": "#dbdad7",
                        "on-tertiary-fixed-variant": "#594138",
                        "tertiary": "#2d1a13"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "stack-md": "16px",
                        "section-gap": "80px",
                        "stack-lg": "32px",
                        "stack-xs": "4px",
                        "grid-margin": "24px",
                        "polaroid-padding": "12px",
                        "stack-sm": "8px"
                    },
                    fontFamily: {
                        "body-lg": ["Outfit"],
                        "display-hero-mobile": ["Playfair Display"],
                        "label-bold": ["Outfit"],
                        "label-sm": ["Outfit"],
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "display-hero": ["Playfair Display"],
                        "body-md": ["Outfit"]
                    },
                    fontSize: {
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-hero-mobile": ["42px", {"lineHeight": "48px", "letterSpacing": "-0.01em", "fontWeight": "900"}],
                        "label-bold": ["14px", {"lineHeight": "20px", "letterSpacing": "0.1em", "fontWeight": "700"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "fontWeight": "500"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "700"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "display-hero": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "900"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
        }
        
        .gold-foil-text {
            background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gold-border {
            border-image: linear-gradient(to right, #D4AF37, #F9E498, #D4AF37) 1;
        }

        .scrapbook-tape {
            background: rgba(250, 249, 246, 0.4);
            backdrop-filter: blur(2px);
            transform: rotate(-15deg);
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes pulse-soft {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
            70% { transform: scale(1.02); box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
        }

        .animate-pulse-soft {
            animation: pulse-soft 2s infinite;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px) scale(0.97);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .scroll-reveal.reveal-active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .floral-bg {
            background-image: url('{{ $bg['cover_pattern'] }}');
            background-size: 400px;
            opacity: 0.08;
        }

        .gold-corner-tl { background: url('{{ $bg['gold_corners'] }}'); background-size: 200%; background-position: top left; }
        .gold-corner-tr { background: url('{{ $bg['gold_corners'] }}'); background-size: 200%; background-position: top right; }
        .gold-corner-bl { background: url('{{ $bg['gold_corners'] }}'); background-size: 200%; background-position: bottom left; }
        .gold-corner-br { background: url('{{ $bg['gold_corners'] }}'); background-size: 200%; background-position: bottom right; }

        .particle {
            position: fixed;
            pointer-events: none;
            z-index: 1;
            border-radius: 50%;
            background: #D4AF37;
            opacity: 0.3;
        }

        body.cover-active { overflow: hidden; height: 100vh; }
        #main-content.hidden { display: none; }

        /* Floating action controls */
        .floater-container {
            position: fixed;
            bottom: 90px;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            z-index: 200;
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
            background: rgba(38, 20, 13, 0.85);
            backdrop-filter: blur(10px);
            border: 2px solid #D4AF37;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #D4AF37;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .float-btn:hover { background: #D4AF37; color: #26140D; }
        .float-btn.playing .material-symbols-outlined { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .float-btn.scrolling { background: #D4AF37; color: #26140D; }

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
    </style>
</head>
<body class="bg-creamy-alabaster text-on-surface font-body-md cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-metallic-gold/20 relative selection:bg-metallic-gold/30">

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ $musicUrl }}" type="audio/mpeg">
    </audio>

    <!-- Particle Container -->
    <div class="fixed inset-0 pointer-events-none z-[1]" id="particle-container"></div>

    <!-- ==================== OVERLAY COVER ==================== -->
    <div class="fixed inset-y-0 z-[100] max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-between pt-20 pb-16 px-6 bg-creamy-alabaster overflow-hidden shadow-2xl" id="wedding-cover">
        <div class="absolute inset-0 floral-bg z-0"></div>
        <!-- Gold Corners -->
        <div class="absolute top-4 left-4 w-24 h-24 gold-corner-tl opacity-60"></div>
        <div class="absolute top-4 right-4 w-24 h-24 gold-corner-tr opacity-60"></div>
        
        <div class="w-full text-center z-10">
            <span class="font-label-bold text-xs text-on-surface-variant uppercase tracking-[0.3em]">Undangan Pernikahan</span>
        </div>

        <div class="relative py-12 z-10 text-center">
            <!-- Decorative Brushes -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -mt-12 w-48 h-24 opacity-10 bg-metallic-gold rounded-full blur-2xl"></div>
            <h2 class="font-display-hero text-5xl leading-none mb-4 animate-float text-primary uppercase font-extrabold tracking-tighter">
                {{ $couple['groom'] }} <span class="gold-foil-text">&amp;</span> {{ $couple['bride'] }}
            </h2>
            
            <div class="flex justify-center items-center gap-4 mt-6">
                <div class="h-[1px] w-12 bg-metallic-gold"></div>
                <p class="font-headline-md text-sm text-rich-chocolate italic">Save the Date: {{ \Carbon\Carbon::parse($event['date_iso'])->format('d.m.y') }}</p>
                <div class="h-[1px] w-12 bg-metallic-gold"></div>
            </div>
        </div>

        <div class="w-full text-center z-20 px-4">
            <div class="bg-white/80 border border-metallic-gold/30 p-4 rounded-2xl shadow-sm my-6 max-w-xs mx-auto text-center">
                <p class="text-[9px] font-label-bold text-on-surface-variant uppercase tracking-[0.2em] mb-1">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <p class="font-headline-md text-primary text-sm font-semibold truncate">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
            </div>

            <button class="group relative inline-flex items-center justify-center px-12 py-4 overflow-hidden font-label-bold rounded-full bg-deep-espresso text-metallic-gold transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl ring-2 ring-metallic-gold/30 animate-pulse-soft" onclick="unlockInvitation()">
                <span class="relative z-10 text-xs font-bold tracking-widest uppercase">Buka Undangan</span>
                <div class="absolute inset-0 bg-gradient-to-r from-metallic-gold/0 via-white/20 to-metallic-gold/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main id="main-content" class="hidden">
        <!-- Top AppBar -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 bg-creamy-alabaster/80 backdrop-blur-md border-b border-metallic-gold/20 shadow-sm flex justify-between items-center px-grid-margin py-stack-sm">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary cursor-pointer transition-transform hover:rotate-90">menu</span>
                <h1 class="font-display-hero-mobile text-primary tracking-tighter text-sm font-semibold">The Wedding of {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-primary text-festive-accent">favorite</span>
            </div>
        </header>

        <!-- HERO SECTION -->
        <section class="relative py-section-gap px-grid-margin bg-surface-container-low overflow-hidden min-h-[600px] flex flex-col justify-center" id="home">
            <div class="absolute inset-0 floral-bg z-0"></div>
            <div class="relative z-10 flex flex-col items-center gap-stack-lg w-full text-center">
                <!-- Large Polaroid Frame -->
                <div class="w-full max-w-[320px] relative z-10 transform -rotate-2 hover:rotate-0 transition-transform duration-500 animate-float">
                    <div class="bg-white p-polaroid-padding pb-6 shadow-[0_10px_30px_rgba(38,20,13,0.15)] rounded-sm">
                        <img class="w-full aspect-[4/5] object-cover grayscale-[20%] sepia-[10%]" src="{{ $bg['hero'] }}" alt="Hero Couple"/>
                        <p class="mt-4 text-center font-display-hero-mobile text-xl text-primary italic">Together Forever</p>
                    </div>
                    <div class="absolute -top-4 -right-4 w-24 h-8 scrapbook-tape opacity-80 border border-metallic-gold/30"></div>
                </div>

                <!-- Countdown Content -->
                <div class="w-full space-y-stack-md mt-6">
                    <h3 class="font-headline-lg text-2xl text-primary font-bold">Menuju Hari Bahagia</h3>
                    <p class="font-body-lg text-sm text-on-surface-variant leading-relaxed px-4">
                        “Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya.”
                    </p>
                    
                    <div class="grid grid-cols-4 gap-2 bg-deep-espresso p-4 rounded-xl shadow-2xl border-2 border-metallic-gold/20 max-w-sm mx-auto">
                        <div class="flex flex-col items-center">
                            <span class="font-display-hero text-2xl text-metallic-gold font-bold" id="days">00</span>
                            <span class="font-label-sm text-[9px] text-creamy-alabaster/60 uppercase">Hari</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="font-display-hero text-2xl text-metallic-gold font-bold" id="hours">00</span>
                            <span class="font-label-sm text-[9px] text-creamy-alabaster/60 uppercase">Jam</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="font-display-hero text-2xl text-metallic-gold font-bold" id="minutes">00</span>
                            <span class="font-label-sm text-[9px] text-creamy-alabaster/60 uppercase">Menit</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="font-display-hero text-2xl text-metallic-gold font-bold" id="seconds">00</span>
                            <span class="font-label-sm text-[9px] text-creamy-alabaster/60 uppercase">Detik</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MEMPELAI SECTION -->
        <section class="py-section-gap px-grid-margin relative overflow-hidden" id="mempelai">
            <div class="absolute inset-0 floral-bg z-0 opacity-10"></div>
            <!-- Corner Ornaments -->
            <div class="absolute bottom-4 left-4 w-24 h-24 gold-corner-bl opacity-40"></div>
            <div class="absolute bottom-4 right-4 w-24 h-24 gold-corner-br opacity-40"></div>
            
            <div class="max-w-md mx-auto text-center space-y-stack-lg relative z-10">
                <h2 class="font-display-hero-mobile text-3xl text-primary font-bold">Pasangan Mempelai</h2>
                <div class="flex flex-col gap-12 mt-8">
                    <!-- Aria (Bride) -->
                    <div class="space-y-stack-md transform hover:scale-102 transition-transform duration-300 scroll-reveal">
                        <div class="relative inline-block animate-float" style="animation-delay: 0.5s">
                            <div class="w-40 h-40 rounded-full border-4 border-metallic-gold p-1.5 overflow-hidden mx-auto shadow-lg">
                                <img class="w-full h-full object-cover rounded-full" src="{{ $bg['bride'] }}" alt="Bride photo"/>
                            </div>
                            <div class="absolute -bottom-2 right-4 w-10 h-10 bg-creamy-alabaster rounded-full flex items-center justify-center text-festive-accent shadow-md border border-metallic-gold/30">
                                <span class="material-symbols-outlined text-lg">favorite</span>
                            </div>
                        </div>
                        <h3 class="font-display-hero text-2xl text-primary font-semibold mt-2">{{ $couple['bride'] }}</h3>
                        <p class="font-label-bold text-xs text-metallic-gold tracking-wider">{{ $couple['parents']['bride'] }}</p>
                        <a class="inline-flex items-center gap-1.5 text-xs text-primary hover:text-metallic-gold transition-colors" href="#">
                            <span class="material-symbols-outlined text-sm">public</span> @instagram_bride
                        </a>
                    </div>
                    
                    <!-- Bima (Groom) -->
                    <div class="space-y-stack-md transform hover:scale-102 transition-transform duration-300 scroll-reveal">
                        <div class="relative inline-block animate-float" style="animation-delay: 1s">
                            <div class="w-40 h-40 rounded-full border-4 border-metallic-gold p-1.5 overflow-hidden mx-auto shadow-lg">
                                <img class="w-full h-full object-cover rounded-full" src="{{ $bg['groom'] }}" alt="Groom photo"/>
                            </div>
                            <div class="absolute -bottom-2 right-4 w-10 h-10 bg-creamy-alabaster rounded-full flex items-center justify-center text-festive-accent shadow-md border border-metallic-gold/30">
                                <span class="material-symbols-outlined text-lg">favorite</span>
                            </div>
                        </div>
                        <h3 class="font-display-hero text-2xl text-primary font-semibold mt-2">{{ $couple['groom'] }}</h3>
                        <p class="font-label-bold text-xs text-metallic-gold tracking-wider">{{ $couple['parents']['groom'] }}</p>
                        <a class="inline-flex items-center gap-1.5 text-xs text-primary hover:text-metallic-gold transition-colors" href="#">
                            <span class="material-symbols-outlined text-sm">public</span> @instagram_groom
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ACARA SECTION -->
        <section class="py-section-gap px-grid-margin relative overflow-hidden" id="event">
            <div class="absolute inset-0 floral-bg z-0 opacity-[0.04]"></div>
            <div class="max-w-md mx-auto space-y-8 relative z-10">
                <h2 class="font-display-hero-mobile text-3xl text-primary text-center font-bold">Acara Kami</h2>
                
                <div class="flex flex-col gap-6">
                    @foreach($schedule as $item)
                    <!-- Event Card -->
                    <div class="relative group scroll-reveal">
                        <div class="absolute inset-0 bg-deep-espresso transform translate-x-2 translate-y-2 rounded-xl transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
                        <div class="relative bg-rich-chocolate border-2 border-metallic-gold p-6 rounded-xl text-creamy-alabaster space-y-4 z-10 overflow-hidden">
                            <!-- Ornament divider -->
                            <div class="absolute top-0 right-0 w-24 h-24 gold-corner-tr opacity-20"></div>
                            
                            <div class="flex items-center gap-3 border-b border-metallic-gold/30 pb-3">
                                <span class="material-symbols-outlined text-2xl text-metallic-gold">calendar_month</span>
                                <h3 class="font-headline-lg text-lg uppercase font-bold">{{ $item['title'] }}</h3>
                            </div>
                            
                            <div class="space-y-2">
                                <p class="font-label-bold text-xs text-metallic-gold tracking-wider">Waktu &amp; Tempat</p>
                                <p class="font-headline-md text-base font-bold">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                                <p class="text-sm font-semibold"><i class="bi bi-clock"></i> Pukul {{ $item['time'] }}</p>
                                <p class="text-xs opacity-80 leading-relaxed">{{ $item['note'] }}</p>
                            </div>
                            
                            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="w-full py-2.5 bg-metallic-gold text-deep-espresso font-label-bold rounded-lg hover:bg-gold-foil-light transition-colors flex items-center justify-center gap-1.5 text-xs font-bold">
                                <span class="material-symbols-outlined text-sm">map</span> Google Maps
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- STORY SECTION -->
        <section class="py-section-gap px-grid-margin relative overflow-hidden" id="story">
            <div class="absolute inset-0 floral-bg z-0 opacity-10"></div>
            <div class="max-w-md mx-auto space-y-8 relative z-10">
                <h2 class="font-display-hero-mobile text-3xl text-primary text-center font-bold">Kisah Cinta Kami</h2>
                
                <div class="relative border-l-2 border-metallic-gold/30 ml-4 pl-6 space-y-8">
                    @foreach($stories as $s)
                    <div class="relative scroll-reveal">
                        <!-- Bullet indicator -->
                        <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-metallic-gold border-4 border-creamy-alabaster shadow-md"></div>
                        
                        <span class="text-xs font-bold text-metallic-gold tracking-widest block">{{ $s['date'] }}</span>
                        <h4 class="font-headline-md text-lg text-primary font-semibold mt-1">{{ $s['title'] }}</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed mt-2">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- GALLERY SECTION (Scrapbook Collage styled for 480px frame) -->
        <section class="py-section-gap px-grid-margin bg-rich-chocolate overflow-hidden relative" id="gallery">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute w-full h-full heboh-brush bg-repeat" style="background-image: url('https://www.transparenttextures.com/patterns/dark-wood.png');"></div>
            </div>
            
            <div class="w-full max-w-[440px] mx-auto relative z-10">
                <h2 class="font-display-hero text-2xl text-creamy-alabaster text-center mb-12 uppercase tracking-wide">Galeri Kenangan</h2>
                
                <div class="relative w-full h-[520px] mx-auto overflow-hidden">
                    <!-- Polaroid 1 -->
                    @if(isset($gallery[0]))
                    <div class="absolute top-2 left-2 w-[170px] rotate-[-8deg] z-20 hover:z-50 hover:rotate-0 transition-all duration-300 cursor-pointer" onclick="openLightbox('{{ $gallery[0] }}')">
                        <div class="bg-white p-2.5 pb-6 shadow-xl rounded-sm">
                            <img class="w-full h-28 object-cover rounded-xs" src="{{ $gallery[0] }}" alt="Gallery 1"/>
                            <span class="scrapbook-tape absolute -top-2 left-1/2 -translate-x-1/2 w-14 h-5"></span>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Polaroid 2 -->
                    @if(isset($gallery[1]))
                    <div class="absolute top-10 right-2 w-[180px] rotate-[6deg] z-10 hover:z-50 hover:rotate-0 transition-all duration-300 cursor-pointer" onclick="openLightbox('{{ $gallery[1] }}')">
                        <div class="bg-white p-2.5 pb-7 shadow-2xl rounded-sm border-[6px] border-white">
                            <img class="w-full h-32 object-cover rounded-xs" src="{{ $gallery[1] }}" alt="Gallery 2"/>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Polaroid 3 -->
                    @if(isset($gallery[2]))
                    <div class="absolute top-[180px] left-4 w-[190px] rotate-[-5deg] z-30 hover:z-50 hover:rotate-0 transition-all duration-300 cursor-pointer" onclick="openLightbox('{{ $gallery[2] }}')">
                        <div class="bg-white p-3 pb-8 shadow-2xl rounded-sm">
                            <img class="w-full h-28 object-cover rounded-xs" src="{{ $gallery[2] }}" alt="Gallery 3"/>
                            <div class="absolute top-3 right-3 w-10 h-3 bg-metallic-gold/30 rotate-45"></div>
                        </div>
                    </div>
                    @endif

                    <!-- Polaroid 4 -->
                    @if(isset($gallery[3]))
                    <div class="absolute top-[210px] right-2 w-[190px] rotate-[4deg] z-20 hover:z-50 hover:rotate-0 transition-all duration-300 cursor-pointer" onclick="openLightbox('{{ $gallery[3] }}')">
                        <div class="bg-white p-2.5 pb-6 shadow-xl rounded-sm border-t-4 border-metallic-gold">
                            <img class="w-full h-28 object-cover rounded-xs" src="{{ $gallery[3] }}" alt="Gallery 4"/>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Polaroid 5 -->
                    @if(isset($gallery[4]))
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 w-[200px] rotate-[-2deg] z-40 hover:z-50 hover:rotate-0 transition-all duration-300 cursor-pointer" onclick="openLightbox('{{ $gallery[4] }}')">
                        <div class="bg-white p-3 pb-8 shadow-2xl rounded-sm border-2 border-metallic-gold/30">
                            <img class="w-full h-32 object-cover rounded-xs" src="{{ $gallery[4] }}" alt="Gallery 5"/>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- KADO / DIGITAL GIFT SECTION -->
        <section class="py-section-gap px-grid-margin relative overflow-hidden" id="gifts">
            <div class="absolute inset-0 floral-bg z-0 opacity-10"></div>
            <div class="max-w-md mx-auto space-y-6 relative z-10 text-center">
                <h2 class="font-display-hero-mobile text-3xl text-primary font-bold">Kado Digital</h2>
                <p class="text-xs text-on-surface-variant leading-relaxed px-4">Doa restu Anda merupakan karunia terindah. Namun jika ingin mengirimkan tanda kasih, Anda dapat mengirimkannya secara digital.</p>
                
                <div class="flex flex-col gap-6 mt-6">
                    @foreach($gifts as $gift)
                    <div class="p-6 bg-white border border-metallic-gold/30 rounded-xl shadow-md space-y-3 max-w-sm mx-auto w-full text-center scroll-reveal">
                        <p class="font-label-caps text-xs text-metallic-gold font-bold uppercase">{{ $gift['bank'] }} TRANSFER</p>
                        <h4 class="font-display-hero text-xl text-primary font-bold tracking-wider">{{ $gift['account'] }}</h4>
                        <p class="text-xs text-on-surface-variant">a.n. {{ $gift['name'] }}</p>
                        <button class="px-5 py-2 bg-deep-espresso text-metallic-gold font-label-bold text-xs rounded-full hover:bg-rich-chocolate transition-colors font-bold tracking-widest shadow-md" onclick="copyRek('{{ $gift['account'] }}', this)">
                            SALIN REKENING
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- RSVP & WISHLIST SECTION -->
        <section class="py-section-gap px-grid-margin relative overflow-hidden" id="rsvp">
            <div class="absolute inset-0 floral-bg z-0 opacity-[0.04]"></div>
            <div class="max-w-md mx-auto space-y-8 relative z-10">
                
                <!-- RSVP Card -->
                <div class="relative group scroll-reveal">
                    <div class="absolute inset-0 bg-metallic-gold transform translate-x-2 translate-y-2 rounded-xl transition-transform group-hover:translate-x-1 group-hover:translate-y-1"></div>
                    <div class="relative bg-creamy-alabaster border-2 border-deep-espresso p-6 rounded-xl text-deep-espresso space-y-4 z-10 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 gold-corner-tr opacity-10"></div>
                        
                        <div class="flex items-center gap-3 border-b border-deep-espresso/10 pb-3">
                            <span class="material-symbols-outlined text-2xl">mail</span>
                            <h3 class="font-headline-lg text-lg uppercase font-bold">Konfirmasi Kehadiran</h3>
                        </div>
                        
                        <form class="space-y-4 pt-2" id="rsvp-form" onsubmit="submitRsvp(event)">
                            <div class="space-y-1">
                                <label class="font-label-bold text-xs block font-bold">Nama Lengkap</label>
                                <input class="w-full bg-transparent border-0 border-b-2 border-metallic-gold focus:ring-0 focus:border-deep-espresso px-0 text-sm transition-colors py-1.5" placeholder="Masukkan nama Anda" id="rsvp-nama" type="text" required/>
                            </div>
                            
                            <div class="space-y-1">
                                <label class="font-label-bold text-xs block font-bold">Konfirmasi Kehadiran</label>
                                <select class="w-full bg-transparent border-0 border-b-2 border-metallic-gold focus:ring-0 focus:border-deep-espresso px-0 text-sm transition-colors py-1.5" id="rsvp-kehadiran" required>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Tidak Hadir">Tidak Hadir</option>
                                    <option value="Ragu-ragu">Masih Ragu</option>
                                </select>
                            </div>
                            
                            <div class="space-y-1">
                                <label class="font-label-bold text-xs block font-bold">Pesan Harapan</label>
                                <textarea class="w-full bg-transparent border-0 border-b-2 border-metallic-gold focus:ring-0 focus:border-deep-espresso px-0 text-sm transition-colors py-1.5" placeholder="Berikan ucapan terbaikmu..." id="rsvp-pesan" rows="3" required></textarea>
                            </div>
                            
                            <button class="w-full py-3 bg-deep-espresso text-metallic-gold font-label-bold rounded-lg hover:bg-rich-chocolate transition-colors shadow-lg text-xs font-bold uppercase tracking-wider" type="submit">
                                Kirim Konfirmasi
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Wishes / Comments List -->
                <div class="space-y-4 mt-8 scroll-reveal">
                    <h3 class="font-headline-md text-xl text-primary font-bold border-b border-metallic-gold/20 pb-2">Ucapan &amp; Doa Restu</h3>
                    
                    <div class="flex flex-col gap-3 max-h-[350px] overflow-y-auto pr-1" id="wishList">
                        @foreach($wishes as $wish)
                        <div class="p-4 bg-white shadow-sm border-l-4 border-metallic-gold rounded-sm text-left">
                            <p class="text-xs text-on-surface-variant italic">"{{ $wish['message'] }}"</p>
                            <span class="font-label-bold text-metallic-gold text-[9px] block mt-2 font-bold uppercase">— {{ $wish['name'] }} ({{ $wish['status'] }})</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER BRANDING -->
        <footer class="text-center py-10 bg-deep-espresso text-creamy-alabaster border-t border-metallic-gold/30">
            <p class="text-[9px] font-label-bold tracking-widest uppercase mb-1">Created with <span class="material-symbols-outlined text-xs text-festive-accent align-middle">favorite</span> TemuRuang</p>
            <p class="text-[8px] opacity-50">&copy; {{ date('Y') }} All Rights Reserved</p>
        </footer>

        <!-- BOTTOM NAV BAR -->
        <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 rounded-t-full bg-deep-espresso border-t border-metallic-gold shadow-[0_-4px_10px_rgba(38,20,13,0.3)] flex justify-around items-center h-20 px-2 pb-2" id="bottomNav">
            <a class="flex flex-col items-center justify-center text-metallic-gold scale-110 p-2 transition-all" href="#home" onclick="smoothScroll(event, '#home', this)">
                <span class="material-symbols-outlined text-xl">home</span>
                <span class="font-label-sm text-[9px]">Home</span>
            </a>
            <a class="flex flex-col items-center justify-center text-secondary-fixed-dim p-2 hover:text-gold-foil-light transition-all" href="#mempelai" onclick="smoothScroll(event, '#mempelai', this)">
                <span class="material-symbols-outlined text-xl">favorite</span>
                <span class="font-label-sm text-[9px]">Mempelai</span>
            </a>
            <a class="flex flex-col items-center justify-center text-secondary-fixed-dim p-2 hover:text-gold-foil-light transition-all" href="#event" onclick="smoothScroll(event, '#event', this)">
                <span class="material-symbols-outlined text-xl">calendar_today</span>
                <span class="font-label-sm text-[9px]">Acara</span>
            </a>
            <a class="flex flex-col items-center justify-center text-secondary-fixed-dim p-2 hover:text-gold-foil-light transition-all" href="#story" onclick="smoothScroll(event, '#story', this)">
                <span class="material-symbols-outlined text-xl">auto_stories</span>
                <span class="font-label-sm text-[9px]">Cerita</span>
            </a>
            <a class="flex flex-col items-center justify-center text-secondary-fixed-dim p-2 hover:text-gold-foil-light transition-all" href="#rsvp" onclick="smoothScroll(event, '#rsvp', this)">
                <span class="material-symbols-outlined text-xl">mail</span>
                <span class="font-label-sm text-[9px]">RSVP</span>
            </a>
        </nav>
        
        <div class="h-20"></div>
    </main>

    <!-- FLOATING ACTIONS CONTAINER -->
    <div class="floater-container" id="floating-actions">
        <div class="floater-inner">
            <div class="float-btn" id="scrollControl" onclick="toggleAutoscroll()">
                <span class="material-symbols-outlined text-xl">keyboard_double_arrow_down</span>
            </div>
            <div class="float-btn" id="musicControl" onclick="toggleMusic()">
                <span class="material-symbols-outlined text-xl">music_note</span>
            </div>
        </div>
    </div>

    <!-- LIGHTBOX / ZOOM MODAL -->
    <div id="lightbox" class="hidden fixed inset-y-0 z-[300] bg-black/95 flex items-center justify-center p-6 opacity-0 transition-opacity duration-300" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white hover:text-metallic-gold" onclick="closeLightbox()">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <img id="lightbox-img" class="max-w-full max-h-[80vh] object-contain shadow-2xl border-2 border-metallic-gold" src="" alt="Zoomed view"/>
    </div>

    <!-- Scripts -->
    <script>
        let isAutoscrolling = false;
        let autoscrollSpeed = 0.6;

        function unlockInvitation() {
            document.getElementById('wedding-cover').classList.add('hidden');
            document.getElementById('main-content').classList.remove('hidden');
            document.body.classList.remove('cover-active');
            
            // Play background music
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio block: " + err));
            
            // Show floating actions
            document.getElementById('floating-actions').classList.add('visible');
            
            // Trigger scroll reveal initial check
            triggerScrollReveal();
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) {
                audio.play();
                ctrl.classList.add('playing');
            } else {
                audio.pause();
                ctrl.classList.remove('playing');
            }
        }

        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            const current = window.innerHeight + window.pageYOffset;
            if (current >= (document.documentElement.scrollHeight - 5)) {
                stopAutoscroll();
                return;
            }
            requestAnimationFrame(scrollStep);
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

        function initCountdown() {
            const target = new Date("{{ $event['date_iso'] }}T{{ $event['time'] }}:00").getTime();
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

        function copyRek(text, btn) {
            navigator.clipboard.writeText(text.replace(/\s/g, '').replace(/-/g, '')).then(() => {
                const oldContent = btn.innerHTML;
                btn.innerHTML = '<span class="material-symbols-outlined text-[10px]">check</span> DISALIN';
                alert('Nomor rekening berhasil disalin!');
                setTimeout(() => {
                    btn.innerHTML = oldContent;
                }, 2000);
            });
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-nama').value;
            const status = document.getElementById('rsvp-kehadiran').value;
            const msg = document.getElementById('rsvp-pesan').value;

            const card = document.createElement('div');
            card.className = 'p-4 bg-white shadow-sm border-l-4 border-metallic-gold rounded-sm text-left';
            card.innerHTML = `<p class="text-xs text-on-surface-variant italic">"${msg}"</p><span class="font-label-bold text-metallic-gold text-[9px] block mt-2 font-bold uppercase">— ${name} (${status})</span>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert('Konfirmasi kehadiran berhasil terkirim!');
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
            
            document.querySelectorAll('#bottomNav a').forEach(a => {
                a.classList.remove('text-metallic-gold', 'scale-110');
                a.classList.add('text-secondary-fixed-dim');
            });
            el.classList.remove('text-secondary-fixed-dim');
            el.classList.add('text-metallic-gold', 'scale-110');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        function triggerScrollReveal() {
            const revealElements = document.querySelectorAll('.scroll-reveal');
            revealElements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                if (elementTop < windowHeight - 100) {
                    el.classList.add('reveal-active');
                }
            });
        }

        function createParticles() {
            const container = document.getElementById('particle-container');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                resetParticle(particle);
                container.appendChild(particle);
                animateParticle(particle);
            }
        }

        function resetParticle(particle) {
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `-20px`;
            particle.style.opacity = Math.random() * 0.5 + 0.1;
        }

        function animateParticle(particle) {
            let top = parseFloat(particle.style.top);
            let left = parseFloat(particle.style.left);
            const speed = Math.random() * 0.5 + 0.2;
            const drift = (Math.random() - 0.5) * 0.1;

            function step() {
                top += speed;
                left += drift;
                particle.style.top = `${top}px`;
                particle.style.left = `${left}%`;

                if (top > window.innerHeight) {
                    resetParticle(particle);
                    top = -20;
                }
                requestAnimationFrame(step);
            }
            step();
        }

        document.addEventListener("DOMContentLoaded", function() {
            initCountdown();
            createParticles();
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });

            // Scroll reveal animation checks
            window.addEventListener('scroll', triggerScrollReveal);

            // Active nav state indicator logic
            window.addEventListener('scroll', () => {
                let current = "";
                const sections = document.querySelectorAll("section");
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 250) {
                        current = section.getAttribute("id");
                    }
                });

                document.querySelectorAll('#bottomNav a').forEach((a) => {
                    a.classList.remove('text-metallic-gold', 'scale-110');
                    a.classList.add('text-secondary-fixed-dim');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-secondary-fixed-dim');
                        a.classList.add('text-metallic-gold', 'scale-110');
                    }
                });
            });
        });
    </script>
</body>
</html>