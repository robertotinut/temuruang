@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[1] ?? 'Farrel');
        $brideName = trim($names[0] ?? 'Nadhira');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'groom_full' => $invitation->groom_name ?? 'Farrel Maulana',
            'bride_full' => $invitation->bride_name ?? 'Nadhira Salsabila',
            'parents' => [
                'groom' => $invitation->groom_parents ?? 'Putra dari Bapak Hendra & Ibu Dian Puspita',
                'bride' => $invitation->bride_parents ?? 'Putri dari Bapak Ahmad & Ibu Siti Rahma',
            ],
            'instagram' => [
                'groom' => $invitation->groom_instagram ?? 'farrel.maulana',
                'bride' => $invitation->bride_instagram ?? 'nadhira.salsabila',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-12-21',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'GEDUNG SERUNI',
            'address' => $invitation->address ?? 'Jl. Angin Sejahtera No. 12, Yogyakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode('Gedung Seruni Yogyakarta'),
        ];

        $schedule = [
            [
                'title' => 'AKAD NIKAH',
                'time' => 'Pukul 08.00 - 09.00 WIB',
                'room' => 'Ruang Melati',
                'venue' => 'Gedung Seruni',
                'icon' => 'candi'
            ],
            [
                'title' => 'RESEPSI',
                'time' => 'Pukul 11.00 - 14.00 WIB',
                'room' => 'Ruang Angin',
                'venue' => 'Gedung Seruni',
                'icon' => 'joglo'
            ]
        ];

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
                ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Farrel Maulana', 'account' => '8420-5519-02'],
                ['bank' => 'Bank Mandiri', 'name' => 'Nadhira Salsabila', 'account' => '124-00-9882716-4'],
            ];
        }

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
                ['name' => 'Dimas & Anisa', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Nadhira & Farrel! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
                ['name' => 'Bagas & Raras', 'status' => 'Hadir', 'message' => 'Lancar sampai hari H bestie! Nuansa Negara Angin nya keren dan syahdu banget.'],
                ['name' => 'Keluarga Besar Wicaksono', 'status' => 'Hadir', 'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir.'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/boho-wedding-bg.mp3');
    } else {
        // Fallback / Demo values matching EXACT reference
        $couple = [
            'groom' => 'FARREL',
            'bride' => 'NADHIRA',
            'groom_full' => 'Farrel Maulana',
            'bride_full' => 'Nadhira Salsabila',
            'parents' => [
                'groom' => 'Putra dari Bapak Hendra & Ibu Dian Puspita',
                'bride' => 'Putri dari Bapak Ahmad & Ibu Siti Rahma',
            ],
            'instagram' => [
                'groom' => 'farrel.maulana',
                'bride' => 'nadhira.salsabila',
            ],
        ];

        $event = [
            'date_iso' => '2026-12-21',
            'time' => '08:00',
            'location' => 'GEDUNG SERUNI',
            'address' => 'Jl. Angin Sejahtera No. 12',
            'city' => 'Yogyakarta',
            'maps_url' => 'https://maps.google.com/?q=Gedung+Seruni+Yogyakarta',
        ];

        $schedule = [
            [
                'title' => 'AKAD NIKAH',
                'time' => 'Pukul 08.00 - 09.00 WIB',
                'room' => 'Ruang Melati',
                'venue' => 'Gedung Seruni',
                'icon' => 'candi'
            ],
            [
                'title' => 'RESEPSI',
                'time' => 'Pukul 11.00 - 14.00 WIB',
                'room' => 'Ruang Angin',
                'venue' => 'Gedung Seruni',
                'icon' => 'joglo'
            ]
        ];

        $wishes = [
            ['name' => 'Dimas & Anisa', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Nadhira & Farrel! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
            ['name' => 'Bagas & Raras', 'status' => 'Hadir', 'message' => 'Lancar sampai hari H bestie! Nuansa Negara Angin nya keren dan syahdu banget.'],
            ['name' => 'Keluarga Besar Wicaksono', 'status' => 'Hadir', 'message' => 'Barakallahu lakuma wa baraka alaikuma wa jama\'a bainakuma fii khoir.'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Farrel Maulana', 'account' => '8420-5519-02'],
            ['bank' => 'Bank Mandiri', 'name' => 'Nadhira Salsabila', 'account' => '124-00-9882716-4'],
        ];

        $musicUrl = asset('musics/boho-wedding-bg.mp3');
    }

    $assetDir = asset('assets/templates/wedding-35');
    $imgDir = asset('assets/templates/wedding-35/images');
    $ornDir = asset('assets/templates/wedding-35/ornaments');
    $guestName = request('to', 'Tamu Undangan');
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>The Wedding of {{ $couple['bride_full'] }} &amp; {{ $couple['groom_full'] }}</title>
    
    <!-- Meta SEO & Social Sharing -->
    <meta name="description" content="Pernikahan {{ $couple['bride_full'] }} &amp; {{ $couple['groom_full'] }} - Minggu, 21 Desember 2026 di Gedung Seruni, Yogyakarta."/>
    <meta property="og:title" content="The Wedding of {{ $couple['bride_full'] }} &amp; {{ $couple['groom_full'] }}"/>
    <meta property="og:description" content="Undangan Pernikahan {{ $couple['bride_full'] }} &amp; {{ $couple['groom_full'] }}"/>
    <meta property="og:image" content="{{ $imgDir }}/thumbnail.jpg"/>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'celestial-navy': '#1E2C38',
                        'celestial-slate': '#2C465A',
                        'celestial-blue': '#4A6B82',
                        'celestial-mist': '#7A9BB0',
                        'celestial-ice': '#DCE7EE',
                        'parchment-light': '#FAF7F0',
                        'parchment-base': '#F5EFEB',
                        'parchment-dark': '#EFE8DE',
                        'antique-gold': '#C5A059',
                        'gold-light': '#DFBF77',
                        'gold-dark': '#9E7B35',
                        'ink-dark': '#2B3945',
                        'ink-muted': '#6B7A88',
                    },
                    fontFamily: {
                        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                        cinzel: ['"Cinzel"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Smooth scrolling and resets */
        html, body {
            margin: 0;
            padding: 0;
            background-color: #D6D0C5;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2B3945;
            -webkit-font-smoothing: antialiased;
        }

        /* Container constraints */
        .mobile-canvas {
            max-width: 460px;
            margin: 0 auto;
            min-height: 100vh;
            background: #F5EFEB;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.25);
            overflow-x: hidden;
        }

        /* Gold gradient text */
        .gold-gradient-text {
            background: linear-gradient(135deg, #F3E5AB 0%, #D8B66C 50%, #9E7B35 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gold-metallic-text {
            background: linear-gradient(180deg, #FDF7EB 0%, #E2C27F 45%, #C5A059 80%, #967026 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Ethereal wind animation */
        @keyframes floatCloud {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(1deg); }
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
        }

        @keyframes windDrift {
            0% { transform: translate(0, 0); }
            50% { transform: translate(5px, -3px); }
            100% { transform: translate(0, 0); }
        }

        .animate-float {
            animation: floatCloud 6s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }

        .animate-wind {
            animation: windDrift 8s ease-in-out infinite;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #F5EFEB;
        }
        ::-webkit-scrollbar-thumb {
            background: #C5A059;
            border-radius: 3px;
        }
    </style>
</head>
<body class="bg-[#D6D0C5] text-ink-dark selection:bg-antique-gold/20 selection:text-celestial-navy">

    <!-- Mobile Outer Container (max-w-460px responsive canvas) -->
    <div class="mobile-canvas relative">

        <!-- ========================================== -->
        <!-- 1. COVER (CARD 1: COVER)                   -->
        <!-- ========================================== -->
        <section id="cover-screen" class="fixed inset-0 z-50 flex flex-col justify-between max-w-[460px] mx-auto bg-[#1C2C39] transition-transform duration-1000 ease-in-out overflow-hidden shadow-2xl">
            <!-- Background Candi Bentar Landscape (Exact Gateway in Mist) -->
            <div class="absolute inset-0 z-0">
                <img src="{{ $imgDir }}/candi-bentar-bg.jpg" alt="Candi Bentar Negara Angin" class="w-full h-full object-cover object-center filter brightness-[0.92] contrast-[1.05]"/>
                <!-- Subtle Gradient Vignette -->
                <div class="absolute inset-0 bg-gradient-to-b from-[#182733]/50 via-transparent to-[#182733]/85 pointer-events-none"></div>
            </div>

            <!-- Top Hanging Lantern / Pendant -->
            <div class="relative z-10 flex justify-center pt-3">
                <img src="{{ $ornDir }}/hanging-pendant.svg" alt="Pendant" class="w-9 h-16 opacity-90 filter drop-shadow-md animate-wind"/>
            </div>

            <!-- Center Typography (Exact Match to Card 1: THE WEDDING OF / NADHIRA & FARREL / 21 . 12 . 2026) -->
            <div class="relative z-10 px-6 text-center -mt-10">
                <!-- Subtitle -->
                <p class="font-cinzel text-[11px] uppercase tracking-[0.35em] text-[#EBE3D5] opacity-95 drop-shadow-md mb-2">
                    THE WEDDING OF
                </p>

                <!-- Couple Names (Uppercase Classical Serif in Gold Metallic) -->
                <h1 class="font-serif text-3xl sm:text-4xl font-semibold tracking-[0.18em] uppercase text-white drop-shadow-[0_4px_14px_rgba(0,0,0,0.8)] leading-tight">
                    <span class="block gold-metallic-text">NADHIRA</span>
                    <span class="block text-2xl font-light italic text-[#EBE3D5] my-0.5 lowercase">&amp;</span>
                    <span class="block gold-metallic-text">FARREL</span>
                </h1>

                <!-- Date -->
                <div class="mt-3 flex items-center justify-center gap-3">
                    <span class="h-[1px] w-8 bg-[#C5A059]/70"></span>
                    <p class="font-cinzel text-xs tracking-[0.3em] text-[#F3EFE6] drop-shadow-md font-light">
                        21 . 12 . 2026
                    </p>
                    <span class="h-[1px] w-8 bg-[#C5A059]/70"></span>
                </div>
            </div>

            <!-- Bottom Guest Greeting & Open Button -->
            <div class="relative z-10 px-8 pb-8 text-center flex flex-col items-center">
                <!-- Recipient Pill -->
                <div class="w-full max-w-[280px] bg-[#1E2C38]/85 backdrop-blur-md border border-[#C5A059]/50 rounded-full py-2.5 px-4 mb-4 shadow-xl">
                    <p class="text-[9px] uppercase tracking-wider text-[#C5A059] font-cinzel">Kepada Yth. Tamu Undangan:</p>
                    <p class="text-sm font-semibold text-white truncate mt-0.5">{{ $guestName }}</p>
                </div>

                <!-- CTA Button BUKA UNDANGAN -->
                <button id="btn-open-invitation" class="group relative inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-[#C5A059] via-[#DFBF77] to-[#C5A059] text-celestial-navy font-cinzel text-xs font-bold tracking-[0.2em] rounded-full shadow-[0_4px_25px_rgba(197,160,89,0.55)] hover:brightness-110 active:scale-95 transition-all">
                    <svg class="w-4 h-4 text-celestial-navy group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19V5l12-3v16l-12-3zm12-9l6-2v8l-6-2"/>
                    </svg>
                    <span>BUKA UNDANGAN</span>
                </button>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- FLOATING MUSIC CONTROLLER                  -->
        <!-- ========================================== -->
        <div id="audio-pill" class="fixed top-4 right-4 z-40 hidden max-w-[460px]">
            <button id="btn-toggle-music" class="w-10 h-10 rounded-full bg-[#1E2C38]/85 backdrop-blur-md border border-[#C5A059]/50 text-[#DFBF77] flex items-center justify-center shadow-lg transition-transform hover:scale-105 active:scale-95" aria-label="Toggle Audio">
                <svg id="icon-music-on" class="w-4 h-4 animate-spin" style="animation-duration: 4s;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                </svg>
                <svg id="icon-music-off" class="w-4 h-4 hidden text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l4.27 4.27c-.24.16-.51.28-.8.36L20.73 21 22 19.73 4.27 3zM12 7h4V3h-6v5.18l2 2V7z"/>
                </svg>
            </button>
            <audio id="bg-audio" loop preload="auto">
                <source src="{{ $musicUrl }}" type="audio/mp3">
            </audio>
        </div>

        <!-- ========================================== -->
        <!-- MAIN INVITATION CONTENT                    -->
        <!-- ========================================== -->
        <main class="relative z-10 w-full bg-[#FAF7F0] min-h-screen">

            <!-- ========================================== -->
            <!-- 2. HALAMAN DEPAN (CARD 2: HALAMAN DEPAN)   -->
            <!-- ========================================== -->
            <section class="relative px-6 py-12 overflow-hidden text-center border-b border-[#E8DEC8] bg-[#F7F2EB]">
                <!-- Background Arch & Vivid Peacock Wings (Card 2) -->
                <div class="absolute inset-0 z-0 pointer-events-none opacity-90">
                    <img src="{{ $imgDir }}/arch-peacock-bg.jpg" alt="Batik Peacock Wings" class="w-full h-full object-cover object-center"/>
                </div>

                <!-- Center Content Box matching Card 2 -->
                <div class="relative z-10 max-w-xs mx-auto py-8 px-6 rounded-[130px_130px_16px_16px] border border-[#C5A059]/40 bg-[#FAF7F0]/90 backdrop-blur-sm shadow-[0_6px_25px_rgba(44,70,90,0.08)]">
                    
                    <!-- Mandala Emblem -->
                    <div class="flex justify-center mb-4">
                        <img src="{{ $ornDir }}/mandala-emblem.svg" alt="Emblem" class="w-8 h-8 opacity-85"/>
                    </div>

                    <!-- UNDANGAN PERNIKAHAN -->
                    <h2 class="font-serif text-2xl tracking-[0.18em] font-semibold text-celestial-navy uppercase mb-1">
                        UNDANGAN<br>PERNIKAHAN
                    </h2>
                    <div class="w-10 h-[1.5px] bg-[#C5A059] mx-auto my-4"></div>

                    <!-- Kepada Yth. -->
                    <p class="font-cinzel text-xs uppercase tracking-wider text-celestial-blue font-medium mb-3">
                        Kepada Yth.
                    </p>

                    <!-- Rounded Recipient Box (Card 2) -->
                    <div class="bg-white/95 border border-[#C5A059]/35 rounded-2xl py-4 px-3 my-2 shadow-sm">
                        <p class="font-serif text-xl sm:text-2xl font-bold text-celestial-navy tracking-wide">
                            {{ $guestName }}
                        </p>
                    </div>

                    <!-- Footnote -->
                    <p class="text-[10px] italic text-ink-muted mt-5 leading-relaxed max-w-[200px] mx-auto">
                        Mohon maaf apabila terdapat kesalahan penulisan nama / gelar
                    </p>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 3. HALAMAN MEMPELAI (CARD 3: MEMPELAI)     -->
            <!-- ========================================== -->
            <section class="relative px-5 py-12 overflow-hidden text-center bg-gradient-to-b from-[#FAF7F0] via-[#F4ECE3] to-[#FAF7F0] border-b border-[#E8DEC8]">
                <!-- Header (Card 3) -->
                <div class="relative z-10 max-w-sm mx-auto mb-5">
                    <h2 class="font-serif text-3xl font-normal italic text-celestial-navy tracking-wide mb-1.5">
                        Dua Jiwa Satu Tujuan
                    </h2>
                    <p class="text-[11px] text-ink-muted leading-relaxed px-4 font-light">
                        Dengan memohon rahmat dan ridha Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir dalam acara pernikahan kami:
                    </p>
                </div>

                <!-- Center Illustration: Bride & Groom from Behind with Billowing Wind Veil (Card 3) -->
                <div class="relative z-10 max-w-[340px] mx-auto my-4">
                    <div class="relative rounded-2xl overflow-hidden border border-[#C5A059]/35 shadow-md bg-white">
                        <img src="{{ $imgDir }}/couple-veil.jpg" alt="Mempelai Nadhira & Farrel" class="w-full h-auto object-cover object-center filter brightness-[0.98]"/>
                    </div>
                </div>

                <!-- Couple Profile Information (Exact 2 Columns side-by-side matching Card 3) -->
                <div class="relative z-10 max-w-sm mx-auto mt-6">
                    <div class="grid grid-cols-2 gap-2 text-center items-start">
                        <!-- Bride (Nadhira Salsabila) -->
                        <div class="p-2.5 bg-white/80 rounded-xl border border-[#C5A059]/25 shadow-sm">
                            <h3 class="font-serif text-base sm:text-lg font-bold text-celestial-navy tracking-wide">
                                {{ $couple['bride_full'] }}
                            </h3>
                            <p class="text-[10px] text-ink-muted mt-0.5 font-light leading-snug">
                                {{ $couple['parents']['bride'] }}
                            </p>
                        </div>

                        <!-- Groom (Farrel Maulana) -->
                        <div class="p-2.5 bg-white/80 rounded-xl border border-[#C5A059]/25 shadow-sm">
                            <h3 class="font-serif text-base sm:text-lg font-bold text-celestial-navy tracking-wide">
                                {{ $couple['groom_full'] }}
                            </h3>
                            <p class="text-[10px] text-ink-muted mt-0.5 font-light leading-snug">
                                {{ $couple['parents']['groom'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Center Mandala -->
                    <div class="flex justify-center mt-3">
                        <img src="{{ $ornDir }}/mandala-emblem.svg" alt="Emblem" class="w-5 h-5 opacity-65"/>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 4. HALAMAN UNDANGAN (CARD 4: UNDANGAN)     -->
            <!-- ========================================== -->
            <section class="relative px-6 py-12 overflow-hidden text-center border-b border-[#E8DEC8] bg-[#FAF7F0]">
                <!-- Header (Card 4) -->
                <div class="relative z-10 max-w-sm mx-auto mb-5">
                    <p class="font-cinzel text-xs uppercase tracking-[0.2em] text-celestial-blue font-semibold">
                        DENGAN SEGALA HORMAT KAMI MENGUNDANG
                    </p>
                    <p class="text-xs text-ink-muted mt-1 font-light">
                        Bapak/Ibu/Saudara/i untuk menghadiri acara pernikahan kami
                    </p>
                </div>

                <!-- Center Date Badge (Card 4) -->
                <div class="relative z-10 max-w-xs mx-auto py-6 px-4 bg-white/85 rounded-2xl border border-[#C5A059]/30 shadow-sm">
                    <!-- Mandala -->
                    <div class="flex justify-center mb-2.5">
                        <img src="{{ $ornDir }}/mandala-emblem.svg" alt="Emblem" class="w-6 h-6 opacity-75"/>
                    </div>

                    <!-- MINGGU -->
                    <p class="font-cinzel text-xs uppercase tracking-[0.3em] text-celestial-navy font-semibold">
                        MINGGU
                    </p>

                    <!-- 21 (Huge Serif Number) -->
                    <h3 class="font-serif text-6xl sm:text-7xl font-bold text-celestial-navy my-0.5 tracking-tight">
                        21
                    </h3>

                    <!-- DESEMBER 2026 -->
                    <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-[#C5A059] font-medium mb-4">
                        DESEMBER 2026
                    </p>

                    <!-- LIVE COUNTDOWN TIMER DIALS -->
                    <div class="pt-4 border-t border-[#E8DEC8]">
                        <p class="text-[9px] font-cinzel uppercase tracking-[0.2em] text-ink-muted mb-2.5">Menghitung Hari Bahagia</p>
                        <div class="grid grid-cols-4 gap-1.5 text-center" id="countdown-timer">
                            <div class="p-1.5 bg-[#FAF7F0] border border-[#C5A059]/25 rounded-lg shadow-inner">
                                <span class="block font-serif text-lg font-bold text-celestial-navy" id="cd-days">00</span>
                                <span class="block text-[8px] uppercase tracking-wider text-celestial-blue font-cinzel">HARI</span>
                            </div>
                            <div class="p-1.5 bg-[#FAF7F0] border border-[#C5A059]/25 rounded-lg shadow-inner">
                                <span class="block font-serif text-lg font-bold text-celestial-navy" id="cd-hours">00</span>
                                <span class="block text-[8px] uppercase tracking-wider text-celestial-blue font-cinzel">JAM</span>
                            </div>
                            <div class="p-1.5 bg-[#FAF7F0] border border-[#C5A059]/25 rounded-lg shadow-inner">
                                <span class="block font-serif text-lg font-bold text-celestial-navy" id="cd-minutes">00</span>
                                <span class="block text-[8px] uppercase tracking-wider text-celestial-blue font-cinzel">MENIT</span>
                            </div>
                            <div class="p-1.5 bg-[#FAF7F0] border border-[#C5A059]/25 rounded-lg shadow-inner">
                                <span class="block font-serif text-lg font-bold text-celestial-navy" id="cd-seconds">00</span>
                                <span class="block text-[8px] uppercase tracking-wider text-celestial-blue font-cinzel">DETIK</span>
                            </div>
                        </div>
                    </div>

                    <!-- Add to Calendar Button -->
                    <div class="mt-3">
                        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Pernikahan Nadhira & Farrel') }}&dates=20261221T010000Z/20261221T070000Z&details={{ urlencode('Akad & Resepsi Pernikahan Nadhira & Farrel di Gedung Seruni, Yogyakarta') }}&location={{ urlencode('Gedung Seruni, Jl. Angin Sejahtera No. 12, Yogyakarta') }}" target="_blank" class="inline-flex items-center gap-1.5 text-[10px] font-cinzel uppercase tracking-wider text-[#9E7B35] hover:text-celestial-navy transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Simpan ke Google Calendar</span>
                        </a>
                    </div>
                </div>

                <!-- Venue Info (Card 4) -->
                <div class="relative z-10 max-w-sm mx-auto mt-6 text-center">
                    <p class="font-cinzel text-xs uppercase tracking-widest text-[#C5A059] font-medium mb-1">DI</p>
                    <h4 class="font-serif text-2xl font-bold text-celestial-navy tracking-wide">
                        {{ $event['location'] }}
                    </h4>
                    <p class="text-xs text-ink-muted mt-0.5">
                        {{ $event['address'] }}<br>Yogyakarta
                    </p>
                    
                    <p class="text-[11px] italic text-ink-muted mt-4 leading-relaxed max-w-[270px] mx-auto font-light">
                        Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu kepada kami.
                    </p>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 5. HALAMAN DETAIL ACARA (CARD 5: DETAIL)   -->
            <!-- ========================================== -->
            <section class="relative px-5 py-12 overflow-hidden border-b border-[#E8DEC8] bg-gradient-to-b from-[#FAF7F0] via-[#F4ECE3] to-[#FAF7F0]">
                <!-- Section Header (Card 5) -->
                <div class="relative z-10 text-center max-w-sm mx-auto mb-6">
                    <h2 class="font-serif text-3xl font-normal italic text-celestial-navy tracking-wide mb-1.5">
                        Rangkaian Acara
                    </h2>
                    <div class="flex justify-center">
                        <img src="{{ $ornDir }}/mandala-emblem.svg" alt="Emblem" class="w-6 h-6 opacity-75"/>
                    </div>
                </div>

                <!-- Two Event Columns side-by-side with Divider (Card 5) -->
                <div class="relative z-10 max-w-sm mx-auto bg-white/85 p-5 rounded-2xl border border-[#C5A059]/30 shadow-sm">
                    <div class="grid grid-cols-2 divide-x divide-[#C5A059]/30 text-center">
                        
                        <!-- 1. AKAD NIKAH -->
                        <div class="px-2 flex flex-col items-center">
                            <!-- Candi Icon -->
                            <div class="w-10 h-10 flex items-center justify-center mb-2">
                                <img src="{{ $ornDir }}/candi-akad.svg" alt="Akad Nikah" class="w-8 h-8"/>
                            </div>
                            <h3 class="font-cinzel text-xs font-bold text-celestial-navy tracking-[0.15em] mb-1">
                                AKAD NIKAH
                            </h3>
                            <p class="text-[10px] font-semibold text-antique-gold font-cinzel tracking-wider mb-1.5">
                                Pukul 08.00 - 09.00 WIB
                            </p>
                            <p class="text-[11px] text-ink-dark font-medium">Ruang Melati</p>
                            <p class="text-[10px] text-ink-muted">Gedung Seruni</p>
                        </div>

                        <!-- 2. RESEPSI -->
                        <div class="px-2 flex flex-col items-center">
                            <!-- Joglo Icon -->
                            <div class="w-10 h-10 flex items-center justify-center mb-2">
                                <img src="{{ $ornDir }}/joglo-resepsi.svg" alt="Resepsi" class="w-8 h-8"/>
                            </div>
                            <h3 class="font-cinzel text-xs font-bold text-celestial-navy tracking-[0.15em] mb-1">
                                RESEPSI
                            </h3>
                            <p class="text-[10px] font-semibold text-antique-gold font-cinzel tracking-wider mb-1.5">
                                Pukul 11.00 - 14.00 WIB
                            </p>
                            <p class="text-[11px] text-ink-dark font-medium">Ruang Angin</p>
                            <p class="text-[10px] text-ink-muted">Gedung Seruni</p>
                        </div>

                    </div>
                </div>

                <!-- Footer Note (Card 5) -->
                <div class="relative z-10 text-center max-w-xs mx-auto mt-6">
                    <p class="text-[11px] text-ink-muted italic leading-relaxed font-light">
                        Atas kehadiran dan doa restu Bapak/Ibu/Saudara/i kami ucapkan terima kasih.
                    </p>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 6. HALAMAN LOKASI (CARD 6: LOKASI)         -->
            <!-- ========================================== -->
            <section class="relative px-5 py-12 overflow-hidden border-b border-[#E8DEC8] bg-[#FAF7F0] text-center">
                <!-- Section Header (Card 6) -->
                <div class="relative z-10 max-w-sm mx-auto mb-5">
                    <h2 class="font-serif text-3xl font-normal italic text-celestial-navy tracking-wide mb-1">
                        Lokasi Acara
                    </h2>
                    <div class="w-10 h-[1px] bg-[#C5A059] mx-auto mt-1.5"></div>
                </div>

                <!-- Illustrated Vector Map Container (Card 6) -->
                <div class="relative z-10 max-w-sm mx-auto bg-white rounded-2xl p-3 border border-[#C5A059]/35 shadow-md">
                    <!-- Map Graphic -->
                    <div class="relative rounded-xl overflow-hidden border border-[#E8DEC8]">
                        <img src="{{ $imgDir }}/vector-wedding-map.jpg" alt="Peta Lokasi Gedung Seruni" class="w-full h-auto object-cover"/>
                        
                        <!-- Location Overlay Tag -->
                        <div class="p-2.5 bg-[#FAF7F0]/95 border-t border-[#E8DEC8] text-left">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-antique-gold shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                <div>
                                    <h4 class="font-cinzel text-xs font-bold text-celestial-navy tracking-wider">GEDUNG SERUNI</h4>
                                    <p class="text-[10px] text-ink-muted">Jl. Angin Sejahtera No. 12, Yogyakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action & QR Code (Card 6) -->
                    <div class="mt-3.5 pt-2.5 border-t border-[#E8DEC8] flex items-center justify-between px-1">
                        <!-- QR Code -->
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-white p-1 rounded-lg border border-[#C5A059]/40 shadow-sm flex items-center justify-center">
                                <svg class="w-8 h-8 text-celestial-navy" fill="currentColor" viewBox="0 0 24 24"><path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm10-2h8v8h-8V2zm2 2v4h4V4h-4zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm10 0h2v2h-2v-2zm4 0h2v2h-2v-2zm-4 4h2v2h-2v-2zm4 0h2v2h-2v-2zm2-2h2v2h-2v-2zm0-4h2v2h-2v-2zM5 5h2v2H5V5zm12 0h2v2h-2V5zM5 17h2v2H5v-2z"/></svg>
                            </div>
                            <div class="text-left">
                                <p class="text-[9px] font-cinzel uppercase tracking-wider text-celestial-blue font-bold">SCAN LOKASI</p>
                                <p class="text-[10px] text-ink-muted">Google Maps</p>
                            </div>
                        </div>

                        <!-- Direct Navigation Button -->
                        <a href="{{ $event['maps_url'] }}" target="_blank" class="px-3.5 py-1.5 bg-celestial-slate hover:bg-celestial-navy text-white text-[10px] font-cinzel font-semibold tracking-wider rounded-lg shadow transition-all">
                            Buka Maps
                        </a>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 7. HALAMAN UCAPAN / RSVP (CARD 7: RSVP)    -->
            <!-- ========================================== -->
            <section class="relative px-5 py-12 overflow-hidden border-b border-[#E8DEC8] bg-gradient-to-b from-[#FAF7F0] via-[#F4ECE3] to-[#FAF7F0]">
                <!-- Header (Card 7) -->
                <div class="relative z-10 text-center max-w-sm mx-auto mb-5">
                    <h2 class="font-serif text-3xl font-normal italic text-celestial-navy tracking-wide mb-1">
                        Ucapan &amp; Doa
                    </h2>
                    <p class="text-xs text-ink-muted font-light">
                        Berikan ucapan dan doa terbaik untuk perjalanan hidup kami ke depan.
                    </p>
                </div>

                <!-- RSVP & Comment Form (Card 7) -->
                <div class="relative z-10 max-w-sm mx-auto bg-white/95 p-4 rounded-2xl border border-[#C5A059]/30 shadow-sm">
                    <form id="wishes-form" class="space-y-3" onsubmit="handleWishesSubmit(event)">
                        <div>
                            <input type="text" id="wisher-name" placeholder="Nama Anda" value="{{ $guestName !== 'Tamu Undangan' ? $guestName : '' }}" required class="w-full px-3 py-2 text-xs bg-[#FAF7F0] border border-[#C5A059]/30 rounded-xl focus:outline-none focus:border-antique-gold transition-colors text-ink-dark placeholder:text-gray-400"/>
                        </div>
                        <div>
                            <textarea id="wisher-message" rows="3" placeholder="Tuliskan ucapan dan doa restu Anda..." required class="w-full px-3 py-2 text-xs bg-[#FAF7F0] border border-[#C5A059]/30 rounded-xl focus:outline-none focus:border-antique-gold transition-colors text-ink-dark placeholder:text-gray-400"></textarea>
                        </div>

                        <!-- Divider -->
                        <div class="flex items-center justify-center gap-2 pt-1">
                            <span class="h-[1px] w-8 bg-[#C5A059]/30"></span>
                            <img src="{{ $ornDir }}/mandala-emblem.svg" alt="Emblem" class="w-4 h-4 opacity-60"/>
                            <span class="h-[1px] w-8 bg-[#C5A059]/30"></span>
                        </div>

                        <!-- Kehadiran Anda Subtitle (Card 7) -->
                        <div class="text-center pt-0.5">
                            <h4 class="font-serif text-base font-bold text-celestial-navy">Kehadiran Anda</h4>
                            <p class="text-[10px] text-ink-muted font-light">Mohon konfirmasi kehadiran melalui form berikut:</p>
                        </div>

                        <!-- Buttons [ HADIR ] & [ TIDAK HADIR ] (Card 7) -->
                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <button type="button" onclick="selectRsvp('Hadir')" id="btn-rsvp-hadir" class="py-2 px-3 bg-celestial-slate text-white text-xs font-cinzel font-semibold tracking-wider rounded-xl shadow transition-all border border-celestial-slate">
                                HADIR
                            </button>
                            <button type="button" onclick="selectRsvp('Tidak Hadir')" id="btn-rsvp-tidak" class="py-2 px-3 bg-[#FAF7F0] text-celestial-navy text-xs font-cinzel font-semibold tracking-wider rounded-xl border border-[#C5A059]/40 hover:bg-[#F0EAE0] transition-all">
                                TIDAK HADIR
                            </button>
                        </div>
                        <input type="hidden" id="rsvp-status" value="Hadir"/>

                        <button type="submit" class="w-full mt-1.5 py-2.5 bg-gradient-to-r from-[#C5A059] to-[#DFBF77] text-celestial-navy font-cinzel text-xs font-bold tracking-[0.15em] rounded-xl shadow-md hover:brightness-105 active:scale-95 transition-all">
                            KIRIM UCAPAN &amp; KONFIRMASI
                        </button>
                    </form>

                    <!-- Wishes List Container -->
                    <div class="mt-5 pt-4 border-t border-[#E8DEC8]">
                        <h4 class="font-cinzel text-[11px] uppercase tracking-wider text-celestial-navy font-bold text-center mb-2.5">
                            Doa Restu Sahabat &amp; Keluarga
                        </h4>
                        <div id="wishes-list" class="space-y-2.5 max-h-52 overflow-y-auto pr-1">
                            @foreach($wishes as $wish)
                            <div class="p-2.5 bg-[#FAF7F0] rounded-xl border border-[#C5A059]/20 text-left">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="font-serif font-bold text-xs text-celestial-navy">{{ $wish['name'] }}</span>
                                    <span class="text-[9px] font-cinzel px-2 py-0.5 rounded-full {{ $wish['status'] === 'Hadir' ? 'bg-celestial-slate text-white' : 'bg-gray-200 text-gray-700' }}">{{ $wish['status'] }}</span>
                                </div>
                                <p class="text-[11px] text-ink-dark leading-relaxed">{{ $wish['message'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- TANDA KASIH DIGITAL (GIFT SECTION) -->
                <div class="relative z-10 max-w-sm mx-auto mt-5">
                    <div class="bg-white/80 rounded-2xl p-4 border border-[#C5A059]/30 text-center">
                        <h4 class="font-serif text-lg font-bold text-celestial-navy mb-1">Tanda Kasih</h4>
                        <p class="text-[10px] text-ink-muted mb-3 font-light">Doa restu Anda merupakan karunia terindah bagi kami. Bagi yang berkenan memberikan tanda kasih:</p>
                        
                        <div class="space-y-2">
                            @foreach($gifts as $gift)
                            <div class="p-2.5 bg-[#FAF7F0] rounded-xl border border-[#C5A059]/25 flex items-center justify-between">
                                <div class="text-left">
                                    <p class="text-[10px] font-cinzel font-bold text-celestial-navy">{{ $gift['bank'] }}</p>
                                    <p class="font-mono text-xs text-antique-gold font-bold tracking-wider" id="acc-{{ $loop->index }}">{{ $gift['account'] }}</p>
                                    <p class="text-[9px] text-ink-muted">a.n {{ $gift['name'] }}</p>
                                </div>
                                <button onclick="copyToClipboard('{{ $gift['account'] }}', this)" class="px-2.5 py-1 bg-white border border-[#C5A059]/40 hover:bg-[#FAF7F0] text-celestial-navy text-[9px] font-cinzel font-semibold rounded-lg shadow-sm transition-all">
                                    Salin
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================== -->
            <!-- 8. HALAMAN PENUTUP (CARD 8: PENUTUP)       -->
            <!-- ========================================== -->
            <section class="relative px-6 py-14 overflow-hidden text-center bg-[#1C2C39] text-white">
                <!-- Background Candi Bentar Landscape (Card 8) -->
                <div class="absolute inset-0 z-0 opacity-45 pointer-events-none">
                    <img src="{{ $imgDir }}/candi-bentar-bg.jpg" alt="Penutup Negara Angin" class="w-full h-full object-cover object-center filter brightness-[0.8] contrast-[1.1]"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#182733] via-transparent to-[#182733]/80"></div>
                </div>

                <!-- Center Scalloped Arch Framing (Card 8) -->
                <div class="relative z-10 max-w-xs mx-auto p-7 rounded-[150px_150px_16px_16px] border border-[#C5A059]/50 bg-[#1C2C39]/75 backdrop-blur-md shadow-2xl">
                    
                    <!-- Mandala Top -->
                    <div class="flex justify-center mb-3">
                        <img src="{{ $ornDir }}/mandala-emblem.svg" alt="Emblem" class="w-7 h-7 opacity-90 filter drop-shadow"/>
                    </div>

                    <!-- Terima Kasih (Card 8) -->
                    <h2 class="font-serif text-3xl sm:text-4xl font-normal italic gold-gradient-text tracking-wide mb-1.5 drop-shadow">
                        Terima Kasih
                    </h2>

                    <!-- ATAS DOA DAN KEHADIRAN ANDA (Card 8) -->
                    <p class="font-cinzel text-[10px] uppercase tracking-[0.25em] text-[#EBE3D5] opacity-90 mb-5 font-medium">
                        ATAS DOA DAN KEHADIRAN ANDA
                    </p>

                    <div class="w-12 h-[1px] bg-[#C5A059]/60 mx-auto mb-5"></div>

                    <!-- Couple Names -->
                    <p class="font-serif text-xl sm:text-2xl font-bold tracking-wide text-white drop-shadow">
                        {{ $couple['bride_full'] }} &amp; {{ $couple['groom_full'] }}
                    </p>
                    <p class="text-[10px] text-[#DFBF77] font-cinzel mt-1 tracking-widest font-light">
                        BESERTA KELUARGA BESAR
                    </p>
                </div>

                <!-- Copyright / Temuruang branding -->
                <div class="relative z-10 mt-8 text-center">
                    <p class="text-[9px] text-gray-400 font-cinzel tracking-widest uppercase">
                        Digital Wedding Invitation by <a href="https://temuruang.com" target="_blank" class="text-[#DFBF77] hover:underline">Temuruang.com</a>
                    </p>
                </div>
            </section>

        </main>
    </div>

    <!-- ========================================== -->
    <!-- JAVASCRIPT LOGIC                          -->
    <!-- ========================================== -->
    <script>
        // 1. OPEN INVITATION & PLAY AUDIO
        const btnOpen = document.getElementById('btn-open-invitation');
        const coverScreen = document.getElementById('cover-screen');
        const audioPill = document.getElementById('audio-pill');
        const bgAudio = document.getElementById('bg-audio');
        const btnToggleMusic = document.getElementById('btn-toggle-music');
        const iconMusicOn = document.getElementById('icon-music-on');
        const iconMusicOff = document.getElementById('icon-music-off');

        btnOpen.addEventListener('click', function() {
            coverScreen.style.transform = 'translateY(-100%)';
            audioPill.classList.remove('hidden');

            if (bgAudio) {
                bgAudio.play().then(() => {
                    iconMusicOn.classList.remove('hidden');
                    iconMusicOff.classList.add('hidden');
                }).catch(e => {
                    console.log('Audio autoplay prevented:', e);
                });
            }

            setTimeout(() => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 300);
        });

        // 2. TOGGLE MUSIC
        btnToggleMusic.addEventListener('click', function() {
            if (bgAudio.paused) {
                bgAudio.play();
                iconMusicOn.classList.remove('hidden');
                iconMusicOff.classList.add('hidden');
            } else {
                bgAudio.pause();
                iconMusicOn.classList.add('hidden');
                iconMusicOff.classList.remove('hidden');
            }
        });

        // 3. LIVE COUNTDOWN TIMER (Target: 21 Desember 2026 08:00 WIB)
        const targetDate = new Date('2026-12-21T08:00:00+07:00').getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                document.getElementById('cd-days').innerText = '00';
                document.getElementById('cd-hours').innerText = '00';
                document.getElementById('cd-minutes').innerText = '00';
                document.getElementById('cd-seconds').innerText = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('cd-days').innerText = String(days).padStart(2, '0');
            document.getElementById('cd-hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('cd-minutes').innerText = String(minutes).padStart(2, '0');
            document.getElementById('cd-seconds').innerText = String(seconds).padStart(2, '0');
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();

        // 4. RSVP BUTTONS TOGGLE
        function selectRsvp(status) {
            document.getElementById('rsvp-status').value = status;
            const btnHadir = document.getElementById('btn-rsvp-hadir');
            const btnTidak = document.getElementById('btn-rsvp-tidak');

            if (status === 'Hadir') {
                btnHadir.className = "py-2 px-3 bg-celestial-slate text-white text-xs font-cinzel font-semibold tracking-wider rounded-xl shadow transition-all border border-celestial-slate";
                btnTidak.className = "py-2 px-3 bg-[#FAF7F0] text-celestial-navy text-xs font-cinzel font-semibold tracking-wider rounded-xl border border-[#C5A059]/40 hover:bg-[#F0EAE0] transition-all";
            } else {
                btnTidak.className = "py-2 px-3 bg-celestial-slate text-white text-xs font-cinzel font-semibold tracking-wider rounded-xl shadow transition-all border border-celestial-slate";
                btnHadir.className = "py-2 px-3 bg-[#FAF7F0] text-celestial-navy text-xs font-cinzel font-semibold tracking-wider rounded-xl border border-[#C5A059]/40 hover:bg-[#F0EAE0] transition-all";
            }
        }

        // 5. WISHES FORM SUBMISSION
        function handleWishesSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('wisher-name').value.trim();
            const message = document.getElementById('wisher-message').value.trim();
            const status = document.getElementById('rsvp-status').value;

            if (!name || !message) return;

            const wishesList = document.getElementById('wishes-list');
            const newCard = document.createElement('div');
            newCard.className = "p-2.5 bg-[#FAF7F0] rounded-xl border border-[#C5A059]/20 text-left";
            newCard.innerHTML = `
                <div class="flex items-center justify-between mb-1">
                    <span class="font-serif font-bold text-xs text-celestial-navy">${name}</span>
                    <span class="text-[9px] font-cinzel px-2 py-0.5 rounded-full ${status === 'Hadir' ? 'bg-celestial-slate text-white' : 'bg-gray-200 text-gray-700'}">${status}</span>
                </div>
                <p class="text-[11px] text-ink-dark leading-relaxed">${message}</p>
            `;
            wishesList.prepend(newCard);

            document.getElementById('wisher-message').value = '';
            alert('Terima kasih! Ucapan & konfirmasi kehadiran Anda telah tersimpan.');
        }

        // 6. COPY TO CLIPBOARD
        function copyToClipboard(text, btn) {
            navigator.clipboard.writeText(text).then(() => {
                const orig = btn.innerText;
                btn.innerText = "Tersalin!";
                btn.classList.add('bg-green-100', 'text-green-800');
                setTimeout(() => {
                    btn.innerText = orig;
                    btn.classList.remove('bg-green-100', 'text-green-800');
                }, 2000);
            }).catch(err => {
                alert('Nomor rekening: ' + text);
            });
        }
    </script>
</body>
</html>
