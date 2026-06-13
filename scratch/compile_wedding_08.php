<?php
$htmlFile = 'd:/Project/temuruang/resources/views/templates/wedding/Untitled-8.html';
$bladeFile = 'd:/Project/temuruang/resources/views/templates/wedding/wedding-08.blade.php';

if (!file_exists($htmlFile)) {
    die("Error: Source HTML file not found at $htmlFile\n");
}

$html = file_get_contents($htmlFile);

// Helper function to normalize newlines
function normalize($text) {
    return str_replace("\r\n", "\n", $text);
}

$html = normalize($html);

// 1. Prepare PHP Header Block
$header = <<<'PHP'
@php
    $couple = $couple ?? [
        'groom' => 'Audwin Trito Iskandar',
        'bride' => 'Aisyah',
        'parents' => [
            'groom' => 'Mr Tommy Iskandar & Mrs Gayatri Pamoedji',
            'bride' => 'Mr. Ridho Kurniawan & Mrs Muspidah',
        ],
    ];

    $event = $event ?? [
        'date_iso' => '2024-02-09',
        'time' => '07:30',
        'location' => 'Sheraton Grand Jakarta Gandaria City Hotel',
        'address' => 'Jalan Sultan Iskandar Muda, Jakarta Selatan, Jakarta 12240',
        'maps_url' => 'https://goo.gl/maps/Lk4Kd5axFRDYMwNQ9',
    ];

    $schedule = $schedule ?? [
        ['title' => 'Akad Nikah', 'time' => '07:30 - 11:00', 'note' => 'Formal Attire'],
    ];

    $bg = $bg ?? [
        'cover' => '/themes/boho-wedding/couple-secondary.jpg',
        'groom' => '/themes/boho-wedding/couple-main.webp',
        'bride' => '/themes/boho-wedding/couple-main.webp',
    ];

    $eventDate = \Carbon\Carbon::parse($event['date_iso']);
    $dayName = $eventDate->translatedFormat('l');
    $dayNum = $eventDate->translatedFormat('d');
    $monthName = $eventDate->translatedFormat('F');
    $year = $eventDate->translatedFormat('Y');
@endphp

PHP;

// 2. Metadata, SEO, and JSON-LD
$metaSearch = <<<'HTML'
    <title>Wedding - Boho Wedding</title>
    <meta name="title" content="Wedding  - Boho Wedding">
    <meta name="description"
        content="undangan warna orange cream dan hijau tema boho flowers - Undangan Online: Undangan digital modern untuk pernikahan dan acara spesial lainnya. Gratis coba dulu, bayar belakangan!">
    <meta itemprop="image" content="https://satumomen.com/themes/boho-wedding/boho-wedding.jpg">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://satumomen.com/preview/boho-wedding">
    <meta property="og:title" content="Wedding  - Boho Wedding">
    <meta property="og:description"
        content="undangan warna orange cream dan hijau tema boho flowers - Undangan Online: Undangan digital modern untuk pernikahan dan acara spesial lainnya. Gratis coba dulu, bayar belakangan!">
    <meta property="og:image" content="https://satumomen.com/themes/boho-wedding/boho-wedding.jpg">
HTML;

$metaReplace = <<<'HTML'
    <title>Undangan Pernikahan | {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}</title>
    <meta name="title" content="Undangan Pernikahan | {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}">
    <meta name="description" content="Undangan digital modern untuk pernikahan {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}">
    <meta itemprop="image" content="{{ asset('themes/boho-wedding/boho-wedding.jpg') }}">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="Undangan Pernikahan | {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}">
    <meta property="og:description" content="Undangan digital modern untuk pernikahan {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}">
    <meta property="og:image" content="{{ asset('themes/boho-wedding/boho-wedding.jpg') }}">
HTML;

$html = str_replace(normalize($metaSearch), normalize($metaReplace), $html);

