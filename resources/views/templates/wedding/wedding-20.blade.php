@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Julian Alexander');
        $brideName = trim($names[1] ?? 'Aria Montgomery');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Robert Alexander & Ibu Sarah Alexander',
                'bride' => 'Bapak David Montgomery & Ibu Elena Montgomery',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-08-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '09:00',
            'location' => $invitation->location ?? 'The Royal Cathedral',
            'address' => $invitation->address ?? '123 King\'s Avenue, Central District',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Royal Cathedral'),
        ];

        $schedule = [
            [
                'title' => 'Holy Matrimony',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '09:00') . ' - 11:00',
                'note' => $invitation->location ?? 'The Royal Cathedral'
            ],
            [
                'title' => 'Grand Reception',
                'time' => '18:00 - Selesai',
                'note' => $invitation->address ?? 'Grand Palace Hotel, Grand Ballroom, 1st Floor'
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
                ['title' => 'First Meeting', 'date' => 'August 2021', 'text' => 'We met under the soft lights of an evening gala. A brief introduction led to a conversation that flowed effortlessly into the night.'],
                ['title' => 'The Proposal', 'date' => 'December 2023', 'text' => 'High on a snow-covered peak under a blanket of stars, Julian asked Aria to walk with him forever, and she said yes.'],
                ['title' => 'The Big Day', 'date' => 'August 2026', 'text' => 'We seal our eternal promise in a celebration surrounded by those we hold most dear.']
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-20/images/image_5.jpg'),
                asset('assets/templates/wedding-20/images/image_6.jpg'),
                asset('assets/templates/wedding-20/images/image_7.jpg'),
                asset('assets/templates/wedding-20/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-20/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-20/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-20/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-20/images/image_4.jpg'),
        ];
    } else {
        $couple = [
            'groom' => 'Julian Alexander',
            'bride' => 'Aria Montgomery',
            'parents' => [
                'groom' => 'Bapak Robert Alexander & Ibu Sarah Alexander',
                'bride' => 'Bapak David Montgomery & Ibu Elena Montgomery',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-24',
            'time' => '09:00',
            'location' => 'The Royal Cathedral',
            'address' => '123 King\'s Avenue, Central District',
            'maps_url' => 'https://maps.google.com/?q=The+Royal+Cathedral',
        ];

        $schedule = [
            ['title' => 'Holy Matrimony', 'time' => '09:00 - 11:00', 'note' => 'The Royal Cathedral'],
            ['title' => 'Grand Reception', 'time' => '18:00 - Selesai', 'note' => 'Grand Palace Hotel, Grand Ballroom'],
        ];

        $stories = [
            ['title' => 'First Meeting', 'date' => 'August 2021', 'text' => 'We met under the soft lights of an evening gala. A brief introduction led to a conversation that flowed effortlessly into the night.'],
            ['title' => 'The Proposal', 'date' => 'December 2023', 'text' => 'High on a snow-covered peak under a blanket of stars, Julian asked Aria to walk with him forever, and she said yes.'],
            ['title' => 'The Big Day', 'date' => 'August 2026', 'text' => 'We seal our eternal promise in a celebration surrounded by those we hold most dear.']
        ];

        $gallery = [
            asset('assets/templates/wedding-20/images/image_5.jpg'),
            asset('assets/templates/wedding-20/images/image_6.jpg'),
            asset('assets/templates/wedding-20/images/image_7.jpg'),
            asset('assets/templates/wedding-20/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-20/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-20/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-20/images/image_3.jpg'),
            'bride' => asset('assets/templates/wedding-20/images/image_4.jpg'),
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
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&amp;family=Montserrat:wght@400;600;700&amp;family=Plus+Jakarta+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Tailwind Config injected from Style Guidance -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed": "#221b0b",
                        "outline-variant": "#43474e",
                        "on-secondary-fixed": "#241a00",
                        "inverse-on-surface": "#203147",
                        "on-primary-fixed-variant": "#2f486a",
                        "on-primary": "#163152",
                        "surface-container-high": "#192b40",
                        "champagne": "#F7E7CE",
                        "rich-gold": "#D4AF37",
                        "outline": "#8e9198",
                        "surface-tint": "#afc8f0",
                        "secondary": "#e9c349",
                        "background": "#011428",
                        "surface-container-lowest": "#000f21",
                        "secondary-fixed-dim": "#e9c349",
                        "on-secondary-fixed-variant": "#574500",
                        "surface-bright": "#293a50",
                        "on-primary-container": "#6f88ad",
                        "surface-container": "#0e2035",
                        "deep-navy": "#001F3F",
                        "on-tertiary-container": "#928570",
                        "surface-dim": "#011428",
                        "primary-fixed": "#d4e3ff",
                        "surface-container-low": "#091c31",
                        "on-error": "#690005",
                        "on-tertiary": "#382f1e",
                        "secondary-container": "#af8d11",
                        "primary-container": "#001f3f",
                        "error": "#ffb4ab",
                        "surface-variant": "#24364b",
                        "secondary-fixed": "#ffe088",
                        "primary": "#afc8f0",
                        "surface": "#011428",
                        "tertiary-container": "#261e0e",
                        "primary-fixed-dim": "#afc8f0",
                        "on-error-container": "#ffdad6",
                        "tertiary-fixed": "#f0e0c8",
                        "on-background": "#d2e4ff",
                        "on-secondary-container": "#342800",
                        "ivory-light": "#FFFDF5",
                        "gold-shimmer": "#FFD700",
                        "error-container": "#93000a",
                        "on-surface": "#d2e4ff",
                        "on-surface-variant": "#c4c6cf",
                        "on-secondary": "#3c2f00",
                        "on-tertiary-fixed-variant": "#4f4533",
                        "inverse-primary": "#476083",
                        "tertiary-fixed-dim": "#d3c5ad",
                        "tertiary": "#d3c5ad",
                        "surface-container-highest": "#24364b",
                        "on-primary-fixed": "#001c3a",
                        "inverse-surface": "#d2e4ff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-mobile": "20px",
                        "section-gap": "120px",
                        "gutter": "24px",
                        "container-max": "1200px",
                        "element-gap": "32px"
                    },
                    "fontFamily": {
                        "display-hero": ["Bodoni Moda", "serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "section-title": ["Bodoni Moda", "serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "label-caps": ["Montserrat", "sans-serif"],
                        "couple-name": ["Bodoni Moda", "serif"],
                        "display-hero-mobile": ["Bodoni Moda", "serif"]
                    },
                    "fontSize": {
                        "display-hero": ["72px", {"lineHeight": "80px", "letterSpacing": "-0.02em", "fontWeight": "900"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "section-title": ["32px", {"lineHeight": "40px", "letterSpacing": "0.1em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.2em", "fontWeight": "600"}],
                        "couple-name": ["56px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "display-hero-mobile": ["48px", {"lineHeight": "52px", "fontWeight": "900"}]
                    }
                }
            }
        };
    </script>
    <style>
        body { background-color: #001F3F; }
        
        .gold-gradient-text {
            background: linear-gradient(to right, #D4AF37, #F7E7CE, #D4AF37);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .glass-panel {
            background-color: rgba(0, 31, 63, 0.6); /* deep-navy tinted */
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid #D4AF37;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.5), inset 0 0 20px rgba(212, 175, 55, 0.1);
        }

        .btn-primary {
            position: relative;
            background: linear-gradient(135deg, rgba(212,175,55,0.8) 0%, rgba(0,31,63,0.9) 100%);
            border: 2px solid #D4AF37;
            color: #FFFDF5;
            text-transform: uppercase;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.3);
        }
        
        .btn-primary::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: rotate(45deg);
            transition: all 0.5s ease;
            opacity: 0;
        }

        .btn-primary:hover::after {
            opacity: 1;
            left: 100%;
        }

        .btn-primary:hover {
            box-shadow: 0 0 25px rgba(212, 175, 55, 0.6);
            transform: translateY(-2px);
        }

        .gallery-item {
            border: 2px solid #D4AF37;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            transition: transform 0.4s ease;
        }
        .gallery-item:hover {
            transform: scale(1.03) rotate(0deg);
            z-index: 10;
        }

        /* Ambient background patterns */
        .pattern-overlay {
            background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll { overflow: hidden; }
    </style>
</head>
<body class="bg-background text-champagne font-body-md antialiased max-w-[480px] w-full mx-auto shadow-2xl border-x border-rich-gold/10 min-h-screen relative overflow-x-hidden hide-scroll">

    <!-- Background Texture Overlay -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-0 pointer-events-none opacity-[0.1] pattern-overlay" style="z-index: -1;"></div>

    <!-- ==============================================
             COVER SCREEN (Buka Undangan)
             ============================================== -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] flex flex-col items-center justify-center transition-transform duration-[1500ms] ease-in-out bg-deep-navy" id="cover-screen">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img alt="Prewedding Cover" class="w-full h-full object-cover opacity-50 mix-blend-luminosity" src="{{ $bg['cover'] }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-deep-navy via-deep-navy/50 to-transparent"></div>
        </div>
        <!-- Cover Content -->
        <div class="relative z-10 flex flex-col items-center text-center px-6">
            <p class="font-label-caps text-label-caps text-rich-gold mb-6 tracking-[0.3em]">THE WEDDING OF</p>
            <!-- Highly Stylized Names -->
            <div class="relative mb-12">
                <span class="material-symbols-outlined absolute -top-8 left-1/2 -translate-x-1/2 text-rich-gold text-4xl opacity-80" style="font-variation-settings: 'FILL' 1;">stars</span>
                <h1 class="font-couple-name text-display-hero-mobile gold-gradient-text italic">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            </div>
            <!-- Guest Card -->
            <div class="glass-panel p-6 rounded-xl max-w-sm w-full mb-10 flex flex-col items-center">
                <p class="font-body-md text-champagne/80 mb-2">Dear,</p>
                <p class="font-section-title text-2xl text-rich-gold mb-4">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
                <p class="font-body-md text-xs text-champagne/60 text-center">We cordially invite you to share in our joy.</p>
            </div>
            <button class="btn-primary rounded-full px-8 py-4 flex items-center gap-2 font-label-caps text-label-caps group" onclick="openInvitation()">
                <span class="material-symbols-outlined text-rich-gold group-hover:animate-spin">mail</span>
                Buka Undangan
            </button>
        </div>
    </div>

    <!-- ==============================================
             MAIN CONTENT WRAPPER
             ============================================== -->
    <div class="relative z-10 opacity-0 transition-opacity duration-1000" id="main-content">
        <!-- ==============================================
                 TOP APP BAR - Centered
                 ============================================== -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 max-w-[480px] w-full z-50 flex justify-between items-center px-6 py-4 bg-transparent transition-all duration-300" id="top-nav">
            <div class="font-couple-name text-rich-gold drop-shadow-sm text-2xl">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</div>
            <button class="text-rich-gold hover:text-gold-shimmer transition-colors bg-surface-container/60 p-2.5 rounded-full border border-rich-gold/30 flex items-center justify-center" id="music-toggle-web" onclick="toggleMusic()">
                <span class="material-symbols-outlined text-lg" id="music-icon-web">music_note</span>
            </button>
        </header>

        <!-- ==============================================
                 HERO SECTION (Home)
                 ============================================== -->
        <section class="relative min-h-screen flex items-center justify-center pt-24 pb-20 px-6" id="home">
            <div class="absolute inset-0 z-0">
                <img alt="Hero Background" class="w-full h-full object-cover opacity-35 mix-blend-overlay" src="{{ $bg['hero'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-b from-deep-navy/80 via-transparent to-deep-navy"></div>
            </div>
            <div class="relative z-10 w-full flex flex-col items-center text-center">
                <!-- Crest -->
                <div class="mb-8 flex flex-col items-center">
                    <span class="material-symbols-outlined text-rich-gold text-5xl mb-2">diamond</span>
                    <div class="h-16 w-px bg-gradient-to-b from-rich-gold to-transparent"></div>
                </div>
                <h2 class="font-couple-name text-display-hero-mobile gold-gradient-text mb-12">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                <!-- Countdown Glassmorphism -->
                <div class="grid grid-cols-4 gap-2 w-full max-w-sm mx-auto">
                    <!-- Days -->
                    <div class="glass-panel p-3.5 flex flex-col items-center justify-center rounded-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-6 h-6 bg-rich-gold/10 rounded-bl-full"></div>
                        <span class="font-section-title text-2xl text-rich-gold mb-0.5" id="days">00</span>
                        <span class="font-label-caps text-[9px] text-champagne/80">Hari</span>
                    </div>
                    <!-- Hours -->
                    <div class="glass-panel p-3.5 flex flex-col items-center justify-center rounded-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-6 h-6 bg-rich-gold/10 rounded-bl-full"></div>
                        <span class="font-section-title text-2xl text-rich-gold mb-0.5" id="hours">00</span>
                        <span class="font-label-caps text-[9px] text-champagne/80">Jam</span>
                    </div>
                    <!-- Minutes -->
                    <div class="glass-panel p-3.5 flex flex-col items-center justify-center rounded-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-6 h-6 bg-rich-gold/10 rounded-bl-full"></div>
                        <span class="font-section-title text-2xl text-rich-gold mb-0.5" id="minutes">00</span>
                        <span class="font-label-caps text-[9px] text-champagne/80">Menit</span>
                    </div>
                    <!-- Seconds -->
                    <div class="glass-panel p-3.5 flex flex-col items-center justify-center rounded-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-6 h-6 bg-rich-gold/10 rounded-bl-full"></div>
                        <span class="font-section-title text-2xl text-rich-gold mb-0.5" id="seconds">00</span>
                        <span class="font-label-caps text-[9px] text-champagne/80">Detik</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-6">
            <div class="w-24 h-px bg-gradient-to-r from-transparent via-rich-gold to-transparent"></div>
        </div>

        <!-- ==============================================
                 PROFILE SECTION
                 ============================================== -->
        <section class="py-16 px-6 relative" id="mempelai">
            <div class="w-full">
                <div class="text-center mb-12 flex flex-col items-center">
                    <span class="material-symbols-outlined text-rich-gold text-3xl mb-3">favorite</span>
                    <h3 class="font-section-title text-xl text-rich-gold tracking-widest uppercase">The Groom &amp; Bride</h3>
                    <p class="font-body-md text-xs text-champagne/70 mt-2 max-w-xs mx-auto">Dengan memohon rahmat dan ridho Tuhan Yang Maha Esa, kami bermaksud menyelenggarakan pernikahan kami.</p>
                </div>
                <div class="flex flex-col gap-12 items-center">
                    <!-- Groom -->
                    <div class="flex flex-col items-center text-center">
                        <div class="relative w-56 h-72 mb-6 p-1.5 rounded-[100px] border border-rich-gold/50 bg-surface-container-high/30">
                            <img alt="Groom" class="w-full h-full object-cover rounded-[90px] grayscale sepia-[0.3]" src="{{ $bg['groom'] }}"/>
                            <div class="absolute -top-3 -right-3 w-10 h-10 border-t-2 border-r-2 border-rich-gold rounded-tr-xl"></div>
                            <div class="absolute -bottom-3 -left-3 w-10 h-10 border-b-2 border-l-2 border-rich-gold rounded-bl-xl"></div>
                        </div>
                        <h4 class="font-couple-name text-3xl text-champagne mb-1">{{ $couple['groom'] }}</h4>
                        <p class="font-body-md text-xs text-champagne/60 leading-relaxed max-w-[280px]">Putra dari {{ $couple['parents']['groom'] }}</p>
                    </div>

                    <!-- Ampersand -->
                    <div class="font-couple-name text-5xl text-rich-gold/40">&amp;</div>

                    <!-- Bride -->
                    <div class="flex flex-col items-center text-center">
                        <div class="relative w-56 h-72 mb-6 p-1.5 rounded-[100px] border border-rich-gold/50 bg-surface-container-high/30">
                            <img alt="Bride" class="w-full h-full object-cover rounded-[90px] grayscale sepia-[0.3]" src="{{ $bg['bride'] }}"/>
                            <div class="absolute -top-3 -left-3 w-10 h-10 border-t-2 border-l-2 border-rich-gold rounded-tl-xl"></div>
                            <div class="absolute -bottom-3 -right-3 w-10 h-10 border-b-2 border-r-2 border-rich-gold rounded-br-xl"></div>
                        </div>
                        <h4 class="font-couple-name text-3xl text-champagne mb-1">{{ $couple['bride'] }}</h4>
                        <p class="font-body-md text-xs text-champagne/60 leading-relaxed max-w-[280px]">Putri dari {{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-6">
            <div class="w-24 h-px bg-gradient-to-r from-transparent via-rich-gold to-transparent"></div>
        </div>

        <!-- ==============================================
                 EVENTS SECTION (Save The Date)
                 ============================================== -->
        <section class="py-16 px-6 relative bg-surface-container-low" id="events">
            <!-- Background Texture -->
            <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(theme('colors.rich-gold') 1px, transparent 1px); background-size: 30px 30px;"></div>
            <div class="relative z-10 w-full">
                <div class="text-center mb-12 flex flex-col items-center">
                    <span class="material-symbols-outlined text-rich-gold text-3xl mb-3">event_available</span>
                    <h3 class="font-section-title text-xl text-rich-gold tracking-widest uppercase">Wedding Events</h3>
                </div>
                <div class="flex flex-col gap-8 items-center">
                    <!-- Event 1 -->
                    <div class="glass-panel p-6 rounded-xl w-full max-w-sm relative overflow-hidden group">
                        <div class="absolute -right-8 -top-8 text-7xl text-rich-gold/5 group-hover:text-rich-gold/10 transition-colors pointer-events-none">
                            <span class="material-symbols-outlined">church</span>
                        </div>
                        <h4 class="font-couple-name text-2xl text-champagne mb-4 border-b border-rich-gold/30 pb-3">{{ $schedule[0]['title'] }}</h4>
                        <div class="space-y-3 font-body-md text-champagne/80 mb-6 text-sm">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-rich-gold text-lg">calendar_month</span>
                                <div>
                                    <p class="font-bold text-champagne">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                                    <p class="text-xs">Pukul {{ $schedule[0]['time'] }} WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-rich-gold text-lg">location_on</span>
                                <div>
                                    <p class="font-bold text-champagne">{{ $schedule[0]['note'] }}</p>
                                    <p class="text-xs leading-relaxed">{{ $event['address'] }}</p>
                                </div>
                            </div>
                        </div>
                        <a class="btn-primary inline-flex items-center justify-center gap-2 w-full py-2.5 text-xs font-bold tracking-wider rounded" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-sm">map</span> Petunjuk Arah
                        </a>
                    </div>
                    <!-- Event 2 -->
                    <div class="glass-panel p-6 rounded-xl w-full max-w-sm relative overflow-hidden group">
                        <div class="absolute -right-8 -top-8 text-7xl text-rich-gold/5 group-hover:text-rich-gold/10 transition-colors pointer-events-none">
                            <span class="material-symbols-outlined">wine_bar</span>
                        </div>
                        <h4 class="font-couple-name text-2xl text-champagne mb-4 border-b border-rich-gold/30 pb-3">{{ $schedule[1]['title'] }}</h4>
                        <div class="space-y-3 font-body-md text-champagne/80 mb-6 text-sm">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-rich-gold text-lg">calendar_month</span>
                                <div>
                                    <p class="font-bold text-champagne">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                                    <p class="text-xs">Pukul {{ $schedule[1]['time'] }} WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-rich-gold text-lg">location_on</span>
                                <div>
                                    <p class="font-bold text-champagne">{{ $schedule[1]['note'] }}</p>
                                </div>
                            </div>
                        </div>
                        <a class="btn-primary inline-flex items-center justify-center gap-2 w-full py-2.5 text-xs font-bold tracking-wider rounded" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-sm">map</span> Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-6">
            <div class="w-24 h-px bg-gradient-to-r from-transparent via-rich-gold to-transparent"></div>
        </div>

        <!-- ==============================================
                 STORIES SECTION
                 ============================================== -->
        <section class="py-16 px-6 relative" id="story">
            <div class="w-full">
                <div class="text-center mb-12 flex flex-col items-center">
                    <span class="material-symbols-outlined text-rich-gold text-3xl mb-3">auto_awesome</span>
                    <h3 class="font-section-title text-xl text-rich-gold tracking-widest uppercase">Our Journey</h3>
                </div>
                <div class="max-w-sm mx-auto w-full relative pl-6 border-l border-rich-gold/30">
                    @foreach($stories as $s)
                    <div class="relative mb-8 last:mb-0">
                        <div class="absolute -left-[30px] top-1.5 w-3 h-3 bg-rich-gold rounded-full border-2 border-background"></div>
                        <div class="glass-panel p-4 rounded-xl bg-surface-container/40">
                            <span class="font-label-caps text-[9px] text-rich-gold uppercase tracking-widest mb-1.5 block font-semibold">{{ $s['date'] }}</span>
                            <h3 class="font-section-title text-sm text-champagne mb-1.5">{{ $s['title'] }}</h3>
                            <p class="font-body-md text-xs text-champagne/75 leading-relaxed">{{ $s['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-6">
            <div class="w-24 h-px bg-gradient-to-r from-transparent via-rich-gold to-transparent"></div>
        </div>

        <!-- ==============================================
                 GALLERY SECTION (Asymmetrical Masonry)
                 ============================================== -->
        <section class="py-16 px-6 relative" id="gallery">
            <div class="w-full max-w-sm mx-auto">
                <div class="text-center mb-12 flex flex-col items-center">
                    <span class="material-symbols-outlined text-rich-gold text-3xl mb-3">photo_library</span>
                    <h3 class="font-section-title text-xl text-rich-gold tracking-widest uppercase">Our Moments</h3>
                    <p class="font-body-md text-xs text-champagne/70 mt-2">A glimpse into our royal journey.</p>
                </div>
                <!-- Broken Masonry Layout -->
                <div class="grid grid-cols-2 gap-4 items-center">
                    <!-- Image 1: Tall -->
                    <div class="gallery-item relative col-span-1 row-span-2 transform -rotate-1 bg-surface-container p-1.5 cursor-pointer rounded" onclick="openLightbox('{{ $gallery[0] }}')">
                        <img alt="Gallery 1" class="w-full h-[280px] object-cover rounded" src="{{ $gallery[0] }}"/>
                        <div class="absolute inset-0 bg-deep-navy/10 hover:bg-transparent transition-colors rounded"></div>
                    </div>
                    <!-- Image 2: Wide -->
                    <div class="gallery-item relative col-span-1 transform translate-y-3 bg-surface-container p-1 cursor-pointer rounded" onclick="openLightbox('{{ $gallery[1] }}')">
                        <img alt="Gallery 2" class="w-full h-[120px] object-cover rounded grayscale" src="{{ $gallery[1] }}"/>
                    </div>
                    <!-- Image 3: Square -->
                    <div class="gallery-item relative col-span-1 transform rotate-1 bg-surface-container p-1.5 cursor-pointer rounded shadow-xl" onclick="openLightbox('{{ $gallery[2] }}')">
                        <img alt="Gallery 3" class="w-full h-[120px] object-cover rounded" src="{{ $gallery[2] }}"/>
                    </div>
                    <!-- Image 4: Tall offset -->
                    <div class="gallery-item relative col-span-1 transform -translate-y-3 bg-surface-container p-1 cursor-pointer rounded" onclick="openLightbox('{{ $gallery[3] }}')">
                        <img alt="Gallery 4" class="w-full h-[160px] object-cover rounded sepia-[0.2]" src="{{ $gallery[3] }}"/>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-6">
            <div class="w-24 h-px bg-gradient-to-r from-transparent via-rich-gold to-transparent"></div>
        </div>

        <!-- ==============================================
                 GIFT SECTION
                 ============================================== -->
        <section class="py-16 px-6 relative bg-surface-container-low" id="gift">
            <div class="max-w-sm mx-auto text-center relative z-10">
                <span class="material-symbols-outlined text-rich-gold text-4xl mb-3">card_giftcard</span>
                <h3 class="font-section-title text-xl text-rich-gold tracking-widest uppercase mb-6">Wedding Gift</h3>
                <p class="font-body-md text-xs text-champagne/80 mb-8 leading-relaxed">Bagi keluarga dan sahabat yang ingin mengirimkan tanda kasih, dapat melalui nomor rekening di bawah ini:</p>
                
                <div class="flex flex-col gap-6 items-center">
                    @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                        @foreach($invitation->bankAccounts as $bank)
                        <div class="glass-panel p-6 rounded-xl relative w-full">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-deep-navy px-4 border border-rich-gold rounded-full">
                                <span class="font-label-caps text-rich-gold text-[10px]">BANK TRANSFER</span>
                            </div>
                            <h4 class="font-couple-name text-xl text-champagne mb-1 mt-3">{{ strtoupper($bank->bank_name) }}</h4>
                            <p class="font-section-title text-lg text-rich-gold tracking-widest mb-1">{{ $bank->account_number }}</p>
                            <p class="font-body-md text-xs text-champagne/60 mb-4">a.n. {{ $bank->account_name }}</p>
                            <button class="btn-primary px-5 py-2 rounded text-xs font-bold tracking-wider inline-flex items-center gap-1.5" onclick="copyAccount('{{ $bank->account_number }}', this)">
                                <span class="material-symbols-outlined text-sm">content_copy</span> Salin Rekening
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="glass-panel p-6 rounded-xl relative w-full">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-deep-navy px-4 border border-rich-gold rounded-full">
                                <span class="font-label-caps text-rich-gold text-[10px]">BANK TRANSFER</span>
                            </div>
                            <h4 class="font-couple-name text-xl text-champagne mb-1 mt-3">BCA</h4>
                            <p class="font-section-title text-lg text-rich-gold tracking-widest mb-1">1234 5678 90</p>
                            <p class="font-body-md text-xs text-champagne/60 mb-4">a.n. Julian Alexander</p>
                            <button class="btn-primary px-5 py-2 rounded text-xs font-bold tracking-wider inline-flex items-center gap-1.5" onclick="copyAccount('1234 5678 90', this)">
                                <span class="material-symbols-outlined text-sm">content_copy</span> Salin Rekening
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex justify-center py-6">
            <div class="w-24 h-px bg-gradient-to-r from-transparent via-rich-gold to-transparent"></div>
        </div>

        <!-- ==============================================
                 RSVP & GUESTBOOK SECTION
                 ============================================== -->
        <section class="py-16 px-6 relative" id="rsvp">
            <div class="max-w-sm mx-auto flex flex-col gap-10">
                <!-- Form -->
                <div>
                    <h3 class="font-section-title text-xl text-rich-gold tracking-widest uppercase mb-3 text-center">RSVP</h3>
                    <p class="font-body-md text-xs text-champagne/70 mb-6 text-center">Silakan konfirmasi kehadiran Anda di bawah ini.</p>
                    <form class="space-y-4" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <input class="w-full bg-transparent border-0 border-b border-rich-gold/50 text-champagne focus:ring-0 focus:border-rich-gold placeholder:text-champagne/30 py-2 text-sm" placeholder="Nama Lengkap" type="text" id="nama" required/>
                        </div>
                        <div>
                            <select class="w-full bg-deep-navy border-0 border-b border-rich-gold/50 text-champagne focus:ring-0 focus:border-rich-gold py-2 text-sm" id="kehadiran" required>
                                <option disabled="" selected="" value="">Kehadiran</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Berhalangan">Maaf, Berhalangan</option>
                            </select>
                        </div>
                        <div>
                            <select class="w-full bg-deep-navy border-0 border-b border-rich-gold/50 text-champagne focus:ring-0 focus:border-rich-gold py-2 text-sm" id="guests">
                                <option value="1">1 Orang</option>
                                <option value="2">2 Orang</option>
                            </select>
                        </div>
                        <button class="btn-primary w-full py-3 text-xs font-bold tracking-widest rounded mt-4" type="submit">
                            KIRIM KONFIRMASI
                        </button>
                    </form>
                </div>
                <!-- Guestbook -->
                <div class="glass-panel p-5 rounded-xl flex flex-col h-[400px]">
                    <h4 class="font-couple-name text-xl text-rich-gold border-b border-rich-gold/30 pb-3 mb-4">Guestbook</h4>
                    <div class="flex-1 overflow-y-auto space-y-4 pr-1 no-scrollbar" id="wishList">
                        <!-- Wish Items -->
                        <div class="bg-surface-container-high/40 p-4 rounded border-l-2 border-rich-gold text-left">
                            <p class="font-bold text-champagne text-xs mb-1">Sarah &amp; John <span class="text-[9px] text-rich-gold bg-rich-gold/15 px-2 py-0.5 rounded ml-2 font-normal">Hadir</span></p>
                            <p class="font-body-md text-xs text-champagne/70 italic">"Wishing you a lifetime of love and happiness. Can't wait to celebrate the royal gala with you both!"</p>
                        </div>
                        <div class="bg-surface-container-high/40 p-4 rounded border-l-2 border-rich-gold text-left">
                            <p class="font-bold text-champagne text-xs mb-1">Keluarga Smith <span class="text-[9px] text-rich-gold bg-rich-gold/15 px-2 py-0.5 rounded ml-2 font-normal">Hadir</span></p>
                            <p class="font-body-md text-xs text-champagne/70 italic">"May your journey be filled with joy and blessings."</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-rich-gold/30 flex flex-col gap-2">
                        <textarea class="w-full bg-transparent border border-rich-gold/30 rounded text-champagne focus:ring-0 focus:border-rich-gold placeholder:text-champagne/30 p-2.5 h-16 resize-none text-xs" placeholder="Tulis Ucapan &amp; Doa..." id="pesan" required></textarea>
                        <button class="w-full text-center text-rich-gold text-xs font-bold uppercase hover:text-gold-shimmer transition-colors py-1.5 bg-surface-container rounded border border-rich-gold/30" onclick="submitWishDirect()">Kirim Ucapan</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==============================================
                 FOOTER
                 ============================================== -->
        <footer class="py-16 text-center relative border-t border-rich-gold/20 pb-40">
            <span class="material-symbols-outlined text-rich-gold text-2xl mb-3">auto_awesome</span>
            <p class="font-body-md text-xs text-champagne/70 mb-3">Terima kasih atas segala doa restu Anda.</p>
            <h2 class="font-couple-name text-3xl text-rich-gold opacity-80">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
        </footer>
    </div>

    <!-- ==============================================
             BOTTOM NAV BAR - Mobile Floating Pill
             ============================================== -->
    <nav class="fixed bottom-0 left-0 w-full z-50 flex justify-center pb-safe mb-6 transition-transform duration-300 transform translate-y-full" id="bottom-nav">
        <div class="bg-surface-container/60 backdrop-blur-xl rounded-full mx-auto w-[90%] max-w-sm border border-rich-gold/30 shadow-[0_0_20px_rgba(212,175,55,0.15)] px-4 py-1.5 flex justify-between items-center">
            <a class="nav-btn flex flex-col items-center justify-center w-12 h-12 group" data-target="home" href="#home" onclick="smoothScroll(event, '#home')">
                <span class="material-symbols-outlined text-lg text-gold-shimmer drop-shadow-[0_0_8px_rgba(255,215,0,0.6)] group-hover:text-gold-shimmer transition-all duration-300">home</span>
                <span class="font-label-caps text-[8px] mt-0.5 text-gold-shimmer drop-shadow-[0_0_8px_rgba(255,215,0,0.6)] group-hover:text-gold-shimmer">Home</span>
            </a>
            <a class="nav-btn flex flex-col items-center justify-center w-12 h-12 group" data-target="mempelai" href="#mempelai" onclick="smoothScroll(event, '#mempelai')">
                <span class="material-symbols-outlined text-lg text-champagne/70 group-hover:text-gold-shimmer transition-all duration-300">favorite</span>
                <span class="font-label-caps text-[8px] mt-0.5 text-champagne/70 group-hover:text-gold-shimmer">Mempelai</span>
            </a>
            <!-- Central FAB for Music -->
            <button class="relative -top-4 bg-gradient-to-b from-rich-gold to-secondary-container p-3 rounded-full border-2 border-deep-navy shadow-[0_0_15px_rgba(212,175,55,0.5)] transform transition-transform active:scale-95 flex items-center justify-center" id="music-toggle-mobile" onclick="toggleMusic()">
                <span class="material-symbols-outlined text-deep-navy text-lg font-bold" id="music-icon-mobile">music_note</span>
            </button>
            <a class="nav-btn flex flex-col items-center justify-center w-12 h-12 group" data-target="events" href="#events" onclick="smoothScroll(event, '#events')">
                <span class="material-symbols-outlined text-lg text-champagne/70 group-hover:text-gold-shimmer transition-all duration-300">event</span>
                <span class="font-label-caps text-[8px] mt-0.5 text-champagne/70 group-hover:text-gold-shimmer">Acara</span>
            </a>
            <a class="nav-btn flex flex-col items-center justify-center w-12 h-12 group" data-target="rsvp" href="#rsvp" onclick="smoothScroll(event, '#rsvp')">
                <span class="material-symbols-outlined text-lg text-champagne/70 group-hover:text-gold-shimmer transition-all duration-300">mail</span>
                <span class="font-label-caps text-[8px] mt-0.5 text-champagne/70 group-hover:text-gold-shimmer">RSVP</span>
            </a>
        </div>
    </nav>

    <!-- Floating Action Controls -->
    <div class="fixed bottom-24 left-1/2 translate-x-[170px] z-[45] flex flex-col gap-3 transform translate-y-32 transition-transform duration-500" id="floating-controls">
        <!-- Music Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-deep-navy/95 text-rich-gold border border-rich-gold flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleMusic()">
            <span class="material-symbols-outlined text-lg" id="music-icon">volume_up</span>
        </button>
        <!-- Autoscroll Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-deep-navy/95 text-rich-gold border border-rich-gold flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAutoscroll()">
            <span class="material-symbols-outlined text-lg" id="autoscroll-icon">play_arrow</span>
        </button>
    </div>

    <!-- Hidden Audio element for background music -->
    <audio id="bg-music" loop>
        <source src="{{ asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3') }}" type="audio/mpeg"/>
    </audio>

    <!-- Lightbox Modal for Photo Preview -->
    <div id="lightbox" class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-rich-gold text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-rich-gold/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <!-- JavaScript for Interactions -->
    <script>
        let isPlaying = false;
        let isScrolling = false;
        let scrollInterval;

        function openInvitation() {
            // Hide Cover
            document.getElementById('cover-screen').style.transform = 'translateY(-100%)';
            document.body.classList.remove('hide-scroll');

            // Show Main
            setTimeout(() => {
                document.getElementById('main-content').classList.remove('opacity-0');
                document.getElementById('bottom-nav').classList.remove('translate-y-full');
                document.getElementById('floating-controls').classList.remove('translate-y-32');
                initCountdown();
            }, 500);

            // Play Music
            const audio = document.getElementById('bg-music');
            audio.play().then(() => {
                isPlaying = true;
                syncMusicIcons();
            }).catch(e => console.log("Audio play failed:", e));

            startAutoscroll();
        }

        // Sync all music button states
        function syncMusicIcons() {
            const iconWeb = document.getElementById('music-icon-web');
            const iconMobile = document.getElementById('music-icon-mobile');
            const iconFloat = document.getElementById('music-icon');
            
            if (isPlaying) {
                if (iconWeb) iconWeb.innerText = 'music_note';
                if (iconMobile) iconMobile.innerText = 'music_note';
                if (iconFloat) iconFloat.innerText = 'volume_up';
            } else {
                if (iconWeb) iconWeb.innerText = 'music_off';
                if (iconMobile) iconMobile.innerText = 'music_off';
                if (iconFloat) iconFloat.innerText = 'volume_off';
            }
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-music');
            if (isPlaying) {
                audio.pause();
                isPlaying = false;
            } else {
                audio.play().catch(e => console.log("Audio play failed:", e));
                isPlaying = true;
            }
            syncMusicIcons();
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
                }, 35);
                icon.innerText = 'pause';
            }
            isScrolling = !isScrolling;
        }

        function startAutoscroll() {
            isScrolling = true;
            document.getElementById('autoscroll-icon').innerText = 'pause';
            scrollInterval = setInterval(() => {
                window.scrollBy(0, 1);
            }, 35);
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
            const presence = document.getElementById('kehadiran').value || 'Hadir';
            const card = document.createElement('div');
            card.className = 'bg-surface-container-high/40 p-4 rounded border-l-2 border-rich-gold text-left';
            card.innerHTML = `<p class="font-bold text-champagne text-xs mb-1">${name} <span class="text-[9px] text-rich-gold bg-rich-gold/15 px-2 py-0.5 rounded ml-2 font-normal">${presence === 'Hadir' ? 'Hadir' : 'Absen'}</span></p><p class="font-body-md text-xs text-champagne/70 italic">"Konfirmasi kehadiran lewat RSVP"</p>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP berhasil dikirim, terima kasih!");
        }

        // Send Wish Direct
        function submitWishDirect() {
            const nameInput = document.getElementById('nama');
            const presenceSelect = document.getElementById('kehadiran');
            const msgInput = document.getElementById('pesan');

            const name = nameInput.value.trim() || "Tamu Undangan";
            const presence = presenceSelect.value || "Hadir";
            const msg = msgInput.value.trim();

            if (!msg) {
                alert("Silakan tulis ucapan terlebih dahulu.");
                return;
            }

            const card = document.createElement('div');
            card.className = 'bg-surface-container-high/40 p-4 rounded border-l-2 border-rich-gold text-left';
            card.innerHTML = `<p class="font-bold text-champagne text-xs mb-1">${name} <span class="text-[9px] text-rich-gold bg-rich-gold/15 px-2 py-0.5 rounded ml-2 font-normal">${presence === 'Hadir' ? 'Hadir' : 'Absen'}</span></p><p class="font-body-md text-xs text-champagne/70 italic">"${msg}"</p>`;
            document.getElementById('wishList').prepend(card);
            
            msgInput.value = '';
            alert("Ucapan berhasil dikirim!");
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

        // Scroll active highlight
        window.addEventListener('scroll', () => {
            let current = "";
            const sections = document.querySelectorAll("main, section");
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 250) {
                    current = section.getAttribute("id");
                }
            });

            document.querySelectorAll('#bottom-nav a').forEach((a) => {
                const href = a.getAttribute("href");
                const icon = a.querySelector('.material-symbols-outlined');
                const text = a.querySelector('span:last-child');
                if (href === `#${current}`) {
                    a.classList.add('scale-110');
                    icon.className = "material-symbols-outlined text-lg text-gold-shimmer drop-shadow-[0_0_8px_rgba(255,215,0,0.6)] transition-all duration-300";
                    text.className = "font-label-caps text-[8px] mt-0.5 text-gold-shimmer drop-shadow-[0_0_8px_rgba(255,215,0,0.6)]";
                } else {
                    a.classList.remove('scale-110');
                    icon.className = "material-symbols-outlined text-lg text-champagne/70 group-hover:text-gold-shimmer transition-all duration-300";
                    text.className = "font-label-caps text-[8px] mt-0.5 text-champagne/70 group-hover:text-gold-shimmer";
                }
            });

            // Top Nav bg
            const topNav = document.getElementById('top-nav');
            if (window.pageYOffset > 50) {
                topNav.classList.remove('bg-transparent');
                topNav.classList.add('bg-deep-navy/90', 'backdrop-blur-md', 'shadow-md');
            } else {
                topNav.classList.add('bg-transparent');
                topNav.classList.remove('bg-deep-navy/90', 'backdrop-blur-md', 'shadow-md');
            }
        });
    </script>
</body>
</html>