@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Raden Adipati');
        $brideName = trim($names[1] ?? 'Kencana Ayu');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Sudirman & Ibu Lestari',
                'bride' => 'Bpk. Haryono & Ibu Saraswati',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-08-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Masjid Raya Grand Royal',
            'address' => $invitation->address ?? 'Jl. Sudirman No. 1, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Masjid Raya Grand Royal'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - Selesai',
                'note' => $invitation->location ?? 'Masjid Raya Grand Royal, Jl. Sudirman No. 1, Jakarta Pusat'
            ],
            [
                'title' => 'Resepsi Gala',
                'time' => '19:00 - Selesai',
                'note' => $invitation->address ?? 'Grand Ballroom The Ritz, Jl. MH Thamrin No. 9, Jakarta Pusat'
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
                ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di sebuah acara gala, kami menyadari ada percikan yang tak terlupakan.'],
                ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
                ['title' => 'Menuju Pernikahan', 'date' => 'Agustus 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-21/images/image_5.jpg'),
                asset('assets/templates/wedding-21/images/image_6.jpg'),
                asset('assets/templates/wedding-21/images/image_7.jpg'),
                asset('assets/templates/wedding-21/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-21/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-21/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-21/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-21/images/image_4.jpg'),
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
                ['bank' => 'BCA', 'name' => $couple['groom'], 'account' => '1234 5678 90'],
            ];
        }
    } else {
        $couple = [
            'groom' => 'Raden Adipati',
            'bride' => 'Kencana Ayu',
            'parents' => [
                'groom' => 'Bpk. Sudirman & Ibu Lestari',
                'bride' => 'Bpk. Haryono & Ibu Saraswati',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-12',
            'time' => '08:00',
            'location' => 'Masjid Raya Grand Royal',
            'address' => 'Jl. Sudirman No. 1, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=Jakarta+Pusat',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 WIB - Selesai', 'note' => 'Masjid Raya Grand Royal, Jl. Sudirman No. 1, Jakarta Pusat'],
            ['title' => 'Resepsi Gala', 'time' => '19:00 WIB - Selesai', 'note' => 'Grand Ballroom The Ritz, Jl. MH Thamrin No. 9, Jakarta Pusat'],
        ];

        $stories = [
            ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di sebuah acara gala, kami menyadari ada percikan yang tak terlupakan.'],
            ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
            ['title' => 'Menuju Pernikahan', 'date' => 'Agustus 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-21/images/image_5.jpg'),
            asset('assets/templates/wedding-21/images/image_6.jpg'),
            asset('assets/templates/wedding-21/images/image_7.jpg'),
            asset('assets/templates/wedding-21/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-21/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-21/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-21/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-21/images/image_4.jpg'),
        ];

        $wishes = [
            ['name' => 'Ari & Dinda', 'status' => 'Hadir', 'message' => 'Selamat berbahagia! Doa kami menyertai langkah kalian berdua.'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Raden Adipati', 'account' => '1234 5678 90'],
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&amp;family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&amp;family=Plus+Jakarta+Sans:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error-container": "#ffdad6",
                        "inverse-surface": "#f7ddd8",
                        "secondary": "#e9c349",
                        "primary-fixed-dim": "#ffb4a8",
                        "on-tertiary-fixed": "#1c1c17",
                        "surface-container-low": "#261816",
                        "on-primary-fixed-variant": "#8f0f07",
                        "on-primary-container": "#ff8371",
                        "primary-container": "#800000",
                        "on-tertiary-fixed-variant": "#474741",
                        "on-surface": "#f7ddd8",
                        "on-primary-fixed": "#410000",
                        "error-container": "#93000a",
                        "on-secondary-fixed-variant": "#574500",
                        "on-error": "#690005",
                        "primary": "#ffb4a8",
                        "tertiary-fixed-dim": "#c9c6bf",
                        "on-background": "#f7ddd8",
                        "on-secondary-fixed": "#241a00",
                        "tertiary": "#c9c6bf",
                        "on-secondary": "#3c2f00",
                        "surface": "#1d100e",
                        "surface-container-high": "#362624",
                        "surface-tint": "#ffb4a8",
                        "glass-overlay": "rgba(128, 0, 0, 0.6)",
                        "surface-variant": "#41312e",
                        "outline-variant": "#5a413d",
                        "outline": "#a98984",
                        "secondary-fixed": "#ffe088",
                        "secondary-container": "#af8d11",
                        "inverse-on-surface": "#3d2d2a",
                        "surface-dim": "#1d100e",
                        "on-primary": "#690000",
                        "on-surface-variant": "#e2bfb9",
                        "surface-container-highest": "#41312e",
                        "secondary-fixed-dim": "#e9c349",
                        "surface-bright": "#463533",
                        "primary-fixed": "#ffdad4",
                        "on-secondary-container": "#342800",
                        "surface-container-lowest": "#170b09",
                        "gold-shimmer": "#FFD700",
                        "tertiary-container": "#3d3d38",
                        "on-tertiary-container": "#a9a7a0",
                        "background": "#1d100e",
                        "surface-container": "#2a1c1a",
                        "inverse-primary": "#b22b1d",
                        "on-tertiary": "#31312b",
                        "tertiary-fixed": "#e5e2db",
                        "maroon-deep": "#4A0000",
                        "error": "#ffb4ab"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "container-max": "1200px",
                        "glass-padding": "40px",
                        "gutter": "24px",
                        "section-gap": "80px"
                    },
                    "fontFamily": {
                        "headline-section": ["Playfair Display"],
                        "display-hero-mobile": ["Playfair Display"],
                        "label-caps": ["Montserrat"],
                        "display-hero": ["Playfair Display"],
                        "body-md": ["Plus Jakarta Sans"],
                        "button-text": ["Montserrat"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-name": ["Playfair Display"]
                    },
                    "fontSize": {
                        "headline-section": ["32px", { "lineHeight": "40px", "letterSpacing": "0.1em", "fontWeight": "700" }],
                        "display-hero-mobile": ["40px", { "lineHeight": "48px", "fontWeight": "900" }],
                        "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.2em", "fontWeight": "700" }],
                        "display-hero": ["64px", { "lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "900" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "button-text": ["14px", { "lineHeight": "20px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "headline-name": ["48px", { "lineHeight": "56px", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #170b09;
        }

        /* Glassmorphism utility */
        .glass-panel {
            background-color: rgba(128, 0, 0, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 2px solid #FFD700;
            box-shadow: inset 0 0 20px rgba(255, 215, 0, 0.1), 0 10px 30px rgba(74, 0, 0, 0.5);
        }

        .gold-text-glow {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5), 0 0 20px rgba(255, 215, 0, 0.3);
        }

        .gold-border-gradient {
            border: 2px solid transparent;
            background: linear-gradient(rgba(128, 0, 0, 0.6), rgba(128, 0, 0, 0.6)) padding-box,
                        linear-gradient(135deg, #D4AF37, #FFD700, #D4AF37) border-box;
        }

        /* Gallery Shapes */
        .shape-oval { border-radius: 50% / 60% 60% 40% 40%; }
        .shape-hex { clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #170b09;
        }
        ::-webkit-scrollbar-thumb {
            background: #800000;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #FFD700;
        }

        /* Cover Interaction */
        #main-content { display: none; }
        body.cover-active { overflow: hidden; }

        /* Floating controls - constrained to wrapper */
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
            background: rgba(128,0,0,0.8); 
            backdrop-filter: blur(10px); 
            border: 2px solid #FFD700; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            cursor: pointer; 
            color: #FFD700; 
            box-shadow: 0 4px 15px rgba(74,0,0,0.5); 
            transition: all 0.3s; 
        }
        .float-btn:hover { background: #FFD700; color: #1d100e; }
        .float-btn.playing .material-symbols-outlined { animation: spin 3s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .float-btn.scrolling { background: #FFD700; color: #1d100e; }

        /* Bottom nav - constrained to wrapper */
        .bottom-nav-bar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            z-index: 50;
        }

        /* Lightbox positioning */
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
<body class="bg-background text-on-background font-body-md antialiased max-w-[480px] w-full mx-auto shadow-2xl border-x border-gold-shimmer/15 min-h-screen relative overflow-x-hidden cover-active">

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- ==================== COVER SECTION ==================== -->
    <section class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] flex flex-col items-center justify-center bg-cover bg-center" id="cover-section" style="background-image: url('{{ $bg['cover'] }}');">
        <div class="absolute inset-0 bg-surface/80 backdrop-blur-sm"></div>
        <div class="relative z-10 text-center px-6 flex flex-col items-center">
            <p class="font-label-caps text-label-caps text-gold-shimmer tracking-widest mb-4">THE WEDDING OF</p>
            <div class="relative inline-block mb-8">
                <h1 class="font-headline-name text-headline-name text-gold-shimmer gold-text-glow leading-tight">
                    {{ $couple['groom'] }}<br/>&amp;<br/>{{ $couple['bride'] }}
                </h1>
            </div>
            <div class="glass-panel p-6 rounded-xl mb-12 max-w-sm w-full gold-border-gradient">
                <p class="font-body-md text-body-md text-on-surface-variant mb-2">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <p class="font-headline-section text-2xl text-on-surface font-bold">{{ request()->get('kpd', 'Tamu Kehormatan') }}</p>
            </div>
            <button class="bg-gold-shimmer text-surface-container-lowest font-button-text text-button-text py-4 px-10 rounded-full shadow-[0_0_20px_rgba(255,215,0,0.4)] hover:scale-105 transition-transform duration-300 flex items-center gap-2" onclick="openInvitation()">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">mail</span>
                BUKA UNDANGAN
            </button>
        </div>
    </section>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="pb-32" id="main-content">
        <!-- ===== HERO SECTION ===== -->
        <section class="relative min-h-screen flex flex-col items-center justify-center pt-20 px-6 text-center bg-cover bg-center" id="home" style="background-image: url('{{ $bg['hero'] ?? $bg['cover'] }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-surface/40 via-surface/80 to-background"></div>
            <div class="relative z-10 w-full flex flex-col items-center">
                <p class="font-label-caps text-label-caps text-gold-shimmer mb-6 tracking-[0.3em]">SAVE THE DATE</p>
                <h2 class="font-display-hero-mobile text-display-hero-mobile text-on-surface mb-12 gold-text-glow">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                <!-- Countdown -->
                <div class="grid grid-cols-4 gap-2 w-full max-w-sm">
                    <div class="glass-panel gold-border-gradient rounded-lg p-3 flex flex-col items-center justify-center">
                        <span class="font-headline-section text-2xl text-gold-shimmer font-bold mb-1" id="cd-days">00</span>
                        <span class="font-label-caps text-[10px] text-on-surface">HARI</span>
                    </div>
                    <div class="glass-panel gold-border-gradient rounded-lg p-3 flex flex-col items-center justify-center">
                        <span class="font-headline-section text-2xl text-gold-shimmer font-bold mb-1" id="cd-hours">00</span>
                        <span class="font-label-caps text-[10px] text-on-surface">JAM</span>
                    </div>
                    <div class="glass-panel gold-border-gradient rounded-lg p-3 flex flex-col items-center justify-center">
                        <span class="font-headline-section text-2xl text-gold-shimmer font-bold mb-1" id="cd-minutes">00</span>
                        <span class="font-label-caps text-[10px] text-on-surface">MENIT</span>
                    </div>
                    <div class="glass-panel gold-border-gradient rounded-lg p-3 flex flex-col items-center justify-center">
                        <span class="font-headline-section text-2xl text-gold-shimmer font-bold mb-1" id="cd-seconds">00</span>
                        <span class="font-label-caps text-[10px] text-on-surface">DETIK</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== PROFILE SECTION ===== -->
        <section class="py-16 text-center relative px-6" id="profile">
            <h3 class="font-headline-section text-headline-section text-gold-shimmer mb-4">Sang Mempelai</h3>
            <p class="font-body-md text-body-md text-on-surface-variant mx-auto mb-12">Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan resepsi pernikahan putra-putri kami.</p>
            <div class="flex flex-col items-center justify-center gap-12">
                <!-- Groom -->
                <div class="flex flex-col items-center w-full">
                    <div class="relative w-52 h-64 mb-6">
                        <div class="absolute inset-0 border-2 border-gold-shimmer shape-oval translate-x-2 translate-y-2 opacity-50"></div>
                        <img class="w-full h-full object-cover shape-oval glass-panel p-2" src="{{ $bg['groom'] }}" alt="Foto {{ $couple['groom'] }}"/>
                    </div>
                    <h4 class="font-headline-section text-2xl text-on-surface mb-2">{{ $couple['groom'] }}</h4>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-4">Putra dari<br/>{{ $couple['parents']['groom'] }}</p>
                </div>
                <div class="text-4xl text-primary-container opacity-50 font-headline-name">&amp;</div>
                <!-- Bride -->
                <div class="flex flex-col items-center w-full">
                    <div class="relative w-52 h-64 mb-6">
                        <div class="absolute inset-0 border-2 border-gold-shimmer shape-oval -translate-x-2 translate-y-2 opacity-50"></div>
                        <img class="w-full h-full object-cover shape-oval glass-panel p-2" src="{{ $bg['bride'] }}" alt="Foto {{ $couple['bride'] }}"/>
                    </div>
                    <h4 class="font-headline-section text-2xl text-on-surface mb-2">{{ $couple['bride'] }}</h4>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-4">Putri dari<br/>{{ $couple['parents']['bride'] }}</p>
                </div>
            </div>
        </section>

        <!-- ===== EVENTS SECTION ===== -->
        <section class="py-16 relative bg-surface-container-low px-6">
            <div class="text-center mb-12">
                <h3 class="font-headline-section text-headline-section text-gold-shimmer mb-4">Save The Date</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Rangkaian acara pernikahan kami.</p>
            </div>
            <div class="grid grid-cols-1 gap-6">
                @foreach($schedule as $i => $sch)
                <div class="glass-panel gold-border-gradient p-8 rounded-xl text-center relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-shimmer to-transparent"></div>
                    <span class="material-symbols-outlined text-4xl text-gold-shimmer mb-4" style="font-variation-settings: 'FILL' 1;">{{ $i === 0 ? 'menu_book' : 'celebration' }}</span>
                    <h4 class="font-headline-section text-2xl text-on-surface mb-4">{{ $sch['title'] }}</h4>
                    <p class="font-label-caps text-label-caps text-primary mb-2">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    <p class="font-body-md text-body-md text-on-surface-variant mb-6">{{ $sch['time'] }}</p>
                    <p class="font-body-md text-body-md text-on-surface mb-6 font-semibold">{!! nl2br(e($sch['note'])) !!}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center gap-2 py-3 {{ $i === 0 ? 'border-2 border-gold-shimmer text-gold-shimmer hover:bg-gold-shimmer hover:text-surface-container-lowest' : 'bg-gold-shimmer text-surface-container-lowest hover:bg-yellow-400' }} font-button-text text-button-text rounded transition-colors">
                        <span class="material-symbols-outlined">location_on</span> MAPS LOKASI
                    </a>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ===== LOVE STORY SECTION ===== -->
        <section class="py-16 px-6" id="story">
            <div class="text-center mb-16">
                <h3 class="font-headline-section text-headline-section text-gold-shimmer mb-4">Our Journey</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Kisah perjalanan cinta kami.</p>
            </div>
            <div class="max-w-md mx-auto w-full relative pl-6 border-l border-gold-shimmer/30">
                @foreach($stories as $s)
                <div class="relative mb-8 last:mb-0">
                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 bg-gold-shimmer rounded-full border-4 border-background"></div>
                    <div class="glass-panel p-5 rounded-xl gold-border-gradient">
                        <span class="font-label-caps text-[10px] text-primary uppercase tracking-widest mb-1.5 block font-semibold">{{ $s['date'] }}</span>
                        <h4 class="font-headline-section text-lg text-on-surface mb-2">{{ $s['title'] }}</h4>
                        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">{{ $s['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ===== GALLERY SECTION ===== -->
        <section class="py-16 px-6" id="gallery">
            <div class="text-center mb-12">
                <h3 class="font-headline-section text-headline-section text-gold-shimmer mb-4">Gallery Moments</h3>
                <p class="font-body-md text-body-md text-on-surface-variant">Jejak langkah perjalanan cinta kami.</p>
            </div>
            <!-- Asymmetrical Masonry Grid -->
            <div class="grid grid-cols-2 gap-3 auto-rows-[140px]">
                @if(isset($gallery[0]))
                <div class="col-span-2 row-span-2 relative overflow-hidden glass-panel p-2 shape-hex group cursor-zoom-in" onclick="openLightbox('{{ $gallery[0] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $gallery[0] }}" alt="Gallery 1"/>
                </div>
                @endif
                @if(isset($gallery[1]))
                <div class="col-span-1 row-span-1 relative overflow-hidden rounded-xl border-2 border-gold-shimmer group cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $gallery[1] }}" alt="Gallery 2"/>
                </div>
                @endif
                @if(isset($gallery[2]))
                <div class="col-span-1 row-span-2 relative overflow-hidden shape-oval border-4 border-primary-container p-1 bg-gold-shimmer group cursor-zoom-in" onclick="openLightbox('{{ $gallery[2] }}')">
                    <img class="w-full h-full object-cover shape-oval transition-transform duration-700 group-hover:scale-110" src="{{ $gallery[2] }}" alt="Gallery 3"/>
                </div>
                @endif
                @if(isset($gallery[3]))
                <div class="col-span-1 row-span-1 relative overflow-hidden rounded-xl glass-panel group cursor-zoom-in" onclick="openLightbox('{{ $gallery[3] }}')">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $gallery[3] }}" alt="Gallery 4"/>
                </div>
                @endif
            </div>
        </section>

        <!-- ===== RSVP & GIFT SECTION ===== -->
        <section class="py-16 bg-surface-container-highest/30 px-6" id="rsvp">
            <div class="grid grid-cols-1 gap-10">
                <!-- RSVP Form -->
                <div class="glass-panel p-8 rounded-xl gold-border-gradient">
                    <h3 class="font-headline-section text-2xl text-gold-shimmer mb-6">Konfirmasi Kehadiran</h3>
                    <form class="space-y-6" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">NAMA LENGKAP</label>
                            <input id="rsvp-nama" class="w-full bg-surface-container border-0 border-b-2 border-gold-shimmer/50 focus:border-gold-shimmer focus:ring-0 text-on-surface px-0 py-2 placeholder-on-surface-variant/50" placeholder="Masukkan nama Anda" type="text" required/>
                        </div>
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">JUMLAH TAMU</label>
                            <select id="rsvp-guests" class="w-full bg-surface-container border-0 border-b-2 border-gold-shimmer/50 focus:border-gold-shimmer focus:ring-0 text-on-surface px-0 py-2">
                                <option value="1">1 Orang</option>
                                <option value="2">2 Orang</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">KONFIRMASI</label>
                            <select id="rsvp-konfirmasi" class="w-full bg-surface-container border-0 border-b-2 border-gold-shimmer/50 focus:border-gold-shimmer focus:ring-0 text-on-surface px-0 py-2">
                                <option value="Hadir">Ya, Saya Akan Hadir</option>
                                <option value="Tidak Hadir">Maaf, Saya Tidak Bisa Hadir</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant mb-2">UCAPAN &amp; DOA</label>
                            <textarea id="rsvp-pesan" class="w-full bg-surface-container border-0 border-b-2 border-gold-shimmer/50 focus:border-gold-shimmer focus:ring-0 text-on-surface px-0 py-2 placeholder-on-surface-variant/50" placeholder="Tulis ucapan Anda" rows="3" required></textarea>
                        </div>
                        <button class="w-full py-4 bg-gold-shimmer text-surface-container-lowest font-button-text text-button-text rounded font-bold hover:scale-[1.02] transition-transform" type="submit">
                            KIRIM RSVP
                        </button>
                    </form>

                    <!-- Wishes List -->
                    <div class="mt-8 max-h-[250px] overflow-y-auto space-y-4 pr-2" id="wishList">
                        @foreach($wishes as $w)
                        <div class="border-b border-gold-shimmer/20 pb-3 text-left">
                            <div class="flex justify-between mb-1">
                                <span class="font-button-text text-sm text-on-surface font-bold">{{ $w['name'] }}</span>
                                <span class="font-label-caps text-[10px] text-gold-shimmer">{{ $w['status'] }}</span>
                            </div>
                            <p class="font-body-md text-sm text-on-surface-variant italic">"{{ $w['message'] }}"</p>
                        </div>
                        @endforeach
                        <div id="wishListDirect"></div>
                    </div>
                </div>

                <!-- Wedding Gift -->
                <div class="flex flex-col justify-center">
                    <div class="text-center mb-8">
                        <h3 class="font-headline-section text-3xl text-gold-shimmer mb-4">Wedding Gift</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant">Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Dan jika memberi adalah ungkapan tanda kasih Anda, Anda dapat memberi kado secara cashless.</p>
                    </div>
                    <div class="flex flex-col gap-4">
                        @foreach($gifts as $gift)
                        <div class="glass-panel p-6 rounded-xl flex items-center justify-between border-l-4 border-l-gold-shimmer w-full bg-surface-container/40">
                            <div>
                                <p class="font-label-caps text-label-caps text-on-surface-variant mb-1">{{ strtoupper($gift['bank']) }} - {{ $gift['name'] }}</p>
                                <p class="font-headline-section text-xl text-on-surface tracking-widest">{{ $gift['account'] }}</p>
                            </div>
                            <button class="p-3 bg-surface-container rounded-full text-gold-shimmer hover:bg-gold-shimmer hover:text-surface-container-lowest transition-colors flex items-center justify-center" onclick="copyRek('{{ $gift['account'] }}', this)">
                                <span class="material-symbols-outlined text-[20px]">content_copy</span>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <div class="text-center py-8">
            <p class="font-body-md text-sm text-on-surface-variant">Created with <span class="text-gold-shimmer">♥</span> TemuRuang</p>
        </div>
    </div> <!-- End Main Content -->

    <!-- ===== BOTTOM NAV BAR ===== -->
    <nav class="bottom-nav-bar" id="mobileNav" style="display:none;">
        <div class="flex justify-around items-center px-4 py-3 mx-3 mb-3 rounded-full border-2 border-secondary bg-glass-overlay backdrop-blur-2xl bg-surface-container-highest/80 shadow-[0_10px_30px_rgba(74,0,0,0.5)]">
            <a class="flex flex-col items-center justify-center text-gold-shimmer" href="#home">
                <span class="material-symbols-outlined mb-1 text-[22px]">castle</span>
                <span class="font-label-caps text-[9px]">Home</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-transform duration-300" href="#profile">
                <span class="material-symbols-outlined mb-1 text-[22px]">favorite</span>
                <span class="font-label-caps text-[9px]">Mempelai</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-transform duration-300" href="#gallery">
                <span class="material-symbols-outlined mb-1 text-[22px]">auto_awesome_motion</span>
                <span class="font-label-caps text-[9px]">Gallery</span>
            </a>
            <a class="flex flex-col items-center justify-center text-on-surface-variant hover:scale-110 transition-transform duration-300" href="#rsvp">
                <span class="material-symbols-outlined mb-1 text-[22px]">edit_calendar</span>
                <span class="font-label-caps text-[9px]">RSVP</span>
            </a>
        </div>
    </nav>

    <!-- Floating Controls -->
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
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-gold-shimmer/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
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

        // Countdown
        function initCountdown() {
            const target = new Date("{{ $event['date_iso'] ?? '2026-08-12' }}T{{ $event['time'] ?? '08:00' }}:00").getTime();
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

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-nama').value;
            const status = document.getElementById('rsvp-konfirmasi').value;
            const msg = document.getElementById('rsvp-pesan').value;
            const card = document.createElement('div');
            card.className = 'border-b border-gold-shimmer/20 pb-3 text-left';
            card.innerHTML = `<div class="flex justify-between mb-1"><span class="font-button-text text-sm text-on-surface font-bold">${name}</span><span class="font-label-caps text-[10px] text-gold-shimmer">${status}</span></div><p class="font-body-md text-sm text-on-surface-variant italic">"${msg}"</p>`;
            document.getElementById('wishListDirect').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert('RSVP berhasil dikirim!');
        }

        function copyRek(text, btn) {
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                const icon = btn.querySelector('.material-symbols-outlined');
                const oldText = icon.textContent;
                icon.textContent = 'check';
                alert('Nomor rekening berhasil disalin!');
                setTimeout(() => {
                    icon.textContent = oldText;
                }, 2000);
            });
        }

        function openLightbox(src) {
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

        document.addEventListener('DOMContentLoaded', function() {
            initCountdown();
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });
        });
    </script>
</body>
</html>