@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Sakti Permadi');
        $brideName = trim($names[1] ?? 'Asri Wandira');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Drs. Hermawan & Ibu Hj. Siti Aminah',
                'bride' => 'Bapak H. Ahmad Sudrajat & Ibu Hj. Lilis Suryani',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-08-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Masjid Al-Irsyad Satya',
            'address' => $invitation->address ?? 'Padalarang, Kabupaten Bandung Barat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Masjid Al-Irsyad Satya Padalarang'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Masjid Al-Irsyad Satya, Padalarang'
            ],
            [
                'title' => 'Resepsi',
                'time' => '11:00 - 14:00 WIB',
                'note' => $invitation->address ?? 'Mason Pine Hotel, Padalarang'
            ]
        ];

        if (isset($invitation->stories) && $invitation->stories->count() > 0) {
            $stories = [];
            foreach ($invitation->stories as $story) {
                $stories[] = [
                    'title' => $story->title,
                    'date' => $story->event_date ? $story->event_date->translatedFormat('F Y') : '',
                    'text' => $story->description,
                ];
            }
        } else {
            $stories = [
                ['title' => 'Pertemuan Pertama', 'date' => 'Januari 2021', 'text' => 'Awal mula semesta mempertemukan kita di sebuah perpustakaan kota yang tenang.'],
                ['title' => 'Lamaran', 'date' => 'Maret 2024', 'text' => 'Mengikrarkan janji untuk melangkah ke jenjang yang lebih serius dalam balutan adat yang penuh doa.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-14/images/image_6.jpg'),
                asset('assets/templates/wedding-14/images/image_7.jpg'),
                asset('assets/templates/wedding-14/images/image_8.jpg'),
                asset('assets/templates/wedding-14/images/image_9.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-14/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => $coverUrl,
            'bride' => $coverUrl,
        ];
    } else {
        $couple = [
            'groom' => 'Sakti Permadi',
            'bride' => 'Asri Wandira',
            'parents' => [
                'groom' => 'Bapak Drs. Hermawan & Ibu Hj. Siti Aminah',
                'bride' => 'Bapak H. Ahmad Sudrajat & Ibu Hj. Lilis Suryani',
            ],
        ];

        $event = [
            'date_iso' => '2024-08-24',
            'time' => '08:00',
            'location' => 'Masjid Al-Irsyad Satya',
            'address' => 'Padalarang, Kabupaten Bandung Barat',
            'maps_url' => 'https://maps.google.com/?q=Masjid+Al-Irsyad+Satya+Padalarang',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'Masjid Al-Irsyad Satya, Padalarang'],
            ['title' => 'Resepsi', 'time' => '11:00 - 14:00 WIB', 'note' => 'Mason Pine Hotel, Padalarang'],
        ];

        $stories = [
            ['title' => 'Pertemuan Pertama', 'date' => 'Januari 2021', 'text' => 'Awal mula semesta mempertemukan kita di sebuah perpustakaan kota yang tenang.'],
            ['title' => 'Lamaran', 'date' => 'Maret 2024', 'text' => 'Mengikrarkan janji untuk melangkah ke jenjang yang lebih serius dalam balutan adat yang penuh doa.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-14/images/image_6.jpg'),
            asset('assets/templates/wedding-14/images/image_7.jpg'),
            asset('assets/templates/wedding-14/images/image_8.jpg'),
            asset('assets/templates/wedding-14/images/image_9.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-14/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-14/images/image_1.jpg'),
            'bride' => asset('assets/templates/wedding-14/images/image_1.jpg'),
        ];
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>{{ $couple['bride'] }} &amp; {{ $couple['groom'] }} | Undangan Pernikahan</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&amp;family=Montserrat:wght@300;400;500;600&amp;family=Inter:wght@400;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary": "#735c00",
                        "error-container": "#ffdad6",
                        "sage-light": "#A3B18A",
                        "error": "#ba1a1a",
                        "tertiary": "#50504d",
                        "on-error": "#ffffff",
                        "sage-deep": "#4A5642",
                        "on-secondary-fixed-variant": "#574500",
                        "tertiary-fixed": "#e4e2dd",
                        "inverse-surface": "#2f3131",
                        "primary-fixed": "#d6e8c8",
                        "surface-container-highest": "#e2e2e2",
                        "surface-variant": "#e2e2e2",
                        "on-primary-container": "#dceece",
                        "on-secondary-fixed": "#241a00",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#1a1c1c",
                        "inverse-on-surface": "#f0f1f1",
                        "surface-bright": "#f9f9f9",
                        "tertiary-container": "#686865",
                        "primary-fixed-dim": "#baccad",
                        "on-tertiary": "#ffffff",
                        "surface-container": "#eeeeee",
                        "on-secondary-container": "#745c00",
                        "background": "#f9f9f9",
                        "primary": "#45553c",
                        "outline-variant": "#c5c8be",
                        "surface-container-high": "#e8e8e8",
                        "tertiary-fixed-dim": "#c8c6c2",
                        "secondary-container": "#fed65b",
                        "surface-tint": "#53634a",
                        "inverse-primary": "#baccad",
                        "surface-container-low": "#f3f3f4",
                        "on-primary-fixed": "#111f0b",
                        "on-primary": "#ffffff",
                        "on-tertiary-container": "#eae8e3",
                        "ivory": "#FAF9F6",
                        "on-tertiary-fixed-variant": "#474744",
                        "surface-dim": "#dadada",
                        "on-primary-fixed-variant": "#3c4b33",
                        "primary-container": "#5d6d53",
                        "on-background": "#1a1c1c",
                        "secondary-fixed": "#ffe088",
                        "on-tertiary-fixed": "#1b1c19",
                        "on-secondary": "#ffffff",
                        "surface": "#f9f9f9",
                        "on-surface-variant": "#444840",
                        "on-error-container": "#93000a",
                        "charcoal-text": "#2D2D2D",
                        "outline": "#757870",
                        "gold-leaf": "#C5A028",
                        "secondary-fixed-dim": "#e9c349"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "gutter": "24px",
                        "unit": "8px",
                        "section-gap": "80px",
                        "container-max": "1200px"
                    },
                    "fontFamily": {
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "display-serif": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "label-caps": ["Inter"],
                        "quote-script": ["Playfair Display"],
                        "body-lg": ["Montserrat"],
                        "display-serif-mobile": ["Playfair Display"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                        "display-serif": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "quote-script": ["20px", {"lineHeight": "30px", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-serif-mobile": ["36px", {"lineHeight": "44px", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        body.is-locked {
            overflow: hidden;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
        }
        
        .fade-in {
            animation: fadeIn 1.5s ease-out forwards;
            opacity: 0;
        }
        
        .delay-1 { animation-delay: 0.3s; }
        .delay-2 { animation-delay: 0.6s; }
        .delay-3 { animation-delay: 0.9s; }
        .delay-4 { animation-delay: 1.2s; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .reveal-visible {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }
        
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .floating-flower {
            position: absolute;
            pointer-events: none;
            z-index: 10;
            animation: float 8s linear infinite;
        }

        @keyframes float {
            0% { transform: translateY(-10vh) translateX(0) rotate(0deg); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { transform: translateY(110vh) translateX(50px) rotate(360deg); opacity: 0; }
        }

        .gold-particle {
            position: absolute;
            background: radial-gradient(circle, #C5A028 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 5;
            animation: twinkle 4s ease-in-out infinite;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.5); }
        }

        .sunda-arch {
            clip-path: ellipse(100% 100% at 50% 100%);
        }
        .sunda-arch-mask {
            clip-path: ellipse(45% 50% at 50% 50%);
        }

        .glass-panel {
            background: rgba(250, 249, 246, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(197, 160, 40, 0.2);
        }
        
        .timeline-line {
            background: linear-gradient(to bottom, transparent, #A3B18A 15%, #A3B18A 85%, transparent);
        }
        
        .scroll-hide::-webkit-scrollbar {
            display: none;
        }
        
        .hover-scale {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-scale:hover {
            transform: scale(1.03);
        }
        
        #main-content {
            display: none;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #C5A028;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-ivory text-charcoal-text selection:bg-gold-leaf/30 max-w-[480px] w-full mx-auto relative shadow-2xl border-x border-gold-leaf/10 min-h-screen is-locked">

    <!-- COVER SECTION -->
    <section class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-50 flex items-center justify-center overflow-hidden" id="cover">
        <!-- Background Image Container -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black/30 z-10"></div>
            <img alt="Beautiful West Java Landscape" class="w-full h-full object-cover scale-110 blur-[2px]" data-alt="Tea plantation background" src="{{ $bg['cover'] }}"/>
        </div>
        <!-- Animation Containers -->
        <div class="absolute inset-0 z-10 pointer-events-none" id="flower-container"></div>
        <div class="absolute inset-0 z-5 pointer-events-none" id="particle-container"></div>
        <!-- Main Content -->
        <div class="relative z-20 text-center px-margin-mobile flex flex-col items-center justify-center">
            <header class="fade-in">
                <span class="font-label-caps text-label-caps text-ivory tracking-[0.3em] uppercase mb-stack-sm block text-xs">
                    The Wedding Of
                </span>
            </header>
            <div class="mt-stack-lg mb-stack-lg">
                <h1 class="fade-in delay-1">
                    <span class="font-display-wedding text-white text-5xl md:text-6xl drop-shadow-lg block leading-tight">
                        {{ $couple['groom'] }} <span class="text-gold-leaf">&amp;</span> {{ $couple['bride'] }}
                    </span>
                </h1>
            </div>
            <div class="fade-in delay-2 flex flex-col items-center gap-stack-md">
                <div class="h-[1px] w-24 bg-gold-leaf/60"></div>
                <p class="font-body-md text-body-md text-ivory/90 tracking-widest font-light text-sm">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <div class="h-[1px] w-24 bg-gold-leaf/60"></div>
            </div>
            <!-- Guest Name Card -->
            <div class="fade-in delay-3 mt-12 mb-10 w-full max-w-xs p-6 glass-panel rounded-xl">
                <p class="font-body-md text-body-md text-ivory/70 mb-2 italic text-xs">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <h3 class="font-headline-md text-headline-md text-white border-b border-gold-leaf/30 pb-2 text-lg">
                    {{ request()->get('kpd', 'Tamu Undangan') }}
                </h3>
            </div>
            <!-- Action Button -->
            <div class="fade-in delay-4 group">
                <button class="relative px-10 py-4 bg-primary text-ivory rounded-full font-body-md text-body-md font-semibold tracking-wide flex items-center gap-3 hover:bg-sage-deep transition-all duration-500 shadow-xl shadow-sage-deep/20 active:scale-95 group-hover:-translate-y-1" id="btn-open-invitation" onclick="openInvitation()">
                    <span class="material-symbols-outlined text-gold-leaf" data-weight="fill">filter_vintage</span>
                    Buka Undangan
                    <span class="material-symbols-outlined text-ivory/50 text-sm">expand_more</span>
                    <!-- Siger-like decorative highlight -->
                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                        <span class="material-symbols-outlined text-gold-leaf text-4xl" data-weight="fill">crown</span>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <!-- MAIN SCROLLING CONTENT (Revealed after click) -->
    <div id="main-content">
        <!-- Top Navigation -->
        <header class="fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-50 flex justify-between items-center px-margin-mobile py-4 bg-gradient-to-b from-ivory/90 to-ivory/10 backdrop-blur-sm transition-opacity duration-500 opacity-0 border-b border-gold-leaf/10" id="nav-header">
            <h1 class="font-display-wedding text-headline-md text-primary">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            <button class="text-primary hover:opacity-80 transition-opacity active:scale-95 transition-transform" onclick="navigator.share ? navigator.share({title: 'Undangan Pernikahan', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Tautan disalin!'))">
                <span class="material-symbols-outlined">share</span>
            </button>
        </header>

        <!-- SECTION 2: MEMPELAI -->
        <main class="pt-24 pb-section-padding" id="mempelai">
            <!-- Bismillah Header -->
            <section class="max-w-container-max mx-auto px-margin-mobile text-center mb-16 reveal">
                <div class="flex flex-col items-center gap-stack-sm">
                    <span class="font-quote-script text-quote-script text-primary opacity-80 italic">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</span>
                    <div class="h-[1px] w-24 bg-gold-leaf my-4 relative">
                        <span class="material-symbols-outlined absolute left-1/2 -top-3 -translate-x-1/2 text-gold-leaf bg-ivory px-2" style="font-size: 20px;">favorite</span>
                    </div>
                    <h2 class="font-display-wedding text-headline-lg text-primary mt-2">Mempelai</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant max-w-lg mx-auto mt-4 text-sm">
                        Atas izin Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk menghadiri hari bahagia kami.
                    </p>
                </div>
            </section>
            <!-- Profiles Section -->
            <section class="max-w-container-max mx-auto px-margin-mobile">
                <div class="flex flex-col gap-12 items-start">
                    <!-- Groom Profile Card -->
                    <div class="reveal-left bg-sage-light/20 rounded-3xl p-8 border border-outline-variant/30 relative overflow-hidden group w-full">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-leaf to-transparent opacity-30"></div>
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-8">
                                <div class="w-64 h-80 overflow-hidden sunda-arch-mask border-4 border-ivory shadow-lg relative z-10">
                                    <img class="w-full h-full object-cover" src="{{ asset('assets/templates/wedding-14/images/image_2.jpg') }}"/>
                                </div>
                                <div class="absolute -top-4 -right-4 text-sage-deep opacity-60">
                                    <span class="material-symbols-outlined" style="font-size: 48px;">spa</span>
                                </div>
                                <div class="absolute -bottom-2 -left-4 text-sage-deep opacity-60">
                                    <span class="material-symbols-outlined" style="font-size: 40px;">yard</span>
                                </div>
                            </div>
                            <h3 class="font-display-wedding text-headline-lg text-primary">{{ $couple['groom'] }}</h3>
                            <div class="h-[2px] w-12 bg-gold-leaf/40 my-4"></div>
                            <p class="font-body-md text-body-md text-on-surface-variant italic mb-2 text-sm">Putra Pertama dari</p>
                            <p class="font-body-lg text-body-lg font-semibold text-primary text-base">{{ $couple['parents']['groom'] }}</p>
                            <a class="mt-8 inline-flex items-center gap-2 text-secondary font-label-caps text-label-caps hover:text-gold-leaf transition-colors text-xs" href="#">
                                <span class="material-symbols-outlined" style="font-size: 18px;">camera_alt</span> @sakti_permadi
                            </a>
                        </div>
                    </div>
                    <!-- Bride Profile Card -->
                    <div class="reveal-right bg-sage-light/20 rounded-3xl p-8 border border-outline-variant/30 relative overflow-hidden group w-full">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-leaf to-transparent opacity-30"></div>
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-8">
                                <div class="w-64 h-80 overflow-hidden sunda-arch-mask border-4 border-ivory shadow-lg relative z-10">
                                    <img class="w-full h-full object-cover" src="{{ asset('assets/templates/wedding-14/images/image_3.jpg') }}"/>
                                </div>
                                <div class="absolute -top-4 -left-4 text-sage-deep opacity-60">
                                    <span class="material-symbols-outlined" style="font-size: 48px;">spa</span>
                                </div>
                                <div class="absolute -bottom-2 -right-4 text-sage-deep opacity-60">
                                    <span class="material-symbols-outlined" style="font-size: 40px;">yard</span>
                                </div>
                            </div>
                            <h3 class="font-display-wedding text-headline-lg text-primary">{{ $couple['bride'] }}</h3>
                            <div class="h-[2px] w-12 bg-gold-leaf/40 my-4"></div>
                            <p class="font-body-md text-body-md text-on-surface-variant italic mb-2 text-sm">Putri Kedua dari</p>
                            <p class="font-body-lg text-body-lg font-semibold text-primary text-base">{{ $couple['parents']['bride'] }}</p>
                            <a class="mt-8 inline-flex items-center gap-2 text-secondary font-label-caps text-label-caps hover:text-gold-leaf transition-colors text-xs" href="#">
                                <span class="material-symbols-outlined" style="font-size: 18px;">camera_alt</span> @asri_wandira
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- SECTION 3: ACARA & KISAH CINTA -->
        <section class="px-margin-mobile max-w-container-max mx-auto py-section-padding" id="acara">
            <div class="text-center mb-16 reveal">
                <span class="font-label-caps text-label-caps text-gold-leaf tracking-widest block mb-2 text-xs">SAVE THE DATE</span>
                <h2 class="font-display-wedding text-headline-lg text-primary">Informasi Acara</h2>
                <div class="w-16 h-px bg-gold-leaf mx-auto mt-4"></div>
            </div>
            <div class="flex flex-col gap-8">
                <!-- Akad Nikah -->
                <div class="reveal group">
                    <div class="bg-white border border-outline-variant/30 p-8 rounded-xl shadow-lg shadow-sage-deep/5 relative overflow-hidden h-full flex flex-col items-center text-center transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                        <div class="w-16 h-16 bg-sage-light/10 rounded-full flex items-center justify-center mb-6 text-primary">
                            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">church</span>
                        </div>
                        <h3 class="font-display-wedding text-headline-md text-primary mb-2">{{ $schedule[0]['title'] }}</h3>
                        <div class="font-label-caps text-label-caps text-gold-leaf mb-6 text-xs">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</div>
                        <div class="space-y-4 mb-8 text-sm">
                            <p class="font-body-md">Tabuh {{ $schedule[0]['time'] }}</p>
                            <p class="font-body-md font-semibold">{{ $schedule[0]['note'] }}</p>
                            <p class="text-on-surface-variant">{{ $event['address'] }}</p>
                        </div>
                        <a class="mt-auto inline-flex items-center gap-2 bg-sage-deep text-white px-8 py-3 rounded-full font-label-caps text-label-caps hover:bg-primary transition-all text-xs shadow-sm" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-sm">map</span> Lihat Lokasi
                        </a>
                    </div>
                </div>
                <!-- Resepsi -->
                <div class="reveal group">
                    <div class="bg-sage-light/10 border border-sage-light/20 p-8 rounded-xl shadow-lg shadow-sage-deep/5 relative overflow-hidden h-full flex flex-col items-center text-center transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-6 text-primary shadow-sm">
                            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                        </div>
                        <h3 class="font-display-wedding text-headline-md text-primary mb-2">{{ $schedule[1]['title'] }}</h3>
                        <div class="font-label-caps text-label-caps text-gold-leaf mb-6 text-xs">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</div>
                        <div class="space-y-4 mb-8 text-sm">
                            <p class="font-body-md">Tabuh {{ $schedule[1]['time'] }}</p>
                            <p class="font-body-md font-semibold">{{ $schedule[1]['note'] }}</p>
                            <p class="text-on-surface-variant">{{ $event['address'] }}</p>
                        </div>
                        <a class="mt-auto inline-flex items-center gap-2 bg-gold-leaf text-white px-8 py-3 rounded-full font-label-caps text-label-caps hover:bg-secondary transition-all text-xs shadow-sm" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-sm">map</span> Lihat Lokasi
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kisah Cinta -->
        <section class="bg-white py-section-padding relative overflow-hidden" id="kisah-cinta">
            <div class="px-margin-mobile max-w-[800px] mx-auto relative z-10">
                <div class="text-center mb-20 reveal">
                    <span class="font-label-caps text-label-caps text-gold-leaf tracking-widest block mb-2 text-xs">OUR JOURNEY</span>
                    <h2 class="font-display-wedding text-headline-lg text-primary">Kisah Cinta Kami</h2>
                    <div class="w-16 h-px bg-gold-leaf mx-auto mt-4"></div>
                </div>
                <div class="relative">
                    <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px timeline-line"></div>
                    
                    @foreach ($stories as $index => $story)
                    <!-- Item -->
                    <div class="relative mb-24 reveal">
                        <div class="flex items-center justify-center mb-8">
                            <div class="w-10 h-10 bg-white border-2 border-gold-leaf rounded-full flex items-center justify-center z-10 shadow-sm transition-transform hover:scale-125">
                                <span class="material-symbols-outlined text-gold-leaf text-xl" style="font-variation-settings: 'FILL' 1;">spa</span>
                            </div>
                        </div>
                        <div class="flex flex-col gap-6 items-center">
                            <div class="w-full text-center">
                                <div class="bg-ivory p-6 rounded-xl border border-outline-variant/20 shadow-sm">
                                    <h4 class="font-display-wedding text-headline-md text-primary mb-2 text-lg">{{ $story['title'] }}</h4>
                                    <span class="font-label-caps text-label-caps text-gold-leaf block mb-4 text-xs">{{ $story['date'] }}</span>
                                    <p class="font-body-md text-on-surface-variant italic text-sm">"{{ $story['text'] }}"</p>
                                </div>
                            </div>
                            @if(isset($gallery[$index]))
                            <div class="w-full max-w-xs cursor-zoom-in" onclick="openLightbox('{{ $gallery[$index] }}')">
                                <img class="w-full aspect-[4/3] rounded-2xl object-cover sunda-arch shadow-md" src="{{ $gallery[$index] }}" alt="{{ $story['title'] }} Image"/>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- SECTION 4: GALERI, RSVP & KADO -->
        <section class="max-w-container-max mx-auto px-margin-mobile py-section-padding" id="galeri">
            <div class="text-center mb-16 fade-in-up">
                <span class="font-label-caps text-label-caps text-gold-leaf tracking-[0.2em] mb-2 block text-xs">MOMEN INDAH</span>
                <h2 class="font-display-wedding text-headline-lg text-primary">Galeri Momen</h2>
                <div class="w-12 h-[1px] bg-gold-leaf mx-auto mt-4"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 auto-rows-[160px]">
                @foreach ($gallery as $index => $img)
                @php
                    $span = '';
                    if ($index == 0) $span = 'col-span-2 row-span-2';
                    elseif ($index == 3) $span = 'col-span-2';
                @endphp
                <div class="overflow-hidden rounded-xl hover-scale shadow-md cursor-zoom-in {{ $span }}" onclick="openLightbox('{{ $img }}')">
                    <img class="w-full h-full object-cover" src="{{ $img }}" alt="Gallery Image {{ $index+1 }}"/>
                </div>
                @endforeach
            </div>
        </section>

        <!-- RSVP Section -->
        <section class="py-section-padding px-margin-mobile max-w-container-max mx-auto flex flex-col gap-12" id="rsvp">
            <div class="bg-white/50 backdrop-blur-md p-8 rounded-3xl border border-outline-variant/30 shadow-xl shadow-sage-deep/5 fade-in-up">
                <h3 class="font-display-wedding text-headline-md text-primary mb-2">Konfirmasi Kehadiran</h3>
                <p class="font-body-md text-on-surface-variant mb-8 text-sm">Suatu kehormatan bagi kami jika Bapak/Ibu berkenan hadir.</p>
                <form class="space-y-6" id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div>
                        <label class="font-label-caps text-[10px] text-gold-leaf block mb-2 uppercase">Nama Lengkap</label>
                        <input id="nama" class="w-full bg-ivory border-none focus:ring-1 focus:ring-gold-leaf rounded-lg py-3 px-4 text-sm" placeholder="Masukkan nama Anda" type="text" required/>
                    </div>
                    <div>
                        <label class="font-label-caps text-[10px] text-gold-leaf block mb-2 uppercase">Kehadiran</label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input class="hidden peer" name="attendance" type="radio" value="Hadir" checked/>
                                <div class="text-center py-3 border border-outline-variant rounded-lg peer-checked:bg-sage-deep peer-checked:text-white transition-all text-sm">Hadir</div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input class="hidden peer" name="attendance" type="radio" value="Tidak Hadir"/>
                                <div class="text-center py-3 border border-outline-variant rounded-lg peer-checked:bg-error peer-checked:text-white transition-all text-sm">Tidak Hadir</div>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="font-label-caps text-[10px] text-gold-leaf block mb-2 uppercase">Pesan &amp; Doa Restu</label>
                        <textarea id="pesan" class="w-full bg-ivory border-none focus:ring-1 focus:ring-gold-leaf rounded-lg py-3 px-4 text-sm" placeholder="Tuliskan pesan manis..." rows="4" required></textarea>
                    </div>
                    <button class="w-full bg-sage-deep text-white font-label-caps py-4 rounded-full hover:bg-primary transition-colors shadow-lg text-xs tracking-widest" type="submit">KIRIM KONFIRMASI</button>
                </form>
            </div>
            <div class="h-full flex flex-col fade-in-up">
                <h3 class="font-display-wedding text-headline-md text-primary mb-2">Buku Tamu</h3>
                <p class="font-body-md text-on-surface-variant mb-8 text-sm">Doa restu dari teman dan keluarga.</p>
                <div id="wishList" class="bg-ivory/50 rounded-3xl p-6 overflow-y-auto max-h-[350px] custom-scrollbar border border-outline-variant/20 space-y-4">
                    <div class="bg-white p-5 rounded-2xl shadow-sm">
                        <p class="font-body-md text-primary font-semibold text-sm">Siti Rahma</p>
                        <p class="text-xs text-on-surface-variant italic mt-1">"Selamat menempuh hidup baru Sakti &amp; Asri!"</p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm">
                        <p class="font-body-md text-primary font-semibold text-sm">Budi Santoso</p>
                        <p class="text-xs text-on-surface-variant italic mt-1">"Semoga menjadi keluarga yang Sakinah, Mawaddah, Warahmah. Amin."</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Wedding Gift -->
        <section class="py-section-padding text-center px-margin-mobile" id="kado">
            <div class="max-w-xl mx-auto fade-in-up">
                <span class="font-label-caps text-label-caps text-gold-leaf tracking-[0.2em] mb-2 block text-xs">TANDA KASIH</span>
                <h2 class="font-display-wedding text-headline-lg text-primary mb-4">Wedding Gift</h2>
                <p class="font-body-md text-on-surface-variant mb-10 text-sm">Kado digital dapat melalui:</p>
                
                @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                    <div class="flex flex-col gap-6">
                        @foreach($invitation->bankAccounts as $bank)
                        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-md">
                            <h4 class="font-headline-md text-primary mb-2 text-lg">{{ strtoupper($bank->bank_name) }}</h4>
                            <p class="text-gold-leaf text-xs mb-4">A/N {{ strtoupper($bank->account_name) }}</p>
                            <p class="text-xl font-bold tracking-widest mb-6">{{ $bank->account_number }}</p>
                            <button class="px-6 py-2 rounded-full border border-gold-leaf text-gold-leaf text-xs hover:bg-gold-leaf hover:text-white transition-all" onclick="copyAccount('{{ $bank->account_number }}', this)">SALIN REKENING</button>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col gap-6">
                        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-md">
                            <h4 class="font-headline-md text-primary mb-2 text-lg">Bank BCA</h4>
                            <p class="text-gold-leaf text-xs mb-4">A/N SAKTI PRATAMA</p>
                            <p class="text-xl font-bold tracking-widest mb-6">1234 5678 90</p>
                            <button class="px-6 py-2 rounded-full border border-gold-leaf text-gold-leaf text-xs hover:bg-gold-leaf hover:text-white transition-all" onclick="copyAccount('1234 5678 90', this)">SALIN REKENING</button>
                        </div>
                        <div class="bg-white p-8 rounded-3xl border border-outline-variant/30 shadow-md">
                            <h4 class="font-headline-md text-primary mb-2 text-lg">Bank Mandiri</h4>
                            <p class="text-gold-leaf text-xs mb-4">A/N ASRI LESTARI</p>
                            <p class="text-xl font-bold tracking-widest mb-6">987 654 3210</p>
                            <button class="px-6 py-2 rounded-full border border-gold-leaf text-gold-leaf text-xs hover:bg-gold-leaf hover:text-white transition-all" onclick="copyAccount('987 654 3210', this)">SALIN REKENING</button>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="w-full py-section-padding bg-surface-container-low border-t border-outline-variant/20 flex flex-col items-center text-center px-margin-mobile">
            <div class="mb-8">
                <span class="font-display-wedding text-[48px] text-gold-leaf block mb-4">Hatur Nuhun</span>
                <div class="font-display-wedding text-headline-lg text-primary">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</div>
            </div>
            <p class="font-body-md text-on-surface-variant max-w-md mb-12 opacity-80 italic text-sm">
                "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu..."
            </p>
            <div class="flex gap-6 mb-12 text-xs">
                <a class="text-on-surface-variant hover:text-secondary font-label-caps text-xs" href="#">INSTAGRAM</a>
                <a class="text-on-surface-variant hover:text-secondary font-label-caps text-xs" href="#">SAVE THE DATE</a>
            </div>
            <div class="text-on-surface-variant/50 text-[10px]">
                © 2024 {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}. Design Inspired by Sundanese Heritage.
            </div>
        </footer>

        <!-- Spacer for Bottom Nav -->
        <div class="h-28"></div>
    </div>

    <!-- Bottom Navigation Bar (Mobile & Desktop Centered) -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[432px] z-50 flex justify-around items-center py-3 px-4 bg-ivory/80 backdrop-blur-md border border-outline-variant/30 rounded-full shadow-lg transform translate-y-32 transition-transform duration-500" id="bottom-nav">
        <a class="flex flex-col items-center text-secondary" href="#cover" onclick="smoothScroll(event, '#cover')">
            <span class="material-symbols-outlined text-[20px]">home</span>
            <span class="font-label-caps text-[9px] mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center text-on-surface-variant/70" href="#mempelai" onclick="smoothScroll(event, '#mempelai')">
            <span class="material-symbols-outlined text-[20px]">favorite</span>
            <span class="font-label-caps text-[9px] mt-1">Profil</span>
        </a>
        <a class="flex flex-col items-center text-on-surface-variant/70" href="#acara" onclick="smoothScroll(event, '#acara')">
            <span class="material-symbols-outlined text-[20px]">event</span>
            <span class="font-label-caps text-[9px] mt-1">Acara</span>
        </a>
        <a class="flex flex-col items-center text-on-surface-variant/70" href="#galeri" onclick="smoothScroll(event, '#galeri')">
            <span class="material-symbols-outlined text-[20px]">photo_library</span>
            <span class="font-label-caps text-[9px] mt-1">Galeri</span>
        </a>
    </nav>

    <!-- Floating Action Controls -->
    <div class="fixed bottom-24 left-1/2 translate-x-[170px] z-[45] flex flex-col gap-3 transform translate-y-32 transition-transform duration-500" id="floating-controls">
        <!-- Music Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-primary/90 text-pure-white flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAudio()">
            <span class="material-symbols-outlined" id="music-icon">volume_up</span>
        </button>
        <!-- Autoscroll Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-primary/90 text-pure-white flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAutoscroll()">
            <span class="material-symbols-outlined" id="autoscroll-icon">play_arrow</span>
        </button>
    </div>

    <!-- Hidden Audio element for background music -->
    <audio id="bg-music" loop>
        <source src="{{ asset('musics/sunda-music.mp3') }}" type="audio/mpeg"/>
    </audio>

    <!-- Lightbox Modal for Photo Preview -->
    <div id="lightbox" class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-gold-leaf text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-gold-leaf/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <script>
        // Reveal Logic on Scroll
        function reveal() {
            const reveals = document.querySelectorAll(".reveal, .reveal-left, .reveal-right, .fade-in-up");
            for (let i = 0; i < reveals.length; i++) {
                const windowHeight = window.innerHeight;
                const elementTop = reveals[i].getBoundingClientRect().top;
                const elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active", "reveal-visible");
                }
            }
        }

        // Open Invitation Logic
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const navHeader = document.getElementById('nav-header');
            const bottomNav = document.getElementById('bottom-nav');
            const floatingControls = document.getElementById('floating-controls');
            const audio = document.getElementById('bg-music');

            document.body.classList.remove('is-locked');
            mainContent.style.display = 'block';

            cover.style.transition = 'all 1.5s cubic-bezier(0.65, 0, 0.35, 1)';
            cover.style.transform = 'translateY(-100%)';

            setTimeout(() => {
                cover.classList.add('hidden');
                navHeader.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-32');
                floatingControls.classList.remove('translate-y-32');
                
                audio.play().then(() => {
                    isPlaying = true;
                    document.getElementById('music-icon').innerText = 'volume_up';
                }).catch(err => console.log('Audio play blocked:', err));

                reveal();
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
            const presence = document.querySelector('input[name="attendance"]:checked')?.value || 'Hadir';
            const msg = document.getElementById('pesan').value;

            const card = document.createElement('div');
            card.className = 'bg-white p-5 rounded-2xl shadow-sm';
            card.innerHTML = `<p class="font-body-md text-primary font-semibold text-sm">${name} (${presence})</p><p class="text-xs text-on-surface-variant italic mt-1">"${msg}"</p>`;
            
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

            document.querySelectorAll('nav a').forEach(a => {
                a.className = "flex flex-col items-center text-on-surface-variant/70";
            });
            e.currentTarget.className = "flex flex-col items-center text-secondary";
        }

        // Particle/Flower Generators (SCREEN_3 Logic)
        function createFlowers() {
            const container = document.getElementById('flower-container');
            if(!container) return;
            const flowerIcons = ['local_florist', 'filter_vintage', 'spa'];
            for (let i = 0; i < 15; i++) {
                const flower = document.createElement('span');
                flower.className = 'material-symbols-outlined floating-flower text-white/40';
                flower.textContent = flowerIcons[Math.floor(Math.random() * flowerIcons.length)];
                flower.style.fontSize = `${Math.random() * 12 + 12}px`;
                flower.style.left = `${Math.random() * 100}%`;
                flower.style.animationDuration = `${Math.random() * 6 + 6}s`;
                flower.style.animationDelay = `${Math.random() * 5}s`;
                container.appendChild(flower);
            }
        }

        function createParticles() {
            const container = document.getElementById('particle-container');
            if(!container) return;
            for (let i = 0; i < 30; i++) {
                const p = document.createElement('div');
                p.className = 'gold-particle';
                const size = Math.random() * 4 + 2;
                p.style.width = `${size}px`;
                p.style.height = `${size}px`;
                p.style.left = `${Math.random() * 100}%`;
                p.style.top = `${Math.random() * 100}%`;
                p.style.animationDelay = `${Math.random() * 4}s`;
                container.appendChild(p);
            }
        }

        // Init
        window.addEventListener('DOMContentLoaded', () => {
            createFlowers();
            createParticles();
        });

        window.addEventListener("scroll", reveal);

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

            document.querySelectorAll('nav a').forEach((a) => {
                a.className = "flex flex-col items-center text-on-surface-variant/70";
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex flex-col items-center text-secondary";
                }
            });
        });
    </script>
</body>
</html>
