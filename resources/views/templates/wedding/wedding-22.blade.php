@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Arkan');
        $brideName = trim($names[1] ?? 'Nabila');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Herman & Ibu Siti',
                'bride' => 'Bpk. Joko & Ibu Wati',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-12-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '10:00',
            'location' => $invitation->location ?? 'Grand Ballroom, Hotel Harmoni',
            'address' => $invitation->address ?? 'Jl. Kebangsaan No. 45, Bandung',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Grand Ballroom, Hotel Harmoni'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '10:00') . ' - 11:30',
                'note' => $invitation->location ?? 'Grand Ballroom, Hotel Harmoni, Ruang Tulip'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '12:00 - 15:00',
                'note' => $invitation->address ?? 'Grand Ballroom Utama'
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
                asset('assets/templates/wedding-22/images/image_5.jpg'),
                asset('assets/templates/wedding-22/images/image_6.jpg'),
                asset('assets/templates/wedding-22/images/image_7.jpg'),
                asset('assets/templates/wedding-22/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-22/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-22/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-22/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-22/images/image_4.jpg'),
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
                ['name' => 'Rian & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru! Semoga lancar dan berkah selalu.'],
                ['name' => 'Siti', 'status' => 'Berhalangan', 'message' => 'Maaf berhalangan hadir. Selamat berbahagia ya, doa terbaik untuk kalian!'],
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
                ['bank' => 'BCA', 'name' => $couple['groom'], 'account' => '123-456-7890'],
            ];
        }
    } else {
        $couple = [
            'groom' => 'Arkan',
            'bride' => 'Nabila',
            'parents' => [
                'groom' => 'Bpk. Herman & Ibu Siti',
                'bride' => 'Bpk. Joko & Ibu Wati',
            ],
        ];

        $event = [
            'date_iso' => '2026-12-12',
            'time' => '10:00',
            'location' => 'Grand Ballroom, Hotel Harmoni',
            'address' => 'Jl. Kebangsaan No. 45, Bandung',
            'maps_url' => 'https://maps.google.com/?q=Bandung',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '10:00 - 11:30', 'note' => 'Ruang Tulip'],
            ['title' => 'Resepsi Pernikahan', 'time' => '12:00 - 15:00', 'note' => 'Ballroom Utama'],
        ];

        $stories = [
            ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di bangku perkuliahan, kami menyadari banyak hal menarik yang membuat kami dekat.'],
            ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
            ['title' => 'Menuju Pernikahan', 'date' => 'Desember 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-22/images/image_5.jpg'),
            asset('assets/templates/wedding-22/images/image_6.jpg'),
            asset('assets/templates/wedding-22/images/image_7.jpg'),
            asset('assets/templates/wedding-22/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-22/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-22/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-22/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-22/images/image_4.jpg'),
        ];

        $wishes = [
            ['name' => 'Rian & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru! Semoga lancar dan berkah selalu.'],
            ['name' => 'Siti', 'status' => 'Berhalangan', 'message' => 'Maaf berhalangan hadir. Selamat berbahagia ya, doa terbaik untuk kalian!'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Arkan', 'account' => '123-456-7890'],
        ];
    }
