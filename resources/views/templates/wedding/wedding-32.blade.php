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
            'text' => 'Seiring waktu, kami menyadari bahwa tujuan dari perjalanan ini bukan lagi sekadar bersama. Harapan yang dulu kami simpan dalam doa bertumbuh menjadi langkah yang siap kami jalani bersama—selamanya.'
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
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Virga');
        $brideName = trim($names[1] ?? 'Bersly');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Mr. Agus Hardianto & Mrs. Siti Laila',
                'bride' => 'Mr. Hadi Caprioff & Mrs. Laily Cupkek',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-09-21',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Masjid Agung',
            'address' => $invitation->address ?? 'Jalan Padi No.9, Sidoarjo – Jawa Timur',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Masjid Agung'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' WIB',
                'note' => $invitation->location ?? 'Masjid Agung'
            ],
            [
                'title' => 'Resepsi',
                'time' => '19:00 WIB',
                'note' => $invitation->address ?? 'Gedung Anggrek No. 3'
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
                ['name' => 'Keluarga Bpk. Budi', 'status' => 'Ya, saya akan hadir', 'message' => 'Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
                ['name' => 'Siti', 'status' => 'Maaf, tidak bisa hadir', 'message' => 'Maaf tidak bisa hadir, semoga lancar dan bahagia selalu.'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Icha',
            'bride' => 'Surya',
            'parents' => [
                'groom' => 'Mr. Agus Hardianto & Mrs. Siti Laila',
                'bride' => 'Mr. Hadi Caprioff & Mrs. Laily Cupkek',
            ],
        ];

        $event = [
            'date_iso' => '2026-09-21',
            'time' => '08:00',
            'location' => 'Masjid Agung',
            'address' => 'Jalan Padi No.9, Sidoarjo – Jawa Timur',
            'maps_url' => 'https://maps.google.com',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08.00 WIB', 'note' => 'Masjid Agung'],
            ['title' => 'Resepsi', 'time' => '19.00 WIB', 'note' => 'Gedung Anggrek No. 3'],
        ];

        $stories = $defaultStories;

        $gallery = [];

        $wishes = [
            ['name' => 'Keluarga Bpk. Budi', 'status' => 'Ya, saya akan hadir', 'message' => 'Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.'],
            ['name' => 'Siti', 'status' => 'Maaf, tidak bisa hadir', 'message' => 'Maaf tidak bisa hadir, semoga lancar dan bahagia selalu.'],
        ];

        $musicUrl = asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    }

    $assetBase = '/assets/templates/wedding-32';
    
    // Dynamic Calendar Calculation
    $eventDate = \Carbon\Carbon::parse($event['date_iso']);
    $calendarMonth = $eventDate->translatedFormat('F');
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <title>Undangan {{ $couple['groom'] }} & {{ $couple['bride'] }}</title>
  <meta name="description" content="Wedding invitation - {{ $couple['groom'] }} & {{ $couple['bride'] }}" />
  
  <!-- Premium Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Great+Vibes&family=Montserrat:wght@300;400;500&family=Playfair+Display:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  
  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
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
    
    /* =================== HERO SECTION =================== */
    .hero-section {
      padding: 0;
      min-height: 100svh;
      background: linear-gradient(180deg, #f7e8ec 0%, #f3dce3 100%);
    }
    
    .hero-section:before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at 16% 14%, rgba(255,255,255,.65), transparent 26%), radial-gradient(circle at 78% 32%, rgba(255,255,255,.48), transparent 24%);
    }
    
    .satin-left { left: -48px; top: 122px; width: 37%; opacity: .90; z-index: 2; filter: drop-shadow(0 12px 18px rgba(80,30,40,.08)); }
    .satin-right { right: -32px; top: 184px; width: 32%; opacity: .90; z-index: 2; filter: drop-shadow(0 12px 18px rgba(80,30,40,.08)); }
    
    .hero-envelope {
      left: 50%;
      top: 24px;
      transform: translateX(-50%);
      width: 81%;
      z-index: 3;
      filter: drop-shadow(0 18px 24px rgba(79,20,31,.18));
    }
    
    /* Dynamic Arched Name Card */
    .hero-card-container {
      position: absolute;
      left: 50%;
      top: 170px;
      transform: translateX(-50%);
      width: 55%;
      z-index: 5;
      filter: drop-shadow(0 16px 22px rgba(79, 20, 31, .18));
    }
    
    .hero-card-bg {
      width: 100%;
      display: block;
    }
    
    .hero-card-text {
      position: absolute;
      top: 14%;
      left: 10%;
      right: 10%;
      bottom: 12%;
      background: #faf3e8; /* Warm paper cream masking the original names */
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      border-radius: 80px 80px 0 0;
    }
    
    .card-wedding-of {
      font-size: 7px;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #9c6873;
      margin: 0 0 4px 0;
      font-family: 'Cormorant Garamond', Georgia, serif;
    }
    
    .card-groom-name, .card-bride-name {
      font-family: 'Great Vibes', cursive;
      font-size: 44px;
      line-height: 1.05;
      color: #6d0f21;
      font-weight: 600;
      text-shadow: 0 2px 4px rgba(111,22,39,0.15);
      margin: 4px 0;
    }
    
    .card-ampersand-char {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-style: italic;
      font-size: 22px;
      color: #d4af7a;
      font-weight: 700;
      margin: 2px 0;
    }
    
    .hero-date { left: 8px; top: 445px; width: 33%; z-index: 6; }
    .hero-monogram { right: 22px; top: 484px; width: 31%; z-index: 6; }
    
    .hero-monogram-badge {
      position: absolute;
      right: 20px;
      top: 470px;
      width: 76px;
      height: 76px;
      border-radius: 50%;
      background: linear-gradient(135deg, #7a1327, #440915);
      border: 2.5px solid #d4af7a;
      box-shadow: 0 8px 20px rgba(111, 22, 39, 0.35), inset 0 0 10px rgba(0,0,0,0.3);
      display: grid;
      place-items: center;
      z-index: 10;
      transform: rotate(-8deg);
    }
    .hero-monogram-badge span {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 26px;
      font-style: italic;
      color: #ffdce2;
      font-weight: 700;
      letter-spacing: 0.05em;
    }
    .hero-date-badge {
      position: absolute;
      left: 16px;
      top: 440px;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ffffff, #fdf6f8);
      border: 2px solid #d4af7a;
      box-shadow: 0 8px 20px rgba(111, 22, 39, 0.25);
      display: grid;
      place-items: center;
      z-index: 10;
      transform: rotate(8deg);
      text-align: center;
      line-height: 1.1;
    }
    .hero-date-badge span {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 24px;
      font-weight: 700;
      color: #7a1327;
    }
    .hero-date-badge small {
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #8f5462;
      display: block;
    }
    .hero-lily { left: 8px; top: 128px; width: 35%; z-index: 4; }
    .hero-floral-right { right: -4px; top: 132px; width: 36%; z-index: 5; }
    .hero-floral-pink { left: 18px; top: 310px; width: 28%; z-index: 4; }
    .hero-butterflies { right: 18px; top: 338px; width: 24%; z-index: 6; opacity: .92; }
    .hero-key { left: 44px; top: 403px; font-size: 40px; color: #7e1f30; opacity: .86; z-index: 7; transform: rotate(16deg); }
    .hero-carriage { left: 30px; bottom: 72px; width: 82%; opacity: .28; z-index: 1; }
    
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

    .story-text::first-letter {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 38px;
      font-weight: 700;
      color: #7a1327;
      float: left;
      line-height: 0.8;
      margin-right: 8px;
      margin-bottom: -2px;
      padding: 4px 6px;
      background: rgba(212, 175, 122, 0.18);
      border: 1px solid rgba(212, 175, 122, 0.5);
      border-radius: 4px;
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
      right: -20px;
      top: -20px;
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
    
    /* Creative Staggered & Tilted Layout */
    .timeline-row:nth-child(odd) {
      transform: rotate(-3deg) translateX(-8px);
      border-left: 5px solid #d4af7a;
    }
    .timeline-row:nth-child(even) {
      transform: rotate(3deg) translateX(8px);
      border-right: 5px solid #d4af7a;
    }
    
    .timeline-row:hover {
      background: #ffffff;
      transform: rotate(0deg) scale(1.04) !important;
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
      padding: 38px 20px 32px;
      background: rgba(255, 255, 255, 0.88);
      border: 1.5px solid rgba(212, 175, 122, 0.65);
      border-radius: 28px;
      box-shadow: 0 20px 45px rgba(111, 22, 39, 0.15);
      backdrop-filter: blur(10px);
    }
    
    .gallery-card:before {
      content: "";
      position: absolute;
      inset: 8px;
      border: 1px dashed rgba(180, 115, 128, 0.35);
      border-radius: 20px;
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
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      max-width: 320px;
      margin: 0 auto;
    }
    
    .gallery-photo {
      height: 160px;
      background: #fff;
      box-shadow: 0 8px 20px rgba(111,22,39,0.18);
      display: grid;
      place-items: center;
      color: #8e5664;
      border-radius: 12px;
      overflow: hidden;
      border: 4px solid #fff;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .gallery-photo:hover {
      transform: scale(1.04);
      box-shadow: 0 14px 30px rgba(111,22,39,0.28);
      z-index: 5;
    }
    
    .gallery-photo img { width: 100%; height: 100%; object-fit: cover; }
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
      font-style: italic;
      border: 3px solid #d4af7a;
      box-shadow: 0 10px 25px rgba(111,22,39,0.3);
    }
    
    .closing-date { position: relative; z-index: 2; margin-top: 14px; font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; letter-spacing: .08em; color: #8c4c5c; text-transform: uppercase; }
    
    .closing-names { position: relative; z-index: 2; font-family: 'Playfair Display', Georgia, serif; font-size: 34px; font-weight: 700; color: var(--maroon); margin: 16px 0 10px; }
    
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
      .gallery-grid { grid-template-columns: 1fr; max-width: 260px; }
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
<body x-data="{ isOpen: false, isMuted: false }">
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
          <p class="cover-note">We are so grateful that you are going to be with us</p>
          <button class="btn-primary" id="openBtn" type="button" 
            @click="
              isOpen = true;
              let audio = document.getElementById('bg-audio');
              if (audio) { audio.play().catch(e => console.log('Autoplay blocked')); }
              setTimeout(() => window.scrollTo({ top: 0, behavior: 'smooth' }), 250);
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
        <!-- 1. HERO SECTION -->
        <section class="section hero-section" id="home">
          <img src="{{ $assetBase }}/satin_left.png" class="asset satin-left" alt="" />
          <img src="{{ $assetBase }}/satin_right.png" class="asset satin-right" alt="" />
          <img src="{{ $assetBase }}/envelope_open.png" class="asset hero-envelope" alt="Open envelope" />
          
          <!-- Dynamic Arched Text Overlaid on Card Background -->
          <div class="hero-card-container">
            <img src="{{ $assetBase }}/card_names.png" class="hero-card-bg" alt="Card Background" />
            <div class="hero-card-text">
              <span class="card-wedding-of">The Wedding of</span>
              <span class="card-groom-name">{{ $couple['groom'] }}</span>
              <span class="card-ampersand-char">&amp;</span>
              <span class="card-bride-name">{{ $couple['bride'] }}</span>
            </div>
          </div>
          
          <div class="asset hero-date-badge">
            <span>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d') }}<small>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('M') }}</small></span>
          </div>
          <div class="asset hero-monogram-badge">
            <span>{{ substr($couple['groom'], 0, 1) }}&amp;{{ substr($couple['bride'], 0, 1) }}</span>
          </div>
          <img src="{{ $assetBase }}/flower_lily.png" class="asset hero-lily" alt="" />
          <img src="{{ $assetBase }}/flower_burgundy_gold.png" class="asset hero-floral-right" alt="" />
          <img src="{{ $assetBase }}/flower_pink_burgundy.png" class="asset hero-floral-pink" alt="" />
          <img src="{{ $assetBase }}/butterflies.png" class="asset hero-butterflies" alt="" />
          <div class="asset hero-key">⌘</div>
          <img src="{{ $assetBase }}/carriage.png" class="asset hero-carriage" alt="" />
        </section>

        <!-- 2. COUPLE SECTION -->
        <section class="section couple-section" id="couple">
          <div class="couple-headline">
            <span class="couple-headline-side left">The Groom</span>
            <div class="faded-vb">
              <span>{{ substr($couple['groom'], 0, 1) }}&amp;{{ substr($couple['bride'], 0, 1) }}</span>
            </div>
            <span class="couple-headline-side right">The Bride</span>
          </div>

          <div class="proclamation-box reveal-up">
            <div class="basmala">Assalamu'alaikum Wr. Wb.</div>
            <p class="couple-intro">Dengan segala kerendahan hati dan dengan ungkapan syukur atas limpahan rahmat Allah SWT, kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.</p>
          </div>

          <div class="couple-tablets-wrap">
            <!-- Groom Tablet -->
            <div class="couple-tablet groom reveal-up">
              <span class="person-role-tag">The Groom</span>
              <h2 class="tablet-name">{{ $couple['groom'] }}</h2>
              <p class="tablet-parents">The Son of<br /><strong>{{ $couple['parents']['groom'] }}</strong></p>
            </div>

            <!-- Ampersand Diamond -->
            <div class="ampersand-diamond-wrap reveal-up">
              <div class="ampersand-diamond">
                <span>&amp;</span>
              </div>
            </div>

            <!-- Bride Tablet -->
            <div class="couple-tablet bride reveal-up">
              <span class="person-role-tag">The Bride</span>
              <h2 class="tablet-name">{{ $couple['bride'] }}</h2>
              <p class="tablet-parents">The Daughter of<br /><strong>{{ $couple['parents']['bride'] }}</strong></p>
            </div>
          </div>

          <img src="{{ $assetBase }}/flower_pink_burgundy.png" class="couple-flower" alt="" />
          <img src="{{ $assetBase }}/butterflies.png" class="couple-happy-butterflies" alt="" />
          <img src="{{ $assetBase }}/carriage.png" class="couple-carriage" alt="" />
        </section>

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
            <div class="gratitude-signoff">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</div>
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
                const end = '{{ str_replace('-', '', $event['date_iso']) }}T040000Z';
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
          <div class="title-combo"><span>Rangkaian Acara</span> The Wedding</div>
          <img src="{{ $assetBase }}/flower_burgundy_gold.png" class="event-flower-top" alt="" />
          <img src="{{ $assetBase }}/flower_pink_burgundy.png" class="event-flower-bottom" alt="" />
          
          @foreach($schedule as $index => $sch)
            <div class="event-card @if($index % 2 == 0) arch @else shield @endif reveal-up">
              <div class="event-badge-icon">♥</div>
              <span class="event-script-sub">Save The Date</span>
              <h3 class="event-title">{{ $sch['title'] }}</h3>
              <div class="event-divider"></div>
              
              <div class="event-time-box">
                <div class="event-date-text">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</div>
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

            <div class="curtain-set" aria-hidden="true">
              <div class="curtain-side left"></div>
              <div class="curtain-top"></div>
              <div class="curtain-side right"></div>
            </div>

            <div class="timeline-list">
              <div class="timeline-row"><span>08.00 WIB</span><p>Akad Nikah Utama</p></div>
              <div class="timeline-row"><span>09.30 WIB</span><p>Sesi Foto Bersama Keluarga</p></div>
              <div class="timeline-row"><span>19.00 WIB</span><p>Resepsi Pembukaan</p></div>
              <div class="timeline-row"><span>19.30 WIB</span><p>Sesi Ramah Tamah & Hiburan</p></div>
              <div class="timeline-row"><span>21.00 WIB</span><p>Penutupan Acara</p></div>
            </div>
          </div>
        </section>

        <!-- 8. DRESSCODE SECTION -->
        <section class="section dresscode-section" id="dresscode">
          <div class="dresscode-card reveal-up">
            <!-- Corner edge florals (Di tepi-tepi) so they NEVER cover the text -->
            <!-- <img src="{{ $assetBase }}/bunga%20pojok%20kiri%20atas.png" class="dress-flower-left" alt="" /> -->
            <!-- <img src="{{ $assetBase }}/bunga%20pojok%20kanan%20atas.png" class="dress-flower-right" alt="" /> -->
            <div class="dress-title">Dresscode</div>
            <div class="event-divider" style="margin: 8px auto 14px;"></div>
            <p class="dress-caption">Kehadiran Anda adalah hadiah terindah bagi kami. Untuk menyempurnakan keindahan momen bahagia ini, kami mengharapkan kesediaan Bapak/Ibu/Saudara/i untuk mengenakan busana palet warna berikut.</p>
            
            <div class="attire-grid">
              <div class="attire-box">
                <div class="attire-icon-circle">
                  <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffdce2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 12l-4 -3v6l4 -3z" fill="#d4af7a" stroke="none" />
                    <path d="M12 12l4 -3v6l4 -3z" fill="#d4af7a" stroke="none" />
                    <circle cx="12" cy="12" r="1.5" fill="#fff" stroke="none" />
                  </svg>
                </div>
                <h4>Gentlemen</h4>
                <p>Formal Suit, Tuxedo, or Batik in Maroon / Charcoal palette</p>
              </div>
              <div class="attire-box">
                <div class="attire-icon-circle">
                  <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="#ffdce2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3a3 3 0 0 0 -3 3v2a3 3 0 0 0 6 0v-2a3 3 0 0 0 -3 -3z" />
                    <path d="M9 8h6l3 12h-12l3 -12z" fill="#d4af7a" fill-opacity="0.3" stroke="#d4af7a" />
                    <path d="M12 12v3" stroke="#fff" />
                  </svg>
                </div>
                <h4>Ladies</h4>
                <p>Evening Gown, Kebaya, or Formal Dress in Cream / Terracotta palette</p>
              </div>
            </div>

            <div class="swatch-row">
              <div class="swatch-item"><span class="swatch sw1"></span><span class="swatch-label">Maroon</span></div>
              <div class="swatch-item"><span class="swatch sw2"></span><span class="swatch-label">Charcoal</span></div>
              <div class="swatch-item"><span class="swatch sw3"></span><span class="swatch-label">Cream</span></div>
              <div class="swatch-item"><span class="swatch sw4"></span><span class="swatch-label">Terracotta</span></div>
            </div>
          </div>
        </section>

        <!-- 9. RSVP & WISHES SECTION (Interactive Guestbook via AlpineJS) -->
        <div x-data="{
          wishes: @json($wishes),
          name: '',
          attend: 'Ya, saya akan hadir',
          message: '',
          rsvpName: '',
          rsvpCount: 1,
          rsvpAttend: 'Ya, saya akan hadir',
          submitRSVP() {
            if (!this.rsvpName) return;
            alert('Konfirmasi kehadiran berhasil dikirim untuk ' + this.rsvpName);
            this.rsvpName = '';
          },
          submitWish() {
            if (!this.name || !this.message) return;
            this.wishes.unshift({
              name: this.name,
              status: this.attend,
              message: this.message
            });
            this.name = '';
            this.message = '';
            alert('Terima kasih atas ucapan dan doa Anda!');
          }
        }">
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
              <button class="form-btn" type="submit">KONFIRMASI KEHADIRAN</button>
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
              <label>KEHADIRAN
                <select x-model="attend" style="border: 1px solid rgba(255,255,255,0.3); border-radius: 10px; background: rgba(255,255,255,0.08); color: #fff; width: 100%; padding: 12px 14px; font-family: 'Cormorant Garamond', Georgia, serif; font-size: 16px; outline: none; margin-top: 6px;">
                  <option value="Ya, saya akan hadir">Ya, saya akan hadir</option>
                  <option value="Maaf, tidak bisa hadir">Maaf, tidak bisa hadir</option>
                </select>
              </label>
              <label>TULIS UCAPAN / DOA ANDA...
                <textarea rows="4" x-model="message" placeholder="Tuliskan ucapan / doa di sini..." required></textarea>
              </label>
              <button class="form-btn" type="submit">KIRIM UCAPAN</button>
              
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
            <div class="album-book">♥ ALBUM MOMEN ♥</div>
            <div class="gallery-grid">
              @if(!empty($gallery))
                @foreach($gallery as $index => $img)
                  <div class="gallery-photo">
                    <img src="{{ $img }}" alt="Gallery {{ $index + 1 }}" />
                  </div>
                @endforeach
              @else
                <div class="gallery-photo">Momen 1</div>
                <div class="gallery-photo">Momen 2</div>
                <div class="gallery-photo">Momen 3</div>
                <div class="gallery-photo">Momen 4</div>
              @endif
            </div>
            @if(empty($gallery))
              <p class="helper-text">Semua box foto ini tinggal kamu ganti dengan foto asli.</p>
            @endif
          </div>
        </section>

        <!-- 11. GIFT SECTION -->
        <section class="section gift-section" id="gift">
          <div class="section-title-script">Gift</div>
          <p class="section-note gift-note">For those of you who want to give a token of love to the bride and groom, you can use the account number below.</p>

          <div class="gift-card-wrap reveal-up">
            <div class="gift-tabs">
              <span class="active">TRANSFER BANK</span>
              <span>KIRIM KADO</span>
            </div>

            <div class="bank-card">
              <div class="bank-top"><strong>BNI</strong><span>💳</span></div>
              <div class="bank-label">NOMOR REKENING</div>
              <div class="bank-number">123456789</div>
              <div class="bank-owner">a.n. {{ $couple['groom'] }}</div>
              <button class="copy-btn" data-copy="123456789" type="button" onclick="salinNorek(this, '123456789')">SALIN</button>
            </div>

            <div class="bank-card">
              <div class="bank-top"><strong>MANDIRI</strong><span>💳</span></div>
              <div class="bank-label">NOMOR REKENING</div>
              <div class="bank-number">987654321</div>
              <div class="bank-owner">a.n. {{ $couple['bride'] }}</div>
              <button class="copy-btn" data-copy="987654321" type="button" onclick="salinNorek(this, '987654321')">SALIN</button>
            </div>

            <div class="gift-footer">♥ KIRIM KADO FISIK? KONFIRMASI KE NOMOR YANG TERSEDIA ♥</div>
          </div>
        </section>

        <!-- 12. CLOSING SECTION -->
        <section class="section closing-section" id="closing">
          <div class="closing-topline"></div>
          
          <div class="closing-card reveal-up">
            <div class="closing-title">See You</div>
            <div class="event-divider" style="margin: 14px auto 18px;"></div>
            <p class="closing-copy">MERUPAKAN SUATU KEHORMATAN DAN KEBAHAGIAAN BAGI KAMI APABILA BAPAK/IBU/SAUDARA/I BERKENAN HADIR UNTUK MEMBERIKAN DOA RESTU KEPADA KAMI.</p>
            <div class="closing-thanks">TERIMAKASIH</div>
            <div class="closing-monogram">
              <span>♥</span>
            </div>
            <div class="closing-date">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</div>
            <div class="closing-names">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</div>
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
</body>
</html>
