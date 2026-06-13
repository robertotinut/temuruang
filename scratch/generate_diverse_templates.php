<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Template;
use App\Models\EventType;

$destDir = __DIR__ . '/../resources/views/templates/wedding';

if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

// 10 Unique premium HSL tailored color palettes
$colors = [
    [ // 0. Royal Deep Maroon & Gold
        'primary' => '#8a1c14',
        'primary_dark' => '#66100a',
        'accent' => '#f5eae9',
        'bg_dark' => '#1f0806'
    ],
    [ // 1. Forest Emerald & Bronze
        'primary' => '#124e3f',
        'primary_dark' => '#0b3228',
        'accent' => '#edf5f2',
        'bg_dark' => '#061713'
    ],
    [ // 2. Midnight Navy & Champagne
        'primary' => '#1b365d',
        'primary_dark' => '#0e1e36',
        'accent' => '#f2f5f9',
        'bg_dark' => '#070e1a'
    ],
    [ // 3. Sweet Sakura & Rose Gold
        'primary' => '#d46a84',
        'primary_dark' => '#9e4359',
        'accent' => '#fdf5f6',
        'bg_dark' => '#290d13'
    ],
    [ // 4. Terracotta & Sand
        'primary' => '#c05c3c',
        'primary_dark' => '#8c3b22',
        'accent' => '#faf5f2',
        'bg_dark' => '#230b05'
    ],
    [ // 5. Sage Green & Warm Bronze
        'primary' => '#68856c',
        'primary_dark' => '#4b624f',
        'accent' => '#f4f6f4',
        'bg_dark' => '#1b241d'
    ],
    [ // 6. Lilac & Lavender
        'primary' => '#8a73b2',
        'primary_dark' => '#624f85',
        'accent' => '#f5f3f9',
        'bg_dark' => '#160f22'
    ],
    [ // 7. Plum & Warm Ochre
        'primary' => '#601a4a',
        'primary_dark' => '#411031',
        'accent' => '#f9f2f6',
        'bg_dark' => '#1d0314'
    ],
    [ // 8. Charcoal Black & Gold
        'primary' => '#c5a880',
        'primary_dark' => '#a98c64',
        'accent' => '#333333',
        'bg_dark' => '#121212'
    ],
    [ // 9. Copper & Tan Linen
        'primary' => '#c28859',
        'primary_dark' => '#915a2f',
        'accent' => '#faf6f2',
        'bg_dark' => '#271a0e'
    ]
];

// 5 Font pairings
$fonts = [
    [
        'serif' => "'Playfair Display', serif",
        'script' => "'Great Vibes', cursive",
        'google' => '<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">'
    ],
    [
        'serif' => "'Cormorant Garamond', serif",
        'script' => "'Alex Brush', cursive",
        'google' => '<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">'
    ],
    [
        'serif' => "'Cinzel', serif",
        'script' => "'Pinyon Script', cursive",
        'google' => '<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Montserrat:wght@300;400;500;600&family=Pinyon+Script&display=swap" rel="stylesheet">'
    ],
    [
        'serif' => "'DM Serif Display', serif",
        'script' => "'Allura', cursive",
        'google' => '<link href="https://fonts.googleapis.com/css2?family=Allura&family=DM+Serif+Display:ital@0;1&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">'
    ],
    [
        'serif' => "'Bodoni Moda', serif",
        'script' => "'Italianno', cursive",
        'google' => '<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,600;1,400&family=Italianno&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">'
    ]
];

// 5 Corner Ornament SVGs
$ornaments = [
    [ // Classical Leaf Curves
        'tl' => '<path d="M 0 0 Q 25 5 25 25 Q 5 25 0 0 Z" fill="var(--primary)" opacity="0.15" /><path d="M 0 0 L 0 35 M 0 0 L 35 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 5 5 Q 20 20 25 25" stroke="var(--primary)" stroke-width="1" fill="none" /><circle cx="25" cy="25" r="2" fill="var(--primary)" />',
        'tr' => '<path d="M 0 0 Q 25 5 25 25 Q 5 25 0 0 Z" fill="var(--primary)" opacity="0.15" /><path d="M 0 0 L 0 35 M 0 0 L 35 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 5 5 Q 20 20 25 25" stroke="var(--primary)" stroke-width="1" fill="none" /><circle cx="25" cy="25" r="2" fill="var(--primary)" />'
    ],
    [ // Tropical Monstera Style
        'tl' => '<path d="M 0 0 L 0 30 L 30 0 Z" fill="var(--primary)" opacity="0.08" /><path d="M 0 0 L 0 25 M 0 0 L 25 0" stroke="var(--primary)" stroke-width="2" fill="none" /><path d="M 0 0 Q 15 15 25 25" stroke="var(--primary)" stroke-width="1" fill="none" />',
        'tr' => '<path d="M 0 0 L 0 30 L 30 0 Z" fill="var(--primary)" opacity="0.08" /><path d="M 0 0 L 0 25 M 0 0 L 25 0" stroke="var(--primary)" stroke-width="2" fill="none" /><path d="M 0 0 Q 15 15 25 25" stroke="var(--primary)" stroke-width="1" fill="none" />'
    ],
    [ // Art Deco Geometric
        'tl' => '<path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" />',
        'tr' => '<path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" /><path d="M 4 4 L 4 22 M 4 4 L 22 4" stroke="var(--primary)" stroke-width="0.75" fill="none" /><path d="M 0 0 L 20 20" stroke="var(--primary)" stroke-width="1" fill="none" />'
    ],
    [ // Vintage Swirls
        'tl' => '<path d="M 0 0 C 15 5, 20 20, 15 25 C 10 30, 5 20, 5 15 C 5 10, 10 5, 15 5" stroke="var(--primary)" stroke-width="1" fill="none" /><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" />',
        'tr' => '<path d="M 0 0 C 15 5, 20 20, 15 25 C 10 30, 5 20, 5 15 C 5 10, 10 5, 15 5" stroke="var(--primary)" stroke-width="1" fill="none" /><path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.5" fill="none" />'
    ],
    [ // Minimalist Dots and Lines
        'tl' => '<path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.2" fill="none" /><circle cx="6" cy="6" r="1.5" fill="var(--primary)" /><circle cx="14" cy="14" r="1.5" fill="var(--primary)" />',
        'tr' => '<path d="M 0 0 L 0 30 M 0 0 L 30 0" stroke="var(--primary)" stroke-width="1.2" fill="none" /><circle cx="6" cy="6" r="1.5" fill="var(--primary)" /><circle cx="14" cy="14" r="1.5" fill="var(--primary)" />'
    ]
];

// Photo frame styles outer/inner
$frameStyles = [
    [ // Hexagon
        'outer' => 'clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);',
        'inner' => 'clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); width: 95%; height: 95%;'
    ],
    [ // Arch
        'outer' => 'border-radius: 100px 100px 0 0;',
        'inner' => 'border-radius: 96px 96px 0 0; width: 96%; height: 96%;'
    ],
    [ // Octagon
        'outer' => 'clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);',
        'inner' => 'clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%); width: 95%; height: 95%;'
    ],
    [ // Oval
        'outer' => 'border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;',
        'inner' => 'border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%; width: 95%; height: 95%;'
    ],
    [ // Polaroid Frame
        'outer' => 'border-radius: 4px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-bottom: 30px solid white;',
        'inner' => 'border-radius: 2px; width: 94%; height: 90%;'
    ]
];

// Unsplash paper textures
$textures = [
    'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?q=80&w=600&auto=format&fit=crop', // Fine linen
    'https://images.unsplash.com/photo-1603486002664-a7319421e133?q=80&w=600&auto=format&fit=crop', // Coarse watercolor
    'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=600&auto=format&fit=crop', // Recycled fiber
    'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?q=80&w=600&auto=format&fit=crop', // Textured cotton
    'https://images.unsplash.com/photo-1618005198143-e5283b519a7f?q=80&w=600&auto=format&fit=crop'  // Antique parchment
];

