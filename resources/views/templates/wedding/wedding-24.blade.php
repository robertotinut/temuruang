@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Julian');
        $brideName = trim($names[1] ?? 'Evelyn');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Albert Thorne & Ibu Sofia Thorne',
                'bride' => 'Bpk. Henry Rose & Ibu Maria Rose',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-10-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '10:00',
            'location' => $invitation->location ?? 'The Grand Ballroom, Hotel Majestic, Jakarta',
            'address' => $invitation->address ?? 'Jl. Majestic Raya No. 12, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Grand Ballroom, Hotel Majestic, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '10:00') . ' - 12:00 WIB',
                'note' => $invitation->location ?? 'The Grand Ballroom, Hotel Majestic, Jakarta'
            ],
            [
                'title' => 'Resepsi',
                'time' => '18:30 - Selesai',
                'note' => $invitation->address ?? 'Jl. Majestic Raya No. 12, Jakarta'
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
                ['title' => 'First Encounter', 'date' => 'Januari 2020', 'text' => 'Bertemu di sebuah gala megah, pandangan pertama yang mengubah segalanya.'],
                ['title' => 'The Proposal', 'date' => 'Agustus 2022', 'text' => 'Di bawah bintang-bintang, sebuah komitmen suci untuk melangkah bersama selamanya.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-24/images/image_7.jpg'),
                asset('assets/templates/wedding-24/images/image_8.jpg'),
                asset('assets/templates/wedding-24/images/image_9.jpg'),
                asset('assets/templates/wedding-24/images/image_10.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-24/images/image_2.jpg');
        $bg = [
            'cover' => $coverUrl,
            'collage_left' => asset('assets/templates/wedding-24/images/image_1.jpg'),
            'collage_right' => asset('assets/templates/wedding-24/images/image_3.jpg'),
            'hero' => asset('assets/templates/wedding-24/images/image_4.jpg'),
            'groom' => asset('assets/templates/wedding-24/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-24/images/image_6.jpg'),
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
                ['name' => 'Hendra', 'status' => 'Hadir', 'message' => 'Selamat Evelyn & Julian! Semoga dilancarkan hingga hari H dan bahagia selamanya.'],
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
                ['bank' => 'BCA', 'name' => 'EVELYN ROSE', 'account' => '987-654-3210'],
            ];
        }
    } else {
        $couple = [
            'groom' => 'Julian',
            'bride' => 'Evelyn',
            'parents' => [
                'groom' => 'Bpk. Albert Thorne & Ibu Sofia Thorne',
                'bride' => 'Bpk. Henry Rose & Ibu Maria Rose',
            ],
        ];

        $event = [
            'date_iso' => '2024-10-24',
            'time' => '10:00',
            'location' => 'The Grand Ballroom, Hotel Majestic, Jakarta',
            'address' => 'Jl. Majestic Raya No. 12, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=Hotel+Majestic+Jakarta',
        ];

        $schedule = [
            ['title' => 'AKAD NIKAH', 'time' => '10:00 - 12:00 WIB', 'note' => 'The Grand Ballroom, Hotel Majestic, Jakarta'],
            ['title' => 'RESEPSI', 'time' => '18:30 - Selesai', 'note' => 'Jl. Majestic Raya No. 12, Jakarta'],
        ];

        $stories = [
            ['title' => 'First Encounter', 'date' => 'Januari 2020', 'text' => 'Bertemu di sebuah gala megah, pandangan pertama yang mengubah segalanya.'],
            ['title' => 'The Proposal', 'date' => 'Agustus 2022', 'text' => 'Di bawah bintang-bintang, sebuah komitmen suci untuk melangkah bersama selamanya.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-24/images/image_7.jpg'),
            asset('assets/templates/wedding-24/images/image_8.jpg'),
            asset('assets/templates/wedding-24/images/image_9.jpg'),
            asset('assets/templates/wedding-24/images/image_10.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-24/images/image_2.jpg'),
            'collage_left' => asset('assets/templates/wedding-24/images/image_1.jpg'),
            'collage_right' => asset('assets/templates/wedding-24/images/image_3.jpg'),
            'hero' => asset('assets/templates/wedding-24/images/image_4.jpg'),
            'groom' => asset('assets/templates/wedding-24/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-24/images/image_6.jpg'),
        ];

        $wishes = [
            ['name' => 'Hendra', 'status' => 'Hadir', 'message' => 'Selamat Evelyn & Julian! Semoga dilancarkan hingga hari H dan bahagia selamanya.'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'EVELYN ROSE', 'account' => '987-654-3210'],
        ];
    }
