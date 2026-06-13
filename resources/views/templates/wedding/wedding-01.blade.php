<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] ?? 'Raka' }} & {{ $couple['bride'] ?? 'Nadya' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #c5a880; /* Champagne Gold */
            --primary-dark: #a98c64;
            --accent: #e7dfd5; /* Soft Cream Sand */
            --bg-dark: #121110; /* Outer Desktop Dark */
            --bg-light: #fcfbf9; /* Main Page Cream */
            --text-dark: #3a3834;
            --text-light: #7e7870;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Montserrat', sans-serif;
            --font-script: 'Great Vibes', cursive;
        }

        /* Reset & Base */
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

        /* Mobile Container Wrapper (Desktop Mockup) */
        .wrapper {
            width: 100%;
            max-width: 480px;
            background: url('https://images.unsplash.com/photo-1586075010923-2dd4570fb338?q=80&w=600&auto=format&fit=crop') repeat;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 40px rgba(0,0,0,0.6);
            padding: 12px;
            padding-bottom: 90px; /* space for bottom nav */
        }

        /* Double border frame layout */
        .inner-wrapper {
            border: 2px solid var(--primary);
            outline: 1px solid var(--primary);
            outline-offset: -6px;
            min-height: calc(100vh - 24px);
            width: 100%;
            border-radius: 4px;
            background: rgba(252, 251, 249, 0.5);
            backdrop-filter: blur(2px);
        }

        /* Fullscreen Cover Page */
        #cover {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            height: 100vh;
            z-index: 9999;
            background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.75)), 
                        url("{{ $bg['cover'] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800' }}") center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 50px 30px;
            color: white;
            text-align: center;
            transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1);
        }

        #cover.opened {
            transform: translate(-50%, -100%);
            pointer-events: none;
        }

        .cover-header p {
            font-size: 0.8rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 15px;
        }

        .cover-title {
            font-family: var(--font-script);
            font-size: 3.5rem;
            color: var(--primary);
            margin: 10px 0;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .cover-names {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-weight: 400;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .cover-guest-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 25px 20px;
            border-radius: 12px;
            width: 100%;
            margin-bottom: 30px;
        }

        .cover-guest-card span {
            font-size: 0.75rem;
            color: #ddd;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .cover-guest-card h3 {
            font-family: var(--font-serif);
            font-size: 1.3rem;
            color: white;
            margin: 10px 0;
            font-weight: 400;
        }

        .btn-open {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: var(--primary);
            color: var(--text-dark);
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 12px 25px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(197, 168, 128, 0.4);
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }

        .btn-open:hover {
            background-color: white;
            color: var(--text-dark);
            transform: translateY(-2px);
        }

        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(197, 168, 128, 0.7); }
            70% { transform: scale(1.03); box-shadow: 0 0 0 10px rgba(197, 168, 128, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(197, 168, 128, 0); }
        }

        /* Floating bottom navigation */
        .bottom-nav {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 40px);
            max-width: 440px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(197, 168, 128, 0.3);
            border-radius: 40px;
            display: flex;
            justify-content: space-around;
            padding: 10px 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .bottom-nav.visible {
            opacity: 1;
            visibility: visible;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--text-light);
            font-size: 0.65rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-item i {
            font-size: 1.1rem;
            margin-bottom: 2px;
        }

        .nav-item.active {
            color: var(--primary-dark);
        }

        /* Section Container */
        section {
            padding: 40px 10px;
            position: relative;
            text-align: center;
        }

        /* Luxury Gold Inner Section Framing */
        .section-frame {
            border: 1px solid rgba(197, 168, 128, 0.35);
            outline: 1px solid rgba(197, 168, 128, 0.15);
            outline-offset: -5px;
            padding: 45px 15px;
            position: relative;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            contain: content;
        }

        /* Leaf Corner SVGs */
        .corner-leaf {
            position: absolute;
            width: 25px;
            height: 25px;
            fill: var(--primary);
            stroke: var(--primary);
            opacity: 0.7;
        }
        .corner-tl { top: 12px; left: 12px; }
        .corner-tr { top: 12px; right: 12px; transform: scaleX(-1); }
        .corner-bl { bottom: 12px; left: 12px; transform: scaleY(-1); }
        .corner-br { bottom: 12px; right: 12px; transform: scale(-1); }

        /* General Typography */
        .section-subtitle {
            font-size: 0.75rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--primary-dark);
            margin-bottom: 10px;
            font-weight: 600;
            display: block;
        }

        .section-title {
            font-family: var(--font-serif);
            font-size: 2rem;
            color: var(--text-dark);
            margin-bottom: 25px;
            font-weight: 400;
        }

        .script-divider {
            font-family: var(--font-script);
            font-size: 2rem;
            color: var(--primary);
            margin: 15px 0;
        }

        /* Home/Hero Section */
        #home {
            min-height: 85vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #home .section-frame {
            background: rgba(255, 255, 255, 0.55);
        }

        #home h2 {
            font-family: var(--font-script);
            font-size: 3rem;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }

        #home h1 {
            font-family: var(--font-serif);
            font-size: 2rem;
            font-weight: 400;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        /* Hexagon Profile Styles */
        .couple-wrapper {
            margin: 35px 0;
        }

        .hex-container {
            position: relative;
            width: 170px;
            height: 190px;
            margin: 0 auto 15px;
            filter: drop-shadow(0 8px 12px rgba(0,0,0,0.12));
        }

        .hex-border {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hex-img {
            width: 95%;
            height: 95%;
            clip-path: polygon(0% 50%, 25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%);
            background-size: cover;
            background-position: center;
        }

        .couple-name {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .couple-parent {
            font-size: 0.8rem;
            color: var(--text-light);
            line-height: 1.5;
        }

        /* Event Section Cards */
        .event-card {
            background: white;
            border: 1px solid rgba(197, 168, 128, 0.25);
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(197, 168, 128, 0.06);
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--primary));
        }

        .event-card h3 {
            font-family: var(--font-serif);
            font-size: 1.4rem;
            color: var(--text-dark);
            margin-bottom: 12px;
            font-weight: 400;
        }

        .event-icon {
            font-size: 1.6rem;
            color: var(--primary-dark);
            margin-bottom: 12px;
            display: inline-block;
        }

        .event-details p {
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 6px;
            color: var(--text-dark);
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--primary-dark);
            border: 1.5px solid var(--primary);
            padding: 9px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            background: var(--primary);
            color: var(--text-dark);
        }

        /* Countdown Timer */
        .countdown-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0 30px;
        }

        .countdown-box {
            background: white;
            border: 1px solid rgba(197, 168, 128, 0.2);
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            border-radius: 8px;
            width: 65px;
            height: 65px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .countdown-box span:first-child {
            font-size: 1.3rem;
            font-family: var(--font-serif);
            font-weight: 600;
            color: var(--primary-dark);
        }

        .countdown-box span:last-child {
            font-size: 0.6rem;
            text-transform: uppercase;
            color: var(--text-light);
            letter-spacing: 1px;
            margin-top: 2px;
        }

        /* Gallery Section Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            aspect-ratio: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* RSVP Form Styles */
        .form-wrap {
            background: white;
            border: 1px solid rgba(197, 168, 128, 0.2);
            padding: 25px 15px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.02);
            text-align: left;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2ded8;
            border-radius: 6px;
            background-color: var(--bg-light);
            font-family: var(--font-sans);
            font-size: 0.85rem;
            color: var(--text-dark);
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: var(--text-dark);
            border: none;
            border-radius: 6px;
            font-family: var(--font-sans);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(197, 168, 128, 0.25);
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* Guestbook Wishes list */
        .wishes-container {
            margin-top: 35px;
            text-align: left;
        }

        .wishes-title {
            font-family: var(--font-serif);
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--text-dark);
            border-bottom: 1px solid var(--accent);
            padding-bottom: 8px;
        }

        .wish-list {
            max-height: 220px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .wish-list::-webkit-scrollbar {
            width: 4px;
        }
        .wish-list::-webkit-scrollbar-thumb {
            background-color: var(--accent);
            border-radius: 10px;
        }

        .wish-card {
            background: #fff;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 3px solid var(--primary);
            box-shadow: 0 2px 6px rgba(0,0,0,0.01);
        }

        .wish-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .wish-name {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--text-dark);
        }

        .wish-status {
            font-size: 0.6rem;
            background: #f0ebe4;
            color: var(--text-light);
            padding: 2px 6px;
            border-radius: 20px;
        }

        .wish-content {
            font-size: 0.75rem;
            color: var(--text-light);
            line-height: 1.4;
        }

        /* Floater Container to keep elements inside 480px width on desktop */
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

        /* Floating buttons control */
        .music-control, .scroll-control {
            position: absolute;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            border: 1px solid var(--accent);
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

        /* Stacking vertically on the right side */
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
            color: var(--text-light);
        }

        .music-control.playing i {
            animation: spin 3.5s linear infinite;
            color: var(--primary-dark);
        }

        .scroll-control.active i {
            animation: bounce 1.5s infinite;
            color: var(--primary-dark);
        }

        /* Elegant scroll badge next to scroll button */
        .scroll-badge {
            position: absolute;
            right: 55px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-dark);
            color: white;
            font-size: 0.6rem;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.5px;
            pointer-events: none;
            white-space: nowrap;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(4px); }
        }

        /* Footer styling */
        .footer {
            padding: 25px 15px;
            background: transparent;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-light);
        }
    </style>
