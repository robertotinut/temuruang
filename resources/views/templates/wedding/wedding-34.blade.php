@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Prabu Dananjaya');
        $brideName = trim($names[1] ?? 'Sekar Larasati');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Putra pertama Bpk. H. Cecep Gunawan & Ibu Hj. Neneng Sartika',
                'bride' => 'Putri kedua Bpk. Ir. H. Deden Suryatna & Ibu Hj. Elis Rohaeti',
            ],
            'instagram' => [
                'groom' => 'https://instagram.com',
                'bride' => 'https://instagram.com'
            ]
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
                'title' => 'Akad Nikah & Sawer Panganten',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => 'Upacara Adat Sunda (Sungkeman, Sawer, Meuleum Harupat & Nincak Endog)',
                'venue' => $event['location']
            ],
            [
                'title' => 'Resepsi Pawiwahan Ageng',
                'time' => '11:00 - 14:00 WIB',
                'note' => 'Kacapi Suling, Rampak Gendang & Jamuan Prasmanan',
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
                ['title' => 'Patepang Munggaran', 'date' => 'Maret 2022', 'text' => 'Dina hawa tiis kota Parahyangan Bandung, takdir maparin lolongkrang pikeun patepang. Tina sawala leutik, mekar rasa asih anu suci.'],
                ['title' => 'Neundeun Omong & Lamaran', 'date' => 'Januari 2025', 'text' => 'Kulawarga ageung ngariung dina suasana pinuh kabagjaan, nali jangji suci pageuh kancing carita mulia.'],
                ['title' => 'Daup Pawiwahan', 'date' => 'Oktober 2026', 'text' => 'Kersaning Gusti Nu Maha Suci, dua manah dihijikeun dina beungkeutan suci ijab qabul nu sakral salalawasna.'],
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
            'parents' => [
                'groom' => 'Putra pertama Bpk. H. Cecep Gunawan & Ibu Hj. Neneng Sartika',
                'bride' => 'Putri kedua Bpk. Ir. H. Deden Suryatna & Ibu Hj. Elis Rohaeti',
            ],
            'instagram' => [
                'groom' => 'https://instagram.com',
                'bride' => 'https://instagram.com'
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
                'title' => 'Akad Nikah & Sawer Panganten',
                'time' => '08:00 - 10:00 WIB',
                'note' => 'Upacara Adat Sunda (Sungkeman, Sawer, Meuleum Harupat & Nincak Endog)',
                'venue' => 'Puri Parahyangan Grand Ballroom'
            ],
            [
                'title' => 'Resepsi Pawiwahan Ageng',
                'time' => '11:00 - 14:00 WIB',
                'note' => 'Kacapi Suling, Rampak Gendang & Jamuan Prasmanan Parahyangan',
                'venue' => 'Puri Parahyangan Grand Ballroom'
            ]
        ];

        $stories = [
            ['title' => 'Patepang Munggaran', 'date' => 'Maret 2022', 'text' => 'Dina hawa tiis kota Parahyangan Bandung, takdir maparin lolongkrang pikeun patepang. Tina sawala leutik, mekar rasa asih anu suci.'],
            ['title' => 'Neundeun Omong & Lamaran', 'date' => 'Januari 2025', 'text' => 'Kulawarga ageung ngariung dina suasana pinuh kabagjaan, nali jangji suci pageuh kancing carita mulia.'],
            ['title' => 'Daup Pawiwahan', 'date' => 'Oktober 2026', 'text' => 'Kersaning Gusti Nu Maha Suci, dua manah dihijikeun dina beungkeutan suci ijab qabul nu sakral salalawasna.'],
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
    $monthName = $monthsMap[(int)$dateObj->format('n')] ?? 'Oktober';
    $formattedDate = $dayName . ', ' . $dateObj->format('d') . ' ' . $monthName . ' ' . $dateObj->format('Y');
    $formattedDateUpper = mb_strtoupper($formattedDate, 'UTF-8');
    $guestName = request('to', 'Tamu Undangan');
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Pernikahan Adat Sunda: {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&amp;family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&amp;family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;family=Alex+Brush&amp;family=Great+Vibes&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            800: '#163E2B',
                            850: '#123323',
                            900: '#0E291C',
                            950: '#081B12',
                        },
                        sage: {
                            50:  '#F4F8F5',
                            100: '#E6EFE8',
                            200: '#CDDFD2',
                            300: '#A9C5B1',
                            400: '#83A78D',
                            500: '#638B6E',
                        },
                        sunda: {
                            gold: '#C5A059',
                            goldLight: '#E8D09B',
                            goldDark: '#997633',
                            parchment: '#FAF8F5',
                            border: '#E3DCce',
                        }
                    },
                    fontFamily: {
                        editorial: ['Playfair Display', 'serif'],
                        cormorant: ['Cormorant Garamond', 'serif'],
                        royal: ['Cinzel Decorative', 'serif'],
                        script: ['Alex Brush', 'cursive'],
                        vibes: ['Great Vibes', 'cursive'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        };
    </script>

    <style>
        :root {
            --emerald-deep: #0E291C;
            --emerald-card: #123323;
            --sunda-gold: #C5A059;
            --parchment: #FAF8F5;
        }

        body {
            background-color: #081B12;
            color: #0E291C;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Tactile Parahyangan silk paper texture */
        .bg-sunda-paper {
            background-color: #FAF8F5;
            background-image:
                radial-gradient(#123323 0.6px, transparent 0.6px),
                radial-gradient(#C5A059 0.6px, #FAF8F5 0.6px);
            background-size: 26px 26px;
            background-position: 0 0, 13px 13px;
        }

        /* Diagonal geometric division line */
        .emerald-header-slant {
            clip-path: polygon(0 0, 100% 0, 100% 86%, 0 100%);
        }

        /* Golden Siger Crown Shimmer Animation */
        @keyframes sigerGlow {
            0%, 100% {
                filter: drop-shadow(0 6px 16px rgba(197, 160, 89, 0.45));
                transform: translateY(0) scale(1);
            }
            50% {
                filter: drop-shadow(0 10px 28px rgba(232, 208, 155, 0.75));
                transform: translateY(-3px) scale(1.02);
            }
        }
        .anim-siger-glow {
            animation: sigerGlow 4.5s ease-in-out infinite;
        }

        /* Ronce Melati Garland Sway */
        @keyframes jasmineSway {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(2deg) translateX(1px); }
        }
        .anim-jasmine-sway {
            animation: jasmineSway 5s ease-in-out infinite;
            transform-origin: top center;
        }

        /* Living Arch Cinematic Breathing */
        @keyframes livingArchZoom {
            0%, 100% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.04) translate(-0.8%, -0.5%); }
        }
        .anim-arch-living {
            animation: livingArchZoom 16s ease-in-out infinite;
        }

        /* Continuous Rotating Golden Emblem */
        @keyframes spinEmblem {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .anim-spin-emblem {
            animation: spinEmblem 18s linear infinite;
        }

        /* Floating Jasmine Petals Drift */
        @keyframes gentleDrift {
            0% {
                transform: translate3d(-10vw, -10vh, 0) rotate(0deg);
                opacity: 0;
            }
            15% { opacity: 0.85; }
            85% { opacity: 0.85; }
            100% {
                transform: translate3d(105vw, 95vh, 0) rotate(340deg);
                opacity: 0;
            }
        }
        .drift-particle {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 35;
            animation: gentleDrift linear infinite;
        }

        /* Cover Opening Transition */
        #coverOverlay {
            transition: opacity 1.1s cubic-bezier(0.4, 0, 0.2, 1), visibility 1.1s;
        }
        #coverOverlay.cover-open {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        #coverOverlay .cover-zoom-target {
            transition: transform 1.2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        #coverOverlay.cover-open .cover-zoom-target {
            transform: scale(1.12) translateY(-20px);
        }

        /* Scroll Reveal Animations */
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-35px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(35px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .is-revealed {
            opacity: 1 !important;
            transform: translate(0, 0) scale(1) !important;
        }
    </style>
</head>
<body class="antialiased selection:bg-[#C5A059] selection:text-white">

<!-- Audio Element -->
<audio id="bgMusic" loop preload="auto" src="{{ $musicUrl }}"></audio>

<!-- Floating Audio Button -->
<button id="musicToggleBtn" type="button" onclick="toggleSundaMusic()" aria-label="Toggle Music" class="fixed bottom-16 right-3.5 z-40 w-10 h-10 rounded-full bg-emerald-900 text-[#E8D09B] border-2 border-[#C5A059] shadow-[0_8px_20px_rgba(14,41,28,0.5)] flex items-center justify-center hover:scale-105 transition">
    <span id="musicIcon" class="material-symbols-outlined text-lg animate-spin" style="animation-duration: 9s;">music_note</span>
</button>

<!-- Floating Jasmine Petals Drift (Background Ambience) -->
<div aria-hidden="true" class="pointer-events-none select-none">
    <img alt="" class="drift-particle w-5 h-5 opacity-70" src="{{ $ornDir }}/jasmine-petal.png" style="top: 8%; animation-duration: 14s; animation-delay: 0s;"/>
    <img alt="" class="drift-particle w-4 h-4 opacity-60" src="{{ $ornDir }}/jasmine-petal.png" style="top: 28%; animation-duration: 18s; animation-delay: 3s;"/>
    <img alt="" class="drift-particle w-6 h-6 opacity-75" src="{{ $ornDir }}/jasmine-petal.png" style="top: 52%; animation-duration: 16s; animation-delay: 6s;"/>
    <img alt="" class="drift-particle w-4 h-4 opacity-50" src="{{ $ornDir }}/jasmine-petal.png" style="top: 74%; animation-duration: 20s; animation-delay: 9s;"/>
</div>

<!-- Main App Container (Max-Width 430px for Luxury Mobile Experience) -->
<div class="relative w-full max-w-[430px] mx-auto min-h-screen bg-sunda-paper shadow-2xl overflow-x-hidden">

    <!-- =================================================================
         1. EDITORIAL COVER OVERLAY ("SAMPUL SERAT ULEM SUNDA")
         ================================================================= -->
    <div id="coverOverlay" class="fixed inset-0 z-50 mx-auto w-full max-w-[430px] h-full overflow-hidden flex flex-col justify-between select-none bg-[#FAF8F5]">

        <!-- Top Emerald Header Background with Slanted Cut -->
        <div class="absolute top-0 inset-x-0 h-[48%] bg-gradient-to-b from-[#0E291C] via-[#123323] to-[#163E2B] emerald-header-slant z-0 shadow-lg">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#FAF8F5_1px,transparent_1px)] [background-size:18px_18px]"></div>
        </div>

        <!-- ================= TOP HEADER BAR ================= -->
        <div class="relative z-20 pt-6 sm:pt-7 px-5 sm:px-6 flex items-start justify-between">
            <div class="flex-1 pr-2 cover-zoom-target">
                <!-- Cultural Subtitle -->
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="text-[9px] sm:text-[10px] font-semibold tracking-[0.28em] uppercase text-sage-200 font-serif">Serat Ulem Pawiwahan</span>
                    <span class="h-[1px] w-8 bg-[#C5A059]/60"></span>
                </div>

                <!-- Groom Name: Prabu -->
                <h1 class="font-editorial text-[32px] sm:text-[38px] text-white tracking-tight leading-[0.95] drop-shadow-sm">
                    {{ $couple['groom'] }}
                </h1>

                <!-- Ampersand & Bride Name: Sekar -->
                <div class="flex items-center gap-1.5 my-0.5">
                    <span class="font-vibes text-2xl sm:text-3xl text-[#E8D09B] drop-shadow-sm leading-none">&amp;</span>
                    <span class="font-editorial text-[32px] sm:text-[38px] text-white tracking-tight leading-[0.95] drop-shadow-sm">
                        {{ $couple['bride'] }}
                    </span>
                </div>

                <p class="text-[9px] uppercase tracking-[0.22em] text-[#C5A059] font-medium mt-1">
                    Adat Sunda Parahyangan
                </p>
            </div>

            <!-- Top Right: Royal Golden Siger Sunda Crown (Emblem with Shimmer Glow) -->
            <div class="relative w-24 sm:w-28 flex flex-col items-center pointer-events-none cover-zoom-target">
                <div class="relative anim-siger-glow">
                    <img alt="Mahkota Siger Sunda"
                         class="w-[88px] sm:w-[98px] drop-shadow-[0_12px_22px_rgba(0,0,0,0.45)]"
                         src="{{ $ornDir }}/sunda-siger-gold.png"/>
                </div>
            </div>
        </div>

        <!-- ================= CENTER ARCH WINDOW (Royal Sundanese Emerald Couple) ================= -->
        <div class="relative z-10 flex items-center justify-center -mt-2 sm:-mt-1 mb-1 px-4 cover-zoom-target">
            <!-- Concentric Arch Gateway with White & Golden Borders -->
            <div class="relative w-[215px] sm:w-[245px] h-[275px] sm:h-[310px] rounded-t-full rounded-b-2xl border-[3px] border-white shadow-[0_18px_40px_rgba(14,41,28,0.28)] overflow-hidden bg-[#123323]">
                
                <!-- Sundanese Couple Photo (Cinematic Living Micro-Motion) -->
                <div class="w-full h-full relative overflow-hidden rounded-t-full rounded-b-2xl">
                    <img alt="Panganten Sunda: Prabu & Sekar"
                         class="w-full h-full object-cover object-center anim-arch-living brightness-[0.98]"
                         src="{{ $bg['cover'] }}"/>

                    <!-- Vignette & Sunset Golden Flare -->
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/45 via-transparent to-transparent pointer-events-none"></div>

                    <!-- Inner Golden Arch Border -->
                    <div class="pointer-events-none absolute inset-0 rounded-t-full rounded-b-2xl border border-[#C5A059]/50"></div>
                </div>
            </div>

            <!-- Sacred Motto on Right Flank -->
            <div class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 pointer-events-none flex flex-col items-center gap-1 opacity-85">
                <span class="text-[#C5A059] text-base font-bold select-none leading-none">✦</span>
                <div class="w-[1px] h-10 bg-gradient-to-b from-[#C5A059]/70 to-transparent"></div>
            </div>
        </div>

        <!-- ================= BOTTOM CARD BODY (Warm Silk Parchment #FAF8F5) ================= -->
        <div class="relative z-20 px-5 pb-6 pt-0 text-center cover-zoom-target">
            <!-- Traditional Golden Divider -->
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="h-[1px] w-12 bg-gradient-to-r from-transparent to-[#C5A059]/70"></span>
                <span class="w-1.5 h-1.5 rotate-45 bg-[#C5A059]"></span>
                <span class="h-[1px] w-12 bg-gradient-to-l from-transparent to-[#C5A059]/70"></span>
            </div>

            <!-- Wedding Date -->
            <p class="font-editorial text-[11px] sm:text-xs font-semibold tracking-[0.2em] uppercase text-emerald-900 whitespace-nowrap">
                {{ $formattedDateUpper }}
            </p>

            <!-- Guest Recipient Pill Badge -->
            <div class="inline-flex flex-col items-center justify-center max-w-[240px] mx-auto mt-2 mb-3 py-1 px-4 rounded-xl bg-white/90 border border-[#E3DCce] shadow-sm">
                <span class="text-[8.5px] uppercase tracking-[0.22em] text-[#638B6E] font-semibold">Kahatur Kanggo Wargi / Tamu:</span>
                <span class="font-editorial font-bold text-xs text-emerald-950 truncate max-w-[210px] mt-0.5">{{ $guestName }}</span>
            </div>

            <!-- CTA Pill Button: "BUKA SERAT ULEM" -->
            <div class="flex justify-center">
                <button id="openInvitationBtn"
                        type="button"
                        onclick="openSundaInvitation()"
                        class="group relative inline-flex items-center justify-center gap-2.5 w-full max-w-[240px] py-2.5 sm:py-3 px-6 rounded-full bg-gradient-to-r from-emerald-900 via-emerald-850 to-emerald-900 text-white font-serif font-semibold text-[11px] tracking-[0.22em] uppercase shadow-[0_10px_24px_rgba(14,41,28,0.4)] border border-[#C5A059]/70 hover:brightness-110 active:scale-[0.98] transition-all">
                    <span>Buka Serat Ulem</span>
                    <span class="text-[#E8D09B] text-xs group-hover:translate-x-1 transition-transform">›</span>
                </button>
            </div>
        </div>

        <!-- Bottom Corner Jasmine Accent -->
        <div class="absolute -bottom-2 -right-2 w-16 pointer-events-none z-10 drop-shadow-sm opacity-60">
            <img alt="" class="w-full object-contain anim-jasmine-sway" src="{{ $ornDir }}/jasmine-petal.png"/>
        </div>
    </div>

    <!-- =================================================================
         2. HERO SECTION ("BUMI PARAHYANGAN & HITUNG MUNDUR")
         ================================================================= -->
    <section id="heroSection" class="relative min-h-screen pt-8 sm:pt-10 pb-24 px-4 sm:px-5 bg-sunda-paper overflow-hidden flex flex-col items-center justify-start">

        <!-- Top Insignia: Crossed Kujang Pasundan Crest -->
        <div class="relative z-20 flex flex-col items-center text-center mt-1 mb-3.5 reveal-up">
            <div class="relative w-[76px] h-[76px] mb-1 drop-shadow-md">
                <img alt="Kujang Pasundan" class="w-full h-full object-contain" src="{{ $ornDir }}/sunda-kujang-gold.png"/>
            </div>
            <span class="text-[8px] sm:text-[9.5px] font-bold uppercase tracking-[0.2em] text-[#C5A059] whitespace-nowrap">
                Pawiwahan Adat Sunda • Bumi Parahyangan
            </span>
            <h2 class="font-editorial text-xl sm:text-2xl font-bold text-emerald-950 mt-1 leading-snug">
                <span>{{ $couple['groom'] }}</span>
                <span class="font-vibes text-[#C5A059] text-2xl sm:text-3xl font-normal mx-1">&amp;</span>
                <span>{{ $couple['bride'] }}</span>
            </h2>
        </div>

        <!-- Royal Arch Frame Couple Portrait -->
        <div class="relative z-20 w-full max-w-[280px] sm:max-w-[310px] rounded-t-full rounded-b-2xl bg-white border-2 border-emerald-900 p-2 shadow-[0_16px_36px_rgba(14,41,28,0.16)] reveal-scale">
            <div class="rounded-t-full rounded-b-xl border border-[#C5A059]/60 p-1 bg-white">
                <div class="relative w-full h-[235px] sm:h-[275px] rounded-t-full rounded-b-lg overflow-hidden bg-emerald-950 shadow-inner">
                    <img alt="{{ $couple['groom'] }} & {{ $couple['bride'] }}"
                         class="w-full h-full object-cover object-top transition-transform duration-1000 hover:scale-105"
                         src="{{ $bg['cover'] }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/70 via-transparent to-emerald-950/15 pointer-events-none"></div>

                    <!-- Badge inside arch -->
                    <div class="absolute bottom-2.5 inset-x-3 text-center pointer-events-none">
                        <span class="inline-block px-3 py-0.5 rounded-full bg-emerald-950/75 backdrop-blur-sm border border-[#C5A059]/40 text-[8.5px] uppercase tracking-[0.22em] text-[#E8D09B] font-semibold drop-shadow">
                            Pawiwahan Panganten
                        </span>
                    </div>
                </div>
            </div>

            <!-- Date & Venue Inside Card -->
            <div class="pt-2.5 pb-1 px-2 text-center">
                <p class="font-editorial font-bold text-xs sm:text-sm text-emerald-950 tracking-wide">{{ $formattedDate }}</p>
                <p class="text-[11px] text-[#4A6753] mt-0.5 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-xs text-[#C5A059]">location_on</span>
                    <span>{{ $event['location'] }}</span>
                </p>
            </div>
        </div>

        <!-- 4 Glazed Emerald-Gold Countdown Tiles -->
        <div class="relative z-20 w-full max-w-[295px] mt-4.5 sm:mt-5 reveal-up">
            <p class="text-center text-[9px] font-bold uppercase tracking-[0.24em] text-emerald-900 mb-2">
                Ngetang Wanci Bahagia
            </p>
            <div id="countdownGrid" class="grid grid-cols-4 gap-2" data-date="{{ $event['date_iso'] }}T{{ $event['time'] }}:00">
                @foreach ([['id' => 'cd-days', 'label' => 'Dinten', 'val' => '124'], ['id' => 'cd-hours', 'label' => 'Jam', 'val' => '08'], ['id' => 'cd-mins', 'label' => 'Menit', 'val' => '45'], ['id' => 'cd-secs', 'label' => 'Detik', 'val' => '30']] as $tile)
                    <div class="relative bg-white rounded-xl border border-emerald-900 py-2 px-1 text-center shadow-[0_4px_12px_rgba(14,41,28,0.08)] overflow-hidden">
                        <!-- Jasmine Corner Dots -->
                        <span class="absolute top-1 left-1 w-1 h-1 rounded-full bg-[#C5A059]"></span>
                        <span class="absolute top-1 right-1 w-1 h-1 rounded-full bg-[#C5A059]"></span>
                        <span class="absolute bottom-1 left-1 w-1 h-1 rounded-full bg-[#C5A059]"></span>
                        <span class="absolute bottom-1 right-1 w-1 h-1 rounded-full bg-[#C5A059]"></span>

                        <span id="{{ $tile['id'] }}" class="block font-editorial font-bold text-lg sm:text-xl text-emerald-950 leading-none">{{ $tile['val'] }}</span>
                        <span class="block text-[8px] font-bold uppercase tracking-[0.16em] text-[#C5A059] mt-1">{{ $tile['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Kujang Filigree Divider -->
        <div class="flex items-center justify-center gap-2.5 mt-5 w-44 opacity-85">
            <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
            <div class="w-4 h-4 flex items-center justify-center">
                <span class="text-[#C5A059] text-xs">✦</span>
            </div>
            <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
        </div>
    </section>

    <!-- =================================================================
         3. QUOTE SECTION ("PANGGEUING ASIH & AR-RUM")
         ================================================================= -->
    <section class="relative py-12 px-6 bg-sage-100 border-y border-[#E3DCce] overflow-hidden">
        <div class="relative z-10 max-w-[360px] mx-auto text-center">
            <!-- Royal Sunda Siger Plaque -->
            <div class="w-20 mx-auto mb-3 reveal-scale drop-shadow-md">
                <img alt="Sunda Siger" class="w-full object-contain" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>

            <!-- Sacred Sundanese Wedding Blessing Card -->
            <div class="relative bg-white rounded-2xl border-2 border-emerald-900 p-6 shadow-[0_14px_32px_rgba(14,41,28,0.12)] reveal-up">
                <div class="pointer-events-none absolute inset-1.5 rounded-xl border border-[#C5A059]/60"></div>

                <p class="font-editorial italic text-xs sm:text-sm leading-relaxed text-emerald-950 mb-3">
                    "Mugia Gusti Nu Maha Suci maparin barokah, ngahijikeun dua manah dina lambang asih sajati, runtut raut sauyunan sabobot sapihanean nepi ka pakena pakena."
                </p>

                <p class="font-editorial italic text-[11px] leading-relaxed text-[#4A6753]">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya."
                </p>

                <div class="mt-4 inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-sage-50 border border-[#E3DCce]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#C5A059]"></span>
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-emerald-900">QS. Ar-Rum : 21</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#C5A059]"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================================
         4. COUPLE SECTION ("PANGANTEN PAMEGET & ISTRI")
         ================================================================= -->
    <section id="coupleSection" class="relative py-16 px-6 bg-sunda-paper overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Panganten Sauyunan</span>
            <h2 class="font-editorial text-2xl font-bold text-emerald-950 mt-1">Sang Mempelai</h2>
            <p class="text-xs text-[#4A6753] mt-2 leading-relaxed">
                Kalayan panyalindungan sareng ridho Allah SWT, sim kuring seja nguningakeun tali asih pernikahan:
            </p>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
                <span class="text-[#C5A059] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
            </div>
        </div>

        <!-- GROOM CARD (Panganten Pameget) -->
        <div class="relative max-w-[350px] mx-auto bg-white rounded-3xl border-2 border-emerald-900 p-5 mb-7 shadow-[0_12px_28px_rgba(14,41,28,0.10)] reveal-left">
            <div class="flex items-center justify-center mb-4">
                <div class="relative w-48 h-56 rounded-t-full rounded-b-2xl overflow-hidden border-2 border-emerald-900 shadow-md">
                    <img alt="{{ $couple['groom'] }}" class="w-full h-full object-cover object-top" src="{{ $bg['groom'] }}"/>
                    <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-emerald-950/75 to-transparent"></div>
                    <span class="absolute bottom-2 inset-x-0 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-[#E8D09B]">Panganten Pameget</span>
                </div>
            </div>

            <div class="text-center px-2">
                <h3 class="font-editorial text-2xl sm:text-3xl text-emerald-950 font-bold">{{ $couple['groom'] }}</h3>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#C5A059] mt-1">Putra Tercinta Ti</p>
                <p class="font-cormorant text-base text-emerald-900 font-semibold mt-0.5">{{ $couple['parents']['groom'] }}</p>
            </div>

            <!-- Kujang Watermark Accent -->
            <div class="absolute top-3 right-3 w-8 opacity-40 pointer-events-none">
                <img alt="" class="w-full object-contain" src="{{ $ornDir }}/sunda-kujang-gold.png"/>
            </div>
        </div>

        <!-- Royal Siger & Melati Love Connector -->
        <div class="flex flex-col items-center justify-center my-4 reveal-scale">
            <div class="relative w-16 h-16 drop-shadow-md">
                <img alt="Mahkota Siger" class="w-full h-full object-contain" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>
            <span class="font-vibes text-3xl sm:text-4xl text-[#C5A059] -mt-1">&amp;</span>
            <p class="text-[9px] uppercase tracking-[0.25em] text-[#C5A059] font-semibold mt-0.5">Dua Manah Ngajadi Hiji</p>
        </div>

        <!-- BRIDE CARD (Panganten Istri) -->
        <div class="relative max-w-[350px] mx-auto bg-white rounded-3xl border-2 border-emerald-900 p-5 mt-3 shadow-[0_12px_28px_rgba(14,41,28,0.10)] reveal-right">
            <div class="flex items-center justify-center mb-4">
                <div class="relative w-48 h-56 rounded-t-full rounded-b-2xl overflow-hidden border-2 border-emerald-900 shadow-md">
                    <img alt="{{ $couple['bride'] }}" class="w-full h-full object-cover object-top" src="{{ $bg['bride'] }}"/>
                    <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-emerald-950/75 to-transparent"></div>
                    <span class="absolute bottom-2 inset-x-0 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-[#E8D09B]">Panganten Istri</span>
                </div>
            </div>

            <div class="text-center px-2">
                <h3 class="font-editorial text-2xl sm:text-3xl text-emerald-950 font-bold">{{ $couple['bride'] }}</h3>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#C5A059] mt-1">Putri Tercinta Ti</p>
                <p class="font-cormorant text-base text-emerald-900 font-semibold mt-0.5">{{ $couple['parents']['bride'] }}</p>
            </div>

            <!-- Siger Watermark Accent -->
            <div class="absolute top-3 right-3 w-8 opacity-40 pointer-events-none">
                <img alt="" class="w-full object-contain" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>
        </div>
    </section>

    <!-- =================================================================
         5. EVENT SCHEDULE SECTION ("RUNTUYAN UPACARA & RESEPSI")
         ================================================================= -->
    <section id="eventSection" class="relative py-16 px-6 bg-gradient-to-b from-[#0E291C] via-[#123323] to-[#081B12] text-white overflow-hidden">
        <!-- Linen Grid Texture -->
        <div class="absolute inset-0 bg-[radial-gradient(#FAF8F5_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>

        <div class="relative z-10 text-center max-w-[340px] mx-auto mb-9 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#E8D09B]">Wanci &amp; Tempat</span>
            <h2 class="font-editorial text-2xl font-bold text-white mt-1">Runtuyan Acara</h2>
            <p class="text-xs text-sage-200 mt-1.5">
                Mangrupikeun kahormatan sareng kabagjaan kanggo sim kuring upami Bapa/Ibu/Saderek kersa sumping dina:
            </p>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-[#E8D09B]/40"></span>
                <span class="text-[#E8D09B] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-[#E8D09B]/40"></span>
            </div>
        </div>

        <!-- Schedule Cards -->
        <div class="relative z-10 space-y-5 max-w-[350px] mx-auto">
            @foreach ($schedule as $idx => $item)
                <div class="relative bg-white text-emerald-950 rounded-2xl border-2 border-[#C5A059] p-5 shadow-[0_16px_35px_rgba(0,0,0,0.35)] {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <div class="flex items-center justify-between border-b border-[#E3DCce] pb-3 mb-3.5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-emerald-900 text-[#E8D09B] flex items-center justify-center shadow">
                                <span class="material-symbols-outlined text-xl">{{ $idx === 0 ? 'volunteer_activism' : 'celebration' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] font-bold uppercase tracking-[0.22em] text-[#C5A059] block">Runtuyan 0{{ $idx + 1 }}</span>
                                <h3 class="font-editorial font-bold text-lg text-emerald-950 leading-tight">{{ $item['title'] }}</h3>
                            </div>
                        </div>
                        <div class="w-6 h-6 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[#C5A059] text-xl">spa</span>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center gap-2.5 text-emerald-900">
                            <span class="material-symbols-outlined text-base text-[#C5A059]">calendar_month</span>
                            <span class="font-semibold">{{ $formattedDate }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-emerald-900">
                            <span class="material-symbols-outlined text-base text-[#C5A059]">schedule</span>
                            <span class="font-semibold">{{ $item['time'] }}</span>
                        </div>
                        <div class="flex items-start gap-2.5 text-[#4A6753]">
                            <span class="material-symbols-outlined text-base text-[#C5A059] mt-0.5">location_on</span>
                            <div>
                                <p class="font-bold text-emerald-950">{{ $item['venue'] }}</p>
                                <p class="text-[11px] text-[#638B6E] mt-0.5">{{ $item['note'] }}</p>
                                <p class="text-[11px] text-[#4A6753] mt-0.5">{{ $event['address'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Google Maps Button -->
        <div class="relative z-10 max-w-[350px] mx-auto mt-7 text-center reveal-up">
            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2.5 w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-[#C5A059] via-[#E8D09B] to-[#C5A059] text-emerald-950 font-bold text-xs uppercase tracking-[0.2em] shadow-[0_10px_25px_rgba(197,160,89,0.35)] hover:brightness-105 transition">
                <span class="material-symbols-outlined text-base">map</span>
                <span>Pituduh Lokasi (Google Maps)</span>
            </a>
        </div>
    </section>

    <!-- =================================================================
         6. LOVE STORY TIMELINE ("RUNTUYAN ASIH")
         ================================================================= -->
    <section id="storySection" class="relative py-16 px-6 bg-sage-100 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Kisah Sauyunan</span>
            <h2 class="font-editorial text-2xl font-bold text-emerald-950 mt-1">Runtuyan Asih</h2>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
                <span class="text-[#C5A059] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
            </div>
        </div>

        <div class="relative max-w-[350px] mx-auto pl-6 border-l-2 border-dashed border-[#C5A059]/70 space-y-6">
            @foreach ($stories as $idx => $st)
                <div class="relative bg-white rounded-2xl border-2 border-emerald-900 p-4 shadow-sm {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <!-- Pin on Timeline -->
                    <div class="absolute -left-[37px] top-5 w-6 h-6 rounded-full bg-emerald-900 border-2 border-[#C5A059] flex items-center justify-center text-[#E8D09B] shadow">
                        <span class="text-[10px] font-bold">0{{ $idx + 1 }}</span>
                    </div>

                    <div class="flex items-center justify-between mb-1.5">
                        <span class="px-2.5 py-0.5 rounded-full bg-sage-50 text-emerald-900 font-bold text-[10px] tracking-wider uppercase border border-sage-200">
                            {{ $st['date'] }}
                        </span>
                        <span class="text-[10px] font-editorial italic text-[#C5A059]">Babak 0{{ $idx + 1 }}</span>
                    </div>
                    <h3 class="font-editorial font-bold text-base text-emerald-950">{{ $st['title'] }}</h3>
                    <p class="text-xs text-[#4A6753] leading-relaxed mt-1.5">{{ $st['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         7. GALLERY SECTION ("POTRET PANGANTEN")
         ================================================================= -->
    <section id="gallerySection" class="relative py-16 px-6 bg-sunda-paper overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Koleksi Foto</span>
            <h2 class="font-editorial text-2xl font-bold text-emerald-950 mt-1">Potret Panganten</h2>
            <div class="flex items-center justify-center gap-2 mt-3 w-40 mx-auto opacity-70">
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
                <span class="text-[#C5A059] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 max-w-[360px] mx-auto">
            @foreach ($gallery as $idx => $imgUrl)
                <div onclick="openLightbox('{{ $imgUrl }}')" class="group cursor-pointer relative overflow-hidden rounded-2xl border-2 border-emerald-900 bg-white p-1.5 shadow-md reveal-scale {{ $idx === 0 ? 'col-span-2 h-56' : 'h-40' }}">
                    <div class="w-full h-full rounded-xl overflow-hidden relative">
                        <img alt="Gallery {{ $idx + 1 }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $imgUrl }}"/>
                        <div class="absolute inset-0 bg-emerald-950/0 group-hover:bg-emerald-950/30 transition-colors flex items-center justify-center">
                            <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl drop-shadow">zoom_in</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         8. DIGITAL GIFT SECTION ("HATURAN TANDA ASIH")
         ================================================================= -->
    <section id="giftSection" class="relative py-16 px-6 bg-sage-100 border-t border-[#E3DCce] overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Kado Pawiwahan</span>
            <h2 class="font-editorial text-2xl font-bold text-emerald-950 mt-1">Tanda Asih</h2>
            <p class="text-xs text-[#4A6753] mt-1.5 leading-relaxed">
                Doa restu ti Bapa/Ibu/Saderek mangrupikeun kurnia pangéndahna kanggo sim kuring. Nanging saupami badé maparin tanda asih, tiasa ngalangkungan:
            </p>
        </div>

        <div class="space-y-4 max-w-[350px] mx-auto">
            @foreach ($gifts as $idx => $gift)
                <div class="relative bg-white rounded-2xl border-2 border-emerald-900 p-5 shadow-sm reveal-up">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full bg-emerald-900 text-white text-[10px] font-bold uppercase tracking-wider">
                            {{ $gift['bank'] }}
                        </span>
                        <span class="material-symbols-outlined text-[#C5A059]">account_balance_wallet</span>
                    </div>
                    <p class="font-mono font-bold text-lg text-emerald-950 tracking-wider">{{ $gift['account'] }}</p>
                    <p class="text-xs text-[#4A6753] mt-0.5">a.n. <strong class="text-emerald-950">{{ $gift['name'] }}</strong></p>

                    <button type="button" onclick="copyBankAccount('{{ $gift['account'] }}', this)" class="mt-3.5 inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-sage-50 hover:bg-sage-100 border border-sage-300 text-emerald-900 text-[11px] font-bold tracking-wider uppercase transition">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                        <span class="copy-label">Salin Nomer Rékéning</span>
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         9. RSVP & WISHES SECTION ("BUKU TAMU & PANEDA RESTU")
         ================================================================= -->
    <section id="rsvpSection" class="relative py-16 px-6 bg-sunda-paper border-t border-[#E3DCce] overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Buku Tamu</span>
            <h2 class="font-editorial text-2xl font-bold text-emerald-950 mt-1">Du'a &amp; Pangharepan</h2>
            <div class="flex items-center justify-center gap-2 mt-3 w-40 mx-auto opacity-70">
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
                <span class="text-[#C5A059] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-emerald-900/40"></span>
            </div>
        </div>

        <div class="max-w-[350px] mx-auto bg-white rounded-3xl border-2 border-emerald-900 p-5 shadow-sm reveal-up">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form id="wishesForm" action="{{ isset($invitation) ? route('invitations.comments.store', $invitation->id) : '#' }}" method="POST" onsubmit="return handleWishSubmit(event)" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-emerald-950 mb-1">Jenengan Lengkep</label>
                    <input type="text" name="name" id="wishName" required placeholder="Tuliskeun jenengan anjeun" class="w-full rounded-xl border-[#E3DCce] bg-white text-xs text-emerald-950 focus:border-emerald-900 focus:ring-emerald-900"/>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-emerald-950 mb-1">Konfirmasi Kasumpingan</label>
                    <select name="status" id="wishStatus" class="w-full rounded-xl border-[#E3DCce] bg-white text-xs text-emerald-950 focus:border-emerald-900 focus:ring-emerald-900">
                        <option value="Hadir">Insya Allah Hadir</option>
                        <option value="Tidak Hadir">Hapunten Teu Tiasa Hadir</option>
                        <option value="Ragu-ragu">Masih Ragu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-emerald-950 mb-1">Du'a &amp; Pangharepan</label>
                    <textarea name="message" id="wishMessage" rows="3" required placeholder="Tuliskeun du'a restu anu haneut kanggo kadua mempelai..." class="w-full rounded-xl border-[#E3DCce] bg-white text-xs text-emerald-950 focus:border-emerald-900 focus:ring-emerald-900"></textarea>
                </div>
                <button type="submit" class="w-full py-3 px-5 rounded-full bg-emerald-900 text-white font-bold text-xs uppercase tracking-[0.2em] border border-[#C5A059] shadow-md hover:bg-emerald-950 transition">
                    Kintun Du'a
                </button>
            </form>

            <!-- Wishes Wall -->
            <div id="wishesWall" class="mt-6 pt-4 border-t border-[#E3DCce] max-h-64 overflow-y-auto space-y-3 pr-1">
                @foreach ($wishes as $w)
                    <div class="p-3.5 rounded-2xl bg-[#F8F6F0] border border-[#E3DCce]">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-editorial font-bold text-xs text-emerald-950">{{ $w['name'] }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $w['status'] === 'Hadir' ? 'bg-emerald-900 text-[#E8D09B]' : 'bg-slate-200 text-slate-700' }}">
                                {{ $w['status'] }}
                            </span>
                        </div>
                        <p class="text-xs text-[#4A6753] leading-relaxed">{{ $w['message'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =================================================================
         10. CLOSING FOOTER ("PANUTUP & HATUR NUHUN")
         ================================================================= -->
    <footer class="relative pt-14 pb-28 px-6 bg-gradient-to-b from-emerald-900 via-emerald-850 to-[#081B12] text-white text-center overflow-hidden">
        <!-- Royal Siger Sunda Emblem -->
        <div class="relative w-20 h-20 mx-auto mb-3 reveal-scale drop-shadow-xl">
            <img alt="Sunda Siger" class="w-full h-full object-contain anim-siger-glow" src="{{ $ornDir }}/sunda-siger-gold.png"/>
        </div>

        <p class="font-editorial italic text-xs sm:text-sm text-[#E8D09B] max-w-[320px] mx-auto mb-3 leading-relaxed">
            "Hatur nuhun kana paneda sareng du'a restu ti wargi sadayana. Mugi janten amal kasaean sareng kenging balesan ti Gusti Allah SWT."
        </p>

        <p class="text-xs text-sage-200 max-w-[300px] mx-auto leading-relaxed">
            Mangrupikeun kahormatan sareng kabagjaan kanggo sim kuring sakulawargi saupami Bapa/Ibu/Saderek kersa sumping ngaluuhan ieu acara.
        </p>
        <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-[#E8D09B] mt-4">Sim Kuring Nu Berbahagia</p>
        <h3 class="font-editorial text-3xl text-white mt-1">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h3>
    </footer>

    <!-- =================================================================
         STICKY BOTTOM NAVIGATION
         ================================================================= -->
    <nav class="fixed bottom-2.5 inset-x-0 z-40 mx-auto w-[90%] max-w-[350px] rounded-full bg-white/95 backdrop-blur-md border border-emerald-900 shadow-[0_10px_25px_rgba(14,41,28,0.25)] px-2 py-1.5 flex items-center justify-around">
        <a href="#heroSection" class="flex flex-col items-center text-emerald-900 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">home</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Home</span>
        </a>
        <a href="#coupleSection" class="flex flex-col items-center text-emerald-900 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">favorite</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Mempelai</span>
        </a>
        <a href="#eventSection" class="flex flex-col items-center text-emerald-900 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">event</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Acara</span>
        </a>
        <a href="#gallerySection" class="flex flex-col items-center text-emerald-900 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">photo_library</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Galeri</span>
        </a>
        <a href="#rsvpSection" class="flex flex-col items-center text-emerald-900 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">chat</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Ucapan</span>
        </a>
    </nav>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" onclick="closeLightbox()" class="fixed inset-0 z-50 hidden bg-emerald-950/90 backdrop-blur-md items-center justify-center p-4">
        <button type="button" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center">
            <span class="material-symbols-outlined">close</span>
        </button>
        <img id="lightboxImage" alt="Preview" class="max-w-full max-h-[85vh] rounded-2xl border-2 border-[#C5A059] shadow-2xl object-contain" src=""/>
    </div>

</div>

<!-- Scripts -->
<script>
    const audioEl = document.getElementById('bgMusic');
    const musicIcon = document.getElementById('musicIcon');
    let isPlaying = false;

    function openSundaInvitation() {
        const cover = document.getElementById('coverOverlay');
        if (cover) {
            cover.classList.add('cover-open');
            setTimeout(() => {
                cover.style.display = 'none';
            }, 1050);
        }

        playSundaMusic();

        setTimeout(() => {
            const hero = document.getElementById('heroSection');
            if (hero) {
                hero.scrollIntoView({ behavior: 'smooth' });
            }
        }, 300);
    }

    function playSundaMusic() {
        if (!audioEl) return;
        audioEl.play().then(() => {
            isPlaying = true;
            if (musicIcon) {
                musicIcon.textContent = 'music_note';
                musicIcon.classList.add('animate-spin');
            }
        }).catch(err => {
            console.log('Audio autoplay prevented:', err);
        });
    }

    function toggleSundaMusic() {
        if (!audioEl) return;
        if (isPlaying) {
            audioEl.pause();
            isPlaying = false;
            if (musicIcon) {
                musicIcon.textContent = 'music_off';
                musicIcon.classList.remove('animate-spin');
            }
        } else {
            audioEl.play();
            isPlaying = true;
            if (musicIcon) {
                musicIcon.textContent = 'music_note';
                musicIcon.classList.add('animate-spin');
            }
        }
    }

    // Countdown Timer
    function initCountdown() {
        const grid = document.getElementById('countdownGrid');
        if (!grid) return;
        const targetStr = grid.getAttribute('data-date');
        const targetDate = new Date(targetStr).getTime();

        function update() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                document.getElementById('cd-days').textContent = '00';
                document.getElementById('cd-hours').textContent = '00';
                document.getElementById('cd-mins').textContent = '00';
                document.getElementById('cd-secs').textContent = '00';
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('cd-days').textContent = String(days).padStart(2, '0');
            document.getElementById('cd-hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('cd-mins').textContent = String(minutes).padStart(2, '0');
            document.getElementById('cd-secs').textContent = String(seconds).padStart(2, '0');
        }

        update();
        setInterval(update, 1000);
    }

    // Scroll Reveal Observer
    function initScrollReveal() {
        const reveals = document.querySelectorAll('.reveal-up, .reveal-scale, .reveal-left, .reveal-right');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                }
            });
        }, { threshold: 0.12 });

        reveals.forEach(el => observer.observe(el));
    }

    // Lightbox
    function openLightbox(url) {
        const modal = document.getElementById('lightboxModal');
        const img = document.getElementById('lightboxImage');
        if (modal && img) {
            img.src = url;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeLightbox() {
        const modal = document.getElementById('lightboxModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Bank Account Copy
    function copyBankAccount(account, btn) {
        navigator.clipboard.writeText(account).then(() => {
            const label = btn.querySelector('.copy-label');
            const originalText = label ? label.textContent : '';
            if (label) label.textContent = 'Kopong Disalin!';
            btn.classList.add('bg-emerald-900', 'text-white');
            setTimeout(() => {
                if (label) label.textContent = originalText;
                btn.classList.remove('bg-emerald-900', 'text-white');
            }, 2000);
        });
    }

    // RSVP & Wishes form submission
    function handleWishSubmit(e) {
        @if(!isset($invitation))
            e.preventDefault();
            const name = document.getElementById('wishName').value.trim();
            const status = document.getElementById('wishStatus').value;
            const message = document.getElementById('wishMessage').value.trim();

            if (!name || !message) return false;

            const wall = document.getElementById('wishesWall');
            const card = document.createElement('div');
            card.className = 'p-3.5 rounded-2xl bg-[#F8F6F0] border border-[#E3DCce]';
            card.innerHTML = `
                <div class="flex items-center justify-between mb-1">
                    <span class="font-editorial font-bold text-xs text-emerald-950">${escapeHtml(name)}</span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase ${status === 'Hadir' ? 'bg-emerald-900 text-[#E8D09B]' : 'bg-slate-200 text-slate-700'}">
                        ${status}
                    </span>
                </div>
                <p class="text-xs text-[#4A6753] leading-relaxed">${escapeHtml(message)}</p>
            `;
            wall.prepend(card);

            document.getElementById('wishesForm').reset();
            alert('Hatur nuhun! Du\'a sareng ucapan anjeun parantos kakintun.');
            return false;
        @else
            return true;
        @endif
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    document.addEventListener('DOMContentLoaded', () => {
        initCountdown();
        initScrollReveal();
    });
</script>

</body>
</html>
