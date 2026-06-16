@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Adrian Pratama');
        $brideName = trim($names[1] ?? 'Julia Anastasia');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak H. Soewondo & Ibu Hj. Marina',
                'bride' => 'Bapak Ir. Wijaya & Ibu Lestari',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-11-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Katedral Jakarta',
            'address' => $invitation->address ?? 'Jl. Katedral No.7B, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Katedral Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Pemberkatan',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - Selesai',
                'note' => $invitation->location ?? 'Katedral Jakarta'
            ],
            [
                'title' => 'Resepsi',
                'time' => '19:00 - 22:00',
                'note' => $invitation->address ?? 'The Ritz-Carlton Pacific Place, Grand Ballroom, SCBD, Jakarta'
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
                ['title' => 'The First Meeting', 'date' => 'June 2018', 'text' => 'We met at a local art exhibition. A shared smile over a painting sparked a conversation that lasted for hours.'],
                ['title' => 'The First "I Love You"', 'date' => 'December 2020', 'text' => 'During a snowy walk in the park, amidst the twinkling holiday lights, those three words finally found their way out.'],
                ['title' => 'The Proposal', 'date' => 'August 2022', 'text' => 'On a quiet beach at sunset, Adrian asked the most important question, and Seraphina said yes with tears of joy.']
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-19/images/image_5.jpg'),
                asset('assets/templates/wedding-19/images/image_6.jpg'),
                asset('assets/templates/wedding-19/images/image_7.jpg'),
                asset('assets/templates/wedding-19/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-19/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-19/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-19/images/image_4.jpg'),
        ];
    } else {
        $couple = [
            'groom' => 'Adrian Pratama',
            'bride' => 'Julia Anastasia',
            'parents' => [
                'groom' => 'Bapak H. Soewondo & Ibu Hj. Marina',
                'bride' => 'Bapak Ir. Wijaya & Ibu Lestari',
            ],
        ];

        $event = [
            'date_iso' => '2026-11-24',
            'time' => '08:00',
            'location' => 'Katedral Jakarta',
            'address' => 'Jl. Katedral No.7B, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=Katedral+Jakarta',
        ];

        $schedule = [
            ['title' => 'Pemberkatan', 'time' => '08:00 - Selesai', 'note' => 'Katedral Jakarta'],
            ['title' => 'Resepsi', 'time' => '19:00 - 22:00', 'note' => 'The Ritz-Carlton Pacific Place, Grand Ballroom, SCBD, Jakarta'],
        ];

        $stories = [
            ['title' => 'The First Meeting', 'date' => 'June 2018', 'text' => 'We met at a local art exhibition. A shared smile over a painting sparked a conversation that lasted for hours.'],
            ['title' => 'The First "I Love You"', 'date' => 'December 2020', 'text' => 'During a snowy walk in the park, amidst the twinkling holiday lights, those three words finally found their way out.'],
            ['title' => 'The Proposal', 'date' => 'August 2022', 'text' => 'On a quiet beach at sunset, Adrian asked the most important question, and Seraphina said yes with tears of joy.']
        ];

        $gallery = [
            asset('assets/templates/wedding-19/images/image_5.jpg'),
            asset('assets/templates/wedding-19/images/image_6.jpg'),
            asset('assets/templates/wedding-19/images/image_7.jpg'),
            asset('assets/templates/wedding-19/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-19/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-19/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-19/images/image_4.jpg'),
        ];
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>The Wedding of {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&amp;family=Playfair+Display:ital,wght@0,600;0,700;1,600&amp;display=swap" rel="stylesheet"/>
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
                        "surface-container-lowest": "#ffffff",
                        "on-primary": "#ffffff",
                        "secondary-container": "#e0e0db",
                        "on-error": "#ffffff",
                        "surface-container": "#f0eded",
                        "tertiary-container": "#97b0ff",
                        "on-secondary-fixed-variant": "#454744",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-background": "#1b1c1c",
                        "deep-charcoal": "#2F2F2F",
                        "on-tertiary-container": "#254188",
                        "tertiary": "#415ba4",
                        "on-primary-container": "#554300",
                        "surface-bright": "#fbf9f8",
                        "glass-fill": "rgba(255, 255, 255, 0.4)",
                        "gold-leaf": "#D4AF37",
                        "tertiary-fixed": "#dbe1ff",
                        "on-primary-fixed-variant": "#574500",
                        "on-tertiary-fixed": "#00174b",
                        "on-secondary-container": "#62635f",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed-dim": "#b4c5ff",
                        "champagne-white": "#FDFCF8",
                        "primary-container": "#d4af37",
                        "on-surface-variant": "#4d4635",
                        "secondary-fixed": "#e3e3de",
                        "background": "#fbf9f8",
                        "outline": "#7f7663",
                        "on-primary-fixed": "#241a00",
                        "on-secondary-fixed": "#1a1c19",
                        "secondary": "#5d5f5b",
                        "surface-container-high": "#eae7e7",
                        "primary": "#735c00",
                        "inverse-primary": "#e9c349",
                        "secondary-fixed-dim": "#c6c7c2",
                        "outline-variant": "#d0c5af",
                        "surface-dim": "#dcd9d9",
                        "on-secondary": "#ffffff",
                        "on-surface": "#1b1c1c",
                        "surface": "#fbf9f8",
                        "on-tertiary-fixed-variant": "#27438a",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#ffe088",
                        "surface-container-low": "#f6f3f2",
                        "inverse-surface": "#303030",
                        "glass-border": "rgba(212, 175, 55, 0.3)",
                        "primary-fixed-dim": "#e9c349",
                        "surface-container-highest": "#e4e2e1",
                        "surface-tint": "#735c00",
                        "inverse-on-surface": "#f3f0f0",
                        "surface-variant": "#e4e2e1"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "gutter": "1rem",
                        "element-gap": "1.5rem",
                        "margin-desktop": "4rem",
                        "margin-mobile": "1.5rem",
                        "section-gap": "5rem",
                        "container-max": "1200px"
                    },
                    fontFamily: {
                        "body-lg": ["Montserrat"],
                        "display-lg": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "label-sm": ["Montserrat"],
                        "body-md": ["Montserrat"],
                        "display-lg-mobile": ["Playfair Display"],
                        "headline-sm": ["Playfair Display"],
                        "label-md": ["Montserrat"]
                    },
                    fontSize: {
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-md": ["32px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "label-sm": ["12px", { "lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "500" }],
                        "body-md": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "display-lg-mobile": ["36px", { "lineHeight": "1.2", "fontWeight": "700" }],
                        "headline-sm": ["24px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "label-md": ["14px", { "lineHeight": "1.2", "letterSpacing": "0.1em", "fontWeight": "600" }]
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

        /* Ambient background patterns */
        .pattern-overlay {
            background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');
        }

        .glass-panel {
            background-color: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 4px 30px rgba(212, 175, 55, 0.1);
        }

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        .fade-up.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gold Dust Particles */
        .particle {
            position: absolute;
            background-color: #D4AF37;
            border-radius: 50%;
            opacity: 0.4;
            animation: float 15s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(100vh) translateX(0); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { transform: translateY(-10vh) translateX(20px); opacity: 0; }
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

        #mobile-menu {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 100%;
            max-width: 480px;
            left: 50%;
            transform: translateX(100%);
            z-index: 60;
            background: #fbf9f8;
            transition: transform 0.5s ease-in-out;
        }
        #mobile-menu.open {
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="bg-champagne-white text-deep-charcoal font-body-md antialiased selection:bg-primary selection:text-white max-w-[480px] w-full mx-auto shadow-2xl border-x border-gold-leaf/10 min-h-screen is-locked">

    <!-- Background Texture Overlay -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-0 pointer-events-none opacity-[0.15] pattern-overlay" style="z-index: -1;"></div>

    <!-- Gold Particles Container -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-0 pointer-events-none overflow-hidden" id="particles-container"></div>

    <!-- COVER SCREEN (Buka Undangan) -->
    <section class="fixed inset-0 z-50 max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col justify-center items-center text-center p-6 bg-cover bg-center" id="cover" style="background-image: linear-gradient(rgba(47, 47, 47, 0.6), rgba(47, 47, 47, 0.7)), url('{{ $bg['cover'] }}');">
        <div class="fade-in w-full flex flex-col items-center z-10">
            <p class="font-label-md text-label-md text-gold-leaf uppercase tracking-widest fade-up">The Wedding Of</p>
            <h1 class="font-display-lg-mobile text-display-lg-mobile text-champagne-white mb-8 fade-up" style="transition-delay: 200ms;">
                {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
            </h1>
            
            <!-- Guest Box -->
            <div class="glass-panel rounded-xl p-6 w-full max-w-sm mb-12 fade-up" style="transition-delay: 400ms;">
                <p class="font-label-sm text-label-sm text-champagne-white/80 mb-2">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <p class="font-headline-sm text-lg text-gold-leaf font-semibold border-b border-white/20 pb-2 w-full text-center mt-2">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
                <p class="font-label-sm text-label-sm text-champagne-white/60 mt-2 italic text-[10px]">Mohon maaf bila ada kesalahan penulisan nama/gelar</p>
            </div>

            <!-- Open Button -->
            <button class="group relative inline-flex items-center justify-center px-8 py-3 rounded-full bg-gold-leaf text-deep-charcoal font-label-md text-label-md uppercase tracking-wider overflow-hidden transition-transform hover:scale-105 active:scale-95 fade-up" id="open-invitation-btn" onclick="openInvitation()" style="transition-delay: 600ms;">
                <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></span>
                <span class="material-symbols-outlined mr-2 text-[18px]">drafts</span>
                Buka Undangan
            </button>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="relative z-10 pb-32 w-full overflow-hidden" id="main-content">
        
        <!-- Top Navigation -->
        <header class="fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-40 bg-white/80 backdrop-blur-md border-b border-gold-leaf/20 flex justify-between items-center px-6 py-4 opacity-0 transition-opacity duration-500" id="top-nav">
            <div class="font-display-lg text-lg text-gold-leaf">A &amp; J</div>
            <button class="text-gold-leaf hover:scale-110 transition-transform flex items-center" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </header>

        <!-- Mobile Menu Overlay -->
        <div class="flex flex-col items-center justify-center gap-8" id="mobile-menu">
            <button class="absolute top-6 right-6 text-gold-leaf" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <a class="font-display-lg text-2xl text-deep-charcoal hover:text-gold-leaf" href="#hero" onclick="toggleMobileMenu()">Home</a>
            <a class="font-display-lg text-2xl text-deep-charcoal hover:text-gold-leaf" href="#mempelai" onclick="toggleMobileMenu()">Mempelai</a>
            <a class="font-display-lg text-2xl text-deep-charcoal hover:text-gold-leaf" href="#acara" onclick="toggleMobileMenu()">Acara</a>
            <a class="font-display-lg text-2xl text-deep-charcoal hover:text-gold-leaf" href="#story" onclick="toggleMobileMenu()">Story</a>
            <a class="font-display-lg text-2xl text-deep-charcoal hover:text-gold-leaf" href="#galeri" onclick="toggleMobileMenu()">Gallery</a>
            <a class="font-display-lg text-2xl text-deep-charcoal hover:text-gold-leaf" href="#rsvp" onclick="toggleMobileMenu()">RSVP</a>
        </div>

        <!-- HERO SECTION -->
        <section class="min-h-screen flex flex-col items-center justify-center pt-24 px-6 relative" id="hero">
            <div class="w-full flex flex-col items-center">
                <!-- Main Image -->
                <div class="relative w-full max-w-sm aspect-[3/4] rounded-t-[100px] rounded-b-xl overflow-hidden mb-12 shadow-2xl glass-panel p-1.5 bg-white/40">
                    <img alt="Hero Photo" class="w-full h-full object-cover rounded-t-[100px] rounded-b-lg brightness-105" src="{{ $bg['cover'] }}"/>
                    <!-- Countdown Overlay -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2.5 w-[90%] justify-center z-10">
                        <div class="glass-panel w-14 h-14 rounded-lg flex flex-col items-center justify-center bg-white/70">
                            <span class="font-headline-sm text-sm text-gold-leaf" id="days">00</span>
                            <span class="font-label-sm text-[8px] text-deep-charcoal/80 uppercase">Hari</span>
                        </div>
                        <div class="glass-panel w-14 h-14 rounded-lg flex flex-col items-center justify-center bg-white/70">
                            <span class="font-headline-sm text-sm text-gold-leaf" id="hours">00</span>
                            <span class="font-label-sm text-[8px] text-deep-charcoal/80 uppercase">Jam</span>
                        </div>
                        <div class="glass-panel w-14 h-14 rounded-lg flex flex-col items-center justify-center bg-white/70">
                            <span class="font-headline-sm text-sm text-gold-leaf" id="minutes">00</span>
                            <span class="font-label-sm text-[8px] text-deep-charcoal/80 uppercase">Mnt</span>
                        </div>
                        <div class="glass-panel w-14 h-14 rounded-lg flex flex-col items-center justify-center bg-white/70">
                            <span class="font-headline-sm text-sm text-gold-leaf" id="seconds">00</span>
                            <span class="font-label-sm text-[8px] text-deep-charcoal/80 uppercase">Dtk</span>
                        </div>
                    </div>
                </div>
                <div class="text-center fade-up">
                    <p class="font-label-md text-xs text-gold-leaf uppercase tracking-widest mb-3">Save The Date</p>
                    <h2 class="font-display-lg-mobile text-2xl text-deep-charcoal mb-3">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                    <p class="font-body-lg text-sm text-secondary">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-12 fade-up">
            <div class="w-px h-24 bg-gradient-to-b from-transparent via-gold-leaf to-transparent"></div>
        </div>

        <!-- MEMPELAI SECTION -->
        <section class="py-20 px-6 relative" id="mempelai">
            <div class="text-center mb-12 fade-up">
                <span class="material-symbols-outlined text-gold-leaf text-[28px] mb-3">favorite</span>
                <h2 class="font-headline-md text-xl text-deep-charcoal">Sang Mempelai</h2>
                <p class="font-body-md text-xs text-secondary mt-3 max-w-sm mx-auto">Dengan memohon rahmat dan ridho Tuhan Yang Maha Esa, kami bermaksud menyelenggarakan pernikahan putra-putri kami.</p>
            </div>
            
            <div class="flex flex-col gap-12 w-full max-w-sm mx-auto">
                <!-- Groom -->
                <div class="flex flex-col items-center text-center w-full fade-up glass-panel p-5 rounded-3xl bg-white/60">
                    <div class="relative w-44 h-56 mb-6 p-1.5 rounded-t-full rounded-b-full border border-gold-leaf bg-white/50">
                        <img alt="Groom" class="w-full h-full object-cover rounded-t-full rounded-b-full" src="{{ $bg['groom'] }}"/>
                        <div class="absolute -bottom-2 -right-2 text-gold-leaf">
                            <span class="material-symbols-outlined text-[32px]">spa</span>
                        </div>
                    </div>
                    <h3 class="font-headline-sm text-base text-deep-charcoal mb-1 font-semibold">{{ $couple['groom'] }}</h3>
                    <p class="font-body-md text-xs text-secondary mb-4">Putra Pertama dari<br/>{{ $couple['parents']['groom'] }}</p>
                    <a class="inline-flex items-center gap-1.5 text-gold-leaf font-label-sm text-xs hover:opacity-70 transition-opacity" href="#">
                        <span class="material-symbols-outlined text-sm">link</span> @adrian.prtma
                    </a>
                </div>

                <!-- Groom & Bride Connector -->
                <div class="text-center py-1 fade-up">
                    <span class="font-display-lg text-3xl text-gold-leaf/40 italic">&amp;</span>
                </div>

                <!-- Bride -->
                <div class="flex flex-col items-center text-center w-full fade-up glass-panel p-5 rounded-3xl bg-white/60" style="transition-delay: 200ms;">
                    <div class="relative w-44 h-56 mb-6 p-1.5 rounded-t-full rounded-b-full border border-gold-leaf bg-white/50">
                        <img alt="Bride" class="w-full h-full object-cover rounded-t-full rounded-b-full" src="{{ $bg['bride'] }}"/>
                        <div class="absolute -top-2 -left-2 text-gold-leaf transform rotate-180">
                            <span class="material-symbols-outlined text-[32px]">spa</span>
                        </div>
                    </div>
                    <h3 class="font-headline-sm text-base text-deep-charcoal mb-1 font-semibold">{{ $couple['bride'] }}</h3>
                    <p class="font-body-md text-xs text-secondary mb-4">Putri Bungsu dari<br/>{{ $couple['parents']['bride'] }}</p>
                    <a class="inline-flex items-center gap-1.5 text-gold-leaf font-label-sm text-xs hover:opacity-70 transition-opacity" href="#">
                        <span class="material-symbols-outlined text-sm">link</span> @julia.anst
                    </a>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-12 fade-up">
            <div class="w-px h-24 bg-gradient-to-b from-transparent via-gold-leaf to-transparent"></div>
        </div>

        <!-- ACARA SECTION -->
        <section class="py-20 px-6 relative" id="acara">
            <div class="text-center mb-12 fade-up">
                <span class="material-symbols-outlined text-gold-leaf text-[28px] mb-3">calendar_today</span>
                <h2 class="font-headline-md text-xl text-deep-charcoal">Rangkaian Acara</h2>
            </div>
            
            <div class="flex flex-col gap-8 w-full max-w-sm mx-auto">
                <!-- Pemberkatan / Akad -->
                <div class="glass-panel rounded-2xl p-6 text-center relative overflow-hidden fade-up bg-white/60">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-leaf to-transparent"></div>
                    <h3 class="font-headline-sm text-base text-deep-charcoal mb-4 font-semibold">{{ $schedule[0]['title'] }}</h3>
                    <div class="flex flex-col gap-3 mb-6">
                        <div class="flex items-center justify-center gap-2 text-secondary text-xs">
                            <span class="material-symbols-outlined text-gold-leaf text-base">event</span>
                            <span>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex items-center justify-center gap-2 text-secondary text-xs">
                            <span class="material-symbols-outlined text-gold-leaf text-base">schedule</span>
                            <span>Pukul {{ $schedule[0]['time'] }} WIB</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 text-secondary mt-1 text-xs">
                            <span class="material-symbols-outlined text-gold-leaf text-base">location_on</span>
                            <span class="font-semibold text-deep-charcoal">{{ $schedule[0]['note'] }}</span>
                            <span class="text-[11px] leading-relaxed text-center">{{ $event['address'] }}</span>
                        </div>
                    </div>
                    <a class="inline-flex items-center justify-center px-6 py-2 rounded-full border border-gold-leaf text-gold-leaf font-label-sm text-xs hover:bg-gold-leaf hover:text-white transition-colors bg-white/80" href="{{ $event['maps_url'] }}" target="_blank">
                        <span class="material-symbols-outlined mr-1.5 text-sm">map</span> Petunjuk Arah
                    </a>
                </div>
                
                <!-- Resepsi -->
                <div class="glass-panel rounded-2xl p-6 text-center relative overflow-hidden fade-up bg-white/60" style="transition-delay: 200ms;">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-leaf to-transparent"></div>
                    <h3 class="font-headline-sm text-base text-deep-charcoal mb-4 font-semibold">{{ $schedule[1]['title'] }}</h3>
                    <div class="flex flex-col gap-3 mb-6">
                        <div class="flex items-center justify-center gap-2 text-secondary text-xs">
                            <span class="material-symbols-outlined text-gold-leaf text-base">event</span>
                            <span>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex items-center justify-center gap-2 text-secondary text-xs">
                            <span class="material-symbols-outlined text-gold-leaf text-base">schedule</span>
                            <span>Pukul {{ $schedule[1]['time'] }} WIB</span>
                        </div>
                        <div class="flex flex-col items-center justify-center gap-1 text-secondary mt-1 text-xs">
                            <span class="material-symbols-outlined text-gold-leaf text-base">location_on</span>
                            <span class="font-semibold text-deep-charcoal">{{ $schedule[1]['note'] }}</span>
                        </div>
                    </div>
                    <a class="inline-flex items-center justify-center px-6 py-2 rounded-full border border-gold-leaf text-gold-leaf font-label-sm text-xs hover:bg-gold-leaf hover:text-white transition-colors bg-white/80" href="{{ $event['maps_url'] }}" target="_blank">
                        <span class="material-symbols-outlined mr-1.5 text-sm">map</span> Petunjuk Arah
                    </a>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-12 fade-up">
            <div class="w-px h-24 bg-gradient-to-b from-transparent via-gold-leaf to-transparent"></div>
        </div>

        <!-- STORY SECTION -->
        <section class="py-20 px-6 relative" id="story">
            <div class="text-center mb-12 fade-up">
                <span class="material-symbols-outlined text-gold-leaf text-[28px] mb-3">auto_awesome</span>
                <h2 class="font-headline-md text-xl text-deep-charcoal">Kisah Cinta</h2>
            </div>
            
            <div class="max-w-sm mx-auto w-full relative pl-6 border-l-2 border-gold-leaf/30">
                @foreach($stories as $s)
                <div class="fade-up relative mb-12 last:mb-0">
                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 bg-gold-leaf rounded-full border-4 border-background"></div>
                    <div class="glass-panel p-5 rounded-2xl bg-white/60">
                        <span class="font-label-md text-[10px] text-primary uppercase tracking-widest mb-1.5 block font-semibold">{{ $s['date'] }}</span>
                        <h3 class="font-headline-md text-sm text-deep-charcoal mb-2">{{ $s['title'] }}</h3>
                        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">{{ $s['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-12 fade-up">
            <div class="w-px h-24 bg-gradient-to-b from-transparent via-gold-leaf to-transparent"></div>
        </div>

        <!-- GALERI SECTION -->
        <section class="py-20 px-6 relative" id="galeri">
            <div class="text-center mb-12 fade-up">
                <span class="material-symbols-outlined text-gold-leaf text-[28px] mb-3">collections</span>
                <h2 class="font-headline-md text-xl text-deep-charcoal">Galeri Momen</h2>
            </div>
            
            <!-- Grid Asimetris -->
            <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto w-full relative z-10">
                @foreach($gallery as $index => $img)
                @php
                    $span = '';
                    if ($index == 0) $span = 'col-span-2 row-span-2';
                @endphp
                <div class="rounded-xl overflow-hidden glass-panel p-1.5 fade-up cursor-zoom-in group bg-white/50 hover:border-gold-leaf transition-all duration-300 {{ $span }}" onclick="openLightbox('{{ $img }}')">
                    <img alt="Gallery {{ $index+1 }}" class="w-full h-full object-cover rounded-lg hover:scale-105 transition-transform duration-500" src="{{ $img }}"/>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-12 fade-up">
            <div class="w-px h-24 bg-gradient-to-b from-transparent via-gold-leaf to-transparent"></div>
        </div>

        <!-- RSVP & KADO SECTION -->
        <section class="py-20 px-6 relative" id="rsvp">
            <div class="glass-panel rounded-3xl p-6 relative z-10 max-w-sm mx-auto bg-white/60">
                
                <div class="text-center mb-8 fade-up">
                    <span class="material-symbols-outlined text-gold-leaf text-[28px] mb-3">rate_review</span>
                    <h2 class="font-headline-md text-lg text-deep-charcoal mb-2">RSVP &amp; Ucapan</h2>
                    <p class="font-body-md text-xs text-secondary leading-relaxed">Kehadiran dan doa restu Anda adalah kado terindah bagi kami.</p>
                </div>
                
                <form class="flex flex-col gap-4 fade-up" id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div>
                        <input class="w-full bg-transparent border-0 border-b border-gold-leaf/50 focus:border-gold-leaf focus:ring-0 px-0 py-2.5 text-deep-charcoal font-body-md text-xs placeholder-secondary transition-colors" placeholder="Nama Lengkap" type="text" id="nama" required/>
                    </div>
                    <div class="flex gap-6 py-2">
                        <label class="flex items-center gap-2 cursor-pointer text-xs">
                            <input class="text-gold-leaf focus:ring-gold-leaf bg-transparent border-gold-leaf/50" name="attendance" type="radio" value="Hadir" checked id="hadir-opt"/>
                            <span class="font-body-md text-secondary">Hadir</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-xs">
                            <input class="text-gold-leaf focus:ring-gold-leaf bg-transparent border-gold-leaf/50" name="attendance" type="radio" value="Berhalangan" id="tidak-opt"/>
                            <span class="font-body-md text-secondary">Maaf, Tidak Hadir</span>
                        </label>
                    </div>
                    <div>
                        <select class="w-full bg-transparent border-0 border-b border-gold-leaf/50 focus:border-gold-leaf focus:ring-0 px-0 py-2.5 text-deep-charcoal font-body-md text-xs cursor-pointer appearance-none" id="guests">
                            <option value="1">1 Orang</option>
                            <option value="2">2 Orang</option>
                        </select>
                    </div>
                    <div>
                        <textarea class="w-full bg-transparent border border-gold-leaf/50 rounded-lg focus:border-gold-leaf focus:ring-0 p-3 text-deep-charcoal font-body-md text-xs placeholder-secondary resize-none h-24" placeholder="Tulis Ucapan &amp; Doa..." rows="3" id="pesan" required></textarea>
                    </div>
                    <button class="w-full py-3.5 rounded-full bg-gold-leaf text-deep-charcoal font-label-md text-xs uppercase tracking-wider hover:bg-opacity-90 transition-all mt-2 font-semibold" type="submit">
                        Kirim Konfirmasi
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="w-full flex items-center gap-4 my-8">
                    <div class="h-px bg-gold-leaf/30 flex-1"></div>
                    <span class="material-symbols-outlined text-gold-leaf text-sm">card_giftcard</span>
                    <div class="h-px bg-gold-leaf/30 flex-1"></div>
                </div>
                
                <!-- Wedding Gift -->
                <div class="text-center fade-up">
                    <h3 class="font-headline-sm text-sm text-deep-charcoal mb-2 font-semibold">Wedding Gift</h3>
                    <p class="font-body-md text-[11px] text-secondary mb-6 leading-relaxed">Bagi keluarga dan sahabat yang ingin mengirimkan tanda kasih, dapat melalui:</p>
                    
                    @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                        <div class="space-y-4">
                            @foreach($invitation->bankAccounts as $bank)
                            <div class="glass-panel p-4 rounded-xl border border-gold-leaf/50 text-left w-full bg-white/40">
                                <p class="font-label-md text-xs text-secondary uppercase mb-1 font-semibold">{{ strtoupper($bank->bank_name) }}</p>
                                <p class="font-headline-sm text-base text-deep-charcoal tracking-wider mb-1 font-medium">{{ $bank->account_number }}</p>
                                <p class="font-body-md text-xs text-secondary mb-3">a.n. {{ $bank->account_name }}</p>
                                <button class="flex items-center justify-center gap-1.5 w-full py-2 border border-gold-leaf text-gold-leaf rounded-full hover:bg-gold-leaf hover:text-white transition-colors text-xs bg-white/80" onclick="copyAccount('{{ $bank->account_number }}', this)">
                                    <span class="material-symbols-outlined text-[14px]">content_copy</span> Salin Nomor Rekening
                                </button>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="glass-panel p-4 rounded-xl border border-gold-leaf/50 text-left w-full bg-white/40">
                            <p class="font-label-md text-xs text-secondary uppercase mb-1 font-semibold">BCA</p>
                            <p class="font-headline-sm text-base text-deep-charcoal tracking-wider mb-1 font-medium">1234 5678 90</p>
                            <p class="font-body-md text-xs text-secondary mb-3">a.n. Adrian Pratama</p>
                            <button class="flex items-center justify-center gap-1.5 w-full py-2 border border-gold-leaf text-gold-leaf rounded-full hover:bg-gold-leaf hover:text-white transition-colors text-xs bg-white/80" onclick="copyAccount('1234 5678 90', this)">
                                <span class="material-symbols-outlined text-[14px]">content_copy</span> Salin Nomor Rekening
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Wishes List Guestbook -->
        <section class="py-12 px-6 max-w-sm mx-auto w-full">
            <div class="glass-panel rounded-2xl p-6 flex flex-col h-[350px] bg-white/50">
                <h3 class="font-headline-md text-deep-charcoal mb-4 text-center font-medium text-sm">Guestbook</h3>
                <div class="flex-1 overflow-y-auto pr-1 space-y-4 no-scrollbar" id="wishList">
                    <div class="bg-white/40 p-4 rounded-xl border border-white/20 text-left">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-label-md text-primary text-xs font-semibold">Eleanor Vance</span>
                            <span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                        </div>
                        <p class="font-body-md text-on-surface-variant text-xs leading-relaxed">Wishing you both a lifetime of happiness and love. Can't wait to celebrate!</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- FOOTER -->
        <footer class="w-full py-12 border-t border-glass-border bg-champagne-white flex flex-col items-center gap-4 px-6 relative z-10 pb-32">
            <div class="font-display-lg text-gold-leaf text-xl uppercase tracking-widest">A &amp; J</div>
            <p class="font-body-md text-xs text-secondary text-center max-w-xs leading-relaxed">Terima kasih atas segala doa dan restu yang telah diberikan.</p>
            <div class="mt-4 text-gold-leaf font-semibold font-label-sm text-[10px] uppercase tracking-widest">
                With Love, 2026
            </div>
        </footer>
    </main>

    <!-- BottomNavBar (Mobile & Desktop Centered) -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 flex justify-around items-center py-2 px-3 bg-glass-fill backdrop-blur-xl border border-glass-border shadow-[0_0_30px_rgba(212,175,55,0.05)] w-[90%] max-w-[432px] rounded-full translate-y-32 transition-transform duration-500" id="bottom-nav">
        <a class="flex items-center justify-center bg-primary-container text-deep-charcoal rounded-full w-10 h-10 hover:bg-gold-leaf/20 transition-all active:scale-90 duration-300" href="#cover" onclick="smoothScroll(event, '#cover')">
            <span class="material-symbols-outlined text-[18px]">home</span>
        </a>
        <a class="flex items-center justify-center text-gold-leaf w-10 h-10 hover:bg-gold-leaf/20 transition-all rounded-full active:scale-90 duration-300" href="#mempelai" onclick="smoothScroll(event, '#mempelai')">
            <span class="material-symbols-outlined text-[18px]">favorite</span>
        </a>
        <a class="flex items-center justify-center text-gold-leaf w-10 h-10 hover:bg-gold-leaf/20 transition-all rounded-full active:scale-90 duration-300" href="#acara" onclick="smoothScroll(event, '#acara')">
            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
        </a>
        <a class="flex items-center justify-center text-gold-leaf w-10 h-10 hover:bg-gold-leaf/20 transition-all rounded-full active:scale-90 duration-300" href="#galeri" onclick="smoothScroll(event, '#galeri')">
            <span class="material-symbols-outlined text-[18px]">collections</span>
        </a>
        <a class="flex items-center justify-center text-gold-leaf w-10 h-10 hover:bg-gold-leaf/20 transition-all rounded-full active:scale-90 duration-300" href="#rsvp" onclick="smoothScroll(event, '#rsvp')">
            <span class="material-symbols-outlined text-[18px]">rsvp</span>
        </a>
    </nav>

    <!-- Floating Action Controls -->
    <div class="fixed bottom-24 left-1/2 translate-x-[170px] z-[45] flex flex-col gap-3 transform translate-y-32 transition-transform duration-500" id="floating-controls">
        <!-- Music Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-white/95 text-gold-leaf border border-gold-leaf/30 flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAudio()">
            <span class="material-symbols-outlined" id="music-icon">volume_up</span>
        </button>
        <!-- Autoscroll Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-white/95 text-gold-leaf border border-gold-leaf/30 flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAutoscroll()">
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
    <script>
        let isPlaying = false;
        let isScrolling = false;
        let scrollInterval;

        document.addEventListener('DOMContentLoaded', () => {
            // Observe cover elements immediately
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            window.observer = observer;

            document.querySelectorAll('#cover .fade-up').forEach(el => {
                observer.observe(el);
            });

            // Start gold particles animation
            initGoldParticles();
            
            // Start countdown
            initCountdown();
        });

        // CSS Particles generator
        function initGoldParticles() {
            const container = document.getElementById('particles-container');
            if (!container) return;

            const particleCount = 35;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 3 + 1.5; 
                const leftPosition = Math.random() * 100; 
                const floatDuration = Math.random() * 12 + 8; 
                const delay = Math.random() * -20; 

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${leftPosition}%`;
                particle.style.animationDuration = `${floatDuration}s`;
                particle.style.animationDelay = `${delay}s`;

                container.appendChild(particle);
            }
        }

        // Open Invitation
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
                cover.classList.add('hidden-cover');
                cover.classList.add('hidden');
                navHeader.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-32');
                floatingControls.classList.remove('translate-y-32');
                
                audio.play().then(() => {
                    isPlaying = true;
                    document.getElementById('music-icon').innerText = 'volume_up';
                }).catch(err => console.log('Audio play blocked:', err));

                // Observe main content elements
                document.querySelectorAll('#main-content .fade-up').forEach(el => {
                    if (window.observer) window.observer.observe(el);
                });

                startAutoscroll();
            }, 500);
        }

        // Audio Toggle
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

        // Autoscroll
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

        // Copy Account
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
            card.className = 'bg-white/40 p-4 rounded-xl border border-white/20 text-left';
            card.innerHTML = `<div class="flex justify-between items-center mb-1"><span class="font-label-md text-primary text-xs font-semibold">${name}</span><span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">${presence}</span></div><p class="font-body-md text-on-surface-variant text-xs leading-relaxed">${msg}</p>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP berhasil dikirim, terima kasih!");
        }

        // Lightbox
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
                a.className = "flex items-center justify-center text-gold-leaf w-10 h-10 hover:bg-gold-leaf/20 transition-all rounded-full active:scale-90 duration-300";
            });
            if (selector === '#cover') {
                e.currentTarget.className = "flex items-center justify-center bg-primary-container text-deep-charcoal rounded-full w-10 h-10 hover:bg-gold-leaf/20 transition-all active:scale-90 duration-300";
            } else {
                e.currentTarget.className = "flex items-center justify-center bg-primary-container text-deep-charcoal rounded-full w-10 h-10 active:scale-90 duration-300";
            }
        }

        // Mobile Menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }

        // Countdown Timer
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

        // Scroll highlight
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
                a.className = "flex items-center justify-center text-gold-leaf w-10 h-10 hover:bg-gold-leaf/20 transition-all rounded-full active:scale-90 duration-300";
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex items-center justify-center bg-primary-container text-deep-charcoal rounded-full w-10 h-10 hover:bg-gold-leaf/20 transition-all active:scale-90 duration-300 scale-105";
                }
            });
        });
    </script>
</body>
</html>