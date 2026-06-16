@php
    $couple = $couple ?? [
        'groom' => 'Arkan',
        'bride' => 'Nabila',
        'parents' => [
            'groom' => 'Bpk. Susilo & Ibu Hartini',
            'bride' => 'Bpk. Wibowo & Ibu Sri',
        ],
    ];

    $event = $event ?? [
        'date_iso' => '2026-12-12',
        'time' => '10:00',
        'location' => 'Pendopo Agung Mangkunegaran',
        'address' => 'Jl. Ronggowarsito No. 81, Solo',
        'maps_url' => 'https://maps.google.com/?q=Pura+Mangkunegaran+Solo',
    ];

    $schedule = $schedule ?? [
        ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00', 'note' => 'Pendopo Utama'],
        ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - 14:00', 'note' => 'Pendopo Agung'],
    ];

    $stories = $stories ?? [
        ['title' => 'Ketemu Pertama', 'date' => 'Maret 2022', 'text' => 'Bermula dari pertemuan di acara keluarga besar, kami merasa ada getaran yang tak biasa.'],
        ['title' => 'Lamaran', 'date' => 'Juli 2024', 'text' => 'Dengan adat Jawa yang sakral, keluarga besar melakukan prosesi lamaran.'],
        ['title' => 'Menuju Ijab', 'date' => 'Desember 2026', 'text' => 'Hari yang dinanti tiba, menyatukan dua keluarga dalam ikatan suci.'],
    ];

    $gallery = $gallery ?? [
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400',
        'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
        'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?q=80&w=400',
        'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=400',
    ];

    $bg = $bg ?? [
        'cover' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800',
        'groom' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400',
        'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
    ];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    <meta name="description" content="Undangan Pernikahan {{ $couple['groom'] }} & {{ $couple['bride'] }} - Konsep Adat Jawa">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Poppins:wght@300;400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">

    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════════════════
           JAVANESE WEDDING THEME – WEDDING 10
           Color palette: Deep brown, gold, cream, batik
           ═══════════════════════════════════════════════════ */
        :root {
            --primary: #8B6914;
            --primary-dark: #6B4F10;
            --primary-light: #C9A84C;
            --accent: #F7F0E3;
            --accent-warm: #FDF5E6;
            --bg-dark: #1A0F00;
            --bg-section: #FBF7EF;
            --text-dark: #2C1810;
            --text-body: #4A3728;
            --text-light: #8B7355;
            --border-gold: rgba(201, 168, 76, 0.3);
            --font-heading: 'Cinzel Decorative', serif;
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Poppins', sans-serif;
            --font-script: 'Great Vibes', cursive;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-sans);
            background: var(--bg-dark);
            color: var(--text-body);
            display: flex; justify-content: center;
            min-height: 100vh; overflow-x: hidden;
        }

        .wrapper {
            width: 100%; max-width: 480px;
            background: var(--bg-section);
            min-height: 100vh; position: relative;
            box-shadow: 0 0 60px rgba(0,0,0,0.5);
            overflow: hidden;
        }

        /* ─── Batik Pattern Overlay ─── */
        .wrapper::before {
            content: '';
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100%; max-width: 480px; height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 5 L35 15 L30 25 L25 15Z' fill='none' stroke='%23C9A84C' stroke-width='0.3' opacity='0.08'/%3E%3Cpath d='M10 25 L15 35 L10 45 L5 35Z' fill='none' stroke='%23C9A84C' stroke-width='0.3' opacity='0.08'/%3E%3Cpath d='M50 25 L55 35 L50 45 L45 35Z' fill='none' stroke='%23C9A84C' stroke-width='0.3' opacity='0.08'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0;
        }

        /* ═══════════════════════════════════════
           1. COVER / POPUP BUKA UNDANGAN
           ═══════════════════════════════════════ */
        #cover {
            position: fixed; top: 0; left: 50%; transform: translateX(-50%);
            width: 100%; max-width: 480px; height: 100vh; z-index: 9999;
            background: linear-gradient(175deg, rgba(26,15,0,0.85), rgba(26,15,0,0.7)),
                        url("{{ $bg['cover'] }}") center/cover no-repeat;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
            padding: 40px 30px; text-align: center;
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        #cover.opened { opacity: 0; transform: translate(-50%, -30px); pointer-events: none; }

        .cover-ornament {
            width: 120px; margin-bottom: 20px;
            opacity: 0.7; filter: drop-shadow(0 0 10px rgba(201,168,76,0.4));
        }
        .cover-label {
            font-family: var(--font-sans); font-size: 0.7rem;
            letter-spacing: 4px; color: var(--primary-light);
            text-transform: uppercase; margin-bottom: 10px;
        }
        .cover-title {
            font-family: var(--font-script); font-size: 3.2rem;
            color: #F5E6C8; margin: 10px 0;
            text-shadow: 0 2px 20px rgba(201,168,76,0.3);
        }
        .cover-date {
            font-family: var(--font-serif); font-size: 1rem;
            color: var(--primary-light); letter-spacing: 2px;
            margin-bottom: 30px;
        }
        .cover-guest-box {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(201,168,76,0.25);
            border-radius: 20px; padding: 20px 25px;
            width: 100%; margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        .cover-guest-box span {
            font-size: 0.65rem; color: rgba(255,255,255,0.5);
            letter-spacing: 2px; text-transform: uppercase;
        }
        .cover-guest-box h3 {
            font-family: var(--font-serif); font-size: 1.3rem;
            color: #F5E6C8; margin-top: 5px; font-weight: 400;
        }
        .btn-open {
            display: inline-flex; align-items: center; gap: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff; font-family: var(--font-sans);
            font-weight: 600; font-size: 0.8rem; letter-spacing: 2px;
            padding: 14px 30px; border-radius: 50px; border: none;
            cursor: pointer; transition: all 0.4s;
            box-shadow: 0 4px 20px rgba(139,105,20,0.4);
        }
        .btn-open:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(139,105,20,0.5); }

        /* ═══════════════════════════════════════
           2. HERO SECTION (Slider + Countdown)
           ═══════════════════════════════════════ */
        .hero-section {
            position: relative; height: 600px; overflow: hidden;
        }
        .hero-slider { position: relative; width: 100%; height: 100%; }
        .hero-slide {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 1.5s ease;
        }
        .hero-slide.active { opacity: 1; }
        .hero-overlay {
            position: absolute; bottom: 0; left: 0; width: 100%; height: 60%;
            background: linear-gradient(to top, var(--bg-dark), transparent);
            z-index: 1;
        }
        .hero-content {
            position: absolute; bottom: 40px; left: 0; width: 100%;
            z-index: 2; text-align: center; padding: 0 20px;
        }
        .hero-subtitle {
            font-family: var(--font-sans); font-size: 0.7rem;
            letter-spacing: 4px; color: var(--primary-light);
            text-transform: uppercase;
        }
        .hero-names {
            font-family: var(--font-script); font-size: 3rem;
            color: #F5E6C8; margin: 10px 0;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);
        }

        /* Countdown */
        .countdown-row {
            display: flex; justify-content: center; gap: 12px;
            margin-top: 20px;
        }
        .cd-box {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(201,168,76,0.3);
            backdrop-filter: blur(8px);
            border-radius: 12px; width: 60px; height: 60px;
            display: flex; flex-direction: column;
            justify-content: center; align-items: center;
        }
        .cd-box .cd-num {
            font-family: var(--font-heading); font-size: 1.1rem;
            color: var(--primary-light); font-weight: 700;
        }
        .cd-box .cd-label {
            font-size: 0.5rem; color: rgba(255,255,255,0.6);
            text-transform: uppercase; letter-spacing: 1px;
        }

        /* ═══════════════════════════════════════
           GENERIC SECTION STYLES
           ═══════════════════════════════════════ */
        section {
            position: relative; z-index: 1;
            padding: 50px 20px; text-align: center;
        }
        .section-card {
            background: rgba(255,255,255,0.85);
            border: 1px solid var(--border-gold);
            border-radius: 24px; padding: 40px 20px;
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.03);
        }
        .sec-label {
            font-family: var(--font-sans); font-size: 0.65rem;
            letter-spacing: 4px; text-transform: uppercase;
            color: var(--primary); margin-bottom: 5px; font-weight: 600;
        }
        .sec-title {
            font-family: var(--font-heading); font-size: 1.3rem;
            color: var(--text-dark); margin-bottom: 5px; font-weight: 400;
        }
        .sec-script {
            font-family: var(--font-script); font-size: 1.8rem;
            color: var(--primary-dark); margin: 5px 0 20px;
        }

        /* Gold ornament divider */
        .ornament-divider {
            display: flex; align-items: center; justify-content: center;
            gap: 10px; margin: 20px auto; width: 80%;
        }
        .ornament-divider::before, .ornament-divider::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-light), transparent);
        }
        .ornament-divider i { color: var(--primary-light); font-size: 0.7rem; }

        /* ═══════════════════════════════════════
           3. MEMPELAI
           ═══════════════════════════════════════ */
        .couple-block { margin: 25px 0; }
        .couple-photo-frame {
            width: 150px; height: 150px; margin: 0 auto 15px;
            border-radius: 50%; overflow: hidden;
            border: 4px solid var(--primary-light);
            box-shadow: 0 6px 25px rgba(139,105,20,0.15);
        }
        .couple-photo-frame img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .couple-name {
            font-family: var(--font-heading); font-size: 1.1rem;
            color: var(--text-dark); margin-bottom: 3px;
        }
        .couple-fullname {
            font-family: var(--font-serif); font-size: 0.95rem;
            font-style: italic; color: var(--text-light); margin-bottom: 8px;
        }
        .couple-parents {
            font-size: 0.75rem; color: var(--text-light); line-height: 1.6;
        }
        .couple-divider {
            font-family: var(--font-script); font-size: 2.5rem;
            color: var(--primary); margin: 10px 0;
        }

        /* ═══════════════════════════════════════
           4. SAVE THE DATE + AYAT + ACARA
           ═══════════════════════════════════════ */
        .ayat-box {
            background: rgba(139,105,20,0.05);
            border: 1px solid var(--border-gold);
            border-radius: 16px; padding: 25px 15px;
            margin: 20px 0; font-family: var(--font-serif);
        }
        .ayat-arabic {
            font-size: 1.1rem; line-height: 2;
            color: var(--text-dark); direction: rtl; margin-bottom: 15px;
        }
        .ayat-translation {
            font-size: 0.8rem; font-style: italic;
            color: var(--text-light); line-height: 1.6; margin-bottom: 10px;
        }
        .ayat-source {
            font-size: 0.7rem; font-weight: 700;
            color: var(--primary-dark);
        }

        .event-card {
            background: rgba(255,255,255,0.9);
            border: 1px solid var(--border-gold);
            border-radius: 20px; padding: 25px 18px;
            margin-bottom: 18px; position: relative; overflow: hidden;
        }
        .event-card::before {
            content: ''; position: absolute; top: 0; left: 0;
            width: 4px; height: 100%;
            background: linear-gradient(to bottom, var(--primary), var(--primary-light));
        }
        .event-card h3 {
            font-family: var(--font-heading); font-size: 0.95rem;
            color: var(--text-dark); margin-bottom: 10px;
        }
        .event-date-display {
            display: flex; align-items: center; justify-content: center;
            gap: 12px; margin: 12px 0; color: var(--primary-dark);
        }
        .event-date-day {
            font-family: var(--font-heading); font-size: 2.2rem;
            font-weight: 700; line-height: 1;
        }
        .event-date-side {
            text-align: left; font-size: 0.75rem; line-height: 1.5;
        }
        .event-date-divider {
            width: 1px; height: 35px;
            background: var(--primary-light);
        }
        .event-info {
            font-size: 0.8rem; color: var(--text-light); margin: 5px 0;
        }
        .btn-maps {
            display: inline-flex; align-items: center; gap: 6px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff; padding: 8px 20px; border-radius: 25px;
            text-decoration: none; font-size: 0.75rem; font-weight: 600;
            margin-top: 10px; transition: all 0.3s;
        }

        /* ═══════════════════════════════════════
           5. OUR STORY
           ═══════════════════════════════════════ */
        .story-timeline {
            text-align: left; padding-left: 20px;
            border-left: 2px solid var(--primary-light);
            margin-top: 25px;
        }
        .story-item {
            position: relative; margin-bottom: 30px;
            padding-left: 15px;
        }
        .story-item::before {
            content: ''; position: absolute;
            left: -27px; top: 5px;
            width: 12px; height: 12px; border-radius: 50%;
            background: var(--primary);
            border: 2px solid var(--accent);
            box-shadow: 0 0 0 3px rgba(139,105,20,0.2);
        }
        .story-date {
            font-weight: 600; font-size: 0.75rem;
            color: var(--primary-dark); margin-bottom: 4px;
        }
        .story-title {
            font-family: var(--font-serif); font-size: 1.05rem;
            color: var(--text-dark); margin-bottom: 5px; font-weight: 600;
        }
        .story-text {
            font-size: 0.75rem; color: var(--text-light); line-height: 1.6;
        }

        /* ═══════════════════════════════════════
           6. SUSUNAN ACARA (Timeline)
           ═══════════════════════════════════════ */
        .agenda-timeline { margin-top: 25px; }
        .agenda-item {
            display: flex; gap: 15px; margin-bottom: 20px;
            text-align: left;
        }
        .agenda-time {
            min-width: 65px; text-align: right;
            font-family: var(--font-heading); font-size: 0.75rem;
            color: var(--primary-dark); padding-top: 3px;
        }
        .agenda-dot-line {
            display: flex; flex-direction: column; align-items: center;
            padding-top: 5px;
        }
        .agenda-dot {
            width: 10px; height: 10px; border-radius: 50%;
            background: var(--primary-light);
            border: 2px solid var(--primary);
            flex-shrink: 0;
        }
        .agenda-line {
            width: 2px; flex: 1;
            background: linear-gradient(to bottom, var(--primary-light), transparent);
            margin-top: 4px;
        }
        .agenda-content h4 {
            font-family: var(--font-serif); font-size: 0.95rem;
            color: var(--text-dark); font-weight: 600;
        }
        .agenda-content p {
            font-size: 0.7rem; color: var(--text-light); margin-top: 3px;
        }

        /* ═══════════════════════════════════════
           7. RSVP & UCAPAN
           ═══════════════════════════════════════ */
        .form-wrap {
            background: rgba(255,255,255,0.9);
            padding: 25px 18px; border-radius: 20px;
            text-align: left; border: 1px solid var(--border-gold);
        }
        .form-group { margin-bottom: 14px; }
        .form-label {
            display: block; font-size: 0.75rem;
            font-weight: 600; margin-bottom: 5px; color: var(--text-dark);
        }
        .form-input {
            width: 100%; padding: 10px 14px;
            border: 1px solid var(--border-gold);
            border-radius: 10px; font-size: 0.8rem;
            font-family: var(--font-sans); background: #fff;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            outline: none; border-color: var(--primary);
        }
        .btn-submit {
            width: 100%; padding: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff; border: none; border-radius: 10px;
            font-weight: 600; font-size: 0.85rem;
            cursor: pointer; transition: all 0.3s;
            font-family: var(--font-sans);
        }

        .wish-list {
            max-height: 250px; overflow-y: auto;
            margin-top: 20px; text-align: left;
        }
        .wish-card {
            background: #fff; padding: 14px;
            border-radius: 14px; border-left: 3px solid var(--primary);
            margin-bottom: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .wish-header {
            display: flex; justify-content: space-between;
            margin-bottom: 5px; font-size: 0.8rem;
        }
        .wish-name { font-weight: 600; color: var(--text-dark); }
        .wish-status {
            background: var(--accent);
            padding: 2px 10px; border-radius: 10px;
            font-size: 0.6rem; color: var(--primary-dark);
        }
        .wish-msg { font-size: 0.75rem; color: var(--text-light); }

        /* ═══════════════════════════════════════
           8. GALLERY
           ═══════════════════════════════════════ */
        .gallery-grid {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 8px; margin-top: 20px;
        }
        .gallery-item {
            border-radius: 16px; overflow: hidden;
            aspect-ratio: 1;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 2px solid rgba(201,168,76,0.15);
        }
        .gallery-item img {
            width: 100%; height: 100%;
            object-fit: cover; transition: transform 0.5s;
        }
        .gallery-item:hover img { transform: scale(1.05); }

        /* ═══════════════════════════════════════
           9. GIFT / KADO
           ═══════════════════════════════════════ */
        .gift-card {
            background: rgba(255,255,255,0.9);
            border: 1px solid var(--border-gold);
            border-radius: 20px; padding: 25px 18px;
            margin-bottom: 15px; text-align: center;
        }
        .gift-bank {
            font-family: var(--font-heading); font-size: 0.85rem;
            color: var(--text-dark); margin-bottom: 5px;
        }
        .gift-number {
            font-family: var(--font-sans); font-size: 1rem;
            font-weight: 600; color: var(--primary-dark);
            letter-spacing: 1px; margin: 8px 0;
        }
        .gift-name {
            font-size: 0.8rem; color: var(--text-light);
        }
        .btn-copy {
            display: inline-flex; align-items: center; gap: 5px;
            background: var(--primary-dark); color: #fff;
            border: none; padding: 8px 20px; border-radius: 20px;
            font-size: 0.75rem; font-weight: 600;
            cursor: pointer; margin-top: 10px; transition: all 0.3s;
        }
        .btn-copy:hover { background: var(--primary); }

        /* ═══════════════════════════════════════
           10. FOOTER
           ═══════════════════════════════════════ */
        .footer-section {
            text-align: center; padding: 30px 20px 100px;
            position: relative; z-index: 1;
        }
        .footer-names {
            font-family: var(--font-script); font-size: 2rem;
            color: var(--primary-dark); margin-bottom: 10px;
        }
        .footer-thanks {
            font-size: 0.75rem; color: var(--text-light);
            line-height: 1.6; margin-bottom: 15px;
        }
        .footer-brand {
            font-size: 0.65rem; color: var(--text-light); opacity: 0.6;
        }

        /* ═══════════════════════════════════════
           11. BOTTOM NAVIGATION
           ═══════════════════════════════════════ */
        .bottom-nav {
            position: fixed; bottom: 20px; left: 50%;
            transform: translateX(-50%);
            width: 88%; max-width: 400px;
            background: rgba(26,15,0,0.85);
            backdrop-filter: blur(15px);
            border-radius: 50px; display: flex;
            justify-content: space-around; padding: 10px 5px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            z-index: 1000; border: 1px solid rgba(201,168,76,0.2);
            opacity: 0; visibility: hidden;
            transition: opacity 0.5s, visibility 0.5s;
        }
        .bottom-nav.visible { opacity: 1; visibility: visible; }
        .nav-item {
            display: flex; flex-direction: column;
            align-items: center; text-decoration: none;
            color: rgba(255,255,255,0.4); font-size: 0.55rem;
            transition: color 0.3s; padding: 2px 8px;
        }
        .nav-item i { font-size: 1.1rem; margin-bottom: 2px; }
        .nav-item.active { color: var(--primary-light); }
        .nav-item:hover { color: var(--primary-light); }

        /* ═══════════════════════════════════════
           12. MUSIC & SCROLL CONTROLS
           ═══════════════════════════════════════ */
        .floaters {
            position: fixed; bottom: 90px; right: calc(50% - 220px);
            z-index: 1001; display: flex; flex-direction: column;
            gap: 10px; opacity: 0; visibility: hidden;
            transition: all 0.5s;
        }
        .floaters.visible { opacity: 1; visibility: visible; }
        .float-btn {
            width: 42px; height: 42px; border-radius: 50%;
            background: rgba(26,15,0,0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(201,168,76,0.3);
            display: flex; justify-content: center; align-items: center;
            cursor: pointer; color: var(--primary-light);
            font-size: 1rem; transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .float-btn:hover { background: rgba(26,15,0,0.95); }
        .float-btn.playing i { animation: spin 3s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* ─── Responsive ─── */
        @media (max-width: 380px) {
            .hero-names { font-size: 2.5rem; }
            .cover-title { font-size: 2.8rem; }
        }
    </style>
</head>
<body>

    <!-- ═══════════════════════════════════
         1. COVER / BUKA UNDANGAN
         ═══════════════════════════════════ -->
    <div id="cover">
        <!-- Javanese ornament SVG -->
        <svg class="cover-ornament" viewBox="0 0 200 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 5 C80 5 60 15 50 25 C60 35 80 45 100 45 C120 45 140 35 150 25 C140 15 120 5 100 5Z"
                  stroke="#C9A84C" stroke-width="1" fill="none" opacity="0.6"/>
            <path d="M100 10 C85 10 70 18 62 25 C70 32 85 40 100 40 C115 40 130 32 138 25 C130 18 115 10 100 10Z"
                  stroke="#C9A84C" stroke-width="0.5" fill="none" opacity="0.4"/>
            <circle cx="100" cy="25" r="3" fill="#C9A84C" opacity="0.5"/>
            <circle cx="50" cy="25" r="2" fill="#C9A84C" opacity="0.3"/>
            <circle cx="150" cy="25" r="2" fill="#C9A84C" opacity="0.3"/>
        </svg>

        <p class="cover-label">Undangan Pernikahan</p>
        <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        <p class="cover-date">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d · m · Y') }}</p>

        <div class="cover-guest-box">
            <span>Kepada Yth. Bapak/Ibu/Saudara/i</span>
            <h3>{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>

        <button class="btn-open" onclick="openInvitation()">
            <i class="bi bi-envelope-open"></i> BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" type="audio/mpeg">
        </audio>

        <!-- ═══════════════════════════════════
             2. HERO (Slider + Countdown)
             ═══════════════════════════════════ -->
        <div class="hero-section" id="home">
            <div class="hero-slider" id="heroSlider">
                @foreach($gallery as $idx => $img)
                <div class="hero-slide {{ $idx === 0 ? 'active' : '' }}"
                     style="background-image: url('{{ $img }}');"></div>
                @endforeach
            </div>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-subtitle">The Wedding Of</p>
                <h1 class="hero-names">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
                <div class="countdown-row">
                    <div class="cd-box"><span class="cd-num" id="cd-days">00</span><span class="cd-label">Hari</span></div>
                    <div class="cd-box"><span class="cd-num" id="cd-hours">00</span><span class="cd-label">Jam</span></div>
                    <div class="cd-box"><span class="cd-num" id="cd-mins">00</span><span class="cd-label">Menit</span></div>
                    <div class="cd-box"><span class="cd-num" id="cd-secs">00</span><span class="cd-label">Detik</span></div>
                </div>
            </div>
        </div>

        <!-- ═══════════════════════════════════
             3. MEMPELAI
             ═══════════════════════════════════ -->
        <section id="couple-sec">
            <div class="section-card">
                <p class="sec-label">Mempelai</p>
                <h2 class="sec-title">Bismillah</h2>
                <p class="sec-script">Pengantin</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.7; margin-bottom: 25px;" data-aos="fade-up">
                    Atas Asung Kersaning Gusti Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i
                    dalam acara pernikahan putra-putri kami.
                </p>

                <div class="couple-block" data-aos="fade-up">
                    <div class="couple-photo-frame">
                        <img src="{{ $bg['groom'] }}" alt="{{ $couple['groom'] }}" loading="lazy">
                    </div>
                    <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                    <p class="couple-parents">
                        Putra dari<br><strong>{{ $couple['parents']['groom'] }}</strong>
                    </p>
                </div>

                <div class="couple-divider" data-aos="zoom-in">&</div>

                <div class="couple-block" data-aos="fade-up">
                    <div class="couple-photo-frame">
                        <img src="{{ $bg['bride'] }}" alt="{{ $couple['bride'] }}" loading="lazy">
                    </div>
                    <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                    <p class="couple-parents">
                        Putri dari<br><strong>{{ $couple['parents']['bride'] }}</strong>
                    </p>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             4. SAVE THE DATE + AYAT + ACARA
             ═══════════════════════════════════ -->
        <section id="event-sec">
            <div class="section-card">
                <p class="sec-label">Save The Date</p>
                <h2 class="sec-title">Hari Bahagia</h2>
                <p class="sec-script">Manunggaling Tekad</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <!-- Ayat -->
                <div class="ayat-box" data-aos="fade-up">
                    <p class="ayat-arabic">
                        وَمِنْ اٰيٰتِهٖٓ اَنْ خَلَقَ لَكُمْ مِّنْ اَنْفُسِكُمْ اَزْوَاجًا لِّتَسْكُنُوْٓا اِلَيْهَا
                        وَجَعَلَ بَيْنَكُمْ مَّوَدَّةً وَّرَحْمَةً
                    </p>
                    <p class="ayat-translation">
                        "Di antara tanda-tanda (kebesaran)-Nya ialah bahwa Dia menciptakan pasangan-pasangan
                        untukmu dari (jenis) dirimu sendiri agar kamu merasa tenteram kepadanya.
                        Dia menjadikan di antaramu rasa cinta dan kasih sayang."
                    </p>
                    <p class="ayat-source">— Ar-Rum: 21 —</p>
                </div>

                <!-- Event Cards -->
                @foreach($schedule as $i => $sch)
                <div class="event-card" data-aos="fade-up">
                    <h3>{{ $sch['title'] }}</h3>
                    <div class="event-date-display">
                        <span class="event-date-day">{{ \Carbon\Carbon::parse($event['date_iso'])->format('d') }}</span>
                        <div class="event-date-divider"></div>
                        <div class="event-date-side">
                            <strong>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l') }}</strong><br>
                            {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('F Y') }}
                        </div>
                    </div>
                    <p class="event-info"><i class="bi bi-clock"></i> {{ $sch['time'] }}</p>
                    <p class="event-info"><i class="bi bi-geo-alt"></i> {{ $sch['note'] }}</p>
                </div>
                @endforeach

                <div class="event-card" data-aos="fade-up">
                    <p style="font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">{{ $event['location'] }}</p>
                    <p style="font-size: 0.75rem; color: var(--text-light); line-height: 1.6;">{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-maps">
                        <i class="bi bi-map"></i> Petunjuk Lokasi
                    </a>
                </div>

                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.7; margin-top: 20px;" data-aos="fade-up">
                    Merupakan suatu kehormatan bagi kami sekeluarga apabila Bapak/Ibu/Saudara/i
                    berkenan hadir dan memberikan doa restu.
                </p>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             5. OUR STORY
             ═══════════════════════════════════ -->
        <section id="story-sec">
            <div class="section-card">
                <p class="sec-label">Sebuah Kisah</p>
                <h2 class="sec-title">Perjalanan Cinta</h2>
                <p class="sec-script">Our Story</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <div class="story-timeline">
                    @foreach($stories as $s)
                    <div class="story-item" data-aos="fade-up">
                        <div class="story-date">{{ $s['date'] }}</div>
                        <h4 class="story-title">{{ $s['title'] }}</h4>
                        <p class="story-text">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             6. SUSUNAN ACARA
             ═══════════════════════════════════ -->
        <section id="agenda-sec">
            <div class="section-card">
                <p class="sec-label">Rundown</p>
                <h2 class="sec-title">Susunan Acara</h2>
                <p class="sec-script">Tata Cara</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <div class="agenda-timeline" data-aos="fade-up">
                    <div class="agenda-item">
                        <div class="agenda-time">08:00</div>
                        <div class="agenda-dot-line"><div class="agenda-dot"></div><div class="agenda-line"></div></div>
                        <div class="agenda-content">
                            <h4>Persiapan & Tamu Datang</h4>
                            <p>Penyambutan tamu undangan dan keluarga</p>
                        </div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-time">09:00</div>
                        <div class="agenda-dot-line"><div class="agenda-dot"></div><div class="agenda-line"></div></div>
                        <div class="agenda-content">
                            <h4>Prosesi Siraman</h4>
                            <p>Upacara siraman adat Jawa</p>
                        </div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-time">10:00</div>
                        <div class="agenda-dot-line"><div class="agenda-dot"></div><div class="agenda-line"></div></div>
                        <div class="agenda-content">
                            <h4>Akad Nikah</h4>
                            <p>Ijab Kabul & Prosesi Pernikahan</p>
                        </div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-time">11:00</div>
                        <div class="agenda-dot-line"><div class="agenda-dot"></div><div class="agenda-line"></div></div>
                        <div class="agenda-content">
                            <h4>Panggih & Balangan Suruh</h4>
                            <p>Prosesi adat Jawa pertemuan mempelai</p>
                        </div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-time">12:00</div>
                        <div class="agenda-dot-line"><div class="agenda-dot"></div><div class="agenda-line"></div></div>
                        <div class="agenda-content">
                            <h4>Resepsi Pernikahan</h4>
                            <p>Jamuan makan dan sesi foto bersama</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             7. RSVP & UCAPAN
             ═══════════════════════════════════ -->
        <section id="rsvp-sec">
            <div class="section-card">
                <p class="sec-label">Kehadiran</p>
                <h2 class="sec-title">RSVP & Ucapan</h2>
                <p class="sec-script">Doa Restu</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <div class="form-wrap" data-aos="fade-up">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" id="rsvp-name" class="form-input" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Kehadiran</label>
                            <select id="rsvp-attend" class="form-input" required>
                                <option value="Hadir">Insya Allah Hadir</option>
                                <option value="Tidak Hadir">Berhalangan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Doa & Ucapan</label>
                            <textarea id="rsvp-msg" class="form-input" rows="3" placeholder="Sampaikan doa & ucapan terbaik" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">KIRIM UCAPAN</button>
                    </form>
                </div>

                <div class="wish-list" data-aos="fade-up">
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Pak Lurah</span>
                            <span class="wish-status">Hadir</span>
                        </div>
                        <p class="wish-msg">Barokallahu lakuma wa baroka 'alaikuma. Semoga sakinah mawaddah warahmah.</p>
                    </div>
                    <div id="wishList"></div>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             8. GALLERY
             ═══════════════════════════════════ -->
        <section id="gallery-sec">
            <div class="section-card">
                <p class="sec-label">Dokumentasi</p>
                <h2 class="sec-title">Galeri Foto</h2>
                <p class="sec-script">Kenangan Indah</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <div class="gallery-grid">
                    @foreach($gallery as $img)
                    <div class="gallery-item" data-aos="zoom-in">
                        <img src="{{ $img }}" alt="Gallery" loading="lazy">
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             9. GIFT / KADO
             ═══════════════════════════════════ -->
        <section id="gift-sec">
            <div class="section-card">
                <p class="sec-label">Wedding Gift</p>
                <h2 class="sec-title">Amplop Digital</h2>
                <p class="sec-script">Kado Pernikahan</p>

                <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>

                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.7; margin-bottom: 20px;" data-aos="fade-up">
                    Tanpa mengurangi rasa hormat, bagi Anda yang ingin memberikan tanda kasih
                    dapat melalui fitur di bawah ini.
                </p>

                <div class="gift-card" data-aos="fade-up">
                    <p class="gift-bank">Bank BCA</p>
                    <p class="gift-number" id="acc1">1234567890</p>
                    <p class="gift-name">a.n. {{ $couple['groom'] }}</p>
                    <button class="btn-copy" onclick="copyText('acc1')">
                        <i class="bi bi-clipboard"></i> Salin
                    </button>
                </div>

                <div class="gift-card" data-aos="fade-up">
                    <p class="gift-bank">Bank Mandiri</p>
                    <p class="gift-number" id="acc2">0987654321</p>
                    <p class="gift-name">a.n. {{ $couple['bride'] }}</p>
                    <button class="btn-copy" onclick="copyText('acc2')">
                        <i class="bi bi-clipboard"></i> Salin
                    </button>
                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════
             10. FOOTER
             ═══════════════════════════════════ -->
        <div class="footer-section">
            <div class="ornament-divider"><i class="bi bi-diamond-fill"></i></div>
            <h2 class="footer-names">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h2>
            <p class="footer-thanks">
                Merupakan suatu kebahagiaan dan kehormatan bagi kami<br>
                apabila Bapak/Ibu/Saudara/i berkenan hadir.<br>
                <strong>Matur Nuwun 🙏</strong>
            </p>
            <p class="footer-brand">Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang</p>
        </div>
    </div>

    <!-- ═══════════════════════════════════
         11. BOTTOM NAVIGATION
         ═══════════════════════════════════ -->
    <div class="bottom-nav" id="bottomNav">
        <a href="#home" class="nav-item active"><i class="bi bi-house"></i><span>Home</span></a>
        <a href="#couple-sec" class="nav-item"><i class="bi bi-people"></i><span>Mempelai</span></a>
        <a href="#event-sec" class="nav-item"><i class="bi bi-calendar-event"></i><span>Acara</span></a>
        <a href="#gallery-sec" class="nav-item"><i class="bi bi-images"></i><span>Galeri</span></a>
        <a href="#rsvp-sec" class="nav-item"><i class="bi bi-chat-heart"></i><span>RSVP</span></a>
    </div>

    <!-- ═══════════════════════════════════
         12. MUSIC & SCROLL CONTROLS
         ═══════════════════════════════════ -->
    <div class="floaters" id="floaters">
        <div class="float-btn" id="scrollControl" onclick="toggleAutoscroll()">
            <i class="bi bi-chevron-double-down"></i>
        </div>
        <div class="float-btn" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 50, duration: 800 });

        let isAutoscrolling = false;
        const autoscrollSpeed = 0.6;

        /* ─── 1. Open Invitation ─── */
        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(() => {});
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('floaters').classList.add('visible');
            document.body.style.overflow = 'auto';
            startAutoscroll();
        }

        /* ─── 12. Music Toggle ─── */
        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); ctrl.classList.add('playing'); }
            else { audio.pause(); ctrl.classList.remove('playing'); }
        }

        /* ─── 12. Auto-scroll ─── */
        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            if ((window.innerHeight + window.pageYOffset) >= (document.documentElement.scrollHeight - 5)) {
                stopAutoscroll(); return;
            }
            requestAnimationFrame(scrollStep);
        }
        function startAutoscroll() {
            isAutoscrolling = true;
            document.getElementById('scrollControl').querySelector('i').className = 'bi bi-pause-fill';
            requestAnimationFrame(scrollStep);
        }
        function stopAutoscroll() {
            isAutoscrolling = false;
            document.getElementById('scrollControl').querySelector('i').className = 'bi bi-chevron-double-down';
        }
        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        /* ─── 2. Hero Slider ─── */
        let slideIndex = 0;
        function heroSlider() {
            const slides = document.querySelectorAll('.hero-slide');
            slides.forEach(s => s.classList.remove('active'));
            slideIndex = (slideIndex + 1) % slides.length;
            slides[slideIndex].classList.add('active');
        }
        setInterval(heroSlider, 4000);

        /* ─── Countdown ─── */
        function initCountdown() {
            const target = new Date("{{ $event['date_iso'] ?? '2026-12-12' }}T09:00:00").getTime();
            setInterval(() => {
                const diff = target - Date.now();
                if (diff <= 0) return;
                document.getElementById('cd-days').innerText = String(Math.floor(diff / 86400000)).padStart(2, '0');
                document.getElementById('cd-hours').innerText = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                document.getElementById('cd-mins').innerText = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                document.getElementById('cd-secs').innerText = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
            }, 1000);
        }

        /* ─── RSVP ─── */
        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-name').value;
            const status = document.getElementById('rsvp-attend').value;
            const msg = document.getElementById('rsvp-msg').value;
            const card = document.createElement('div');
            card.className = 'wish-card';
            card.innerHTML = `<div class="wish-header"><span class="wish-name">${name}</span><span class="wish-status">${status}</span></div><p class="wish-msg">${msg}</p>`;
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("Terima kasih! Ucapan Anda telah terkirim.");
        }

        /* ─── Copy Account Number ─── */
        function copyText(id) {
            const text = document.getElementById(id).innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }

        /* ─── Nav active state ─── */
        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section, .hero-section');
            const items = document.querySelectorAll('.nav-item');
            let current = '';
            sections.forEach(sec => {
                if (pageYOffset >= (sec.offsetTop - 250)) current = sec.getAttribute('id');
            });
            items.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === `#${current}`) item.classList.add('active');
            });
        });

        /* ─── Init ─── */
        document.addEventListener("DOMContentLoaded", function() {
            document.body.style.overflow = 'hidden';
            initCountdown();
            ['wheel', 'touchstart'].forEach(evt => {
                window.addEventListener(evt, () => { if (isAutoscrolling) stopAutoscroll(); }, { passive: true });
            });
        });
    </script>
</body>
</html>