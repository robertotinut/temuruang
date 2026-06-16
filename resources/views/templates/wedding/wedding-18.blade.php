@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Arthur Sterling');
        $brideName = trim($names[1] ?? 'Eleanor Vance');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Albert Sterling & Ibu Catherine',
                'bride' => 'Bapak George Vance & Ibu Diana',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-10-14',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '15:00',
            'location' => $invitation->location ?? 'The Grand Ballroom',
            'address' => $invitation->address ?? '123 Serenity Avenue, Azure City',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Grand Ballroom'),
        ];

        $schedule = [
            [
                'title' => 'Ceremony',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '15:00') . ' - 16:30',
                'note' => $invitation->location ?? 'The Grand Cathedral'
            ],
            [
                'title' => 'Reception',
                'time' => '18:00 - Midnight',
                'note' => $invitation->address ?? 'The Azure Estate, 456 Twilight Boulevard'
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
                asset('assets/templates/wedding-17/images/image_4.jpg'),
                asset('assets/templates/wedding-17/images/image_5.jpg'),
                asset('assets/templates/wedding-17/images/image_6.jpg'),
                asset('assets/templates/wedding-17/images/image_7.jpg'),
                asset('assets/templates/wedding-17/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-18/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-17/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-17/images/image_3.jpg'),
        ];
    } else {
        $couple = [
            'groom' => 'Arthur Sterling',
            'bride' => 'Eleanor Vance',
            'parents' => [
                'groom' => 'Bapak Albert Sterling & Ibu Catherine',
                'bride' => 'Bapak George Vance & Ibu Diana',
            ],
        ];

        $event = [
            'date_iso' => '2026-10-14',
            'time' => '15:00',
            'location' => 'The Grand Ballroom',
            'address' => '123 Serenity Avenue, Azure City',
            'maps_url' => 'https://maps.google.com/?q=The+Grand+Ballroom+Azure+City',
        ];

        $schedule = [
            ['title' => 'Ceremony', 'time' => '15:00 - 16:30', 'note' => 'The Grand Cathedral'],
            ['title' => 'Reception', 'time' => '18:00 - Midnight', 'note' => 'The Azure Estate, 456 Twilight Boulevard'],
        ];

        $stories = [
            ['title' => 'The First Meeting', 'date' => 'June 2018', 'text' => 'We met at a local art exhibition. A shared smile over a painting sparked a conversation that lasted for hours.'],
            ['title' => 'The First "I Love You"', 'date' => 'December 2020', 'text' => 'During a snowy walk in the park, amidst the twinkling holiday lights, those three words finally found their way out.'],
            ['title' => 'The Proposal', 'date' => 'August 2022', 'text' => 'On a quiet beach at sunset, Adrian asked the most important question, and Seraphina said yes with tears of joy.']
        ];

        $gallery = [
            asset('assets/templates/wedding-17/images/image_4.jpg'),
            asset('assets/templates/wedding-17/images/image_5.jpg'),
            asset('assets/templates/wedding-17/images/image_6.jpg'),
            asset('assets/templates/wedding-17/images/image_7.jpg'),
            asset('assets/templates/wedding-17/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-18/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-17/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-17/images/image_3.jpg'),
        ];
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>The Wedding of {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-lowest": "#ffffff",
                        "surface-tint": "#735c00",
                        "on-surface-variant": "#4d4635",
                        "on-error-container": "#93000a",
                        "surface": "#fff8f0",
                        "tertiary": "#415ba4",
                        "primary": "#735c00",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-surface": "#1f1b13",
                        "surface-container-low": "#fbf3e5",
                        "on-primary-fixed-variant": "#574500",
                        "surface-bright": "#fff8f0",
                        "on-primary-container": "#554300",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#254188",
                        "primary-fixed-dim": "#e9c349",
                        "inverse-surface": "#343027",
                        "surface-container": "#f5eddf",
                        "surface-dim": "#e1d9cc",
                        "on-background": "#1f1b13",
                        "gold-leaf": "#D4AF37",
                        "champagne-white": "#F5F0E6",
                        "surface-container-high": "#efe7da",
                        "on-secondary-fixed-variant": "#474744",
                        "tertiary-fixed-dim": "#b4c5ff",
                        "tertiary-fixed": "#dbe1ff",
                        "secondary-fixed": "#e4e2de",
                        "inverse-on-surface": "#f8f0e2",
                        "primary-fixed": "#ffe088",
                        "surface-container-highest": "#eae1d4",
                        "primary-container": "#d4af37",
                        "secondary": "#5e5e5c",
                        "on-tertiary-fixed-variant": "#27438a",
                        "on-secondary": "#ffffff",
                        "deep-charcoal": "#1A1A1A",
                        "error": "#ba1a1a",
                        "secondary-container": "#e1dfdc",
                        "gold-stroke": "rgba(212, 175, 55, 0.5)",
                        "on-secondary-fixed": "#1b1c1a",
                        "surface-variant": "#eae1d4",
                        "outline-variant": "#d0c5af",
                        "ivory-base": "#FDFBF7",
                        "secondary-fixed-dim": "#c8c6c3",
                        "tertiary-container": "#97b0ff",
                        "glass-surface": "rgba(255, 255, 255, 0.4)",
                        "outline": "#7f7663",
                        "background": "#fff8f0",
                        "inverse-primary": "#e9c349",
                        "on-secondary-container": "#636360",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-fixed": "#00174b",
                        "on-primary-fixed": "#241a00"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "section-gap": "8rem",
                        "gutter": "1.5rem",
                        "overlap-offset": "-3rem",
                        "safe-margin": "2rem",
                        "max-width": "1200px"
                    },
                    fontFamily: {
                        "body-lg": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "label-caps": ["Montserrat"],
                        "headline-lg-mobile": ["Playfair Display"],
                        "display-hero-mobile": ["Playfair Display"],
                        "label-gold": ["Montserrat"],
                        "display-hero": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "headline-md": ["Playfair Display"]
                    },
                    fontSize: {
                        "body-lg": ["18px", {"lineHeight": "1.7", "fontWeight": "400"}],
                        "headline-lg": ["48px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "label-caps": ["12px", {"lineHeight": "1.0", "letterSpacing": "0.2em", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "display-hero-mobile": ["42px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "label-gold": ["14px", {"lineHeight": "1.0", "fontWeight": "500"}],
                        "display-hero": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "600"}]
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
        .glass-panel {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.5);
        }

        .gold-frame-oval {
            position: relative;
        }
        .gold-frame-oval::before {
            content: '';
            position: absolute;
            inset: -8px;
            border: 1px solid rgba(212, 175, 55, 0.5);
            border-radius: 50%;
            z-index: 0;
        }
        .gold-frame-oval::after {
            content: '';
            position: absolute;
            top: -15px;
            bottom: -15px;
            left: 15px;
            right: 15px;
            border: 1px solid rgba(212, 175, 55, 0.5);
            z-index: 0;
            pointer-events: none;
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gold Particle Animation Styles */
        .particle {
            position: absolute;
            background-color: #d4af37;
            border-radius: 50%;
            box-shadow: 0 0 8px 2px rgba(212, 175, 55, 0.4);
            pointer-events: none;
            opacity: 0;
            animation: 
                particleFloatUp var(--float-duration) linear infinite,
                particleDrift var(--drift-duration) ease-in-out infinite alternate;
            animation-delay: var(--delay);
        }

        @keyframes particleFloatUp {
            0% {
                bottom: -20px;
                opacity: 0;
            }
            15% {
                opacity: var(--max-opacity);
            }
            85% {
                opacity: var(--max-opacity);
            }
            100% {
                bottom: 100%;
                opacity: 0;
            }
        }

        @keyframes particleDrift {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(var(--drift-distance));
            }
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
            background: #fff8f0;
            transition: transform 0.5s ease-in-out;
        }
        #mobile-menu.open {
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="bg-ivory-base text-deep-charcoal font-body-lg antialiased selection:bg-primary selection:text-white max-w-[480px] w-full mx-auto shadow-2xl border-x border-gold-leaf/10 min-h-screen is-locked">

    <!-- Gold Particles Container -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[5] pointer-events-none overflow-hidden" id="particle-container"></div>

    <!-- COVER SECTION -->
    <section class="fixed inset-0 z-50 max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-center bg-cover bg-center text-center p-6" id="cover" style="background-image: linear-gradient(rgba(26, 26, 26, 0.4), rgba(26, 26, 26, 0.7)), url('{{ $bg['cover'] }}');">
        <div class="fade-in w-full flex flex-col items-center z-10">
            <p class="font-label-caps text-label-caps text-champagne-white tracking-widest mb-6">THE WEDDING OF</p>
            <h1 class="font-display-hero-mobile text-display-hero-mobile text-white mb-8">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            
            <div class="glass-panel p-6 rounded-3xl relative w-full mb-12 bg-white/10 border-white/20">
                <div class="absolute -inset-2 border border-gold-stroke rounded-3xl opacity-40"></div>
                <p class="font-body-md text-champagne-white/90 italic mb-4">We invite you to share in our joy</p>
                <p class="font-body-md text-white/90 text-xs uppercase tracking-wider">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
                <p class="font-headline-md text-lg text-white font-semibold border-b border-white/30 pb-2 w-full text-center mt-2">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
                <p class="text-[9px] text-white/70 mt-2">Mohon maaf bila ada kesalahan penulisan nama/gelar</p>
            </div>

            <button class="bg-glass-surface backdrop-blur-md border border-gold-stroke text-gold-leaf px-8 py-4 rounded-full font-label-caps text-label-caps hover:bg-gold-leaf hover:text-deep-charcoal transition-all duration-300 flex items-center gap-2 mx-auto relative z-20" id="open-invitation-btn" onclick="openInvitation()">
                <span>Open Invitation</span>
                <span class="material-symbols-outlined text-[18px]">drafts</span>
            </button>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="relative z-10 pb-32 w-full overflow-hidden" id="main-content">
        
        <!-- Top Navigation -->
        <header class="fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-40 bg-white/80 backdrop-blur-md border-b border-gold-leaf/20 flex justify-between items-center px-6 py-4 opacity-0 transition-opacity duration-500" id="top-nav">
            <div class="font-headline-md text-lg text-gold-leaf tracking-widest uppercase">A &amp; E Wedding</div>
            <button class="text-gold-leaf hover:opacity-80 transition-opacity flex items-center" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </header>

        <!-- Mobile Menu Overlay -->
        <div class="flex flex-col items-center justify-center gap-8" id="mobile-menu">
            <button class="absolute top-6 right-6 text-gold-leaf" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <a class="font-display-hero-mobile text-2xl text-deep-charcoal hover:text-gold-leaf" href="#hero" onclick="toggleMobileMenu()">Home</a>
            <a class="font-display-hero-mobile text-2xl text-deep-charcoal hover:text-gold-leaf" href="#couple" onclick="toggleMobileMenu()">Couple</a>
            <a class="font-display-hero-mobile text-2xl text-deep-charcoal hover:text-gold-leaf" href="#event" onclick="toggleMobileMenu()">Event</a>
            <a class="font-display-hero-mobile text-2xl text-deep-charcoal hover:text-gold-leaf" href="#story" onclick="toggleMobileMenu()">Story</a>
            <a class="font-display-hero-mobile text-2xl text-deep-charcoal hover:text-gold-leaf" href="#gallery" onclick="toggleMobileMenu()">Gallery</a>
            <a class="font-display-hero-mobile text-2xl text-deep-charcoal hover:text-gold-leaf" href="#rsvp" onclick="toggleMobileMenu()">RSVP</a>
        </div>

        <!-- HERO SECTION -->
        <section class="min-h-[90vh] flex flex-col items-center justify-center pt-24 px-6 pb-12 relative" id="hero">
            <div class="w-full flex flex-col items-center text-center">
                <!-- Countdown -->
                <div class="fade-in flex flex-col items-center w-full mb-12">
                    <h2 class="font-headline-lg text-xl text-deep-charcoal mb-6">The Celebration Begins In</h2>
                    <div class="grid grid-cols-4 gap-3 w-full max-w-sm">
                        <!-- Days -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-hero-mobile text-xl text-gold-leaf mb-1" id="days">00</span>
                            <span class="font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest">Days</span>
                        </div>
                        <!-- Hours -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-hero-mobile text-xl text-gold-leaf mb-1" id="hours">00</span>
                            <span class="font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest">Hours</span>
                        </div>
                        <!-- Mins -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-hero-mobile text-xl text-gold-leaf mb-1" id="minutes">00</span>
                            <span class="font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest">Mins</span>
                        </div>
                        <!-- Secs -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-hero-mobile text-xl text-gold-leaf mb-1" id="seconds">00</span>
                            <span class="font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest">Secs</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex items-center justify-center py-6 opacity-50 fade-in">
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
            <span class="material-symbols-outlined text-gold-leaf mx-3 text-sm">favorite</span>
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
        </div>

        <!-- COUPLE SECTION -->
        <section class="py-20 px-6 relative" id="couple">
            <div class="text-center mb-12 fade-in">
                <h2 class="font-display-hero-mobile text-2xl text-deep-charcoal mb-4">Meet The Couple</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-xs mx-auto">Two distinct paths merging into one beautiful journey of love and prestige.</p>
            </div>
            
            <div class="flex flex-col gap-12 w-full max-w-sm mx-auto">
                <!-- Groom -->
                <div class="fade-in flex flex-col items-center text-center">
                    <div class="w-48 h-48 rounded-full p-2 glass-panel mb-6 relative gold-frame-oval">
                        <img alt="Groom portrait" class="w-full h-full object-cover rounded-full z-10 relative" src="{{ $bg['groom'] }}"/>
                    </div>
                    <h3 class="font-headline-md text-lg text-deep-charcoal mb-1">{{ $couple['groom'] }}</h3>
                    <span class="font-label-caps text-xs text-gold-leaf uppercase tracking-widest mb-3">The Groom</span>
                    <p class="font-body-md text-xs text-on-surface-variant max-w-xs mb-4">Putra Kedua dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                    <a class="w-8 h-8 rounded-full glass-panel flex items-center justify-center text-gold-leaf hover:bg-gold-leaf hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">link</span>
                    </a>
                </div>

                <!-- Groom & Bride Connector -->
                <div class="text-center py-2 fade-in">
                    <span class="font-display-hero-mobile text-3xl text-gold-leaf">&amp;</span>
                </div>

                <!-- Bride -->
                <div class="fade-in flex flex-col items-center text-center">
                    <div class="w-48 h-48 rounded-full p-2 glass-panel mb-6 relative gold-frame-oval">
                        <img alt="Bride portrait" class="w-full h-full object-cover rounded-full z-10 relative" src="{{ $bg['bride'] }}"/>
                    </div>
                    <h3 class="font-headline-md text-lg text-deep-charcoal mb-1">{{ $couple['bride'] }}</h3>
                    <span class="font-label-caps text-xs text-gold-leaf uppercase tracking-widest mb-3">The Bride</span>
                    <p class="font-body-md text-xs text-on-surface-variant max-w-xs mb-4">Putri Pertama dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                    <a class="w-8 h-8 rounded-full glass-panel flex items-center justify-center text-gold-leaf hover:bg-gold-leaf hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">link</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex items-center justify-center py-6 opacity-50 fade-in">
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
            <span class="material-symbols-outlined text-gold-leaf mx-3 text-sm">calendar_today</span>
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
        </div>

        <!-- EVENT SECTION -->
        <section class="py-20 px-6 relative" id="event">
            <div class="text-center mb-12 fade-in">
                <h2 class="font-display-hero-mobile text-2xl text-deep-charcoal mb-4">The Details</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-xs mx-auto">Join us in celebrating our union.</p>
            </div>
            
            <div class="flex flex-col gap-8 w-full max-w-sm mx-auto">
                <!-- Ceremony -->
                <div class="fade-in glass-panel rounded-2xl p-6 flex flex-col items-center text-center bg-white/60">
                    <span class="material-symbols-outlined text-gold-leaf text-3xl mb-3">church</span>
                    <h3 class="font-headline-md text-lg text-deep-charcoal mb-1">{{ $schedule[0]['title'] }}</h3>
                    <p class="font-label-caps text-xs text-primary uppercase tracking-widest mb-3">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-4">Pukul {{ $schedule[0]['time'] }} WIB</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-6 leading-relaxed">{{ $schedule[0]['note'] }}<br>{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" class="inline-flex items-center justify-center px-6 py-2.5 border border-gold-leaf text-gold-leaf rounded-full font-label-caps text-xs hover:bg-gold-leaf hover:text-deep-charcoal transition-colors bg-white/80">
                        <span class="material-symbols-outlined mr-1.5 text-sm">map</span> View Map
                    </a>
                </div>
                
                <!-- Reception -->
                <div class="fade-in glass-panel rounded-2xl p-6 flex flex-col items-center text-center bg-white/60">
                    <span class="material-symbols-outlined text-gold-leaf text-3xl mb-3">restaurant</span>
                    <h3 class="font-headline-md text-lg text-deep-charcoal mb-1">{{ $schedule[1]['title'] }}</h3>
                    <p class="font-label-caps text-xs text-primary uppercase tracking-widest mb-3">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-4">Pukul {{ $schedule[1]['time'] }} WIB</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-6 leading-relaxed">{{ $schedule[1]['note'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" class="inline-flex items-center justify-center px-6 py-2.5 border border-gold-leaf text-gold-leaf rounded-full font-label-caps text-xs hover:bg-gold-leaf hover:text-deep-charcoal transition-colors bg-white/80">
                        <span class="material-symbols-outlined mr-1.5 text-sm">map</span> View Map
                    </a>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex items-center justify-center py-6 opacity-50 fade-in">
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
            <span class="material-symbols-outlined text-gold-leaf mx-3 text-sm">auto_awesome</span>
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
        </div>

        <!-- STORY SECTION -->
        <section class="py-20 px-6 relative" id="story">
            <div class="text-center mb-12 fade-in">
                <h2 class="font-display-hero-mobile text-2xl text-deep-charcoal mb-4">Our Journey</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-xs mx-auto">From the first hello to forever.</p>
            </div>
            
            <div class="max-w-sm mx-auto w-full relative pl-6 border-l-2 border-gold-leaf/30">
                @foreach($stories as $s)
                <div class="fade-in relative mb-12 last:mb-0">
                    <!-- Timeline point -->
                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 bg-gold-leaf rounded-full border-4 border-background"></div>
                    <div class="glass-panel p-5 rounded-2xl bg-white/60">
                        <span class="font-label-caps text-[10px] text-primary uppercase tracking-widest mb-1.5 block font-semibold">{{ $s['date'] }}</span>
                        <h3 class="font-headline-md text-sm text-deep-charcoal mb-2">{{ $s['title'] }}</h3>
                        <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">{{ $s['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex items-center justify-center py-6 opacity-50 fade-in">
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
            <span class="material-symbols-outlined text-gold-leaf mx-3 text-sm">photo_library</span>
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
        </div>

        <!-- GALLERY SECTION (Grid with Lightbox) -->
        <section class="py-20 px-6 relative" id="gallery">
            <div class="text-center mb-12 fade-in">
                <h2 class="font-display-hero-mobile text-2xl text-deep-charcoal mb-4">Gallery</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-xs mx-auto">Captured moments of our love.</p>
            </div>
            
            <div class="grid grid-cols-2 gap-3 max-w-sm mx-auto w-full">
                @foreach ($gallery as $index => $img)
                @php
                    $span = '';
                    if ($index == 1) $span = 'col-span-2 row-span-2';
                @endphp
                <div class="fade-in glass-panel p-1.5 rounded-xl overflow-hidden cursor-zoom-in group bg-white/50 hover:border-gold-leaf transition-all duration-300 {{ $span }}" onclick="openLightbox('{{ $img }}')">
                    <img alt="Gallery photo {{ $index+1 }}" class="w-full h-full object-cover rounded-lg transition-transform duration-500 group-hover:scale-105" src="{{ $img }}"/>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex items-center justify-center py-6 opacity-50 fade-in">
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
            <span class="material-symbols-outlined text-gold-leaf mx-3 text-sm">rate_review</span>
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
        </div>

        <!-- RSVP & WISHES SECTION -->
        <section class="py-20 px-6 relative" id="rsvp">
            <div class="text-center mb-12 fade-in">
                <h2 class="font-display-hero-mobile text-2xl text-deep-charcoal mb-4">RSVP &amp; Wishes</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-xs mx-auto">We would be honored to have you celebrate with us.</p>
            </div>
            
            <div class="flex flex-col gap-10 max-w-sm mx-auto w-full">
                <!-- RSVP Form -->
                <div class="fade-in glass-panel rounded-2xl p-6 bg-white/50">
                    <form class="flex flex-col gap-4" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-caps text-xs text-on-surface mb-1" for="nama">Name</label>
                            <input class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs" id="nama" placeholder="Your full name" type="text" required/>
                        </div>
                        <div>
                            <label class="block font-label-caps text-xs text-on-surface mb-1" for="kehadiran">Will you attend?</label>
                            <select class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs appearance-none" id="kehadiran">
                                <option value="Hadir">Yes, I will be there</option>
                                <option value="Berhalangan">Sorry, I can't make it</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-caps text-xs text-on-surface mb-1" for="guests">Number of Guests</label>
                            <input class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs" id="guests" max="5" min="1" type="number" value="1"/>
                        </div>
                        <div>
                            <label class="block font-label-caps text-xs text-on-surface mb-1" for="pesan">Wishes for the couple</label>
                            <textarea class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs h-24 resize-none" id="pesan" placeholder="Write your wishes here..." required></textarea>
                        </div>
                        <button class="w-full bg-deep-navy-ink text-white rounded-full py-3.5 font-label-caps text-xs hover:bg-deep-navy-ink/90 transition-colors mt-2" type="submit">Confirm Attendance</button>
                    </form>
                </div>
                
                <!-- Guestbook -->
                <div class="fade-in glass-panel rounded-2xl p-6 flex flex-col h-[380px] bg-white/50">
                    <h3 class="font-headline-md text-deep-charcoal mb-4 text-center font-medium">Guestbook</h3>
                    <div class="flex-1 overflow-y-auto pr-1 space-y-4 no-scrollbar" id="wishList">
                        <div class="bg-white/40 p-4 rounded-xl border border-white/20 text-left">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-label-caps text-primary text-xs font-semibold">Eleanor Vance</span>
                                <span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                            </div>
                            <p class="font-body-md text-on-surface-variant text-xs leading-relaxed">Wishing you both a lifetime of happiness and love. Can't wait to celebrate!</p>
                        </div>
                        <div class="bg-white/40 p-4 rounded-xl border border-white/20 text-left">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-label-caps text-primary text-xs font-semibold">Marcus Thorne</span>
                                <span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                            </div>
                            <p class="font-body-md text-on-surface-variant text-xs leading-relaxed">Congratulations to the beautiful couple! Looking forward to the big day.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full flex items-center justify-center py-6 opacity-50 fade-in">
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
            <span class="material-symbols-outlined text-gold-leaf mx-3 text-sm">redeem</span>
            <div class="w-20 h-[1px] bg-gold-leaf/30"></div>
        </div>

        <!-- GIFT SECTION -->
        <section class="py-20 px-6 relative" id="gift">
            <div class="max-w-sm mx-auto w-full text-center fade-in glass-panel rounded-3xl p-6 bg-white/50">
                <span class="material-symbols-outlined text-gold-leaf text-3xl mb-3">redeem</span>
                <h2 class="font-display-hero-mobile text-xl text-deep-charcoal mb-3">Wedding Gift</h2>
                <p class="font-body-md text-xs text-on-surface-variant mb-6 leading-relaxed">Your presence at our wedding is the greatest gift of all. However, if you wish to honor us with a gift, a monetary blessing towards our future would be deeply appreciated.</p>
                
                @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                    <div class="space-y-4 w-full">
                        @foreach($invitation->bankAccounts as $bank)
                        <div class="bg-white/60 p-4 rounded-xl border border-gold-leaf/20 flex flex-col items-center">
                            <p class="font-label-caps text-primary uppercase text-xs mb-1.5 font-semibold">{{ strtoupper($bank->bank_name) }}</p>
                            <p class="font-headline-md text-deep-charcoal tracking-wider text-base mb-1">{{ $bank->account_number }}</p>
                            <p class="font-body-md text-on-surface-variant text-[11px] mb-3">a.n. {{ $bank->account_name }}</p>
                            <button class="inline-flex items-center justify-center px-4 py-2 bg-gold-leaf/10 text-gold-leaf rounded-lg font-label-md text-xs hover:bg-gold-leaf/20 transition-colors w-full" onclick="copyAccount('{{ $bank->account_number }}', this)">
                                <span class="material-symbols-outlined mr-1.5 text-xs">content_copy</span> Copy Number
                            </button>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/60 p-4 rounded-xl border border-gold-leaf/20 flex flex-col items-center w-full">
                        <p class="font-label-caps text-primary uppercase text-xs mb-1.5 font-semibold">BCA Bank</p>
                        <p class="font-headline-md text-deep-charcoal tracking-wider text-base mb-1">123 456 7890</p>
                        <p class="font-body-md text-on-surface-variant text-[11px] mb-3">a.n. Arthur Sterling</p>
                        <button class="inline-flex items-center justify-center px-4 py-2 bg-gold-leaf/10 text-gold-leaf rounded-lg font-label-md text-xs hover:bg-gold-leaf/20 transition-colors w-full" onclick="copyAccount('123 456 7890', this)">
                            <span class="material-symbols-outlined mr-1.5 text-xs">content_copy</span> Copy Number
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-surface-container-low dark:bg-deep-charcoal text-gold-leaf font-body-md text-body-md py-12 flex flex-col items-center gap-4 w-full px-6 mt-12 pb-32">
            <div class="font-headline-md text-headline-md text-gold-leaf mb-2">A&amp;E</div>
            <p class="text-secondary text-xs">© 2026 Crafted with Love &amp; Prestige</p>
        </footer>
    </main>

    <!-- BottomNavBar (Mobile & Desktop Centered) -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[432px] z-50 rounded-full border border-gold-stroke bg-white/75 backdrop-blur-xl shadow-[0_8px_32px_rgba(27,38,59,0.08)] flex justify-around py-2 px-2 translate-y-32 transition-transform duration-500 font-label-caps text-[10px]" id="bottom-nav">
        <a class="flex flex-col items-center justify-center text-primary rounded-full p-2 hover:bg-gold-leaf/10 transition-all duration-300" href="#cover" onclick="smoothScroll(event, '#cover')">
            <span class="material-symbols-outlined text-[18px]">home</span>
            <span>Home</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:text-gold-leaf transition-all duration-300" href="#couple" onclick="smoothScroll(event, '#couple')">
            <span class="material-symbols-outlined text-[18px]">favorite</span>
            <span>Couple</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:text-gold-leaf transition-all duration-300" href="#event" onclick="smoothScroll(event, '#event')">
            <span class="material-symbols-outlined text-[18px]">event</span>
            <span>Event</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:text-gold-leaf transition-all duration-300" href="#gallery" onclick="smoothScroll(event, '#gallery')">
            <span class="material-symbols-outlined text-[18px]">photo_library</span>
            <span>Gallery</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:text-gold-leaf transition-all duration-300" href="#rsvp" onclick="smoothScroll(event, '#rsvp')">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            <span>RSVP</span>
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
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            window.observer = observer;

            document.querySelectorAll('#cover .fade-in').forEach(el => {
                observer.observe(el);
            });

            // Start gold particles animation
            initGoldParticles();
            
            // Start countdown
            initCountdown();
        });

        // CSS Particles generator
        function initGoldParticles() {
            const container = document.getElementById('particle-container');
            if (!container) return;

            const particleCount = 45;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                const size = Math.random() * 3 + 1.5; 
                const leftPosition = Math.random() * 100; 
                const floatDuration = Math.random() * 12 + 8; 
                const driftDuration = Math.random() * 3 + 2; 
                const delay = Math.random() * -20; 
                const maxOpacity = Math.random() * 0.4 + 0.2; 
                const driftDistance = (Math.random() - 0.5) * 60; 

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${leftPosition}%`;
                particle.style.setProperty('--float-duration', `${floatDuration}s`);
                particle.style.setProperty('--drift-duration', `${driftDuration}s`);
                particle.style.setProperty('--delay', `${delay}s`);
                particle.style.setProperty('--max-opacity', maxOpacity.toFixed(2));
                particle.style.setProperty('--drift-distance', `${driftDistance}px`);

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
                cover.classList.add('hidden');
                navHeader.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-32');
                floatingControls.classList.remove('translate-y-32');
                
                audio.play().then(() => {
                    isPlaying = true;
                    document.getElementById('music-icon').innerText = 'volume_up';
                }).catch(err => console.log('Audio play blocked:', err));

                // Observe main content elements
                document.querySelectorAll('#main-content .fade-in').forEach(el => {
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
            const presence = document.getElementById('kehadiran')?.value || 'Hadir';
            const msg = document.getElementById('pesan').value;

            const card = document.createElement('div');
            card.className = 'bg-white/40 p-4 rounded-xl border border-white/20 text-left';
            card.innerHTML = `<div class="flex justify-between items-center mb-1"><span class="font-label-caps text-primary text-xs font-semibold">${name}</span><span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">${presence}</span></div><p class="font-body-md text-on-surface-variant text-xs leading-relaxed">${msg}</p>`;
            
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
                a.classList.remove('text-primary');
                a.classList.add('opacity-70');
            });
            e.currentTarget.classList.remove('opacity-70');
            e.currentTarget.classList.add('text-primary');
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
                a.className = "flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:text-gold-leaf transition-all duration-300";
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex flex-col items-center justify-center text-primary rounded-full p-2 bg-gold-leaf/20 hover:text-gold-leaf transition-all duration-300 scale-105";
                }
            });
        });
    </script>
</body>
</html>