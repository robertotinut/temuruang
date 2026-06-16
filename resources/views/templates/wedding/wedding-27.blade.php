@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Alex');
        $brideName = trim($names[1] ?? 'Morgan');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Heru & Ibu Sarah',
                'bride' => 'Bpk. Wijaya & Ibu Ratna',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-11-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Gedung Kesenian Jakarta',
            'address' => $invitation->address ?? 'Jl. Gedung Kesenian No.1, Sawah Besar, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Gedung Kesenian Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Gedung Kesenian Jakarta, Jl. Gedung Kesenian No.1, Sawah Besar, Jakarta Pusat'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '11:00 - Selesai',
                'note' => $invitation->address ?? 'Grand Ballroom Gedung Kesenian, Jl. Gedung Kesenian No.1, Jakarta Pusat'
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
                ['title' => 'Pertemuan Pertama', 'date' => 'Agustus 2021', 'text' => 'Di sebuah kedai kopi bernuansa hijau rindang, obrolan singkat tentang buku mengubah arah hidup kami selamanya.'],
                ['title' => 'Lamaran', 'date' => 'Januari 2023', 'text' => 'Di puncak bukit saat matahari terbit, di kelilingi pepohonan sage, janji untuk setia mulai terukir.'],
                ['title' => 'Menuju Hari Bahagia', 'date' => 'November 2024', 'text' => 'Kini kami bersiap melangkah bersama ke gerbang kehidupan baru, diselimuti doa dan restu.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-27/images/image_7.jpg'),
                asset('assets/templates/wedding-27/images/image_8.jpg'),
                asset('assets/templates/wedding-27/images/image_9.jpg'),
                asset('assets/templates/wedding-27/images/image_10.jpg'),
                asset('assets/templates/wedding-27/images/image_11.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-27/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'cover_circle' => asset('assets/templates/wedding-27/images/image_3.jpg'),
            'cover_small' => asset('assets/templates/wedding-27/images/image_2.jpg'),
            'hero_polaroid' => asset('assets/templates/wedding-27/images/image_4.jpg'),
            'groom' => asset('assets/templates/wedding-27/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-27/images/image_6.jpg'),
            'story_1' => asset('assets/templates/wedding-27/images/image_7.jpg'),
            'story_2' => asset('assets/templates/wedding-27/images/image_8.jpg'),
            'story_3' => asset('assets/templates/wedding-27/images/image_10.jpg'),
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
                ['name' => 'Keluarga Budi', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Alex & Morgan! Semoga senantiasa dipenuhi berkah dan kebahagiaan.'],
                ['name' => 'Siti Aminah', 'status' => 'Hadir', 'message' => 'Sangat senang melihat kebahagiaan kalian berdua. Semoga lancar sampai hari H!'],
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
                ['bank' => 'BCA', 'name' => 'Alexandro Putra', 'account' => '123 456 7890'],
                ['bank' => 'Mandiri', 'name' => 'Morgana Jelita', 'account' => '098 765 4321'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Alex',
            'bride' => 'Morgan',
            'parents' => [
                'groom' => 'Bpk. Heru & Ibu Sarah',
                'bride' => 'Bpk. Wijaya & Ibu Ratna',
            ],
        ];

        $event = [
            'date_iso' => '2024-11-24',
            'time' => '08:00',
            'location' => 'Gedung Kesenian Jakarta',
            'address' => 'Jl. Gedung Kesenian No.1, Sawah Besar, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=Gedung+Kesenian+Jakarta',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'Gedung Kesenian Jakarta, Jl. Gedung Kesenian No.1, Sawah Besar, Jakarta Pusat'],
            ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - Selesai', 'note' => 'Grand Ballroom Gedung Kesenian, Jl. Gedung Kesenian No.1, Jakarta Pusat'],
        ];

        $stories = [
            ['title' => 'Pertemuan Pertama', 'date' => 'Agustus 2021', 'text' => 'Di sebuah kedai kopi bernuansa hijau rindang, obrolan singkat tentang buku mengubah arah hidup kami selamanya.'],
            ['title' => 'Lamaran', 'date' => 'Januari 2023', 'text' => 'Di puncak bukit saat matahari terbit, di kelilingi pepohonan sage, janji untuk setia mulai terukir.'],
            ['title' => 'Menuju Hari Bahagia', 'date' => 'November 2024', 'text' => 'Kini kami bersiap melangkah bersama ke gerbang kehidupan baru, diselimuti doa dan restu.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-27/images/image_7.jpg'),
            asset('assets/templates/wedding-27/images/image_8.jpg'),
            asset('assets/templates/wedding-27/images/image_9.jpg'),
            asset('assets/templates/wedding-27/images/image_10.jpg'),
            asset('assets/templates/wedding-27/images/image_11.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-27/images/image_1.jpg'),
            'cover_circle' => asset('assets/templates/wedding-27/images/image_3.jpg'),
            'cover_small' => asset('assets/templates/wedding-27/images/image_2.jpg'),
            'hero_polaroid' => asset('assets/templates/wedding-27/images/image_4.jpg'),
            'groom' => asset('assets/templates/wedding-27/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-27/images/image_6.jpg'),
            'story_1' => asset('assets/templates/wedding-27/images/image_7.jpg'),
            'story_2' => asset('assets/templates/wedding-27/images/image_8.jpg'),
            'story_3' => asset('assets/templates/wedding-27/images/image_10.jpg'),
        ];

        $wishes = [
            ['name' => 'Keluarga Budi', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Alex & Morgan! Semoga senantiasa dipenuhi berkah dan kebahagiaan.'],
            ['name' => 'Siti Aminah', 'status' => 'Hadir', 'message' => 'Sangat senang melihat kebahagiaan kalian berdua. Semoga lancar sampai hari H!'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Alexandro Putra', 'account' => '123 456 7890'],
            ['bank' => 'Mandiri', 'name' => 'Morgana Jelita', 'account' => '098 765 4321'],
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
    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@100..900&amp;family=Manrope:wght@200..800&amp;family=Space+Grotesk:wght@300..700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed": "#ffe088",
                        "outline-variant": "#c3c8c1",
                        "background": "#faf9f6",
                        "deep-forest": "#1B3022",
                        "on-tertiary-fixed-variant": "#574500",
                        "error-container": "#ffdad6",
                        "surface-variant": "#e3e2e0",
                        "on-primary-container": "#819986",
                        "surface": "#faf9f6",
                        "on-surface-variant": "#434843",
                        "secondary-container": "#d6e7a1",
                        "on-surface": "#1a1c1a",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary": "#ffffff",
                        "primary-fixed": "#d0e9d4",
                        "on-primary-fixed-variant": "#364c3c",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#b4cdb8",
                        "on-secondary-container": "#5a682f",
                        "surface-container-high": "#e9e8e5",
                        "on-background": "#1a1c1a",
                        "festive-gold": "#D4AF37",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#161f00",
                        "tertiary-fixed-dim": "#e9c349",
                        "sage-green": "#8A9A5B",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed-variant": "#3e4c16",
                        "surface-tint": "#4d6453",
                        "secondary": "#56642b",
                        "error": "#ba1a1a",
                        "primary-container": "#1b3022",
                        "secondary-fixed-dim": "#bdce89",
                        "primary-fixed-dim": "#b4cdb8",
                        "surface-dim": "#dbdad7",
                        "surface-bright": "#faf9f6",
                        "on-tertiary-container": "#4e3d00",
                        "primary": "#061b0e",
                        "tertiary": "#735c00",
                        "burnished-copper": "#B87333",
                        "surface-container-low": "#f4f3f1",
                        "on-tertiary-fixed": "#241a00",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#f2f1ee",
                        "tertiary-container": "#cba72f",
                        "alabaster-white": "#FAF9F6",
                        "secondary-fixed": "#d9eaa3",
                        "inverse-surface": "#2f312f",
                        "outline": "#737973",
                        "surface-container-highest": "#e3e2e0",
                        "on-primary-fixed": "#0b2013",
                        "surface-container": "#efeeeb"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "overlap-offset": "-2rem",
                        "gutter": "1.5rem",
                        "margin-page": "2rem",
                        "section-gap": "6rem"
                    },
                    fontFamily: {
                        "subheading": ["Space Grotesk", "sans-serif"],
                        "display-xl-mobile": ["Anybody", "sans-serif"],
                        "display-xl": ["Anybody", "sans-serif"],
                        "headline-lg": ["Anybody", "sans-serif"],
                        "headline-lg-mobile": ["Anybody", "sans-serif"],
                        "body-md": ["Manrope", "sans-serif"],
                        "body-lg": ["Manrope", "sans-serif"],
                        "label-bold": ["Space Grotesk", "sans-serif"]
                    },
                    fontSize: {
                        "subheading": ["18px", { "lineHeight": "24px", "letterSpacing": "0.1em", "fontWeight": "600" }],
                        "display-xl-mobile": ["56px", { "lineHeight": "60px", "letterSpacing": "-0.04em", "fontWeight": "900" }],
                        "display-xl": ["84px", { "lineHeight": "90px", "letterSpacing": "-0.04em", "fontWeight": "900" }],
                        "headline-lg": ["48px", { "lineHeight": "52px", "fontWeight": "800" }],
                        "headline-lg-mobile": ["36px", { "lineHeight": "40px", "fontWeight": "800" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "label-bold": ["14px", { "lineHeight": "18px", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .grain-overlay {
            background-image: url("https://www.transparenttextures.com/patterns/natural-paper.png");
            pointer-events: none;
        }
        .polaroid-frame {
            padding: 12px 12px 40px 12px;
            background: white;
            box-shadow: 0 10px 25px -5px rgba(27, 48, 34, 0.1);
        }
        .circular-mask {
            clip-path: circle(50% at 50% 50%);
        }
        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        .animate-sparkle {
            animation: sparkle 2s infinite ease-in-out;
        }

        body.cover-active {
            overflow: hidden;
            height: 100vh;
        }

        .timeline-scroll::-webkit-scrollbar { display: none; }
        .timeline-scroll { -ms-overflow-style: none; scrollbar-width: none; }

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
            background: rgba(27, 48, 34, 0.85);
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
        .float-btn:hover { background: #D4AF37; color: #1B3022; }
        .float-btn.paused .material-symbols-outlined { color: #8A9A5B; }
        .float-btn.scrolling { background: #D4AF37; color: #1B3022; }

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
<body class="bg-alabaster-white text-deep-forest selection:bg-festive-gold selection:text-white cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-deep-forest/10 relative">

    <!-- Grain Overlay -->
    <div class="fixed inset-0 grain-overlay opacity-30 z-[100] max-w-[480px] w-full left-1/2 -translate-x-1/2"></div>

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ $musicUrl }}" type="audio/mpeg">
    </audio>

    <!-- ==================== OVERLAY COVER ==================== -->
    <div class="fixed inset-y-0 z-[100] max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-between pt-16 pb-12 px-6 bg-alabaster-white overflow-hidden" id="wedding-cover">
        <!-- Background Ornaments -->
        <div class="absolute -top-10 -left-10 w-40 h-40 opacity-20 pointer-events-none text-festive-gold">
            <svg fill="currentColor" viewBox="0 0 100 100" class="w-full h-full">
                <path d="M50 0C50 27.614 27.614 50 0 50C27.614 50 50 72.386 50 100C50 72.386 72.386 50 100 50C72.386 50 50 27.614 50 0Z"></path>
            </svg>
        </div>
        <div class="absolute -bottom-10 right-1/4 w-32 h-32 text-sage-green/20 pointer-events-none">
            <span class="material-symbols-outlined text-[120px]">park</span>
        </div>

        <!-- Title -->
        <div class="w-full text-center z-10">
            <p class="font-subheading text-[11px] tracking-[0.3em] text-deep-forest/60 uppercase">The Wedding Invitation of</p>
        </div>

        <!-- Asymmetric Photo Collage -->
        <div class="relative w-full h-[320px] flex items-center justify-center my-6 z-10">
            <!-- Main Photo -->
            <div class="absolute w-[185px] aspect-[4/5] z-20 -translate-x-10 -translate-y-4 -rotate-3 p-2.5 bg-white shadow-2xl border border-deep-forest/5 rounded-sm">
                <img class="w-full h-full object-cover" src="{{ $bg['cover'] }}" alt="Main Portrait"/>
            </div>
            <!-- Secondary Photo (Circle) -->
            <div class="absolute w-[125px] aspect-square z-30 translate-x-16 -translate-y-16 rounded-full overflow-hidden border-2 border-festive-gold shadow-xl parallax-circle">
                <img class="w-full h-full object-cover" src="{{ $bg['cover_circle'] }}" alt="Detail Shot"/>
            </div>
            <!-- Tertiary Photo (Small Polaroid) -->
            <div class="absolute w-[115px] aspect-square z-10 translate-x-20 translate-y-12 rotate-12 p-2 bg-white border border-deep-forest/5 shadow-lg">
                <img class="w-full h-full object-cover" src="{{ $bg['cover_small'] }}" alt="Event Vibe"/>
            </div>
        </div>

        <!-- Typography Names & Buka Undangan -->
        <div class="w-full text-center z-20 px-4">
            <h1 class="font-display-xl-mobile text-deep-forest leading-none mb-6">
                <span class="block text-festive-gold uppercase font-black text-5xl tracking-tighter">{{ $couple['groom'] }}</span>
                <span class="font-light text-2xl italic my-1 block">&amp;</span>
                <span class="block uppercase font-black text-5xl tracking-tighter">{{ $couple['bride'] }}</span>
            </h1>

            <div class="bg-sage-green/10 border border-sage-green/20 p-4 rounded-2xl shadow-sm mb-6 max-w-xs mx-auto text-center">
                <p class="text-[9px] font-label-bold text-deep-forest/50 uppercase tracking-[0.2em] mb-1">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <h2 class="font-headline-lg-mobile text-deep-forest text-base font-bold truncate">{{ request()->get('kpd', 'Tamu Undangan') }}</h2>
            </div>

            <button class="group relative inline-flex items-center justify-center px-10 py-3.5 font-label-bold text-xs text-white bg-deep-forest overflow-hidden rounded-full transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl tracking-widest" onclick="unlockInvitation()">
                <span class="relative z-10 flex items-center gap-2">
                    BUKA UNDANGAN
                    <span class="material-symbols-outlined text-sm">mail</span>
                </span>
                <div class="absolute inset-0 bg-festive-gold translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
            </button>
        </div>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main id="main-content" class="hidden">
        <!-- Top App Bar -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 bg-alabaster-white/80 backdrop-blur-md flex justify-between items-center px-6 py-4 border-b border-deep-forest/5">
            <div class="font-display-xl-mobile text-sm text-deep-forest font-bold tracking-tighter">{{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}</div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-deep-forest text-lg">favorite</span>
            </div>
        </header>

        <!-- HERO SECTION -->
        <section class="pt-24 pb-16 px-6 relative overflow-hidden text-center" id="hero">
            <div class="relative w-full max-w-[280px] mx-auto mb-8 scroll-reveal">
                <div class="polaroid-frame rotate-[-3deg] relative z-10 border border-deep-forest/5">
                    <img class="w-full aspect-[4/5] object-cover grayscale-[10%]" src="{{ $bg['hero_polaroid'] }}" alt="Couple Portrait"/>
                </div>
                <!-- Decorative sparkle -->
                <div class="absolute -top-4 -right-4 w-12 h-12 text-festive-gold animate-sparkle">
                    <span class="material-symbols-outlined text-4xl">flare</span>
                </div>
            </div>

            <div class="space-y-6 max-w-sm mx-auto scroll-reveal">
                <h2 class="font-headline-lg-mobile text-deep-forest leading-tight">
                    Waktu yang <span class="italic text-festive-gold">Ditunggu-tunggu</span> Akan Segera Tiba
                </h2>
                <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                    "Cinta bukan tentang berapa hari, bulan, atau tahun kalian bersama. Cinta adalah tentang seberapa besar kalian saling mencintai setiap harinya."
                </p>

                <!-- Countdown Timer Grid -->
                <div class="flex gap-4 justify-center w-full mt-8">
                    <div class="bg-sage-green p-4 rounded-xl text-white text-center flex-1 shadow-lg shadow-sage-green/20 max-w-[70px]">
                        <span class="font-headline-lg-mobile text-xl block" id="days">00</span>
                        <span class="font-label-bold text-[8px] uppercase tracking-widest">Hari</span>
                    </div>
                    <div class="bg-sage-green p-4 rounded-xl text-white text-center flex-1 shadow-lg shadow-sage-green/20 max-w-[70px]">
                        <span class="font-headline-lg-mobile text-xl block" id="hours">00</span>
                        <span class="font-label-bold text-[8px] uppercase tracking-widest">Jam</span>
                    </div>
                    <div class="bg-sage-green p-4 rounded-xl text-white text-center flex-1 shadow-lg shadow-sage-green/20 max-w-[70px]">
                        <span class="font-headline-lg-mobile text-xl block" id="minutes">00</span>
                        <span class="font-label-bold text-[8px] uppercase tracking-widest">Menit</span>
                    </div>
                    <div class="bg-sage-green p-4 rounded-xl text-white text-center flex-1 shadow-lg shadow-sage-green/20 max-w-[70px]">
                        <span class="font-headline-lg-mobile text-xl block" id="seconds">00</span>
                        <span class="font-label-bold text-[8px] uppercase tracking-widest">Detik</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- MEMPELAI SECTION -->
        <section class="py-16 px-6 bg-surface-container-low relative overflow-hidden text-center" id="mempelai">
            <div class="absolute top-0 right-0 w-48 h-48 text-festive-gold/10 -rotate-12 translate-x-10 translate-y-[-10px] pointer-events-none">
                <span class="material-symbols-outlined text-[180px]">filter_vintage</span>
            </div>

            <div class="max-w-sm mx-auto relative z-10 flex flex-col items-center">
                <div class="text-center mb-10 scroll-reveal">
                    <span class="font-subheading text-[10px] text-sage-green uppercase tracking-[0.2em] block mb-1">MEMPERKENALKAN</span>
                    <h2 class="font-headline-lg-mobile text-deep-forest text-2xl font-bold uppercase">Mempelai</h2>
                </div>

                <div class="space-y-12 w-full">
                    <!-- Groom -->
                    <div class="flex flex-col items-center scroll-reveal">
                        <div class="polaroid-frame rotate-[2deg] w-64 group hover:rotate-0 transition-transform duration-500 mb-4 border border-deep-forest/5">
                            <img alt="Groom Portrait" class="w-full aspect-square object-cover" src="{{ $bg['groom'] }}"/>
                        </div>
                        <h3 class="font-headline-lg-mobile text-lg text-deep-forest font-bold">{{ $couple['groom'] }}andro Putra</h3>
                        <p class="font-body-md text-xs italic text-sage-green max-w-[220px] my-2">"Seorang pemimpi yang akhirnya menemukan rumah dalam pelukanmu."</p>
                        <p class="font-label-bold text-[10px] text-on-surface-variant uppercase tracking-wider">
                            Putra pertama dari <br/><span class="text-deep-forest font-bold">{{ $couple['parents']['groom'] }}</span>
                        </p>
                    </div>

                    <div class="font-display-xl-mobile text-festive-gold text-3xl font-light py-2 scroll-reveal">&amp;</div>

                    <!-- Bride -->
                    <div class="flex flex-col items-center scroll-reveal">
                        <div class="polaroid-frame rotate-[-3deg] w-64 group hover:rotate-0 transition-transform duration-500 mb-4 border border-deep-forest/5">
                            <img alt="Bride Portrait" class="w-full aspect-square object-cover" src="{{ $bg['bride'] }}"/>
                        </div>
                        <h3 class="font-headline-lg-mobile text-lg text-deep-forest font-bold">{{ $couple['bride'] }}a Jelita</h3>
                        <p class="font-body-md text-xs italic text-sage-green max-w-[220px] my-2">"Menemukan petualangan terindah dalam setiap percakapan kita."</p>
                        <p class="font-label-bold text-[10px] text-on-surface-variant uppercase tracking-wider">
                            Putri tunggal dari <br/><span class="text-deep-forest font-bold">{{ $couple['parents']['bride'] }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SAVE THE DATE SECTION (Akad & Resepsi) -->
        <section class="py-16 px-6 bg-alabaster-white text-center" id="acara">
            <div class="max-w-sm mx-auto">
                <div class="mb-10 scroll-reveal">
                    <span class="font-subheading text-[10px] text-festive-gold uppercase tracking-[0.2em] block mb-1">THE CELEBRATION</span>
                    <h2 class="font-headline-lg-mobile text-deep-forest text-2xl font-bold uppercase">Waktu & Tempat</h2>
                </div>

                <div class="space-y-8">
                    <!-- Akad -->
                    <div class="relative p-8 bg-sage-green/5 rounded-3xl overflow-hidden border border-sage-green/20 border-t-4 border-t-sage-green text-left scroll-reveal">
                        <div class="flex justify-between items-start mb-4">
                            <span class="material-symbols-outlined text-3xl text-sage-green">church</span>
                            <span class="font-label-bold text-[10px] text-sage-green uppercase tracking-wider">Akad Nikah</span>
                        </div>
                        <div class="space-y-1 mb-4">
                            <p class="font-headline-lg-mobile text-lg text-deep-forest font-bold">{{ $schedule[0]['time'] }}</p>
                            <p class="font-label-bold text-[11px] text-deep-forest/70">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed mb-4">
                            {{ $schedule[0]['note'] }}
                        </p>
                        <a class="inline-flex items-center gap-1.5 font-label-bold text-xs text-festive-gold hover:underline font-bold" href="{{ $event['maps_url'] }}" target="_blank">
                            LIHAT LOKASI <span class="material-symbols-outlined text-xs">north_east</span>
                        </a>
                    </div>

                    <!-- Resepsi -->
                    <div class="relative p-8 bg-deep-forest text-white rounded-3xl overflow-hidden border border-festive-gold/30 border-t-4 border-t-festive-gold text-left scroll-reveal">
                        <div class="flex justify-between items-start mb-4">
                            <span class="material-symbols-outlined text-3xl text-festive-gold">celebration</span>
                            <span class="font-label-bold text-[10px] text-festive-gold uppercase tracking-wider">Resepsi</span>
                        </div>
                        <div class="space-y-1 mb-4">
                            <p class="font-headline-lg-mobile text-lg text-festive-gold font-bold">{{ $schedule[1]['time'] }}</p>
                            <p class="font-label-bold text-[11px] text-white/70">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                        </div>
                        <p class="font-body-md text-xs text-white/80 leading-relaxed mb-4">
                            {{ $schedule[1]['note'] }}
                        </p>
                        <a class="inline-flex items-center gap-1.5 font-label-bold text-xs text-festive-gold hover:text-white transition-colors font-bold" href="{{ $event['maps_url'] }}" target="_blank">
                            LIHAT LOKASI <span class="material-symbols-outlined text-xs">north_east</span>
                        </a>
                    </div>

                    <!-- Address & Directions -->
                    <div class="w-full bg-surface-container p-6 rounded-2xl border border-deep-forest/5 text-center scroll-reveal">
                        <p class="font-bold text-deep-forest text-sm mb-1 uppercase tracking-widest">{{ $event['location'] }}</p>
                        <p class="text-[11px] text-on-surface-variant leading-relaxed mb-4">{{ $event['address'] }}</p>
                        
                        <div class="flex flex-col gap-2">
                            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="w-full bg-deep-forest text-white py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-deep-forest/90 transition-colors text-xs font-label-bold tracking-wider shadow-md">
                                <span class="material-symbols-outlined text-sm">map</span> LOKASI GOOGLE MAPS
                            </a>
                            <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($couple['groom'] . ' & ' . $couple['bride'] . ' Wedding') }}&dates={{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T080000Z/{{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T210000Z&details=Pernikahan+{{ urlencode($couple['groom'] . '+&+' . $couple['bride']) }}&location={{ urlencode($event['location']) }}" target="_blank" rel="noopener" class="w-full border border-deep-forest text-deep-forest py-3 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-deep-forest/5 transition-colors text-xs font-label-bold tracking-wider">
                                <span class="material-symbols-outlined text-sm">calendar_add_on</span> SIMPAN TANGGAL
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- OUR STORY SECTION -->
        <section class="py-16 px-6 bg-surface-container-low overflow-hidden text-center" id="story">
            <div class="max-w-sm mx-auto flex flex-col items-center">
                <div class="text-center mb-10 scroll-reveal">
                    <span class="font-subheading text-[10px] text-sage-green uppercase tracking-[0.2em] block mb-1">KISAH KAMI</span>
                    <h2 class="font-headline-lg-mobile text-deep-forest text-2xl font-bold uppercase">A Journey to Forever</h2>
                </div>
                
                <!-- Horizontal snap scroll wrapper -->
                <div class="w-full overflow-x-auto timeline-scroll flex gap-6 pb-6 snap-x scroll-smooth z-10">
                    @foreach($stories as $i => $s)
                    <div class="min-w-[260px] max-w-[260px] snap-center scroll-reveal">
                        <div class="p-5 bg-white shadow-xl rounded-2xl text-left h-full flex flex-col justify-between border border-deep-forest/5">
                            <div>
                                <div class="w-full h-32 overflow-hidden mb-4 rounded-xl">
                                    <img alt="Story photo" class="w-full h-full object-cover" src="{{ $bg['story_' . ($i + 1)] ?? $gallery[$i % count($gallery)] }}"/>
                                </div>
                                <span class="font-label-bold text-festive-gold text-[10px] tracking-wider block mb-1">{{ strtoupper($s['date']) }}</span>
                                <h4 class="font-headline-lg-mobile text-sm text-deep-forest font-bold">{{ $s['title'] }}</h4>
                                <p class="font-body-md text-xs text-on-surface-variant mt-2 leading-relaxed">"{{ $s['text'] }}"</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-[9px] font-label-bold text-festive-gold tracking-widest uppercase mt-2 animate-pulse flex items-center justify-center gap-1">&larr; Geser untuk membaca &rarr;</p>
            </div>
        </section>

        <!-- GALLERY SECTION -->
        <section class="py-16 px-6 bg-deep-forest overflow-hidden text-center text-white" id="galeri">
            <div class="max-w-sm mx-auto">
                <div class="text-center mb-10 scroll-reveal">
                    <span class="font-label-bold text-festive-gold tracking-widest block mb-1 text-[10px] uppercase font-bold">MOMEN INDAH</span>
                    <h2 class="font-headline-lg-mobile text-white text-2xl font-bold uppercase">Galeri Momen</h2>
                </div>
                
                <!-- Grid Layout adapted from screen_1_green.html -->
                <div class="grid grid-cols-12 gap-3 auto-rows-[120px] scroll-reveal">
                    <!-- Large Circle (Image 1) -->
                    <div class="col-span-8 row-span-2 overflow-hidden rounded-full cursor-zoom-in relative border border-festive-gold/30 shadow-xl" onclick="openLightbox('{{ $gallery[0] }}')">
                        <img alt="Gallery photo 1" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $gallery[0] }}"/>
                    </div>
                    
                    <!-- Vertical Card (Image 2) -->
                    <div class="col-span-4 row-span-2 overflow-hidden rounded-2xl cursor-zoom-in relative border border-festive-gold/20 shadow-md" onclick="openLightbox('{{ $gallery[1] }}')">
                        <img alt="Gallery photo 2" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $gallery[1] }}"/>
                    </div>

                    <!-- Offset Small Circle (Image 3) -->
                    <div class="col-span-4 row-span-1 overflow-hidden rounded-full cursor-zoom-in relative border-2 border-festive-gold p-1" onclick="openLightbox('{{ $gallery[2] }}')">
                        <img alt="Gallery photo 3" class="w-full h-full object-cover rounded-full" src="{{ $gallery[2] }}"/>
                    </div>

                    <!-- Landscape (Image 4) -->
                    <div class="col-span-8 row-span-1 overflow-hidden rounded-2xl cursor-zoom-in relative border border-festive-gold/20 shadow-md" onclick="openLightbox('{{ $gallery[3] }}')">
                        <img alt="Gallery photo 4" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $gallery[3] }}"/>
                    </div>
                    
                    <!-- Last Circle (Image 5) -->
                    <div class="col-span-5 row-span-1 overflow-hidden rounded-full cursor-zoom-in relative border border-festive-gold/20" onclick="openLightbox('{{ $gallery[4] ?? $gallery[0] }}')">
                        <img alt="Gallery photo 5" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $gallery[4] ?? $gallery[0] }}"/>
                    </div>
                    
                    <!-- Spacer/Decorative -->
                    <div class="col-span-7 row-span-1 rounded-2xl border border-festive-gold/30 flex items-center justify-center p-4 text-center">
                        <span class="material-symbols-outlined text-3xl text-festive-gold animate-pulse">spa</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- RSVP & WISHES FEED SECTION -->
        <section class="py-16 px-6 bg-alabaster-white" id="rsvp">
            <div class="max-w-sm mx-auto flex flex-col gap-10">
                <!-- RSVP Card -->
                <div class="bg-white p-6 rounded-2xl border border-deep-forest/5 shadow-xl relative scroll-reveal text-center">
                    <div class="absolute -top-3 -left-3 w-8 h-8 text-sage-green pointer-events-none opacity-20">
                        <span class="material-symbols-outlined text-4xl">park</span>
                    </div>
                    
                    <h3 class="font-headline-lg-mobile text-deep-forest text-lg font-bold mb-4 uppercase tracking-wider">Konfirmasi Kehadiran</h3>
                    <form class="space-y-4 text-left" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="font-label-bold text-[9px] text-on-surface-variant uppercase tracking-wider block mb-1">Nama Lengkap</label>
                            <input class="w-full bg-surface-container-low border-0 border-b border-sage-green/30 focus:border-sage-green focus:ring-0 px-2 py-2 text-xs text-deep-forest placeholder:text-deep-forest/30 rounded-none transition-colors" placeholder="Contoh: Ibu Rina Rahayu" type="text" id="rsvp-nama" required/>
                        </div>
                        <div>
                            <label class="font-label-bold text-[9px] text-on-surface-variant uppercase tracking-wider block mb-1">Kehadiran</label>
                            <select class="w-full bg-surface-container-low border-0 border-b border-sage-green/30 focus:border-sage-green focus:ring-0 px-2 py-2 text-xs text-deep-forest rounded-none transition-colors" id="rsvp-kehadiran">
                                <option value="Hadir">Hadir (1 Orang)</option>
                                <option value="Hadir Berdua">Hadir Berdua</option>
                                <option value="Berhalangan Hadir">Berhalangan Hadir</option>
                            </select>
                        </div>
                        <div>
                            <label class="font-label-bold text-[9px] text-on-surface-variant uppercase tracking-wider block mb-1">Doa Restu &amp; Ucapan</label>
                            <textarea class="w-full bg-surface-container-low border border-sage-green/20 focus:border-sage-green focus:ring-0 px-3 py-2 text-xs text-deep-forest placeholder:text-deep-forest/30 rounded-lg h-24 resize-none transition-colors" placeholder="Tulis ucapan dan doa hangat Anda..." id="rsvp-pesan" required></textarea>
                        </div>
                        <button class="w-full bg-deep-forest text-white font-label-bold py-3.5 tracking-widest text-[10px] font-bold hover:bg-primary transition-all duration-300 rounded-full shadow-lg">KIRIM KONFIRMASI</button>
                    </form>
                </div>

                <!-- Wishes Feed -->
                <div class="flex flex-col text-left scroll-reveal">
                    <h3 class="font-headline-lg-mobile text-deep-forest text-base font-bold uppercase tracking-wider mb-6 text-center">Doa Restu Sahabat</h3>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1.5 custom-scrollbar" id="wishes-container">
                        @foreach($wishes as $w)
                        <div class="p-4 bg-white shadow-sm border-l-4 border-sage-green rounded-lg">
                            <p class="font-body-md text-on-surface-variant text-xs italic">"{{ $w['message'] }}"</p>
                            <span class="font-label-bold text-festive-gold text-[9px] block mt-2 font-bold">— {{ $w['name'] }} ({{ $w['status'] }})</span>
                        </div>
                        @endforeach
                        <div id="wishList"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KADO DIGITAL SECTION -->
        <section class="py-16 px-6 bg-deep-forest text-center text-white relative" id="kado">
            <div class="max-w-sm mx-auto relative z-10 flex flex-col items-center">
                <span class="material-symbols-outlined text-festive-gold text-4xl mb-2 animate-bounce">wallet</span>
                <h2 class="font-headline-lg-mobile text-white text-xl uppercase tracking-widest mb-1">Wedding Gift</h2>
                <p class="text-white/70 text-xs leading-relaxed px-4 mb-6 font-light">Doa restu Anda adalah berkah terindah. Namun jika Anda ingin berbagi kebahagiaan secara digital, silakan melalui rekening berikut:</p>
                
                <div class="space-y-4 w-full">
                    @foreach($gifts as $i => $g)
                    <div class="bg-primary-container p-6 border border-festive-gold/30 rounded-2xl relative group overflow-hidden text-center shadow-md">
                        <div class="absolute inset-0 bg-festive-gold/5 translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                        
                        <p class="font-label-bold text-festive-gold text-[9px] mb-1 uppercase tracking-widest">{{ $g['bank'] }}</p>
                        <p class="font-display-xl-mobile text-xl text-white mb-2 tracking-widest font-bold">{{ $g['account'] }}</p>
                        <p class="font-body-md text-white/70 text-xs font-light">A.N {{ strtoupper($g['name']) }}</p>
                        
                        <button class="mt-4 flex items-center gap-1.5 mx-auto text-festive-gold font-label-bold text-[9px] font-bold border border-festive-gold px-4 py-2 hover:bg-festive-gold hover:text-deep-forest transition-all duration-300 rounded-full" onclick="copyRek('{{ $g['account'] }}', this)">
                            <span class="material-symbols-outlined text-xs">content_copy</span> SALIN REKENING
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="w-full py-16 bg-alabaster-white border-t border-deep-forest/5 flex flex-col items-center text-center px-6">
            <div class="font-display-xl-mobile text-deep-forest/5 text-6xl absolute -top-2 font-black pointer-events-none select-none">
                {{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}
            </div>
            
            <div class="relative z-10 flex flex-col items-center max-w-sm">
                <h2 class="font-display-xl-mobile text-deep-forest text-2xl mb-4 uppercase font-bold">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                <p class="font-body-md text-[11px] text-on-surface-variant leading-relaxed mb-6 italic font-light px-2">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang."
                </p>
                <p class="font-label-bold text-[9px] text-festive-gold mb-4 tracking-[0.2em] uppercase font-bold">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
                </p>
                <div class="w-12 h-[1px] bg-sage-green/30 mb-4"></div>
                <p class="font-body-md text-[9px] text-on-surface-variant/50 font-light">Created with <span class="text-festive-gold">♥</span> TemuRuang</p>
            </div>
        </footer>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed bottom-8 left-1/2 -translate-x-1/2 flex gap-8 items-center z-50 bg-deep-forest/90 backdrop-blur-md rounded-full px-8 py-3.5 border border-festive-gold/30 shadow-xl" id="bottomNav">
            <a class="material-symbols-outlined text-festive-gold scale-110 transition-all duration-500 ease-out hover:scale-125" href="#hero" onclick="smoothScroll(event, '#hero', this)">home</a>
            <a class="material-symbols-outlined text-white/55 hover:text-festive-gold transition-all hover:scale-125" href="#mempelai" onclick="smoothScroll(event, '#mempelai', this)">favorite</a>
            <a class="material-symbols-outlined text-white/55 hover:text-festive-gold transition-all hover:scale-125" href="#acara" onclick="smoothScroll(event, '#acara', this)">event</a>
            <a class="material-symbols-outlined text-white/55 hover:text-festive-gold transition-all hover:scale-125" href="#galeri" onclick="smoothScroll(event, '#galeri', this)">celebration</a>
        </nav>
    </main>

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

    <script>
        let isAutoscrolling = false;
        let scrollSpeed = 0.65; // speed parameter

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

        function unlockInvitation() {
            const cover = document.getElementById('wedding-cover');
            const main = document.getElementById('main-content');
            const floater = document.getElementById('floaterContainer');
            
            cover.classList.add('transition-all', 'duration-1000', '-translate-y-full', 'opacity-0');
            setTimeout(() => {
                cover.style.display = 'none';
                main.classList.remove('hidden');
                document.body.classList.remove('cover-active');
                floater.classList.add('visible');
                
                // Play audio
                const audio = document.getElementById('bg-audio');
                audio.play().catch(e => console.log("Audio autoplay blocked"));
            }, 800);
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
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
            card.className = 'p-4 bg-white shadow-md border-l-4 border-sage-green rounded-lg text-left';
            card.innerHTML = `<p class="font-body-md text-on-surface-variant text-xs italic">"${msg}"</p><span class="font-label-bold text-festive-gold text-[9px] block mt-2 font-bold">— ${name} (${status})</span>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert('Konfirmasi kehadiran dan ucapan berhasil dikirim!');
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
                a.classList.remove('text-festive-gold', 'scale-110');
                a.classList.add('text-white/55');
            });
            el.classList.remove('text-white/55');
            el.classList.add('text-festive-gold', 'scale-110');

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
                    a.classList.remove('text-festive-gold', 'scale-110');
                    a.classList.add('text-white/55');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-white/55');
                        a.classList.add('text-festive-gold', 'scale-110');
                    }
                });
            });
        });
    </script>
</body>
</html>