// Escape JSON-LD properties and make the context dynamically bind to TemuRuang branding
$ldSearch = <<<'HTML'
    <script type="application/ld+json">
        {
          "@context": "https://schema.org/", 
          "@type": "Product", 
          "name": "Wedding  - Boho Wedding",
          "image": "https://satumomen.com/themes/boho-wedding/boho-wedding.jpg",
          "description": "undangan warna orange cream dan hijau tema boho flowers - Undangan Online: Undangan digital modern untuk pernikahan dan acara spesial lainnya. Gratis coba dulu, bayar belakangan!",
          "brand": {
            "@type": "Brand",
            "name": "Satu Momen"
          },
          "review": {
            "@type": "Review",
            "reviewRating": {
              "@type": "Rating",
              "ratingValue": "5",
              "bestRating": "5"
            },
            "author": {
              "@type": "Person",
              "name": "Elsa Gunayanti"
            }
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "579"
          },
          "offers": {
            "@type": "Offer",
            "url": "https://satumomen.com/harga",
            "priceCurrency": "IDR",
            "price": "85000",
            "availability": "https://schema.org/InStock",
            "itemCondition": "https://schema.org/NewCondition"
          }
        }
    </script>
HTML;

$ldReplace = <<<'HTML'
    <script type="application/ld+json">
        {
          "@@context": "https://schema.org/", 
          "@@type": "Product", 
          "name": "Undangan Pernikahan | {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}",
          "image": "{{ asset('themes/boho-wedding/boho-wedding.jpg') }}",
          "description": "Undangan digital modern untuk pernikahan {{ $couple['bride'] }} &amp; {{ $couple['groom'] }}",
          "brand": {
            "@@type": "Brand",
            "name": "TemuRuang"
          },
          "review": {
            "@@type": "Review",
            "reviewRating": {
              "@@type": "Rating",
              "ratingValue": "5",
              "bestRating": "5"
            },
            "author": {
              "@@type": "Person",
              "name": "Elsa Gunayanti"
            }
          },
          "aggregateRating": {
            "@@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "579"
          },
          "offers": {
            "@@type": "Offer",
            "url": "https://temuruang.id",
            "priceCurrency": "IDR",
            "price": "85000",
            "availability": "https://schema.org/InStock",
            "itemCondition": "https://schema.org/NewCondition"
          }
        }
    </script>
HTML;

$html = str_replace(normalize($ldSearch), normalize($ldReplace), $html);

// 3. Localize Assets and Music
$html = str_replace('https://assets.satumomen.com/build/', '/build/', $html);
$html = str_replace('https://satumomen.com/themes/', '/themes/', $html);
$html = str_replace('https://satumomen.com/fonts/', '/fonts/', $html);
$html = str_replace('https://satumomen.com/images/', '/images/', $html);

// Replace slide background image globally
$html = str_replace(
    'https://assets.satumomen.com/images/invitation/secondary_image-1432211693586982.jpg',
    '{{ $bg[\'cover\'] ?? \'/themes/boho-wedding/couple-secondary.jpg\' }}',
    $html
);

// Background Music
$musicSearch = <<<'HTML'
        <audio id="music" loop autoplay>
            <source
                src="https://assets.satumomen.com/musics/every-day-i-love-you-boyzone-piano-cover-by-riyandi-kusuma.mp3">
        </audio>
HTML;

$musicReplace = <<<'HTML'
        <!-- music -->
        <audio id="music" loop autoplay>
            <source src="/musics/boho-wedding-bg.mp3" type="audio/mpeg">
        </audio>
        <!-- end music -->
HTML;

$html = str_replace(normalize($musicSearch), normalize($musicReplace), $html);

// 4. Inject TemuRuang custom watermark styles into the head
$watermarkStyle = <<<'HTML'
    <style>
        /* Hide dynamic satumomen watermark */
        .watermark-placeholder svg, 
        .watermark-placeholder img, 
        .watermark-placeholder a, 
        #waterMark,
        .btn-float.bg-success {
            display: none !important;
        }
        
        /* Render TemuRuang custom watermark */
        .watermark-placeholder::after {
            content: "TemuRuang";
            font-family: 'Cinzel', serif;
            font-weight: bold;
            font-size: 14px;
            color: #54735c; /* Boho accent color */
            opacity: 0.8;
            display: block;
            text-align: center;
            margin-top: 15px;
            letter-spacing: 1px;
        }
    </style>
