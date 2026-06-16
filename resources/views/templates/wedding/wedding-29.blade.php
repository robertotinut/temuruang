@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Elias');
        $brideName = trim($names[1] ?? 'Jada');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Ahmad Suherman & Ibu Sari Widowati',
                'bride' => 'Bpk. Hendra Wijaya & Ibu Linda Permata',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-05-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Grand Ballroom Hotel Mulia',
            'address' => $invitation->address ?? 'Jl. Asia Afrika, Senayan, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Grand Ballroom Hotel Mulia, Senayan, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Masjid Agung Al-Barkah, Jl. Veteran No. 1, Bekasi'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '11:00 - 14:00 WIB',
                'note' => $invitation->address ?? 'Grand Ballroom Hotel Mulia, Jl. Asia Afrika, Jakarta'
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
                ['title' => 'Pertemuan Pertama', 'date' => 'Agustus 2021', 'text' => 'Di sebuah sudut kota, takdir mempertemukan dua jiwa yang tak saling mengenal, namun merasa begitu akrab.'],
                ['title' => 'Membangun Mimpi', 'date' => 'Januari 2023', 'text' => 'Setiap tawa dan air mata menjadi pondasi bagi istana cinta yang sedang kita bangun bersama.'],
                ['title' => 'Janji Suci', 'date' => 'Mei 2024', 'text' => 'Dua cincin, satu janji, dan selamanya untuk saling menjaga dalam ikatan yang diberkati.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-29/images/image_10.jpg'),
                asset('assets/templates/wedding-29/images/image_11.jpg'),
                asset('assets/templates/wedding-29/images/image_12.jpg'),
                asset('assets/templates/wedding-29/images/image_13.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-29/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-29/images/image_2.jpg'),
            'hero_small_1' => asset('assets/templates/wedding-29/images/image_3.jpg'),
            'hero_small_2' => asset('assets/templates/wedding-29/images/image_4.jpg'),
            'story_1' => asset('assets/templates/wedding-29/images/image_5.jpg'),
            'story_2' => asset('assets/templates/wedding-29/images/image_6.jpg'),
            'story_3' => asset('assets/templates/wedding-29/images/image_7.jpg'),
            'groom' => asset('assets/templates/wedding-29/images/image_8.jpg'),
            'bride' => asset('assets/templates/wedding-29/images/image_9.jpg'),
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
                ['name' => 'Diana & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat ya Elias & Jada! Semoga menjadi keluarga sakinah mawaddah warahmah. Bahagia selamanya!'],
                ['name' => 'Rafi Alfian', 'status' => 'Hadir', 'message' => 'Happy wedding bro! Lancar-lancar sampe hari H ya. See you there!'],
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
                ['bank' => 'BCA', 'name' => 'Elias Putra', 'account' => '123 456 7890'],
                ['bank' => 'Mandiri', 'name' => 'Jada Amira', 'account' => '098 765 4321'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Elias',
            'bride' => 'Jada',
            'parents' => [
                'groom' => 'Bpk. Ahmad Suherman & Ibu Sari Widowati',
                'bride' => 'Bpk. Hendra Wijaya & Ibu Linda Permata',
            ],
        ];

        $event = [
            'date_iso' => '2024-05-12',
            'time' => '08:00',
            'location' => 'Grand Ballroom Hotel Mulia',
            'address' => 'Jl. Asia Afrika, Senayan, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=Hotel+Mulia+Senayan',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'Masjid Agung Al-Barkah, Jl. Veteran No. 1, Bekasi'],
            ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - 14:00 WIB', 'note' => 'Grand Ballroom Hotel Mulia, Jl. Asia Afrika, Jakarta'],
        ];

        $stories = [
            ['title' => 'Pertemuan Pertama', 'date' => 'Agustus 2021', 'text' => 'Di sebuah sudut kota, takdir mempertemukan dua jiwa yang tak saling mengenal, namun merasa begitu akrab.'],
            ['title' => 'Membangun Mimpi', 'date' => 'Januari 2023', 'text' => 'Setiap tawa dan air mata menjadi pondasi bagi istana cinta yang sedang kita bangun bersama.'],
            ['title' => 'Janji Suci', 'date' => 'Mei 2024', 'text' => 'Dua cincin, satu janji, dan selamanya untuk saling menjaga dalam ikatan yang diberkati.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-29/images/image_10.jpg'),
            asset('assets/templates/wedding-29/images/image_11.jpg'),
            asset('assets/templates/wedding-29/images/image_12.jpg'),
            asset('assets/templates/wedding-29/images/image_13.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-29/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-29/images/image_2.jpg'),
            'hero_small_1' => asset('assets/templates/wedding-29/images/image_3.jpg'),
            'hero_small_2' => asset('assets/templates/wedding-29/images/image_4.jpg'),
            'story_1' => asset('assets/templates/wedding-29/images/image_5.jpg'),
            'story_2' => asset('assets/templates/wedding-29/images/image_6.jpg'),
            'story_3' => asset('assets/templates/wedding-29/images/image_7.jpg'),
            'groom' => asset('assets/templates/wedding-29/images/image_8.jpg'),
            'bride' => asset('assets/templates/wedding-29/images/image_9.jpg'),
        ];

        $wishes = [
            ['name' => 'Diana & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat ya Elias & Jada! Semoga menjadi keluarga sakinah mawaddah warahmah. Bahagia selamanya!'],
            ['name' => 'Rafi Alfian', 'status' => 'Hadir', 'message' => 'Happy wedding bro! Lancar-lancar sampe hari H ya. See you there!'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Elias Putra', 'account' => '123 456 7890'],
            ['bank' => 'Mandiri', 'name' => 'Jada Amira', 'account' => '098 765 4321'],
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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&amp;family=Outfit:wght@400;600&amp;family=Libre+Franklin:wght@400&amp;family=Epilogue:wght@300&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "outline-variant": "#bfc9c3",
                        "on-tertiary-fixed": "#002115",
                        "surface-container-highest": "#e5e2db",
                        "secondary-fixed-dim": "#b9cbb9",
                        "surface-bright": "#fcf9f2",
                        "tertiary-fixed-dim": "#a8cfbc",
                        "inverse-primary": "#95d3ba",
                        "on-background": "#1c1c18",
                        "primary-container": "#064e3b",
                        "on-primary-fixed-variant": "#0b513d",
                        "secondary-container": "#d2e4d2",
                        "emerald-deep": "#064E3B",
                        "on-secondary": "#ffffff",
                        "surface-container-high": "#ebe8e1",
                        "primary": "#003527",
                        "on-primary": "#ffffff",
                        "tertiary": "#0e3427",
                        "surface": "#fcf9f2",
                        "on-tertiary": "#ffffff",
                        "gold-dust": "#D4AF37",
                        "mint-accent": "#D1FAE5",
                        "surface-tint": "#2b6954",
                        "inverse-on-surface": "#f3f0e9",
                        "on-error": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-fixed-variant": "#294e3f",
                        "on-secondary-container": "#566758",
                        "error": "#ba1a1a",
                        "secondary": "#526254",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
                        "surface-variant": "#e5e2db",
                        "sage-muted": "#7A8B7B",
                        "on-secondary-fixed": "#101f13",
                        "on-tertiary-container": "#93baa7",
                        "inverse-surface": "#31312c",
                        "on-surface-variant": "#404944",
                        "secondary-fixed": "#d5e7d5",
                        "alabaster-white": "#FAF9F6",
                        "on-primary-fixed": "#002117",
                        "tertiary-fixed": "#c3ecd7",
                        "surface-container": "#f1eee7",
                        "on-secondary-fixed-variant": "#3b4b3d",
                        "on-surface-variant": "#404944",
                        "primary-fixed-dim": "#95d3ba",
                        "surface-container-low": "#f6f3ec",
                        "warm-beige-bg": "#F4F1EA",
                        "tertiary-container": "#274b3c",
                        "surface-dim": "#dcdad3",
                        "background": "#fcf9f2",
                        "primary-fixed": "#b0f0d6",
                        "on-surface": "#1c1c18"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "gutter-md": "1.5rem",
                        "section-gap": "5rem",
                        "margin-page": "2rem",
                        "stack-overlap": "-2rem"
                    },
                    fontFamily: {
                        "label-caps": ["Outfit"],
                        "headline-lg-mobile": ["Playfair Display"],
                        "couple-name": ["Playfair Display"],
                        "body-md": ["Libre Franklin"],
                        "headline-lg": ["Playfair Display"],
                        "script-grand": ["Epilogue"]
                    },
                    fontSize: {
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "couple-name": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "900"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "headline-lg": ["40px", {"lineHeight": "48px", "fontWeight": "700"}],
                        "script-grand": ["48px", {"lineHeight": "56px", "fontWeight": "300"}]
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
        .washi-tape {
            background: rgba(209, 250, 229, 0.6);
            mask-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 0 L10 5 L20 0 L30 5 L40 0 L50 5 L60 0 L70 5 L80 0 L90 5 L100 0 V20 L90 15 L80 20 L70 15 L60 20 L50 15 L40 20 L30 15 L20 20 L10 15 L0 20 Z" fill="black"/></svg>');
            -webkit-mask-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 0 L10 5 L20 0 L30 5 L40 0 L50 5 L60 0 L70 5 L80 0 L90 5 L100 0 V20 L90 15 L80 20 L70 15 L60 20 L50 15 L40 20 L30 15 L20 20 L10 15 L0 20 Z" fill="black"/></svg>');
            mask-repeat: repeat-x;
            -webkit-mask-repeat: repeat-x;
        }
        .polaroid {
            box-shadow: 0 4px 12px rgba(6, 78, 59, 0.1);
        }
        .gold-sparkle {
            background-image: radial-gradient(circle, #D4AF37 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-up.reveal-active {
            opacity: 1;
            transform: translateY(0);
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
            background: rgba(6, 78, 59, 0.85);
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
        .float-btn:hover { background: #D4AF37; color: #064E3B; }
        .float-btn.paused .material-symbols-outlined { color: #7A8B7B; }
        .float-btn.scrolling { background: #D4AF37; color: #064E3B; }
        
        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: rotate-slow 20s linear infinite; }

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
<body class="bg-background text-on-background font-body-md cover-active max-w-[480px] w-full mx-auto shadow-2xl border-x border-emerald-deep/10 relative selection:bg-gold-dust/30">

    <!-- Audio Element -->
    <audio id="bg-audio" loop preload="auto">
        <source src="{{ $musicUrl }}" type="audio/mpeg">
    </audio>

    <!-- ==================== OVERLAY COVER ==================== -->
    <section class="fixed inset-0 z-[100] bg-emerald-deep flex flex-col justify-between items-center py-14 px-8 overflow-hidden max-w-[480px] w-full mx-auto shadow-2xl" id="cover">
        <div class="absolute inset-0 gold-sparkle opacity-20"></div>
        <!-- Decorative Botanicals -->
        <div class="absolute -top-10 -left-10 w-64 h-64 rotate-12 opacity-40">
            <span class="material-symbols-outlined text-[160px] text-mint-accent">local_florist</span>
        </div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 -rotate-12 opacity-40">
            <span class="material-symbols-outlined text-[160px] text-gold-dust">spa</span>
        </div>

        <div class="relative z-10 text-center w-full">
            <p class="font-label-caps text-label-caps text-mint-accent tracking-[0.3em] mb-6">UNDANGAN PERNIKAHAN</p>
            <h1 class="font-couple-name text-couple-name text-white mb-2 leading-none text-5xl tracking-tighter uppercase font-bold">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            <p class="font-script-grand text-script-grand text-gold-dust italic mb-8">Menuju Kebahagiaan Abadi</p>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl py-4 px-6 mb-8 inline-block max-w-xs mx-auto">
                <p class="font-label-caps text-label-caps text-white mb-1">UNTUK TAMU KAMI</p>
                <p class="font-headline-lg text-lg text-white font-bold truncate">{{ request()->get('kpd', 'Sahabat & Keluarga Tercinta') }}</p>
            </div>
            
            <div>
                <button class="bg-gold-dust text-primary font-label-caps text-label-caps px-10 py-5 rounded-full hover:scale-105 active:scale-95 transition-all shadow-xl flex items-center justify-center gap-3 mx-auto border border-white/10" id="btn-open" onclick="unlockInvitation()">
                    <span class="material-symbols-outlined">mail</span>
                    BUKA UNDANGAN
                </button>
            </div>
        </div>
    </section>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="opacity-0 transition-opacity duration-1000 hidden pb-24" id="main-content">
        <!-- Top App Bar -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-[40] flex justify-between items-center px-6 h-16 bg-surface/85 backdrop-blur-md border-b border-emerald-deep/5">
            <div class="font-couple-name text-lg text-emerald-deep font-bold tracking-tighter">{{ $couple['groom'][0] }} &amp; {{ $couple['bride'][0] }}</div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-emerald-deep text-lg">favorite</span>
            </div>
        </header>

        <!-- HERO SECTION: COLLAGE -->
        <section class="relative pt-24 pb-12 overflow-hidden" id="hero">
            <div class="absolute inset-0 -z-10 opacity-30 pointer-events-none">
                <span class="material-symbols-outlined absolute top-20 left-[10%] text-[100px] text-sage-muted rotate-12">eco</span>
                <span class="material-symbols-outlined absolute bottom-40 right-[15%] text-[80px] text-tertiary-fixed-dim -rotate-12">filter_vintage</span>
            </div>

            <div class="px-6">
                <div class="grid grid-cols-12 gap-3 relative">
                    <!-- Main Polaroid -->
                    <div class="col-span-12 z-20 reveal-up">
                        <div class="polaroid bg-white p-4 pb-12 rotate-[-2deg] relative border border-emerald-deep/5">
                            <div class="washi-tape absolute -top-4 left-1/4 w-32 h-8 z-30"></div>
                            <img class="w-full aspect-[4/5] object-cover rounded-sm" src="{{ $bg['hero'] }}" alt="Selamanya Bersama"/>
                            <p class="font-script-grand text-center mt-6 text-emerald-deep text-lg italic">Selamanya Bersama</p>
                        </div>
                    </div>
                    <!-- Offset Small Polaroid 1 -->
                    <div class="col-span-6 mt-4 reveal-up">
                        <div class="polaroid bg-white p-3 pb-8 rotate-[3deg] relative border border-emerald-deep/5">
                            <div class="washi-tape absolute -right-6 top-1/2 w-24 h-6 rotate-90 z-30 opacity-60"></div>
                            <img class="w-full aspect-square object-cover rounded-sm" src="{{ $bg['hero_small_1'] }}" alt="Detail"/>
                        </div>
                    </div>
                    <!-- Offset Small Polaroid 2 -->
                    <div class="col-span-6 mt-4 reveal-up">
                        <div class="polaroid bg-white p-3 pb-8 rotate-[-1deg] border border-emerald-deep/5">
                            <img class="w-full aspect-[3/4] object-cover rounded-sm" src="{{ $bg['hero_small_2'] }}" alt="Moments"/>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12 max-w-sm mx-auto reveal-up">
                    <h2 class="font-headline-lg-mobile text-emerald-deep text-2xl mb-4 uppercase font-bold">Momen Berbahagia</h2>
                    <p class="text-sage-muted text-sm leading-relaxed italic">"Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya."</p>
                </div>
            </div>
        </section>

        <!-- STORIES SECTION -->
        <section class="py-16 bg-surface relative overflow-hidden text-center" id="story">
            <div class="absolute inset-0 gold-sparkle opacity-5 pointer-events-none"></div>
            <div class="px-6 relative">
                <div class="text-center mb-12 reveal-up">
                    <h2 class="font-script-grand text-4xl text-emerald-deep leading-none mb-2 font-bold uppercase">Kisah Cinta</h2>
                    <p class="font-label-caps text-label-caps text-gold-dust tracking-[0.4em] text-[10px]">OUR JOURNEY TOGETHER</p>
                </div>

                <div class="relative max-w-sm mx-auto pl-6 border-l border-sage-muted/30 space-y-12 text-left">
                    @foreach($stories as $i => $s)
                    <!-- Entry -->
                    <div class="relative reveal-up">
                        <!-- Node -->
                        <div class="w-6 h-6 bg-emerald-deep rounded-full border-4 border-white shadow-sm flex items-center justify-center absolute -left-[39px] top-1">
                            <span class="material-symbols-outlined text-white text-[10px] font-bold">favorite</span>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <span class="font-label-caps text-gold-dust text-[10px] tracking-wider font-bold">{{ strtoupper($s['date']) }}</span>
                                <h3 class="font-headline-lg-mobile text-base text-emerald-deep font-bold mt-1">{{ $s['title'] }}</h3>
                                <p class="text-sage-muted text-xs leading-relaxed italic mt-1.5">"{{ $s['text'] }}"</p>
                            </div>
                            
                            <!-- Story polaroid image wrapper -->
                            <div class="polaroid bg-white p-2.5 pb-8 rotate-[-2deg] w-full max-w-[200px] border border-emerald-deep/5 relative shadow-md">
                                <div class="washi-tape absolute -top-2 left-1/4 w-20 h-5 z-20 opacity-70"></div>
                                <img class="w-full aspect-square object-cover rounded-sm" src="{{ $bg['story_' . ($i + 1)] ?? $gallery[$i % count($gallery)] }}" alt="{{ $s['title'] }}"/>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- COUPLE PROFILES -->
        <section class="py-16 bg-surface-container-low overflow-hidden text-center" id="couple">
            <div class="px-6 max-w-sm mx-auto flex flex-col items-center">
                
                <!-- Groom -->
                <div class="reveal-up flex flex-col items-center">
                    <div class="relative mb-6">
                        <div class="polaroid bg-white p-3 pb-10 rotate-[-3deg] relative z-10 w-64 border border-emerald-deep/5">
                            <img class="w-full aspect-square object-cover rounded-sm" src="{{ $bg['groom'] }}" alt="Groom"/>
                        </div>
                        <div class="absolute -top-6 -right-6 w-24 h-24 bg-gold-dust/20 rounded-full blur-xl -z-10"></div>
                    </div>
                    <h3 class="font-couple-name text-2xl text-emerald-deep font-bold mb-1">{{ $couple['groom'] }} Putra</h3>
                    <p class="font-label-caps text-[9px] text-gold-dust mb-3 tracking-widest font-bold">PUTRA DARI</p>
                    <p class="font-body-md text-xs text-sage-muted leading-relaxed">{{ $couple['parents']['groom'] }}</p>
                </div>

                <!-- Divider -->
                <div class="my-8 reveal-up">
                    <span class="material-symbols-outlined text-gold-dust text-5xl rotate-45">all_inclusive</span>
                </div>

                <!-- Bride -->
                <div class="reveal-up flex flex-col items-center">
                    <div class="relative mb-6">
                        <div class="polaroid bg-white p-3 pb-10 rotate-[3deg] relative z-10 w-64 border border-emerald-deep/5">
                            <img class="w-full aspect-square object-cover rounded-sm" src="{{ $bg['bride'] }}" alt="Bride"/>
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-mint-accent/30 rounded-full blur-xl -z-10"></div>
                    </div>
                    <h3 class="font-couple-name text-2xl text-emerald-deep font-bold mb-1">{{ $couple['bride'] }} Amira</h3>
                    <p class="font-label-caps text-[9px] text-gold-dust mb-3 tracking-widest font-bold">PUTRI DARI</p>
                    <p class="font-body-md text-xs text-sage-muted leading-relaxed">{{ $couple['parents']['bride'] }}</p>
                </div>
            </div>
        </section>

        <!-- EVENT DETAILS (Agenda Bahagia) -->
        <section class="py-16 relative overflow-hidden text-center" id="events">
            <div class="px-6 max-w-sm mx-auto">
                <div class="text-center mb-10 reveal-up">
                    <p class="font-label-caps text-gold-dust tracking-[0.4em] text-[10px] font-bold mb-2">SAVE THE DATE</p>
                    <h2 class="font-headline-lg-mobile text-emerald-deep text-2xl font-bold uppercase">Agenda Bahagia</h2>
                </div>

                <div class="space-y-8">
                    <!-- Akad -->
                    <div class="reveal-up relative group">
                        <div class="absolute -inset-1 bg-sage-muted/15 rounded-3xl blur-md"></div>
                        <div class="relative bg-white p-6 rounded-2xl shadow-sm flex flex-col items-center border border-outline-variant/30 text-center">
                            <span class="material-symbols-outlined text-4xl text-emerald-deep mb-4">church</span>
                            <h3 class="font-headline-lg-mobile text-lg text-emerald-deep font-bold mb-1">Akad Nikah</h3>
                            <div class="w-12 h-[1px] bg-gold-dust mb-4"></div>
                            <p class="font-label-bold text-[10px] text-sage-muted tracking-wider block mb-1 uppercase">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            <p class="font-body-md text-xs text-on-background mb-4">Pukul {{ $schedule[0]['time'] }}</p>
                            <p class="font-body-md text-xs text-emerald-deep font-bold mb-1">{{ $schedule[0]['note'] }}</p>
                            
                            <a class="inline-flex items-center gap-1.5 text-gold-dust font-label-bold text-xs hover:underline mt-4 font-bold" href="{{ $event['maps_url'] }}" target="_blank">
                                <span class="material-symbols-outlined text-xs">location_on</span>
                                GOOGLE MAPS
                            </a>
                        </div>
                    </div>

                    <!-- Resepsi -->
                    <div class="reveal-up relative group">
                        <div class="absolute -inset-1 bg-emerald-deep/10 rounded-3xl blur-md"></div>
                        <div class="relative bg-emerald-deep p-6 rounded-2xl shadow-md flex flex-col items-center text-center">
                            <span class="material-symbols-outlined text-4xl text-gold-dust mb-4">celebration</span>
                            <h3 class="font-headline-lg-mobile text-lg text-white font-bold mb-1">Resepsi</h3>
                            <div class="w-12 h-[1px] bg-gold-dust mb-4"></div>
                            <p class="font-label-bold text-[10px] text-mint-accent tracking-wider block mb-1 uppercase">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            <p class="font-body-md text-xs text-white/90 mb-4">Pukul {{ $schedule[1]['time'] }}</p>
                            <p class="font-body-md text-xs text-mint-accent font-bold mb-1">{{ $schedule[1]['note'] }}</p>
                            
                            <a class="inline-flex items-center gap-1.5 text-gold-dust font-label-bold text-xs hover:underline mt-4 font-bold" href="{{ $event['maps_url'] }}" target="_blank">
                                <span class="material-symbols-outlined text-xs">location_on</span>
                                GOOGLE MAPS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- GALLERY SECTION -->
        <section class="py-16 bg-warm-beige-bg text-center" id="gallery">
            <div class="px-6 max-w-sm mx-auto">
                <div class="text-center mb-10 reveal-up">
                    <h2 class="font-script-grand text-3xl text-emerald-deep font-bold uppercase">Momen Indah</h2>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <!-- Photo 1 -->
                    <div class="col-span-2 reveal-up">
                        <div class="polaroid bg-white p-2 pb-6 rotate-1 border border-emerald-deep/5 cursor-zoom-in" onclick="openLightbox('{{ $gallery[0] }}')">
                            <img class="w-full aspect-[4/3] object-cover rounded-sm" src="{{ $gallery[0] }}" alt="Gallery 1"/>
                        </div>
                    </div>
                    <!-- Photo 2 -->
                    <div class="reveal-up">
                        <div class="polaroid bg-white p-2 pb-6 rotate-[-2deg] border border-emerald-deep/5 cursor-zoom-in" onclick="openLightbox('{{ $gallery[1] }}')">
                            <img class="w-full aspect-square object-cover rounded-sm" src="{{ $gallery[1] }}" alt="Gallery 2"/>
                        </div>
                    </div>
                    <!-- Photo 3 -->
                    <div class="reveal-up">
                        <div class="polaroid bg-white p-2 pb-6 rotate-[3deg] border border-emerald-deep/5 cursor-zoom-in" onclick="openLightbox('{{ $gallery[2] }}')">
                            <img class="w-full aspect-square object-cover rounded-sm" src="{{ $gallery[2] }}" alt="Gallery 3"/>
                        </div>
                    </div>
                    <!-- Photo 4 -->
                    <div class="col-span-2 reveal-up">
                        <div class="polaroid bg-white p-2 pb-8 rotate-[-1deg] relative border border-emerald-deep/5 cursor-zoom-in" onclick="openLightbox('{{ $gallery[3] ?? $gallery[0] }}')">
                            <div class="washi-tape absolute top-0 right-4 w-20 h-6 -rotate-12 opacity-80"></div>
                            <img class="w-full h-32 object-cover rounded-sm" src="{{ $gallery[3] ?? $gallery[0] }}" alt="Gallery 4"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KADO DIGITAL (Wedding Gift) -->
        <section class="py-16 px-6 bg-warm-beige-bg/50 backdrop-blur-sm border-t border-b border-gold-dust/20" id="registry">
            <div class="max-w-sm mx-auto text-center">
                <div class="text-center mb-8" data-aos="fade-up">
                    <span class="text-[10px] uppercase tracking-widest text-gold-dust font-label-caps font-bold mb-1 block">Wedding Gift</span>
                    <h2 class="font-headline-lg-mobile text-2xl text-emerald-deep font-bold uppercase">Kado Digital</h2>
                    <div class="w-12 h-[1px] bg-gold-dust mx-auto mt-2"></div>
                </div>

                <p class="text-xs text-sage-muted font-body-md italic max-w-xs mx-auto leading-relaxed mb-6" data-aos="fade-up">
                    Doa restu Anda adalah kado terindah bagi kami. Namun bagi Anda yang ingin memberikan tanda kasih secara digital, silakan transfer melalui rekening berikut:
                </p>

                <div class="space-y-4 w-full">
                    @foreach($gifts as $g)
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gold-dust/30 text-center relative overflow-hidden" data-aos="fade-up">
                        <p class="text-[9px] text-gold-dust uppercase tracking-widest font-label-caps font-bold mb-1">{{ $g['bank'] }}</p>
                        <h3 class="font-headline-lg-mobile text-lg text-emerald-deep font-bold tracking-wider mb-1">{{ $g['account'] }}</h3>
                        <p class="text-[10px] text-sage-muted uppercase tracking-wide">A.N {{ $g['name'] }}</p>
                        <button class="mt-4 px-5 py-2.5 border border-gold-dust text-gold-dust hover:bg-gold-dust hover:text-emerald-deep rounded-full text-[9px] font-bold tracking-widest uppercase transition-all duration-300 cursor-pointer" onclick="copyAccount('{{ $g['account'] }}', this)">
                            Salin Rekening
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- RSVP & TAMU SECTION -->
        <section class="py-16 px-6 text-center" id="rsvp">
            <div class="max-w-sm mx-auto">
                <div class="bg-white rounded-[2rem] p-6 shadow-xl border border-emerald-deep/5 relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-gold-dust/5 rounded-full blur-2xl"></div>
                    <div class="text-center mb-8 reveal-up">
                        <span class="material-symbols-outlined text-3xl text-emerald-deep mb-2">mail_outline</span>
                        <h2 class="font-headline-lg-mobile text-xl text-emerald-deep font-bold mb-2 uppercase">Konfirmasi Kehadiran</h2>
                        <p class="font-body-md text-xs text-sage-muted leading-relaxed">Kehadiran dan doa restu Anda adalah berkah bagi kami.</p>
                    </div>

                    <form class="space-y-4 text-left reveal-up" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-caps text-[9px] text-emerald-deep mb-1 font-bold">NAMA LENGKAP</label>
                            <input class="w-full bg-surface border-0 border-b border-gold-dust/30 focus:border-emerald-deep focus:ring-0 text-xs p-3 focus:outline-none rounded-none text-gray-700" placeholder="Masukkan nama Anda" type="text" id="rsvp-nama" required/>
                        </div>
                        <div>
                            <label class="block font-label-caps text-[9px] text-emerald-deep mb-1 font-bold">KEHADIRAN</label>
                            <select class="w-full bg-surface border-0 border-b border-gold-dust/30 focus:border-emerald-deep focus:ring-0 text-xs p-3 focus:outline-none rounded-none text-gray-700" id="rsvp-kehadiran">
                                <option value="Hadir">Saya Akan Hadir</option>
                                <option value="Tidak Hadir">Berhalangan Hadir</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-caps text-[9px] text-emerald-deep mb-1 font-bold">PESAN &amp; DOA RESTU</label>
                            <textarea class="w-full bg-surface border border-gold-dust/20 focus:border-emerald-deep focus:ring-0 text-xs p-3 rounded-lg resize-none h-24 text-gray-700 placeholder-gray-300 focus:outline-none" placeholder="Tuliskan ucapan dan doa hangat Anda..." id="rsvp-pesan" required></textarea>
                        </div>
                        <button class="w-full bg-emerald-deep text-white font-label-caps text-[10px] tracking-widest font-bold py-4 rounded-full hover:bg-primary transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer" type="submit">
                            KIRIM KONFIRMASI
                            <span class="material-symbols-outlined text-sm">send</span>
                        </button>
                    </form>

                    <div class="mt-12 text-left reveal-up">
                        <h3 class="font-label-caps text-gold-dust text-center mb-6 tracking-[0.2em] text-[10px] font-bold">BUKU TAMU</h3>
                        <div class="space-y-4 max-h-60 overflow-y-auto pr-1.5 custom-scrollbar" id="wishes-container">
                            @foreach($wishes as $w)
                            <div class="bg-alabaster-white p-4 rounded-xl border border-emerald-deep/5 relative text-left">
                                <p class="font-label-bold text-[9px] text-emerald-deep mb-1 uppercase font-bold">{{ $w['name'] }} ({{ $w['status'] }})</p>
                                <p class="text-xs text-on-surface-variant italic leading-relaxed">"{{ $w['message'] }}"</p>
                            </div>
                            @endforeach
                            <div id="wishList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="flex flex-col items-center text-center w-full bg-surface-container-low py-16 px-6 border-t border-outline-variant/30">
            <h2 class="font-script-grand text-3xl text-emerald-deep font-bold mb-4">E &amp; J</h2>
            <p class="font-body-md text-xs text-tertiary max-w-[280px] leading-relaxed mx-auto italic mb-8">Terima kasih telah menjadi bagian dari perjalanan cinta kami. Sampai jumpa di hari bahagia!</p>
            <p class="font-body-md text-[9px] text-sage-muted/60">With Love, Elias &amp; Jada 2024</p>
            <p class="font-body-md text-[8px] text-sage-muted/40 mt-2">Created with <span class="text-gold-dust">♥</span> TemuRuang</p>
        </footer>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed bottom-8 left-1/2 -translate-x-1/2 flex gap-8 items-center z-50 bg-[#003527]/90 backdrop-blur-md rounded-full px-8 py-3.5 border border-gold-dust/30 shadow-xl" id="bottomNav">
            <a class="material-symbols-outlined text-gold-dust scale-110 transition-all duration-500 ease-out hover:scale-125" href="#hero" onclick="smoothScroll(event, '#hero', this)">favorite</a>
            <a class="material-symbols-outlined text-white/55 hover:text-gold-dust transition-all hover:scale-125" href="#couple" onclick="smoothScroll(event, '#couple', this)">person</a>
            <a class="material-symbols-outlined text-white/55 hover:text-gold-dust transition-all hover:scale-125" href="#events" onclick="smoothScroll(event, '#events', this)">event</a>
            <a class="material-symbols-outlined text-white/55 hover:text-gold-dust transition-all hover:scale-125" href="#gallery" onclick="smoothScroll(event, '#gallery', this)">photo_library</a>
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
            const cover = document.getElementById('cover');
            const main = document.getElementById('main-content');
            const floater = document.getElementById('floaterContainer');
            
            cover.classList.add('transition-all', 'duration-1000', '-translate-y-full', 'opacity-0');
            setTimeout(() => {
                cover.style.display = 'none';
                main.classList.remove('hidden');
                main.classList.remove('opacity-0');
                document.body.classList.remove('cover-active');
                floater.classList.add('visible');
                
                // Play audio
                const audio = document.getElementById('bg-audio');
                audio.play().catch(e => console.log("Audio autoplay blocked"));
                
                // Trigger scroll reveals
                triggerReveal();
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

        function copyAccount(text, btn) {
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                const oldContent = btn.innerHTML;
                btn.innerHTML = 'DISALIN';
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
            card.className = 'bg-alabaster-white p-4 rounded-xl border border-emerald-deep/5 relative text-left';
            card.innerHTML = `<p class="font-label-bold text-[9px] text-emerald-deep mb-1 uppercase font-bold">${name} (${status})</p><p class="text-xs text-on-surface-variant italic leading-relaxed">"${msg}"</p>`;
            
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
                a.classList.remove('text-gold-dust', 'scale-110');
                a.classList.add('text-white/55');
            });
            el.classList.remove('text-white/55');
            el.classList.add('text-gold-dust', 'scale-110');

            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Scroll Reveal Observer
        function triggerReveal() {
            const revealElements = document.querySelectorAll('.reveal-up');
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
        }

        document.addEventListener("DOMContentLoaded", function() {
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

                document.querySelectorAll('#bottomNav a').forEach((a) => {
                    a.classList.remove('text-gold-dust', 'scale-110');
                    a.classList.add('text-white/55');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.remove('text-white/55');
                        a.classList.add('text-gold-dust', 'scale-110');
                    }
                });
            });
        });
    </script>
</body>
</html>
