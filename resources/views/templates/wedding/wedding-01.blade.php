@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Aditya');
        $brideName = trim($names[1] ?? 'Arumi');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Rahardian & Ibu Astuti',
                'bride' => 'Bpk. Kusumo & Ibu Indah',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-08-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'The Heritage Residence',
            'address' => $invitation->address ?? 'Jalan Veteran No. 45, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Heritage Residence, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'The Heritage Residence'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '19:00 - 21:00 WIB',
                'note' => $invitation->address ?? 'Grand Ballroom Menteng'
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
                ['title' => 'The First Encounter', 'date' => '09 Jan 2021', 'text' => 'Bermula dari cangkir kopi yang tidak sengaja tertukar, sebuah percakapan hangat pun terjalin.'],
                ['title' => 'The Commitment', 'date' => '25 Agt 2023', 'text' => 'Di bawah langit sore yang syahdu, kami berjanji untuk melangkah ke arah masa depan bersama.'],
                ['title' => 'The Eternal Union', 'date' => '24 Agt 2026', 'text' => 'Dua hati kini resmi bersatu dalam ikatan janji suci pernikahan yang kekal.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-01/images/image_3.jpg'), // rings
                asset('assets/templates/wedding-01/images/image_4.jpg'), // walk
                asset('assets/templates/wedding-01/images/image_5.jpg'), // laugh
                asset('assets/templates/wedding-01/images/image_6.jpg'), // veil
                asset('assets/templates/wedding-01/images/image_7.jpg'), // feast
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-01/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-01/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-01/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-01/images/image_6.jpg'),
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
                ['name' => 'Sarah & Johan', 'status' => 'Hadir', 'message' => 'May your love be like a fine film, getting more beautiful and valuable as it ages. Congratulations!'],
                ['name' => 'Uncle Robert', 'status' => 'Hadir', 'message' => 'So happy to witness this beautiful union. Wishing you a lifetime of joy and laughter.'],
                ['name' => 'Anya W.', 'status' => 'Hadir', 'message' => 'Cheers to the most aesthetic couple! Looking forward to celebrate with you guys.'],
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
                ['bank' => 'Bank Central Asia', 'name' => 'Aditya', 'account' => '123-456-7890'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/boho-wedding-bg.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Aditya',
            'bride' => 'Arumi',
            'parents' => [
                'groom' => 'Bpk. Rahardian & Ibu Astuti',
                'bride' => 'Bpk. Kusumo & Ibu Indah',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-24',
            'time' => '08:00',
            'location' => 'The Heritage Residence',
            'address' => 'Jalan Veteran No. 45, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=The+Heritage+Residence',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00', 'note' => 'The Heritage Residence'],
            ['title' => 'Resepsi Pernikahan', 'time' => '19:00 - 21:00', 'note' => 'Grand Ballroom Menteng'],
        ];

        $stories = [
            ['title' => 'The First Encounter', 'date' => '09 Jan 2021', 'text' => 'Bermula dari cangkir kopi yang tidak sengaja tertukar, sebuah percakapan hangat pun terjalin.'],
            ['title' => 'The Commitment', 'date' => '25 Agt 2023', 'text' => 'Di bawah langit sore yang syahdu, kami berjanji untuk melangkah ke arah masa depan bersama.'],
            ['title' => 'The Eternal Union', 'date' => '24 Agt 2026', 'text' => 'Dua hati kini resmi bersatu dalam ikatan janji suci pernikahan yang kekal.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-01/images/image_3.jpg'),
            asset('assets/templates/wedding-01/images/image_4.jpg'),
            asset('assets/templates/wedding-01/images/image_5.jpg'),
            asset('assets/templates/wedding-01/images/image_6.jpg'),
            asset('assets/templates/wedding-01/images/image_7.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-01/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-01/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-01/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-01/images/image_6.jpg'),
        ];

        $wishes = [
            ['name' => 'Sarah & Johan', 'status' => 'Hadir', 'message' => 'May your love be like a fine film, getting more beautiful and valuable as it ages. Congratulations!'],
            ['name' => 'Uncle Robert', 'status' => 'Hadir', 'message' => 'So happy to witness this beautiful union. Wishing you a lifetime of joy and laughter.'],
            ['name' => 'Anya W.', 'status' => 'Hadir', 'message' => 'Cheers to the most aesthetic couple! Looking forward to celebrate with you guys.'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia', 'name' => 'Aditya', 'account' => '123-456-7890'],
        ];

        $musicUrl = asset('musics/boho-wedding-bg.mp3');
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Undangan Pernikahan | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&amp;family=Courier+Prime:ital,wght@0,400;0,700;1,400&amp;family=Special+Elite&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
                    "sage-green": "#8DA08B",
                    "surface-dim": "#e7d8c5",
                    "on-tertiary-container": "#ff906a",
                    "secondary-fixed": "#ffdcbd",
                    "on-tertiary": "#ffffff",
                    "inverse-surface": "#382f22",
                    "primary-fixed": "#ccead6",
                    "on-error": "#ffffff",
                    "on-error-container": "#93000a",
                    "surface-variant": "#efe0cd",
                    "surface-bright": "#fff8f3",
                    "on-secondary-container": "#7a532a",
                    "tertiary-fixed-dim": "#ffb59c",
                    "secondary": "#7d562d",
                    "surface-container-lowest": "#ffffff",
                    "on-primary-fixed-variant": "#324c3e",
                    "on-primary-container": "#98b5a3",
                    "tertiary-container": "#762809",
                    "espresso-brown": "#2B1B17",
                    "on-background": "#221a0f",
                    "on-secondary": "#ffffff",
                    "error": "#ba1a1a",
                    "primary-container": "#2d4739",
                    "surface-container-highest": "#efe0cd",
                    "on-tertiary-fixed": "#390c00",
                    "surface-tint": "#496455",
                    "outline": "#727973",
                    "tertiary-fixed": "#ffdbcf",
                    "secondary-container": "#ffca98",
                    "on-surface-variant": "#424844",
                    "background": "#fff8f3",
                    "on-secondary-fixed": "#2c1600",
                    "secondary-fixed-dim": "#f0bd8b",
                    "surface-container": "#fbecd8",
                    "warm-ivory": "#FAF6F0",
                    "error-container": "#ffdad6",
                    "on-tertiary-fixed-variant": "#7d2d0e",
                    "inverse-on-surface": "#feeedb",
                    "on-secondary-fixed-variant": "#623f18",
                    "surface-container-low": "#fff2e2",
                    "on-primary": "#ffffff",
                    "surface-container-high": "#f5e6d3",
                    "inverse-primary": "#b0cdbb",
                    "primary-fixed-dim": "#b0cdbb",
                    "primary": "#173124",
                    "tertiary": "#541600",
                    "on-surface": "#221a0f",
                    "on-primary-fixed": "#062014",
                    "outline-variant": "#c2c8c2",
                    "surface": "#fff8f3"
            },
            borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            spacing: {
                    "section-padding": "80px",
                    "unit": "8px",
                    "container-max": "1200px",
                    "reflow-breakpoint": "768px",
                    "gutter": "24px"
            },
            fontFamily: {
                    "label-stamp": ["Special Elite"],
                    "headline-section": ["Playfair Display"],
                    "display-names": ["Playfair Display"],
                    "quote-script": ["Playfair Display"],
                    "display-names-mobile": ["Playfair Display"],
                    "body-main": ["Courier Prime"]
            },
            fontSize: {
                    "label-stamp": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.1em", "fontWeight": "400"}],
                    "headline-section": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                    "display-names": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "900"}],
                    "quote-script": ["20px", {"lineHeight": "1.5", "fontWeight": "400"}],
                    "display-names-mobile": ["42px", {"lineHeight": "1.1", "fontWeight": "900"}],
                    "body-main": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
    
    <!-- AOS.js for Vintage Scroll Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
    
    <style>
        html {
            background-color: #1a110d;
            overflow-x: hidden;
        }

        body {
            background-color: #fbecd8;
            background-image: url("https://www.transparenttextures.com/patterns/natural-paper.png");
            color: #2B1B17;
        }

        .torn-edge-top {
            clip-path: polygon(0% 15%, 5% 10%, 10% 18%, 15% 12%, 20% 17%, 25% 10%, 30% 15%, 35% 12%, 40% 18%, 45% 10%, 50% 15%, 55% 10%, 60% 18%, 65% 12%, 70% 17%, 75% 10%, 80% 15%, 85% 12%, 90% 18%, 95% 10%, 100% 15%, 100% 100%, 0% 100%);
        }

        .torn-edge-bottom {
            clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 95% 90%, 90% 82%, 85% 88%, 80% 83%, 75% 90%, 70% 85%, 65% 88%, 60% 82%, 55% 90%, 50% 85%, 45% 90%, 40% 82%, 35% 88%, 30% 85%, 25% 90%, 20% 83%, 15% 88%, 10% 82%, 5% 90%, 0% 85%);
        }

        .film-strip-border {
            border: 20px solid #1a1a1a;
            position: relative;
        }
        .film-strip-border::before, .film-strip-border::after {
            content: '';
            position: absolute;
            left: -20px;
            right: -20px;
            height: 10px;
            background-image: repeating-linear-gradient(to right, white 0, white 10px, transparent 10px, transparent 20px);
        }
        .film-strip-border::before { top: -15px; }
        .film-strip-border::after { bottom: -15px; }

        .wax-seal {
            background: radial-gradient(circle at 30% 30%, #a64b2a, #541600);
            box-shadow: 4px 4px 12px rgba(43,27,23,0.4), inset -2px -2px 4px rgba(0,0,0,0.5);
            transition: all 0.3s ease;
        }
        .wax-seal:active {
            transform: scale(0.95);
            box-shadow: 2px 2px 6px rgba(43,27,23,0.4);
        }

        .ticket-edge {
            background-image: radial-gradient(circle at 0 50%, transparent 10px, #EADBC8 10px),
                              radial-gradient(circle at 100% 50%, transparent 10px, #EADBC8 10px);
            background-size: 50% 100%;
            background-position: left, right;
            background-repeat: no-repeat;
        }

        .grain-overlay {
            pointer-events: none;
            position: fixed;
            top: 0; left: 50%; width: 100%; height: 100%;
            max-width: 480px;
            transform: translateX(-50%);
            background: url("https://www.transparenttextures.com/patterns/stardust.png");
            opacity: 0.15;
            z-index: 1001;
        }

        body.cover-active {
            overflow: hidden;
            height: 100vh;
        }

        .polaroid-frame {
            background: #fff;
            padding: 12px 12px 24px 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border: 1px solid rgba(0,0,0,0.08);
        }

        .scrapbook-border {
            border: 6px double #7d562d;
            outline: 2px solid #7d562d;
            outline-offset: -12px;
        }

        /* Floating action buttons */
        .floater-container {
            position: fixed;
            bottom: 95px;
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
            background: rgba(23, 49, 36, 0.95);
            border: 2px dashed #ffdcbd;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #ffdcbd;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }
        .float-btn:hover { background: #ffdcbd; color: #173124; }
        .float-btn.paused .material-symbols-outlined { color: #b0cdbb; }
        .float-btn.scrolling { background: #ffdcbd; color: #173124; }

        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: rotate-slow 20s linear infinite; }
        
        #wishes-container::-webkit-scrollbar {
            width: 4px;
        }
        #wishes-container::-webkit-scrollbar-track {
            background: transparent;
        }
        #wishes-container::-webkit-scrollbar-thumb {
            background: #2B1B17;
            border-radius: 4px;
        }
    </style>
</head>
<body class="font-body-main text-[#2B1B17] max-w-[480px] w-full mx-auto shadow-2xl border-x border-[#1a110d] relative cover-active">
    
    <div class="grain-overlay"></div>

    <!-- Background Audio Element -->
    <audio id="bg-music" loop preload="auto">
        <source src="{{ $musicUrl }}" type="audio/mpeg"/>
    </audio>

    <!-- ==================== COVER SECTION ==================== -->
    <div class="fixed inset-y-0 left-1/2 w-full max-w-[480px] h-screen bg-surface-dim flex flex-col items-center justify-between py-12 px-6 shadow-2xl transition-transform duration-[1200ms] ease-in-out transform -translate-x-1/2 z-[100] overflow-y-auto" id="cover">
        
        <!-- Postage Stamp Ornaments (Top Corners) -->
        <div class="w-full flex justify-between items-start">
            <div class="rotate-[-10deg] opacity-95">
                <div class="w-20 h-24 bg-warm-ivory p-1 border-2 border-dashed border-espresso-brown shadow-md flex flex-col items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-3xl">loyalty</span>
                    <p class="font-label-stamp text-[8px] mt-1.5 font-bold">PAR AVION</p>
                </div>
            </div>
            <div class="rotate-[8deg] opacity-95">
                <div class="w-20 h-24 bg-sage-green p-1 border-2 border-dashed border-espresso-brown shadow-md flex flex-col items-center justify-center text-white">
                    <span class="material-symbols-outlined text-3xl">auto_stories</span>
                    <p class="font-label-stamp text-[8px] mt-1.5 font-bold">SPECIAL DELIV.</p>
                </div>
            </div>
        </div>

        <div class="relative text-center w-full my-auto flex flex-col items-center">
            <div class="mb-6 film-strip-border mx-auto inline-block p-1.5 rotate-[-2deg] bg-white shadow-xl max-w-[240px]">
                <img class="w-full aspect-[3/4] object-cover sepia-[0.3] contrast-125" src="{{ $bg['cover'] }}" alt="Vintage Cover Photo"/>
            </div>
            
            <span class="text-[9px] uppercase tracking-[0.3em] text-primary font-bold mb-2">The Wedding Invitation of</span>
            
            <h1 class="font-display-names text-3xl md:text-4xl text-primary font-black uppercase tracking-tight leading-none px-4 text-center">
                {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
            </h1>
            
            <p class="font-label-stamp text-xs mt-3 text-espresso-brown tracking-widest font-bold">
                {{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') : 'SABTU, 24 AGUSTUS 2026' }}
            </p>

            <!-- Recipient guest card -->
            <div class="bg-white/40 border border-espresso-brown/20 rounded-xl p-3 backdrop-blur-md w-4/5 mt-6 text-center">
                <p class="text-[8px] uppercase tracking-widest text-espresso-brown/60 font-bold block mb-1">Dear Special Guest</p>
                <h3 class="font-serif text-sm font-bold text-espresso-brown">
                    {{ request()->get('kpd', request()->get('to', 'Sahabat & Keluarga Tercinta')) }}
                </h3>
            </div>
        </div>

        <div class="w-full flex justify-center pb-6">
            <button class="wax-seal w-28 h-28 rounded-full flex flex-col items-center justify-center text-white font-label-stamp text-center border-4 border-[#8B2E0E] cursor-pointer animate-pulse active:scale-95" onclick="openInvitation()">
                <span class="material-symbols-outlined text-3xl mb-0.5" style="font-variation-settings: 'FILL' 1;">mail</span>
                <span class="text-[10px] font-bold leading-tight">BUKA<br/>UNDANGAN</span>
            </button>
        </div>
    </div>

    <!-- ==================== TOP NAVIGATION ==================== -->
    <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 flex justify-between items-center px-4 py-3 bg-surface-bright/95 backdrop-blur-sm border-b border-espresso-brown hidden" id="main-nav">
        <div class="flex items-center gap-1.5 text-primary">
            <span class="material-symbols-outlined text-xl">history_edu</span>
            <span class="font-display-names text-sm font-black uppercase">Our Eternal Union</span>
        </div>
        <div class="flex gap-4 items-center">
            <span class="material-symbols-outlined text-primary text-lg">amp</span>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <main class="w-full relative pt-0 pb-28 overflow-hidden hidden" id="main-content">
        
        <!-- HERO SECTION -->
        <section class="py-16 px-6 flex flex-col items-center bg-warm-ivory torn-edge-bottom pb-20 relative" id="love">
            <!-- Vintage Corner Filigree Ornaments -->
            <div class="absolute top-4 left-4 w-12 h-12 border-t-2 border-l-2 border-primary/20"></div>
            <div class="absolute top-4 right-4 w-12 h-12 border-t-2 border-r-2 border-primary/20"></div>
            
            <div class="text-center max-w-sm" data-aos="fade-up">
                <span class="material-symbols-outlined text-tertiary text-3xl mb-2">format_quote</span>
                <p class="font-quote-script text-base italic text-espresso-brown leading-relaxed mb-6 font-serif">
                    "I have for the first time found what I can truly love. I have found you. You are my sympathy—my better self—my good angel; I am bound to you with a strong attachment."
                </p>
                <p class="font-label-stamp text-[9px] text-primary-container tracking-wider font-bold">— Charlotte Brontë, Jane Eyre</p>
            </div>

            <div class="mt-12 flex flex-col items-center w-full space-y-8">
                <div class="relative w-full max-w-[280px]" data-aos="fade-up">
                    <div class="rotate-[-3deg] p-3 bg-white shadow-lg border border-outline-variant">
                        <img class="w-full aspect-[4/5] object-cover grayscale brightness-90 border border-gray-200" src="{{ $bg['hero'] }}" alt="Vintage Hero Couple Photo"/>
                    </div>
                </div>

                <div class="space-y-4 text-center w-full" data-aos="fade-up">
                    <h2 class="font-headline-section text-xl text-primary border-b-2 border-dashed border-primary pb-2 inline-block font-bold">
                        The Story Begins
                    </h2>
                    <p class="text-xs leading-relaxed font-sans max-w-xs mx-auto italic text-gray-700">
                        Bagaikan lembaran film analog tua yang penuh kenangan hangat, perjalanan kisah cinta kami pun terukir indah. Dari perjumpaan perdana hingga ketetapan janji suci hari ini.
                    </p>

                    <!-- Countdown Timer Card -->
                    <div class="bg-white/60 p-4 border border-espresso-brown/20 rounded-xl shadow-inner mt-6 max-w-[280px] mx-auto">
                        <span class="font-label-stamp text-[9px] uppercase tracking-widest text-espresso-brown/50 font-bold block mb-2">Menuju Hari Bahagia</span>
                        <div class="grid grid-cols-4 gap-2 text-center" id="countdown-timer">
                            <div class="bg-primary text-white py-2 px-1 rounded shadow-inner">
                                <span class="block font-headline-section text-lg font-bold" id="days">00</span>
                                <span class="font-label-stamp text-[7px]">HARI</span>
                            </div>
                            <div class="bg-primary text-white py-2 px-1 rounded shadow-inner">
                                <span class="block font-headline-section text-lg font-bold" id="hours">00</span>
                                <span class="font-label-stamp text-[7px]">JAM</span>
                            </div>
                            <div class="bg-primary text-white py-2 px-1 rounded shadow-inner">
                                <span class="block font-headline-section text-lg font-bold" id="minutes">00</span>
                                <span class="font-label-stamp text-[7px]">MENIT</span>
                            </div>
                            <div class="bg-primary text-white py-2 px-1 rounded shadow-inner">
                                <span class="block font-headline-section text-lg font-bold" id="seconds">00</span>
                                <span class="font-label-stamp text-[7px]">DETIK</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MEMPELAI SECTION -->
        <section class="py-16 px-6 bg-surface-bright relative" id="mempelai">
            <div class="text-center w-full mb-12" data-aos="fade-up">
                <span class="text-[9px] uppercase tracking-widest text-espresso-brown/50 font-bold block mb-1">Introducing</span>
                <h2 class="font-display-names text-2xl text-primary font-bold">Kedua Mempelai</h2>
                <div class="w-12 h-[1px] bg-primary mx-auto mt-2"></div>
            </div>

            <div class="flex flex-col items-center space-y-12 w-full">
                <!-- Groom -->
                <div class="flex flex-col items-center text-center space-y-4 w-full" data-aos="fade-up">
                    <div class="relative group max-w-[200px]">
                        <div class="absolute -inset-2.5 border-4 border-double border-[#ffca98]/40 rounded-lg rotate-3 group-hover:rotate-0 transition-transform"></div>
                        <div class="polaroid-frame p-2 rotate-1 group-hover:rotate-0 transition-transform w-44 h-56">
                            <img class="w-full h-full object-cover border border-espresso-brown grayscale" src="{{ $bg['groom'] }}" alt="Groom Photo"/>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-display-names text-xl text-primary font-bold italic">{{ $couple['groom'] }}</h3>
                        <p class="font-label-stamp text-[9px] uppercase font-bold tracking-wider text-espresso-brown/70 mt-1">
                            {{ $couple['parents']['groom'] }}
                        </p>
                    </div>
                </div>

                <!-- Heart Icon Divider -->
                <div class="flex items-center justify-center w-full py-2" data-aos="zoom-in">
                    <span class="material-symbols-outlined text-tertiary text-2xl">favorite</span>
                </div>

                <!-- Bride -->
                <div class="flex flex-col items-center text-center space-y-4 w-full" data-aos="fade-up">
                    <div class="relative group max-w-[200px]">
                        <div class="absolute -inset-2.5 border-4 border-double border-[#ffca98]/40 rounded-lg -rotate-3 group-hover:rotate-0 transition-transform"></div>
                        <div class="polaroid-frame p-2 -rotate-1 group-hover:rotate-0 transition-transform w-44 h-56">
                            <img class="w-full h-full object-cover border border-espresso-brown grayscale" src="{{ $bg['bride'] }}" alt="Bride Photo"/>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-display-names text-xl text-primary font-bold italic">{{ $couple['bride'] }}</h3>
                        <p class="font-label-stamp text-[9px] uppercase font-bold tracking-wider text-espresso-brown/70 mt-1">
                            {{ $couple['parents']['bride'] }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- EVENT DETAILS (TICKET STYLE) -->
        <section class="py-16 px-6 bg-surface-container flex flex-col items-center" id="when">
            <div class="text-center w-full mb-10" data-aos="fade-up">
                <span class="text-[9px] uppercase tracking-widest text-espresso-brown/50 font-bold block mb-1">Rangkaian Acara</span>
                <h2 class="font-display-names text-2xl text-[#7d562d] font-bold">SAVE THE DATE</h2>
                <div class="w-12 h-[1px] bg-[#7d562d] mx-auto mt-2"></div>
            </div>

            <div class="w-full max-w-[320px] flex flex-col gap-8">
                <!-- Ticket 1: Akad Nikah -->
                <div class="relative bg-[#EADBC8] p-6 shadow-xl ticket-edge border-2 border-dashed border-on-secondary-container" data-aos="fade-up">
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-primary text-white px-4 py-0.5 font-label-stamp text-[10px] tracking-widest rounded-full font-bold">
                        AKAD NIKAH
                    </div>
                    <div class="pt-4 space-y-4 text-center">
                        <span class="material-symbols-outlined text-4xl text-tertiary">history_edu</span>
                        <h3 class="font-headline-section text-xl font-bold">Saturday Morning</h3>
                        <p class="font-label-stamp text-sm text-primary font-bold">
                            {{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') : '24 AGUSTUS 2026' }}
                        </p>
                        <div class="h-px w-full border-b border-dashed border-espresso-brown/30 my-2"></div>
                        <p class="font-body-main text-xs font-bold">{{ $schedule[0]['time'] }}</p>
                        <p class="font-headline-section text-sm italic font-bold text-espresso-brown">{{ $schedule[0]['note'] }}</p>
                        <p class="font-body-main text-[10px] text-gray-600 leading-relaxed">{{ $event['address'] }}</p>
                        <a class="inline-block mt-2 text-tertiary font-label-stamp text-[10px] font-bold border-b border-tertiary pb-0.5 hover:text-primary transition-colors" href="{{ $event['maps_url'] }}" target="_blank">LIHAT GOOGLE MAPS</a>
                    </div>
                </div>

                <!-- Ticket 2: Resepsi -->
                <div class="relative bg-[#EADBC8] p-6 shadow-xl ticket-edge border-2 border-dashed border-on-secondary-container" data-aos="fade-up">
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-tertiary text-white px-4 py-0.5 font-label-stamp text-[10px] tracking-widest rounded-full font-bold">
                        RESEPSI
                    </div>
                    <div class="pt-4 space-y-4 text-center">
                        <span class="material-symbols-outlined text-4xl text-primary">restaurant</span>
                        <h3 class="font-headline-section text-xl font-bold">Saturday Evening</h3>
                        <p class="font-label-stamp text-sm text-primary font-bold">
                            {{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') : '24 AGUSTUS 2026' }}
                        </p>
                        <div class="h-px w-full border-b border-dashed border-espresso-brown/30 my-2"></div>
                        <p class="font-body-main text-xs font-bold">{{ $schedule[1]['time'] }}</p>
                        <p class="font-headline-section text-sm italic font-bold text-espresso-brown">{{ $schedule[1]['note'] }}</p>
                        <p class="font-body-main text-[10px] text-gray-600 leading-relaxed">{{ $event['address'] }}</p>
                        <a class="inline-block mt-2 text-tertiary font-label-stamp text-[10px] font-bold border-b border-tertiary pb-0.5 hover:text-primary transition-colors" href="{{ $event['maps_url'] }}" target="_blank">LIHAT GOOGLE MAPS</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- KISAH CINTA SECTION -->
        @if(!empty($stories))
        <section class="py-16 px-6 bg-surface-bright relative" id="story">
            <div class="text-center w-full mb-12" data-aos="fade-up">
                <span class="text-[9px] uppercase tracking-widest text-espresso-brown/50 font-bold block mb-1">Our Journey</span>
                <h2 class="font-display-names text-2xl text-primary font-bold">Love Story</h2>
                <div class="w-12 h-[1px] bg-primary mx-auto mt-2"></div>
            </div>

            <div class="relative w-full max-w-[320px] mx-auto">
                <!-- Center dashed line -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 border-l-2 border-dashed border-primary/20"></div>

                <div class="space-y-10 relative">
                    @foreach($stories as $i => $s)
                    <div class="relative pl-10 text-left" data-aos="fade-up">
                        <!-- Bullet -->
                        <div class="absolute left-1.5 top-1.5 w-5.5 h-5.5 bg-primary border-2 border-white rounded-full flex items-center justify-center shadow-md">
                            <span class="material-symbols-outlined text-white text-[8px] font-bold">favorite</span>
                        </div>
                        <div>
                            <span class="font-label-stamp text-[8px] text-tertiary font-bold uppercase block">{{ $s['date'] }}</span>
                            <h4 class="font-serif text-sm text-espresso-brown font-bold mt-0.5 leading-tight">{{ $s['title'] }}</h4>
                            <p class="font-sans text-[11px] text-gray-600 mt-1.5 leading-relaxed">{{ $s['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- GALLERY (ARTISTIC COLLAGE) -->
        <section class="py-16 px-6 bg-surface-bright relative overflow-visible border-t border-espresso-brown/10" id="gallery">
            <div class="text-center w-full mb-12" data-aos="fade-up">
                <h2 class="font-display-names text-2xl text-primary font-bold">Our Moments</h2>
                <p class="font-label-stamp text-[9px] text-espresso-brown font-bold mt-1">CAPTURED ON ANALOG FILM</p>
                <div class="w-12 h-[1px] bg-primary mx-auto mt-2"></div>
            </div>

            <!-- Collage block -->
            <div class="relative w-full max-w-sm mx-auto flex flex-col gap-6">
                <!-- Polaroid 1 (Rings) -->
                <div class="polaroid-frame -rotate-3 w-56 mx-auto cursor-zoom-in" onclick="openLightbox('{{ $gallery[0] }}')" data-aos="fade-up">
                    <img class="w-full h-auto object-cover border border-gray-100 grayscale hover:grayscale-0 transition duration-300" src="{{ $gallery[0] }}" alt="Gallery Rings"/>
                    <p class="mt-3 font-label-stamp text-[8px] text-center text-espresso-brown font-bold">The Promise</p>
                </div>
                
                <!-- Film Strip Border (Collage center) -->
                <div class="flex gap-2 justify-center py-4 bg-[#1a1a1a] p-2.5 rounded-lg shadow-xl" data-aos="fade-up">
                    <div class="w-20 h-20 overflow-hidden border border-white/20 relative cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                        <img class="object-cover w-full h-full grayscale hover:grayscale-0 transition duration-300" src="{{ $gallery[1] }}" alt="Gallery Walk"/>
                    </div>
                    <div class="w-20 h-20 overflow-hidden border border-white/20 relative cursor-zoom-in" onclick="openLightbox('{{ $gallery[2] }}')">
                        <img class="object-cover w-full h-full grayscale hover:grayscale-0 transition duration-300" src="{{ $gallery[2] }}" alt="Gallery Laugh"/>
                    </div>
                </div>

                <!-- Polaroid 2 (Feast) -->
                <div class="polaroid-frame rotate-3 w-56 mx-auto cursor-zoom-in" onclick="openLightbox('{{ $gallery[4] ?? $gallery[0] }}')" data-aos="fade-up">
                    <img class="w-full h-auto object-cover border border-gray-100" src="{{ $gallery[4] ?? $gallery[0] }}" alt="Gallery Feast"/>
                    <p class="mt-3 font-label-stamp text-[8px] text-center text-espresso-brown font-bold">Wedding Table</p>
                </div>
            </div>

            <!-- Decorative Stamps -->
            <div class="absolute top-[35%] right-[2%] w-16 h-16 bg-[#ffdbcf] border-2 border-white shadow-lg rotate-[15deg] flex items-center justify-center z-10 opacity-70">
                <span class="material-symbols-outlined text-2xl text-on-tertiary-fixed">favorite</span>
            </div>
            <div class="absolute bottom-[35%] left-[2%] w-14 h-14 bg-[#ffca98] border-2 border-white shadow-lg rotate-[-20deg] flex items-center justify-center z-10 opacity-70">
                <span class="material-symbols-outlined text-2xl text-on-secondary-container">mail</span>
            </div>
        </section>

        <!-- RSVP & WISHES (POSTCARD STYLE) -->
        <section class="py-16 px-6 bg-[#f5e6d3] torn-edge-top" id="rsvp">
            <div class="w-full max-w-[320px] mx-auto flex flex-col gap-10">
                
                <!-- RSVP Form -->
                <div class="bg-warm-ivory p-6 border-2 border-espresso-brown shadow-[6px_6px_0px_#2B1B17] relative text-left" data-aos="fade-up">
                    <div class="absolute -top-5 -right-5 w-14 h-14 bg-primary text-white flex items-center justify-center rounded-full border-2 border-warm-ivory shadow-lg rotate-[15deg]">
                        <span class="material-symbols-outlined text-2xl">amp</span>
                    </div>
                    <h2 class="font-headline-section text-lg font-bold mb-6 text-primary">CONFIRM ATTENDANCE</h2>
                    
                    <form class="space-y-4" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-stamp text-[9px] uppercase font-bold text-espresso-brown mb-1">Your Full Name</label>
                            <input class="w-full bg-transparent border-0 border-b-2 border-espresso-brown focus:ring-0 focus:border-primary font-body-main px-0 py-1 text-xs" placeholder="Typewriter name here..." type="text" id="rsvp-nama" required/>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-label-stamp text-[9px] uppercase font-bold text-espresso-brown mb-1">Number of Guests</label>
                                <select class="w-full bg-transparent border-0 border-b-2 border-espresso-brown focus:ring-0 focus:border-primary font-body-main px-0 py-1 text-xs" id="rsvp-jumlah">
                                    <option>1 Person</option>
                                    <option>2 Persons</option>
                                    <option>3 Persons</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-label-stamp text-[9px] uppercase font-bold text-espresso-brown mb-1">Attendance</label>
                                <select class="w-full bg-transparent border-0 border-b-2 border-espresso-brown focus:ring-0 focus:border-primary font-body-main px-0 py-1 text-xs" id="rsvp-kehadiran">
                                    <option value="Hadir">I'm Coming</option>
                                    <option value="Tidak Hadir">So Sorry, I Can't</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-stamp text-[9px] uppercase font-bold text-espresso-brown mb-1">Pesan &amp; Doa Restu</label>
                            <textarea class="w-full bg-transparent border-0 border-b-2 border-espresso-brown focus:ring-0 focus:border-primary font-body-main px-0 py-1 text-xs h-12 resize-none" placeholder="Write your heartfelt message..." id="rsvp-pesan" required></textarea>
                        </div>
                        <button class="w-full bg-primary text-white py-3 font-label-stamp text-[10px] font-bold uppercase tracking-widest hover:bg-primary-container transition-all shadow-md active:scale-95 cursor-pointer mt-2" type="submit">
                            SEND TELEGRAM
                        </button>
                    </form>
                </div>

                <!-- Digital Registry / Kado Digital (Premium copy accounts) -->
                @if(!empty($gifts))
                <div class="bg-warm-ivory p-6 border-2 border-dashed border-espresso-brown shadow-md text-left" data-aos="fade-up">
                    <h2 class="font-display-names text-lg font-bold text-espresso-brown mb-4">Wedding Registry</h2>
                    <p class="font-sans text-[10px] text-gray-600 leading-relaxed mb-6 italic">
                        Kehadiran Anda adalah hadiah terbaik bagi kami. Namun, apabila Anda ingin mengirimkan tanda kasih secara digital, Anda dapat mentransfer ke rekening berikut:
                    </p>
                    <div class="space-y-4">
                        @foreach($gifts as $g)
                        <div onclick="copyAccount('{{ $g['account'] }}', this)" class="bg-[#FAF6F0] p-4 border border-espresso-brown/30 flex justify-between items-center group cursor-pointer hover:border-primary transition-all">
                            <div>
                                <p class="font-label-stamp text-[8px] font-bold opacity-60 uppercase">{{ $g['bank'] }}</p>
                                <p class="font-label-md text-xs font-bold text-espresso-brown mt-0.5">{{ $g['account'] }}</p>
                                <p class="font-body-main text-[9px] text-gray-500 italic mt-0.5">a.n {{ $g['name'] }}</p>
                            </div>
                            <span class="material-symbols-outlined text-primary group-hover:scale-125 transition-transform text-lg">content_copy</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Wishes Feed List -->
                <div class="space-y-6 text-left" data-aos="fade-up">
                    <h2 class="font-headline-section text-lg font-bold text-espresso-brown">WISHES &amp; BLESSINGS</h2>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1" id="wishes-container">
                        @foreach($wishes as $w)
                        <div class="bg-white p-4 shadow-sm border-l-4 border-primary relative text-left">
                            <p class="font-body-main italic text-xs mb-3 text-gray-700 leading-relaxed">"{{ $w['message'] }}"</p>
                            <div class="flex items-center justify-between">
                                <span class="font-label-stamp text-[8px] font-bold text-primary">— {{ $w['name'] }}</span>
                                <span class="text-[7px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border {{ $w['status'] == 'Hadir' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200' }}">{{ $w['status'] }}</span>
                            </div>
                            <span class="absolute top-2 right-2 material-symbols-outlined text-primary opacity-20 text-xs">loyalty</span>
                        </div>
                        @endforeach
                        <div id="wishList" class="space-y-4"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-20 bg-primary text-white text-center px-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10"></div>
            <div class="relative z-10 space-y-6 max-w-xs mx-auto">
                <p class="font-label-stamp text-sm tracking-widest font-bold">UNTIL DEATH DO US PART</p>
                <h2 class="font-display-names text-4xl font-black tracking-tighter">{{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}</h2>
                <div class="flex justify-center gap-4">
                    <span class="material-symbols-outlined text-xl">favorite</span>
                    <span class="material-symbols-outlined text-xl">auto_stories</span>
                    <span class="material-symbols-outlined text-xl">loyalty</span>
                </div>
                <p class="font-body-main text-[10px] text-[#b0cdbb] leading-relaxed max-w-xs mx-auto opacity-80">
                    Designed with love for our friends and family. Thank you for being part of our story.
                </p>
                <p class="font-label-stamp text-[8px] mt-8 opacity-40">EST. 2026 • TemuRuang</p>
            </div>
        </footer>
    </main>

    <!-- ==================== BOTTOM NAV (MOBILE NAV SHELL) ==================== -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[80] bg-[#FAF6F0] rounded-xl flex w-[300px] justify-around items-center py-2 shadow-2xl border-2 border-dashed border-espresso-brown hidden" id="bottom-nav">
        <a class="flex flex-col items-center justify-center text-[#7d562d] hover:text-primary transition-all p-1.5" href="#love" onclick="smoothScroll(event, '#love', this)">
            <span class="material-symbols-outlined text-xl">favorite</span>
            <span class="font-label-stamp text-[8px] mt-0.5 font-bold">Love</span>
        </a>
        <a class="flex flex-col items-center justify-center text-[#7d562d]/50 hover:text-primary transition-all p-1.5" href="#when" onclick="smoothScroll(event, '#when', this)">
            <span class="material-symbols-outlined text-xl">auto_stories</span>
            <span class="font-label-stamp text-[8px] mt-0.5 font-bold">When</span>
        </a>
        <a class="flex flex-col items-center justify-center text-[#7d562d]/50 hover:text-primary transition-all p-1.5" href="#gallery" onclick="smoothScroll(event, '#gallery', this)">
            <span class="material-symbols-outlined text-xl">photo_library</span>
            <span class="font-label-stamp text-[8px] mt-0.5 font-bold">Gallery</span>
        </a>
        <a class="flex flex-col items-center justify-center text-[#7d562d]/50 hover:text-primary transition-all p-1.5" href="#rsvp" onclick="smoothScroll(event, '#rsvp', this)">
            <span class="material-symbols-outlined text-xl">mail</span>
            <span class="font-label-stamp text-[8px] mt-0.5 font-bold">RSVP</span>
        </a>
    </nav>

    <!-- FLOATING ACTION CONTROLS -->
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

    <!-- LIGHTBOX MODAL -->
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
            card.className = 'bg-white p-4 shadow-sm border-l-4 border-primary relative text-left';
            
            const badgeClass = status === 'Hadir' 
                ? 'bg-green-50 text-green-700 border-green-200' 
                : 'bg-red-50 text-red-700 border-red-200';
                
            card.innerHTML = `
                <p class="font-body-main italic text-xs mb-3 text-gray-700 leading-relaxed">"${msg}"</p>
                <div class="flex items-center justify-between">
                    <span class="font-label-stamp text-[8px] font-bold text-primary">— ${name}</span>
                    <span class="text-[7px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border ${badgeClass}">${status}</span>
                </div>
                <span class="absolute top-2 right-2 material-symbols-outlined text-primary opacity-20 text-xs">loyalty</span>
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
                a.classList.remove('text-primary');
                a.classList.add('text-[#7d562d]/50');
            });
            el.classList.remove('text-[#7d562d]/50');
            el.classList.add('text-primary');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            ['wheel', 'touchmove'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });

            // COUNTDOWN TIMER
            const target = new Date("{{ $event['date_iso'] }}T{{ $event['time'] }}").getTime();
            setInterval(() => {
                const now = new Date().getTime();
                const distance = target - now;
                if (distance < 0) return;
                
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                document.getElementById('days').innerText = String(days).padStart(2, '0');
                document.getElementById('hours').innerText = String(hours).padStart(2, '0');
                document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
                document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
            }, 1000);

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
                    a.classList.remove('text-primary');
                    a.classList.add('text-[#7d562d]/50');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-[#7d562d]/50');
                        a.classList.add('text-primary');
                    }
                });
            });
        });
    </script>
</body>
</html>