@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Prabu Dananjaya');
        $brideName = trim($names[1] ?? 'Sekar Larasati');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'groom_full' => $invitation->groom_name ?? 'Prabu Dananjaya, S.T.',
            'bride_full' => $invitation->bride_name ?? 'Sekar Larasati, S.Ked.',
            'parents' => [
                'groom' => $invitation->groom_parents ?? 'Putra pertama Bpk. H. Cecep Gunawan & Ibu Hj. Neneng Sartika',
                'bride' => $invitation->bride_parents ?? 'Putri kedua Bpk. Ir. H. Deden Suryatna & Ibu Hj. Elis Rohaeti',
            ],
            'instagram' => [
                'groom' => $invitation->groom_instagram ?? 'prabudananjaya',
                'bride' => $invitation->bride_instagram ?? 'sekarlarasati',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2027-08-22',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Puri Parahyangan Grand Ballroom',
            'address' => $invitation->address ?? 'Jl. Dago Giri No. 88, Dago, Bandung, Jawa Barat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Puri Parahyangan Bandung'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah & Upacara Adat',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => 'Sungkeman, Sawer Panganten, Meuleum Harupat & Nincak Endog',
                'venue' => $event['location']
            ],
            [
                'title' => 'Resepsi Pawiwahan Ageng',
                'time' => '11:00 - 14:00 WIB',
                'note' => 'Kliningan Sunda, Kacapi Suling & Ramah Tamah Prasmanan',
                'venue' => $event['location']
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
                ['title' => 'Patepang Munggaran', 'date' => 'Maret 2022', 'text' => 'Dina hawa tiis kota Bandung Parahyangan, takdir maparin lolongkrang pikeun patepang. Tina sawala leutik, mekar rasa asih anu suci.'],
                ['title' => 'Neundeun Omong & Lamaran', 'date' => 'Januari 2025', 'text' => 'Kulawarga ageung ngariung dina suasana pinuh kabagjaan, nali jangji suci pageuh kancing carita mulia.'],
                ['title' => 'Daup Pawiwahan', 'date' => 'Agustus 2027', 'text' => 'Kersaning Gusti Nu Maha Suci, dua manah dihijikeun dina beungkeutan suci ijab qabul nu sakral salalawasna.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-34/images/gallery-1.jpg'),
                asset('assets/templates/wedding-34/images/gallery-2.jpg'),
                asset('assets/templates/wedding-34/images/gallery-3.jpg'),
                asset('assets/templates/wedding-34/images/gallery-4.jpg'),
                asset('assets/templates/wedding-34/images/gallery-5.jpg'),
                asset('assets/templates/wedding-34/images/gallery-6.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-34/images/sunda-couple-arch.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-34/images/sunda-couple-full.jpg'),
            'groom' => asset('assets/templates/wedding-34/images/sunda-groom.jpg'),
            'bride' => asset('assets/templates/wedding-34/images/sunda-bride.jpg'),
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
                ['name' => 'Kang Asep & Teh Yayu', 'status' => 'Hadir', 'message' => 'Wilujeng ngambah sagara rumah tangga kanggo Prabu & Sekar. Mugi runtut raut sauyunan, repeh rapih, ayem tengtrem lahir batin.'],
                ['name' => 'Keluarga Bpk. H. Rahmat Hidayat', 'status' => 'Hadir', 'message' => 'Barakallahu lakum wa baraka alaikum. Selamat menempuh hidup baru, semoga menjadi keluarga sakinah mawaddah warahmah.'],
                ['name' => 'Dini Nurul & Rekan Kampus', 'status' => 'Hadir', 'message' => 'Geulis pisan Teh Sekar nganggo siger Sunda! Samawa dugi ka pakena pakena, bahagia selalu ya berdua!'],
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
                ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Prabu Dananjaya', 'account' => '7730-8912-44'],
                ['bank' => 'Bank Mandiri', 'name' => 'Sekar Larasati', 'account' => '131-00-6729184-1'],
            ];
        }

        $musicUrl = asset('musics/sunda-music.mp3');
    } else {
        // Fallback dummy data for preview
        $couple = [
            'groom' => 'Prabu Dananjaya',
            'bride' => 'Sekar Larasati',
            'groom_full' => 'Prabu Dananjaya, S.T.',
            'bride_full' => 'Sekar Larasati, S.Ked.',
            'parents' => [
                'groom' => 'Putra pertama Bpk. H. Cecep Gunawan & Ibu Hj. Neneng Sartika',
                'bride' => 'Putri kedua Bpk. Ir. H. Deden Suryatna & Ibu Hj. Elis Rohaeti',
            ],
            'instagram' => [
                'groom' => 'prabudananjaya',
                'bride' => 'sekarlarasati'
            ]
        ];

        $event = [
            'date_iso' => '2027-08-22',
            'time' => '08:00',
            'location' => 'Puri Parahyangan Grand Ballroom',
            'address' => 'Jl. Dago Giri No. 88, Dago, Bandung, Jawa Barat',
            'maps_url' => 'https://maps.google.com/?q=Puri+Parahyangan+Bandung',
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah & Upacara Adat',
                'time' => '08:00 - 10:00 WIB',
                'note' => 'Sungkeman, Sawer Panganten, Meuleum Harupat & Nincak Endog',
                'venue' => 'Puri Parahyangan Grand Ballroom'
            ],
            [
                'title' => 'Resepsi Pawiwahan Ageng',
                'time' => '11:00 - 14:00 WIB',
                'note' => 'Kliningan Sunda, Kacapi Suling & Ramah Tamah Prasmanan',
                'venue' => 'Puri Parahyangan Grand Ballroom'
            ]
        ];

        $stories = [
            ['title' => 'Patepang Munggaran', 'date' => 'Maret 2022', 'text' => 'Dina hawa tiis kota Bandung Parahyangan, takdir maparin lolongkrang pikeun patepang. Tina sawala leutik, mekar rasa asih anu suci.'],
            ['title' => 'Neundeun Omong & Lamaran', 'date' => 'Januari 2025', 'text' => 'Kulawarga ageung ngariung dina suasana pinuh kabagjaan, nali jangji suci pageuh kancing carita mulia.'],
            ['title' => 'Daup Pawiwahan', 'date' => 'Agustus 2027', 'text' => 'Kersaning Gusti Nu Maha Suci, dua manah dihijikeun dina beungkeutan suci ijab qabul nu sakral salalawasna.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-34/images/gallery-1.jpg'),
            asset('assets/templates/wedding-34/images/gallery-2.jpg'),
            asset('assets/templates/wedding-34/images/gallery-3.jpg'),
            asset('assets/templates/wedding-34/images/gallery-4.jpg'),
            asset('assets/templates/wedding-34/images/gallery-5.jpg'),
            asset('assets/templates/wedding-34/images/gallery-6.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-34/images/sunda-couple-arch.jpg'),
            'hero' => asset('assets/templates/wedding-34/images/sunda-couple-full.jpg'),
            'groom' => asset('assets/templates/wedding-34/images/sunda-groom.jpg'),
            'bride' => asset('assets/templates/wedding-34/images/sunda-bride.jpg'),
        ];

        $wishes = [
            ['name' => 'Kang Asep & Teh Yayu', 'status' => 'Hadir', 'message' => 'Wilujeng ngambah sagara rumah tangga kanggo Prabu & Sekar. Mugi runtut raut sauyunan, repeh rapih, ayem tengtrem lahir batin.'],
            ['name' => 'Keluarga Bpk. H. Rahmat Hidayat', 'status' => 'Hadir', 'message' => 'Barakallahu lakum wa baraka alaikum. Selamat menempuh hidup baru, semoga menjadi keluarga sakinah mawaddah warahmah.'],
            ['name' => 'Dini Nurul & Rekan Kampus', 'status' => 'Hadir', 'message' => 'Geulis pisan Teh Sekar nganggo siger Sunda! Samawa dugi ka pakena pakena, bahagia selalu ya berdua!'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Prabu Dananjaya', 'account' => '7730-8912-44'],
            ['bank' => 'Bank Mandiri', 'name' => 'Sekar Larasati', 'account' => '131-00-6729184-1'],
        ];

        $musicUrl = asset('musics/sunda-music.mp3');
    }

    $imgDir = asset('assets/templates/wedding-34/images');
    $ornDir = asset('assets/templates/wedding-34/ornaments');
    
    // Explicit Indonesian Date Localization
    $daysMap = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
    ];
    $monthsMap = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $dateObj = \Carbon\Carbon::parse($event['date_iso']);
    $dayName = $daysMap[$dateObj->format('l')] ?? 'Minggu';
    $monthName = $monthsMap[(int)$dateObj->format('n')] ?? 'Agustus';
    $formattedDate = $dayName . ', ' . $dateObj->format('d') . ' ' . $monthName . ' ' . $dateObj->format('Y');
    $guestName = request('to', 'Tamu Undangan');
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Pawiwahan Adat Sunda: {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>

    <!-- Google Fonts: Cormorant Garamond, Cinzel, Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sage: {
                            50: '#F6F9F7',
                            100: '#EBF1EC',
                            200: '#D5E3D8',
                            300: '#B8CFC0',
                            400: '#8FAFA0',
                            500: '#698E7B',
                            600: '#4E725F',
                            700: '#3A5747',
                            800: '#2A4034',
                            900: '#1C2C23',
                        },
                        ivory: {
                            50: '#FDFBF7',
                            100: '#F9F6F0',
                            200: '#F2EDE2',
                            300: '#E8E0D1',
                        },
                        gold: {
                            light: '#EEDB9F',
                            base: '#C5A059',
                            dark: '#937435',
                        },
                        ink: {
                            dark: '#1D2A22',
                            muted: '#586A5F',
                            light: '#82948A',
                        }
                    },
                    fontFamily: {
                        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                        cinzel: ['"Cinzel"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        };
    </script>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            background-color: #DDE5E0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1D2A22;
            -webkit-font-smoothing: antialiased;
        }

        .mobile-canvas {
            max-width: 440px;
            margin: 0 auto;
            min-height: 100vh;
            background: #FDFBF7;
            position: relative;
            box-shadow: 0 10px 40px rgba(28, 44, 35, 0.18);
            overflow-x: hidden;
        }

        /* Subtle Arch Top for Cards */
        .arch-top {
            border-radius: 160px 160px 16px 16px;
        }

        /* Cover Curtain Transition */
        #coverOverlay {
            transition: transform 0.9s cubic-bezier(0.77, 0, 0.175, 1);
        }
        #coverOverlay.cover-open {
            transform: translateY(-100%);
            pointer-events: none;
        }

        /* Clean gold accent line */
        .gold-line {
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, #C5A059 50%, transparent 100%);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
        }
        ::-webkit-scrollbar-track {
            background: #F2EDE2;
        }
        ::-webkit-scrollbar-thumb {
            background: #698E7B;
            border-radius: 2px;
        }
    </style>
