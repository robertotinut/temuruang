@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Haris');
        $brideName = trim($names[1] ?? 'Anisa');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Surono & Ibu Sri Mulyani',
                'bride' => 'Bapak Budi & Ibu Siti',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-12-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '09:00',
            'location' => $invitation->location ?? 'Omah Kawangan',
            'address' => $invitation->address ?? 'Depan Asrama Brimob Boyolali, Kawangan, Boyolali',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Omah Kawangan, Boyolali'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '09:00') . ' - 10:30 WIB',
                'note' => $invitation->location ?? 'Omah Kawangan'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '11:00 - 15:00 WIB',
                'note' => $invitation->address ?? 'Depan Asrama Brimob Boyolali, Kawangan, Boyolali'
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
                ['title' => 'Pertama Bertemu', 'date' => '09 Jan 2021', 'text' => 'Kami dipertemukan oleh seorang teman dekat, lalu mulai bertukar cerita dan merasa cocok.'],
                ['title' => 'Mengikat Janji', 'date' => '25 Agt 2022', 'text' => 'Kami sepakat untuk melangkah ke jenjang yang lebih serius dengan pertunangan disaksikan keluarga.'],
                ['title' => 'Hari Bahagia', 'date' => '12 Des 2026', 'text' => 'Kami mengikat janji suci kami dalam ikatan pernikahan yang sah dan memulai babak baru.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400'
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800';
        $bg = [
            'cover' => $coverUrl,
            'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400',
            'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
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
                ['name' => 'Keluarga Budi', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Haris & Anisa! Semoga sakinah mawaddah warahmah.'],
                ['name' => 'Siti Aminah', 'status' => 'Hadir', 'message' => 'Lancar-lancar acaranya ya, turut bahagia.'],
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
                ['bank' => 'BCA', 'name' => 'Haris', 'account' => '123-456-7890'],
                ['bank' => 'Mandiri', 'name' => 'Anisa', 'account' => '987-654-3210'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Haris',
            'bride' => 'Anisa',
            'parents' => [
                'groom' => 'Bapak Surono & Ibu Sri Mulyani',
                'bride' => 'Bapak Budi & Ibu Siti',
            ],
        ];

        $event = [
            'date_iso' => '2026-12-12',
            'time' => '09:00',
            'location' => 'Omah Kawangan',
            'address' => 'Depan Asrama Brimob Boyolali, Kawangan, Boyolali',
            'maps_url' => 'https://maps.google.com/?q=Boyolali',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '09:00 - 10:30', 'note' => 'Lokasi Acara, Omah Kawangan'],
            ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - 15:00', 'note' => 'Lokasi Acara, Omah Kawangan'],
        ];

        $stories = [
            ['title' => 'Pertama Bertemu', 'date' => '09 Jan 2021', 'text' => 'Kami dipertemukan oleh seorang teman dekat, lalu mulai bertukar cerita dan merasa cocok.'],
            ['title' => 'Mengikat Janji', 'date' => '25 Agt 2022', 'text' => 'Kami sepakat untuk melangkah ke jenjang yang lebih serius dengan pertunangan disaksikan keluarga.'],
            ['title' => 'Hari Bahagia', 'date' => '12 Des 2026', 'text' => 'Kami mengikat janji suci kami dalam ikatan pernikahan yang sah dan memulai babak baru.'],
        ];

        $gallery = [
            'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
            'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
            'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400'
        ];

        $bg = [
            'cover' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800',
            'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400',
            'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
        ];

        $wishes = [
            ['name' => 'Keluarga Budi', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Haris & Anisa! Semoga sakinah mawaddah warahmah.'],
            ['name' => 'Siti Aminah', 'status' => 'Hadir', 'message' => 'Lancar-lancar acaranya ya, turut bahagia.'],
        ];

        $gifts = [
            ['bank' => 'BCA', 'name' => 'Haris', 'account' => '123-456-7890'],
            ['bank' => 'Mandiri', 'name' => 'Anisa', 'account' => '987-654-3210'],
        ];

        $musicUrl = asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $couple['bride'] }} & {{ $couple['groom'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons & Animation stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --emerald: #0b2e1e; /* Rich Royal Emerald Green */
            --emerald-light: #164a34;
            --emerald-transparent: rgba(11, 46, 30, 0.85);
            --gold: #d4af37; /* Champagne Gold */
            --gold-light: #f3e5ab;
            --gold-gradient: linear-gradient(135deg, #b38728, #fbf5b7, #daaf38, #aa771c);
            --cream: #faf8f5; /* Premium soft cream background */
            --glass-bg: rgba(255, 255, 255, 0.72);
            --glass-border: rgba(212, 175, 55, 0.28);
            --text-dark: #1f2d26;
            --text-light: #526359;
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Great Vibes', cursive;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            background-color: #05140d;
            color: var(--text-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Mobile Wrapper */
        .wrapper {
            width: 100%;
            max-width: 480px;
            background: var(--cream);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 50px rgba(0,0,0,0.8);
            padding: 20px 18px 95px 18px; /* space for bottom floating nav */
            z-index: 1;
        }

        /* Dual gold-embossed fine frames */
        .inner-wrapper {
            border: 1.5px solid var(--gold);
            outline: 1.5px solid rgba(212, 175, 55, 0.45);
            outline-offset: -6px;
            min-height: calc(100vh - 40px);
            width: 100%;
            border-radius: 12px;
            position: relative;
            padding: 10px;
            background: rgba(250, 248, 245, 0.4);
            backdrop-filter: blur(2px);
        }

        /* 3D Gate-Fold Cover Page Overlay */
        #cover {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            height: 100vh;
            z-index: 9999;
            background: linear-gradient(rgba(11, 46, 30, 0.93), rgba(11, 46, 30, 0.97)), 
                        url("{{ $bg['cover'] }}") center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 50px 20px;
            text-align: center;
            transition: transform 1.5s cubic-bezier(0.77, 0, 0.175, 1), opacity 1.5s;
            overflow: hidden;
        }

        #cover.hide-cover {
            transform: translate(-50%, -100vh);
            opacity: 0;
            pointer-events: none;
        }

        .gate-container {
            position: relative;
            width: 300px;
            height: 380px;
            margin: auto;
            perspective: 1200px;
            transform-style: preserve-3d;
        }

        .gate-left, .gate-right {
            position: absolute;
            top: 0;
            width: 150px;
            height: 100%;
            background: var(--emerald-light);
            border: 2px solid var(--gold);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            z-index: 3;
            transform-style: preserve-3d;
            transition: transform 1.6s cubic-bezier(0.77, 0, 0.175, 1);
            overflow: hidden;
        }

        .gate-left {
            left: 0;
            border-right: 1px solid var(--gold);
            transform-origin: left;
            border-radius: 12px 0 0 12px;
        }

        .gate-right {
            right: 0;
            border-left: 1px solid var(--gold);
            transform-origin: right;
            border-radius: 0 12px 12px 0;
        }

        /* Golden vine/pattern overlays inside the gate doors */
        .gate-pattern {
            position: absolute;
            inset: 8px;
            border: 1px dashed rgba(212, 175, 55, 0.4);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .gate-left .gate-pattern {
            border-right: none;
            border-radius: 8px 0 0 8px;
        }

        .gate-right .gate-pattern {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        /* Inner invite letter card */
        .gate-letter {
            position: absolute;
            top: 15px;
            left: 15px;
            width: 270px;
            height: 350px;
            background: white;
            border: 2.5px double var(--gold);
            border-radius: 8px;
            z-index: 1;
            transform: translateZ(-30px) scale(0.95);
            opacity: 0;
            transition: transform 1.4s cubic-bezier(0.77, 0, 0.175, 1), opacity 1.4s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        /* Wax seal crest */
        .gate-crest {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 65px;
            height: 65px;
            background: var(--gold-gradient);
            border-radius: 50%;
            border: 2px solid white;
            z-index: 10;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s ease;
        }

        .gate-crest::before {
            content: '';
            position: absolute;
            inset: 3px;
            border: 1px dashed rgba(255,255,255,0.6);
            border-radius: 50%;
        }

        .gate-crest span {
            font-family: var(--font-serif);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--emerald);
            letter-spacing: 0.5px;
        }

        /* Open states */
        .gate-container.opened .gate-left {
            transform: rotateY(-115deg);
        }

        .gate-container.opened .gate-right {
            transform: rotateY(115deg);
        }

        .gate-container.opened .gate-letter {
            transform: translateZ(40px) scale(1.03);
            opacity: 1;
            z-index: 5;
        }

        .gate-container.opened .gate-crest {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.4);
            pointer-events: none;
        }

        .open-instruction {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gold-light);
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .tapping-hand {
            font-size: 1.8rem;
            animation: tap 1.5s infinite ease-in-out;
        }

        @keyframes tap {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-8px) scale(0.95); }
        }

        /* Leaf Corner Ornaments extending into frame */
        .corner-ornament {
            position: absolute;
            width: 70px;
            height: 70px;
            z-index: 5;
            pointer-events: none;
        }

        .corner-tl { top: 0; left: 0; fill: var(--gold); }
        .corner-tr { top: 0; right: 0; transform: scaleX(-1); fill: var(--gold); }
        .corner-bl { bottom: 0; left: 0; transform: scaleY(-1); fill: var(--gold); }
        .corner-br { bottom: 0; right: 0; transform: scale(-1); fill: var(--gold); }

        /* General Sections */
        section {
            padding: 60px 10px;
            position: relative;
            text-align: center;
        }

        .section-subtitle {
            font-size: 0.75rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 8px;
            font-weight: 600;
            display: block;
        }

        .section-title {
            font-family: var(--font-serif);
            font-size: 2.1rem;
            color: var(--emerald);
            margin-bottom: 25px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2.5px;
        }

        /* Hero section central monogram woven with gold leaves */
        .names-monogram {
            position: relative;
            width: 100%;
            height: 320px;
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .monogram-bg-circle {
            position: absolute;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(212, 175, 55, 0.25);
            border-radius: 50%;
            z-index: 0;
        }

        .initial-graphic {
            position: absolute;
            width: 170px;
            height: 170px;
            opacity: 0.18;
            z-index: 1;
            pointer-events: none;
            color: var(--gold);
        }

        .initial-pos-1 { top: 10px; left: 18%; }
        .initial-pos-2 { bottom: 10px; right: 18%; }

        .script-name-overlap {
            font-family: var(--font-script);
            font-size: 3.5rem;
            color: var(--emerald);
            z-index: 2;
            position: relative;
            text-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .name-1 { margin-top: -30px; margin-left: -40px; }
        .name-2 { margin-top: 30px; margin-right: -40px; }

        .union-text {
            font-family: var(--font-sans);
            font-size: 0.72rem;
            color: var(--text-light);
            letter-spacing: 4px;
            text-transform: uppercase;
            margin: 5px 0;
            z-index: 2;
        }

        /* Countdown display styled as elegant circular outline rings */
        .countdown-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 35px 0 25px;
        }

        .countdown-ring {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            border: 1.5px solid var(--gold);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: white;
            box-shadow: 0 4px 12px rgba(11, 46, 30, 0.05);
        }

        .countdown-num {
            font-family: var(--font-serif);
            font-size: 1.35rem;
            color: var(--emerald);
            line-height: 1.1;
            font-weight: 600;
        }

        .countdown-lbl {
            font-size: 0.58rem;
            text-transform: uppercase;
            color: var(--text-light);
            letter-spacing: 1px;
            margin-top: 2px;
        }

        /* Pill Navy/Gold Buttons */
        .btn-pill-emerald {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--emerald);
            color: white;
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            border: 1px solid var(--gold);
            box-shadow: 0 6px 15px rgba(11, 46, 30, 0.25);
            transition: all 0.3s;
            margin-top: 20px;
        }
        .btn-pill-emerald:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(11, 46, 30, 0.35);
        }

        /* Dual Intersecting gold Arch frames for couple intro */
        .floral-arch-header {
            width: 100%;
            max-width: 250px;
            margin: 0 auto 30px auto;
        }

        .arch-svg {
            width: 100%;
            height: auto;
        }

        .couple-wrapper {
            margin: 40px auto;
            max-width: 320px;
            text-align: center;
        }

        .arch-photo-container {
            width: 155px;
            height: 230px;
            border-radius: 50% / 35% 35% 65% 65%;
            margin: 0 auto 20px auto;
            overflow: hidden;
            border: 2px solid var(--gold);
            padding: 5px;
            background: white;
            box-shadow: 0 8px 25px rgba(11, 46, 30, 0.1);
        }

        .arch-photo-container img {
            width: 100%;
            height: 100%;
            border-radius: 50% / 35% 35% 65% 65%;
            object-fit: cover;
        }

        .mempelai-nama {
            font-family: var(--font-script);
            font-size: 2.8rem;
            color: var(--emerald);
            margin-bottom: 5px;
        }

        .mempelai-parent {
            font-family: var(--font-serif);
            font-style: italic;
            font-size: 0.95rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Glassmorphic Cards and Grids */
        .event-box {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 35px 22px;
            box-shadow: 0 8px 32px rgba(11, 46, 30, 0.04);
            margin-bottom: 30px;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .event-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gold-gradient);
            border-radius: 16px 16px 0 0;
        }

        .event-box h3 {
            font-family: var(--font-serif);
            font-size: 1.45rem;
            color: var(--emerald);
            margin-bottom: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .event-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(11, 46, 30, 0.05);
            border: 1px solid rgba(212, 175, 55, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            color: var(--emerald);
            font-size: 1.3rem;
        }

        /* Editorial Calendar block */
        .editorial-date-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
        }
        .ed-day-name, .ed-month-name {
            font-family: var(--font-sans);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--emerald);
            flex: 1;
        }
        .ed-day-name { text-align: right; }
        .ed-month-name { text-align: left; }
        .ed-center-box { text-align: center; }
        .ed-date-num {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-weight: 600;
            color: white;
            background: var(--emerald);
            border: 1.5px solid var(--gold);
            padding: 6px 15px;
            display: inline-block;
            line-height: 1;
            margin-bottom: 5px;
            border-radius: 4px;
        }
        .ed-year-num {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: var(--text-light);
        }

        /* Interactive Story Slider */
        .story-slider-container {
            position: relative;
            width: 100%;
            max-width: 360px;
            margin: 0 auto;
            padding: 10px;
        }

        .story-slider {
            position: relative;
            height: 260px;
            width: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .story-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: scale(0.9) translateX(50px);
            pointer-events: none;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .story-slide.active {
            opacity: 1;
            transform: scale(1) translateX(0);
            pointer-events: auto;
            z-index: 2;
        }

        .story-slide.prev-slide {
            opacity: 0;
            transform: scale(0.9) translateX(-50px);
            pointer-events: none;
        }

        .story-card-inner {
            background: var(--glass-bg);
            border: 1.5px solid var(--glass-border);
            border-radius: 18px;
            padding: 25px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: 0 8px 30px rgba(11, 46, 30, 0.04);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .story-card-inner::after {
            content: '';
            position: absolute;
            inset: 8px;
            border: 1px dashed rgba(212, 175, 55, 0.25);
            border-radius: 12px;
            pointer-events: none;
        }

        .story-card-decoration {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(212, 175, 55, 0.15);
            border: 1px solid rgba(212, 175, 55, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .story-card-heart {
            color: var(--gold);
            font-size: 1.1rem;
            animation: pulseHeart 2s infinite ease-in-out;
        }

        @keyframes pulseHeart {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }

        .story-card-date {
            font-family: var(--font-sans);
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--gold);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .story-card-title {
            font-family: var(--font-serif);
            font-size: 1.35rem;
            color: var(--emerald);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .story-card-divider {
            width: 40px;
            height: 1.5px;
            background: var(--gold-gradient);
            margin: 6px auto 12px auto;
        }

        .story-card-desc {
            font-size: 0.78rem;
            color: var(--text-light);
            line-height: 1.6;
            max-width: 280px;
        }

        /* Controls styling */
        .story-slider-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }

        .btn-story-nav {
            background: var(--emerald);
            border: 1px solid var(--gold);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(11, 46, 30, 0.15);
            transition: all 0.3s;
        }

        .btn-story-nav:hover {
            background: var(--emerald-light);
            transform: scale(1.05);
        }

        .story-dots {
            display: flex;
            gap: 8px;
        }

        .story-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(11, 46, 30, 0.2);
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.3s;
        }

        .story-dot.active {
            background: var(--gold);
            transform: scale(1.2);
            box-shadow: 0 0 6px rgba(212, 175, 55, 0.5);
        }

        /* Modern Asymmetrical Collage Gallery */
        .gallery-collage {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .gallery-collage-item {
            position: relative;
            overflow: hidden;
            border: 2px solid var(--gold);
            background: white;
            padding: 4px;
            box-shadow: 0 8px 25px rgba(11, 46, 30, 0.05);
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .gallery-collage-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .gallery-collage-item:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.2);
        }

        .gallery-collage-item:hover img {
            transform: scale(1.08);
        }

        /* Shape 1: Tall Arch (Kubah) */
        .collage-shape-1 {
            grid-row: span 2;
            height: 270px;
            border-radius: 150px 150px 12px 12px;
        }
        .collage-shape-1 img {
            border-radius: 150px 150px 8px 8px;
        }

        /* Shape 2: Perfect Circle */
        .collage-shape-2 {
            height: 127px;
            border-radius: 50%;
        }
        .collage-shape-2 img {
            border-radius: 50%;
        }

        /* Shape 3: Organic Leaf */
        .collage-shape-3 {
            height: 127px;
            border-radius: 80px 12px 80px 12px;
        }
        .collage-shape-3 img {
            border-radius: 76px 8px 76px 8px;
        }

        /* Shape 4: Pill/Pillow shape */
        .collage-shape-4 {
            grid-column: span 2;
            height: 140px;
            border-radius: 50px / 25px;
        }
        .collage-shape-4 img {
            border-radius: 46px / 21px;
        }

        /* Dompet / Gift block */
        .gift-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 30px 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.02);
            margin-top: 25px;
            backdrop-filter: blur(10px);
        }

        .btn-copy {
            background-color: var(--emerald);
            color: white;
            border: 1px solid var(--gold);
            padding: 10px 22px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 15px;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(11, 46, 30, 0.15);
            transition: all 0.3s;
        }
        .btn-copy:hover {
            background-color: var(--emerald-light);
        }

        /* RSVP Form */
        .form-wrap {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 30px 20px;
            text-align: left;
            box-shadow: 0 6px 20px rgba(0,0,0,0.02);
            backdrop-filter: blur(10px);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--emerald);
            margin-bottom: 6px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid rgba(212, 175, 55, 0.25);
            border-radius: 8px;
            font-size: 0.85rem;
            background-color: white;
            font-family: var(--font-sans);
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            border-color: var(--emerald);
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--emerald);
            color: white;
            border: 1px solid var(--gold);
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 2px;
            box-shadow: 0 4px 12px rgba(11, 46, 30, 0.2);
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: var(--emerald-light);
        }

        .wish-list {
            max-height: 250px;
            overflow-y: auto;
            margin-top: 25px;
        }
        .wish-card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            border-left: 4px solid var(--gold);
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
            border-top: 1px solid rgba(212, 175, 55, 0.1);
            border-right: 1px solid rgba(212, 175, 55, 0.1);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }
        .wish-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 0.8rem;
        }
        .wish-name {
            font-weight: 600;
            color: var(--emerald);
        }
        .wish-status {
            background: rgba(11, 46, 30, 0.05);
            color: var(--emerald);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.65rem;
            font-weight: 500;
        }
        .wish-content {
            font-size: 0.78rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Floating Bottom Nav - Emerald & Gold Ring buttons */
        .bottom-nav-emerald {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 440px;
            background: var(--emerald-transparent);
            border-radius: 40px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 12px;
            box-shadow: 0 8px 32px rgba(11, 46, 30, 0.3);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, visibility 0.5s;
            border: 1px solid rgba(212, 175, 55, 0.25);
            backdrop-filter: blur(12px);
        }

        .bottom-nav-emerald.visible {
            opacity: 1;
            visibility: visible;
        }

        .nav-item-ring {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1.5px solid rgba(212, 175, 55, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold-light);
            text-decoration: none;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-item-ring i {
            font-size: 1.05rem;
        }

        .nav-item-ring.active {
            background: var(--gold-gradient);
            color: var(--emerald);
            border-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* Floater vinyl container */
        .floater-container {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            height: 0;
            z-index: 1000;
            pointer-events: none;
        }

        .scroll-control-emerald {
            position: absolute;
            bottom: 165px;
            right: 20px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--emerald);
            box-shadow: 0 6px 18px rgba(11, 46, 30, 0.25);
            border: 1.5px solid var(--gold);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            pointer-events: auto;
            transition: all 0.5s ease;
        }

        .scroll-control-emerald.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-control-emerald i {
            font-size: 1.1rem;
            color: white;
        }

        .scroll-control-emerald.active i {
            animation: bounce 1.5s infinite;
        }

        .scroll-badge-emerald {
            position: absolute;
            right: 55px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--emerald);
            color: white;
            font-size: 0.6rem;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            pointer-events: none;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid var(--gold);
        }

        /* Vinyl Record Player Control */
        .music-vinyl-player {
            position: absolute;
            bottom: 95px;
            right: 20px;
            width: 50px;
            height: 50px;
            pointer-events: auto;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .music-vinyl-player.visible {
            opacity: 1;
            visibility: visible;
        }

        .vinyl-disc {
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, #222 30%, #050505 60%, #222 70%, #050505 100%);
            border-radius: 50%;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4), inset 0 0 0 2px rgba(255,255,255,0.05);
            position: relative;
            cursor: pointer;
            transition: transform 0.3s;
        }

        /* Record center label */
        .vinyl-label {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16px;
            height: 16px;
            background: var(--gold-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #111;
        }
        .vinyl-label::after {
            content: '';
            width: 4px;
            height: 4px;
            background: #fff;
            border-radius: 50%;
        }

        /* Vinyl arm needle */
        .vinyl-arm {
            position: absolute;
            top: -8px;
            right: -4px;
            width: 20px;
            height: 30px;
            transform-origin: 16px 4px;
            transform: rotate(-35deg);
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            z-index: 1002;
        }

        /* Playing states */
        .music-vinyl-player.playing .vinyl-disc {
            animation: spinDisc 3.5s linear infinite;
        }

        .music-vinyl-player.playing .vinyl-arm {
            transform: rotate(5deg);
        }

        @keyframes spinDisc {
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(4px); }
        }
    </style>
</head>
<body>

    <!-- COVER SCREEN -->
    <div id="cover">
        <!-- Canvas for gold leaves particle animations -->
        <canvas id="canvas-particles" style="position: absolute; inset: 0; width: 100%; height: 100%; pointer-events: none; z-index: 2;"></canvas>

        <div class="cover-header" style="z-index: 5; margin-top: 10px;">
            <p style="letter-spacing: 5px; font-size: 0.75rem; font-weight: 700; color: var(--gold); text-transform: uppercase; margin-bottom: 6px;">The Wedding Of</p>
            <h1 style="font-family: var(--font-script); font-size: 3.5rem; color: var(--gold-light); font-weight: 300; margin: 0; text-shadow: 0 2px 10px rgba(0,0,0,0.4);">{{ $couple['bride'] }} & {{ $couple['groom'] }}</h1>
        </div>

        <!-- 3D Gate-Fold Envelope Container -->
        <div class="gate-container" id="invitationGate">
            <div class="gate-left">
                <div class="gate-pattern">
                    <!-- SVG Gold Leaves stem design left -->
                    <svg viewBox="0 0 100 200" style="width: 80%; height: 80%; opacity: 0.65;">
                        <path d="M 90 20 Q 40 80 90 180" stroke="var(--gold)" stroke-width="1.5" fill="none" />
                        <path d="M 90 50 Q 70 40 55 50" stroke="var(--gold)" stroke-width="1" fill="none" />
                        <path d="M 90 90 Q 60 85 50 100" stroke="var(--gold)" stroke-width="1" fill="none" />
                        <path d="M 90 130 Q 70 125 60 140" stroke="var(--gold)" stroke-width="1" fill="none" />
                        <!-- Leaf buds -->
                        <circle cx="55" cy="50" r="2" fill="var(--gold)" />
                        <circle cx="50" cy="100" r="2" fill="var(--gold)" />
                        <circle cx="60" cy="140" r="2" fill="var(--gold)" />
                    </svg>
                </div>
            </div>
            <div class="gate-right">
                <div class="gate-pattern">
                    <!-- SVG Gold Leaves stem design right -->
                    <svg viewBox="0 0 100 200" style="width: 80%; height: 80%; opacity: 0.65; transform: scaleX(-1);">
                        <path d="M 90 20 Q 40 80 90 180" stroke="var(--gold)" stroke-width="1.5" fill="none" />
                        <path d="M 90 50 Q 70 40 55 50" stroke="var(--gold)" stroke-width="1" fill="none" />
                        <path d="M 90 90 Q 60 85 50 100" stroke="var(--gold)" stroke-width="1" fill="none" />
                        <path d="M 90 130 Q 70 125 60 140" stroke="var(--gold)" stroke-width="1" fill="none" />
                        <!-- Leaf buds -->
                        <circle cx="55" cy="50" r="2" fill="var(--gold)" />
                        <circle cx="50" cy="100" r="2" fill="var(--gold)" />
                        <circle cx="60" cy="140" r="2" fill="var(--gold)" />
                    </svg>
                </div>
            </div>

            <!-- Inner Invitation Letter Card (Guest Card) -->
            <div class="gate-letter">
                <div style="border: 1px solid rgba(212, 175, 55, 0.4); outline: 1px solid rgba(212, 175, 55, 0.2); outline-offset: -4px; width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; border-radius: 4px; padding: 15px;">
                    <p style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; color: var(--gold); font-weight: 600; margin-bottom: 5px;">Kepada Yth.</p>
                    <p style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-light); margin-bottom: 15px;">Bapak/Ibu/Saudara/i</p>
                    <h3 style="font-family: var(--font-serif); font-size: 1.5rem; color: var(--emerald); font-weight: 700; margin: 5px 0;">{{ request()->get('kpd', 'Nama Tamu') }}</h3>
                    <div style="width: 50px; height: 1px; background: var(--gold-gradient); margin: 15px auto;"></div>
                    <p style="font-size: 0.68rem; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-light); margin-bottom: 20px;">di Tempat</p>
                    <span style="font-size: 0.62rem; color: var(--gold); text-transform: uppercase; letter-spacing: 1px;">Tanpa Mengurangi Rasa Hormat</span>
                </div>
            </div>

            <!-- Custom Interactive Wax Seal Crest -->
            <div class="gate-crest" onclick="openGate()">
                <span>{{ substr($couple['bride'], 0, 1) }}&{{ substr($couple['groom'], 0, 1) }}</span>
            </div>
        </div>

        <div class="open-instruction" style="z-index: 5;">
            <span>Ketuk Segel Lilin Untuk Membuka</span>
            <div class="tapping-hand">👆</div>
        </div>
    </div>

    <!-- MAIN INVITATION WRAPPER -->
    <div class="wrapper">
        <div class="inner-wrapper">
            
            <audio id="bg-audio" loop preload="auto">
                <source src="{{ $musicUrl }}" type="audio/mpeg">
            </audio>

            <!-- Fine Gold leaf decorative vector corners inside the frames -->
            <!-- Top Left -->
            <svg class="corner-ornament corner-tl" viewBox="0 0 100 100">
                <path d="M 0 0 L 30 0 A 30 30 0 0 1 0 30 Z" fill="var(--gold)" opacity="0.3"/>
                <path d="M 0 0 Q 35 15 15 45 Q 5 25 0 0" opacity="0.85"/>
            </svg>
            <!-- Top Right -->
            <svg class="corner-ornament corner-tr" viewBox="0 0 100 100">
                <path d="M 0 0 L 30 0 A 30 30 0 0 1 0 30 Z" fill="var(--gold)" opacity="0.3"/>
                <path d="M 0 0 Q 35 15 15 45 Q 5 25 0 0" opacity="0.85"/>
            </svg>
            <!-- Bottom Left -->
            <svg class="corner-ornament corner-bl" viewBox="0 0 100 100">
                <path d="M 0 0 L 30 0 A 30 30 0 0 1 0 30 Z" fill="var(--gold)" opacity="0.3"/>
                <path d="M 0 0 Q 35 15 15 45 Q 5 25 0 0" opacity="0.85"/>
            </svg>
            <!-- Bottom Right -->
            <svg class="corner-ornament corner-br" viewBox="0 0 100 100">
                <path d="M 0 0 L 30 0 A 30 30 0 0 1 0 30 Z" fill="var(--gold)" opacity="0.3"/>
                <path d="M 0 0 Q 35 15 15 45 Q 5 25 0 0" opacity="0.85"/>
            </svg>

            <!-- HERO HOME SECTION -->
            <section id="home">
                <div class="names-monogram">
                    <!-- Circular leaf ornament circle -->
                    <div class="monogram-bg-circle"></div>
                    <svg viewBox="0 0 100 100" style="position: absolute; width: 220px; height: 220px; opacity: 0.15; z-index: 0;">
                        <circle cx="50" cy="50" r="44" stroke="var(--emerald)" stroke-width="0.8" stroke-dasharray="2 3" fill="none" />
                        <path d="M 50 6 A 44 44 0 0 1 94 50" stroke="var(--emerald)" stroke-width="1" fill="none"/>
                        <path d="M 50 94 A 44 44 0 0 1 6 50" stroke="var(--emerald)" stroke-width="1" fill="none"/>
                    </svg>

                    <!-- Initial "Bride" Graphic with Leaves -->
                    <div class="initial-graphic initial-pos-1">
                        <svg viewBox="0 0 100 100">
                            <text x="15" y="85" font-family="var(--font-serif)" font-size="95" fill="var(--gold)" font-weight="300">{{ substr($couple['bride'], 0, 1) }}</text>
                            <path d="M15 70 Q45 45 75 40" stroke="var(--emerald)" stroke-width="1.8" fill="none"/>
                            <path d="M30 60 L24 65 L23 56 Z" fill="var(--emerald)"/>
                            <path d="M48 50 L56 45 L50 40 Z" fill="var(--emerald)"/>
                        </svg>
                    </div>

                    <!-- Initial "Groom" Graphic with Leaves -->
                    <div class="initial-graphic-2 initial-pos-2">
                        <svg viewBox="0 0 100 100">
                            <text x="15" y="85" font-family="var(--font-serif)" font-size="95" fill="var(--gold)" font-weight="300">{{ substr($couple['groom'], 0, 1) }}</text>
                            <path d="M15 70 Q45 45 75 40" stroke="var(--emerald)" stroke-width="1.8" fill="none"/>
                            <path d="M30 60 L24 65 L23 56 Z" fill="var(--emerald)"/>
                            <path d="M48 50 L56 45 L50 40 Z" fill="var(--emerald)"/>
                        </svg>
                    </div>
                    
                    <div class="script-name-overlap name-1">{{ $couple['bride'] }}</div>
                    <div class="union-text">The Wedding Of</div>
                    <div class="script-name-overlap name-2">{{ $couple['groom'] }}</div>
                </div>

                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.6; max-width: 320px; margin: 15px auto;" data-aos="fade-up">
                    Dengan menyebut nama Allah yang Maha Pengasih lagi Maha Penyayang, kami mengundang Anda untuk merayakan cinta kami.
                </p>

                <!-- Countdown Text Circles -->
                <div class="countdown-row" data-aos="fade-up">
                    <div class="countdown-ring">
                        <span class="countdown-num" id="days">00</span>
                        <span class="countdown-lbl">Hari</span>
                    </div>
                    <div class="countdown-ring">
                        <span class="countdown-num" id="hours">00</span>
                        <span class="countdown-lbl">Jam</span>
                    </div>
                    <div class="countdown-ring">
                        <span class="countdown-num" id="minutes">00</span>
                        <span class="countdown-lbl">Menit</span>
                    </div>
                    <div class="countdown-ring">
                        <span class="countdown-num" id="seconds">00</span>
                        <span class="countdown-lbl">Detik</span>
                    </div>
                </div>

                <p style="font-family: var(--font-serif); font-size: 1.25rem; color: var(--emerald); font-weight: 700; margin-top: 15px; letter-spacing: 1px;" data-aos="fade-up">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>

                <a href="#event-sec" class="btn-pill-emerald" data-aos="fade-up">
                    <i class="bi bi-calendar-check"></i> Save The Date
                </a>
            </section>

            <!-- MEMPELAI (COUPLE) SECTION -->
            <section id="couple-sec">
                <!-- Golden Botanical Arch Header -->
                <div class="floral-arch-header" data-aos="fade-down">
                    <svg viewBox="0 0 200 80" class="arch-svg">
                        <path d="M 20 75 A 80 80 0 0 1 180 75" stroke="var(--gold)" stroke-width="2.5" fill="none" />
                        <path d="M 30 72 C 45 55, 60 40, 80 35 C 100 30, 120 35, 140 40 C 160 48, 168 64, 170 72" stroke="var(--emerald)" stroke-width="1.5" fill="none" />
                        <!-- Roses outlines -->
                        <circle cx="100" cy="32" r="7" fill="var(--emerald)" stroke="var(--gold)" stroke-width="1"/>
                        <circle cx="72" cy="38" r="6" fill="var(--emerald)" stroke="var(--gold)" stroke-width="1"/>
                        <circle cx="128" cy="38" r="6" fill="var(--emerald)" stroke="var(--gold)" stroke-width="1"/>
                        <!-- Leaves stem -->
                        <path d="M 100 32 Q 90 15 85 20 Z" fill="var(--gold)" />
                        <path d="M 100 32 Q 110 15 115 20 Z" fill="var(--gold)" />
                    </svg>
                </div>

                <p style="font-size: 0.82rem; line-height: 1.6; color: var(--text-light); margin-bottom: 30px; max-width: 340px; margin-left: auto; margin-right: auto;" data-aos="fade-up">
                    Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah, berkahilah ikatan pernikahan kami:
                </p>

                <!-- Bride (Anisa) -->
                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="arch-photo-container">
                        <img src="{{ $bg['bride'] }}" alt="{{ $couple['bride'] }}">
                    </div>
                    <h3 class="mempelai-nama">{{ $couple['bride'] }}</h3>
                    <p class="mempelai-parent">
                        Putri tercinta dari {{ $couple['parents']['bride'] }}
                    </p>
                </div>

                <div style="font-family: var(--font-script); font-size: 3.2rem; color: var(--gold); margin: 15px 0;">&</div>

                <!-- Groom (Haris) -->
                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="arch-photo-container">
                        <img src="{{ $bg['groom'] }}" alt="{{ $couple['groom'] }}">
                    </div>
                    <h3 class="mempelai-nama">{{ $couple['groom'] }}</h3>
                    <p class="mempelai-parent">
                        Putra tercinta dari {{ $couple['parents']['groom'] }}
                    </p>
                </div>
            </section>

            <!-- ACARA (EVENTS) SECTION -->
            <section id="event-sec">
                <span class="section-subtitle">Save the Date</span>
                <h2 class="section-title">Acara Pernikahan</h2>

                <!-- Akad -->
                <div class="event-box" data-aos="fade-up">
                    <div class="event-icon-circle"><i class="bi bi-bookmark-heart"></i></div>
                    <h3>Akad Nikah</h3>
                    
                    <!-- Editorial Date Grid -->
                    <div class="editorial-date-grid">
                        <div class="ed-day-name">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l') }}</div>
                        <div class="ed-center-box">
                            <div class="ed-date-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('d') }}</div>
                            <div class="ed-year-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('Y') }}</div>
                        </div>
                        <div class="ed-month-name">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('M') }}</div>
                    </div>

                    <p style="font-size: 0.9rem; font-weight: 700; color: var(--emerald);"><i class="bi bi-clock me-1"></i> Pukul {{ $schedule[0]['time'] }} WIB</p>
                    <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 8px;">{{ $schedule[0]['note'] }}</p>
                </div>

                <!-- Resepsi -->
                <div class="event-box" data-aos="fade-up">
                    <div class="event-icon-circle"><i class="bi bi-people"></i></div>
                    <h3>Resepsi</h3>
                    
                    <!-- Editorial Date Grid -->
                    <div class="editorial-date-grid">
                        <div class="ed-day-name">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l') }}</div>
                        <div class="ed-center-box">
                            <div class="ed-date-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('d') }}</div>
                            <div class="ed-year-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('Y') }}</div>
                        </div>
                        <div class="ed-month-name">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('M') }}</div>
                    </div>

                    <p style="font-size: 0.9rem; font-weight: 700; color: var(--emerald);"><i class="bi bi-clock me-1"></i> Pukul {{ $schedule[1]['time'] }} WIB</p>
                    <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 8px;">{{ $schedule[1]['note'] }}</p>
                </div>

                <!-- Lokasi Map -->
                <div class="event-box" data-aos="fade-up">
                    <div class="event-icon-circle"><i class="bi bi-geo-alt"></i></div>
                    <h3>Lokasi Acara</h3>
                    <p style="font-weight: 700; font-size: 0.95rem; color: var(--emerald);">{{ $event['location'] }}</p>
                    <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 6px; line-height: 1.6;">{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-pill-emerald" style="margin-top: 15px;">
                        <i class="bi bi-map"></i> Lihat Petunjuk Maps
                    </a>
                </div>
            </section>

            <!-- KISAH (STORY) SECTION -->
            <section id="story-sec">
                <span class="section-subtitle">Our Journey</span>
                <h2 class="section-title">Kisah Cinta</h2>

                <div class="story-slider-container" data-aos="fade-up">
                    <div class="story-slider">
                        @foreach($stories as $index => $s)
                        <div class="story-slide @if($index === 0) active @endif" data-index="{{ $index }}">
                            <div class="story-card-inner">
                                <div class="story-card-decoration">
                                    <i class="bi bi-suit-heart-fill story-card-heart"></i>
                                </div>
                                <span class="story-card-date">{{ $s['date'] }}</span>
                                <h4 class="story-card-title">{{ $s['title'] }}</h4>
                                <div class="story-card-divider"></div>
                                <p class="story-card-desc">{{ $s['text'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Navigation Controls -->
                    <div class="story-slider-controls">
                        <button class="btn-story-nav btn-prev" onclick="prevStorySlide()"><i class="bi bi-chevron-left"></i></button>
                        <div class="story-dots">
                            @foreach($stories as $index => $s)
                            <span class="story-dot @if($index === 0) active @endif" onclick="setStorySlide({{ $index }})"></span>
                            @endforeach
                        </div>
                        <button class="btn-story-nav btn-next" onclick="nextStorySlide()"><i class="bi bi-chevron-right"></i></button>
                    </div>
                </div>
            </section>

            <!-- GALERI (GALLERY) SECTION -->
            <section id="gallery-sec">
                <span class="section-subtitle">Sweet Memories</span>
                <h2 class="section-title">Galeri Foto</h2>

                <div class="gallery-collage">
                    @foreach($gallery as $index => $img)
                    <div class="gallery-collage-item collage-shape-{{ ($index % 4) + 1 }}" data-aos="zoom-in" onclick="openLightbox('{{ $img }}')">
                        <img src="{{ $img }}" alt="Wedding Image">
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- KADO / REKENING SECTION -->
            <section id="gift-sec">
                <span class="section-subtitle">Send Love</span>
                <h2 class="section-title">Kirim Hadiah</h2>
                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.6; max-width: 320px; margin: auto;">
                    Doa restu Anda merupakan kado terindah bagi kami. Namun bagi Anda yang ingin memberikan tanda kasih secara digital, silakan transfer melalui:
                </p>

                <div class="gifts-container" style="display: flex; flex-direction: column; gap: 20px;">
                    @foreach($gifts as $g)
                    <div class="gift-card" data-aos="fade-up" style="margin-bottom: 0px;">
                        <p style="font-weight: 700; font-size: 0.8rem; color: var(--emerald); letter-spacing: 1.5px;">{{ strtoupper($g['bank']) }}</p>
                        <h3 style="font-family: var(--font-serif); font-size: 1.5rem; color: var(--emerald); margin: 6px 0; font-weight: 700;">{{ $g['account'] }}</h3>
                        <p style="font-size: 0.8rem; color: var(--text-light);">a.n. {{ $g['name'] }}</p>
                        <button class="btn-copy" onclick="copyAccount('{{ $g['account'] }}')">Salin Nomor Rekening</button>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- RSVP SECTION -->
            <section id="rsvp-sec">
                <span class="section-subtitle">Presence</span>
                <h2 class="section-title">RSVP & Ucapan</h2>

                <div class="form-wrap" data-aos="fade-up">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-input" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Kehadiran</label>
                            <select id="kehadiran" class="form-input" required>
                                <option value="Hadir">Saya Akan Hadir</option>
                                <option value="Tidak Hadir">Berhalangan Hadir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ucapan & Doa Restu</label>
                            <textarea id="pesan" class="form-input" rows="3" placeholder="Tulis doa restu tulus Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
                    </form>
                </div>

                <div class="wish-list" id="wishList">
                    @foreach($wishes as $w)
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">{{ $w['name'] }}</span>
                            <span class="wish-status">{{ $w['status'] }}</span>
                        </div>
                        <p class="wish-content">{{ $w['message'] }}</p>
                    </div>
                    @endforeach
                    <div id="dynamicWishes"></div>
                </div>
            </section>

            <!-- Footer brand -->
            <div style="text-align: center; padding: 30px 0 10px 0; font-size: 0.72rem; color: var(--text-light); letter-spacing: 1px;">
                Created with <i class="bi bi-heart-fill" style="color: var(--gold);"></i> TemuRuang
            </div>
        </div>
    </div>

    <!-- BOTTOM FLOATING NAVIGATION (EMERALD & GOLD RINGS) -->
    <div class="bottom-nav-emerald" id="bottomNav">
        <a href="#home" class="nav-item-ring active"><i class="bi bi-house"></i></a>
        <a href="#couple-sec" class="nav-item-ring"><i class="bi bi-heart"></i></a>
        <a href="#event-sec" class="nav-item-ring"><i class="bi bi-calendar3"></i></a>
        <a href="#story-sec" class="nav-item-ring"><i class="bi bi-book"></i></a>
        <a href="#rsvp-sec" class="nav-item-ring"><i class="bi bi-chat-left-dots"></i></a>
    </div>

    <!-- FLOATING VINYL PLAYER & AUTOSCROLL -->
    <div class="floater-container">
        <!-- Floating Autoscroll Control -->
        <div class="scroll-control-emerald" id="scrollControl" onclick="toggleAutoscroll()">
            <i class="bi bi-chevron-double-down"></i>
            <span class="scroll-badge-emerald">Auto Scroll</span>
        </div>

        <!-- Floating Vinyl Music Player -->
        <div class="music-vinyl-player" id="musicPlayerControl">
            <div class="vinyl-disc" onclick="toggleMusic()">
                <div class="vinyl-label"></div>
            </div>
            <!-- Vinyl needle arm arm -->
            <div class="vinyl-arm" id="vinylArm">
                <svg viewBox="0 0 25 35" width="25" height="35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="5" r="4" fill="var(--gold)" />
                    <path d="M20 5 L10 25 L5 25 L5 30" stroke="var(--gold)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <rect x="2" y="29" width="6" height="4" rx="1" fill="#fff" />
                </svg>
            </div>
        </div>
    </div>

    <!-- LIGHTBOX IMAGE POPUP MODAL -->
    <div id="lightbox" style="position: fixed; inset: 0; background: rgba(0,0,0,0.9); z-index: 10000; display: none; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.4s;" onclick="closeLightbox()">
        <img id="lightbox-img" style="max-width: 90%; max-height: 85%; border: 3px solid white; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.5);" src="" alt="Popup Image">
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50 });

        let isAutoscrolling = false;
        let autoscrollSpeed = 0.6;

        // 3D Gate opening sequence
        let gateOpened = false;
        function openGate() {
            if (gateOpened) return;
            gateOpened = true;

            const gate = document.getElementById('invitationGate');
            gate.classList.add('opened');

            // Play background music and position vinyl arm needle
            const audio = document.getElementById('bg-audio');
            const player = document.getElementById('musicPlayerControl');
            audio.play().then(() => {
                player.classList.add('playing');
            }).catch(err => console.log("Audio autoplay blocked by user agent."));

            // Wait 2.8s for gates and letters to animate fully
            setTimeout(() => {
                document.getElementById('cover').classList.add('hide-cover');
                document.getElementById('bottomNav').classList.add('visible');
                player.classList.add('visible');
                document.getElementById('scrollControl').classList.add('visible');
                document.body.style.overflow = 'auto';
                startAutoscroll();
            }, 2800);
        }

        // Floating Gold Leaves Animation Loop using HTML5 Canvas
        function initGoldLeaves() {
            const canvas = document.getElementById('canvas-particles');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width = canvas.width = window.innerWidth > 480 ? 480 : window.innerWidth;
            let height = canvas.height = window.innerHeight;

            window.addEventListener('resize', () => {
                width = canvas.width = window.innerWidth > 480 ? 480 : window.innerWidth;
                height = canvas.height = window.innerHeight;
            });

            const leafCount = 20;
            const leaves = [];

            for (let i = 0; i < leafCount; i++) {
                leaves.push({
                    x: Math.random() * width,
                    y: Math.random() * height - height,
                    r: Math.random() * 6 + 4,
                    d: Math.random() * leafCount,
                    speed: Math.random() * 1.2 + 0.6,
                    rotation: Math.random() * 360,
                    rotationSpeed: Math.random() * 2 - 1,
                    swaySpeed: Math.random() * 0.02 + 0.01,
                    swayWidth: Math.random() * 18 + 8
                });
            }

            function draw() {
                ctx.clearRect(0, 0, width, height);
                leaves.forEach(l => {
                    ctx.save();
                    const swayX = Math.sin(l.d) * l.swayWidth;
                    ctx.translate(l.x + swayX, l.y);
                    ctx.rotate(l.rotation * Math.PI / 180);
                    
                    // Draw gold leaf oval shape
                    ctx.fillStyle = 'rgba(212, 175, 55, 0.55)';
                    ctx.beginPath();
                    ctx.ellipse(0, 0, l.r * 1.5, l.r, 0, 0, 2 * Math.PI);
                    ctx.closePath();
                    ctx.fill();
                    
                    // Center leaf line in bright gold
                    ctx.strokeStyle = 'rgba(251, 245, 183, 0.75)';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(-l.r * 1.4, 0);
                    ctx.lineTo(l.r * 1.4, 0);
                    ctx.stroke();

                    ctx.restore();

                    l.y += l.speed;
                    l.d += l.swaySpeed;
                    l.rotation += l.rotationSpeed;

                    if (l.y > height) {
                        l.y = -20;
                        l.x = Math.random() * width;
                        l.speed = Math.random() * 1.2 + 0.6;
                    }
                });
                requestAnimationFrame(draw);
            }
            draw();
        }

        // Music player controllers
        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const player = document.getElementById('musicPlayerControl');
            if (audio.paused) {
                audio.play();
                player.classList.add('playing');
            } else {
                audio.pause();
                player.classList.remove('playing');
            }
        }

        // Autoscroll logic
        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            const current = window.innerHeight + window.pageYOffset;
            const bottom = document.documentElement.scrollHeight - 5;
            if (current >= bottom) { stopAutoscroll(); return; }
            requestAnimationFrame(scrollStep);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.add('active');
            ctrl.querySelector('i').className = 'bi bi-pause-fill';
            requestAnimationFrame(scrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.remove('active');
            ctrl.querySelector('i').className = 'bi bi-chevron-double-down';
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        // Story slider controllers
        let currentStoryIndex = 0;
        
        function showStorySlide(index) {
            const storySlides = document.querySelectorAll('.story-slide');
            const storyDots = document.querySelectorAll('.story-dot');
            if (storySlides.length === 0) return;
            
            storySlides.forEach((slide, idx) => {
                slide.classList.remove('active', 'prev-slide');
                if (storyDots[idx]) {
                    storyDots[idx].classList.remove('active');
                }
                
                if (idx === index) {
                    slide.classList.add('active');
                    if (storyDots[idx]) {
                        storyDots[idx].classList.add('active');
                    }
                } else if (idx < index) {
                    slide.classList.add('prev-slide');
                }
            });
        }

        function nextStorySlide() {
            const storySlides = document.querySelectorAll('.story-slide');
            if (storySlides.length === 0) return;
            currentStoryIndex = (currentStoryIndex + 1) % storySlides.length;
            showStorySlide(currentStoryIndex);
        }

        function prevStorySlide() {
            const storySlides = document.querySelectorAll('.story-slide');
            if (storySlides.length === 0) return;
            currentStoryIndex = (currentStoryIndex - 1 + storySlides.length) % storySlides.length;
            showStorySlide(currentStoryIndex);
        }

        function setStorySlide(index) {
            currentStoryIndex = index;
            showStorySlide(currentStoryIndex);
        }

        // Lightbox Popup function
        function openLightbox(src) {
            const lb = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lb.style.display = 'flex';
            setTimeout(() => {
                lb.style.opacity = '1';
            }, 50);
        }

        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            lb.style.opacity = '0';
            setTimeout(() => {
                lb.style.display = 'none';
            }, 400);
        }

        // Copy Account function
        function copyAccount(num) {
            navigator.clipboard.writeText(num.replace(/\s/g, ''));
            alert("Nomor rekening berhasil disalin!");
        }

        // Form Submit RSVP
        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const status = document.getElementById('kehadiran').value;
            const msg = document.getElementById('pesan').value;
            const card = document.createElement('div');
            card.className = 'wish-card';
            card.innerHTML = `<div class="wish-header"><span class="wish-name">${name}</span><span class="wish-status">${status}</span></div><p class="wish-content">${msg}</p>`;
            document.getElementById('dynamicWishes').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP & Ucapan doa restu berhasil dikirim!");
        }

        // Countdown timer initialization
        function initCountdown() {
            const target = new Date("{{ $event['date_iso'] ?? '2026-12-12' }}T09:00:00").getTime();
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

        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = 'hidden';
            initCountdown();
            initGoldLeaves();
            ['wheel', 'touchstart'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });
        });

        // Track scrolling and update bottom nav active item
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const items = document.querySelectorAll('.nav-item-ring');
            let current = '';
            sections.forEach(sec => {
                if (pageYOffset >= (sec.offsetTop - 250)) current = sec.getAttribute('id');
            });
            items.forEach(item => {
                item.classList.remove('active');
                let href = item.getAttribute('href');
                if (href === '#event-sec' && current === 'event-sec') item.classList.add('active');
                else if (href === '#couple-sec' && current === 'couple-sec') item.classList.add('active');
                else if (href === '#home' && current === 'home') item.classList.add('active');
                else if (href === '#story-sec' && current === 'story-sec') item.classList.add('active');
                else if (href === '#rsvp-sec' && current === 'rsvp-sec') item.classList.add('active');
            });
        });
    </script>
</body>
</html>
