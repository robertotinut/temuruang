@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        // Parse groom and bride from invitation title (e.g. "Raden & Ajeng")
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Raden Wijaya');
        $brideName = trim($names[1] ?? 'Ajeng Sekar Wangi');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Kunto Wibowo & Ibu Ratna Sari',
                'bride' => 'Bapak Heru Prasetyo & Ibu Maya Indah',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-08-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Masjid Agung Al-Mabrur',
            'address' => $invitation->address ?? 'Jl. Kebangsaan No. 45, Yogyakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Masjid Agung Al-Mabrur Yogyakarta'),
        ];

        $schedule = [
            [
                'title' => 'AKAD NIKAH',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Masjid Agung Al-Mabrur, Yogyakarta'
            ],
            [
                'title' => 'RESEPSI',
                'time' => '11:00 - 14:00 WIB',
                'note' => $invitation->address ?? 'Dalem Kalitan, Jl. Gajah Mada No. 12, Surakarta'
            ]
        ];

        if (isset($invitation->stories) && $invitation->stories->count() > 0) {
            $stories = [];
            foreach ($invitation->stories as $story) {
                $stories[] = [
                    'title' => $story->title,
                    'date' => $story->event_date ? $story->event_date->format('Y') : '',
                    'text' => $story->description,
                ];
            }
        } else {
            $stories = [
                ['title' => 'PERTEMUAN', 'date' => '2018', 'text' => 'Pertama kali bertemu di kampus seni, berbagi mimpi yang sama.'],
                ['title' => 'PENGIKAT HATI', 'date' => '2020', 'text' => 'Memutuskan untuk melangkah lebih serius dan saling mengenal keluarga.'],
                ['title' => 'LAMARAN', 'date' => '2023', 'text' => 'Mengikat janji di depan orang tua dalam prosesi lamaran yang khidmat.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-12/images/image_5.jpg'),
                asset('assets/templates/wedding-12/images/image_6.jpg'),
                asset('assets/templates/wedding-12/images/image_7.jpg'),
                asset('assets/templates/wedding-12/images/image_8.jpg'),
                asset('assets/templates/wedding-12/images/image_9.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-12/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => $coverUrl,
            'bride' => $coverUrl,
        ];
    } else {
        $couple = [
            'groom' => 'Raden Wijaya',
            'bride' => 'Ajeng Sekar Wangi',
            'parents' => [
                'groom' => 'Bapak Kunto Wibowo & Ibu Ratna Sari',
                'bride' => 'Bapak Heru Prasetyo & Ibu Maya Indah',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-24',
            'time' => '08:00',
            'location' => 'Masjid Agung Al-Mabrur',
            'address' => 'Jl. Kebangsaan No. 45, Yogyakarta',
            'maps_url' => 'https://maps.google.com/?q=Masjid+Agung+Al-Mabrur+Yogyakarta',
        ];

        $schedule = [
            ['title' => 'AKAD NIKAH', 'time' => '08:00 - 10:00 WIB', 'note' => 'Masjid Agung Al-Mabrur, Yogyakarta'],
            ['title' => 'RESEPSI', 'time' => '11:00 - 14:00 WIB', 'note' => 'Dalem Kalitan, Jl. Gajah Mada No. 12, Surakarta'],
        ];

        $stories = [
            ['title' => 'PERTEMUAN', 'date' => '2018', 'text' => 'Pertama kali bertemu di kampus seni, berbagi mimpi yang sama.'],
            ['title' => 'PENGIKAT HATI', 'date' => '2020', 'text' => 'Memutuskan untuk melangkah lebih serius dan saling mengenal keluarga.'],
            ['title' => 'LAMARAN', 'date' => '2023', 'text' => 'Mengikat janji di depan orang tua dalam prosesi lamaran yang khidmat.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-12/images/image_5.jpg'),
            asset('assets/templates/wedding-12/images/image_6.jpg'),
            asset('assets/templates/wedding-12/images/image_7.jpg'),
            asset('assets/templates/wedding-12/images/image_8.jpg'),
            asset('assets/templates/wedding-12/images/image_9.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-12/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-12/images/image_1.jpg'),
            'bride' => asset('assets/templates/wedding-12/images/image_1.jpg'),
        ];
    }
@endphp
<!DOCTYPE html>
<html class="dark" lang="id"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>{{ $couple['groom'] }} &amp; {{ $couple['bride'] }} - Undangan Digital Pernikahan</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Montserrat:wght@400;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#4e4843",
                    "surface-container-lowest": "#110e07",
                    "on-secondary-container": "#bfb7b0",
                    "on-primary-fixed": "#241a00",
                    "secondary": "#cec5be",
                    "surface-container": "#231f17",
                    "on-error-container": "#ffdad6",
                    "on-tertiary-fixed-variant": "#27438a",
                    "primary-fixed-dim": "#e9c349",
                    "on-primary-fixed-variant": "#574500",
                    "burnished-gold": "#B8860B",
                    "inverse-surface": "#eae1d4",
                    "surface-dim": "#16130b",
                    "surface-container-low": "#1f1b13",
                    "surface-container-high": "#2d2a21",
                    "tertiary-fixed": "#dbe1ff",
                    "on-secondary": "#34302b",
                    "on-tertiary": "#082b72",
                    "tertiary": "#bfcdff",
                    "royal-sepia": "#3D2B1F",
                    "primary-fixed": "#ffe088",
                    "surface-tint": "#e9c349",
                    "on-secondary-fixed": "#1f1b17",
                    "on-tertiary-container": "#254188",
                    "antique-cream": "#F5EFE1",
                    "on-error": "#690005",
                    "inverse-primary": "#735c00",
                    "surface-container-highest": "#38342b",
                    "tertiary-container": "#97b0ff",
                    "secondary-fixed": "#eae1da",
                    "on-primary-container": "#554300",
                    "error": "#ffb4ab",
                    "tertiary-fixed-dim": "#b4c5ff",
                    "on-primary": "#3c2f00",
                    "outline-variant": "#4d4635",
                    "on-surface-variant": "#d0c5af",
                    "outline": "#99907c",
                    "error-container": "#93000a",
                    "on-secondary-fixed-variant": "#4b4641",
                    "primary-container": "#d4af37",
                    "on-background": "#eae1d4",
                    "primary": "#f2ca50",
                    "on-tertiary-fixed": "#00174b",
                    "secondary-fixed-dim": "#cec5be",
                    "deep-black": "#0D0C0B",
                    "on-surface": "#eae1d4",
                    "background": "#16130b",
                    "surface": "#16130b",
                    "surface-bright": "#3d392f",
                    "surface-variant": "#38342b",
                    "inverse-on-surface": "#343027"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "spacing": {
                    "ornament-buffer": "2rem",
                    "section-gap": "5rem",
                    "container-padding": "1.5rem",
                    "element-margin": "1rem"
            },
            "fontFamily": {
                    "headline-lg-mobile": ["Playfair Display"],
                    "headline-lg": ["Playfair Display"],
                    "body-md": ["Montserrat"],
                    "section-title": ["Playfair Display"],
                    "body-lg": ["Montserrat"],
                    "display-wedding": ["Playfair Display"],
                    "label-caps": ["Montserrat"]
            },
            "fontSize": {
                    "headline-lg-mobile": ["28px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "section-title": ["24px", {"lineHeight": "1.4", "letterSpacing": "0.1em", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "display-wedding": ["48px", {"lineHeight": "1.2", "letterSpacing": "0.02em", "fontWeight": "700"}],
                    "label-caps": ["12px", {"lineHeight": "1.2", "letterSpacing": "0.2em", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #0D0C0B;
            color: #eae1d4;
            scroll-behavior: smooth;
        }
        
        /* Batik Pattern Watermark Overlay */
        .batik-overlay {
            background-image: url("https://www.transparenttextures.com/patterns/batik-ideal.png"); /* Representative batik-like pattern */
            opacity: 0.03;
            pointer-events: none;
        }

        .javanese-border {
            border-image: linear-gradient(to right, transparent, #B8860B, transparent) 1;
        }
        .gold-glow {
            text-shadow: 0 0 10px rgba(184, 134, 11, 0.5);
        }
        .ornament-rotate {
            animation: rotate 20s linear infinite;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Floating Gold Dust Effect */
        .gold-dust {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #0D0C0B; }
        ::-webkit-scrollbar-thumb { background: #B8860B; }

        .reveal {
            opacity: 0;
            transition: all 1.2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal.fade-up { transform: translateY(40px); }
        .reveal.fade-in { transform: scale(0.95); }
        .reveal.zoom-in { transform: scale(0.9); }
        .reveal.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .delay-100 { transition-delay: 100ms; }
        .delay-200 { transition-delay: 200ms; }
        .delay-300 { transition-delay: 300ms; }
        .delay-400 { transition-delay: 400ms; }
        .delay-500 { transition-delay: 500ms; }

        .music-pulse {
            animation: music-pulse 2s infinite;
        }
        @keyframes music-pulse {
            0% { box-shadow: 0 0 0 0 rgba(184, 134, 11, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(184, 134, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(184, 134, 11, 0); }
        }

        /* Gunungan SVG Positioning */
        .gunungan-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 600px;
            opacity: 0.1;
            z-index: -1;
        }

        /* Corner Carvings */
        .corner-ukiran {
            position: absolute;
            width: 40px;
            height: 40px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.6;
            pointer-events: none;
        }
        .ukiran-tl { top: 10px; left: 10px; transform: rotate(0deg); }
        .ukiran-tr { top: 10px; right: 10px; transform: rotate(90deg); }
        .ukiran-bl { bottom: 10px; left: 10px; transform: rotate(270deg); }
        .ukiran-br { bottom: 10px; right: 10px; transform: rotate(180deg); }

        .svg-ukiran { fill: #B8860B; }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #B8860B;
            border-radius: 2px;
        }
    </style>
</head>
<body class="font-body-md text-body-md overflow-x-hidden bg-zinc-950">

<div class="max-w-[480px] w-full mx-auto bg-deep-black min-h-screen relative shadow-[0_0_50px_rgba(0,0,0,0.8)] border-x border-burnished-gold/20 flex flex-col pb-24 md:pb-6">
    <!-- GOLD DUST PARTICLES -->
    <div class="gold-dust opacity-20"></div>
    <audio id="weddingMusic" loop="">
        <source src="https://invite.leafitation.com/wp-content/uploads/2026/01/Jawa-03-Niken-Salindry-KUSUMA-WIJAYA.mp3" type="audio/mpeg"/>
    </audio>

    <!-- MUSIC & SCROLL CONTROL FLOATING BUTTONS -->
    <button class="fixed bottom-24 right-6 md:right-[calc(50vw-240px+24px)] z-[70] w-12 h-12 rounded-full bg-burnished-gold text-deep-black shadow-lg flex items-center justify-center transition-all duration-300 music-pulse hidden border border-primary/50" id="musicToggle" onclick="toggleMusic()">
        <span class="material-symbols-outlined" id="musicIcon">volume_up</span>
    </button>
    <button class="fixed bottom-40 right-6 md:right-[calc(50vw-240px+24px)] z-[70] w-12 h-12 rounded-full bg-burnished-gold text-deep-black shadow-lg flex items-center justify-center transition-all duration-300 hidden border border-primary/50" id="autoscrollToggle" onclick="toggleAutoscroll()">
        <span class="material-symbols-outlined" id="floatAutoscrollIcon">play_arrow</span>
    </button>

    <!-- COVER SECTION -->
    <section class="relative h-screen w-full flex flex-col items-center justify-center overflow-hidden z-[60]" id="cover">
        <div class="absolute inset-0 z-0">
            <img alt="Javanese royal pre-wedding" class="w-full h-full object-cover opacity-40" src="{{ $bg['cover'] }}"/>
            <div class="absolute inset-0 bg-gradient-to-b from-deep-black via-transparent to-deep-black"></div>
            <!-- Gunungan Watermark -->
            <svg class="gunungan-bg svg-ukiran" viewbox="0 0 100 150" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 0 L100 120 L80 120 L80 150 L20 150 L20 120 L0 120 Z M50 20 L20 110 L80 110 Z"></path>
            </svg>
        </div>
        <div class="relative z-10 text-center px-6 space-y-6">
            <p class="reveal fade-up font-label-caps text-label-caps text-primary tracking-[0.3em] active">THE WEDDING OF</p>
            <h1 class="reveal fade-up delay-200 font-display-wedding text-display-wedding text-primary gold-glow active">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            <div class="reveal fade-up delay-300 py-8 active">
                <p class="font-body-md text-on-surface-variant italic mb-2">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <h2 class="font-section-title text-section-title text-antique-cream border-b border-burnished-gold/30 pb-2 inline-block px-4">{{ request()->get('kpd', 'Tamu Undangan') }}</h2>
            </div>
            <button class="reveal fade-up delay-500 group relative px-10 py-4 bg-antique-cream text-deep-black font-label-caps text-label-caps border border-burnished-gold transition-all duration-500 hover:bg-transparent hover:text-primary active:scale-95 shadow-[0_0_20px_rgba(184,134,11,0.3)] active" onclick="openInvitation()">
                <span class="relative z-10">BUKA UNDANGAN</span>
                <div class="absolute inset-0 bg-burnished-gold opacity-0 group-hover:opacity-10 transition-opacity"></div>
            </button>
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 opacity-30 animate-bounce">
            <span class="material-symbols-outlined text-primary text-4xl">expand_more</span>
        </div>
    </section>

    <!-- TOP NAVIGATION -->
    <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 bg-deep-black/90 backdrop-blur-md border-b border-burnished-gold/20 flex justify-between items-center px-ornament-buffer py-4">
        <div class="font-display-wedding text-primary drop-shadow-[0_2px_2px_rgba(184,134,11,0.5)] text-xl">The Sacred Union</div>
        <div class="flex items-center gap-4">
            <button class="text-primary transition-transform active:scale-95" onclick="toggleMusic()">
                <span class="material-symbols-outlined" id="navMusicIcon">volume_up</span>
            </button>
            <button class="text-primary transition-transform active:scale-95" onclick="toggleAutoscroll()">
                <span class="material-symbols-outlined" id="navAutoscrollIcon">play_arrow</span>
            </button>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative pt-24 pb-section-gap px-container-padding flex flex-col items-center" id="home">
        <div class="max-w-[600px] w-full relative">
            <!-- Background Wayang Shadow -->
            <svg class="absolute -top-20 -left-20 w-40 h-40 opacity-10 svg-ukiran rotate-12" viewbox="0 0 100 100">
                <path d="M50 0 L100 100 L50 70 L0 100 Z"></path>
            </svg>
            <div class="reveal zoom-in aspect-[4/5] overflow-hidden border border-burnished-gold/30 rounded-lg relative shadow-2xl">
                <img alt="Sacred hands ceremony" class="w-full h-full object-cover brightness-75" src="{{ asset('assets/templates/wedding-12/images/image_2.jpg') }}"/>
                <div class="absolute bottom-0 left-0 w-full p-8 bg-gradient-to-t from-deep-black to-transparent">
                    <h3 class="reveal fade-up delay-300 font-section-title text-section-title text-primary">Save the Date</h3>
                    <p class="reveal fade-up delay-400 font-body-md text-antique-cream">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
            <!-- COUNTDOWN TIMER -->
            <div class="mt-element-margin grid grid-cols-4 gap-4 text-center">
                <div class="reveal fade-up delay-100 bg-royal-sepia/80 border border-burnished-gold/50 p-3 backdrop-blur-sm relative overflow-hidden">
                    <div class="batik-overlay absolute inset-0"></div>
                    <div class="font-headline-lg-mobile text-primary relative z-10" id="days">00</div>
                    <div class="font-label-caps text-[10px] text-on-surface-variant relative z-10">HARI</div>
                </div>
                <div class="reveal fade-up delay-200 bg-royal-sepia/80 border border-burnished-gold/50 p-3 backdrop-blur-sm relative overflow-hidden">
                    <div class="batik-overlay absolute inset-0"></div>
                    <div class="font-headline-lg-mobile text-primary relative z-10" id="hours">00</div>
                    <div class="font-label-caps text-[10px] text-on-surface-variant relative z-10">JAM</div>
                </div>
                <div class="reveal fade-up delay-300 bg-royal-sepia/80 border border-burnished-gold/50 p-3 backdrop-blur-sm relative overflow-hidden">
                    <div class="batik-overlay absolute inset-0"></div>
                    <div class="font-headline-lg-mobile text-primary relative z-10" id="minutes">00</div>
                    <div class="font-label-caps text-[10px] text-on-surface-variant relative z-10">MENIT</div>
                </div>
                <div class="reveal fade-up delay-400 bg-royal-sepia/80 border border-burnished-gold/50 p-3 backdrop-blur-sm relative overflow-hidden">
                    <div class="batik-overlay absolute inset-0"></div>
                    <div class="font-headline-lg-mobile text-primary relative z-10" id="seconds">00</div>
                    <div class="font-label-caps text-[10px] text-on-surface-variant relative z-10">DETIK</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CUSTOM SECTION DIVIDER (Javanese Carving Style) -->
    <div class="reveal fade-in flex justify-center py-12 opacity-60">
        <svg fill="none" height="60" viewbox="0 0 400 60" width="400" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 30 C50 30 70 0 100 0 C130 0 150 30 200 30 C250 30 270 60 300 60 C330 60 350 30 400 30" opacity="0.4" stroke="#B8860B" stroke-dasharray="4 4" stroke-width="1.5"></path>
            <path class="svg-ukiran" d="M200 10 L215 30 L200 50 L185 30 Z" fill="#B8860B"></path>
            <path d="M150 30 H250" stroke="#B8860B" stroke-width="1"></path>
            <circle cx="120" cy="30" fill="#B8860B" r="3"></circle>
            <circle cx="280" cy="30" fill="#B8860B" r="3"></circle>
        </svg>
    </div>

    <!-- PROFILE SECTION -->
    <section class="relative px-container-padding pb-section-gap space-y-section-gap max-w-[600px] mx-auto" id="couple">
        <div class="batik-overlay absolute inset-0"></div>
        <div class="reveal fade-up text-center space-y-4 relative z-10">
            <p class="font-body-md italic text-on-surface-variant">"Menciptakan harmoni dalam kesucian janji, menyatukan dua hati dalam ikatan yang abadi."</p>
        </div>
        <div class="space-y-12 relative z-10">
            <!-- GROOM -->
            <div class="text-center group relative p-8 bg-royal-sepia/10 border border-burnished-gold/10 rounded-xl">
                <!-- Corner Ornaments -->
                <div class="corner-ukiran ukiran-tl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-tr"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-bl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-br"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="reveal zoom-in relative inline-block mb-6">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-2 border-burnished-gold p-1">
                        <img alt="Portrait Groom" class="w-full h-full object-cover rounded-full filter grayscale hover:grayscale-0 transition-all duration-700" src="{{ asset('assets/templates/wedding-12/images/image_3.jpg') }}"/>
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-burnished-gold text-deep-black w-10 h-10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined">shield</span>
                    </div>
                </div>
                <div class="reveal fade-up delay-200">
                    <h3 class="font-headline-lg text-primary mb-2">{{ $couple['groom'] }}</h3>
                    <p class="font-body-md text-on-surface-variant">Putra pertama dari</p>
                    <p class="font-body-md font-semibold text-antique-cream">{{ $couple['parents']['groom'] }}</p>
                </div>
            </div>
            <div class="reveal fade-in text-center py-4">
                <span class="font-display-wedding text-primary text-6xl opacity-30">&amp;</span>
            </div>
            <!-- BRIDE -->
            <div class="text-center group relative p-8 bg-royal-sepia/10 border border-burnished-gold/10 rounded-xl">
                <!-- Corner Ornaments -->
                <div class="corner-ukiran ukiran-tl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-tr"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-bl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-br"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="reveal zoom-in relative inline-block mb-6">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-2 border-burnished-gold p-1">
                        <img alt="Portrait Bride" class="w-full h-full object-cover rounded-full filter grayscale hover:grayscale-0 transition-all duration-700" src="{{ asset('assets/templates/wedding-12/images/image_4.jpg') }}"/>
                    </div>
                    <div class="absolute -bottom-2 -left-2 bg-burnished-gold text-deep-black w-10 h-10 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined">favorite</span>
                    </div>
                </div>
                <div class="reveal fade-up delay-200">
                    <h3 class="font-headline-lg text-primary mb-2">{{ $couple['bride'] }}</h3>
                    <p class="font-body-md text-on-surface-variant">Putri kedua dari</p>
                    <p class="font-body-md font-semibold text-antique-cream">{{ $couple['parents']['bride'] }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- EVENT SECTION -->
    <section class="relative px-container-padding pb-section-gap bg-royal-sepia/20 py-20" id="event">
        <div class="batik-overlay absolute inset-0"></div>
        <div class="max-w-[600px] mx-auto space-y-element-margin relative z-10">
            <h2 class="reveal fade-up font-section-title text-section-title text-center text-primary mb-10">Agenda Suci</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- AKAD -->
                <div class="reveal fade-up delay-100 bg-royal-sepia border border-burnished-gold/40 p-8 text-center space-y-4 rounded-lg relative overflow-hidden group">
                    <!-- Corner Ornaments -->
                    <div class="corner-ukiran ukiran-tl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                    <div class="corner-ukiran ukiran-br"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                    <div class="absolute top-0 right-0 w-16 h-16 opacity-10">
                        <span class="material-symbols-outlined text-primary text-6xl">menu_book</span>
                    </div>
                    <h4 class="font-label-caps text-label-caps text-primary border-b border-burnished-gold/20 pb-2">{{ $schedule[0]['title'] }}</h4>
                    <div class="space-y-1">
                        <p class="font-body-lg font-bold text-antique-cream">{{ $schedule[0]['time'] }}</p>
                        <p class="font-body-md text-on-surface-variant">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="pt-4 space-y-1">
                        <p class="font-body-md font-semibold text-primary">{{ $schedule[0]['note'] }}</p>
                        <p class="font-body-md text-xs text-on-surface-variant">{{ $event['address'] }}</p>
                    </div>
                    <a class="mt-4 inline-flex items-center space-x-2 text-primary border border-primary/30 px-4 py-2 hover:bg-primary hover:text-deep-black transition-colors" href="{{ $event['maps_url'] }}" target="_blank">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span class="text-xs font-label-caps">BUKA GOOGLE MAPS</span>
                    </a>
                </div>
                <!-- RESEPSI -->
                <div class="reveal fade-up delay-300 bg-royal-sepia border border-burnished-gold/40 p-8 text-center space-y-4 rounded-lg relative overflow-hidden group">
                    <!-- Corner Ornaments -->
                    <div class="corner-ukiran ukiran-tl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                    <div class="corner-ukiran ukiran-br"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                    <div class="absolute top-0 right-0 w-16 h-16 opacity-10">
                        <span class="material-symbols-outlined text-primary text-6xl">celebration</span>
                    </div>
                    <h4 class="font-label-caps text-label-caps text-primary border-b border-burnished-gold/20 pb-2">{{ $schedule[1]['title'] }}</h4>
                    <div class="space-y-1">
                        <p class="font-body-lg font-bold text-antique-cream">{{ $schedule[1]['time'] }}</p>
                        <p class="font-body-md text-on-surface-variant">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div class="pt-4 space-y-1">
                        <p class="font-body-md font-semibold text-primary">{{ $schedule[1]['note'] }}</p>
                        <p class="font-body-md text-xs text-on-surface-variant">{{ $event['address'] }}</p>
                    </div>
                    <a class="mt-4 inline-flex items-center space-x-2 text-primary border border-primary/30 px-4 py-2 hover:bg-primary hover:text-deep-black transition-colors" href="{{ $event['maps_url'] }}" target="_blank">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span class="text-xs font-label-caps">BUKA GOOGLE MAPS</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STORY TIMELINE -->
    <section class="px-container-padding py-section-gap max-w-[600px] mx-auto" id="story">
        <h2 class="reveal fade-up font-section-title text-section-title text-center text-primary mb-12">Kisah Kami</h2>
        <div class="relative">
            <div class="absolute left-1/2 -translate-x-1/2 h-full w-[1px] bg-burnished-gold/30"></div>
            <div class="space-y-16">
                @foreach($stories as $index => $s)
                <div class="reveal fade-up delay-{{ ($index + 1) * 100 }} relative flex flex-col items-center">
                    <div class="w-10 h-10 bg-royal-sepia border border-burnished-gold rounded-full z-10 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-primary text-sm">
                            @if($index == 0) school @elseif($index == 1) favorite @else diamond @endif
                        </span>
                    </div>
                    <div class="bg-royal-sepia/40 border border-burnished-gold/20 p-6 text-center w-full max-w-[280px] relative">
                        <div class="batik-overlay absolute inset-0"></div>
                        <h5 class="font-label-caps text-primary text-xs mb-2 relative z-10">{{ $s['date'] }} - {{ strtoupper($s['title']) }}</h5>
                        <p class="text-xs text-on-surface-variant relative z-10">{{ $s['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- GALLERY SECTION -->
    <section class="px-container-padding pb-section-gap max-w-[800px] mx-auto" id="gallery">
        <h2 class="reveal fade-up font-section-title text-section-title text-center text-primary mb-10">Galeri Foto</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($gallery as $index => $img)
                @if($index == 1)
                <div class="reveal zoom-in delay-200 aspect-[3/4] overflow-hidden border border-burnished-gold/20 shadow-lg group row-span-2 relative">
                    <img alt="Gallery 2" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 cursor-zoom-in filter grayscale hover:grayscale-0" src="{{ $img }}" onclick="openLightbox(this.src)"/>
                </div>
                @else
                <div class="reveal zoom-in delay-{{ ($index + 1) * 100 }} aspect-square overflow-hidden border border-burnished-gold/20 shadow-lg group relative">
                    <img alt="Gallery {{ $index + 1 }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 cursor-zoom-in filter grayscale hover:grayscale-0" src="{{ $img }}" onclick="openLightbox(this.src)"/>
                </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- RSVP & GUESTBOOK -->
    <section class="px-container-padding py-20 bg-deep-black relative overflow-hidden" id="rsvp">
        <div class="batik-overlay absolute inset-0"></div>
        <div class="max-w-[600px] mx-auto relative z-10">
            <h2 class="reveal fade-up font-section-title text-section-title text-center text-primary mb-8">Konfirmasi Kehadiran</h2>
            <div class="reveal fade-up delay-200 bg-royal-sepia/30 border border-burnished-gold/20 p-8 rounded-lg relative">
                <!-- Corner Ornaments -->
                <div class="corner-ukiran ukiran-tl"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <div class="corner-ukiran ukiran-tr"><svg class="svg-ukiran" viewbox="0 0 100 100"><path d="M0 0 L100 0 L0 100 Z"></path></svg></div>
                <form class="space-y-6" id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div class="reveal fade-up delay-300 space-y-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant block">NAMA LENGKAP</label>
                        <input id="nama" class="w-full bg-transparent border-0 border-b border-antique-cream focus:ring-0 focus:border-primary text-antique-cream placeholder:text-on-surface-variant/30 outline-none" placeholder="Masukkan nama Anda" type="text" required/>
                    </div>
                    <div class="reveal fade-up delay-400 space-y-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant block">JUMLAH TAMU</label>
                        <select id="jumlah_tamu" class="w-full bg-transparent border-0 border-b border-antique-cream focus:ring-0 focus:border-primary text-antique-cream outline-none">
                            <option class="bg-deep-black" value="1 Orang">1 Orang</option>
                            <option class="bg-deep-black" value="2 Orang">2 Orang</option>
                        </select>
                    </div>
                    <div class="reveal fade-up delay-500 space-y-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant block">STATUS KEHADIRAN</label>
                        <div class="flex space-x-6 pt-2">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input class="text-primary focus:ring-primary bg-transparent border-primary" name="status" type="radio" checked/>
                                <span class="text-sm text-antique-cream">Hadir</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input class="text-primary focus:ring-primary bg-transparent border-primary" name="status" type="radio"/>
                                <span class="text-sm text-antique-cream">Berhalangan</span>
                            </label>
                        </div>
                    </div>
                    <div class="reveal fade-up delay-600 space-y-2">
                        <label class="font-label-caps text-label-caps text-on-surface-variant block">UCAPAN &amp; DOA</label>
                        <textarea id="pesan" class="w-full bg-transparent border-0 border-b border-antique-cream focus:ring-0 focus:border-primary text-antique-cream placeholder:text-on-surface-variant/30 outline-none" placeholder="Tuliskan ucapan untuk mempelai" rows="3" required></textarea>
                    </div>
                    <button class="reveal fade-in delay-700 w-full py-4 bg-primary text-deep-black font-label-caps text-label-caps hover:bg-antique-cream transition-colors duration-300" type="submit">KIRIM KONFIRMASI</button>
                </form>
                <div id="wishList" class="reveal fade-up delay-300 mt-12 space-y-4 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                    <div class="border-l border-primary/40 pl-4 py-2">
                        <p class="text-xs font-bold text-primary">Siti Aminah</p>
                        <p class="text-[10px] text-on-surface-variant mb-1">2 jam yang lalu • Hadir</p>
                        <p class="text-xs text-antique-cream italic">"Selamat menempuh hidup baru {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}! Semoga berkah dan bahagia selalu."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WEDDING GIFT -->
    <section class="relative px-container-padding py-section-gap" id="gift">
        <div class="batik-overlay absolute inset-0"></div>
        <div class="max-w-[600px] mx-auto text-center space-y-10 relative z-10">
            <div class="reveal fade-up space-y-4">
                <h2 class="font-section-title text-section-title text-primary">Kado Digital</h2>
                <p class="font-body-md text-on-surface-variant">Doa restu Anda adalah karunia terindah.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="reveal fade-up delay-100 bg-royal-sepia/40 border border-burnished-gold/30 p-8 rounded-lg space-y-4 group relative overflow-hidden">
                    <div class="text-primary font-bold text-xl tracking-widest">BANK BCA</div>
                    <p class="font-body-lg text-antique-cream tracking-widest">8830123456</p>
                    <p class="text-sm font-semibold text-primary">a.n {{ $couple['groom'] }}</p>
                    <button class="w-full py-2 border border-primary/30 text-primary text-[10px] font-label-caps hover:bg-primary hover:text-deep-black transition-all" onclick="copyToClipboard('8830123456')">SALIN</button>
                </div>
                <div class="reveal fade-up delay-200 bg-royal-sepia/40 border border-burnished-gold/30 p-8 rounded-lg space-y-4 group relative overflow-hidden">
                    <div class="text-primary font-bold text-xl tracking-widest">BANK MANDIRI</div>
                    <p class="font-body-lg text-antique-cream tracking-widest">1370001234567</p>
                    <p class="text-sm font-semibold text-primary">a.n {{ $couple['bride'] }}</p>
                    <button class="w-full py-2 border border-primary/30 text-primary text-[10px] font-label-caps hover:bg-primary hover:text-deep-black transition-all" onclick="copyToClipboard('1370001234567')">SALIN</button>
                </div>
            </div>
            <div class="reveal fade-in delay-400 pt-6">
                <p class="font-body-md text-antique-cream italic opacity-80">Matur Nuwun</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-deep-black relative overflow-hidden w-full py-section-gap border-t border-burnished-gold/20 flex flex-col items-center justify-center space-y-element-margin pb-28 md:pb-12">
        <div class="batik-overlay absolute inset-0"></div>
        <div class="reveal fade-up font-display-wedding text-primary text-3xl relative z-10">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</div>
        <p class="reveal fade-up delay-200 font-section-title text-section-title text-center text-primary relative z-10">Matur Nuwun</p>
        <div class="reveal fade-in delay-300 flex flex-col items-center space-y-2 opacity-60 relative z-10">
            <p class="text-xs font-label-caps text-on-surface-variant">KELUARGA BESAR BAPAK &amp; IBU</p>
        </div>
        <!-- Spacer to prevent content from being covered by bottom nav bar -->
        <div class="h-24 relative z-10"></div>
        <div class="absolute -bottom-10 opacity-5">
            <span class="material-symbols-outlined text-[200px] text-primary ornament-rotate">ac_unit</span>
        </div>
    </footer>

    <!-- MOBILE NAVIGATION BAR -->
    <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 flex justify-around items-center px-4 py-3 pb-6 backdrop-blur-md bg-deep-black/90 shadow-[0_-4px_20px_rgba(184,134,11,0.2)] rounded-t-full border-t border-burnished-gold/30">
        <a class="flex flex-col items-center justify-center text-primary font-bold scale-110 active:scale-90 transition-transform" href="#home">
            <span class="material-symbols-outlined">home</span>
            <span class="font-label-caps text-[8px] mt-1">BERANDA</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant/70 hover:text-primary transition-all duration-300" href="#couple">
            <span class="material-symbols-outlined">favorite</span>
            <span class="font-label-caps text-[8px] mt-1">PASANGAN</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant/70 hover:text-primary transition-all duration-300" href="#event">
            <span class="material-symbols-outlined">event</span>
            <span class="font-label-caps text-[8px] mt-1">ACARA</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant/70 hover:text-primary transition-all duration-300" href="#gallery">
            <span class="material-symbols-outlined">photo_library</span>
            <span class="font-label-caps text-[8px] mt-1">GALERI</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant/70 hover:text-primary transition-all duration-300" href="#rsvp">
            <span class="material-symbols-outlined">mail</span>
            <span class="font-label-caps text-[8px] mt-1">RSVP</span>
        </a>
    </nav>
</div>

<!-- LIGHTBOX MODAL -->
<div id="lightboxModal" class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center hidden opacity-0 transition-opacity duration-300 pointer-events-none" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 text-white text-3xl font-bold">&times;</button>
    <img id="lightboxImg" class="max-w-[90%] max-h-[85vh] object-contain rounded border border-burnished-gold/30" src="" alt="Preview"/>
</div>

<script>
        // Music Logic
        const music = document.getElementById('weddingMusic');
        const musicToggle = document.getElementById('musicToggle');
        const musicIcon = document.getElementById('musicIcon');
        const navMusicIcon = document.getElementById('navMusicIcon');
        let isPlaying = false;

        function openInvitation() {
            document.getElementById('cover').style.display = 'none';
            document.body.style.overflow = 'auto';
            musicToggle.classList.remove('hidden');
            document.getElementById('autoscrollToggle').classList.remove('hidden');
            playMusic();
            startAutoscroll();
        }

        function playMusic() {
            music.play().then(() => {
                isPlaying = true;
                updateMusicIcons();
            }).catch(err => console.log("Audio play failed:", err));
        }

        function toggleMusic() {
            if (isPlaying) {
                music.pause();
                isPlaying = false;
            } else {
                music.play();
                isPlaying = true;
            }
            updateMusicIcons();
        }

        function updateMusicIcons() {
            const icon = isPlaying ? 'volume_up' : 'volume_off';
            musicIcon.textContent = icon;
            navMusicIcon.textContent = icon;
            if (isPlaying) {
                musicToggle.classList.add('music-pulse');
            } else {
                musicToggle.classList.remove('music-pulse');
            }
        }

        // Autoscroll Logic
        let isAutoscrolling = false;
        let autoscrollSpeed = 0.5;

        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            const currentScroll = window.innerHeight + window.pageYOffset;
            const bottomLimit = document.documentElement.scrollHeight - 5;
            if (currentScroll >= bottomLimit) {
                stopAutoscroll();
                return;
            }
            requestAnimationFrame(scrollStep);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            updateAutoscrollIcons();
            requestAnimationFrame(scrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            updateAutoscrollIcons();
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) {
                stopAutoscroll();
            } else {
                startAutoscroll();
            }
        }

        function updateAutoscrollIcons() {
            const icon = isAutoscrolling ? 'pause' : 'play_arrow';
            document.getElementById('navAutoscrollIcon').textContent = icon;
            document.getElementById('floatAutoscrollIcon').textContent = icon;
        }

        // Stop autoscroll on manual user scroll
        ['wheel', 'touchstart', 'touchmove'].forEach(evt => {
            window.addEventListener(evt, () => {
                if (isAutoscrolling) {
                    stopAutoscroll();
                }
            }, { passive: true });
        });

        // Lightbox Modal functions
        function openLightbox(src) {
            const modal = document.getElementById('lightboxModal');
            const img = document.getElementById('lightboxImg');
            img.src = src;
            modal.classList.remove('hidden');
            modal.classList.remove('pointer-events-none');
            setTimeout(() => {
                modal.classList.add('opacity-100');
            }, 10);
            if (isAutoscrolling) stopAutoscroll();
        }

        function closeLightbox() {
            const modal = document.getElementById('lightboxModal');
            modal.classList.remove('opacity-100');
            modal.classList.add('pointer-events-none');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Reveal Intersection Observer
        const observerOptions = {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            reveals.forEach(el => observer.observe(el));
            document.body.style.overflow = 'hidden';

            // Subtle Gold Particle Effect
            const goldDust = document.querySelector('.gold-dust');
            for(let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute bg-burnished-gold rounded-full opacity-50';
                const size = Math.random() * 3 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.animation = `float ${Math.random() * 10 + 10}s linear infinite`;
                goldDust.appendChild(particle);
            }
        });

        // Floating animation for particles
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes float {
                0% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0; }
                10% { opacity: 0.5; }
                90% { opacity: 0.5; }
                100% { transform: translateY(-100vh) translateX(50px) rotate(360deg); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        // Countdown Timer Logic
        const weddingDate = new Date("{{ $event['date_iso'] }}T{{ $event['time'] }}:00").getTime();
        const updateTimer = setInterval(function() {
            const now = new Date().getTime();
            const distance = weddingDate - now;
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById("days").innerHTML = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerHTML = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerHTML = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerHTML = seconds < 10 ? "0" + seconds : seconds;
            
            if (distance < 0) {
                clearInterval(updateTimer);
                document.getElementById("days").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
            }
        }, 1000);

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert("Nomor rekening berhasil disalin: " + text);
            });
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const status = document.querySelector('input[name="status"]:checked')?.nextElementSibling?.textContent || 'Hadir';
            const msg = document.getElementById('pesan').value;
            const card = document.createElement('div');
            card.className = 'border-l border-primary/40 pl-4 py-2';
            card.innerHTML = `<p class="text-xs font-bold text-primary">${name}</p><p class="text-[10px] text-on-surface-variant mb-1">Baru saja • ${status}</p><p class="text-xs text-antique-cream italic">"${msg}"</p>`;
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("Konfirmasi kehadiran berhasil dikirim!");
        }

        // Active Nav Logic
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('nav a');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('text-primary', 'font-bold', 'scale-110');
                link.classList.add('text-on-surface-variant/70');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('text-primary', 'font-bold', 'scale-110');
                    link.classList.remove('text-on-surface-variant/70');
                }
            });
        });
    </script>
</body></html>