@endphp
<!DOCTYPE html>
<html class="dark scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Undangan Pernikahan | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&amp;family=Playfair+Display:ital,wght@0,700;0,900;1,700&amp;family=Montserrat:wght@700&amp;family=Great+Vibes&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "outline-variant": "#404941",
                        "surface-dim": "#001809",
                        "on-tertiary-fixed-variant": "#005306",
                        "surface": "#001809",
                        "on-surface": "#c4eccd",
                        "on-secondary": "#3c2f00",
                        "secondary": "#e9c349",
                        "royal-gold": "#C5A021",
                        "surface-container-high": "#0c301c",
                        "inverse-primary": "#2a6a3f",
                        "secondary-fixed-dim": "#e9c349",
                        "primary": "#93d6a0",
                        "glitter-white": "#F9F9F9",
                        "surface-container-highest": "#193b26",
                        "primary-fixed-dim": "#93d6a0",
                        "inverse-on-surface": "#143722",
                        "surface-tint": "#93d6a0",
                        "surface-variant": "#193b26",
                        "primary-fixed": "#aef2bb",
                        "forest-shadow": "#012616",
                        "on-error-container": "#ffdad6",
                        "surface-container-low": "#00210f",
                        "inverse-surface": "#c4eccd",
                        "lime-accent": "#BFFF00",
                        "error-container": "#93000a",
                        "error": "#ffb4ab",
                        "on-secondary-fixed-variant": "#574500",
                        "on-background": "#c4eccd",
                        "on-primary": "#003919",
                        "surface-container-lowest": "#001206",
                        "secondary-container": "#af8d11",
                        "tertiary-container": "#004c05",
                        "surface-container": "#012612",
                        "on-error": "#690005",
                        "emerald-deep": "#043927",
                        "on-tertiary-fixed": "#002201",
                        "on-primary-fixed-variant": "#0b5229",
                        "tertiary-fixed": "#75ff68",
                        "on-tertiary": "#003a03",
                        "on-secondary-container": "#342800",
                        "tertiary-fixed-dim": "#4ce346",
                        "outline": "#8a9389",
                        "on-primary-fixed": "#00210c",
                        "on-secondary-fixed": "#241a00",
                        "background": "#001809",
                        "secondary-fixed": "#ffe088",
                        "primary-container": "#004b23",
                        "on-surface-variant": "#c0c9be",
                        "on-tertiary-container": "#29c72c",
                        "tertiary": "#4ce346",
                        "surface-bright": "#1d402b",
                        "on-primary-container": "#79bb87"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "glass-offset": "12px",
                        "element-gap": "1.5rem",
                        "container-padding": "2rem",
                        "section-gap": "5rem",
                        "mobile-margin": "1rem"
                    },
                    fontFamily: {
                        "body-md": ["Outfit"],
                        "headline-lg": ["Playfair Display"],
                        "display-hero": ["Playfair Display"],
                        "body-lg": ["Outfit"],
                        "headline-md": ["Playfair Display"],
                        "label-gold": ["Montserrat"],
                        "display-hero-mobile": ["Playfair Display"],
                        "script": ["'Great Vibes'", "cursive"]
                    },
                    fontSize: {
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "fontWeight": "700" }],
                        "display-hero": ["64px", { "lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "900" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "700" }],
                        "label-gold": ["12px", { "lineHeight": "16px", "letterSpacing": "0.15em", "fontWeight": "700" }],
                        "display-hero-mobile": ["42px", { "lineHeight": "48px", "fontWeight": "900" }]
                    },
                    animation: {
                        'pulse-glow': 'pulseGlow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'twinkle': 'twinkle 3s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        pulseGlow: {
                            '0%, 100%': { opacity: 1, transform: 'scale(1)', boxShadow: '0 0 20px rgba(197,160,33,0.3)' },
                            '50%': { opacity: .8, transform: 'scale(1.05)', boxShadow: '0 0 40px rgba(197,160,33,0.6)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        twinkle: {
                            '0%': { opacity: 0.3 },
                            '100%': { opacity: 1 },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(0, 36, 17, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid #C5A021;
            box-shadow: 0 8px 32px 0 rgba(1, 38, 22, 0.8);
        }

        .glass-card {
            background: rgba(0, 36, 17, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid #C5A021;
            box-shadow: 0 8px 32px 0 rgba(4, 57, 39, 0.4);
        }
        
        .gold-text-gradient {
            background: linear-gradient(to right, #e9c349, #C5A021, #ffe088, #C5A021);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gold-gradient-bg {
            background: linear-gradient(135deg, #C5A021 0%, #e9c349 50%, #af8d11 100%);
        }

        .lime-gold-btn {
            background: linear-gradient(135deg, #BFFF00 0%, #C5A021 100%);
            color: #001809;
        }

        .ornament-bg {
            background-image: 
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath d='M50 0 L100 50 L50 100 L0 50 Z' fill='none' stroke='%23C5A021' stroke-width='0.5' opacity='0.25'/%3E%3Cpath d='M50 20 C40 30, 40 40, 50 50 C60 40, 60 30, 50 20 Z' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.2'/%3E%3Cpath d='M20 50 C30 40, 40 40, 50 50 C40 60, 30 60, 20 50 Z' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.2'/%3E%3Cpath d='M50 50 C40 60, 40 70, 50 80 C60 70, 60 60, 50 50 Z' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.2'/%3E%3Cpath d='M50 50 C60 40, 70 40, 80 50 C70 60, 60 60, 50 50 Z' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.2'/%3E%3Cpath d='M0 0 Q20 0 20 20' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.22'/%3E%3Cpath d='M100 0 Q80 0 80 20' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.22'/%3E%3Cpath d='M0 100 Q20 100 20 80' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.22'/%3E%3Cpath d='M100 100 Q80 100 80 80' fill='none' stroke='%23C5A021' stroke-width='0.4' opacity='0.22'/%3E%3C/svg%3E"),
                radial-gradient(rgba(197, 160, 33, 0.15) 1px, transparent 1px);
            background-size: 80px 80px, 20px 20px;
        }

        .silk-texture {
            background: radial-gradient(circle at center, #073a21 0%, #001206 100%);
        }

        .particle {
            position: absolute;
            background: #e9c349;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.6;
        }

        .sparkle {
            animation: sparkle 3s infinite alternate;
        }
        @keyframes sparkle {
            0% { opacity: 0.3; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1.2); }
        }

        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }

        /* Cover & Main content locking */
        #main-content { display: none; }
        body.cover-active { overflow: hidden; }

        /* Floating action controls */
        .floater-container {
            position: fixed;
            bottom: 80px;
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
            right: 16px;
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
            background: rgba(0, 36, 17, 0.85);
            backdrop-filter: blur(10px);
            border: 2px solid #C5A021;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #C5A021;
            box-shadow: 0 4px 15px rgba(0, 24, 9, 0.6);
            transition: all 0.3s;
        }
        .float-btn:hover { background: #C5A021; color: #001809; }
        .float-btn.playing .material-symbols-outlined { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .float-btn.scrolling { background: #C5A021; color: #001809; }

        /* Bottom nav - constrained */
        .bottom-nav-bar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            z-index: 50;
        }

        /* Lightbox constrained positioning */
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
<body class="bg-surface-dim text-on-surface font-body-md relative min-h-screen overflow-x-hidden selection:bg-royal-gold selection:text-surface cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-royal-gold/10">

    <!-- Background Layers -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 silk-texture z-[-2] pointer-events-none"></div>
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 ornament-bg z-[-1] pointer-events-none mix-blend-screen opacity-60"></div>

    <!-- Floating Sparkles (CSS generated) -->
    <div class="fixed top-[10%] left-[20%] w-2 h-2 rounded-full bg-royal-gold sparkle z-[-1]" style="animation-delay: 0s;"></div>
    <div class="fixed top-[30%] right-[15%] w-3 h-3 rounded-full bg-lime-accent sparkle z-[-1]" style="animation-delay: 0.5s;"></div>
    <div class="fixed top-[60%] left-[10%] w-1.5 h-1.5 rounded-full bg-royal-gold sparkle z-[-1]" style="animation-delay: 1s;"></div>
    <div class="fixed top-[80%] right-[25%] w-2.5 h-2.5 rounded-full bg-secondary sparkle z-[-1]" style="animation-delay: 1.5s;"></div>

    <!-- Background Particles Container -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none" id="particles-js"></div>

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- ==================== COVER SECTION ==================== -->
    <div id="cover-section" class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] flex flex-col justify-between items-center px-8 py-16 text-center">
        <!-- Cover Background image overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-emerald-deep opacity-80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-surface-dim/80 via-transparent to-surface-dim/80 z-10"></div>
            <img alt="Luxurious wedding setting" class="w-full h-full object-cover opacity-40" src="{{ $bg['cover'] }}"/>
        </div>
        
        <div class="relative z-10 space-y-4 w-full mt-6">
            <span class="font-label-gold text-label-gold text-lime-accent bg-emerald-deep/80 px-4 py-1 rounded-full border border-royal-gold/50 backdrop-blur-sm uppercase tracking-widest">The Wedding Invitation of</span>
            <h1 class="font-script text-5xl text-secondary-fixed drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
        </div>

        <div class="relative z-10 glass-panel rounded-xl p-6 w-full max-w-xs relative overflow-hidden group">
            <p class="font-label-gold text-label-gold text-secondary uppercase tracking-widest mb-2">Dear Honorable Guest</p>
            <p class="font-headline-md text-glitter-white text-xl">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
            <p class="text-[10px] text-on-surface-variant mt-2 opacity-80 leading-relaxed">Kami memohon kehadiran Anda di hari bahagia kami</p>
        </div>

        <div class="relative z-10">
            <button aria-label="Buka Undangan" class="group relative inline-flex items-center justify-center w-36 h-36 rounded-full glass-panel border-4 border-royal-gold overflow-hidden animate-pulse-glow" onclick="openInvitation()">
                <div class="absolute inset-0 bg-royal-gold/20 group-hover:bg-royal-gold/40 transition-colors duration-300"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <span class="material-symbols-outlined text-4xl text-lime-accent mb-2 group-hover:scale-110 transition-transform duration-300">file_open</span>
                    <span class="font-label-gold text-label-gold text-glitter-white text-xs whitespace-nowrap">Buka Undangan</span>
                </div>
                <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shimmer_1.5s_infinite]"></div>
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="relative z-10 pb-[120px]" id="main-content">
        <!-- ===== HERO SECTION ===== -->
        <section class="relative min-h-screen flex flex-col justify-center items-center px-4 pt-24 pb-16" id="home">
            <!-- Pre-wedding Photo Background -->
            <div class="absolute inset-0 z-0 overflow-hidden border-b-2 border-royal-gold shadow-[0_10px_40px_rgba(4,57,39,0.5)]">
                <div class="absolute inset-0 bg-gradient-to-t from-surface-dim via-surface-dim/40 to-transparent z-10"></div>
                <img alt="Pre-wedding photo" class="w-full h-full object-cover object-center scale-105" src="{{ $bg['hero'] ?? $bg['cover'] }}"/>
            </div>
            <!-- Hero Content -->
            <div class="relative z-20 flex flex-col items-center text-center mt-auto mb-12">
                <span class="font-label-gold text-label-gold text-lime-accent mb-4 bg-emerald-deep/80 px-4 py-1 rounded-full border border-royal-gold/50 backdrop-blur-sm uppercase tracking-widest">
                    The Wedding Of
                </span>
                <h2 class="font-display-hero-mobile text-glitter-white mb-2 text-glow drop-shadow-[0_4px_4px_rgba(0,0,0,0.5)] px-4">
                    {{ $couple['groom'] }} <span class="text-royal-gold font-light italic">&amp;</span> {{ $couple['bride'] }}
                </h2>
                <!-- Countdown Timer -->
                <div class="flex gap-2.5 mt-8" id="countdown-timer">
                    <div class="glass-card flex flex-col items-center justify-center w-16 h-16 rounded-xl group">
                        <span class="font-headline-lg text-royal-gold text-2xl" id="cd-days">00</span>
                        <span class="font-label-gold text-[8px] text-on-surface-variant mt-0.5">DAYS</span>
                    </div>
                    <div class="glass-card flex flex-col items-center justify-center w-16 h-16 rounded-xl group">
                        <span class="font-headline-lg text-royal-gold text-2xl" id="cd-hours">00</span>
                        <span class="font-label-gold text-[8px] text-on-surface-variant mt-0.5">HOURS</span>
                    </div>
                    <div class="glass-card flex flex-col items-center justify-center w-16 h-16 rounded-xl group">
                        <span class="font-headline-lg text-royal-gold text-2xl" id="cd-minutes">00</span>
                        <span class="font-label-gold text-[8px] text-on-surface-variant mt-0.5">MINS</span>
                    </div>
                    <div class="glass-card flex flex-col items-center justify-center w-16 h-16 rounded-xl group">
                        <span class="font-headline-lg text-royal-gold text-2xl" id="cd-seconds">00</span>
                        <span class="font-label-gold text-[8px] text-on-surface-variant mt-0.5">SECS</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== PROFILE SECTION ===== -->
        <section class="py-16 px-4 relative z-10 max-w-md mx-auto text-center" id="profile">
            <!-- Section Header -->
            <div class="text-center mb-12 relative">
                <h2 class="font-headline-lg text-royal-gold text-glow mb-4">The Bride &amp; Groom</h2>
                <div class="flex items-center justify-center gap-3 mt-4">
                    <div class="w-16 h-[1px] bg-gradient-to-r from-transparent to-royal-gold"></div>
                    <span class="material-symbols-outlined text-royal-gold text-lg">spa</span>
                    <div class="w-16 h-[1px] bg-gradient-to-l from-transparent to-royal-gold"></div>
                </div>
            </div>
            
            <div class="flex flex-col gap-12 items-center">
                <!-- Groom -->
                <div class="flex flex-col items-center text-center relative group w-full">
                    <div class="relative w-56 h-72 rounded-full border-4 border-royal-gold p-2 shadow-[0_0_30px_rgba(197,160,33,0.3)] bg-surface-container-high transition-transform duration-500 z-10">
                       <div class="w-full h-full rounded-full overflow-hidden border-2 border-outline-variant relative">
                           <img alt="Groom Portrait" class="w-full h-full object-cover grayscale opacity-80" src="{{ $bg['groom'] }}"/>
                           <div class="absolute inset-0 border-4 border-dashed border-royal-gold/30 rounded-full scale-[0.95] z-20 pointer-events-none rotate-[-15deg]"></div>
                       </div>
                    </div>
                    <div class="glass-card mt-[-60px] pt-16 pb-6 px-6 rounded-2xl w-full z-20 relative flex flex-col items-center">
                        <h3 class="font-headline-md text-glitter-white mb-1">{{ $couple['groom'] }}</h3>
                        <p class="font-label-gold text-royal-gold mb-4">THE GROOM</p>
                        <p class="font-body-md text-on-surface-variant text-xs mb-4">Son of {{ $couple['parents']['groom'] }}</p>
                    </div>
                </div>
                
                <!-- Bride -->
                <div class="flex flex-col items-center text-center relative group w-full">
                    <div class="relative w-56 h-72 rounded-full border-4 border-royal-gold p-2 shadow-[0_0_30px_rgba(197,160,33,0.3)] bg-surface-container-high transition-transform duration-500 z-10">
                       <div class="w-full h-full rounded-full overflow-hidden border-2 border-outline-variant relative">
                           <img alt="Bride Portrait" class="w-full h-full object-cover grayscale opacity-80" src="{{ $bg['bride'] }}"/>
                           <div class="absolute inset-0 border-4 border-dashed border-royal-gold/30 rounded-full scale-[0.95] z-20 pointer-events-none rotate-[15deg]"></div>
                       </div>
                    </div>
                    <div class="glass-card mt-[-60px] pt-16 pb-6 px-6 rounded-2xl w-full z-20 relative flex flex-col items-center">
                        <h3 class="font-headline-md text-glitter-white mb-1">{{ $couple['bride'] }}</h3>
                        <p class="font-label-gold text-royal-gold mb-4">THE BRIDE</p>
                        <p class="font-body-md text-on-surface-variant text-xs mb-4">Daughter of {{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== EVENTS SECTION ===== -->
        <section class="py-16 px-4 relative z-10" id="events">
            <div class="text-center mb-12 relative z-10">
                <h2 class="font-headline-lg text-royal-gold mb-4">Save the Date</h2>
                <div class="flex items-center justify-center gap-3 mt-4">
                    <div class="w-16 h-[1px] bg-gradient-to-r from-transparent to-royal-gold"></div>
                    <span class="material-symbols-outlined text-royal-gold text-lg">spa</span>
                    <div class="w-16 h-[1px] bg-gradient-to-l from-transparent to-royal-gold"></div>
                </div>
            </div>
            <div class="flex flex-col gap-6 max-w-md mx-auto">
                @foreach($schedule as $i => $sch)
                <div class="glass-panel bg-emerald-deep/40 gold-border rounded-xl p-6 relative shadow-[0_10px_30px_rgba(4,57,39,0.8)] overflow-hidden">
                    <div class="relative z-10 text-center flex flex-col items-center gap-3">
                        <span class="font-label-gold text-lime-accent bg-surface-container/80 px-4 py-0.5 rounded-full border border-lime-accent/30 text-[10px]">{{ $i === 0 ? 'THE CEREMONY' : 'THE CELEBRATION' }}</span>
                        <h3 class="font-headline-md text-royal-gold text-lg mt-2">{{ $sch['title'] }}</h3>
                        <p class="font-body-lg text-glitter-white text-base mt-2">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                        <p class="font-headline-lg text-lime-accent text-xl mt-1">Pukul {{ $sch['time'] }}</p>
                        <div class="flex items-center justify-center gap-2 w-full my-3 opacity-60">
                            <div class="flex-1 h-[0.5px] bg-gradient-to-r from-transparent to-royal-gold"></div>
                            <span class="material-symbols-outlined text-royal-gold text-xs">favorite</span>
                            <div class="flex-1 h-[0.5px] bg-gradient-to-l from-transparent to-royal-gold"></div>
                        </div>
                        <p class="font-body-md text-on-surface-variant text-sm">{{ $sch['note'] }}</p>
                    </div>
                </div>
                @endforeach

                <div class="glass-panel bg-emerald-deep/40 gold-border rounded-xl p-6 relative shadow-[0_10px_30px_rgba(4,57,39,0.8)] text-center flex flex-col items-center">
                    <p class="font-weight-600 font-body-lg text-glitter-white text-base mb-2">{{ $event['location'] }}</p>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4">{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 border-2 border-royal-gold text-royal-gold rounded-full font-label-gold py-2.5 px-6 hover:bg-royal-gold/10 transition-colors text-xs w-full">
                        <span class="material-symbols-outlined text-sm">map</span> PETUNJUK LOKASI
                    </a>
                </div>
            </div>
        </section>

        <!-- ===== STORY SECTION ===== -->
        <section class="py-16 px-4 relative z-10" id="story">
            <div class="text-center mb-12">
                <span class="font-label-gold text-lime-accent text-[10px] bg-emerald-deep/80 px-4 py-1 rounded-full border border-royal-gold/50 backdrop-blur-sm uppercase tracking-widest mb-3 inline-block font-semibold">Our Memoir</span>
                <h2 class="font-headline-lg text-royal-gold">Our Love Journey</h2>
                <div class="flex items-center justify-center gap-3 mt-4">
                    <div class="w-16 h-[1px] bg-gradient-to-r from-transparent to-royal-gold"></div>
                    <span class="material-symbols-outlined text-royal-gold text-lg">spa</span>
                    <div class="w-16 h-[1px] bg-gradient-to-l from-transparent to-royal-gold"></div>
                </div>
            </div>
            <div class="max-w-md mx-auto w-full relative pl-8 border-l-2 border-dashed border-royal-gold/30 py-2">
                @foreach($stories as $s)
                <div class="relative mb-12 last:mb-0">
                    <!-- Timeline Node Icon -->
                    <div class="absolute -left-[48px] top-6 w-8 h-8 rounded-full border-2 border-royal-gold bg-emerald-deep flex items-center justify-center text-lime-accent shadow-lg z-10">
                        <span class="material-symbols-outlined text-[14px]">
                            @if($loop->index == 0)
                            favorite
                            @elseif($loop->index == 1)
                            diamond
                            @else
                            celebration
                            @endif
                        </span>
                    </div>
                    
                    <!-- Journey Card -->
                    <div class="glass-panel p-6 rounded-2xl bg-emerald-deep/50 relative border-2 border-royal-gold/40 shadow-xl overflow-hidden group hover:scale-[1.02] transition-transform duration-300">
                        <!-- Card inner corner dashed borders -->
                        <div class="absolute inset-2 border border-dashed border-royal-gold/20 rounded-xl pointer-events-none"></div>
                        
                        <!-- Floating leaf ornament decoration -->
                        <div class="absolute top-2 right-4 opacity-10 group-hover:opacity-30 transition-opacity duration-300">
                            <span class="material-symbols-outlined text-4xl text-royal-gold">spa</span>
                        </div>

                        <!-- Date Badge -->
                        <span class="inline-block font-label-gold text-[9px] text-lime-accent bg-surface-container/60 border border-lime-accent/30 px-3.5 py-1 rounded-full uppercase tracking-widest mb-3 font-semibold relative z-10 shadow-sm">
                            {{ $s['date'] }}
                        </span>
                        
                        <h4 class="font-headline-md text-base text-secondary-fixed mb-2 font-bold relative z-10 flex items-center gap-2">
                            <span>{{ $s['title'] }}</span>
                            <span class="w-2 h-2 rounded-full bg-royal-gold animate-pulse"></span>
                        </h4>
                        
                        <div class="w-12 h-[1px] bg-royal-gold/30 my-2 relative z-10"></div>
                        
                        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed relative z-10">{{ $s['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ===== GALLERY SECTION ===== -->
        <section class="py-16 px-4 relative z-10" id="gallery">
            <div class="text-center mb-12">
                <h2 class="font-headline-lg text-royal-gold mb-4">Royal Moments</h2>
                <div class="flex items-center justify-center gap-3 mt-4">
                    <div class="w-16 h-[1px] bg-gradient-to-r from-transparent to-royal-gold"></div>
                    <span class="material-symbols-outlined text-royal-gold text-lg">spa</span>
                    <div class="w-16 h-[1px] bg-gradient-to-l from-transparent to-royal-gold"></div>
                </div>
            </div>
            <!-- Asymmetric grid -->
            <div class="grid grid-cols-2 gap-3 max-w-md mx-auto relative">
                @if(isset($gallery[0]))
                <div class="col-span-2 relative aspect-[4/3] rounded-lg overflow-hidden border-2 border-royal-gold group cursor-zoom-in" onclick="openLightbox('{{ $gallery[0] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $gallery[0] }}" alt="Gallery 1"/>
                </div>
                @endif
                @if(isset($gallery[1]))
                <div class="col-span-1 relative aspect-square rounded-lg overflow-hidden border-2 border-royal-gold group cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $gallery[1] }}" alt="Gallery 2"/>
                </div>
                @endif
                @if(isset($gallery[2]))
                <div class="col-span-1 relative aspect-square rounded-lg overflow-hidden border-2 border-royal-gold group cursor-zoom-in" onclick="openLightbox('{{ $gallery[2] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $gallery[2] }}" alt="Gallery 3"/>
                </div>
                @endif
                @if(isset($gallery[3]))
                <div class="col-span-2 relative aspect-[16/9] rounded-lg overflow-hidden border-2 border-royal-gold group cursor-zoom-in" onclick="openLightbox('{{ $gallery[3] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $gallery[3] }}" alt="Gallery 4"/>
                </div>
                @endif
            </div>
        </section>

        <!-- ===== RSVP SECTION ===== -->
        <section class="py-16 px-4 relative z-10" id="rsvp">
            <div class="glass-panel rounded-3xl p-6 max-w-md mx-auto">
                <div class="text-center mb-8">
                    <h2 class="font-headline-lg text-royal-gold mb-2">RSVP</h2>
                    <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">Kehadiran dan doa restu Anda merupakan karunia terindah bagi kami.</p>
                </div>
                <form class="space-y-6" id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div>
                        <label class="font-label-gold text-royal-gold block uppercase text-[10px] mb-2" for="fullName">Nama Lengkap</label>
                        <input class="w-full bg-surface-container-lowest border-0 border-b-2 border-royal-gold focus:border-lime-accent focus:ring-0 text-on-surface font-body-md text-xs p-2.5 placeholder-on-surface-variant/30" id="rsvp-nama" placeholder="Masukkan nama lengkap" type="text" required/>
                    </div>
                    <div>
                        <label class="font-label-gold text-royal-gold block uppercase text-[10px] mb-2">Konfirmasi Kehadiran</label>
                        <select class="w-full bg-surface-container-lowest border-0 border-b-2 border-royal-gold focus:border-lime-accent focus:ring-0 text-on-surface font-body-md text-xs p-2.5" id="rsvp-konfirmasi">
                            <option value="Hadir">Ya, Saya Akan Hadir</option>
                            <option value="Tidak Hadir">Maaf, Saya Tidak Bisa Hadir</option>
                        </select>
                   </div>
                   <div>
                       <label class="font-label-gold text-royal-gold block uppercase text-[10px] mb-2">Jumlah Tamu</label>
                       <select class="w-full bg-surface-container-lowest border-0 border-b-2 border-royal-gold focus:border-lime-accent focus:ring-0 text-on-surface font-body-md text-xs p-2.5" id="rsvp-guests">
                           <option value="1">1 Orang</option>
                           <option value="2">2 Orang</option>
                       </select>
                   </div>
                   <div>
                       <label class="font-label-gold text-royal-gold block uppercase text-[10px] mb-2" for="pesan">Ucapan &amp; Doa</label>
                       <textarea class="w-full bg-surface-container-lowest border border-royal-gold rounded-lg focus:border-lime-accent focus:ring-0 p-3 text-on-surface font-body-md text-xs placeholder-on-surface-variant/30 resize-none h-24" placeholder="Tulis ucapan selamat Anda" rows="3" id="rsvp-pesan" required></textarea>
                   </div>
                   <button class="lime-gold-btn py-3.5 rounded-full font-label-gold uppercase tracking-wider hover:scale-[1.02] transition-transform duration-300 w-full font-bold shadow-[0_0_15px_rgba(197,160,33,0.4)]" type="submit">
                       KIRIM RSVP
                   </button>
               </form>

               <!-- Wishes List -->
               <div class="mt-8 max-h-[200px] overflow-y-auto space-y-4 pr-1 scrollbar-thin" id="wishList">
                   @foreach($wishes as $w)
                   <div class="border-b border-royal-gold/20 pb-3 text-left">
                       <div class="flex justify-between mb-1">
                           <span class="font-body-md text-xs text-on-surface font-bold">{{ $w['name'] }}</span>
                           <span class="font-label-gold text-[9px] bg-royal-gold/15 text-royal-gold px-2 py-0.5 rounded">{{ $w['status'] }}</span>
                       </div>
                       <p class="font-body-md text-[11px] text-on-surface-variant italic font-light">"{{ $w['message'] }}"</p>
                   </div>
                   @endforeach
                   <div id="wishListDirect"></div>
               </div>
           </div>
       </section>

       <!-- ===== GIFT SECTION ===== -->
       <section class="py-16 px-4 relative z-10" id="gift">
           <div class="text-center mb-12 relative z-10">
               <span class="inline-block px-4 py-1 bg-lime-accent text-surface-dim font-label-gold rounded-full mb-4 uppercase tracking-widest font-bold">Blessings</span>
               <h2 class="font-headline-lg text-royal-gold">Wedding Gift</h2>
               <p class="font-body-md text-xs text-on-surface-variant max-w-xs mx-auto mt-4 leading-relaxed">Bagi keluarga dan sahabat yang ingin mengirimkan hadiah, dapat mengirimkan secara non-tunai melalui rekening berikut:</p>
           </div>
           
           <div class="flex flex-col gap-6 max-w-md mx-auto">
               @foreach($gifts as $gift)
               <div class="glass-panel rounded-2xl p-6 flex flex-col justify-between w-full bg-emerald-deep/40">
                   <div>
                       <h4 class="font-headline-md text-royal-gold mb-1 text-base">{{ strtoupper($gift['bank']) }}</h4>
                       <p class="font-body-md text-xs text-on-surface-variant mb-4">a.n. {{ $gift['name'] }}</p>
                       <div class="flex items-center gap-4 bg-surface-container-lowest p-3.5 rounded-xl border border-outline-variant">
                           <span class="font-headline-md text-base tracking-widest text-on-surface flex-1">{{ $gift['account'] }}</span>
                       </div>
                   </div>
                   <button class="mt-4 flex items-center justify-center gap-2 w-full py-2.5 border-2 border-royal-gold text-royal-gold rounded-full font-label-gold uppercase hover:bg-royal-gold/10 hover:text-lime-accent hover:border-lime-accent transition-all duration-300 text-[10px]" onclick="copyRek('{{ $gift['account'] }}', this)">
                       <span class="material-symbols-outlined text-sm">content_copy</span> SALIN REKENING
                   </button>
               </div>
               @endforeach
           </div>
       </section>

       <!-- ===== FOOTER ===== -->
       <footer class="w-full py-12 border-t border-royal-gold/30 bg-forest-shadow flex flex-col items-center gap-4 text-center px-4 relative z-10">
           <div class="mb-4 relative">
               <span class="absolute -top-4 -left-4 material-symbols-outlined text-2xl text-lime-accent opacity-50 rotate-12">auto_awesome</span>
               <span class="absolute -bottom-4 -right-4 material-symbols-outlined text-2xl text-royal-gold opacity-50 -rotate-12">auto_awesome</span>
               <h2 class="font-headline-lg text-royal-gold text-glow text-xl">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
               <p class="font-headline-md text-on-surface-variant text-sm italic mt-1">Together Forever</p>
           </div>
           <div class="w-24 h-[2px] bg-royal-gold opacity-50"></div>
           <p class="font-body-md text-[10px] text-on-surface-variant font-light">Created with <span class="text-royal-gold">♥</span> TemuRuang</p>
       </footer>
   </div>

    <!-- ===== BOTTOM NAV BAR ===== -->
    <nav class="bottom-nav-bar" id="mobileNav" style="display:none;">
        <div class="flex justify-around items-center px-4 py-2.5 mx-3 mb-3 rounded-full border-2 border-royal-gold bg-surface-container-highest/80 backdrop-blur-2xl shadow-[0_10px_30px_rgba(4,57,39,0.5)]">
            <a class="nav-link flex flex-col items-center justify-center text-lime-accent bg-royal-gold/10 rounded-full p-2.5" href="#home" onclick="smoothScroll(event, '#home', this)">
                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">home</span>
                <span class="font-label-gold text-[8px] mt-0.5">Home</span>
            </a>
            <a class="nav-link flex flex-col items-center justify-center text-glitter-white p-2.5 hover:text-lime-accent transition-colors" href="#profile" onclick="smoothScroll(event, '#profile', this)">
                <span class="material-symbols-outlined text-[20px]">favorite</span>
                <span class="font-label-gold text-[8px] mt-0.5">Mempelai</span>
            </a>
            <a class="nav-link flex flex-col items-center justify-center text-glitter-white p-2.5 hover:text-lime-accent transition-colors" href="#events" onclick="smoothScroll(event, '#events', this)">
                <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                <span class="font-label-gold text-[8px] mt-0.5">Acara</span>
            </a>
            <a class="nav-link flex flex-col items-center justify-center text-glitter-white p-2.5 hover:text-lime-accent transition-colors" href="#gallery" onclick="smoothScroll(event, '#gallery', this)">
                <span class="material-symbols-outlined text-[20px]">collections</span>
                <span class="font-label-gold text-[8px] mt-0.5">Galeri</span>
            </a>
            <a class="nav-link flex flex-col items-center justify-center text-glitter-white p-2.5 hover:text-lime-accent transition-colors" href="#rsvp" onclick="smoothScroll(event, '#rsvp', this)">
                <span class="material-symbols-outlined text-[20px]">mail</span>
                <span class="font-label-gold text-[8px] mt-0.5">RSVP</span>
            </a>
        </div>
    </nav>

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
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-gold-shimmer text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-royal-gold/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <script>
        let isAutoscrolling = false;

        function openInvitation() {
            const cover = document.getElementById('cover-section');
            const mainContent = document.getElementById('main-content');

            cover.style.transition = 'opacity 1s ease-in-out';
            cover.style.opacity = '0';

            setTimeout(() => {
                cover.style.display = 'none';
                mainContent.style.display = 'block';
                document.body.classList.remove('cover-active');

                // Show mobile nav
                const mobileNav = document.getElementById('mobileNav');
                if (mobileNav) mobileNav.style.display = '';

                // Show floating controls
                document.getElementById('floaterContainer').classList.add('visible');

                // Start music
                const audio = document.getElementById('bg-audio');
                audio.play().then(() => {
                    document.getElementById('musicControl').classList.add('playing');
                }).catch(() => {});

                // Start auto-scroll
                startAutoscroll();

                window.scrollTo({ top: document.getElementById('home').offsetTop, behavior: 'smooth' });
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
            window.scrollBy(0, 0.6);
            const current = window.innerHeight + window.pageYOffset;
            if (current >= (document.documentElement.scrollHeight - 5)) { stopAutoscroll(); return; }
            requestAnimationFrame(scrollStep);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            document.getElementById('scrollControl').classList.add('scrolling');
            document.getElementById('scrollControl').querySelector('.material-symbols-outlined').textContent = 'pause';
            requestAnimationFrame(scrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            document.getElementById('scrollControl').classList.remove('scrolling');
            document.getElementById('scrollControl').querySelector('.material-symbols-outlined').textContent = 'keyboard_double_arrow_down';
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        // Countdown Timer
        function initCountdown() {
            const target = new Date("{{ $event['date_iso'] ?? '2026-12-12' }}T{{ $event['time'] ?? '10:00' }}:00").getTime();
            setInterval(() => {
                const now = new Date().getTime();
                const diff = target - now;
                if (diff <= 0) return;
                document.getElementById('cd-days').innerText = String(Math.floor(diff / 86400000)).padStart(2, '0');
                document.getElementById('cd-hours').innerText = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                document.getElementById('cd-minutes').innerText = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                document.getElementById('cd-seconds').innerText = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
            }, 1000);
        }

        function copyRek(text, btn) {
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                const oldText = btn.innerHTML;
                btn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span> BERHASIL DISALIN';
                alert('Nomor rekening berhasil disalin!');
                setTimeout(() => {
                    btn.innerHTML = oldText;
                }, 2000);
            });
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-nama').value;
            const status = document.getElementById('rsvp-konfirmasi').value;
            const msg = document.getElementById('rsvp-pesan').value;
            const card = document.createElement('div');
            card.className = 'border-b border-royal-gold/20 pb-3 text-left';
            card.innerHTML = `<div class="flex justify-between mb-1"><span class="font-body-md text-xs text-on-surface font-bold">${name}</span><span class="font-label-gold text-[9px] bg-royal-gold/15 text-royal-gold px-2 py-0.5 rounded">${status}</span></div><p class="font-body-md text-[11px] text-on-surface-variant italic font-light">"${msg}"</p>`;
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
            
            // Highlight active tab
            document.querySelectorAll('.bottom-nav-bar a').forEach(a => {
                a.classList.remove('text-lime-accent', 'bg-royal-gold/10');
                a.classList.add('text-glitter-white');
            });
            el.classList.remove('text-glitter-white');
            el.classList.add('text-lime-accent', 'bg-royal-gold/10');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Particle generator inside cover
        function initParticles() {
            const container = document.getElementById('particles-js');
            if (!container) return;
            const particleCount = 25;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 4 + 1;
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                const duration = Math.random() * 10 + 5;
                const delay = Math.random() * 5;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${x}%`;
                particle.style.top = `${y}%`;
                
                particle.animate([
                    { transform: 'translateY(0) scale(1)', opacity: Math.random() * 0.5 + 0.2 },
                    { transform: `translateY(-100px) scale(${Math.random() + 0.5})`, opacity: 0 }
                ], {
                    duration: duration * 1000,
                    delay: delay * 1000,
                    iterations: Infinity,
                    direction: 'alternate',
                    easing: 'ease-in-out'
                });

                container.appendChild(particle);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initCountdown();
            initParticles();
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });

            // Scroll highlighter for active nav
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
                    a.classList.remove('text-lime-accent', 'bg-royal-gold/10');
                    a.classList.add('text-glitter-white');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-glitter-white');
                        a.classList.add('text-lime-accent', 'bg-royal-gold/10');
                    }
                });
            });
        });
    </script>
</body>
</html>