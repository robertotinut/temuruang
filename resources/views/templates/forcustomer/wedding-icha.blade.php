@php
    $defaultStories = [
        [
            'chapter' => 'Chapter I',
            'title' => 'Once Upon a Time',
            'date' => 'Awal Mula',
            'text' => 'Sebelum saling mengenal, kami hanyalah dua orang asing yang menjalani hidup di dunia masing-masing. Kami tidak pernah tahu bahwa langkah-langkah kecil yang kami ambil saat itu perlahan sedang membawa kami menuju satu tujuan yang sama.'
        ],
        [
            'chapter' => 'Chapter II',
            'title' => 'The Journey',
            'date' => 'Perjalanan',
            'text' => 'Tidak semua kisah dimulai dengan keyakinan. Kadang, ia bertumbuh melalui pertanyaan, perbedaan, dan pilihan-pilihan yang tidak selalu mudah. Kami pernah berada di titik ketika jarak terasa panjang, perbedaan terasa besar, dan keraguan terdengar lebih keras daripada harapan. Namun, di setiap musim yang kami lalui, selalu ada satu keputusan yang terus kami ambil—memilih untuk tetap berjalan ke arah yang sama.'
        ],
        [
            'chapter' => 'Chapter III',
            'title' => 'The Promise',
            'date' => 'Harapan & Doa',
            'text' => 'Seiring waktu, kami menyadari bahwa tujuan dari perjalanan ini bukan lagi sekadar memilih arah. Namun, harapan yang dulu kami simpan dalam doa bertumbuh menjadi langkah yang siap kami jalani—Bersama, Selamanya.'
        ],
        [
            'chapter' => 'Chapter IV',
            'title' => 'Forever Begins',
            'date' => 'Hari Ini & Selamanya',
            'text' => 'Hari ini, dengan hati yang penuh syukur, kami melangkah sebagai satu—dan percaya bahwa Sang Maha Cinta tak pernah salah dalam menuliskan takdir-Nya.'
        ]
    ];

    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = array_map('trim', explode('&', $invitation->title, 2));
        $groomName = count($names) === 2 && $names[0] !== ''
            ? $names[0]
            : 'Icha Alifia Yokendy Putri';
        $brideName = count($names) === 2 && $names[1] !== ''
            ? $names[1]
            : 'Pamunkas Surya Merdeka';

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => 'Bpk. Yoyok Kristianto & Ibu Enik Sa`adah',
                'bride' => 'Jendral Maliyat Kustur & Ibu Sudarni',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-29',
            'time' => '08:00',
            'location' => $invitation->location ?? 'Kediaman Mempelai Wanita',
            'address' => $invitation->address ?? 'Wisma Indah 2 K6 No. 40 Gunung Anyar Tambak, Surabaya',
            'maps_url' => 'https://maps.app.goo.gl/MNJZgHTxTkzjqtweA',
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => '08.00 WIB',
                'note' => $invitation->location ?? 'Kediaman Mempelai Wanita'
            ],
            [
                'title' => 'Resepsi',
                'time' => '16.00 WIB',
                'note' => $invitation->address ?? 'Wisma Indah 2 K6 No. 40 Gunung Anyar Tambak, Surabaya'
            ]
        ];

        if (isset($invitation->stories) && $invitation->stories->count() > 0) {

            $stories = [];
            $roman = ['I', 'II', 'III', 'IV', 'V', 'VI'];
            foreach ($invitation->stories as $idx => $story) {
                $stories[] = [
                    'chapter' => 'Chapter ' . ($roman[$idx] ?? ($idx + 1)),
                    'title' => $story->title,
                    'date' => $story->date,
                    'text' => $story->content
                ];
            }
            if (isset($stories[0]['title']) && stripos($stories[0]['title'], 'Pertemuan') !== false) {
                $stories = $defaultStories;
            }
        } else {
            $stories = $defaultStories;
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [];
        }

        if ($invitation->relationLoaded('guestBooks')) {
            $wishes = [];
            foreach ($invitation->guestBooks->sortByDesc('created_at')->take(20) as $guestBook) {
                $wishes[] = [
                    'name' => $guestBook->guest_name,
                    'status' => 'Ucapan & Doa',
                    'message' => $guestBook->message
                ];
            }
        } else {
            $wishes = [];
        }

        $musicUrl = asset('assets/templates/wedding-32/KEMBANG JUWITA - PAWESTRI - OFFICIAL MUSIC VIDEO.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Icha Alifia Yokendy Putri ',
            'bride' => 'Pamunkas Surya Merdeka',
            'parents' => [
                'groom' => 'Bpk. Yoyok Kristianto & Ibu Enik Sa`adah',
                'bride' => 'Bpk. Maliyat Kustur & Ibu Sudarni',
            ],
        ];

        $event = [
            'date_iso' => '2026-08-29',
            'time' => '08:00',
            'location' => 'Kediaman Mempelai Wanita',
            'address' => 'Wisma Indah 2 K6 No. 40 Gunung Anyar Tambak, Surabaya',
            'maps_url' => 'https://maps.app.goo.gl/MNJZgHTxTkzjqtweA',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08.00 WIB', 'note' => 'Kediaman Mempelai Wanita'],
            ['title' => 'Resepsi', 'time' => '16.00 WIB', 'note' => 'Kediaman Mempelai Wanita'],
        ];

        $stories = $defaultStories;

        $gallery = [];

        $wishes = [
            ['name' => 'Keluarga Bpk. Budi', 'status' => 'Ya, saya akan hadir', 'message' => 'Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
            ['name' => 'Siti', 'status' => 'Maaf, tidak bisa hadir', 'message' => 'Maaf tidak bisa hadir, semoga lancar dan bahagia selalu.'],
        ];

        $musicUrl = asset('assets/templates/wedding-32/KEMBANG JUWITA - PAWESTRI - OFFICIAL MUSIC VIDEO.mp3');
    }

    $assetBase = '/assets/templates/wedding-32';
    
    // Dynamic Calendar Calculation
    $eventDate = \Carbon\Carbon::parse($event['date_iso']);
    $calendarMonth = $eventDate->locale('id')->translatedFormat('F');
    $calendarYear = $eventDate->format('Y');
    $activeDay = (int)$eventDate->format('j');
    
    // Day of week of the 1st day of the month (0 = Sunday, 1 = Monday, etc.)
    $firstDayOfWeek = $eventDate->copy()->startOfMonth()->dayOfWeek;
    $daysInMonth = $eventDate->daysInMonth;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <title>Undangan {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
  <meta name="description" content="Wedding invitation - {{ $couple['groom'] }} & {{ $couple['bride'] }}" />
  
  <!-- Premium Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Great+Vibes&family=Montserrat:wght@300;400;500&family=Parisienne&family=Playfair+Display:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  
  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  
  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

  <style>
    [x-cloak] { display: none !important; }

    :root {
      --bg: #f8ebef;
      --bg-soft: #fcf4f6;
      --bg-soft-2: #f4dfe6;
      --maroon: #6f1627;
      --maroon-2: #8a243a;
      --maroon-3: #5a0f1e;
      --rose: #ca8d99;
      --rose-2: #e4d5da;
      --gold: #d6ad72;
      --text: #703241;
      --white: #ffffff;
      --shadow: 0 16px 36px rgba(91,22,35,.16);
      --shadow-strong: 0 22px 44px rgba(85,18,31,.22);
    }
    
    * {
      box-sizing: border-box;
    }
    
    html {
      scroll-behavior: smooth;
    }
    
    body {
      margin: 0;
      font-family: "Cormorant Garamond", Georgia, serif;
      background: #131316;
      color: var(--text);
      overflow-x: hidden;
    }
    
    a {
      color: inherit;
      text-decoration: none;
    }
    
    button, input, textarea {
      font: inherit;
    }
    
    .page-stage {
      min-height: 100vh;
    }
    
    .phone-shell {
      width: min(100%, 430px);
      margin: 0 auto;
      min-height: 100vh;
      background: linear-gradient(180deg, var(--bg-soft) 0%, var(--bg) 36%, var(--bg-soft-2) 100%);
      position: relative;
      overflow: hidden;
    }
    
    .content {
      position: relative;
      z-index: 1;
      display: none; /* Hidden until cover is opened */
    }
    
    .content.is-visible {
      display: block;
    }
    
    .section {
      position: relative;
      min-height: 100svh;
      padding: 28px 18px 86px;
      overflow: hidden;
      background: linear-gradient(180deg, var(--bg-soft) 0%, var(--bg) 58%, #f5e1e7 100%);
    }
    
    .asset {
      position: absolute;
      pointer-events: none;
      user-select: none;
    }
    
    .script, .section-title-script, .dress-title, .gallery-label, .event-title, .person-block h2, .closing-names, .month-name, .title-combo span {
      font-family: "Great Vibes", cursive;
    }
    
    @media (min-width: 700px) {
      .page-stage {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 20px 0 40px;
      }
      .phone-shell {
        min-height: calc(100vh - 40px);
        border-radius: 34px;
        box-shadow: 0 0 0 10px #202227, 0 30px 80px rgba(0,0,0,.45);
      }
    }
    
    /* =================== COVER SCREEN =================== */
    .cover-flower {
      position: absolute;
      width: 48%;
      max-width: 190px;
      opacity: .95;
      filter: drop-shadow(0 8px 16px rgba(90, 30, 40, .12));
      z-index: 1;
      pointer-events: none;
    }
    
    .cover-flower-tl {
      left: -20px;
      top: -20px;
      transform: scaleY(-1);
    }
    
    .cover-flower-tr {
      right: -20px;
      top: -20px;
      transform: scale(-1);
    }
    
    .cover-flower-bl {
      left: -20px;
      bottom: -20px;
    }
    
    .cover-flower-br {
      right: -20px;
      bottom: -20px;
      transform: scaleX(-1);
    }

    .cover-screen {
      position: fixed;
      inset: 0;
      z-index: 100;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: #F8F0EE;
      overflow: hidden;
      transition: transform 1.2s cubic-bezier(0.76, 0, 0.24, 1), opacity .7s ease;
      left: 50%;
      transform: translateX(-50%);
      width: min(100%, 430px);
    }

    .cover-screen.is-open {
      transform: translateX(-50%) translateY(-106%);
      opacity: 0;
      pointer-events: none;
    }

    .cover-content {
      text-align: center;
      z-index: 2;
      width: 100%;
      padding: 32px 26px;
    }

    .eyebrow {
      font-family: 'Great Vibes', cursive;
      color: var(--rose);
      font-size: 32px;
      margin: 0 0 2px;
      line-height: 1;
    }

    .cover-content h1 {
      font-family: 'Playfair Display', serif;
      font-size: 28px;
      letter-spacing: .12em;
      color: var(--maroon);
      font-weight: 500;
      margin: 0 0 20px;
    }

    .cover-envelope-scene {
      position: relative;
      width: 58%;
      max-width: 220px;
      margin: 0 auto;
      filter: drop-shadow(0 12px 18px rgba(74, 15, 28, .20));
      animation: floatY 4s ease-in-out infinite;
      z-index: 2;
    }
    
    .cover-envelope {
      width: 100%;
      display: block;
      position: relative;
      z-index: 3;
    }
    
    .cover-ornament-flower-l {
      position: absolute;
      bottom: 25px;
      left: -45px;
      width: 135px;
      z-index: 4;
      pointer-events: none;
    }
    
    .cover-ornament-tassel {
      position: absolute;
      bottom: -25px;
      left: -20px;
      width: 52px;
      z-index: 2;
      pointer-events: none;
    }
    
    .cover-ornament-flower-r {
      position: absolute;
      bottom: 20px;
      right: -40px;
      width: 130px;
      z-index: 4;
      pointer-events: none;
    }
    
    .cover-ornament-butterfly {
      position: absolute;
      top: -25px;
      right: 10px;
      width: 72px;
      z-index: 5;
      pointer-events: none;
      animation: floatY 3s ease-in-out infinite;
    }

    .dear {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-size: 15px;
      margin: 22px 0 6px;
      color: #a36f7a;
      letter-spacing: 0.05em;
    }
    
    .cover-content h2 {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 28px;
      font-weight: 700;
      margin: 0 0 10px;
      color: var(--maroon);
      text-shadow: 0 2px 4px rgba(93, 23, 40, .10);
    }
    
    .cover-note {
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 400;
      letter-spacing: 0.03em;
      margin: 0 auto 20px;
      max-width: 280px;
      color: #986271;
      line-height: 1.7;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 12px 24px;
      border-radius: 999px;
      font-weight: 700;
      letter-spacing: .06em;
      font-size: 13px;
      border: 0;
      cursor: pointer;
      box-shadow: 0 12px 24px rgba(75, 14, 27, .24);
      background: linear-gradient(180deg, #8c263a, #5b0f20);
      color: #fff;
    }
    
    @keyframes floatY {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }

    
    /* =================== FLOATING UI & NAV =================== */
    .floating-ui {
      position: fixed;
      left: 50%;
      bottom: 18px;
      transform: translateX(-50%);
      width: min(100%, 430px);
      pointer-events: none;
      z-index: 20;
      display: none;
    }
    
    .floating-ui.is-visible {
      display: block;
    }
    
    .fab {
      position: absolute;
      width: 42px;
      height: 42px;
      border-radius: 50%;
      background: linear-gradient(180deg, var(--maroon-2), var(--maroon-3));
      color: #fff;
      display: grid;
      place-items: center;
      box-shadow: var(--shadow);
      font-size: 15px;
      pointer-events: auto;
      border: 0;
      text-decoration: none;
    }
    
    .fab-left { left: 14px; bottom: 0; }
    .fab-right { right: 14px; bottom: 0; cursor: pointer; }
    .fab-qr { right: 14px; bottom: 64px; font-size: 11px; }
    
    .quick-nav {
      position: fixed;
      right: max(14px, calc((100vw - 430px)/2 + 14px));
      bottom: 128px;
      z-index: 21;
      display: flex;
      flex-direction: column;
      gap: 8px;
      padding: 12px;
      border-radius: 20px;
      background: rgba(255,249,250,.92);
      box-shadow: var(--shadow-strong);
      transform: translateY(12px) scale(.95);
      opacity: 0;
      pointer-events: none;
      transition: .25s ease;
      border: 1px solid rgba(111,22,39,.12);
    }
    
    .quick-nav.show {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0) scale(1);
    }
    
    .quick-nav a {
      padding: 10px 14px;
      border-radius: 999px;
      background: rgba(111,22,39,.06);
      font-size: 12px;
      color: var(--maroon);
      text-align: center;
    }
    
    /* =================== GSAP HERO SECTION =================== */
    .section.stage {
      padding: 0;
    }
    .stage {
      position: relative;
      width: 100%;
      height: min(100svh, 920px);
      min-height: 760px;
      max-height: 920px;
      overflow: hidden;
      isolation: isolate;
      background:
        radial-gradient(circle at 50% 18%, rgba(255, 246, 214, .07), transparent 34%),
        radial-gradient(circle at 0% 70%, rgba(255, 218, 168, .06), transparent 30%),
        linear-gradient(180deg, #8a243a 0%, #6f1627 45%, #4a0f19 100%);
      box-shadow: 0 30px 80px rgba(0, 0, 0, .44);
    }

    .stage::before,
    .stage::after {
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 0;
    }

    .stage::before {
      background:
        linear-gradient(90deg, rgba(255,255,255,.045), transparent 10%, transparent 90%, rgba(0,0,0,.14)),
        radial-gradient(circle at 50% 50%, transparent 45%, rgba(0,0,0,.18) 100%);
      mix-blend-mode: soft-light;
    }

    .stage::after {
      border: 1px solid rgba(255, 246, 227, .08);
      box-shadow: inset 0 0 60px rgba(0,0,0,.18);
    }

    .grain-layer {
      position: absolute;
      inset: 0;
      z-index: 1;
      pointer-events: none;
      opacity: .15;
      background-image:
        repeating-radial-gradient(circle at 20% 20%, rgba(255,255,255,.16) 0 1px, transparent 1px 4px),
        repeating-linear-gradient(90deg, rgba(255,255,255,.04) 0 1px, transparent 1px 4px);
      mix-blend-mode: overlay;
    }

    .ambient {
      position: absolute;
      z-index: 0;
      width: 190px;
      height: 190px;
      border-radius: 50%;
      filter: blur(36px);
      opacity: .28;
      pointer-events: none;
    }

    .ambient-1 { left: -80px; top: 140px; background: #fff0c2; }
    .ambient-2 { right: -95px; bottom: 85px; background: #ff9d9d; } /* adjusted to maroon palette */

    .asset,
    .piece {
      position: absolute;
      user-select: none;
      -webkit-user-drag: none;
      transform-origin: center center;
      will-change: transform, opacity;
    }
    
    .piece { 
      z-index: 3; 
      opacity: 0; /* Hide initially for GSAP entrance animation */
    }
    
    .envelope {
      z-index: 2;
      width: 73%;
      left: 13.5%;
      top: 64px;
      height: auto;
      object-fit: contain;
      filter: drop-shadow(0 14px 18px rgba(0, 0, 0, .25));
    }
    
    .flower-left {
      z-index: 5;
      width: 53%;
      left: 6px;
      top: 44px;
      height: auto;
      filter: drop-shadow(0 14px 13px rgba(0,0,0,.18));
    }
    
    .butterfly {
      z-index: 6;
      width: 24%;
      right: 28px;
      top: 72px;
      height: auto;
      filter: drop-shadow(0 8px 8px rgba(0,0,0,.15));
    }
    
    .flower-right {
      z-index: 3; /* Render behind name-card to keep text fully visible */
      width: 42%;
      right: -4px;
      top: 284px;
      height: auto;
      filter: drop-shadow(0 13px 12px rgba(0,0,0,.17));
    }
    
    .portrait-wrap {
      z-index: 7;
      width: 52%;
      left: 24px;
      top: 350px;
      aspect-ratio: 1 / 1.25;
      filter: drop-shadow(0 16px 15px rgba(0,0,0,.28));
    }
    
    .photo-frame {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
      z-index: 2;
      pointer-events: none;
      margin-top: -10px;
      margin-left: -20px;
    }
    
    .photo-oval {
      position: absolute;
      z-index: 1;
      left: 18%;
      top: 25.5%;
      width: 61%;
      height: 58.5%;
      border-radius: 50%;
      overflow: hidden;
      background: #a7a29b;
      box-shadow: inset 0 0 25px rgba(0,0,0,.25);
    }
    
    .photo-oval img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scale(1.06);
    }
    
    .name-card {
      z-index: 4;
      right: 24px;
      top: 424px;
      width: 49%;
      height: 306px;
      padding: 38px 22px 25px 22px;
      color: #1a0f0d; /* Very dark brown for maximum readability */
      text-align: center;
      background: #fffdf9; /* Solid high-contrast background */
      border: 2px dotted rgba(53, 41, 27, .9);
      box-shadow: 0 20px 28px rgba(0,0,0,.22);
    }
    
    .name-card::before {
      content: "";
      position: absolute;
      inset: -16px -13px auto auto;
      width: 105%;
      height: 94px;
      z-index: -1;
      border-radius: 38px 38px 0 0;
      border-top: 3px double rgba(79, 59, 40, .25);
      opacity: .42;
    }
    
    .name-card::after {
      content: "";
      position: absolute;
      top: -28px;
      left: 50%;
      width: 76%;
      height: 52px;
      transform: translateX(-50%);
      border-radius: 999px 999px 0 0;
      background:
        radial-gradient(circle at 10px 35px, transparent 11px, rgba(255,255,255,.92) 12px 18px, transparent 19px) 0 0 / 28px 44px repeat-x;
      filter: drop-shadow(0 3px 1px rgba(0,0,0,.05));
    }
    
    .lace {
      position: absolute;
      top: 6px;
      bottom: 6px;
      width: 21px;
      opacity: .85;
      pointer-events: none;
      background:
        radial-gradient(circle, rgba(70,49,32,.4) 0 2px, transparent 2.5px) center / 6px 8px repeat-y;
    }
    
    .lace-left { left: -2px; }
    .lace-right { right: -2px; }
    
    .mini-label {
      display: block;
      margin-bottom: 4px;
      font-size: 10px;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: #3b2c25; /* Darker, high contrast */
      font-weight: 700;
    }
    
    .name-card h1 {
      margin: 0;
      font-family: "Great Vibes", "Parisienne", cursive;
      font-weight: 400;
      font-size: clamp(24px, 7vw, 36px);
      line-height: 1;
      color: #1a0f0d; /* Very dark */
      text-shadow: 0 1px 0 #fff;
      word-wrap: break-word;
    }
    
    .name-card h1 span {
      display: inline-block;
      margin: 6px 0;
      font-family: "Cormorant Garamond", Georgia, serif;
      font-size: .6em;
      font-weight: 700;
      color: #3b2c25; /* Very dark */
    }
    
    .name-card p {
      margin: 12px 0 0;
      font-family: "Parisienne", "Great Vibes", cursive;
      font-size: clamp(16px, 4vw, 20px);
      letter-spacing: .06em;
      color: #1a0f0d; /* Very dark */
      font-weight: 600;
    }
    
    .date-card {
      z-index: 3;
      left: 42px;
      top: 625px; /* positioned relative to top to maintain consistent gap under portrait-wrap */
      width: 44%;
      height: 145px;
      padding-top: 15px;
      text-align: center;
      color: #1a0f0d; /* Very dark */
      background: #fffdf9; /* Solid high-contrast background */
      border: 2px solid rgba(76, 61, 42, .75);
      box-shadow: 0 20px 30px rgba(0,0,0,.2);
      margin-top: -80px;
    }
    
    .date-card span {
      display: block;
      font-family: "Parisienne", "Great Vibes", cursive;
      font-size: 24px;
    }
    
    .date-card strong {
      display: block;
      margin-top: 8px;
      font-family: "Great Vibes", "Parisienne", cursive;
      font-size: clamp(28px, 7vw, 36px);
      font-weight: 700;
      line-height: .9;
      color: #1a0f0d; /* Very dark */
    }
    
    .date-card em {
      display: block;
      margin-top: 8px;
      font-family: "Parisienne", cursive;
      font-size: 22px;
      font-style: normal;
      color: #1a0f0d; /* Very dark */
      font-weight: 600;
    }
    
    .hydrangea {
      z-index: 8;
      width: 31%;
      left: 34.5%;
      top: 620px;
      height: auto;
      filter: drop-shadow(0 12px 10px rgba(0,0,0,.22));
    }
    
    .music-disc {
      z-index: 5;
      right: 10px;
      bottom: 140px;
      width: 34%;
      aspect-ratio: 1 / 1;
      border: 0;
      cursor: pointer;
      color: #74685e;
      border-radius: 50%;
      background:
        radial-gradient(circle at 50% 67%, #4a2909 0 13%, transparent 14%),
        radial-gradient(circle, #fdf4e6 0 52%, transparent 53%),
        conic-gradient(from 20deg, #f7ecdb, #fffaf1, #eadbca, #fff7eb, #efe1cf, #f7ecdb);
      box-shadow:
        inset 0 0 0 3px rgba(73, 53, 32, .65),
        inset 0 0 0 22px rgba(255,255,255,.28),
        0 18px 24px rgba(0,0,0,.26);
    }
    
    .music-disc::before {
      content: "";
      position: absolute;
      inset: 15px;
      border-radius: 50%;
      border: 1px solid rgba(82, 61, 38, .36);
    }
    
    .disc-copy {
      position: absolute;
      top: 22px;
      left: 0;
      right: 0;
      text-align: center;
      font-family: "Great Vibes", "Parisienne", cursive;
      font-size: clamp(31px, 9.2vw, 44px);
      line-height: 1.04;
    }
    
    .disc-play {
      position: absolute;
      left: 50%;
      bottom: 31px;
      width: 0;
      height: 0;
      transform: translateX(-37%);
      border-left: 21px solid #fff7ed;
      border-top: 14px solid transparent;
      border-bottom: 14px solid transparent;
      filter: drop-shadow(0 1px 0 rgba(0,0,0,.25));
    }
    
    .music-disc.is-playing { animation: discSpin 5.5s linear infinite; }
    .music-disc.is-playing .disc-copy, .music-disc.is-playing .disc-play { animation: counterSpin 5.5s linear infinite; }
    
    @keyframes discSpin { to { transform: rotate(360deg); } }
    @keyframes counterSpin { to { transform: rotate(-360deg); } }
    
    .corner {
      position: absolute;
      width: 38px;
      height: 38px;
      border-color: rgba(74, 62, 46, .42);
    }
    .corner-a { top: 11px; left: 11px; border-top: 3px double; border-left: 3px double; border-top-left-radius: 11px; }
    .corner-b { top: 11px; right: 11px; border-top: 3px double; border-right: 3px double; border-top-right-radius: 11px; }
    .corner-c { bottom: 11px; left: 11px; border-bottom: 3px double; border-left: 3px double; border-bottom-left-radius: 11px; }
    .corner-d { bottom: 11px; right: 11px; border-bottom: 3px double; border-right: 3px double; border-bottom-right-radius: 11px; }

    @media (max-width: 430px) {
      .stage { max-height: none; min-height: 720px; }
      .envelope { top: 8%; left: 13.5%; width: 73%; }
      .flower-left { top: 5%; left: 6%; width: 44%; }
      .butterfly { top: 9%; right: 8%; width: 22%; }
      .flower-right { top: 32%; right: -4%; width: 36%; }
      .portrait-wrap { top: 345px; left: 18px; width: 52%; }
      .name-card { top: 421px; right: 16px; width: 51%; height: 304px; }
      .hydrangea { top: 610px; left: 34%; width: 32%; }
      .date-card { left: 32px; top: 615px; width: 44%; height: 140px; padding-top: 15px; }
    }

    @media (max-height: 780px) {
      .stage { min-height: 700px; }
      .envelope { top: 7%; width: 68%; left: 16%; }
      .flower-left { top: 5%; width: 40%; left: 4%; }
      .butterfly { top: 8%; width: 20%; right: 8%; }
      .flower-right { top: 30%; width: 32%; right: -4%; }
      .portrait-wrap { top: 240px; width: 55%; left: 15px; }
      .name-card { top: 44%; width: 44%; min-height: 230px; padding-top: 25px; }
      .hydrangea { top: 525px; left: 46%; width: 28%; }
      .date-card { height: 130px; top: 565px; padding-top: 12px; }
    }
    
    /* =================== COUPLE SECTION =================== */
    .couple-section {
      position: relative;
      text-align: center;
      padding: 50px 16px 60px;
      background: radial-gradient(circle at 50% 20%, rgba(255, 255, 255, 0.8), transparent 70%),
                  linear-gradient(180deg, #f8ebef 0%, #f4dce3 50%, #f0ced7 100%),
                  url("https://www.transparenttextures.com/patterns/handmade-paper.png");
      overflow: hidden;
    }
    
    .couple-headline {
      position: relative;
      z-index: 5;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 16px;
      margin: 10px auto 28px;
      max-width: 360px;
    }
    
    .couple-headline-side {
      flex: 1;
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--maroon);
      letter-spacing: 0.08em;
      text-transform: uppercase;
      text-shadow: 0 1px 2px rgba(255,255,255,0.8);
    }
    
    .couple-headline-side.left { text-align: right; }
    .couple-headline-side.right { text-align: left; }
    
    .faded-vb {
      width: 54px;
      height: 54px;
      border-radius: 12px;
      transform: rotate(45deg);
      background: linear-gradient(135deg, var(--maroon), #560e1d);
      color: #ffdce2;
      border: 2px solid #d4af7a;
      box-shadow: 0 8px 20px rgba(111,22,39,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .faded-vb span {
      transform: rotate(-45deg);
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 22px;
      font-weight: 700;
      letter-spacing: 1px;
    }
    
    .proclamation-box {
      position: relative;
      z-index: 5;
      max-width: 350px;
      margin: 0 auto 32px;
      padding: 24px 20px;
      background: linear-gradient(145deg, rgba(255, 255, 255, 0.92), rgba(253, 240, 244, 0.95));
      border: 1.5px solid #d4af7a;
      border-radius: 6px;
      box-shadow: 0 12px 30px rgba(111,22,39,0.12);
    }

    .proclamation-box:before, .proclamation-box:after {
      content: "";
      position: absolute;
      width: 12px;
      height: 12px;
      border-color: #7a1327;
      border-style: solid;
      pointer-events: none;
    }
    .proclamation-box:before { top: 4px; left: 4px; border-width: 2px 0 0 2px; }
    .proclamation-box:after { bottom: 4px; right: 4px; border-width: 0 2px 2px 0; }
    
    .basmala {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 20px;
      font-weight: 700;
      color: #7a1327;
      letter-spacing: 0.05em;
      margin-bottom: 12px;
    }
    
    .couple-intro {
      margin: 0 auto;
      max-width: 280px;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 15px;
      line-height: 1.6;
      color: #5a2a35;
    }
    
    .couple-tablets-wrap {
      position: relative;
      z-index: 5;
      max-width: 360px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 28px;
    }

    .couple-tablet {
      position: relative;
      padding: 34px 20px 30px;
      background: linear-gradient(155deg, #7a1327 0%, #560e1d 60%, #440915 100%);
      border: 2px solid #d4af7a;
      border-radius: 12px;
      transition: all 0.4s ease;
    }

    .couple-tablet.groom {
      box-shadow: -8px 8px 0px rgba(212, 175, 122, 0.45), 0 15px 35px rgba(111,22,39,0.25);
    }
    .couple-tablet.bride {
      box-shadow: 8px 8px 0px rgba(212, 175, 122, 0.45), 0 15px 35px rgba(111,22,39,0.25);
    }

    .couple-tablet:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 45px rgba(111,22,39,0.4);
    }

    .couple-tablet:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px dashed rgba(255, 255, 255, 0.3);
      border-radius: 8px;
      pointer-events: none;
    }

    .couple-photo-wrap {
      position: relative;
      z-index: 1;
      width: 178px;
      height: 224px;
      margin: 0 auto 22px;
      padding: 5px;
      border: 2px solid #d4af7a;
      border-radius: 92px 92px 10px 10px;
      background: linear-gradient(145deg, #f4dfb4, #9b713d 48%, #e8c78a);
      overflow: hidden;
      box-shadow:
        0 13px 28px rgba(0,0,0,0.34),
        inset 0 0 0 2px rgba(255,255,255,.28);
    }

    .couple-photo-wrap:after {
      content: "";
      position: absolute;
      z-index: 2;
      inset: 9px;
      border: 1px solid rgba(255, 231, 184, .8);
      border-radius: 82px 82px 5px 5px;
      pointer-events: none;
    }

    .couple-photo {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 84px 84px 5px 5px;
      filter: saturate(.96) contrast(1.03);
    }

    .couple-tablet.groom .couple-photo {
      object-position: 55% 30%;
      transform-origin: 55% 30%;
      transform: scale(1.13);
    }

    .couple-tablet.bride .couple-photo {
      object-position: 68% 31%;
      transform-origin: 68% 31%;
      transform: scale(1.27);
    }
    
    .person-role-tag {
      display: inline-block;
      font-family: 'Montserrat', sans-serif;
      font-size: 9.5px;
      font-weight: 700;
      letter-spacing: 0.22em;
      color: #ffdce2;
      background: rgba(212, 175, 122, 0.25);
      border: 1px solid rgba(212, 175, 122, 0.5);
      padding: 4px 16px;
      border-radius: 4px;
      text-transform: uppercase;
      margin-bottom: 12px;
    }
    
    .tablet-name {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 38px;
      line-height: 1.1;
      font-weight: 700;
      margin: 0 0 12px;
      color: #fff;
      text-shadow: 0 2px 8px rgba(0,0,0,0.35);
      letter-spacing: 0.03em;
    }
    
    .tablet-parents {
      margin: 0;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16px;
      line-height: 1.55;
      color: #eed5dc;
    }
    
    .tablet-parents strong {
      color: #d4af7a;
      font-size: 17px;
      font-weight: 700;
    }
    
    .ampersand-diamond-wrap {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: -10px 0;
      z-index: 10;
    }
    
    .ampersand-diamond {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      transform: rotate(45deg);
      background: linear-gradient(135deg, #d4af7a, #99733e);
      border: 2.5px solid #fff;
      box-shadow: 0 6px 18px rgba(0,0,0,0.3);
      display: grid;
      place-items: center;
    }

    .ampersand-diamond span {
      transform: rotate(-45deg);
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 24px;
      font-weight: 700;
      font-style: italic;
      color: #fff;
    }
    
    .couple-flower { position: absolute; right: -15px; bottom: 30px; width: 130px; opacity: .94; z-index: 6; pointer-events: none; }
    .couple-carriage { position: absolute; left: 0; bottom: 0; width: 100%; opacity: .18; z-index: 1; pointer-events: none; }
    
    /* =================== STORY SECTION =================== */
    .title-combo {
      font-size: 36px;
      color: var(--maroon);
      text-align: center;
      font-weight: 500;
      position: relative;
      z-index: 2;
    }
    
    .title-combo span {
      font-size: 30px;
      margin-right: 6px;
    }
    
    .section-subtitle {
      font-size: 34px;
      color: var(--maroon);
      text-align: center;
      font-weight: 500;
    }
    
    .section-subtitle.big {
      margin-bottom: 20px;
    }
    
    .section-title-script {
      font-size: 36px;
      text-align: center;
      font-weight: 400;
      line-height: 1.2;
      margin-top: 16px;
    }
    
    .section-note {
      max-width: 300px;
      margin: 10px auto 22px;
      text-align: center;
      font-size: 11px;
      line-height: 1.65;
      color: #94616d;
    }
    
    .story-section {
      position: relative;
      padding-top: 40px;
      text-align: center;
      overflow: hidden;
    }
    .story-tassel { position: absolute; left: 16px; top: 120px; width: 34px; opacity: .92; z-index: 2; pointer-events: none; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.25)); }
    .story-flower { position: absolute; right: -25px; top: 160px; width: 140px; z-index: 1; opacity: 0.25; pointer-events: none; }
    
    .story-prologue-box {
      position: relative;
      z-index: 5;
      max-width: 330px;
      margin: 10px auto 36px;
      padding: 18px 22px;
      background: linear-gradient(145deg, rgba(255, 255, 255, 0.92), rgba(253, 240, 244, 0.95));
      border: 1.5px solid #d4af7a;
      border-radius: 6px;
      box-shadow: 0 10px 25px rgba(111,22,39,0.1);
    }
    .story-prologue-box:before, .story-prologue-box:after {
      content: "";
      position: absolute;
      width: 10px;
      height: 10px;
      border-color: #7a1327;
      border-style: solid;
      pointer-events: none;
    }
    .story-prologue-box:before { top: 3px; left: 3px; border-width: 1.5px 0 0 1.5px; }
    .story-prologue-box:after { bottom: 3px; right: 3px; border-width: 0 1.5px 1.5px 0; }
    
    .story-subtitle {
      font-family: 'Playfair Display', Georgia, serif;
      font-style: italic;
      font-size: 14px;
      color: #7a1327;
      margin: 0;
      line-height: 1.55;
    }

    .story-timeline {
      position: relative;
      max-width: 380px;
      margin: 10px auto 0;
      padding: 10px 14px 20px 38px;
      text-align: left;
    }
    
    .story-timeline::before {
      content: '';
      position: absolute;
      top: 15px;
      bottom: 40px;
      left: 18px;
      width: 2px;
      background: linear-gradient(180deg, transparent, #d4af7a, #7a1327, #d4af7a, transparent);
      box-shadow: 0 0 8px rgba(212, 175, 122, 0.4);
    }
    
    .story-card {
      position: relative;
      background: linear-gradient(145deg, #ffffff 0%, #fcf5f7 100%);
      border: 2px solid #d4af7a;
      border-radius: 4px 26px 4px 26px;
      padding: 30px 22px 26px;
      margin-bottom: 34px;
      box-shadow: 0 15px 35px rgba(111,22,39,0.12), 6px 6px 0px rgba(212, 175, 122, 0.35);
      transition: all 0.4s ease;
      overflow: hidden;
    }
    
    .story-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 22px 45px rgba(111,22,39,0.2), 8px 8px 0px rgba(212, 175, 122, 0.45);
    }

    .story-card:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px dashed rgba(212, 175, 122, 0.45);
      border-radius: 2px 18px 2px 18px;
      pointer-events: none;
    }

    .story-node {
      position: absolute;
      left: -38px;
      top: 24px;
      width: 38px;
      height: 38px;
      border-radius: 10px;
      transform: rotate(45deg);
      background: linear-gradient(135deg, #7a1327, #440915);
      border: 2px solid #d4af7a;
      box-shadow: 0 0 0 5px rgba(212, 175, 122, 0.25), 0 6px 16px rgba(111,22,39,0.3);
      display: grid;
      place-items: center;
      z-index: 10;
    }

    .story-node span {
      transform: rotate(-45deg);
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 15px;
      color: #ffdce2;
    }

    .story-chapter-tag {
      display: inline-block;
      font-family: 'Montserrat', sans-serif;
      font-size: 9.5px;
      font-weight: 700;
      letter-spacing: 0.24em;
      text-transform: uppercase;
      color: #ffdce2;
      background: linear-gradient(135deg, #7a1327, #440915);
      border: 1.5px solid #d4af7a;
      padding: 5px 16px;
      border-radius: 4px;
      box-shadow: 0 4px 12px rgba(111,22,39,0.25);
      margin-bottom: 14px;
      position: relative;
      z-index: 5;
    }

    .story-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 25px;
      font-weight: 700;
      color: #7a1327;
      margin: 0 0 12px;
      line-height: 1.25;
      letter-spacing: 0.02em;
      text-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .story-divider {
      width: 65px;
      height: 3px;
      background: linear-gradient(90deg, #7a1327, #d4af7a, transparent);
      margin: 0 0 16px;
      border-radius: 2px;
    }

    .story-text {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16.5px;
      line-height: 1.75;
      color: #4a1d28;
      margin: 0;
      text-align: justify;
      position: relative;
      z-index: 2;
    }

    /* Removed drop cap styling to keep capital letter normal */
    .story-text::first-letter {
      font-family: inherit;
      font-size: inherit;
      font-weight: inherit;
      color: inherit;
      float: none;
      line-height: inherit;
      margin: 0;
      padding: 0;
      background: none;
      border: none;
    }

    .story-quote-bg {
      position: absolute;
      right: 14px;
      bottom: 6px;
      font-family: 'Great Vibes', cursive;
      font-size: 85px;
      color: rgba(212, 175, 122, 0.12);
      line-height: 1;
      pointer-events: none;
      user-select: none;
    }
    
    .year, .year-top {
      font-size: 40px;
      line-height: 1;
      color: #ddd0d4;
      font-style: italic;
      font-weight: 700;
    }
    
    .story-copy p {
      margin: 6px 0 0;
      font-size: 9px;
      line-height: 1.4;
      color: #8a5562;
    }
    
    /* =================== COUNTDOWN & GRATITUDE =================== */
    .countdown-section { padding: 40px 16px 30px; text-align: center; }
    
    .gratitude-card {
      position: relative;
      max-width: 380px;
      margin: 10px auto 40px;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.96), rgba(253, 245, 247, 0.90));
      border: 1px solid rgba(180, 115, 128, 0.32);
      border-radius: 24px;
      padding: 36px 26px 30px;
      box-shadow: 0 18px 40px rgba(111, 22, 39, 0.09);
      backdrop-filter: blur(10px);
      text-align: center;
    }
    
    .gratitude-badge {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--maroon), #882436);
      color: #fff;
      display: grid;
      place-items: center;
      border: 3px solid #fff;
      box-shadow: 0 6px 16px rgba(111, 22, 39, 0.25);
      font-size: 18px;
    }
    
    .gratitude-flower {
      position: absolute;
      right: -15px;
      bottom: -15px;
      width: 75px;
      opacity: 0.8;
      pointer-events: none;
    }
    
    .gratitude-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 20px;
      font-weight: 700;
      color: var(--maroon);
      margin: 8px 0 14px;
    }

    .gratitude-text {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16px;
      line-height: 1.75;
      color: #5d2835;
      margin: 0 0 20px;
      font-style: italic;
    }
    
    .gratitude-signoff {
      font-family: 'Great Vibes', cursive;
      font-size: 30px;
      color: var(--maroon);
      line-height: 1.2;
    }
    
    .count-title { margin: 20px 0 24px; }
    
    .count-frame {
      position: relative;
      max-width: 380px;
      margin: 0 auto;
      background: linear-gradient(145deg, rgba(255, 255, 255, 0.98), rgba(254, 246, 248, 0.92));
      padding: 38px 20px 30px;
      border-radius: 26px;
      box-shadow: 0 20px 48px rgba(111, 22, 39, 0.12);
      border: 1px solid rgba(180, 115, 128, 0.35);
    }
    
    .count-frame:before {
      content: "";
      position: absolute;
      inset: 10px;
      border: 1px dashed rgba(184, 95, 114, 0.45);
      border-radius: 18px;
      pointer-events: none;
    }
    
    .count-frame:after {
      content: "❦";
      position: absolute;
      top: 10px;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 20px;
      color: #b85f72;
      background: #fff;
      padding: 0 12px;
      border-radius: 99px;
    }
    
    .count-grid {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      text-align: center;
      margin-bottom: 24px;
    }
    
    .count-grid > div {
      background: rgba(255, 245, 247, 0.85);
      border: 1px solid rgba(180, 115, 128, 0.25);
      border-radius: 16px;
      padding: 14px 4px;
      box-shadow: 0 4px 12px rgba(111, 22, 39, 0.04);
      transition: transform 0.3s ease, background 0.3s ease;
    }
    
    .count-grid > div:hover {
      transform: translateY(-3px);
      background: rgba(255, 238, 242, 0.95);
      border-color: rgba(180, 115, 128, 0.45);
    }
    
    .count-grid strong {
      display: block;
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 28px;
      color: var(--maroon);
      font-weight: 700;
      line-height: 1;
      margin-bottom: 6px;
    }
    
    .count-grid span {
      display: block;
      font-family: 'Montserrat', sans-serif;
      font-size: 9.5px;
      font-weight: 700;
      letter-spacing: .12em;
      color: #8c5360;
    }
    
    .light-btn, #calendarBtn {
      position: relative;
      z-index: 2;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin: 10px auto 0;
      border: 0;
      border-radius: 999px;
      padding: 14px 32px;
      background: linear-gradient(135deg, var(--maroon), #882436);
      color: #fff;
      box-shadow: 0 8px 22px rgba(111, 22, 39, 0.25);
      font-family: 'Montserrat', sans-serif;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.08em;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .light-btn:hover, #calendarBtn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(111, 22, 39, 0.35);
      background: linear-gradient(135deg, #882436, var(--maroon));
    }
    
    /* =================== CALENDAR =================== */
    .calendar-section { text-align: center; padding: 36px 16px 20px; }
    
    .calendar-card {
      position: relative;
      max-width: 380px;
      margin: 10px auto 30px;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(254, 246, 248, 0.92));
      border: 1px solid rgba(180, 115, 128, 0.35);
      border-radius: 28px;
      padding: 38px 22px 32px;
      box-shadow: 0 20px 50px rgba(111, 22, 39, 0.12);
      overflow: hidden;
    }
    
    .calendar-flower-top {
      position: absolute;
      right: -24px;
      top: -48px;
      width: 100px;
      opacity: 0.85;
      pointer-events: none;
      z-index: 1;
      transform: rotate(15deg);
    }
    
    .calendar-flower-bottom {
      position: absolute;
      left: -20px;
      bottom: -20px;
      width: 90px;
      opacity: 0.82;
      pointer-events: none;
      z-index: 1;
      transform: rotate(-15deg);
    }
    
    .calendar-year-badge {
      position: relative;
      z-index: 2;
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.18em;
      color: #a86273;
      background: rgba(202, 141, 153, 0.15);
      padding: 5px 16px;
      border-radius: 999px;
      display: inline-block;
      margin-bottom: 8px;
    }

    .month-name {
      position: relative;
      z-index: 2;
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 32px;
      font-weight: 700;
      color: var(--maroon);
      margin: 0 0 12px;
      line-height: 1.2;
    }
    
    .calendar-divider {
      position: relative;
      z-index: 2;
      width: 48px;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--maroon), transparent);
      margin: 0 auto 18px;
    }
    
    .calendar-grid {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 6px;
      margin: 10px 0 12px;
    }
    
    .calendar-grid .head {
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 700;
      color: #9c4d5f;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      padding-bottom: 12px;
      border-bottom: 1px solid rgba(180, 115, 128, 0.2);
      margin-bottom: 6px;
    }
    
    .calendar-grid .day-cell {
      height: 38px;
      display: grid;
      place-items: center;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 17px;
      font-weight: 600;
      color: #5d2835;
      border-radius: 10px;
      transition: all 0.3s ease;
    }
    
    .calendar-grid .day-cell:hover:not(.empty) {
      background: rgba(202, 141, 153, 0.15);
      transform: scale(1.1);
    }
    
    .calendar-grid .day-cell.active-day {
      background: linear-gradient(135deg, var(--maroon), #882436);
      color: #fff;
      font-weight: 700;
      font-size: 18px;
      box-shadow: 0 6px 16px rgba(111, 22, 39, 0.4);
      transform: scale(1.12);
      border: 2px solid #fff;
    }
    
    .calendar-note {
      position: relative;
      z-index: 2;
      font-family: 'Montserrat', sans-serif;
      font-size: 11.5px;
      font-weight: 600;
      color: #8c263a;
      background: rgba(255, 235, 240, 0.85);
      border: 1px dashed rgba(180, 115, 128, 0.45);
      padding: 10px 18px;
      border-radius: 14px;
      margin-top: 16px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    
    .heart-dot {
      color: var(--maroon);
      font-size: 14px;
    }
    
    /* =================== EVENTS =================== */
    .events-section {
      position: relative;
      padding: 50px 16px 44px;
      text-align: center;
      background: radial-gradient(circle at 50% 20%, rgba(255, 255, 255, 0.75), transparent 75%),
                  linear-gradient(180deg, rgba(253, 240, 244, 0.2) 0%, rgba(244, 218, 225, 0.85) 50%, rgba(253, 240, 244, 0.2) 100%),
                  url("https://www.transparenttextures.com/patterns/handmade-paper.png");
      border-top: 1px dashed rgba(180, 115, 128, 0.35);
      border-bottom: 1px dashed rgba(180, 115, 128, 0.35);
      margin: 20px 0;
      overflow: hidden;
    }
    
    .event-flower-top {
      position: absolute;
      right: -25px;
      top: 10px;
      width: 120px;
      opacity: 0.85;
      pointer-events: none;
      z-index: 1;
      transform: rotate(15deg);
    }
    
    .event-flower-bottom {
      position: absolute;
      left: -25px;
      bottom: 10px;
      width: 110px;
      opacity: 0.85;
      pointer-events: none;
      z-index: 1;
      transform: rotate(-15deg);
    }
    
    .event-card {
      position: relative;
      z-index: 2;
      width: 100%;
      max-width: 360px;
      margin: 24px auto 38px;
      padding: 46px 24px 38px;
      background: linear-gradient(155deg, #7a1327 0%, #560e1d 60%, #440915 100%);
      color: #fff;
      box-shadow: 0 24px 54px rgba(111, 22, 39, 0.25), 0 4px 14px rgba(0,0,0,0.12);
      transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    
    .event-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 60px rgba(111, 22, 39, 0.32), 0 6px 18px rgba(0,0,0,0.15);
    }
    
    .event-card.arch {
      border: 2px solid rgba(212, 175, 122, 0.75);
      border-radius: 40px 12px 40px 12px;
    }
    
    .event-card.shield {
      border: 2px solid rgba(212, 175, 122, 0.75);
      border-radius: 12px 40px 12px 40px;
    }
    
    .event-card:before {
      content: "";
      position: absolute;
      inset: 10px;
      border: 1px dashed rgba(255, 255, 255, 0.3);
      border-radius: inherit;
      pointer-events: none;
    }
    
    .event-badge-icon {
      position: absolute;
      top: -18px;
      left: 50%;
      transform: translateX(-50%);
      width: 38px;
      height: 38px;
      background: linear-gradient(135deg, #d4af7a, #aa824a);
      color: #fff;
      border-radius: 50%;
      display: grid;
      place-items: center;
      font-size: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      border: 2px solid #fff;
      z-index: 3;
    }
    
    .event-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 32px;
      font-weight: 700;
      color: #fff;
      margin: 10px 0 4px;
      letter-spacing: 0.02em;
      text-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }
    
    .event-script-sub {
      font-family: 'Great Vibes', cursive;
      font-size: 26px;
      color: #eed3d8;
      margin-bottom: 16px;
      display: block;
    }
    
    .event-divider {
      width: 54px;
      height: 2px;
      background: linear-gradient(90deg, transparent, #d4af7a, transparent);
      margin: 0 auto 22px;
    }
    
    .event-time-box {
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.25);
      border-radius: 16px;
      padding: 14px 18px;
      margin: 0 auto 24px;
      max-width: 280px;
      backdrop-filter: blur(4px);
    }
    
    .event-date-text {
      font-family: 'Montserrat', sans-serif;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.08em;
      color: #ffdce2;
      margin-bottom: 4px;
      text-transform: uppercase;
    }
    
    .event-clock-text {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 20px;
      font-weight: 700;
      color: #fff;
    }
    
    .event-place {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 21px;
      font-weight: 700;
      color: #fff;
      margin-bottom: 8px;
    }
    
    .event-address {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16px;
      line-height: 1.6;
      color: #eed6dd;
      margin: 0 auto 26px;
      max-width: 270px;
    }
    
    .outline-btn, .maps-btn {
      position: relative;
      z-index: 3;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      background: linear-gradient(135deg, #fff, #f6e8eb);
      color: #6a1023;
      border: 1px solid rgba(255, 255, 255, 0.9);
      border-radius: 999px;
      padding: 13px 32px;
      font-family: 'Montserrat', sans-serif;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 0.12em;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .outline-btn:hover, .maps-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 28px rgba(0, 0, 0, 0.35);
      background: #fff;
      color: #440915;
    }
    
    /* =================== TIMELINE =================== */
    .timeline-section {
      position: relative;
      padding: 40px 16px 44px;
      text-align: center;
    }
    
    .timeline-card {
      position: relative;
      max-width: 360px;
      margin: 20px auto 10px;
      padding: 36px 18px 30px;
      background: rgba(255, 255, 255, 0.4);
      border: 1.5px solid rgba(212, 175, 122, 0.4);
      border-radius: 28px;
      box-shadow: 0 20px 45px rgba(111, 22, 39, 0.1);
      backdrop-filter: blur(10px);
    }
    
    .timeline-card:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px dashed rgba(180, 115, 128, 0.35);
      border-radius: 20px;
      pointer-events: none;
    }
    
    .curtain-set { position: relative; height: 120px; margin: 10px 0 20px; }
    .curtain-side { position: absolute; top: 0; width: 70px; height: 110px; background: linear-gradient(180deg, #8d1a30, #6a1023); box-shadow: var(--shadow); }
    .curtain-side.left { left: 14px; border-radius: 14px 6px 44px 44px; clip-path: polygon(0 0, 100% 0, 76% 100%, 10% 100%); }
    .curtain-side.right { right: 14px; border-radius: 6px 14px 44px 44px; clip-path: polygon(0 0, 100% 0, 90% 100%, 24% 100%); }
    .curtain-top { position: absolute; left: 50%; top: 0; transform: translateX(-50%); width: 170px; height: 50px; background: linear-gradient(180deg, #8d1a30, #6a1023); border-radius: 0 0 80px 80px; box-shadow: var(--shadow); }
    
    .timeline-list {
      position: relative;
      z-index: 2;
      max-width: 320px;
      margin: 10px auto 0;
      text-align: left;
      padding: 10px 0;
    }
    
    /* Golden Thread connecting timeline items */
    .timeline-list:before {
      content: "";
      position: absolute;
      left: 50%;
      top: 15px;
      bottom: 15px;
      width: 2px;
      background: repeating-linear-gradient(180deg, #d4af7a 0, #d4af7a 10px, transparent 10px, transparent 20px);
      transform: translateX(-50%);
      z-index: 0;
    }
    
    .timeline-row {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      padding: 18px 16px;
      margin-bottom: 18px;
      background: linear-gradient(145deg, #ffffff, #fff8fa);
      border: 1.5px solid rgba(212, 175, 122, 0.5);
      border-radius: 18px;
      box-shadow: 0 10px 25px rgba(111, 22, 39, 0.12);
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    /* Straight, clean layout (no rotation as requested) */
    .timeline-row {
      border-left: 5px solid #d4af7a;
      transform: none !important;
    }
    .timeline-row:nth-child(odd) {
      transform: none;
    }
    .timeline-row:nth-child(even) {
      transform: none;
    }
    
    .timeline-row:hover {
      background: #ffffff;
      transform: scale(1.04) !important;
      box-shadow: 0 16px 35px rgba(111, 22, 39, 0.22);
      border-color: #d4af7a;
      z-index: 5;
    }
    
    .timeline-row span {
      background: linear-gradient(135deg, #7a1327, #440915);
      color: #ffdce2;
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 700;
      padding: 6px 16px;
      border-radius: 20px;
      border: 1px solid #d4af7a;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      box-shadow: 0 4px 10px rgba(111, 22, 39, 0.25);
    }
    
    .timeline-row p {
      margin: 0;
      text-align: center;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 18px;
      font-weight: 700;
      color: #520a18;
      letter-spacing: 0.02em;
    }
    
    /* =================== DRESSCODE =================== */
    .dresscode-section {
      position: relative;
      padding: 40px 16px 44px;
      text-align: center;
    }
    .dresscode-card {
      position: relative;
      max-width: 360px;
      margin: 20px auto;
      padding: 48px 22px 38px;
      background: linear-gradient(170deg, #ffffff, #fdf6f8);
      border: 2px solid #d4af7a;
      border-radius: 20px;
      box-shadow: 0 24px 50px rgba(111, 22, 39, 0.18);
    }
    .dresscode-card:before {
      content: "";
      position: absolute;
      inset: 10px;
      border: 1px dashed rgba(180, 115, 128, 0.35);
      border-radius: inherit;
      pointer-events: none;
    }
    /* Corner edge florals for Dresscode card (di tepi-tepi) so they NEVER cover text */
    .dress-flower-left {
      position: absolute;
      top: -24px;
      left: -24px;
      width: 125px;
      z-index: 5;
      pointer-events: none;
      filter: drop-shadow(0 8px 16px rgba(111,22,39,0.2));
    }
    .dress-flower-right {
      position: absolute;
      bottom: -24px;
      right: -24px;
      width: 125px;
      z-index: 5;
      pointer-events: none;
      filter: drop-shadow(0 8px 16px rgba(111,22,39,0.2));
      transform: scale(-1);
    }
    
    /* Harmonious Happy Vibes Florals & Butterflies across sections */
    .timeline-flower-left { position: absolute; left: -20px; top: 120px; width: 130px; z-index: 4; opacity: 0.9; pointer-events: none; filter: drop-shadow(0 8px 15px rgba(0,0,0,0.12)); }
    .timeline-flower-right { position: absolute; right: -20px; bottom: 80px; width: 130px; z-index: 4; opacity: 0.9; pointer-events: none; filter: drop-shadow(0 8px 15px rgba(0,0,0,0.12)); }
    .timeline-butterfly { position: absolute; right: 25px; top: 40px; width: 45px; z-index: 6; opacity: 0.95; pointer-events: none; animation: flutterHappy 3s infinite ease-in-out; }
    .couple-happy-butterflies { position: absolute; left: 20px; top: 220px; width: 65px; z-index: 6; opacity: 0.95; pointer-events: none; animation: flutterHappy 3.5s infinite ease-in-out; }
    .story-butterfly { position: absolute; left: 30px; top: 80px; width: 55px; z-index: 6; opacity: 0.95; pointer-events: none; animation: flutterHappy 4s infinite ease-in-out; }
    .gratitude-butterfly { position: absolute; right: 25px; bottom: 40px; width: 50px; z-index: 6; opacity: 0.95; pointer-events: none; animation: flutterHappy 3.2s infinite ease-in-out; }
    .closing-flower { position: absolute; left: -15px; bottom: 30px; width: 130px; z-index: 4; opacity: 0.85; pointer-events: none; }
    .closing-carriage { position: absolute; right: 20px; bottom: 10px; width: 60%; opacity: 0.2; z-index: 1; pointer-events: none; }

    @keyframes flutterHappy {
      0%, 100% { transform: translateY(0) rotate(0deg) scale(1); }
      50% { transform: translateY(-8px) rotate(6deg) scale(1.08); }
    }

    /* =================== HAPPY VIBES FLOATING PARTICLES =================== */
    .happy-vibes-particles {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 999;
      overflow: hidden;
    }
    .vibes-item {
      position: absolute;
      bottom: -40px;
      font-size: 18px;
      opacity: 0;
      animation: floatUpHappy 8s infinite linear;
    }
    .v1 { left: 10%; animation-delay: 0s; animation-duration: 9s; font-size: 16px; }
    .v2 { left: 25%; animation-delay: 2s; animation-duration: 11s; font-size: 20px; }
    .v3 { left: 40%; animation-delay: 4s; animation-duration: 8s; font-size: 14px; }
    .v4 { left: 55%; animation-delay: 1s; animation-duration: 12s; font-size: 18px; }
    .v5 { left: 70%; animation-delay: 3s; animation-duration: 10s; font-size: 15px; }
    .v6 { left: 85%; animation-delay: 5s; animation-duration: 9s; font-size: 17px; }
    .v7 { left: 15%; animation-delay: 6s; animation-duration: 11s; font-size: 19px; }
    .v8 { left: 75%; animation-delay: 7s; animation-duration: 10s; font-size: 16px; }

    @keyframes floatUpHappy {
      0% { transform: translateY(0) rotate(0deg) scale(0.8); opacity: 0; }
      15% { opacity: 0.85; }
      80% { opacity: 0.85; }
      100% { transform: translateY(-110vh) rotate(360deg) scale(1.1); opacity: 0; }
    }
    .dress-title {
      position: relative;
      z-index: 4;
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 32px;
      font-weight: 700;
      color: var(--maroon);
      margin-top: 22px;
    }
    .dress-caption {
      position: relative;
      z-index: 4;
      max-width: 290px;
      margin: 14px auto 0;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16px;
      line-height: 1.6;
      color: #7c4452;
    }
    
    /* Creative Attire Cards Guide */
    .attire-grid {
      position: relative;
      z-index: 4;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-top: 24px;
    }
    .attire-box {
      background: rgba(255, 255, 255, 0.9);
      border: 1px solid rgba(212, 175, 122, 0.5);
      border-radius: 14px;
      padding: 16px 10px 14px;
      box-shadow: 0 8px 20px rgba(111, 22, 39, 0.08);
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: transform 0.3s ease;
    }
    .attire-box:hover {
      transform: translateY(-4px);
      border-color: #d4af7a;
      box-shadow: 0 12px 25px rgba(111, 22, 39, 0.15);
    }
    .attire-icon-circle {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: linear-gradient(135deg, #7a1327, #440915);
      border: 2px solid #d4af7a;
      display: grid;
      place-items: center;
      margin-bottom: 10px;
      box-shadow: 0 4px 10px rgba(111, 22, 39, 0.25);
    }
    .attire-box h4 {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 15px;
      font-weight: 700;
      color: #520a18;
      margin: 0 0 4px 0;
    }
    .attire-box p {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 12.5px;
      line-height: 1.4;
      color: #7c4452;
      margin: 0;
    }
    
    .swatch-row { position: relative; z-index: 2; display: flex; justify-content: center; gap: 16px; margin-top: 26px; }
    .swatch-item { display: flex; flex-direction: column; align-items: center; gap: 6px; }
    .swatch { width: 54px; height: 54px; border-radius: 50%; display: block; box-shadow: 0 6px 14px rgba(0,0,0,0.18); border: 3px solid #fff; transition: transform 0.3s ease; }
    .swatch-item:hover .swatch { transform: scale(1.15); }
    .swatch-label { font-family: 'Montserrat', sans-serif; font-size: 10px; font-weight: 700; color: #8c4c5c; letter-spacing: 0.05em; text-transform: uppercase; }
    .sw1 { background: radial-gradient(circle at 35% 25%, #a16e7f, #521523); }
    .sw2 { background: radial-gradient(circle at 35% 25%, #4a3e3e, #1a1a1a); }
    .sw3 { background: radial-gradient(circle at 35% 25%, #fffaf5, #e6d3d7); }
    .sw4 { background: radial-gradient(circle at 35% 25%, #a67d65, #5a311b); }
    
    /* =================== RSVP & GUESTBOOK =================== */
    .rsvp-section, .wishes-section { position: relative; padding: 40px 16px; text-align: center; }
    
    .maroon-form {
      position: relative;
      max-width: 360px;
      margin: 20px auto 0;
      background: linear-gradient(155deg, #7a1327 0%, #560e1d 60%, #440915 100%);
      border: 2px solid rgba(212, 175, 122, 0.75);
      border-radius: 26px;
      color: #fff;
      padding: 34px 22px 28px;
      box-shadow: 0 24px 54px rgba(111, 22, 39, 0.28);
      text-align: left;
    }
    
    .maroon-form:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px dashed rgba(255, 255, 255, 0.28);
      border-radius: 18px;
      pointer-events: none;
    }
    
    .maroon-form label {
      position: relative;
      z-index: 2;
      display: block;
      font-family: 'Montserrat', sans-serif;
      font-size: 10.5px;
      font-weight: 700;
      letter-spacing: .08em;
      color: #ffdce2;
      margin-bottom: 12px;
      text-transform: uppercase;
    }
    
    .maroon-form input, .maroon-form textarea, .maroon-form select {
      position: relative;
      z-index: 2;
      width: 100%;
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.08);
      color: #fff;
      padding: 12px 14px;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16px;
      outline: none;
      transition: all 0.3s ease;
      margin-top: 6px;
    }
    
    .maroon-form input:focus, .maroon-form textarea:focus, .maroon-form select:focus {
      border-color: #d4af7a;
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 12px rgba(212, 175, 122, 0.3);
    }
    
    .maroon-form select option { background: #560e1d; color: #fff; }
    .maroon-form input::placeholder, .maroon-form textarea::placeholder { color: #d7b5bd; opacity: 0.8; font-style: italic; }
    
    .option-box {
      position: relative;
      z-index: 2;
      display: flex !important;
      align-items: center;
      gap: 10px;
      background: rgba(255,255,255,.1);
      border: 1px solid rgba(255,255,255,.22);
      border-radius: 12px;
      padding: 12px 14px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 16px !important;
      color: #fff !important;
      text-transform: none !important;
      letter-spacing: normal !important;
    }
    
    .option-box:hover { background: rgba(255,255,255,.18); border-color: #d4af7a; }
    .option-box input { width: auto; margin: 0; accent-color: #d4af7a; }
    
    .form-btn {
      position: relative;
      z-index: 2;
      width: 100%;
      margin-top: 18px;
      border: 1px solid #fff;
      border-radius: 999px;
      background: linear-gradient(135deg, #fff, #f6e8eb);
      color: #6a1023;
      padding: 14px 20px;
      font-family: 'Montserrat', sans-serif;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 0.12em;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      transition: all 0.3s ease;
    }
    
    .form-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 28px rgba(0,0,0,0.35);
      background: #fff;
      color: #440915;
    }
    
    .latest-title {
      position: relative;
      z-index: 2;
      text-align: center;
      margin: 28px 0 12px;
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .12em;
      color: #ffdce2;
    }
    
    .latest-box {
      position: relative;
      z-index: 2;
      min-height: 150px;
      border: 1px solid rgba(255,255,255,.3);
      border-radius: 14px;
      padding: 16px;
      background: rgba(0, 0, 0, 0.15);
      color: #e9d3d9;
    }
    
    /* =================== GALLERY =================== */
    .gallery-section { position: relative; padding: 40px 16px; text-align: center; }
    
    .gallery-card {
      position: relative;
      max-width: 360px;
      margin: 20px auto;
      padding: 34px 18px 24px;
      background:
        radial-gradient(circle at 12% 8%, rgba(118, 85, 66, .48), transparent 34%),
        radial-gradient(circle at 92% 90%, rgba(87, 55, 49, .5), transparent 38%),
        linear-gradient(145deg, #392b24, #211a17);
      border: 1px solid rgba(212, 175, 122, 0.45);
      border-radius: 18px;
      box-shadow: 0 20px 45px rgba(34, 21, 18, 0.3);
      backdrop-filter: blur(10px);
    }
    
    .gallery-card:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px solid rgba(212, 175, 122, 0.2);
      border-radius: 12px;
      pointer-events: none;
    }
    
    .album-book {
      position: relative;
      z-index: 2;
      width: 148px;
      height: 195px;
      margin: 10px auto 20px;
      border-radius: 10px;
      background: linear-gradient(145deg, #8b1630, #5d1022);
      color: #fff;
      box-shadow: 0 16px 35px rgba(111,22,39,0.35);
      display: grid;
      place-items: center;
      transform: rotate(-6deg);
      border: 2px solid rgba(212, 175, 122, 0.6);
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.15em;
    }
    
    .album-book:before {
      content: "";
      position: absolute;
      left: 12px;
      top: 0;
      bottom: 0;
      width: 14px;
      background: rgba(255,255,255,.12);
      border-right: 1px solid rgba(212, 175, 122, 0.4);
    }
    
    .gallery-label { position: relative; z-index: 2; font-family: 'Playfair Display', Georgia, serif; font-size: 32px; font-weight: 700; color: var(--maroon); margin-bottom: 18px; }
    
    .gallery-grid {
      position: relative;
      z-index: 2;
      display: grid;
      grid-template-columns: repeat(6, minmax(0, 1fr));
      grid-template-rows: repeat(5, 72px);
      grid-template-areas:
        "photo1 photo1 photo1 photo2 photo2 photo2"
        "photo1 photo1 photo1 photo2 photo2 photo2"
        "photo3 photo3 photo4 photo4 photo5 photo5"
        "photo6 photo6 photo6 photo7 photo7 photo7"
        "photo6 photo6 photo6 photo7 photo7 photo7";
      gap: 8px;
      max-width: 324px;
      margin: 0 auto;
    }
    
    .gallery-photo {
      position: relative;
      width: 100%;
      height: 100%;
      min-height: 0;
      background: #211a17;
      box-shadow: 0 8px 20px rgba(0,0,0,0.28);
      color: #8e5664;
      border-radius: 6px;
      overflow: hidden;
      border: 0;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: zoom-in;
    }

    .gallery-photo:nth-child(1) { grid-area: photo1; }
    .gallery-photo:nth-child(2) { grid-area: photo2; }
    .gallery-photo:nth-child(3) { grid-area: photo3; }
    .gallery-photo:nth-child(4) { grid-area: photo4; }
    .gallery-photo:nth-child(5) { grid-area: photo5; }
    .gallery-photo:nth-child(6) { grid-area: photo6; }
    .gallery-photo:nth-child(7) { grid-area: photo7; }
    
    .gallery-photo:hover {
      transform: scale(1.04);
      box-shadow: 0 14px 30px rgba(111,22,39,0.28);
      z-index: 5;
    }
    
    .gallery-photo img {
      position: absolute;
      inset: 0;
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scale(1.02);
      transition: transform 0.3s ease;
    }

    .gallery-photo:nth-child(1) img { object-position: 50% 35%; }
    .gallery-photo:nth-child(2) img { object-position: 50% 54%; }
    .gallery-photo:nth-child(3) img { object-position: 68% 43%; }
    .gallery-photo:nth-child(4) img { object-position: 50% 50%; }
    .gallery-photo:nth-child(5) img { object-position: 50% 57%; }
    .gallery-photo:nth-child(6) img { object-position: 50% 67%; }
    .gallery-photo:nth-child(7) img { object-position: 50% 57%; }

    .gallery-photo:hover img { transform: scale(1.07); }

    .gallery-preview {
      position: fixed;
      z-index: 10000;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px 54px;
      background: rgba(25, 5, 11, 0.92);
      backdrop-filter: blur(8px);
    }

    .gallery-preview-image {
      display: block;
      max-width: min(100%, 900px);
      max-height: 88vh;
      border: 4px solid #fff;
      border-radius: 12px;
      object-fit: contain;
      box-shadow: 0 20px 60px rgba(0,0,0,.55);
    }

    .gallery-preview-close,
    .gallery-preview-nav {
      position: absolute;
      display: grid;
      place-items: center;
      width: 42px;
      height: 42px;
      padding: 0;
      border: 1px solid rgba(255,255,255,.55);
      border-radius: 50%;
      color: #fff;
      background: rgba(111,22,39,.85);
      cursor: pointer;
      font-size: 25px;
      line-height: 1;
    }

    .gallery-preview-close { top: 20px; right: 20px; }
    .gallery-preview-nav { top: 50%; transform: translateY(-50%); }
    .gallery-preview-prev { left: 10px; }
    .gallery-preview-next { right: 10px; }
    .helper-text { position: relative; z-index: 2; max-width: 290px; margin: 18px auto 0; font-family: 'Cormorant Garamond', Georgia, serif; font-size: 14px; font-style: italic; color: #8c4c5c; }
    
    /* =================== GIFT =================== */
    .gift-section { position: relative; padding: 40px 16px; text-align: center; }
    .gift-note { max-width: 320px; margin: 10px auto 24px; font-family: 'Cormorant Garamond', Georgia, serif; font-size: 16px; line-height: 1.6; color: #7c4452; }
    
    .gift-card-wrap {
      position: relative;
      max-width: 360px;
      margin: 0 auto;
      padding: 34px 20px 30px;
      background: rgba(255, 255, 255, 0.88);
      border: 1.5px solid rgba(212, 175, 122, 0.65);
      border-radius: 28px;
      box-shadow: 0 20px 45px rgba(111, 22, 39, 0.15);
      backdrop-filter: blur(10px);
    }
    
    .gift-card-wrap:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px dashed rgba(180, 115, 128, 0.35);
      border-radius: 20px;
      pointer-events: none;
    }
    
    .gift-tabs { position: relative; z-index: 2; display: flex; justify-content: center; gap: 20px; font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; color: #ad7482; margin-bottom: 24px; }
    .gift-tabs span { padding-bottom: 6px; cursor: pointer; transition: all 0.3s ease; }
    .gift-tabs .active { color: var(--maroon); border-bottom: 2.5px solid var(--maroon); }
    
    .bank-card {
      position: relative;
      z-index: 2;
      max-width: 310px;
      margin: 0 auto 18px;
      background: linear-gradient(145deg, #ffffff, #fcf0f3);
      border: 1.5px solid rgba(212, 175, 122, 0.8);
      border-radius: 20px;
      box-shadow: 0 12px 28px rgba(111,22,39,0.14);
      padding: 24px 20px;
      text-align: left;
      overflow: hidden;
    }
    
    .bank-top { display: flex; justify-content: space-between; align-items: center; color: var(--maroon); margin-bottom: 14px; font-family: 'Montserrat', sans-serif; font-size: 14px; }
    .bank-label { font-family: 'Montserrat', sans-serif; font-size: 9.5px; font-weight: 700; letter-spacing: 0.1em; color: #aa6b79; }
    .bank-number { font-family: 'Playfair Display', Georgia, serif; font-size: 26px; line-height: 1.2; color: var(--maroon); font-weight: 700; margin: 8px 0; letter-spacing: 0.05em; }
    .bank-owner { font-family: 'Cormorant Garamond', Georgia, serif; font-size: 16px; font-weight: 600; color: #7a3e4c; }
    
    .copy-btn {
      position: absolute;
      right: 18px;
      bottom: 18px;
      border: 1px solid #d4af7a;
      background: linear-gradient(135deg, var(--maroon), #6a1023);
      color: #fff;
      border-radius: 999px;
      padding: 8px 16px;
      font-family: 'Montserrat', sans-serif;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0.08em;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(111,22,39,0.25);
      transition: all 0.3s ease;
    }
    
    .copy-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 14px rgba(111,22,39,0.35); }
    .gift-footer { position: relative; z-index: 2; font-family: 'Montserrat', sans-serif; font-size: 9.5px; font-weight: 600; color: #8c4c5c; letter-spacing: .06em; margin-top: 14px; }
    
    /* =================== CLOSING =================== */
    .closing-section {
      position: relative;
      text-align: center;
      padding: 50px 16px 0;
      background: radial-gradient(circle at 50% 30%, rgba(255, 255, 255, 0.75), transparent 75%),
                  linear-gradient(180deg, rgba(253, 240, 244, 0.2) 0%, rgba(244, 218, 225, 0.85) 50%, rgba(240, 205, 215, 0.95) 100%),
                  url("https://www.transparenttextures.com/patterns/handmade-paper.png");
      overflow: hidden;
    }
    
    .closing-topline { position: absolute; top: 0; left: 0; right: 0; height: 12px; background: linear-gradient(90deg, #6d0f21, #d4af7a, #8f1b32, #6d0f21); }
    
    .closing-card {
      position: relative;
      max-width: 360px;
      margin: 20px auto 36px;
      padding: 46px 24px 38px;
      background: rgba(255, 255, 255, 0.88);
      border: 1.5px solid rgba(212, 175, 122, 0.7);
      border-radius: 16px;
      box-shadow: 0 24px 50px rgba(111, 22, 39, 0.2);
      backdrop-filter: blur(10px);
    }
    
    .closing-card:before {
      content: "";
      position: absolute;
      inset: 10px;
      border: 1px dashed rgba(180, 115, 128, 0.35);
      border-radius: inherit;
      pointer-events: none;
    }
    
    .closing-title { position: relative; z-index: 2; font-family: 'Great Vibes', cursive; font-size: 48px; line-height: 1.1; color: var(--maroon); margin-top: 10px; font-weight: 400; }
    .closing-copy { position: relative; z-index: 2; max-width: 290px; margin: 16px auto 0; font-family: 'Cormorant Garamond', Georgia, serif; font-size: 15px; line-height: 1.7; color: #7c4452; }
    .closing-thanks { position: relative; z-index: 2; margin-top: 20px; font-family: 'Playfair Display', Georgia, serif; font-size: 26px; color: var(--maroon); font-weight: 700; letter-spacing: .06em; }
    
    .closing-monogram {
      position: relative;
      z-index: 2;
      margin: 24px auto 16px;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--maroon), #560e1d);
      color: #ffdce2;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 38px;
      font-style: normal; /* Straightened monogram */
      border: 3px solid #d4af7a;
      box-shadow: 0 10px 25px rgba(111,22,39,0.3);
    }
    
    .closing-date { position: relative; z-index: 2; margin-top: 14px; font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; letter-spacing: .08em; color: #8c4c5c; text-transform: uppercase; }
    
    .closing-names { position: relative; z-index: 2; font-family: 'Playfair Display', Georgia, serif; font-size: 34px; font-weight: 700; color: var(--maroon); margin: 16px 0 10px; font-style: normal; /* Straightened name */ }
    
    .closing-footer {
      background: linear-gradient(90deg, #7d1128, #5d0f1f);
      color: #fff;
      padding: 18px 16px;
      text-align: center;
      font-family: 'Montserrat', sans-serif;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: .16em;
      box-shadow: 0 -4px 15px rgba(0,0,0,0.15);
    }
    
    @media (max-width: 390px) {
      .cover-flower { width: 118px; }
      .cover-envelope-scene { width: 54%; }
      .cover-ornament-flower-l { width: 115px; left: -38px; }
      .cover-ornament-flower-r { width: 110px; right: -35px; }
      .hero-card-container { width: 58%; top: 168px; }
      .hero-date-badge { top: 432px; left: 10px; width: 66px; height: 66px; }
      .hero-date-badge span { font-size: 20px; }
      .hero-monogram-badge { top: 465px; right: 12px; width: 70px; height: 70px; }
      .hero-monogram-badge span { font-size: 24px; }
      .title-combo, .section-subtitle, .closing-title { font-size: 32px; }
      .title-combo span { font-size: 26px; }
      .year, .year-top { font-size: 36px; }
      .watermark-number { font-size: 56px; }
      .card-groom-name, .card-bride-name { font-size: 38px; }
      .card-ampersand-char { font-size: 20px; }
      .gratitude-card { padding: 28px 18px 24px; }
      .count-frame { padding: 30px 14px 24px; }
      .count-grid strong { font-size: 24px; }
      .calendar-card { padding: 30px 14px 24px; }
      .calendar-grid .day-cell { font-size: 15px; height: 34px; }
      .event-card { padding: 38px 18px 30px; }
      .event-title { font-size: 28px; }
      .timeline-card, .dresscode-card, .gallery-card, .gift-card-wrap, .closing-card { padding: 38px 14px 26px; }
      .timeline-row { padding: 14px 10px; gap: 6px; }
      .timeline-row p { font-size: 15px; }
      .dress-flower-left { top: -16px; left: -16px; width: 95px; }
      .dress-flower-right { bottom: -16px; right: -16px; width: 95px; }
      .timeline-flower-left, .timeline-flower-right { width: 95px; }
      .closing-flower { width: 95px; }
      .attire-grid { gap: 8px; margin-top: 18px; }
      .attire-box { padding: 12px 8px; }
      .attire-box h4 { font-size: 14px; }
      .attire-box p { font-size: 11.5px; }
      .maroon-form { padding: 28px 16px 24px; }
      .gallery-grid { grid-template-columns: repeat(6, minmax(0, 1fr)); max-width: 320px; }
      .couple-headline-side { font-size: 17px; }
      .faded-vb { width: 48px; height: 48px; }
      .faded-vb span { font-size: 18px; }
      .proclamation-box { padding: 20px 16px; }
      .couple-tablet { padding: 28px 16px 24px; }
      .tablet-name { font-size: 32px; }
    }
    
    /* Music Control Button */
    .music-btn {
      position: fixed;
      top: 16px;
      right: max(16px, calc((100vw - 430px) / 2 + 16px));
      z-index: 25;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: rgba(255, 246, 248, 0.85);
      border: 1px solid rgba(111, 20, 36, 0.15);
      box-shadow: var(--shadow);
      cursor: pointer;
      display: none; /* Show only when opened */
      place-items: center;
      color: var(--maroon);
      transition: transform 0.2s;
    }
    
    .music-btn.is-visible {
      display: grid;
    }
    
    .music-btn svg {
      width: 18px;
      height: 18px;
      fill: currentColor;
    }
  </style>
</head>
<body
  x-data="{
    isOpen: false,
    isMuted: false,
    previewIndex: null,
    galleryImages: [
      @for($index = 1; $index <= 7; $index++)
        '{{ $assetBase }}/g-{{ $index }}.jpeg',
      @endfor
    ],
    openPreview(index) {
      this.previewIndex = index;
      document.body.style.overflow = 'hidden';
    },
    closePreview() {
      this.previewIndex = null;
      document.body.style.overflow = '';
    },
    movePreview(step) {
      this.previewIndex = (this.previewIndex + step + this.galleryImages.length) % this.galleryImages.length;
    }
  }"
  @keydown.escape.window="closePreview()"
  @keydown.left.window="previewIndex !== null && movePreview(-1)"
  @keydown.right.window="previewIndex !== null && movePreview(1)"
>
  <!-- Hidden Background Music -->
  <audio id="bg-audio" loop preload="auto">
    <source src="{{ $musicUrl }}" type="audio/mpeg">
  </audio>

  <div class="page-stage">
    <div class="phone-shell" id="top">
      <!-- =================== COVER SECTION =================== -->
      <div class="cover-screen" :class="isOpen ? 'is-open' : ''" id="coverScreen">
        <img src="{{ $assetBase }}/flower_corner.png" class="cover-flower cover-flower-tl" alt="" />
        <img src="{{ $assetBase }}/flower_corner.png" class="cover-flower cover-flower-tr" alt="" />
        <img src="{{ $assetBase }}/flower_corner.png" class="cover-flower cover-flower-bl" alt="" />
        <img src="{{ $assetBase }}/flower_corner.png" class="cover-flower cover-flower-br" alt="" />
        
        <div class="cover-content">
          <p class="eyebrow">You're</p>
          <h1>INVITED</h1>
          <div class="cover-envelope-scene">
            <img src="{{ $assetBase }}/envelope_closed.png" class="cover-envelope" alt="Envelope" />
            <img src="{{ $assetBase }}/gantungan%20bunga%20dekat%20amplop%20kiri.png" class="cover-ornament-flower-l" alt="" />
            <img src="{{ $assetBase }}/tali%20di%20gantungan%20bunga%20dekat%20amplop%20kiri.png" class="cover-ornament-tassel" alt="" />
            <img src="{{ $assetBase }}/gantungan%20bunga%20dekat%20amplop%20kanan.png" class="cover-ornament-flower-r" alt="" />
            <img src="{{ $assetBase }}/kupu2.png" class="cover-ornament-butterfly" alt="" />
          </div>
          <p class="dear">Dear,</p>
          <h2 id="guestName">{{ request('to', request('kpd', 'Tamu Undangan')) }}</h2>
          <p class="cover-note" style="font-size:10px;">We are so grateful that you are going to be with us</p>
          <button class="btn-primary" id="openBtn" type="button" 
            @click="
              isOpen = true;
              let audio = document.getElementById('bg-audio');
              if (audio) { audio.play().catch(e => console.log('Autoplay blocked')); }
              setTimeout(() => window.scrollTo({ top: 0, behavior: 'smooth' }), 250);
              setTimeout(() => {
                if (typeof window.animateWithGsap === 'function') window.animateWithGsap();
              }, 400);
            "
          >LET'S OPEN</button>
        </div>
      </div>

      <!-- Music Toggle Control -->
      <button 
        id="musicToggle" 
        class="music-btn" 
        :class="isOpen ? 'is-visible' : ''" 
        aria-label="Toggle Music"
        @click="
          isMuted = !isMuted;
          let audio = document.getElementById('bg-audio');
          if (audio) { audio.muted = isMuted; }
        "
      >
        <svg x-show="!isMuted" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
        <svg x-show="isMuted" viewBox="0 0 24 24" style="display: none;" :style="isMuted ? 'display: block !important;' : ''"><path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l6 6 1.27-1.27L4.27 3zM14 7h4V3h-6v5.18l2 2z"/></svg>
      </button>

      <!-- =================== MAIN PAGE CONTENT =================== -->
      <div class="content" :class="isOpen ? 'is-visible' : ''">
        <!-- 1. HERO SECTION (GSAP VINTAGE) -->
        <section class="section stage" id="home">
          <div class="ambient ambient-1"></div>
          <div class="ambient ambient-2"></div>
          <div class="grain-layer"></div>

          <img class="piece asset envelope float-slow" src="{{ $assetBase }}/gsap/envelope-vintage.png" alt="Amplop vintage" draggable="false" />
          <img class="piece asset flower-left float-medium" src="{{ $assetBase }}/gsap/flowers-left.png" alt="Rangkaian bunga kiri" draggable="false" />
          <img class="piece asset butterfly float-butterfly" src="{{ $assetBase }}/gsap/butterfly.png" alt="Kupu-kupu" draggable="false" />
          <img class="piece asset flower-right float-soft" src="{{ $assetBase }}/gsap/flowers-right.png" alt="Rangkaian bunga kanan" draggable="false" />

          <div class="piece portrait-wrap float-soft">
            <div class="photo-oval">
              <img src="{{ $assetBase }}/pembukaan-image.jpeg" alt="Foto pasangan" draggable="false" />
            </div>
            <img class="asset photo-frame" src="{{ $assetBase }}/gsap/photo-frame-oval.png" alt="Pigura foto vintage" draggable="false" />
          </div>

          <article class="piece name-card float-card" aria-label="Nama pasangan">
            <div class="lace lace-left"></div>
            <div class="lace lace-right"></div>
            <span class="mini-label">The Wedding of</span>
            <br>
            <h1 style="font-size:45px;font-weight:normal;">Icha<br><span>&amp;</span><br>Surya</h1>
            <!-- <p>{{ \Carbon\Carbon::parse($event['date_iso'])->format('d . m . Y') }}</p> -->
          </article>

          <article class="piece date-card float-card" aria-label="Tanggal acara">
            <div class="corner corner-a"></div>
            <div class="corner corner-b"></div>
            <div class="corner corner-c"></div>
            <div class="corner corner-d"></div>
            <span style="margin-bottom:-20px;">&nbsp;</span>
            <strong>{{ \Carbon\Carbon::parse($event['date_iso'])->format('d') }} - {{ \Carbon\Carbon::parse($event['date_iso'])->locale('id')->translatedFormat('M') }}</strong>
            <em>{{ \Carbon\Carbon::parse($event['date_iso'])->format('Y') }}</em>
          </article>

          <img class="piece asset hydrangea float-medium" src="{{ $assetBase }}/gsap/hydrangea.png" alt="Bunga hydrangea" draggable="false" />
        </section>

        <!-- 2. COUPLE SECTION -->
        <section class="section couple-section" id="couple">
          <div class="couple-headline">
            <span class="couple-headline-side left">Bride</span>
            <div class="faded-vb">
              <span>{{ substr($couple['groom'], 0, 1) }}</span>&<span>{{ substr($couple['bride'], 0, 1) }}</span>
            </div>
            <span class="couple-headline-side right">Groom</span>
          </div>

          <div class="proclamation-box reveal-up">
            <div class="basmala">Assalamu'alaikum Wr. Wb.</div>
            <p class="couple-intro">Dengan segala kerendahan hati dan dengan ungkapan syukur atas limpahan rahmat Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.</p>
            <!-- <br> -->
          </div>
          

          <div class="couple-tablets-wrap">
            <!-- Groom Tablet -->
            <div class="couple-tablet groom reveal-up">
              <div class="couple-photo-wrap">
                <img class="couple-photo" src="{{ $assetBase }}/cewek-image.jpeg" alt="Foto mempelai wanita" />
              </div>
              <span class="person-role-tag">The Bride</span>
              <h2 class="tablet-name">{{ $couple['groom'] }}</h2>
              <p class="tablet-parents">The Daughter of<br /><strong>{{ $couple['parents']['groom'] }}</strong></p>
            </div>

            <!-- Ampersand Diamond -->
            <div class="ampersand-diamond-wrap reveal-up">
              <div class="ampersand-diamond">
                <span>&amp;</span>
              </div>
            </div>

            <!-- Bride Tablet -->
            <div class="couple-tablet bride reveal-up">
              <div class="couple-photo-wrap">
                <img class="couple-photo" src="{{ $assetBase }}/cowok-image.jpeg" alt="Foto mempelai pria" />
              </div>
              <span class="person-role-tag">The Groom</span>
              <h2 class="tablet-name">{{ $couple['bride'] }}</h2>
              <p class="tablet-parents">The Son of<br /><strong>{{ $couple['parents']['bride'] }}</strong></p>
            </div>

            
          </div>

          <!-- <img src="{{ $assetBase }}/flower_pink_burgundy.png" class="couple-flower" alt="" /> -->
          <img src="{{ $assetBase }}/butterflies.png" class="couple-happy-butterflies" alt="" />
          <img src="{{ $assetBase }}/carriage.png" class="couple-carriage" alt="" />


        </section>


        
                      <br>
<div class="proclamation-box reveal-up">
            <!-- <div class="basmala">Assalamu'alaikum Wr. Wb.</div> -->
            <p class="couple-intro">"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang. Sungguh, pada yang demikian itu benar-benar terdapat tanda-tanda (kebesaran Allah) bagi kaum yang berpikir." <br><i> QS. Ar-Rum : 21</i></p>
            <!-- <p class="couple-intro">Dengan segala kerendahan hati dan dengan ungkapan syukur atas limpahan rahmat Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.</p> -->
            <br>
          </div>

        <!-- 3. STORY SECTION -->
        <section class="section story-section" id="story">
          <div class="title-combo"><span>Love</span> Story</div>
          
          <div class="story-prologue-box reveal-up">
            <img src="{{ $assetBase }}/tassel.png" class="story-tassel" alt="" />
            <p class="story-subtitle">"Every chapter of our lives brought us closer to this moment."</p>
          </div>
          <img src="{{ $assetBase }}/flower_burgundy_gold.png" class="story-flower" alt="" />
          <img src="{{ $assetBase }}/butterfly_single.png" class="story-butterfly" alt="" />

          <div class="story-timeline">
            @foreach($stories as $index => $story)
              <div class="story-card reveal-up">
                <div class="story-node"><span>♥</span></div>
                <div class="story-quote-bg">“</div>
                @if(isset($story['chapter']))
                  <span class="story-chapter-tag">{{ $story['chapter'] }}</span>
                @else
                  <span class="story-chapter-tag">Chapter {{ $index + 1 }}</span>
                @endif
                <h3 class="story-title">{{ $story['title'] }}</h3>
                <div class="story-divider"></div>
                <p class="story-text">{{ $story['text'] }}</p>
              </div>
            @endforeach
          </div>
        </section>


        <!-- 4. COUNTDOWN SECTION -->
        <section class="section countdown-section" id="countdown">
          <div class="gratitude-card reveal-up">
            <div class="gratitude-badge">♥</div>
            <img src="{{ $assetBase }}/flower_lily.png" class="gratitude-flower" alt="" />
            <img src="{{ $assetBase }}/kupu2.png" class="gratitude-butterfly" alt="" />
            <h3 class="gratitude-title">Ungkapan Terima Kasih</h3>
            <p class="gratitude-text">"Terima kasih karena selalu membersamai kami hingga di titik ini. Besar harapan kami agar doa dan restu Anda menjadi bagian dari awal kisah baru kami sebagai keluarga kecil yang berbahagia."</p>
            <div class="gratitude-signoff"><span style="font-size:25px;font-weight:normal;">Icha </span><span>&</span><span style="font-size:25px;font-weight:normal;">Surya</span></div>
          </div>

          <div class="title-combo count-title"><span>Counting</span> Days</div>
          <div class="count-frame reveal-up">
            <div class="count-grid" 
                 x-data="{
                    target: new Date('{{ $event['date_iso'] }}T{{ $event['time'] }}:00+07:00').getTime(),
                    days: '00', hours: '00', minutes: '00', seconds: '00',
                    init() {
                        setInterval(() => {
                            let now = new Date().getTime();
                            let distance = this.target - now;
                            if(distance < 0) return;
                            this.days = String(Math.floor(distance / (1000*60*60*24))).padStart(2, '0');
                            this.hours = String(Math.floor((distance % (1000*60*60*24)) / (1000*60*60))).padStart(2, '0');
                            this.minutes = String(Math.floor((distance % (1000*60*60)) / (1000*60))).padStart(2, '0');
                            this.seconds = String(Math.floor((distance % (1000*60)) / 1000)).padStart(2, '0');
                        }, 1000);
                    }
                 }"
            >
              <div><strong x-text="days">00</strong><span>HARI</span></div>
              <div><strong x-text="hours">00</strong><span>JAM</span></div>
              <div><strong x-text="minutes">00</strong><span>MENIT</span></div>
              <div><strong x-text="seconds">00</strong><span>DETIK</span></div>
            </div>
            
            <button 
              id="calendarBtn" 
              class="light-btn" 
              type="button"
              @click="
                const start = '{{ str_replace('-', '', $event['date_iso']) }}T010000Z';
                const end = '{{ str_replace('-', '', $event['date_iso']) }}T110000Z';
                const text = encodeURIComponent('Wedding {{ $couple['groom'] }} & {{ $couple['bride'] }}');
                const details = encodeURIComponent('Akad & Resepsi {{ $couple['groom'] }} dan {{ $couple['bride'] }}');
                const location = encodeURIComponent('{{ $event['address'] }}');
                window.open(`https://calendar.google.com/calendar/render?action=TEMPLATE&text=${text}&dates=${start}/${end}&details=${details}&location=${location}`,'_blank');
              "
            >
              Add to Calendar
            </button>
          </div>
        </section>

        <!-- 5. CALENDAR SECTION (Dynamic Calendar Month Grid) -->
        <section class="section calendar-section" id="calendar">
          <div class="title-combo"><span>Save</span> The Date</div>
          
          <div class="calendar-card reveal-up">
            <img src="{{ $assetBase }}/flower_pink_burgundy.png" class="calendar-flower-top" alt="" />
            <img src="{{ $assetBase }}/flower_burgundy_gold.png" class="calendar-flower-bottom" alt="" />
            
            <div class="calendar-year-badge">{{ $calendarYear }}</div>
            <h3 class="month-name">{{ $calendarMonth }}</h3>
            <div class="calendar-divider"></div>
            
            <div class="calendar-grid">
              <div class="head">Min</div><div class="head">Sen</div><div class="head">Sel</div><div class="head">Rab</div><div class="head">Kam</div><div class="head">Jum</div><div class="head">Sab</div>
              @for($i = 0; $i < $firstDayOfWeek; $i++)
                <div class="day-cell empty"></div>
              @endfor
              @for($day = 1; $day <= $daysInMonth; $day++)
                <div class="day-cell @if($day == $activeDay) active-day @endif">{{ $day }}</div>
              @endfor
            </div>
            
            <div class="calendar-note">
              <span class="heart-dot">♥</span> {{ $activeDay }} {{ $calendarMonth }} {{ $calendarYear }} — Hari Pernikahan
            </div>
          </div>
        </section>

        <!-- 6. EVENTS SECTION -->
        <section class="section events-section" id="events">
          <div class="title-combo"><span>Rangkaian Acara</span> Pernikahan</div>
          <img src="{{ $assetBase }}/flower_burgundy_gold.png" class="event-flower-top" alt="" />
          <img src="{{ $assetBase }}/flower_pink_burgundy.png" class="event-flower-bottom" alt="" />
          
          @foreach($schedule as $index => $sch)
            <div class="event-card @if($index % 2 == 0) arch @else shield @endif reveal-up">
              <div class="event-badge-icon">♥</div>
              <span class="event-script-sub">Save The Date</span>
              <h3 class="event-title">{{ $sch['title'] }}</h3>
              <div class="event-divider"></div>
              
              <div class="event-time-box">
                <div class="event-date-text">{{ \Carbon\Carbon::parse($event['date_iso'])->locale('id')->translatedFormat('l, d F Y') }}.</div>
                <div class="event-clock-text">{{ $sch['time'] }}</div>
              </div>
              
              <div class="event-place">{{ $sch['note'] }}</div>
              <div class="event-address">{{ $event['address'] }}</div>
              
              <a href="{{ $event['maps_url'] }}" target="_blank" class="maps-btn">
                <span>📍 BUKA GOOGLE MAPS</span>
              </a>
            </div>
          @endforeach
        </section>

        <!-- 7. TIMELINE SECTION -->
        <section class="section timeline-section" id="timeline">
          <div class="title-combo"><span>Wedding</span> Timeline</div>
          
          <div class="timeline-card reveal-up">
            <!-- <img src="{{ $assetBase }}/flower-left.png" class="timeline-flower-left" alt="" />
            <img src="{{ $assetBase }}/flower-right.png" class="timeline-flower-right" alt="" />
            <img src="{{ $assetBase }}/butterflies.png" class="timeline-butterfly" alt="" /> -->

            <!-- <div class="curtain-set" aria-hidden="true">
              <div class="curtain-side left"></div>
              <div class="curtain-top"></div>
              <div class="curtain-side right"></div>
            </div> -->

            <div class="timeline-list">
              <div class="timeline-row"><span>08.00 WIB</span><p>Akad Nikah</p></div>
              <div class="timeline-row"><span>09.30 WIB</span><p>Sesi Foto Bersama Keluarga</p></div>
              <div class="timeline-row"><span>16.00 WIB</span><p>Resepsi Pembukaan</p></div>
              <div class="timeline-row"><span>16.30 WIB</span><p>Sesi Ramah Tamah &amp; Hiburan</p></div>
              <div class="timeline-row"><span>19.00 WIB</span><p>Penutupan Acara</p></div>
            </div>
          </div>
        </section>

        <!-- 8. DRESSCODE SECTION REMOVED -->

        <!-- 9. RSVP & WISHES SECTION (Interactive Guestbook via AlpineJS) -->
        <div x-data="rsvpComponent(@js($wishes))">
          <!-- RSVP Section -->
          <section class="section rsvp-section" id="rsvp">
            <div class="section-title-script">Konfirmasi Kehadiran Anda</div>
            <p class="section-note">Mohon berkenan mengonfirmasi kehadiran Anda sebagai bagian dari kebahagiaan yang akan kami rayakan bersama.</p>

            <form class="maroon-form reveal-up" @submit.prevent="submitRSVP">
              <label>NAMA ANDA
                <input type="text" x-model="rsvpName" placeholder="Tulis nama Anda" required />
              </label>
              <label>JUMLAH TAMU
                <input type="number" x-model="rsvpCount" min="1" placeholder="1" required />
              </label>
              <label>APAKAH ANDA AKAN HADIR?</label>
              <label class="option-box">
                <input type="radio" value="Ya, saya akan hadir" x-model="rsvpAttend" /> Ya, saya akan hadir
              </label>
              <label class="option-box">
                <input type="radio" value="Maaf, tidak bisa hadir" x-model="rsvpAttend" /> Maaf, tidak bisa hadir
              </label>
              <button class="form-btn" type="submit" :disabled="submittingRsvp">
                <span x-text="submittingRsvp ? 'MENGIRIM...' : 'KONFIRMASI KEHADIRAN'"></span>
              </button>
            </form>
          </section>

          <!-- Wishes / Guestbook Section -->
          <section class="section wishes-section" id="wishes">
            <div class="section-title-script">Ucapan &amp; Doa</div>
            <p class="section-note">Setiap doa, harapan, dan ucapan yang Anda titipkan akan menjadi kenangan berharga dalam perjalanan kami bersama.</p>

            <form class="maroon-form reveal-up" @submit.prevent="submitWish">
              <label>NAMA ANDA
                <input type="text" x-model="name" placeholder="Tulis nama Anda" required />
              </label>
              <label>TULIS UCAPAN / DOA ANDA...
                <textarea rows="4" x-model="message" placeholder="Tuliskan ucapan / doa di sini..." required></textarea>
              </label>
              <button class="form-btn" type="submit" :disabled="submittingWish">
                <span x-text="submittingWish ? 'MENGIRIM...' : 'KIRIM UCAPAN'"></span>
              </button>
              
              <div class="latest-title">♥ UCAPAN TERBARU ♥</div>
              <div class="latest-box" style="display: flex; flex-direction: column; gap: 10px; max-height: 250px; overflow-y: auto;">
                <template x-for="(wish, index) in wishes" :key="index">
                  <div style="background: rgba(255,255,255,0.08); padding: 12px 14px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); text-align: left; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                    <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 12px; color: #d4af7a; margin-bottom: 6px; font-family: 'Montserrat', sans-serif;">
                      <span x-text="wish.name"></span>
                      <span style="font-size: 9px; opacity: 0.9; font-weight: normal; background: rgba(212, 175, 122, 0.2); color: #fff; padding: 2px 8px; border-radius: 12px; border: 1px solid rgba(212, 175, 122, 0.4);" x-text="wish.status"></span>
                    </div>
                    <p style="margin: 0; font-size: 14px; line-height: 1.5; color: #eed5dc; font-style: italic; font-family: 'Cormorant Garamond', Georgia, serif;" x-text="'“' + wish.message + '”'"></p>
                  </div>
                </template>
              </div>
            </form>
          </section>
        </div>

        <!-- 10. GALLERY SECTION -->
        <section class="section gallery-section" id="gallery">
          <div class="title-combo"><span>Our</span> Moment</div>
          <div class="gallery-label" style="margin-top: 10px;">Galeri</div>
          <div class="event-divider" style="margin: 0 auto 20px;"></div>

          <div class="gallery-card reveal-up">
            <div class="gallery-grid">
              @for($index = 1; $index <= 7; $index++)
                <div
                  class="gallery-photo"
                  role="button"
                  tabindex="0"
                  aria-label="Preview foto galeri {{ $index }}"
                  @click="openPreview({{ $index - 1 }})"
                  @keydown.enter.prevent="openPreview({{ $index - 1 }})"
                >
                  <img src="{{ $assetBase }}/g-{{ $index }}.jpeg" alt="Gallery {{ $index }}" />
                </div>
              @endfor
            </div>
          </div>
        </section>

        <!-- 11. GIFT SECTION -->
        <section class="section gift-section" id="gift">
          <div class="section-title-script">Gift</div>
          <p class="section-note gift-note">For those of you who want to give a token of love to the bride and groom, you can use the account number below.</p>

          <div class="gift-card-wrap reveal-up">
            <div class="gift-tabs">
              <span class="active">TRANSFER BANK</span>
              <!-- <span>KIRIM KADO</span> -->
            </div>

            <div class="bank-card">
              <div class="bank-top"><strong>BCA</strong><span>💳</span></div>
              <div class="bank-label">NOMOR REKENING</div>
              <div class="bank-number">0882523550</div>
              <div class="bank-owner">a.n. Icha Alifia Y. P.</div>
              <button class="copy-btn" data-copy="0882523550" type="button" onclick="salinNorek(this, '0882523550')">SALIN</button>
            </div>

            <div class="bank-card">
              <div class="bank-top"><strong>SHOPEEPAY</strong><span>💳</span></div>
              <div class="bank-label">NOMOR</div>
              <div class="bank-number">085856833060</div>
              <div class="bank-owner">a.n. Icha Alifia Y. P.</div>
              <button class="copy-btn" data-copy="085856833060" type="button" onclick="salinNorek(this, '085856833060')">SALIN</button>
            </div>

            <!-- <div class="gift-footer">♥ KIRIM KADO FISIK? KONFIRMASI KE NOMOR YANG TERSEDIA ♥</div> -->
          </div>
        </section>

        <!-- 12. CLOSING SECTION -->
        <section class="section closing-section" id="closing">
          <div class="closing-topline"></div>
          
          <div class="closing-card reveal-up">
            <div class="closing-title">See You</div>
            <div class="event-divider" style="margin: 14px auto 18px;"></div>
            <p class="closing-copy">MERUPAKAN SUATU KEHORMATAN DAN KEBAHAGIAAN BAGI KAMI APABILA BAPAK/IBU/SAUDARA/I BERKENAN HADIR UNTUK MEMBERIKAN DOA RESTU KEPADA KAMI.</p>
            <div class="closing-thanks">Thank You</div>
            <div class="closing-monogram">
              <span>♥</span>
            </div>
            <div class="closing-date">{{ \Carbon\Carbon::parse($event['date_iso'])->locale('id')->translatedFormat('l, d F Y') }}</div>
            <div class="closing-names">Icha &amp; Surya</div>
          </div>

          <img src="{{ $assetBase }}/flower_lily.png" class="closing-flower" alt="" />
          <img src="{{ $assetBase }}/carriage.png" class="closing-carriage" alt="" />
          <footer class="closing-footer">POWERED BY TEMURUANG • ◎ • 🌐</footer>
        </section>
      </div>

      <!-- Interactive Happy Vibes Floating Gold Sparkles & Petals Animation -->
      <div class="happy-vibes-particles" x-show="isOpen" aria-hidden="true">
        <span class="vibes-item v1">✨</span>
        <span class="vibes-item v2">🌸</span>
        <span class="vibes-item v3">✨</span>
        <span class="vibes-item v4">🦋</span>
        <span class="vibes-item v5">💖</span>
        <span class="vibes-item v6">✨</span>
        <span class="vibes-item v7">🌸</span>
        <span class="vibes-item v8">✨</span>
      </div>

      <!-- Floating UI Action bar -->
      <div class="floating-ui" id="floatingUi" :class="isOpen ? 'is-visible' : ''" aria-hidden="true">
        <a href="#top" class="fab fab-left" title="Home" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">◎</a>
        <a href="#gift" class="fab fab-qr" title="Gift" onclick="document.getElementById('gift').scrollIntoView({behavior: 'smooth'}); return false;">QR</a>
        <button class="fab fab-right" id="navToggle" type="button" aria-label="Buka menu">☰</button>
      </div>

      <!-- Quick Nav dropdown -->
      <nav class="quick-nav" id="quickNav">
        <a href="#top" onclick="document.getElementById('top').scrollIntoView({behavior: 'smooth'}); return false;">Home</a>
        <a href="#couple" onclick="document.getElementById('couple').scrollIntoView({behavior: 'smooth'}); return false;">Couple</a>
        <a href="#story" onclick="document.getElementById('story').scrollIntoView({behavior: 'smooth'}); return false;">Story</a>
        <a href="#events" onclick="document.getElementById('events').scrollIntoView({behavior: 'smooth'}); return false;">Event</a>
        <a href="#gallery" onclick="document.getElementById('gallery').scrollIntoView({behavior: 'smooth'}); return false;">Gallery</a>
        <a href="#gift" onclick="document.getElementById('gift').scrollIntoView({behavior: 'smooth'}); return false;">Gift</a>
        <a href="#closing" onclick="document.getElementById('closing').scrollIntoView({behavior: 'smooth'}); return false;">Closing</a>
      </nav>
    </div>
  </div>

  <script>
    const navToggle = document.getElementById('navToggle');
    const quickNav = document.getElementById('quickNav');

    navToggle?.addEventListener('click', () => {
      quickNav.classList.toggle('show');
    });

    document.querySelectorAll('.quick-nav a').forEach(link => {
      link.addEventListener('click', () => quickNav.classList.remove('show'));
    });

    document.addEventListener('click', (e) => {
      if (quickNav && !quickNav.contains(e.target) && e.target !== navToggle) {
        quickNav.classList.remove('show');
      }
    });

    function salinNorek(btn, norek) {
      if (navigator.clipboard) {
        navigator.clipboard.writeText(norek).then(() => {
          const old = btn.textContent;
          btn.textContent = 'TERSALIN';
          setTimeout(() => btn.textContent = old, 1500);
        }).catch(err => {
          alert('Nomor Rekening: ' + norek);
        });
      } else {
        alert('Nomor Rekening: ' + norek);
      }
    }
  </script>
    <!-- Bottom Scripts -->
    <script>
      document.addEventListener('alpine:init', () => {
        const rsvpUrl = @json(isset($invitation) ? route('invitation.rsvp.store', ['invitation' => $invitation->slug]) : null);
        const guestBookUrl = @json(isset($invitation) ? route('invitation.guest-book.store', ['invitation' => $invitation->slug]) : null);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        Alpine.data('rsvpComponent', (initialWishes) => ({
          wishes: initialWishes || [],
          name: '',
          message: '',
          rsvpName: '',
          rsvpCount: 1,
          rsvpAttend: 'Ya, saya akan hadir',
          submittingRsvp: false,
          submittingWish: false,
          async sendRequest(url, payload) {
            if (!url) {
              throw new Error('Form hanya dapat digunakan dari halaman undangan yang sudah dibuat.');
            }

            const response = await fetch(url, {
              method: 'POST',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
              },
              body: JSON.stringify(payload)
            });
            const result = await response.json().catch(() => ({}));

            if (!response.ok) {
              const validationMessage = result.errors
                ? Object.values(result.errors).flat()[0]
                : null;
              throw new Error(validationMessage || result.message || 'Data gagal dikirim. Silakan coba lagi.');
            }

            return result;
          },
          async submitRSVP() {
            if (!this.rsvpName) return;
            this.submittingRsvp = true;

            try {
              await this.sendRequest(rsvpUrl, {
                guest_name: this.rsvpName,
                guest_count: Number(this.rsvpCount),
                attendance_status: this.rsvpAttend === 'Ya, saya akan hadir' ? 'Hadir' : 'Tidak Hadir'
              });
              alert('Konfirmasi kehadiran berhasil dikirim untuk ' + this.rsvpName);
              this.rsvpName = '';
              this.rsvpCount = 1;
            } catch (error) {
              alert(error.message);
            } finally {
              this.submittingRsvp = false;
            }
          },
          async submitWish() {
            if (!this.name || !this.message) return;
            this.submittingWish = true;

            try {
              const result = await this.sendRequest(guestBookUrl, {
                guest_name: this.name,
                message: this.message
              });
              this.wishes.unshift(result.wish);
              this.name = '';
              this.message = '';
              alert('Terima kasih atas ucapan dan doa Anda!');
            } catch (error) {
              alert(error.message);
            } finally {
              this.submittingWish = false;
            }
          }
        }));
      });

      window.animateWithGsap = function() {
        if (!window.gsap) return;
        
        const stage = document.getElementById('home');
        const pieces = [...stage.querySelectorAll('.piece')];
        const stageRect = stage.getBoundingClientRect();
        const startX = stageRect.width / 2;
        const startY = stageRect.height + 120;

        function randomBetween(min, max) {
          return Math.random() * (max - min) + min;
        }

        // Set initial position at the bottom center and scale down
        pieces.forEach((el) => {
          const rect = el.getBoundingClientRect();
          const localCenterX = rect.left - stageRect.left + rect.width / 2;
          const localCenterY = rect.top - stageRect.top + rect.height / 2;

          gsap.set(el, {
            x: startX - localCenterX + randomBetween(-18, 18),
            y: startY - localCenterY + randomBetween(0, 80),
            scale: randomBetween(0.58, 0.74),
            opacity: 0,
            rotate: randomBetween(-13, 13),
            transformOrigin: 'center center'
          });
        });

        // Entrance timeline
        const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

        tl.to('#home .envelope', {
          x: 0,
          y: 0,
          opacity: 1,
          scale: 1,
          rotate: 0,
          duration: 1.05,
          ease: 'back.out(1.4)'
        })
        .to(['#home .flower-left', '#home .flower-right'], {
          x: 0,
          y: 0,
          opacity: 1,
          scale: 1,
          rotate: 0,
          duration: 1.2,
          stagger: 0.15,
          ease: 'back.out(1.65)'
        }, '-=0.58')
        .to(['#home .portrait-wrap', '#home .name-card'], {
          x: 0,
          y: 0,
          opacity: 1,
          scale: 1,
          rotate: 0,
          duration: 1.05,
          stagger: 0.13,
          ease: 'back.out(1.4)'
        }, '-=0.55')
        .to(['#home .date-card', '#home .hydrangea', '#home .butterfly'], {
          x: 0,
          y: 0,
          opacity: 1,
          scale: 1,
          rotate: 0,
          duration: 1.05,
          stagger: 0.11,
          ease: 'back.out(1.55)'
        }, '-=0.45')
        .add(window.startFloatingAnimations, '>-0.1');
      };

      window.startFloatingAnimations = function() {
        if (!window.gsap) return;
        
        gsap.to('#home .float-slow', { y: '-=8', duration: 4.2, repeat: -1, yoyo: true, ease: 'sine.inOut' });
        gsap.to('#home .float-medium', { y: '-=11', x: '+=2', duration: 3.2, repeat: -1, yoyo: true, ease: 'sine.inOut' });
        gsap.to('#home .float-soft', { y: '+=7', rotate: '+=1.2', duration: 3.7, repeat: -1, yoyo: true, ease: 'sine.inOut' });
        gsap.to('#home .float-card', { y: '-=5', duration: 4.6, repeat: -1, yoyo: true, ease: 'sine.inOut' });
        gsap.to('#home .float-butterfly', { x: '-=13', y: '+=9', rotate: '-=7', duration: 2.7, repeat: -1, yoyo: true, ease: 'sine.inOut' });
      };
    </script>
  </div>

  <div
    x-cloak
    x-show="previewIndex !== null"
    x-transition.opacity
    class="gallery-preview"
    role="dialog"
    aria-modal="true"
    aria-label="Preview foto galeri"
    @click.self="closePreview()"
  >
    <button type="button" class="gallery-preview-close" aria-label="Tutup preview" @click="closePreview()">×</button>
    <button type="button" class="gallery-preview-nav gallery-preview-prev" aria-label="Foto sebelumnya" @click="movePreview(-1)">‹</button>
    <img
      class="gallery-preview-image"
      :src="previewIndex !== null ? galleryImages[previewIndex] : ''"
      :alt="previewIndex !== null ? `Gallery ${previewIndex + 1}` : 'Gallery preview'"
    />
    <button type="button" class="gallery-preview-nav gallery-preview-next" aria-label="Foto berikutnya" @click="movePreview(1)">›</button>
  </div>
</body>
</html>
