@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Asep Setiawan');
        $brideName = trim($names[1] ?? 'Siti Nurhaliza');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Dedi & Ibu Rani',
                'bride' => 'Bpk. Ahmad & Ibu Siti',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-07-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Bumi Parahyangan Convention Center',
            'address' => $invitation->address ?? 'Jl. Raya Puncak KM 12, Jawa Barat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Bumi Parahyangan Convention Center'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Bumi Parahyangan Convention Center'
            ],
            [
                'title' => 'Resepsi',
                'time' => '11:00 - 14:00 WIB',
                'note' => $invitation->address ?? 'Bumi Parahyangan Convention Center'
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
                ['title' => 'Patepang Nu Mimiti', 'date' => 'JANUARI 2022', 'text' => 'Dina hiji poe anu cerah, takdir mawa sim kuring panggih di hiji perpustakaan kota. Harita aya rasa anu beda.'],
                ['title' => 'Niat Nu Suci', 'date' => 'MARET 2023', 'text' => 'Siti jeung Asep sapuk pikeun ngajalankeun hubungan anu leuwih serius. Kalayan restu ti sepuh duanana.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-13/images/image_5.jpg'),
                asset('assets/templates/wedding-13/images/image_6.jpg'),
                asset('assets/templates/wedding-13/images/image_7.jpg'),
                asset('assets/templates/wedding-13/images/image_8.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-13/images/image_2.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => $coverUrl,
            'bride' => $coverUrl,
        ];
    } else {
        $couple = [
            'groom' => 'Asep Setiawan',
            'bride' => 'Siti Nurhaliza',
            'parents' => [
                'groom' => 'Bpk. Dedi & Ibu Rani',
                'bride' => 'Bpk. Ahmad & Ibu Siti',
            ],
        ];

        $event = [
            'date_iso' => '2024-07-12',
            'time' => '08:00',
            'location' => 'Bumi Parahyangan Convention Center',
            'address' => 'Jl. Raya Puncak KM 12, Jawa Barat',
            'maps_url' => 'https://maps.google.com/?q=Bumi+Parahyangan+Convention+Center',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08.00 - 10.00 WIB', 'note' => 'Bumi Parahyangan Convention Center'],
            ['title' => 'Resepsi', 'time' => '11.00 - 14.00 WIB', 'note' => 'Bumi Parahyangan Convention Center'],
        ];

        $stories = [
            ['title' => 'Patepang Nu Mimiti', 'date' => 'JANUARI 2022', 'text' => 'Dina hiji poe anu cerah, takdir mawa sim kuring panggih di hiji perpustakaan kota. Harita aya rasa anu beda.'],
            ['title' => 'Niat Nu Suci', 'date' => 'MARET 2023', 'text' => 'Siti jeung Asep sapuk pikeun ngajalankeun hubungan anu leuwih serius. Kalayan restu ti sepuh duanana.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-13/images/image_5.jpg'),
            asset('assets/templates/wedding-13/images/image_6.jpg'),
            asset('assets/templates/wedding-13/images/image_7.jpg'),
            asset('assets/templates/wedding-13/images/image_8.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-13/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-13/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-13/images/image_3.jpg'),
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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Inter:wght@300;400;500&amp;family=Montserrat:wght@400;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#bdce89",
                        "primary-container": "#2d4b3e",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#fed65b",
                        "tertiary": "#273300",
                        "surface": "#faf9f5",
                        "tertiary-container": "#3d4a14",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-secondary-fixed": "#241a00",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-fixed-variant": "#3e4c16",
                        "on-primary-container": "#99baa9",
                        "sage-natural": "#8A9A5B",
                        "error": "#ba1a1a",
                        "outline-variant": "#c1c8c3",
                        "surface-dim": "#dbdad6",
                        "primary": "#163428",
                        "bone-cream": "#F5F2E9",
                        "secondary-fixed-dim": "#e9c349",
                        "on-secondary-fixed-variant": "#574500",
                        "secondary-fixed": "#ffe088",
                        "outline": "#727974",
                        "on-tertiary-fixed": "#161f00",
                        "charcoal-text": "#2A2A2A",
                        "inverse-surface": "#2f312e",
                        "tertiary-fixed": "#d9eaa3",
                        "on-primary": "#ffffff",
                        "background": "#faf9f5",
                        "surface-variant": "#e3e2df",
                        "pure-white": "#FFFFFF",
                        "inverse-primary": "#adcebd",
                        "surface-container-low": "#f4f4f0",
                        "on-tertiary-container": "#a9ba77",
                        "surface-bright": "#faf9f5",
                        "surface-container-highest": "#e3e2df",
                        "primary-fixed-dim": "#adcebd",
                        "surface-container-high": "#e9e8e4",
                        "on-secondary-container": "#745c00",
                        "on-error-container": "#93000a",
                        "on-background": "#1b1c1a",
                        "surface-tint": "#466557",
                        "on-primary-fixed": "#012116",
                        "sundanese-gold": "#D4AF37",
                        "inverse-on-surface": "#f2f1ed",
                        "on-surface": "#1b1c1a",
                        "on-error": "#ffffff",
                        "surface-container": "#efeeea",
                        "primary-fixed": "#c8ead8",
                        "on-surface-variant": "#424844",
                        "on-primary-fixed-variant": "#2f4d40",
                        "secondary": "#735c00"
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
                        "body-md": ["Inter"],
                        "label-caps": ["Montserrat"],
                        "quote-script": ["Playfair Display"],
                        "body-lg": ["Inter"],
                        "display-serif-mobile": ["Playfair Display"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "headline-lg": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "display-serif": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "label-caps": ["12px", {"lineHeight": "1.2", "letterSpacing": "0.1em", "fontWeight": "600"}],
                        "quote-script": ["22px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "display-serif-mobile": ["36px", {"lineHeight": "1.2", "fontWeight": "700"}]
                    }
                },
            },
        }
    </script>
    <style>
        body.locked {
            overflow: hidden;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .siger-divider {
            height: 100px;
            width: 1px;
            background: linear-gradient(to bottom, transparent, #D4AF37, transparent);
            margin: 2rem auto;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .oval-frame {
            border-radius: 50% / 40%;
            border: 2px solid #D4AF37;
            padding: 8px;
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 1s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D4AF37;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-background text-on-background selection:bg-sundanese-gold/30 max-w-[480px] w-full mx-auto relative shadow-2xl border-x border-sundanese-gold/10 min-h-screen locked">

    <!-- COVER SECTION -->
    <section class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-50 flex items-center justify-center overflow-hidden" id="cover">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-primary/20 backdrop-blur-[2px] z-10"></div>
            <img alt="Prewedding Cover" class="w-full h-full object-cover" src="{{ $bg['cover'] }}"/>
        </div>
        <div class="relative z-20 text-center px-6 flex flex-col items-center">
            <!-- Siger Sunda Logo -->
            <img alt="Siger Logo" class="w-24 h-24 mb-8 drop-shadow-md" src="{{ asset('assets/templates/wedding-13/images/image_1.jpg') }}"/>
            <p class="font-label-caps text-label-caps text-pure-white mb-4 tracking-[0.2em] uppercase">The Wedding of</p>
            <h2 class="font-display-serif-mobile text-display-serif-mobile text-pure-white mb-10 leading-tight">
                {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}
            </h2>
            <div class="mb-12">
                <p class="font-body-md text-pure-white/90 italic mb-2">Kepada Bapak/Ibu/Saudara/i:</p>
                <p class="font-headline-md text-pure-white font-semibold text-xl">{{ request()->get('kpd', 'Tamu Undangan') }}</p>
            </div>
            <button class="group relative px-10 py-4 overflow-hidden rounded-full border border-sundanese-gold/50 bg-white/10 backdrop-blur-md transition-all duration-300 hover:bg-sage-natural/90" onclick="openInvitation()">
                <div class="relative z-10 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sundanese-gold group-hover:text-pure-white transition-colors" style="font-variation-settings: 'FILL' 1;">stars</span>
                    <span class="font-label-caps text-label-caps text-pure-white tracking-widest">BUKA UNDANGAN</span>
                </div>
            </button>
        </div>
    </section>

    <!-- TOP APP BAR -->
    <header class="bg-surface/80 backdrop-blur-md text-primary fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[60] border-b border-sundanese-gold/20 shadow-sm opacity-0 transition-opacity duration-500" id="main-header">
        <div class="flex justify-between items-center px-margin-mobile py-4">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-sundanese-gold">spa</span>
                <span class="font-display-serif-mobile text-headline-md tracking-widest text-primary">{{ $couple['bride'] }} &amp; {{ $couple['groom'] }}</span>
            </div>
            <button class="hover:opacity-80 transition-opacity active:scale-95 transition-transform" onclick="navigator.share ? navigator.share({title: 'Undangan Pernikahan', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Tautan disalin!'))">
                <span class="material-symbols-outlined">share</span>
            </button>
        </div>
    </header>

    <!-- CONTENT WRAPPER -->
    <main class="opacity-0 transition-opacity duration-1000 relative" id="main-content">
        <!-- Hero Section Content -->
        <section class="min-h-screen flex flex-col items-center justify-center pt-24 pb-12 relative overflow-hidden" id="Home">
            <div class="z-10 text-center px-margin-mobile max-w-2xl flex flex-col items-center justify-center">
                <img alt="Siger Icon" class="w-16 mx-auto mb-8 animate-pulse" src="{{ asset('assets/templates/wedding-13/images/image_1.jpg') }}"/>
                <p class="font-label-caps text-label-caps text-sage-natural mb-4">WILUJENG SUMPING</p>
                <h1 class="font-display-serif-mobile text-display-serif-mobile text-primary mb-6">Pernikahan Suci {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}</h1>
                <p class="font-body-md text-body-md text-on-surface-variant italic mb-12">"Mugi-mugi janten kulawarga nu sakinah, mawaddah, warahmah."</p>

                <!-- Countdown Timer -->
                <div class="grid grid-cols-4 gap-2 w-full max-w-xs px-2 mt-6">
                    <div class="bg-white border-t-2 border-sundanese-gold rounded-xl p-3 flex flex-col items-center shadow-md">
                        <span class="font-display-serif text-lg font-bold text-primary" id="days">00</span>
                        <span class="font-label-caps text-[8px] text-on-surface-variant/70 mt-1">HARI</span>
                    </div>
                    <div class="bg-white border-t-2 border-sundanese-gold rounded-xl p-3 flex flex-col items-center shadow-md">
                        <span class="font-display-serif text-lg font-bold text-primary" id="hours">00</span>
                        <span class="font-label-caps text-[8px] text-on-surface-variant/70 mt-1">JAM</span>
                    </div>
                    <div class="bg-white border-t-2 border-sundanese-gold rounded-xl p-3 flex flex-col items-center shadow-md">
                        <span class="font-display-serif text-lg font-bold text-primary" id="minutes">00</span>
                        <span class="font-label-caps text-[8px] text-on-surface-variant/70 mt-1">MENIT</span>
                    </div>
                    <div class="bg-white border-t-2 border-sundanese-gold rounded-xl p-3 flex flex-col items-center shadow-md">
                        <span class="font-display-serif text-lg font-bold text-primary" id="seconds">00</span>
                        <span class="font-label-caps text-[8px] text-on-surface-variant/70 mt-1">DETIK</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Mempelai -->
        <section class="py-section-gap bg-bone-cream/50 relative" id="mempelai">
            <div class="max-w-container-max mx-auto px-margin-mobile">
                <div class="text-center mb-16 reveal">
                    <span class="material-symbols-outlined text-sundanese-gold text-4xl mb-4">favorite</span>
                    <h2 class="font-headline-lg text-headline-lg text-primary">Mempelai</h2>
                    <div class="siger-divider"></div>
                </div>
                <div class="flex flex-col gap-16 items-center">
                    <!-- Groom -->
                    <div class="text-center reveal w-full">
                        <div class="relative w-64 h-80 mx-auto mb-8">
                            <img class="w-full h-full object-cover oval-frame shadow-lg" data-alt="Portrait of Groom" src="{{ asset('assets/templates/wedding-13/images/image_2.jpg') }}"/>
                        </div>
                        <h3 class="font-display-serif text-headline-lg text-primary mb-2">{{ $couple['groom'] }}</h3>
                        <p class="font-body-md text-on-surface-variant mb-4">Putra kadeudeuh ti</p>
                        <p class="font-headline-md text-headline-md text-sage-natural">{{ $couple['parents']['groom'] }}</p>
                    </div>
                    <!-- Bride -->
                    <div class="text-center reveal w-full">
                        <div class="relative w-64 h-80 mx-auto mb-8">
                            <img class="w-full h-full object-cover oval-frame shadow-lg" data-alt="Portrait of Bride" src="{{ asset('assets/templates/wedding-13/images/image_3.jpg') }}"/>
                        </div>
                        <h3 class="font-display-serif text-headline-lg text-primary mb-2">{{ $couple['bride'] }}</h3>
                        <p class="font-body-md text-on-surface-variant mb-4">Putri kadeudeuh ti</p>
                        <p class="font-headline-md text-headline-md text-sage-natural">{{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Acara -->
        <section class="py-section-gap relative overflow-hidden" id="acara">
            <div class="absolute top-0 right-0 w-64 opacity-10 pointer-events-none">
                <img alt="Background Pattern" src="{{ asset('assets/templates/wedding-13/images/image_4.jpg') }}"/>
            </div>
            <div class="max-w-container-max mx-auto px-margin-mobile relative z-10">
                <div class="text-center mb-16 reveal">
                    <h2 class="font-headline-lg text-headline-lg text-primary uppercase tracking-widest">Waktos Nu Mustari</h2>
                    <p class="text-sage-natural font-label-caps mt-2">SAVE THE DATE</p>
                </div>
                <div class="flex flex-col gap-8">
                    <!-- Akad -->
                    <div class="glass-card p-8 text-center rounded-3xl reveal shadow-lg">
                        <span class="material-symbols-outlined text-sundanese-gold text-4xl mb-4">auto_awesome</span>
                        <h3 class="font-display-serif text-headline-md mb-6 border-b border-sundanese-gold/30 pb-4">Akad Nikah</h3>
                        <div class="space-y-4 font-body-md text-on-surface-variant">
                            <p class="font-bold text-primary">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            <p>Tabuh {{ $schedule[0]['time'] }}</p>
                            <p class="mt-8 italic">{{ $schedule[0]['note'] }}</p>
                            <p>{{ $event['address'] }}</p>
                        </div>
                        <a class="mt-8 bg-sage-natural text-pure-white px-8 py-3 rounded-full font-label-caps hover:opacity-90 transition-all flex items-center gap-2 mx-auto justify-center w-fit shadow-md" href="{{ $event['maps_url'] }}" target="_blank">
                            <span class="material-symbols-outlined text-sm">location_on</span> BUKA PETA
                        </a>
                    </div>
                    <!-- Resepsi -->
                    <div class="glass-card p-8 text-center rounded-3xl reveal shadow-lg">
                        <span class="material-symbols-outlined text-sundanese-gold text-4xl mb-4">celebration</span>
                        <h3 class="font-display-serif text-headline-md mb-6 border-b border-sundanese-gold/30 pb-4">Resepsi</h3>
                        <div class="space-y-4 font-body-md text-on-surface-variant">
                            <p class="font-bold text-primary">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            <p>Tabuh {{ $schedule[1]['time'] }}</p>
                            <p class="mt-8 italic">{{ $schedule[1]['note'] }}</p>
                            <p>{{ $event['address'] }}</p>
                        </div>
                        <button class="mt-8 border border-sundanese-gold text-primary px-8 py-3 rounded-full font-label-caps hover:bg-sundanese-gold/10 transition-all flex items-center gap-2 mx-auto justify-center w-fit shadow-sm" onclick="window.open('https://calendar.google.com/calendar/render?action=TEMPLATE&text=' + encodeURIComponent('Pernikahan {{ $couple['bride'] }} & {{ $couple['groom'] }}') + '&dates={{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T080000Z/{{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T140000Z&details=Selamat+datang+di+pernikahan+kami&location=' + encodeURIComponent('{{ $event['location'] }}'))">
                            <span class="material-symbols-outlined text-sm">calendar_add_on</span> SIMPEN ACARA
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kisah Cinta -->
        <section class="py-section-gap bg-surface-container-low" id="cerita">
            <div class="max-w-4xl mx-auto px-margin-mobile">
                <div class="text-center mb-16 reveal">
                    <h2 class="font-headline-lg text-headline-lg text-primary">Kisah Cinta</h2>
                    <div class="siger-divider"></div>
                </div>
                <div class="relative">
                    <!-- Center Line -->
                    <div class="absolute left-1/2 -translate-x-1/2 h-full w-px bg-sundanese-gold/40"></div>
                    
                    @foreach ($stories as $index => $story)
                    <!-- Timeline Item -->
                    <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 reveal">
                        @if ($index % 2 == 0)
                        <div class="md:text-right md:pr-12">
                            <h4 class="font-display-serif text-headline-md text-primary">{{ $story['title'] }}</h4>
                            <p class="text-sage-natural font-label-caps mb-2">{{ $story['date'] }}</p>
                            <p class="font-body-md text-on-surface-variant text-sm">{{ $story['text'] }}</p>
                        </div>
                        <div class="hidden md:block"></div>
                        @else
                        <div class="hidden md:block"></div>
                        <div class="md:pl-12">
                            <h4 class="font-display-serif text-headline-md text-primary">{{ $story['title'] }}</h4>
                            <p class="text-sage-natural font-label-caps mb-2">{{ $story['date'] }}</p>
                            <p class="font-body-md text-on-surface-variant text-sm">{{ $story['text'] }}</p>
                        </div>
                        @endif
                        <div class="absolute left-1/2 -translate-x-1/2 top-0 bg-pure-white p-2 rounded-full border border-sundanese-gold">
                            <span class="material-symbols-outlined text-sundanese-gold text-sm" style="font-variation-settings: 'FILL' 1;">{{ $index % 2 == 0 ? 'spa' : 'favorite' }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Galeri Foto -->
        <section class="py-section-gap" id="galeri">
            <div class="max-w-container-max mx-auto px-margin-mobile">
                <div class="text-center mb-16 reveal">
                    <h2 class="font-headline-lg text-headline-lg text-primary">Moments</h2>
                </div>
                <div class="grid grid-cols-2 gap-4 auto-rows-[160px]">
                    @foreach ($gallery as $index => $img)
                    @php
                        $span = '';
                        if ($index == 0) $span = 'col-span-2 row-span-2';
                        elseif ($index == 3) $span = 'col-span-2';
                    @endphp
                    <div class="overflow-hidden rounded-2xl reveal {{ $span }} cursor-zoom-in shadow-md" onclick="openLightbox('{{ $img }}')">
                        <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" src="{{ $img }}" alt="Gallery Image {{ $index+1 }}"/>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- RSVP & Guestbook -->
        <section class="py-section-gap bg-bone-cream" id="doa">
            <div class="max-w-4xl mx-auto px-margin-mobile">
                <div class="flex flex-col gap-12">
                    <!-- RSVP Form -->
                    <div class="reveal w-full">
                        <h3 class="font-headline-md text-primary mb-6">Konfirmasi Kahadiran</h3>
                        <form class="space-y-4" id="rsvp-form" onsubmit="submitRsvp(event)">
                            <div>
                                <label class="font-label-caps text-on-surface-variant block mb-2 text-xs">NAMI LENGKEP</label>
                                <input id="nama" class="w-full bg-pure-white border border-sage-natural/30 focus:border-sage-natural focus:ring-0 rounded-lg py-3 px-4 text-sm" type="text" placeholder="Tulis nami lengkap" required/>
                            </div>
                            <div>
                                <label class="font-label-caps text-on-surface-variant block mb-2 text-xs">JUMLAH TAMU</label>
                                <select id="jumlah_tamu" class="w-full bg-pure-white border border-sage-natural/30 focus:border-sage-natural focus:ring-0 rounded-lg py-3 px-4 text-sm">
                                    <option value="1 Jalmi">1 Jalmi</option>
                                    <option value="2 Jalmi">2 Jalmi</option>
                                </select>
                            </div>
                            <div>
                                <label class="font-label-caps text-on-surface-variant block mb-2 text-xs">KAHADIRAN</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input class="text-sage-natural focus:ring-sage-natural" name="presence" type="radio" value="Hadir" checked/>
                                        <span class="font-body-md text-sm">Hadir</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input class="text-sage-natural focus:ring-sage-natural" name="presence" type="radio" value="Ulah (Hampura)"/>
                                        <span class="font-body-md text-sm">Ulah (Hampura)</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="font-label-caps text-on-surface-variant block mb-2 text-xs">PANGDU'A &amp; UCAPAN</label>
                                <textarea id="pesan" class="w-full bg-pure-white border border-sage-natural/30 focus:border-sage-natural focus:ring-0 rounded-lg py-3 px-4 text-sm" rows="4" placeholder="Kintun pangdu'a kanggo mempelai" required></textarea>
                            </div>
                            <button class="w-full bg-primary text-pure-white py-4 rounded-full font-label-caps hover:bg-primary-container transition-all text-xs tracking-widest shadow-md" type="submit">KIRIM KONFIRMASI</button>
                        </form>
                    </div>
                    <!-- Guestbook -->
                    <div class="reveal w-full">
                        <h3 class="font-headline-md text-primary mb-6">Pangdu'a &amp; Ucapan</h3>
                        <div id="wishList" class="space-y-4 max-h-[300px] overflow-y-auto pr-4 custom-scrollbar">
                            <div class="glass-card p-6 rounded-2xl shadow-sm">
                                <p class="font-label-caps text-sage-natural mb-2 text-xs">Kang Ridwan</p>
                                <p class="font-quote-script text-on-surface text-base italic">"Wilujeng Siti &amp; Asep! Mugi-mugi janten sakinah dugi ka jannah. Amin."</p>
                            </div>
                            <div class="glass-card p-6 rounded-2xl shadow-sm">
                                <p class="font-label-caps text-sage-natural mb-2 text-xs">Teh Sarah</p>
                                <p class="font-quote-script text-on-surface text-base italic">"Sena sampurasun, moga acara lanca-linci. Samawa!"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Wedding Gift -->
        <section class="py-section-gap text-center relative">
            <div class="max-w-2xl mx-auto px-margin-mobile reveal">
                <h2 class="font-headline-lg text-primary mb-4">Wedding Gift</h2>
                <p class="font-body-md text-on-surface-variant mb-12 text-sm">Pikeun kado tanda kadeudeuh, mangga tiasa dikirimkeun ngalangkungan:</p>
                
                @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                    <div class="flex flex-col gap-6">
                        @foreach($invitation->bankAccounts as $bank)
                        <div class="glass-card p-8 rounded-3xl shadow-md border border-sundanese-gold/10">
                            <div class="text-primary font-bold text-xl tracking-widest mb-4">{{ strtoupper($bank->bank_name) }}</div>
                            <p class="font-body-lg font-bold text-primary tracking-widest text-2xl mb-2">{{ $bank->account_number }}</p>
                            <p class="font-label-caps text-sage-natural mb-6 text-xs">A/N {{ strtoupper($bank->account_name) }}</p>
                            <button class="bg-sage-natural text-pure-white px-6 py-2 rounded-full font-label-caps text-[10px] hover:scale-105 active:scale-95 transition-all shadow-sm" onclick="copyAccount('{{ $bank->account_number }}', this)">SALIN NOMOR REKENING</button>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass-card p-8 rounded-3xl mb-8 shadow-md border border-sundanese-gold/10">
                        <img alt="BCA Logo" class="h-8 mx-auto mb-6" src="{{ asset('assets/templates/wedding-13/images/image_9.jpg') }}"/>
                        <p class="font-body-lg font-bold text-primary tracking-widest text-2xl mb-2">123 456 7890</p>
                        <p class="font-label-caps text-sage-natural mb-6 text-xs">A/N SITI NURHALIZA</p>
                        <button class="bg-sage-natural text-pure-white px-6 py-2 rounded-full font-label-caps text-[10px] hover:scale-105 active:scale-95 transition-all shadow-sm" onclick="copyAccount('1234567890', this)">SALIN NOMOR REKENING</button>
                    </div>
                @endif
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-16 bg-primary text-pure-white text-center">
            <div class="max-w-container-max mx-auto px-margin-mobile reveal">
                <img alt="Siger Icon" class="w-12 mx-auto mb-8 invert opacity-50 animate-pulse" src="{{ asset('assets/templates/wedding-13/images/image_1.jpg') }}"/>
                <h2 class="font-display-serif text-display-serif-mobile mb-4 text-3xl">Hatur Nuhun</h2>
                <p class="font-body-md opacity-80 mb-12 text-sm">Hadirna Saderek mangrupikeun kabungah pikeun sim kuring saparakanca.</p>
                <p class="font-label-caps tracking-[0.3em] opacity-60 text-xs">{{ strtoupper($couple['bride']) }} &amp; {{ strtoupper($couple['groom']) }} • 2024</p>
            </div>
        </footer>

        <!-- Spacer for Bottom Nav -->
        <div class="h-28"></div>
    </main>

    <!-- Bottom Navigation Bar -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[432px] rounded-full bg-pure-white/80 dark:bg-surface-container/80 backdrop-blur-md z-50 flex justify-around items-center py-3 px-6 border border-sundanese-gold/30 shadow-[0_8px_30px_rgb(45,75,62,0.08)] transform translate-y-32 transition-transform duration-500" id="bottom-nav">
        <a class="flex flex-col items-center justify-center text-primary relative after:content-[''] after:absolute after:-bottom-1 after:w-1 after:h-1 after:bg-sundanese-gold after:rounded-full" href="#Home" onclick="smoothScroll(event, '#Home')">
            <span class="material-symbols-outlined text-[20px]">home</span>
            <span class="font-label-caps text-[9px] mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center justify-center text-sage-natural/60 hover:text-primary transition-colors" href="#mempelai" onclick="smoothScroll(event, '#mempelai')">
            <span class="material-symbols-outlined text-[20px]">favorite</span>
            <span class="font-label-caps text-[9px] mt-1">Mempelai</span>
        </a>
        <a class="flex flex-col items-center justify-center text-sage-natural/60 hover:text-primary transition-colors" href="#acara" onclick="smoothScroll(event, '#acara')">
            <span class="material-symbols-outlined text-[20px]">calendar_month</span>
            <span class="font-label-caps text-[9px] mt-1">Acara</span>
        </a>
        <a class="flex flex-col items-center justify-center text-sage-natural/60 hover:text-primary transition-colors" href="#cerita" onclick="smoothScroll(event, '#cerita')">
            <span class="material-symbols-outlined text-[20px]">auto_stories</span>
            <span class="font-label-caps text-[9px] mt-1">Cerita</span>
        </a>
        <a class="flex flex-col items-center justify-center text-sage-natural/60 hover:text-primary transition-colors" href="#doa" onclick="smoothScroll(event, '#doa')">
            <span class="material-symbols-outlined text-[20px]">auto_awesome</span>
            <span class="font-label-caps text-[9px] mt-1">Doa</span>
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
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-sundanese-gold text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-sundanese-gold/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <script>
        // Open Invitation
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const header = document.getElementById('main-header');
            const bottomNav = document.getElementById('bottom-nav');
            const floatingControls = document.getElementById('floating-controls');
            const audio = document.getElementById('bg-music');

            document.body.classList.remove('locked');

            cover.style.transition = 'all 1.5s cubic-bezier(0.65, 0, 0.35, 1)';
            cover.style.transform = 'translateY(-100%)';

            setTimeout(() => {
                cover.classList.add('hidden');
                mainContent.classList.remove('opacity-0');
                header.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-32');
                floatingControls.classList.remove('translate-y-32');
                
                // Play audio and start components
                audio.play().then(() => {
                    isPlaying = true;
                    document.getElementById('music-icon').innerText = 'volume_up';
                }).catch(err => console.log('Music play blocked:', err));

                startCountdown();
                handleScrollReveal();
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

        // Stop autoscroll on manual user interaction
        ['wheel', 'touchstart', 'touchmove'].forEach(evt => 
            window.addEventListener(evt, () => {
                stopAutoscroll();
            }, { passive: true })
        );

        // Countdown Logic
        function startCountdown() {
            const weddingDate = new Date("{{ $event['date_iso'] }}T{{ $event['time'] }}:00").getTime();
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = weddingDate - now;

                if (distance < 0) {
                    clearInterval(timer);
                    document.getElementById("days").innerText = "00";
                    document.getElementById("hours").innerText = "00";
                    document.getElementById("minutes").innerText = "00";
                    document.getElementById("seconds").innerText = "00";
                } else {
                    document.getElementById("days").innerText = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    document.getElementById("hours").innerText = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    document.getElementById("minutes").innerText = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    document.getElementById("seconds").innerText = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                }
            }, 1000);
        }

        // Scroll Reveal
        function handleScrollReveal() {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, { threshold: 0.15 });

            reveals.forEach(el => observer.observe(el));
        }

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
            const presence = document.querySelector('input[name="presence"]:checked')?.value || 'Hadir';
            const msg = document.getElementById('pesan').value;

            const card = document.createElement('div');
            card.className = 'glass-card p-6 rounded-2xl shadow-sm';
            card.innerHTML = `<p class="font-label-caps text-sage-natural mb-2 text-xs">${name} (${presence})</p><p class="font-quote-script text-on-surface text-base italic">"${msg}"</p>`;
            
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

        // Close Lightbox
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

            // Update active link state
            document.querySelectorAll('nav a').forEach(a => {
                a.className = "flex flex-col items-center justify-center text-sage-natural/60 hover:text-primary transition-colors";
                a.removeAttribute('style');
            });
            e.currentTarget.className = "flex flex-col items-center justify-center text-primary relative after:content-[''] after:absolute after:-bottom-1 after:w-1 after:h-1 after:bg-sundanese-gold after:rounded-full";
        }

        // Scroll Active Nav Link Highlight
        window.addEventListener('scroll', () => {
            let current = "";
            const sections = document.querySelectorAll("section");
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute("id");
                }
            });

            document.querySelectorAll('nav a').forEach((a) => {
                a.className = "flex flex-col items-center justify-center text-sage-natural/60 hover:text-primary transition-colors";
                a.classList.remove("text-primary", "after:content-['']", "after:absolute", "after:-bottom-1", "after:w-1", "after:h-1", "after:bg-sundanese-gold", "after:rounded-full");
                
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex flex-col items-center justify-center text-primary relative after:content-[''] after:absolute after:-bottom-1 after:w-1 after:h-1 after:bg-sundanese-gold after:rounded-full";
                }
            });
        });
    </script>
</body>
</html>