// 5 Layout Skeletons as string templates with placeholders
// Layout A: Classic Premium Card (Long-Scroll)
$skeletonA = <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    [[GOOGLE_FONTS]]
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: [[COLOR_PRIMARY]]; 
            --primary-dark: [[COLOR_PRIMARY_DARK]];
            --accent: [[COLOR_ACCENT]]; 
            --bg-dark: [[COLOR_BG_DARK]]; 
            --bg-light: #fcfbf9; 
            --text-dark: #3a3834;
            --text-light: #7e7870;
            --font-serif: [[FONT_SERIF]];
            --font-sans: 'Montserrat', sans-serif;
            --font-script: [[FONT_SCRIPT]];
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: url('[[TEXTURE]]') repeat; min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding: 12px; padding-bottom: 90px; }
        .inner-wrapper { border: 2px solid var(--primary); outline: 1px solid var(--primary); outline-offset: -6px; min-height: calc(100vh - 24px); width: 100%; border-radius: 4px; background: rgba(252, 251, 249, 0.5); backdrop-filter: blur(2px); }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.75)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: white; text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-header p { font-size: 0.8rem; letter-spacing: 4px; text-transform: uppercase; color: var(--accent); margin-bottom: 15px; }
        .cover-title { font-family: var(--font-script); font-size: 3.5rem; color: var(--primary); margin: 10px 0; text-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .cover-guest-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 25px 20px; border-radius: 12px; width: 100%; margin-bottom: 30px; }
        .cover-guest-card span { font-size: 0.75rem; color: #ddd; text-transform: uppercase; letter-spacing: 2px; }
        .cover-guest-card h3 { font-family: var(--font-serif); font-size: 1.3rem; color: white; margin: 10px 0; font-weight: 400; }
        
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: var(--primary); color: white; font-family: var(--font-sans); font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; padding: 12px 25px; border-radius: 30px; border: none; cursor: pointer; box-shadow: 0 5px 15px rgba(0,0,0,0.2); transition: all 0.3s ease; animation: pulse 2s infinite; }
        .btn-open:hover { background-color: white; color: var(--text-dark); }
        @keyframes pulse { 0% { transform: scale(1); } 70% { transform: scale(1.03); } 100% { transform: scale(1); } }

        .bottom-nav { position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); width: calc(100% - 40px); max-width: 440px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(197, 168, 128, 0.3); border-radius: 40px; display: flex; justify-content: space-around; padding: 10px 15px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); z-index: 999; opacity: 0; visibility: hidden; transition: opacity 0.5s ease, visibility 0.5s ease; }
        .bottom-nav.visible { opacity: 1; visibility: visible; }
        .nav-item { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: var(--text-light); font-size: 0.65rem; font-weight: 500; transition: color 0.3s; }
        .nav-item i { font-size: 1.1rem; margin-bottom: 2px; }
        .nav-item.active { color: var(--primary-dark); }

        section { padding: 50px 15px; position: relative; text-align: center; }
        .section-frame { border: 1px solid rgba(197, 168, 128, 0.25); padding: 40px 20px; position: relative; border-radius: 12px; background: rgba(255, 255, 255, 0.88); box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        
        .corner-ornament { position: absolute; width: 35px; height: 35px; }
        .corner-tl { top: 12px; left: 12px; }
        .corner-tr { top: 12px; right: 12px; transform: scaleX(-1); }
        .corner-bl { bottom: 12px; left: 12px; transform: scaleY(-1); }
        .corner-br { bottom: 12px; right: 12px; transform: scale(-1); }

        .section-subtitle { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 10px; font-weight: 600; display: block; }
        .section-title { font-family: var(--font-serif); font-size: 2rem; color: var(--text-dark); margin-bottom: 25px; font-weight: 400; }
        .script-divider { font-family: var(--font-script); font-size: 2.2rem; color: var(--primary); margin: 15px 0; }

        .couple-wrapper { margin: 35px 0; }
        .photo-container { position: relative; width: 160px; height: 180px; margin: 0 auto 15px; filter: drop-shadow(0 8px 12px rgba(0,0,0,0.12)); display: flex; align-items: center; justify-content: center; }
        .photo-border { width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--accent)); [[FRAME_STYLE_OUTER]] display: flex; align-items: center; justify-content: center; }
        .photo-img { [[FRAME_STYLE_INNER]] background-size: cover; background-position: center; }

        .couple-name { font-family: var(--font-serif); font-size: 1.5rem; color: var(--text-dark); margin-bottom: 6px; }
        .couple-parent { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .event-card { background: white; border: 1px solid rgba(197, 168, 128, 0.2); padding: 25px 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-bottom: 25px; }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.3rem; color: var(--text-dark); margin-bottom: 12px; font-weight: 400; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; background: transparent; color: var(--primary-dark); border: 1.5px solid var(--primary); padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-top: 15px; transition: all 0.3s; }
        .btn-action:hover { background: var(--primary); color: white; }

        .countdown-container { display: flex; justify-content: center; gap: 10px; margin: 20px 0; }
        .countdown-box { background: white; border: 1px solid rgba(197, 168, 128, 0.2); border-radius: 8px; width: 60px; height: 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .countdown-box span:first-child { font-size: 1.2rem; font-family: var(--font-serif); font-weight: 600; color: var(--primary-dark); }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; color: var(--text-light); }

        .story-timeline { text-align: left; padding-left: 20px; border-left: 2px solid var(--accent); margin-top: 25px; }
        .story-item { position: relative; margin-bottom: 30px; }
        .story-item::before { content: ''; position: absolute; left: -27px; top: 4px; width: 12px; height: 12px; border-radius: 50%; background: var(--primary); border: 2px solid white; }
        .story-date { font-weight: 600; font-size: 0.8rem; color: var(--primary-dark); margin-bottom: 5px; }
        .story-title { font-family: var(--font-serif); font-size: 1.1rem; margin-bottom: 8px; }
        .story-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .gallery-item { border-radius: 8px; overflow: hidden; aspect-ratio: 1; box-shadow: 0 4px 10px rgba(0,0,0,0.03); }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .gallery-item:hover img { transform: scale(1.1); }

        .gift-box { background: white; border: 1px dashed var(--primary); padding: 25px; border-radius: 12px; margin-top: 20px; }
        .btn-copy { background: var(--primary); color: white; border: none; padding: 8px 20px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 10px; }

        .form-wrap { background: white; border: 1px solid rgba(197, 168, 128, 0.2); padding: 25px 15px; border-radius: 12px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.85rem; }
        .btn-submit { width: 100%; padding: 12px; background: var(--primary); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; text-align: left; }
        .wish-card { background: white; padding: 12px; border-radius: 8px; border-left: 4px solid var(--primary); margin-bottom: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; }
        .wish-status { background: #f0ebe4; padding: 2px 8px; border-radius: 10px; font-size: 0.65rem; }
        .wish-content { font-size: 0.75rem; color: var(--text-light); }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 95px; right: 20px; }
        .scroll-control { bottom: 155px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-control.active i { color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p>The Wedding Invitation of</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span>Kepada Yth. Bapak/Ibu/Saudara/i:</span>
            <h3>{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
            <p style="font-size: 0.7rem; color: #ddd; margin-top: 5px;">Kami memohon kehadiran Anda di hari bahagia kami</p>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            <i class="bi bi-envelope-open"></i> BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <div class="inner-wrapper">
            <audio id="bg-audio" loop preload="auto">
                <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
            </audio>

            <!-- HERO -->
            <section id="home">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-bl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-br" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    
                    <span class="section-subtitle">Save The Date</span>
                    <h2>{{ $couple['groom'] }} & {{ $couple['bride'] }}</h2>
                    <div class="script-divider">The Wedding</div>
                    <h4 style="font-family: var(--font-serif); font-size: 1.1rem; font-weight: 400; margin-top: 15px;">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}
                    </h4>
                </div>
            </section>

            <!-- MEMPELAI -->
            <section id="couple-sec">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-bl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-br" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    
                    <span class="section-subtitle">Groom & Bride</span>
                    <h2 class="section-title">Mempelai</h2>
                    <p style="font-size: 0.8rem; line-height: 1.6; color: var(--text-light); margin-bottom: 25px;">
                        Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Dengan memohon rahmat dan ridho-Mu, kami mengundang Anda menghadiri hari bahagia kami:
                    </p>

                    <div class="couple-wrapper" data-aos="fade-up">
                        <div class="photo-container">
                            <div class="photo-border">
                                <div class="photo-img" style="background-image: url('{{ $bg['groom'] }}');"></div>
                            </div>
                        </div>
                        <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                        <p class="couple-parent">Putra Kedua dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                    </div>

                    <div class="script-divider">&</div>

                    <div class="couple-wrapper" data-aos="fade-up">
                        <div class="photo-container">
                            <div class="photo-border">
                                <div class="photo-img" style="background-image: url('{{ $bg['bride'] }}');"></div>
                            </div>
                        </div>
                        <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                        <p class="couple-parent">Putri Pertama dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                    </div>
                </div>
            </section>

            <!-- ACARA -->
            <section id="event-sec">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-bl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-br" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    
                    <span class="section-subtitle">Save The Date</span>
                    <h2 class="section-title">Acara Pernikahan</h2>

                    <div class="event-card" data-aos="fade-up">
                        <h3>{{ $schedule[0]['title'] }}</h3>
                        <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                            {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                        </p>
                        <p style="font-size: 0.8rem; margin-bottom: 12px;"><i class="bi bi-clock"></i> Pukul {{ $schedule[0]['time'] }}</p>
                        <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[0]['note'] }}</p>
                    </div>

                    <div class="event-card" data-aos="fade-up">
                        <h3>{{ $schedule[1]['title'] }}</h3>
                        <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                            {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                        </p>
                        <p style="font-size: 0.8rem; margin-bottom: 12px;"><i class="bi bi-clock"></i> Pukul {{ $schedule[1]['time'] }}</p>
                        <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[1]['note'] }}</p>
                    </div>

                    <div class="event-card" data-aos="fade-up">
                        <p style="font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">{{ $event['location'] }}</p>
                        <p style="font-size: 0.75rem; color: var(--text-light); line-height: 1.5;">{{ $event['address'] }}</p>
                        <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">
                            <i class="bi bi-geo-alt"></i> LIHAT PETA LOKASI
                        </a>
                    </div>

                    <div class="countdown-container" data-aos="fade-up">
                        <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                        <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                        <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                        <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
                    </div>
                </div>
            </section>

            <!-- STORIES -->
            <section id="story-sec">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <span class="section-subtitle">Our Love Journey</span>
                    <h2 class="section-title">Kisah Cinta</h2>

                    <div class="story-timeline">
                        @foreach($stories as $s)
                        <div class="story-item" data-aos="fade-up">
                            <div class="story-date">{{ $s['date'] }}</div>
                            <h4 class="story-title">{{ $s['title'] }}</h4>
                            <p class="story-content">{{ $s['text'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- GALERI -->
            <section id="gallery-sec">
                <div class="section-frame">
                    <svg class="corner-ornament corner-tl" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <svg class="corner-ornament corner-tr" viewBox="0 0 50 50">[[CORNER_SVG]]</svg>
                    <span class="section-subtitle">Our Memories</span>
                    <h2 class="section-title">Galeri Foto</h2>

                    <div class="gallery-grid">
                        @foreach($gallery as $img)
                        <div class="gallery-item" data-aos="zoom-in">
                            <img src="{{ $img }}" alt="Galeri">
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- GIFT / DOMPET -->
            <section id="gift-sec">
                <div class="section-frame">
                    <span class="section-subtitle">Share Love</span>
                    <h2 class="section-title">Kirim Hadiah</h2>
                    <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.6;">
                        Bagi keluarga dan sahabat yang ingin mengirimkan hadiah, dapat mengirimkan secara non-tunai melalui rekening berikut:
                    </p>

                    <div class="gift-box" data-aos="fade-up">
                        <p style="font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; color: var(--primary-dark);">BANK BCA</p>
                        <h3 style="font-family: var(--font-serif); margin: 8px 0; font-size: 1.4rem;">123-456-7890</h3>
                        <p style="font-size: 0.8rem; color: var(--text-light);">a.n. {{ $couple['groom'] }}</p>
                        <button class="btn-copy" onclick="copyRek('123-456-7890')">SALIN REKENING</button>
                    </div>
                </div>
            </section>

            <!-- RSVP -->
            <section id="rsvp-sec">
                <div class="section-frame">
                    <span class="section-subtitle">Join Our Joy</span>
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
                                    <option value="Hadir">Hadir</option>
                                    <option value="Tidak Hadir">Berhalangan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ucapan & Doa</label>
                                <textarea id="pesan" class="form-input" rows="4" placeholder="Tulis ucapan selamat Anda" required></textarea>
                            </div>
                            <button type="submit" class="btn-submit">KIRIM KONFIRMASI</button>
                        </form>
                    </div>

                    <div class="wish-list">
                        <div class="wish-card">
                            <div class="wish-header">
                                <span class="wish-name">Rian & Keluarga</span>
                                <span class="wish-status">Hadir</span>
                            </div>
                            <p class="wish-content">Selamat menempuh hidup baru! Semoga lancar dan berkah selalu.</p>
                        </div>
                        <div class="wish-card">
                            <div class="wish-header">
                                <span class="wish-name">Siti</span>
                                <span class="wish-status">Berhalangan</span>
                            </div>
                            <p class="wish-content">Maaf berhalangan hadir. Selamat berbahagia ya, doa terbaik untuk kalian!</p>
                        </div>
                        <div id="wishList"></div>
                    </div>
                </div>
            </section>

            <div style="text-align: center; padding: 30px; font-size: 0.7rem; color: var(--text-light);">
                Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
            </div>
        </div>
    </div>

    <!-- Navigasi Bawah -->
    <div class="bottom-nav" id="bottomNav">
        <a href="#home" class="nav-item active"><i class="bi bi-house-door"></i><span>Home</span></a>
        <a href="#couple-sec" class="nav-item"><i class="bi bi-heart"></i><span>Mempelai</span></a>
        <a href="#event-sec" class="nav-item"><i class="bi bi-calendar-event"></i><span>Acara</span></a>
        <a href="#story-sec" class="nav-item"><i class="bi bi-book"></i><span>Cerita</span></a>
        <a href="#rsvp-sec" class="nav-item"><i class="bi bi-envelope"></i><span>RSVP</span></a>
    </div>

    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
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

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Autoplay blocked. User interaction required."));
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const control = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); control.classList.add('playing'); }
            else { audio.pause(); control.classList.remove('playing'); }
        }

        function scrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, autoscrollSpeed);
            const currentScroll = window.innerHeight + window.pageYOffset;
            const bottomLimit = document.documentElement.scrollHeight - 5;
            if (currentScroll >= bottomLimit) { stopAutoscroll(); return; }
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

        function copyRek(num) {
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
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert(" RSVP berhasil dikirim!");
        }

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
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
    </script>
