@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Aditya');
        $brideName = trim($names[1] ?? 'Arumi');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Rahardian & Ibu Astuti',
                'bride' => 'Bpk. Kusumo & Ibu Indah',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-08-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'De Molen Glasshouse & Garden',
            'address' => $invitation->address ?? 'Jalan Veteran No. 45, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Heritage Residence, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'De Molen Pavilion'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '19:00 - 21:00 WIB',
                'note' => $invitation->address ?? 'Royal Delft Grand Ballroom'
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
                ['title' => 'The First Encounter', 'date' => '09 Jan 2021', 'text' => 'Bermula dari secangkir kopi hangat di pagi yang berangin, percakapan sederhana tumbuh menjadi rasa nyaman yang tak tergantikan.'],
                ['title' => 'The Commitment', 'date' => '25 Agt 2023', 'text' => 'Di bawah langit senja keemasan bagai hamparan kebun tulip yang mekar, kami mengikat janji untuk melangkah menuju masa depan bersama.'],
                ['title' => 'The Eternal Union', 'date' => '24 Agt 2026', 'text' => 'Dua hati kini bersatu dalam ikatan suci pernikahan, berputar selaras layaknya kincir angin yang setia menyambut hembusan waktu.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-01/images/image_1.jpg'),
                asset('assets/templates/wedding-01/images/image_2.jpg'),
                asset('assets/templates/wedding-01/images/image_3.jpg'),
                asset('assets/templates/wedding-01/images/image_4.jpg'),
                asset('assets/templates/wedding-01/images/image_5.jpg'),
                asset('assets/templates/wedding-01/images/image_6.jpg'),
                asset('assets/templates/wedding-01/images/image_7.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-01/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-01/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-01/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-01/images/image_6.jpg'),
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
                ['name' => 'Sarah & Johan', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Aditya & Arumi! Semoga cinta kalian selalu mekar indah seperti hamparan bunga tulip di musim semi.'],
                ['name' => 'Om Hendra Wijaya', 'status' => 'Hadir', 'message' => 'Turut berbahagia menyaksikan ikatan suci ini. Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
                ['name' => 'Anya & Keluarga', 'status' => 'Hadir', 'message' => 'Undangan vintage kincir angin Belandanya cantik sekali! Sampai bertemu di hari bahagia kalian ya!'],
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
                ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Aditya Rahardian', 'account' => '8420-5519-02'],
                ['bank' => 'Bank Mandiri', 'name' => 'Arumi Kusumo', 'account' => '124-00-9882716-4'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/boho-wedding-bg.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Aditya',
            'bride' => 'Arumi',
            'parents' => [
                'groom' => 'Bpk. Rahardian & Ibu Astuti',
                'bride' => 'Bpk. Kusumo & Ibu Indah',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-24',
            'time' => '08:00',
            'location' => 'De Molen Glasshouse & Garden',
            'address' => 'Jalan Veteran No. 45, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=The+Heritage+Residence',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'De Molen Pavilion'],
            ['title' => 'Resepsi Pernikahan', 'time' => '19:00 - 21:00 WIB', 'note' => 'Royal Delft Grand Ballroom'],
        ];

        $stories = [
            ['title' => 'The First Encounter', 'date' => '09 Jan 2021', 'text' => 'Bermula dari secangkir kopi hangat di pagi yang berangin, percakapan sederhana tumbuh menjadi rasa nyaman yang tak tergantikan.'],
            ['title' => 'The Commitment', 'date' => '25 Agt 2023', 'text' => 'Di bawah langit senja keemasan bagai hamparan kebun tulip yang mekar, kami mengikat janji untuk melangkah menuju masa depan bersama.'],
            ['title' => 'The Eternal Union', 'date' => '24 Agt 2026', 'text' => 'Dua hati kini bersatu dalam ikatan suci pernikahan, berputar selaras layaknya kincir angin yang setia menyambut hembusan waktu.'],
        ];

        $gallery = [
            asset('assets/templates/wedding-01/images/image_1.jpg'),
            asset('assets/templates/wedding-01/images/image_2.jpg'),
            asset('assets/templates/wedding-01/images/image_3.jpg'),
            asset('assets/templates/wedding-01/images/image_4.jpg'),
            asset('assets/templates/wedding-01/images/image_5.jpg'),
            asset('assets/templates/wedding-01/images/image_6.jpg'),
            asset('assets/templates/wedding-01/images/image_7.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-01/images/image_1.jpg'),
            'hero' => asset('assets/templates/wedding-01/images/image_2.jpg'),
            'groom' => asset('assets/templates/wedding-01/images/image_5.jpg'),
            'bride' => asset('assets/templates/wedding-01/images/image_6.jpg'),
        ];

        $wishes = [
            ['name' => 'Sarah & Johan', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Aditya & Arumi! Semoga cinta kalian selalu mekar indah seperti hamparan bunga tulip di musim semi.'],
            ['name' => 'Om Hendra Wijaya', 'status' => 'Hadir', 'message' => 'Turut berbahagia menyaksikan ikatan suci ini. Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
            ['name' => 'Anya & Keluarga', 'status' => 'Hadir', 'message' => 'Undangan vintage kincir angin Belandanya cantik sekali! Sampai bertemu di hari bahagia kalian ya!'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Aditya Rahardian', 'account' => '8420-5519-02'],
            ['bank' => 'Bank Mandiri', 'name' => 'Arumi Kusumo', 'account' => '124-00-9882716-4'],
        ];

        $musicUrl = asset('musics/boho-wedding-bg.mp3');
    }

    $ornDir = asset('assets/templates/wedding-01/ornaments');
    
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
    $dayName = $daysMap[$dateObj->format('l')] ?? 'Senin';
    $monthName = $monthsMap[(int)$dateObj->format('n')] ?? 'Agustus';
    $formattedDate = $dayName . ', ' . $dateObj->format('d') . ' ' . $monthName . ' ' . $dateObj->format('Y');
    $formattedDateCover = mb_strtoupper($formattedDate, 'UTF-8');
    $guestName = request('to', 'Tamu Undangan');
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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&amp;family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&amp;family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;family=Alex+Brush&amp;family=Great+Vibes&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            800: '#1B3B60',
                            850: '#183B65',
                            900: '#142E4E',
                            950: '#0E2138',
                        },
                        delft: {
                            50:  '#F4F8FD',
                            100: '#E5EFFB',
                            200: '#C5DCF6',
                            300: '#92BEEE',
                            400: '#5899E2',
                            500: '#2E76CE',
                            600: '#1D58A8',
                            700: '#163E73',
                            800: '#0F2B54',
                            900: '#091B38',
                        },
                        alabaster: {
                            DEFAULT: '#FAF7F2',
                            card: '#FAF7F2',
                            warm: '#F5EFE6',
                            border: '#E8E1D5',
                        },
                        dutch: {
                            gold: '#C5A059',
                            goldLight: '#E2C78A',
                            goldDark: '#997633',
                            red: '#B9382E',
                        }
                    },
                    fontFamily: {
                        editorial: ['Playfair Display', 'serif'],
                        cormorant: ['Cormorant Garamond', 'serif'],
                        script: ['Alex Brush', 'cursive'],
                        vibes: ['Great Vibes', 'cursive'],
                        royal: ['Cinzel Decorative', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        };
    </script>

    <style>
        :root {
            --navy-primary: #183B65;
            --navy-deep: #0E2138;
            --alabaster: #FAF7F2;
            --gold-accent: #C5A059;
        }

        body {
            background-color: #0E2138;
            color: #183B65;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Subtle tactile parchment / Dutch linen texture */
        .bg-alabaster-paper {
            background-color: #FAF7F2;
            background-image:
                radial-gradient(#183B65 0.5px, transparent 0.5px),
                radial-gradient(#C5A059 0.5px, #FAF7F2 0.5px);
            background-size: 24px 24px;
            background-position: 0 0, 12px 12px;
            background-opacity: 0.04;
        }

        /* Diagonal organic division line between Navy header and Alabaster card */
        .navy-header-slant {
            clip-path: polygon(0 0, 100% 0, 100% 86%, 0 100%);
        }

        /* ==============================================================
           ANIMATIONS FOR INDIVIDUAL SEPARATED ASSETS
           ============================================================== */

        /* 1. Stamp Entrance & Micro-Floating */
        @keyframes stampDropIn {
            0% {
                opacity: 0;
                transform: translateY(-50px) scale(1.18) rotate(-6deg);
            }
            70% {
                opacity: 1;
                transform: translateY(4px) scale(0.97) rotate(3.2deg);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1) rotate(2deg);
            }
        }
        .anim-stamp-in {
            animation: stampDropIn 1.1s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            will-change: transform, opacity;
        }

        @keyframes stampGentleFloat {
            0%, 100% {
                transform: rotate(2deg) translateY(0);
            }
            50% {
                transform: rotate(1.2deg) translateY(-3.5px);
            }
        }
        .anim-stamp-float {
            animation: stampGentleFloat 5.2s ease-in-out infinite;
        }

        /* 2. Postmark Stamp Ink Impression Entrance */
        @keyframes postmarkStampIn {
            0% {
                opacity: 0;
                transform: scale(1.35) rotate(-10deg);
            }
            70% {
                opacity: 0.95;
                transform: scale(0.98) rotate(1deg);
            }
            100% {
                opacity: 0.92;
                transform: scale(1) rotate(0deg);
            }
        }
        .anim-postmark-in {
            animation: postmarkStampIn 0.85s cubic-bezier(0.22, 1, 0.36, 1) 0.3s both;
            will-change: transform, opacity;
        }

        /* 3. Delft Blue Botanical Tulip Swaying in Dutch Breeze */
        @keyframes tulipGentleSway {
            0%, 100% {
                transform: rotate(0deg) translateY(0) scale(1);
            }
            50% {
                transform: rotate(3.2deg) translateY(-5px) scale(1.02);
            }
        }
        .anim-tulip-sway {
            animation: tulipGentleSway 6.8s ease-in-out infinite;
            transform-origin: bottom right;
            will-change: transform;
        }

        /* 4. Living Canal Arch Window Cinematic Breathing (Ken Burns) */
        @keyframes livingArchZoom {
            0%, 100% {
                transform: scale(1) translate(0, 0);
            }
            50% {
                transform: scale(1.05) translate(-1%, -0.8%);
            }
        }
        .anim-arch-living {
            animation: livingArchZoom 16s ease-in-out infinite;
            will-change: transform;
        }

        /* Continuous Rotating Windmill Sails */
        @keyframes spinWindmill {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .anim-windmill-sails {
            animation: spinWindmill 18s linear infinite;
            transform-origin: 50% 50%;
            will-change: transform;
        }

        /* Twinkling 4-Point Gold Star */
        @keyframes starTwinkle {
            0%, 100% {
                opacity: 0.4;
                transform: scale(0.85) rotate(0deg);
            }
            50% {
                opacity: 1;
                transform: scale(1.25) rotate(18deg);
            }
        }
        .anim-star-twinkle {
            animation: starTwinkle 3.2s ease-in-out infinite;
        }

        /* Gentle Floating Gold Sparks & Petals */
        @keyframes gentleDrift {
            0% {
                transform: translate3d(-10vw, -10vh, 0) rotate(0deg);
                opacity: 0;
            }
            15% { opacity: 0.75; }
            85% { opacity: 0.75; }
            100% {
                transform: translate3d(105vw, 95vh, 0) rotate(320deg);
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
            transform: scale(1.15) translateY(-24px);
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
            transform: translateX(-32px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(32px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .is-visible {
            opacity: 1 !important;
            transform: translate(0, 0) scale(1) !important;
        }

        /* Dutch Window Shutter (Zandloperluik) Hourglass Pattern */
        .dutch-shutter {
            background:
                linear-gradient(135deg, #183B65 25%, transparent 25%) -8px 0,
                linear-gradient(225deg, #183B65 25%, transparent 25%) -8px 0,
                linear-gradient(315deg, #183B65 25%, transparent 25%),
                linear-gradient(45deg,  #183B65 25%, transparent 25%);
            background-size: 16px 32px;
            background-color: #FAF7F2;
        }

        /* Editorial Postal Border Frame */
        .postal-card-frame {
            border: 2px solid #183B65;
            box-shadow:
                0 18px 45px -12px rgba(20, 46, 78, 0.18),
                inset 0 0 0 3px #FAF7F2,
                inset 0 0 0 4.5px #C5A059;
        }

        /* Hide scrollbars */
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>

<body class="selection:bg-navy-850 selection:text-white">

<!-- =====================================================================
     MOBILE INVITATION CONTAINER (Max-Width 430px)
     ===================================================================== -->
<div class="relative mx-auto w-full max-w-[430px] min-h-screen bg-[#FAF7F2] shadow-[0_0_60px_rgba(0,0,0,0.65)] overflow-hidden">

    <!-- Subtle Ambient Dust / Petals Floating -->
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 mx-auto max-w-[430px] overflow-hidden z-30">
        <img alt="" class="drift-particle w-4 h-4 opacity-70" src="{{ $ornDir }}/white-petal.png" style="top: 10%; animation-duration: 14s; animation-delay: 0s;"/>
        <img alt="" class="drift-particle w-5 h-5 opacity-60" src="{{ $ornDir }}/tulip-petal.png" style="top: 35%; animation-duration: 16s; animation-delay: 3s;"/>
        <img alt="" class="drift-particle w-4 h-4 opacity-50" src="{{ $ornDir }}/white-petal.png" style="top: 65%; animation-duration: 15s; animation-delay: 7s;"/>
    </div>

    <!-- =================================================================
         1. EDITORIAL COVER OVERLAY (Exact Option 3 Match)
         ================================================================= -->
    <div id="coverOverlay" class="fixed inset-0 z-50 mx-auto w-full max-w-[430px] h-full overflow-hidden flex flex-col justify-between select-none bg-[#FAF7F2]">

        <!-- Top Half: Deep Royal Dutch Navy Editorial Background (#183B65) -->
        <div class="absolute top-0 inset-x-0 h-[46%] bg-[#183B65] navy-header-slant z-0 shadow-lg">
            <!-- Subtle pinstripe / linen grain on navy -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#FAF7F2_1px,transparent_1px)] [background-size:16px_16px]"></div>
        </div>

        <!-- ================= TOP HEADER BAR ================= -->
        <div class="relative z-20 pt-6 sm:pt-8 px-5 sm:px-6 flex items-start justify-between">
            <!-- Top Left: Spaced Serif Subtitle & Couple Names -->
            <div class="flex-1 pr-2 cover-zoom-target">
                <!-- THE WEDDING OF -->
                <div class="flex items-center gap-2 mb-1.5 sm:mb-2">
                    <span class="text-[9.5px] sm:text-[10.5px] font-medium tracking-[0.28em] uppercase text-delft-200/90 font-serif">The Wedding Of</span>
                    <span class="h-[1px] w-10 bg-delft-300/40"></span>
                </div>

                <!-- Groom Name: Aditya -->
                <h1 class="font-editorial text-[32px] sm:text-[40px] text-white tracking-tight leading-[0.95] drop-shadow-sm">
                    {{ $couple['groom'] }}
                </h1>

                <!-- Connector: & (Warm Antique Gold Script) -->
                <div class="flex items-center gap-1.5 my-0.5">
                    <span class="font-vibes text-2xl sm:text-3xl text-[#E2C78A] drop-shadow-sm leading-none">&amp;</span>
                    <!-- Bride Name: Arumi -->
                    <span class="font-editorial text-[32px] sm:text-[40px] text-white tracking-tight leading-[0.95] drop-shadow-sm">
                        {{ $couple['bride'] }}
                    </span>
                </div>
            </div>

            <!-- Top Right: Vintage Dutch Postage Stamp + Postal Cancellation Waves (SEPARATED & ANIMATED) -->
            <div class="relative w-24 sm:w-28 flex flex-col items-end pointer-events-none cover-zoom-target">
                <!-- Postage Stamp (Nederland Tulip Stamp) -->
                <div class="relative anim-stamp-in">
                    <img alt="Nederland Tulip Postage Stamp"
                         class="w-[82px] sm:w-[94px] drop-shadow-[0_10px_20px_rgba(0,0,0,0.38)] anim-stamp-float"
                         src="{{ $ornDir }}/nederland-stamp.png"/>

                    <!-- Amsterdam Postmark Overlay Imprint with Wavy Cancellation Lines -->
                    <div class="absolute -top-2.5 -left-2.5 w-[124px] sm:w-[138px] pointer-events-none anim-postmark-in">
                        <img alt="Amsterdam Cancellation Postmark"
                             class="w-full object-contain drop-shadow-sm"
                             src="{{ $ornDir }}/dutch-postmark.png"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= CENTER ARCH WINDOW (Living Dutch Windmill Canal Scene) ================= -->
        <div class="relative z-10 flex items-center justify-center -mt-2 sm:-mt-1 mb-1 px-4 cover-zoom-target">
            <!-- Arched Window Frame with White Porcelain Inset Border & Soft Shadow (Mathematically Concentric) -->
            <div class="relative w-[215px] sm:w-[245px] h-[275px] sm:h-[310px] rounded-t-full rounded-b-2xl border-[3px] border-white shadow-[0_18px_40px_rgba(20,46,78,0.22)] overflow-hidden bg-[#EAE6DF]">
                
                <!-- Dutch Windmill Canal Photo with Orange-Red Tulips (Living Breathing Micro-Motion) -->
                <div class="w-full h-full relative overflow-hidden rounded-t-full rounded-b-2xl">
                    <img alt="Dutch Historic Windmill & Canal with Tulips"
                         class="w-full h-full object-cover object-center anim-arch-living brightness-[0.98]"
                         src="{{ $ornDir }}/dutch-windmill-canal.jpg"/>

                    <!-- Soft Vignette & Morning Sunlight Flare -->
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-900/35 via-transparent to-transparent pointer-events-none"></div>

                    <!-- Delicate Golden Arch Rim Glow -->
                    <div class="pointer-events-none absolute inset-0 rounded-t-full rounded-b-2xl border border-[#C5A059]/40"></div>
                </div>
            </div>

            <!-- Right Side Accent: 4-Point Dutch Gold Star (Twinkling) -->
            <div class="absolute right-4 sm:right-6 top-1/2 -translate-y-1/2 pointer-events-none flex flex-col items-center gap-1">
                <span class="text-[#C5A059] text-lg sm:text-xl font-bold anim-star-twinkle select-none leading-none">✦</span>
                <div class="w-[1px] h-8 bg-gradient-to-b from-[#C5A059]/60 to-transparent"></div>
            </div>
        </div>

        <!-- ================= BOTTOM CARD BODY (Warm Alabaster #FAF7F2) ================= -->
        <div class="relative z-20 px-5 pb-6 pt-0 text-center cover-zoom-target">
            <!-- Thin Golden Divider Line -->
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="h-[1px] w-12 bg-gradient-to-r from-transparent to-[#C5A059]/70"></span>
                <span class="w-1.5 h-1.5 rotate-45 bg-[#C5A059]"></span>
                <span class="h-[1px] w-12 bg-gradient-to-l from-transparent to-[#C5A059]/70"></span>
            </div>

            <!-- Wedding Event Date (SENIN, 24 AGUSTUS 2026) -->
            <p class="font-editorial text-[11px] sm:text-xs font-semibold tracking-[0.18em] uppercase text-navy-850 whitespace-nowrap">
                {{ $formattedDateCover }}
            </p>

            <!-- Guest Recipient Pill Badge -->
            <div class="inline-flex flex-col items-center justify-center max-w-[240px] mx-auto mt-2 mb-3 py-1 px-3.5 rounded-xl bg-white/85 border border-[#E8E1D5] shadow-sm">
                <span class="text-[8.5px] uppercase tracking-[0.2em] text-[#7A8A9E] font-medium">Kepada Yth. Bapak/Ibu/Saudara/i</span>
                <span class="font-editorial font-bold text-xs text-navy-850 truncate max-w-[210px] mt-0.5">{{ $guestName }}</span>
            </div>

            <!-- CTA Pill Button: "BUKA UNDANGAN >" (Deep Navy with Gold Accents) -->
            <div class="flex justify-center">
                <button id="openInvitationBtn"
                        type="button"
                        onclick="openDutchInvitation()"
                        class="group relative inline-flex items-center justify-center gap-2.5 w-full max-w-[230px] py-2.5 sm:py-3 px-6 rounded-full bg-[#183B65] text-white font-serif font-semibold text-[11px] tracking-[0.2em] uppercase shadow-[0_10px_24px_rgba(24,59,101,0.35)] border border-[#C5A059]/60 hover:bg-[#122E52] active:scale-[0.98] transition-all">
                    <span>Buka Undangan</span>
                    <span class="text-[#E2C78A] text-xs group-hover:translate-x-1 transition-transform">›</span>
                </button>
            </div>
        </div>

        <!-- ================= BOTTOM RIGHT CORNER: DELFT BLUE BOTANICAL TULIP ETCHING (SEPARATE & SWAYING) ================= -->
        <div class="absolute -bottom-2 -right-2 w-[120px] sm:w-[140px] pointer-events-none z-10 drop-shadow-sm opacity-90">
            <img alt="Royal Delft Botanical Tulip Etching"
                 class="w-full object-contain anim-tulip-sway"
                 src="{{ $ornDir }}/delft-tulip-etching.png"/>
        </div>

    </div>

    <!-- =================================================================
         2. HERO SECTION ("HOLLAND HERITAGE EDITORIAL & COUNTDOWN")
         ================================================================= -->
    <section id="heroSection" class="relative min-h-screen pt-8 sm:pt-10 pb-24 px-4 sm:px-5 bg-alabaster-paper overflow-hidden flex flex-col items-center justify-start">

        <!-- Header: Living Miniature Dutch Windmill & Subtitle -->
        <div class="relative z-20 flex flex-col items-center text-center mt-1 mb-3.5 reveal-up">
            <!-- Living Miniature Dutch Windmill (Tower + Rotating 4-Blade Sails) -->
            <div class="relative w-[64px] h-[86px] mb-1.5 drop-shadow-md">
                <img alt="Dutch Windmill Tower" class="w-full h-full object-contain" src="{{ $ornDir }}/windmill-tower.png"/>
                <div class="absolute left-1/2 top-[24%] -translate-x-1/2 -translate-y-1/2 w-[82px] h-[82px] pointer-events-none">
                    <img alt="Rotating Windmill Sails" class="w-full h-full object-contain anim-windmill-sails" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
            </div>
            <span class="text-[8px] sm:text-[9.5px] font-bold uppercase tracking-[0.16em] sm:tracking-[0.24em] text-[#C5A059] whitespace-nowrap">Holland Heritage Romance • Negeri Kincir Angin</span>
            <h2 class="font-editorial text-2xl sm:text-3xl font-bold text-navy-850 mt-0.5">
                {{ $couple['groom'] }} <span class="font-vibes text-[#C5A059] text-2xl sm:text-3xl font-normal mx-0.5">&amp;</span> {{ $couple['bride'] }}
            </h2>
        </div>

        <!-- Dutch Arched Window Couple Portrait Frame (Concentric & Mathematically Symmetrical) -->
        <div class="relative z-20 w-full max-w-[280px] sm:max-w-[310px] rounded-t-full rounded-b-2xl bg-white border-2 border-navy-850 p-2 shadow-[0_16px_36px_rgba(20,46,78,0.14)] reveal-scale">
            <!-- Concentric Inner Gold Line -->
            <div class="rounded-t-full rounded-b-xl border border-[#C5A059]/60 p-1 bg-white">
                <!-- Arch Photo Container -->
                <div class="relative w-full h-[235px] sm:h-[275px] rounded-t-full rounded-b-lg overflow-hidden bg-navy-900 shadow-inner">
                    <img alt="{{ $couple['groom'] }} & {{ $couple['bride'] }}"
                         class="w-full h-full object-cover object-top transition-transform duration-1000 hover:scale-105"
                         src="{{ $bg['cover'] }}?v=20261025"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/70 via-transparent to-navy-950/10 pointer-events-none"></div>

                    <!-- Elegant celebration badge inside bottom of arch -->
                    <div class="absolute bottom-2.5 inset-x-3 text-center pointer-events-none">
                        <span class="inline-block px-3 py-0.5 rounded-full bg-navy-950/65 backdrop-blur-sm border border-amber-200/30 text-[8.5px] uppercase tracking-[0.22em] text-amber-200 font-semibold drop-shadow">
                            The Wedding Celebration
                        </span>
                    </div>
                </div>
            </div>

            <!-- Date & Venue Strip Inside Card -->
            <div class="pt-2.5 pb-1 px-2 text-center">
                <p class="font-editorial font-bold text-xs sm:text-sm text-navy-850 tracking-wide">{{ $formattedDate }}</p>
                <p class="text-[11px] text-[#5C6E82] mt-0.5 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-xs text-[#C5A059]">location_on</span>
                    <span>{{ $event['location'] }}</span>
                </p>
            </div>

            <!-- Delft Botanical Tulip Accent in Bottom Corner -->
            <img alt="" class="anim-tulip-sway absolute -bottom-3 -right-3 w-16 pointer-events-none drop-shadow-sm opacity-85" src="{{ $ornDir }}/delft-tulip-etching.png"/>
        </div>

        <!-- 4 Glazed Dutch Delft Ceramic Tile Countdown Boxes -->
        <div class="relative z-20 w-full max-w-[295px] mt-4.5 sm:mt-5 reveal-up">
            <p class="text-center text-[9px] font-bold uppercase tracking-[0.24em] text-navy-850 mb-2">
                Menghitung Hari Bahagia
            </p>
            <div id="countdownGrid" class="grid grid-cols-4 gap-2" data-date="{{ $event['date_iso'] }}T{{ $event['time'] }}:00">
                @foreach ([['id' => 'cd-days', 'label' => 'Hari', 'val' => '124'], ['id' => 'cd-hours', 'label' => 'Jam', 'val' => '08'], ['id' => 'cd-mins', 'label' => 'Menit', 'val' => '45'], ['id' => 'cd-secs', 'label' => 'Detik', 'val' => '30']] as $tile)
                    <div class="relative bg-white rounded-xl border border-navy-850 py-2 px-1 text-center shadow-[0_4px_12px_rgba(24,59,101,0.08)] overflow-hidden">
                        <!-- Corner Delft Tile Dots -->
                        <span class="absolute top-1 left-1 w-1 h-1 rounded-full bg-delft-200"></span>
                        <span class="absolute top-1 right-1 w-1 h-1 rounded-full bg-delft-200"></span>
                        <span class="absolute bottom-1 left-1 w-1 h-1 rounded-full bg-delft-200"></span>
                        <span class="absolute bottom-1 right-1 w-1 h-1 rounded-full bg-delft-200"></span>

                        <span id="{{ $tile['id'] }}" class="block font-editorial font-bold text-lg sm:text-xl text-navy-850 leading-none">{{ $tile['val'] }}</span>
                        <span class="block text-[8px] font-bold uppercase tracking-[0.16em] text-[#C5A059] mt-1">{{ $tile['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Windmill Divider -->
        <div class="flex items-center justify-center gap-2.5 mt-5 w-44 opacity-85">
            <span class="h-[1px] flex-1 bg-navy-850/40"></span>
            <div class="w-5 h-5 flex items-center justify-center">
                <img alt="" class="w-full h-full object-contain anim-windmill-sails" style="animation-duration: 12s;" src="{{ $ornDir }}/windmill-blades.png"/>
            </div>
            <span class="h-[1px] flex-1 bg-navy-850/40"></span>
        </div>
    </section>

    <!-- =================================================================
         3. QUOTE SECTION ("ROYAL DELFT BLUE WINDMILL CERAMIC PLAQUE")
         ================================================================= -->
    <section class="relative py-12 px-6 bg-[#F5EFE6] border-y border-[#E8E1D5] overflow-hidden">
        <div class="relative z-10 max-w-[360px] mx-auto text-center">
            <!-- Authentic 17th-Century Royal Delft Blue Windmill Ceramic Tile (Delfts Blauw Tegeltje) -->
            <div class="w-24 sm:w-28 mx-auto mb-3.5 reveal-scale drop-shadow-md">
                <img alt="Royal Delft Windmill Tile" class="w-full object-contain rounded-xl border border-navy-850/20 shadow-sm" src="{{ $ornDir }}/delft-windmill-tile.png"/>
            </div>

            <!-- Epistle Card -->
            <div class="relative bg-white rounded-2xl border-2 border-navy-850 p-6 shadow-[0_14px_32px_rgba(24,59,101,0.10)] reveal-up">
                <div class="pointer-events-none absolute inset-1.5 rounded-xl border border-[#C5A059]/60"></div>

                <span class="material-symbols-outlined text-2xl text-[#C5A059] mb-2">format_quote</span>
                <p class="font-editorial italic text-sm leading-relaxed text-navy-950">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                </p>
                <div class="mt-4 inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#FAF7F2] border border-[#E8E1D5]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#C5A059]"></span>
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-navy-850">QS. Ar-Rum : 21</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[#C5A059]"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================================
         4. COUPLE SECTION ("DUTCH ARCHITECTURAL WINDOWS & LIVING WINDMILL")
         ================================================================= -->
    <section id="coupleSection" class="relative py-16 px-6 bg-alabaster-paper overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Bruid &amp; Bruidegom</span>
            <h2 class="font-editorial text-2xl font-bold text-navy-850 mt-1">Sang Mempelai</h2>
            <p class="text-xs text-[#5C6E82] mt-2 leading-relaxed">
                Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud mengumumkan pernikahan kami:
            </p>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
                <div class="w-4 h-4 flex items-center justify-center">
                    <img alt="" class="w-full h-full object-contain anim-windmill-sails" style="animation-duration: 12s;" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
            </div>
        </div>

        <!-- GROOM CARD -->
        <div class="relative max-w-[350px] mx-auto postal-card-frame bg-white rounded-3xl p-5 mb-7 reveal-left">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-5 h-44 rounded-l-lg border border-navy-850 dutch-shutter shadow-sm"></div>
                <div class="relative w-44 h-52 rounded-t-full rounded-b-2xl overflow-hidden border-2 border-navy-850 shadow-md">
                    <img alt="{{ $couple['groom'] }}" class="w-full h-full object-cover object-top" src="{{ $bg['groom'] }}"/>
                    <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-navy-950/70 to-transparent"></div>
                    <span class="absolute bottom-2 inset-x-0 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-amber-200">The Groom</span>
                </div>
                <div class="w-5 h-44 rounded-r-lg border border-navy-850 dutch-shutter shadow-sm"></div>
            </div>

            <div class="text-center px-2">
                <h3 class="font-editorial text-3xl text-navy-850 font-bold">{{ $couple['groom'] }}</h3>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#C5A059] mt-1">Putra Tercinta Dari</p>
                <p class="font-cormorant text-base text-navy-900 font-semibold mt-0.5">{{ $couple['parents']['groom'] }}</p>
            </div>

            <!-- Delft Botanical Tulip Accent -->
            <img alt="" class="anim-tulip-sway absolute -bottom-4 -left-4 w-20 pointer-events-none drop-shadow-sm" src="{{ $ornDir }}/delft-tulip-etching.png"/>
        </div>

        <!-- Living Dutch Windmill Love Connector -->
        <div class="flex flex-col items-center justify-center my-4 reveal-scale">
            <div class="relative w-[64px] h-[86px] drop-shadow-md">
                <img alt="Dutch Windmill" class="w-full h-full object-contain" src="{{ $ornDir }}/windmill-tower.png"/>
                <div class="absolute left-1/2 top-[24%] -translate-x-1/2 -translate-y-1/2 w-[82px] h-[82px] pointer-events-none">
                    <img alt="" class="w-full h-full object-contain anim-windmill-sails" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
            </div>
            <span class="font-vibes text-3xl sm:text-4xl text-[#C5A059] -mt-1">&amp;</span>
            <p class="text-[9px] uppercase tracking-[0.25em] text-[#C5A059] font-medium mt-0.5">De Molen van Liefde</p>
        </div>

        <!-- BRIDE CARD -->
        <div class="relative max-w-[350px] mx-auto postal-card-frame bg-white rounded-3xl p-5 mt-3 reveal-right">
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="w-5 h-44 rounded-l-lg border border-navy-850 dutch-shutter shadow-sm"></div>
                <div class="relative w-44 h-52 rounded-t-full rounded-b-2xl overflow-hidden border-2 border-navy-850 shadow-md">
                    <img alt="{{ $couple['bride'] }}" class="w-full h-full object-cover object-top" src="{{ $bg['bride'] }}"/>
                    <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-navy-950/70 to-transparent"></div>
                    <span class="absolute bottom-2 inset-x-0 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-amber-200">The Bride</span>
                </div>
                <div class="w-5 h-44 rounded-r-lg border border-navy-850 dutch-shutter shadow-sm"></div>
            </div>

            <div class="text-center px-2">
                <h3 class="font-editorial text-3xl text-navy-850 font-bold">{{ $couple['bride'] }}</h3>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#C5A059] mt-1">Putri Tercinta Dari</p>
                <p class="font-cormorant text-base text-navy-900 font-semibold mt-0.5">{{ $couple['parents']['bride'] }}</p>
            </div>

            <!-- Delft Botanical Tulip Accent -->
            <img alt="" class="anim-tulip-sway absolute -bottom-4 -right-4 w-20 pointer-events-none drop-shadow-sm" src="{{ $ornDir }}/delft-tulip-etching.png"/>
        </div>
    </section>

    <!-- =================================================================
         5. EVENT SCHEDULE SECTION ("ROYAL DUTCH NIGHT")
         ================================================================= -->
    <section id="eventSection" class="relative py-16 px-6 bg-gradient-to-b from-navy-900 via-navy-850 to-navy-950 text-white overflow-hidden">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(#FAF7F2_1px,transparent_1px)] [background-size:24px_24px] opacity-10 pointer-events-none"></div>

        <!-- Section Header -->
        <div class="relative z-10 text-center max-w-[340px] mx-auto mb-9 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#E2C78A]">Tijd &amp; Locatie</span>
            <h2 class="font-editorial text-2xl font-bold text-white mt-1">Rangkaian Acara</h2>
            <p class="text-xs text-delft-200 mt-1.5">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir pada:
            </p>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-[#E2C78A]/40"></span>
                <div class="w-4 h-4 flex items-center justify-center">
                    <img alt="" class="w-full h-full object-contain anim-windmill-sails" style="animation-duration: 12s;" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
                <span class="h-[1px] flex-1 bg-[#E2C78A]/40"></span>
            </div>
        </div>

        <!-- Event Cards -->
        <div class="relative z-10 space-y-5 max-w-[350px] mx-auto">
            @foreach ($schedule as $idx => $item)
                <div class="relative bg-white text-navy-900 rounded-2xl border-2 border-[#C5A059] p-5 shadow-[0_16px_35px_rgba(0,0,0,0.35)] {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <div class="flex items-center justify-between border-b border-[#E8E1D5] pb-3 mb-3.5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-navy-850 text-[#E2C78A] flex items-center justify-center shadow">
                                <span class="material-symbols-outlined text-xl">{{ $idx === 0 ? 'volunteer_activism' : 'celebration' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] font-bold uppercase tracking-[0.22em] text-[#C5A059] block">Bagian 0{{ $idx + 1 }}</span>
                                <h3 class="font-editorial font-bold text-lg text-navy-850 leading-tight">{{ $item['title'] }}</h3>
                            </div>
                        </div>
                        <div class="w-6 h-6 flex items-center justify-center">
                            <img alt="Windmill Sail" class="w-full h-full object-contain anim-windmill-sails" style="animation-duration: 10s;" src="{{ $ornDir }}/windmill-blades.png"/>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center gap-2.5 text-navy-850">
                            <span class="material-symbols-outlined text-base text-[#C5A059]">calendar_month</span>
                            <span class="font-semibold">{{ $formattedDate }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-navy-850">
                            <span class="material-symbols-outlined text-base text-[#C5A059]">schedule</span>
                            <span class="font-semibold">{{ $item['time'] }}</span>
                        </div>
                        <div class="flex items-start gap-2.5 text-[#5C6E82]">
                            <span class="material-symbols-outlined text-base text-[#C5A059] mt-0.5">location_on</span>
                            <div>
                                <p class="font-bold text-navy-900">{{ $item['note'] }}</p>
                                <p class="text-[11px] text-[#7A8A9E] mt-0.5">{{ $event['address'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Google Maps Link Button -->
        <div class="relative z-10 max-w-[350px] mx-auto mt-7 text-center reveal-up">
            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2.5 w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-[#C5A059] via-[#E2C78A] to-[#C5A059] text-navy-950 font-bold text-xs uppercase tracking-[0.2em] shadow-[0_10px_25px_rgba(197,160,89,0.35)] hover:brightness-105 transition">
                <span class="material-symbols-outlined text-base">map</span>
                <span>Petunjuk Lokasi (Google Maps)</span>
            </a>
        </div>
    </section>

    <!-- =================================================================
         6. LOVE STORY TIMELINE ("KINDERDIJK MEMORIES")
         ================================================================= -->
    <section id="storySection" class="relative py-16 px-6 bg-[#F5EFE6] overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Ons Liefdesverhaal</span>
            <h2 class="font-editorial text-2xl font-bold text-navy-850 mt-1">Kisah Cinta Kami</h2>
            <div class="flex items-center justify-center gap-2.5 mt-3 w-40 mx-auto opacity-75">
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
                <div class="w-4 h-4 flex items-center justify-center">
                    <img alt="" class="w-full h-full object-contain anim-windmill-sails" style="animation-duration: 12s;" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
            </div>
        </div>

        <div class="relative max-w-[350px] mx-auto pl-6 border-l-2 border-dashed border-[#C5A059]/60 space-y-6">
            @foreach ($stories as $idx => $st)
                <div class="relative bg-white rounded-2xl border-2 border-navy-850 p-4 shadow-sm {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <!-- Canal Windmill Pin on Timeline Line -->
                    <div class="absolute -left-[37px] top-5 w-6 h-6 rounded-full bg-navy-850 border-2 border-[#C5A059] flex items-center justify-center p-0.5 shadow">
                        <img alt="" class="w-full h-full object-contain anim-windmill-sails" style="animation-duration: 12s;" src="{{ $ornDir }}/windmill-blades.png"/>
                    </div>

                    <div class="flex items-center justify-between mb-1.5">
                        <span class="px-2.5 py-0.5 rounded-full bg-delft-50 text-navy-850 font-bold text-[10px] tracking-wider uppercase border border-delft-200">
                            {{ $st['date'] }}
                        </span>
                        <span class="text-[10px] font-editorial italic text-[#C5A059]">Chapter 0{{ $idx + 1 }}</span>
                    </div>
                    <h3 class="font-editorial font-bold text-base text-navy-850">{{ $st['title'] }}</h3>
                    <p class="text-xs text-[#5C6E82] leading-relaxed mt-1.5">{{ $st['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         7. GALLERY SECTION ("EDITORIAL POSTAL PORTFOLIO")
         ================================================================= -->
    <section id="gallerySection" class="relative py-16 px-6 bg-alabaster-paper overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Herinneringen</span>
            <h2 class="font-editorial text-2xl font-bold text-navy-850 mt-1">Galeri Bahagia</h2>
            <div class="flex items-center justify-center gap-2 mt-3 w-40 mx-auto opacity-70">
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
                <span class="text-[#C5A059] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 max-w-[360px] mx-auto">
            @foreach ($gallery as $idx => $imgUrl)
                <div onclick="openLightbox('{{ $imgUrl }}')" class="group cursor-pointer relative overflow-hidden rounded-2xl border-2 border-navy-850 bg-white p-1.5 shadow-md reveal-scale {{ $idx === 0 ? 'col-span-2 h-56' : 'h-40' }}">
                    <div class="w-full h-full rounded-xl overflow-hidden relative">
                        <img alt="Gallery {{ $idx + 1 }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $imgUrl }}"/>
                        <div class="absolute inset-0 bg-navy-950/0 group-hover:bg-navy-950/25 transition-colors flex items-center justify-center">
                            <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl drop-shadow">zoom_in</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         8. DIGITAL GIFT SECTION ("TANDA KASIH")
         ================================================================= -->
    <section id="giftSection" class="relative py-16 px-6 bg-[#F5EFE6] border-t border-[#E8E1D5] overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Huwelijkscadeau</span>
            <h2 class="font-editorial text-2xl font-bold text-navy-850 mt-1">Tanda Kasih</h2>
            <p class="text-xs text-[#5C6E82] mt-1.5 leading-relaxed">
                Doa restu Anda merupakan karunia terindah bagi kami. Namun jika memberi adalah ungkapan tanda kasih, Anda dapat mengirimkan melalui:
            </p>
        </div>

        <div class="space-y-4 max-w-[350px] mx-auto">
            @foreach ($gifts as $idx => $gift)
                <div class="relative bg-white rounded-2xl border-2 border-navy-850 p-5 shadow-sm reveal-up">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full bg-navy-850 text-white text-[10px] font-bold uppercase tracking-wider">
                            {{ $gift['bank'] }}
                        </span>
                        <span class="material-symbols-outlined text-[#C5A059]">account_balance_wallet</span>
                    </div>
                    <p class="font-mono font-bold text-lg text-navy-950 tracking-wider">{{ $gift['account'] }}</p>
                    <p class="text-xs text-[#5C6E82] mt-0.5">a.n. <strong class="text-navy-850">{{ $gift['name'] }}</strong></p>

                    <button type="button" onclick="copyBankAccount('{{ $gift['account'] }}', this)" class="mt-3.5 inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-delft-50 hover:bg-delft-100 border border-delft-200 text-navy-850 text-[11px] font-bold tracking-wider uppercase transition">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                        <span class="copy-label">Salin Nomor Rekening</span>
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         9. RSVP & WISHES SECTION ("BUKU TAMU & UCAPAN")
         ================================================================= -->
    <section id="rsvpSection" class="relative py-16 px-6 bg-alabaster-paper border-t border-[#E8E1D5] overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#C5A059]">Gastenboek</span>
            <h2 class="font-editorial text-2xl font-bold text-navy-850 mt-1">Doa &amp; Ucapan</h2>
            <div class="flex items-center justify-center gap-2 mt-3 w-40 mx-auto opacity-70">
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
                <span class="text-[#C5A059] text-xs">✦</span>
                <span class="h-[1px] flex-1 bg-navy-850/40"></span>
            </div>
        </div>

        <div class="max-w-[350px] mx-auto bg-white rounded-3xl border-2 border-navy-850 p-5 shadow-sm reveal-up">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form id="wishesForm" action="{{ isset($invitation) ? route('invitations.comments.store', $invitation->id) : '#' }}" method="POST" onsubmit="return handleWishSubmit(event)" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-navy-850 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="wishName" required placeholder="Tuliskan nama Anda" class="w-full rounded-xl border-[#E8E1D5] bg-white text-xs text-navy-950 focus:border-navy-850 focus:ring-navy-850"/>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-navy-850 mb-1">Konfirmasi Kehadiran</label>
                    <select name="status" id="wishStatus" class="w-full rounded-xl border-[#E8E1D5] bg-white text-xs text-navy-950 focus:border-navy-850 focus:ring-navy-850">
                        <option value="Hadir">Hadir</option>
                        <option value="Tidak Hadir">Berhalangan Hadir</option>
                        <option value="Ragu-ragu">Masih Ragu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-navy-850 mb-1">Ucapan &amp; Doa</label>
                    <textarea name="message" id="wishMessage" rows="3" required placeholder="Tuliskan doa dan ucapan hangat untuk kedua mempelai..." class="w-full rounded-xl border-[#E8E1D5] bg-white text-xs text-navy-950 focus:border-navy-850 focus:ring-navy-850"></textarea>
                </div>
                <button type="submit" class="w-full py-3 px-5 rounded-full bg-navy-850 text-white font-bold text-xs uppercase tracking-[0.2em] border border-[#C5A059] shadow-md hover:bg-navy-900 transition">
                    Kirim Ucapan
                </button>
            </form>

            <!-- Wishes Wall -->
            <div id="wishesWall" class="mt-6 pt-4 border-t border-[#E8E1D5] max-h-64 overflow-y-auto space-y-3 pr-1">
                @foreach ($wishes as $w)
                    <div class="p-3.5 rounded-2xl bg-[#FAF7F2] border border-[#E8E1D5]">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-editorial font-bold text-xs text-navy-950">{{ $w['name'] }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $w['status'] === 'Hadir' ? 'bg-navy-850 text-[#E2C78A]' : 'bg-slate-200 text-slate-700' }}">
                                {{ $w['status'] }}
                            </span>
                        </div>
                        <p class="text-xs text-[#5C6E82] leading-relaxed">{{ $w['message'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =================================================================
         10. CLOSING FOOTER ("LAND VAN WINDMOLENS")
         ================================================================= -->
    <footer class="relative pt-14 pb-28 px-6 bg-gradient-to-b from-navy-900 via-navy-850 to-[#0A192B] text-white text-center overflow-hidden">
        <!-- Grand Living Dutch Windmill with Continuously Rotating Sails -->
        <div class="relative w-[88px] h-[118px] mx-auto mb-4 reveal-scale">
            <img alt="Grand Dutch Windmill" class="w-full h-full object-contain drop-shadow-[0_12px_24px_rgba(0,0,0,0.5)]" src="{{ $ornDir }}/windmill-tower.png"/>
            <div class="absolute left-1/2 top-[24%] -translate-x-1/2 -translate-y-1/2 w-[114px] h-[114px] pointer-events-none">
                <img alt="Rotating Windmill Sails" class="w-full h-full object-contain anim-windmill-sails" src="{{ $ornDir }}/windmill-blades.png"/>
            </div>
        </div>

        <!-- Romantic Dutch Heritage Windmill Quote -->
        <p class="font-editorial italic text-xs sm:text-sm text-[#E2C78A] max-w-[320px] mx-auto mb-4 leading-relaxed">
            "Dua hati kini bersatu, berputar selaras layaknya kincir angin Belanda yang setia menyambut hembusan waktu."
        </p>

        <!-- Amsterdam Postmark Accent -->
        <div class="w-16 mx-auto mb-3 opacity-60">
            <img alt="Amsterdam Postmark" class="w-full object-contain" src="{{ $ornDir }}/dutch-postmark.png"/>
        </div>

        <p class="text-xs text-delft-200 max-w-[300px] mx-auto leading-relaxed">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
        </p>
        <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-[#E2C78A] mt-4">Kami Yang Berbahagia</p>
        <h3 class="font-editorial text-3xl text-white mt-1">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h3>

        <!-- Botanical Tulip Accent in Bottom Corner -->
        <img alt="" class="anim-tulip-sway absolute -bottom-4 -right-4 w-32 pointer-events-none opacity-30" src="{{ $ornDir }}/delft-tulip-etching.png"/>
    </footer>

    <!-- =================================================================
         FLOATING AUDIO CONTROLLER & STICKY BOTTOM NAVIGATION
         ================================================================= -->
    <audio id="bgMusic" loop preload="auto" src="{{ $musicUrl }}"></audio>

    <button id="musicToggleBtn" type="button" onclick="toggleDutchMusic()" aria-label="Toggle Music" class="fixed bottom-16 right-3.5 z-40 w-10 h-10 rounded-full bg-navy-850 text-[#E2C78A] border-2 border-[#C5A059] shadow-lg flex items-center justify-center hover:scale-105 transition">
        <span id="musicIcon" class="material-symbols-outlined text-lg animate-spin" style="animation-duration: 8s;">music_note</span>
    </button>

    <nav class="fixed bottom-2.5 inset-x-0 z-40 mx-auto w-[90%] max-w-[350px] rounded-full bg-white/95 backdrop-blur-md border border-navy-850 shadow-[0_10px_25px_rgba(20,46,78,0.25)] px-2 py-1.5 flex items-center justify-around">
        <a href="#heroSection" class="flex flex-col items-center text-navy-850 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">home</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Home</span>
        </a>
        <a href="#coupleSection" class="flex flex-col items-center text-navy-850 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">favorite</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Mempelai</span>
        </a>
        <a href="#eventSection" class="flex flex-col items-center text-navy-850 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">event</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Acara</span>
        </a>
        <a href="#gallerySection" class="flex flex-col items-center text-navy-850 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">photo_library</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Galeri</span>
        </a>
        <a href="#rsvpSection" class="flex flex-col items-center text-navy-850 hover:text-[#C5A059] transition">
            <span class="material-symbols-outlined text-base">chat</span>
            <span class="text-[8.5px] font-bold uppercase tracking-wider">Ucapan</span>
        </a>
    </nav>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" onclick="closeLightbox()" class="fixed inset-0 z-50 hidden bg-navy-950/90 backdrop-blur-md items-center justify-center p-4">
        <button type="button" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center">
            <span class="material-symbols-outlined">close</span>
        </button>
        <img id="lightboxImage" alt="Preview" class="max-w-full max-h-[85vh] rounded-2xl border-2 border-[#C5A059] shadow-2xl object-contain" src=""/>
    </div>

</div>

<!-- =====================================================================
     SCRIPTS
     ===================================================================== -->
<script>
    const audioEl = document.getElementById('bgMusic');
    const musicIcon = document.getElementById('musicIcon');
    let isPlaying = false;

    function openDutchInvitation() {
        const cover = document.getElementById('coverOverlay');
        if (cover) {
            cover.classList.add('cover-open');
            setTimeout(() => {
                cover.style.display = 'none';
            }, 1050);
        }

        // Start background music on user gesture
        playDutchMusic();

        // Scroll to hero smoothly
        setTimeout(() => {
            const hero = document.getElementById('heroSection');
            if (hero) {
                hero.scrollIntoView({ behavior: 'smooth' });
            }
        }, 300);
    }

    function playDutchMusic() {
        if (!audioEl) return;
        audioEl.play().then(() => {
            isPlaying = true;
            if (musicIcon) {
                musicIcon.textContent = 'music_note';
                musicIcon.classList.add('animate-spin');
            }
        }).catch(() => {
            isPlaying = false;
        });
    }

    function toggleDutchMusic() {
        if (!audioEl) return;
        if (isPlaying) {
            audioEl.pause();
            isPlaying = false;
            if (musicIcon) {
                musicIcon.textContent = 'music_off';
                musicIcon.classList.remove('animate-spin');
            }
        } else {
            audioEl.play().then(() => {
                isPlaying = true;
                if (musicIcon) {
                    musicIcon.textContent = 'music_note';
                    musicIcon.classList.add('animate-spin');
                }
            }).catch(() => {});
        }
    }

    // Countdown Timer
    function initCountdown() {
        const grid = document.getElementById('countdownGrid');
        if (!grid) return;

        let targetDate = new Date(grid.getAttribute('data-date')).getTime();
        const now = new Date().getTime();
        if (isNaN(targetDate) || targetDate <= now) {
            // For demo/preview, set to 64 days ahead so countdown is always alive
            targetDate = now + (64 * 24 * 60 * 60 * 1000) + (14 * 60 * 60 * 1000) + (35 * 60 * 1000);
        }

        function update() {
            const now = new Date().getTime();
            const diff = targetDate - now;

            if (diff <= 0) {
                document.getElementById('cd-days').textContent = '00';
                document.getElementById('cd-hours').textContent = '00';
                document.getElementById('cd-mins').textContent = '00';
                document.getElementById('cd-secs').textContent = '00';
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const secs = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('cd-days').textContent = String(days).padStart(2, '0');
            document.getElementById('cd-hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('cd-mins').textContent = String(mins).padStart(2, '0');
            document.getElementById('cd-secs').textContent = String(secs).padStart(2, '0');
        }

        update();
        setInterval(update, 1000);
    }

    // Scroll Reveal Observer
    function initScrollReveal() {
        const elements = document.querySelectorAll('.reveal-up, .reveal-scale, .reveal-left, .reveal-right');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.12 });

        elements.forEach(el => observer.observe(el));
    }

    // Copy Account
    function copyBankAccount(account, btn) {
        navigator.clipboard.writeText(account).then(() => {
            const label = btn.querySelector('.copy-label');
            if (label) {
                const prev = label.textContent;
                label.textContent = 'Tersalin!';
                btn.classList.add('bg-emerald-100', 'text-emerald-800');
                setTimeout(() => {
                    label.textContent = prev;
                    btn.classList.remove('bg-emerald-100', 'text-emerald-800');
                }, 2200);
            }
        });
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

    // Wish Submit
    function handleWishSubmit(e) {
        const form = e.target;
        if (form.getAttribute('action') === '#') {
            e.preventDefault();
            const name = document.getElementById('wishName').value.trim();
            const status = document.getElementById('wishStatus').value;
            const message = document.getElementById('wishMessage').value.trim();

            if (!name || !message) return false;

            const wall = document.getElementById('wishesWall');
            const item = document.createElement('div');
            item.className = 'p-3.5 rounded-2xl bg-[#FAF7F2] border border-[#E8E1D5] reveal-up is-visible';
            item.innerHTML = `
                <div class="flex items-center justify-between mb-1">
                    <span class="font-editorial font-bold text-xs text-navy-950">${name}</span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase ${status === 'Hadir' ? 'bg-navy-850 text-[#E2C78A]' : 'bg-slate-200 text-slate-700'}">
                        ${status}
                    </span>
                </div>
                <p class="text-xs text-[#5C6E82] leading-relaxed">${message}</p>
            `;
            wall.prepend(item);
            form.reset();
            return false;
        }
        return true;
    }

    document.addEventListener('DOMContentLoaded', () => {
        initCountdown();
        initScrollReveal();
    });
</script>

</body>
</html>
