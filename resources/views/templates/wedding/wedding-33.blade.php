@php
    $getAsset = function($filename) {
        return asset('assets/templates/wedding-new-1/' . $filename);
    };

    $getNewAsset = function($filename) {
        return asset('assets/templates/wedding-new-1/new asset/' . rawurlencode($filename));
    };

    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Raden Bagus');
        $brideName = trim($names[1] ?? 'Sekar Ayu');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'groom_full' => $groomName . ' Dananjaya, S.T.',
            'bride_full' => $brideName . ' Lestari, S.Ked.',
            'parents' => [
                'groom' => $invitation->description ?? 'Putra pertama Bpk. H. Bambang Kusumo & Ibu Hj. Siti Wahyuni',
                'bride' => 'Putri kedua Bpk. Ir. H. Sudarsono & Ibu Hj. Sri Rahayu',
            ],
            'instagram' => [
                'groom' => 'https://instagram.com',
                'bride' => 'https://instagram.com'
            ]
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2027-04-18',
            'date_formatted' => $invitation->event_date ? $invitation->event_date->translatedFormat('l, d F Y') : 'Minggu, 18 April 2027',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Pendopo Agung Keraton',
            'address' => $invitation->address ?? 'Jl. Rotowijayan No. 1, Kadipaten, Kraton, Kota Yogyakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Kraton Yogyakarta'),
        ];

        $schedule = [
            [
                'title' => 'Upacara Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'date' => $event['date_formatted'],
                'venue' => 'Pendopo Dalem Mangkubumen',
                'address' => 'Jl. Ngasem No. 12, Kraton, Kota Yogyakarta',
                'maps' => $event['maps_url']
            ],
            [
                'title' => 'Panggih & Resepsi Ageng',
                'time' => '11:00 - 14:00 WIB',
                'date' => $event['date_formatted'],
                'venue' => $event['location'],
                'address' => $event['address'],
                'maps' => $event['maps_url']
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
                ['title' => 'Purwakaning Asih', 'date' => 'Maret 2023', 'text' => 'Bermula dari perjumpaan sederhana di tlatah Ngayogyakarta Hadiningrat, tatap mata menumbuhkan getar kebaikan dalam kalbu.'],
                ['title' => 'Kanthi Kersaning Hyang', 'date' => 'Agustus 2025', 'text' => 'Dua keluarga besar manunggal ngrembag kekadangan suci, nyawiji tekad lumampah ing gesang bebrayan.'],
                ['title' => 'Daup Pawiwahan', 'date' => 'April 2027', 'text' => 'Kanthi ridho Gusti Ingkang Maha Agung, kami berikrar mengikat janji suci sakral selamanya.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                $getAsset('lestari-01-hero.png'),
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600',
                'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=600',
                'https://images.unsplash.com/photo-1520854221256-17451cc331bf?q=80&w=600',
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=600',
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600';
        $bg = [
            'cover' => $coverUrl,
            'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=600',
            'bride' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=600',
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
                ['name' => 'Kanjeng Raden Mas Hardiko', 'status' => 'Hadir', 'message' => 'Nderek mangayubagya, mugi dados kulawarga ingkang tansah ayom ayem, berkah wilujeng lahir batin.'],
                ['name' => 'Dr. H. Bambang & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru. Semoga menjadi keluarga sakinah mawaddah warahmah, langgeng ngantos kaken ninen.'],
                ['name' => 'Anindya Larasati', 'status' => 'Hadir', 'message' => 'Barakallah, ikut berbahagia untuk kedua mempelai. Semoga upacara pernikahan berjalan lancar dan penuh berkah!'],
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
                ['bank' => 'BCA', 'name' => 'Raden Bagus Dananjaya', 'account' => '8210984729'],
                ['bank' => 'Bank Mandiri', 'name' => 'Sekar Ayu Lestari', 'account' => '1370019284721'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('assets/templates/wedding-11/wp-content/uploads/2026/01/Jawa-03-Niken-Salindry-KUSUMA-WIJAYA.mp3');
    } else {
        // Fallback Demo Values matching Undangan Pernikahan Jawa Mewah.png
        $couple = [
            'groom' => 'Raden Bagus',
            'bride' => 'Sekar Ayu',
            'groom_full' => 'Raden Bagus Dananjaya, S.T.',
            'bride_full' => 'Raden Ajeng Sekar Ayu, S.Ked.',
            'parents' => [
                'groom' => 'Putra pertama Bpk. H. Bambang Kusumo & Ibu Hj. Siti Wahyuni',
                'bride' => 'Putri kedua Bpk. Ir. H. Sudarsono & Ibu Hj. Sri Rahayu',
            ],
            'instagram' => [
                'groom' => 'https://instagram.com',
                'bride' => 'https://instagram.com'
            ]
        ];

        $event = [
            'date_iso' => '2027-04-18',
            'date_formatted' => 'Minggu, 18 April 2027',
            'time' => '08:00',
            'location' => 'Pendopo Agung Dalem Keraton',
            'address' => 'Jl. Rotowijayan No. 1, Kadipaten, Kraton, Kota Yogyakarta',
            'maps_url' => 'https://maps.google.com/?q=Kraton+Yogyakarta',
        ];

        $schedule = [
            [
                'title' => 'Upacara Akad Nikah',
                'time' => '08:00 - 10:00 WIB',
                'date' => 'Minggu, 18 April 2027',
                'venue' => 'Pendopo Dalem Mangkubumen',
                'address' => 'Jl. Ngasem No. 12, Kraton, Kota Yogyakarta',
                'maps' => 'https://maps.google.com/?q=Pendopo+Dalem+Mangkubumen'
            ],
            [
                'title' => 'Panggih & Resepsi Ageng',
                'time' => '11:00 - 14:00 WIB',
                'date' => 'Minggu, 18 April 2027',
                'venue' => 'Pendopo Agung Dalem Keraton',
                'address' => 'Jl. Rotowijayan No. 1, Kadipaten, Kraton, Kota Yogyakarta',
                'maps' => 'https://maps.google.com/?q=Kraton+Yogyakarta'
            ]
        ];

        $stories = [
            ['title' => 'Purwakaning Asih', 'date' => 'Maret 2023', 'text' => 'Bermula dari perjumpaan sederhana di tlatah Ngayogyakarta Hadiningrat, tatap mata menumbuhkan getar kebaikan dalam kalbu.'],
            ['title' => 'Kanthi Kersaning Hyang', 'date' => 'Agustus 2025', 'text' => 'Dua keluarga besar manunggal ngrembag kekadangan suci, nyawiji tekad lumampah ing gesang bebrayan.'],
            ['title' => 'Daup Pawiwahan', 'date' => 'April 2027', 'text' => 'Kanthi ridho Gusti Ingkang Maha Agung, kami berikrar mengikat janji suci sakral selamanya.'],
        ];

        $gallery = [
            $getAsset('lestari-01-hero.png'),
            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600',
            'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600',
            'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=600',
            'https://images.unsplash.com/photo-1520854221256-17451cc331bf?q=80&w=600',
            'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=600',
        ];

        $bg = [
            'cover' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600',
            'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=600',
            'bride' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=600',
        ];

        $wishes = [
            ['name' => 'Kanjeng Raden Mas Hardiko', 'status' => 'Hadir', 'message' => 'Nderek mangayubagya, mugi dados kulawarga ingkang tansah ayom ayem, berkah wilujeng lahir batin.'],
            ['name' => 'Dr. H. Bambang & Keluarga', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru. Semoga menjadi keluarga sakinah mawaddah warahmah, langgeng ngantos kaken ninen.'],
            ['name' => 'Anindya Larasati', 'status' => 'Hadir', 'message' => 'Barakallah, ikut berbahagia untuk kedua mempelai. Semoga upacara pernikahan berjalan lancar dan penuh berkah!'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Raden Bagus Dananjaya', 'account' => '8210984729'],
            ['bank' => 'Bank Mandiri', 'name' => 'Sekar Ayu Lestari', 'account' => '1370019284721'],
        ];

        $musicUrl = asset('assets/templates/wedding-11/wp-content/uploads/2026/01/Jawa-03-Niken-Salindry-KUSUMA-WIJAYA.mp3');
    }

    $initialBride = strtoupper(substr($couple['bride'], 0, 1));
    $initialGroom = strtoupper(substr($couple['groom'], 0, 1));
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pawiwahan Ageng • {{ $couple['bride'] }} & {{ $couple['groom'] }}</title>
    
    <link rel="icon" type="image/png" href="{{ $getAsset('lestari-03-wayang.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lestari': {
                            'espresso': '#0b0604',
                            'dark': '#130a06',
                            'card': '#1c1008',
                            'gold': '#D9AA45',
                            'lightgold': '#F3CE7A',
                            'antiquegold': '#C49742',
                            'champagne': '#F7EBD5',
                            'ivory': '#FCFBF7',
                            'cream': '#F4EDE2',
                            'muted': '#A89785'
                        }
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
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('rsvpForm', () => ({
                name: @js(request('to', request('kpd', ''))),
                status: 'Hadir',
                message: '',
                wishesList: @js($wishes ?? []),
                submitted: false,
                sendWish() {
                    if (!this.name.trim() || !this.message.trim()) return;
                    this.wishesList.unshift({
                        name: this.name,
                        status: this.status,
                        message: this.message
                    });
                    this.message = '';
                    this.submitted = true;
                    setTimeout(() => { this.submitted = false; }, 3000);
                }
            }));
        });
    </script>
    <!-- AOS.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }

        html, body {
            background-color: #070402;
            color: #F4EDE2;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        /* Desktop Stage Layout */
        .desktop-stage {
            min-height: 100vh;
            width: 100%;
            background-color: #080402;
            background-image: 
                radial-gradient(circle at 50% 25%, rgba(217, 170, 69, 0.14) 0%, transparent 55%),
                radial-gradient(circle at 50% 80%, rgba(120, 55, 18, 0.14) 0%, transparent 60%);
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .invitation-shell {
            width: 100%;
            max-width: 430px;
            min-height: 100dvh;
            background-color: #110905;
            position: relative;
            box-shadow: 0 0 90px rgba(0, 0, 0, 0.98);
            overflow-x: hidden;
        }

        @media (min-width: 640px) {
            .desktop-stage {
                padding: 16px 0;
                align-items: center;
            }
            .invitation-shell {
                border-radius: 32px;
                min-height: min(880px, 95vh);
                border: 1px solid rgba(217, 170, 69, 0.3);
            }
        }

        /* ===================================================== */
        /* STAGGERED ENTRANCE & TRANSFORMATION ANIMATIONS        */
        /* ===================================================== */
        @keyframes bgZoomIn {
            0% { transform: scale(1.12); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes gateSlideLeft {
            0% { transform: translateX(-70px) translateY(20px) scale(0.94); opacity: 0; filter: blur(4px); }
            100% { transform: translateX(0) translateY(0) scale(1); opacity: 1; filter: blur(0); }
        }

        @keyframes gateSlideRight {
            0% { transform: translateX(70px) translateY(20px) scale(0.94); opacity: 0; filter: blur(4px); }
            100% { transform: translateX(0) translateY(0) scale(1); opacity: 1; filter: blur(0); }
        }

        @keyframes flowerDropLeft {
            0% { transform: translate(-40px, -50px) rotate(-10deg) scale(0.85); opacity: 0; }
            100% { transform: translate(0, 0) rotate(0deg) scale(1); opacity: 1; }
        }

        @keyframes flowerDropRight {
            0% { transform: translate(40px, -50px) rotate(10deg) scale(0.85); opacity: 0; }
            100% { transform: translate(0, 0) rotate(0deg) scale(1); opacity: 1; }
        }

        @keyframes lampRise {
            0% { transform: translateY(45px) scale(0.88); opacity: 0; }
            100% { transform: translateY(0) scale(1); opacity: 1; }
        }

        @keyframes wayangEnter {
            0% { transform: translateX(50px) translateY(20px) rotate(6deg) scale(0.9); opacity: 0; }
            100% { transform: translateX(0) translateY(0) rotate(0deg) scale(1); opacity: 1; }
        }

        @keyframes fgFlowerRise {
            0% { transform: translateY(50px) scale(0.85); opacity: 0; }
            100% { transform: translateY(0) scale(1); opacity: 1; }
        }

        @keyframes textRevealDown {
            0% { transform: translateY(-22px); opacity: 0; filter: blur(3px); }
            100% { transform: translateY(0); opacity: 1; filter: blur(0); }
        }

        @keyframes textRevealUp {
            0% { transform: translateY(26px) scale(0.96); opacity: 0; filter: blur(3px); }
            100% { transform: translateY(0) scale(1); opacity: 1; filter: blur(0); }
        }

        /* ===================================================== */
        /* ORGANIC CONTINUOUS IDLE ANIMATIONS FOR ROYAL ASSETS   */
        /* ===================================================== */
        /* Top-Left Hanging Jasmine Sway (Visible Graceful Wind Swing) */
        @keyframes swayJasmineTL {
            0%, 100% { transform: rotate(0deg) translateY(0); }
            30% { transform: rotate(6deg) translateY(5px); }
            70% { transform: rotate(-4deg) translateY(2px); }
        }
        .idle-sway-tl {
            animation: swayJasmineTL 4.5s ease-in-out infinite;
            transform-origin: top left;
        }

        /* Top-Right Hanging Jasmine Sway */
        @keyframes swayJasmineTR {
            0%, 100% { transform: rotate(0deg) translateY(0); }
            35% { transform: rotate(-6deg) translateY(5px); }
            75% { transform: rotate(4deg) translateY(2px); }
        }
        .idle-sway-tr {
            animation: swayJasmineTR 4.8s ease-in-out infinite;
            transform-origin: top right;
        }

        /* Bottom-Left Foreground Jasmine Sway & Float */
        @keyframes swayJasmineBL {
            0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
            35% { transform: translateY(-13px) rotate(-4deg) scale(1.04); }
            70% { transform: translateY(-4px) rotate(2.5deg) scale(1.01); }
        }
        .idle-sway-bl {
            animation: swayJasmineBL 4.6s ease-in-out infinite;
            transform-origin: bottom left;
        }

        /* Bottom-Right Foreground Jasmine Sway & Float */
        @keyframes swayJasmineBR {
            0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
            40% { transform: translateY(-15px) rotate(4.5deg) scale(1.04); }
            75% { transform: translateY(-5px) rotate(-3deg) scale(1.01); }
        }
        .idle-sway-br {
            animation: swayJasmineBR 5.2s ease-in-out infinite;
            transform-origin: bottom right;
        }

        /* Midground Jasmine near Lamp breathing */
        @keyframes breatheJasmineMid {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-10px) scale(1.06); }
        }
        .idle-breathe-mid {
            animation: breatheJasmineMid 4.2s ease-in-out infinite;
            transform-origin: center center;
        }

        /* Wayang figure sacred floating breath */
        @keyframes wayangFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-11px) rotate(-2.8deg) scale(1.025); }
        }
        .idle-wayang {
            animation: wayangFloat 5.2s ease-in-out infinite;
            transform-origin: bottom center;
        }

        /* Antique Brass Lamp subtle hover */
        @keyframes lampHover {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-9px); }
        }
        .idle-lamp {
            animation: lampHover 4.4s ease-in-out infinite;
            transform-origin: center bottom;
        }

        /* Realistic dynamic candle flicker & light aura */
        @keyframes candleFlickerReal {
            0%, 100% { opacity: 0.8; transform: scale(1); filter: drop-shadow(0 0 10px rgba(255,200,90,0.85)); }
            25% { opacity: 1; transform: scale(1.2) translateY(-1.5px); filter: drop-shadow(0 0 18px rgba(255,225,130,1)); }
            50% { opacity: 0.65; transform: scale(0.92) translateY(1px); filter: drop-shadow(0 0 8px rgba(255,175,65,0.7)); }
            75% { opacity: 0.95; transform: scale(1.12) translateY(-1px); filter: drop-shadow(0 0 15px rgba(255,215,110,0.95)); }
        }
        .idle-candle {
            animation: candleFlickerReal 1.6s ease-in-out infinite;
        }

        /* 3D Royal Monogram Crest Gentle Float */
        @keyframes crestFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-8px) scale(1.04); }
        }
        .idle-float-crest {
            animation: crestFloat 4s ease-in-out infinite;
        }

        /* Drifting Falling Jasmine Petals (10.png & 9.png) with 3D Flutter */
        @keyframes petalFall1 {
            0% {
                transform: translateY(-40px) translateX(0) rotate(0deg) rotateY(0deg) scale(0.7);
                opacity: 0;
            }
            15% {
                opacity: 0.95;
            }
            50% {
                transform: translateY(50vh) translateX(32px) rotate(170deg) rotateY(60deg) scale(0.9);
                opacity: 0.95;
            }
            85% {
                opacity: 0.75;
            }
            100% {
                transform: translateY(105vh) translateX(-20px) rotate(350deg) rotateY(120deg) scale(0.7);
                opacity: 0;
            }
        }

        @keyframes petalFall2 {
            0% {
                transform: translateY(-40px) translateX(0) rotate(0deg) rotateX(0deg) scale(0.65);
                opacity: 0;
            }
            15% {
                opacity: 0.9;
            }
            55% {
                transform: translateY(52vh) translateX(-36px) rotate(-160deg) rotateX(70deg) scale(0.85);
                opacity: 0.9;
            }
            85% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(105vh) translateX(24px) rotate(-330deg) rotateX(140deg) scale(0.65);
                opacity: 0;
            }
        }

        @keyframes petalFall3 {
            0% {
                transform: translateY(-40px) translateX(0) rotate(15deg) scale(0.6);
                opacity: 0;
            }
            20% {
                opacity: 0.85;
            }
            50% {
                transform: translateY(48vh) translateX(20px) rotate(120deg) scale(0.75);
                opacity: 0.9;
            }
            80% {
                opacity: 0.7;
            }
            100% {
                transform: translateY(105vh) translateX(-15px) rotate(260deg) scale(0.6);
                opacity: 0;
            }
        }

        .falling-petal-1 {
            animation: petalFall1 7.5s linear infinite;
        }
        .falling-petal-2 {
            animation: petalFall2 9.5s linear infinite;
        }
        .falling-petal-3 {
            animation: petalFall3 8.2s linear infinite;
        }
        .falling-petal-4 {
            animation: petalFall1 11s linear infinite;
        }
        .falling-petal-5 {
            animation: petalFall2 7s linear infinite;
        }
        .falling-petal-6 {
            animation: petalFall3 10.5s linear infinite;
        }
        .falling-petal-7 {
            animation: petalFall1 8.8s linear infinite;
        }
        .falling-petal-8 {
            animation: petalFall2 12s linear infinite;
        }

        /* Floating Countdown Cards Animation */
        @keyframes cardFloatA {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-7px); }
        }
        @keyframes cardFloatB {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-9px); }
        }
        .float-card-1 { animation: cardFloatA 3.8s ease-in-out infinite; }
        .float-card-2 { animation: cardFloatB 4.4s ease-in-out infinite 0.3s; }
        .float-card-3 { animation: cardFloatA 4s ease-in-out infinite 0.6s; }
        .float-card-4 { animation: cardFloatB 4.6s ease-in-out infinite 0.9s; }

        /* Metallic Gold Shimmer Sweep across Couple Names */
        @keyframes textShimmerSweep {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .name-shimmer {
            background: linear-gradient(110deg, #F7EBD5 0%, #F5D38A 25%, #FFFDF5 50%, #F5D38A 75%, #F7EBD5 100%);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textShimmerSweep 4.5s ease-in-out infinite;
        }

        /* Pulsing Crest Halo */
        @keyframes haloPulse {
            0%, 100% { transform: scale(1); opacity: 0.35; }
            50% { transform: scale(1.22); opacity: 0.75; }
        }
        .crest-halo {
            animation: haloPulse 3s ease-in-out infinite;
        }

        /* Royal Cameo Medallion Animations */
        @keyframes cameoSlideLeft {
            0% { transform: translateX(-90px) translateY(30px) rotate(-8deg) scale(0.85); opacity: 0; filter: blur(4px); }
            100% { transform: translateX(0) translateY(0) rotate(0deg) scale(1); opacity: 1; filter: blur(0); }
        }
        @keyframes cameoSlideRight {
            0% { transform: translateX(90px) translateY(30px) rotate(8deg) scale(0.85); opacity: 0; filter: blur(4px); }
            100% { transform: translateX(0) translateY(0) rotate(0deg) scale(1); opacity: 1; filter: blur(0); }
        }
        @keyframes cameoFloatA {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-7px) rotate(-1.5deg) scale(1.02); }
        }
        @keyframes cameoFloatB {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-8px) rotate(1.5deg) scale(1.02); }
        }
        .anim-cameo-left {
            opacity: 0;
            animation: cameoSlideLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.35s forwards;
        }
        .anim-cameo-right {
            opacity: 0;
            animation: cameoSlideRight 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
        }
        .idle-cameo-float-a {
            animation: cameoFloatA 4.8s ease-in-out infinite;
        }
        .idle-cameo-float-b {
            animation: cameoFloatB 5.2s ease-in-out infinite;
        }
        @keyframes pendopoZoom {
            0% { transform: scale(1.08); filter: blur(3px); opacity: 0; }
            100% { transform: scale(1); filter: blur(0); opacity: 1; }
        }
        .anim-pendopo-enter {
            animation: pendopoZoom 1.4s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        /* Lampu Robyong Pendulum Swing */
        @keyframes lampRobyongSwing {
            0%, 100% { transform: rotate(0deg) translateY(0); }
            50% { transform: rotate(2.5deg) translateY(3px); }
        }
        .idle-sway-robyong {
            animation: lampRobyongSwing 5.5s ease-in-out infinite;
            transform-origin: top center;
        }

        /* Gunungan Wayang Floating Breath */
        @keyframes gununganFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-6px) scale(1.03); }
        }
        .idle-float-gunungan {
            animation: gununganFloat 4.8s ease-in-out infinite;
        }

        .anim-bg {
            animation: bgZoomIn 1.4s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        .anim-gate-left {
            opacity: 0;
            animation: gateSlideLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.25s forwards;
        }
        .anim-gate-right {
            opacity: 0;
            animation: gateSlideRight 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.25s forwards;
        }
        .anim-flower-tl {
            opacity: 0;
            animation: flowerDropLeft 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.55s forwards;
            transform-origin: top left;
        }
        .anim-flower-tr {
            opacity: 0;
            animation: flowerDropRight 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.65s forwards;
            transform-origin: top right;
        }
        .anim-lamp {
            opacity: 0;
            animation: lampRise 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.8s forwards;
        }
        .anim-wayang {
            opacity: 0;
            animation: wayangEnter 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards;
        }
        .anim-fg-flower-bl {
            opacity: 0;
            animation: fgFlowerRise 1.1s cubic-bezier(0.16, 1, 0.3, 1) 1.05s forwards;
        }
        .anim-fg-flower-br {
            opacity: 0;
            animation: fgFlowerRise 1.1s cubic-bezier(0.16, 1, 0.3, 1) 1.15s forwards;
        }
        .anim-top-title {
            opacity: 0;
            animation: textRevealDown 1s cubic-bezier(0.16, 1, 0.3, 1) 1.25s forwards;
        }
        .anim-couple-names {
            opacity: 0;
            animation: textRevealUp 1.1s cubic-bezier(0.16, 1, 0.3, 1) 1.45s forwards;
        }
        .anim-date-block {
            opacity: 0;
            animation: textRevealUp 1s cubic-bezier(0.16, 1, 0.3, 1) 1.65s forwards;
        }
        .anim-cta-block {
            opacity: 0;
            animation: textRevealUp 1s cubic-bezier(0.16, 1, 0.3, 1) 1.85s forwards;
        }

        /* Gate Opening Transition when user clicks "Buka Undangan" */
        .cover-opening .anim-gate-left {
            transition: transform 1.2s cubic-bezier(0.7, 0, 0.3, 1), opacity 1s ease;
            transform: translateX(-140%) scale(1.15) !important;
            opacity: 0 !important;
        }
        .cover-opening .anim-gate-right {
            transition: transform 1.2s cubic-bezier(0.7, 0, 0.3, 1), opacity 1s ease;
            transform: translateX(140%) scale(1.15) !important;
            opacity: 0 !important;
        }
        .cover-opening .anim-lamp,
        .cover-opening .anim-flower-tl,
        .cover-opening .anim-fg-flower-bl {
            transition: transform 1.1s cubic-bezier(0.7, 0, 0.3, 1), opacity 0.9s ease;
            transform: translateX(-120%) !important;
            opacity: 0 !important;
        }
        .cover-opening .anim-wayang,
        .cover-opening .anim-flower-tr,
        .cover-opening .anim-fg-flower-br {
            transition: transform 1.1s cubic-bezier(0.7, 0, 0.3, 1), opacity 0.9s ease;
            transform: translateX(120%) !important;
            opacity: 0 !important;
        }
        .cover-opening .cover-ZoomOut {
            transition: transform 1.3s cubic-bezier(0.7, 0, 0.3, 1), opacity 1.2s ease;
            transform: scale(1.22);
            opacity: 0;
        }

        /* Luxury Name Styling matching Reference Image */
        .couple-name-text {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-weight: 600;
            color: #F7EBD5;
            text-shadow: 0 3px 16px rgba(0, 0, 0, 0.95), 0 0 24px rgba(217, 170, 69, 0.25);
        }

        .gold-foil {
            background: linear-gradient(135deg, #FFF6E5 0%, #F5D38A 40%, #D9AA45 75%, #9E6F22 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Reference Ornate Button Styling */
        .btn-buka-reference {
            background: radial-gradient(ellipse at center, rgba(38, 23, 14, 0.92) 0%, rgba(16, 9, 5, 0.96) 100%);
            border: 1.5px solid #C89D48;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.8), inset 0 0 12px rgba(217, 170, 69, 0.22);
            transition: all 0.35s ease;
        }
        .btn-buka-reference:hover {
            border-color: #F3CE7A;
            box-shadow: 0 8px 30px rgba(217, 170, 69, 0.45), inset 0 0 18px rgba(243, 206, 122, 0.35);
            transform: translateY(-2px) scale(1.02);
        }

        /* Floating Golden Sparkles */
        @keyframes floatDust {
            0% { transform: translateY(105%) scale(0.6); opacity: 0; }
            20% { opacity: 0.85; }
            80% { opacity: 0.85; }
            100% { transform: translateY(-20px) scale(1.1); opacity: 0; }
        }
        .gold-sparkle {
            position: absolute;
            border-radius: 50%;
            pointer-events:none;
            animation: floatDust linear infinite;
        }

        /* ========================================================================= */
        /* LIVING AMBIENT SYSTEM: ROYAL FIREFLIES (KUNANG-KUNANG) & BUTTERFLIES       */
        /* ========================================================================= */
        @keyframes fireflyPulse {
            0%, 100% {
                opacity: 0.15;
                transform: scale(0.65);
                box-shadow: 0 0 4px 1px rgba(245, 211, 138, 0.35);
            }
            50% {
                opacity: 0.95;
                transform: scale(1.25);
                box-shadow: 0 0 10px 3px rgba(245, 211, 138, 0.9), 0 0 18px 6px rgba(217, 170, 69, 0.5);
            }
        }

        @keyframes fireflyDriftA {
            0%, 100% { transform: translate3d(0, 0, 0); }
            25% { transform: translate3d(22px, -20px, 0); }
            50% { transform: translate3d(-16px, -42px, 0); }
            75% { transform: translate3d(14px, -18px, 0); }
        }

        @keyframes fireflyDriftB {
            0%, 100% { transform: translate3d(0, 0, 0); }
            30% { transform: translate3d(-24px, 22px, 0); }
            65% { transform: translate3d(18px, -26px, 0); }
            85% { transform: translate3d(-10px, -8px, 0); }
        }

        @keyframes fireflyDriftC {
            0%, 100% { transform: translate3d(0, 0, 0); }
            35% { transform: translate3d(20px, 26px, 0); }
            70% { transform: translate3d(-22px, 14px, 0); }
            90% { transform: translate3d(12px, -18px, 0); }
        }

        .ambient-firefly-node {
            position: absolute;
            pointer-events: none;
            will-change: transform;
        }

        .ambient-firefly-dot {
            border-radius: 50%;
            background: radial-gradient(circle, #FFFFFF 0%, #FFF4CC 35%, #F5D38A 65%, rgba(217, 170, 69, 0.4) 90%, transparent 100%);
            animation: fireflyPulse 3s ease-in-out infinite;
            will-change: transform, opacity, box-shadow;
        }

        .firefly-drift-a { animation: fireflyDriftA 10s ease-in-out infinite; }
        .firefly-drift-b { animation: fireflyDriftB 12s ease-in-out infinite; }
        .firefly-drift-c { animation: fireflyDriftC 11s ease-in-out infinite; }

        /* 3D Butterfly Wing Flapping */
        @keyframes butterflyFlap {
            0% {
                transform: scaleX(1) scaleY(1);
            }
            100% {
                transform: scaleX(0.22) scaleY(0.92);
            }
        }

        /* Butterfly Flight Path 1: diagonal lower-left to upper-right */
        @keyframes butterflyFlightPath1 {
            0% {
                transform: translate3d(-50px, 85vh, 0) rotate(18deg);
                opacity: 0;
            }
            6% {
                opacity: 0.9;
            }
            28% {
                transform: translate3d(100px, 58vh, 0) rotate(32deg);
            }
            55% {
                transform: translate3d(230px, 36vh, 0) rotate(14deg);
            }
            80% {
                transform: translate3d(330px, 14vh, 0) rotate(-6deg);
                opacity: 0.85;
            }
            94% {
                opacity: 0.3;
            }
            100% {
                transform: translate3d(450px, -45px, 0) rotate(12deg);
                opacity: 0;
            }
        }

        /* Butterfly Flight Path 2: looping mid-right to upper-left */
        @keyframes butterflyFlightPath2 {
            0% {
                transform: translate3d(450px, 32vh, 0) rotate(-32deg) scaleX(-1);
                opacity: 0;
            }
            8% {
                opacity: 0.85;
            }
            32% {
                transform: translate3d(270px, 48vh, 0) rotate(-18deg) scaleX(-1);
            }
            62% {
                transform: translate3d(120px, 28vh, 0) rotate(-38deg) scaleX(-1);
            }
            88% {
                transform: translate3d(-25px, 16vh, 0) rotate(-12deg) scaleX(-1);
                opacity: 0.8;
            }
            100% {
                transform: translate3d(-65px, 8vh, 0) rotate(-26deg) scaleX(-1);
                opacity: 0;
            }
        }

        /* Butterfly Flight Path 3: sweeping lower-right to top-left */
        @keyframes butterflyFlightPath3 {
            0% {
                transform: translate3d(440px, 92vh, 0) rotate(-22deg) scaleX(-1);
                opacity: 0;
            }
            8% {
                opacity: 0.85;
            }
            35% {
                transform: translate3d(260px, 64vh, 0) rotate(-35deg) scaleX(-1);
            }
            65% {
                transform: translate3d(150px, 36vh, 0) rotate(-15deg) scaleX(-1);
            }
            88% {
                transform: translate3d(60px, 12vh, 0) rotate(-28deg) scaleX(-1);
                opacity: 0.8;
            }
            100% {
                transform: translate3d(-40px, -35px, 0) rotate(-18deg) scaleX(-1);
                opacity: 0;
            }
        }

        .ambient-butterfly-wrap {
            position: absolute;
            pointer-events: none;
            will-change: transform, opacity;
            top: 0;
            left: 0;
        }

        .ambient-butterfly-body {
            animation: butterflyFlap 0.3s ease-in-out infinite alternate;
            transform-origin: center center;
        }

        .butterfly-flight-1 {
            animation: butterflyFlightPath1 20s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            animation-delay: -3s;
        }

        .butterfly-flight-2 {
            animation: butterflyFlightPath2 26s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            animation-delay: -14s;
        }

        .butterfly-flight-3 {
            animation: butterflyFlightPath3 23s cubic-bezier(0.4, 0, 0.2, 1) infinite;
            animation-delay: -8s;
        }

        /* ========================================================================= */
        /* STAGGERED ROYAL ORNAMENT ASSEMBLY ANIMATIONS FOR ALL SECTIONS             */
        /* ========================================================================= */
        
        /* 1. Fast Reset on Leaving Viewport (No Lag) */
        .sec-assemble-section-divider,
        .sec-assemble-hero-tl,
        .sec-assemble-hero-tr,
        .sec-assemble-crest,
        .sec-assemble-salam,
        .sec-assemble-intro,
        .sec-assemble-names,
        .sec-assemble-date,
        .sec-assemble-title,
        .sec-assemble-divider,
        .sec-assemble-crown,
        .sec-assemble-gunungan,
        .sec-assemble-card,
        .sec-assemble-corner-tl,
        .sec-assemble-corner-tr,
        .sec-assemble-corner-bl,
        .sec-assemble-corner-br,
        .sec-assemble-arch-left,
        .sec-assemble-arch-right,
        .sec-assemble-border-left,
        .sec-assemble-border-right,
        .sec-assemble-bismillah,
        .sec-assemble-text-up,
        .sec-assemble-quote,
        .sec-assemble-cameo-left,
        .sec-assemble-cameo-right,
        .sec-assemble-count-1,
        .sec-assemble-count-2,
        .sec-assemble-count-3,
        .sec-assemble-count-4,
        .sec-assemble-save-date,
        .sec-assemble-frame,
        .sec-assemble-wreath-l,
        .sec-assemble-wreath-r,
        .sec-assemble-lamp,
        .sec-assemble-wayang,
        .sec-assemble-line-l,
        .sec-assemble-line-r,
        .sec-assemble-jewel,
        .sec-assemble-info,
        .sec-assemble-btn,
        .sec-assemble-card-left,
        .sec-assemble-card-right,
        .sec-assemble-item,
        .sec-assemble-timeline-line,
        .sec-assemble-timeline-dot,
        .sec-assemble-story,
        .sec-assemble-gallery,
        .sec-assemble-gift-btn,
        .sec-assemble-wishes {
            transition: opacity 0.22s ease, transform 0.22s ease !important;
        }

        /* 2. UNIVERSAL ELEMENTS */
        .sec-assemble-section-divider {
            opacity: 0;
            transform: scale(0.85);
        }
        .section-assembled .sec-assemble-section-divider {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.08s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.08s !important;
        }

        .sec-assemble-title {
            opacity: 0;
            transform: translateY(-25px);
        }
        .section-assembled .sec-assemble-title {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.1s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.1s !important;
        }

        .sec-assemble-divider {
            opacity: 0;
            transform: scaleX(0);
            transform-origin: center;
        }
        .section-assembled .sec-assemble-divider {
            opacity: 0.85;
            transform: scaleX(1);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.28s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.28s !important;
        }

        .sec-assemble-crown {
            opacity: 0;
            transform: translateY(-40px) scale(0.85);
        }
        .section-assembled .sec-assemble-crown {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }

        .sec-assemble-card {
            opacity: 0;
            transform: scale(0.92) translateY(25px);
        }
        .section-assembled .sec-assemble-card {
            opacity: 1;
            transform: scale(1) translateY(0);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.18s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.18s !important;
        }

        /* 4 Corner Ornaments Fly in from outside */
        .sec-assemble-corner-tl {
            opacity: 0;
            transform: translate(-30px, -30px) rotate(-25deg) scale(0.5);
        }
        .section-assembled .sec-assemble-corner-tl {
            opacity: 0.8;
            transform: translate(0, 0) rotate(0deg) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s !important;
        }

        .sec-assemble-corner-tr {
            opacity: 0;
            transform: translate(30px, -30px) rotate(25deg) scaleX(-1) scale(0.5);
        }
        .section-assembled .sec-assemble-corner-tr {
            opacity: 0.8;
            transform: translate(0, 0) rotate(0deg) scaleX(-1) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.35s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.35s !important;
        }

        .sec-assemble-corner-bl {
            opacity: 0;
            transform: translate(-30px, 30px) rotate(25deg) scaleY(-1) scale(0.5);
        }
        .section-assembled .sec-assemble-corner-bl {
            opacity: 0.8;
            transform: translate(0, 0) rotate(0deg) scaleY(-1) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s !important;
        }

        .sec-assemble-corner-br {
            opacity: 0;
            transform: translate(30px, 30px) rotate(-25deg) scale(-1) scale(0.5);
        }
        .section-assembled .sec-assemble-corner-br {
            opacity: 0.8;
            transform: translate(0, 0) rotate(0deg) scale(-1) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.45s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.45s !important;
        }

        .sec-assemble-bismillah {
            opacity: 0;
            transform: scale(0.85);
            filter: blur(4px);
        }
        .section-assembled .sec-assemble-bismillah {
            opacity: 1;
            transform: scale(1);
            filter: blur(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.25s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.25s, filter 0.85s ease 0.25s !important;
        }

        .sec-assemble-text-up {
            opacity: 0;
            transform: translateY(20px);
        }
        .section-assembled .sec-assemble-text-up {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.35s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.35s !important;
        }

        .sec-assemble-quote {
            opacity: 0;
            transform: translateY(18px);
        }
        .section-assembled .sec-assemble-quote {
            opacity: 0.85;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.5s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.5s !important;
        }

        .sec-assemble-btn {
            opacity: 0;
            transform: scale(0.88) translateY(12px);
        }
        .section-assembled .sec-assemble-btn {
            opacity: 1;
            transform: scale(1) translateY(0);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.55s, transform 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.55s !important;
        }

        /* 3. HERO SECTION (STAGGERED ASSEMBLY OF SEPARATED ORNAMENTS) */
        /* Side Vertical Carved Borders */
        .sec-assemble-border-l {
            opacity: 0;
            transform: translateX(-40px);
        }
        .section-assembled .sec-assemble-border-l {
            opacity: 0.95;
            transform: translateX(0);
            transition: opacity 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s, transform 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }

        .sec-assemble-border-r {
            opacity: 0;
            transform: translateX(40px);
        }
        .section-assembled .sec-assemble-border-r {
            opacity: 0.95;
            transform: translateX(0);
            transition: opacity 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s, transform 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }

        /* Top Crest & Greetings */
        .sec-assemble-crest {
            opacity: 0;
            transform: translateY(-24px) scale(0.8);
        }
        .section-assembled .sec-assemble-crest {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.32s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.32s !important;
        }

        .sec-assemble-salam {
            opacity: 0;
            transform: translateY(22px);
        }
        .section-assembled .sec-assemble-salam {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.45s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.45s !important;
        }

        .sec-assemble-intro {
            opacity: 0;
            transform: translateY(18px);
        }
        .section-assembled .sec-assemble-intro {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.58s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.58s !important;
        }

        /* Cameos Assembly */
        .sec-assemble-cameo-left {
            opacity: 0;
            transform: translate(-75px, 20px) rotate(-12deg) scale(0.78);
        }
        .section-assembled .sec-assemble-cameo-left {
            opacity: 1;
            transform: translate(0, 0) rotate(0deg) scale(1);
            transition: opacity 1.15s cubic-bezier(0.16, 1, 0.3, 1) 0.72s, transform 1.15s cubic-bezier(0.16, 1, 0.3, 1) 0.72s !important;
        }

        .sec-assemble-cameo-right {
            opacity: 0;
            transform: translate(75px, 20px) rotate(12deg) scale(0.78);
        }
        .section-assembled .sec-assemble-cameo-right {
            opacity: 1;
            transform: translate(0, 0) rotate(0deg) scale(1);
            transition: opacity 1.15s cubic-bezier(0.16, 1, 0.3, 1) 0.85s, transform 1.15s cubic-bezier(0.16, 1, 0.3, 1) 0.85s !important;
        }

        .sec-assemble-jewel {
            opacity: 0;
            transform: scale(0.2) rotate(-30deg);
        }
        .section-assembled .sec-assemble-jewel {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.98s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.98s !important;
        }

        .sec-assemble-names {
            opacity: 0;
            transform: translateY(16px);
        }
        .section-assembled .sec-assemble-names {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.1s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.1s !important;
        }

        .sec-assemble-date {
            opacity: 0;
            transform: scaleX(0.7) translateY(12px);
        }
        .section-assembled .sec-assemble-date {
            opacity: 1;
            transform: scaleX(1) translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.25s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.25s !important;
        }

        /* Countdown Staggered Assembly */
        .sec-assemble-count-1,
        .sec-assemble-count-2,
        .sec-assemble-count-3,
        .sec-assemble-count-4 {
            opacity: 0;
            transform: translateY(22px) scale(0.85);
        }
        .section-assembled .sec-assemble-count-1 {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.38s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.38s !important;
        }
        .section-assembled .sec-assemble-count-2 {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.48s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.48s !important;
        }
        .section-assembled .sec-assemble-count-3 {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.58s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.58s !important;
        }
        .section-assembled .sec-assemble-count-4 {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.68s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.68s !important;
        }

        .sec-assemble-save-date {
            opacity: 0;
            transform: translateY(18px) scale(0.92);
        }
        .section-assembled .sec-assemble-save-date {
            opacity: 1;
            transform: translateY(0) scale(1);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.85s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.85s !important;
        }

        /* 4. SANG MEMPELAI (SECTION 3) */
        .sec-assemble-arch-left {
            opacity: 0;
            transform: translate(-50px, -50px) rotate(-15deg) scale(0.8);
        }
        .section-assembled .sec-assemble-arch-left {
            opacity: 1;
            transform: translate(0, 0) rotate(0deg) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }

        .sec-assemble-arch-right {
            opacity: 0;
            transform: translate(50px, -50px) rotate(15deg) scale(0.8);
        }
        .section-assembled .sec-assemble-arch-right {
            opacity: 1;
            transform: translate(0, 0) rotate(0deg) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }

        .sec-assemble-mempelai-bl {
            opacity: 0;
            transform: translate(-40px, 40px) scale(0.85);
        }
        .section-assembled .sec-assemble-mempelai-bl {
            opacity: 0.9;
            transform: translate(0, 0) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s !important;
        }

        .sec-assemble-mempelai-br {
            opacity: 0;
            transform: translate(40px, 40px) scale(0.85);
        }
        .section-assembled .sec-assemble-mempelai-br {
            opacity: 0.9;
            transform: translate(0, 0) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s !important;
        }

        .sec-assemble-border-left {
            opacity: 0;
            transform: translateX(-40px);
        }
        .section-assembled .sec-assemble-border-left {
            opacity: 0.85;
            transform: translateX(0);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s !important;
        }

        .sec-assemble-border-right {
            opacity: 0;
            transform: translateX(40px);
        }
        .section-assembled .sec-assemble-border-right {
            opacity: 0.85;
            transform: translateX(0);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.25s !important;
        }

        .sec-assemble-frame {
            opacity: 0;
            transform: scale(0.84) translateY(25px);
            box-shadow: 0 0 0 rgba(217, 170, 69, 0);
        }
        .section-assembled .sec-assemble-frame {
            opacity: 1;
            transform: scale(1) translateY(0);
            box-shadow: 0 12px 32px rgba(0,0,0,0.9), 0 0 24px rgba(217,170,69,0.28);
            transition: opacity 0.95s cubic-bezier(0.16, 1, 0.3, 1) 0.18s, transform 0.95s cubic-bezier(0.16, 1, 0.3, 1) 0.18s, box-shadow 1s ease 0.25s !important;
        }

        .sec-assemble-wreath-l {
            opacity: 0;
            transform: translate(-25px, 20px) scale(0.8) rotate(-8deg);
        }
        .section-assembled .sec-assemble-wreath-l {
            opacity: 1;
            transform: translate(0, 0) scale(1) rotate(0deg);
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1) 0.32s, transform 1s cubic-bezier(0.16, 1, 0.3, 1) 0.32s !important;
        }

        .sec-assemble-wreath-r {
            opacity: 0;
            transform: translate(25px, 20px) scale(0.8) rotate(8deg);
        }
        .section-assembled .sec-assemble-wreath-r {
            opacity: 1;
            transform: translate(0, 0) scale(1) rotate(0deg);
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1) 0.32s, transform 1s cubic-bezier(0.16, 1, 0.3, 1) 0.32s !important;
        }

        @keyframes swayWreathL {
            0%, 100% { transform: rotate(0deg) translateY(0); }
            50% { transform: rotate(-1.5deg) translateY(-2px); }
        }
        .idle-sway-wreath-l {
            animation: swayWreathL 5.5s ease-in-out infinite;
            transform-origin: bottom right;
        }

        @keyframes swayWreathR {
            0%, 100% { transform: rotate(0deg) translateY(0); }
            50% { transform: rotate(1.5deg) translateY(-2px); }
        }
        .idle-sway-wreath-r {
            animation: swayWreathR 5.8s ease-in-out infinite 0.5s;
            transform-origin: bottom left;
        }

        .sec-assemble-line-l {
            opacity: 0;
            transform: scaleX(0);
            transform-origin: right center;
        }
        .section-assembled .sec-assemble-line-l {
            opacity: 1;
            transform: scaleX(1);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.2s, transform 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.2s !important;
        }

        .sec-assemble-line-r {
            opacity: 0;
            transform: scaleX(0);
            transform-origin: left center;
        }
        .section-assembled .sec-assemble-line-r {
            opacity: 1;
            transform: scaleX(1);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.2s, transform 0.75s cubic-bezier(0.16, 1, 0.3, 1) 0.2s !important;
        }

        .sec-assemble-jewel {
            opacity: 0;
            transform: scale(0) rotate(-180deg);
        }
        .section-assembled .sec-assemble-jewel {
            opacity: 1;
            transform: scale(1) rotate(0deg);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.3s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.3s !important;
        }

        .sec-assemble-info {
            opacity: 0;
            transform: translateY(20px);
        }
        .section-assembled .sec-assemble-info {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.5s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.5s !important;
        }

        /* 5. RANGKAIAN ACARA (SECTION 4) */
        .sec-assemble-card-left {
            opacity: 0;
            transform: translateX(-45px) rotate(-2deg) scale(0.95);
        }
        .section-assembled .sec-assemble-card-left {
            opacity: 1;
            transform: translateX(0) rotate(0deg) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.2s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.2s !important;
        }

        .sec-assemble-card-right {
            opacity: 0;
            transform: translateX(45px) rotate(2deg) scale(0.95);
        }
        .section-assembled .sec-assemble-card-right {
            opacity: 1;
            transform: translateX(0) rotate(0deg) scale(1);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.35s, transform 0.9s cubic-bezier(0.16, 1, 0.3, 1) 0.35s !important;
        }

        .sec-assemble-item {
            opacity: 0;
            transform: translateY(14px);
        }
        .section-assembled .sec-assemble-item {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.45s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.45s !important;
        }

        /* 6. KISAH KASIH (SECTION 5) */
        .sec-assemble-timeline-line {
            opacity: 0;
            transform: scaleY(0);
            transform-origin: top;
        }
        .section-assembled .sec-assemble-timeline-line {
            opacity: 0.6;
            transform: scaleY(1);
            transition: opacity 0.8s ease 0.15s, transform 1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }

        .sec-assemble-timeline-dot {
            opacity: 0;
            transform: scale(0);
        }
        .section-assembled .sec-assemble-timeline-dot {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.7s ease 0.25s, transform 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.25s !important;
        }

        .sec-assemble-story {
            opacity: 0;
            transform: translateX(35px);
        }
        .section-assembled .sec-assemble-story-0 {
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.2s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.2s !important;
        }
        .section-assembled .sec-assemble-story-1 {
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.4s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.4s !important;
        }
        .section-assembled .sec-assemble-story-2 {
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.6s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.6s !important;
        }

        /* 7. GALERI BAHAGIA (SECTION 6) */
        .sec-assemble-gallery {
            opacity: 0;
            transform: scale(0.85) translateY(18px);
        }
        .section-assembled .sec-assemble-gallery-0 {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0deg);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.15s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.15s !important;
        }
        .section-assembled .sec-assemble-gallery-1 {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0deg);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.28s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.28s !important;
        }
        .section-assembled .sec-assemble-gallery-2 {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0deg);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s !important;
        }
        .section-assembled .sec-assemble-gallery-3 {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0deg);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.52s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.52s !important;
        }
        .section-assembled .sec-assemble-gallery-4 {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0deg);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.64s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.64s !important;
        }
        .section-assembled .sec-assemble-gallery-5 {
            opacity: 1;
            transform: scale(1) translateY(0) rotate(0deg);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.76s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.76s !important;
        }

        /* 8. TANDA KASIH (SECTION 7) */
        .sec-assemble-gift-btn {
            opacity: 0;
            transform: scale(0.88) translateY(15px);
        }
        .section-assembled .sec-assemble-gift-btn {
            opacity: 1;
            transform: scale(1) translateY(0);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s !important;
        }

        /* 9. RSVP & WISHES (SECTION 8) */
        .sec-assemble-wishes {
            opacity: 0;
            transform: translateY(22px);
        }
        .section-assembled .sec-assemble-wishes {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.35s, transform 0.85s cubic-bezier(0.16, 1, 0.3, 1) 0.35s !important;
        }

        /* 10. PENUTUP / FOOTER (SECTION 9) */
        .sec-assemble-gunungan {
            opacity: 0;
            transform: translateY(-40px) scale(0.78);
        }
        .section-assembled .sec-assemble-gunungan {
            opacity: 0.95;
            transform: translateY(0) scale(1);
            transition: opacity 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s, transform 1s cubic-bezier(0.16, 1, 0.3, 1) 0.2s !important;
        }

        @media (prefers-reduced-motion: reduce) {
            .sec-assemble-title,
            .sec-assemble-divider,
            .sec-assemble-crown,
            .sec-assemble-gunungan,
            .sec-assemble-card,
            .sec-assemble-corner-tl,
            .sec-assemble-corner-tr,
            .sec-assemble-corner-bl,
            .sec-assemble-corner-br,
            .sec-assemble-arch-left,
            .sec-assemble-arch-right,
            .sec-assemble-border-left,
            .sec-assemble-border-right,
            .sec-assemble-bismillah,
            .sec-assemble-text-up,
            .sec-assemble-quote,
            .sec-assemble-cameo-left,
            .sec-assemble-cameo-right,
            .sec-assemble-count-1,
            .sec-assemble-count-2,
            .sec-assemble-count-3,
            .sec-assemble-count-4,
            .sec-assemble-save-date,
            .sec-assemble-frame,
            .sec-assemble-lamp,
            .sec-assemble-wayang,
            .sec-assemble-line-l,
            .sec-assemble-line-r,
            .sec-assemble-jewel,
            .sec-assemble-info,
            .sec-assemble-btn,
            .sec-assemble-card-left,
            .sec-assemble-card-right,
            .sec-assemble-item,
            .sec-assemble-timeline-line,
            .sec-assemble-timeline-dot,
            .sec-assemble-story,
            .sec-assemble-gallery,
            .sec-assemble-gift-btn,
            .sec-assemble-wishes {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
        }

        .glass-card {
            background: rgba(22, 13, 8, 0.72);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(217, 170, 69, 0.32);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.55), inset 0 1px 0 rgba(245, 211, 138, 0.15);
        }

        .clamped-shell-float {
            position: fixed;
            width: 100%;
            max-width: 430px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 50;
        }

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        @keyframes slowSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin-vinyl { animation: slowSpin 25s linear infinite; }
    </style>
