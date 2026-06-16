@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Arya');
        $brideName = trim($names[1] ?? 'Naurah');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Ir. Gunawan & Ibu Ratna',
                'bride' => 'Bpk. H. Ahmad & Ibu Hj. Siti',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-06-15',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'The Grand Ballroom, Mulia Senayan',
            'address' => $invitation->address ?? 'The Grand Ballroom, Mulia Senayan, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Grand Ballroom, Mulia Senayan, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Masjid Agung Al-Azhar, Jakarta Selatan'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '19:00 - Selesai',
                'note' => $invitation->address ?? 'The Grand Ballroom, Mulia Senayan, Jakarta'
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
                ['title' => 'Pertemuan Pertama', 'date' => 'Agustus 2021', 'text' => 'Tak sengaja bertemu di sebuah galeri seni, berawal dari diskusi tentang lukisan klasik.'],
                ['title' => 'Lamaran', 'date' => 'Januari 2023', 'text' => 'Di bawah pendar lampu kota, kami memutuskan untuk melangkah ke jenjang yang lebih serius.'],
                ['title' => 'Selamanya', 'date' => 'Juni 2024', 'text' => 'Hari ini, kami mengukir janji untuk menua bersama dalam cinta yang abadi.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-25/images/image_11.jpg'),
                asset('assets/templates/wedding-25/images/image_12.jpg'),
                asset('assets/templates/wedding-25/images/image_13.jpg'),
                asset('assets/templates/wedding-25/images/image_14.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-25/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'cover_circle' => asset('assets/templates/wedding-25/images/image_2.jpg'),
            'cover_small' => asset('assets/templates/wedding-25/images/image_3.jpg'),
            'groom' => asset('assets/templates/wedding-25/images/image_4.jpg'),
            'bride' => asset('assets/templates/wedding-25/images/image_5.jpg'),
            'akad' => asset('assets/templates/wedding-25/images/image_6.jpg'),
            'resepsi' => asset('assets/templates/wedding-25/images/image_7.jpg'),
            'story_1' => asset('assets/templates/wedding-25/images/image_8.jpg'),
            'story_2' => asset('assets/templates/wedding-25/images/image_9.jpg'),
            'story_3' => asset('assets/templates/wedding-25/images/image_10.jpg'),
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
                ['name' => 'Sahabat Naurah', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Naurah & Arya! Semoga sakinah mawaddah warahmah.'],
                ['name' => 'Keluarga Besar Arya', 'status' => 'Hadir', 'message' => 'Bahagia selalu ya kalian berdua, ditunggu kabar baik selanjutnya!'],
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
                ['bank' => 'BCA', 'name' => 'Naurah Al-Zahra', 'account' => '123 456 7890'],
                ['bank' => 'Mandiri', 'name' => 'Arya Pratama', 'account' => '098 765 4321'],
            ];
        }
    } else {
        // FALLBACK / DEMO
        $couple = [
            'groom' => 'Arya',
            'bride' => 'Naurah',
            'parents' => [
                'groom' => 'Bpk. Ir. Gunawan & Ibu Ratna',
                'bride' => 'Bpk. H. Ahmad & Ibu Hj. Siti',
            ],
        ];

        $event = [
            'date_iso' => '2024-06-15',
            'time' => '08:00',
            'location' => 'The Grand Ballroom, Mulia Senayan',
            'address' => 'The Grand Ballroom, Mulia Senayan, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=Hotel+Mulia+Senayan',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'Masjid Agung Al-Azhar, Jakarta Selatan'],
            ['title' => 'Resepsi Pernikahan', 'time' => '19:00 - Selesai', 'note' => 'The Grand Ballroom, Mulia Senayan, Jakarta'],
        ];

        $stories = [
            ['title' => 'Pertemuan Pertama', 'date' => 'Agustus 2021', 'text' => 'Tak sengaja bertemu di sebuah galeri seni, berawal dari diskusi tentang lukisan klasik.'],
            ['title' => 'Lamaran', 'date' => 'Januari 2023', 'text' => 'Di bawah pendar lampu kota, kami memutuskan untuk melangkah ke jenjang yang lebih serius.'],
            ['title' => 'Selamanya', 'date' => 'Juni 2024', 'text' => 'Hari ini, kami mengukir janji untuk menua bersama dalam cinta yang abadi.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-25/images/image_11.jpg'),
            asset('assets/templates/wedding-25/images/image_12.jpg'),
            asset('assets/templates/wedding-25/images/image_13.jpg'),
            asset('assets/templates/wedding-25/images/image_14.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-25/images/image_1.jpg'),
            'cover_circle' => asset('assets/templates/wedding-25/images/image_2.jpg'),
            'cover_small' => asset('assets/templates/wedding-25/images/image_3.jpg'),
            'groom' => asset('assets/templates/wedding-25/images/image_4.jpg'),
            'bride' => asset('assets/templates/wedding-25/images/image_5.jpg'),
            'akad' => asset('assets/templates/wedding-25/images/image_6.jpg'),
            'resepsi' => asset('assets/templates/wedding-25/images/image_7.jpg'),
            'story_1' => asset('assets/templates/wedding-25/images/image_8.jpg'),
            'story_2' => asset('assets/templates/wedding-25/images/image_9.jpg'),
            'story_3' => asset('assets/templates/wedding-25/images/image_10.jpg'),
        ];

        $wishes = [
            ['name' => 'Sahabat Naurah', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Naurah & Arya! Semoga sakinah mawaddah warahmah.'],
            ['name' => 'Keluarga Besar Arya', 'status' => 'Hadir', 'message' => 'Bahagia selalu ya kalian berdua, ditunggu kabar baik selanjutnya!'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Naurah Al-Zahra', 'account' => '123 456 7890'],
            ['bank' => 'Mandiri', 'name' => 'Arya Pratama', 'account' => '098 765 4321'],
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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400&amp;family=Space+Grotesk:wght@600&amp;family=Manrope:wght@400;600&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00003c",
                        "primary-container": "#000080",
                        "gold-foil": "#D4AF37",
                        "midnight-tint": "#000066",
                        "ink-black": "#00001A",
                        "surface": "#fbf8ff",
                        "surface-container": "#efecf6",
                        "surface-container-high": "#eae7f0",
                        "surface-container-highest": "#e4e1eb",
                        "surface-container-low": "#f5f2fc",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#1b1b22",
                        "on-surface-variant": "#464653",
                        "paper-white": "#FAFAFA",
                        "secondary": "#5d5f5f",
                        "secondary-fixed-dim": "#c6c6c7",
                        "outline": "#767684",
                        "outline-variant": "#c6c5d5"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "stack-offset": "40px",
                        "gutter": "16px",
                        "section-gap": "120px",
                        "content-margin": "24px"
                    },
                    fontFamily: {
                        "label-caps": ["Space Grotesk"],
                        "body-md": ["Manrope"],
                        "body-lg": ["Manrope"],
                        "display-grand-mobile": ["Playfair Display"],
                        "display-grand": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "script-accent": ["Playfair Display"]
                    },
                    fontSize: {
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.15em", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-grand-mobile": ["48px", {"lineHeight": "52px", "letterSpacing": "-0.01em", "fontWeight": "900"}],
                        "display-grand": ["84px", {"lineHeight": "90px", "letterSpacing": "-0.02em", "fontWeight": "900"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "script-accent": ["42px", {"lineHeight": "1.2", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        body { overflow-x: hidden; }
        .gold-border { border: 1px solid #D4AF37; }
        .gold-gradient { background: linear-gradient(135deg, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C); }
        .gold-text-gradient {
            background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728, #FBF5B7, #AA771C);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .paper-texture {
            background-image: url("https://www.transparenttextures.com/patterns/felt.png");
        }
        .ornament-corner {
            position: absolute;
            width: 50px;
            height: 50px;
            border: 2px solid #D4AF37;
            pointer-events: none;
            z-index: 10;
        }
        .ornament-corner-tl { top: 12px; left: 12px; border-right: 0; border-bottom: 0; }
        .ornament-corner-tr { top: 12px; right: 12px; border-left: 0; border-bottom: 0; }
        .ornament-corner-bl { bottom: 12px; left: 12px; border-right: 0; border-top: 0; }
        .ornament-corner-br { bottom: 12px; right: 12px; border-left: 0; border-top: 0; }
        
        .timeline-scroll::-webkit-scrollbar { display: none; }
        .timeline-scroll { -ms-overflow-style: none; scrollbar-width: none; }

        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: rotate-slow 20s linear infinite; }

        /* Lock background cover */
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
            background: rgba(27, 27, 34, 0.85);
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
        .float-btn:hover { background: #D4AF37; color: #00001A; }
        .float-btn.playing .material-symbols-outlined { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .float-btn.scrolling { background: #D4AF37; color: #00001A; }

        /* Scroll reveal animation styles */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px) scale(0.97);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .scroll-reveal.reveal-active {
            opacity: 1;
            transform: translateY(0) scale(1);
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
    </style>
</head>
<body class="bg-paper-white text-on-surface font-body-md cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-gold-foil/20 relative selection:bg-gold-foil/30">

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- ==================== OVERLAY COVER ==================== -->
    <div class="fixed inset-y-0 z-[100] max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-between pt-20 pb-16 px-6 bg-paper-white paper-texture overflow-hidden" id="wedding-cover">
        
        <!-- Background Ornaments -->
        <div class="absolute -top-20 -left-20 opacity-20 pointer-events-none text-gold-foil">
            <svg fill="none" height="350" viewbox="0 0 100 100" width="350">
                <path d="M50 0C50 27.614 27.614 50 0 50C27.614 50 50 72.386 50 100C50 72.386 72.386 50 100 50C72.386 50 50 27.614 50 0Z" fill="currentColor"></path>
            </svg>
        </div>

        <div class="w-full text-center z-10">
            <span class="font-label-caps text-label-caps text-gold-foil mb-2 block tracking-[0.3em]">THE WEDDING OF</span>
        </div>

        <!-- Asymmetric Photo Collage (Scaled down to prevent horizontal mobile overflow) -->
        <div class="relative w-full h-[320px] flex items-center justify-center my-6 z-10">
            <!-- Main Photo -->
            <div class="absolute w-[180px] aspect-[4/5] z-20 -translate-x-12 -translate-y-4 -rotate-3 p-2.5 bg-white shadow-2xl gold-border">
                <img class="w-full h-full object-cover" src="{{ $bg['cover'] }}" alt="Main Portrait"/>
            </div>
            <!-- Secondary Photo (Circle) -->
            <div class="absolute w-[120px] aspect-square z-30 translate-x-16 -translate-y-16 rounded-full overflow-hidden border-2 border-gold-foil shadow-xl parallax-circle">
                <img class="w-full h-full object-cover" src="{{ $bg['cover_circle'] }}" alt="Detail Shot"/>
            </div>
            <!-- Tertiary Photo (Small Polaroid) -->
            <div class="absolute w-[110px] aspect-square z-10 translate-x-20 translate-y-12 rotate-12 p-2 bg-white gold-border shadow-lg">
                <img class="w-full h-full object-cover" src="{{ $bg['cover_small'] }}" alt="Event Vibe"/>
            </div>
        </div>

        <!-- Typography & Buka Undangan -->
        <div class="w-full text-center z-20 px-4">
            <h1 class="flex flex-col items-center justify-center gap-1">
                <span class="font-display-grand text-5xl text-primary font-black uppercase tracking-tighter">{{ $couple['groom'] }}</span>
                <span class="font-script-accent text-gold-foil text-4xl -my-2 italic">&amp;</span>
                <span class="font-display-grand text-5xl text-primary font-black uppercase tracking-tighter">{{ $couple['bride'] }}</span>
            </h1>

            <div class="bg-white/85 border border-gold-foil/30 p-4 rounded-2xl shadow-sm my-6 max-w-xs mx-auto text-center">
                <p class="text-[9px] font-label-caps text-secondary uppercase tracking-[0.2em] mb-1">Dear Honorable Guest</p>
                <p class="font-headline-md text-primary text-sm font-semibold truncate">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
            </div>

            <button class="group relative inline-flex items-center justify-center px-10 py-3.5 font-label-caps text-label-caps text-paper-white bg-primary overflow-hidden rounded-md transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl tracking-widest" onclick="unlockInvitation()">
                <span class="relative z-10">BUKA UNDANGAN</span>
                <div class="absolute inset-0 bg-gold-foil translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                <span class="relative z-10 ml-2 material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">celebration</span>
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main id="main-content" class="hidden">
        <!-- Top App Bar -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 bg-transparent flex justify-between items-center px-6 py-4">
            <div class="font-script-accent text-lg text-gold-foil font-semibold">{{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}</div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-gold-foil text-xl">favorite</span>
            </div>
        </header>

        <!-- HERO SECTION -->
        <section class="relative min-h-[640px] bg-primary flex flex-col items-center justify-center py-20 px-6 overflow-hidden text-center" id="home">
            <!-- Botanical Line Art -->
            <div class="absolute top-0 right-0 w-1/2 h-1/2 opacity-10 pointer-events-none text-gold-foil">
                <svg class="h-full w-full" fill="none" viewbox="0 0 200 200">
                    <path d="M100 0C100 0 120 40 180 60C120 80 100 200 100 200C100 200 80 80 20 60C80 40 100 0 100 0Z" stroke="currentColor" stroke-width="0.5"></path>
                </svg>
            </div>
            <div class="absolute bottom-0 left-0 w-1/2 h-1/2 opacity-10 pointer-events-none rotate-180 text-gold-foil">
                <svg class="h-full w-full" fill="none" viewbox="0 0 200 200">
                    <path d="M100 0C100 0 120 40 180 60C120 80 100 200 100 200C100 200 80 80 20 60C80 40 100 0 100 0Z" stroke="currentColor" stroke-width="0.5"></path>
                </svg>
            </div>
            
            <div class="relative z-20 flex flex-col items-center max-w-sm w-full">
                <h2 class="font-headline-lg text-paper-white text-2xl uppercase tracking-wider mb-8">Save the Date</h2>
                
                <!-- Countdown -->
                <div class="flex gap-4 justify-center w-full mb-10">
                    <div class="flex flex-col items-center p-3.5 bg-primary-container border border-gold-foil/30 rounded-xl w-16 shadow-2xl">
                        <span class="font-display-grand text-xl text-gold-foil" id="days">00</span>
                        <span class="font-label-caps text-[8px] text-secondary-fixed-dim mt-1">DAYS</span>
                    </div>
                    <div class="flex flex-col items-center p-3.5 bg-primary-container border border-gold-foil/30 rounded-xl w-16 shadow-2xl">
                        <span class="font-display-grand text-xl text-gold-foil" id="hours">00</span>
                        <span class="font-label-caps text-[8px] text-secondary-fixed-dim mt-1">HOURS</span>
                    </div>
                    <div class="flex flex-col items-center p-3.5 bg-primary-container border border-gold-foil/30 rounded-xl w-16 shadow-2xl">
                        <span class="font-display-grand text-xl text-gold-foil" id="minutes">00</span>
                        <span class="font-label-caps text-[8px] text-secondary-fixed-dim mt-1">MINS</span>
                    </div>
                    <div class="flex flex-col items-center p-3.5 bg-primary-container border border-gold-foil/30 rounded-xl w-16 shadow-2xl">
                        <span class="font-display-grand text-xl text-gold-foil" id="seconds">00</span>
                        <span class="font-label-caps text-[8px] text-secondary-fixed-dim mt-1">SECS</span>
                    </div>
                </div>

                <!-- Event Details Anchor -->
                <div class="text-paper-white/80 space-y-2.5">
                    <p class="font-headline-md text-gold-foil text-lg tracking-widest font-semibold">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p class="font-label-caps text-[10px] text-paper-white/60 tracking-widest uppercase">The Grand Ballroom, Mulia Senayan</p>
                </div>
            </div>
            
            <!-- Gold Foil Splatter Decor -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-40">
                <div class="absolute top-1/4 left-1/4 w-1.5 h-1.5 bg-gold-foil rounded-full"></div>
                <div class="absolute top-1/2 right-1/3 w-2 h-2 bg-gold-foil rounded-full blur-[0.5px]"></div>
                <div class="absolute bottom-1/4 left-1/3 w-2 h-2 bg-gold-foil rounded-full"></div>
            </div>
        </section>

        <!-- MEMPELAI SECTION -->
        <section class="py-24 px-6 bg-surface overflow-hidden paper-texture text-center" id="mempelai">
            <div class="absolute top-0 right-0 opacity-10 pointer-events-none text-midnight-tint">
                <svg class="w-72 h-72" fill="currentColor" viewbox="0 0 100 100">
                    <path d="M50 0C50 50 0 50 0 50C50 50 50 100 50 100C50 50 100 50 100 50C50 50 50 0 50 0Z"></path>
                </svg>
            </div>
            
            <div class="max-w-sm mx-auto relative z-10 flex flex-col items-center">
                <div class="text-center mb-12 scroll-reveal">
                    <span class="font-label-caps text-gold-foil tracking-widest block mb-2 text-xs uppercase">INTRODUCING</span>
                    <h2 class="font-headline-lg text-primary text-2xl uppercase italic">Sang Mempelai</h2>
                </div>

                <div class="space-y-16 w-full">
                    <!-- Groom -->
                    <div class="flex flex-col items-center scroll-reveal">
                        <div class="relative w-full max-w-[240px] p-3.5 bg-white shadow-2xl -rotate-3 gold-border mb-6">
                            <img alt="Groom Portrait" class="w-full aspect-[4/5] object-cover" src="{{ $bg['groom'] }}"/>
                            <div class="mt-4 font-script-accent text-primary text-center text-xl font-semibold">{{ $couple['groom'] }}</div>
                        </div>
                        <p class="font-body-md text-secondary text-sm">Putra dari</p>
                        <p class="font-headline-md text-primary text-sm font-bold mt-1">{{ $couple['parents']['groom'] }}</p>
                    </div>

                    <div class="font-script-accent text-gold-foil text-3xl italic scroll-reveal">&amp;</div>

                    <!-- Bride -->
                    <div class="flex flex-col items-center scroll-reveal">
                        <div class="relative w-full max-w-[240px] p-3.5 bg-white shadow-2xl rotate-3 gold-border mb-6">
                            <img alt="Bride Portrait" class="w-full aspect-[4/5] object-cover" src="{{ $bg['bride'] }}"/>
                            <div class="mt-4 font-script-accent text-primary text-center text-xl font-semibold">{{ $couple['bride'] }}</div>
                        </div>
                        <p class="font-body-md text-secondary text-sm">Putri bungsu dari</p>
                        <p class="font-headline-md text-primary text-sm font-bold mt-1">{{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ACARA SECTION -->
        <section class="py-24 px-6 bg-midnight-tint overflow-hidden text-center text-white" id="acara">
            <!-- Ornament Background -->
            <div class="absolute inset-0 opacity-5 pointer-events-none">
                <svg height="100%" width="100%">
                    <pattern height="80" id="grid" patternunits="userSpaceOnUse" width="80">
                        <path d="M 80 0 L 0 0 0 80" fill="none" stroke="gold" stroke-width="0.5"></path>
                    </pattern>
                    <rect fill="url(#grid)" height="100%" width="100%"></rect>
                </svg>
            </div>
            
            <div class="max-w-sm mx-auto relative z-10 flex flex-col items-center gap-10">
                <div class="text-center scroll-reveal">
                    <h2 class="font-display-grand text-gold-foil text-5xl italic mb-3">Save the Date</h2>
                    <div class="h-[1px] w-20 bg-gold-foil mx-auto"></div>
                </div>

                @foreach($schedule as $i => $sch)
                <!-- Card -->
                <div class="relative w-full bg-primary p-7 border border-gold-foil/30 shadow-2xl text-left scroll-reveal">
                    @if($i === 0)
                        <div class="ornament-corner ornament-corner-tl"></div>
                        <div class="ornament-corner ornament-corner-br"></div>
                    @else
                        <div class="ornament-corner ornament-corner-tr"></div>
                        <div class="ornament-corner ornament-corner-bl"></div>
                    @endif
                    
                    <span class="font-label-caps text-gold-foil text-[10px] block mb-3 uppercase tracking-wider">{{ $sch['time'] }}</span>
                    <h3 class="font-headline-lg text-paper-white text-lg mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-gold-foil text-base">{{ $i === 0 ? 'church' : 'celebration' }}</span>
                        {{ $sch['title'] }}
                    </h3>
                    <p class="text-secondary-fixed-dim font-body-md text-xs mb-5 leading-relaxed">
                        {{ $i === 0 ? 'Prosesi sakral penyatuan dua janji suci di bawah naungan Ridho Ilahi.' : 'Malam perayaan penuh suka cita bersama keluarga dan kerabat terdekat.' }}
                    </p>
                    
                    <div class="flex items-start gap-2.5 text-gold-foil text-xs font-light">
                        <span class="material-symbols-outlined text-sm mt-0.5">location_on</span>
                        <span class="font-body-md">{{ $sch['note'] }}</span>
                    </div>
                </div>
                @endforeach

                <!-- Address & Directions -->
                <div class="w-full bg-primary p-7 border border-gold-foil/30 shadow-2xl text-center scroll-reveal">
                    <p class="font-bold text-gold-foil text-sm mb-1 uppercase tracking-widest">{{ $event['location'] }}</p>
                    <p class="text-xs text-secondary-fixed-dim leading-relaxed mb-6 font-light">{{ $event['address'] }}</p>
                    
                    <div class="flex flex-col gap-3">
                        <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="w-full bg-gold-foil text-primary py-3 rounded-md font-bold flex items-center justify-center gap-2 hover:bg-gold-foil/90 transition-colors text-xs font-label-caps tracking-wider">
                            <span class="material-symbols-outlined text-base">map</span> LOKASI GOOGLE MAPS
                        </a>
                        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($couple['groom'] . ' & ' . $couple['bride'] . ' Wedding') }}&dates={{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T080000Z/{{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T210000Z&details=Pernikahan+{{ urlencode($couple['groom'] . '+&+' . $couple['bride']) }}&location={{ urlencode($event['location']) }}" target="_blank" rel="noopener" class="w-full border border-gold-foil text-gold-foil py-3 rounded-md font-bold flex items-center justify-center gap-2 hover:bg-gold-foil/10 transition-colors text-xs font-label-caps tracking-wider">
                            <span class="material-symbols-outlined text-base">calendar_add_on</span> SIMPAN TANGGAL
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- STORIES SECTION -->
        <section class="py-24 px-6 bg-paper-white paper-texture overflow-hidden text-center" id="story">
            <div class="max-w-sm mx-auto flex flex-col items-center">
                <div class="text-center mb-12 scroll-reveal">
                    <h2 class="font-headline-lg text-primary text-2xl uppercase tracking-widest">Kisah Kami</h2>
                    <p class="text-gold-foil font-script-accent text-2xl mt-1">A Journey to Forever</p>
                </div>
                
                <!-- Horizontal snap scroll wrapper -->
                <div class="w-full overflow-x-auto timeline-scroll flex gap-6 pb-6 snap-x scroll-smooth z-10">
                    @foreach($stories as $i => $s)
                    <div class="min-w-[280px] max-w-[280px] snap-center scroll-reveal">
                        <div class="p-5 bg-white shadow-xl gold-border rounded-lg text-left h-full flex flex-col justify-between">
                            <div>
                                <div class="w-full h-32 overflow-hidden mb-4 rounded-sm">
                                    <img alt="Story photo" class="w-full h-full object-cover" src="{{ $bg['story_' . ($i + 1)] ?? $gallery[$i % count($gallery)] }}"/>
                                </div>
                                <span class="font-label-caps text-gold-foil text-[10px] font-bold tracking-wider">{{ strtoupper($s['date']) }}</span>
                                <h4 class="font-headline-md text-primary text-base mt-1.5 font-bold">{{ $s['title'] }}</h4>
                                <p class="font-body-md text-secondary text-xs mt-2 leading-relaxed">"{{ $s['text'] }}"</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-[9px] font-label-caps text-gold-foil tracking-widest uppercase mt-4 animate-pulse">Geser untuk membaca &rarr;</p>
            </div>
        </section>

        <!-- GALLERY SECTION -->
        <section class="py-24 px-6 bg-primary overflow-hidden text-center text-white" id="galeri">
            <div class="max-w-sm mx-auto">
                <div class="text-center mb-12 scroll-reveal">
                    <span class="font-label-caps text-gold-foil tracking-widest block mb-2 text-xs uppercase font-bold">OUR MOMENTS</span>
                    <h2 class="font-display-grand text-gold-foil text-4xl italic">Galeri Kebahagiaan</h2>
                </div>
                
                <!-- Masonry grid -->
                <div class="grid grid-cols-2 gap-3 scroll-reveal">
                    @foreach($gallery as $i => $img)
                    <div class="relative aspect-square overflow-hidden group cursor-zoom-in gold-border" onclick="openLightbox('{{ $img }}')">
                        <img alt="Gallery photo {{ $i + 1 }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700" src="{{ $img }}"/>
                        <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-2xl">zoom_in</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- RSVP & WISHES SECTION -->
        <section class="py-24 px-6 bg-paper-white paper-texture" id="rsvp">
            <div class="max-w-sm mx-auto flex flex-col gap-10">
                <!-- Form RSVP -->
                <div class="bg-white p-7 shadow-2xl gold-border relative scroll-reveal text-center">
                    <div class="ornament-corner ornament-corner-tl w-8 h-8"></div>
                    <div class="ornament-corner ornament-corner-br w-8 h-8"></div>
                    
                    <h3 class="font-headline-md text-primary mb-6 uppercase tracking-wider text-base font-bold">Konfirmasi Kehadiran</h3>
                    <form class="space-y-5 text-left" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="font-label-caps text-[10px] text-secondary block mb-1 uppercase tracking-wider">Nama Lengkap</label>
                            <input class="w-full bg-surface border-0 border-b border-gold-foil/30 focus:border-gold-foil focus:ring-0 px-2 py-2 text-xs text-primary placeholder:text-secondary/40 rounded-none transition-colors" placeholder="Contoh: Budi Santoso" type="text" id="rsvp-nama" required/>
                        </div>
                        <div>
                            <label class="font-label-caps text-[10px] text-secondary block mb-1 uppercase tracking-wider">Kehadiran</label>
                            <select class="w-full bg-surface border-0 border-b border-gold-foil/30 focus:border-gold-foil focus:ring-0 px-2 py-2 text-xs text-primary rounded-none transition-colors" id="rsvp-kehadiran">
                                <option value="Hadir">Hadir</option>
                                <option value="Berhalangan Hadir">Berhalangan Hadir</option>
                            </select>
                        </div>
                        <div>
                            <label class="font-label-caps text-[10px] text-secondary block mb-1 uppercase tracking-wider">Doa &amp; Ucapan</label>
                            <textarea class="w-full bg-surface border border-gold-foil/20 focus:border-gold-foil focus:ring-0 px-3 py-2 text-xs text-primary placeholder:text-secondary/40 rounded-lg h-24 resize-none transition-colors" placeholder="Tulis doa restu Anda..." id="rsvp-pesan" required></textarea>
                        </div>
                        <button class="w-full bg-primary text-paper-white font-label-caps py-3.5 tracking-widest text-xs font-bold hover:bg-midnight-tint hover:scale-[1.02] active:scale-95 transition-all duration-300 rounded-sm">KIRIM KONFIRMASI</button>
                    </form>
                </div>

                <!-- Wishes Feed -->
                <div class="flex flex-col text-left scroll-reveal">
                    <h3 class="font-headline-md text-primary text-base font-bold uppercase tracking-wider mb-6 text-center">Ucapan &amp; Doa Restu</h3>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1.5 custom-scrollbar" id="wishes-container">
                        @foreach($wishes as $w)
                        <div class="p-4 bg-white shadow-md border-l-4 border-gold-foil rounded-sm">
                            <p class="font-body-md text-on-surface-variant text-xs italic">"{{ $w['message'] }}"</p>
                            <span class="font-label-caps text-gold-foil text-[9px] block mt-2 font-bold">— {{ $w['name'] }} ({{ $w['status'] }})</span>
                        </div>
                        @endforeach
                        <div id="wishList"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KADO DIGITAL SECTION -->
        <section class="py-24 px-6 bg-midnight-tint relative overflow-hidden text-center text-white" id="kado">
            <div class="max-w-sm mx-auto relative z-10 flex flex-col items-center">
                <span class="material-symbols-outlined text-gold-foil text-5xl mb-3 animate-bounce">wallet</span>
                <h2 class="font-headline-lg text-paper-white text-xl uppercase tracking-widest mb-2">Wedding Gift</h2>
                <p class="text-secondary-fixed-dim text-xs leading-relaxed px-4 mb-8 font-light">Kehadiran Anda adalah kado terindah, namun jika Anda ingin memberikan tanda kasih, silakan melalui rekening berikut:</p>
                
                <div class="space-y-5 w-full">
                    @foreach($gifts as $i => $g)
                    <div class="bg-primary-container p-6 border border-gold-foil/30 rounded-xl relative group overflow-hidden text-center">
                        <div class="absolute inset-0 bg-gold-foil/5 translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                        
                        <!-- Bank logo -->
                        <div class="h-8 flex items-center justify-center mb-4">
                            @if(strtoupper($g['bank']) === 'BCA')
                                <img alt="BCA Logo" class="h-6 object-contain grayscale invert" src="{{ asset('assets/templates/wedding-25/images/image_15.jpg') }}"/>
                            @elseif(strtoupper($g['bank']) === 'MANDIRI')
                                <img alt="Mandiri Logo" class="h-6 object-contain grayscale invert" src="{{ asset('assets/templates/wedding-25/images/image_16.jpg') }}"/>
                            @else
                                <span class="font-bold text-gold-foil tracking-widest text-sm uppercase">{{ $g['bank'] }}</span>
                            @endif
                        </div>
                        
                        <p class="font-label-caps text-secondary-fixed-dim text-[9px] mb-1.5 uppercase tracking-widest">NOMOR REKENING</p>
                        <p class="font-display-grand text-2xl text-gold-foil mb-3 tracking-widest font-bold">{{ $g['account'] }}</p>
                        <p class="font-body-md text-paper-white text-xs font-light">A.N {{ strtoupper($g['name']) }}</p>
                        
                        <button class="mt-4 flex items-center gap-1.5 mx-auto text-gold-foil font-label-caps text-[9px] font-bold border border-gold-foil px-4 py-2 hover:bg-gold-foil hover:text-primary transition-all duration-300 rounded-sm" onclick="copyRek('{{ $g['account'] }}', this)">
                            <span class="material-symbols-outlined text-xs">content_copy</span> SALIN NO. REK
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="w-full py-24 relative overflow-hidden bg-primary border-t border-gold-foil/20 flex flex-col items-center text-center px-6">
            <div class="font-display-grand text-paper-white text-5xl opacity-10 absolute -top-4 font-black">
                {{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <h2 class="font-script-accent text-gold-foil text-3xl mb-6 italic">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                <p class="font-body-lg text-secondary-fixed-dim text-[11px] leading-relaxed max-w-xs mb-10 italic font-light px-2">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang."
                </p>
                <p class="font-label-caps text-[9px] text-gold-foil mb-6 tracking-[0.2em] uppercase font-bold">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
                </p>
                <div class="w-12 h-[1px] bg-gold-foil/30 mb-6"></div>
                <p class="font-body-md text-[9px] text-secondary-fixed-dim font-light">Created with <span class="text-gold-foil">♥</span> TemuRuang</p>
            </div>
        </footer>

        <!-- Bottom Navigation Pill -->
        <nav class="fixed bottom-8 left-1/2 -translate-x-1/2 flex gap-8 items-center z-50 bg-primary/80 backdrop-blur-md rounded-full px-8 py-3.5 border border-gold-foil/30 shadow-xl" id="bottomNav">
            <a class="material-symbols-outlined text-gold-foil scale-110 transition-all duration-500 ease-out hover:scale-125" href="#home" onclick="smoothScroll(event, '#home', this)">home</a>
            <a class="material-symbols-outlined text-secondary-fixed-dim hover:text-gold-foil transition-all hover:scale-125" href="#mempelai" onclick="smoothScroll(event, '#mempelai', this)">favorite</a>
            <a class="material-symbols-outlined text-secondary-fixed-dim hover:text-gold-foil transition-all hover:scale-125" href="#acara" onclick="smoothScroll(event, '#acara', this)">event</a>
            <a class="material-symbols-outlined text-secondary-fixed-dim hover:text-gold-foil transition-all hover:scale-125" href="#galeri" onclick="smoothScroll(event, '#galeri', this)">celebration</a>
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
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-gold-foil text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-lg border-2 border-gold-foil/40 shadow-2xl" src="" alt="Enlarged photo"/>
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
                main.classList.remove('hidden');
                document.body.classList.remove('cover-active');
                document.getElementById('floaterContainer').classList.add('visible');
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
            card.className = 'p-4 bg-white shadow-md border-l-4 border-gold-foil rounded-sm text-left';
            card.innerHTML = `<p class="font-body-md text-on-surface-variant text-xs italic">"${msg}"</p><span class="font-label-caps text-gold-foil text-[9px] block mt-2 font-bold">— ${name} (${status})</span>`;
            
            document.getElementById('wishList').prepend(card);
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
            
            document.querySelectorAll('#bottomNav a').forEach(a => {
                a.classList.remove('text-gold-foil', 'scale-110');
                a.classList.add('text-secondary-fixed-dim');
            });
            el.classList.remove('text-secondary-fixed-dim');
            el.classList.add('text-gold-foil', 'scale-110');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            initCountdown();
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });

            // Parallax Effect for Circular Image on Scroll
            window.addEventListener('scroll', () => {
                const circle = document.querySelector('.parallax-circle');
                if (circle) {
                    const scroll = window.pageYOffset;
                    circle.style.transform = `translate(4rem, -4rem) translateY(${scroll * 0.1}px) rotate(${scroll * 0.05}deg)`;
                }
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

                document.querySelectorAll('#bottomNav a').forEach((a) => {
                    a.classList.remove('text-gold-foil', 'scale-110');
                    a.classList.add('text-secondary-fixed-dim');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-secondary-fixed-dim');
                        a.classList.add('text-gold-foil', 'scale-110');
                    }
                });
            });
        });
    </script>
</body>
</html>