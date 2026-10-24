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
                ['name' => 'Anya & Keluarga', 'status' => 'Hadir', 'message' => 'Undangan kincir angin Belandanya cantik sekali! Sampai bertemu di hari bahagia kalian ya!'],
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
            ['name' => 'Anya & Keluarga', 'status' => 'Hadir', 'message' => 'Undangan kincir angin Belandanya cantik sekali! Sampai bertemu di hari bahagia kalian ya!'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia (BCA)', 'name' => 'Aditya Rahardian', 'account' => '8420-5519-02'],
            ['bank' => 'Bank Mandiri', 'name' => 'Arumi Kusumo', 'account' => '124-00-9882716-4'],
        ];

        $musicUrl = asset('musics/boho-wedding-bg.mp3');
    }

    $ornDir = asset('assets/templates/wedding-01/ornaments');
    $formattedDate = \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y');
    $guestName = request('to', 'Tamu Undangan');
@endphp
<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Undangan Pernikahan | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&amp;family=Great+Vibes&amp;family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
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
                        porcelain: {
                            DEFAULT: '#F9FBFF',
                            warm: '#FFFDF7',
                            cream: '#F5EFE2',
                        },
                        tulip: {
                            coral: '#E11D48',
                            pink: '#F472B6',
                            gold: '#D4A236',
                            amber: '#F59E0B',
                        }
                    },
                    fontFamily: {
                        royal: ['Cinzel Decorative', 'serif'],
                        script: ['Great Vibes', 'cursive'],
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        };
    </script>

    <style>
        :root {
            --delft-royal: #163E73;
            --delft-deep: #0B2142;
            --porcelain-bg: #F9FBFF;
            --dutch-gold: #D4A236;
        }

        body {
            background-color: #08172E;
            color: #163E73;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Subtle Delft Blue Porcelain Tile (Tegeltje) Pattern */
        .bg-delft-porcelain {
            background-color: #F9FBFF;
            background-image:
                radial-gradient(circle at 0% 0%, rgba(22, 62, 115, 0.055) 0, rgba(22, 62, 115, 0.055) 10px, transparent 11px),
                radial-gradient(circle at 100% 0%, rgba(22, 62, 115, 0.055) 0, rgba(22, 62, 115, 0.055) 10px, transparent 11px),
                radial-gradient(circle at 0% 100%, rgba(22, 62, 115, 0.055) 0, rgba(22, 62, 115, 0.055) 10px, transparent 11px),
                radial-gradient(circle at 100% 100%, rgba(22, 62, 115, 0.055) 0, rgba(22, 62, 115, 0.055) 10px, transparent 11px),
                linear-gradient(to right, rgba(22, 62, 115, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(22, 62, 115, 0.04) 1px, transparent 1px);
            background-size: 72px 72px;
        }

        .bg-dutch-cream {
            background-color: #FFFDF7;
            background-image:
                radial-gradient(rgba(212, 162, 54, 0.10) 1px, transparent 1px),
                radial-gradient(rgba(22, 62, 115, 0.05) 1px, #FFFDF7 1px);
            background-size: 36px 36px;
            background-position: 0 0, 18px 18px;
        }

        /* ==============================================================
           CONTINUOUS WINDMILL ROTATION & DUTCH BREEZE ANIMATIONS
           ============================================================== */
        @keyframes spinWindmill {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .anim-windmill-sails {
            animation: spinWindmill 16s linear infinite;
            transform-origin: 50% 50%;
            will-change: transform;
        }
        .anim-windmill-sails-fast {
            animation: spinWindmill 3.5s linear infinite !important;
        }

        /* Gentle Dutch breeze sway for tulip meadows & corners */
        @keyframes tulipSwayLeft {
            0%, 100% { transform: rotate(0deg) scale(1); }
            50%      { transform: rotate(2.4deg) scale(1.02); }
        }
        @keyframes tulipSwayRight {
            0%, 100% { transform: rotate(0deg) scale(1); }
            50%      { transform: rotate(-2.4deg) scale(1.02); }
        }
        .anim-tulip-left {
            transform-origin: bottom left;
            animation: tulipSwayLeft 5.8s ease-in-out infinite;
        }
        .anim-tulip-right {
            transform-origin: bottom right;
            animation: tulipSwayRight 6.2s ease-in-out infinite;
        }
        .anim-corner-tl {
            transform-origin: top left;
            animation: tulipSwayLeft 6.5s ease-in-out infinite;
        }
        .anim-corner-tr {
            transform-origin: top right;
            animation: tulipSwayRight 6.8s ease-in-out infinite;
        }

        /* Floating Tulip Petals & Blue Butterflies in Dutch Wind */
        @keyframes dutchWindPetal {
            0% {
                transform: translate3d(-10vw, -10vh, 0) rotate(0deg) scale(0.85);
                opacity: 0;
            }
            15% {
                opacity: 0.85;
            }
            85% {
                opacity: 0.85;
            }
            100% {
                transform: translate3d(105vw, 95vh, 0) rotate(380deg) scale(1.05);
                opacity: 0;
            }
        }
        .petal-stream {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 35;
            animation: dutchWindPetal linear infinite;
        }

        @keyframes butterflyFlutter {
            0%, 100% { transform: translateY(0px) rotate(-6deg) scale(1); }
            50%      { transform: translateY(-14px) rotate(8deg) scale(0.92); }
        }
        .anim-butterfly {
            animation: butterflyFlutter 3.8s ease-in-out infinite;
        }

        /* Cover Opening Cinema Transition */
        #coverOverlay {
            transition: opacity 1.15s cubic-bezier(0.4, 0, 0.2, 1), visibility 1.15s;
        }
        #coverOverlay.cover-open {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        #coverOverlay .cover-windmill-zoom {
            transition: transform 1.25s cubic-bezier(0.22, 1, 0.36, 1);
        }
        #coverOverlay.cover-open .cover-windmill-zoom {
            transform: scale(1.42) translateY(-18px);
        }
        #coverOverlay .cover-part-left {
            transition: transform 1.15s cubic-bezier(0.22, 1, 0.36, 1), opacity 1s;
        }
        #coverOverlay .cover-part-right {
            transition: transform 1.15s cubic-bezier(0.22, 1, 0.36, 1), opacity 1s;
        }
        #coverOverlay.cover-open .cover-part-left {
            transform: translateX(-110px) rotate(-10deg);
            opacity: 0;
        }
        #coverOverlay.cover-open .cover-part-right {
            transform: translateX(110px) rotate(10deg);
            opacity: 0;
        }

        /* Scroll Reveal Animations */
        .reveal-up {
            opacity: 0;
            transform: translateY(34px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-34px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(34px);
            transition: opacity 0.85s cubic-bezier(0.22, 1, 0.36, 1), transform 0.85s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .is-visible {
            opacity: 1 !important;
            transform: translate(0, 0) scale(1) !important;
        }

        /* Dutch Bell-Gable & Stepped-Gable Card Borders */
        .delft-porcelain-card {
            background: linear-gradient(180deg, #FFFFFF 0%, #F4F8FD 100%);
            border: 2px solid #163E73;
            box-shadow:
                0 18px 40px -15px rgba(15, 43, 84, 0.18),
                inset 0 0 0 4px #FFFFFF,
                inset 0 0 0 5.5px rgba(212, 162, 54, 0.65);
        }

        /* Dutch Hourglass Shutter (Zandloperluik) Pattern */
        .dutch-shutter {
            background:
                linear-gradient(135deg, #163E73 25%, transparent 25%) -10px 0,
                linear-gradient(225deg, #163E73 25%, transparent 25%) -10px 0,
                linear-gradient(315deg, #163E73 25%, transparent 25%),
                linear-gradient(45deg,  #163E73 25%, transparent 25%);
            background-size: 20px 40px;
            background-color: #F9FBFF;
        }

        /* Hide scrollbar */
        ::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>

<body class="selection:bg-delft-700 selection:text-white">

<!-- =====================================================================
     MOBILE INVITATION SHELL (Centered max-w-[430px])
     ===================================================================== -->
<div class="relative mx-auto w-full max-w-[430px] min-h-screen bg-delft-porcelain shadow-[0_0_60px_rgba(0,0,0,0.65)] overflow-hidden">

    <!-- =================================================================
         AMBIENT WIND-BLOWN TULIP PETALS & DELFT BLUE BUTTERFLIES
         ================================================================= -->
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 mx-auto max-w-[430px] overflow-hidden z-30">
        <img alt="" class="petal-stream w-5 h-5" src="{{ $ornDir }}/tulip-petal.png" style="top: 8%; animation-duration: 13s; animation-delay: 0s;"/>
        <img alt="" class="petal-stream w-4 h-4" src="{{ $ornDir }}/white-petal.png" style="top: 24%; animation-duration: 15s; animation-delay: 3.5s;"/>
        <img alt="" class="petal-stream w-6 h-6" src="{{ $ornDir }}/tulip-petal.png" style="top: 42%; animation-duration: 12s; animation-delay: 6.2s;"/>
        <img alt="" class="petal-stream w-4 h-4" src="{{ $ornDir }}/white-petal.png" style="top: 60%; animation-duration: 16s; animation-delay: 1.8s;"/>
        <img alt="" class="petal-stream w-6 h-6 anim-butterfly" src="{{ $ornDir }}/blue-butterfly.png" style="top: 18%; animation-duration: 18s; animation-delay: 4.5s;"/>
    </div>

    <!-- =================================================================
         1. FULL-SCREEN COVER OVERLAY ("NEGERI KINCIR ANGIN BELANDA")
         ================================================================= -->
    <div id="coverOverlay" class="fixed inset-0 z-50 mx-auto w-full max-w-[430px] h-full overflow-hidden flex flex-col justify-between select-none">

        <!-- Golden-Hour Kinderdijk Canal & Keukenhof Tulip Meadow Backdrop -->
        <div class="absolute inset-0 cover-windmill-zoom">
            <img alt="Dutch Windmill Canal & Tulip Meadow" class="w-full h-full object-cover object-center brightness-[0.96]" src="{{ $ornDir }}/holland-canal-bg.jpg"/>
            <!-- Soft Royal Delft Blue & Golden Sunset Vignette -->
            <div class="absolute inset-0 bg-gradient-to-b from-delft-900/60 via-delft-900/15 to-delft-900/80"></div>
        </div>

        <!-- Top Delft Porcelain & Tulip Cascading Corners -->
        <img alt="" class="cover-part-left anim-corner-tl absolute -top-3 -left-3 w-44 pointer-events-none z-20 drop-shadow-lg" src="{{ $ornDir }}/delft-corner-tl.png"/>
        <img alt="" class="cover-part-right anim-corner-tr absolute -top-3 -right-3 w-44 pointer-events-none z-20 drop-shadow-lg" src="{{ $ornDir }}/delft-corner-tr.png"/>

        <!-- Top Header Subtitle -->
        <div class="relative z-20 pt-10 px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-white/85 backdrop-blur-md border border-tulip-gold/60 shadow-md">
                <span class="w-1.5 h-1.5 rounded-full bg-delft-700"></span>
                <span class="text-[10px] font-semibold tracking-[0.28em] uppercase text-delft-800">The Wedding Of</span>
                <span class="w-1.5 h-1.5 rounded-full bg-delft-700"></span>
            </div>
        </div>

        <!-- CENTERPIECE: LIVING DUTCH WINDMILL (Tower + Rotating 4-Blade Lattice Sails) -->
        <div class="relative z-10 flex-1 flex items-center justify-center cover-windmill-zoom pointer-events-none my-auto">
            <!-- Warm Golden Sun & Sky Mist Halo Behind Windmill -->
            <div class="absolute w-72 h-72 rounded-full bg-amber-100/65 blur-2xl"></div>

            <!-- Windmill Assembly Container (3:4 aspect ratio matching 600x800 windmill-tower.png) -->
            <div class="relative w-[264px] h-[352px]">
                <!-- Static Dutch Brick & Thatch Tower with Real Tulip Base -->
                <img alt="Dutch Windmill Tower" class="w-full h-full object-contain drop-shadow-[0_14px_24px_rgba(9,27,56,0.55)]" src="{{ $ornDir }}/windmill-tower.png"/>

                <!-- Rotating 4-Blade Sail Cross Centered on Axle Hub (50% X, 18.25% Y of Tower) -->
                <div class="absolute left-1/2 top-[18.25%] -translate-x-1/2 -translate-y-1/2 w-[284px] h-[284px] z-20">
                    <img id="coverWindmillBlades" alt="Spinning Windmill Blades" class="w-full h-full object-contain anim-windmill-sails drop-shadow-[0_6px_12px_rgba(0,0,0,0.35)]" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
            </div>
        </div>

        <!-- Bottom Royal Delft Porcelain Plaque & Guest Invitation Card -->
        <div class="relative z-30 px-5 pb-7 pt-1">
            <div class="relative rounded-[28px] delft-porcelain-card bg-white/95 backdrop-blur-md shadow-[0_20px_45px_rgba(9,27,56,0.55)] px-5 py-4 text-center overflow-hidden">
                <!-- Inner Gold Pinstripe Frame -->
                <div class="pointer-events-none absolute inset-1.5 rounded-[22px] border border-tulip-gold/60"></div>

                <!-- Couple Names -->
                <p class="text-[10px] font-bold tracking-[0.26em] uppercase text-tulip-gold mb-0.5">De Molen van Liefde</p>
                <h1 class="font-script text-4xl text-delft-800 leading-tight drop-shadow-sm">
                    {{ $couple['groom'] }} <span class="text-tulip-gold font-serif text-2xl mx-0.5">&amp;</span> {{ $couple['bride'] }}
                </h1>
                <p class="text-[11px] font-bold tracking-[0.18em] uppercase text-delft-700 mt-1">
                    {{ $formattedDate }}
                </p>

                <!-- Delft Blue & Gold Divider Line -->
                <div class="flex items-center justify-center gap-2 my-2.5">
                    <span class="h-[1px] w-12 bg-gradient-to-r from-transparent to-delft-700/50"></span>
                    <svg class="w-4 h-4 text-tulip-gold" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2C9.5 5 8 7.5 8 10.5C8 13.5 9.8 15.5 12 15.5C14.2 15.5 16 13.5 16 10.5C16 7.5 14.5 5 12 2ZM6 6C5 8.5 5 11.5 7 13.5C8.2 14.7 9.8 15.3 11.2 15.4C9.2 13.8 8 11.3 8 8.5C7.2 7.6 6.5 6.8 6 6ZM18 6C17.5 6.8 16.8 7.6 16 8.5C16 11.3 14.8 13.8 12.8 15.4C14.2 15.3 15.8 14.7 17 13.5C19 11.5 19 8.5 18 6ZM11 16.5V22H13V16.5H11Z"/>
                    </svg>
                    <span class="h-[1px] w-12 bg-gradient-to-l from-transparent to-delft-700/50"></span>
                </div>

                <!-- Guest Recipient Box -->
                <div class="bg-delft-50/90 border border-delft-200 rounded-xl py-2 px-4 mb-3.5">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-delft-600">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                    <p class="font-serif font-bold text-base text-delft-900 mt-0.5 truncate">{{ $guestName }}</p>
                </div>

                <!-- Open Invitation CTA Button -->
                <button id="openInvitationBtn" type="button" onclick="openDutchInvitation()" class="group relative inline-flex items-center justify-center gap-2.5 w-full py-3 px-6 rounded-full bg-gradient-to-r from-delft-800 via-delft-700 to-delft-800 text-white font-semibold text-xs tracking-[0.2em] uppercase shadow-[0_10px_25px_rgba(22,62,115,0.45)] border border-tulip-gold/70 hover:brightness-110 active:scale-[0.98] transition-all">
                    <svg class="w-4 h-4 text-tulip-gold animate-spin" style="animation-duration: 7s;" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 10.2C11 10.2 10.2 11 10.2 12C10.2 13 11 13.8 12 13.8C13 13.8 13.8 13 13.8 12C13.8 11 13 10.2 12 10.2ZM13 2H10.5L11.2 9.5H12.8L13 2ZM22 13V10.5L14.5 11.2V12.8L22 13ZM11 22H13.5L12.8 14.5H11.2L11 22ZM2 11V13.5L9.5 12.8V11.2L2 11Z"/>
                    </svg>
                    <span>Buka Undangan</span>
                </button>
            </div>
        </div>

        <!-- Foreground Dutch Tulip Meadow Corners (Left & Right) -->
        <img alt="" class="cover-part-left anim-tulip-left absolute -bottom-4 -left-4 w-48 pointer-events-none z-20 drop-shadow-xl" src="{{ $ornDir }}/tulip-meadow-left.png"/>
        <img alt="" class="cover-part-right anim-tulip-right absolute -bottom-4 -right-4 w-48 pointer-events-none z-20 drop-shadow-xl" src="{{ $ornDir }}/tulip-meadow-right.png"/>
    </div>

    <!-- =================================================================
         2. HERO SECTION ("ROYAL DELFT PORCELAIN & LIVE WINDMILL COUNTDOWN")
         ================================================================= -->
    <section id="heroSection" class="relative min-h-screen pt-14 pb-16 px-5 bg-delft-porcelain overflow-hidden flex flex-col items-center">
        <!-- Top Delft Porcelain & Tulip Corners -->
        <img alt="" class="anim-corner-tl absolute -top-3 -left-3 w-40 pointer-events-none z-10" src="{{ $ornDir }}/delft-corner-tl.png"/>
        <img alt="" class="anim-corner-tr absolute -top-3 -right-3 w-40 pointer-events-none z-10" src="{{ $ornDir }}/delft-corner-tr.png"/>

        <!-- Miniature Spinning Windmill Crest Header -->
        <div class="relative z-20 flex flex-col items-center text-center mt-2 mb-4 reveal-up">
            <div class="relative w-20 h-24 mb-1">
                <img alt="Mini Windmill" class="w-full h-full object-contain" src="{{ $ornDir }}/windmill-tower.png"/>
                <div class="absolute left-1/2 top-[18.25%] -translate-x-1/2 -translate-y-1/2 w-20 h-20">
                    <img alt="" class="w-full h-full object-contain anim-windmill-sails" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-[0.32em] text-delft-600">Holland Heritage Romance</span>
            <h2 class="font-royal text-2xl font-bold text-delft-800 mt-1">
                {{ $couple['groom'] }} <span class="text-tulip-gold">&amp;</span> {{ $couple['bride'] }}
            </h2>
        </div>

        <!-- Dutch Bell-Gable (Klokgevel) Royal Delft Porcelain Portrait Frame -->
        <div class="relative z-20 w-full max-w-[340px] delft-porcelain-card rounded-t-[160px] rounded-b-[28px] p-3.5 reveal-scale">
            <!-- Arch Couple Portrait -->
            <div class="relative w-full h-[350px] rounded-t-[146px] rounded-b-[18px] overflow-hidden border-2 border-tulip-gold/70 shadow-inner">
                <img alt="{{ $couple['groom'] }} & {{ $couple['bride'] }}" class="w-full h-full object-cover object-center transition-transform duration-1000 hover:scale-105" src="{{ $bg['cover'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-delft-900/75 via-transparent to-delft-900/15"></div>

                <!-- Overlay Couple Script Title inside Arch -->
                <div class="absolute bottom-4 inset-x-4 text-center text-white">
                    <p class="text-[10px] uppercase tracking-[0.28em] text-amber-200 font-semibold">We Are Getting Married</p>
                    <p class="font-script text-4xl leading-none mt-1 drop-shadow">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</p>
                </div>
            </div>

            <!-- Date & Venue Strip Inside Porcelain Card -->
            <div class="pt-3.5 pb-1 px-2 text-center">
                <p class="font-serif font-bold text-sm text-delft-800 tracking-wide">{{ $formattedDate }}</p>
                <p class="text-xs text-delft-600 mt-0.5 flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm text-tulip-gold">location_on</span>
                    <span>{{ $event['location'] }}</span>
                </p>
            </div>

            <!-- Tulip Bouquet Accent Overlapping Bottom Corners of Frame -->
            <img alt="" class="anim-tulip-left absolute -bottom-5 -left-5 w-28 pointer-events-none drop-shadow-md" src="{{ $ornDir }}/tulip-meadow-left.png"/>
            <img alt="" class="anim-tulip-right absolute -bottom-5 -right-5 w-28 pointer-events-none drop-shadow-md" src="{{ $ornDir }}/tulip-meadow-right.png"/>
        </div>

        <!-- 4 Glazed Royal Delft Blue Ceramic Tile Countdown Boxes -->
        <div class="relative z-20 w-full max-w-[350px] mt-8 reveal-up">
            <p class="text-center text-[10px] font-bold uppercase tracking-[0.28em] text-delft-700 mb-3">
                Menghitung Hari Bahagia
            </p>
            <div id="countdownGrid" class="grid grid-cols-4 gap-2.5" data-date="{{ $event['date_iso'] }}T{{ $event['time'] }}:00">
                @foreach ([['id' => 'cd-days', 'label' => 'Hari', 'val' => '124'], ['id' => 'cd-hours', 'label' => 'Jam', 'val' => '08'], ['id' => 'cd-mins', 'label' => 'Menit', 'val' => '45'], ['id' => 'cd-secs', 'label' => 'Detik', 'val' => '30']] as $tile)
                    <div class="relative bg-white rounded-xl border-2 border-delft-700 py-3 px-1 text-center shadow-[0_8px_18px_rgba(22,62,115,0.12)] overflow-hidden">
                        <!-- Corner Delft Tile Dots -->
                        <span class="absolute top-1 left-1 w-1.5 h-1.5 rounded-full bg-delft-300"></span>
                        <span class="absolute top-1 right-1 w-1.5 h-1.5 rounded-full bg-delft-300"></span>
                        <span class="absolute bottom-1 left-1 w-1.5 h-1.5 rounded-full bg-delft-300"></span>
                        <span class="absolute bottom-1 right-1 w-1.5 h-1.5 rounded-full bg-delft-300"></span>

                        <span id="{{ $tile['id'] }}" class="block font-serif font-bold text-2xl text-delft-800 leading-none">{{ $tile['val'] }}</span>
                        <span class="block text-[9px] font-bold uppercase tracking-[0.18em] text-tulip-gold mt-1.5">{{ $tile['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Horizontal Dutch Tulip & Delft Diamond Divider -->
        <img alt="" class="w-64 mt-7 opacity-95 reveal-up" src="{{ $ornDir }}/tulip-divider.png"/>
    </section>

    <!-- =================================================================
         3. QUOTE SECTION ("DELFTWARE TEGELTJE WISDOM PLAQUE")
         ================================================================= -->
    <section class="relative py-12 px-6 bg-dutch-cream border-y border-delft-200 overflow-hidden">
        <div class="relative z-10 max-w-[360px] mx-auto text-center">
            <!-- Authentic Delft Porcelain Medallion & Tulips Crest -->
            <img alt="Delft Windmill Crest" class="w-56 mx-auto mb-3 reveal-scale drop-shadow-md" src="{{ $ornDir }}/delft-windmill-crest.png"/>

            <!-- 17th-Century Dutch Tegeltje Ceramic Tile Card -->
            <div class="relative bg-white rounded-2xl border-2 border-delft-700 p-6 shadow-[0_14px_32px_rgba(22,62,115,0.10)] reveal-up">
                <div class="pointer-events-none absolute inset-1.5 rounded-xl border border-tulip-gold/60"></div>

                <span class="material-symbols-outlined text-2xl text-delft-600 mb-2">format_quote</span>
                <p class="font-serif italic text-sm leading-relaxed text-delft-900">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                </p>
                <div class="mt-4 inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-delft-50 border border-delft-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-tulip-gold"></span>
                    <span class="text-[10px] font-bold tracking-[0.2em] uppercase text-delft-800">QS. Ar-Rum : 21</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-tulip-gold"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- =================================================================
         4. COUPLE SECTION ("DUTCH WINDOW-SHUTTER & TULIP ARCH PORTRAITS")
         ================================================================= -->
    <section id="coupleSection" class="relative py-16 px-5 bg-delft-porcelain overflow-hidden">
        <!-- Section Header -->
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-tulip-gold">Bruid &amp; Bruidegom</span>
            <h2 class="font-royal text-2xl font-bold text-delft-800 mt-1">Sang Mempelai</h2>
            <p class="text-xs text-delft-600 mt-2 leading-relaxed">
                Dengan memohon rahmat dan ridho Tuhan Yang Maha Esa, kami bermaksud menyelenggarakan pernikahan putra-putri kami:
            </p>
            <img alt="" class="w-52 mx-auto mt-3" src="{{ $ornDir }}/tulip-divider.png"/>
        </div>

        <!-- GROOM CARD (Dutch Window with Hourglass Shutters) -->
        <div class="relative max-w-[350px] mx-auto delft-porcelain-card rounded-3xl p-5 mb-7 reveal-left">
            <div class="flex items-center justify-center gap-2 mb-4">
                <!-- Left Dutch Hourglass Shutter Strip -->
                <div class="w-5 h-44 rounded-l-lg border border-delft-700 dutch-shutter shadow-sm"></div>

                <!-- Arched Dutch Window Portrait -->
                <div class="relative w-44 h-52 rounded-t-full rounded-b-2xl overflow-hidden border-2 border-delft-800 shadow-lg">
                    <img alt="{{ $couple['groom'] }}" class="w-full h-full object-cover object-top" src="{{ $bg['groom'] }}"/>
                    <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-delft-900/70 to-transparent"></div>
                    <span class="absolute bottom-2 inset-x-0 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-amber-200">The Groom</span>
                </div>

                <!-- Right Dutch Hourglass Shutter Strip -->
                <div class="w-5 h-44 rounded-r-lg border border-delft-700 dutch-shutter shadow-sm"></div>
            </div>

            <div class="text-center px-2">
                <h3 class="font-script text-4xl text-delft-800">{{ $couple['groom'] }}</h3>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-tulip-gold mt-1">Putra Tercinta Dari</p>
                <p class="font-serif text-sm text-delft-900 mt-1">{{ $couple['parents']['groom'] }}</p>
            </div>

            <img alt="" class="anim-tulip-left absolute -bottom-3 -left-3 w-24 pointer-events-none" src="{{ $ornDir }}/tulip-meadow-left.png"/>
        </div>

        <!-- Spinning Dutch Windmill Love Connector -->
        <div class="flex flex-col items-center justify-center my-4 reveal-scale">
            <div class="relative w-16 h-20">
                <img alt="" class="w-full h-full object-contain" src="{{ $ornDir }}/windmill-tower.png"/>
                <div class="absolute left-1/2 top-[18.25%] -translate-x-1/2 -translate-y-1/2 w-16 h-16">
                    <img alt="" class="w-full h-full object-contain anim-windmill-sails" src="{{ $ornDir }}/windmill-blades.png"/>
                </div>
            </div>
            <span class="font-script text-3xl text-tulip-gold -mt-1">&amp;</span>
        </div>

        <!-- BRIDE CARD (Dutch Window with Hourglass Shutters) -->
        <div class="relative max-w-[350px] mx-auto delft-porcelain-card rounded-3xl p-5 mt-3 reveal-right">
            <div class="flex items-center justify-center gap-2 mb-4">
                <!-- Left Dutch Hourglass Shutter Strip -->
                <div class="w-5 h-44 rounded-l-lg border border-delft-700 dutch-shutter shadow-sm"></div>

                <!-- Arched Dutch Window Portrait -->
                <div class="relative w-44 h-52 rounded-t-full rounded-b-2xl overflow-hidden border-2 border-delft-800 shadow-lg">
                    <img alt="{{ $couple['bride'] }}" class="w-full h-full object-cover object-top" src="{{ $bg['bride'] }}"/>
                    <div class="absolute inset-x-0 bottom-0 h-14 bg-gradient-to-t from-delft-900/70 to-transparent"></div>
                    <span class="absolute bottom-2 inset-x-0 text-center text-[9px] font-bold uppercase tracking-[0.25em] text-amber-200">The Bride</span>
                </div>

                <!-- Right Dutch Hourglass Shutter Strip -->
                <div class="w-5 h-44 rounded-r-lg border border-delft-700 dutch-shutter shadow-sm"></div>
            </div>

            <div class="text-center px-2">
                <h3 class="font-script text-4xl text-delft-800">{{ $couple['bride'] }}</h3>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-tulip-gold mt-1">Putri Tercinta Dari</p>
                <p class="font-serif text-sm text-delft-900 mt-1">{{ $couple['parents']['bride'] }}</p>
            </div>

            <img alt="" class="anim-tulip-right absolute -bottom-3 -right-3 w-24 pointer-events-none" src="{{ $ornDir }}/tulip-meadow-right.png"/>
        </div>
    </section>

    <!-- =================================================================
         5. EVENT SCHEDULE SECTION ("ROYAL DELFT NIGHT & STEPPED-GABLE CARDS")
         ================================================================= -->
    <section id="eventSection" class="relative py-16 px-5 bg-gradient-to-b from-delft-900 via-delft-800 to-delft-900 text-white overflow-hidden">
        <!-- Subtle Background Canal & Tulip Scene -->
        <img alt="" class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-luminosity pointer-events-none" src="{{ $ornDir }}/holland-canal-bg.jpg"/>
        <div class="absolute inset-0 bg-gradient-to-b from-delft-900/90 via-delft-800/80 to-delft-900/95 pointer-events-none"></div>

        <!-- Section Header with Delft Crest -->
        <div class="relative z-10 text-center max-w-[340px] mx-auto mb-9 reveal-up">
            <img alt="" class="w-48 mx-auto mb-2 drop-shadow-lg" src="{{ $ornDir }}/delft-windmill-crest.png"/>
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-amber-300">Tijd &amp; Locatie</span>
            <h2 class="font-royal text-2xl font-bold text-white mt-1">Rangkaian Acara</h2>
            <p class="text-xs text-delft-100 mt-1.5">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir pada:
            </p>
        </div>

        <!-- Event Schedule Cards (Dutch Canal Gable House Style) -->
        <div class="relative z-10 space-y-6 max-w-[350px] mx-auto">
            @foreach ($schedule as $idx => $item)
                <div class="relative bg-white text-delft-900 rounded-2xl border-2 border-tulip-gold p-5 shadow-[0_16px_35px_rgba(0,0,0,0.35)] {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <!-- Top Dutch Gable Crest Badge -->
                    <div class="flex items-center justify-between border-b border-delft-100 pb-3 mb-3.5">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-delft-800 text-amber-300 flex items-center justify-center shadow">
                                <span class="material-symbols-outlined text-xl">{{ $idx === 0 ? 'volunteer_activism' : 'celebration' }}</span>
                            </div>
                            <div>
                                <span class="text-[9px] font-bold uppercase tracking-[0.22em] text-tulip-gold block">Bagian 0{{ $idx + 1 }}</span>
                                <h3 class="font-serif font-bold text-lg text-delft-800 leading-tight">{{ $item['title'] }}</h3>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-2xl text-delft-300 animate-spin" style="animation-duration: 12s;">toys_fan</span>
                    </div>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center gap-2.5 text-delft-800">
                            <span class="material-symbols-outlined text-base text-tulip-gold">calendar_month</span>
                            <span class="font-semibold">{{ $formattedDate }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-delft-800">
                            <span class="material-symbols-outlined text-base text-tulip-gold">schedule</span>
                            <span class="font-semibold">{{ $item['time'] }}</span>
                        </div>
                        <div class="flex items-start gap-2.5 text-delft-700">
                            <span class="material-symbols-outlined text-base text-tulip-gold mt-0.5">location_on</span>
                            <div>
                                <p class="font-bold text-delft-900">{{ $item['note'] }}</p>
                                <p class="text-[11px] text-delft-600 mt-0.5">{{ $event['address'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Google Maps Direction Card -->
        <div class="relative z-10 max-w-[350px] mx-auto mt-7 text-center reveal-up">
            <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2.5 w-full py-3.5 px-6 rounded-full bg-gradient-to-r from-amber-500 via-tulip-gold to-amber-500 text-delft-900 font-bold text-xs uppercase tracking-[0.2em] shadow-[0_10px_25px_rgba(212,162,54,0.4)] hover:brightness-105 transition">
                <span class="material-symbols-outlined text-base">map</span>
                <span>Petunjuk Lokasi (Google Maps)</span>
            </a>
        </div>
    </section>

    <!-- =================================================================
         6. LOVE STORY SECTION ("KINDERDIJK CANAL & WINDMILL TIMELINE")
         ================================================================= -->
    <section id="storySection" class="relative py-16 px-5 bg-dutch-cream overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-10 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-tulip-gold">Ons Liefdesverhaal</span>
            <h2 class="font-royal text-2xl font-bold text-delft-800 mt-1">Kisah Cinta Kami</h2>
            <img alt="" class="w-52 mx-auto mt-2" src="{{ $ornDir }}/tulip-divider.png"/>
        </div>

        <!-- Vertical Dutch Canal Waterway Line -->
        <div class="relative max-w-[350px] mx-auto pl-6 border-l-2 border-dashed border-delft-400 space-y-6">
            @foreach ($stories as $idx => $st)
                <div class="relative delft-porcelain-card rounded-2xl p-4 {{ $idx % 2 === 0 ? 'reveal-left' : 'reveal-right' }}">
                    <!-- Canal Windmill Pin on Left Timeline Line -->
                    <div class="absolute -left-[37px] top-5 w-6 h-6 rounded-full bg-delft-800 border-2 border-tulip-gold flex items-center justify-center text-white shadow">
                        <span class="material-symbols-outlined text-xs animate-spin" style="animation-duration: 9s;">toys_fan</span>
                    </div>

                    <div class="flex items-center justify-between mb-1.5">
                        <span class="px-2.5 py-0.5 rounded-full bg-delft-100 text-delft-800 font-bold text-[10px] tracking-wider uppercase">
                            {{ $st['date'] }}
                        </span>
                        <span class="text-[10px] font-serif italic text-tulip-gold">Chapter 0{{ $idx + 1 }}</span>
                    </div>
                    <h3 class="font-serif font-bold text-base text-delft-800">{{ $st['title'] }}</h3>
                    <p class="text-xs text-delft-700 leading-relaxed mt-1.5">{{ $st['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         7. GALLERY SECTION ("RIJKSMUSEUM DELFT & GOLD GALLERY")
         ================================================================= -->
    <section id="gallerySection" class="relative py-16 px-5 bg-delft-porcelain overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-tulip-gold">Herinneringen</span>
            <h2 class="font-royal text-2xl font-bold text-delft-800 mt-1">Galeri Bahagia</h2>
            <img alt="" class="w-52 mx-auto mt-2" src="{{ $ornDir }}/tulip-divider.png"/>
        </div>

        <!-- Masonry-Style Dutch Porcelain Framed Grid -->
        <div class="grid grid-cols-2 gap-3 max-w-[360px] mx-auto">
            @foreach ($gallery as $idx => $imgUrl)
                <div onclick="openLightbox('{{ $imgUrl }}')" class="group cursor-pointer relative overflow-hidden rounded-2xl border-2 border-delft-700 bg-white p-1.5 shadow-md reveal-scale {{ $idx === 0 ? 'col-span-2 h-56' : 'h-40' }}">
                    <div class="w-full h-full rounded-xl overflow-hidden relative">
                        <img alt="Gallery {{ $idx + 1 }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $imgUrl }}"/>
                        <div class="absolute inset-0 bg-delft-900/0 group-hover:bg-delft-900/25 transition-colors flex items-center justify-center">
                            <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl drop-shadow">zoom_in</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         8. DIGITAL GIFT SECTION ("ROYAL DELFT PORCELAIN BANK CARDS")
         ================================================================= -->
    <section id="giftSection" class="relative py-16 px-5 bg-dutch-cream border-t border-delft-200 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <img alt="" class="w-44 mx-auto mb-2" src="{{ $ornDir }}/delft-windmill-crest.png"/>
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-tulip-gold">Huwelijkscadeau</span>
            <h2 class="font-royal text-2xl font-bold text-delft-800 mt-1">Tanda Kasih</h2>
            <p class="text-xs text-delft-600 mt-1.5 leading-relaxed">
                Doa restu Anda merupakan karunia terindah bagi kami. Namun jika memberi adalah ungkapan tanda kasih, Anda dapat mengirimkan melalui:
            </p>
        </div>

        <div class="space-y-4 max-w-[350px] mx-auto">
            @foreach ($gifts as $idx => $gift)
                <div class="relative delft-porcelain-card rounded-2xl p-5 reveal-up">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 rounded-full bg-delft-800 text-white text-[10px] font-bold uppercase tracking-wider">
                            {{ $gift['bank'] }}
                        </span>
                        <span class="material-symbols-outlined text-tulip-gold">account_balance_wallet</span>
                    </div>
                    <p class="font-mono font-bold text-lg text-delft-900 tracking-wider">{{ $gift['account'] }}</p>
                    <p class="text-xs text-delft-600 mt-0.5">a.n. <strong class="text-delft-800">{{ $gift['name'] }}</strong></p>

                    <button type="button" onclick="copyBankAccount('{{ $gift['account'] }}', this)" class="mt-3.5 inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-delft-50 hover:bg-delft-100 border border-delft-300 text-delft-800 text-[11px] font-bold tracking-wider uppercase transition">
                        <span class="material-symbols-outlined text-sm">content_copy</span>
                        <span class="copy-label">Salin Nomor Rekening</span>
                    </button>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =================================================================
         9. RSVP & WISHES SECTION ("GUCAPAN & DOA RESTU")
         ================================================================= -->
    <section id="rsvpSection" class="relative py-16 px-5 bg-delft-porcelain border-t border-delft-200 overflow-hidden">
        <div class="text-center max-w-[330px] mx-auto mb-8 reveal-up">
            <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-tulip-gold">Gastenboek</span>
            <h2 class="font-royal text-2xl font-bold text-delft-800 mt-1">Doa &amp; Ucapan</h2>
            <img alt="" class="w-52 mx-auto mt-2" src="{{ $ornDir }}/tulip-divider.png"/>
        </div>

        <div class="max-w-[350px] mx-auto delft-porcelain-card rounded-3xl p-5 reveal-up">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form id="wishesForm" action="{{ isset($invitation) ? route('invitations.comments.store', $invitation->id) : '#' }}" method="POST" onsubmit="return handleWishSubmit(event)" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-delft-800 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="wishName" required placeholder="Tuliskan nama Anda" class="w-full rounded-xl border-delft-300 bg-white text-xs text-delft-900 focus:border-delft-700 focus:ring-delft-700"/>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-delft-800 mb-1">Konfirmasi Kehadiran</label>
                    <select name="status" id="wishStatus" class="w-full rounded-xl border-delft-300 bg-white text-xs text-delft-900 focus:border-delft-700 focus:ring-delft-700">
                        <option value="Hadir">Hadir</option>
                        <option value="Tidak Hadir">Berhalangan Hadir</option>
                        <option value="Ragu-ragu">Masih Ragu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-delft-800 mb-1">Ucapan &amp; Doa</label>
                    <textarea name="message" id="wishMessage" rows="3" required placeholder="Tuliskan doa dan ucapan hangat untuk kedua mempelai..." class="w-full rounded-xl border-delft-300 bg-white text-xs text-delft-900 focus:border-delft-700 focus:ring-delft-700"></textarea>
                </div>
                <button type="submit" class="w-full py-3 px-5 rounded-full bg-gradient-to-r from-delft-800 via-delft-700 to-delft-800 text-white font-bold text-xs uppercase tracking-[0.2em] border border-tulip-gold shadow-md hover:brightness-110 transition">
                    Kirim Ucapan
                </button>
            </form>

            <!-- Wishes Wall -->
            <div id="wishesWall" class="mt-6 pt-4 border-t border-delft-200 max-h-64 overflow-y-auto space-y-3 pr-1">
                @foreach ($wishes as $w)
                    <div class="p-3.5 rounded-2xl bg-delft-50/80 border border-delft-200">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-serif font-bold text-xs text-delft-900">{{ $w['name'] }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $w['status'] === 'Hadir' ? 'bg-delft-800 text-amber-200' : 'bg-slate-200 text-slate-700' }}">
                                {{ $w['status'] }}
                            </span>
                        </div>
                        <p class="text-xs text-delft-700 leading-relaxed">{{ $w['message'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =================================================================
         10. CLOSING FOOTER WITH LIVING WINDMILL & TULIP MEADOW
         ================================================================= -->
    <footer class="relative pt-14 pb-28 px-6 bg-gradient-to-b from-delft-900 to-[#061224] text-white text-center overflow-hidden">
        <!-- Spinning Dutch Windmill Closing Emblem -->
        <div class="relative w-32 h-44 mx-auto mb-3 reveal-scale">
            <img alt="Dutch Windmill" class="w-full h-full object-contain" src="{{ $ornDir }}/windmill-tower.png"/>
            <div class="absolute left-1/2 top-[18.25%] -translate-x-1/2 -translate-y-1/2 w-36 h-36">
                <img alt="" class="w-full h-full object-contain anim-windmill-sails" src="{{ $ornDir }}/windmill-blades.png"/>
            </div>
        </div>

        <p class="text-xs text-delft-200 max-w-[300px] mx-auto leading-relaxed">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.
        </p>
        <p class="text-[10px] font-bold uppercase tracking-[0.28em] text-amber-300 mt-4">Kami Yang Berbahagia</p>
        <h3 class="font-script text-4xl text-white mt-1">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h3>

        <!-- Bottom Tulip Meadow Corners -->
        <img alt="" class="anim-tulip-left absolute -bottom-4 -left-4 w-40 pointer-events-none opacity-95" src="{{ $ornDir }}/tulip-meadow-left.png"/>
        <img alt="" class="anim-tulip-right absolute -bottom-4 -right-4 w-40 pointer-events-none opacity-95" src="{{ $ornDir }}/tulip-meadow-right.png"/>
    </footer>

    <!-- =================================================================
         FLOATING AUDIO CONTROLLER & STICKY ROYAL DELFT BOTTOM NAVIGATION
         ================================================================= -->
    <audio id="bgMusic" loop preload="auto" src="{{ $musicUrl }}"></audio>

    <button id="musicToggleBtn" type="button" onclick="toggleDutchMusic()" aria-label="Toggle Music" class="fixed bottom-20 right-4 z-40 w-11 h-11 rounded-full bg-delft-800 text-amber-300 border-2 border-tulip-gold shadow-lg flex items-center justify-center hover:scale-105 transition">
        <span id="musicIcon" class="material-symbols-outlined text-xl animate-spin" style="animation-duration: 8s;">music_note</span>
    </button>

    <nav class="fixed bottom-3 inset-x-0 z-40 mx-auto w-[92%] max-w-[390px] rounded-full bg-white/95 backdrop-blur-md border-2 border-delft-800 shadow-[0_12px_30px_rgba(9,27,56,0.35)] px-3 py-2 flex items-center justify-around">
        <a href="#heroSection" class="flex flex-col items-center text-delft-800 hover:text-tulip-gold transition">
            <span class="material-symbols-outlined text-lg">home</span>
            <span class="text-[9px] font-bold uppercase tracking-wider">Home</span>
        </a>
        <a href="#coupleSection" class="flex flex-col items-center text-delft-800 hover:text-tulip-gold transition">
            <span class="material-symbols-outlined text-lg">favorite</span>
            <span class="text-[9px] font-bold uppercase tracking-wider">Mempelai</span>
        </a>
        <a href="#eventSection" class="flex flex-col items-center text-delft-800 hover:text-tulip-gold transition">
            <span class="material-symbols-outlined text-lg">event</span>
            <span class="text-[9px] font-bold uppercase tracking-wider">Acara</span>
        </a>
        <a href="#gallerySection" class="flex flex-col items-center text-delft-800 hover:text-tulip-gold transition">
            <span class="material-symbols-outlined text-lg">photo_library</span>
            <span class="text-[9px] font-bold uppercase tracking-wider">Galeri</span>
        </a>
        <a href="#rsvpSection" class="flex flex-col items-center text-delft-800 hover:text-tulip-gold transition">
            <span class="material-symbols-outlined text-lg">chat</span>
            <span class="text-[9px] font-bold uppercase tracking-wider">Ucapan</span>
        </a>
    </nav>

    <!-- =================================================================
         FULLSCREEN LIGHTBOX MODAL
         ================================================================= -->
    <div id="lightboxModal" onclick="closeLightbox()" class="fixed inset-0 z-50 hidden bg-delft-900/90 backdrop-blur-md items-center justify-center p-4">
        <button type="button" class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center">
            <span class="material-symbols-outlined">close</span>
        </button>
        <img id="lightboxImage" alt="Preview" class="max-w-full max-h-[85vh] rounded-2xl border-2 border-tulip-gold shadow-2xl object-contain" src=""/>
    </div>

</div>

<!-- =====================================================================
     INTERACTIVE SCRIPTS (Cover Windmill Boost, Countdown, Lightbox, Audio)
     ===================================================================== -->
<script>
    const audioEl = document.getElementById('bgMusic');
    const musicIcon = document.getElementById('musicIcon');
    let isPlaying = false;

    function openDutchInvitation() {
        const cover = document.getElementById('coverOverlay');
        const blades = document.getElementById('coverWindmillBlades');
        if (blades) {
            blades.classList.add('anim-windmill-sails-fast');
        }
        if (cover) {
            cover.classList.add('cover-open');
        }
        if (audioEl) {
            audioEl.play().then(() => {
                isPlaying = true;
            }).catch(() => {});
        }
    }

    function toggleDutchMusic() {
        if (!audioEl) return;
        if (isPlaying) {
            audioEl.pause();
            isPlaying = false;
            musicIcon.textContent = 'music_off';
            musicIcon.classList.remove('animate-spin');
        } else {
            audioEl.play().then(() => {
                isPlaying = true;
                musicIcon.textContent = 'music_note';
                musicIcon.classList.add('animate-spin');
            }).catch(() => {});
        }
    }

    // Countdown Timer
    (function initCountdown() {
        const grid = document.getElementById('countdownGrid');
        if (!grid) return;
        const targetStr = grid.getAttribute('data-date');
        const targetTime = new Date(targetStr).getTime();

        function updateTimer() {
            const now = new Date().getTime();
            let diff = targetTime - now;
            if (isNaN(diff) || diff <= 0) {
                diff = 124 * 86400000 + 8 * 3600000 + 45 * 60000;
            }
            const d = Math.floor(diff / (1000 * 60 * 60 * 24));
            const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);

            document.getElementById('cd-days').textContent  = String(d).padStart(2, '0');
            document.getElementById('cd-hours').textContent = String(h).padStart(2, '0');
            document.getElementById('cd-mins').textContent  = String(m).padStart(2, '0');
            document.getElementById('cd-secs').textContent  = String(s).padStart(2, '0');
        }
        updateTimer();
        setInterval(updateTimer, 1000);
    })();

    // Scroll Reveal Observer
    (function initScrollReveal() {
        const els = document.querySelectorAll('.reveal-up, .reveal-scale, .reveal-left, .reveal-right');
        if (!('IntersectionObserver' in window)) {
            els.forEach(el => el.classList.add('is-visible'));
            return;
        }
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.14 });
        els.forEach(el => obs.observe(el));
    })();

    // Copy Bank Account
    function copyBankAccount(acc, btn) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(acc);
        }
        const label = btn.querySelector('.copy-label');
        if (label) {
            const orig = label.textContent;
            label.textContent = 'Berhasil Disalin!';
            setTimeout(() => { label.textContent = orig; }, 2000);
        }
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

    // Demo Wish Submit Handler (when previewing without $invitation)
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
            item.className = 'p-3.5 rounded-2xl bg-delft-50/80 border border-delft-200';
            item.innerHTML = `
                <div class="flex items-center justify-between mb-1">
                    <span class="font-serif font-bold text-xs text-delft-900"></span>
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase bg-delft-800 text-amber-200"></span>
                </div>
                <p class="text-xs text-delft-700 leading-relaxed"></p>
            `;
            item.querySelector('span:first-child').textContent = name;
            item.querySelector('span:last-child').textContent = status;
            item.querySelector('p').textContent = message;
            wall.prepend(item);
            form.reset();
            return false;
        }
        return true;
    }
</script>
</body>
</html>