</body>
</html>
HTML;


// Layout B: Modern Split-Screen (Long-Scroll, Flat Design, Side Slide-out Hamburger)
$skeletonB = <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    [[GOOGLE_FONTS]]
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: [[COLOR_PRIMARY]]; 
            --primary-dark: [[COLOR_PRIMARY_DARK]];
            --accent: [[COLOR_ACCENT]]; 
            --bg-dark: [[COLOR_BG_DARK]]; 
            --text-dark: #2A2C2A;
            --text-light: #6E726E;
            --font-serif: [[FONT_SERIF]];
            --font-sans: 'Montserrat', sans-serif;
            --font-script: [[FONT_SCRIPT]];
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: var(--accent); min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding-bottom: 40px; }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: white; text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-title { font-family: var(--font-script); font-size: 3.5rem; color: var(--primary); margin: 10px 0; }
        .cover-guest-card { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15); padding: 25px 20px; border-radius: 20px; width: 100%; margin-bottom: 30px; }
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: var(--primary); color: white; font-family: var(--font-sans); font-weight: 600; font-size: 0.85rem; letter-spacing: 2px; padding: 14px 30px; border-radius: 50px; border: none; cursor: pointer; transition: all 0.3s; }

        /* Floating hamburger trigger instead of bottom nav */
        .menu-trigger { position: fixed; top: 20px; right: 20px; width: 45px; height: 45px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.15); opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .menu-trigger.visible { opacity: 1; visibility: visible; }
        
        .overlay-menu { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; background: rgba(0, 0, 0, 0.95); z-index: 9999; display: flex; flex-direction: column; justify-content: center; align-items: center; opacity: 0; visibility: hidden; transition: all 0.4s ease; }
        .overlay-menu.open { opacity: 1; visibility: visible; }
        .close-trigger { position: absolute; top: 20px; right: 20px; font-size: 2rem; color: white; cursor: pointer; }
        .menu-links { display: flex; flex-direction: column; gap: 25px; text-align: center; }
        .menu-links a { font-family: var(--font-serif); font-size: 1.5rem; color: #bbb; text-decoration: none; letter-spacing: 2px; transition: color 0.3s; }
        .menu-links a:hover { color: var(--primary); }

        section { padding: 60px 20px; position: relative; text-align: center; }
        
        .section-subtitle { font-size: 0.75rem; letter-spacing: 4px; text-transform: uppercase; color: var(--primary); margin-bottom: 10px; font-weight: 600; display: block; }
        .section-title { font-family: var(--font-serif); font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 25px; font-weight: 400; text-transform: uppercase; }
        .script-divider { font-family: var(--font-script); font-size: 2.5rem; color: var(--primary); margin: 20px 0; }

        /* Modern capsule images */
        .couple-wrapper { margin: 40px 0; background: white; border-radius: 30px; padding: 30px 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .capsule-photo { width: 150px; height: 230px; margin: 0 auto 20px; border-radius: 75px; background-size: cover; background-position: center; border: 4px solid var(--accent); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }

        .couple-name { font-family: var(--font-serif); font-size: 1.6rem; color: var(--primary-dark); margin-bottom: 6px; }
        .couple-parent { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .event-card { background: white; border-radius: 24px; padding: 35px 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); margin-bottom: 25px; text-align: center; border: 1px solid rgba(0,0,0,0.02); }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.4rem; color: var(--primary-dark); margin-bottom: 12px; font-weight: 600; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; background: var(--primary); color: white; padding: 10px 25px; border-radius: 30px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-top: 15px; transition: all 0.3s; }

        .countdown-container { display: flex; justify-content: center; gap: 12px; margin: 25px 0; }
        .countdown-box { background: var(--primary-dark); border-radius: 12px; width: 65px; height: 65px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; }
        .countdown-box span:first-child { font-size: 1.3rem; font-family: var(--font-serif); font-weight: 600; }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; opacity: 0.85; }

        .story-timeline { text-align: center; margin-top: 25px; }
        .story-item { background: white; border-radius: 20px; padding: 25px; margin-bottom: 25px; box-shadow: 0 8px 25px rgba(0,0,0,0.02); }
        .story-date { font-weight: 600; font-size: 0.8rem; color: var(--primary); margin-bottom: 8px; }
        .story-title { font-family: var(--font-serif); font-size: 1.2rem; margin-bottom: 8px; color: var(--primary-dark); }
        .story-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .gallery-item { border-radius: 16px; overflow: hidden; aspect-ratio: 1; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }

        .gift-box { background: white; padding: 30px; border-radius: 24px; margin-top: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.02); }
        .btn-copy { background: var(--primary-dark); color: white; border: none; padding: 10px 25px; border-radius: 30px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 15px; }

        .form-wrap { background: white; padding: 30px 20px; border-radius: 24px; text-align: left; box-shadow: 0 8px 25px rgba(0,0,0,0.02); }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; color: var(--primary-dark); }
        .form-input { width: 100%; padding: 12px; border: 1px solid #e2ded8; border-radius: 8px; font-size: 0.85rem; background: var(--accent); }
        .btn-submit { width: 100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; letter-spacing: 1px; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; }
        .wish-card { background: white; padding: 15px; border-radius: 16px; margin-bottom: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); text-align: left; }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; color: var(--primary-dark); }
        .wish-status { background: var(--accent); padding: 2px 8px; border-radius: 10px; font-size: 0.65rem; }
        .wish-content { font-size: 0.75rem; color: var(--text-light); }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 25px; left: 20px; }
        .scroll-control { bottom: 25px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p style="letter-spacing: 3px; font-size: 0.75rem; text-transform: uppercase;">Undangan Pernikahan</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.7rem; color: #ccc; letter-spacing: 1px;">Kpd. Yth Bapak/Ibu/Saudara/i:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.4rem; color: white; margin-top: 5px;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            BUKA UNDANGAN <i class="bi bi-arrow-right"></i>
        </button>
    </div>

    <!-- Slide-out overlay menu triggered by top hamburger -->
    <div class="overlay-menu" id="overlayMenu">
        <div class="close-trigger" onclick="toggleOverlayMenu()"><i class="bi bi-x"></i></div>
        <div class="menu-links">
            <a href="#home" onclick="toggleOverlayMenu()">HOME</a>
            <a href="#couple-sec" onclick="toggleOverlayMenu()">MEMPELAI</a>
            <a href="#event-sec" onclick="toggleOverlayMenu()">ACARA</a>
            <a href="#story-sec" onclick="toggleOverlayMenu()">KISAH KAMI</a>
            <a href="#gallery-sec" onclick="toggleOverlayMenu()">GALERI</a>
            <a href="#rsvp-sec" onclick="toggleOverlayMenu()">RSVP</a>
        </div>
    </div>

    <!-- Top floating hamburger menu -->
    <div class="menu-trigger" id="menuTrigger" onclick="toggleOverlayMenu()">
        <i class="bi bi-list"></i>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" type="audio/mpeg">
        </audio>

        <!-- HERO -->
        <section id="home" style="min-height: 80vh; display: flex; flex-direction: column; justify-content: center;">
            <span class="section-subtitle">The Marriage Celebration</span>
            <h1 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300; text-transform: uppercase; color: var(--primary-dark);">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
            <div class="script-divider">Love Begins</div>
            <h4 style="font-family: var(--font-sans); font-size: 0.9rem; letter-spacing: 2px; font-weight: 600;">
                {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
            </h4>
        </section>

        <!-- MEMPELAI -->
        <section id="couple-sec">
            <span class="section-subtitle">Meet The Couple</span>
            <h2 class="section-title">Mempelai</h2>
            
            <div class="couple-wrapper" data-aos="fade-up">
                <div class="capsule-photo" style="background-image: url('{{ $bg['groom'] }}');"></div>
                <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                <p class="couple-parent">Putra dari Pasangan<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
            </div>

            <div class="couple-wrapper" data-aos="fade-up">
                <div class="capsule-photo" style="background-image: url('{{ $bg['bride'] }}');"></div>
                <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                <p class="couple-parent">Putri dari Pasangan<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
            </div>
        </section>

        <!-- ACARA -->
        <section id="event-sec">
            <span class="section-subtitle">Save The Time</span>
            <h2 class="section-title">Acara</h2>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[0]['title'] }}</h3>
                <p style="font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.85rem;"><i class="bi bi-clock"></i> {{ $schedule[0]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">{{ $schedule[0]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[1]['title'] }}</h3>
                <p style="font-weight: 600; color: var(--primary); margin-bottom: 8px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.85rem;"><i class="bi bi-clock"></i> {{ $schedule[1]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light); margin-top: 5px;">{{ $schedule[1]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <p style="font-weight: 600; margin-bottom: 5px;">{{ $event['location'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light);">{{ $event['address'] }}</p>
                <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">
                    <i class="bi bi-geo-alt"></i> Buka Google Maps
                </a>
            </div>

            <div class="countdown-container" data-aos="fade-up">
                <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
            </div>
        </section>

        <!-- TIMELINE KISAH -->
        <section id="story-sec">
            <span class="section-subtitle">Our Timeline</span>
            <h2 class="section-title">Cerita Kami</h2>

            <div class="story-timeline">
                @foreach($stories as $s)
                <div class="story-item" data-aos="fade-up">
                    <div class="story-date">{{ $s['date'] }}</div>
                    <h4 class="story-title">{{ $s['title'] }}</h4>
                    <p class="story-content">{{ $s['text'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- GALERI -->
        <section id="gallery-sec">
            <span class="section-subtitle">Photo Gallery</span>
            <h2 class="section-title">Galeri</h2>

            <div class="gallery-grid">
                @foreach($gallery as $img)
                <div class="gallery-item" data-aos="zoom-in">
                    <img src="{{ $img }}" alt="Gallery Image">
                </div>
                @endforeach
            </div>
        </section>

        <!-- HADIAH -->
        <section id="gift-sec">
            <span class="section-subtitle">Share Blessings</span>
            <h2 class="section-title">Hadiah</h2>

            <div class="gift-box" data-aos="fade-up">
                <p style="font-weight: bold; font-size: 0.8rem; color: var(--primary);">TRANSFER BANK</p>
                <h3 style="font-family: var(--font-serif); margin: 5px 0;">123-456-7890</h3>
                <p style="font-size: 0.8rem; color: var(--text-light); mb-2">BCA a.n. {{ $couple['groom'] }}</p>
                <button class="btn-copy" onclick="copyRek('123-456-7890')">SALIN REKENING</button>
            </div>
        </section>

        <!-- RSVP -->
        <section id="rsvp-sec">
            <span class="section-subtitle">Be Our Guest</span>
            <h2 class="section-title">RSVP</h2>

            <div class="form-wrap" data-aos="fade-up">
                <form id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div class="form-group">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" id="nama" class="form-input" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kehadiran</label>
                        <select id="kehadiran" class="form-input" required>
                            <option value="Hadir">Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ucapan & Doa Restu</label>
                        <textarea id="pesan" class="form-input" rows="3" placeholder="Tulis doa restu Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">KIRIM UCAPAN</button>
                </form>
            </div>

            <div class="wish-list">
                <div class="wish-card">
                    <div class="wish-header">
                        <span class="wish-name">Hendra</span>
                        <span class="wish-status">Hadir</span>
                    </div>
                    <p class="wish-content">Selamat Raka & Nadya! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.</p>
                </div>
                <div id="wishList"></div>
            </div>
        </section>

        <div style="text-align: center; font-size: 0.7rem; color: var(--text-light); margin-top: 30px;">
            Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
        </div>
    </div>

    <!-- Floating controls -->
    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
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

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio play blocked."));
            document.getElementById('menuTrigger').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        function toggleOverlayMenu() {
            document.getElementById('overlayMenu').classList.toggle('open');
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
            if (current >= (document.documentElement.scrollHeight - 5)) { stopAutoscroll(); return; }
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

        function copyRek(num) {
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
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP berhasil dikirim!");
        }
    </script>
</body>
</html>
HTML;


// Layout C: Full-Screen Snap-Scroll (Page-based, dots indicator navigation)
$skeletonC = <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    [[GOOGLE_FONTS]]
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: [[COLOR_PRIMARY]]; 
            --primary-dark: [[COLOR_PRIMARY_DARK]];
            --accent: [[COLOR_ACCENT]]; 
            --bg-dark: [[COLOR_BG_DARK]]; 
            --text-dark: #333;
            --text-light: #666;
            --font-serif: [[FONT_SERIF]];
            --font-sans: 'Montserrat', sans-serif;
            --font-script: [[FONT_SCRIPT]];
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow: hidden; }

        .wrapper { width: 100%; max-width: 480px; height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); background: var(--accent); }
        
        /* CSS Snap scroll container */
        .snap-container { height: 100%; overflow-y: scroll; scroll-snap-type: y mandatory; scroll-behavior: smooth; -webkit-overflow-scrolling: touch; scrollbar-width: none; }
        .snap-container::-webkit-scrollbar { width: 0; height: 0; }

        section { height: 100vh; scroll-snap-align: start; padding: 50px 25px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; position: relative; box-sizing: border-box; }
        section::before { content: ''; position: absolute; inset: 0; background: url('[[TEXTURE]]') repeat; opacity: 0.15; z-index: -1; }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.85)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: white; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }

        .section-subtitle { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 10px; font-weight: 600; }
        .section-title { font-family: var(--font-serif); font-size: 2rem; color: var(--primary-dark); margin-bottom: 20px; font-weight: 400; }
        .script-divider { font-family: var(--font-script); font-size: 2.3rem; color: var(--primary); margin: 10px 0; }

        /* Side navigation dots */
        .side-dots { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); display: flex; flex-direction: column; gap: 12px; z-index: 100; opacity: 0; visibility: hidden; transition: opacity 0.5s; }
        .side-dots.visible { opacity: 1; visibility: visible; }
        .dot { width: 8px; height: 8px; border-radius: 50%; border: 1.5px solid var(--primary-dark); background: transparent; cursor: pointer; transition: all 0.3s; }
        .dot.active { background: var(--primary-dark); transform: scale(1.4); }

        .couple-photo { width: 120px; height: 120px; border-radius: 50%; background-size: cover; background-position: center; margin: 0 auto 15px; border: 3px solid var(--primary); box-shadow: 0 4px 12px rgba(0,0,0,0.06); }
        .couple-name { font-family: var(--font-serif); font-size: 1.3rem; color: var(--primary-dark); }
        
        .event-box { background: white; border-radius: 16px; padding: 25px 20px; width: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.02); margin-top: 15px; border: 1px solid rgba(0,0,0,0.03); }
        .countdown-container { display: flex; justify-content: center; gap: 8px; margin-top: 15px; }
        .countdown-box { background: var(--primary); border-radius: 8px; width: 50px; height: 50px; display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; }
        .countdown-box span:first-child { font-size: 1.1rem; font-family: var(--font-serif); font-weight: 600; }
        .countdown-box span:last-child { font-size: 0.5rem; text-transform: uppercase; }

        .story-timeline { text-align: left; max-height: 250px; overflow-y: auto; padding-right: 5px; width: 100%; }
        .story-item { border-left: 2px solid var(--primary); padding-left: 15px; position: relative; margin-bottom: 20px; }
        .story-item::before { content: ''; position: absolute; left: -6px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background: var(--primary-dark); }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; width: 100%; }
        .gallery-item { border-radius: 12px; overflow: hidden; aspect-ratio: 1; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        .form-wrap { background: white; padding: 20px 15px; border-radius: 16px; width: 100%; text-align: left; border: 1px solid rgba(0,0,0,0.02); }
        .form-group { margin-bottom: 10px; }
        .form-label { font-size: 0.75rem; font-weight: 600; display: block; margin-bottom: 3px; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.8rem; }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 25px; left: 20px; }
        .scroll-control { bottom: 25px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div>
            <p style="letter-spacing: 4px; font-size: 0.75rem; text-transform: uppercase;">Undangan Pernikahan</p>
            <h1 style="font-family: var(--font-script); font-size: 3rem; color: var(--primary); margin: 15px 0;">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.75rem; text-transform: uppercase;">Kpd. Yth:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.3rem; margin: 5px 0;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()" style="padding: 12px 30px; border-radius: 30px; background: var(--primary); color: white; border: none; font-weight: 600; letter-spacing: 1px; cursor: pointer;">
            BUKA UNDANGAN
        </button>
    </div>

    <!-- Side dots navigation -->
    <div class="side-dots" id="sideDots">
        <div class="dot active" onclick="scrollToSection('home')"></div>
        <div class="dot" onclick="scrollToSection('couple-sec')"></div>
        <div class="dot" onclick="scrollToSection('event-sec')"></div>
        <div class="dot" onclick="scrollToSection('story-sec')"></div>
        <div class="dot" onclick="scrollToSection('gallery-sec')"></div>
        <div class="dot" onclick="scrollToSection('rsvp-sec')"></div>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3" type="audio/mpeg">
        </audio>

        <div class="snap-container" id="snapContainer">
            <!-- HERO -->
            <section id="home">
                <span class="section-subtitle">Save The Date</span>
                <h1 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300;">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
                <div class="script-divider">The Marriage</div>
                <h4 style="font-family: var(--font-sans); font-size: 0.9rem; font-weight: 600; letter-spacing: 1px; margin-top: 10px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}
                </h4>
            </section>

            <!-- MEMPELAI -->
            <section id="couple-sec">
                <span class="section-subtitle">Groom & Bride</span>
                <h2 class="section-title">Mempelai</h2>
                
                <div style="width: 100%; display: flex; justify-content: space-around; gap: 10px; margin-top: 10px;">
                    <div style="flex: 1;">
                        <div class="couple-photo" style="background-image: url('{{ $bg['groom'] }}');"></div>
                        <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                        <p style="font-size: 0.7rem; color: var(--text-light); margin-top: 5px;">{{ $couple['parents']['groom'] }}</p>
                    </div>
                    <div style="flex: 1;">
                        <div class="couple-photo" style="background-image: url('{{ $bg['bride'] }}');"></div>
                        <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                        <p style="font-size: 0.7rem; color: var(--text-light); margin-top: 5px;">{{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </section>

            <!-- ACARA -->
            <section id="event-sec">
                <span class="section-subtitle">The Ceremony</span>
                <h2 class="section-title">Waktu & Lokasi</h2>

                <div class="event-box">
                    <p style="font-size: 0.8rem; font-weight: 600; color: var(--primary);">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p style="font-size: 0.75rem; margin-top: 5px;"><strong>{{ $schedule[0]['title'] }}:</strong> {{ $schedule[0]['time'] }}</p>
                    <p style="font-size: 0.75rem;"><strong>{{ $schedule[1]['title'] }}:</strong> {{ $schedule[1]['time'] }}</p>
                    <p style="font-size: 0.75rem; margin-top: 5px; color: var(--text-light);">{{ $event['location'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">Maps</a>
                </div>

                <div class="countdown-container">
                    <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                    <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                    <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                    <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
                </div>
            </section>

            <!-- STORIES -->
            <section id="story-sec">
                <span class="section-subtitle">Our Timeline</span>
                <h2 class="section-title">Cerita</h2>

                <div class="story-timeline">
                    @foreach($stories as $s)
                    <div class="story-item">
                        <p style="font-size: 0.75rem; font-weight: 600; color: var(--primary);">{{ $s['date'] }} - {{ $s['title'] }}</p>
                        <p style="font-size: 0.75rem; color: var(--text-light); margin-top: 2px;">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- GALERI -->
            <section id="gallery-sec">
                <span class="section-subtitle">Memories</span>
                <h2 class="section-title">Galeri</h2>

                <div class="gallery-grid">
                    @foreach($gallery as $img)
                    <div class="gallery-item">
                        <img src="{{ $img }}" alt="Gallery Image">
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- RSVP -->
            <section id="rsvp-sec">
                <span class="section-subtitle">Join Us</span>
                <h2 class="section-title">RSVP</h2>

                <div class="form-wrap">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <input type="text" id="nama" class="form-input" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <select id="kehadiran" class="form-input" required>
                                <option value="Hadir">Saya Akan Hadir</option>
                                <option value="Tidak Hadir">Berhalangan Hadir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea id="pesan" class="form-input" rows="2" placeholder="Doa Restu & Ucapan" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit" style="padding: 10px;">KIRIM</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Floating controllers directly under body to keep fixed coordinates stable in snap context -->
    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
        <div class="scroll-control" id="scrollControl" onclick="toggleAutoscroll()">
            <i class="bi bi-chevron-double-down"></i>
            <span class="scroll-badge">Auto Play</span>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        let isAutoscrolling = false;
        let autoAdvanceInterval;

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Audio block."));
            document.getElementById('sideDots').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
        }

        function scrollToSection(id) {
            const el = document.getElementById(id);
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }

        function toggleMusic() {
            const audio = document.getElementById('bg-audio');
            const ctrl = document.getElementById('musicControl');
            if (audio.paused) { audio.play(); ctrl.classList.add('playing'); }
            else { audio.pause(); ctrl.classList.remove('playing'); }
        }

        // Snap Scroll Auto-Advance periodically
        function advanceSection() {
            const sections = ['home', 'couple-sec', 'event-sec', 'story-sec', 'gallery-sec', 'rsvp-sec'];
            const container = document.getElementById('snapContainer');
            
            // Find which section is currently visible based on scroll position
            const scrollPos = container.scrollTop;
            const height = container.clientHeight;
            let currentIdx = Math.round(scrollPos / height);
            
            let nextIdx = (currentIdx + 1) % sections.length;
            scrollToSection(sections[nextIdx]);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.add('active');
            ctrl.querySelector('i').className = 'bi bi-pause-fill';
            
            autoAdvanceInterval = setInterval(advanceSection, 6000);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const ctrl = document.getElementById('scrollControl');
            ctrl.classList.remove('active');
            ctrl.querySelector('i').className = 'bi bi-chevron-double-down';
            
            clearInterval(autoAdvanceInterval);
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) stopAutoscroll(); else startAutoscroll();
        }

        document.addEventListener("DOMContentLoaded", function() {
            initCountdown();
            
            // Stop auto advance if user touches/scrolls the container
            const container = document.getElementById('snapContainer');
            ['touchstart', 'wheel'].forEach(evt => {
                container.addEventListener(evt, () => {
                    if (isAutoscrolling) stopAutoscroll();
                }, { passive: true });
            });

            // Intersection Observer to highlight active dots
            const sections = document.querySelectorAll('section');
            const dots = document.querySelectorAll('.dot');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        dots.forEach(dot => {
                            dot.classList.remove('active');
                            if (dot.getAttribute('onclick').includes(id)) {
                                dot.classList.add('active');
                            }
                        });
                    }
                });
            }, {
                root: container,
                threshold: 0.5
            });
            sections.forEach(sec => observer.observe(sec));
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

        function submitRsvp(e) {
            e.preventDefault();
            alert("RSVP berhasil dikirim!");
            document.getElementById('rsvp-form').reset();
        }
    </script>
</body>
</html>
HTML;


// Layout D: Botanical Watercolor (Long-Scroll, delicate circles, floating watercolor background elements)
$skeletonD = <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    [[GOOGLE_FONTS]]
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: [[COLOR_PRIMARY]]; 
            --primary-dark: [[COLOR_PRIMARY_DARK]];
            --accent: [[COLOR_ACCENT]]; 
            --bg-dark: [[COLOR_BG_DARK]]; 
            --text-dark: #3a3b3a;
            --text-light: #707570;
            --font-serif: [[FONT_SERIF]];
            --font-sans: 'Montserrat', sans-serif;
            --font-script: [[FONT_SCRIPT]];
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: var(--accent); min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding: 15px; padding-bottom: 95px; }

        /* Delicate watercolor background elements */
        .watercolor-bg-1, .watercolor-bg-2 { position: absolute; width: 250px; height: 250px; border-radius: 50%; filter: blur(60px); z-index: 0; opacity: 0.6; pointer-events: none; }
        .watercolor-bg-1 { top: 100px; left: -80px; background: radial-gradient(circle, var(--primary) 0%, transparent 70%); }
        .watercolor-bg-2 { bottom: 400px; right: -80px; background: radial-gradient(circle, var(--primary-dark) 0%, transparent 70%); }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.85)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 50px 30px; color: var(--text-dark); text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-title { font-family: var(--font-script); font-size: 3.5rem; color: var(--primary-dark); margin: 15px 0; }
        .cover-guest-card { background: rgba(255, 255, 255, 0.85); border: 1px solid var(--primary); padding: 25px 20px; border-radius: 30px; width: 100%; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: var(--primary-dark); color: white; font-family: var(--font-sans); font-weight: 600; font-size: 0.85rem; letter-spacing: 1.5px; padding: 12px 25px; border-radius: 30px; border: none; cursor: pointer; transition: all 0.3s; }

        /* Floating pill-shaped bottom nav */
        .bottom-nav-pill { position: fixed; bottom: 25px; left: 50%; transform: translateX(-50%); width: 85%; max-width: 380px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); border-radius: 50px; display: flex; justify-content: space-around; padding: 10px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08); z-index: 1000; opacity: 0; visibility: hidden; transition: opacity 0.5s, visibility 0.5s; border: 1px solid rgba(255,255,255,0.4); }
        .bottom-nav-pill.visible { opacity: 1; visibility: visible; }
        .nav-item { display: flex; flex-direction: column; align-items: center; text-decoration: none; color: var(--text-light); font-size: 0.65rem; transition: color 0.3s; }
        .nav-item i { font-size: 1.1rem; margin-bottom: 2px; }
        .nav-item.active { color: var(--primary-dark); font-weight: bold; }

        section { padding: 50px 10px; position: relative; text-align: center; z-index: 1; }
        .section-frame { border: 1px solid rgba(255, 255, 255, 0.8); background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(10px); padding: 40px 15px; border-radius: 30px; box-shadow: 0 4px 25px rgba(0,0,0,0.02); }

        .section-subtitle { font-size: 0.75rem; letter-spacing: 3px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 8px; font-weight: 600; }
        .section-title { font-family: var(--font-serif); font-size: 1.8rem; color: var(--text-dark); margin-bottom: 25px; font-weight: 400; }
        .script-divider { font-family: var(--font-script); font-size: 2.2rem; color: var(--primary-dark); margin: 15px 0; }

        /* Botanical circle frames */
        .couple-wrapper { margin: 35px 0; }
        .circle-photo { width: 140px; height: 140px; border-radius: 50%; margin: 0 auto 15px; border: 4px solid white; box-shadow: 0 6px 20px rgba(0,0,0,0.06); background-size: cover; background-position: center; }

        .couple-name { font-family: var(--font-serif); font-size: 1.4rem; color: var(--text-dark); margin-bottom: 5px; }
        .couple-parent { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .event-card { background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(255, 255, 255, 0.9); padding: 25px 20px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.01); margin-bottom: 20px; }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.2rem; color: var(--text-dark); margin-bottom: 8px; }
        .btn-action { display: inline-flex; align-items: center; gap: 8px; background: var(--primary-dark); color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 0.8rem; font-weight: 600; margin-top: 10px; }

        .countdown-container { display: flex; justify-content: center; gap: 10px; margin: 20px 0; }
        .countdown-box { background: white; border: 1px solid rgba(255,255,255,0.8); border-radius: 50%; width: 60px; height: 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .countdown-box span:first-child { font-size: 1.15rem; font-family: var(--font-serif); font-weight: 600; color: var(--primary-dark); }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; color: var(--text-light); }

        .story-timeline { text-align: left; padding-left: 15px; border-left: 2px solid var(--primary); margin-top: 25px; }
        .story-item { position: relative; margin-bottom: 25px; }
        .story-item::before { content: ''; position: absolute; left: -21px; top: 4px; width: 10px; height: 10px; border-radius: 50%; background: var(--primary); }
        .story-date { font-weight: 600; font-size: 0.8rem; color: var(--primary-dark); margin-bottom: 3px; }
        .story-title { font-family: var(--font-serif); font-size: 1rem; margin-bottom: 5px; }
        .story-content { font-size: 0.75rem; color: var(--text-light); line-height: 1.5; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; }
        .gallery-item { border-radius: 20px; overflow: hidden; aspect-ratio: 1; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        .gift-box { background: rgba(255, 255, 255, 0.8); padding: 25px; border-radius: 20px; margin-top: 20px; border: 1px solid rgba(255,255,255,0.9); }
        .btn-copy { background: var(--primary-dark); color: white; border: none; padding: 8px 20px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 10px; }

        .form-wrap { background: rgba(255,255,255,0.8); padding: 25px 15px; border-radius: 20px; text-align: left; border: 1px solid rgba(255,255,255,0.9); }
        .form-group { margin-bottom: 12px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 4px; }
        .form-input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 0.85rem; background: white; }
        .btn-submit { width: 100%; padding: 12px; background: var(--primary-dark); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; text-align: left; }
        .wish-card { background: white; padding: 12px; border-radius: 12px; border-left: 4px solid var(--primary); margin-bottom: 10px; }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 4px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; }
        .wish-status { background: var(--accent); padding: 2px 8px; border-radius: 10px; font-size: 0.65rem; }
        .wish-content { font-size: 0.75rem; color: var(--text-light); }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 95px; right: 20px; }
        .scroll-control { bottom: 155px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary-dark); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--primary-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 10px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p style="font-size: 0.75rem; letter-spacing: 3px;">WEDDING INVITATION</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.7rem; color: var(--text-light); letter-spacing: 1px;">Kpd. Yth Bapak/Ibu/Saudara/i:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.3rem; margin-top: 5px;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            <i class="bi bi-heart"></i> BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <div class="watercolor-bg-1"></div>
        <div class="watercolor-bg-2"></div>

        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3" type="audio/mpeg">
        </audio>

        <!-- HERO -->
        <section id="home">
            <div class="section-frame">
                <span class="section-subtitle">Save The Date</span>
                <h2>{{ $couple['groom'] }} & {{ $couple['bride'] }}</h2>
                <div class="script-divider">The Wedding Ceremony</div>
                <h4 style="font-family: var(--font-serif); font-size: 1rem; font-weight: 400; margin-top: 15px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d.m.y') }}
                </h4>
            </div>
        </section>

        <!-- MEMPELAI -->
        <section id="couple-sec">
            <div class="section-frame">
                <span class="section-subtitle">Groom & Bride</span>
                <h2 class="section-title">Mempelai</h2>

                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="circle-photo" style="background-image: url('{{ $bg['groom'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                    <p class="couple-parent">Putra dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                </div>

                <div class="script-divider">&</div>

                <div class="couple-wrapper" data-aos="fade-up">
                    <div class="circle-photo" style="background-image: url('{{ $bg['bride'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                    <p class="couple-parent">Putri dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                </div>
            </div>
        </section>

        <!-- ACARA -->
        <section id="event-sec">
            <div class="section-frame">
                <span class="section-subtitle">Wedding Events</span>
                <h2 class="section-title">Waktu & Tempat</h2>

                <div class="event-card" data-aos="fade-up">
                    <h3>{{ $schedule[0]['title'] }}</h3>
                    <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary-dark); margin-bottom: 8px;">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[0]['time'] }}</p>
                    <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[0]['note'] }}</p>
                </div>

                <div class="event-card" data-aos="fade-up">
                    <h3>{{ $schedule[1]['title'] }}</h3>
                    <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary-dark); margin-bottom: 8px;">
                        {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                    </p>
                    <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[1]['time'] }}</p>
                    <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[1]['note'] }}</p>
                </div>

                <div class="event-card" data-aos="fade-up">
                    <p style="font-weight: 600; font-size: 0.9rem; margin-bottom: 5px;">{{ $event['location'] }}</p>
                    <p style="font-size: 0.75rem; color: var(--text-light); line-height: 1.5;">{{ $event['address'] }}</p>
                    <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">
                        <i class="bi bi-geo-alt"></i> Petunjuk Arah
                    </a>
                </div>

                <div class="countdown-container" data-aos="fade-up">
                    <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                    <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                    <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                    <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
                </div>
            </div>
        </section>

        <!-- STORIES -->
        <section id="story-sec">
            <div class="section-frame">
                <span class="section-subtitle">Our Journey</span>
                <h2 class="section-title">Kisah Cinta</h2>

                <div class="story-timeline">
                    @foreach($stories as $s)
                    <div class="story-item" data-aos="fade-up">
                        <div class="story-date">{{ $s['date'] }}</div>
                        <h4 class="story-title">{{ $s['title'] }}</h4>
                        <p class="story-content">{{ $s['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- GALERI -->
        <section id="gallery-sec">
            <div class="section-frame">
                <span class="section-subtitle">Memories</span>
                <h2 class="section-title">Galeri Foto</h2>

                <div class="gallery-grid">
                    @foreach($gallery as $img)
                    <div class="gallery-item" data-aos="zoom-in">
                        <img src="{{ $img }}" alt="Galeri">
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- RSVP -->
        <section id="rsvp-sec">
            <div class="section-frame">
                <span class="section-subtitle">Presence</span>
                <h2 class="section-title">Konfirmasi & Ucapan</h2>

                <div class="form-wrap" data-aos="fade-up">
                    <form id="rsvp-form" onsubmit="submitRsvp(event)">
                        <div class="form-group">
                            <label class="form-label">Nama Anda</label>
                            <input type="text" id="nama" class="form-input" placeholder="Masukkan nama" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kehadiran</label>
                            <select id="kehadiran" class="form-input" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Tidak Hadir">Berhalangan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Doa & Ucapan</label>
                            <textarea id="pesan" class="form-input" rows="3" placeholder="Tulis ucapan selamat Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">KIRIM</button>
                    </form>
                </div>

                <div class="wish-list">
                    <div class="wish-card">
                        <div class="wish-header">
                            <span class="wish-name">Fajar</span>
                            <span class="wish-status">Hadir</span>
                        </div>
                        <p class="wish-content">Lancar jaya berkah melimpah sakinah warahmah selamanya!</p>
                    </div>
                    <div id="wishList"></div>
                </div>
            </div>
        </section>

        <div style="text-align: center; padding: 20px 0; font-size: 0.75rem; color: var(--text-light);">
            Created with <i class="bi bi-heart-fill" style="color: var(--primary-dark);"></i> TemuRuang
        </div>
    </div>

    <!-- Floating Pill Navigation Bar -->
    <div class="bottom-nav-pill" id="bottomNav">
        <a href="#home" class="nav-item active"><i class="bi bi-house"></i><span>Home</span></a>
        <a href="#couple-sec" class="nav-item"><i class="bi bi-heart"></i><span>Mempelai</span></a>
        <a href="#event-sec" class="nav-item"><i class="bi bi-calendar"></i><span>Acara</span></a>
        <a href="#story-sec" class="nav-item"><i class="bi bi-clock-history"></i><span>Kisah</span></a>
        <a href="#rsvp-sec" class="nav-item"><i class="bi bi-chat-text"></i><span>RSVP</span></a>
    </div>

    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
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

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Blocked."));
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
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
            if (current >= (document.documentElement.scrollHeight - 5)) { stopAutoscroll(); return; }
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

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const status = document.getElementById('kehadiran').value;
            const msg = document.getElementById('pesan').value;
            const card = document.createElement('div');
            card.className = 'wish-card';
            card.innerHTML = `<div class="wish-header"><span class="wish-name">${name}</span><span class="wish-status">${status}</span></div><p class="wish-content">${msg}</p>`;
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP berhasil dikirim!");
        }

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
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
    </script>
</body>
</html>
HTML;


// Layout E: Asymmetric Editorial Grid (Long-scroll, polaroid style, minimalist navigation text at the bottom)
$skeletonE = <<<'HTML'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    [[GOOGLE_FONTS]]
    
    <!-- Icons & Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: [[COLOR_PRIMARY]]; 
            --primary-dark: [[COLOR_PRIMARY_DARK]];
            --accent: [[COLOR_ACCENT]]; 
            --bg-dark: [[COLOR_BG_DARK]]; 
            --text-dark: #2c2d2c;
            --text-light: #5a5d5a;
            --font-serif: [[FONT_SERIF]];
            --font-sans: 'Montserrat', sans-serif;
            --font-script: [[FONT_SCRIPT]];
        }

        * { box-sizing: border-box; margin: 0; padding: 0; scroll-behavior: smooth; }
        body { font-family: var(--font-sans); background-color: var(--bg-dark); color: var(--text-dark); display: flex; justify-content: center; align-items: center; min-height: 100vh; overflow-x: hidden; }

        .wrapper { width: 100%; max-width: 480px; background: var(--accent); min-height: 100vh; position: relative; box-shadow: 0 0 40px rgba(0,0,0,0.6); padding-bottom: 80px; border-left: 1px solid rgba(0,0,0,0.1); border-right: 1px solid rgba(0,0,0,0.1); }

        #cover { position: fixed; top: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 100vh; z-index: 9999; background: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.8)), url("{{ $bg['cover'] }}") center/cover no-repeat; display: flex; flex-direction: column; justify-content: space-between; align-items: center; padding: 60px 30px; color: white; text-align: center; transition: transform 1.2s cubic-bezier(0.77, 0, 0.175, 1); }
        #cover.opened { transform: translate(-50%, -100%); pointer-events: none; }
        .cover-title { font-family: var(--font-serif); font-size: 2.8rem; letter-spacing: 2px; text-transform: uppercase; color: white; margin: 15px 0; font-weight: 300; }
        .cover-guest-card { background: transparent; border: 1px solid rgba(255,255,255,0.4); padding: 25px 20px; width: 100%; margin-bottom: 30px; }
        .btn-open { display: inline-flex; align-items: center; gap: 10px; background-color: white; color: black; font-family: var(--font-sans); font-weight: 600; font-size: 0.8rem; letter-spacing: 3px; padding: 14px 30px; border: none; cursor: pointer; transition: all 0.3s; }

        /* Asymmetric vertical grid lines */
        .wrapper::before { content: ''; position: absolute; top: 0; left: 30px; bottom: 0; width: 1px; background: rgba(0,0,0,0.04); z-index: 0; pointer-events: none; }

        /* Minimalist bottom nav with text links */
        .bottom-nav-text { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; background: var(--bg-dark); border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: space-around; padding: 18px 0; z-index: 1000; opacity: 0; visibility: hidden; transition: opacity 0.5s, visibility 0.5s; }
        .bottom-nav-text.visible { opacity: 1; visibility: visible; }
        .nav-item { color: #888; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; font-family: var(--font-sans); transition: color 0.3s; }
        .nav-item.active { color: var(--primary); font-weight: 600; }

        section { padding: 70px 25px 50px; position: relative; text-align: left; z-index: 1; }

        .section-subtitle { font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase; color: var(--primary-dark); margin-bottom: 15px; font-weight: 600; display: block; }
        .section-title { font-family: var(--font-serif); font-size: 2.2rem; color: var(--text-dark); margin-bottom: 30px; font-weight: 300; text-transform: uppercase; border-bottom: 1px solid rgba(0,0,0,0.06); padding-bottom: 10px; }
        
        /* Polaroid asymmetrically aligned */
        .couple-wrapper { margin: 40px 0; }
        .polaroid-frame { background: white; padding: 15px 15px 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); display: inline-block; width: 85%; transform: rotate(-2deg); }
        .couple-wrapper.bride-side { text-align: right; }
        .couple-wrapper.bride-side .polaroid-frame { transform: rotate(2deg); }
        .polaroid-img { width: 100%; aspect-ratio: 1; background-size: cover; background-position: center; border: 1px solid #eee; margin-bottom: 15px; }

        .couple-name { font-family: var(--font-serif); font-size: 1.5rem; color: var(--text-dark); margin-bottom: 6px; font-weight: 400; }
        .couple-parent { font-size: 0.75rem; color: var(--text-light); line-height: 1.5; }

        .event-card { border: 1px solid rgba(0,0,0,0.1); padding: 30px 20px; margin-bottom: 20px; }
        .event-card h3 { font-family: var(--font-serif); font-size: 1.25rem; font-weight: 400; color: var(--text-dark); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .btn-action { display: inline-block; background: transparent; color: var(--text-dark); border-bottom: 1.5px solid var(--primary); text-decoration: none; font-size: 0.8rem; font-weight: 600; padding: 3px 0; margin-top: 15px; }

        .countdown-container { display: flex; gap: 8px; margin: 25px 0; }
        .countdown-box { background: white; border: 1px solid rgba(0,0,0,0.1); width: 60px; height: 60px; display: flex; flex-direction: column; justify-content: center; align-items: center; }
        .countdown-box span:first-child { font-size: 1.25rem; font-family: var(--font-serif); font-weight: 600; }
        .countdown-box span:last-child { font-size: 0.55rem; text-transform: uppercase; color: var(--text-light); }

        .story-timeline { text-align: left; }
        .story-item { margin-bottom: 30px; position: relative; }
        .story-date { font-weight: 600; font-size: 0.85rem; color: var(--primary); margin-bottom: 5px; font-family: var(--font-sans); }
        .story-title { font-family: var(--font-serif); font-size: 1.2rem; font-weight: 400; margin-bottom: 8px; }
        .story-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.6; }

        .gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .gallery-item { border-radius: 4px; overflow: hidden; aspect-ratio: 0.8; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; }

        .gift-box { border: 1px solid rgba(0,0,0,0.1); padding: 30px 20px; margin-top: 20px; }
        .btn-copy { background: var(--text-dark); color: white; border: none; padding: 10px 25px; font-size: 0.8rem; font-weight: 600; cursor: pointer; margin-top: 15px; letter-spacing: 1px; }

        .form-wrap { border: 1px solid rgba(0,0,0,0.1); padding: 30px 20px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.8rem; font-weight: 600; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px; }
        .form-input { width: 100%; padding: 12px; border: 1px solid #bbb; font-size: 0.85rem; background: transparent; }
        .btn-submit { width: 100%; padding: 14px; background: var(--text-dark); color: white; border: none; font-weight: 600; cursor: pointer; letter-spacing: 2px; text-transform: uppercase; }

        .wish-list { max-height: 250px; overflow-y: auto; margin-top: 20px; }
        .wish-card { border-bottom: 1px solid rgba(0,0,0,0.1); padding: 15px 0; }
        .wish-header { display: flex; justify-content: space-between; margin-bottom: 5px; font-size: 0.8rem; }
        .wish-name { font-weight: 600; color: var(--text-dark); }
        .wish-status { color: var(--primary); font-weight: 600; }
        .wish-content { font-size: 0.8rem; color: var(--text-light); line-height: 1.5; }

        .floater-container { position: fixed; bottom: 0; left: 50%; transform: translateX(-50%); width: 100%; max-width: 480px; height: 0; z-index: 1000; pointer-events: none; }
        .music-control, .scroll-control { position: absolute; width: 45px; height: 45px; border-radius: 50%; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid var(--primary); display: flex; justify-content: center; align-items: center; cursor: pointer; opacity: 0; visibility: hidden; pointer-events: auto; transition: all 0.5s ease; }
        .music-control.visible, .scroll-control.visible { opacity: 1; visibility: visible; }
        .music-control { bottom: 75px; right: 20px; }
        .scroll-control { bottom: 135px; right: 20px; }
        .music-control.playing i { animation: spin 4s linear infinite; color: var(--primary); }
        .scroll-badge { position: absolute; right: 55px; top: 50%; transform: translateY(-50%); background: var(--text-dark); color: white; font-size: 0.6rem; padding: 3px 8px; border-radius: 2px; white-space: nowrap; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div id="cover">
        <div class="cover-header">
            <p style="letter-spacing: 5px; font-size: 0.7rem; text-transform: uppercase;">Undangan Acara</p>
            <h1 class="cover-title">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
        </div>
        <div class="cover-guest-card">
            <span style="font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; color: #ccc;">Yth:</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.4rem; font-weight: 300; margin-top: 5px;">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
        </div>
        <button class="btn-open" onclick="openInvitation()">
            BUKA UNDANGAN
        </button>
    </div>

    <div class="wrapper">
        <audio id="bg-audio" loop preload="auto">
            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3" type="audio/mpeg">
        </audio>

        <!-- HERO -->
        <section id="home" style="min-height: 70vh; display: flex; flex-direction: column; justify-content: center;">
            <span class="section-subtitle">The Marriage Celebration</span>
            <h1 style="font-family: var(--font-serif); font-size: 2.2rem; font-weight: 300;">{{ $couple['groom'] }} & {{ $couple['bride'] }}</h1>
            <h4 style="font-family: var(--font-sans); font-size: 0.85rem; font-weight: 600; letter-spacing: 3px; margin-top: 15px; text-transform: uppercase;">
                {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d F Y') }}
            </h4>
        </section>

        <!-- MEMPELAI -->
        <section id="couple-sec">
            <span class="section-subtitle">The Bride & Groom</span>
            <h2 class="section-title">Mempelai</h2>

            <div class="couple-wrapper" data-aos="fade-up">
                <div class="polaroid-frame">
                    <div class="polaroid-img" style="background-image: url('{{ $bg['groom'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['groom'] }}</h3>
                    <p class="couple-parent">Putra dari<br><strong>{{ $couple['parents']['groom'] }}</strong></p>
                </div>
            </div>

            <div class="couple-wrapper bride-side" data-aos="fade-up">
                <div class="polaroid-frame">
                    <div class="polaroid-img" style="background-image: url('{{ $bg['bride'] }}');"></div>
                    <h3 class="couple-name">{{ $couple['bride'] }}</h3>
                    <p class="couple-parent">Putri dari<br><strong>{{ $couple['parents']['bride'] }}</strong></p>
                </div>
            </div>
        </section>

        <!-- ACARA -->
        <section id="event-sec">
            <span class="section-subtitle">Save The Date</span>
            <h2 class="section-title">Acara Kami</h2>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[0]['title'] }}</h3>
                <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 5px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[0]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[0]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <h3>{{ $schedule[1]['title'] }}</h3>
                <p style="font-size: 0.85rem; font-weight: 600; color: var(--primary); margin-bottom: 5px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                </p>
                <p style="font-size: 0.8rem; margin-bottom: 5px;"><i class="bi bi-clock"></i> {{ $schedule[1]['time'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light);">{{ $schedule[1]['note'] }}</p>
            </div>

            <div class="event-card" data-aos="fade-up">
                <p style="font-weight: 600; font-size: 0.85rem; margin-bottom: 5px; text-transform: uppercase;">{{ $event['location'] }}</p>
                <p style="font-size: 0.8rem; color: var(--text-light); line-height: 1.5;">{{ $event['address'] }}</p>
                <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-action">LIHAT LOKASI</a>
            </div>

            <div class="countdown-container" data-aos="fade-up">
                <div class="countdown-box"><span id="days">00</span><span>Hari</span></div>
                <div class="countdown-box"><span id="hours">00</span><span>Jam</span></div>
                <div class="countdown-box"><span id="minutes">00</span><span>Menit</span></div>
                <div class="countdown-box"><span id="seconds">00</span><span>Detik</span></div>
            </div>
        </section>

        <!-- STORY -->
        <section id="story-sec">
            <span class="section-subtitle">Our Journey</span>
            <h2 class="section-title">Kisah Cinta</h2>

            <div class="story-timeline">
                @foreach($stories as $s)
                <div class="story-item" data-aos="fade-up">
                    <div class="story-date">{{ $s['date'] }}</div>
                    <h4 class="story-title">{{ $s['title'] }}</h4>
                    <p class="story-content">{{ $s['text'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- GALERI -->
        <section id="gallery-sec">
            <span class="section-subtitle">Memories</span>
            <h2 class="section-title">Galeri Foto</h2>

            <div class="gallery-grid">
                @foreach($gallery as $img)
                <div class="gallery-item" data-aos="zoom-in">
                    <img src="{{ $img }}" alt="Galeri">
                </div>
                @endforeach
            </div>
        </section>

        <!-- GIFT -->
        <section id="gift-sec">
            <span class="section-subtitle">Share Love</span>
            <h2 class="section-title">Hadiah</h2>

            <div class="gift-box" data-aos="fade-up">
                <p style="font-weight: 600; font-size: 0.8rem;">BCA TRANSFER</p>
                <h3 style="font-family: var(--font-serif); font-size: 1.3rem; margin: 5px 0;">123-456-7890</h3>
                <p style="font-size: 0.8rem; color: var(--text-light);">a.n. {{ $couple['groom'] }}</p>
                <button class="btn-copy" onclick="copyRek('123-456-7890')">SALIN REKENING</button>
            </div>
        </section>

        <!-- RSVP -->
        <section id="rsvp-sec">
            <span class="section-subtitle">Response</span>
            <h2 class="section-title">RSVP</h2>

            <div class="form-wrap" data-aos="fade-up">
                <form id="rsvp-form" onsubmit="submitRsvp(event)">
                    <div class="form-group">
                        <label class="form-label">Nama Anda</label>
                        <input type="text" id="nama" class="form-input" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kehadiran</label>
                        <select id="kehadiran" class="form-input" required>
                            <option value="Hadir">Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ucapan & Doa</label>
                        <textarea id="pesan" class="form-input" rows="3" placeholder="Doa Restu Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Kirim Konfirmasi</button>
                </form>
            </div>

            <div class="wish-list">
                <div class="wish-card">
                    <div class="wish-header">
                        <span class="wish-name">Ari & Dinda</span>
                        <span class="wish-status">Hadir</span>
                    </div>
                    <p class="wish-content">Selamat berbahagia! Doa kami menyertai langkah kalian berdua.</p>
                </div>
                <div id="wishList"></div>
            </div>
        </section>

        <div style="text-align: center; padding: 20px 0; font-size: 0.7rem; color: var(--text-light);">
            Created with <i class="bi bi-heart-fill" style="color: var(--primary);"></i> TemuRuang
        </div>
    </div>

    <!-- Textual Bottom Nav -->
    <div class="bottom-nav-text" id="bottomNav">
        <a href="#home" class="nav-item active">Home</a>
        <a href="#couple-sec" class="nav-item">Mempelai</a>
        <a href="#event-sec" class="nav-item">Acara</a>
        <a href="#story-sec" class="nav-item">Cerita</a>
        <a href="#rsvp-sec" class="nav-item">RSVP</a>
    </div>

    <div class="floater-container">
        <div class="music-control" id="musicControl" onclick="toggleMusic()">
            <i class="bi bi-disc"></i>
        </div>
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

        function openInvitation() {
            document.getElementById('cover').classList.add('opened');
            const audio = document.getElementById('bg-audio');
            audio.play().then(() => {
                document.getElementById('musicControl').classList.add('playing');
            }).catch(err => console.log("Blocked."));
            document.getElementById('bottomNav').classList.add('visible');
            document.getElementById('musicControl').classList.add('visible');
            document.body.style.overflow = 'auto';
            document.getElementById('scrollControl').classList.add('visible');
            startAutoscroll();
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
            if (current >= (document.documentElement.scrollHeight - 5)) { stopAutoscroll(); return; }
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

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const status = document.getElementById('kehadiran').value;
            const msg = document.getElementById('pesan').value;
            const card = document.createElement('div');
            card.className = 'wish-card';
            card.innerHTML = `<div class="wish-header"><span class="wish-name">${name}</span><span class="wish-status">${status}</span></div><p class="wish-content">${msg}</p>`;
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("RSVP berhasil dikirim!");
        }

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
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
    </script>
</body>
</html>
HTML;


// Mapping templates to distinct layouts
// i from 2 to 26
$layoutMap = [
    'A' => $skeletonA,
    'B' => $skeletonB,
    'C' => $skeletonC,
    'D' => $skeletonD,
    'E' => $skeletonE
];

$layoutIndices = ['A', 'B', 'C', 'D', 'E'];

for ($i = 2; $i <= 26; $i++) {
    $slug = sprintf('wedding-%02d', $i);
    
    // Cyclically select layout, color scheme, font pairing, and corner ornament
    $layoutIndex = $layoutIndices[($i - 2) % 5];
    $color = $colors[($i * 3) % 10];
    $font = $fonts[($i * 2) % 5];
    $ornament = $ornaments[$i % 5];
    $frame = $frameStyles[($i + 1) % 5];
    $texture = $textures[($i * 4) % 5];
    
    $rawSkeleton = $layoutMap[$layoutIndex];
    
    // Dummy Data Setup Block at the top of the view
    $dataBlock = <<<'PHP'
@php
    $couple = $couple ?? [
        'groom' => 'Arkan',
        'bride' => 'Nabila',
        'parents' => [
            'groom' => 'Bpk. Herman & Ibu Siti',
            'bride' => 'Bpk. Joko & Ibu Wati',
        ],
    ];

    $event = $event ?? [
        'date_iso' => '2026-12-12',
        'time' => '10:00',
        'location' => 'Grand Ballroom, Hotel Harmoni',
        'address' => 'Jl. Kebangsaan No. 45, Bandung',
        'maps_url' => 'https://maps.google.com/?q=Bandung',
    ];

    $schedule = $schedule ?? [
        ['title' => 'Akad Nikah', 'time' => '10:00 - 11:30', 'note' => 'Ruang Tulip'],
        ['title' => 'Resepsi Pernikahan', 'time' => '12:00 - 15:00', 'note' => 'Ballroom Utama'],
    ];

    $stories = $stories ?? [
        ['title' => 'Awal Bertemu', 'date' => 'Maret 2022', 'text' => 'Bermula dari perkenalan singkat di bangku perkuliahan, kami menyadari banyak hal menarik yang membuat kami dekat.'],
        ['title' => 'Menjalin Komitmen', 'date' => 'Juli 2024', 'text' => 'Kami memutuskan untuk melangkah bersama dengan komitmen serius yang matang.'],
        ['title' => 'Menuju Pernikahan', 'date' => 'Desember 2026', 'text' => 'Hari bahagia yang dinantikan akhirnya tiba untuk menyatukan janji suci kami berdua.'],
    ];

    $gallery = $gallery ?? [
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
        'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400'
    ];

    $bg = $bg ?? [
        'cover' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800',
        'groom' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400',
        'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
    ];
@endphp

PHP;

    // String injection replacements
    $compiled = str_replace('[[GOOGLE_FONTS]]', $font['google'], $rawSkeleton);
    $compiled = str_replace('[[COLOR_PRIMARY]]', $color['primary'], $compiled);
    $compiled = str_replace('[[COLOR_PRIMARY_DARK]]', $color['primary_dark'], $compiled);
    $compiled = str_replace('[[COLOR_ACCENT]]', $color['accent'], $compiled);
    $compiled = str_replace('[[COLOR_BG_DARK]]', $color['bg_dark'], $compiled);
    $compiled = str_replace('[[FONT_SERIF]]', $font['serif'], $compiled);
    $compiled = str_replace('[[FONT_SCRIPT]]', $font['script'], $compiled);
    $compiled = str_replace('[[TEXTURE]]', $texture, $compiled);
    $compiled = str_replace('[[FRAME_STYLE_OUTER]]', $frame['outer'], $compiled);
    $compiled = str_replace('[[FRAME_STYLE_INNER]]', $frame['inner'], $compiled);
    
    // Randomize corner ornament placement dynamically (using TL and TR paths)
    $compiled = str_replace('[[CORNER_SVG]]', $ornament['tl'], $compiled);
    
    // Inject the PHP data block right after the doctype or php block if needed
    $insertPos = strpos($compiled, '<!DOCTYPE html>');
    if ($insertPos !== false) {
        $finalOutput = substr($compiled, 0, $insertPos) . $dataBlock . substr($compiled, $insertPos);
    } else {
        $finalOutput = $dataBlock . $compiled;
    }
    
    $filePath = "$destDir/$slug.blade.php";
    file_put_contents($filePath, $finalOutput);
    echo "Compiled: $slug.blade.php (Layout $layoutIndex, Palette " . (($i * 3) % 10) . ")\n";
    
    // Update template model details in the database
    $layoutNames = [
        'A' => 'Classic Premium Card',
        'B' => 'Modern Minimalist Capsule',
        'C' => 'Full-Screen Snap-Scroll',
        'D' => 'Botanical Watercolor',
        'E' => 'Asymmetric Editorial Grid'
    ];
    
    $template = Template::where('slug', $slug)->first();
    if ($template) {
        $template->update([
            'name' => sprintf('Wedding %02d (%s)', $i, $layoutNames[$layoutIndex]),
            'description' => sprintf('Desain premium dengan gaya %s. Dilengkapi audio pemutar musik, tombol autoscroll seksi, dan ornamen visual yang unik.', $layoutNames[$layoutIndex])
        ]);
    }
}

echo "All 25 diverse templates successfully compiled and registered!\n";

?>
