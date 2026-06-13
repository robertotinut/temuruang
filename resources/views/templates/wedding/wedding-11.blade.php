@php
    $couple = $couple ?? [
        'groom' => 'Haris',
        'bride' => 'Anisa',
        'parents' => [
            'groom' => 'Bapak Surono & Ibu Sri Mulyani',
            'bride' => 'Bapak Budi & Ibu Siti',
        ],
    ];

    $event = $event ?? [
        'date_iso' => '2026-12-12',
        'time' => '09:00',
        'location' => 'Omah Kawangan',
        'address' => 'Depan Asrama Brimob Boyolali, Kawangan, Boyolali',
        'maps_url' => 'https://maps.google.com/?q=Boyolali',
    ];

    $schedule = $schedule ?? [
        ['title' => 'Akad Nikah', 'time' => '09:00 - 10:30', 'note' => 'Lokasi Acara, Omah Kawangan'],
        ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - 15:00', 'note' => 'Lokasi Acara, Omah Kawangan'],
    ];

    $stories = $stories ?? [
        ['title' => 'Pertama Bertemu', 'date' => '09 Jan 2021', 'text' => 'Kami dipertemukan oleh seorang teman dekat, lalu mulai bertukar cerita dan merasa cocok.'],
        ['title' => 'Mengikat Janji', 'date' => '25 Agt 2022', 'text' => 'Kami sepakat untuk melangkah ke jenjang yang lebih serius dengan pertunangan disaksikan keluarga.'],
        ['title' => 'Hari Bahagia', 'date' => '12 Des 2026', 'text' => 'Kami mengikat janji suci kami dalam ikatan pernikahan yang sah dan memulai babak baru.'],
    ];

    $gallery = $gallery ?? [
        'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400'
    ];

    $bg = $bg ?? [
        'cover' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800',
        'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400',
        'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['bride'] }} & {{ $couple['groom'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@300;400;500;600&family=Waterfall&family=Sacramento&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1d3d5f; /* Deep Navy */
            --primary-light: #5f7d95;
            --accent: #f7f4eb; /* Warm Cream */
            --gold: #c5a880; /* Champagne Gold */
            --bg-dark: #121110; 
            --text-dark: #2b3e50;
            --text-light: #6c7e8d;
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Sacramento', cursive;
            --font-waterfall: 'Waterfall', cursive;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-dark);
            color: var(--text-dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Mobile Wrapper with elegant watercolor background pattern */
        .wrapper {
            width: 100%;
            max-width: 480px;
            background: var(--accent) url('https://images.unsplash.com/photo-1603486002664-a7319421e133?q=80&w=600&auto=format&fit=crop') repeat;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 40px rgba(0,0,0,0.6);
            padding: 15px;
            padding-bottom: 95px; /* bottom nav space */
            z-index: 1;
        }

        /* Double-line fine thin border frame */
        .inner-wrapper {
            border: 1px solid rgba(30, 61, 95, 0.25);
            outline: 1px solid rgba(30, 61, 95, 0.15);
            outline-offset: -5px;
            min-height: calc(100vh - 30px);
            width: 100%;
            border-radius: 8px;
            position: relative;
            padding: 10px;
            background: rgba(253, 251, 247, 0.3);
            backdrop-filter: blur(2px);
        }

        /* Fullscreen Cover Page Overlay */
        #cover {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            height: 100vh;
            z-index: 9999;
            background: linear-gradient(rgba(253, 251, 247, 0.72), rgba(253, 251, 247, 0.88)), 
                        url("{{ $bg['cover'] }}") center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 60px 30px;
            text-align: center;
            transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1);
        }

        #cover.opened {
            transform: translate(-50%, -100%);
            pointer-events: none;
        }

        /* 3D Envelope Styling */
        .envelope-container {
            position: relative;
            width: 290px;
            height: 190px;
            margin: 20px auto;
            perspective: 1000px;
            cursor: pointer;
            z-index: 10;
        }

        .envelope {
            position: relative;
            width: 100%;
            height: 100%;
            background-color: var(--accent);
            border-radius: 8px;
            box-shadow: 0 15px 35px rgba(30, 61, 95, 0.15);
            transform-style: preserve-3d;
            transition: transform 0.3s;
            border: 1px solid rgba(197, 168, 128, 0.3);
        }

        .envelope-container:hover .envelope {
            transform: scale(1.02);
        }

        /* Front flaps to form envelope pocket */
        .envelope::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 0;
            border-left: 145px solid transparent;
            border-right: 145px solid transparent;
            border-bottom: 95px solid #eae2d0; /* Darker cream pocket floor */
            border-radius: 0 0 8px 8px;
            z-index: 4;
            pointer-events: none;
        }

        .envelope-left {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-top: 95px solid transparent;
            border-bottom: 95px solid transparent;
            border-left: 145px solid rgba(226, 219, 190, 0.95);
            border-radius: 8px 0 0 8px;
            z-index: 3;
            pointer-events: none;
        }

        .envelope-right {
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-top: 95px solid transparent;
            border-bottom: 95px solid transparent;
            border-right: 145px solid rgba(226, 219, 190, 0.95);
            border-radius: 0 8px 8px 0;
            z-index: 3;
            pointer-events: none;
        }

        /* Top Flap */
        .envelope-flap {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-left: 145px solid transparent;
            border-right: 145px solid transparent;
            border-top: 105px solid #c9be95; /* Darker flap */
            transform-origin: top;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 5;
        }

        /* Letter Inside */
        .letter {
            position: absolute;
            bottom: 5px;
            left: 10px;
            width: 270px;
            height: 170px;
            background: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            z-index: 2;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.6s, opacity 0.8s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border: 2px solid var(--gold);
            outline: 1px solid rgba(30, 61, 95, 0.1);
            outline-offset: -4px;
        }

        /* Wax Seal */
        .wax-seal {
            position: absolute;
            top: 95px;
            left: 145px;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            background: radial-gradient(circle, #b91c1c 40%, #991b1b 100%);
            border: 2px solid var(--gold);
            border-radius: 50%;
            z-index: 6;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25), inset 0 2px 4px rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.5s ease;
        }

        .wax-seal::after {
            content: '💌';
            font-size: 1.25rem;
            color: white;
        }

        /* Active animation classes */
        .envelope-container.opening .envelope-flap {
            transform: rotateX(180deg);
            z-index: 1;
        }

        .envelope-container.opening .letter {
            transform: translateY(-110px);
            z-index: 4;
        }

        .envelope-container.opening .wax-seal {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.5);
            pointer-events: none;
        }

        /* Instruction and hand icon */
        .open-instruction {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: 2px;
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
            50% { transform: translateY(-6px) scale(0.95); }
        }

        /* Floating background particles style */
        .floating-particle {
            position: absolute;
            bottom: -30px;
            pointer-events: none;
            z-index: 1;
            animation: floatUp 10s linear infinite;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: inherit;
            }
            90% {
                opacity: inherit;
            }
            100% {
                transform: translateY(-110vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Leaf Corner Ornaments extending into frame */
        .corner-ornament {
            position: absolute;
            width: 80px;
            height: 80px;
            z-index: 5;
            pointer-events: none;
        }

        .corner-tl { top: 0; left: 0; }
        .corner-tr { top: 0; right: 0; transform: scaleX(-1); }
        .corner-bl { bottom: 0; left: 0; transform: scaleY(-1); }
        .corner-br { bottom: 0; right: 0; transform: scale(-1); }

        /* General Sections */
        section {
            padding: 50px 10px;
            position: relative;
            text-align: center;
        }

        .section-subtitle {
            font-size: 0.75rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--primary-light);
            margin-bottom: 8px;
            font-weight: 600;
            display: block;
        }

        .section-title {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 25px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Central Initials Overlapping Monogram (Hero section) */
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

        .initial-graphic {
            position: absolute;
            width: 170px;
            height: 170px;
            opacity: 0.22;
            z-index: 1;
            pointer-events: none;
        }

        .initial-graphic-2 {
            position: absolute;
            width: 170px;
            height: 170px;
            opacity: 0.22;
            z-index: 1;
            pointer-events: none;
        }

        .initial-pos-1 { top: 10px; left: 20%; }
        .initial-pos-2 { bottom: 10px; right: 20%; }

        .script-name-overlap {
            font-family: var(--font-script);
            font-size: 3.8rem;
            color: var(--primary);
            z-index: 2;
            position: relative;
        }
        .name-1 { margin-top: -40px; margin-left: -50px; }
        .name-2 { margin-top: 40px; margin-right: -50px; }

        .union-text {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            color: var(--text-light);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin: 5px 0;
            z-index: 2;
        }

        /* Countdown display clean text grid without cards */
        .countdown-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 30px 0 20px;
        }

        .countdown-num-block {
            text-align: center;
        }

        .countdown-num {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            color: var(--primary);
            line-height: 1;
            font-weight: 300;
        }

        .countdown-lbl {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: var(--text-light);
            letter-spacing: 1px;
            margin-top: 5px;
            display: block;
        }

        /* Save the Date button styled like mockup */
        .btn-pill-navy {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--primary);
            color: white;
            font-family: var(--font-sans);
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(30, 61, 95, 0.2);
            transition: all 0.3s;
            margin-top: 20px;
        }
        .btn-pill-navy:hover {
            transform: translateY(-2px);
        }

        /* Mempelai (Couple) Section Wreath/Flower Arch header */
        .floral-arch-header {
            width: 100%;
            max-width: 280px;
            margin: 0 auto 30px auto;
        }

        .arch-svg {
            width: 100%;
            height: auto;
        }

        /* Mempelai (Couple) Arch Photo frames */
        .couple-wrapper {
            margin: 40px auto;
            max-width: 320px;
            text-align: center;
        }

        .arch-photo-container {
            width: 150px;
            height: 220px;
            border-radius: 50% / 35% 35% 65% 65%;
            margin: 0 auto 20px auto;
            overflow: hidden;
            border: 1px solid var(--gold);
            padding: 4px;
            background: white;
            box-shadow: 0 8px 25px rgba(30, 61, 95, 0.08);
        }

        .arch-photo-container img {
            width: 100%;
            height: 100%;
            border-radius: 50% / 35% 35% 65% 65%;
            object-fit: cover;
        }

        .mempelai-nama {
            font-family: var(--font-script);
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .mempelai-parent {
            font-family: var(--font-serif);
            font-style: italic;
            font-size: 0.95rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Clean Boxed Editorial Date Grid */
        .editorial-date-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 25px 0;
        }
        .ed-day-name, .ed-month-name {
            font-family: var(--font-sans);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
            flex: 1;
        }
        .ed-day-name {
            text-align: right;
        }
        .ed-month-name {
            text-align: left;
        }
        .ed-center-box {
            text-align: center;
        }
        .ed-date-num {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary);
            border: 1px solid var(--primary);
            padding: 8px 15px;
            display: inline-block;
            line-height: 1;
            margin-bottom: 5px;
        }
        .ed-year-num {
            font-family: var(--font-sans);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--text-light);
        }

        /* Event Box & Minimalist Calendar layout */
        .event-box {
            background: white;
            border: 1px solid rgba(30, 61, 95, 0.1);
            border-radius: 18px;
            padding: 35px 20px;
            box-shadow: 0 8px 25px rgba(30, 61, 95, 0.02);
            margin-bottom: 30px;
            position: relative;
        }

        .event-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), var(--primary));
            border-radius: 18px 18px 0 0;
        }

        .event-box h3 {
            font-family: var(--font-serif);
            font-size: 1.4rem;
            color: var(--primary);
            margin-bottom: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Ring / Wine outline icons */
        .event-icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(30, 61, 95, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            color: var(--primary);
            font-size: 1.4rem;
        }

        /* Timeline Stories style */
        .story-timeline {
            position: relative;
            padding: 20px 0;
            text-align: left;
        }
        .story-timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 1px;
            background: rgba(30, 61, 95, 0.15);
        }
        .story-node {
            position: relative;
            padding-left: 45px;
            margin-bottom: 30px;
        }
        .story-node::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 5px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--primary);
            border: 2px solid var(--accent);
            box-shadow: 0 0 0 3px rgba(30, 61, 95, 0.15);
        }
        .story-node-date {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--primary-light);
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        .story-node-title {
            font-family: var(--font-serif);
            font-size: 1.15rem;
            color: var(--primary);
            margin-bottom: 8px;
            font-weight: 600;
        }
        .story-node-desc {
            font-size: 0.78rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 15px;
        }
        .gallery-card {
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 1;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(30, 61, 95, 0.04);
            position: relative;
        }
        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .gallery-card:hover img {
            transform: scale(1.08);
        }

        /* Dompet / Gift block */
        .gift-card {
            background: white;
            border: 1px solid rgba(30, 61, 95, 0.1);
            border-radius: 18px;
            padding: 30px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.01);
            margin-top: 25px;
        }

        .btn-copy {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 15px;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(30, 61, 95, 0.15);
            transition: all 0.3s;
        }
        .btn-copy:hover {
            background-color: var(--primary-light);
        }

        /* RSVP Form */
        .form-wrap {
            background: white;
            border: 1px solid rgba(30, 61, 95, 0.1);
            border-radius: 18px;
            padding: 30px 20px;
            text-align: left;
            box-shadow: 0 4px 15px rgba(0,0,0,0.01);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 6px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .form-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dcdad4;
            border-radius: 8px;
            font-size: 0.85rem;
            background-color: var(--accent);
            font-family: var(--font-sans);
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            border-color: var(--primary);
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 2px;
            box-shadow: 0 4px 12px rgba(30, 61, 95, 0.2);
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: var(--primary-light);
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
            border-left: 4px solid var(--primary);
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.01);
        }
        .wish-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 0.8rem;
        }
        .wish-name {
            font-weight: 600;
            color: var(--primary);
        }
        .wish-status {
            background: rgba(30, 61, 95, 0.05);
            color: var(--primary);
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

        /* Solid Navy Floating Bottom Navigation with circular outline buttons */
        .bottom-nav-navy {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 440px;
            background: var(--primary);
            border-radius: 40px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 12px;
            box-shadow: 0 8px 32px rgba(30, 61, 95, 0.25);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s, visibility 0.5s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .bottom-nav-navy.visible {
            opacity: 1;
            visibility: visible;
        }

        .nav-item-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-item-circle i {
            font-size: 1.05rem;
        }

        .nav-item-circle.active {
            background: white;
            color: var(--primary);
            border-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* Right-Side Stacked Circular outline floating buttons */
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

        .music-control, .scroll-control {
            position: absolute;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 4px 15px rgba(30, 61, 95, 0.25);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            pointer-events: auto;
            transition: all 0.5s ease;
        }

        .music-control.visible, .scroll-control.visible {
            opacity: 1;
            visibility: visible;
        }

        .music-control {
            bottom: 95px;
            right: 20px;
        }

        .scroll-control {
            bottom: 155px;
            right: 20px;
        }

        .music-control i, .scroll-control i {
            font-size: 1.1rem;
            color: white;
        }

        .music-control.playing i {
            animation: spin 3.5s linear infinite;
        }

        .scroll-control.active i {
            animation: bounce 1.5s infinite;
        }

        .scroll-badge {
            position: absolute;
            right: 55px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary);
            color: white;
            font-size: 0.6rem;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            pointer-events: none;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.1);
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(3px); }
        }
    </style>
