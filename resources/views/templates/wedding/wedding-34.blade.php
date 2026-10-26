@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Prabu Dananjaya');
        $brideName = trim($names[1] ?? 'Sekar Larasati');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'groom_full' => $groomName . ', S.T.',
            'bride_full' => $brideName . ', S.Ked.',
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
                'note' => 'Upacara Adat Sunda: Sungkeman, Sawer Panganten, Meuleum Harupat & Nincak Endog',
                'venue' => $event['location']
            ],
            [
                'title' => 'Resepsi Pawiwahan Ageng',
                'time' => '11:00 - 14:00 WIB',
                'note' => 'Kliningan Sunda, Kacapi Suling & Jamuan Prasmanan Khas Parahyangan',
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
                'note' => 'Upacara Adat Sunda: Sungkeman, Sawer Panganten, Meuleum Harupat & Nincak Endog',
                'venue' => 'Puri Parahyangan Grand Ballroom'
            ],
            [
                'title' => 'Resepsi Pawiwahan Ageng',
                'time' => '11:00 - 14:00 WIB',
                'note' => 'Kliningan Sunda, Kacapi Suling & Jamuan Prasmanan Khas Parahyangan',
                'venue' => 'Puri Parahyangan Grand Ballroom'
            ]
        ];

        $stories = [
            ['title' => 'Patepang Munggaran', 'date' => 'Maret 2022', 'text' => 'Dina hawa tiis kota Parahyangan Bandung, takdir maparin lolongkrang pikeun patepang. Tina sawala leutik, mekar rasa asih anu suci.'],
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
    $formattedDateUpper = mb_strtoupper($formattedDate, 'UTF-8');
    $guestName = request('to', 'Tamu Undangan');
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Pawiwahan Adat Sunda: {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>

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
                            750: '#14402A',
                            800: '#0F3321',
                            850: '#0B2719',
                            900: '#071C12',
                            950: '#04120B',
                        },
                        sage: {
                            50:  '#F4F8F5',
                            100: '#E5EFE7',
                            200: '#C9DEC0',
                            300: '#A4C6AC',
                            400: '#7FA88B',
                            500: '#5E896B',
                        },
                        sunda: {
                            gold: '#D4AF37',
                            goldLight: '#F3E5AB',
                            goldDark: '#997633',
                            amber: '#C5A059',
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
        body {
            background-color: #030D08;
            color: #E2ECE5;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Sunda Royal Emerald Silk Background with Golden Damask Texture */
        .bg-sunda-silk {
            background-color: #071C12;
            background-image:
                radial-gradient(ellipse at 50% 0%, #14402A 0%, transparent 70%),
                radial-gradient(circle at 50% 50%, rgba(212, 175, 55, 0.05) 0%, transparent 60%),
                radial-gradient(#D4AF37 0.75px, transparent 0.75px);
            background-size: 100% 100%, 100% 100%, 30px 30px;
        }

        /* Glassmorphism Emerald Cards */
        .glass-emerald {
            background: linear-gradient(135deg, rgba(15, 51, 33, 0.75) 0%, rgba(7, 28, 18, 0.85) 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 175, 55, 0.35);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.45), inset 0 1px 1px rgba(243, 229, 171, 0.2);
        }

        /* Golden Siger Crown Shimmer Animation */
        @keyframes sigerGlow {
            0%, 100% {
                filter: drop-shadow(0 8px 20px rgba(212, 175, 55, 0.45));
                transform: translateY(0) scale(1);
            }
            50% {
                filter: drop-shadow(0 14px 32px rgba(243, 229, 171, 0.75));
                transform: translateY(-4px) scale(1.02);
            }
        }
        .anim-siger-glow {
            animation: sigerGlow 4.5s ease-in-out infinite;
        }

        /* Golden Aura Pulse for CTA */
        @keyframes goldPulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.5), 0 10px 25px rgba(0,0,0,0.4);
            }
            50% {
                box-shadow: 0 0 0 12px rgba(212, 175, 55, 0), 0 14px 30px rgba(212, 175, 55, 0.3);
            }
        }
        .anim-gold-pulse {
            animation: goldPulse 2.8s infinite;
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

        /* Cover Curtain / Unfold Transition */
        #coverOverlay {
            transition: transform 1.25s cubic-bezier(0.77, 0, 0.175, 1), opacity 1.1s ease;
        }
        #coverOverlay.cover-open {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        /* Scroll Reveal Animations */
        .reveal-up {
            opacity: 0;
            transform: translateY(32px);
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
<body class="antialiased selection:bg-[#D4AF37] selection:text-emerald-950">

<!-- Audio Element -->
<audio id="bgMusic" loop preload="auto" src="{{ $musicUrl }}"></audio>

<!-- Floating Audio Button -->
<button id="musicToggleBtn" type="button" onclick="toggleSundaMusic()" aria-label="Toggle Music" class="fixed bottom-16 right-3.5 z-40 w-11 h-11 rounded-full bg-gradient-to-br from-emerald-800 to-emerald-950 text-[#F3E5AB] border-2 border-[#D4AF37] shadow-[0_8px_24px_rgba(0,0,0,0.6)] flex items-center justify-center hover:scale-105 active:scale-95 transition">
    <span id="musicIcon" class="material-symbols-outlined text-xl animate-spin" style="animation-duration: 9s;">music_note</span>
</button>

<!-- Floating Jasmine Petals Drift (Background Ambience) -->
<div aria-hidden="true" class="pointer-events-none select-none">
    <img alt="" class="drift-particle w-5 h-5 opacity-70" src="{{ $ornDir }}/jasmine-petal.png" style="top: 8%; animation-duration: 14s; animation-delay: 0s;"/>
    <img alt="" class="drift-particle w-4 h-4 opacity-60" src="{{ $ornDir }}/jasmine-petal.png" style="top: 28%; animation-duration: 18s; animation-delay: 3s;"/>
    <img alt="" class="drift-particle w-6 h-6 opacity-75" src="{{ $ornDir }}/jasmine-petal.png" style="top: 52%; animation-duration: 16s; animation-delay: 6s;"/>
    <img alt="" class="drift-particle w-4 h-4 opacity-50" src="{{ $ornDir }}/jasmine-petal.png" style="top: 74%; animation-duration: 20s; animation-delay: 9s;"/>
</div>

<!-- Main App Container (Max-Width 430px for High-End Mobile Experience) -->
<div class="relative w-full max-w-[430px] mx-auto min-h-screen bg-sunda-silk shadow-[0_0_50px_rgba(0,0,0,0.8)] overflow-x-hidden text-[#E2ECE5]">

    <!-- =================================================================
         1. NEW CONCEPT COVER: "BALE KENCANA PASUNDAN" (FULL-SCREEN ROYAL TAPESTRY)
         ================================================================= -->
    <div id="coverOverlay" class="fixed inset-0 z-50 mx-auto w-full max-w-[430px] h-full overflow-hidden flex flex-col justify-between items-center px-6 py-8 select-none bg-gradient-to-b from-[#05140C] via-[#092618] to-[#040F09]">
        
        <!-- Subtle Golden Ornate Frame Borders on Cover -->
        <div class="pointer-events-none absolute inset-3 rounded-3xl border border-[#D4AF37]/30 shadow-inner"></div>
        <div class="pointer-events-none absolute inset-4 rounded-3xl border border-[#D4AF37]/15"></div>

        <!-- Corner Ornaments (Golden Filigree Accents) -->
        <span class="absolute top-5 left-5 text-[#D4AF37]/60 text-xs">✦</span>
        <span class="absolute top-5 right-5 text-[#D4AF37]/60 text-xs">✦</span>
        <span class="absolute bottom-5 left-5 text-[#D4AF37]/60 text-xs">✦</span>
        <span class="absolute bottom-5 right-5 text-[#D4AF37]/60 text-xs">✦</span>

        <!-- ================= TOP HEADER: ROYAL SIGER CROWN & TITLE ================= -->
        <div class="relative z-10 flex flex-col items-center text-center mt-2">
            <!-- Grand Royal Siger Crown with Shimmering Glow -->
            <div class="relative w-28 h-28 mb-1 anim-siger-glow">
                <img alt="Mahkota Siger Sunda" class="w-full h-full object-contain drop-shadow-2xl" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>

            <!-- Header Spaced Title -->
            <span class="text-[10px] font-bold uppercase tracking-[0.32em] text-[#D4AF37] font-serif">
                Pawiwahan Adat Sunda
            </span>
            <div class="flex items-center justify-center gap-2 mt-1">
                <span class="h-[1px] w-8 bg-gradient-to-r from-transparent to-[#D4AF37]"></span>
                <span class="text-[9px] uppercase tracking-[0.24em] text-sage-300">Bale Parahyangan</span>
                <span class="h-[1px] w-8 bg-gradient-to-l from-transparent to-[#D4AF37]"></span>
            </div>
        </div>

        <!-- ================= CENTER: MAJESTIC EMBOSSED PORTRAIT MEDALLION ================= -->
        <div class="relative z-10 my-auto py-2 flex flex-col items-center">
            <!-- Golden Double-Bordered Portrait Frame -->
            <div class="relative p-2 rounded-2xl bg-gradient-to-b from-[#D4AF37]/50 via-emerald-800/40 to-[#D4AF37]/50 shadow-[0_20px_45px_rgba(0,0,0,0.65)]">
                <div class="relative w-[190px] h-[240px] sm:w-[210px] sm:h-[265px] rounded-xl overflow-hidden border-2 border-[#F3E5AB]/70 bg-emerald-950">
                    <img alt="Panganten Sunda" class="w-full h-full object-cover object-center filter brightness-105" src="{{ $bg['cover'] }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/70 via-transparent to-transparent pointer-events-none"></div>

                    <!-- Subtle bottom ribbon -->
                    <div class="absolute bottom-2 inset-x-2 text-center pointer-events-none">
                        <span class="inline-block px-3 py-0.5 rounded-full bg-emerald-950/80 backdrop-blur-sm border border-[#D4AF37]/50 text-[8.5px] uppercase tracking-[0.25em] text-[#F3E5AB] font-semibold">
                            Sampul Serat Ulem
                        </span>
                    </div>
                </div>
            </div>

            <!-- Couple Names in Majestic Editorial Serif -->
            <div class="text-center mt-3">
                <h1 class="font-editorial text-2xl sm:text-3xl text-white font-bold tracking-tight leading-tight drop-shadow-md">
                    {{ $couple['groom'] }}
                </h1>
                <div class="flex items-center justify-center gap-2 -my-1">
                    <span class="h-[1px] w-6 bg-[#D4AF37]/50"></span>
                    <span class="font-vibes text-3xl text-[#D4AF37]">&amp;</span>
                    <span class="h-[1px] w-6 bg-[#D4AF37]/50"></span>
                </div>
                <h1 class="font-editorial text-2xl sm:text-3xl text-white font-bold tracking-tight leading-tight drop-shadow-md">
                    {{ $couple['bride'] }}
                </h1>
            </div>
        </div>

        <!-- ================= BOTTOM: GUEST BADGE & OPEN CTA BUTTON ================= -->
        <div class="relative z-10 w-full flex flex-col items-center text-center mb-2">
            <!-- Guest Badge -->
            <div class="mb-3.5 py-1.5 px-5 rounded-2xl bg-emerald-950/80 border border-[#D4AF37]/40 backdrop-blur-md shadow-md max-w-[270px]">
                <p class="text-[8.5px] uppercase tracking-[0.22em] text-sage-300 font-medium">Kahatur Rawuh Bapa/Ibu/Saderek:</p>
                <p class="font-editorial font-bold text-sm text-[#F3E5AB] truncate mt-0.5">{{ $guestName }}</p>
            </div>

            <!-- Grand Golden Wax Seal Button -->
            <button id="openInvitationBtn"
                    type="button"
                    onclick="openSundaInvitation()"
                    class="group anim-gold-pulse relative inline-flex items-center justify-center gap-3 w-full max-w-[250px] py-3.5 px-6 rounded-full bg-gradient-to-r from-[#C5A059] via-[#F3E5AB] to-[#C5A059] text-emerald-950 font-serif font-bold text-xs tracking-[0.22em] uppercase shadow-[0_12px_30px_rgba(212,175,55,0.4)] hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-base">drafts</span>
                <span>Buka Serat Ulem</span>
                <span class="text-xs group-hover:translate-x-1 transition-transform">›</span>
            </button>
        </div>
    </div>

    <!-- =================================================================
         2. HERO SECTION: "BALE SAWALA PARAHYANGAN"
         ================================================================= -->
    <section id="heroSection" class="relative min-h-screen pt-12 pb-24 px-5 flex flex-col items-center justify-start overflow-hidden">
        
        <!-- Insignia: Crossed Kujang Pasundan Crest -->
        <div class="relative z-20 flex flex-col items-center text-center mb-5 reveal-up">
            <div class="relative w-20 h-20 mb-2 drop-shadow-[0_10px_20px_rgba(0,0,0,0.6)]">
                <img alt="Kujang Pasundan" class="w-full h-full object-contain" src="{{ $ornDir }}/sunda-kujang-gold.png"/>
            </div>
            <span class="text-[9px] font-bold uppercase tracking-[0.28em] text-[#D4AF37]">
                Pangbagéa Pawiwahan • Adat Sunda
            </span>
            <div class="font-editorial text-2xl sm:text-3xl font-bold text-white mt-1 leading-snug">
                <span>{{ $couple['groom'] }}</span>
                <span class="font-vibes text-[#D4AF37] text-3xl font-normal mx-1">&amp;</span>
                <span>{{ $couple['bride'] }}</span>
            </div>
        </div>

        <!-- Full-Width Arch Pre-Wedding Portrait in Greenhouse -->
        <div class="relative z-20 w-full max-w-[340px] rounded-3xl p-2.5 glass-emerald reveal-scale">
            <div class="relative w-full h-[320px] rounded-2xl overflow-hidden shadow-2xl">
                <img alt="{{ $couple['groom'] }} & {{ $couple['bride'] }}"
                     class="w-full h-full object-cover object-center filter brightness-105 transition-transform duration-1000 hover:scale-105"
                     src="{{ $bg['hero'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-transparent to-transparent opacity-80 pointer-events-none"></div>

                <!-- Floating Venue & Date inside Portrait Bottom -->
                <div class="absolute bottom-3 inset-x-3 text-center pointer-events-none">
                    <p class="font-editorial text-lg text-[#F3E5AB] font-bold tracking-wide drop-shadow">{{ $formattedDate }}</p>
                    <p class="text-xs text-sage-200 mt-0.5 flex items-center justify-center gap-1 drop-shadow">
                        <span class="material-symbols-outlined text-xs text-[#D4AF37]">location_on</span>
                        <span>{{ $event['location'] }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Modern Frosted Glass Countdown Ribbon (Ngetang Wanci) -->
        <div class="relative z-20 w-full max-w-[340px] mt-6 reveal-up">
            <p class="text-center text-[9.5px] font-bold uppercase tracking-[0.28em] text-[#D4AF37] mb-2.5">
                Ngetang Wanci Bahagia
            </p>
            <div id="countdownGrid" class="grid grid-cols-4 gap-2.5" data-date="{{ $event['date_iso'] }}T{{ $event['time'] }}:00">
                @foreach ([['id' => 'cd-days', 'label' => 'Dinten', 'val' => '300'], ['id' => 'cd-hours', 'label' => 'Jam', 'val' => '11'], ['id' => 'cd-mins', 'label' => 'Menit', 'val' => '35'], ['id' => 'cd-secs', 'label' => 'Detik', 'val' => '20']] as $tile)
                    <div class="relative rounded-2xl glass-emerald py-3 px-1 text-center overflow-hidden border border-[#D4AF37]/35 shadow-lg">
                        <span class="absolute top-1.5 left-1.5 w-1 h-1 rounded-full bg-[#D4AF37]"></span>
                        <span class="absolute top-1.5 right-1.5 w-1 h-1 rounded-full bg-[#D4AF37]"></span>
                        <span id="{{ $tile['id'] }}" class="block font-editorial font-bold text-xl sm:text-2xl text-[#F3E5AB] leading-none">{{ $tile['val'] }}</span>
                        <span class="block text-[8px] font-bold uppercase tracking-[0.16em] text-sage-300 mt-1.5">{{ $tile['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Divider with Gold Sunda Emblem -->
        <div class="flex items-center justify-center gap-3 mt-8 w-44 opacity-80">
            <span class="h-[1px] flex-1 bg-gradient-to-r from-transparent to-[#D4AF37]"></span>
            <span class="text-[#D4AF37] text-sm">✦</span>
            <span class="h-[1px] flex-1 bg-gradient-to-l from-transparent to-[#D4AF37]"></span>
        </div>
    </section>

    <!-- =================================================================
         3. QUOTE SECTION: "PANGGEUING ASIH" (SACRED SUNDANESE BLESSING)
         ================================================================= -->
    <section class="relative py-14 px-6 overflow-hidden">
        <div class="relative z-10 max-w-[360px] mx-auto text-center">
            
            <!-- Floating Siger Sunda Crest -->
            <div class="w-16 h-16 mx-auto mb-3 reveal-scale drop-shadow-[0_8px_18px_rgba(212,175,55,0.4)]">
                <img alt="Siger Sunda" class="w-full h-full object-contain anim-siger-glow" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>

            <!-- Sacred Blessing Card -->
            <div class="relative glass-emerald rounded-3xl p-6 sm:p-7 shadow-2xl reveal-up">
                <!-- Golden Corner Flourishes -->
                <span class="absolute top-3 left-3 text-[#D4AF37]/60 text-xs">✦</span>
                <span class="absolute top-3 right-3 text-[#D4AF37]/60 text-xs">✦</span>
                <span class="absolute bottom-3 left-3 text-[#D4AF37]/60 text-xs">✦</span>
                <span class="absolute bottom-3 right-3 text-[#D4AF37]/60 text-xs">✦</span>

                <span class="material-symbols-outlined text-2xl text-[#D4AF37] mb-2">format_quote</span>

                <p class="font-editorial italic text-sm leading-relaxed text-[#F3E5AB] mb-4">
                    "Mugia Gusti Nu Maha Suci maparin barokah, ngahijikeun dua manah dina lambang asih sajati, runtut raut sauyunan sabobot sapihanean nepi ka pakena pakena."
                </p>

                <div class="h-[1px] w-24 mx-auto bg-gradient-to-r from-transparent via-[#D4AF37]/60 to-transparent my-3.5"></div>

                <p class="font-cormorant italic text-xs leading-relaxed text-sage-200">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                </p>

                <div class="mt-5 inline-flex items-center gap-2 px-4 py-1 rounded-full bg-emerald-950/80 border border-[#D4AF37]/50 shadow-inner">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                    <span class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#F3E5AB]">QS. Ar-Rum : 21</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================================
         4. COUPLE SECTION: "SANG MEMPELAI" (PANGANTEN PAMEGET & ISTRI)
         ================================================================= -->
    <section id="coupleSection" class="relative py-16 px-6 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#D4AF37]">Panganten Sauyunan</span>
            <h2 class="font-editorial text-3xl font-bold text-white mt-1">Sang Mempelai</h2>
            <p class="text-xs text-sage-300 mt-2 leading-relaxed">
                Kalayan panyalindungan sareng ridho Allah SWT, sim kuring seja nguningakeun tali asih pernikahan:
            </p>
        </div>

        <!-- GROOM CARD (Panganten Pameget) -->
        <div class="relative max-w-[350px] mx-auto glass-emerald rounded-3xl p-5 mb-8 shadow-2xl reveal-left">
            <div class="relative w-full h-[280px] rounded-2xl overflow-hidden shadow-lg mb-4 border border-[#D4AF37]/40">
                <img alt="{{ $couple['groom'] }}" class="w-full h-full object-cover object-top filter brightness-105" src="{{ $bg['groom'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/80 via-transparent to-transparent pointer-events-none"></div>

                <div class="absolute top-3 right-3 w-10 h-10 rounded-full glass-emerald flex items-center justify-center border border-[#D4AF37]/50 shadow">
                    <img alt="Kujang" class="w-6 h-6 object-contain" src="{{ $ornDir }}/sunda-kujang-gold.png"/>
                </div>

                <span class="absolute bottom-2.5 inset-x-0 text-center text-[9.5px] font-bold uppercase tracking-[0.25em] text-[#F3E5AB]">
                    Panganten Pameget
                </span>
            </div>

            <div class="text-center px-2">
                <h3 class="font-editorial text-2xl text-white font-bold">{{ $couple['groom_full'] }}</h3>
                <p class="text-[10.5px] font-bold uppercase tracking-[0.2em] text-[#D4AF37] mt-1.5">Putra Tercinta Ti:</p>
                <p class="font-cormorant text-base text-sage-200 font-semibold mt-0.5">{{ $couple['parents']['groom'] }}</p>

                <!-- Instagram Button -->
                <a href="{{ $couple['instagram']['groom'] }}" target="_blank" rel="noopener noreferrer" class="mt-3.5 inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-950/70 border border-[#D4AF37]/40 text-[#F3E5AB] text-[11px] font-semibold hover:bg-emerald-900 transition">
                    <span class="material-symbols-outlined text-sm">alternate_email</span>
                    <span>{{ $couple['groom'] }}</span>
                </a>
            </div>
        </div>

        <!-- Royal Connector: "Dua Manah Ngajadi Hiji" -->
        <div class="flex flex-col items-center justify-center my-4 reveal-scale">
            <div class="relative w-16 h-16 drop-shadow-md">
                <img alt="Siger Sunda" class="w-full h-full object-contain anim-siger-glow" src="{{ $ornDir }}/sunda-siger-gold.png"/>
            </div>
            <span class="font-vibes text-3xl sm:text-4xl text-[#D4AF37] -mt-1">&amp;</span>
            <p class="text-[9.5px] uppercase tracking-[0.25em] text-[#D4AF37] font-semibold mt-0.5">Dua Manah Ngajadi Hiji</p>
        </div>

        <!-- BRIDE CARD (Panganten Istri) -->
        <div class="relative max-w-[350px] mx-auto glass-emerald rounded-3xl p-5 mt-4 shadow-2xl reveal-right">
            <div class="relative w-full h-[280px] rounded-2xl overflow-hidden shadow-lg mb-4 border border-[#D4AF37]/40">
                <img alt="{{ $couple['bride'] }}" class="w-full h-full object-cover object-top filter brightness-105" src="{{ $bg['bride'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/80 via-transparent to-transparent pointer-events-none"></div>

                <div class="absolute top-3 right-3 w-10 h-10 rounded-full glass-emerald flex items-center justify-center border border-[#D4AF37]/50 shadow">
                    <img alt="Siger" class="w-6 h-6 object-contain" src="{{ $ornDir }}/sunda-siger-gold.png"/>
                </div>

                <span class="absolute bottom-2.5 inset-x-0 text-center text-[9.5px] font-bold uppercase tracking-[0.25em] text-[#F3E5AB]">
                    Panganten Istri
                </span>
            </div>

            <div class="text-center px-2">
                <h3 class="font-editorial text-2xl text-white font-bold">{{ $couple['bride_full'] }}</h3>
                <p class="text-[10.5px] font-bold uppercase tracking-[0.2em] text-[#D4AF37] mt-1.5">Putri Tercinta Ti:</p>
                <p class="font-cormorant text-base text-sage-200 font-semibold mt-0.5">{{ $couple['parents']['bride'] }}</p>

                <!-- Instagram Button -->
                <a href="{{ $couple['instagram']['bride'] }}" target="_blank" rel="noopener noreferrer" class="mt-3.5 inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-950/70 border border-[#D4AF37]/40 text-[#F3E5AB] text-[11px] font-semibold hover:bg-emerald-900 transition">
                    <span class="material-symbols-outlined text-sm">alternate_email</span>
                    <span>{{ $couple['bride'] }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- =================================================================
         5. EVENT SCHEDULE SECTION: "RUNTUYAN UPACARA & RESEPSI"
         ================================================================= -->
    <section id="eventSection" class="relative py-16 px-6 overflow-hidden">
        <div class="relative z-10 text-center max-w-[340px] mx-auto mb-9 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#D4AF37]">Wanci &amp; Tempat</span>
            <h2 class="font-editorial text-3xl font-bold text-white mt-1">Runtuyan Acara</h2>
            <p class="text-xs text-sage-300 mt-2 leading-relaxed">
                Mangrupikeun kahormatan sareng kabagjaan kanggo sim kuring upami Bapa/Ibu/Saderek kersa sumping dina:
            </p>
        </div>

        <!-- Schedule Cards -->
        <div class="relative z-10 space-y-6 max-w-[350px] mx-auto">
            @foreach ($schedule as $idx => $item)
                <div class="relative glass-emerald rounded-3xl p-6 shadow-2xl {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <div class="flex items-center justify-between border-b border-[#D4AF37]/25 pb-3.5 mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-[#C5A059] to-[#997633] text-emerald-950 flex items-center justify-center shadow-lg font-bold">
                                <span class="material-symbols-outlined text-2xl">{{ $idx === 0 ? 'volunteer_activism' : 'celebration' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-[#D4AF37] block">Bagian 0{{ $idx + 1 }}</span>
                                <h3 class="font-editorial font-bold text-lg text-white leading-tight mt-0.5">{{ $item['title'] }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center gap-3 text-sage-200">
                            <span class="material-symbols-outlined text-lg text-[#D4AF37]">calendar_month</span>
                            <span class="font-semibold">{{ $formattedDate }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sage-200">
                            <span class="material-symbols-outlined text-lg text-[#D4AF37]">schedule</span>
                            <span class="font-semibold">{{ $item['time'] }}</span>
                        </div>
                        <div class="flex items-start gap-3 text-sage-300">
                            <span class="material-symbols-outlined text-lg text-[#D4AF37] mt-0.5">location_on</span>
                            <div>
                                <p class="font-bold text-white text-sm">{{ $item['venue'] }}</p>
                                <p class="text-[11px] text-[#F3E5AB] mt-0.5">{{ $item['note'] }}</p>
                                <p class="text-[11px] text-sage-300 mt-0.5">{{ $event['address'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Google Maps Link Button -->
        <div class="relative z-10 max-w-[350px] mx-auto mt-7 text-center reveal-up">
            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2.5 w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-[#C5A059] via-[#F3E5AB] to-[#C5A059] text-emerald-950 font-bold text-xs uppercase tracking-[0.2em] shadow-[0_12px_28px_rgba(212,175,55,0.35)] hover:brightness-110 active:scale-95 transition">
                <span class="material-symbols-outlined text-base">map</span>
                <span>Pituduh Lokasi (Google Maps)</span>
            </a>
        </div>
    </section>

    <!-- =================================================================
         6. LOVE STORY TIMELINE: "RUNTUYAN ASIH"
         ================================================================= -->
    <section id="storySection" class="relative py-16 px-6 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#D4AF37]">Kisah Sauyunan</span>
            <h2 class="font-editorial text-3xl font-bold text-white mt-1">Runtuyan Asih</h2>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-[#D4AF37]/50"></span>
                <span class="text-[#D4AF37] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-[#D4AF37]/50"></span>
            </div>
        </div>

        <div class="relative max-w-[350px] mx-auto pl-6 border-l-2 border-dashed border-[#D4AF37]/60 space-y-6">
            @foreach ($stories as $idx => $st)
                <div class="relative glass-emerald rounded-2xl p-5 shadow-lg {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <!-- Pin on Timeline -->
                    <div class="absolute -left-[37px] top-5 w-6 h-6 rounded-full bg-gradient-to-br from-[#C5A059] to-[#997633] border-2 border-white flex items-center justify-center text-emerald-950 font-bold text-[10px] shadow">
                        {{ $idx + 1 }}
                    </div>

                    <div class="flex items-center justify-between mb-1.5">
                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-950 text-[#F3E5AB] font-bold text-[10px] tracking-wider uppercase border border-[#D4AF37]/40">
                            {{ $st['date'] }}
                        </span>
                        <span class="text-[10px] font-editorial italic text-[#D4AF37]">Babak 0{{ $idx + 1 }}</span>
                    </div>
                    <h3 class="font-editorial font-bold text-base text-white">{{ $st['title'] }}</h3>
                    <p class="text-xs text-sage-200 leading-relaxed mt-1.5">{{ $st['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         7. GALLERY SECTION: "POTRET PANGANTEN"
         ================================================================= -->
    <section id="gallerySection" class="relative py-16 px-6 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#D4AF37]">Koleksi Foto</span>
            <h2 class="font-editorial text-3xl font-bold text-white mt-1">Potret Panganten</h2>
            <div class="flex items-center justify-center gap-2 mt-3 w-40 mx-auto opacity-70">
                <span class="h-[1px] flex-1 bg-[#D4AF37]/50"></span>
                <span class="text-[#D4AF37] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-[#D4AF37]/50"></span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3.5 max-w-[360px] mx-auto">
            @foreach ($gallery as $idx => $imgUrl)
                <div onclick="openLightbox('{{ $imgUrl }}')" class="group cursor-pointer relative overflow-hidden rounded-2xl glass-emerald p-1.5 shadow-xl reveal-scale {{ $idx === 0 ? 'col-span-2 h-56' : 'h-44' }}">
                    <div class="w-full h-full rounded-xl overflow-hidden relative">
                        <img alt="Gallery {{ $idx + 1 }}" class="w-full h-full object-cover filter brightness-105 transition-transform duration-700 group-hover:scale-110" src="{{ $imgUrl }}"/>
                        <div class="absolute inset-0 bg-emerald-950/0 group-hover:bg-emerald-950/40 transition-colors flex items-center justify-center">
                            <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl drop-shadow">zoom_in</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         8. DIGITAL GIFT SECTION: "HATURAN TANDA ASIH"
         ================================================================= -->
    <section id="giftSection" class="relative py-16 px-6 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#D4AF37]">Kado Pawiwahan</span>
            <h2 class="font-editorial text-3xl font-bold text-white mt-1">Tanda Asih</h2>
            <p class="text-xs text-sage-300 mt-2 leading-relaxed">
                Doa restu ti Bapa/Ibu/Saderek mangrupikeun kurnia pangéndahna kanggo sim kuring. Nanging saupami badé maparin tanda asih, tiasa ngalangkungan:
            </p>
        </div>

        <div class="space-y-4 max-w-[350px] mx-auto">
            @foreach ($gifts as $idx => $gift)
                <div class="relative glass-emerald rounded-3xl p-5 shadow-2xl reveal-up">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3.5 py-1 rounded-full bg-emerald-950 text-[#F3E5AB] text-[10px] font-bold uppercase tracking-wider border border-[#D4AF37]/40">
                            {{ $gift['bank'] }}
                        </span>
                        <span class="material-symbols-outlined text-[#D4AF37]">account_balance_wallet</span>
                    </div>
                    <p class="font-mono font-bold text-lg text-white tracking-wider">{{ $gift['account'] }}</p>
                    <p class="text-xs text-sage-300 mt-0.5">a.n. <strong class="text-[#F3E5AB]">{{ $gift['name'] }}</strong></p>

                    <button type="button" onclick="copyBankAccount('{{ $gift['account'] }}', this)" class="mt-3.5 inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-emerald-950 hover:bg-emerald-900 border border-[#D4AF37]/50 text-[#F3E5AB] text-[11px] font-bold tracking-wider uppercase transition">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                        <span class="copy-label">Salin Nomer Rékéning</span>
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         9. RSVP & WISHES SECTION: "BUKU TAMU & PANEDA RESTU"
         ================================================================= -->
    <section id="rsvpSection" class="relative py-16 px-6 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#D4AF37]">Buku Tamu</span>
            <h2 class="font-editorial text-3xl font-bold text-white mt-1">Du'a &amp; Pangharepan</h2>
            <div class="flex items-center justify-center gap-2 mt-3 w-40 mx-auto opacity-70">
                <span class="h-[1px] flex-1 bg-[#D4AF37]/50"></span>
                <span class="text-[#D4AF37] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-[#D4AF37]/50"></span>
            </div>
        </div>

        <div class="max-w-[350px] mx-auto glass-emerald rounded-3xl p-6 shadow-2xl reveal-up">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-950 border border-emerald-500 text-[#F3E5AB] text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form id="wishesForm" action="{{ isset($invitation) ? route('invitations.comments.store', $invitation->id) : '#' }}" method="POST" onsubmit="return handleWishSubmit(event)" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-sage-200 mb-1">Jenengan Lengkep</label>
                    <input type="text" name="name" id="wishName" required placeholder="Tuliskeun jenengan anjeun" class="w-full rounded-xl border-[#D4AF37]/40 bg-emerald-950/70 text-xs text-white placeholder-sage-400 focus:border-[#D4AF37] focus:ring-[#D4AF37]"/>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-sage-200 mb-1">Konfirmasi Kasumpingan</label>
                    <select name="status" id="wishStatus" class="w-full rounded-xl border-[#D4AF37]/40 bg-emerald-950/70 text-xs text-white focus:border-[#D4AF37] focus:ring-[#D4AF37]">
                        <option value="Hadir">Insya Allah Hadir</option>
                        <option value="Tidak Hadir">Hapunten Teu Tiasa Hadir</option>
                        <option value="Ragu-ragu">Masih Ragu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-sage-200 mb-1">Du'a &amp; Pangharepan</label>
                    <textarea name="message" id="wishMessage" rows="3" required placeholder="Tuliskeun du'a restu anu haneut kanggo kadua mempelai..." class="w-full rounded-xl border-[#D4AF37]/40 bg-emerald-950/70 text-xs text-white placeholder-sage-400 focus:border-[#D4AF37] focus:ring-[#D4AF37]"></textarea>
                </div>
                <button type="submit" class="w-full py-3.5 px-5 rounded-full bg-gradient-to-r from-[#C5A059] via-[#F3E5AB] to-[#C5A059] text-emerald-950 font-bold text-xs uppercase tracking-[0.2em] shadow-lg hover:brightness-110 active:scale-95 transition">
                    Kintun Du'a
                </button>
            </form>

            <!-- Wishes Wall -->
            <div id="wishesWall" class="mt-6 pt-4 border-t border-[#D4AF37]/25 max-h-64 overflow-y-auto space-y-3 pr-1">
                @foreach ($wishes as $w)
                    <div class="p-3.5 rounded-2xl bg-emerald-950/70 border border-[#D4AF37]/25">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-editorial font-bold text-xs text-[#F3E5AB]">{{ $w['name'] }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $w['status'] === 'Hadir' ? 'bg-[#D4AF37] text-emerald-950' : 'bg-slate-700 text-slate-300' }}">
                                {{ $w['status'] }}
                            </span>
                        </div>
                        <p class="text-xs text-sage-200 leading-relaxed">{{ $w['message'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =================================================================
         10. CLOSING FOOTER: "PANUTUP & HATUR NUHUN"
         ================================================================= -->
    <footer class="relative pt-16 pb-28 px-6 bg-gradient-to-b from-[#071C12] via-[#04100A] to-[#020704] text-white text-center overflow-hidden">
        <!-- Royal Siger Sunda Emblem with Shimmer -->
        <div class="relative w-24 h-24 mx-auto mb-4 reveal-scale drop-shadow-[0_10px_25px_rgba(212,175,55,0.5)]">
            <img alt="Sunda Siger" class="w-full h-full object-contain anim-siger-glow" src="{{ $ornDir }}/sunda-siger-gold.png"/>
        </div>

        <p class="font-editorial italic text-sm text-[#F3E5AB] max-w-[320px] mx-auto mb-3.5 leading-relaxed">
            "Hatur nuhun kana paneda sareng du'a restu ti wargi sadayana. Mugi janten amal kasaean sareng kenging balesan ti Gusti Allah SWT."
        </p>

        <p class="text-xs text-sage-300 max-w-[300px] mx-auto leading-relaxed">
            Mangrupikeun kahormatan sareng kabagjaan kanggo sim kuring sakulawargi saupami Bapa/Ibu/Saderek kersa sumping ngaluuhan ieu acara.
        </p>
        
        <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-[#D4AF37] mt-5">Sim Kuring Nu Berbahagia</p>
        <h3 class="font-editorial text-3xl text-white mt-1.5">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h3>
    </footer>

    <!-- =================================================================
         STICKY BOTTOM NAVIGATION (LUXURY EMERALD & GOLD)
         ================================================================= -->
    <nav class="fixed bottom-2.5 inset-x-0 z-40 mx-auto w-[90%] max-w-[350px] rounded-full bg-emerald-950/90 backdrop-blur-md border border-[#D4AF37]/50 shadow-[0_12px_30px_rgba(0,0,0,0.65)] px-2 py-1.5 flex items-center justify-around">
        <a href="#heroSection" class="flex flex-col items-center text-sage-300 hover:text-[#F3E5AB] transition">
            <span class="material-symbols-outlined text-base">home</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Home</span>
        </a>
        <a href="#coupleSection" class="flex flex-col items-center text-sage-300 hover:text-[#F3E5AB] transition">
            <span class="material-symbols-outlined text-base">favorite</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Mempelai</span>
        </a>
        <a href="#eventSection" class="flex flex-col items-center text-sage-300 hover:text-[#F3E5AB] transition">
            <span class="material-symbols-outlined text-base">event</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Acara</span>
        </a>
        <a href="#gallerySection" class="flex flex-col items-center text-sage-300 hover:text-[#F3E5AB] transition">
            <span class="material-symbols-outlined text-base">photo_library</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Galeri</span>
        </a>
        <a href="#rsvpSection" class="flex flex-col items-center text-sage-300 hover:text-[#F3E5AB] transition">
            <span class="material-symbols-outlined text-base">chat</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Ucapan</span>
        </a>
    </nav>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" onclick="closeLightbox()" class="fixed inset-0 z-50 hidden bg-emerald-950/95 backdrop-blur-md items-center justify-center p-4">
        <button type="button" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center">
            <span class="material-symbols-outlined">close</span>
        </button>
        <img id="lightboxImage" alt="Preview" class="max-w-full max-h-[85vh] rounded-2xl border-2 border-[#D4AF37] shadow-2xl object-contain" src=""/>
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
            }, 1250);
        }

        playSundaMusic();

        setTimeout(() => {
            const hero = document.getElementById('heroSection');
            if (hero) {
                hero.scrollIntoView({ behavior: 'smooth' });
            }
        }, 200);
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
        }, { threshold: 0.10 });

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
            if (label) label.textContent = 'Parantos Disalin!';
            btn.classList.add('bg-emerald-800', 'text-[#F3E5AB]');
            setTimeout(() => {
                if (label) label.textContent = originalText;
                btn.classList.remove('bg-emerald-800', 'text-[#F3E5AB]');
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
            card.className = 'p-3.5 rounded-2xl bg-emerald-950/70 border border-[#D4AF37]/25';
            card.innerHTML = `
                <div class="flex items-center justify-between mb-1">
                    <span class="font-editorial font-bold text-xs text-[#F3E5AB]">${escapeHtml(name)}</span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase ${status === 'Hadir' ? 'bg-[#D4AF37] text-emerald-950' : 'bg-slate-700 text-slate-300'}">
                        ${status}
                    </span>
                </div>
                <p class="text-xs text-sage-200 leading-relaxed">${escapeHtml(message)}</p>
            `;
            wall.prepend(card);

            document.getElementById('wishesForm').reset();
            alert('Hatur nuhun! Du\'a sareng pangharepan anjeun parantos kakintun.');
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