</head>
<body>

    <!-- Fullscreen Cover overlay -->
    <div id="cover">
        <div class="cover-header">
            <p>The Wedding Invitation of</p>
            <h1 class="cover-title">{{ $couple['groom'] ?? 'Raka' }} & {{ $couple['bride'] ?? 'Nadya' }}</h1>
        </div>

        <div style="flex-grow: 1; display:flex; align-items:center; justify-content:center;">
            <svg width="60" height="60" viewBox="0 0 100 100" fill="none">
                <circle cx="50" cy="50" r="45" stroke="var(--primary)" stroke-width="1.5" opacity="0.3" />
                <path d="M30 40 L50 60 L70 40" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>

        <div style="width: 100%;">
            <div class="cover-guest-card">
                <span>Kepada Yth. Bapak/Ibu/Saudara/i:</span>
                <h3>
                    @if(request()->has('kpd'))
                        {{ request()->get('kpd') }}
                    @else
                        Tamu Undangan
                    @endif
                </h3>
                <p style="font-size: 0.7rem; color: #bbb;">Kami memohon kehadiran Anda di hari bahagia kami</p>
            </div>
            
            <button class="btn-open" onclick="openInvitation()">
                <i class="bi bi-envelope-open"></i> BUKA UNDANGAN
            </button>
        </div>
    </div>

    <!-- Main Mobile Content Area -->
    <div class="wrapper">
        <div class="inner-wrapper">
            
            <!-- Background music tag (SoundHelix direct audio, preload allowed) -->
            <audio id="bg-audio" loop preload="auto">
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" type="audio/mpeg">
            </audio>



            <!-- HOME HERO -->
            <section id="home">
                <div class="section-frame">
                    <!-- Leaf Corner SVGs -->
                    <svg class="corner-leaf corner-tl" viewBox="0 0 50 50">
                        <path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" />
                        <path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" />
                        <path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" />
                        <circle cx="20" cy="20" r="2" fill="var(--primary)" />
                    </svg>
                    <svg class="corner-leaf corner-tr" viewBox="0 0 50 50">
                        <path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" />
                        <path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" />
                        <path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" />
                        <circle cx="20" cy="20" r="2" fill="var(--primary)" />
                    </svg>
                    <svg class="corner-leaf corner-bl" viewBox="0 0 50 50">
                        <path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" />
                        <path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" />
                        <path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" />
                        <circle cx="20" cy="20" r="2" fill="var(--primary)" />
                    </svg>
                    <svg class="corner-leaf corner-br" viewBox="0 0 50 50">
                        <path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" />
                        <path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" />
                        <path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" />
                        <circle cx="20" cy="20" r="2" fill="var(--primary)" />
                    </svg>
                    
                    <span class="section-subtitle" data-aos="fade-down">The Wedding Of</span>
                    <h2 data-aos="zoom-in" data-aos-duration="1200">{{ $couple['groom'] ?? 'Raka' }} & {{ $couple['bride'] ?? 'Nadya' }}</h2>
                    
                    <!-- Premium Gold Line Art Medallion Divider -->
                    <svg viewBox="0 0 100 50" class="gold-scroll" style="width: 100px; height: auto; fill: var(--primary); margin: 15px 0;">
                        <path d="M 10 25 C 25 10, 45 40, 50 25 C 55 10, 75 40, 90 25" stroke="currentColor" stroke-width="1.2" fill="none" />
                        <path d="M 20 25 C 30 15, 40 35, 50 25 M 50 25 C 60 15, 70 35, 80 25" stroke="currentColor" stroke-width="0.6" fill="none" />
                        <circle cx="50" cy="25" r="3" />
                    </svg>
                    
                    <div class="script-divider">Save the Date</div>
                    
                    <h4 style="font-family: var(--font-serif); font-size: 1.1rem; letter-spacing: 2px; margin-top: 15px; font-weight: 400;" data-aos="fade-up">
                        {{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') : '12 Desember 2026' }}
                    </h4>
                </div>
            </section>

            <!-- MEMPELAI SECTION -->
            <section id="couple-sec">
                <div class="section-frame">
                    <svg class="corner-leaf corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    
                    <span class="section-subtitle" data-aos="fade-down">The Groom & Bride</span>
                    <h2 class="section-title" data-aos="fade-down">Mempelai</h2>
                    
                    <div style="font-family: var(--font-serif); font-size: 1rem; color: var(--primary-dark); font-style: italic; margin-bottom: 20px;">Bismillahirrahmanirrahim</div>
                    
                    <p style="font-size: 0.8rem; line-height: 1.7; color: var(--text-light); margin-bottom: 30px;" data-aos="fade-up">
                        Assalamu’alaikum Warahmatullahi Wabarakatuh<br>
                        Maha suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Dengan memohon rahmat dan ridho-Mu, kami mengundang Anda menghadiri hari bahagia kami:
                    </p>

                    <!-- Groom Profile -->
                    <div class="couple-wrapper" data-aos="fade-up">
                        <div class="hex-container">
                            <div class="hex-border">
                                <div class="hex-img" style="background-image: url('https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400');"></div>
                            </div>
                        </div>
                        <h3 class="couple-name">{{ $couple['groom'] ?? 'Raka Pratama' }}</h3>
                        <p class="couple-parent">
                            Putra Kedua dari Pasangan<br>
                            <strong>{{ $couple['parents']['groom'] ?? 'Bpk. Budi & Ibu Siti' }}</strong>
                        </p>
                    </div>

                    <div class="script-divider" data-aos="zoom-in">&</div>

                    <!-- Bride Profile -->
                    <div class="couple-wrapper" data-aos="fade-up">
                        <div class="hex-container">
                            <div class="hex-border">
                                <div class="hex-img" style="background-image: url('https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400');"></div>
                            </div>
                        </div>
                        <h3 class="couple-name">{{ $couple['bride'] ?? 'Nadya Maharani' }}</h3>
                        <p class="couple-parent">
                            Putri Pertama dari Pasangan<br>
                            <strong>{{ $couple['parents']['bride'] ?? 'Bpk. Setiawan & Ibu Ratna' }}</strong>
                        </p>
                    </div>
                </div>
            </section>

            <!-- ACARA SECTION -->
            <section id="event-sec">
                <div class="section-frame">
                    <svg class="corner-leaf corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>

                    <span class="section-subtitle" data-aos="fade-down">Save The Date</span>
                    <h2 class="section-title" data-aos="fade-down">Acara Pernikahan</h2>

                    <!-- Countdown Timer -->
                    <div class="countdown-container" data-aos="zoom-in">
                        <div class="countdown-box">
                            <span id="days">00</span>
                            <span>Hari</span>
                        </div>
                        <div class="countdown-box">
                            <span id="hours">00</span>
                            <span>Jam</span>
                        </div>
                        <div class="countdown-box">
                            <span id="minutes">00</span>
                            <span>Menit</span>
                        </div>
                        <div class="countdown-box">
                            <span id="seconds">00</span>
                            <span>Detik</span>
                        </div>
                    </div>

                    <!-- Card Akad Nikah -->
                    <div class="event-card" data-aos="fade-up">
                        <div class="event-icon"><i class="bi bi-heart"></i></div>
                        <h3>Akad Nikah</h3>
                        <div class="event-details">
                            <p><strong>Sabtu, {{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') : '12 Desember 2026' }}</strong></p>
                            <p>Pukul {{ $schedule[0]['time'] ?? '09:00' }} - Selesai</p>
                            <p style="margin-top: 10px;"><strong>{{ $event['location'] ?? 'Hotel Mulia Senayan' }}</strong></p>
                            <p style="color: var(--text-light); font-size: 0.75rem;">{{ $event['address'] ?? 'Jl. Asia Afrika, Senayan, Jakarta' }}</p>
                        </div>
                        <a href="{{ $event['maps_url'] ?? '#' }}" target="_blank" class="btn-action">
                            <i class="bi bi-geo-alt"></i> Petunjuk Google Maps
                        </a>
                    </div>

                    <!-- Card Resepsi -->
                    <div class="event-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="event-icon"><i class="bi bi-stars"></i></div>
                        <h3>Resepsi Pernikahan</h3>
                        <div class="event-details">
                            <p><strong>Sabtu, {{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') : '12 Desember 2026' }}</strong></p>
                            <p>Pukul {{ $schedule[1]['time'] ?? '19:00' }} - Selesai</p>
                            <p style="margin-top: 10px;"><strong>{{ $event['location'] ?? 'Hotel Mulia Senayan' }}</strong></p>
                            <p style="color: var(--text-light); font-size: 0.75rem;">{{ $event['address'] ?? 'Jl. Asia Afrika, Senayan, Jakarta' }}</p>
                        </div>
                        <a href="{{ $event['maps_url'] ?? '#' }}" target="_blank" class="btn-action">
                            <i class="bi bi-geo-alt"></i> Petunjuk Google Maps
                        </a>
                    </div>
                </div>
            </section>

            <!-- GALLERY SECTION -->
            <section id="gallery-sec">
                <div class="section-frame">
                    <svg class="corner-leaf corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>

                    <span class="section-subtitle" data-aos="fade-down">Our Romantic Moments</span>
                    <h2 class="section-title" data-aos="fade-down">Galeri Foto</h2>

                    <div class="gallery-grid">
                        @if(isset($gallery) && count($gallery) > 0)
                            @foreach($gallery as $index => $img)
                                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                                    <img src="{{ $img }}" alt="Momen Bahagia {{ $index + 1 }}">
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback Unsplash Photos -->
                            <div class="gallery-item" data-aos="zoom-in">
                                <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400" alt="Moment 1">
                            </div>
                            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                                <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400" alt="Moment 2">
                            </div>
                            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
                                <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=400" alt="Moment 3">
                            </div>
                            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
                                <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400" alt="Moment 4">
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- RSVP & GUESTBOOK SECTION -->
            <section id="rsvp-sec">
                <div class="section-frame">
                    <svg class="corner-leaf corner-tl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-tr" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-bl" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>
                    <svg class="corner-leaf corner-br" viewBox="0 0 50 50"><path d="M 0 0 L 0 20 M 0 0 L 20 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 0 0 Q 12 12 20 20" stroke="var(--primary)" stroke-width="1.2" fill="none" /><path d="M 3 3 Q 10 3 10 10 Q 3 10 3 3 Z" fill="var(--primary)" opacity="0.8" /><circle cx="20" cy="20" r="2" fill="var(--primary)" /></svg>

                    <span class="section-subtitle" data-aos="fade-down">Confirm Your Attendance</span>
                    <h2 class="section-title" data-aos="fade-down">Kehadiran (RSVP)</h2>

                    <div class="form-wrap" data-aos="fade-up">
                        <form id="rsvp-form" onsubmit="submitRsvp(event)">
                            <div class="form-group">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" class="form-input" placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="kehadiran">Konfirmasi Kehadiran</label>
                                <select id="kehadiran" class="form-input" required>
                                    <option value="" disabled selected>Pilih kehadiran</option>
                                    <option value="Hadir">Ya, Saya Hadir</option>
                                    <option value="Tidak Hadir">Maaf, Tidak Dapat Hadir</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="pesan">Pesan & Doa Restu</label>
                                <textarea id="pesan" class="form-input" rows="4" placeholder="Tulis ucapan dan doa untuk kedua mempelai..." required></textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send-fill"></i> KIRIM RSVP
                            </button>
                        </form>
                    </div>

                    <!-- Wishes Feed Area (Interactive Guestbook) -->
                    <div class="wishes-container" data-aos="fade-up">
                        <h3 class="wishes-title"><i class="bi bi-chat-text-fill"></i> Doa Restu & Ucapan</h3>
                        <div class="wish-list" id="wishList">
                            <!-- Default Mock Wishes -->
                            <div class="wish-card">
                                <div class="wish-header">
                                    <span class="wish-name">Budi Pratama</span>
                                    <span class="wish-status">Hadir</span>
                                </div>
                                <p class="wish-content">Selamat menempuh hidup baru untuk Raka dan Nadya! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah. Amin.</p>
                            </div>
                            <div class="wish-card">
                                <div class="wish-header">
                                    <span class="wish-name">Siti Aminah</span>
                                    <span class="wish-status">Hadir</span>
                                </div>
                                <p class="wish-content">Selamat ya! Bahagia selalu selamanya sampai kakek nenek, amin YRA.</p>
                            </div>
                            <div class="wish-card">
                                <div class="wish-header">
                                    <span class="wish-name">Hendra & Family</span>
                                    <span class="wish-status">Tidak Hadir</span>
                                </div>
                                <p class="wish-content">Selamat atas pernikahannya Raka & Nadya! Maaf kami berhalangan hadir karena ada tugas luar kota. Semoga dilancarkan acaranya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FOOTER -->
            <div class="footer">
                <p>Made with ♥ by TemuRuang</p>
                <p style="margin-top: 5px; color: #bbb; font-size: 0.65rem;">&copy; 2026. All rights reserved.</p>
            </div>

        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animations
        AOS.init({
            once: true,
            duration: 1000,
            offset: 50
        });

        // Autoscroll Global Variables
        let autoscrollInterval = null;
        let isAutoscrolling = false;
        const autoscrollSpeed = 0.6; // Scroll speed in pixels per animation frame

        // Cover trigger controls
        function openInvitation() {
            // Hide Cover Page with slide up
            const cover = document.getElementById('cover');
            cover.classList.add('opened');

            // Play background music
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => {
                console.log("Audio autoplay was blocked by browser. User interaction required.");
            });

            // Show bottom navigation and music control
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            
            // Enable body scrolling
            document.body.style.overflow = 'auto';

            // Show autoscroll control and start auto-scrolling
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        // Music player controls
        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const control = document.getElementById('musicControl');
            if (audio.paused) {
                audio.play();
                control.classList.add('playing');
            } else {
                audio.pause();
                control.classList.remove('playing');
            }
        }

        // Lock screen scroll until cover is opened
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = 'hidden';
            initCountdown();

            // Symmetrically bind wheel/touch triggers to temporarily pause autoscroll when user scrolls manually
            const userInteractiveEvents = ['wheel', 'touchstart'];
            userInteractiveEvents.forEach(event => {
                window.addEventListener(event, function() {
                    if (isAutoscrolling) {
                        stopAutoscroll();
                    }
                }, { passive: true });
            });
        });

        // Autoscroll Engine (requestAnimationFrame based for ultra smooth motion)
        function scrollStep() {
            if (!isAutoscrolling) return;
            
            window.scrollBy(0, autoscrollSpeed);
            
            // Check if user hit the bottom limit
            const currentScroll = window.innerHeight + window.pageYOffset;
            const bottomLimit = document.documentElement.scrollHeight - 5;
            if (currentScroll >= bottomLimit) {
                stopAutoscroll();
                return;
            }
            
            requestAnimationFrame(scrollStep);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const scrollControl = document.getElementById('scrollControl');
            scrollControl.classList.add('active');
            scrollControl.querySelector('i').className = 'bi bi-pause-fill';
            
            requestAnimationFrame(scrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const scrollControl = document.getElementById('scrollControl');
            scrollControl.classList.remove('active');
            scrollControl.querySelector('i').className = 'bi bi-chevron-double-down';
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) {
                stopAutoscroll();
            } else {
                startAutoscroll();
            }
        }

        // Active navigation indicator based on scrolling
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const navItems = document.querySelectorAll('.nav-item');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= (sectionTop - 250)) {
                    current = section.getAttribute('id');
                }
            });

            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });

        // Event Countdown Timer
        function initCountdown() {
            const targetDateStr = "{{ $event['date_iso'] ?? '2026-12-12' }}T09:00:00";
            const targetDate = new Date(targetDateStr).getTime();

            const countdownInterval = setInterval(() => {
                const now = new Date().getTime();
                const difference = targetDate - now;

                if (difference <= 0) {
                    clearInterval(countdownInterval);
                    document.getElementById('days').innerText = "00";
                    document.getElementById('hours').innerText = "00";
                    document.getElementById('minutes').innerText = "00";
                    document.getElementById('seconds').innerText = "00";
                    return;
                }

                const days = Math.floor(difference / (1000 * 60 * 60 * 24));
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((difference % (1000 * 60)) / 1000);

                document.getElementById('days').innerText = String(days).padStart(2, '0');
                document.getElementById('hours').innerText = String(hours).padStart(2, '0');
                document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
                document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
            }, 1000);
        }

        // RSVP Guestbook Interactive Submissions
        function submitRsvp(event) {
            event.preventDefault();
            const nama = document.getElementById('nama').value;
            const kehadiran = document.getElementById('kehadiran').value;
            const pesan = document.getElementById('pesan').value;

            if (nama && kehadiran && pesan) {
                // Create a new wish card element
                const wishCard = document.createElement('div');
                wishCard.className = 'wish-card';
                wishCard.style.opacity = '0';
                wishCard.style.transform = 'translateY(15px)';
                wishCard.style.transition = 'all 0.5s ease';

                wishCard.innerHTML = `
                    <div class="wish-header">
                        <span class="wish-name">${escapeHtml(nama)}</span>
                        <span class="wish-status">${escapeHtml(kehadiran)}</span>
                    </div>
                    <p class="wish-content">${escapeHtml(pesan)}</p>
                `;

                // Add to guestbook list
                const wishList = document.getElementById('wishList');
                wishList.insertBefore(wishCard, wishList.firstChild);

                // Smooth animation appearance
                setTimeout(() => {
                    wishCard.style.opacity = '1';
                    wishCard.style.transform = 'translateY(0)';
                }, 100);

                // Reset form inputs
                document.getElementById('rsvp-form').reset();
                
                alert('Terima kasih! RSVP dan Doa Restu Anda berhasil dikirim.');
            }
        }

        // HTML escaping utility for security
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }
    </script>

    <!-- Floating Nav Menu -->
    <div class="bottom-nav" id="bottomNav">
        <a href="#home" class="nav-item active"><i class="bi bi-house-door"></i><span>Home</span></a>
        <a href="#couple-sec" class="nav-item"><i class="bi bi-heart"></i><span>Mempelai</span></a>
        <a href="#event-sec" class="nav-item"><i class="bi bi-calendar-event"></i><span>Acara</span></a>
        <a href="#gallery-sec" class="nav-item"><i class="bi bi-images"></i><span>Galeri</span></a>
        <a href="#rsvp-sec" class="nav-item"><i class="bi bi-envelope"></i><span>RSVP</span></a>
    </div>

    <!-- Floating Controls Container (Centered & stacked like mobile app sidebar) -->
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
</body>
</html>