</head>
<body>

    <!-- COVER SCREEN -->
    <div id="cover">
        <!-- Background leaf/heart particles container -->
        <div id="cover-particles" style="position: absolute; inset: 0; overflow: hidden; pointer-events: none; z-index: 1;"></div>

        <div class="cover-header" style="z-index: 5; margin-bottom: 15px;">
            <p style="letter-spacing: 4px; font-size: 0.72rem; font-weight: 600; color: var(--primary-light); text-transform: uppercase; margin-bottom: 8px;">The Wedding Of</p>
            <h1 style="font-family: var(--font-script); font-size: 3.2rem; color: var(--primary); font-weight: 300; margin: 0;">{{ $couple['bride'] }} & {{ $couple['groom'] }}</h1>
        </div>

        <!-- 3D Envelope Component -->
        <div class="envelope-container" id="invitation-envelope" onclick="openEnvelope(this)">
            <div class="envelope">
                <div class="envelope-flap"></div>
                <div class="envelope-left"></div>
                <div class="envelope-right"></div>
                
                <!-- Guest Card Letter Inside -->
                <div class="letter">
                    <div class="letter-inner">
                        <p style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-light); margin-bottom: 4px;">Kepada Yth.</p>
                        <p style="font-size: 0.6rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-light); margin-bottom: 8px;">Bapak/Ibu/Saudara/i</p>
                        <h3 style="font-family: var(--font-serif); font-size: 1.25rem; color: var(--primary); font-weight: 600; margin: 4px 0;">{{ request()->get('kpd', 'Nama Tamu') }}</h3>
                        <div style="width: 40px; height: 1px; background: var(--gold); margin: 8px auto;"></div>
                        <p style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-light);">di Tempat</p>
                    </div>
                </div>
                
                <!-- Wax Seal center stamp -->
                <div class="wax-seal"></div>
            </div>
        </div>

        <div class="open-instruction" style="z-index: 5;">
            <span>Ketuk Amplop untuk Membuka</span>
            <div class="tapping-hand">👆</div>
        </div>
    </div>

    <!-- MAIN WRAPPER -->
    <div class="wrapper">
        <div class="inner-wrapper">
            
            <audio id="bg-audio" loop preload="auto">
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3" type="audio/mpeg">
            </audio>

            <!-- Background leaves decoration -->
            <!-- Top Left -->
            <svg class="corner-ornament corner-tl" viewBox="0 0 100 100">
                <path d="M0,0 Q35,5 30,35 Q10,30 0,0" fill="var(--primary)" opacity="0.8"/>
                <path d="M0,0 Q40,15 35,55 Q15,40 0,0" fill="var(--primary)" opacity="0.6"/>
                <path d="M0,0 Q12,25 20,40" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                <circle cx="20" cy="40" r="1.5" fill="var(--primary)"/>
            </svg>
            <!-- Top Right -->
            <svg class="corner-ornament corner-tr" viewBox="0 0 100 100">
                <path d="M0,0 Q35,5 30,35 Q10,30 0,0" fill="var(--primary)" opacity="0.8"/>
                <path d="M0,0 Q40,15 35,55 Q15,40 0,0" fill="var(--primary)" opacity="0.6"/>
                <path d="M0,0 Q12,25 20,40" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                <circle cx="20" cy="40" r="1.5" fill="var(--primary)"/>
            </svg>
            <!-- Bottom Left -->
            <svg class="corner-ornament corner-bl" viewBox="0 0 100 100">
                <path d="M0,0 Q35,5 30,35 Q10,30 0,0" fill="var(--primary)" opacity="0.8"/>
                <path d="M0,0 Q40,15 35,55 Q15,40 0,0" fill="var(--primary)" opacity="0.6"/>
                <path d="M0,0 Q12,25 20,40" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                <circle cx="20" cy="40" r="1.5" fill="var(--primary)"/>
            </svg>
            <!-- Bottom Right -->
            <svg class="corner-ornament corner-br" viewBox="0 0 100 100">
                <path d="M0,0 Q35,5 30,35 Q10,30 0,0" fill="var(--primary)" opacity="0.8"/>
                <path d="M0,0 Q40,15 35,55 Q15,40 0,0" fill="var(--primary)" opacity="0.6"/>
                <path d="M0,0 Q12,25 20,40" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                <circle cx="20" cy="40" r="1.5" fill="var(--primary)"/>
            </svg>

            <!-- HERO HOME -->
            <section id="home">
                <div class="names-monogram">
                    <!-- Circular overlay decorative leaves stem wreath -->
                    <svg class="wreath-overlay" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="42" stroke="var(--primary)" stroke-width="0.8" stroke-dasharray="2 3" />
                        <path d="M12 50 Q10 40 18 35" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                        <path d="M88 50 Q90 60 82 65" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                        <path d="M50 8 Q60 10 55 18" stroke="var(--primary)" stroke-width="1.2" fill="none"/>
                        <circle cx="55" cy="18" r="1.5" fill="var(--primary)"/>
                    </svg>

                    <!-- Initial "Bride" Graphic with Leaves -->
                    <div class="initial-graphic initial-pos-1">
                        <svg viewBox="0 0 100 100">
                            <text x="20" y="85" font-family="var(--font-serif)" font-size="95" fill="var(--gold)" font-weight="300">{{ substr($couple['bride'], 0, 1) }}</text>
                            <path d="M15 70 Q40 50 75 42" stroke="var(--primary)" stroke-width="1.8" fill="none"/>
                            <path d="M30 61 L23 66 L23 57 Z" fill="var(--primary)"/>
                            <path d="M48 51 L56 46 L51 41 Z" fill="var(--primary)"/>
                        </svg>
                    </div>

                    <!-- Initial "Groom" Graphic with Leaves -->
                    <div class="initial-graphic-2 initial-pos-2">
                        <svg viewBox="0 0 100 100">
                            <text x="20" y="85" font-family="var(--font-serif)" font-size="95" fill="var(--gold)" font-weight="300">{{ substr($couple['groom'], 0, 1) }}</text>
                            <path d="M15 70 Q40 50 75 42" stroke="var(--primary)" stroke-width="1.8" fill="none"/>
                            <path d="M30 61 L23 66 L23 57 Z" fill="var(--primary)"/>
                            <path d="M48 51 L56 46 L51 41 Z" fill="var(--primary)"/>
                        </svg>
                    </div>
                    
                    <div class="script-name-overlap name-1">{{ $couple['bride'] }}</div>
                    <div class="union-text">The Wedding Of</div>
                    <div class="script-name-overlap name-2">{{ $couple['groom'] }}</div>
                </div>

                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.6; max-width: 300px; margin: 15px auto;" data-aos="fade-up">
                    Kami akan menikah, dan kami ingin Anda menjadi bagian dari hari istimewa kami!
                </p>

                <!-- Countdown Text Row (no cards/borders) -->
                <div class="countdown-row" data-aos="fade-up">
                    <div class="countdown-num-block">
                        <span class="countdown-num" id="days">00</span>
                        <span class="countdown-lbl">Hari</span>
                    </div>
                    <div class="countdown-num-block">
                        <span class="countdown-num" id="hours">00</span>
                        <span class="countdown-lbl">Jam</span>
                    </div>
                    <div class="countdown-num-block">
                        <span class="countdown-num" id="minutes">00</span>
                        <span class="countdown-lbl">Menit</span>
                    </div>
                    <div class="countdown-num-block">
                        <span class="countdown-num" id="seconds">00</span>
                        <span class="countdown-lbl">Detik</span>
                    </div>
                </div>

                <p style="font-family: var(--font-serif); font-size: 1.15rem; color: var(--primary); font-weight: 600; margin-top: 10px;" data-aos="fade-up">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>

                <a href="#event-sec" class="btn-pill-navy" data-aos="fade-up">
                    <i class="bi bi-calendar-check"></i> Save The Date
                </a>
            </section>

            <!-- MEMPELAI -->
            <section id="couple-sec">
                <!-- Golden Floral Arch Wreath Header -->
                <div class="floral-arch-header" data-aos="fade-down">
                    <svg viewBox="0 0 200 80" class="arch-svg">
                        <path d="M 20 75 A 80 80 0 0 1 180 75" stroke="var(--gold)" stroke-width="2" fill="none" />
                        <path d="M 30 72 C 45 60, 60 45, 80 38 C 100 32, 120 38, 140 45 C 160 52, 168 66, 170 72" stroke="var(--primary)" stroke-width="1.2" fill="none" />
                        <!-- Roses -->
                        <circle cx="100" cy="34" r="8" fill="var(--primary)" />
                        <circle cx="72" cy="40" r="6" fill="var(--primary)" />
                        <circle cx="128" cy="40" r="6" fill="var(--primary)" />
                        <!-- Leaves -->
                        <path d="M 100 34 Q 90 20 85 24 Z" fill="var(--primary-light)" />
                        <path d="M 100 34 Q 110 20 115 24 Z" fill="var(--primary-light)" />
                        <path d="M 72 40 Q 60 28 55 33 Z" fill="var(--primary-light)" />
                        <path d="M 128 40 Q 140 28 145 33 Z" fill="var(--primary-light)" />
                    </svg>
                </div>

                <p style="font-size: 0.78rem; line-height: 1.6; color: var(--text-light); margin-bottom: 30px;" data-aos="fade-up">
                    Assalamualaikum Wr. Wb. Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i pada acara pernikahan kami:
                </p>

                <!-- Bride (Anisa) -->
                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="arch-photo-container">
                        <img src="{{ $bg['bride'] }}" alt="{{ $couple['bride'] }}">
                    </div>
                    <h3 class="mempelai-nama">{{ $couple['bride'] }}</h3>
                    <p class="mempelai-parent">
                        Putri dari {{ $couple['parents']['bride'] }}
                    </p>
                </div>

                <div style="font-family: var(--font-script); font-size: 2.8rem; color: var(--gold); margin: 25px 0;">&</div>

                <!-- Groom (Haris) -->
                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="arch-photo-container">
                        <img src="{{ $bg['groom'] }}" alt="{{ $couple['groom'] }}">
                    </div>
                    <h3 class="mempelai-nama">{{ $couple['groom'] }}</h3>
                    <p class="mempelai-parent">
                        Putra dari {{ $couple['parents']['groom'] }}
                    </p>
                </div>
            </section>

            <!-- ACARA -->
            <section id="event-sec">
                <span class="section-subtitle">Save the Date</span>
                <h2 class="section-title">Acara Pernikahan</h2>

                <!-- Akad -->
                <div class="event-box" data-aos="fade-up">
                    <div class="event-icon-circle"><i class="bi bi-gift"></i></div>
                    <h3>Akad Nikah</h3>
                    
                    <!-- Clean Editorial Date Grid -->
                    <div class="editorial-date-grid">
                        <div class="ed-day-name">Sabtu</div>
                        <div class="ed-center-box">
                            <div class="ed-date-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('d') }}</div>
                            <div class="ed-year-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('Y') }}</div>
                        </div>
                        <div class="ed-month-name">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('M') }}</div>
                    </div>

                    <p style="font-size: 0.85rem; font-weight: 600;"><i class="bi bi-clock me-1"></i> Pukul {{ $schedule[0]['time'] }} WIB</p>
                    <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 8px;">{{ $schedule[0]['note'] }}</p>
                </div>

                <!-- Resepsi -->
                <div class="event-box" data-aos="fade-up">
                    <div class="event-icon-circle"><i class="bi bi-suit-spade"></i></div>
                    <h3>Resepsi</h3>
                    
                    <!-- Clean Editorial Date Grid -->
                    <div class="editorial-date-grid">
                        <div class="ed-day-name">Sabtu</div>
                        <div class="ed-center-box">
                            <div class="ed-date-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('d') }}</div>
                            <div class="ed-year-num">{{ \Carbon\Carbon::parse($event['date_iso'])->format('Y') }}</div>
                        </div>
                        <div class="ed-month-name">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('M') }}</div>
                    </div>

                    <p style="font-size: 0.85rem; font-weight: 600;"><i class="bi bi-clock me-1"></i> Pukul {{ $schedule[1]['time'] }} WIB</p>
                    <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 8px;">{{ $schedule[1]['note'] }}</p>
                </div>

                <!-- Lokasi Map -->
                <div class="event-box" data-aos="fade-up">
                    <div class="event-icon-circle"><i class="bi bi-geo-alt"></i></div>
                    <h3>Lokasi Acara</h3>
                    <p style="font-weight: 600; font-size: 0.9rem; color: var(--primary);">{{ $event['location'] }}</p>
                    <p style="font-size: 0.78rem; color: var(--text-light); margin-top: 5px; line-height: 1.5;">{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-pill-navy" style="margin-top: 15px;">
                        <i class="bi bi-map"></i> Lihat Maps
                    </a>
                </div>
            </section>

            <!-- CERITA -->
            <section id="story-sec">
                <span class="section-subtitle">Our Journey</span>
                <h2 class="section-title">Kisah Cinta</h2>

                <div class="story-timeline">
                    @foreach($stories as $s)
                    <div class="story-node" data-aos="fade-up">
                        <div class="story-node-date">{{ $s['date'] }}</div>
                        <h4 class="story-node-title">{{ $s['title'] }}</h4>
                        <p class="story-node-desc">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- GALERI -->
            <section id="gallery-sec">
                <span class="section-subtitle">Sweet Memories</span>
                <h2 class="section-title">Galeri</h2>

                <div class="gallery-grid">
                    @foreach($gallery as $img)
                    <div class="gallery-card" data-aos="zoom-in">
                        <img src="{{ $img }}" alt="Gallery Image">
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- KADO / REKENING -->
            <section id="gift-sec">
                <span class="section-subtitle">Send Love</span>
                <h2 class="section-title">Kirim Hadiah</h2>
                <p style="font-size: 0.78rem; color: var(--text-light); line-height: 1.6;">
                    Doa restu Anda merupakan hadiah terindah untuk kami. Namun, apabila Anda ingin mengirimkan kado/tanda kasih, Anda dapat melakukannya melalui rekening di bawah ini:
                </p>

                <div class="gift-card" data-aos="fade-up">
                    <p style="font-weight: 600; font-size: 0.8rem; color: var(--primary); letter-spacing: 1px;">BANK TRANSFER BCA</p>
                    <h3 style="font-family: var(--font-serif); font-size: 1.45rem; color: var(--primary); margin: 6px 0;">123-456-7890</h3>
                    <p style="font-size: 0.78rem; color: var(--text-light);">a.n. {{ $couple['groom'] }}</p>
                    <button class="btn-copy" onclick="copyAccount('123-456-7890')">Salin Rekening</button>
                </div>
            </section>

            <!-- RSVP -->
            <section id="rsvp-sec">
                <span class="section-subtitle">Presence</span>
                <h2 class="section-title">RSVP & Ucapan</h2>

                <div class="form-wrap" data-aos="fade-up">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <label class="form-label">Nama Anda</label>
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
                            <label class="form-label">Ucapan & Doa</label>
                            <textarea id="pesan" class="form-input" rows="3" placeholder="Tulis doa selamat Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
                    </form>
                </div>

                <div class="wish-list" id="wishList">
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Ari Wibowo</span>
                            <span class="wish-status">Hadir</span>
                        </div>
                        <p class="wish-content">Selamat berbahagia ya Haris & Anisa! Semoga acaranya lancar dari awal sampai akhir, dan menjadi keluarga yang samawa.</p>
                    </div>
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Sisca Amelia</span>
                            <span class="wish-status">Berhalangan</span>
                        </div>
                        <p class="wish-content">Selamat menempuh hidup baru! Maaf belum bisa hadir karena di luar kota. Doa terbaik untuk kalian berdua.</p>
                    </div>
                    <div id="dynamicWishes"></div>
                </div>
            </section>

            <div style="text-align: center; padding: 25px 0 10px 0; font-size: 0.72rem; color: var(--text-light);">
                Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
            </div>
        </div>
    </div>

    <!-- BOTTOM FLOATING NAVIGATION (SOLID NAVY WITH CIRCULAR OUTLINE ITEMS) -->
    <div class="bottom-nav-navy" id="bottomNav">
        <a href="#home" class="nav-item-circle active"><i class="bi bi-house"></i></a>
        <a href="#couple-sec" class="nav-item-circle"><i class="bi bi-heart"></i></a>
        <a href="#event-sec" class="nav-item-circle"><i class="bi bi-calendar3"></i></a>
        <a href="#story-sec" class="nav-item-circle"><i class="bi bi-book"></i></a>
        <a href="#rsvp-sec" class="nav-item-circle"><i class="bi bi-chat-left-dots"></i></a>
    </div>

    <!-- FLOATING SIDEBAR CONTROLS -->
    <div class="floater-container">
        <!-- Floating Music Control -->
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>

        <!-- Floating Autoscroll Control -->
        <div class="scroll-control" id="scrollControl" onclick="toggleAutoscroll()">
            <i class="bi bi-chevron-double-down"></i>
            <span class="scroll-badge">Auto Scroll</span>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50 });

        let isAutoscrolling = false;
        let autoscrollSpeed = 0.6;

        let openingSequenceStarted = false;
        function openEnvelope(element) {
            if (openingSequenceStarted) return;
            openingSequenceStarted = true;
            
            element.classList.add('opening');
            
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio play blocked by browser."));
            
            setTimeout(() => {
                document.getElementById('cover').classList.add('opened');
                document.getElementById('bottomNav').classList.add('visible');
                document.getElementById('musicControl').classList.add('visible');
                document.getElementById('scrollControl').classList.add('visible');
                document.body.style.overflow = 'auto';
                startAutoscroll();
            }, 2500);
        }

        function createCoverParticles() {
            const container = document.getElementById('cover-particles');
            if (!container) return;
            const icons = ['💙', '🌸', '✨', '🍃', '🤍', '🥂'];
            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'floating-particle';
                particle.innerText = icons[Math.floor(Math.random() * icons.length)];
                particle.style.left = Math.random() * 100 + '%';
                particle.style.fontSize = (Math.random() * 12 + 12) + 'px';
                particle.style.animationDelay = (Math.random() * 8) + 's';
                particle.style.animationDuration = (Math.random() * 6 + 6) + 's';
                particle.style.opacity = Math.random() * 0.4 + 0.25;
                container.appendChild(particle);
            }
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); ctrl.classList.add('playing'); }
            else { audio.pause(); ctrl.classList.remove('playing'); }
        }

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

        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = 'hidden';
            initCountdown();
            createCoverParticles();
            ['wheel', 'touchstart'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });
        });

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

        function copyAccount(num) {
            navigator.clipboard.writeText(num);
            alert("Nomor rekening berhasil disalin!");
        }

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
            alert("RSVP dan Ucapan Anda berhasil dikirim!");
        }

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const items = document.querySelectorAll('.nav-item-circle');
            let current = '';
            sections.forEach(sec => {
                if (pageYOffset >= (sec.offsetTop - 250)) current = sec.getAttribute('id');
            });
            items.forEach(item => {
                item.classList.remove('active');
                // Maps standard menu anchors to section ids
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