</head>
<body 
    x-data="{ 
        isOpening: false,
        isOpen: {{ request()->has('open') ? 'true' : 'false' }}, 
        activeSection: '{{ request()->get('sec', 'hero') }}',
        isPlaying: false,
        copiedToast: false,
        lightboxImg: null,
        openInvitation() {
            if (this.isOpening) return;
            this.isOpening = true;
            this.playMusic();
            setTimeout(() => {
                this.isOpen = true;
                this.$nextTick(() => {
                    this.initAssemblyObserver();
                    setTimeout(() => {
                        let hero = document.getElementById('hero');
                        if (hero) hero.classList.add('section-assembled');
                    }, 60);
                    if (window.AOS) {
                        AOS.init({ duration: 900, once: false, mirror: true, offset: 60 });
                        setTimeout(() => { AOS.refreshHard(); }, 300);
                    }
                });
            }, 1150);
        },
        playMusic() {
            let audio = document.getElementById('bg-audio');
            if (audio) {
                audio.play().then(() => {
                    this.isPlaying = true;
                }).catch(e => {
                    console.log('Audio play triggered');
                });
            }
        },
        toggleMusic() {
            let audio = document.getElementById('bg-audio');
            if (!audio) return;
            if (this.isPlaying) {
                audio.pause();
                this.isPlaying = false;
            } else {
                audio.play();
                this.isPlaying = true;
            }
        },
        copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                this.copiedToast = true;
                setTimeout(() => { this.copiedToast = false; }, 2500);
            });
        },
        initAssemblyObserver() {
            if (this._assemblyObserver) {
                this._assemblyObserver.disconnect();
            }
            this._assemblyObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.id) {
                            this.activeSection = entry.target.id;
                        }
                        entry.target.classList.add('section-assembled');
                    } else {
                        entry.target.classList.remove('section-assembled');
                    }
                });
            }, { 
                threshold: 0.08,
                rootMargin: '0px 0px -20px 0px'
            });
            
            document.querySelectorAll('.anim-section, .nav-section').forEach(section => {
                this._assemblyObserver.observe(section);
            });
        },
        observeSections() {
            this.initAssemblyObserver();
        },
        init() {
            @if(request()->has('open'))
            this.$nextTick(() => {
                this.initAssemblyObserver();
                setTimeout(() => {
                    let target = document.getElementById('{{ request()->get('sec', 'hero') }}');
                    if (target) {
                        target.scrollIntoView();
                        target.classList.add('section-assembled');
                    }
                }, 400);
            });
            @endif
        }
    }"
    :class="isOpen ? '' : 'overflow-hidden'"