</head>
HTML;

$html = str_replace('</head>', normalize($watermarkStyle), $html);

// 5. Dynamic Data/Variable Replacements
// Cover Section
$html = str_replace(
    '<div id="satuMomen" data-guest="Nama Tamu" data-group="VIP">',
    '<div id="satuMomen" data-guest="{{ request()->get(\'kpd\', \'Tamu Undangan\') }}" data-group="{{ request()->get(\'group\', \'Tamu Undangan\') }}">',
    $html
);

$html = str_replace(
    normalize('<div id="guestNameSlot"
                                                                class="editable color-accent h5 font-weight-bold mb-1 animate__animated animate__fadeInUp animate__slower"
                                                                style="font-size:16px;">Guest Name</div>'),
    normalize('<div id="guestNameSlot"
                                                                class="editable color-accent h5 font-weight-bold mb-1 animate__animated animate__fadeInUp animate__slower"
                                                                style="font-size:16px;">{{ request()->get(\'kpd\', \'Tamu Undangan\') }}</div>'),
    $html
);

$html = str_replace(
    normalize('<div style="font-size:50px;line-height:1.5;position:relative;z-index:2;"
                                                            class="editable color-accent font-latin">Aisyah</div>'),
    normalize('<div style="font-size:50px;line-height:1.5;position:relative;z-index:2;"
                                                            class="editable color-accent font-latin">{{ $couple[\'bride\'] }}</div>'),
    $html
);

$html = str_replace(
    normalize('<div style="font-size:50px;line-height:1.5;position:relative;z-index:2;"
                                                            class="editable color-accent font-latin">Audwin</div>'),
    normalize('<div style="font-size:50px;line-height:1.5;position:relative;z-index:2;"
                                                            class="editable color-accent font-latin">{{ $couple[\'groom\'] }}</div>'),
    $html
);

// Slide 2 Mempelai
// Bride
$html = str_replace(
    normalize('<div class="editable color-accent h4 mb-2 font-latin"
                                                        style="font-size:30px;">Aisyah</div>'),
    normalize('<div class="editable color-accent h4 mb-2 font-latin"
                                                        style="font-size:30px;">{{ $couple[\'bride\'] }}</div>'),
    $html
);
$html = str_replace(
    normalize('<div class="editable" style="font-size:14px;">Daughter of Mr. Ridho
                                                         Kurniawan<br />&amp; Mrs Muspidah</div>'),
    normalize('<div class="editable" style="font-size:14px;">Putri dari {{ $couple[\'parents\'][\'bride\'] }}</div>'),
    $html
);

// Groom
$html = str_replace(
    normalize('<div class="editable color-accent h4 mb-2 font-latin"
                                                        style="font-size:30px;">Audwin Trito Iskandar</div>'),
    normalize('<div class="editable color-accent h4 mb-2 font-latin"
                                                        style="font-size:30px;">{{ $couple[\'groom\'] }}</div>'),
    $html
);
$html = str_replace(
    normalize('<div class="editable" style="font-size:14px;">Son of Mr Tommy
                                                         Iskandar<br />&amp; Mrs Gayatri Pamoedji</div>'),
    normalize('<div class="editable" style="font-size:14px;">Putra dari {{ $couple[\'parents\'][\'groom\'] }}</div>'),
    $html
);

// Slide 3 Event/Schedule
$html = str_replace(
    normalize('<div class="editable color-accent font-weight-bold mb-2"
                                                            style="font-size:16px;line-height:1.2;">ON FRIDAY<br />9TH
                                                            FEBRUARY 2024</div>'),
    normalize('<div class="editable color-accent font-weight-bold mb-2"
                                                            style="font-size:16px;line-height:1.2;">{{ strtoupper($eventDate->translatedFormat(\'l\')) }}<br />{{ strtoupper($eventDate->translatedFormat(\'d F Y\')) }}</div>'),
    $html
);

$html = str_replace(
    normalize('<div class="editable" style="font-size:14.4px;">At 07.30 – 11.00
                                                         </div>'),
    normalize('<div class="editable" style="font-size:14.4px;">Pukul {{ $schedule[0][\'time\'] ?? $event[\'time\'] }}</div>'),
    $html
);

$html = str_replace(
    normalize('<div class="editable" style="font-size:14.4px;">Sheraton Grand
                                                            Jakarta Gandaria City Hotel<br />Jalan Sultan Iskandar Muda.
                                                            Jakarta Selatan,Jakarta, Jakarta 12240<br /></div>'),
    normalize('<div class="editable" style="font-size:14.4px;">{{ $event[\'location\'] }}<br />{{ $event[\'address\'] }}</div>'),
    $html
);

// Slide 4 Maps
$html = str_replace(
    'src="https://assets.satumomen.com/images/galleries/143221-gallery-1693586643.webp"',
    'src="{{ $bg[\'groom\'] ?? \'/themes/boho-wedding/couple-main.webp\' }}"',
    $html
);

$html = str_replace(
    normalize('<div class="editable color-accent"
                                                                style="font-size:14.4px;">Sheraton Grand Jakarta
                                                                Gandaria City Hotel</div>'),
    normalize('<div class="editable color-accent"
                                                                style="font-size:14.4px;">{{ $event[\'location\'] }}</div>'),
    $html
);

$html = str_replace(
    normalize('<div class="editable mb-3" style="font-size:12px;">Jln.
                                                                Sultan Iskandar Muda. Jakarta Selatan,Jakarta, Jakarta
                                                                12240<br /></div>'),
    normalize('<div class="editable mb-3" style="font-size:12px;">{{ $event[\'address\'] }}<br /></div>'),
    $html
);

$html = str_replace(
    'href="https://goo.gl/maps/Lk4Kd5axFRDYMwNQ9"',
    'href="{{ $event[\'maps_url\'] }}"',
    $html
);

// Slide 5 RSVP Countdown
$html = str_replace(
    'data-datetime="2024-02-09T09:30"',
    'data-datetime="{{ $event[\'date_iso\'] }}T{{ $event[\'time\'] }}"',
    $html
);

$html = str_replace(
    'name="Nama Tamu"',
    'name="{{ request()->get(\'kpd\', \'Tamu Undangan\') }}"',
    $html
);

// Slide 6 Thanks
$html = str_replace(
    normalize('<div class="editable h4 color-accent animate__animated animate__fadeInDown animate__slow font-latin"
                                                            style="font-size:30px;">Aisyah &amp; Audwin</div>'),
    normalize('<div class="editable h4 color-accent animate__animated animate__fadeInDown animate__slow font-latin"
                                                            style="font-size:30px;">{{ $couple[\'bride\'] }} &amp; {{ $couple[\'groom\'] }}</div>'),
    $html
);

// 6. Clean Cloudflare and Rocket Loader Scripts/Tags
$html = str_replace('type="fcd29c944b623f58f0e47bba-text/javascript"', 'type="text/javascript"', $html);
$html = str_replace('data-cf-modified-fcd29c944b623f58f0e47bba-=""', '', $html);

// Remove specific inline checkguards if they exist:
$html = str_replace('if (!window.__cfRLUnblockHandlers) return false; ', '', $html);
$html = str_replace('onclick="if (!window.__cfRLUnblockHandlers) return false; ', 'onclick="', $html);

// Remove rocket-loader and cloudflare insights and challenge iframe:
$html = preg_replace('/<script[^>]*rocket-loader\.min\.js[^>]*><\/script>/s', '', $html);
$html = preg_replace('/<script[^>]*beacon\.min\.js[^>]*><\/script>/s', '', $html);
$html = preg_replace('/<script>\(function\s*\(\)\s*\{\s*function\s*c\(\)\s*\{.*?\}\s*\}\)\(\);<\/script>/s', '', $html);

// Write final file
$output = $header . $html;
file_put_contents($bladeFile, $output);
echo "Successfully compiled Untitled-8.html to wedding-08.blade.php with localized Boho assets\n";
?>
