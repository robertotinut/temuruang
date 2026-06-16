@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Adrian Sterling');
        $brideName = trim($names[1] ?? 'Seraphina Vance');

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
            'location' => $invitation->location ?? 'The Grand Cathedral',
            'address' => $invitation->address ?? '123 Serenity Avenue, Azure City',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Grand Cathedral'),
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

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-17/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-17/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-17/images/image_3.jpg'),
        ];
    } else {
        $couple = [
            'groom' => 'Adrian Sterling',
            'bride' => 'Seraphina Vance',
            'parents' => [
                'groom' => 'Bapak Albert Sterling & Ibu Catherine',
                'bride' => 'Bapak George Vance & Ibu Diana',
            ],
        ];

        $event = [
            'date_iso' => '2026-10-14',
            'time' => '15:00',
            'location' => 'The Grand Cathedral',
            'address' => '123 Serenity Avenue, Azure City',
            'maps_url' => 'https://maps.google.com/?q=The+Grand+Cathedral+Azure+City',
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
            'cover' => asset('assets/templates/wedding-17/images/image_1.jpg'),
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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&amp;family=Montserrat:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "secondary-fixed": "#d7e2ff",
                        "on-primary-fixed": "#071d30",
                        "on-primary-container": "#3e5167",
                        "inverse-surface": "#293137",
                        "outline": "#74777d",
                        "surface-variant": "#dbe4ea",
                        "on-tertiary-container": "#624d00",
                        "on-secondary-fixed": "#101b30",
                        "on-error-container": "#93000a",
                        "secondary": "#545e76",
                        "error-container": "#ffdad6",
                        "on-surface": "#151d22",
                        "primary-fixed": "#d0e4ff",
                        "tertiary-container": "#e4be45",
                        "background": "#f5faff",
                        "surface-dim": "#d3dbe2",
                        "primary-fixed-dim": "#b4c8e2",
                        "surface-container-low": "#edf5fc",
                        "on-surface-variant": "#43474c",
                        "on-secondary-fixed-variant": "#3c475d",
                        "surface-container": "#e7eff6",
                        "tertiary-fixed": "#ffe088",
                        "deep-navy-ink": "#1B263B",
                        "gold-leaf": "#D4AF37",
                        "on-primary-fixed-variant": "#35485e",
                        "secondary-container": "#d7e2ff",
                        "on-background": "#151d22",
                        "inverse-primary": "#b4c8e2",
                        "primary-container": "#b0c4de",
                        "surface-container-highest": "#dbe4ea",
                        "secondary-fixed-dim": "#bbc6e2",
                        "on-tertiary-fixed": "#241a00",
                        "outline-variant": "#c4c6cd",
                        "tertiary-fixed-dim": "#e9c349",
                        "surface-bright": "#f5faff",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-fixed-variant": "#574500",
                        "on-error": "#ffffff",
                        "inverse-on-surface": "#eaf2f9",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#5a647c",
                        "on-tertiary": "#ffffff",
                        "surface": "#f5faff",
                        "surface-tint": "#4d6077",
                        "on-primary": "#ffffff",
                        "primary": "#4d6077",
                        "tertiary": "#735c00",
                        "on-secondary": "#ffffff",
                        "soft-powder": "#B0C4DE",
                        "surface-container-high": "#e1e9f0",
                        "ice-blue-glimmer": "#E6F2FF"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "container-max": "1200px",
                        "unit": "8px",
                        "gutter": "24px",
                        "margin-mobile": "20px",
                        "margin-desktop": "64px"
                    },
                    fontFamily: {
                        "display-lg-mobile": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "display-lg": ["Playfair Display"],
                        "label-lg": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "body-lg": ["Montserrat"],
                        "label-md": ["Montserrat"]
                    },
                    fontSize: {
                        "display-lg-mobile": ["40px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "display-lg": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-lg": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "label-md": ["12px", {"lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "500"}]
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
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.5); /* Champagne Gold */
            box-shadow: 0 8px 32px rgba(27, 38, 59, 0.08); /* Deep Navy tint */
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
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
            background: #f5faff;
            transition: transform 0.5s ease-in-out;
        }
        #mobile-menu.open {
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md relative antialiased selection:bg-primary selection:text-white max-w-[480px] w-full mx-auto shadow-2xl border-x border-gold-leaf/20 min-h-screen is-locked">

    <!-- Ambient Background Animation -->
    <div class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-0 pointer-events-none" id="animation-container">
        <div class="absolute inset-0 bg-gradient-to-b from-ice-blue-glimmer/40 to-surface-container-low/60 mix-blend-overlay"></div>
    </div>

    <!-- COVER SECTION -->
    <section class="fixed inset-0 z-50 max-w-[480px] w-full left-1/2 -translate-x-1/2 flex flex-col items-center justify-center bg-cover bg-center text-center p-6" id="cover" style="background-image: linear-gradient(rgba(27, 38, 59, 0.4), rgba(27, 38, 59, 0.75)), url('{{ $bg['cover'] }}');">
        <div class="fade-in w-full flex flex-col items-center">
            <span class="font-headline-md text-headline-md text-white/80 tracking-widest uppercase mb-4 opacity-80 text-sm">The Wedding of</span>
            <h1 class="font-display-lg text-display-lg-mobile text-gold-leaf mb-12 drop-shadow-sm">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
            
            <div class="glass-panel rounded-2xl p-6 w-full mb-12 text-center relative overflow-hidden bg-white/20 border-white/30">
                <p class="font-body-lg text-body-lg text-white mb-4 italic">"Two souls, one beautiful journey."</p>
                <p class="font-body-md text-white/90 text-sm">Kepada Yth. Bapak/Ibu/Saudara/i:</p>
                <p class="font-headline-md text-lg text-white font-semibold border-b border-white/30 pb-2 w-full text-center mt-2">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
                <p class="text-[10px] text-white/70 mt-2">Mohon maaf bila ada kesalahan penulisan nama/gelar</p>
            </div>
            
            <button class="inline-flex items-center justify-center px-8 py-4 bg-deep-navy-ink text-white rounded-full font-label-lg text-label-lg transition-transform hover:scale-105 hover:shadow-[0_8px_24px_rgba(27,38,59,0.2)] cursor-pointer z-20" id="open-invitation-btn" onclick="openInvitation()">
                Open Invitation
            </button>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="relative z-10 pb-32 w-full overflow-hidden" id="main-content">
        
        <!-- Top Navigation -->
        <header class="fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-40 bg-white/70 backdrop-blur-md border-b border-gold-leaf/20 flex justify-between items-center px-6 py-4 opacity-0 transition-opacity duration-500" id="top-nav">
            <div class="font-display-lg text-lg text-gold-leaf">Azure Serenity</div>
            <button class="text-primary hover:text-gold-leaf" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </header>

        <!-- Mobile Menu Overlay -->
        <div class="flex flex-col items-center justify-center gap-8" id="mobile-menu">
            <button class="absolute top-6 right-6 text-primary hover:text-gold-leaf" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <a class="font-display-lg text-2xl text-deep-navy-ink hover:text-gold-leaf" href="#hero" onclick="toggleMobileMenu()">Home</a>
            <a class="font-display-lg text-2xl text-deep-navy-ink hover:text-gold-leaf" href="#couple" onclick="toggleMobileMenu()">Couple</a>
            <a class="font-display-lg text-2xl text-deep-navy-ink hover:text-gold-leaf" href="#event" onclick="toggleMobileMenu()">Event</a>
            <a class="font-display-lg text-2xl text-deep-navy-ink hover:text-gold-leaf" href="#story" onclick="toggleMobileMenu()">Story</a>
            <a class="font-display-lg text-2xl text-deep-navy-ink hover:text-gold-leaf" href="#gallery" onclick="toggleMobileMenu()">Gallery</a>
            <a class="font-display-lg text-2xl text-deep-navy-ink hover:text-gold-leaf" href="#rsvp" onclick="toggleMobileMenu()">RSVP</a>
        </div>

        <!-- HERO SECTION (Countdown & Main Image) -->
        <section class="min-h-screen flex flex-col items-center justify-center px-6 py-20 relative mt-12" id="hero">
            <div class="w-full flex flex-col items-center">
                <!-- Image Container with Frame -->
                <div class="fade-in w-full max-w-sm mb-12 relative rounded-t-full overflow-hidden glass-panel p-2">
                    <img alt="Elegant wedding couple silhouetted" class="w-full h-[360px] object-cover rounded-t-full brightness-110 contrast-90" src="{{ $bg['cover'] }}"/>
                </div>
                <!-- Countdown -->
                <div class="fade-in flex flex-col items-center text-center w-full">
                    <h2 class="font-headline-lg text-xl text-deep-navy-ink mb-6">The Celebration Begins In</h2>
                    <div class="grid grid-cols-4 gap-3 w-full max-w-sm">
                        <!-- Days -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-lg text-xl text-gold-leaf mb-1" id="days">00</span>
                            <span class="font-label-md text-[9px] text-on-surface-variant uppercase tracking-widest">Days</span>
                        </div>
                        <!-- Hours -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-lg text-xl text-gold-leaf mb-1" id="hours">00</span>
                            <span class="font-label-md text-[9px] text-on-surface-variant uppercase tracking-widest">Hours</span>
                        </div>
                        <!-- Mins -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-lg text-xl text-gold-leaf mb-1" id="minutes">00</span>
                            <span class="font-label-md text-[9px] text-on-surface-variant uppercase tracking-widest">Mins</span>
                        </div>
                        <!-- Secs -->
                        <div class="glass-panel rounded-xl flex flex-col items-center justify-center p-3 aspect-square bg-white/60">
                            <span class="font-display-lg text-xl text-gold-leaf mb-1" id="seconds">00</span>
                            <span class="font-label-md text-[9px] text-on-surface-variant uppercase tracking-widest">Secs</span>
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
                <h2 class="font-display-lg text-2xl text-deep-navy-ink mb-4">Meet The Couple</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-sm mx-auto">Two distinct paths merging into one beautiful journey of love and serenity.</p>
            </div>
            
            <div class="flex flex-col gap-12 w-full max-w-sm mx-auto">
                <!-- Groom -->
                <div class="fade-in flex flex-col items-center text-center">
                    <div class="w-48 h-48 rounded-full p-1.5 glass-panel mb-6 relative">
                        <img alt="Groom portrait" class="w-full h-full object-cover rounded-full" src="{{ $bg['groom'] }}"/>
                        <div class="absolute -bottom-2 right-4 bg-gold-leaf text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg border border-white">
                            <span class="material-symbols-outlined text-sm">person</span>
                        </div>
                    </div>
                    <h3 class="font-headline-md text-lg text-deep-navy-ink mb-1">{{ $couple['groom'] }}</h3>
                    <span class="font-label-lg text-xs text-gold-leaf uppercase tracking-widest mb-3">The Groom</span>
                    <p class="font-body-md text-xs text-on-surface-variant max-w-xs mb-4">Putra Kedua dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                    <a class="w-8 h-8 rounded-full glass-panel flex items-center justify-center text-gold-leaf hover:bg-gold-leaf hover:text-white transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">link</span>
                    </a>
                </div>

                <!-- Groom & Bride Connector -->
                <div class="text-center py-2 fade-in">
                    <span class="font-display-lg text-3xl text-gold-leaf">&amp;</span>
                </div>

                <!-- Bride -->
                <div class="fade-in flex flex-col items-center text-center">
                    <div class="w-48 h-48 rounded-full p-1.5 glass-panel mb-6 relative">
                        <img alt="Bride portrait" class="w-full h-full object-cover rounded-full" src="{{ $bg['bride'] }}"/>
                        <div class="absolute -bottom-2 right-4 bg-gold-leaf text-white rounded-full w-8 h-8 flex items-center justify-center shadow-lg border border-white">
                            <span class="material-symbols-outlined text-sm">favorite</span>
                        </div>
                    </div>
                    <h3 class="font-headline-md text-lg text-deep-navy-ink mb-1">{{ $couple['bride'] }}</h3>
                    <span class="font-label-lg text-xs text-gold-leaf uppercase tracking-widest mb-3">The Bride</span>
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
                <h2 class="font-display-lg text-2xl text-deep-navy-ink mb-4">The Details</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-sm mx-auto">Join us in celebrating our union.</p>
            </div>
            
            <div class="flex flex-col gap-8 w-full max-w-sm mx-auto">
                <!-- Ceremony -->
                <div class="fade-in glass-panel rounded-2xl p-6 flex flex-col items-center text-center bg-white/60">
                    <span class="material-symbols-outlined text-gold-leaf text-3xl mb-3">church</span>
                    <h3 class="font-headline-md text-lg text-deep-navy-ink mb-1">{{ $schedule[0]['title'] }}</h3>
                    <p class="font-label-lg text-xs text-primary uppercase tracking-widest mb-3">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-4">Pukul {{ $schedule[0]['time'] }} WIB</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-6 leading-relaxed">{{ $schedule[0]['note'] }}<br>{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" class="inline-flex items-center justify-center px-6 py-2.5 border border-gold-leaf text-gold-leaf rounded-full font-label-md text-xs hover:bg-gold-leaf hover:text-white transition-colors bg-white/80">
                        <span class="material-symbols-outlined mr-1.5 text-sm">map</span> View Map
                    </a>
                </div>
                
                <!-- Reception -->
                <div class="fade-in glass-panel rounded-2xl p-6 flex flex-col items-center text-center bg-white/60">
                    <span class="material-symbols-outlined text-gold-leaf text-3xl mb-3">restaurant</span>
                    <h3 class="font-headline-md text-lg text-deep-navy-ink mb-1">{{ $schedule[1]['title'] }}</h3>
                    <p class="font-label-lg text-xs text-primary uppercase tracking-widest mb-3">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-4">Pukul {{ $schedule[1]['time'] }} WIB</p>
                    <p class="font-body-md text-xs text-on-surface-variant mb-6 leading-relaxed">{{ $schedule[1]['note'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" class="inline-flex items-center justify-center px-6 py-2.5 border border-gold-leaf text-gold-leaf rounded-full font-label-md text-xs hover:bg-gold-leaf hover:text-white transition-colors bg-white/80">
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
                <h2 class="font-display-lg text-2xl text-deep-navy-ink mb-4">Our Journey</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-sm mx-auto">From the first hello to forever.</p>
            </div>
            
            <div class="max-w-sm mx-auto w-full relative pl-6 border-l-2 border-gold-leaf/30">
                @foreach($stories as $s)
                <div class="fade-in relative mb-12 last:mb-0">
                    <!-- Timeline point -->
                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 bg-gold-leaf rounded-full border-4 border-background"></div>
                    <div class="glass-panel p-5 rounded-2xl bg-white/60">
                        <span class="font-label-md text-[10px] text-primary uppercase tracking-widest mb-1.5 block font-semibold">{{ $s['date'] }}</span>
                        <h3 class="font-headline-md text-sm text-deep-navy-ink mb-2">{{ $s['title'] }}</h3>
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
                <h2 class="font-display-lg text-2xl text-deep-navy-ink mb-4">Gallery</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-sm mx-auto">Captured moments of our love.</p>
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
                <h2 class="font-display-lg text-2xl text-deep-navy-ink mb-4">RSVP &amp; Wishes</h2>
                <p class="font-body-md text-sm text-on-surface-variant max-w-sm mx-auto">We would be honored to have you celebrate with us.</p>
            </div>
            
            <div class="flex flex-col gap-10 max-w-sm mx-auto w-full">
                <!-- RSVP Form -->
                <div class="fade-in glass-panel rounded-2xl p-6 bg-white/50">
                    <form class="flex flex-col gap-4" id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div>
                            <label class="block font-label-md text-xs text-on-surface mb-1" for="nama">Name</label>
                            <input class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs" id="nama" placeholder="Your full name" type="text" required/>
                        </div>
                        <div>
                            <label class="block font-label-md text-xs text-on-surface mb-1" for="kehadiran">Will you attend?</label>
                            <select class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs appearance-none" id="kehadiran">
                                <option value="Hadir">Yes, I will be there</option>
                                <option value="Berhalangan">Sorry, I can't make it</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-md text-xs text-on-surface mb-1" for="guests">Number of Guests</label>
                            <input class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs" id="guests" max="5" min="1" type="number" value="1"/>
                        </div>
                        <div>
                            <label class="block font-label-md text-xs text-on-surface mb-1" for="pesan">Wishes for the couple</label>
                            <textarea class="w-full bg-white/60 border border-gold-leaf/30 rounded-lg px-4 py-2.5 focus:outline-none focus:border-gold-leaf font-body-md text-xs h-24 resize-none" id="pesan" placeholder="Write your wishes here..." required></textarea>
                        </div>
                        <button class="w-full bg-deep-navy-ink text-white rounded-full py-3.5 font-label-lg text-xs hover:bg-deep-navy-ink/90 transition-colors mt-2" type="submit">Confirm Attendance</button>
                    </form>
                </div>
                
                <!-- Guestbook -->
                <div class="fade-in glass-panel rounded-2xl p-6 flex flex-col h-[380px] bg-white/50">
                    <h3 class="font-headline-md text-deep-navy-ink mb-4 text-center font-medium">Guestbook</h3>
                    <div class="flex-1 overflow-y-auto pr-1 space-y-4 no-scrollbar" id="wishList">
                        <div class="bg-white/40 p-4 rounded-xl border border-white/20 text-left">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-label-lg text-primary text-xs font-semibold">Eleanor Vance</span>
                                <span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                            </div>
                            <p class="font-body-md text-on-surface-variant text-xs leading-relaxed">Wishing you both a lifetime of happiness and love. Can't wait to celebrate!</p>
                        </div>
                        <div class="bg-white/40 p-4 rounded-xl border border-white/20 text-left">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-label-lg text-primary text-xs font-semibold">Marcus Thorne</span>
                                <span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Hadir</span>
                            </div>
                            <p class="font-body-md text-on-surface-variant text-xs leading-relaxed">Congratulations to the beautiful couple! Looking forward to the big day.</p>
                        </div>
                        <div class="bg-white/40 p-4 rounded-xl border border-white/20 text-left">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-label-lg text-primary text-xs font-semibold">Sarah Jenkins</span>
                                <span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">Berhalangan</span>
                            </div>
                            <p class="font-body-md text-on-surface-variant text-xs leading-relaxed">So happy for you two! Wishing you all the best on your new journey together.</p>
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
                <h2 class="font-display-lg text-xl text-deep-navy-ink mb-3">Wedding Gift</h2>
                <p class="font-body-md text-xs text-on-surface-variant mb-6 leading-relaxed">Your presence at our wedding is the greatest gift of all. However, if you wish to honor us with a gift, a monetary blessing towards our future would be deeply appreciated.</p>
                
                @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                    <div class="space-y-4 w-full">
                        @foreach($invitation->bankAccounts as $bank)
                        <div class="bg-white/60 p-4 rounded-xl border border-gold-leaf/20 flex flex-col items-center">
                            <p class="font-label-lg text-primary uppercase text-xs mb-1.5 font-semibold">{{ strtoupper($bank->bank_name) }}</p>
                            <p class="font-headline-md text-deep-navy-ink tracking-wider text-base mb-1">{{ $bank->account_number }}</p>
                            <p class="font-body-md text-on-surface-variant text-[11px] mb-3">a.n. {{ $bank->account_name }}</p>
                            <button class="inline-flex items-center justify-center px-4 py-2 bg-gold-leaf/10 text-gold-leaf rounded-lg font-label-md text-xs hover:bg-gold-leaf/20 transition-colors w-full" onclick="copyAccount('{{ $bank->account_number }}', this)">
                                <span class="material-symbols-outlined mr-1.5 text-xs">content_copy</span> Copy Number
                            </button>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/60 p-4 rounded-xl border border-gold-leaf/20 flex flex-col items-center w-full">
                        <p class="font-label-lg text-primary uppercase text-xs mb-1.5 font-semibold">Azure Bank</p>
                        <p class="font-headline-md text-deep-navy-ink tracking-wider text-base mb-1">1234 5678 9012</p>
                        <p class="font-body-md text-on-surface-variant text-[11px] mb-3">a.n. Adrian Sterling</p>
                        <button class="inline-flex items-center justify-center px-4 py-2 bg-gold-leaf/10 text-gold-leaf rounded-lg font-label-md text-xs hover:bg-gold-leaf/20 transition-colors w-full" onclick="copyAccount('1234 5678 9012', this)">
                            <span class="material-symbols-outlined mr-1.5 text-xs">content_copy</span> Copy Number
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="py-12 text-center relative z-10 pb-32">
            <div class="fade-in">
                <h2 class="font-display-lg text-2xl text-gold-leaf mb-4">Thank You</h2>
                <p class="font-body-md text-xs text-on-surface-variant max-w-xs mx-auto leading-relaxed">We look forward to sharing our special day with you.</p>
                <div class="mt-8 font-label-md text-primary/60 uppercase tracking-widest text-[11px] font-semibold">
                    {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
                </div>
            </div>
        </footer>
    </main>

    <!-- BottomNavBar (Mobile & Desktop Centered) -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[432px] z-50 rounded-full border border-gold-leaf/30 bg-white/75 backdrop-blur-xl shadow-[0_8px_32px_rgba(27,38,59,0.08)] flex justify-around py-2 px-2 translate-y-32 transition-transform duration-500" id="bottom-nav">
        <a class="flex flex-col items-center justify-center text-primary rounded-full p-2 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]" href="#cover" onclick="smoothScroll(event, '#cover')">
            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">home</span>
            <span>Home</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-secondary-fixed-variant p-2 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]" href="#couple" onclick="smoothScroll(event, '#couple')">
            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 0;">favorite</span>
            <span>Couple</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-secondary-fixed-variant p-2 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]" href="#event" onclick="smoothScroll(event, '#event')">
            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 0;">calendar_today</span>
            <span>Event</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-secondary-fixed-variant p-2 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]" href="#gallery" onclick="smoothScroll(event, '#gallery')">
            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 0;">photo_library</span>
            <span>Gallery</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-secondary-fixed-variant p-2 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]" href="#rsvp" onclick="smoothScroll(event, '#rsvp')">
            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 0;">mail</span>
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
        <source src="{{ asset('musics/boho-wedding-bg.mp3') }}" type="audio/mpeg"/>
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
        let petals = [];

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

            // Start Three.js ambient petals animation
            initThreeJS();
            
            // Start countdown
            initCountdown();
        });

        // Three.js Falling Petals
        function initThreeJS() {
            const container = document.getElementById('animation-container');
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, container.clientWidth / window.innerHeight, 0.1, 1000);
            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            
            renderer.setSize(container.clientWidth, window.innerHeight);
            container.appendChild(renderer.domElement);

            const petalCount = 40;
            const createPetal = () => {
                const shape = new THREE.Shape();
                shape.moveTo(0, 0);
                shape.bezierCurveTo(0.5, 0.5, 0.8, 1, 0, 1.5);
                shape.bezierCurveTo(-0.8, 1, -0.5, 0.5, 0, 0);
                
                const geometry = new THREE.ShapeGeometry(shape);
                const material = new THREE.MeshPhongMaterial({
                    color: new THREE.Color(0xB0C4DE).offsetHSL(0, 0, (Math.random() - 0.5) * 0.1),
                    transparent: true,
                    opacity: 0.6,
                    side: THREE.DoubleSide
                });
                
                const petal = new THREE.Mesh(geometry, material);
                petal.position.set(
                    (Math.random() - 0.5) * 10,
                    Math.random() * 10,
                    (Math.random() - 0.5) * 5
                );
                
                petal.rotation.set(Math.random() * Math.PI, Math.random() * Math.PI, Math.random() * Math.PI);
                const scale = 0.15 + Math.random() * 0.25;
                petal.scale.set(scale, scale, scale);
                
                petal.userData = {
                    speedY: 0.008 + Math.random() * 0.012,
                    speedX: (Math.random() - 0.5) * 0.006,
                    rotationSpeed: (Math.random() - 0.5) * 0.015,
                    phase: Math.random() * Math.PI * 2
                };
                
                return petal;
            };

            const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
            scene.add(ambientLight);
            const pointLight = new THREE.PointLight(0xffffff, 0.4);
            pointLight.position.set(5, 5, 5);
            scene.add(pointLight);

            for (let i = 0; i < petalCount; i++) {
                const p = createPetal();
                petals.push(p);
                scene.add(p);
            }

            camera.position.z = 6;

            function animate() {
                requestAnimationFrame(animate);
                const time = Date.now() * 0.001;
                
                petals.forEach(p => {
                    p.position.y -= p.userData.speedY;
                    p.position.x += Math.sin(time + p.userData.phase) * 0.003;
                    p.rotation.x += p.userData.rotationSpeed;
                    p.rotation.y += p.userData.rotationSpeed * 0.5;
                    
                    if (p.position.y < -5) {
                        p.position.y = 5;
                        p.position.x = (Math.random() - 0.5) * 10;
                    }
                });
                
                renderer.render(scene, camera);
            }

            window.addEventListener('resize', () => {
                camera.aspect = container.clientWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.clientWidth, window.innerHeight);
            });

            animate();
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
            card.innerHTML = `<div class="flex justify-between items-center mb-1"><span class="font-label-lg text-primary text-xs font-semibold">${name}</span><span class="text-[9px] bg-gold-leaf/20 text-gold-leaf px-2 py-0.5 rounded-full border border-gold-leaf/30">${presence}</span></div><p class="font-body-md text-on-surface-variant text-xs leading-relaxed">${msg}</p>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP parantos kakintun, Hatur nuhun!");
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
                a.classList.add('text-on-secondary-fixed-variant');
            });
            e.currentTarget.classList.remove('text-on-secondary-fixed-variant');
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
                a.className = "flex flex-col items-center justify-center text-on-secondary-fixed-variant p-2 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]";
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex flex-col items-center justify-center text-primary rounded-full p-2 bg-gold-leaf/20 hover:bg-gold-leaf/10 transition-all duration-300 font-label-md text-[10px]";
                }
            });
        });
    </script>
</body>
</html>