>

<!-- BACKGROUND AUDIO -->
<audio id="bg-audio" loop preload="auto">
    <source src="{{ $musicUrl }}" type="audio/mpeg">
</audio>

<!-- TOAST COPIED -->
<div 
    x-show="copiedToast" 
    x-cloak 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    class="clamped-shell-float top-6 px-4 flex justify-center pointer-events-none"
>
    <div class="px-5 py-2.5 rounded-full bg-[#1b1008]/95 border border-lestari-gold/80 text-lestari-lightgold text-xs font-semibold shadow-2xl backdrop-blur-md flex items-center gap-2">
        <svg class="w-4 h-4 text-lestari-lightgold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span>Nomor rekening berhasil disalin!</span>
    </div>
</div>

<!-- LIGHTBOX MODAL -->
<div 
    x-show="lightboxImg" 
    x-cloak 
    @click="lightboxImg = null"
    class="fixed inset-0 z-[100] bg-black/90 backdrop-blur-md flex items-center justify-center p-4"
>
    <div class="relative max-w-sm w-full" @click.stop>
        <button @click="lightboxImg = null" class="absolute -top-10 right-0 text-lestari-lightgold hover:text-white p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img :src="lightboxImg" class="w-full h-auto max-h-[80vh] object-contain rounded-2xl border border-lestari-gold/40 shadow-2xl">
    </div>
