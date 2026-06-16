@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Malik');
        $brideName = trim($names[1] ?? 'Kiara');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Mr. Baskoro & Mrs. Sarah',
                'bride' => 'Mr. Wijaya & Mrs. Ratna',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-10-25',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'The Heritage Hotel, Jakarta',
            'address' => $invitation->address ?? 'Ballroom Lantai 2, Jl. Sudirman Kav 21, Jakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'The Heritage Hotel, Jakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'The Heritage Hotel, Jakarta'
            ],
            [
                'title' => 'Resepsi Pernikahan',
                'time' => '19:00 - 21:00 WIB',
                'note' => $invitation->address ?? 'Ballroom Utama'
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
                ['title' => 'The First Hello', 'date' => '2018', 'text' => 'Met at a local coffee shop where we both reached for the last croissant. A shared laugh started it all.'],
                ['title' => 'The Distance', 'date' => '2020', 'text' => 'Navigating life apart during the pandemic only made us realize we never wanted to be without each other.'],
                ['title' => 'The Promise', 'date' => '2023', 'text' => 'Under a starry sky in Bandung, Malik finally asked, and Kiara said "Always."'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
            // Fill remaining if less than 6
            $defaultGalleries = [
                asset('assets/templates/wedding-02/images/image_4.jpg'),
                asset('assets/templates/wedding-02/images/image_5.jpg'),
                asset('assets/templates/wedding-02/images/image_6.jpg'),
                asset('assets/templates/wedding-02/images/image_7.jpg'),
                asset('assets/templates/wedding-02/images/image_8.jpg'),
                asset('assets/templates/wedding-02/images/image_9.jpg'),
            ];
            for ($i = count($gallery); $i < 6; $i++) {
                $gallery[] = $defaultGalleries[$i - count($gallery)];
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-02/images/image_4.jpg'),
                asset('assets/templates/wedding-02/images/image_5.jpg'),
                asset('assets/templates/wedding-02/images/image_6.jpg'),
                asset('assets/templates/wedding-02/images/image_7.jpg'),
                asset('assets/templates/wedding-02/images/image_8.jpg'),
                asset('assets/templates/wedding-02/images/image_9.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-02/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-02/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-02/images/image_3.jpg'),
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
                ['name' => 'Sarah & Johan', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Malik & Kiara! Semoga cinta kalian abadi selamanya.'],
                ['name' => 'Uncle Robert', 'status' => 'Hadir', 'message' => 'So happy to witness this beautiful union. Wishing you a lifetime of joy and laughter.'],
                ['name' => 'Anya W.', 'status' => 'Hadir', 'message' => 'Cheers to the most aesthetic couple! Looking forward to celebrate with you guys.'],
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
                ['bank' => 'Bank Central Asia', 'name' => 'Malik Ibrahim', 'account' => '123-456-7890'],
                ['bank' => 'Bank Mandiri', 'name' => 'Kiara Adistya', 'account' => '987-654-3210'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Malik',
            'bride' => 'Kiara',
            'parents' => [
                'groom' => 'Mr. Baskoro & Mrs. Sarah',
                'bride' => 'Mr. Wijaya & Mrs. Ratna',
            ],
        ];

        $event = [
            'date_iso' => '2026-10-25',
            'time' => '08:00',
            'location' => 'The Heritage Hotel, Jakarta',
            'address' => 'Ballroom Lantai 2, Jl. Sudirman Kav 21, Jakarta',
            'maps_url' => 'https://maps.google.com/?q=The+Heritage+Hotel,+Jakarta',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00', 'note' => 'The Heritage Hotel, Jakarta'],
            ['title' => 'Resepsi Pernikahan', 'time' => '19:00 - 21:00', 'note' => 'Ballroom Utama'],
        ];

        $stories = [
            ['title' => 'The First Hello', 'date' => '2018', 'text' => 'Met at a local coffee shop where we both reached for the last croissant. A shared laugh started it all.'],
            ['title' => 'The Distance', 'date' => '2020', 'text' => 'Navigating life apart during the pandemic only made us realize we never wanted to be without each other.'],
            ['title' => 'The Promise', 'date' => '2023', 'text' => 'Under a starry sky in Bandung, Malik finally asked, and Kiara said "Always."'],
        ];

        $gallery = [
            asset('assets/templates/wedding-02/images/image_4.jpg'),
            asset('assets/templates/wedding-02/images/image_5.jpg'),
            asset('assets/templates/wedding-02/images/image_6.jpg'),
            asset('assets/templates/wedding-02/images/image_7.jpg'),
            asset('assets/templates/wedding-02/images/image_8.jpg'),
            asset('assets/templates/wedding-02/images/image_9.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-02/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-02/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-02/images/image_3.jpg'),
        ];

        $wishes = [
            ['name' => 'Sarah & Johan', 'status' => 'Hadir', 'message' => 'Selamat menempuh hidup baru Malik & Kiara! Semoga cinta kalian abadi selamanya.'],
            ['name' => 'Uncle Robert', 'status' => 'Hadir', 'message' => 'So happy to witness this beautiful union. Wishing you a lifetime of joy and laughter.'],
            ['name' => 'Anya W.', 'status' => 'Hadir', 'message' => 'Cheers to the most aesthetic couple! Looking forward to celebrate with you guys.'],
        ];

        $gifts = [
            ['bank' => 'Bank Central Asia', 'name' => 'Malik Ibrahim', 'account' => '123-456-7890'],
            ['bank' => 'Bank Mandiri', 'name' => 'Kiara Adistya', 'account' => '987-654-3210'],
        ];

        $musicUrl = asset('musics/love-story-taylor-swift-sax-cover-by-leon-chen-rdlfx2fnhok.mp3');
    }
@endphp
<!DOCTYPE html>
<html class="light scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>The Wedding of {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</title>
    
    <!-- External CSS / CDNs -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,700&amp;family=Special+Elite&amp;family=Work+Sans:wght@400;600&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>

    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#061b0e", // Deep Forest Green
                    "primary-container": "#1b3022",
                    "secondary": "#7e5709", // Vintage Gold
                    "surface": "#fff8f3",
                    "background": "#061b0e",
                    "on-background": "#fbecd8",
                    "deep-rose": "#8B2635",
                    "aged-ivory": "#FAF6F0",
                    "ink-charcoal": "#2B1B17"
            },
            "fontFamily": {
                    "headline-md": ["Playfair Display"],
                    "body-md": ["Special Elite"],
                    "display-lg": ["Playfair Display"],
                    "label-caps": ["Work Sans"]
            }
          }
        }
      }
    </script>
    <style>
        body {
            background-color: #061b0e;
        }

        body.cover-active {
            overflow: hidden;
            height: 100vh;
        }

        /* Film Grain Shader Simulation */
        .grain-overlay {
            position: fixed;
            top: 0; left: 50%; width: 100%; height: 100%;
            max-width: 480px;
            transform: translateX(-50%);
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.05;
            pointer-events: none;
            z-index: 9999;
        }

        .vignette {
            position: fixed;
            top: 0; left: 50%; width: 100%; height: 100%;
            max-width: 480px;
            transform: translateX(-50%);
            box-shadow: inset 0 0 150px rgba(0,0,0,0.8);
            pointer-events: none;
            z-index: 9998;
        }

        /* Envelope Animation */
        #envelope-container {
            position: fixed;
            inset-y: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #061b0e;
            transition: transform 1s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease;
        }

        .envelope {
            position: relative;
            width: 280px;
            height: 180px;
            background: #8B2635; /* Deep Rose Wax color */
            cursor: pointer;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
            perspective: 800px;
        }

        .envelope::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-left: 140px solid transparent;
            border-right: 140px solid transparent;
            border-top: 90px solid #721d2a;
            transition: transform 0.5s ease;
            transform-origin: top;
            z-index: 2;
        }

        .envelope.open::before {
            transform: rotateX(180deg);
        }

        .wax-seal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: #D4AF37;
            border-radius: 50%;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display';
            font-weight: bold;
            color: #310900;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.2s ease;
        }
        .wax-seal:hover {
            transform: translate(-50%, -50%) scale(1.08);
        }

        /* Gold Emboss Text */
        .gold-emboss {
            color: #D4AF37;
            text-shadow: 1px 1px 0px #996515, 2px 2px 0px #996515, 3px 3px 5px rgba(0,0,0,0.4);
            background: linear-gradient(to bottom, #fceabb 0%, #fccd4d 50%, #f8b500 51%, #fbdf93 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Film Strip */
        .film-strip {
            border: 15px solid #1a1a1a;
            position: relative;
            background: #1a1a1a;
        }
        .film-strip::before, .film-strip::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 15px;
            left: 0;
            background-image: radial-gradient(circle, #fff 40%, transparent 45%);
            background-size: 25px 15px;
            background-repeat: repeat-x;
        }
        .film-strip::before { top: -20px; }
        .film-strip::after { bottom: -20px; }

        .scrapbook-photo {
            padding: 10px;
            background: white;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.3);
            position: relative;
        }
        .photo-corner {
            position: absolute;
            width: 30px;
            height: 30px;
            background: rgba(0,0,0,0.2);
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }

        .torn-edge {
            clip-path: polygon(0% 2%, 5% 0%, 10% 3%, 15% 1%, 20% 4%, 25% 2%, 30% 5%, 35% 2%, 40% 4%, 45% 1%, 50% 3%, 55% 0%, 60% 4%, 65% 2%, 70% 5%, 75% 2%, 80% 4%, 85% 1%, 90% 3%, 95% 0%, 100% 2%, 100% 98%, 95% 100%, 90% 97%, 85% 99%, 80% 96%, 75% 98%, 70% 95%, 65% 98%, 60% 96%, 55% 100%, 50% 97%, 45% 99%, 40% 96%, 35% 98%, 30% 95%, 25% 98%, 20% 96%, 15% 100%, 10% 97%, 5% 99%, 0% 98%);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .floating { animation: float 4s ease-in-out infinite; }

        #wishList::-webkit-scrollbar {
            width: 4px;
        }
        #wishList::-webkit-scrollbar-track {
            background: transparent;
        }
        #wishList::-webkit-scrollbar-thumb {
            background: #7e5709;
            border-radius: 4px;
        }
    </style>
