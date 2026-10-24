@php
    // Dynamic Invitation Mapping for wedding-29 (The Royal Orangery & Emerald Botanical Editorial)
    if (isset($invitation)) {
        $names = explode('&', $invitation->title ?? 'Elias & Jada');
        $groomName = trim($names[0] ?? 'Elias');
        $brideName = trim($names[1] ?? 'Jada');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'groom_full' => $invitation->groom_name ?? ($groomName . ' Putra Pratama, S.T.'),
            'bride_full' => $invitation->bride_name ?? ($brideName . ' Amira Permata, B.A.'),
            'parents' => [
                'groom' => $invitation->description ?? 'Putra pertama Bpk. Ahmad Suherman & Ibu Sari Widowati',
                'bride' => 'Putri kedua Bpk. Hendra Wijaya & Ibu Linda Permata',
            ],
        ];

        $eventDateObj = $invitation->event_date ? \Carbon\Carbon::parse($invitation->event_date) : \Carbon\Carbon::parse('2027-05-12');
        $event = [
            'date_iso' => $eventDateObj->format('Y-m-d'),
            'date_formatted' => $eventDateObj->translatedFormat('l, d F Y'),
            'date_short' => $eventDateObj->format('d . m . Y'),
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'The Glasshouse Orangery, Hotel Mulia',
            'address' => $invitation->address ?? 'Jl. Asia Afrika, Senayan, Jakarta Pusat',
            'maps_url' => $invitation->google_maps_url ?? ('https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Hotel Mulia Senayan Jakarta')),
        ];

        $schedule = [
            [
                'title' => 'Ikrar Suci Akad Nikah',
                'badge' => 'HOLY MATRIMONY',
                'date' => $eventDateObj->translatedFormat('l, d F Y'),
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' – 10:00 WIB',
                'venue' => $invitation->location ?? 'The Emerald Glasshouse Sanctuary',
                'address' => $invitation->address ?? 'Jl. Asia Afrika, Senayan, Jakarta Pusat',
            ],
            [
                'title' => 'Gardenia Orangery Reception',
                'badge' => 'WEDDING RECEPTION',
                'date' => $eventDateObj->translatedFormat('l, d F Y'),
                'time' => '11:00 – 14:00 WIB',
                'venue' => $invitation->location ?? 'Grand Botanical Conservatory, Hotel Mulia',
                'address' => $invitation->address ?? 'Jl. Asia Afrika, Senayan, Jakarta Pusat',
            ],
        ];

        if (isset($invitation->stories) && $invitation->stories->count() > 0) {
            $stories = [];
            foreach ($invitation->stories as $story) {
                $stories[] = [
                    'title' => $story->title,
                    'date' => $story->date,
                    'text' => $story->content,
                ];
            }
        } else {
            $stories = [
                [
                    'title' => 'Pertemuan di Rumah Kaca',
                    'date' => 'Agustus 2022',
                    'text' => 'Di bawah teduhnya atap kaca dan aroma eukaliptus pagi itu, dua langkah yang semula asing berpapasan dan memulai percakapan hangat pertama.',
                ],
                [
                    'title' => 'Merangkai Musim Bersama',
                    'date' => 'Januari 2025',
                    'text' => 'Setiap perjalanan, tawa, dan doa yang dipanjatkan bersama menjadi akar yang menguatkan langkah kami menuju satu tujuan yang sama.',
                ],
                [
                    'title' => 'Ikatan Janji Abadi',
                    'date' => 'Mei 2027',
                    'text' => 'Dua cincin, satu ikrar suci, dan lembaran baru untuk saling meneduhkan sepanjang usia dalam ridha-Nya.',
                ],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-29/images/image_10.jpg'),
                asset('assets/templates/wedding-29/images/image_11.jpg'),
                asset('assets/templates/wedding-29/images/image_12.jpg'),
                asset('assets/templates/wedding-29/images/image_13.jpg'),
                asset('assets/templates/wedding-29/images/image_2.jpg'),
                asset('assets/templates/wedding-29/images/image_3.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-29/images/image_2.jpg');
        $bg = [
            'cover' => $coverUrl,
            'hero' => asset('assets/templates/wedding-29/images/image_2.jpg'),
            'hero_small_1' => asset('assets/templates/wedding-29/images/image_3.jpg'),
            'hero_small_2' => asset('assets/templates/wedding-29/images/image_4.jpg'),
            'story_1' => asset('assets/templates/wedding-29/images/image_5.jpg'),
            'story_2' => asset('assets/templates/wedding-29/images/image_6.jpg'),
            'story_3' => asset('assets/templates/wedding-29/images/image_7.jpg'),
            'groom' => asset('assets/templates/wedding-29/images/image_8.jpg'),
            'bride' => asset('assets/templates/wedding-29/images/image_9.jpg'),
        ];

        if (isset($invitation->comments) && $invitation->comments->count() > 0) {
            $wishes = [];
            foreach ($invitation->comments as $comment) {
                $wishes[] = [
                    'name' => $comment->name,
                    'status' => $comment->status,
                    'message' => $comment->message,
                ];
            }
        } else {
            $wishes = [
                ['name' => 'Diana & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Elias & Jada! Semoga menjadi keluarga sakinah mawaddah warahmah dan bahagia selamanya.'],
                ['name' => 'Rafi Alfian', 'status' => 'Hadir', 'message' => 'Happy wedding bro! Semoga seluruh rangkaian acara berjalan lancar dan penuh berkah sampai hari H.'],
                ['name' => 'Clara Anastasia', 'status' => 'Hadir', 'message' => 'Undangan dan temanya cantik sekali! Selamat berbahagia untuk Jada & Elias, sampai jumpa di acara resepsi.'],
            ];
        }

        if (isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0) {
            $gifts = [];
            foreach ($invitation->bankAccounts as $bank) {
                $gifts[] = [
                    'bank' => $bank->bank_name,
                    'name' => $bank->account_name,
                    'account' => $bank->account_number,
                ];
            }
        } else {
            $gifts = [
                ['bank' => 'BCA', 'name' => 'Elias Putra Pratama', 'account' => '123 456 7890'],
                ['bank' => 'Mandiri', 'name' => 'Jada Amira Permata', 'account' => '098 765 4321'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        $couple = [
            'groom' => 'Elias',
            'bride' => 'Jada',
            'groom_full' => 'Elias Putra Pratama, S.T.',
            'bride_full' => 'Jada Amira Permata, B.A.',
            'parents' => [
                'groom' => 'Putra pertama Bpk. Ahmad Suherman & Ibu Sari Widowati',
                'bride' => 'Putri kedua Bpk. Hendra Wijaya & Ibu Linda Permata',
            ],
        ];

        $event = [
            'date_iso' => '2027-05-12',
            'date_formatted' => 'Minggu, 12 Mei 2027',
            'date_short' => '12 . 05 . 2027',
            'time' => '08:00',
            'location' => 'The Glasshouse Orangery, Hotel Mulia',
            'address' => 'Jl. Asia Afrika, Senayan, Jakarta Pusat',
            'maps_url' => 'https://maps.google.com/?q=Hotel+Mulia+Senayan+Jakarta',
        ];

        $schedule = [
            [
                'title' => 'Ikrar Suci Akad Nikah',
                'badge' => 'HOLY MATRIMONY',
                'date' => 'Minggu, 12 Mei 2027',
                'time' => '08:00 – 10:00 WIB',
                'venue' => 'The Emerald Glasshouse Sanctuary',
                'address' => 'Jl. Asia Afrika, Senayan, Jakarta Pusat',
            ],
            [
                'title' => 'Gardenia Orangery Reception',
                'badge' => 'WEDDING RECEPTION',
                'date' => 'Minggu, 12 Mei 2027',
                'time' => '11:00 – 14:00 WIB',
                'venue' => 'Grand Botanical Conservatory, Hotel Mulia',
                'address' => 'Jl. Asia Afrika, Senayan, Jakarta Pusat',
            ],
        ];

        $stories = [
            [
                'title' => 'Pertemuan di Rumah Kaca',
                'date' => 'Agustus 2022',
                'text' => 'Di bawah teduhnya atap kaca dan aroma eukaliptus pagi itu, dua langkah yang semula asing berpapasan dan memulai percakapan hangat pertama.',
            ],
            [
                'title' => 'Merangkai Musim Bersama',
                'date' => 'Januari 2025',
                'text' => 'Setiap perjalanan, tawa, dan doa yang dipanjatkan bersama menjadi akar yang menguatkan langkah kami menuju satu tujuan yang sama.',
            ],
            [
                'title' => 'Ikatan Janji Abadi',
                'date' => 'Mei 2027',
                'text' => 'Dua cincin, satu ikrar suci, dan lembaran baru untuk saling meneduhkan sepanjang usia dalam ridha-Nya.',
            ],
        ];

        $gallery = [
            asset('assets/templates/wedding-29/images/image_10.jpg'),
            asset('assets/templates/wedding-29/images/image_11.jpg'),
            asset('assets/templates/wedding-29/images/image_12.jpg'),
            asset('assets/templates/wedding-29/images/image_13.jpg'),
            asset('assets/templates/wedding-29/images/image_2.jpg'),
            asset('assets/templates/wedding-29/images/image_3.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-29/images/image_2.jpg'),
            'hero' => asset('assets/templates/wedding-29/images/image_2.jpg'),
            'hero_small_1' => asset('assets/templates/wedding-29/images/image_3.jpg'),
            'hero_small_2' => asset('assets/templates/wedding-29/images/image_4.jpg'),
            'story_1' => asset('assets/templates/wedding-29/images/image_5.jpg'),
            'story_2' => asset('assets/templates/wedding-29/images/image_6.jpg'),
            'story_3' => asset('assets/templates/wedding-29/images/image_7.jpg'),
            'groom' => asset('assets/templates/wedding-29/images/image_8.jpg'),
            'bride' => asset('assets/templates/wedding-29/images/image_9.jpg'),
        ];

        $wishes = [
            ['name' => 'Diana & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Elias & Jada! Semoga menjadi keluarga sakinah mawaddah warahmah dan bahagia selamanya.'],
            ['name' => 'Rafi Alfian', 'status' => 'Hadir', 'message' => 'Happy wedding bro! Semoga seluruh rangkaian acara berjalan lancar dan penuh berkah sampai hari H.'],
            ['name' => 'Clara Anastasia', 'status' => 'Hadir', 'message' => 'Undangan dan temanya cantik sekali! Selamat berbahagia untuk Jada & Elias, sampai jumpa di acara resepsi.'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Elias Putra Pratama', 'account' => '123 456 7890'],
            ['bank' => 'Mandiri', 'name' => 'Jada Amira Permata', 'account' => '098 765 4321'],
        ];

        $musicUrl = asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    }

    $groomInitial = mb_strtoupper(mb_substr($couple['groom'], 0, 1));
    $brideInitial = mb_strtoupper(mb_substr($couple['bride'], 0, 1));

    $getOrnament = function (string $filename) {
        $rel = 'assets/templates/wedding-29/ornaments/' . $filename;
        $full = public_path($rel);
        $v = file_exists($full) ? filemtime($full) : time();
        return asset($rel) . '?v=' . $v;
    };
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $couple['groom'] }} &amp; {{ $couple['bride'] }} – Botanical Glasshouse</title>

    <!-- Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts: Playfair Display, Cormorant Garamond, Pinyon Script, Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700&family=Pinyon+Script&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            950: '#031c14',
                            900: '#063224',
                            800: '#0a4734',
                            700: '#115e46',
                        },
                        alabaster: {
                            50: '#FDFBF7',
                            100: '#FAF6EE',
                            200: '#F2ECE1',
                            300: '#E5DCCB',
                        },
                        gold: {
                            200: '#F9E5A8',
                            300: '#F1D07E',
                            400: '#D9AE4C',
                            500: '#C29432',
                            600: '#9A701B',
                        }
                    },
                    fontFamily: {
                        display: ['Playfair Display', 'serif'],
                        serif: ['Cormorant Garamond', 'serif'],
                        script: ['Pinyon Script', 'cursive'],
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Washi Tape Effect for Botanical Scrapbook Polaroids */
        .washi-tape-gold {
            background: linear-gradient(135deg, rgba(241, 208, 126, 0.78) 0%, rgba(194, 148, 50, 0.68) 100%);
            box-shadow: 0 2px 6px rgba(6, 50, 36, 0.15);
            backdrop-filter: blur(2px);
            mask-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 0 L6 4 L12 0 L18 4 L24 0 L30 4 L36 0 L42 4 L48 0 L54 4 L60 0 L66 4 L72 0 L78 4 L84 0 L90 4 L96 0 L100 3 V17 L96 20 L90 16 L84 20 L78 16 L72 20 L66 16 L60 20 L54 16 L48 20 L42 16 L36 20 L30 16 L24 20 L18 16 L12 20 L6 16 L0 20 Z" fill="black"/></svg>');
            -webkit-mask-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg"><path d="M0 0 L6 4 L12 0 L18 4 L24 0 L30 4 L36 0 L42 4 L48 0 L54 4 L60 0 L66 4 L72 0 L78 4 L84 0 L90 4 L96 0 L100 3 V17 L96 20 L90 16 L84 20 L78 16 L72 20 L66 16 L60 20 L54 16 L48 20 L42 16 L36 20 L30 16 L24 20 L18 16 L12 20 L6 16 L0 20 Z" fill="black"/></svg>');
        }
        .washi-tape-sage {
            background: linear-gradient(135deg, rgba(167, 215, 193, 0.78) 0%, rgba(110, 168, 142, 0.72) 100%);
            box-shadow: 0 2px 6px rgba(6, 50, 36, 0.14);
            backdrop-filter: blur(2px);
        }

        /* Fine Botanical Paper Grain Overlay */
        .paper-texture {
            background-color: #FAF6EE;
            background-image:
                radial-gradient(rgba(194, 148, 50, 0.08) 1px, transparent 1px),
                radial-gradient(rgba(6, 50, 36, 0.04) 1px, #FAF6EE 1px);
            background-size: 28px 28px;
            background-position: 0 0, 14px 14px;
        }

        /* Polaroid Card Styling */
        .botanical-polaroid {
            background: #FFFFFF;
            box-shadow:
                0 14px 32px -6px rgba(6, 50, 36, 0.18),
                0 4px 10px -2px rgba(6, 50, 36, 0.08),
                inset 0 0 0 1px rgba(194, 148, 50, 0.22);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s ease;
        }
        .botanical-polaroid:hover {
            transform: translateY(-4px) rotate(0deg) !important;
            box-shadow: 0 20px 40px -8px rgba(6, 50, 36, 0.26);
        }

        /* =========================================================
           1. COVER ENTRANCE & LIVING ORANGERY ANIMATIONS
           ========================================================= */
        @keyframes orangeryBgZoom {
            0%   { transform: scale(1.12); filter: brightness(0.75); }
            100% { transform: scale(1.03); filter: brightness(0.95); }
        }
        @keyframes orangeryBreathing {
            0%, 100% { transform: scale(1.03); }
            50%      { transform: scale(1.08); }
        }
        .anim-orangery-bg {
            animation:
                orangeryBgZoom 2.4s cubic-bezier(0.16, 1, 0.3, 1) forwards,
                orangeryBreathing 16s ease-in-out 2.4s infinite;
        }

        @keyframes chandelierDrop {
            0%   { opacity: 0; transform: translateY(-75px) scale(0.88); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes chandelierSwing {
            0%, 100% { transform: rotate(-1.6deg); }
            50%      { transform: rotate(1.6deg); }
        }
        .anim-chandelier {
            opacity: 0;
            animation: chandelierDrop 1.7s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
            transition: transform 1.2s cubic-bezier(0.65, 0, 0.35, 1), opacity 1s ease;
        }
        .idle-chandelier {
            transform-origin: top center;
            animation: chandelierSwing 6.5s ease-in-out infinite;
        }

        @keyframes vineCurtainLeftIn {
            0%   { opacity: 0; transform: translateX(-60px) scale(0.94); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes vineCurtainRightIn {
            0%   { opacity: 0; transform: translateX(60px) scale(0.94); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }
        .anim-vine-l {
            opacity: 0;
            animation: vineCurtainLeftIn 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.25s forwards;
            transition: transform 1.3s cubic-bezier(0.65, 0, 0.35, 1), opacity 1.1s ease;
        }
        .anim-vine-r {
            opacity: 0;
            animation: vineCurtainRightIn 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.25s forwards;
            transition: transform 1.3s cubic-bezier(0.65, 0, 0.35, 1), opacity 1.1s ease;
        }

        @keyframes archWindowPop {
            0%   { opacity: 0; transform: translateY(32px) scale(0.9); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .anim-arch-window {
            opacity: 0;
            animation: archWindowPop 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.45s forwards;
            transition: transform 1.2s cubic-bezier(0.65, 0, 0.35, 1), opacity 1s ease;
        }

        @keyframes waxSealStamp {
            0%   { opacity: 0; transform: scale(1.45) rotate(-12deg); }
            70%  { opacity: 1; transform: scale(0.94) rotate(3deg); }
            100% { opacity: 1; transform: scale(1) rotate(0deg); }
        }
        .anim-wax-seal {
            opacity: 0;
            animation: waxSealStamp 1.2s cubic-bezier(0.22, 1, 0.36, 1) 0.85s forwards;
        }

        @keyframes bouquetRiseL {
            0%   { opacity: 0; transform: translate(-35px, 45px) scale(0.88); }
            100% { opacity: 1; transform: translate(0, 0) scale(1); }
        }
        @keyframes bouquetRiseR {
            0%   { opacity: 0; transform: translate(35px, 45px) scale(0.88); }
            100% { opacity: 1; transform: translate(0, 0) scale(1); }
        }
        .anim-bouquet-bl {
            opacity: 0;
            animation: bouquetRiseL 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.55s forwards;
            transition: transform 1.2s cubic-bezier(0.65, 0, 0.35, 1), opacity 1s ease;
        }
        .anim-bouquet-br {
            opacity: 0;
            animation: bouquetRiseR 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.55s forwards;
            transition: transform 1.2s cubic-bezier(0.65, 0, 0.35, 1), opacity 1s ease;
        }

        /* Cover Open Curtain-Parting Transition */
        .cover-is-opening .anim-chandelier {
            transform: translateY(-130%) scale(0.9) !important;
            opacity: 0 !important;
        }
        .cover-is-opening .anim-vine-l {
            transform: translateX(-130%) rotate(-8deg) !important;
            opacity: 0 !important;
        }
        .cover-is-opening .anim-vine-r {
            transform: translateX(130%) rotate(8deg) !important;
            opacity: 0 !important;
        }
        .cover-is-opening .anim-bouquet-bl {
            transform: translate(-90%, 90%) !important;
            opacity: 0 !important;
        }
        .cover-is-opening .anim-bouquet-br {
            transform: translate(90%, 90%) !important;
            opacity: 0 !important;
        }
        .cover-is-opening .anim-arch-window {
            transform: scale(1.12) translateY(-15px) !important;
            opacity: 0 !important;
        }

        /* =========================================================
           2. IDLE BOTANICAL SWAY, BUTTERFLIES & SUNBEAM DUST
           ========================================================= */
        @keyframes swayLeftVine {
            0%, 100% { transform: rotate(0deg) scale(1); }
            50%      { transform: rotate(2.4deg) scale(1.015); }
        }
        @keyframes swayRightVine {
            0%, 100% { transform: rotate(0deg) scale(1); }
            50%      { transform: rotate(-2.4deg) scale(1.015); }
        }
        .idle-vine-l { transform-origin: top left; animation: swayLeftVine 5.5s ease-in-out infinite; }
        .idle-vine-r { transform-origin: top right; animation: swayRightVine 6s ease-in-out infinite; }
        .idle-rose-bl { transform-origin: bottom left; animation: swayLeftVine 5s ease-in-out infinite; }
        .idle-rose-br { transform-origin: bottom right; animation: swayRightVine 5.4s ease-in-out infinite; }

        /* Falling White Jasmine Petals & Eucalyptus Leaves */
        @keyframes petalFallA {
            0%   { transform: translate3d(0, -10%, 0) rotate(0deg); opacity: 0; }
            12%  { opacity: 0.88; }
            50%  { transform: translate3d(28px, 48vh, 0) rotate(160deg); opacity: 0.85; }
            88%  { opacity: 0.75; }
            100% { transform: translate3d(-16px, 104vh, 0) rotate(340deg); opacity: 0; }
        }
        @keyframes petalFallB {
            0%   { transform: translate3d(0, -10%, 0) rotate(25deg); opacity: 0; }
            12%  { opacity: 0.82; }
            50%  { transform: translate3d(-32px, 50vh, 0) rotate(-140deg); opacity: 0.8; }
            88%  { opacity: 0.7; }
            100% { transform: translate3d(20px, 104vh, 0) rotate(-300deg); opacity: 0; }
        }
        .petal-fall-a { animation: petalFallA 13s linear infinite; }
        .petal-fall-b { animation: petalFallB 16s linear infinite; }

        /* 3D Fluttering Golden Butterflies */
        @keyframes wingFlutter {
            0%, 100% { transform: scaleX(1) rotateY(0deg); }
            50%      { transform: scaleX(0.32) rotateY(55deg); }
        }
        @keyframes butterflyPath1 {
            0%   { transform: translate3d(-40px, 72vh, 0) rotate(28deg) scale(0.82); opacity: 0; }
            10%  { opacity: 0.92; }
            45%  { transform: translate3d(210px, 42vh, 0) rotate(18deg) scale(1); }
            88%  { opacity: 0.92; }
            100% { transform: translate3d(460px, 14vh, 0) rotate(24deg) scale(0.8); opacity: 0; }
        }
        @keyframes butterflyPath2 {
            0%   { transform: translate3d(450px, 78vh, 0) rotate(-32deg) scale(0.76); opacity: 0; }
            12%  { opacity: 0.88; }
            52%  { transform: translate3d(170px, 48vh, 0) rotate(-18deg) scale(0.95); }
            88%  { opacity: 0.88; }
            100% { transform: translate3d(-50px, 18vh, 0) rotate(-28deg) scale(0.75); opacity: 0; }
        }
        .butterfly-flight-1 { position: absolute; left: 0; top: 0; animation: butterflyPath1 19s ease-in-out infinite; }
        .butterfly-flight-2 { position: absolute; left: 0; top: 0; animation: butterflyPath2 23s ease-in-out -8s infinite; }
        .butterfly-wing { animation: wingFlutter 0.28s ease-in-out infinite; }

        /* =========================================================
           3. SECTION STAGGERED ASSEMBLY SYSTEM (ON SCROLL)
           ========================================================= */
        .anim-section {
            position: relative;
        }
        .stagger-up,
        .stagger-down,
        .stagger-left,
        .stagger-right,
        .stagger-scale,
        .stagger-polaroid-l,
        .stagger-polaroid-r {
            opacity: 0;
            will-change: transform, opacity;
            transition:
                opacity 1.05s cubic-bezier(0.16, 1, 0.3, 1),
                transform 1.15s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .stagger-up         { transform: translateY(36px); }
        .stagger-down       { transform: translateY(-36px); }
        .stagger-left       { transform: translateX(-42px); }
        .stagger-right      { transform: translateX(42px); }
        .stagger-scale      { transform: scale(0.86); }
        .stagger-polaroid-l { transform: translate(-45px, 25px) rotate(-9deg) scale(0.9); }
        .stagger-polaroid-r { transform: translate(45px, 25px) rotate(9deg) scale(0.9); }

        .anim-section.is-visible .stagger-up,
        .anim-section.is-visible .stagger-down,
        .anim-section.is-visible .stagger-left,
        .anim-section.is-visible .stagger-right,
        .anim-section.is-visible .stagger-scale {
            opacity: 1;
            transform: translate(0, 0) scale(1);
        }
        .anim-section.is-visible .stagger-polaroid-l {
            opacity: 1;
            transform: translate(0, 0) rotate(-3deg) scale(1);
        }
        .anim-section.is-visible .stagger-polaroid-r {
            opacity: 1;
            transform: translate(0, 0) rotate(3deg) scale(1);
        }

        .delay-100 { transition-delay: 0.10s !important; }
        .delay-200 { transition-delay: 0.20s !important; }
        .delay-300 { transition-delay: 0.30s !important; }
        .delay-400 { transition-delay: 0.40s !important; }
        .delay-500 { transition-delay: 0.50s !important; }
        .delay-600 { transition-delay: 0.60s !important; }
        .delay-700 { transition-delay: 0.70s !important; }

        /* Clamped Floating UI inside 480px Shell */
        .clamped-shell-float {
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            pointer-events: none;
            z-index: 60;
        }

        @keyframes spinVinyl {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        .spin-vinyl { animation: spinVinyl 9s linear infinite; }
    </style>
</head>

<body
    class="bg-[#031A12] text-emerald-950 font-sans antialiased selection:bg-gold-300 selection:text-emerald-950 overflow-x-hidden"
    x-data="{
        isOpen: false,
        isOpening: false,
        isPlaying: false,
        activeSection: 'hero',
        lightboxOpen: false,
        lightboxImage: '',
        openInvitation() {
            if (this.isOpen || this.isOpening) return;
            this.isOpening = true;
            const audio = document.getElementById('bgMusic');
            if (audio) {
                audio.volume = 0.65;
                audio.play().then(() => { this.isPlaying = true; }).catch(() => {});
            }
            setTimeout(() => {
                this.isOpen = true;
                window.scrollTo({ top: 0, behavior: 'instant' });
                setTimeout(() => {
                    this.observeSections();
                    const heroEl = document.getElementById('hero');
                    if (heroEl) heroEl.classList.add('is-visible');
                }, 80);
            }, 950);
        },
        toggleMusic() {
            const audio = document.getElementById('bgMusic');
            if (!audio) return;
            if (this.isPlaying) {
                audio.pause();
                this.isPlaying = false;
            } else {
                audio.play().then(() => { this.isPlaying = true; }).catch(() => {});
            }
        },
        openLightbox(src) {
            this.lightboxImage = src;
            this.lightboxOpen = true;
        },
        observeSections() {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        if (entry.target.classList.contains('nav-section')) {
                            this.activeSection = entry.target.id;
                        }
                    }
                });
            }, { threshold: 0.14 });
            document.querySelectorAll('.anim-section').forEach(el => obs.observe(el));
        }
    }"
>
    <!-- Background Audio -->
    <audio id="bgMusic" loop preload="auto">
        <source src="{{ $musicUrl }}" type="audio/mpeg">
    </audio>

    <!-- Desktop Ambient Backdrop -->
    <div class="fixed inset-0 pointer-events-none z-0 hidden sm:block overflow-hidden">
        <img src="{{ $getOrnament('glasshouse-daylight-bg.jpg') }}" class="w-full h-full object-cover blur-2xl opacity-25 scale-110" alt="">
        <div class="absolute inset-0 bg-gradient-to-b from-[#031A12]/80 via-[#04241A]/75 to-[#031A12]/90"></div>
    </div>

    <!-- ================================================================== -->
    <!-- MOBILE INVITATION SHELL (MAX-W-480PX)                              -->
    <!-- ================================================================== -->
    <div class="relative z-10 w-full max-w-[480px] min-h-screen mx-auto shadow-[0_0_70px_rgba(0,0,0,0.85)] overflow-x-hidden flex flex-col bg-alabaster-100">

        <!-- ============================================================== -->
        <!-- 1. THE ROYAL ORANGERY GLASSHOUSE COVER OVERLAY                 -->
        <!-- ============================================================== -->
        <div
            id="coverOverlay"
            x-show="!isOpen"
            :class="{ 'cover-is-opening': isOpening }"
            class="fixed inset-0 z-50 w-full max-w-[480px] mx-auto h-[100dvh] overflow-hidden select-none flex flex-col justify-between items-center"
        >
            <!-- Layer 1: Sunlit European Glasshouse Orangery Background -->
            <div class="absolute inset-0 z-0 overflow-hidden bg-[#042218]">
                <img
                    src="{{ $getOrnament('glasshouse-daylight-bg.jpg') }}"
                    class="anim-orangery-bg w-full h-full object-cover object-center"
                    alt="Royal Botanical Orangery"
                >
                <!-- Soft Emerald & Golden Sunlight Gradient Vignette -->
                <div
                    class="absolute inset-0 pointer-events-none"
                    style="background: linear-gradient(180deg, rgba(4, 34, 24, 0.55) 0%, rgba(6, 50, 36, 0.18) 38%, rgba(4, 34, 24, 0.52) 72%, rgba(3, 24, 17, 0.92) 100%);"
                ></div>
            </div>

            <!-- Layer 2: Cascading Eucalyptus & Gardenia Vine Curtains (Left & Right) -->
            <div class="anim-vine-l absolute top-0 -left-3 w-[31%] z-[14] pointer-events-none">
                <img src="{{ $getOrnament('vine-curtain-left.png') }}" class="w-full h-auto idle-vine-l drop-shadow-[0_8px_18px_rgba(0,0,0,0.45)]" alt="Vine Left">
            </div>
            <div class="anim-vine-r absolute top-0 -right-3 w-[31%] z-[14] pointer-events-none">
                <img src="{{ $getOrnament('vine-curtain-right.png') }}" class="w-full h-auto idle-vine-r drop-shadow-[0_8px_18px_rgba(0,0,0,0.45)]" alt="Vine Right">
            </div>

            <!-- Layer 3: Hanging Crystal, Brass & Ivy Botanical Chandelier (Top Center) -->
            <div class="anim-chandelier absolute -top-3 inset-x-0 mx-auto w-[46%] max-w-[205px] z-[16] pointer-events-none flex justify-center">
                <div class="relative w-full idle-chandelier">
                    <!-- Warm Chandelier Candle Aura -->
                    <div class="absolute inset-x-4 top-1/2 -translate-y-1/2 h-20 rounded-full bg-amber-200/30 blur-2xl"></div>
                    <img
                        src="{{ $getOrnament('chandelier-top.png') }}"
                        class="w-full h-auto block drop-shadow-[0_12px_22px_rgba(0,0,0,0.65)]"
                        alt="Botanical Crystal Chandelier"
                    >
                </div>
            </div>

            <!-- Layer 4: Drifting Jasmine Blossoms & Leaves -->
            <div class="absolute inset-0 pointer-events-none z-[18] overflow-hidden">
                <div class="petal-fall-a absolute" style="left: 18%; top: -8%; width: 22px; animation-delay: -2s;">
                    <img src="{{ $getOrnament('falling-blossom.png') }}" class="w-full h-auto drop-shadow" alt="">
                </div>
                <div class="petal-fall-b absolute" style="left: 76%; top: -8%; width: 19px; animation-delay: -6s;">
                    <img src="{{ $getOrnament('falling-leaf.png') }}" class="w-full h-auto drop-shadow" alt="">
                </div>
                <div class="petal-fall-a absolute" style="left: 48%; top: -8%; width: 20px; animation-delay: -9s;">
                    <img src="{{ $getOrnament('falling-blossom.png') }}" class="w-full h-auto drop-shadow" alt="">
                </div>
            </div>

            <!-- Layer 5: Foreground Bottom White Rose & Gold Fern Bouquets -->
            <div class="anim-bouquet-bl absolute -bottom-4 -left-5 w-[42%] z-[26] pointer-events-none">
                <img src="{{ $getOrnament('floral-bottom-left.png') }}" class="w-full h-auto idle-rose-bl drop-shadow-[0_10px_20px_rgba(0,0,0,0.75)]" alt="Rose Bouquet Left">
            </div>
            <div class="anim-bouquet-br absolute -bottom-4 -right-5 w-[42%] z-[26] pointer-events-none">
                <img src="{{ $getOrnament('floral-bottom-right.png') }}" class="w-full h-auto idle-rose-br drop-shadow-[0_10px_20px_rgba(0,0,0,0.75)]" alt="Rose Bouquet Right">
            </div>

            <!-- Layer 6: Central Botanical Glasshouse Arch Card & Typography -->
            <div class="relative z-[30] w-full h-full flex flex-col justify-between items-center pt-[138px] pb-6 px-6">

                <!-- Centerpiece: Glasshouse Arched Portrait Frame + Wax Seal -->
                <div class="anim-arch-window relative w-full max-w-[276px] mx-auto flex flex-col items-center">
                    <!-- Outer Cream & Gold Passe-Partout Arch Card -->
                    <div class="relative w-full rounded-t-[140px] rounded-b-[28px] p-2.5 bg-alabaster-50/95 backdrop-blur-md shadow-[0_24px_50px_rgba(0,0,0,0.65)] border-2 border-gold-400">
                        <!-- Inner Gold Hairline Frame -->
                        <div class="relative w-full rounded-t-[130px] rounded-b-[20px] p-1.5 border border-emerald-900/20 bg-alabaster-100">
                            <!-- Couple Portrait inside Arch -->
                            <div class="relative w-full h-[215px] sm:h-[230px] rounded-t-[124px] rounded-b-[14px] overflow-hidden">
                                <img
                                    src="{{ $bg['cover'] }}"
                                    class="w-full h-full object-cover object-top"
                                    alt="{{ $couple['groom'] }} & {{ $couple['bride'] }}"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/65 via-transparent to-emerald-950/15"></div>
                                <!-- Top Small Pill inside Arch -->
                                <div class="absolute top-3 inset-x-0 flex justify-center">
                                    <span class="px-3 py-0.5 rounded-full bg-emerald-950/65 backdrop-blur-sm border border-gold-300/45 text-[8.5px] tracking-[0.28em] uppercase text-gold-200 font-medium">
                                        THE WEDDING OF
                                    </span>
                                </div>
                            </div>

                            <!-- Editorial Names & Date inside Arch Base -->
                            <div class="pt-6 pb-2.5 px-3 text-center bg-alabaster-50 rounded-b-[14px]">
                                <h1 class="font-display text-[28px] sm:text-[31px] font-bold text-emerald-900 leading-none tracking-tight">
                                    {{ $couple['groom'] }}
                                    <span class="font-script text-gold-500 text-3xl font-normal mx-1">&amp;</span>
                                    {{ $couple['bride'] }}
                                </h1>
                                <p class="font-serif italic text-xs text-emerald-800/80 mt-1 tracking-wider">
                                    {{ $event['date_formatted'] }}
                                </p>
                            </div>
                        </div>

                        <!-- 3D Emerald & Gold Botanical Wax Seal Stamp Overlapping the Arch Seam -->
                        <div class="absolute inset-x-0 top-[188px] sm:top-[202px] z-20 flex justify-center pointer-events-none">
                            <div class="anim-wax-seal relative w-24 h-16 flex items-center justify-center">
                                <img
                                    src="{{ $getOrnament('emerald-wax-seal.png') }}"
                                    class="w-full h-full object-contain drop-shadow-[0_6px_12px_rgba(0,0,0,0.5)]"
                                    alt="Emerald Wax Seal"
                                >
                                <!-- Dynamic Couple Initials Badge on Wax Center -->
                                <div class="absolute w-7 h-7 rounded-full bg-gradient-to-br from-[#0c4a35] to-[#05261b] border border-gold-400/80 flex items-center justify-center shadow-inner">
                                    <span class="font-display text-[9px] font-bold tracking-tighter text-gold-200">{{ $groomInitial }}&amp;{{ $brideInitial }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Guest Badge & Interactive CTA Button -->
                <div class="w-full max-w-[290px] flex flex-col items-center text-center mt-2">
                    <div class="w-full py-2 px-4 rounded-2xl bg-emerald-950/75 backdrop-blur-md border border-gold-400/40 shadow-lg mb-2.5">
                        <p class="text-[9.5px] uppercase tracking-[0.24em] text-gold-300 font-medium">
                            Kepada Yth. Bapak/Ibu/Saudara/i
                        </p>
                        <p class="font-display text-sm sm:text-base font-semibold text-alabaster-50 truncate mt-0.5">
                            {{ request('to', request('kpd', 'Sahabat & Keluarga Tercinta')) }}
                        </p>
                    </div>

                    <button
                        id="btnOpenInvitation"
                        @click="openInvitation()"
                        class="group relative w-full py-3 px-7 rounded-full bg-gradient-to-r from-[#073B2A] via-[#0B523B] to-[#073B2A] border-2 border-gold-300 shadow-[0_10px_25px_rgba(0,0,0,0.65)] flex items-center justify-center gap-2.5 cursor-pointer hover:scale-[1.02] active:scale-95 transition-all"
                    >
                        <span class="w-1.5 h-1.5 rounded-full bg-gold-300"></span>
                        <span class="font-sans text-xs font-semibold uppercase tracking-[0.24em] text-alabaster-50">
                            Buka Undangan
                        </span>
                        <svg class="w-3.5 h-3.5 text-gold-300 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- ============================================================== -->
        <!-- PERSISTENT AMBIENT BUTTERFLIES & FLOATING AUDIO CONTROL        -->
        <!-- ============================================================== -->
        <div
            x-show="isOpen"
            x-cloak
            class="clamped-shell-float top-4 px-4 flex justify-between items-center z-50"
        >
            <!-- Monogram Pill -->
            <div class="pointer-events-auto px-3.5 py-1.5 rounded-full bg-emerald-950/85 backdrop-blur-md border border-gold-400/50 shadow-lg flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="font-display text-xs font-bold text-gold-200 tracking-wider">{{ $groomInitial }} &amp; {{ $brideInitial }}</span>
            </div>

            <!-- Music Vinyl Button -->
            <button
                @click="toggleMusic()"
                class="pointer-events-auto w-10 h-10 rounded-full bg-emerald-950/90 border border-gold-400/70 backdrop-blur-md flex items-center justify-center text-gold-300 shadow-xl"
                :title="isPlaying ? 'Pause Musik' : 'Putar Musik'"
            >
                <div :class="isPlaying ? 'spin-vinyl' : ''" class="flex items-center justify-center">
                    <svg x-show="isPlaying" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    <svg x-show="!isPlaying" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l6 6 1.27-1.27L4.27 3zM14 7h4V3h-6v5.18l2 2z"/></svg>
                </div>
            </button>
        </div>

        <!-- Persistent Ambient Golden Butterflies Layer -->
        <div
            x-show="isOpen"
            x-cloak
            class="clamped-shell-float inset-0 pointer-events-none z-30 overflow-hidden"
            style="height: 100vh; height: 100dvh;"
        >
            <div class="butterfly-flight-1">
                <div class="butterfly-wing">
                    <img src="{{ $getOrnament('gold-butterfly.png') }}" class="w-7 h-auto drop-shadow-[0_2px_8px_rgba(194,148,50,0.65)]" alt="">
                </div>
            </div>
            <div class="butterfly-flight-2">
                <div class="butterfly-wing" style="animation-duration: 0.24s;">
                    <img src="{{ $getOrnament('gold-butterfly.png') }}" class="w-6 h-auto drop-shadow-[0_2px_8px_rgba(194,148,50,0.65)]" alt="">
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- 2. MAIN INVITATION CONTENT (POST-COVER)                        -->
        <!-- ============================================================== -->
        <main
            id="main-scroll"
            x-show="isOpen"
            x-init="observeSections()"
            class="relative w-full flex-1 flex flex-col pb-24"
        >

            <!-- ============================================================== -->
            <!-- SECTION 1: HERO – BOTANICAL SCRAPBOOK COLLAGE & COUNTDOWN      -->
            <!-- (WARM ALABASTER PAPER TEXTURE — DISTINCT EDITORIAL STYLE)      -->
            <!-- ============================================================== -->
            <section
                id="hero"
                class="anim-section nav-section paper-texture relative pt-16 pb-14 px-6 overflow-hidden"
            >
                <!-- Top Corner Cascading White English Roses -->
                <div class="stagger-left absolute -top-4 -left-7 w-32 pointer-events-none z-10 opacity-95">
                    <img src="{{ $getOrnament('floral-top-left.png') }}" class="w-full h-auto idle-vine-l drop-shadow-md" alt="">
                </div>
                <div class="stagger-right absolute -top-4 -right-7 w-32 pointer-events-none z-10 opacity-95">
                    <img src="{{ $getOrnament('floral-top-right.png') }}" class="w-full h-auto idle-vine-r drop-shadow-md" alt="">
                </div>

                <!-- Header Tagline -->
                <div class="relative z-20 text-center mt-3 mb-6 px-6">
                    <p class="stagger-down text-[9.5px] font-sans font-semibold uppercase tracking-[0.28em] text-emerald-800">
                        THE ROYAL BOTANICAL CELEBRATION
                    </p>
                    <h2 class="stagger-up delay-100 font-display text-3xl sm:text-4xl font-bold text-emerald-950 mt-1">
                        {{ $couple['groom'] }}
                        <span class="font-script text-gold-500 font-normal text-4xl mx-1">&amp;</span>
                        {{ $couple['bride'] }}
                    </h2>
                    <p class="stagger-up delay-200 font-serif italic text-sm text-emerald-800/80 mt-0.5">
                        {{ $event['date_formatted'] }}
                    </p>
                </div>

                <!-- Editorial Polaroid Trio Collage with Gold Washi Tape -->
                <div class="relative z-20 max-w-[360px] mx-auto">
                    <!-- Main Featured Polaroid -->
                    <div class="stagger-scale delay-200 relative z-20 botanical-polaroid p-3.5 pb-10 rounded-xl rotate-[-1.5deg]">
                        <div class="washi-tape-gold absolute -top-3 left-1/2 -translate-x-1/2 w-28 h-6 z-30"></div>
                        <div class="relative w-full aspect-[4/4.3] overflow-hidden rounded-lg">
                            <img src="{{ $bg['hero'] }}" class="w-full h-full object-cover object-top" alt="Selamanya Bersama">
                        </div>
                        <p class="font-script text-2xl text-emerald-900 text-center mt-3 leading-none">
                            Selamanya Dalam Kasih
                        </p>
                    </div>

                    <!-- Two Overlapping Secondary Polaroids -->
                    <div class="grid grid-cols-2 gap-3.5 -mt-4 relative z-30 px-1">
                        <div class="stagger-polaroid-l delay-300 botanical-polaroid p-2.5 pb-6 rounded-xl relative">
                            <div class="washi-tape-sage absolute -top-2.5 left-6 w-20 h-5 z-30"></div>
                            <img src="{{ $bg['hero_small_1'] }}" class="w-full aspect-square object-cover rounded-md" alt="Momen 1">
                            <p class="font-serif italic text-[11px] text-emerald-800 text-center mt-2">Our Promise</p>
                        </div>
                        <div class="stagger-polaroid-r delay-400 botanical-polaroid p-2.5 pb-6 rounded-xl relative mt-3">
                            <div class="washi-tape-gold absolute -top-2.5 right-6 w-20 h-5 z-30"></div>
                            <img src="{{ $bg['hero_small_2'] }}" class="w-full aspect-square object-cover rounded-md" alt="Momen 2">
                            <p class="font-serif italic text-[11px] text-emerald-800 text-center mt-2">Forevermore</p>
                        </div>
                    </div>
                </div>

                <!-- Bespoke Botanical Rose & Gold Olive Divider -->
                <div class="stagger-up delay-400 flex justify-center my-6">
                    <img src="{{ $getOrnament('botanical-divider.png') }}" class="w-56 h-auto drop-shadow-sm" alt="Botanical Divider">
                </div>

                <!-- Deep Emerald & Gold Glasshouse Countdown Card -->
                <div
                    class="stagger-up delay-500 relative z-20 max-w-[360px] mx-auto rounded-3xl p-5 bg-gradient-to-br from-emerald-900 via-emerald-950 to-emerald-900 border-2 border-gold-400/70 shadow-[0_18px_40px_rgba(6,50,36,0.28)] text-center text-alabaster-50"
                    x-data="{
                        target: new Date('{{ $event['date_iso'] }}T{{ $event['time'] }}').getTime(),
                        days: '00', hours: '00', minutes: '00', seconds: '00',
                        init() {
                            const update = () => {
                                let d = Math.max(0, this.target - new Date().getTime());
                                this.days = String(Math.floor(d / 86400000)).padStart(2, '0');
                                this.hours = String(Math.floor((d % 86400000) / 3600000)).padStart(2, '0');
                                this.minutes = String(Math.floor((d % 3600000) / 60000)).padStart(2, '0');
                                this.seconds = String(Math.floor((d % 60000) / 1000)).padStart(2, '0');
                            };
                            update();
                            setInterval(update, 1000);
                        }
                    }"
                >
                    <p class="text-[9.5px] font-sans uppercase tracking-[0.3em] text-gold-300 font-semibold mb-3">
                        MENUJU HARI BAHAGIA
                    </p>
                    <div class="grid grid-cols-4 gap-2 mb-4">
                        <div class="rounded-2xl py-2.5 bg-emerald-800/55 border border-gold-400/35">
                            <span class="font-display text-2xl font-bold text-gold-200 block leading-none" x-text="days">00</span>
                            <span class="text-[8.5px] uppercase tracking-[0.2em] text-alabaster-200 mt-1 block">Hari</span>
                        </div>
                        <div class="rounded-2xl py-2.5 bg-emerald-800/55 border border-gold-400/35">
                            <span class="font-display text-2xl font-bold text-gold-200 block leading-none" x-text="hours">00</span>
                            <span class="text-[8.5px] uppercase tracking-[0.2em] text-alabaster-200 mt-1 block">Jam</span>
                        </div>
                        <div class="rounded-2xl py-2.5 bg-emerald-800/55 border border-gold-400/35">
                            <span class="font-display text-2xl font-bold text-gold-200 block leading-none" x-text="minutes">00</span>
                            <span class="text-[8.5px] uppercase tracking-[0.2em] text-alabaster-200 mt-1 block">Menit</span>
                        </div>
                        <div class="rounded-2xl py-2.5 bg-emerald-800/55 border border-gold-400/35">
                            <span class="font-display text-2xl font-bold text-gold-200 block leading-none" x-text="seconds">00</span>
                            <span class="text-[8.5px] uppercase tracking-[0.2em] text-alabaster-200 mt-1 block">Detik</span>
                        </div>
                    </div>
                    <a
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('The Wedding of ' . $couple['groom'] . ' & ' . $couple['bride']) }}&dates=20270512T010000Z/20270512T070000Z&details=Undangan+Pernikahan+Royal+Botanical+Glasshouse&location={{ urlencode($event['location'] . ', ' . $event['address']) }}"
                        target="_blank"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2 rounded-full bg-gold-400 text-emerald-950 font-sans text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gold-300 transition-colors shadow"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Simpan Tanggal</span>
                    </a>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 2: AYAT SUCI (DEEP EMERALD ORANGERY SCROLL)            -->
            <!-- ============================================================== -->
            <section id="ayat" class="anim-section relative py-14 px-6 bg-emerald-950 text-center overflow-hidden">
                <!-- Background Subtle Orangery -->
                <div class="absolute inset-0 opacity-20 pointer-events-none">
                    <img src="{{ $getOrnament('glasshouse-daylight-bg.jpg') }}" class="w-full h-full object-cover" alt="">
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-emerald-950 via-emerald-900/90 to-emerald-950 pointer-events-none"></div>

                <!-- Wax Seal Emblem Header -->
                <div class="stagger-scale relative z-10 w-24 h-16 mx-auto mb-3 flex items-center justify-center">
                    <img src="{{ $getOrnament('emerald-wax-seal.png') }}" class="w-full h-full object-contain drop-shadow-lg" alt="Wax Seal">
                    <div class="absolute w-7 h-7 rounded-full bg-emerald-950 border border-gold-400 flex items-center justify-center">
                        <span class="font-display text-[9px] font-bold text-gold-200">{{ $groomInitial }}&amp;{{ $brideInitial }}</span>
                    </div>
                </div>

                <!-- Warm Parchment Verse Card -->
                <div class="stagger-up delay-100 relative z-10 max-w-[355px] mx-auto rounded-3xl p-6 bg-alabaster-50 border-2 border-gold-400 shadow-[0_20px_45px_rgba(0,0,0,0.5)] text-emerald-950">
                    <p class="font-serif text-xl text-gold-600 mb-2">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <p class="font-serif italic text-sm leading-relaxed text-emerald-900">
                        "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                    </p>
                    <div class="w-16 h-[1px] bg-gold-400 mx-auto my-3"></div>
                    <p class="font-sans text-[10px] font-bold uppercase tracking-[0.28em] text-gold-600">
                        QS. Ar-Rum : 21
                    </p>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 3: SANG MEMPELAI (EDITORIAL BOTANICAL ARCH PROFILES)   -->
            <!-- ============================================================== -->
            <section id="mempelai" class="anim-section nav-section paper-texture relative py-16 px-6 overflow-hidden">
                <!-- Cascading Eucalyptus Vines on Left & Right Sides -->
                <div class="stagger-left absolute top-8 -left-4 w-24 opacity-85 pointer-events-none">
                    <img src="{{ $getOrnament('vine-curtain-left.png') }}" class="w-full h-auto idle-vine-l" alt="">
                </div>
                <div class="stagger-right absolute top-8 -right-4 w-24 opacity-85 pointer-events-none">
                    <img src="{{ $getOrnament('vine-curtain-right.png') }}" class="w-full h-auto idle-vine-r" alt="">
                </div>

                <!-- Section Header -->
                <div class="relative z-20 text-center max-w-xs mx-auto mb-10">
                    <p class="stagger-down text-[10px] font-sans font-semibold uppercase tracking-[0.34em] text-gold-600">
                        THE BRIDE &amp; GROOM
                    </p>
                    <h2 class="stagger-up delay-100 font-display text-3xl font-bold text-emerald-950 mt-1">
                        Pasangan Mempelai
                    </h2>
                    <p class="stagger-up delay-200 font-serif italic text-sm text-emerald-800 mt-1">
                        Assalamu’alaikum Warahmatullahi Wabarakatuh. Dengan memohon rahmat Allah SWT, kami mengundang Bapak/Ibu/Saudara/i pada pernikahan kami:
                    </p>
                </div>

                <!-- Bride Botanical Arch Profile Card -->
                <div class="stagger-left delay-200 relative z-20 max-w-[340px] mx-auto rounded-t-[150px] rounded-b-3xl bg-white p-4 pb-9 shadow-[0_18px_40px_rgba(6,50,36,0.14)] border-2 border-gold-400/70 text-center">
                    <!-- Floating Corner White Roses -->
                    <img src="{{ $getOrnament('floral-top-left.png') }}" class="absolute -top-4 -left-4 w-24 h-auto pointer-events-none drop-shadow-md z-20" alt="">
                    <img src="{{ $getOrnament('floral-bottom-right.png') }}" class="absolute -bottom-4 -right-4 w-20 h-auto pointer-events-none drop-shadow-md z-20" alt="">

                    <div class="relative w-[200px] h-[250px] mx-auto rounded-t-[110px] rounded-b-2xl overflow-hidden border-2 border-gold-400 shadow-md">
                        <img src="{{ $bg['bride'] }}" class="w-full h-full object-cover object-top" alt="{{ $couple['bride_full'] }}">
                    </div>

                    <span class="inline-block mt-4 px-3.5 py-0.5 rounded-full bg-emerald-900 text-gold-200 text-[9px] font-sans font-semibold uppercase tracking-[0.24em]">
                        THE BRIDE
                    </span>
                    <h3 class="font-display text-2xl font-bold text-emerald-950 mt-1.5">
                        {{ $couple['bride_full'] }}
                    </h3>
                    <p class="font-serif italic text-sm text-emerald-800 mt-1 px-8 relative z-30">
                        {{ $couple['parents']['bride'] }}
                    </p>
                </div>

                <!-- Intertwined Botanical Rose Divider & Wax Seal -->
                <div class="stagger-scale delay-300 relative z-20 flex flex-col items-center my-7">
                    <img src="{{ $getOrnament('botanical-divider.png') }}" class="w-52 h-auto" alt="">
                    <span class="font-script text-4xl text-gold-600 -mt-1">&amp;</span>
                </div>

                <!-- Groom Botanical Arch Profile Card -->
                <div class="stagger-right delay-400 relative z-20 max-w-[340px] mx-auto rounded-t-[150px] rounded-b-3xl bg-white p-4 pb-9 shadow-[0_18px_40px_rgba(6,50,36,0.14)] border-2 border-gold-400/70 text-center">
                    <!-- Floating Corner White Roses -->
                    <img src="{{ $getOrnament('floral-top-right.png') }}" class="absolute -top-4 -right-4 w-24 h-auto pointer-events-none drop-shadow-md z-20" alt="">
                    <img src="{{ $getOrnament('floral-bottom-left.png') }}" class="absolute -bottom-4 -left-4 w-20 h-auto pointer-events-none drop-shadow-md z-20" alt="">

                    <div class="relative w-[200px] h-[250px] mx-auto rounded-t-[110px] rounded-b-2xl overflow-hidden border-2 border-gold-400 shadow-md">
                        <img src="{{ $bg['groom'] }}" class="w-full h-full object-cover object-top" alt="{{ $couple['groom_full'] }}">
                    </div>

                    <span class="inline-block mt-4 px-3.5 py-0.5 rounded-full bg-emerald-900 text-gold-200 text-[9px] font-sans font-semibold uppercase tracking-[0.24em]">
                        THE GROOM
                    </span>
                    <h3 class="font-display text-2xl font-bold text-emerald-950 mt-1.5">
                        {{ $couple['groom_full'] }}
                    </h3>
                    <p class="font-serif italic text-sm text-emerald-800 mt-1 px-8 relative z-30">
                        {{ $couple['parents']['groom'] }}
                    </p>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 4: RANGKAIAN ACARA (SUNLIT GLASSHOUSE CATHEDRAL CARDS) -->
            <!-- ============================================================== -->
            <section id="acara" class="anim-section nav-section relative py-16 px-6 bg-emerald-950 text-center overflow-hidden">
                <!-- Sunlit Glasshouse Background -->
                <div class="absolute inset-0 opacity-30 pointer-events-none">
                    <img src="{{ $getOrnament('glasshouse-daylight-bg.jpg') }}" class="w-full h-full object-cover" alt="">
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/90 via-emerald-950/75 to-emerald-950/95 pointer-events-none"></div>

                <!-- Hanging Crystal & Ivy Chandelier -->
                <div class="stagger-down relative z-20 w-36 mx-auto -mt-10 mb-3 pointer-events-none">
                    <img src="{{ $getOrnament('chandelier-top.png') }}" class="w-full h-auto idle-chandelier drop-shadow-xl" alt="">
                </div>

                <div class="relative z-20 mb-8">
                    <p class="stagger-down text-[10px] font-sans font-semibold uppercase tracking-[0.34em] text-gold-300">
                        WEDDING ITINERARY
                    </p>
                    <h2 class="stagger-up delay-100 font-display text-3xl font-bold text-alabaster-50 mt-1">
                        Rangkaian Acara
                    </h2>
                </div>

                <!-- Arched Cathedral Glasshouse Event Cards -->
                <div class="relative z-20 space-y-6 max-w-[355px] mx-auto">
                    @foreach($schedule as $idx => $item)
                        <div class="{{ $idx % 2 === 0 ? 'stagger-left delay-200' : 'stagger-right delay-300' }} relative rounded-t-[110px] rounded-b-3xl p-6 pt-10 bg-alabaster-50/95 text-emerald-950 border-2 border-gold-400 shadow-[0_20px_45px_rgba(0,0,0,0.55)] overflow-hidden">
                            <!-- Top Gold Lantern Accent -->
                            <div class="w-12 h-16 mx-auto mb-2">
                                <img src="{{ $getOrnament('gold-lantern.png') }}" class="w-full h-full object-contain drop-shadow" alt="Lantern">
                            </div>

                            <span class="inline-block px-3 py-0.5 rounded-full bg-emerald-900/10 border border-emerald-900/20 text-[9px] font-sans font-bold uppercase tracking-[0.22em] text-emerald-900">
                                {{ $item['badge'] }}
                            </span>

                            <h3 class="font-display text-2xl font-bold text-emerald-950 mt-1.5">
                                {{ $item['title'] }}
                            </h3>

                            <div class="w-20 h-[1px] bg-gold-400 mx-auto my-3"></div>

                            <p class="font-sans text-xs font-bold uppercase tracking-wider text-emerald-900">
                                {{ $item['date'] }}
                            </p>
                            <p class="font-serif italic text-base text-gold-600 font-semibold mt-0.5">
                                Pukul {{ $item['time'] }}
                            </p>

                            <div class="mt-3 pt-3 border-t border-emerald-900/10">
                                <p class="font-display text-sm font-bold text-emerald-950">
                                    {{ $item['venue'] }}
                                </p>
                                <p class="font-sans text-xs text-emerald-800/80 mt-0.5 leading-relaxed">
                                    {{ $item['address'] }}
                                </p>
                            </div>

                            <a
                                href="{{ $event['maps_url'] }}"
                                target="_blank"
                                class="mt-4 inline-flex items-center justify-center gap-2 w-full py-2.5 px-5 rounded-full bg-emerald-900 text-gold-200 font-sans text-[10px] font-semibold uppercase tracking-[0.22em] hover:bg-emerald-800 transition-colors shadow"
                            >
                                <svg class="w-3.5 h-3.5 text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Petunjuk Google Maps</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 5: KISAH CINTA (BOTANICAL SCRAPBOOK POLAROID TIMELINE) -->
            <!-- ============================================================== -->
            <section id="kisah" class="anim-section paper-texture relative py-16 px-6 overflow-hidden">
                <div class="text-center max-w-xs mx-auto mb-10">
                    <p class="stagger-down text-[10px] font-sans font-semibold uppercase tracking-[0.34em] text-gold-600">
                        OUR LOVE JOURNEY
                    </p>
                    <h2 class="stagger-up delay-100 font-display text-3xl font-bold text-emerald-950 mt-1">
                        Kisah Cinta Kami
                    </h2>
                    <div class="stagger-scale delay-200 flex justify-center mt-2">
                        <img src="{{ $getOrnament('botanical-divider.png') }}" class="w-44 h-auto" alt="">
                    </div>
                </div>

                @php
                    $storyPhotos = [$bg['story_1'], $bg['story_2'], $bg['story_3']];
                @endphp

                <div class="relative max-w-[355px] mx-auto pl-7 border-l-2 border-gold-400/60 space-y-10">
                    @foreach($stories as $i => $s)
                        <div class="{{ $i % 2 === 0 ? 'stagger-right' : 'stagger-left' }} delay-{{ ($i + 1) * 100 }} relative">
                            <!-- Gold Wax Node -->
                            <div class="absolute -left-[41px] top-2 w-6 h-6 rounded-full bg-emerald-900 border-2 border-gold-300 shadow flex items-center justify-center text-[10px] text-gold-200 font-bold">
                                {{ $i + 1 }}
                            </div>

                            <div class="botanical-polaroid rounded-2xl p-4 relative" style="transform: rotate({{ $i % 2 === 0 ? '-1.2deg' : '1.2deg' }});">
                                <div class="washi-tape-gold absolute -top-2.5 right-6 w-20 h-5 z-20"></div>
                                <div class="w-full h-40 rounded-lg overflow-hidden mb-3">
                                    <img src="{{ $storyPhotos[$i % count($storyPhotos)] }}" class="w-full h-full object-cover" alt="{{ $s['title'] }}">
                                </div>
                                <span class="text-[9.5px] font-sans font-bold uppercase tracking-[0.22em] text-gold-600">
                                    {{ $s['date'] }}
                                </span>
                                <h3 class="font-display text-lg font-bold text-emerald-950 mt-0.5">
                                    {{ $s['title'] }}
                                </h3>
                                <p class="font-serif italic text-sm text-emerald-800/90 mt-1 leading-relaxed">
                                    "{{ $s['text'] }}"
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 6: GALERI BAHAGIA (POLAROID MASONRY + LIGHTBOX)        -->
            <!-- ============================================================== -->
            <section id="galeri" class="anim-section nav-section relative py-16 px-6 bg-emerald-950 text-center overflow-hidden">
                <div class="relative z-10 mb-8">
                    <p class="stagger-down text-[10px] font-sans font-semibold uppercase tracking-[0.34em] text-gold-300">
                        CAPTURED MOMENTS
                    </p>
                    <h2 class="stagger-up delay-100 font-display text-3xl font-bold text-alabaster-50 mt-1">
                        Galeri Bahagia
                    </h2>
                    <div class="stagger-scale delay-200 flex justify-center mt-2">
                        <img src="{{ $getOrnament('botanical-divider.png') }}" class="w-44 h-auto" alt="">
                    </div>
                </div>

                <div class="relative z-10 grid grid-cols-2 gap-3.5 max-w-[365px] mx-auto">
                    @foreach($gallery as $gIdx => $imgUrl)
                        <div
                            @click="openLightbox('{{ $imgUrl }}')"
                            class="{{ $gIdx % 3 === 0 ? 'col-span-2 aspect-[16/10]' : 'col-span-1 aspect-[4/5]' }} {{ $gIdx % 2 === 0 ? 'stagger-left' : 'stagger-right' }} group cursor-pointer rounded-2xl p-2 bg-alabaster-50 border border-gold-400/60 shadow-xl overflow-hidden"
                        >
                            <div class="w-full h-full rounded-xl overflow-hidden relative">
                                <img src="{{ $imgUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Gallery {{ $gIdx + 1 }}">
                                <div class="absolute inset-0 bg-emerald-950/0 group-hover:bg-emerald-950/25 transition-colors flex items-center justify-center">
                                    <span class="opacity-0 group-hover:opacity-100 transition-opacity px-3 py-1 rounded-full bg-emerald-950/80 text-gold-200 text-[10px] uppercase tracking-widest">Perbesar</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 7: KADO DIGITAL (WARM ALABASTER & EMERALD FOIL CARDS)  -->
            <!-- ============================================================== -->
            <section id="kado" class="anim-section paper-texture relative py-16 px-6 text-center overflow-hidden">
                <div class="max-w-xs mx-auto mb-8">
                    <p class="stagger-down text-[10px] font-sans font-semibold uppercase tracking-[0.34em] text-gold-600">
                        WEDDING GIFT
                    </p>
                    <h2 class="stagger-up delay-100 font-display text-3xl font-bold text-emerald-950 mt-1">
                        Tanda Kasih
                    </h2>
                    <p class="stagger-up delay-200 font-serif italic text-sm text-emerald-800 mt-1">
                        Doa restu Anda merupakan karunia terindah bagi kami. Namun jika memberi adalah ungkapan tanda kasih, Anda dapat mengirimkannya melalui:
                    </p>
                </div>

                <div class="max-w-[355px] mx-auto space-y-4">
                    @foreach($gifts as $kIdx => $gift)
                        <div
                            x-data="{ copied: false }"
                            class="{{ $kIdx % 2 === 0 ? 'stagger-left delay-200' : 'stagger-right delay-300' }} relative rounded-2xl p-5 bg-gradient-to-br from-emerald-900 via-emerald-950 to-emerald-900 text-alabaster-50 border-2 border-gold-400/75 shadow-lg text-left overflow-hidden"
                        >
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-3 py-1 rounded-full bg-gold-400/20 border border-gold-300/40 font-sans text-xs font-bold uppercase tracking-widest text-gold-200">
                                    {{ $gift['bank'] }}
                                </span>
                                <img src="{{ $getOrnament('emerald-wax-seal.png') }}" class="w-12 h-8 object-contain" alt="">
                            </div>
                            <p class="font-display text-xl font-bold tracking-wider text-gold-200">
                                {{ $gift['account'] }}
                            </p>
                            <p class="font-sans text-xs text-alabaster-200 mt-0.5">
                                a.n. {{ $gift['name'] }}
                            </p>
                            <button
                                type="button"
                                @click="navigator.clipboard.writeText('{{ $gift['account'] }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                class="mt-3.5 inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gold-400 text-emerald-950 font-sans text-[10px] font-bold uppercase tracking-wider hover:bg-gold-300 transition-colors"
                            >
                                <span x-text="copied ? 'Berhasil Disalin!' : 'Salin Nomor Rekening'">Salin Nomor Rekening</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 8: RSVP & DOA RESTU                                    -->
            <!-- ============================================================== -->
            <section id="rsvp" class="anim-section nav-section relative py-16 px-6 bg-emerald-950 text-alabaster-50 overflow-hidden">
                <div class="max-w-[355px] mx-auto">
                    <div class="text-center mb-7">
                        <p class="stagger-down text-[10px] font-sans font-semibold uppercase tracking-[0.34em] text-gold-300">
                            GUESTBOOK &amp; WISHES
                        </p>
                        <h2 class="stagger-up delay-100 font-display text-3xl font-bold text-alabaster-50 mt-1">
                            Doa &amp; Ucapan
                        </h2>
                        <div class="stagger-scale delay-200 flex justify-center mt-2">
                            <img src="{{ $getOrnament('botanical-divider.png') }}" class="w-44 h-auto" alt="">
                        </div>
                    </div>

                    <div
                        x-data="{
                            name: '',
                            status: 'Hadir',
                            message: '',
                            submitted: false,
                            wishesList: {{ Js::from($wishes) }},
                            submitWish() {
                                if (!this.name.trim() || !this.message.trim()) return;
                                this.wishesList.unshift({
                                    name: this.name,
                                    status: this.status,
                                    message: this.message
                                });
                                this.name = '';
                                this.message = '';
                                this.submitted = true;
                                setTimeout(() => this.submitted = false, 3500);
                            }
                        }"
                    >
                        <form @submit.prevent="submitWish()" class="stagger-up delay-200 rounded-3xl p-5 bg-alabaster-50 text-emerald-950 border-2 border-gold-400 shadow-xl space-y-3.5 mb-6">
                            <div>
                                <label class="block text-[10px] font-sans font-bold uppercase tracking-wider text-emerald-900 mb-1">Nama Lengkap</label>
                                <input type="text" x-model="name" required placeholder="Tuliskan nama Anda..." class="w-full rounded-xl border border-emerald-900/20 bg-white px-3.5 py-2.5 text-xs text-emerald-950 focus:outline-none focus:border-emerald-800">
                            </div>
                            <div>
                                <label class="block text-[10px] font-sans font-bold uppercase tracking-wider text-emerald-900 mb-1">Konfirmasi Kehadiran</label>
                                <select x-model="status" class="w-full rounded-xl border border-emerald-900/20 bg-white px-3.5 py-2.5 text-xs text-emerald-950 focus:outline-none focus:border-emerald-800">
                                    <option value="Hadir">Hadir</option>
                                    <option value="Berhalangan">Maaf, Berhalangan Hadir</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-sans font-bold uppercase tracking-wider text-emerald-900 mb-1">Doa &amp; Ucapan</label>
                                <textarea x-model="message" rows="3" required placeholder="Tuliskan doa dan ucapan hangat untuk kedua mempelai..." class="w-full rounded-xl border border-emerald-900/20 bg-white px-3.5 py-2.5 text-xs text-emerald-950 focus:outline-none focus:border-emerald-800"></textarea>
                            </div>
                            <button type="submit" class="w-full py-3 rounded-full bg-emerald-900 text-gold-200 font-sans text-xs font-bold uppercase tracking-[0.22em] hover:bg-emerald-800 transition-colors shadow">
                                Kirim Ucapan
                            </button>
                            <p x-show="submitted" x-cloak class="text-xs text-emerald-700 font-semibold text-center">Terima kasih! Doa dan ucapan Anda telah tersimpan.</p>
                        </form>

                        <!-- Wishes Stream -->
                        <div class="stagger-up delay-300 space-y-3 max-h-64 overflow-y-auto pr-1 hide-scrollbar">
                            <template x-for="(w, idx) in wishesList" :key="idx">
                                <div class="rounded-2xl p-4 bg-emerald-900/75 border border-gold-400/35 backdrop-blur-sm">
                                    <div class="flex items-center justify-between mb-1">
                                        <h4 class="font-display text-sm font-bold text-gold-200" x-text="w.name"></h4>
                                        <span class="px-2.5 py-0.5 rounded-full text-[9px] font-sans font-semibold uppercase tracking-wider bg-emerald-800 text-gold-300 border border-gold-400/30" x-text="w.status"></span>
                                    </div>
                                    <p class="font-serif italic text-sm text-alabaster-100 leading-relaxed" x-text="'&quot;' + w.message + '&quot;'"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 9: FOOTER (THE ROYAL ORANGERY CLOSING)                 -->
            <!-- ============================================================== -->
            <footer class="anim-section paper-texture relative pt-12 pb-28 px-6 text-center overflow-hidden border-t border-gold-400/40">
                <div class="stagger-bouquet-bl absolute -bottom-4 -left-5 w-36 pointer-events-none opacity-90">
                    <img src="{{ $getOrnament('floral-bottom-left.png') }}" class="w-full h-auto idle-rose-bl" alt="">
                </div>
                <div class="stagger-bouquet-br absolute -bottom-4 -right-5 w-36 pointer-events-none opacity-90">
                    <img src="{{ $getOrnament('floral-bottom-right.png') }}" class="w-full h-auto idle-rose-br" alt="">
                </div>

                <div class="relative z-10 max-w-xs mx-auto">
                    <div class="w-20 h-14 mx-auto mb-2 flex items-center justify-center relative">
                        <img src="{{ $getOrnament('emerald-wax-seal.png') }}" class="w-full h-full object-contain" alt="">
                        <div class="absolute w-6 h-6 rounded-full bg-emerald-950 border border-gold-400 flex items-center justify-center">
                            <span class="font-display text-[8px] font-bold text-gold-200">{{ $groomInitial }}&amp;{{ $brideInitial }}</span>
                        </div>
                    </div>
                    <p class="text-[9.5px] font-sans uppercase tracking-[0.34em] text-gold-600 font-semibold">
                        TERIMA KASIH
                    </p>
                    <h2 class="font-display text-3xl font-bold text-emerald-950 my-1">
                        {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
                    </h2>
                    <p class="font-serif italic text-sm text-emerald-800 leading-relaxed">
                        Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.
                    </p>
                    <p class="text-[10px] text-emerald-800/60 mt-5 font-sans">
                        TemuRuang Digital Invitation • Botanical Glasshouse Edition
                    </p>
                </div>
            </footer>

        </main>

        <!-- ============================================================== -->
        <!-- LIGHTBOX MODAL                                                 -->
        <!-- ============================================================== -->
        <div
            x-show="lightboxOpen"
            x-cloak
            @click="lightboxOpen = false"
            class="fixed inset-0 z-[80] bg-emerald-950/90 backdrop-blur-md flex items-center justify-center p-5"
        >
            <div class="relative max-w-[420px] w-full">
                <img :src="lightboxImage" class="w-full h-auto max-h-[82vh] object-contain rounded-2xl border-2 border-gold-400 shadow-2xl" alt="Preview">
                <button @click="lightboxOpen = false" class="mt-4 mx-auto block px-6 py-2 rounded-full bg-gold-400 text-emerald-950 font-sans text-xs font-bold uppercase tracking-widest">
                    Tutup
                </button>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- 3. FLOATING BOTANICAL BOTTOM NAVIGATION                        -->
        <!-- ============================================================== -->
        <div
            x-show="isOpen"
            x-cloak
            class="clamped-shell-float bottom-0 z-40"
        >
            <div class="pointer-events-auto mx-4 mb-3 rounded-full bg-emerald-950/95 backdrop-blur-md border border-gold-400/60 shadow-[0_12px_30px_rgba(0,0,0,0.65)] px-4 py-2 flex justify-around items-center text-[9px] font-sans uppercase tracking-wider font-semibold">
                <a @click="document.getElementById('hero').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-1 gap-0.5 transition-colors" :class="activeSection === 'hero' ? 'text-gold-300 font-bold' : 'text-alabaster-200/70 hover:text-gold-200'">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    <span>Beranda</span>
                </a>
                <a @click="document.getElementById('mempelai').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-1 gap-0.5 transition-colors" :class="activeSection === 'mempelai' ? 'text-gold-300 font-bold' : 'text-alabaster-200/70 hover:text-gold-200'">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span>Mempelai</span>
                </a>
                <a @click="document.getElementById('acara').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-1 gap-0.5 transition-colors" :class="activeSection === 'acara' ? 'text-gold-300 font-bold' : 'text-alabaster-200/70 hover:text-gold-200'">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                    <span>Acara</span>
                </a>
                <a @click="document.getElementById('galeri').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-1 gap-0.5 transition-colors" :class="activeSection === 'galeri' ? 'text-gold-300 font-bold' : 'text-alabaster-200/70 hover:text-gold-200'">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg>
                    <span>Galeri</span>
                </a>
                <a @click="document.getElementById('rsvp').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-1 gap-0.5 transition-colors" :class="activeSection === 'rsvp' ? 'text-gold-300 font-bold' : 'text-alabaster-200/70 hover:text-gold-200'">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12zM7 9h10v2H7zm0-3h10v2H7zm0 6h7v2H7z"/></svg>
                    <span>Ucapan</span>
                </a>
            </div>
        </div>

    </div>
</body>
</html>