</div>

<!-- ============================================== -->
<!-- DESKTOP STAGE WRAPPER -->
<!-- ============================================== -->
<div class="desktop-stage">

    <div class="invitation-shell flex flex-col">

        <!-- ========================================================================= -->
        <!-- 1. LAYERED CINEMATIC COVER (EXACT REPLICA OF Undangan Pernikahan Jawa Mewah.png) -->
        <!-- ========================================================================= -->
        <div 
            x-show="!isOpen"
            :class="isOpening ? 'cover-opening pointer-events-none' : ''"
            class="fixed inset-0 sm:absolute sm:inset-0 z-50 bg-[#0d0603] overflow-hidden select-none flex flex-col justify-between"
        >
            <!-- LAYER 0: BASE ARCHITECTURAL TEMPLE BACKGROUND -->
            <div class="absolute inset-0 z-0 cover-ZoomOut">
                <img 
                    src="{{ $getNewAsset('Latar Gerbang Kuil Emas Bernuansa Hangat.png') }}" 
                    class="w-full h-full object-cover object-center anim-bg" 
                    alt="Latar Kuil"
                >
                <!-- Subtle warm vignette to blend layers seamlessly -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/45 via-transparent to-black/75"></div>
            </div>

            <!-- LAYER 1: FLOATING GOLD DUST PARTICLES -->
            <div class="absolute inset-0 pointer-events-none z-[5] overflow-hidden">
                @for ($i = 0; $i < 16; $i++)
                    @php
                        $left = rand(10, 90);
                        $size = rand(2, 3);
                        $dur = rand(7, 13);
                        $del = rand(0, 7);
                    @endphp
                    <div 
                        class="gold-sparkle" 
                        style="
                            left: {{ $left }}%; 
                            bottom: 10%;
                            width: {{ $size }}px; 
                            height: {{ $size }}px; 
                            background-color: #F5D38A; 
                            box-shadow: 0 0 8px #D9AA45;
                            animation-duration: {{ $dur }}s; 
                            animation-delay: -{{ $del }}s;
                        "
                    ></div>
                @endfor
            </div>

            <!-- LAYER 2: CENTRAL SPLIT GATE (CANDI BENTAR 1.png & 2.png) -->
            <!-- Left Gate (1.png: gate sits at 2%..42% width of 1080x1350 image) -->
            <img 
                src="{{ $getNewAsset('1.png') }}" 
                class="anim-gate-left absolute z-[10] pointer-events-none h-auto filter drop-shadow-[0_14px_28px_rgba(0,0,0,0.9)]"
                style="top: 15.5%; left: 15.5%; width: 75%;"
                alt="Gapura Kiri"
            >
            <!-- Right Gate (2.png: gate sits at 9%..49% width of 1080x1350 image) -->
            <img 
                src="{{ $getNewAsset('2.png') }}" 
                class="anim-gate-right absolute z-[10] pointer-events-none h-auto filter drop-shadow-[0_14px_28px_rgba(0,0,0,0.9)]"
                style="top: 15%; left: 46.25%; width: 75%;"
                alt="Gapura Kanan"
            >

            <!-- LAYER 1.5: GENTLY DRIFTING & TUMBLING JASMINE PETALS & LEAVES (10.png & 9.png) -->
            <div class="absolute inset-0 pointer-events-none z-[22] overflow-hidden">
                <!-- Blossom 1 -->
                <div class="falling-petal-1 absolute" style="left: 12%; top: -10%; width: 28px; animation-delay: -2s;">
                    <img src="{{ $getNewAsset('10.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Petal">
                </div>
                <!-- Leaf 2 -->
                <div class="falling-petal-2 absolute" style="left: 72%; top: -10%; width: 22px; animation-delay: -5s;">
                    <img src="{{ $getNewAsset('9.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Leaf">
                </div>
                <!-- Blossom 3 -->
                <div class="falling-petal-3 absolute" style="left: 36%; top: -10%; width: 24px; animation-delay: -1s;">
                    <img src="{{ $getNewAsset('10.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Petal">
                </div>
                <!-- Leaf 4 -->
                <div class="falling-petal-4 absolute" style="left: 86%; top: -10%; width: 19px; animation-delay: -7s;">
                    <img src="{{ $getNewAsset('9.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Leaf">
                </div>
                <!-- Blossom 5 -->
                <div class="falling-petal-5 absolute" style="left: 54%; top: -10%; width: 26px; animation-delay: -3.5s;">
                    <img src="{{ $getNewAsset('10.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Petal">
                </div>
                <!-- Leaf 6 -->
                <div class="falling-petal-6 absolute" style="left: 22%; top: -10%; width: 18px; animation-delay: -8s;">
                    <img src="{{ $getNewAsset('9.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Leaf">
                </div>
                <!-- Blossom 7 -->
                <div class="falling-petal-7 absolute" style="left: 64%; top: -10%; width: 22px; animation-delay: -4s;">
                    <img src="{{ $getNewAsset('10.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Petal">
                </div>
                <!-- Leaf 8 -->
                <div class="falling-petal-8 absolute" style="left: 44%; top: -10%; width: 16px; animation-delay: -6.5s;">
                    <img src="{{ $getNewAsset('9.png') }}" class="w-full h-auto drop-shadow-[0_4px_10px_rgba(0,0,0,0.65)]" alt="Leaf">
                </div>
            </div>

            <!-- LAYER 3: MIDGROUND MELATI BEHIND BRASS LAMP (7.png) WITH CONTINUOUS BREATHING MOTION -->
            <div class="anim-lamp absolute z-[14] pointer-events-none" style="top: 52%; left: 8%; width: 28%;">
                <img 
                    src="{{ $getNewAsset('7.png') }}" 
                    class="w-full h-auto block idle-breathe-mid filter drop-shadow-[0_6px_12px_rgba(0,0,0,0.85)]"
                    alt="Melati Tengah"
                >
            </div>

            <!-- LAYER 4: LEFT ANTIQUE BRASS OIL LAMP WITH FLAME (4.png) WITH LIVING CANDLE FLICKER & HOVER -->
            <div 
                class="anim-lamp absolute z-[18] pointer-events-none idle-lamp"
                style="top: 43.5%; left: 0%; width: 40%;"
            >
                <!-- Warm Candle Flame Aura with dynamic flicker -->
                <div 
                    class="idle-candle absolute rounded-full pointer-events-none"
                    style="top: 2%; left: 14%; width: 52px; height: 52px; background: radial-gradient(circle, rgba(255,215,120,0.85) 0%, rgba(217,140,45,0.3) 55%, transparent 75%);"
                ></div>
                <img 
                    src="{{ $getNewAsset('4.png') }}" 
                    class="w-full h-auto block filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.92)]"
                    alt="Lampu Kuningan"
                >
            </div>

            <!-- LAYER 5: RIGHT WAYANG KULIT FIGURE (3.png) WITH MAJESTIC BREATHING MOTION -->
            <div class="anim-wayang absolute z-[18] pointer-events-none" style="top: 42.5%; left: 72%; width: 48%;">
                <img 
                    src="{{ $getNewAsset('3.png') }}" 
                    class="w-full h-auto block idle-wayang filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.92)]"
                    alt="Wayang Kulit"
                >
            </div>

            <!-- LAYER 6A: TOP-LEFT CASCADING JASMINE (5.png) WITH CONTINUOUS WIND SWAY -->
            <div class="anim-flower-tl absolute z-[25] pointer-events-none" style="top: -2%; left: -4%; width: 52%;">
                <img 
                    src="{{ $getNewAsset('5.png') }}" 
                    class="w-full h-auto block idle-sway-tl filter drop-shadow-[0_8px_16px_rgba(0,0,0,0.75)]"
                    alt="Melati Kiri Atas"
                >
            </div>

            <!-- LAYER 6B: TOP-RIGHT CASCADING JASMINE (6.png) WITH CONTINUOUS WIND SWAY -->
            <div class="anim-flower-tr absolute z-[25] pointer-events-none" style="top: -2%; right: -5%; width: 42%;">
                <img 
                    src="{{ $getNewAsset('6.png') }}" 
                    class="w-full h-auto block idle-sway-tr -scale-x-100 filter drop-shadow-[0_8px_16px_rgba(0,0,0,0.75)]"
                    alt="Melati Kanan Atas"
                >
            </div>

            <!-- LAYER 7: FOREGROUND BOKEH MELATI CORNERS (8.png & 6.png) WITH CONTINUOUS LIVING BREEZE MOTION -->
            <div class="anim-fg-flower-bl absolute z-[28] pointer-events-none" style="bottom: -5%; left: -8%; width: 42%;">
                <img 
                    src="{{ $getNewAsset('8.png') }}" 
                    class="w-full h-auto block idle-sway-bl filter blur-[0.8px] drop-shadow-[0_8px_16px_rgba(0,0,0,0.85)]"
                    alt="Melati Kiri Bawah"
                >
            </div>
            <div class="anim-fg-flower-br absolute z-[28] pointer-events-none" style="bottom: -3%; right: -5%; width: 46%;">
                <img 
                    src="{{ $getNewAsset('6.png') }}" 
                    class="w-full h-auto block idle-sway-br filter blur-[0.8px] drop-shadow-[0_8px_16px_rgba(0,0,0,0.85)]"
                    alt="Melati Kanan Bawah"
                >
            </div>

            <!-- ========================================================================= -->
            <!-- LAYER 8: FOREGROUND TYPOGRAPHY & INTERACTIVE CTA (MATCHING REFERENCE)     -->
            <!-- ========================================================================= -->
            <div class="relative z-[30] w-full h-full flex flex-col justify-between items-center py-6 px-5 cover-ZoomOut">
                
                <!-- TOP HEADER: Royal Crest + PAWIWAHAN AGENG -->
                <div class="anim-top-title text-center pt-1">
                    <!-- Ornate Gold Lotus Filigree Crest SVG -->
                    <svg class="w-12 h-8 mx-auto mb-1 text-[#DFB76C] fill-current drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" viewBox="0 0 100 65">
                        <path d="M50 4 C53 16 62 24 62 34 C62 42 55 47 50 52 C45 47 38 42 38 34 C38 24 47 16 50 4 Z" fill="none" stroke="currentColor" stroke-width="2.2"/>
                        <path d="M50 12 L50 56" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M38 36 C26 28 14 34 10 44 C18 46 28 44 38 42" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M62 36 C74 28 86 34 90 44 C82 46 72 44 62 42" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M22 48 L78 48" stroke="currentColor" stroke-width="1.5"/>
                        <circle cx="50" cy="4" r="2.5"/>
                        <circle cx="10" cy="44" r="2"/>
                        <circle cx="90" cy="44" r="2"/>
                    </svg>

                    <p class="font-cinzel text-[11px] tracking-[0.38em] text-[#E5C178] uppercase font-semibold drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        PAWIWAHAN AGENG
                    </p>
                    <p class="font-serif italic text-[15px] text-[#F2E6D0] tracking-wide mt-0.5 drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        The Wedding Invitation of
                    </p>
                </div>

                <!-- SPACER FOR CENTRAL GATEWAY -->
                <div class="flex-1"></div>

                <!-- LOWER-CENTER: COUPLE NAMES, DATE & CTA BUTTON -->
                <div class="w-full flex flex-col items-center pb-1">
                    
                    <!-- Couple Names (Exact match to Sekar Ayu & Raden Bagus in Reference) -->
                    <div class="anim-couple-names text-center">
                        <h1 class="couple-name-text name-shimmer text-[40px] sm:text-[44px] leading-[1.08] tracking-wide">
                            {{ $couple['bride'] }}
                        </h1>

                        <!-- Horizontal Hairline with Italic Ampersand -->
                        <div class="flex items-center justify-center gap-3 my-1">
                            <div class="w-16 h-[1px] bg-gradient-to-r from-transparent via-[#C89D48] to-[#C89D48]"></div>
                            <span class="font-serif italic text-xl text-[#E5C178] leading-none">&amp;</span>
                            <div class="w-16 h-[1px] bg-gradient-to-l from-transparent via-[#C89D48] to-[#C89D48]"></div>
                        </div>

                        <h1 class="couple-name-text name-shimmer text-[40px] sm:text-[44px] leading-[1.08] tracking-wide">
                            {{ $couple['groom'] }}
                        </h1>
                    </div>

                    <!-- Date & Ornate Filigree Divider -->
                    <div class="anim-date-block text-center mt-2.5 mb-3.5">
                        <p class="font-serif text-[14px] tracking-[0.18em] text-[#E5C178] font-medium drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">
                            {{ $event['date_formatted'] }}
                        </p>

                        <!-- Filigree Center Line SVG -->
                        <div class="flex items-center justify-center mt-1.5 opacity-90">
                            <div class="w-20 h-[1px] bg-gradient-to-r from-transparent to-[#C89D48]"></div>
                            <svg class="w-10 h-4 text-[#DFB76C] fill-current mx-1" viewBox="0 0 60 24">
                                <path d="M30 2 L35 12 L30 22 L25 12 Z" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                <circle cx="15" cy="12" r="2"/>
                                <circle cx="45" cy="12" r="2"/>
                                <path d="M18 12 C22 6 26 6 30 12 C34 18 38 18 42 12" fill="none" stroke="currentColor" stroke-width="1.2"/>
                            </svg>
                            <div class="w-20 h-[1px] bg-gradient-to-l from-transparent to-[#C89D48]"></div>
                        </div>
                    </div>

                    <!-- Recipient & Ornate "Buka Undangan" Button -->
                    <div class="anim-cta-block w-full flex flex-col items-center">
                        <p class="font-serif text-[12px] tracking-[0.12em] text-[#E6D7BE] mb-0.5 drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">
                            Kepada Yth. Bapak/Ibu/Saudara/i
                        </p>
                        @if(request('to') || request('kpd'))
                            <p class="font-serif text-base font-semibold text-[#F7EBD5] mb-2 tracking-wide">
                                {{ request('to', request('kpd')) }}
                            </p>
                        @else
                            <div class="mb-2"></div>
                        @endif

                        <!-- Ornate Pill Button (Exact Replica of Reference Image) -->
                        <div class="relative flex flex-col items-center">
                            <button 
                                @click="openInvitation()"
                                class="btn-buka-reference relative px-10 py-2.5 rounded-full flex items-center justify-center gap-5 cursor-pointer group"
                            >
                                <!-- Inner subtle hairline border -->
                                <span class="absolute inset-[3px] rounded-full border border-[#C89D48]/35 pointer-events-none"></span>

                                <!-- Left Diamond Star -->
                                <span class="text-[#DFB76C] text-[9px] leading-none">✦</span>

                                <!-- Button Label -->
                                <span class="font-serif text-[17px] font-medium tracking-[0.06em] text-[#F7EBD5] group-hover:text-white transition-colors">
                                    Buka Undangan
                                </span>

                                <!-- Right Diamond Star -->
                                <span class="text-[#DFB76C] text-[9px] leading-none">✦</span>
                            </button>

                            <!-- Bottom Filigree Flourish under Button -->
                            <svg class="w-12 h-3.5 text-[#C89D48] fill-current -mt-0.5 opacity-90" viewBox="0 0 60 18">
                                <path d="M30 16 L24 6 L30 2 L36 6 Z" fill="none" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M24 8 C16 8 12 4 6 2" fill="none" stroke="currentColor" stroke-width="1.2"/>
                                <path d="M36 8 C44 8 48 4 54 2" fill="none" stroke="currentColor" stroke-width="1.2"/>
                                <circle cx="30" cy="16" r="1.5"/>
                            </svg>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- ============================================================== -->
        <!-- FLOATING MUSIC BUTTON (PINNED TO INVITATION SHELL) -->
        <!-- ============================================================== -->
        <div 
            x-show="isOpen" 
            x-cloak 
            class="clamped-shell-float top-4 px-4 flex justify-end pointer-events-none"
        >
            <button 
                @click="toggleMusic()" 
                class="pointer-events-auto w-10 h-10 rounded-full bg-[#180f0a]/90 border border-lestari-gold/70 backdrop-blur-md flex items-center justify-center text-lestari-lightgold shadow-2xl"
                :title="isPlaying ? 'Pause Musik' : 'Play Musik'"
            >
                <div :class="isPlaying ? 'spin-vinyl' : ''" class="flex items-center justify-center">
                    <svg x-show="isPlaying" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    <svg x-show="!isPlaying" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l6 6 1.27-1.27L4.27 3zM14 7h4V3h-6v5.18l2 2z"/></svg>
                </div>
            </button>
        </div>

        <!-- ============================================================== -->
        <!-- PERSISTENT LIVING AMBIENT SYSTEM: FIREFLIES & BUTTERFLIES     -->
        <!-- Pinioned to viewport within invitation shell, active on scroll -->
        <!-- ============================================================== -->
        <div 
            x-show="isOpen" 
            x-cloak 
            class="clamped-shell-float inset-0 pointer-events-none z-30 overflow-hidden" 
            style="height: 100vh; height: 100dvh;"
        >
            <!-- 1. FLUTTERING GOLDEN BUTTERFLIES (KUPU-KUPU EMAS) -->
            <div class="ambient-butterfly-wrap butterfly-flight-1">
                <div class="ambient-butterfly-body">
                    <img 
                        src="{{ $getAsset('ref-gold-butterfly.png') }}" 
                        class="w-7 sm:w-8 h-auto object-contain filter drop-shadow-[0_0_8px_rgba(245,211,138,0.7)]" 
                        alt="Golden Butterfly"
                    >
                </div>
            </div>

            <div class="ambient-butterfly-wrap butterfly-flight-2">
                <div class="ambient-butterfly-body" style="animation-duration: 0.26s;">
                    <img 
                        src="{{ $getAsset('ref-gold-butterfly.png') }}" 
                        class="w-6 sm:w-7 h-auto object-contain filter drop-shadow-[0_0_8px_rgba(245,211,138,0.7)]" 
                        alt="Golden Butterfly"
                    >
                </div>
            </div>

            <div class="ambient-butterfly-wrap butterfly-flight-3">
                <div class="ambient-butterfly-body" style="animation-duration: 0.32s;">
                    <img 
                        src="{{ $getAsset('ref-gold-butterfly.png') }}" 
                        class="w-5 sm:w-6 h-auto object-contain filter drop-shadow-[0_0_6px_rgba(245,211,138,0.6)]" 
                        alt="Golden Butterfly"
                    >
                </div>
            </div>

            <!-- 2. ROYAL GOLDEN FIREFLIES (KUNANG-KUNANG EMAS) -->
            <!-- Harmoniously distributed throughout screen space with varied drift, pulse & size -->
            <div class="ambient-firefly-node firefly-drift-a" style="left: 12%; top: 16%; animation-duration: 9s; animation-delay: -2s;">
                <div class="ambient-firefly-dot" style="width: 4px; height: 4px; animation-duration: 2.8s; animation-delay: -0.6s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-b" style="left: 82%; top: 22%; animation-duration: 11s; animation-delay: -4s;">
                <div class="ambient-firefly-dot" style="width: 5px; height: 5px; animation-duration: 3.4s; animation-delay: -1.2s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-c" style="left: 28%; top: 38%; animation-duration: 10s; animation-delay: -1s;">
                <div class="ambient-firefly-dot" style="width: 3.5px; height: 3.5px; animation-duration: 2.5s; animation-delay: -2.1s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-a" style="left: 74%; top: 48%; animation-duration: 12s; animation-delay: -6s;">
                <div class="ambient-firefly-dot" style="width: 4.5px; height: 4.5px; animation-duration: 3.8s; animation-delay: -0.8s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-b" style="left: 18%; top: 62%; animation-duration: 8.5s; animation-delay: -3s;">
                <div class="ambient-firefly-dot" style="width: 5px; height: 5px; animation-duration: 2.9s; animation-delay: -1.5s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-c" style="left: 85%; top: 72%; animation-duration: 13s; animation-delay: -5s;">
                <div class="ambient-firefly-dot" style="width: 4px; height: 4px; animation-duration: 3.1s; animation-delay: -2.4s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-a" style="left: 42%; top: 82%; animation-duration: 10.5s; animation-delay: -7s;">
                <div class="ambient-firefly-dot" style="width: 4px; height: 4px; animation-duration: 3.6s; animation-delay: -1.8s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-b" style="left: 64%; top: 12%; animation-duration: 9.5s; animation-delay: -8s;">
                <div class="ambient-firefly-dot" style="width: 3px; height: 3px; animation-duration: 2.2s; animation-delay: -0.4s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-c" style="left: 8%; top: 88%; animation-duration: 11.5s; animation-delay: -2.5s;">
                <div class="ambient-firefly-dot" style="width: 4.5px; height: 4.5px; animation-duration: 3.3s; animation-delay: -1.1s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-a" style="left: 55%; top: 68%; animation-duration: 12.5s; animation-delay: -4.5s;">
                <div class="ambient-firefly-dot" style="width: 3.5px; height: 3.5px; animation-duration: 2.7s; animation-delay: -0.9s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-b" style="left: 36%; top: 26%; animation-duration: 10s; animation-delay: -3.5s;">
                <div class="ambient-firefly-dot" style="width: 4px; height: 4px; animation-duration: 3.2s; animation-delay: -1.7s;"></div>
            </div>
            <div class="ambient-firefly-node firefly-drift-c" style="left: 88%; top: 40%; animation-duration: 11s; animation-delay: -6.5s;">
                <div class="ambient-firefly-dot" style="width: 3.5px; height: 3.5px; animation-duration: 2.6s; animation-delay: -0.5s;"></div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- 2. MAIN SCROLLABLE CONTENT (POST-COVER) -->
        <!-- ============================================================== -->
        <main 
            id="main-scroll" 
            x-show="isOpen" 
            x-init="observeSections()" 
            x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative w-full flex-1 flex flex-col pb-24"
        >

            <!-- ============================================================== -->
            <!-- SECTION 1: HERO (ROYAL JAVANESE PENDOPO & TWIN CAMEOS)         -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- SECTION 1: HERO (SEPARATED ORNAMENTS & ANIMATED ASSEMBLY)      -->
            <!-- ============================================================== -->
            <section 
                id="hero" 
                class="anim-section nav-section relative min-h-[100dvh] flex flex-col justify-between items-center text-center px-4 pt-6 pb-6 overflow-hidden select-none"
                style="background: radial-gradient(ellipse at 50% 38%, #201007 0%, #120803 55%, #080301 100%);"
            >
                <!-- LAYER 0: SUBTLE ROYAL BATIK WATERMARK -->
                <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay" style="background: url('{{ $getAsset('lestari-05-kawung-tile.png') }}') repeat 260px 260px;"></div>

                <!-- LAYER 1: ORNATE VERTICAL BORDERS (FLY IN FROM SIDES) -->
                <img 
                    src="{{ $getAsset('ref-hero-border-l.png') }}" 
                    class="sec-assemble-border-l absolute left-0 top-0 bottom-0 h-full w-[44px] sm:w-[52px] object-cover object-left pointer-events-none z-10" 
                    alt="Batas Kiri"
                >
                <img 
                    src="{{ $getAsset('ref-hero-border-r.png') }}" 
                    class="sec-assemble-border-r absolute right-0 top-0 bottom-0 h-full w-[44px] sm:w-[52px] object-cover object-right pointer-events-none z-10" 
                    alt="Batas Kanan"
                >

                <!-- TOP SECTION: ROYAL INVITATION HEADER (ANIMATED ASSEMBLY) -->
                <div class="relative z-20 w-full pt-1 sm:pt-2 flex flex-col items-center">
                    <!-- Top Golden Lotus Crest Motif -->
                    <div class="sec-assemble-crest flex items-center justify-center gap-2 mb-1.5">
                        <div class="w-8 sm:w-12 h-[1px] bg-gradient-to-r from-transparent via-[#D4AF37]/60 to-[#D4AF37]"></div>
                        <img src="{{ $getAsset('ref-lotus-crest.png') }}" class="w-7 sm:w-8 h-auto object-contain drop-shadow-[0_2px_8px_rgba(212,175,55,0.6)]" alt="Royal Lotus Crest">
                        <div class="w-8 sm:w-12 h-[1px] bg-gradient-to-l from-transparent via-[#D4AF37]/60 to-[#D4AF37]"></div>
                    </div>

                    <!-- Title -->
                    <h1 class="sec-assemble-crest font-cinzel text-[11px] sm:text-xs tracking-[0.42em] text-[#E5C384] font-semibold uppercase drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        PAWIWAHAN AGENG
                    </h1>

                    <!-- Hairline Divider -->
                    <div class="sec-assemble-crest flex items-center justify-center gap-2 my-1.5">
                        <div class="w-5 sm:w-8 h-[1px] bg-[#C5A059]/40"></div>
                        <img src="{{ $getAsset('ref-filigree-diamond.png') }}" class="w-2.5 h-auto opacity-75" alt="❖">
                        <div class="w-5 sm:w-8 h-[1px] bg-[#C5A059]/40"></div>
                    </div>

                    <!-- Islamic Greeting -->
                    <h2 class="sec-assemble-salam font-serif text-lg sm:text-[22px] text-[#F6EEDB] font-normal tracking-wide drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)] px-4 leading-snug">
                        Assalamu’alaikum Warahmatullahi Wabarakatuh
                    </h2>

                    <!-- Introductory Text -->
                    <p class="sec-assemble-intro font-serif italic text-xs text-[#D8C8B0] leading-relaxed max-w-[310px] mx-auto mt-1 font-light drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        Dengan memohon rahmat dan ridha Allah SWT, kami bermaksud menyelenggarakan pernikahan putra-putri kami.
                    </p>
                </div>

                <!-- MIDDLE SECTION: TWIN ROYAL CAMEOS & COUPLE NAMES (ANIMATED GLIDE-IN) -->
                <div class="relative z-20 w-full max-w-[370px] mx-auto my-auto py-1">
                    <div class="flex items-center justify-center gap-2 sm:gap-3.5">
                        <!-- Bride Cameo -->
                        <div class="sec-assemble-cameo-left flex-1 max-w-[136px] sm:max-w-[150px] flex flex-col items-center">
                            <div class="relative w-[124px] sm:w-[138px]">
                                <img 
                                    src="{{ $getAsset('ref-cameo-bride-clean.png') }}" 
                                    class="w-full h-auto block filter drop-shadow-[0_8px_20px_rgba(0,0,0,0.95)]" 
                                    alt="{{ $couple['bride'] }}"
                                >
                            </div>
                            <h3 class="sec-assemble-names font-serif text-xl sm:text-2xl text-[#F6EEDB] font-normal mt-2 tracking-wide drop-shadow-[0_2px_8px_rgba(0,0,0,1)]">
                                {{ $couple['bride'] }}
                            </h3>
                            <p class="sec-assemble-names font-cinzel text-[8.5px] sm:text-[9px] tracking-[0.25em] text-[#D4AF37] font-semibold uppercase mt-0.5">
                                MEMPELAI WANITA
                            </p>
                        </div>

                        <!-- Ampersand with Sacred Javanese Finials -->
                        <div class="sec-assemble-jewel flex flex-col items-center justify-center px-1 mb-7">
                            <img src="{{ $getAsset('ref-filigree-diamond.png') }}" class="w-3 sm:w-3.5 h-auto drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" alt="Finial">
                            <span class="font-serif italic text-2xl sm:text-3xl text-[#E5C384] my-1 leading-none drop-shadow-[0_2px_8px_rgba(0,0,0,1)]">&amp;</span>
                            <img src="{{ $getAsset('ref-filigree-diamond.png') }}" class="w-3 sm:w-3.5 h-auto rotate-180 drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]" alt="Finial">
                        </div>

                        <!-- Groom Cameo -->
                        <div class="sec-assemble-cameo-right flex-1 max-w-[136px] sm:max-w-[150px] flex flex-col items-center">
                            <div class="relative w-[124px] sm:w-[138px]">
                                <img 
                                    src="{{ $getAsset('ref-cameo-groom-clean.png') }}" 
                                    class="w-full h-auto block filter drop-shadow-[0_8px_20px_rgba(0,0,0,0.95)]" 
                                    alt="{{ $couple['groom'] }}"
                                >
                            </div>
                            <h3 class="sec-assemble-names font-serif text-xl sm:text-2xl text-[#F6EEDB] font-normal mt-2 tracking-wide drop-shadow-[0_2px_8px_rgba(0,0,0,1)]">
                                {{ $couple['groom'] }}
                            </h3>
                            <p class="sec-assemble-names font-cinzel text-[8.5px] sm:text-[9px] tracking-[0.25em] text-[#D4AF37] font-semibold uppercase mt-0.5">
                                MEMPELAI PRIA
                            </p>
                        </div>
                    </div>

                    <!-- Date Divider -->
                    <div class="sec-assemble-date flex items-center justify-center gap-2 mt-3 sm:mt-4 max-w-[260px] mx-auto">
                        <div class="w-8 sm:w-12 h-[1px] bg-gradient-to-r from-transparent to-[#D4AF37]/70"></div>
                        <img src="{{ $getAsset('ref-filigree-diamond.png') }}" class="w-2.5 h-auto opacity-75" alt="❖">
                        <div class="w-8 sm:w-12 h-[1px] bg-gradient-to-l from-transparent to-[#D4AF37]/70"></div>
                    </div>

                    <!-- Event Date Text -->
                    <p class="sec-assemble-date font-cinzel text-xs sm:text-[13px] tracking-[0.28em] text-[#D4AF37] font-semibold uppercase mt-1 drop-shadow-[0_2px_6px_rgba(0,0,0,1)]">
                        {{ $event['date_formatted'] ?? 'MINGGU, 18 APRIL 2027' }}
                    </p>
                </div>

                <!-- BOTTOM SECTION: BORDERLESS ORGANIC COUNTDOWN & CALENDAR CTA -->
                <div class="relative z-20 w-full flex flex-col items-center mt-auto pb-16 px-4">
                    
                    <!-- Seamless Borderless Typography Countdown (Matching Reference 1:1) -->
                    <div 
                        class="w-full max-w-[320px] flex items-center justify-around py-1 mb-3.5"
                        x-data="{
                            target: new Date('{{ $event['date_iso'] }}T{{ $event['time'] }}').getTime(),
                            days: '00', hours: '00', minutes: '00', seconds: '00',
                            init() {
                                const update = () => {
                                    let now = new Date().getTime();
                                    let d = this.target - now;
                                    if (d < 0) d = 0;
                                    this.days = String(Math.floor(d / (1000 * 60 * 60 * 24))).padStart(2, '0');
                                    this.hours = String(Math.floor((d % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                                    this.minutes = String(Math.floor((d % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                                    this.seconds = String(Math.floor((d % (1000 * 60)) / 1000)).padStart(2, '0');
                                };
                                update();
                                setInterval(update, 1000);
                            }
                        }"
                    >
                        <!-- Days -->
                        <div class="sec-assemble-count-1 flex flex-col items-center flex-1">
                            <span class="font-serif text-3xl sm:text-4xl font-light leading-none text-[#F6EEDB] drop-shadow-[0_2px_10px_rgba(0,0,0,1)]" x-text="days">182</span>
                            <span class="font-cinzel text-[8.5px] uppercase tracking-[0.25em] text-[#D4AF37] font-semibold mt-1.5 drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">HARI</span>
                        </div>

                        <!-- Hairline Divider -->
                        <div class="w-[1px] h-7 sm:h-8 bg-gradient-to-b from-transparent via-[#C5A059]/40 to-transparent"></div>

                        <!-- Hours -->
                        <div class="sec-assemble-count-2 flex flex-col items-center flex-1">
                            <span class="font-serif text-3xl sm:text-4xl font-light leading-none text-[#F6EEDB] drop-shadow-[0_2px_10px_rgba(0,0,0,1)]" x-text="hours">08</span>
                            <span class="font-cinzel text-[8.5px] uppercase tracking-[0.25em] text-[#D4AF37] font-semibold mt-1.5 drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">JAM</span>
                        </div>

                        <!-- Hairline Divider -->
                        <div class="w-[1px] h-7 sm:h-8 bg-gradient-to-b from-transparent via-[#C5A059]/40 to-transparent"></div>

                        <!-- Minutes -->
                        <div class="sec-assemble-count-3 flex flex-col items-center flex-1">
                            <span class="font-serif text-3xl sm:text-4xl font-light leading-none text-[#F6EEDB] drop-shadow-[0_2px_10px_rgba(0,0,0,1)]" x-text="minutes">31</span>
                            <span class="font-cinzel text-[8.5px] uppercase tracking-[0.25em] text-[#D4AF37] font-semibold mt-1.5 drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">MENIT</span>
                        </div>

                        <!-- Hairline Divider -->
                        <div class="w-[1px] h-7 sm:h-8 bg-gradient-to-b from-transparent via-[#C5A059]/40 to-transparent"></div>

                        <!-- Seconds -->
                        <div class="sec-assemble-count-4 flex flex-col items-center flex-1">
                            <span class="font-serif text-3xl sm:text-4xl font-light leading-none text-[#F6EEDB] drop-shadow-[0_2px_10px_rgba(0,0,0,1)]" x-text="seconds">21</span>
                            <span class="font-cinzel text-[8.5px] uppercase tracking-[0.25em] text-[#D4AF37] font-semibold mt-1.5 drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">DETIK</span>
                        </div>
                    </div>

                    <!-- Modern Save The Date / Google Calendar Button -->
                    <a 
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Pawiwahan Ageng ' . $couple['bride'] . ' & ' . $couple['groom']) }}&dates=20270418T010000Z/20270418T070000Z&details=Pawiwahan+Ageng+Pernikahan+Adat+Jawa&location={{ urlencode($event['location'] . ', ' . $event['address']) }}" 
                        target="_blank"
                        class="sec-assemble-save-date group inline-flex items-center justify-center gap-2.5 px-6 sm:px-8 py-2.5 rounded-full text-[10px] sm:text-[10.5px] font-cinzel font-semibold tracking-[0.22em] text-[#E5C384] border border-[#C5A059]/60 hover:border-[#E5C384] hover:bg-[#C5A059]/15 transition-all mb-3.5 bg-black/25 backdrop-blur-sm shadow-[0_4px_16px_rgba(0,0,0,0.6)]"
                    >
                        <svg class="w-3.5 h-3.5 text-[#E5C384]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>SIMPAN KE KALENDER</span>
                    </a>

                    <!-- High-Visibility Scroll Indicator with Chevron -->
                    <div class="sec-assemble-save-date flex flex-col items-center gap-0.5 opacity-80">
                        <svg class="w-3.5 h-3.5 text-[#C5A059] animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 9l-7 7-7-7"/></svg>
                        <span class="font-cinzel text-[8.5px] uppercase tracking-[0.28em] text-[#C5A059] font-medium">GULIR UNTUK MELANJUTKAN</span>
                    </div>

                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 2: AYAT SUCI & FALSAFAH JAWA                           -->
            <!-- ============================================================== -->
            <section id="ayat" class="anim-section nav-section relative py-14 px-5 text-center overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;">
                <!-- Deep Espresso Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/92 to-[#080402] pointer-events-none"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_45%,rgba(217,170,69,0.14),transparent_70%)] pointer-events-none"></div>

                <!-- Royal Section Transition Crest & Divider -->
                <div class="sec-assemble-section-divider relative z-20 flex items-center justify-center gap-3 max-w-[280px] mx-auto mb-6 pointer-events-none">
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-transparent via-[#D9AA45]/50 to-[#D9AA45]"></div>
                    <div class="flex items-center gap-1.5 px-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                        <img src="{{ $getAsset('royal-gold-crest.png') }}" class="w-6 h-auto object-contain filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Crest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                    </div>
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D9AA45] via-[#D9AA45]/50 to-transparent"></div>
                </div>

                <!-- Outer Section Framing Corner Arches (Pure Gold & White Jasmine) -->
                <div class="sec-assemble-arch-left absolute top-0 left-0 w-24 sm:w-28 h-auto z-[12] pointer-events-none opacity-80">
                    <img src="{{ $getAsset('hero-corner-tl.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Pojok Kiri">
                </div>
                <div class="sec-assemble-arch-right absolute top-0 right-0 w-24 sm:w-28 h-auto z-[12] pointer-events-none opacity-80">
                    <img src="{{ $getAsset('hero-corner-tr.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Pojok Kanan">
                </div>

                <!-- Carved Teak Crown Ornament -->
                <div class="sec-assemble-crown relative z-20 flex justify-center -mb-5 pointer-events-none">
                    <img src="{{ $getAsset('ukiran-mahkota-jati.png') }}" class="w-44 sm:w-48 h-auto object-contain filter drop-shadow-[0_6px_16px_rgba(0,0,0,0.9)]" alt="Mahkota Keraton">
                </div>

                <!-- Sacred Verse Plaque Card -->
                <div class="sec-assemble-card relative max-w-sm mx-auto pt-7 pb-6 px-6 rounded-3xl bg-[#140b07]/85 backdrop-blur-md shadow-[0_15px_40px_rgba(0,0,0,0.85)] border border-[#D9AA45]/40 overflow-hidden">
                    <!-- 4 Antique Gold Corner Filigrees -->
                    <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tl absolute -top-1 -left-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" alt="Corner">
                    <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tr absolute -top-1 -right-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-x-[-1]" alt="Corner">
                    <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-bl absolute -bottom-1 -left-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-y-[-1]" alt="Corner">
                    <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-br absolute -bottom-1 -right-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-[-1]" alt="Corner">

                    <div class="relative z-10">
                        <p class="sec-assemble-bismillah font-serif italic text-2xl text-[#F9DE96] mb-2.5 drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <p class="sec-assemble-text-up font-serif italic text-xs leading-relaxed text-[#FFFDF8] font-light mb-3 drop-shadow-[0_1px_4px_rgba(0,0,0,0.9)]">
                            "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                        </p>
                        <p class="sec-assemble-text-up font-cinzel text-[9.5px] tracking-[0.25em] text-[#F5D38A] font-semibold uppercase">
                            (QS. AR-RUM: 21)
                        </p>
                        <div class="sec-assemble-divider w-28 h-auto mx-auto my-3 opacity-90">
                            <img src="{{ $getAsset('lestari-06-divider.png') }}" class="w-full h-full object-contain filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" alt="Divider Keraton">
                        </div>
                        <p class="sec-assemble-quote font-serif italic text-[11.5px] text-[#F5ECD8] leading-relaxed drop-shadow-[0_1px_4px_rgba(0,0,0,0.9)]">
                            "Mbangun kromo ingkang satuhu, nyawiji donga mugi tansah pinayungan karahayon nir ing sambikala."
                        </p>
                    </div>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 3: SANG MEMPELAI (THE COUPLE)                          -->
            <!-- ============================================================== -->
            <section id="mempelai" class="anim-section nav-section relative py-14 px-4 text-center overflow-hidden" style="background: #140b06 radial-gradient(circle at 50% 30%, #2b180d 0%, #160c07 65%, #0e0704 100%);">
                <!-- Atmospheric subtle dark vignette -->
                <div class="absolute inset-0 bg-gradient-to-b from-[#0e0704] via-transparent to-[#0e0704] pointer-events-none"></div>

                <!-- 4 Cascading Jasmine Corner Ornaments matching reference image exactly -->
                <!-- Top-Left Corner Jasmine -->
                <div class="sec-assemble-arch-left absolute top-0 left-0 w-28 sm:w-32 h-auto z-[15] pointer-events-none opacity-90">
                    <img src="{{ $getAsset('ref-corner-tl.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Melati Pojok Kiri Atas">
                </div>

                <!-- Top-Right Corner Jasmine -->
                <div class="sec-assemble-arch-right absolute top-0 right-0 w-28 sm:w-32 h-auto z-[15] pointer-events-none opacity-90">
                    <img src="{{ $getAsset('ref-corner-tr.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Melati Pojok Kanan Atas">
                </div>

                <!-- Bottom-Left Corner Jasmine -->
                <div class="sec-assemble-mempelai-bl absolute bottom-0 left-0 w-24 sm:w-28 h-auto z-[15] pointer-events-none opacity-85">
                    <img src="{{ $getAsset('ref-corner-bl.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Melati Pojok Kiri Bawah">
                </div>

                <!-- Bottom-Right Corner Jasmine -->
                <div class="sec-assemble-mempelai-br absolute bottom-0 right-0 w-24 sm:w-28 h-auto z-[15] pointer-events-none opacity-85">
                    <img src="{{ $getAsset('ref-corner-br.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Melati Pojok Kanan Bawah">
                </div>

                <div class="relative z-20 max-w-sm mx-auto">
                    <!-- Top Royal Header matching Reference -->
                    <div class="mb-8">
                        <!-- Royal Gold Diamond Medallion Motif -->
                        <div class="sec-assemble-crest flex justify-center mb-1.5">
                            <img src="{{ $getAsset('ref-motif-keraton.png') }}" class="w-7 h-auto filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Motif Keraton">
                        </div>

                        <!-- Top Hairline Divider with Diamond Dot -->
                        <div class="sec-assemble-divider flex items-center justify-center gap-3 my-2">
                            <div class="w-16 sm:w-20 h-px bg-[#C9A84C]/50"></div>
                            <span class="text-[#D4AF37] text-[7px]">◆</span>
                            <div class="w-16 sm:w-20 h-px bg-[#C9A84C]/50"></div>
                        </div>

                        <!-- Subtitle -->
                        <p class="sec-assemble-title font-cinzel text-[10px] tracking-[0.38em] text-[#E5C170] uppercase font-semibold">DHUAJENG &amp; KAKANG</p>

                        <!-- Main Heading -->
                        <h2 class="sec-assemble-title font-serif text-3xl sm:text-4xl text-[#F3E5C8] font-normal tracking-wide mt-1">Sang Mempelai</h2>

                        <!-- Lower Hairline Divider with Diamond Motif -->
                        <div class="sec-assemble-divider flex items-center justify-center gap-2.5 mt-2">
                            <div class="w-14 sm:w-16 h-px bg-[#C9A84C]/50"></div>
                            <span class="text-[#D4AF37] text-[10px]">❖</span>
                            <div class="w-14 sm:w-16 h-px bg-[#C9A84C]/50"></div>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <!-- ==================== MEMPELAI WANITA ==================== -->
                        <div class="flex flex-col items-center relative">
                            <!-- Arch Portrait Card with integrated frame, crest, pendant, and jasmine wreath -->
                            <div class="relative w-[216px] sm:w-[230px] h-[286px] sm:h-[305px] mb-4 flex items-center justify-center mx-auto">
                                <!-- Subtle Golden Ambience Glow Behind Portrait -->
                                <div class="absolute inset-2 rounded-full bg-[#E5C170]/10 filter blur-xl pointer-events-none"></div>

                                <!-- Outer Arch Frame (Fine Hairline Gold) -->
                                <div class="sec-assemble-frame relative w-full h-full rounded-t-full rounded-b-[2px] border border-[#D4AF37]/75 p-[5px] bg-[#140b06]/40 shadow-[0_12px_28px_rgba(0,0,0,0.85)] z-10 flex items-center justify-center">
                                    <!-- Inner Arch Border with User Photo -->
                                    <div class="relative w-full h-full rounded-t-full rounded-b-[1px] border border-[#F6EEDB]/40 overflow-hidden bg-[#120a06]">
                                        <img src="{{ isset($invitation->bride_image) ? asset('storage/' . $invitation->bride_image) : $getAsset('bride-solo.jpg') }}" class="w-full h-full object-cover filter brightness-[0.98] transition-transform duration-700 hover:scale-105" alt="Mempelai Wanita">
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#120a06]/40 via-transparent to-transparent pointer-events-none"></div>
                                    </div>

                                    <!-- Arch Apex Crown Crest (Guaranteed dead-center) -->
                                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 w-16 sm:w-18 z-20 pointer-events-none flex justify-center">
                                        <div class="sec-assemble-crown w-full flex justify-center">
                                            <img src="{{ $getAsset('ref-arch-crest.png') }}" class="w-full h-auto filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.85)]" alt="Mahkota Puncak">
                                        </div>
                                    </div>

                                    <!-- Arch Baseline Pendant -->
                                    <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-7 sm:w-8 z-20 pointer-events-none flex justify-center">
                                        <img src="{{ $getAsset('ref-arch-pendant.png') }}" class="w-full h-auto filter drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]" alt="Bandul Bawah">
                                    </div>
                                </div>

                                <!-- Left Flanking Climbing Jasmine Wreath -->
                                <div class="sec-assemble-wreath-l absolute -left-8 sm:-left-9 bottom-0 w-16 sm:w-18 h-auto z-20 pointer-events-none">
                                    <img src="{{ $getAsset('ref-branch-left.png') }}" class="w-full h-auto filter drop-shadow-[0_4px_10px_rgba(0,0,0,0.9)] idle-sway-wreath-l" alt="Melati Kiri">
                                </div>

                                <!-- Right Flanking Climbing Jasmine Wreath -->
                                <div class="sec-assemble-wreath-r absolute -right-8 sm:-right-9 bottom-0 w-16 sm:w-18 h-auto z-20 pointer-events-none">
                                    <img src="{{ $getAsset('ref-branch-right.png') }}" class="w-full h-auto filter drop-shadow-[0_4px_10px_rgba(0,0,0,0.9)] idle-sway-wreath-r" alt="Melati Kanan">
                                </div>
                            </div>

                            <!-- Typography Below Bride Portrait -->
                            <div class="sec-assemble-info flex flex-col items-center">
                                <h3 class="font-serif text-2xl sm:text-[26px] font-normal text-[#F6EEDB] tracking-wide drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]">
                                    {{ $couple['bride_full'] ?? $couple['bride'] }}
                                </h3>
                                
                                <!-- Flanked Subtitle: —— MEMPELAI WANITA —— -->
                                <div class="flex items-center justify-center gap-3 my-2">
                                    <div class="w-10 sm:w-12 h-px bg-[#C9A84C]/60"></div>
                                    <span class="font-cinzel text-[10px] tracking-[0.3em] text-[#D4AF37] font-semibold uppercase">Mempelai Wanita</span>
                                    <div class="w-10 sm:w-12 h-px bg-[#C9A84C]/60"></div>
                                </div>

                                <!-- Parents Description -->
                                <p class="text-xs sm:text-[13px] text-[#DFD5C4] leading-relaxed font-light max-w-[290px] mx-auto drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">
                                    {{ $couple['parents']['bride'] }}
                                </p>
                            </div>

                            @if(isset($couple['instagram']['bride']) && !empty($couple['instagram']['bride']))
                            <div class="sec-assemble-btn mt-3.5">
                                <a href="{{ $couple['instagram']['bride'] }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full border border-[#D4AF37]/50 bg-black/30 text-[#E5C384] text-[9.5px] tracking-[0.25em] font-cinzel uppercase hover:border-[#D4AF37] hover:bg-black/50 transition-all shadow-sm">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    <span>Instagram</span>
                                </a>
                            </div>
                            @endif
                        </div>

                        <!-- Ampersand with Sacred Javanese Gold Jewel -->
                        <div class="flex items-center justify-center my-6">
                            <div class="sec-assemble-line-l w-16 h-[1px] bg-gradient-to-r from-transparent via-[#D4AF37]/70 to-[#D4AF37]"></div>
                            <div class="sec-assemble-jewel mx-3.5 w-9 h-9 flex items-center justify-center rounded-full border border-[#D4AF37]/50 bg-[#160d08] shadow-[0_0_14px_rgba(217,170,69,0.25)] idle-breathe-mid">
                                <span class="font-serif italic text-lg text-[#F5D38A] leading-none">&amp;</span>
                            </div>
                            <div class="sec-assemble-line-r w-16 h-[1px] bg-gradient-to-r from-[#D4AF37] via-[#D4AF37]/70 to-transparent"></div>
                        </div>

                        <!-- ==================== MEMPELAI PRIA ==================== -->
                        <div class="flex flex-col items-center relative">
                            <!-- Arch Portrait Card with integrated frame, crest, pendant, and jasmine wreath -->
                            <div class="relative w-[216px] sm:w-[230px] h-[286px] sm:h-[305px] mb-4 flex items-center justify-center mx-auto">
                                <!-- Subtle Golden Ambience Glow Behind Portrait -->
                                <div class="absolute inset-2 rounded-full bg-[#E5C170]/10 filter blur-xl pointer-events-none"></div>

                                <!-- Outer Arch Frame (Fine Hairline Gold) -->
                                <div class="sec-assemble-frame relative w-full h-full rounded-t-full rounded-b-[2px] border border-[#D4AF37]/75 p-[5px] bg-[#140b06]/40 shadow-[0_12px_28px_rgba(0,0,0,0.85)] z-10 flex items-center justify-center">
                                    <!-- Inner Arch Border with User Photo -->
                                    <div class="relative w-full h-full rounded-t-full rounded-b-[1px] border border-[#F6EEDB]/40 overflow-hidden bg-[#120a06]">
                                        <img src="{{ isset($invitation->groom_image) ? asset('storage/' . $invitation->groom_image) : $getAsset('groom-solo.jpg') }}" class="w-full h-full object-cover filter brightness-[0.98] transition-transform duration-700 hover:scale-105" alt="Mempelai Pria">
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#120a06]/40 via-transparent to-transparent pointer-events-none"></div>
                                    </div>

                                    <!-- Arch Apex Crown Crest (Guaranteed dead-center) -->
                                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 w-16 sm:w-18 z-20 pointer-events-none flex justify-center">
                                        <div class="sec-assemble-crown w-full flex justify-center">
                                            <img src="{{ $getAsset('ref-arch-crest.png') }}" class="w-full h-auto filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.85)]" alt="Mahkota Puncak">
                                        </div>
                                    </div>

                                    <!-- Arch Baseline Pendant -->
                                    <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-7 sm:w-8 z-20 pointer-events-none flex justify-center">
                                        <img src="{{ $getAsset('ref-arch-pendant.png') }}" class="w-full h-auto filter drop-shadow-[0_2px_4px_rgba(0,0,0,0.85)]" alt="Bandul Bawah">
                                    </div>
                                </div>

                                <!-- Left Flanking Climbing Jasmine Wreath -->
                                <div class="sec-assemble-wreath-l absolute -left-8 sm:-left-9 bottom-0 w-16 sm:w-18 h-auto z-20 pointer-events-none">
                                    <img src="{{ $getAsset('ref-branch-left.png') }}" class="w-full h-auto filter drop-shadow-[0_4px_10px_rgba(0,0,0,0.9)] idle-sway-wreath-l" alt="Melati Kiri">
                                </div>

                                <!-- Right Flanking Climbing Jasmine Wreath -->
                                <div class="sec-assemble-wreath-r absolute -right-8 sm:-right-9 bottom-0 w-16 sm:w-18 h-auto z-20 pointer-events-none">
                                    <img src="{{ $getAsset('ref-branch-right.png') }}" class="w-full h-auto filter drop-shadow-[0_4px_10px_rgba(0,0,0,0.9)] idle-sway-wreath-r" alt="Melati Kanan">
                                </div>
                            </div>

                            <!-- Typography Below Groom Portrait -->
                            <div class="sec-assemble-info flex flex-col items-center">
                                <h3 class="font-serif text-2xl sm:text-[26px] font-normal text-[#F6EEDB] tracking-wide drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]">
                                    {{ $couple['groom_full'] ?? $couple['groom'] }}
                                </h3>
                                
                                <!-- Flanked Subtitle: —— MEMPELAI PRIA —— -->
                                <div class="flex items-center justify-center gap-3 my-2">
                                    <div class="w-10 sm:w-12 h-px bg-[#C9A84C]/60"></div>
                                    <span class="font-cinzel text-[10px] tracking-[0.3em] text-[#D4AF37] font-semibold uppercase">Mempelai Pria</span>
                                    <div class="w-10 sm:w-12 h-px bg-[#C9A84C]/60"></div>
                                </div>

                                <!-- Parents Description -->
                                <p class="text-xs sm:text-[13px] text-[#DFD5C4] leading-relaxed font-light max-w-[290px] mx-auto drop-shadow-[0_1px_4px_rgba(0,0,0,0.8)]">
                                    {{ $couple['parents']['groom'] }}
                                </p>
                            </div>

                            @if(isset($couple['instagram']['groom']) && !empty($couple['instagram']['groom']))
                            <div class="sec-assemble-btn mt-3.5">
                                <a href="{{ $couple['instagram']['groom'] }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full border border-[#D4AF37]/50 bg-black/30 text-[#E5C384] text-[9.5px] tracking-[0.25em] font-cinzel uppercase hover:border-[#D4AF37] hover:bg-black/50 transition-all shadow-sm">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                    <span>Instagram</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 4: RANGKAIAN ACARA (EVENT)                             -->
            <!-- ============================================================== -->
            <section id="acara" class="anim-section nav-section relative py-14 px-5 text-center overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;">
                <!-- Atmospheric dark overlay -->
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/94 to-[#080402] pointer-events-none"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_35%,rgba(217,170,69,0.12),transparent_70%)] pointer-events-none"></div>

                <!-- Royal Section Transition Crest & Divider -->
                <div class="sec-assemble-section-divider relative z-20 flex items-center justify-center gap-3 max-w-[280px] mx-auto mb-6 pointer-events-none">
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-transparent via-[#D9AA45]/50 to-[#D9AA45]"></div>
                    <div class="flex items-center gap-1.5 px-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                        <img src="{{ $getAsset('royal-gold-crest.png') }}" class="w-6 h-auto object-contain filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Crest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                    </div>
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D9AA45] via-[#D9AA45]/50 to-transparent"></div>
                </div>

                <!-- Outer Section Framing Corner Arches (Pure Gold & White Jasmine) -->
                <div class="sec-assemble-arch-left absolute top-0 left-0 w-24 sm:w-28 h-auto z-[12] pointer-events-none opacity-80">
                    <img src="{{ $getAsset('hero-corner-tl.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Pojok Kiri">
                </div>
                <div class="sec-assemble-arch-right absolute top-0 right-0 w-24 sm:w-28 h-auto z-[12] pointer-events-none opacity-80">
                    <img src="{{ $getAsset('hero-corner-tr.png') }}" class="w-full h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Pojok Kanan">
                </div>

                <div class="relative z-10">
                    <!-- Top Carved Crown / Ornament -->
                    <div class="sec-assemble-crown flex justify-center mb-2.5 pointer-events-none">
                        <img src="{{ $getAsset('ukiran-mahkota-jati.png') }}" class="w-32 sm:w-36 h-auto object-contain filter drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" alt="Mahkota">
                    </div>

                    <div class="sec-assemble-title mb-8">
                        <p class="font-cinzel text-[9.5px] uppercase tracking-[0.35em] text-[#F5D38A] font-semibold">TITI MANGSANE</p>
                        <h2 class="font-serif text-3xl font-medium gold-foil mt-0.5">Rangkaian Acara</h2>
                        <div class="sec-assemble-divider w-28 h-auto mx-auto mt-2 opacity-90">
                            <img src="{{ $getAsset('lestari-06-divider.png') }}" class="w-full h-full object-contain filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" alt="Divider Keraton">
                        </div>
                    </div>

                    <div class="space-y-6 max-w-sm mx-auto">
                        @foreach($schedule as $idx => $sch)
                        <div 
                            class="{{ $idx % 2 === 0 ? 'sec-assemble-card-left' : 'sec-assemble-card-right' }} relative rounded-2xl p-6 text-left glass-card shadow-[0_12px_32px_rgba(0,0,0,0.85)] border border-[#D9AA45]/40 overflow-hidden"
                        >
                            <!-- 4 Antique Gold Corner Filigrees on each Event Card (Enlarged & Prominent) -->
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tl absolute -top-1 -left-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tr absolute -top-1 -right-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-x-[-1]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-bl absolute -bottom-1 -left-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-y-[-1]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-br absolute -bottom-1 -right-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-[-1]" alt="Corner">

                            <div class="relative z-10">
                                <h3 class="sec-assemble-item font-serif text-2xl font-semibold gold-foil mb-3">{{ $sch['title'] }}</h3>
                                
                                <div class="sec-assemble-item space-y-2.5 mb-4 text-xs text-lestari-cream/90">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-6 h-6 rounded-full bg-[#D9AA45]/15 flex items-center justify-center shrink-0 border border-[#D9AA45]/30">
                                            <svg class="w-3.5 h-3.5 text-lestari-lightgold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <span class="font-medium text-lestari-ivory">{{ $sch['date'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-6 h-6 rounded-full bg-[#D9AA45]/15 flex items-center justify-center shrink-0 border border-[#D9AA45]/30">
                                            <svg class="w-3.5 h-3.5 text-lestari-lightgold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <span class="font-medium text-lestari-ivory">{{ $sch['time'] }}</span>
                                    </div>
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-6 h-6 rounded-full bg-[#D9AA45]/15 flex items-center justify-center shrink-0 border border-[#D9AA45]/30 mt-0.5">
                                            <svg class="w-3.5 h-3.5 text-lestari-lightgold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-lestari-lightgold">{{ $sch['venue'] }}</p>
                                            <p class="text-[11px] text-lestari-muted mt-0.5 leading-relaxed">{{ $sch['address'] }}</p>
                                        </div>
                                    </div>
                                </div>

                                <a 
                                    href="{{ $sch['maps'] ?? $event['maps_url'] }}" 
                                    target="_blank" 
                                    class="sec-assemble-btn inline-flex items-center justify-center gap-2 w-full py-2.5 rounded-xl border border-lestari-gold/50 bg-[#140b07] hover:bg-lestari-gold hover:text-[#150d08] text-lestari-lightgold text-xs font-cinzel font-semibold tracking-wider transition-all duration-300 shadow"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                                    <span>Petunjuk Google Maps</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 5: KISAH KASIH (LOVE STORY)                            -->
            <!-- ============================================================== -->
            @if(!empty($stories))
            <section id="cerita" class="anim-section nav-section relative py-14 px-5 text-center overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;">
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/94 to-[#080402] pointer-events-none"></div>

                <!-- Royal Section Transition Crest & Divider -->
                <div class="sec-assemble-section-divider relative z-20 flex items-center justify-center gap-3 max-w-[280px] mx-auto mb-6 pointer-events-none">
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-transparent via-[#D9AA45]/50 to-[#D9AA45]"></div>
                    <div class="flex items-center gap-1.5 px-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                        <img src="{{ $getAsset('royal-gold-crest.png') }}" class="w-6 h-auto object-contain filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Crest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                    </div>
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D9AA45] via-[#D9AA45]/50 to-transparent"></div>
                </div>

                <div class="relative z-10">
                    <div class="sec-assemble-title mb-8">
                        <p class="font-cinzel text-[9.5px] uppercase tracking-[0.35em] text-[#F5D38A] font-semibold">LELAMPAHAN KASIH</p>
                        <h2 class="font-serif text-3xl font-medium gold-foil mt-0.5">Kisah Kasih</h2>
                        <div class="sec-assemble-divider w-28 h-auto mx-auto mt-2 opacity-90">
                            <img src="{{ $getAsset('lestari-06-divider.png') }}" class="w-full h-full object-contain filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" alt="Divider Keraton">
                        </div>
                    </div>

                    <div class="relative max-w-sm mx-auto text-left pl-6 my-2">
                        <!-- Vertical Golden Timeline Trunk (Unrolls downwards) -->
                        <div class="sec-assemble-timeline-line absolute left-0 top-2 bottom-2 w-[2px] bg-gradient-to-b from-[#D9AA45] via-[#F5D38A] to-[#D9AA45]/40 shadow-[0_0_8px_rgba(217,170,69,0.5)]"></div>

                        <div class="space-y-7">
                            @foreach($stories as $sIndex => $story)
                            <div class="sec-assemble-story sec-assemble-story-{{ $sIndex % 3 }} relative">
                                <!-- Glowing Jewel Dot -->
                                <div class="sec-assemble-timeline-dot absolute -left-[31px] top-1 w-3.5 h-3.5 rounded-full bg-[#D9AA45] border-2 border-[#150d08] shadow-[0_0_10px_#D9AA45]"></div>
                                <span class="font-cinzel text-[9px] uppercase tracking-[0.2em] text-lestari-lightgold font-semibold block mb-0.5">
                                    {{ $story['date'] }}
                                </span>
                                <h3 class="font-serif text-xl font-semibold text-lestari-ivory">{{ $story['title'] }}</h3>
                                <p class="text-xs text-lestari-cream/80 font-light leading-relaxed mt-1">
                                    {{ $story['text'] }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <!-- ============================================================== -->
            <!-- SECTION 6: GALERI FOTO (GALLERY)                               -->
            <!-- ============================================================== -->
            @if(!empty($gallery))
            <section id="galeri" class="anim-section nav-section relative py-14 px-5 text-center overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;">
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/94 to-[#080402] pointer-events-none"></div>

                <!-- Royal Section Transition Crest & Divider -->
                <div class="sec-assemble-section-divider relative z-20 flex items-center justify-center gap-3 max-w-[280px] mx-auto mb-6 pointer-events-none">
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-transparent via-[#D9AA45]/50 to-[#D9AA45]"></div>
                    <div class="flex items-center gap-1.5 px-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                        <img src="{{ $getAsset('royal-gold-crest.png') }}" class="w-6 h-auto object-contain filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Crest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                    </div>
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D9AA45] via-[#D9AA45]/50 to-transparent"></div>
                </div>

                <div class="relative z-10">
                    <div class="sec-assemble-title mb-8">
                        <p class="font-cinzel text-[9.5px] uppercase tracking-[0.35em] text-[#F5D38A] font-semibold">KENANGAN ENDAH</p>
                        <h2 class="font-serif text-3xl font-medium gold-foil mt-0.5">Galeri Bahagia</h2>
                        <div class="sec-assemble-divider w-28 h-auto mx-auto mt-2 opacity-90">
                            <img src="{{ $getAsset('lestari-06-divider.png') }}" class="w-full h-full object-contain filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" alt="Divider Keraton">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3.5 max-w-sm mx-auto">
                        @foreach($gallery as $gIndex => $imgUrl)
                        <div 
                            @click="lightboxImg = '{{ $imgUrl }}'"
                            class="sec-assemble-gallery sec-assemble-gallery-{{ $gIndex % 6 }} relative group aspect-[3/4] rounded-2xl overflow-hidden border border-[#D9AA45]/40 bg-[#1a100a] cursor-pointer shadow-[0_8px_20px_rgba(0,0,0,0.85)] hover:border-[#F5D38A] transition-all"
                        >
                            <img src="{{ $imgUrl }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 filter brightness-[0.95]" alt="Gallery">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center p-3">
                                <span class="font-cinzel text-[8.5px] uppercase tracking-widest text-lestari-lightgold">Perbesar</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- ============================================================== -->
            <!-- SECTION 7: TANDA KASIH (WEDDING GIFT)                          -->
            <!-- ============================================================== -->
            @if(!empty($gifts))
            <section id="hadiah" class="anim-section nav-section relative py-14 px-5 text-center overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;" x-data="{ openGifts: false }">
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/94 to-[#080402] pointer-events-none"></div>

                <!-- Royal Section Transition Crest & Divider -->
                <div class="sec-assemble-section-divider relative z-20 flex items-center justify-center gap-3 max-w-[280px] mx-auto mb-6 pointer-events-none">
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-transparent via-[#D9AA45]/50 to-[#D9AA45]"></div>
                    <div class="flex items-center gap-1.5 px-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                        <img src="{{ $getAsset('royal-gold-crest.png') }}" class="w-6 h-auto object-contain filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Crest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                    </div>
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D9AA45] via-[#D9AA45]/50 to-transparent"></div>
                </div>

                <div class="relative z-10">
                    <div class="sec-assemble-title mb-6">
                        <p class="font-cinzel text-[9.5px] uppercase tracking-[0.35em] text-[#F5D38A] font-semibold">TANDA TRESNA</p>
                        <h2 class="font-serif text-3xl font-medium gold-foil mt-0.5">Tanda Kasih</h2>
                        <div class="sec-assemble-divider w-28 h-auto mx-auto mt-2 opacity-90">
                            <img src="{{ $getAsset('lestari-06-divider.png') }}" class="w-full h-full object-contain filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" alt="Divider Keraton">
                        </div>
                        <p class="sec-assemble-text-up text-xs text-lestari-muted font-light max-w-xs mx-auto mt-2 leading-relaxed">
                            Doa restu panjenengan sami punika dados kado ingkang paling aji. Menawi kepareng paring tanda tresna lumantar rekening menika:
                        </p>
                    </div>

                    <button 
                        @click="openGifts = !openGifts"
                        class="sec-assemble-gift-btn inline-flex items-center gap-2 px-7 py-2.5 rounded-full border border-lestari-gold/60 bg-[#1b1109] hover:border-lestari-lightgold text-lestari-lightgold font-cinzel text-xs uppercase tracking-wider shadow-lg transition-all"
                    >
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.1 0 2-.89 2-2V8c0-1.1-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1Z"/></svg>
                        <span x-text="openGifts ? 'Tutup Rekening' : 'Amplop Digital / Rekening'">Amplop Digital / Rekening</span>
                    </button>

                    <div 
                        x-show="openGifts" 
                        x-cloak 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="mt-5 space-y-3.5 max-w-sm mx-auto"
                    >
                        @foreach($gifts as $gift)
                        <div class="sec-assemble-card relative rounded-2xl p-6 glass-card text-left shadow-xl border border-[#D9AA45]/40 overflow-hidden">
                            <!-- 4 Corner ornaments (Enlarged & Prominent) -->
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tl absolute -top-1 -left-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tr absolute -top-1 -right-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-x-[-1]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-bl absolute -bottom-1 -left-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-y-[-1]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-br absolute -bottom-1 -right-1 w-12 h-12 sm:w-14 sm:h-14 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-[-1]" alt="Corner">

                            <div class="relative z-10">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-cinzel text-xs font-bold text-lestari-lightgold uppercase tracking-wider">{{ $gift['bank'] }}</span>
                                    <svg class="w-4 h-4 text-lestari-gold opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <p class="font-serif text-2xl font-bold tracking-wider gold-foil mb-0.5">{{ $gift['account'] }}</p>
                                <p class="text-xs text-lestari-muted font-light mb-3">a.n {{ $gift['name'] }}</p>

                                <button 
                                    @click="copyToClipboard('{{ $gift['account'] }}')"
                                    class="w-full py-2 rounded-xl border border-lestari-gold/40 bg-[#140b07] hover:bg-lestari-gold hover:text-[#150d08] text-lestari-lightgold text-xs font-cinzel font-semibold tracking-wider transition-colors flex items-center justify-center gap-1.5 shadow"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                    <span>Salin No. Rekening</span>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- ============================================================== -->
            <!-- SECTION 8: RSVP & BUKU TAMU (GUEST BOOK)                       -->
            <!-- ============================================================== -->
            <section id="rsvp" class="anim-section nav-section relative py-14 px-5 text-center overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;">
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/94 to-[#080402] pointer-events-none"></div>

                <!-- Royal Section Transition Crest & Divider -->
                <div class="sec-assemble-section-divider relative z-20 flex items-center justify-center gap-3 max-w-[280px] mx-auto mb-6 pointer-events-none">
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-transparent via-[#D9AA45]/50 to-[#D9AA45]"></div>
                    <div class="flex items-center gap-1.5 px-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                        <img src="{{ $getAsset('royal-gold-crest.png') }}" class="w-6 h-auto object-contain filter drop-shadow-[0_2px_8px_rgba(217,170,69,0.5)]" alt="Crest">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D9AA45]/70"></span>
                    </div>
                    <div class="flex-1 h-[1px] bg-gradient-to-r from-[#D9AA45] via-[#D9AA45]/50 to-transparent"></div>
                </div>

                <div class="relative z-10">
                    <div class="sec-assemble-title mb-8">
                        <p class="font-cinzel text-[9.5px] uppercase tracking-[0.35em] text-[#F5D38A] font-semibold">PANGUCAP & DONGA</p>
                        <h2 class="font-serif text-3xl font-medium gold-foil mt-0.5">RSVP & Ucapan</h2>
                        <div class="sec-assemble-divider w-28 h-auto mx-auto mt-2 opacity-90">
                            <img src="{{ $getAsset('lestari-06-divider.png') }}" class="w-full h-full object-contain filter drop-shadow-[0_2px_6px_rgba(0,0,0,0.8)]" alt="Divider Keraton">
                        </div>
                    </div>

                    <div 
                        class="max-w-sm mx-auto"
                        x-data="rsvpForm"
                    >
                        <!-- Form Card with Royal Assembly and Corner Filigrees (Enlarged & Prominent) -->
                        <div class="sec-assemble-card rounded-3xl p-6 glass-card text-left shadow-[0_15px_40px_rgba(0,0,0,0.85)] border border-[#D9AA45]/40 mb-6 relative overflow-hidden">
                            <!-- 4 Corner ornaments (Enlarged & Prominent) -->
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tl absolute -top-1 -left-1 w-14 h-14 sm:w-16 sm:h-16 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-tr absolute -top-1 -right-1 w-14 h-14 sm:w-16 sm:h-16 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-x-[-1]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-bl absolute -bottom-1 -left-1 w-14 h-14 sm:w-16 sm:h-16 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-y-[-1]" alt="Corner">
                            <img src="{{ $getAsset('lestari-07-corner-ornament.png') }}" class="sec-assemble-corner-br absolute -bottom-1 -right-1 w-14 h-14 sm:w-16 sm:h-16 object-contain opacity-85 pointer-events-none filter drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)] transform scale-[-1]" alt="Corner">

                            <form @submit.prevent="sendWish" class="space-y-3.5 relative z-10">
                                <div>
                                    <label class="block font-cinzel text-[9px] uppercase tracking-[0.2em] text-lestari-lightgold mb-1 font-semibold">Nama Lengkap</label>
                                    <input 
                                        type="text" 
                                        x-model="name" 
                                        required 
                                        placeholder="Nama Anda" 
                                        class="w-full bg-[#0d0704] border border-lestari-gold/30 rounded-xl px-3.5 py-2 text-xs text-lestari-cream placeholder-lestari-muted/50 focus:outline-none focus:border-lestari-gold"
                                    >
                                </div>

                                <div>
                                    <label class="block font-cinzel text-[9px] uppercase tracking-[0.2em] text-lestari-lightgold mb-1 font-semibold">Konfirmasi Kehadiran</label>
                                    <select 
                                        x-model="status" 
                                        class="w-full bg-[#0d0704] border border-lestari-gold/30 rounded-xl px-3.5 py-2 text-xs text-lestari-cream focus:outline-none focus:border-lestari-gold"
                                    >
                                        <option value="Hadir">Hadir Memenuhi Undangan</option>
                                        <option value="Tidak Hadir">Berhalangan Hadir</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-cinzel text-[9px] uppercase tracking-[0.2em] text-lestari-lightgold mb-1 font-semibold">Doa & Ucapan</label>
                                    <textarea 
                                        x-model="message" 
                                        required 
                                        rows="3" 
                                        placeholder="Tulis ucapan & doa restu..." 
                                        class="w-full bg-[#0d0704] border border-lestari-gold/30 rounded-xl px-3.5 py-2 text-xs text-lestari-cream placeholder-lestari-muted/50 focus:outline-none focus:border-lestari-gold resize-none"
                                    ></textarea>
                                </div>

                                <button 
                                    type="submit" 
                                    class="sec-assemble-btn btn-buka-reference w-full py-2.5 rounded-xl text-[#F7EBD5] font-cinzel font-bold text-xs uppercase tracking-wider shadow-lg transition-all"
                                >
                                    Kirim Ucapan
                                </button>

                                <p x-show="submitted" x-cloak class="text-xs text-green-400 text-center font-medium mt-1">Matur nuwun, ucapan sampun kakintun.</p>
                            </form>
                        </div>

                        <!-- Wishes Stream Cascades In -->
                        <div class="sec-assemble-wishes text-left space-y-2.5 max-h-64 overflow-y-auto pr-1 hide-scrollbar">
                            <template x-for="(w, idx) in wishesList" :key="idx">
                                <div class="p-3.5 rounded-xl border border-lestari-gold/20 bg-[#180f0a]/80 backdrop-blur-sm shadow">
                                    <div class="flex items-center justify-between mb-1">
                                        <h4 class="font-serif text-sm font-semibold text-lestari-lightgold" x-text="w.name"></h4>
                                        <span 
                                            class="text-[8px] px-2 py-0.5 rounded-full font-cinzel uppercase tracking-wider font-semibold"
                                            :class="w.status === 'Hadir' ? 'bg-green-900/60 text-green-300 border border-green-600/40' : 'bg-red-900/60 text-red-300 border border-red-600/40'"
                                            x-text="w.status"
                                        ></span>
                                    </div>
                                    <p class="text-xs text-lestari-cream/90 font-light leading-relaxed italic" x-text="'&quot;' + w.message + '&quot;'"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================== -->
            <!-- SECTION 9: FOOTER                                              -->
            <!-- ============================================================== -->
            <footer id="penutup" class="anim-section nav-section relative pt-12 pb-24 px-5 text-center border-t border-lestari-gold/20 overflow-hidden" style="background: #0d0604 url('{{ $getAsset('lestari-05-kawung-tile.png') }}') center center / 280px repeat;">
                <div class="absolute inset-0 bg-gradient-to-b from-[#080402] via-[#0d0604]/94 to-[#080402] pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="sec-assemble-gunungan mx-auto w-16 h-20 mb-3 opacity-90">
                        <img src="{{ $getAsset('gunungan-wayang-gold.png') }}" class="w-full h-full object-contain idle-float-gunungan filter drop-shadow-[0_4px_12px_rgba(217,170,69,0.35)]" alt="Gunungan Emas">
                    </div>
                    <p class="sec-assemble-title font-cinzel text-[9.5px] tracking-[0.38em] text-lestari-lightgold uppercase font-medium">MATUR NUWUN</p>
                    <h2 class="sec-assemble-text-up font-serif text-2xl font-medium gold-foil my-1">{{ $couple['bride'] }} & {{ $couple['groom'] }}</h2>
                    <p class="sec-assemble-text-up text-xs text-lestari-muted font-light">Sembah nuwun awit donga pangestu panjenengan sami.</p>
                    <p class="text-[9px] text-lestari-muted/50 mt-6 font-light">Temuruang Digital Wedding Invitation</p>
                </div>
            </footer>

        </main>

        <!-- ============================================================== -->
        <!-- 3. MOBILE BOTTOM NAVIGATION (CLAMPED TO SHELL)                 -->
        <!-- ============================================================== -->
        <div 
            x-show="isOpen" 
            x-cloak
            class="clamped-shell-float bottom-0 z-40 transition-transform duration-500"
        >
            <div class="mx-3.5 mb-3 rounded-full bg-[#140b07]/90 backdrop-blur-md border border-[#D4AF37]/35 shadow-[0_12px_30px_rgba(0,0,0,0.9)] px-4 py-2 flex justify-around items-center text-[8.5px] font-cinzel uppercase tracking-wider font-semibold">
                
                <a 
                    @click="document.getElementById('hero').scrollIntoView({behavior: 'smooth'})" 
                    class="cursor-pointer flex flex-col items-center p-1 gap-1 transition-colors duration-300" 
                    :class="activeSection === 'hero' ? 'text-lestari-lightgold font-bold scale-105' : 'text-lestari-muted hover:text-lestari-lightgold'"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                    <span>Sampul</span>
                </a>
                
                <a 
                    @click="document.getElementById('mempelai').scrollIntoView({behavior: 'smooth'})" 
                    class="cursor-pointer flex flex-col items-center p-1 gap-1 transition-colors duration-300" 
                    :class="activeSection === 'mempelai' ? 'text-lestari-lightgold font-bold scale-105' : 'text-lestari-muted hover:text-lestari-lightgold'"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span>Mempelai</span>
                </a>
                
                <a 
                    @click="document.getElementById('acara').scrollIntoView({behavior: 'smooth'})" 
                    class="cursor-pointer flex flex-col items-center p-1 gap-1 transition-colors duration-300" 
                    :class="activeSection === 'acara' ? 'text-lestari-lightgold font-bold scale-105' : 'text-lestari-muted hover:text-lestari-lightgold'"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                    <span>Acara</span>
                </a>
                
                <a 
                    @click="document.getElementById('galeri').scrollIntoView({behavior: 'smooth'})" 
                    class="cursor-pointer flex flex-col items-center p-1 gap-1 transition-colors duration-300" 
                    :class="activeSection === 'galeri' ? 'text-lestari-lightgold font-bold scale-105' : 'text-lestari-muted hover:text-lestari-lightgold'"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg>
                    <span>Galeri</span>
                </a>

                <a 
                    @click="document.getElementById('rsvp').scrollIntoView({behavior: 'smooth'})" 
                    class="cursor-pointer flex flex-col items-center p-1 gap-1 transition-colors duration-300" 
                    :class="activeSection === 'rsvp' ? 'text-lestari-lightgold font-bold scale-105' : 'text-lestari-muted hover:text-lestari-lightgold'"
                >
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12zM7 9h10v2H7zm0-3h10v2H7zm0 6h7v2H7z"/></svg>
                    <span>RSVP</span>
                </a>

            </div>
        </div>

    </div>

</div>

<!-- AOS JS Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>