@endphp
<!DOCTYPE html>
<html class="light scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Undangan Pernikahan | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&amp;family=Plus+Jakarta+Sans:wght@400;700&amp;family=Source+Serif+4:ital,wght@0,400;0,600;1,400&amp;family=Syne:wght@600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed-dim": "#bcc2ff",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#e9c349",
                        "surface-container-highest": "#e2e2e2",
                        "on-tertiary-fixed": "#000c61",
                        "error": "#ba1a1a",
                        "surface": "#f9f9f9",
                        "on-secondary-container": "#745c00",
                        "primary-fixed-dim": "#ffb4a8",
                        "secondary-container": "#fed65b",
                        "secondary": "#735c00",
                        "outline-variant": "#e2bfb9",
                        "error-container": "#ffdad6",
                        "on-tertiary": "#ffffff",
                        "surface-dim": "#dadada",
                        "surface-container-high": "#e8e8e8",
                        "on-background": "#1a1c1c",
                        "surface-variant": "#e2e2e2",
                        "secondary-fixed": "#ffe088",
                        "on-surface": "#1a1c1c",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#2f3131",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed-variant": "#8f0f07",
                        "on-primary": "#ffffff",
                        "metallic-gold": "#D4AF37",
                        "on-secondary-fixed": "#241a00",
                        "primary-container": "#800000",
                        "background": "#f9f9f9",
                        "surface-container-low": "#f3f3f4",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#94a0ff",
                        "surface-container": "#eeeeee",
                        "inverse-primary": "#ffb4a8",
                        "tertiary-fixed": "#dfe0ff",
                        "on-primary-fixed": "#410000",
                        "primary": "#570000",
                        "surface-tint": "#b22b1d",
                        "on-primary-container": "#ff8371",
                        "surface-bright": "#f9f9f9",
                        "on-surface-variant": "#5a413d",
                        "tertiary": "#00137f",
                        "primary-fixed": "#ffdad4",
                        "deep-maroon": "#800000",
                        "on-tertiary-fixed-variant": "#1830c2",
                        "soft-gold": "#F2E6C2",
                        "ink-black": "#1A1A1A",
                        "tertiary-container": "#0021b9",
                        "on-secondary-fixed-variant": "#574500",
                        "inverse-on-surface": "#f0f1f1",
                        "outline": "#8e706c"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "gutter": "24px",
                        "element-overlap": "-40px",
                        "section-gap": "120px",
                        "container-max": "1200px",
                        "margin-mobile": "20px"
                    },
                    fontFamily: {
                        "label-caps": ["Plus Jakarta Sans"],
                        "body-lg": ["\"Source Serif 4\""],
                        "body-md": ["\"Source Serif 4\""],
                        "headline-lg": ["Syne"],
                        "headline-md": ["Syne"],
                        "display-grand-mobile": ["Great Vibes"],
                        "display-grand": ["Great Vibes"]
                    },
                    fontSize: {
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.2em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "display-grand-mobile": ["56px", {"lineHeight": "60px", "fontWeight": "400"}],
                        "display-grand": ["84px", {"lineHeight": "90px", "letterSpacing": "0.02em", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float { 
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .sparkle-bg {
            background-image: radial-gradient(circle, #D4AF37 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .floral-texture {
            background-image: url("https://www.transparenttextures.com/patterns/black-linen.png"), 
                              linear-gradient(135deg, #800000 0%, #570000 100%);
            background-blend-mode: overlay;
        }
        body { overflow-x: hidden; }
        .polaroid {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.4s ease;
        }
        .polaroid:hover { transform: rotate(0deg) scale(1.05); }

        /* Lock background cover */
        body.cover-active { overflow: hidden; height: 100vh; }
        #main-content { display: none; }

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
            background: rgba(26, 28, 28, 0.85);
            backdrop-filter: blur(10px);
            border: 2px solid #D4AF37;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #D4AF37;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            transition: all 0.3s;
        }
        .float-btn:hover { background: #D4AF37; color: #1A1A1A; }
        .float-btn.playing .material-symbols-outlined { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .float-btn.scrolling { background: #D4AF37; color: #1A1A1A; }

        /* Bottom Nav styling */
        .bottom-nav-bar {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 420px;
            z-index: 50;
        }

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

        /* Scroll reveal animation styles */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(40px) scale(0.96);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scroll-reveal.reveal-active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        
        /* Pulse ring animation */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 1; }
            50% { opacity: 0.5; }
            100% { transform: scale(1.4); opacity: 0; }
        }
        .animate-pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        /* Floating ornaments */
        .animate-sway {
            animation: sway 8s ease-in-out infinite alternate;
        }
        @keyframes sway {
            0% { transform: rotate(-5deg) translateY(0); }
            100% { transform: rotate(5deg) translateY(-8px); }
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body-md cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-metallic-gold/20 relative">

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- ==================== OVERLAY COVER ==================== -->
    <div class="fixed inset-y-0 z-[100] max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-center floral-texture overflow-hidden" id="wedding-cover">
        <div class="absolute inset-0 opacity-20 sparkle-bg"></div>
        
        <!-- Intricate Floral Ornaments for Overlay -->
        <div class="absolute -top-10 -left-10 w-48 h-48 opacity-25 rotate-180 text-soft-gold">
            <svg fill="none" viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 20C100 20 120 60 100 100C80 60 100 20 100 20ZM20 100C20 100 60 80 100 100C60 120 20 100 20 100ZM100 180C100 180 80 140 100 100C120 140 100 180 100 180ZM180 100C180 100 140 120 100 100C140 80 180 100 180 100Z" stroke="currentColor" stroke-width="0.5"></path>
                <circle cx="100" cy="100" r="40" stroke="currentColor" stroke-width="0.5"></circle>
            </svg>
        </div>
        <div class="absolute -bottom-10 -right-10 w-48 h-48 opacity-25 text-soft-gold">
            <svg fill="none" viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 20C100 20 120 60 100 100C80 60 100 20 100 20ZM20 100C20 100 60 80 100 100C60 120 20 100 20 100ZM100 180C100 180 80 140 100 100C120 140 100 180 100 180ZM180 100C180 100 140 120 100 100C140 80 180 100 180 100Z" stroke="currentColor" stroke-width="0.5"></path>
                <circle cx="100" cy="100" r="40" stroke="currentColor" stroke-width="0.5"></circle>
            </svg>
        </div>

        <!-- Staggered Prewedding Collage (Resized and scaled for mobile containment) -->
        <div class="relative w-full max-w-sm h-[400px] flex items-center justify-center">
            <div class="absolute w-32 h-44 -translate-x-20 -translate-y-6 rotate-[-12deg] border-[6px] border-white shadow-2xl overflow-hidden rounded-sm">
                <img class="w-full h-full object-cover" src="{{ $bg['collage_left'] }}" alt="Prewedding Left"/>
            </div>
            <div class="absolute w-40 h-52 z-10 translate-x-1 translate-y-4 rotate-[5deg] border-[8px] border-white shadow-2xl overflow-hidden rounded-sm">
                <img class="w-full h-full object-cover" src="{{ $bg['cover'] }}" alt="Prewedding Center"/>
            </div>
            <div class="absolute w-28 h-36 translate-x-20 -translate-y-12 rotate-[-8deg] border-[6px] border-white shadow-2xl overflow-hidden rounded-sm">
                <img class="w-full h-full object-cover" src="{{ $bg['collage_right'] }}" alt="Prewedding Right"/>
            </div>
        </div>

        <!-- Content -->
        <div class="z-20 text-center flex flex-col items-center px-4 mt-6">
            <p class="font-label-caps text-label-caps text-soft-gold mb-3 text-[10px]">THE WEDDING OF</p>
            <h1 class="font-display-grand text-4xl md:text-5xl text-white drop-shadow-xl mb-6 uppercase">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            
            <div class="glass-panel p-5 rounded-2xl border-metallic-gold/30 mb-8 max-w-xs text-center backdrop-blur-md w-72">
                <p class="text-[9px] font-label-caps text-soft-gold/80 mb-1.5 uppercase">Dear Honorable Guest</p>
                <p class="font-headline-md text-white text-sm truncate font-semibold">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
            </div>
            
            <button class="px-10 py-3.5 bg-white text-deep-maroon font-bold text-xs border border-metallic-gold hover:bg-metallic-gold hover:text-white transition-all duration-500 rounded-full font-label-caps shadow-xl tracking-wider" onclick="unlockInvitation()">
                BUKA UNDANGAN
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main id="main-content">
        <!-- TopAppBar -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 flex justify-between items-center px-6 py-4 bg-surface/20 backdrop-blur-md dark:bg-ink-black/10 transition-colors duration-300">
            <span class="material-symbols-outlined text-deep-maroon text-xl">auto_stories</span>
            <span class="font-display-grand text-lg text-deep-maroon font-semibold">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</span>
            <span class="material-symbols-outlined text-deep-maroon text-xl">favorite</span>
        </header>

        <!-- HERO SECTION -->
        <section class="relative min-h-screen flex flex-col items-center justify-center text-center overflow-hidden px-4" id="home">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover opacity-20" src="{{ $bg['hero'] }}" alt="Hero Background"/>
                <div class="absolute inset-0 bg-gradient-to-t from-surface via-surface/40 to-surface"></div>
            </div>
            <div class="relative z-10 max-w-sm flex flex-col items-center w-full">
                <div class="mb-4 animate-pulse">
                    <span class="material-symbols-outlined text-metallic-gold text-5xl">auto_awesome</span>
                </div>
                <h2 class="font-display-grand text-3xl text-deep-maroon mb-2">SAVE THE DATE</h2>
                <div class="w-20 h-0.5 bg-metallic-gold my-4"></div>
                <p class="font-headline-md text-primary text-base tracking-widest uppercase mb-12">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('F d, Y') }}
                </p>
                
                <!-- Countdown -->
                <div class="flex gap-6 justify-center w-full">
                    <div class="flex flex-col items-center">
                        <span class="font-headline-lg text-3xl text-deep-maroon" id="days">00</span>
                        <span class="font-label-caps text-[9px] text-outline mt-1">DAYS</span>
                    </div>
                    <div class="w-px h-10 bg-metallic-gold/50 self-center"></div>
                    <div class="flex flex-col items-center">
                        <span class="font-headline-lg text-3xl text-deep-maroon" id="hours">00</span>
                        <span class="font-label-caps text-[9px] text-outline mt-1">HOURS</span>
                    </div>
                    <div class="w-px h-10 bg-metallic-gold/50 self-center"></div>
                    <div class="flex flex-col items-center">
                        <span class="font-headline-lg text-3xl text-deep-maroon" id="minutes">00</span>
                        <span class="font-label-caps text-[9px] text-outline mt-1">MINS</span>
                    </div>
                    <div class="w-px h-10 bg-metallic-gold/50 self-center"></div>
                    <div class="flex flex-col items-center">
                        <span class="font-headline-lg text-3xl text-deep-maroon" id="seconds">00</span>
                        <span class="font-label-caps text-[9px] text-outline mt-1">SECS</span>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Scroll Indicator -->
            <div class="absolute bottom-12 animate-bounce">
                <span class="material-symbols-outlined text-deep-maroon text-2xl">expand_more</span>
            </div>
        </section>

        <!-- MEMPELAI SECTION -->
        <section class="py-24 px-4 bg-white relative overflow-hidden text-center" id="mempelai">
            <!-- Decorative Floral Ornament -->
            <div class="absolute -top-10 -right-10 w-64 h-64 opacity-5 pointer-events-none text-deep-maroon">
                <svg viewbox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 0C100 0 130 50 100 100C70 50 100 0 100 0ZM0 100C0 100 50 70 100 100C50 130 0 100 0 100ZM100 200C100 200 70 150 100 100C130 150 100 200 100 200ZM200 100C200 100 150 130 100 100C150 70 200 100 200 100Z" fill="currentColor"></path>
                </svg>
            </div>
            <div class="max-w-sm mx-auto flex flex-col gap-16">
                <!-- Groom -->
                <div class="flex flex-col items-center w-full">
                    <div class="polaroid bg-white p-4 rotate-[-4deg] border border-surface-container shadow-2xl mb-6">
                        <div class="w-60 h-72 overflow-hidden mb-4 rounded-sm">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="{{ $bg['groom'] }}" alt="Portrait of Groom"/>
                        </div>
                        <p class="font-display-grand text-2xl text-deep-maroon text-center">{{ $couple['groom'] }}</p>
                    </div>
                    <p class="font-label-caps text-metallic-gold text-xs tracking-widest uppercase mb-2">Putra dari</p>
                    <p class="text-on-surface-variant font-medium text-xs mb-4">{{ $couple['parents']['groom'] }}</p>
                    <p class="font-body-lg text-xs text-center max-w-xs italic text-on-surface-variant leading-relaxed px-4">
                        "When I saw her, I knew my heart had finally found its home."
                    </p>
                </div>
                
                <span class="font-display-names text-4xl text-metallic-gold font-light my-2">&amp;</span>
                
                <!-- Bride -->
                <div class="flex flex-col items-center w-full">
                    <div class="polaroid bg-white p-4 rotate-[4deg] border border-surface-container shadow-2xl mb-6">
                        <div class="w-60 h-72 overflow-hidden mb-4 rounded-sm">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="{{ $bg['bride'] }}" alt="Portrait of Bride"/>
                        </div>
                        <p class="font-display-grand text-2xl text-deep-maroon text-center">{{ $couple['bride'] }}</p>
                    </div>
                    <p class="font-label-caps text-metallic-gold text-xs tracking-widest uppercase mb-2">Putri dari</p>
                    <p class="text-on-surface-variant font-medium text-xs mb-4">{{ $couple['parents']['bride'] }}</p>
                    <p class="font-body-lg text-xs text-center max-w-xs italic text-on-surface-variant leading-relaxed px-4">
                        "In your eyes, I see every adventure I ever want to have."
                    </p>
                </div>
            </div>
        </section>

        <!-- EVENTS SECTION -->
        <section class="py-24 px-4 bg-surface text-center" id="events">
            <div class="max-w-sm mx-auto flex flex-col gap-8">
                <div class="text-center mb-6">
                    <span class="font-label-caps text-label-caps text-metallic-gold mb-2 block">CELEBRATION</span>
                    <h2 class="font-display-grand text-3xl text-deep-maroon">Waktu &amp; Lokasi</h2>
                </div>
                
                @foreach($schedule as $i => $sch)
                <div class="bg-white p-8 rounded-2xl border border-soft-gold shadow-xl relative overflow-hidden text-left">
                    <div class="absolute -top-10 -right-10 w-24 h-24 opacity-10 rotate-90 text-deep-maroon pointer-events-none">
                        <svg viewbox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                            <path d="M50 0 C50 0 60 40 50 50 C40 40 50 0 50 0 M0 50 C0 50 40 40 50 50 C40 60 0 50 0 50 M50 100 C50 100 40 60 50 50 C60 60 50 100 50 100 M100 50 C100 50 60 60 50 50 C60 40 100 50 100 50" stroke="currentColor" stroke-width="0.5"></path>
                        </svg>
                    </div>
                    <h3 class="font-headline-md text-deep-maroon text-base mb-4 flex items-center gap-2 justify-center font-bold">
                        <span class="material-symbols-outlined text-metallic-gold text-lg">{{ $i === 0 ? 'favorite' : 'celebration' }}</span>
                        {{ strtoupper($sch['title']) }}
                    </h3>
                    <div class="space-y-3.5 text-on-surface-variant text-xs font-light max-w-xs mx-auto">
                        <p class="flex items-center gap-3 justify-center"><span class="material-symbols-outlined text-metallic-gold text-base">event</span> {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                        <p class="flex items-center gap-3 justify-center"><span class="material-symbols-outlined text-metallic-gold text-base">schedule</span> Pukul {{ $sch['time'] }}</p>
                        <p class="flex items-center gap-3 justify-center"><span class="material-symbols-outlined text-metallic-gold text-base">pin_drop</span> {{ $sch['note'] }}</p>
                    </div>
                </div>
                @endforeach

                <div class="bg-white p-8 rounded-2xl border border-metallic-gold/20 shadow-xl text-center">
                    <p class="font-bold text-deep-maroon text-sm mb-2 uppercase tracking-widest">{{ $event['location'] }}</p>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-6 font-light px-4">{{ $event['address'] }}</p>
                    
                    <div class="flex flex-col gap-3">
                        <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="w-full bg-deep-maroon text-white py-3 rounded-full font-bold flex items-center justify-center gap-2 hover:bg-metallic-gold transition-colors text-xs shadow-md font-label-caps">
                            <span class="material-symbols-outlined text-base">map</span> BUKA GOOGLE MAPS
                        </a>
                        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($couple['groom'] . ' & ' . $couple['bride'] . ' Wedding') }}&dates={{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T080000Z/{{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T210000Z&details=Pernikahan+{{ urlencode($couple['groom'] . '+&+' . $couple['bride']) }}&location={{ urlencode($event['location']) }}" target="_blank" rel="noopener" class="w-full border border-metallic-gold text-metallic-gold py-3 rounded-full font-bold flex items-center justify-center gap-2 hover:bg-metallic-gold/10 transition-colors text-xs font-label-caps">
                            <span class="material-symbols-outlined text-base">calendar_add_on</span> SIMPAN TANGGAL
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- STORIES SECTION -->
        <section class="py-28 px-6 relative overflow-hidden text-center floral-texture text-white" id="story">
            <div class="absolute inset-0 opacity-20 sparkle-bg pointer-events-none"></div>
            
            <!-- Intricate corner floral vector decorations -->
            <div class="absolute -top-12 -left-12 w-36 h-36 opacity-30 text-soft-gold animate-sway pointer-events-none">
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0 Q50 0 50 50 Q100 50 100 100 M0 20 Q35 20 35 55" stroke="currentColor" stroke-width="0.75"></path>
                    <circle cx="50" cy="50" r="10" stroke="currentColor" stroke-width="0.5" fill="none"></circle>
                </svg>
            </div>
            <div class="absolute -bottom-12 -right-12 w-36 h-36 opacity-30 text-soft-gold animate-sway pointer-events-none" style="transform: rotate(180deg);">
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0 Q50 0 50 50 Q100 50 100 100 M0 20 Q35 20 35 55" stroke="currentColor" stroke-width="0.75"></path>
                    <circle cx="50" cy="50" r="10" stroke="currentColor" stroke-width="0.5" fill="none"></circle>
                </svg>
            </div>

            <!-- Floating animated golden stars in background -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
                <span class="material-symbols-outlined absolute text-soft-gold/20 text-xl top-10 left-1/4 animate-pulse">auto_awesome</span>
                <span class="material-symbols-outlined absolute text-soft-gold/20 text-2xl top-1/2 right-10 animate-pulse delay-700">star</span>
                <span class="material-symbols-outlined absolute text-soft-gold/15 text-lg bottom-10 left-12 animate-pulse delay-1000">favorite</span>
            </div>

            <div class="max-w-sm mx-auto relative z-10">
                <div class="text-center mb-16 scroll-reveal">
                    <span class="font-label-caps text-label-caps text-soft-gold mb-2 block font-semibold tracking-[0.25em]">OUR MEMOIR</span>
                    <h2 class="font-display-grand text-4xl text-white drop-shadow-[0_2px_10px_rgba(0,0,0,0.5)]">Our Story</h2>
                    <div class="w-12 h-[1px] bg-soft-gold/60 mx-auto mt-4"></div>
                </div>
                
                @php
                    $storyIcons = ['auto_awesome', 'favorite', 'chat_bubble', 'celebration'];
                @endphp

                <div class="relative pl-10 border-l-[3px] border-metallic-gold/30 text-left py-2 space-y-12">
                    <!-- Glowing solid line shadow overlay -->
                    <div class="absolute -left-[3px] top-0 bottom-0 w-[3px] bg-gradient-to-b from-metallic-gold via-soft-gold to-metallic-gold shadow-[0_0_10px_#D4AF37] pointer-events-none"></div>

                    @foreach($stories as $i => $s)
                    <div class="relative scroll-reveal">
                        <!-- timeline dot with pulsing concentric rings -->
                        <div class="absolute -left-[51px] top-4 w-6 h-6 rounded-full bg-deep-maroon border-2 border-metallic-gold z-10 flex items-center justify-center shadow-[0_0_10px_rgba(212,175,55,0.6)]">
                            <div class="w-2 h-2 rounded-full bg-soft-gold"></div>
                            <!-- Pulse Ring -->
                            <div class="absolute inset-0 rounded-full border border-soft-gold animate-pulse-ring pointer-events-none"></div>
                        </div>

                        <!-- Elegant glassmorphic card container with gold borders -->
                        <div class="bg-black/35 backdrop-blur-md p-6 rounded-2xl border border-metallic-gold/30 hover:border-soft-gold/80 transition-all duration-500 shadow-xl group hover:shadow-[0_5px_25px_rgba(212,175,55,0.15)]">
                            <div class="flex items-center gap-3.5 mb-2.5">
                                <span class="material-symbols-outlined text-soft-gold text-lg group-hover:scale-125 transition-transform duration-300">{{ $storyIcons[$i % count($storyIcons)] }}</span>
                                <span class="font-label-caps text-[10px] text-soft-gold/90 font-semibold tracking-wider">{{ strtoupper($s['date']) }}</span>
                            </div>
                            
                            <h3 class="font-headline-md text-base text-white font-bold mb-2 group-hover:text-soft-gold transition-colors duration-300">{{ $s['title'] }}</h3>
                            <p class="text-white/85 text-xs leading-relaxed font-light font-body-lg italic">"{{ $s['text'] }}"</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- FLOATING STAGGERED COLLAGE GALLERY -->
        <section class="py-24 px-4 bg-surface relative text-center" id="photo_library">
            <div class="text-center mb-16">
                <span class="font-label-caps text-label-caps text-metallic-gold mb-2 block font-semibold">MEMORIES</span>
                <h2 class="font-display-grand text-3xl text-deep-maroon">Our Gallery</h2>
            </div>
            
            <!-- Staggered height relative container optimized for mobile centering -->
            <div class="relative w-full max-w-sm mx-auto min-h-[580px]">
                <!-- Item 1: Wide Rect -->
                @if(isset($gallery[0]))
                <div class="absolute top-0 left-0 w-[160px] border border-metallic-gold p-1 shadow-lg cursor-zoom-in group hover:scale-[1.03] transition-transform duration-300" onclick="openLightbox('{{ $gallery[0] }}')">
                    <img class="w-full aspect-[4/3] object-cover grayscale group-hover:grayscale-0 transition-all duration-300" src="{{ $gallery[0] }}" alt="Gallery Item 1"/>
                </div>
                @endif
                
                <!-- Item 2: Circle Frame -->
                @if(isset($gallery[1]))
                <div class="absolute top-16 right-0 w-[180px] aspect-square rounded-full border-4 border-metallic-gold overflow-hidden z-10 shadow-2xl animate-float cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                    <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-300" src="{{ $gallery[1] }}" alt="Gallery Item 2"/>
                </div>
                @endif
                
                <!-- Item 3: Tall Vertical -->
                @if(isset($gallery[2]))
                <div class="absolute bottom-0 left-4 w-[160px] border border-metallic-gold p-1 shadow-lg z-0 rotate-[-2deg] cursor-zoom-in group hover:scale-[1.03] transition-transform duration-300" onclick="openLightbox('{{ $gallery[2] }}')">
                    <img class="w-full aspect-[2/3] object-cover grayscale group-hover:grayscale-0 transition-all duration-300" src="{{ $gallery[2] }}" alt="Gallery Item 3"/>
                </div>
                @endif
                
                <!-- Item 4: Small Square -->
                @if(isset($gallery[3]))
                <div class="absolute bottom-16 right-4 w-[140px] border border-metallic-gold p-1 shadow-xl z-20 rotate-[10deg] cursor-zoom-in group hover:scale-[1.03] transition-transform duration-300" onclick="openLightbox('{{ $gallery[3] }}')">
                    <img class="w-full aspect-square object-cover grayscale group-hover:grayscale-0 transition-all duration-300" src="{{ $gallery[3] }}" alt="Gallery Item 4"/>
                </div>
                @endif
            </div>
        </section>

        <!-- RSVP SECTION -->
        <section class="py-24 px-4 floral-texture text-white relative overflow-hidden" id="rsvp">
            <div class="absolute inset-0 opacity-10 sparkle-bg pointer-events-none"></div>
            
            <div class="max-w-sm mx-auto text-center relative z-10">
                <h2 class="font-display-grand text-3xl text-white mb-6">Join Our Celebration</h2>
                
                <div class="glass-panel p-8 rounded-3xl border border-metallic-gold/30 shadow-2xl text-left bg-black/45">
                    <form class="space-y-5" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-caps text-soft-gold text-[10px] uppercase mb-1">Nama Lengkap</label>
                            <input class="w-full bg-transparent border-0 border-b border-white/40 py-2.5 focus:outline-none focus:border-soft-gold focus:ring-0 text-xs text-white placeholder:text-white/30" id="rsvp-nama" placeholder="Contoh: Budi Santoso" type="text" required/>
                        </div>
                        <div>
                            <label class="block font-label-caps text-soft-gold text-[10px] uppercase mb-1">Jumlah Tamu</label>
                            <select class="w-full bg-transparent border-0 border-b border-white/40 py-2.5 focus:outline-none focus:border-soft-gold focus:ring-0 text-xs text-white" id="rsvp-guests">
                                <option class="text-black" value="1">1 Orang</option>
                                <option class="text-black" value="2">2 Orang</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-caps text-soft-gold text-[10px] uppercase mb-1">Konfirmasi Kehadiran</label>
                            <div class="flex gap-6 mt-1.5 px-1">
                                <label class="flex items-center gap-2 cursor-pointer group text-xs text-white">
                                    <input class="form-radio text-metallic-gold bg-transparent border-white/40 focus:ring-0" name="status" type="radio" value="Hadir" checked id="status-hadir"/>
                                    <span class="group-hover:text-soft-gold transition-colors">Hadir</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer group text-xs text-white">
                                    <input class="form-radio text-metallic-gold bg-transparent border-white/40 focus:ring-0" name="status" type="radio" value="Tidak Hadir" id="status-absen"/>
                                    <span class="group-hover:text-soft-gold transition-colors">Maaf, Berhalangan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-caps text-soft-gold text-[10px] uppercase mb-1">Ucapan &amp; Doa Restu</label>
                            <textarea class="w-full bg-transparent border border-white/30 rounded-xl text-white focus:border-soft-gold focus:ring-0 p-3 placeholder:text-white/30 text-xs h-24 resize-none" id="rsvp-pesan" placeholder="Tulis ucapan dan doa restu Anda..." required></textarea>
                        </div>
                        <button class="w-full py-3 bg-white text-deep-maroon font-bold text-xs hover:bg-metallic-gold hover:text-white transition-all duration-300 rounded-full font-label-caps shadow-lg" type="submit">
                            SUBMIT RSVP
                        </button>
                    </form>

                    <!-- wishes output -->
                    <div class="mt-8 max-h-[200px] overflow-y-auto space-y-3.5 pr-1.5 scrollbar-thin text-left border-t border-white/10 pt-6 text-white" id="wishes-container">
                        @foreach($wishes as $w)
                        <div class="border-b border-white/10 pb-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-soft-gold text-xs">{{ $w['name'] }}</span>
                                <span class="text-[8px] bg-white/10 text-white px-2 py-0.5 rounded-full border border-white/20 font-semibold">{{ $w['status'] }}</span>
                            </div>
                            <p class="text-[11px] text-white/80 font-light italic">"{{ $w['message'] }}"</p>
                        </div>
                        @endforeach
                        <div id="wishListDirect"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- GIFT SECTION -->
        <section class="py-24 px-4 bg-white text-center" id="gift">
            <div class="max-w-sm mx-auto">
                <span class="material-symbols-outlined text-5xl text-metallic-gold mb-4 animate-float">card_giftcard</span>
                <h2 class="font-display-grand text-3xl text-deep-maroon mb-2">Wedding Gift</h2>
                <p class="text-on-surface-variant text-xs mb-8 px-4 leading-relaxed font-light">Doa restu Anda adalah kado terindah, namun jika Anda ingin memberikan tanda kasih, silakan melalui rekening berikut:</p>
                
                <div class="space-y-4">
                    @foreach($gifts as $gift)
                    <div class="bg-surface-container-low p-5 rounded-2xl border border-soft-gold flex flex-col items-center gap-3 text-left">
                        <div class="text-center w-full">
                            <p class="font-bold text-deep-maroon text-xs uppercase tracking-widest">{{ strtoupper($gift['bank']) }}</p>
                            <p class="text-xl font-display-names text-deep-maroon my-1 tracking-widest font-semibold">{{ $gift['account'] }}</p>
                            <p class="text-[9px] uppercase tracking-widest text-on-surface-variant font-medium">A/N {{ $gift['name'] }}</p>
                        </div>
                        <button class="w-full py-2 bg-deep-maroon text-white rounded-full font-bold text-[10px] hover:scale-105 transition-all flex items-center justify-center gap-1.5 font-label-caps" onclick="copyRek('{{ $gift['account'] }}', this)">
                            <span class="material-symbols-outlined text-sm">content_copy</span> SALIN NO. REK
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-24 bg-surface text-center relative overflow-hidden px-4">
            <div class="container mx-auto flex flex-col items-center">
                <div class="w-16 h-px bg-metallic-gold/30 mx-auto mb-10"></div>
                <div class="font-display-grand text-3xl text-deep-maroon mb-4 tracking-wider uppercase">
                    {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
                </div>
                <p class="font-label-caps text-metallic-gold uppercase tracking-[0.4em] text-[10px]">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
                </p>
                <div class="w-16 h-[1px] bg-metallic-gold/20 my-6"></div>
                <p class="font-body-main text-[10px] text-on-surface-variant font-light">Created with <span class="text-deep-maroon">♥</span> TemuRuang</p>
            </div>
        </footer>

        <!-- BOTTOM NAV BAR -->
        <nav class="bottom-nav-bar" id="mobileNav" style="display:none;">
            <div class="flex justify-around items-center py-2.5 px-3 bg-surface/85 backdrop-blur-xl border border-metallic-gold/30 rounded-full shadow-[0_4px_20px_rgba(0,0,0,0.15)]">
                <a class="flex flex-col items-center justify-center bg-deep-maroon text-white rounded-full p-2.5 shadow-md transition-all font-semibold" href="#home" onclick="smoothScroll(event, '#home', this)">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">home</span>
                </a>
                <a class="flex flex-col items-center justify-center text-deep-maroon p-2.5 opacity-70 hover:opacity-100 transition-all" href="#mempelai" onclick="smoothScroll(event, '#mempelai', this)">
                    <span class="material-symbols-outlined text-[18px]">favorite</span>
                </a>
                <a class="flex flex-col items-center justify-center text-deep-maroon p-2.5 opacity-70 hover:opacity-100 transition-all" href="#events" onclick="smoothScroll(event, '#events', this)">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                </a>
                <a class="flex flex-col items-center justify-center text-deep-maroon p-2.5 opacity-70 hover:opacity-100 transition-all" href="#photo_library" onclick="smoothScroll(event, '#photo_library', this)">
                    <span class="material-symbols-outlined text-[18px]">photo_library</span>
                </a>
                <a class="flex flex-col items-center justify-center text-deep-maroon p-2.5 opacity-70 hover:opacity-100 transition-all" href="#rsvp" onclick="smoothScroll(event, '#rsvp', this)">
                    <span class="material-symbols-outlined text-[18px]">rsvp</span>
                </a>
            </div>
        </nav>
    </main>

    <!-- Floating Action Controls -->
    <div class="floater-container" id="floaterContainer">
        <div class="floater-inner">
            <div class="float-btn" id="scrollControl" onclick="toggleAutoscroll()" title="Auto Scroll">
                <span class="material-symbols-outlined">keyboard_double_arrow_down</span>
            </div>
            <div class="float-btn" id="musicControl" onclick="toggleMusic()" title="Music">
                <span class="material-symbols-outlined">music_note</span>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal for Photo Preview -->
    <div id="lightbox" class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-gold-leaf text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-lg border-2 border-gold-leaf/40 shadow-2xl" src="" alt="Enlarged photo"/>
    </div>

    <!-- Floating Sparkle Elements (Global) -->
    <div class="fixed inset-0 pointer-events-none z-40 overflow-hidden">
        <div class="absolute top-1/4 left-10 w-2 h-2 bg-metallic-gold rounded-full blur-[1px] animate-pulse"></div>
        <div class="absolute top-1/2 right-20 w-3 h-3 bg-metallic-gold rounded-full blur-[2px] animate-pulse delay-700"></div>
        <div class="absolute bottom-1/4 left-1/3 w-2 h-2 bg-metallic-gold rounded-full blur-[1px] animate-pulse delay-1000"></div>
    </div>

    <!-- Scripts -->
    <script>
        let isAutoscrolling = false;
        const autoscrollSpeed = 0.6;

        function unlockInvitation() {
            const cover = document.getElementById('wedding-cover');
            const main = document.getElementById('main-content');
            
            cover.classList.add('transition-all', 'duration-1000', 'opacity-0', '-translate-y-full');
            
            // Play audio
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio play blocked."));
            
            setTimeout(() => {
                cover.style.display = 'none';
                main.style.display = 'block';
                document.body.classList.remove('cover-active');
                document.getElementById('floaterContainer').classList.add('visible');
                document.getElementById('mobileNav').style.display = 'block';
                startAutoscroll();
            }, 1000);
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
            if (current >= (document.documentElement.scrollHeight - 5)) { stopAutoscroll(); return; }
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
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                const oldContent = btn.innerHTML;
                btn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span> BERHASIL DISALIN';
                alert('Nomor rekening berhasil disalin!');
                setTimeout(() => {
                    btn.innerHTML = oldContent;
                }, 2000);
            });
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-nama').value;
            const guests = document.getElementById('rsvp-guests').value;
            const statusRadio = document.querySelector('input[name="status"]:checked');
            const status = statusRadio ? statusRadio.value : 'Hadir';
            const msg = document.getElementById('rsvp-pesan').value;

            const card = document.createElement('div');
            card.className = 'border-b border-white/10 pb-3 text-left';
            card.innerHTML = `<div class="flex justify-between items-center mb-1"><span class="font-bold text-soft-gold text-xs">${name}</span><span class="text-[8px] bg-white/10 text-white px-2 py-0.5 rounded-full border border-white/20 font-semibold">${status}</span></div><p class="text-[11px] text-white/80 font-light italic">"${msg}"</p>`;
            
            document.getElementById('wishListDirect').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert('RSVP berhasil dikirim!');
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
            
            document.querySelectorAll('.bottom-nav-bar a').forEach(a => {
                a.classList.remove('bg-deep-maroon', 'text-white', 'shadow-md');
                a.classList.add('text-deep-maroon');
            });
            el.classList.remove('text-deep-maroon');
            el.classList.add('bg-deep-maroon', 'text-white', 'shadow-md');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            initCountdown();
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });

            // Scroll Reveal Observer
            const revealElements = document.querySelectorAll('.scroll-reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-active');
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -50px 0px'
            });
            revealElements.forEach(el => observer.observe(el));

            // Navigation highlight on scroll
            window.addEventListener('scroll', () => {
                let current = "";
                const sections = document.querySelectorAll("section");
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 250) {
                        current = section.getAttribute("id");
                    }
                });

                document.querySelectorAll('.bottom-nav-bar a').forEach((a) => {
                    a.classList.remove('bg-deep-maroon', 'text-white', 'shadow-md');
                    a.classList.add('text-deep-maroon');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-deep-maroon');
                        a.classList.add('bg-deep-maroon', 'text-white', 'shadow-md');
                    }
                });
            });
        });
    </script>
</body>
</html>