</head>
<body class="selection:bg-deep-rose selection:text-white font-body-md text-on-background overflow-x-hidden cover-active">
    
    <div class="grain-overlay"></div>
    <div class="vignette"></div>

    <!-- Centered Containment Column -->
    <div class="max-w-[480px] w-full mx-auto relative shadow-2xl bg-[#061b0e] min-h-screen flex flex-col border-x border-secondary/20">

        <!-- Envelope Overlay -->
        <div id="envelope-container" onclick="openInvitation()">
            <div class="flex flex-col items-center max-w-[280px] w-full text-center">
                <div class="envelope mb-8" id="envelope">
                    <div class="wax-seal">{{ substr($couple['groom'], 0, 1) }}&amp;{{ substr($couple['bride'], 0, 1) }}</div>
                </div>
                
                <div class="bg-aged-ivory/5 backdrop-blur-md border border-secondary/35 p-5 rounded-lg mb-8 w-full text-aged-ivory shadow-lg">
                    <span class="text-[9px] font-label-caps uppercase tracking-[0.25em] text-secondary">Kepada Yth. Bapak/Ibu/Saudara/i:</span>
                    <h3 class="font-headline-md text-xl text-aged-ivory mt-2 tracking-wide font-bold">{{ request()->get('kpd', 'Tamu Undangan') }}</h3>
                    <p class="text-[9px] font-body-md text-aged-ivory/50 mt-1 italic">Di Tempat</p>
                </div>

                <p class="text-aged-ivory font-body-md animate-pulse uppercase tracking-[0.25em] text-xs">Klik Lilin Segel Untuk Membuka</p>
            </div>
        </div>

        <!-- Background Music -->
        <audio id="bgMusic" loop>
            <source src="{{ $musicUrl }}" type="audio/mpeg"/>
        </audio>

        <!-- Bottom Nav Pill -->
        <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-ink-charcoal/80 backdrop-blur-md border border-secondary/35 px-6 py-3 rounded-full z-[100] flex gap-5 text-aged-ivory shadow-2xl transition-transform translate-y-24" id="bottomNav">
            <a class="material-symbols-outlined hover:text-secondary transition-colors" href="#cover" title="Cover">home</a>
            <a class="material-symbols-outlined hover:text-secondary transition-colors" href="#mempelai" title="Mempelai">person</a>
            <a class="material-symbols-outlined hover:text-secondary transition-colors" href="#acara" title="Acara">event</a>
            <a class="material-symbols-outlined hover:text-secondary transition-colors" href="#kisah" title="Kisah">history_edu</a>
            <a class="material-symbols-outlined hover:text-secondary transition-colors" href="#gallery" title="Gallery">photo_library</a>
            <button class="material-symbols-outlined hover:text-secondary transition-colors" id="scrollBtn" onclick="toggleAutoscroll()" title="Auto Scroll">keyboard_double_arrow_down</button>
            <button class="material-symbols-outlined hover:text-secondary transition-colors" id="musicBtn" onclick="toggleMusic()" title="Musik">music_note</button>
        </nav>

        <!-- Main Content -->
        <main class="hidden opacity-0 transition-opacity duration-1000 flex-1 flex flex-col" id="main-content">
            
            <!-- COVER SECTION -->
            <section class="min-h-screen flex flex-col items-center justify-center relative px-6 bg-[url('https://www.transparenttextures.com/patterns/dark-leather.png')]" id="cover">
                <div class="absolute inset-0 bg-primary/40"></div>
                <div class="relative z-10 text-center w-full">
                    <p class="font-label-caps text-secondary tracking-[0.2em] uppercase text-xs mb-4">The Wedding Invitation of</p>
                    <h1 class="font-headline-md text-5xl gold-emboss mb-12 font-bold">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h1>
                    <div class="floating max-w-[280px] mx-auto mb-8 transform -rotate-3">
                        <div class="film-strip shadow-2xl">
                            <img alt="Prewedding Cover" class="sepia grayscale contrast-125 w-full aspect-[3/4] object-cover" src="{{ $bg['cover'] }}"/>
                        </div>
                    </div>
                </div>
            </section>

            <!-- HERO / QUOTE SECTION -->
            <section class="py-20 px-8 text-center bg-primary-container relative overflow-hidden flex flex-col items-center justify-center">
                <div class="max-w-xs relative z-10">
                    <span class="material-symbols-outlined text-secondary text-5xl mb-4">format_quote</span>
                    <p class="font-headline-md text-xl text-aged-ivory italic leading-relaxed">
                        "I would rather share one lifetime with you than face all the ages of this world alone."
                    </p>
                    <p class="mt-6 font-label-caps text-secondary text-xs tracking-wider">— J.R.R. Tolkien</p>
                </div>
                <!-- Decorative stamp -->
                <div class="absolute -bottom-10 -left-10 w-32 h-32 opacity-20 rotate-12 pointer-events-none">
                    <img class="w-full grayscale" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAtDB5vcay7qFHKQSCTTk8Slg7CTW_YD01zQBzoM8MoGwu0mY3BQ_MAROHMAUTnI4aIp1r1Q_RxN5XPYyWTa9BkadN1PAsWllXqRFNTP8YrJBRY_kY1xZgnvEsZX0RUJ5FphTD5thAyRY5oHwSPCwtbbTu4CFGIukcYlE0kpJkuaQsrSS2nWtjKkz9G2JATpY0hdc1YkgZf-rXUF7j2cFuQnxvQk04xcQJS-csH7q51CmE7dPFuYHZ6VXcmVXgv4zKsDCCA6f01uJA" alt="stamp"/>
                </div>
            </section>

            <!-- MEMPELAI (PROFILE) -->
            <section class="py-24 px-6 bg-primary" id="mempelai">
                <h2 class="font-headline-md text-4xl text-center gold-emboss mb-16 font-bold">The Happy Couple</h2>
                <div class="max-w-xs mx-auto space-y-16">
                    <!-- Groom -->
                    <div class="flex flex-col items-center text-center">
                        <div class="scrapbook-photo transform rotate-3 mb-6 w-56 h-72">
                            <div class="photo-corner top-0 left-0"></div>
                            <img class="w-full h-full object-cover grayscale brightness-90" src="{{ $bg['groom'] }}" alt="Groom"/>
                            <p class="font-body-md text-ink-charcoal text-base mt-3 font-semibold">{{ $couple['groom'] }}</p>
                        </div>
                        <div class="text-aged-ivory">
                            <p class="font-body-md text-xs opacity-75">Putra dari {{ $couple['parents']['groom'] }}</p>
                            <a class="inline-flex items-center gap-1.5 text-secondary mt-3 hover:underline text-xs" href="#">
                                <span class="material-symbols-outlined text-xs">alternate_email</span>{{ strtolower($couple['groom']) }}_wedding
                            </a>
                        </div>
                    </div>

                    <!-- Ampersand Divider -->
                    <div class="text-center font-headline-md text-5xl text-secondary opacity-60 font-bold">&amp;</div>

                    <!-- Bride -->
                    <div class="flex flex-col items-center text-center">
                        <div class="scrapbook-photo transform -rotate-2 mb-6 w-56 h-72">
                            <div class="photo-corner top-0 right-0 rotate-90"></div>
                            <img class="w-full h-full object-cover grayscale brightness-90" src="{{ $bg['bride'] }}" alt="Bride"/>
                            <p class="font-body-md text-ink-charcoal text-base mt-3 font-semibold">{{ $couple['bride'] }}</p>
                        </div>
                        <div class="text-aged-ivory">
                            <p class="font-body-md text-xs opacity-75">Putri dari {{ $couple['parents']['bride'] }}</p>
                            <a class="inline-flex items-center gap-1.5 text-secondary mt-3 hover:underline text-xs" href="#">
                                <span class="material-symbols-outlined text-xs">alternate_email</span>{{ strtolower($couple['bride']) }}_wedding
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ACARA (TICKET STYLE) -->
            <section class="py-24 px-6 bg-primary-container" id="acara">
                <h2 class="font-headline-md text-4xl text-center text-aged-ivory mb-16 font-bold">Save the Date</h2>
                <div class="max-w-xs mx-auto space-y-10">
                    
                    <!-- Akad Ticket -->
                    <div class="bg-[#e7d8c5] border-2 border-dashed border-secondary/40 p-8 shadow-xl relative overflow-hidden flex flex-col justify-between rounded-lg">
                        <div class="absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary-container rounded-full"></div>
                        <div class="absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary-container rounded-full"></div>
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-label-caps text-[9px] text-ink-charcoal/60 uppercase tracking-wider">Wedding Ceremony</span>
                            <span class="material-symbols-outlined text-deep-rose text-lg">favorite</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-2xl text-ink-charcoal mb-4 font-bold">{{ $schedule[0]['title'] }}</h3>
                            <div class="space-y-2 font-body-md text-ink-charcoal/80 text-xs">
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                                <p>Pukul {{ $schedule[0]['time'] }}</p>
                                <p class="mt-4 font-bold text-ink-charcoal">{{ $schedule[0]['note'] }}</p>
                            </div>
                        </div>
                        <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ urlencode('Akad Nikah ' . $couple['groom'] . ' & ' . $couple['bride']) }}&dates={{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T080000Z/{{ \Carbon\Carbon::parse($event['date_iso'])->format('Ymd') }}T100000Z&details=Selamat+menempuh+hidup+baru!&location={{ urlencode($schedule[0]['note']) }}" target="_blank" rel="noopener" class="mt-8 bg-secondary text-aged-ivory py-2.5 px-4 text-[10px] font-label-caps uppercase tracking-widest hover:bg-deep-rose transition-colors text-center block rounded">Add to Calendar</a>
                    </div>

                    <!-- Reception Ticket -->
                    <div class="bg-[#e7d8c5] border-2 border-dashed border-secondary/40 p-8 shadow-xl relative overflow-hidden flex flex-col justify-between rounded-lg">
                        <div class="absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary-container rounded-full"></div>
                        <div class="absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-primary-container rounded-full"></div>
                        <div class="flex justify-between items-start mb-6">
                            <span class="font-label-caps text-[9px] text-ink-charcoal/60 uppercase tracking-wider">Dinner Celebration</span>
                            <span class="material-symbols-outlined text-secondary text-lg">confirmation_number</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-2xl text-ink-charcoal mb-4 font-bold">{{ $schedule[1]['title'] }}</h3>
                            <div class="space-y-2 font-body-md text-ink-charcoal/80 text-xs">
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                                <p>Pukul {{ $schedule[1]['time'] }}</p>
                                <p class="mt-4 font-bold text-ink-charcoal">{{ $schedule[1]['note'] }}</p>
                            </div>
                        </div>
                        <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="mt-8 bg-ink-charcoal text-aged-ivory py-2.5 px-4 text-[10px] font-label-caps uppercase tracking-widest hover:bg-secondary transition-colors text-center block rounded">Google Maps</a>
                    </div>

                    <!-- Countdown Timer -->
                    <div class="mt-12 flex justify-center gap-3 text-aged-ivory font-body-md">
                        <div class="bg-primary-container border border-secondary/20 p-3 rounded w-14 text-center shadow-lg">
                            <span id="days" class="font-headline-md text-xl text-secondary block font-bold">00</span>
                            <span class="text-[7px] font-label-caps uppercase opacity-65 tracking-wider">Days</span>
                        </div>
                        <div class="bg-primary-container border border-secondary/20 p-3 rounded w-14 text-center shadow-lg">
                            <span id="hours" class="font-headline-md text-xl text-secondary block font-bold">00</span>
                            <span class="text-[7px] font-label-caps uppercase opacity-65 tracking-wider">Hours</span>
                        </div>
                        <div class="bg-primary-container border border-secondary/20 p-3 rounded w-14 text-center shadow-lg">
                            <span id="minutes" class="font-headline-md text-xl text-secondary block font-bold">00</span>
                            <span class="text-[7px] font-label-caps uppercase opacity-65 tracking-wider">Mins</span>
                        </div>
                        <div class="bg-primary-container border border-secondary/20 p-3 rounded w-14 text-center shadow-lg">
                            <span id="seconds" class="font-headline-md text-xl text-secondary block font-bold">00</span>
                            <span class="text-[7px] font-label-caps uppercase opacity-65 tracking-wider">Secs</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- KISAH CINTA (TIMELINE) -->
            <section class="py-24 px-6 bg-primary" id="kisah">
                <h2 class="font-headline-md text-4xl text-center gold-emboss mb-16 font-bold">Our Journey</h2>
                <div class="max-w-xs mx-auto relative border-l-2 border-secondary/30 pl-8 space-y-16">
                    @foreach($stories as $index => $story)
                    <div class="relative">
                        @php
                            $rotations = ['rotate-6', '-rotate-12', 'rotate-12', '-rotate-6'];
                            $rotation = $rotations[$index % 4];
                        @endphp
                        <div class="absolute -left-[46px] top-0 w-8 h-8 bg-aged-ivory p-1 shadow-md border-[1px] border-dashed border-secondary {{ $rotation }}">
                            <div class="w-full h-full bg-deep-rose/20"></div>
                        </div>
                        <span class="font-label-caps text-secondary text-xs font-semibold tracking-wider">{{ $story['date'] }} — {{ $story['title'] }}</span>
                        <p class="text-aged-ivory font-body-md mt-2 text-xs leading-relaxed">{{ $story['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- GALLERY (MESSY SCRAPBOOK) -->
            <section class="py-24 px-6 bg-primary-container overflow-hidden" id="gallery">
                <h2 class="font-headline-md text-4xl text-center text-aged-ivory mb-16 font-bold">Captured Moments</h2>
                <div class="max-w-[320px] mx-auto grid grid-cols-2 gap-4 relative">
                    <div class="scrapbook-photo transform rotate-3 hover:scale-105 transition-transform cursor-pointer" onclick="openLightbox('{{ $gallery[0] }}')">
                        <img class="grayscale w-full aspect-square object-cover" src="{{ $gallery[0] }}" alt="Gallery 1"/>
                    </div>
                    <div class="scrapbook-photo transform -rotate-6 hover:scale-105 transition-transform cursor-pointer z-10" onclick="openLightbox('{{ $gallery[1] }}')">
                        <img class="sepia grayscale w-full aspect-square object-cover" src="{{ $gallery[1] }}" alt="Gallery 2"/>
                    </div>
                    <div class="scrapbook-photo transform rotate-12 hover:scale-105 transition-transform cursor-pointer" onclick="openLightbox('{{ $gallery[2] }}')">
                        <img class="grayscale w-full aspect-square object-cover" src="{{ $gallery[2] }}" alt="Gallery 3"/>
                    </div>
                    <div class="scrapbook-photo transform -rotate-3 hover:scale-105 transition-transform cursor-pointer" onclick="openLightbox('{{ $gallery[3] }}')">
                        <img class="sepia grayscale w-full aspect-square object-cover" src="{{ $gallery[3] }}" alt="Gallery 4"/>
                    </div>
                    <div class="scrapbook-photo transform rotate-2 hover:scale-105 transition-transform cursor-pointer" onclick="openLightbox('{{ $gallery[4] }}')">
                        <img class="grayscale w-full aspect-square object-cover" src="{{ $gallery[4] }}" alt="Gallery 5"/>
                    </div>
                    <div class="scrapbook-photo transform -rotate-12 hover:scale-105 transition-transform cursor-pointer" onclick="openLightbox('{{ $gallery[5] }}')">
                        <img class="grayscale w-full aspect-square object-cover" src="{{ $gallery[5] }}" alt="Gallery 6"/>
                    </div>
                </div>
            </section>

            <!-- RSVP (POSTCARD) -->
            <section class="py-24 px-6 bg-primary flex items-center justify-center" id="rsvp">
                <div class="max-w-xs w-full bg-[#e7d8c5] torn-edge p-6 shadow-2xl relative flex flex-col gap-8">
                    <div>
                        <h2 class="font-headline-md text-2xl text-ink-charcoal mb-4 font-bold">Will You Join Us?</h2>
                        <form id="rsvp-form" onsubmit="submitRsvp(event)" class="space-y-4">
                            <div>
                                <label class="block font-label-caps text-[9px] text-ink-charcoal/60 uppercase tracking-wider mb-1">Guest Name</label>
                                <input id="rsvp-nama" class="w-full bg-transparent border-b border-ink-charcoal/20 py-1.5 focus:border-secondary outline-none font-body-md text-ink-charcoal text-xs" type="text" placeholder="Your name..." required/>
                            </div>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-1.5 font-body-md text-ink-charcoal text-xs cursor-pointer">
                                    <input id="rsvp-hadir" class="text-secondary focus:ring-secondary" name="attendance" type="radio" value="Hadir" checked/> I'm Coming!
                                </label>
                                <label class="flex items-center gap-1.5 font-body-md text-ink-charcoal text-xs cursor-pointer">
                                    <input id="rsvp-absen" class="text-deep-rose focus:ring-deep-rose" name="attendance" type="radio" value="Tidak Hadir"/> Decline
                                </label>
                            </div>
                            <div>
                                <label class="block font-label-caps text-[9px] text-ink-charcoal/60 uppercase tracking-wider mb-1">A Message for Us</label>
                                <textarea id="rsvp-pesan" class="w-full bg-transparent border border-ink-charcoal/20 p-3 focus:border-secondary outline-none font-body-md text-ink-charcoal italic text-xs" placeholder="Your warm wishes..." rows="3" required></textarea>
                            </div>
                            <button type="submit" class="bg-ink-charcoal text-aged-ivory font-label-caps px-6 py-2.5 hover:bg-secondary transition-colors w-full text-xs rounded tracking-widest uppercase">Send Message</button>
                        </form>
                    </div>
                    <div class="border-t border-dotted border-ink-charcoal/20 pt-6 flex flex-col justify-between min-h-[120px]">
                        <div class="text-center">
                            <div class="w-12 h-16 bg-white p-1 shadow-sm border border-ink-charcoal/10 mx-auto mb-4 rotate-12 flex flex-col items-center justify-center">
                                <span class="text-[6px] font-label-caps text-ink-charcoal opacity-40">2026</span>
                                <div class="w-full h-8 bg-deep-rose/20"></div>
                            </div>
                            <p class="font-body-md text-ink-charcoal text-[11px] italic">"Delivered with love through time."</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- WISHES FEED -->
            <section class="py-12 px-6 bg-primary">
                <div class="max-w-xs mx-auto">
                    <h3 class="font-headline-md text-2xl text-center text-aged-ivory mb-8 font-bold">Blessings &amp; Wishes</h3>
                    <div id="wishList" class="space-y-4 max-h-[300px] overflow-y-auto pr-1">
                        @foreach($wishes as $w)
                        <div class="bg-white/5 border border-secondary/25 p-4 rounded relative text-left">
                            <p class="font-body-md italic text-xs mb-3 text-aged-ivory/80 leading-relaxed">"{{ $w['message'] }}"</p>
                            <div class="flex items-center justify-between">
                                <span class="font-label-caps text-secondary text-[9px] font-bold tracking-wider">— {{ $w['name'] }}</span>
                                @php
                                    $badgeClass = $w['status'] === 'Hadir' 
                                        ? 'bg-emerald-950/80 text-emerald-400 border-emerald-800' 
                                        : 'bg-rose-950/80 text-rose-400 border-rose-800';
                                @endphp
                                <span class="text-[7px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border {{ $badgeClass }}">{{ $w['status'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- DIGITAL GIFT (ANTIQUE ENVELOPE) -->
            <section class="py-24 px-6 bg-primary-container" id="gift">
                <div class="max-w-xs mx-auto text-center">
                    <div class="bg-aged-ivory/5 p-6 border border-secondary/20 rounded-lg">
                        <span class="material-symbols-outlined text-secondary text-4xl mb-4">redeem</span>
                        <h2 class="font-headline-md text-2xl text-aged-ivory mb-3 font-bold">Digital Wedding Gift</h2>
                        <p class="font-body-md text-aged-ivory/70 text-xs mb-8 leading-relaxed">Your presence is our greatest gift, but if you wish to honor us with a token of love:</p>
                        <div class="space-y-3">
                            @foreach($gifts as $gift)
                            <div onclick="copyAccount('{{ $gift['account'] }}', this)" class="bg-primary p-3.5 border border-secondary/30 flex justify-between items-center group cursor-pointer hover:border-secondary transition-colors rounded">
                                <div class="text-left">
                                    <p class="text-[9px] font-label-caps text-secondary uppercase tracking-wider">{{ $gift['bank'] }}</p>
                                    <p class="text-aged-ivory font-body-md text-xs mt-0.5">{{ $gift['account'] }}</p>
                                    <p class="text-[9px] font-body-md text-aged-ivory/40 italic">a.n {{ $gift['name'] }}</p>
                                </div>
                                <span class="material-symbols-outlined text-secondary opacity-40 group-hover:opacity-100 transition-opacity text-sm">content_copy</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="py-12 px-6 bg-primary border-t border-secondary/10 text-center">
                <h3 class="font-headline-md text-xl gold-emboss mb-3 font-bold">{{ substr($couple['groom'], 0, 1) }} &amp; {{ substr($couple['bride'], 0, 1) }}</h3>
                <p class="font-body-md text-aged-ivory/40 text-[10px] italic">Crafted with nostalgia. &copy; 2026</p>
            </footer>
        </main>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-ink-charcoal/95 backdrop-blur-sm z-[200] hidden flex items-center justify-center p-4 transition-opacity duration-300 opacity-0" onclick="closeLightbox()">
        <button class="absolute top-4 right-4 text-white text-3xl font-bold">&times;</button>
        <img id="lightbox-img" class="max-w-[90%] max-h-[80vh] object-contain shadow-2xl border-4 border-white" src="" alt="Enlarged gallery image"/>
    </div>

    <!-- JavaScript Actions -->
    <script>
        function openInvitation() {
            const container = document.getElementById('envelope-container');
            const envelope = document.getElementById('envelope');
            const mainContent = document.getElementById('main-content');
            const nav = document.getElementById('bottomNav');
            const music = document.getElementById('bgMusic');

            // 1. Open the envelope
            envelope.classList.add('open');

            // 2. Delay and hide container
            setTimeout(() => {
                container.style.opacity = '0';
                container.style.transform = 'translate(-50%, -100%)';
                
                // Show content
                mainContent.classList.remove('hidden');
                setTimeout(() => {
                    mainContent.classList.add('opacity-100');
                    nav.classList.remove('translate-y-24');
                    document.body.classList.remove('cover-active');
                    
                    // Play music
                    music.play().catch(e => console.log("Autoplay blocked"));
                    
                    // Reveal scroll items
                    initScrollReveal();
                }, 100);
            }, 800);
        }

        let isPlaying = true;
        function toggleMusic() {
            const music = document.getElementById('bgMusic');
            const btn = document.getElementById('musicBtn');
            if (music.paused) {
                music.play();
                btn.innerText = 'music_note';
                btn.classList.remove('text-red-500');
                isPlaying = true;
            } else {
                music.pause();
                btn.innerText = 'music_off';
                btn.classList.add('text-red-500');
                isPlaying = false;
            }
        }

        let isAutoscrolling = false;
        const scrollSpeed = 1;

        function autoScrollStep() {
            if (!isAutoscrolling) return;
            window.scrollBy(0, scrollSpeed);
            const currentScroll = window.innerHeight + window.pageYOffset;
            const bottomLimit = document.documentElement.scrollHeight - 5;
            if (currentScroll >= bottomLimit) {
                stopAutoscroll();
                return;
            }
            requestAnimationFrame(autoScrollStep);
        }

        function startAutoscroll() {
            isAutoscrolling = true;
            const btn = document.getElementById('scrollBtn');
            btn.textContent = 'pause';
            btn.classList.add('text-secondary');
            requestAnimationFrame(autoScrollStep);
        }

        function stopAutoscroll() {
            isAutoscrolling = false;
            const btn = document.getElementById('scrollBtn');
            btn.textContent = 'keyboard_double_arrow_down';
            btn.classList.remove('text-secondary');
        }

        function toggleAutoscroll() {
            if (isAutoscrolling) {
                stopAutoscroll();
            } else {
                startAutoscroll();
            }
        }

        ['wheel', 'touchmove', 'mousedown'].forEach(evt => {
            window.addEventListener(evt, () => {
                if (isAutoscrolling) stopAutoscroll();
            }, { passive: true });
        });

        function copyAccount(text, el) {
            navigator.clipboard.writeText(text.replace(/-/g, '').trim()).then(() => {
                const checkIcon = el.querySelector('.material-symbols-outlined');
                if (checkIcon) {
                    checkIcon.textContent = 'check';
                    setTimeout(() => {
                        checkIcon.textContent = 'content_copy';
                    }, 2000);
                }
                alert('Nomor rekening berhasil disalin!');
            });
        }

        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('rsvp-nama').value;
            const status = document.querySelector('input[name="attendance"]:checked').value;
            const msg = document.getElementById('rsvp-pesan').value;

            const card = document.createElement('div');
            card.className = 'bg-white/5 border border-secondary/25 p-4 rounded relative text-left';
            
            const badgeClass = status === 'Hadir' 
                ? 'bg-emerald-950/80 text-emerald-400 border-emerald-800' 
                : 'bg-rose-950/80 text-rose-400 border-rose-800';
                
            card.innerHTML = `
                <p class="font-body-md italic text-xs mb-3 text-aged-ivory/80 leading-relaxed">"${msg}"</p>
                <div class="flex items-center justify-between">
                    <span class="font-label-caps text-secondary text-[9px] font-bold">— ${name}</span>
                    <span class="text-[7px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border ${badgeClass}">${status}</span>
                </div>
            `;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert('RSVP dan ucapan Anda berhasil dikirim!');
        }

        function openLightbox(src) {
            if (isAutoscrolling) stopAutoscroll();
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.add('opacity-100');
            }, 50);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('opacity-100');
            setTimeout(() => {
                lightbox.classList.add('hidden');
            }, 300);
        }

        // Reveal on scroll logic
        function initScrollReveal() {
            const observerOptions = {
                threshold: 0.05
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('section').forEach(section => {
                section.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-10');
                observer.observe(section);
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            // COUNTDOWN TIMER
            const targetDateStr = "{{ $event['date_iso'] }}T{{ $event['time'] }}:00";
            const target = new Date(targetDateStr).getTime();
            
            setInterval(() => {
                const now = new Date().getTime();
                const diff = target - now;
                if (diff <= 0) return;
                
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                
                document.getElementById('days').innerText = String(days).padStart(2, '0');
                document.getElementById('hours').innerText = String(hours).padStart(2, '0');
                document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
                document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
            }, 1000);

            // Active nav indicator highlight on scroll
            window.addEventListener('scroll', () => {
                let current = "";
                const sections = document.querySelectorAll("section");
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= sectionTop - 250) {
                        current = section.getAttribute("id") || "";
                    }
                });

                document.querySelectorAll('#bottomNav a').forEach((a) => {
                    a.classList.remove('text-secondary');
                    const href = a.getAttribute("href");
                    if (href === `#${current}`) {
                        a.classList.add('text-secondary');
                    }
                });
            });
        });
    </script>
</body>
</html>