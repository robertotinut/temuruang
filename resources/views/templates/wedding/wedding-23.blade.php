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
                'groom' => $invitation->description ?? 'Bpk. Sudjatmiko & Ibu Ratnasari',
                'bride' => 'Bpk. Wijaya & Ibu Kartika',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-10-20',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'The Grand Emerald Palace, Jakarta',
            'address' => $invitation->address ?? 'Ballroom Royal Celebration, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Grand Emerald Palace, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'The Grand Emerald Palace, Jakarta'
            ],
            [
                'title' => 'Resepsi',
                'time' => '18:30 - Selesai',
                'note' => $invitation->address ?? 'Ballroom Royal Celebration, Jakarta'
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
                asset('assets/templates/wedding-23/images/image_4.jpg'),
                asset('assets/templates/wedding-23/images/image_5.jpg'),
                asset('assets/templates/wedding-23/images/image_6.jpg'),
                asset('assets/templates/wedding-23/images/image_7.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-23/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-23/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-23/images/image_3.jpg'),
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
                ['name' => 'Hendra', 'status' => 'Hadir', 'message' => 'Selamat Aria & Bima! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
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
                ['bank' => 'BCA', 'name' => 'ARIA KUSUMA', 'account' => '123-456-7890'],
            ];
        }
    } else {
        $couple = [
            'groom' => 'Bima',
            'bride' => 'Aria',
            'parents' => [
                'groom' => 'Bpk. Sudjatmiko & Ibu Ratnasari',
                'bride' => 'Bpk. Wijaya & Ibu Kartika',
            ],
        ];

        $event = [
            'date_iso' => '2024-10-20',
            'time' => '08:00',
            'location' => 'The Grand Emerald Palace, Jakarta',
            'address' => 'Ballroom Royal Celebration, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=The+Grand+Emerald+Palace+Jakarta',
        ];

        $schedule = [
            ['title' => 'AKAD NIKAH', 'time' => '08:00 - 10:00 WIB', 'note' => 'The Grand Emerald Palace, Jakarta'],
            ['title' => 'RESEPSI', 'time' => '18:30 - Selesai', 'note' => 'Ballroom Royal Celebration, Jakarta'],
        ];

        $stories = [
            ['title' => 'First Encounter', 'date' => 'Januari 2020', 'text' => 'Bertemu di sebuah gala megah, pandangan pertama yang mengubah segalanya.'],
            ['title' => 'The Proposal', 'date' => 'Agustus 2022', 'text' => 'Di bawah bintang-bintang, sebuah komitmen suci untuk melangkah bersama selamanya.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-23/images/image_4.jpg'),
            asset('assets/templates/wedding-23/images/image_5.jpg'),
            asset('assets/templates/wedding-23/images/image_6.jpg'),
            asset('assets/templates/wedding-23/images/image_7.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-23/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-23/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-23/images/image_3.jpg'),
        ];

        $wishes = [
            ['name' => 'Hendra', 'status' => 'Hadir', 'message' => 'Selamat Aria & Bima! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'ARIA KUSUMA', 'account' => '123-456-7890'],
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&amp;family=Bodoni+Moda:ital,wght@0,700;1,700&amp;family=Cinzel+Decorative:wght@700;900&amp;display=swap" rel="stylesheet"/>
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
                        "tertiary-container": "#ff92a8",
                        "secondary-container": "#af8d11",
                        "surface-tint": "#4ce346",
                        "outline": "#869580",
                        "on-secondary-container": "#342800",
                        "surface-container-high": "#242c21",
                        "primary-container": "#32cd32",
                        "gold-leaf": "#F9E27E",
                        "inverse-surface": "#dce6d4",
                        "on-primary-fixed": "#002201",
                        "primary-fixed-dim": "#4ce346",
                        "secondary": "#e9c349",
                        "surface-container": "#1a2217",
                        "on-primary-fixed-variant": "#005306",
                        "tertiary": "#ffbcc7",
                        "surface-container-lowest": "#081007",
                        "on-secondary-fixed-variant": "#574500",
                        "primary-fixed": "#75ff68",
                        "on-tertiary-fixed-variant": "#7c293f",
                        "on-tertiary-fixed": "#3f0015",
                        "on-surface-variant": "#bccbb4",
                        "error": "#ffb4ab",
                        "on-surface": "#dce6d4",
                        "surface-container-low": "#161e13",
                        "on-secondary": "#3c2f00",
                        "surface-bright": "#333c30",
                        "royal-black": "#010A01",
                        "surface": "#0e150b",
                        "on-background": "#dce6d4",
                        "deep-emerald": "#042F04",
                        "on-primary": "#003a03",
                        "lime-vibrant": "#ADFF2F",
                        "primary": "#55ea4d",
                        "error-container": "#93000a",
                        "surface-dim": "#0e150b",
                        "secondary-fixed": "#ffe088",
                        "outline-variant": "#3d4a39",
                        "inverse-primary": "#006e0a",
                        "on-error-container": "#ffdad6",
                        "surface-container-highest": "#2f372b",
                        "background": "#0e150b",
                        "surface-variant": "#2f372b",
                        "tertiary-fixed": "#ffd9de",
                        "on-tertiary": "#5e1229",
                        "on-tertiary-container": "#79273d",
                        "on-primary-container": "#005105",
                        "secondary-fixed-dim": "#e9c349",
                        "tertiary-fixed-dim": "#ffb2bf",
                        "on-secondary-fixed": "#241a00",
                        "inverse-on-surface": "#2a3327",
                        "on-error": "#690005"
                    },
                    fontFamily: {
                        "body-main": ["Montserrat"],
                        "display-names": ["Bodoni Moda"],
                        "section-title": ["Cinzel Decorative"],
                        "label-gold": ["Cinzel Decorative"],
                        "display-names-mobile": ["Bodoni Moda"]
                    },
                    fontSize: {
                        "body-main": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "display-names": ["48px", {"lineHeight": "1.1", "letterSpacing": "0.05em", "fontWeight": "700"}],
                        "section-title": ["28px", {"lineHeight": "1.2", "letterSpacing": "0.1em", "fontWeight": "700"}],
                        "label-gold": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.2em", "fontWeight": "600"}],
                        "display-names-mobile": ["36px", {"lineHeight": "1.1", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        body { background-color: #010A01; color: #dce6d4; }
        .glass-panel { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(249, 226, 126, 0.3); background: rgba(85, 234, 77, 0.08); }
        .gold-glow { text-shadow: 0 0 15px rgba(249, 226, 126, 0.8), 0 0 30px rgba(173, 255, 47, 0.5); }
        .lime-glow { box-shadow: 0 0 20px rgba(173, 255, 47, 0.4); }
        
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating { animation: float 6s ease-in-out infinite; }

        .particle-container {
            pointer-events: none;
        }
        .gold-dust {
            position: absolute; background: #F9E27E; border-radius: 50%; opacity: 0.6;
            animation: fall linear infinite;
        }
        @keyframes fall {
            to { transform: translateY(100vh) translateX(20px); }
        }

        .scroll-reveal { opacity: 0; transform: translateY(30px); transition: all 1.0s ease-out; }
        .reveal-active { opacity: 1; transform: translateY(0); }

        .filigree-corner {
            position: absolute; width: 80px; height: 80px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath d='M0,0 Q50,0 50,50 Q100,50 100,100' fill='none' stroke='%23F9E27E' stroke-width='2'/%3E%3Cpath d='M0,20 Q30,20 30,50' fill='none' stroke='%23F9E27E' stroke-width='1'/%3E%3C/svg%3E");
            background-size: contain; opacity: 0.7;
        }

        /* Cover and main content coordination */
        body.cover-active { overflow: hidden; height: 100vh; }
        #main-content { display: none; }

        /* Floating action controls */
        .floater-container {
            position: fixed;
            bottom: 100px;
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
            background: rgba(8, 16, 7, 0.85);
            backdrop-filter: blur(10px);
            border: 2px solid #F9E27E;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #F9E27E;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            transition: all 0.3s;
        }
        .float-btn:hover { background: #F9E27E; color: #010A01; }
        .float-btn.playing .material-symbols-outlined { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .float-btn.scrolling { background: #F9E27E; color: #010A01; }

        /* Bottom Nav styling */
        .bottom-nav-bar {
            position: fixed;
            bottom: 24px;
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
    </style>
</head>
<body class="font-body-main selection:bg-lime-vibrant selection:text-royal-black cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-gold-leaf/20 bg-royal-black text-on-surface min-h-screen relative overflow-x-hidden">

    <!-- constrained particle container -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 particle-container z-10 pointer-events-none" id="particle-host"></div>

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- ==================== 1. COVER SECTION ==================== -->
    <section class="relative h-screen w-full flex items-center justify-center overflow-hidden z-[100]" id="cover">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover opacity-60" src="{{ $bg['cover'] }}" alt="Pre-wedding Cover"/>
            <div class="absolute inset-0 bg-gradient-to-b from-royal-black/80 via-transparent to-royal-black"></div>
        </div>
        <div class="relative z-10 text-center px-6 w-full max-w-sm">
            <h1 class="font-display-names text-display-names text-gold-leaf gold-glow mb-8 tracking-widest leading-none floating uppercase">
                {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
            </h1>
            <div class="glass-panel p-8 rounded-2xl border-gold-leaf/50 shadow-2xl">
                <p class="font-label-gold text-gold-leaf uppercase mb-2 text-xs">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <h2 class="font-section-title text-xl text-lime-vibrant mb-6 truncate">{{ request()->get('kpd', 'Tamu Undangan') }}</h2>
                <button class="group relative px-8 py-4 bg-lime-vibrant text-royal-black rounded-full font-bold text-sm tracking-wider hover:scale-105 transition-transform active:scale-95 lime-glow" onclick="unlockInvitation()">
                    <span class="relative z-10">BUKA UNDANGAN</span>
                    <div class="absolute inset-0 bg-gold-leaf opacity-0 group-hover:opacity-20 rounded-full transition-opacity"></div>
                    <div class="absolute -inset-1 bg-lime-vibrant/30 rounded-full blur animate-pulse z-[-1]"></div>
                </button>
            </div>
        </div>
    </section>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main id="main-content">
        <!-- TOP APP BAR -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 px-6 py-4 flex justify-between items-center bg-gradient-to-b from-royal-black via-royal-black/50 to-transparent">
            <div class="font-section-title text-gold-leaf drop-shadow-[0_0_10px_rgba(173,255,47,0.5)] text-sm tracking-wider uppercase">
                Royal Celebration
            </div>
            <div class="flex gap-4">
                <span class="material-symbols-outlined text-lime-vibrant text-xl">spa</span>
            </div>
        </header>

        <!-- 2. HERO & COUNTDOWN -->
        <section class="relative min-h-screen py-32 flex flex-col items-center justify-center text-center px-4" id="home">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover opacity-20" src="{{ $bg['cover'] }}" alt="Hero Background"/>
                <div class="absolute inset-0 bg-gradient-to-t from-royal-black via-royal-black/50 to-royal-black"></div>
            </div>
            <div class="scroll-reveal container mx-auto relative z-20 flex flex-col items-center">
                <h2 class="font-section-title text-gold-leaf mb-4 tracking-widest text-lg">SAVE THE DATE</h2>
                <div class="w-24 h-0.5 bg-gradient-to-r from-transparent via-gold-leaf to-transparent mx-auto mb-12"></div>
                
                <h1 class="font-display-names text-4xl text-lime-vibrant mb-8 tracking-widest uppercase">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>

                <div class="grid grid-cols-4 gap-4 max-w-sm w-full mx-auto">
                    <div class="glass-panel py-4 rounded-xl border border-gold-leaf/40 relative overflow-hidden group">
                        <div class="filigree-corner top-0 left-0 scale-50 -translate-x-6 -translate-y-6"></div>
                        <span class="block font-display-names text-3xl text-lime-vibrant mb-1" id="days">00</span>
                        <span class="font-label-gold text-gold-leaf text-[9px] uppercase tracking-widest">HARI</span>
                    </div>
                    <div class="glass-panel py-4 rounded-xl border border-gold-leaf/40 relative overflow-hidden group">
                        <div class="filigree-corner top-0 right-0 scale-50 translate-x-6 -translate-y-6 rotate-90"></div>
                        <span class="block font-display-names text-3xl text-lime-vibrant mb-1" id="hours">00</span>
                        <span class="font-label-gold text-gold-leaf text-[9px] uppercase tracking-widest">JAM</span>
                    </div>
                    <div class="glass-panel py-4 rounded-xl border border-gold-leaf/40 relative overflow-hidden group">
                        <div class="filigree-corner bottom-0 left-0 scale-50 -translate-x-6 translate-y-6 -rotate-90"></div>
                        <span class="block font-display-names text-3xl text-lime-vibrant mb-1" id="mins">00</span>
                        <span class="font-label-gold text-gold-leaf text-[9px] uppercase tracking-widest">MENIT</span>
                    </div>
                    <div class="glass-panel py-4 rounded-xl border border-gold-leaf/40 relative overflow-hidden group">
                        <div class="filigree-corner bottom-0 right-0 scale-50 translate-x-6 translate-y-6 rotate-180"></div>
                        <span class="block font-display-names text-3xl text-lime-vibrant mb-1" id="secs">00</span>
                        <span class="font-label-gold text-gold-leaf text-[9px] uppercase tracking-widest">DETIK</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. MEMPELAI -->
        <section class="py-24 bg-royal-black/50 px-4" id="mempelai">
            <div class="container mx-auto">
                <div class="flex flex-col items-center gap-16">
                    <!-- Groom -->
                    <div class="scroll-reveal text-center max-w-sm w-full flex flex-col items-center">
                        <div class="relative mb-8 inline-block">
                            <div class="absolute inset-0 bg-lime-vibrant blur-3xl opacity-20 -z-10"></div>
                            <div class="w-60 h-76 rounded-[120px] border-4 border-gold-leaf p-2 overflow-hidden floating">
                                <img class="w-full h-full object-cover rounded-[112px] grayscale hover:grayscale-0 transition-all duration-700" src="{{ $bg['groom'] }}" alt="Portrait of Groom"/>
                            </div>
                            <div class="absolute -bottom-4 -right-4 w-20 h-20 filigree-corner opacity-100 scale-120 rotate-180"></div>
                        </div>
                        <h3 class="font-display-names text-3xl text-gold-leaf gold-glow mb-2">{{ $couple['groom'] }}</h3>
                        <p class="font-label-gold text-lime-vibrant text-xs mb-3 tracking-widest uppercase">Putra dari</p>
                        <p class="text-on-surface-variant font-medium text-xs">{{ $couple['parents']['groom'] }}</p>
                    </div>

                    <div class="scroll-reveal font-display-names text-5xl text-lime-vibrant font-light my-2">&amp;</div>

                    <!-- Bride -->
                    <div class="scroll-reveal text-center max-w-sm w-full flex flex-col items-center">
                        <div class="relative mb-8 inline-block">
                            <div class="absolute inset-0 bg-lime-vibrant blur-3xl opacity-20 -z-10"></div>
                            <div class="w-60 h-76 rounded-[120px] border-4 border-gold-leaf p-2 overflow-hidden floating" style="animation-delay: -2s;">
                                <img class="w-full h-full object-cover rounded-[112px] grayscale hover:grayscale-0 transition-all duration-700" src="{{ $bg['bride'] }}" alt="Portrait of Bride"/>
                            </div>
                            <div class="absolute -top-4 -left-4 w-20 h-20 filigree-corner opacity-100 scale-120"></div>
                        </div>
                        <h3 class="font-display-names text-3xl text-gold-leaf gold-glow mb-2">{{ $couple['bride'] }}</h3>
                        <p class="font-label-gold text-lime-vibrant text-xs mb-3 tracking-widest uppercase">Putri dari</p>
                        <p class="text-on-surface-variant font-medium text-xs">{{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. ACARA -->
        <section class="py-24 relative overflow-hidden px-4" id="calendar">
            <div class="container mx-auto">
                <div class="flex flex-col gap-8">
                    @foreach($schedule as $i => $sch)
                    <div class="scroll-reveal glass-panel p-8 rounded-3xl relative overflow-hidden border border-gold-leaf/30 shadow-xl">
                        <div class="filigree-corner top-0 right-0 scale-75 translate-x-4 -translate-y-4 rotate-90 opacity-60"></div>
                        <h3 class="font-section-title text-lime-vibrant text-lg mb-6 flex items-center gap-3 justify-center">
                            <span class="material-symbols-outlined text-xl text-gold-leaf">{{ $i === 0 ? 'favorite' : 'celebration' }}</span>
                            {{ strtoupper($sch['title']) }}
                        </h3>
                        <div class="space-y-3.5 text-on-surface text-sm max-w-xs mx-auto">
                            <p class="flex items-center gap-3.5 justify-center"><span class="material-symbols-outlined text-gold-leaf text-base">event</span> {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            <p class="flex items-center gap-3.5 justify-center"><span class="material-symbols-outlined text-gold-leaf text-base">schedule</span> Pukul {{ $sch['time'] }}</p>
                            <p class="flex items-center gap-3.5 justify-center"><span class="material-symbols-outlined text-gold-leaf text-base">pin_drop</span> {{ $sch['note'] }}</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- Location details card -->
                    <div class="scroll-reveal glass-panel p-8 rounded-3xl relative overflow-hidden border border-lime-vibrant/20 shadow-xl text-center">
                        <div class="filigree-corner bottom-0 left-0 scale-75 -translate-x-4 translate-y-4 -rotate-90 opacity-60"></div>
                        <h4 class="font-bold text-gold-leaf text-sm mb-2 uppercase tracking-widest">{{ $event['location'] }}</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed mb-6">{{ $event['address'] }}</p>
                        
                        <div class="flex flex-col gap-3 max-w-xs mx-auto">
                            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="w-full bg-lime-vibrant text-royal-black py-3 rounded-full font-bold flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform text-xs shadow-md">
                                <span class="material-symbols-outlined text-base">map</span> BUKA GOOGLE MAPS
                            </a>
                            <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($couple['groom'] . ' & ' . $couple['bride'] . ' Wedding') }}&dates={{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T080000Z/{{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T210000Z&details=Pernikahan+{{ urlencode($couple['groom'] . '+&+' . $couple['bride']) }}&location={{ urlencode($event['location']) }}" target="_blank" rel="noopener" class="w-full border border-gold-leaf text-gold-leaf py-3 rounded-full font-bold flex items-center justify-center gap-2 hover:bg-gold-leaf/10 transition-colors text-xs">
                                <span class="material-symbols-outlined text-base">calendar_add_on</span> SIMPAN TANGGAL
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. KISAH CINTA -->
        <section class="py-24 bg-royal-black px-4" id="kisah">
            <div class="container mx-auto">
                <h2 class="font-section-title text-center text-gold-leaf mb-16 gold-glow text-xl tracking-widest">JOURNEY OF LOVE</h2>
                <div class="relative w-full max-w-sm mx-auto">
                    <!-- center line -->
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 h-full w-0.5 bg-gradient-to-b from-transparent via-gold-leaf/40 to-transparent"></div>
                    <div class="space-y-16">
                        @foreach($stories as $index => $s)
                        <div class="scroll-reveal flex flex-col items-center gap-6 relative">
                            <!-- timeline node icon -->
                            <div class="w-10 h-10 rounded-full {{ $index % 2 == 0 ? 'bg-lime-vibrant lime-glow' : 'bg-gold-leaf gold-glow' }} border-4 border-royal-black z-10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-royal-black text-sm">
                                    {{ $index % 2 == 0 ? 'favorite' : 'diamond' }}
                                </span>
                            </div>
                            <!-- Journey Card -->
                            <div class="glass-panel p-6 rounded-2xl border border-gold-leaf/20 shadow-xl w-full text-center relative overflow-hidden group">
                                <div class="absolute inset-1.5 border border-dashed border-gold-leaf/10 rounded-xl pointer-events-none"></div>
                                <h4 class="font-label-gold text-lime-vibrant text-[10px] tracking-widest mb-1">{{ strtoupper($s['date']) }}</h4>
                                <h3 class="font-display-names text-lg text-gold-leaf mb-2">{{ $s['title'] }}</h3>
                                <p class="text-on-surface-variant text-xs leading-relaxed font-light">"{{ $s['text'] }}"</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. GALLERY MOMENTS -->
        <section class="py-24 overflow-hidden bg-deep-emerald/20 px-4" id="photo_library">
            <div class="container mx-auto">
                <h2 class="font-section-title text-center text-lime-vibrant mb-16 tracking-[0.4em] text-lg">MOMENTS</h2>
                <!-- Asymmetric stack height container -->
                <div class="relative w-full max-w-sm mx-auto min-h-[580px]">
                    @if(isset($gallery[0]))
                    <div class="scroll-reveal group absolute top-0 left-0 w-[170px] rotate-[-5deg] hover:rotate-0 transition-transform duration-500 z-20 cursor-zoom-in" onclick="openLightbox('{{ $gallery[0] }}')">
                        <div class="p-2.5 bg-white shadow-2xl border-[6px] border-gold-leaf rounded-sm">
                            <img class="w-full aspect-[4/5] object-cover grayscale hover:grayscale-0 transition-all duration-300" src="{{ $gallery[0] }}" alt="Gallery Item 1"/>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($gallery[1]))
                    <div class="scroll-reveal group absolute top-20 right-0 w-[190px] rotate-[3deg] hover:rotate-0 transition-transform duration-500 z-10 cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                        <div class="p-2.5 bg-white shadow-2xl border-[6px] border-lime-vibrant rounded-sm">
                            <img class="w-full aspect-[3/4] object-cover grayscale hover:grayscale-0 transition-all duration-300" src="{{ $gallery[1] }}" alt="Gallery Item 2"/>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($gallery[2]))
                    <div class="scroll-reveal group absolute bottom-0 left-2 w-[180px] rotate-[-2deg] hover:rotate-0 transition-transform duration-500 z-20 cursor-zoom-in" onclick="openLightbox('{{ $gallery[2] }}')">
                        <div class="p-2.5 bg-white shadow-2xl border-[6px] border-gold-leaf rounded-sm">
                            <img class="w-full aspect-square object-cover grayscale hover:grayscale-0 transition-all duration-300" src="{{ $gallery[2] }}" alt="Gallery Item 3"/>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($gallery[3]))
                    <div class="scroll-reveal group absolute bottom-12 right-2 w-[160px] rotate-[10deg] hover:rotate-0 transition-transform duration-500 z-10 cursor-zoom-in" onclick="openLightbox('{{ $gallery[3] }}')">
                        <div class="p-2.5 bg-white shadow-2xl border-[6px] border-lime-vibrant rounded-sm">
                            <img class="w-full aspect-[4/5] object-cover grayscale hover:grayscale-0 transition-all duration-300" src="{{ $gallery[3] }}" alt="Gallery Item 4"/>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- 7. RSVP & GUESTBOOK -->
        <section class="py-24 px-4" id="rsvp">
            <div class="container mx-auto max-w-sm">
                <div class="glass-panel p-8 rounded-3xl relative overflow-hidden border border-gold-leaf/30 shadow-2xl">
                    <div class="filigree-corner top-0 left-0 scale-75 -translate-x-4 -translate-y-4 opacity-50"></div>
                    <div class="filigree-corner bottom-0 right-0 scale-75 translate-x-4 translate-y-4 rotate-180 opacity-50"></div>
                    
                    <h2 class="font-section-title text-center text-gold-leaf mb-8 text-base tracking-widest">GUEST RSVP</h2>
                    
                    <form class="space-y-5" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-gold text-lime-vibrant mb-2 text-[10px]">Nama Lengkap</label>
                            <input class="w-full bg-transparent border-0 border-b-2 border-gold-leaf text-on-surface focus:border-lime-vibrant focus:ring-0 transition-colors p-2 text-xs placeholder:text-surface-variant/40" id="rsvp-nama" placeholder="Contoh: Budi Santoso" type="text" required/>
                        </div>
                        <div>
                            <label class="block font-label-gold text-lime-vibrant mb-2 text-[10px]">Jumlah Tamu</label>
                            <select class="w-full bg-transparent border-0 border-b-2 border-gold-leaf text-on-surface focus:border-lime-vibrant focus:ring-0 p-2 text-xs" id="rsvp-guests">
                                <option class="bg-royal-black" value="1">1 Orang</option>
                                <option class="bg-royal-black" value="2">2 Orang</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-gold text-lime-vibrant mb-2 text-[10px]">Konfirmasi Kehadiran</label>
                            <div class="flex gap-6 mt-1.5 px-1">
                                <label class="flex items-center gap-2 cursor-pointer group text-xs">
                                    <input class="form-radio text-lime-vibrant bg-transparent border-gold-leaf focus:ring-0" name="status" type="radio" value="Hadir" checked id="status-hadir"/>
                                    <span class="text-on-surface group-hover:text-gold-leaf transition-colors">Hadir</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer group text-xs">
                                    <input class="form-radio text-lime-vibrant bg-transparent border-gold-leaf focus:ring-0" name="status" type="radio" value="Tidak Hadir" id="status-absen"/>
                                    <span class="text-on-surface group-hover:text-gold-leaf transition-colors">Maaf, Berhalangan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-gold text-lime-vibrant mb-2 text-[10px]">Ucapan &amp; Doa Restu</label>
                            <textarea class="w-full bg-transparent border border-gold-leaf/30 rounded-xl text-on-surface focus:border-lime-vibrant focus:ring-0 p-3 placeholder:text-surface-variant/50 text-xs h-24 resize-none" id="rsvp-pesan" placeholder="Tulis ucapan dan doa restu Anda..." required></textarea>
                        </div>
                        <button class="w-full bg-lime-vibrant text-royal-black py-3 rounded-full font-bold text-xs hover:bg-gold-leaf transition-all lime-glow tracking-widest" type="submit">
                            KIRIM RSVP
                        </button>
                    </form>

                    <!-- wishes output -->
                    <div class="mt-8 max-h-[200px] overflow-y-auto space-y-3.5 pr-1.5 scrollbar-thin text-left border-t border-gold-leaf/20 pt-6" id="wishes-container">
                        @foreach($wishes as $w)
                        <div class="border-b border-gold-leaf/15 pb-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-bold text-gold-leaf text-xs">{{ $w['name'] }}</span>
                                <span class="text-[8px] bg-lime-vibrant/10 text-lime-vibrant px-2 py-0.5 rounded-full border border-lime-vibrant/20 font-semibold">{{ $w['status'] }}</span>
                            </div>
                            <p class="text-[11px] text-on-surface-variant font-light italic">"{{ $w['message'] }}"</p>
                        </div>
                        @endforeach
                        <div id="wishListDirect"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 8. KADO DIGITAL -->
        <section class="py-24 bg-deep-emerald/30 px-4" id="gift">
            <div class="container mx-auto max-w-sm text-center">
                <div class="glass-panel p-8 rounded-3xl border border-gold-leaf/40 shadow-2xl">
                    <span class="material-symbols-outlined text-5xl text-lime-vibrant mb-4 floating">card_giftcard</span>
                    <h2 class="font-section-title text-gold-leaf mb-2 text-base tracking-widest">WEDDING GIFT</h2>
                    <p class="text-on-surface-variant text-xs mb-8 px-4 leading-relaxed font-light">Doa restu Anda adalah kado terindah, namun jika Anda ingin memberikan tanda kasih, silakan melalui saluran berikut:</p>
                    
                    <div class="space-y-4">
                        @foreach($gifts as $gift)
                        <div class="bg-royal-black/50 p-5 rounded-2xl border border-gold-leaf/25 flex flex-col items-center gap-3">
                            <div class="text-center w-full">
                                <p class="font-bold text-lime-vibrant text-xs uppercase tracking-widest">{{ strtoupper($gift['bank']) }}</p>
                                <p class="text-xl font-display-names text-gold-leaf my-1 tracking-widest">{{ $gift['account'] }}</p>
                                <p class="text-[9px] uppercase tracking-widest text-on-surface-variant font-medium">A/N {{ $gift['name'] }}</p>
                            </div>
                            <button class="w-full py-2 bg-gold-leaf text-royal-black rounded-full font-bold text-[10px] hover:scale-105 transition-all flex items-center justify-center gap-1.5" onclick="copyRek('{{ $gift['account'] }}', this)">
                                <span class="material-symbols-outlined text-sm">content_copy</span> SALIN NO. REK
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. FOOTER -->
        <footer class="py-24 text-center relative overflow-hidden px-4">
            <div class="container mx-auto relative z-10 flex flex-col items-center">
                <div class="w-16 h-px bg-gold-leaf mx-auto mb-10"></div>
                <p class="font-display-names italic text-lg text-on-surface-variant mb-10 max-w-xs mx-auto leading-relaxed px-2">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya."
                </p>
                <div class="font-display-names text-4xl text-gold-leaf gold-glow mb-6 tracking-[0.2em] leading-tight uppercase">
                    {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
                </div>
                <p class="font-label-gold text-lime-vibrant uppercase tracking-[0.4em] text-[10px]">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
                </p>
                <div class="w-16 h-[1px] bg-gold-leaf/20 my-6"></div>
                <p class="font-body-main text-[10px] text-on-surface-variant font-light">Created with <span class="text-lime-vibrant">♥</span> TemuRuang</p>
            </div>
        </footer>

        <!-- BOTTOM NAV BAR -->
        <nav class="bottom-nav-bar" id="mobileNav" style="display:none;">
            <div class="flex justify-around items-center py-2 px-3 bg-primary/10 backdrop-blur-xl border border-gold-leaf/30 rounded-full shadow-[0_0_20px_rgba(173,255,47,0.3)]">
                <a class="flex flex-col items-center justify-center bg-lime-vibrant text-royal-black rounded-full p-2.5 shadow-[0_0_12px_#ADFF2F] transition-all" href="#home" onclick="smoothScroll(event, '#home', this)">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">home</span>
                </a>
                <a class="flex flex-col items-center justify-center text-gold-leaf p-2.5 opacity-70 hover:opacity-100 hover:text-lime-vibrant transition-all" href="#mempelai" onclick="smoothScroll(event, '#mempelai', this)">
                    <span class="material-symbols-outlined text-[18px]">favorite</span>
                </a>
                <a class="flex flex-col items-center justify-center text-gold-leaf p-2.5 opacity-70 hover:opacity-100 hover:text-lime-vibrant transition-all" href="#calendar" onclick="smoothScroll(event, '#calendar', this)">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                </a>
                <a class="flex flex-col items-center justify-center text-gold-leaf p-2.5 opacity-70 hover:opacity-100 hover:text-lime-vibrant transition-all" href="#photo_library" onclick="smoothScroll(event, '#photo_library', this)">
                    <span class="material-symbols-outlined text-[18px]">photo_library</span>
                </a>
                <a class="flex flex-col items-center justify-center text-gold-leaf p-2.5 opacity-70 hover:opacity-100 hover:text-lime-vibrant transition-all" href="#rsvp" onclick="smoothScroll(event, '#rsvp', this)">
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

    <!-- Scripts -->
    <script>
        let isAutoscrolling = false;
        const autoscrollSpeed = 0.6;

        function createParticles() {
            const host = document.getElementById('particle-host');
            if (!host) return;
            const count = 35;
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.className = 'gold-dust';
                p.style.left = Math.random() * 100 + '%';
                const size = (Math.random() * 3 + 1);
                p.style.width = p.style.height = size + 'px';
                p.style.animationDuration = (Math.random() * 5 + 5) + 's';
                p.style.animationDelay = (Math.random() * 5) + 's';
                host.appendChild(p);
            }
        }

        function unlockInvitation() {
            const cover = document.getElementById('cover');
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
                initScrollReveal();
                startAutoscroll();
            }, 1000);
        }

        function initScrollReveal() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-active');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
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
                document.getElementById('mins').innerText = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                document.getElementById('secs').innerText = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
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
            card.className = 'border-b border-gold-leaf/15 pb-3 text-left';
            card.innerHTML = `<div class="flex justify-between items-center mb-1"><span class="font-bold text-gold-leaf text-xs">${name}</span><span class="text-[8px] bg-lime-vibrant/10 text-lime-vibrant px-2 py-0.5 rounded-full border border-lime-vibrant/20 font-semibold">${status}</span></div><p class="text-[11px] text-on-surface-variant font-light italic">"${msg}"</p>`;
            
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
                a.classList.remove('bg-lime-vibrant', 'text-royal-black', 'shadow-[0_0_12px_#ADFF2F]');
                a.classList.add('text-gold-leaf');
            });
            el.classList.remove('text-gold-leaf');
            el.classList.add('bg-lime-vibrant', 'text-royal-black', 'shadow-[0_0_12px_#ADFF2F]');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            createParticles();
            initCountdown();
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
                        current = section.getAttribute("id");
                    }
                });

                document.querySelectorAll('.bottom-nav-bar a').forEach((a) => {
                    a.classList.remove('bg-lime-vibrant', 'text-royal-black', 'shadow-[0_0_12px_#ADFF2F]');
                    a.classList.add('text-gold-leaf');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-gold-leaf');
                        a.classList.add('bg-lime-vibrant', 'text-royal-black', 'shadow-[0_0_12px_#ADFF2F]');
                    }
                });
            });
        });
    </script>
</body>
</html>