</head>
<body class="bg-[#DDE5E0] text-ink-dark selection:bg-sage-200 selection:text-sage-900">

<!-- Audio Element -->
<audio id="bgMusic" loop preload="auto" src="{{ $musicUrl }}"></audio>

<!-- Floating Audio Toggle Button -->
<div id="audioPill" class="fixed top-4 right-4 z-40 hidden max-w-[440px]">
    <button id="musicToggleBtn" type="button" onclick="toggleSundaMusic()" aria-label="Toggle Music" class="w-10 h-10 rounded-full bg-white/90 backdrop-blur-md border border-sage-300 text-sage-800 shadow-md flex items-center justify-center hover:scale-105 active:scale-95 transition">
        <svg id="musicIconOn" class="w-4 h-4 animate-spin" style="animation-duration: 4s;" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
        </svg>
        <svg id="musicIconOff" class="w-4 h-4 hidden text-gray-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l4.27 4.27c-.24.16-.51.28-.8.36L20.73 21 22 19.73 4.27 3zM12 7h4V3h-6v5.18l2 2V7z"/>
        </svg>
    </button>
</div>

<!-- Mobile Canvas Container (Max-Width 440px) -->
<div class="mobile-canvas relative">

    <!-- =================================================================
         1. COVER SCREEN: CLEAN & AESTHETIC SUNDA LUXURY
         ================================================================= -->
    <div id="coverOverlay" class="fixed inset-0 z-50 mx-auto w-full max-w-[440px] h-full overflow-hidden flex flex-col justify-between items-center px-6 py-8 bg-[#F8FAF7] shadow-2xl">
        
        <!-- Subtle Top Heritage Crest -->
        <div class="relative z-10 flex flex-col items-center text-center pt-2">
            <!-- Delicate Siger Sunda Emblem -->
            <div class="w-14 h-14 mb-2 opacity-90">
                <img alt="Mahkota Siger Sunda" class="w-full h-full object-contain filter drop-shadow-sm" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>

            <p class="font-cinzel text-[10px] font-semibold uppercase tracking-[0.3em] text-sage-600">
                Pawiwahan Adat Sunda
            </p>
            <div class="gold-line w-24 my-2"></div>
        </div>

        <!-- Center Couple Portrait in Elegant Soft Arch Frame -->
        <div class="relative z-10 my-auto py-2 flex flex-col items-center">
            <!-- Arched Photo -->
            <div class="relative p-1.5 rounded-t-[140px] rounded-b-2xl bg-white border border-sage-200 shadow-md">
                <div class="relative w-[210px] h-[280px] rounded-t-[132px] rounded-b-xl overflow-hidden bg-sage-100">
                    <img alt="Panganten Sunda" class="w-full h-full object-cover object-center filter brightness-[1.02]" src="{{ $bg['cover'] }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent pointer-events-none"></div>
                </div>
            </div>

            <!-- Couple Names in Editorial Serif -->
            <div class="text-center mt-4">
                <h1 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide leading-tight">
                    {{ $couple['groom'] }}
                </h1>
                <p class="font-serif italic text-xl text-gold-base my-0.5">&amp;</p>
                <h1 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide leading-tight">
                    {{ $couple['bride'] }}
                </h1>
            </div>

            <!-- Date -->
            <p class="font-cinzel text-[11px] uppercase tracking-[0.25em] text-sage-600 mt-2">
                {{ $formattedDate }}
            </p>
        </div>

        <!-- Bottom Guest Greeting & Open Button -->
        <div class="relative z-10 w-full flex flex-col items-center text-center pb-2">
            <!-- Guest Badge -->
            <div class="mb-3.5 py-2 px-5 rounded-xl bg-white border border-sage-200 shadow-sm max-w-[280px] w-full">
                <p class="text-[9px] uppercase tracking-wider text-sage-500 font-cinzel">Kahatur Rawuh Bapa/Ibu/Saderek:</p>
                <p class="font-serif font-bold text-base text-sage-900 truncate mt-0.5">{{ $guestName }}</p>
            </div>

            <!-- Clean Refined Open Button -->
            <button id="openInvitationBtn"
                    type="button"
                    onclick="openSundaInvitation()"
                    class="group relative inline-flex items-center justify-center gap-2 w-full max-w-[260px] py-3 px-6 rounded-full bg-sage-800 hover:bg-sage-900 text-ivory-50 font-cinzel font-semibold text-xs tracking-[0.2em] uppercase shadow-md active:scale-95 transition-all">
                <svg class="w-4 h-4 text-gold-light group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19V5l12-3v16l-12-3zm12-9l6-2v8l-6-2"/>
                </svg>
                <span>Buka Undangan</span>
            </button>
        </div>
    </div>

    <!-- =================================================================
         2. HERO SECTION: PANGANTEN & COUNTDOWN
         ================================================================= -->
    <section class="relative pt-12 pb-16 px-6 bg-gradient-to-b from-[#F8FAF7] via-white to-[#F8FAF7] border-b border-sage-100 text-center">
        <!-- Top Small Insignia -->
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 opacity-85">
                <img alt="Kujang Pasundan" class="w-full h-full object-contain" src="{{ $ornDir }}/sunda-kujang-gold.png"/>
            </div>
        </div>

        <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-sage-600 font-medium mb-1">
            Pangbagéa Pawiwahan
        </p>
        <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-4">
            {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
        </h2>

        <!-- Greenhouse Pre-wedding Portrait -->
        <div class="relative max-w-[340px] mx-auto rounded-2xl overflow-hidden p-1.5 bg-white border border-sage-200 shadow-md mb-6">
            <div class="relative w-full h-[320px] rounded-xl overflow-hidden">
                <img alt="{{ $couple['groom'] }} & {{ $couple['bride'] }}" class="w-full h-full object-cover object-center" src="{{ $bg['hero'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                <div class="absolute bottom-3 inset-x-3 text-center text-white pointer-events-none">
                    <p class="font-serif text-lg font-bold drop-shadow">{{ $formattedDate }}</p>
                    <p class="text-xs text-white/90 drop-shadow mt-0.5">{{ $event['location'] }}</p>
                </div>
            </div>
        </div>

        <!-- Live Countdown Timer -->
        <div class="max-w-[340px] mx-auto">
            <p class="font-cinzel text-[10px] uppercase tracking-[0.2em] text-sage-600 font-semibold mb-3">
                Ngetang Wanci Bahagia
            </p>
            <div class="grid grid-cols-4 gap-2">
                <div class="p-2.5 bg-white rounded-xl border border-sage-200 shadow-sm">
                    <span id="cd-days" class="block font-serif text-xl sm:text-2xl font-bold text-sage-900">00</span>
                    <span class="block text-[9px] font-cinzel uppercase tracking-wider text-sage-600 font-medium mt-0.5">Dinten</span>
                </div>
                <div class="p-2.5 bg-white rounded-xl border border-sage-200 shadow-sm">
                    <span id="cd-hours" class="block font-serif text-xl sm:text-2xl font-bold text-sage-900">00</span>
                    <span class="block text-[9px] font-cinzel uppercase tracking-wider text-sage-600 font-medium mt-0.5">Jam</span>
                </div>
                <div class="p-2.5 bg-white rounded-xl border border-sage-200 shadow-sm">
                    <span id="cd-mins" class="block font-serif text-xl sm:text-2xl font-bold text-sage-900">00</span>
                    <span class="block text-[9px] font-cinzel uppercase tracking-wider text-sage-600 font-medium mt-0.5">Menit</span>
                </div>
                <div class="p-2.5 bg-white rounded-xl border border-sage-200 shadow-sm">
                    <span id="cd-secs" class="block font-serif text-xl sm:text-2xl font-bold text-sage-900">00</span>
                    <span class="block text-[9px] font-cinzel uppercase tracking-wider text-sage-600 font-medium mt-0.5">Detik</span>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================================
         3. QUOTE SECTION: PANGGEUING ASIH
         ================================================================= -->
    <section class="relative py-14 px-6 bg-[#FDFBF7] text-center border-b border-sage-100">
        <div class="max-w-sm mx-auto p-6 rounded-2xl bg-white border border-sage-200 shadow-sm">
            <!-- Small Siger Crown -->
            <div class="w-10 h-10 mx-auto mb-3 opacity-80">
                <img alt="Siger Sunda" class="w-full h-full object-contain" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>

            <p class="font-serif italic text-base leading-relaxed text-sage-900 mb-4">
                "Mugia Gusti Nu Maha Suci maparin barokah, ngahijikeun dua manah dina lambang asih sajati, runtut raut sauyunan sabobot sapihanean dugi ka pakena-pakena."
            </p>

            <div class="gold-line w-20 mx-auto my-3"></div>

            <p class="text-xs leading-relaxed text-ink-muted font-light mb-4">
                "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
            </p>

            <span class="inline-block px-3 py-1 rounded-full bg-sage-50 border border-sage-200 text-[10px] font-cinzel font-semibold tracking-wider text-sage-800">
                QS. Ar-Rum : 21
            </span>
        </div>
    </section>

    <!-- =================================================================
         4. COUPLE SECTION: SANG MEMPELAI
         ================================================================= -->
    <section class="relative py-14 px-6 bg-[#F8FAF7] border-b border-sage-100 text-center">
        <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-sage-600 font-medium mb-1">
            Sang Mempelai
        </p>
        <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-8">
            Panganten Pawiwahan
        </h2>

        <div class="max-w-sm mx-auto space-y-6">
            <!-- Groom Card -->
            <div class="p-5 bg-white rounded-2xl border border-sage-200 shadow-sm flex flex-col items-center">
                <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-sage-300 p-0.5 mb-3 shadow-inner">
                    <img alt="{{ $couple['groom_full'] }}" class="w-full h-full object-cover object-top rounded-full" src="{{ $bg['groom'] }}"/>
                </div>
                <h3 class="font-serif text-xl font-bold text-sage-900 tracking-wide">
                    {{ $couple['groom_full'] }}
                </h3>
                <p class="text-xs text-gold-dark font-cinzel font-semibold mt-0.5">Panganten Pameget</p>
                <p class="text-xs text-ink-muted mt-2 font-light max-w-xs leading-relaxed">
                    {{ $couple['parents']['groom'] }}
                </p>
                @if(isset($couple['instagram']['groom']))
                <a href="https://instagram.com/{{ $couple['instagram']['groom'] }}" target="_blank" class="inline-flex items-center gap-1.5 mt-3 text-[11px] font-cinzel text-sage-700 hover:text-sage-900 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>&#64;{{ $couple['instagram']['groom'] }}</span>
                </a>
                @endif
            </div>

            <div class="gold-line w-16 mx-auto"></div>

            <!-- Bride Card -->
            <div class="p-5 bg-white rounded-2xl border border-sage-200 shadow-sm flex flex-col items-center">
                <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-sage-300 p-0.5 mb-3 shadow-inner">
                    <img alt="{{ $couple['bride_full'] }}" class="w-full h-full object-cover object-top rounded-full" src="{{ $bg['bride'] }}"/>
                </div>
                <h3 class="font-serif text-xl font-bold text-sage-900 tracking-wide">
                    {{ $couple['bride_full'] }}
                </h3>
                <p class="text-xs text-gold-dark font-cinzel font-semibold mt-0.5">Panganten Istri</p>
                <p class="text-xs text-ink-muted mt-2 font-light max-w-xs leading-relaxed">
                    {{ $couple['parents']['bride'] }}
                </p>
                @if(isset($couple['instagram']['bride']))
                <a href="https://instagram.com/{{ $couple['instagram']['bride'] }}" target="_blank" class="inline-flex items-center gap-1.5 mt-3 text-[11px] font-cinzel text-sage-700 hover:text-sage-900 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>&#64;{{ $couple['instagram']['bride'] }}</span>
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- =================================================================
         5. EVENT SCHEDULE: RUNTUYAN ACARA
         ================================================================= -->
    <section class="relative py-14 px-6 bg-[#FDFBF7] border-b border-sage-100 text-center">
        <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-sage-600 font-medium mb-1">
            Runtuyan Acara
        </p>
        <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-8">
            Wanci &amp; Tempat
        </h2>

        <div class="max-w-sm mx-auto space-y-4">
            @foreach($schedule as $item)
            <div class="p-5 bg-white rounded-2xl border border-sage-200 shadow-sm text-center">
                <span class="inline-block px-3 py-1 rounded-full bg-sage-50 text-[10px] font-cinzel font-bold tracking-wider text-sage-800 mb-2">
                    {{ $item['time'] }}
                </span>
                <h3 class="font-serif text-xl font-bold text-sage-900 mb-1">
                    {{ $item['title'] }}
                </h3>
                <p class="text-xs text-ink-muted leading-relaxed font-light mb-3">
                    {{ $item['note'] }}
                </p>
                <div class="pt-3 border-t border-sage-100 flex items-center justify-center gap-1.5 text-xs text-sage-700 font-medium">
                    <svg class="w-4 h-4 text-gold-base shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span>{{ $item['venue'] }}</span>
                </div>
            </div>
            @endforeach

            <!-- Action Buttons: Google Maps & Save to Calendar -->
            <div class="pt-3 flex flex-col sm:flex-row gap-2.5 justify-center">
                <a href="{{ $event['maps_url'] }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-sage-800 hover:bg-sage-900 text-white font-cinzel text-xs font-semibold tracking-wider shadow-sm transition-all text-center">
                    Buka Google Maps
                </a>
                <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Pawiwahan Prabu & Sekar') }}&dates=20270822T010000Z/20270822T070000Z&details={{ urlencode('Pawiwahan Adat Sunda Prabu Dananjaya & Sekar Larasati di Puri Parahyangan Grand Ballroom Bandung') }}&location={{ urlencode($event['location'] . ', ' . $event['address']) }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-white border border-sage-300 hover:bg-sage-50 text-sage-800 font-cinzel text-xs font-semibold tracking-wider shadow-sm transition-all text-center">
                    Simpan Kalender
                </a>
            </div>
        </div>
    </section>

    <!-- =================================================================
         6. GALLERY: GALERI PAWIWAHAN
         ================================================================= -->
    <section class="relative py-14 px-5 bg-[#F8FAF7] border-b border-sage-100 text-center">
        <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-sage-600 font-medium mb-1">
            Momen Kabagjaan
        </p>
        <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-6">
            Galeri Pawiwahan
        </h2>

        <div class="grid grid-cols-2 gap-2.5 max-w-sm mx-auto">
            @foreach($gallery as $img)
            <div class="relative rounded-xl overflow-hidden bg-white border border-sage-200 shadow-sm aspect-[4/5] group cursor-pointer" onclick="openLightbox('{{ $img }}')">
                <img alt="Galeri Prabu & Sekar" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $img }}"/>
            </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         7. TANDA KASIH DIGITAL (GIFT ENVELOPE)
         ================================================================= -->
    <section class="relative py-14 px-6 bg-[#FDFBF7] border-b border-sage-100 text-center">
        <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-sage-600 font-medium mb-1">
            Tanda Asih
        </p>
        <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-2">
            Amplop Digital
        </h2>
        <p class="text-xs text-ink-muted font-light max-w-xs mx-auto mb-6">
            Pidu'a restu ti Bapa/Ibu/Saderek mangrupikeun kurnia anu paling utama. Kanggo anu badé ngintun tanda asih:
        </p>

        <div class="max-w-sm mx-auto space-y-3">
            @foreach($gifts as $gift)
            <div class="p-4 bg-white rounded-2xl border border-sage-200 shadow-sm flex items-center justify-between">
                <div class="text-left">
                    <p class="text-xs font-cinzel font-bold text-sage-900">{{ $gift['bank'] }}</p>
                    <p class="font-mono text-sm text-gold-dark font-bold tracking-wider my-0.5">{{ $gift['account'] }}</p>
                    <p class="text-[11px] text-ink-muted">a.n {{ $gift['name'] }}</p>
                </div>
                <button onclick="copyToClipboard('{{ $gift['account'] }}', this)" class="px-3.5 py-1.5 bg-sage-50 border border-sage-300 hover:bg-sage-100 text-sage-800 text-[11px] font-cinzel font-semibold rounded-lg shadow-sm transition-all">
                    Salin
                </button>
            </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         8. WISHES & RSVP: BUKU TAMU
         ================================================================= -->
    <section class="relative py-14 px-6 bg-[#F8FAF7] border-b border-sage-100 text-center">
        <p class="font-cinzel text-xs uppercase tracking-[0.25em] text-sage-600 font-medium mb-1">
            Pangbagéa &amp; Doa
        </p>
        <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-6">
            Buku Tamu &amp; RSVP
        </h2>

        <div class="max-w-sm mx-auto bg-white p-5 rounded-2xl border border-sage-200 shadow-sm">
            <form id="wishes-form" class="space-y-3" onsubmit="handleWishesSubmit(event)">
                <div>
                    <input type="text" id="wisher-name" placeholder="Nami Bapa/Ibu/Saderek" value="{{ $guestName !== 'Tamu Undangan' ? $guestName : '' }}" required class="w-full px-3.5 py-2.5 text-xs bg-sage-50 border border-sage-200 rounded-xl focus:outline-none focus:border-sage-500 text-ink-dark placeholder:text-gray-400 transition-colors"/>
                </div>
                <div>
                    <textarea id="wisher-message" rows="3" placeholder="Seratkeun pangbagéa sareng doa restu..." required class="w-full px-3.5 py-2.5 text-xs bg-sage-50 border border-sage-200 rounded-xl focus:outline-none focus:border-sage-500 text-ink-dark placeholder:text-gray-400 transition-colors"></textarea>
                </div>

                <div class="pt-2 text-center">
                    <p class="text-[11px] font-cinzel font-semibold text-sage-800 mb-2">Konfirmasi Kasumpingan:</p>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" onclick="selectRsvp('Hadir')" id="btn-rsvp-hadir" class="py-2 px-3 bg-sage-800 text-white text-xs font-cinzel font-semibold rounded-xl shadow-sm transition-all border border-sage-800">
                            Hadir
                        </button>
                        <button type="button" onclick="selectRsvp('Henteu Hadir')" id="btn-rsvp-tidak" class="py-2 px-3 bg-white text-sage-800 text-xs font-cinzel font-semibold rounded-xl border border-sage-300 hover:bg-sage-50 transition-all">
                            Henteu Hadir
                        </button>
                    </div>
                    <input type="hidden" id="rsvp-status" value="Hadir"/>
                </div>

                <button type="submit" class="w-full mt-2 py-3 bg-sage-800 hover:bg-sage-900 text-white font-cinzel text-xs font-bold tracking-[0.15em] rounded-xl shadow-md transition-all">
                    Kirim Doa Restu
                </button>
            </form>

            <!-- Wishes Feed -->
            <div class="mt-6 pt-4 border-t border-sage-100 text-left">
                <p class="text-[11px] font-cinzel font-bold text-sage-700 text-center mb-3">Pangbagéa Ti Wargi Sadaya</p>
                <div id="wishes-list" class="space-y-2.5 max-h-52 overflow-y-auto pr-1">
                    @foreach($wishes as $wish)
                    <div class="p-3 bg-sage-50 rounded-xl border border-sage-200">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-serif font-bold text-sm text-sage-900">{{ $wish['name'] }}</span>
                            <span class="text-[9px] font-cinzel px-2 py-0.5 rounded-full {{ $wish['status'] === 'Hadir' ? 'bg-sage-200 text-sage-800' : 'bg-gray-100 text-gray-600' }}">{{ $wish['status'] }}</span>
                        </div>
                        <p class="text-xs text-ink-muted leading-relaxed font-light">{{ $wish['message'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================================
         9. FOOTER: HATUR NUHUN
         ================================================================= -->
    <footer class="relative py-14 px-6 bg-[#FDFBF7] text-center">
        <div class="max-w-xs mx-auto">
            <!-- Small Siger Crown -->
            <div class="w-12 h-12 mx-auto mb-3 opacity-80">
                <img alt="Siger Sunda" class="w-full h-full object-contain" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>

            <h2 class="font-serif text-3xl font-semibold text-sage-900 tracking-wide mb-1">
                Hatur Nuhun
            </h2>
            <p class="text-xs text-ink-muted font-light leading-relaxed mb-4">
                Kana sagala pidu'a sareng perhatosanana, kami ngahaturkeun nuhun anu saageung-ageungna.
            </p>

            <div class="gold-line w-16 mx-auto mb-4"></div>

            <p class="font-serif text-xl font-bold text-sage-900">
                {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
            </p>
            <p class="text-[10px] font-cinzel text-sage-600 tracking-widest mt-0.5">
                KULAWIRGA AGEUNG
            </p>

            <div class="mt-8 pt-4 border-t border-sage-200">
                <p class="text-[9px] text-sage-500 font-cinzel tracking-widest uppercase">
                    Digital Invitation by <a href="https://temuruang.com" target="_blank" class="text-sage-700 font-bold hover:underline">Temuruang.com</a>
                </p>
            </div>
        </div>
    </footer>

</div>

<!-- Lightbox Modal for Gallery -->
<div id="galleryLightbox" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4 cursor-pointer" onclick="closeLightbox()">
    <img id="lightboxImg" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl object-contain"/>
</div>

<!-- =================================================================
     JAVASCRIPT LOGIC
     ================================================================= -->
<script>
    // 1. OPEN INVITATION & AUDIO
    const coverOverlay = document.getElementById('coverOverlay');
    const audioPill = document.getElementById('audioPill');
    const bgMusic = document.getElementById('bgMusic');
    const musicIconOn = document.getElementById('musicIconOn');
    const musicIconOff = document.getElementById('musicIconOff');

    function openSundaInvitation() {
        coverOverlay.classList.add('cover-open');
        audioPill.classList.remove('hidden');

        if (bgMusic) {
            bgMusic.play().then(() => {
                musicIconOn.classList.remove('hidden');
                musicIconOff.classList.add('hidden');
            }).catch(e => {
                console.log('Audio autoplay prevented:', e);
            });
        }

        setTimeout(() => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }, 300);
    }

    // 2. TOGGLE MUSIC
    function toggleSundaMusic() {
        if (!bgMusic) return;
        if (bgMusic.paused) {
            bgMusic.play();
            musicIconOn.classList.remove('hidden');
            musicIconOff.classList.add('hidden');
        } else {
            bgMusic.pause();
            musicIconOn.classList.add('hidden');
            musicIconOff.classList.remove('hidden');
        }
    }

    // 3. COUNTDOWN TIMER (Target: 22 Agustus 2027 08:00 WIB)
    const targetDate = new Date('2027-08-22T08:00:00+07:00').getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            document.getElementById('cd-days').innerText = '00';
            document.getElementById('cd-hours').innerText = '00';
            document.getElementById('cd-mins').innerText = '00';
            document.getElementById('cd-secs').innerText = '00';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('cd-days').innerText = String(days).padStart(2, '0');
        document.getElementById('cd-hours').innerText = String(hours).padStart(2, '0');
        document.getElementById('cd-mins').innerText = String(minutes).padStart(2, '0');
        document.getElementById('cd-secs').innerText = String(seconds).padStart(2, '0');
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();

    // 4. RSVP TOGGLE
    function selectRsvp(status) {
        document.getElementById('rsvp-status').value = status;
        const btnHadir = document.getElementById('btn-rsvp-hadir');
        const btnTidak = document.getElementById('btn-rsvp-tidak');

        if (status === 'Hadir') {
            btnHadir.className = "py-2 px-3 bg-sage-800 text-white text-xs font-cinzel font-semibold rounded-xl shadow-sm transition-all border border-sage-800";
            btnTidak.className = "py-2 px-3 bg-white text-sage-800 text-xs font-cinzel font-semibold rounded-xl border border-sage-300 hover:bg-sage-50 transition-all";
        } else {
            btnTidak.className = "py-2 px-3 bg-sage-800 text-white text-xs font-cinzel font-semibold rounded-xl shadow-sm transition-all border border-sage-800";
            btnHadir.className = "py-2 px-3 bg-white text-sage-800 text-xs font-cinzel font-semibold rounded-xl border border-sage-300 hover:bg-sage-50 transition-all";
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
        const card = document.createElement('div');
        card.className = "p-3 bg-sage-50 rounded-xl border border-sage-200 text-left";
        card.innerHTML = `
            <div class="flex items-center justify-between mb-1">
                <span class="font-serif font-bold text-sm text-sage-900">${name}</span>
                <span class="text-[9px] font-cinzel px-2 py-0.5 rounded-full ${status === 'Hadir' ? 'bg-sage-200 text-sage-800' : 'bg-gray-100 text-gray-600'}">${status}</span>
            </div>
            <p class="text-xs text-ink-muted leading-relaxed font-light">${message}</p>
        `;
        wishesList.prepend(card);

        document.getElementById('wisher-message').value = '';
        alert('Hatur nuhun! Pidu\'a sareng konfirmasi kasumpingan parantos katampi.');
    }

    // 6. COPY TO CLIPBOARD
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const orig = btn.innerText;
            btn.innerText = "Tersalin!";
            btn.classList.add('bg-sage-200', 'text-sage-900');
            setTimeout(() => {
                btn.innerText = orig;
                btn.classList.remove('bg-sage-200', 'text-sage-900');
            }, 2000);
        }).catch(() => {
            alert('Nomer rekening: ' + text);
        });
    }

    // 7. LIGHTBOX
    function openLightbox(url) {
        const lb = document.getElementById('galleryLightbox');
        const img = document.getElementById('lightboxImg');
        img.src = url;
        lb.classList.remove('hidden');
        lb.classList.add('flex');
    }

    function closeLightbox() {
        const lb = document.getElementById('galleryLightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
    }
</script>
</body>
</html>
