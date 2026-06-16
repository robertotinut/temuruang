@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Arthur Pendragon');
        $brideName = trim($names[1] ?? 'Josephine March');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Uther & Ibu Igraine',
                'bride' => 'Bapak Robert & Ibu Margaret',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-12-14',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '09:00',
            'location' => $invitation->location ?? 'Katedral Jakarta',
            'address' => $invitation->address ?? 'Jl. Katedral No.7B, Pasar Baru, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Katedral Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Pemberkatan',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '09:00') . ' - 11:00 WIB',
                'note' => $invitation->location ?? 'Katedral Jakarta'
            ],
            [
                'title' => 'Resepsi',
                'time' => '19:00 - 21:00 WIB',
                'note' => $invitation->address ?? 'The Ritz-Carlton Jakarta, Grand Ballroom'
            ]
        ];

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-16/images/image_5.jpg'),
                asset('assets/templates/wedding-16/images/image_6.jpg'),
                asset('assets/templates/wedding-16/images/image_7.jpg'),
                asset('assets/templates/wedding-16/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-16/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-16/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-16/images/image_4.jpg'),
        ];
    } else {
        $couple = [
            'groom' => 'Arthur Pendragon, B.Sc.',
            'bride' => 'Josephine March, S.E.',
            'parents' => [
                'groom' => 'Bapak Uther & Ibu Igraine',
                'bride' => 'Bapak Robert & Ibu Margaret',
            ],
        ];

        $event = [
            'date_iso' => '2024-12-14',
            'time' => '09:00',
            'location' => 'Katedral Jakarta',
            'address' => 'Jl. Katedral No.7B, Pasar Baru, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=Katedral+Jakarta',
        ];

        $schedule = [
            ['title' => 'Pemberkatan', 'time' => '09:00 - 11:00 WIB', 'note' => 'Katedral Jakarta'],
            ['title' => 'Resepsi', 'time' => '19:00 - 21:00 WIB', 'note' => 'The Ritz-Carlton Jakarta, Grand Ballroom'],
        ];

        $gallery = [
            asset('assets/templates/wedding-16/images/image_5.jpg'),
            asset('assets/templates/wedding-16/images/image_6.jpg'),
            asset('assets/templates/wedding-16/images/image_7.jpg'),
            asset('assets/templates/wedding-16/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-16/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-16/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-16/images/image_4.jpg'),
        ];
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>{{ $couple['bride'] }} &amp; {{ $couple['groom'] }} | Grand Royal Wedding</title>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&amp;family=Outfit:wght@100..900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "deep-charcoal": "#1A1A1B",
                        "outline-variant": "#d0c5af",
                        "on-tertiary": "#ffffff",
                        "surface": "#fff8f0",
                        "outline": "#7f7663",
                        "secondary-fixed": "#e4e2de",
                        "secondary-container": "#e1dfdc",
                        "surface-bright": "#fff8f0",
                        "tertiary-fixed-dim": "#c8c6c7",
                        "inverse-surface": "#343027",
                        "on-surface-variant": "#4d4635",
                        "primary-container": "#d4af37",
                        "on-secondary-fixed-variant": "#474744",
                        "glass-fill": "rgba(255, 255, 255, 0.4)",
                        "tertiary-container": "#b4b2b3",
                        "on-surface": "#1f1b13",
                        "primary": "#735c00",
                        "surface-container-highest": "#eae1d4",
                        "on-secondary-container": "#636360",
                        "on-background": "#1f1b13",
                        "on-tertiary-container": "#454546",
                        "secondary": "#5e5e5c",
                        "on-primary": "#ffffff",
                        "primary-fixed-dim": "#e9c349",
                        "secondary-fixed-dim": "#c8c6c3",
                        "on-tertiary-fixed-variant": "#474647",
                        "surface-tint": "#735c00",
                        "gold-leaf": "#D4AF37",
                        "on-primary-container": "#554300",
                        "on-error-container": "#93000a",
                        "background": "#fff8f0",
                        "tertiary": "#5f5e5f",
                        "gold-shimmer": "#F2E2B0",
                        "surface-container": "#f5eddf",
                        "error-container": "#ffdad6",
                        "surface-variant": "#eae1d4",
                        "on-secondary-fixed": "#1b1c1a",
                        "on-tertiary-fixed": "#1b1b1c",
                        "surface-container-low": "#fbf3e5",
                        "on-secondary": "#ffffff",
                        "on-error": "#ffffff",
                        "on-primary-fixed": "#241a00",
                        "on-primary-fixed-variant": "#574500",
                        "midnight-navy": "#0A1128",
                        "ivory-base": "#FDFBF7",
                        "primary-fixed": "#ffe088",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-fixed": "#e5e2e3",
                        "inverse-on-surface": "#f8f0e2",
                        "surface-dim": "#e1d9cc",
                        "surface-container-high": "#efe7da",
                        "inverse-primary": "#e9c349",
                        "error": "#ba1a1a"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    spacing: {
                        "stack-sm": "8px",
                        "gutter": "24px",
                        "stack-lg": "32px",
                        "margin-mobile": "20px",
                        "stack-md": "16px",
                        "section-gap": "80px",
                        "container-max": "1200px"
                    },
                    fontFamily: {
                        "headline-md": ["Bodoni Moda"],
                        "display-lg": ["Bodoni Moda"],
                        "label-caps": ["Outfit"],
                        "display-lg-mobile": ["Bodoni Moda"],
                        "body-md": ["Outfit"],
                        "headline-sm": ["Bodoni Moda"],
                        "body-lg": ["Outfit"],
                        "button-text": ["Outfit"]
                    },
                    fontSize: {
                        "headline-md": ["32px", { lineHeight: "1.3", fontWeight: "500", letterSpacing: "0.05em" }],
                        "display-lg": ["48px", { lineHeight: "1.1", letterSpacing: "0.02em", fontWeight: "600" }],
                        "label-caps": ["12px", { lineHeight: "1.2", letterSpacing: "0.15em", fontWeight: "500" }],
                        "display-lg-mobile": ["36px", { lineHeight: "1.2", fontWeight: "600", letterSpacing: "0.02em" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "300" }],
                        "headline-sm": ["24px", { lineHeight: "1.4", fontWeight: "500", letterSpacing: "0.05em" }],
                        "body-lg": ["18px", { lineHeight: "1.6", letterSpacing: "0.01em", fontWeight: "300" }],
                        "button-text": ["14px", { lineHeight: "1", letterSpacing: "0.05em", fontWeight: "500" }]
                    }
                }
            }
        };
    </script>
    <style>
        body.is-locked {
            overflow: hidden;
            height: 100vh;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(212, 175, 55, 0.4);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
        
        .gold-border {
            border: 1px solid #D4AF37;
        }

        .cover-overlay {
            background: linear-gradient(to bottom, rgba(10, 17, 40, 0.4), rgba(10, 17, 40, 0.85));
        }

        .gold-gradient-text {
            background: linear-gradient(to right, #D4AF37, #F2E2B0, #D4AF37);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 15px rgba(212, 175, 55, 0.5); }
            50% { box-shadow: 0 0 30px rgba(212, 175, 55, 0.8); }
        }

        .btn-primary {
            background: linear-gradient(45deg, #D4AF37, #F2E2B0, #D4AF37);
            background-size: 200% auto;
            color: #1A1A1B;
            transition: 0.5s;
        }

        .btn-primary:hover {
            animation: shimmer 2s linear infinite;
        }
        
        .btn-pulse {
            animation: pulseGlow 2s infinite;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        #main-content {
            display: none;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .fixed-bg {
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        .dark-overlay {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        /* Gold Dust Particles */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
        }

        /* Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }

        .ornament-corner {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 1px solid #D4AF37;
            opacity: 0.6;
        }
        .ornament-tl { top: 20px; left: 20px; border-right: none; border-bottom: none; }
        .ornament-tr { top: 20px; right: 20px; border-left: none; border-bottom: none; }
        .ornament-bl { bottom: 20px; left: 20px; border-right: none; border-top: none; }
        .ornament-br { bottom: 20px; right: 20px; border-left: none; border-top: none; }

        #mobile-menu {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 100%;
            max-width: 480px;
            left: 50%;
            transform: translateX(100%);
            z-index: 60;
            transition: transform 0.5s ease-in-out;
            background: #1A1A1B;
        }
        #mobile-menu.open {
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="bg-deep-charcoal text-white font-body-md antialiased selection:bg-gold-leaf selection:text-white max-w-[480px] w-full mx-auto relative shadow-2xl border-x border-gold-leaf/10 min-h-screen is-locked">

    <!-- Fixed Background -->
    <div class="fixed inset-0 z-0 fixed-bg max-w-[480px] w-full left-1/2 -translate-x-1/2" style="background-image: url('{{ asset('assets/templates/wedding-16/images/image_2.jpg') }}');"></div>
    <div class="fixed inset-0 z-0 dark-overlay max-w-[480px] w-full left-1/2 -translate-x-1/2"></div>
    
    <!-- COVER SECTION -->
    <section class="fixed inset-0 z-50 max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-center bg-cover bg-center" id="cover" style="background-image: url('{{ asset('assets/templates/wedding-16/images/image_1.jpg') }}');">
        <div class="absolute inset-0 cover-overlay"></div>
        <div class="relative z-10 flex flex-col items-center text-center px-6 w-full max-w-md fade-in-up">
            <div class="ornament-corner ornament-tl"></div>
            <div class="ornament-corner ornament-tr"></div>
            <div class="ornament-corner ornament-bl"></div>
            <div class="ornament-corner ornament-br"></div>
            <span class="font-label-caps text-label-caps text-gold-leaf mb-stack-sm tracking-widest uppercase">The Wedding Of</span>
            <div class="relative py-12 px-8 mb-stack-lg w-full">
                <!-- Gold Geometric Frame -->
                <div class="absolute inset-0 border border-gold-leaf opacity-60 rounded-t-full rounded-b-full shadow-[0_0_15px_rgba(212,175,55,0.3)]"></div>
                <div class="absolute inset-2 border border-gold-leaf opacity-40 rounded-t-full rounded-b-full"></div>
                <h1 class="font-display-lg-mobile gold-gradient-text mb-2">{{ $couple['groom'] }}</h1>
                <span class="font-headline-md text-headline-md text-gold-leaf italic">&amp;</span>
                <h1 class="font-display-lg-mobile gold-gradient-text mt-2">{{ $couple['bride'] }}</h1>
            </div>
            <div class="glass-panel w-full p-6 rounded-lg mb-stack-lg flex flex-col items-center">
                <span class="font-body-md text-body-md text-white/80 mb-1">Kepada Yth. Bapak/Ibu/Saudara/i</span>
                <p class="font-headline-sm text-headline-sm text-white font-medium border-b border-gold-leaf/50 pb-2 w-full text-center">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
                <span class="font-label-caps text-label-caps text-white/60 mt-2 text-[10px]">Mohon maaf bila ada kesalahan penulisan nama/gelar</span>
            </div>
            <button class="btn-primary btn-pulse rounded-full py-3 px-8 font-button-text text-button-text flex items-center gap-2 shadow-lg" id="openBtn" onclick="openInvitation()">
                <span class="material-symbols-outlined text-[18px]">drafts</span>
                Buka Undangan
            </button>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="relative z-10 pb-32 w-full overflow-hidden" id="main-content">
        <!-- Particles Container -->
        <div id="particles-js" class="pointer-events-none"></div>

        <!-- Top Navigation -->
        <header class="fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-40 bg-black/45 backdrop-blur-md border-b border-gold-leaf/20 flex justify-between items-center px-margin-mobile py-4 opacity-0 transition-opacity duration-500" id="top-nav">
            <div class="font-headline-sm text-base gold-gradient-text uppercase tracking-widest">A &amp; J Wedding</div>
            <button class="text-gold-leaf" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </header>

        <!-- Mobile Menu Overlay -->
        <div class="flex flex-col items-center justify-center gap-8" id="mobile-menu">
            <button class="absolute top-6 right-6 text-gold-leaf" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <a class="font-display-lg-mobile text-gold-leaf" href="#hero" onclick="toggleMobileMenu()">Home</a>
            <a class="font-display-lg-mobile text-gold-leaf" href="#profile" onclick="toggleMobileMenu()">Mempelai</a>
            <a class="font-display-lg-mobile text-gold-leaf" href="#event" onclick="toggleMobileMenu()">Acara</a>
            <a class="font-display-lg-mobile text-gold-leaf" href="#gallery" onclick="toggleMobileMenu()">Galeri</a>
            <a class="font-display-lg-mobile text-gold-leaf" href="#kado" onclick="toggleMobileMenu()">Kado</a>
            <a class="font-display-lg-mobile text-gold-leaf" href="#rsvp" onclick="toggleMobileMenu()">RSVP</a>
        </div>

        <!-- SECTION: HERO -->
        <section class="relative min-h-[90vh] flex items-center justify-center py-section-gap px-margin-mobile" id="hero">
            <div class="absolute inset-4 z-0 rounded-2xl overflow-hidden border border-gold-leaf/30 shadow-[0_0_30px_rgba(212,175,55,0.15)]">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/templates/wedding-16/images/image_2.jpg') }}');"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/80"></div>
            </div>
            <div class="relative z-10 flex flex-col items-center w-full max-w-4xl mt-16 text-center">
                <div class="mb-stack-lg fade-in-up">
                    <h2 class="font-display-lg-mobile gold-gradient-text mb-4">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                    <p class="font-body-lg text-body-lg text-white/90 text-center max-w-2xl mx-auto glass-panel p-6 rounded-xl border-gold-leaf/40 text-sm md:text-base">
                        "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang."
                    </p>
                </div>
                <!-- Countdown Glass Panels -->
                <div class="grid grid-cols-4 gap-2 w-full max-w-2xl mx-auto fade-in-up delay-200" id="countdown">
                    <div class="glass-panel rounded-lg p-3 flex flex-col items-center justify-center text-center">
                        <span class="font-headline-md text-lg gold-gradient-text" id="days">00</span>
                        <span class="font-label-caps text-[9px] text-white/80 uppercase tracking-wider">Hari</span>
                    </div>
                    <div class="glass-panel rounded-lg p-3 flex flex-col items-center justify-center text-center">
                        <span class="font-headline-md text-lg gold-gradient-text" id="hours">00</span>
                        <span class="font-label-caps text-[9px] text-white/80 uppercase tracking-wider">Jam</span>
                    </div>
                    <div class="glass-panel rounded-lg p-3 flex flex-col items-center justify-center text-center">
                        <span class="font-headline-md text-lg gold-gradient-text" id="minutes">00</span>
                        <span class="font-label-caps text-[9px] text-white/80 uppercase tracking-wider">Menit</span>
                    </div>
                    <div class="glass-panel rounded-lg p-3 flex flex-col items-center justify-center text-center">
                        <span class="font-headline-md text-lg gold-gradient-text" id="seconds">00</span>
                        <span class="font-label-caps text-[9px] text-white/80 uppercase tracking-wider">Detik</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="flex justify-center my-12 fade-in-up">
            <svg fill="none" height="40" viewbox="0 0 200 40" width="200" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 20 L90 20 M110 20 L190 20" stroke="#D4AF37" stroke-linecap="round" stroke-width="1"></path>
                <path d="M100 5 L115 20 L100 35 L85 20 Z" fill="none" stroke="#D4AF37" stroke-width="1.5"></path>
                <circle cx="100" cy="20" fill="#D4AF37" r="3"></circle>
            </svg>
        </div>

        <!-- SECTION: PROFILE -->
        <section class="py-section-gap px-margin-mobile relative" id="profile">
            <div class="text-center mb-16 fade-in-up">
                <span class="font-label-caps text-label-caps text-gold-leaf uppercase tracking-widest mb-2 block">Mempelai</span>
                <h2 class="font-headline-md text-headline-md gold-gradient-text">Sang Pengantin</h2>
            </div>
            <div class="flex flex-col gap-16 max-w-5xl mx-auto items-center">
                <!-- Groom -->
                <div class="flex flex-col items-center text-center fade-in-up delay-100 w-full">
                    <div class="relative w-64 h-80 mb-8 p-3">
                        <!-- Shield/Oval Border -->
                        <div class="absolute inset-0 border-2 border-gold-leaf rounded-[40%] opacity-80 scale-105 shadow-[0_0_20px_rgba(212,175,55,0.2)]"></div>
                        <div class="absolute inset-2 border border-gold-leaf rounded-[40%] opacity-50 scale-105"></div>
                        <img alt="Groom Profile" class="w-full h-full object-cover rounded-[40%]" src="{{ $bg['groom'] }}"/>
                    </div>
                    <h3 class="font-headline-sm text-lg gold-gradient-text mb-2">{{ $couple['groom'] }}</h3>
                    <p class="font-body-md text-sm text-white/80 mb-4">Putra pertama dari<br/>{{ $couple['parents']['groom'] }}</p>
                    <a class="inline-flex items-center gap-2 font-label-caps text-xs text-gold-leaf hover:text-white transition-colors border border-gold-leaf/50 rounded-full px-6 py-2 glass-panel" href="#">
                        <svg class="w-4 h-4" fill="currentColor" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                        @arthur.p
                    </a>
                </div>

                <div class="py-4">
                    <span class="font-display-lg-mobile text-headline-lg text-gold-leaf/30 italic">&amp;</span>
                </div>

                <!-- Bride -->
                <div class="flex flex-col items-center text-center fade-in-up delay-200 w-full">
                    <div class="relative w-64 h-80 mb-8 p-3">
                        <!-- Shield/Oval Border -->
                        <div class="absolute inset-0 border-2 border-gold-leaf rounded-[40%] opacity-80 scale-105 shadow-[0_0_20px_rgba(212,175,55,0.2)]"></div>
                        <div class="absolute inset-2 border border-gold-leaf rounded-[40%] opacity-50 scale-105"></div>
                        <img alt="Bride Profile" class="w-full h-full object-cover rounded-[40%]" src="{{ $bg['bride'] }}"/>
                    </div>
                    <h3 class="font-headline-sm text-lg gold-gradient-text mb-2">{{ $couple['bride'] }}</h3>
                    <p class="font-body-md text-sm text-white/80 mb-4">Putri kedua dari<br/>{{ $couple['parents']['bride'] }}</p>
                    <a class="inline-flex items-center gap-2 font-label-caps text-xs text-gold-leaf hover:text-white transition-colors border border-gold-leaf/50 rounded-full px-6 py-2 glass-panel" href="#">
                        <svg class="w-4 h-4" fill="currentColor" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                        @josephine.m
                    </a>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="flex justify-center my-12 fade-in-up">
            <svg fill="none" height="40" viewbox="0 0 200 40" width="200" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 20 L90 20 M110 20 L190 20" stroke="#D4AF37" stroke-linecap="round" stroke-width="1"></path>
                <path d="M100 5 L115 20 L100 35 L85 20 Z" fill="none" stroke="#D4AF37" stroke-width="1.5"></path>
                <circle cx="100" cy="20" fill="#D4AF37" r="3"></circle>
            </svg>
        </div>

        <!-- SECTION: EVENT -->
        <section class="py-section-gap px-margin-mobile relative" id="event">
            <div class="text-center mb-16 fade-in-up">
                <span class="font-label-caps text-label-caps text-gold-leaf uppercase tracking-widest mb-2 block">Save The Date</span>
                <h2 class="font-headline-md text-headline-md gold-gradient-text">Rangkaian Acara</h2>
            </div>
            <div class="flex flex-col gap-8 max-w-4xl mx-auto">
                <!-- Ceremony -->
                <div class="glass-panel p-8 rounded-xl relative overflow-hidden group hover:border-gold-leaf transition-all duration-500 hover:shadow-[0_0_30px_rgba(212,175,55,0.2)] fade-in-up delay-100">
                    <div class="ornament-corner ornament-tl"></div>
                    <div class="ornament-corner ornament-tr"></div>
                    <div class="ornament-corner ornament-bl"></div>
                    <div class="ornament-corner ornament-br"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold-leaf/10 rounded-bl-full -z-10 group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="flex justify-center mb-6 text-gold-leaf">
                        <span class="material-symbols-outlined text-5xl">church</span>
                    </div>
                    <h3 class="font-headline-sm text-lg text-center text-white mb-6 border-b border-gold-leaf/30 pb-4">{{ $schedule[0]['title'] }}</h3>
                    <div class="space-y-4 font-body-md text-center text-white/90 text-sm">
                        <div class="flex flex-col items-center">
                            <span class="font-medium gold-gradient-text text-base">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                            <span>Tabuh {{ $schedule[0]['time'] }}</span>
                        </div>
                        <div class="flex flex-col items-center pt-2">
                            <span class="font-medium text-white text-base">{{ $schedule[0]['note'] }}</span>
                            <span class="text-xs text-white/70">{{ $event['address'] }}</span>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-center">
                        <a class="btn-primary rounded-full py-2.5 px-6 font-button-text text-xs flex items-center gap-2" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            Google Maps
                        </a>
                    </div>
                </div>
                <!-- Reception -->
                <div class="glass-panel p-8 rounded-xl relative overflow-hidden group hover:border-gold-leaf transition-all duration-500 hover:shadow-[0_0_30px_rgba(212,175,55,0.2)] fade-in-up delay-200">
                    <div class="ornament-corner ornament-tl"></div>
                    <div class="ornament-corner ornament-tr"></div>
                    <div class="ornament-corner ornament-bl"></div>
                    <div class="ornament-corner ornament-br"></div>
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold-leaf/10 rounded-bl-full -z-10 group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="flex justify-center mb-6 text-gold-leaf">
                        <span class="material-symbols-outlined text-5xl">celebration</span>
                    </div>
                    <h3 class="font-headline-sm text-lg text-center text-white mb-6 border-b border-gold-leaf/30 pb-4">{{ $schedule[1]['title'] }}</h3>
                    <div class="space-y-4 font-body-md text-center text-white/90 text-sm">
                        <div class="flex flex-col items-center">
                            <span class="font-medium gold-gradient-text text-base">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                            <span>Tabuh {{ $schedule[1]['time'] }}</span>
                        </div>
                        <div class="flex flex-col items-center pt-2">
                            <span class="font-medium text-white text-base">{{ $schedule[1]['note'] }}</span>
                            <span class="text-xs text-white/70">{{ $event['address'] }}</span>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-center">
                        <a class="btn-primary rounded-full py-2.5 px-6 font-button-text text-xs flex items-center gap-2" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-[16px]">location_on</span>
                            Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION: GALLERY (Bento/Asymmetric) -->
        <section class="py-section-gap px-margin-mobile relative" id="gallery">
            <div class="text-center mb-16 fade-in-up">
                <span class="font-label-caps text-label-caps text-gold-leaf uppercase tracking-widest mb-2 block">Our Moments</span>
                <h2 class="font-headline-md text-headline-md gold-gradient-text">Galeri Foto</h2>
            </div>
            
            <div class="grid grid-cols-2 gap-4 auto-rows-[160px] fade-in-up delay-100">
                @foreach ($gallery as $index => $img)
                @php
                    $span = '';
                    if ($index == 0) $span = 'col-span-2 row-span-2';
                    elseif ($index == 3) $span = 'col-span-2';
                @endphp
                <div class="overflow-hidden rounded-xl hover:scale-105 transition-all duration-500 shadow-md cursor-zoom-in relative group {{ $span }}" onclick="openLightbox('{{ $img }}')">
                    <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="{{ $img }}" alt="Gallery Image {{ $index+1 }}"/>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                        <div class="w-12 h-12 border border-gold-leaf rounded-full flex items-center justify-center scale-50 group-hover:scale-100 transition-transform duration-500">
                            <span class="material-symbols-outlined text-gold-leaf text-xl">zoom_in</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- SECTION: WEDDING GIFT -->
        <section class="py-section-gap px-margin-mobile relative text-center" id="kado">
            <div class="max-w-3xl mx-auto glass-panel p-8 rounded-2xl border-2 border-gold-leaf/40 shadow-[0_10px_40px_rgba(0,0,0,0.5)] fade-in-up">
                <div class="ornament-corner ornament-tl"></div>
                <div class="ornament-corner ornament-tr"></div>
                <div class="ornament-corner ornament-bl"></div>
                <div class="ornament-corner ornament-br"></div>
                <div class="text-center mb-10">
                    <span class="font-label-caps text-label-caps text-gold-leaf uppercase tracking-widest mb-2 block">Tanda Kasih</span>
                    <h2 class="font-headline-md text-headline-md gold-gradient-text">Kado Digital</h2>
                    <p class="font-body-md text-sm text-white/70 mt-4 max-w-md mx-auto">
                        Bagi keluarga dan kerabat yang ingin mengirimkan hadiah tanda kasih, dapat melalui transfer bank atau dompet digital berikut:
                    </p>
                </div>
                
                @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                    <div class="space-y-6">
                        @foreach($invitation->bankAccounts as $bank)
                        <div class="bg-black/30 border border-gold-leaf/30 p-6 flex justify-between items-center rounded-xl group hover:border-gold-leaf transition-all">
                            <div class="text-left">
                                <p class="font-label-caps text-label-caps text-gold-leaf uppercase mb-1">{{ strtoupper($bank->bank_name) }}</p>
                                <p class="font-headline-sm text-white tracking-wider text-base md:text-lg">{{ $bank->account_number }}</p>
                                <p class="font-body-md text-white/70 text-xs">a.n {{ strtoupper($bank->account_name) }}</p>
                            </div>
                            <button class="text-gold-leaf hover:scale-110 transition-transform p-2 glass-panel rounded-full" onclick="copyAccount('{{ $bank->account_number }}', this)">
                                <span class="material-symbols-outlined text-sm">content_copy</span>
                            </button>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="space-y-6">
                        <div class="bg-black/30 border border-gold-leaf/30 p-6 flex justify-between items-center rounded-xl group hover:border-gold-leaf transition-all">
                            <div class="text-left">
                                <p class="font-label-caps text-label-caps text-gold-leaf uppercase mb-1">Bank BCA</p>
                                <p class="font-headline-sm text-white tracking-wider text-base md:text-lg">123 456 7890</p>
                                <p class="font-body-md text-white/70 text-xs">a.n Arthur Pendragon</p>
                            </div>
                            <button class="text-gold-leaf hover:scale-110 transition-transform p-2 glass-panel rounded-full" onclick="copyAccount('123 456 7890', this)">
                                <span class="material-symbols-outlined text-sm">content_copy</span>
                            </button>
                        </div>
                        <div class="bg-black/30 border border-gold-leaf/30 p-6 flex justify-between items-center rounded-xl group hover:border-gold-leaf transition-all">
                            <div class="text-left">
                                <p class="font-label-caps text-label-caps text-gold-leaf uppercase mb-1">Bank Mandiri</p>
                                <p class="font-headline-sm text-white tracking-wider text-base md:text-lg">987 654 3210</p>
                                <p class="font-body-md text-white/70 text-xs">a.n Josephine March</p>
                            </div>
                            <button class="text-gold-leaf hover:scale-110 transition-transform p-2 glass-panel rounded-full" onclick="copyAccount('987 654 3210', this)">
                                <span class="material-symbols-outlined text-sm">content_copy</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- SECTION: RSVP & WISHES -->
        <section class="py-section-gap px-margin-mobile relative" id="rsvp">
            <div class="max-w-3xl mx-auto glass-panel p-8 rounded-2xl border-2 border-gold-leaf/40 shadow-[0_10px_40px_rgba(0,0,0,0.5)] fade-in-up">
                <div class="ornament-corner ornament-tl"></div>
                <div class="ornament-corner ornament-tr"></div>
                <div class="ornament-corner ornament-bl"></div>
                <div class="ornament-corner ornament-br"></div>
                <div class="text-center mb-10">
                    <span class="font-label-caps text-label-caps text-gold-leaf uppercase tracking-widest mb-2 block">Kehadiran</span>
                    <h2 class="font-headline-md text-headline-md gold-gradient-text">RSVP &amp; Ucapan</h2>
                </div>
                <form class="space-y-6 mb-12" id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div>
                        <input id="nama" class="w-full bg-black/20 border-0 border-b-2 border-gold-leaf/40 focus:ring-0 focus:border-gold-leaf text-white py-4 px-4 placeholder-white/50 transition-colors rounded-t-lg text-sm" placeholder="Nama Lengkap" type="text" required/>
                    </div>
                    <div>
                        <select id="kehadiran" class="w-full bg-black/20 border-0 border-b-2 border-gold-leaf/40 focus:ring-0 focus:border-gold-leaf text-white py-4 px-4 transition-colors rounded-t-lg appearance-none text-sm">
                            <option class="text-black" value="hadir" selected>Ya, Saya akan hadir</option>
                            <option class="text-black" value="tidak">Maaf, Saya tidak bisa hadir</option>
                        </select>
                    </div>
                    <div>
                        <select id="jumlah_tamu" class="w-full bg-black/20 border-0 border-b-2 border-gold-leaf/40 focus:ring-0 focus:border-gold-leaf text-white py-4 px-4 transition-colors rounded-t-lg appearance-none text-sm">
                            <option class="text-black" value="1" selected>1 Orang</option>
                            <option class="text-black" value="2">2 Orang</option>
                        </select>
                    </div>
                    <div>
                        <textarea id="pesan" class="w-full bg-black/20 border-0 border-b-2 border-gold-leaf/40 focus:ring-0 focus:border-gold-leaf text-white py-4 px-4 placeholder-white/50 transition-colors resize-none rounded-t-lg text-sm" placeholder="Tulis ucapan dan doa restu..." rows="3" required></textarea>
                    </div>
                    <button class="btn-primary w-full rounded-full py-4 font-button-text text-button-text mt-6 shadow-[0_0_20px_rgba(212,175,55,0.3)] hover:shadow-[0_0_30px_rgba(212,175,55,0.6)] text-xs uppercase" type="submit">Kirim RSVP</button>
                </form>
                
                <!-- Guestbook Box -->
                <div id="wishList" class="border border-gold-leaf/30 rounded-xl p-6 bg-black/40 backdrop-blur-md h-64 overflow-y-auto no-scrollbar space-y-4 relative">
                    <!-- Wish Item -->
                    <div class="border-b border-gold-leaf/20 pb-4 last:border-0 text-left">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium text-gold-leaf text-sm">Keluarga Bpk. Wijaya</span>
                            <span class="text-[10px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                        </div>
                        <p class="text-sm text-white/80 font-body-md">Selamat menempuh hidup baru Arthur dan Josephine. Semoga selalu berbahagia dan langgeng sampai maut memisahkan.</p>
                    </div>
                    <!-- Wish Item -->
                    <div class="border-b border-gold-leaf/20 pb-4 last:border-0 text-left">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium text-gold-leaf text-sm">Sarah &amp; Tim</span>
                            <span class="text-[10px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                        </div>
                        <p class="text-sm text-white/80 font-body-md">Happy Wedding guys!! Can't wait to celebrate with you both. Wishing you a lifetime of love and happiness.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION: FOOTER -->
        <footer class="py-24 text-center relative overflow-hidden">
            <div class="max-w-2xl mx-auto px-6 fade-in-up">
                <span class="font-headline-sm text-headline-sm gold-gradient-text italic mb-6 block">Terima Kasih</span>
                <p class="font-body-md text-sm text-white/70 mb-12">Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.</p>
                <div class="font-display-lg-mobile gold-gradient-text tracking-widest">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</div>
            </div>
        </footer>
        
        <!-- Spacer for bottom nav -->
        <div class="h-28"></div>
    </main>

    <!-- Bottom Navigation Bar (Mobile & Desktop Centered) -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[432px] z-50 flex justify-around items-center py-3 px-4 bg-black/85 backdrop-blur-md border border-gold-leaf/20 rounded-full shadow-lg transform translate-y-32 transition-transform duration-500" id="bottom-nav">
        <a class="flex flex-col items-center text-gold-leaf" href="#cover" onclick="smoothScroll(event, '#cover')">
            <span class="material-symbols-outlined text-[20px]">home</span>
            <span class="font-label-caps text-[9px] mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center text-white/60" href="#profile" onclick="smoothScroll(event, '#profile')">
            <span class="material-symbols-outlined text-[20px]">favorite</span>
            <span class="font-label-caps text-[9px] mt-1">Profil</span>
        </a>
        <a class="flex flex-col items-center text-white/60" href="#event" onclick="smoothScroll(event, '#event')">
            <span class="material-symbols-outlined text-[20px]">event_note</span>
            <span class="font-label-caps text-[9px] mt-1">Acara</span>
        </a>
        <a class="flex flex-col items-center text-white/60" href="#gallery" onclick="smoothScroll(event, '#gallery')">
            <span class="material-symbols-outlined text-[20px]">photo_library</span>
            <span class="font-label-caps text-[9px] mt-1">Galeri</span>
        </a>
        <a class="flex flex-col items-center text-white/60" href="#rsvp" onclick="smoothScroll(event, '#rsvp')">
            <span class="material-symbols-outlined text-[20px]">mail</span>
            <span class="font-label-caps text-[9px] mt-1">RSVP</span>
        </a>
    </nav>

    <!-- Floating Action Controls -->
    <div class="fixed bottom-24 left-1/2 translate-x-[170px] z-[45] flex flex-col gap-3 transform translate-y-32 transition-transform duration-500" id="floating-controls">
        <!-- Music Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-deep-charcoal/90 text-gold-leaf border border-gold-leaf/30 flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAudio()">
            <span class="material-symbols-outlined" id="music-icon">volume_up</span>
        </button>
        <!-- Autoscroll Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-deep-charcoal/90 text-gold-leaf border border-gold-leaf/30 flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAutoscroll()">
            <span class="material-symbols-outlined" id="autoscroll-icon">play_arrow</span>
        </button>
    </div>

    <!-- Hidden Audio element for background music -->
    <audio id="bg-music" loop>
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg"/>
    </audio>

    <!-- Lightbox Modal for Photo Preview -->
    <div id="lightbox" class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-gold-leaf text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-gold-leaf/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <!-- JavaScript for Interactions -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openBtn = document.getElementById('openBtn');
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const bottomNav = document.getElementById('bottom-nav');
            const floatingControls = document.getElementById('floating-controls');
            const navHeader = document.getElementById('top-nav');
            const audio = document.getElementById('bg-music');
            
            let autoScrollInterval;

            // Particles.js configuration
            particlesJS('particles-js', {
                "particles": {
                    "number": { "value": 40, "density": { "enable": true, "value_area": 800 } },
                    "color": { "value": "#D4AF37" },
                    "shape": { "type": "circle" },
                    "opacity": { "value": 0.5, "random": true, "anim": { "enable": true, "speed": 1, "opacity_min": 0.1, "sync": false } },
                    "size": { "value": 3, "random": true, "anim": { "enable": true, "speed": 2, "size_min": 0.1, "sync": false } },
                    "line_linked": { "enable": false },
                    "move": { "enable": true, "speed": 1, "direction": "top", "random": true, "straight": false, "out_mode": "out", "bounce": false }
                },
                "interactivity": { "events": { "onhover": { "enable": false }, "onclick": { "enable": false }, "resize": true } },
                "retina_detect": true
            });

            // Intersection Observer for scroll animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Expose globally for openInvitation function
            window.observer = observer;

            // Observe cover elements immediately so they animate in on page load
            document.querySelectorAll('#cover .fade-in-up').forEach(el => {
                observer.observe(el);
            });
        });

        // Open Invitation Logic
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const navHeader = document.getElementById('top-nav');
            const bottomNav = document.getElementById('bottom-nav');
            const floatingControls = document.getElementById('floating-controls');
            const audio = document.getElementById('bg-music');

            document.body.classList.remove('is-locked');
            mainContent.style.display = 'block';
            setTimeout(() => {
                mainContent.style.opacity = '1';
            }, 50);

            cover.style.transition = 'transform 1.2s cubic-bezier(0.77, 0, 0.175, 1), opacity 1s ease-in-out';
            cover.style.transform = 'translateY(-100%)';
            cover.style.opacity = '0';

            setTimeout(() => {
                cover.classList.add('hidden');
                navHeader.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-32');
                floatingControls.classList.remove('translate-y-32');
                
                audio.play().then(() => {
                    isPlaying = true;
                    document.getElementById('music-icon').innerText = 'volume_up';
                }).catch(err => console.log('Audio play blocked:', err));

                // Observe elements inside main-content for animation
                document.querySelectorAll('#main-content .fade-in-up').forEach(el => {
                    if (window.observer) window.observer.observe(el);
                });

                startAutoscroll();
            }, 500);
        }

        // Audio Toggle
        let isPlaying = false;
        function toggleAudio() {
            const audio = document.getElementById('bg-music');
            const icon = document.getElementById('music-icon');
            if (isPlaying) {
                audio.pause();
                icon.innerText = 'volume_off';
            } else {
                audio.play();
                icon.innerText = 'volume_up';
            }
            isPlaying = !isPlaying;
        }

        // Autoscroll Logic
        let isScrolling = false;
        let scrollInterval;
        function toggleAutoscroll() {
            const icon = document.getElementById('autoscroll-icon');
            if (isScrolling) {
                clearInterval(scrollInterval);
                icon.innerText = 'play_arrow';
            } else {
                scrollInterval = setInterval(() => {
                    window.scrollBy(0, 1);
                }, 30);
                icon.innerText = 'pause';
            }
            isScrolling = !isScrolling;
        }

        function startAutoscroll() {
            isScrolling = true;
            document.getElementById('autoscroll-icon').innerText = 'pause';
            scrollInterval = setInterval(() => {
                window.scrollBy(0, 1);
            }, 30);
        }

        function stopAutoscroll() {
            if (isScrolling) {
                clearInterval(scrollInterval);
                document.getElementById('autoscroll-icon').innerText = 'play_arrow';
                isScrolling = false;
            }
        }

        ['wheel', 'touchstart', 'touchmove'].forEach(evt => 
            window.addEventListener(evt, () => {
                stopAutoscroll();
            }, { passive: true })
        );

        // Copy Account Logic
        function copyAccount(number, btn) {
            navigator.clipboard.writeText(number);
            const originalText = btn.innerHTML;
            btn.innerHTML = 'COPIED!';
            setTimeout(() => {
                btn.innerHTML = originalText;
            }, 2000);
        }

        // RSVP Submit
        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const presence = document.getElementById('kehadiran')?.value || 'hadir';
            const msg = document.getElementById('pesan').value;

            const card = document.createElement('div');
            card.className = 'border-b border-gold-leaf/20 pb-4 last:border-0 text-left';
            card.innerHTML = `<div class="flex items-center gap-2 mb-1"><span class="font-medium text-gold-leaf text-sm">${name}</span><span class="text-[10px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">${presence === 'hadir' ? 'Hadir' : 'Berhalangan'}</span></div><p class="text-sm text-white/80 font-body-md">${msg}</p>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("Hatur nuhun, ucapan parantos kakintun!");
        }

        // Lightbox Logic
        function openLightbox(src) {
            stopAutoscroll();
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
            }, 10);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('opacity-0');
            setTimeout(() => {
                lightbox.classList.add('hidden');
            }, 300);
        }

        // Smooth Scroll
        function smoothScroll(e, selector) {
            e.preventDefault();
            stopAutoscroll();
            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });

            document.querySelectorAll('#bottom-nav a').forEach(a => {
                a.className = "flex flex-col items-center text-white/60";
            });
            e.currentTarget.className = "flex flex-col items-center text-gold-leaf";
        }

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }

        // Simple Countdown Timer
        const targetDate = new Date("{{ $event['date_iso'] }}T{{ $event['time'] }}:00").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) return;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days').innerText = days.toString().padStart(2, '0');
            document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
            document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Scroll Active Nav Link Highlight
        window.addEventListener('scroll', () => {
            let current = "";
            const sections = document.querySelectorAll("main, section");
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute("id");
                }
            });

            document.querySelectorAll('#bottom-nav a').forEach((a) => {
                a.className = "flex flex-col items-center text-white/60";
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex flex-col items-center text-gold-leaf";
                }
            });
        });
    </script>
</body>
</html>