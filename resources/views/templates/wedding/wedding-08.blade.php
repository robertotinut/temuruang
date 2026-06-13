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
<!DOCTYPE html>
<html lang="id" class="notranslate" translate="no">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="color-scheme" content="light only">
    <meta name="format-detection" content="telephone=no">
    <meta name="google" content="notranslate" />
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


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



    <meta name="google-site-verification" content="mnNzvBVq_B97WsnU3f2nBt0YS2PxHRzRjhGXf6_UtjA">

    <!-- css -->
    <link rel="stylesheet" href="/plugins/animate.css@4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.0.3/src/fill/style.css" />

    <link rel="preload" as="style" href="/build/assets/bootstrap-vCaDZZbr.css" />
    <link rel="preload" as="style" href="/build/assets/themesv2-DZZF_N8v.css" />
    <link rel="stylesheet" href="/build/assets/bootstrap-vCaDZZbr.css" />
    <link rel="stylesheet" href="/build/assets/themesv2-DZZF_N8v.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Montserrat:ital,wght@0,400;0,700;1,400;1,700&family=Parisienne&display=swap');

        :root {
            --inv-bg: #fdfdfd;
            --inv-base: #3D342B;
            --inv-accent: #54735C;
            --inv-border: #EB6C16;
            --font-base: 'Montserrat', sans-serif;
            --font-accent: 'La Belle Aurore', cursive;
            --font-latin: 'Parisienne', cursive;
            --menu-bg: #C8B3A0;
            --menu-inactive: #ffffff;
            --menu-active: #97795D;
            --btn-color: #ffffff;
        }

        .menu-item.is-active {
            background-color: var(--menu-active) !important;
            color: var(--menu-inactive) !important;
        }
    </style>


    <style>
        @import url('/fonts/brittany_signature/BrittanySignature.css');
        @import url('/fonts/photograph_signature/fonts.css');
        @import url('/fonts/heatwood/Heatwood.css');

        .font-brittany-signature {
            font-family: 'Brittany Signature';
            line-height: 1.6 !important;
        }

        .font-photograph-signature {
            font-family: 'Photograph Signature';
            line-height: 1.6 !important;
        }

        .font-heatwood {
            font-family: 'Heatwood';
            line-height: 3 !important;
        }

        #YTMusic {
            display: block
        }
    </style>
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

<body>
    <main id="app">
        <div id="modalOverlay" class="modal-backdrop fade" style="display: none;"></div>
        <!-- Loader -->
        <div id="loader" class="loader-wrapper"><span class="loader"><span class="loader-inner"></span></span></div>
        <!-- music -->
        <!-- music -->
        <audio id="music" loop autoplay>
            <source src="/musics/boho-wedding-bg.mp3" type="audio/mpeg">
        </audio>
        <!-- end music -->
        <!-- end music -->
        <div id="workspace-container" class="position-fixed h-100 w-100" style="overflow: hidden">
            <div id="panZoom" class="position-fixed h-100 w-100"
                style="top: 0; right:0; bottom:0; left:0; transform-origin: 50% 50%;">
                <div class="h-100 w-100 d-flex align-items-center justify-content-center">
                    <div class="canvas not-open  ">
                        <!-- invitation -->
                        <div id="satuMomen" data-guest="{{ request()->get('kpd', 'Tamu Undangan') }}" data-group="{{ request()->get('group', 'Tamu Undangan') }}">
                            <div class="satumomen_track">
                                <ul class="satumomen_list">
                                    <li class="satumomen_slide satumomen_cover">
                                        <div class="container-mobile cover"
                                            style="background-image: url({{ $bg['cover'] ?? '/themes/boho-wedding/couple-secondary.jpg' }}); background-size: cover;">
                                            <div class="frame">
                                                <img class="frame-tr animate__animated animate__fadeInTopRight animate__slow"
                                                    src="/themes/boho-wedding/frame-tr.png" alt="frame"
                                                    style="width:40%">
                                                <img class="frame-bl animate__animated animate__fadeInBottomLeft animate__slow"
                                                    src="/themes/boho-wedding/frame-bl.png" alt="frame"
                                                    style="width:40%">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-center"
                                                style="height:100%;">

                                                <div style="width:100%;">
                                                    <div class="text-center editable animate__animated animate__fadeInDown animate__slower mb-4"
                                                        style="font-size:16px;">THE WEDDING OF</div>
                                                    <div
                                                        class="text-center animate__animated animate__zoomIn animate__slower mb-5">
                                                        <div style="font-size:50px;line-height:1.5;position:relative;z-index:2;"
                                                            class="editable color-accent font-latin">{{ $couple['bride'] }}</div>
                                                        <div style="font-size:90px;line-height:1;z-index:1;position:relative;color:#e36613;margin-top:-4%;margin-bottom:-9%;"
                                                            class="editable font-accent">&amp;</div>
                                                        <div style="font-size:50px;line-height:1.5;position:relative;z-index:2;"
                                                            class="editable color-accent font-latin">{{ $couple['groom'] }}</div>
                                                    </div>
                                                    <div class="text-center mx-auto" style="max-width:300px;">
                                                        <div
                                                            class="text-center mb-3 p-2 animate__animated animate__zoomIn animate__slower">
                                                            <div class="editable mb-1 animate__animated animate__fadeInUp animate__slower"
                                                                style="font-size:14px;">Dear</div>
                                                            <div id="guestNameSlot"
                                                                class="editable color-accent h5 font-weight-bold mb-1 animate__animated animate__fadeInUp animate__slower"
                                                                style="font-size:16px;">{{ request()->get('kpd', 'Tamu Undangan') }}</div>
                                                            <div class="editable mb-1 animate__animated animate__fadeInUp animate__slower"
                                                                style="font-size:14px;">We're inviting you to join our
                                                                joyful moment together.</div>
                                                        </div><button
                                                            class="btn-open-invitation btn btn-primary rounded-pill mb-4 animate__animated animate__fadeInUp animate__slow"
                                                            style="font-size: 14px;">Open Invitation</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="satumomen_slide">
                                        <div class="container-mobile "
                                            style="background-image: url({{ $bg['cover'] ?? '/themes/boho-wedding/couple-secondary.jpg' }}); background-size: cover;">
                                            <div class="frame">
                                                <img class="frame-tr animate__animated animate__fadeInTopRight animate__slow"
                                                    src="/themes/boho-wedding/frame-tr.png" alt="frame"
                                                    style="width:40%">
                                                <img class="frame-bl animate__animated animate__fadeInBottomLeft animate__slow"
                                                    src="/themes/boho-wedding/frame-bl.png" alt="frame"
                                                    style="width:40%">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-center"
                                                style="height:100%;">
                                                <div class="editable mb-4 text-center animate__animated animate__fadeInDown animate__slower"
                                                    style="font-size:14px;">Cordially request the honour of your
                                                    presence at<br />the marriage of our beloved son and daughter<br />
                                                </div>
                                                <div class="text-center mb-2 animate__animated animate__fadeInDown animate__slower"
                                                    style="position:relative;">
                                                    <div class="editable color-accent h4 mb-2 font-latin"
                                                        style="font-size:30px;">{{ $couple['bride'] }}</div>
                                                    <div class="editable" style="font-size:14px;">Daughter of Mr. Ridho
                                                        Kurniawan<br />&amp; Mrs Muspidah</div>
                                                </div>
                                                <div class="editable text-center animate__animated animate__zoomIn animate__slower color-accent mb-2 font-accent"
                                                    style="font-size:30px;">and</div>
                                                <div class="text-center mb-2 animate__animated animate__fadeInUp animate__slower"
                                                    style="position:relative;">
                                                    <div class="editable color-accent h4 mb-2 font-latin"
                                                        style="font-size:30px;">{{ $couple['groom'] }}</div>
                                                    <div class="editable" style="font-size:14px;">Son of Mr Tommy
                                                        Iskandar<br />&amp; Mrs Gayatri Pamoedji</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="satumomen_slide">
                                        <div class="container-mobile "
                                            style="background-image: url({{ $bg['cover'] ?? '/themes/boho-wedding/couple-secondary.jpg' }}); background-size: cover;">
                                            <div class="frame">
                                                <img class="frame-tr animate__animated animate__fadeInTopRight animate__slow"
                                                    src="/themes/boho-wedding/frame-tr.png" alt="frame"
                                                    style="width:40%">
                                                <img class="frame-bl animate__animated animate__fadeInBottomLeft animate__slow"
                                                    src="/themes/boho-wedding/frame-bl.png" alt="frame"
                                                    style="width:40%">
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height:100%;">
                                                <div style="width:100%;">
                                                    <div class="editable mb-4 text-center animate__animated animate__fadeInDown animate__slower"
                                                        style="font-size:14.4px;">Our joy will be complete with your
                                                        presence and <br />blessings at our celebration of love<br />
                                                    </div>
                                                    <div
                                                        class="text-center mb-3 animate__animated animate__fadeInDown animate__slower">
                                                        <div class="editable color-accent font-weight-bold mb-2"
                                                            style="font-size:16px;line-height:1.2;">{{ strtoupper($eventDate->translatedFormat('l')) }}<br />{{ strtoupper($eventDate->translatedFormat('d F Y')) }}</div>
                                                        <div class="editable" style="font-size:14.4px;">At 07.30 – 11.00
                                                        </div>


                                                    </div>

                                                    <div
                                                        class="text-center mb-3 animate__animated animate__fadeInUp animate__slower">


                                                        <div class="editable font-accent" style="font-size:24px;">
                                                            Location</div>

                                                        <div class="editable" style="font-size:14.4px;">{{ $event['location'] }}<br />{{ $event['address'] }}</div>
                                                    </div>
                                                    <div
                                                        class="text-center mb-3 animate__animated animate__fadeInUp animate__slower">


                                                        <div class="editable font-accent" style="font-size:24px;">Dress
                                                            Code</div>

                                                        <div class="editable" style="font-size:14.4px;">To support our
                                                            wedding theme it will<br />be very good if you wear<br />
                                                        </div>
                                                        <div class="editable font-weight-bold"
                                                            style="font-size:14.4px;">Dress code:<br />Formal Attire
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="satumomen_slide">
                                        <div class="container-mobile "
                                            style="background-image: url({{ $bg['cover'] ?? '/themes/boho-wedding/couple-secondary.jpg' }}); background-size: cover;">
                                            <div class="frame">
                                                <img class="frame-tr animate__animated animate__fadeInTopRight animate__slow"
                                                    src="/themes/boho-wedding/frame-tr.png" alt="frame"
                                                    style="width:40%">
                                                <img class="frame-bl animate__animated animate__fadeInBottomLeft animate__slow"
                                                    src="/themes/boho-wedding/frame-bl.png" alt="frame"
                                                    style="width:40%">
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height:100%;">
                                                <div style="width:100%;">
                                                    <div class="editable text-center color-accent mb-3 animate__animated animate__fadeInDown animate__slower font-accent"
                                                        style="font-size:24px;">Location</div>

                                                    <div>
                                                        <div style="width:100%;margin:auto;border-radius:3rem .5rem;overflow:hidden;margin-bottom:20px;padding-bottom:70%;position:relative;border:4px solid var(--inv-border);"
                                                            class="image-editable animate__animated animate__zoomIn animate__slow">
                                                            <img class="w-100 h-100"
                                                                src="{{ $bg['groom'] ?? '/themes/boho-wedding/couple-main.webp' }}"
                                                                style="position: absolute;"
                                                                alt="143221-gallery-1693586643.webp" />
                                                        </div>

                                                        <div
                                                            class="text-center animate__animated animate__fadeInUp animate__slow">

                                                            <div class="editable color-accent"
                                                                style="font-size:14.4px;">{{ $event['location'] }}</div>
                                                            <div class="editable mb-3" style="font-size:12px;">{{ $event['address'] }}<br /></div><a
                                                                href="{{ $event['maps_url'] }}"
                                                                class="link btn btn-primary rounded-pill mb-4 animate__animated animate__fadeInUp animate__slow"
                                                                target="_blank"
                                                                rel="nofollow noreferrer noopener">Petunjuk Ke
                                                                Lokasi</a>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="satumomen_slide">
                                        <div class="container-mobile "
                                            style="background-image: url({{ $bg['cover'] ?? '/themes/boho-wedding/couple-secondary.jpg' }}); background-size: cover;">
                                            <div class="frame">
                                                <img class="frame-tr animate__animated animate__fadeInTopRight animate__slow"
                                                    src="/themes/boho-wedding/frame-tr.png" alt="frame"
                                                    style="width:40%">
                                                <img class="frame-bl animate__animated animate__fadeInBottomLeft animate__slow"
                                                    src="/themes/boho-wedding/frame-bl.png" alt="frame"
                                                    style="width:40%">
                                            </div>
                                            <div class="d-flex justify-content-center align-items-center"
                                                style="height:100%;">
                                                <div style="width:100%;">
                                                    <div class="text-center">
                                                        <div class="editable color-accent h4 mb-4 animate__animated animate__fadeInDown animate__slower font-latin"
                                                            style="font-size:40px;">Rsvp</div>
                                                        <div class="editable animate__animated animate__fadeInDown animate__slower"
                                                            style="font-size:14.4px;">Mr./Ms./Mrs.</div>

                                                        <div class="editable mb-4 animate__animated animate__fadeInDown animate__slower"
                                                            style="font-size:14.4px;">Tap button bellow for confirm
                                                            attendance</div>
                                                        <div class="mx-auto mb-4 countdown-wrapper d-flex flex-column animate__animated animate__fadeInDown animate__slower"
                                                            data-datetime="{{ $event['date_iso'] }}T{{ $event['time'] }}" style="max-width:320px;">
                                                            <div class="countdown text-center">
                                                                <div class="countdown-item day">
                                                                    <div class="number">00</div>
                                                                    <div class="text editable">Hari</div>
                                                                </div>
                                                                <div class="countdown-item hour">
                                                                    <div class="number">00</div>
                                                                    <div class="text editable">Jam</div>
                                                                </div>
                                                                <div class="countdown-item minute">
                                                                    <div class="number">00</div>
                                                                    <div class="text editable">Menit</div>
                                                                </div>
                                                                <div class="countdown-item second">
                                                                    <div class="number">00</div>
                                                                    <div class="text editable">Detik</div>
                                                                </div>
                                                            </div>
                                                            <button
                                                                class="btn-countdown btn btn-sm btn-pilled btn-accent mt-2">Atur
                                                                Countdown</button>
                                                        </div>
                                                        <button
                                                            class="btn-rsvp btn btn-primary rounded-pill mb-4 animate__animated animate__heartBeat animate__slow animate__infinite infinite"
                                                            style="font-size: 14px;">Confirm Attendance</button>
                                                        <div class="editable mb-4 animate__animated animate__fadeInUp animate__slower"
                                                            style="font-size:14.4px;">Please confirm your
                                                            attendance<br />until 1st February 2024</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="satumomen_slide">
                                        <div class="container-mobile "
                                            style="background-image: url({{ $bg['cover'] ?? '/themes/boho-wedding/couple-secondary.jpg' }}); background-size: cover;">
                                            <div class="frame">
                                                <img class="frame-tr animate__animated animate__fadeInTopRight animate__slow"
                                                    src="/themes/boho-wedding/frame-tr.png" alt="frame"
                                                    style="width:40%">
                                                <img class="frame-bl animate__animated animate__fadeInBottomLeft animate__slow"
                                                    src="/themes/boho-wedding/frame-bl.png" alt="frame"
                                                    style="width:40%">
                                            </div>
                                            <div class="watermark d-flex flex-column" style="height:100%;">
                                                <div class="mt-auto" style="width:100%;">
                                                    <div class="text-center">

                                                        <div class="editable mb-3 animate__animated animate__fadeInDown animate__slower"
                                                            style="font-size:14px;">Thank you for celebrating with
                                                            us,<br />please enjoy on our special day!<br /></div>
                                                        <div class="editable font-italic animate__animated animate__fadeInDown animate__slow"
                                                            style="font-size:14px;">Best Regards</div>

                                                        <div class="editable h4 color-accent animate__animated animate__fadeInDown animate__slow font-latin"
                                                            style="font-size:30px;">{{ $couple['bride'] }} &amp; {{ $couple['groom'] }}</div>

                                                    </div>
                                                </div>
                                                <div class="watermark-placeholder text-center mb-auto mb-5 pb-5"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Ads for free version -->
                                    <!-- end Ads for free version -->
                                </ul>
                            </div>
                        </div>
                        <div id="smMenu" class="satumomen_menu">
                            <ul class="satumomen_menu_list">
                                <li class="satumomen_menu_item">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.144 20.782v-3.067c0-.777.632-1.408 1.414-1.413h2.875c.786 0 1.423.633 1.423 1.413v3.058c0 .674.548 1.222 1.227 1.227h1.96a3.46 3.46 0 0 0 2.444-1 3.41 3.41 0 0 0 1.013-2.422V9.866c0-.735-.328-1.431-.895-1.902l-6.662-5.29a3.115 3.115 0 0 0-3.958.071L3.467 7.963A2.474 2.474 0 0 0 2.5 9.867v8.703C2.5 20.464 4.047 22 5.956 22h1.916c.327.002.641-.125.873-.354.232-.228.363-.54.363-.864h.036Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span>Opening</span>
                                </li>
                                <li class="satumomen_menu_item">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity=".4"
                                            d="M11.776 21.837a36.258 36.258 0 0 1-6.328-4.957 12.668 12.668 0 0 1-3.03-4.805C1.278 8.535 2.603 4.49 6.3 3.288A6.282 6.282 0 0 1 12.007 4.3a6.291 6.291 0 0 1 5.706-1.012c3.697 1.201 5.03 5.247 3.893 8.787a12.67 12.67 0 0 1-3.013 4.805 36.58 36.58 0 0 1-6.328 4.957l-.25.163-.24-.163Z"
                                            fill="currentColor" />
                                        <path
                                            d="m12.01 22-.234-.163a36.316 36.316 0 0 1-6.337-4.957 12.667 12.667 0 0 1-3.048-4.805c-1.13-3.54.195-7.586 3.892-8.787a6.296 6.296 0 0 1 5.728 1.023V22ZM18.23 10a.719.719 0 0 1-.517-.278.818.818 0 0 1-.167-.592c.022-.702-.378-1.341-.994-1.59-.391-.107-.628-.53-.53-.948.093-.41.477-.666.864-.573a.384.384 0 0 1 .138.052c1.236.476 2.036 1.755 1.973 3.155a.808.808 0 0 1-.23.56.708.708 0 0 1-.537.213Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span>The Wedding</span>
                                </li>
                                <li class="satumomen_menu_item">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3 16.87V9.257h18v7.674C21 20.07 19.024 22 15.863 22H8.127C4.996 22 3 20.03 3 16.87Zm4.96-2.46a.822.822 0 0 1-.85-.799c0-.46.355-.84.81-.861.444 0 .81.351.82.8a.822.822 0 0 1-.78.86Zm4.06 0a.822.822 0 0 1-.85-.799c0-.46.356-.84.81-.861.445 0 .81.351.82.8a.822.822 0 0 1-.78.86Zm4.03 3.68a.847.847 0 0 1-.82-.85.831.831 0 0 1 .81-.849h.01c.465 0 .84.38.84.849 0 .47-.375.85-.84.85Zm-4.88-.85c.02.46.395.821.85.8a.821.821 0 0 0 .78-.859.817.817 0 0 0-.82-.801.855.855 0 0 0-.81.86Zm-4.07 0c.02.46.395.821.85.8a.821.821 0 0 0 .78-.859.817.817 0 0 0-.82-.801.855.855 0 0 0-.81.86Zm8.14-3.639c0-.46.356-.83.81-.84.445 0 .8.359.82.8a.82.82 0 0 1-.79.849.814.814 0 0 1-.84-.799v-.01Z"
                                            fill="currentColor" />
                                        <path opacity=".4"
                                            d="M3.003 9.257c.013-.587.063-1.752.156-2.127.474-2.11 2.084-3.45 4.386-3.64h8.911c2.282.2 3.912 1.55 4.386 3.64.092.365.142 1.539.155 2.127H3.003Z"
                                            fill="currentColor" />
                                        <path
                                            d="M8.305 6.59c.435 0 .76-.329.76-.77V2.771A.748.748 0 0 0 8.306 2c-.435 0-.76.33-.76.771V5.82c0 .441.325.77.76.77ZM15.695 6.59c.425 0 .76-.329.76-.77V2.771a.754.754 0 0 0-.76-.771c-.435 0-.76.33-.76.771V5.82c0 .441.325.77.76.77Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span>Event</span>
                                </li>
                                <li class="satumomen_menu_item">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.532 2.937a6.89 6.89 0 0 1 7.034.058C17.71 4.327 19.012 6.705 19 9.26c-.05 2.54-1.447 4.929-3.193 6.775a18.727 18.727 0 0 1-3.358 2.82 1.173 1.173 0 0 1-.408.144.82.82 0 0 1-.39-.119 18.515 18.515 0 0 1-4.839-4.547A9.28 9.28 0 0 1 5 9.134c-.001-2.562 1.347-4.928 3.532-6.197Zm1.262 7.258a2.378 2.378 0 0 0 2.198 1.497 2.339 2.339 0 0 0 1.683-.701c.446-.454.696-1.07.694-1.713a2.423 2.423 0 0 0-1.462-2.243 2.346 2.346 0 0 0-2.594.52 2.455 2.455 0 0 0-.519 2.64Z"
                                            fill="currentColor" />
                                        <ellipse opacity=".4" cx="12" cy="21" rx="5" ry="1" fill="currentColor" />
                                    </svg>
                                    <span>Maps</span>
                                </li>
                                <li class="satumomen_menu_item">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity=".4"
                                            d="M12.02 2C6.21 2 2 6.74 2 12c0 1.68.49 3.41 1.35 4.99.16.26.18.59.07.9l-.67 2.24c-.15.54.31.94.82.78l2.02-.6c.55-.18.98.05 1.491.36 1.46.86 3.279 1.3 4.919 1.3 4.96 0 10-3.83 10-10C22 6.65 17.7 2 12.02 2Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.98 13.29c-.71-.01-1.28-.58-1.28-1.29 0-.7.58-1.28 1.28-1.27.71 0 1.28.57 1.28 1.28 0 .7-.57 1.28-1.28 1.28Zm-4.61 0c-.7 0-1.28-.58-1.28-1.28 0-.71.57-1.28 1.28-1.28.71 0 1.28.57 1.28 1.28 0 .7-.57 1.27-1.28 1.28Zm7.94-1.28c0 .7.57 1.28 1.28 1.28.71 0 1.28-.58 1.28-1.28 0-.71-.57-1.28-1.28-1.28-.71 0-1.28.57-1.28 1.28Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span>RSVP</span>
                                </li>
                                <li class="satumomen_menu_item">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity=".4"
                                            d="M16.34 2H7.67C4.28 2 2 4.38 2 7.92v8.17C2 19.62 4.28 22 7.67 22h8.67c3.39 0 5.66-2.38 5.66-5.91V7.92C22 4.38 19.73 2 16.34 2Z"
                                            fill="currentColor" />
                                        <path
                                            d="M10.813 15.248a.872.872 0 0 1-.619-.256l-2.373-2.373a.874.874 0 1 1 1.237-1.238l1.755 1.755 4.128-4.128a.874.874 0 1 1 1.237 1.238l-4.746 4.746a.872.872 0 0 1-.619.256Z"
                                            fill="currentColor" />
                                    </svg>
                                    <span>Thanks</span>
                                </li>
                                <!-- Ads for free version -->
                                <!-- end Ads for free version -->
                            </ul>
                        </div>
                        <!-- end invitation -->
                        <div class="floating-action d-flex align-items-end flex-column">
                            <a href="/chat?text=Saya+mau+order+undangan+digital+tema+Boho+Wedding"
                                title="Pesan Tema Ini" target="_blank" rel="noopener noreferrer"
                                class="btn btn-float bg-success border-success text-white" style="z-index: 99">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" focusable="false" width="1.5rem" height="1.5rem"
                                    style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967c-.273-.099-.471-.148-.67.15c-.197.297-.767.966-.94 1.164c-.173.199-.347.223-.644.075c-.297-.15-1.255-.463-2.39-1.475c-.883-.788-1.48-1.761-1.653-2.059c-.173-.297-.018-.458.13-.606c.134-.133.298-.347.446-.52c.149-.174.198-.298.298-.497c.099-.198.05-.371-.025-.52c-.075-.149-.669-1.612-.916-2.207c-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372c-.272.297-1.04 1.016-1.04 2.479c0 1.462 1.065 2.875 1.213 3.074c.149.198 2.096 3.2 5.077 4.487c.709.306 1.262.489 1.694.625c.712.227 1.36.195 1.871.118c.571-.085 1.758-.719 2.006-1.413c.248-.694.248-1.289.173-1.413c-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214l-3.741.982l.998-3.648l-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884c2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"
                                        fill="currentColor"></path>
                                    <rect x="0" y="0" width="24" height="24" fill="rgba(0, 0, 0, 0)"></rect>
                                </svg>
                            </a>
                            <button id="btnQrModal"
                                onclick="showModal(qrModal)"
                                class="btn btn-float " >
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <rect x="40" y="40" width="80" height="80" rx="16"></rect>
                                    <rect x="40" y="136" width="80" height="80" rx="16"></rect>
                                    <rect x="136" y="40" width="80" height="80" rx="16"></rect>
                                    <path d="M144,184a8,8,0,0,0,8-8V144a8,8,0,0,0-16,0v32A8,8,0,0,0,144,184Z"></path>
                                    <path
                                        d="M208,152H184v-8a8,8,0,0,0-16,0v56H144a8,8,0,0,0,0,16h32a8,8,0,0,0,8-8V168h24a8,8,0,0,0,0-16Z">
                                    </path>
                                    <path d="M208,184a8,8,0,0,0-8,8v16a8,8,0,0,0,16,0V192A8,8,0,0,0,208,184Z"></path>
                                </svg>
                            </button>
                            <button id="btnMusic" onclick="playMusic()"
                                class="btn btn-float " >
                                <svg class="play" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M184,152V104a8,8,0,0,1,16,0v48a8,8,0,0,1-16,0Zm40-72a8,8,0,0,0-8,8v80a8,8,0,0,0,16,0V88A8,8,0,0,0,224,80ZM53.92,34.62A8,8,0,1,0,42.08,45.38L73.55,80H32A16,16,0,0,0,16,96v64a16,16,0,0,0,16,16H77.25l69.84,54.31A8,8,0,0,0,160,224V175.09l42.08,46.29a8,8,0,1,0,11.84-10.76Zm92.16,77.59A8,8,0,0,0,160,106.83V32a8,8,0,0,0-12.91-6.31l-39.85,31a8,8,0,0,0-1,11.7Z">
                                    </path>
                                </svg>
                                <svg class="pause" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M160,32V224a8,8,0,0,1-12.91,6.31L77.25,176H32a16,16,0,0,1-16-16V96A16,16,0,0,1,32,80H77.25l69.84-54.31A8,8,0,0,1,160,32Zm32,64a8,8,0,0,0-8,8v48a8,8,0,0,0,16,0V104A8,8,0,0,0,192,96Zm32-16a8,8,0,0,0-8,8v80a8,8,0,0,0,16,0V88A8,8,0,0,0,224,80Z">
                                    </path>
                                </svg>
                            </button>
                            <button id="btnAutoplay" class="btn btn-float ">
                                <svg class="play" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M128,24A104,104,0,1,0,232,128,104.13,104.13,0,0,0,128,24Zm36.44,110.66-48,32A8.05,8.05,0,0,1,112,168a8,8,0,0,1-8-8V96a8,8,0,0,1,12.44-6.66l48,32a8,8,0,0,1,0,13.32Z">
                                    </path>
                                </svg>
                                <svg class="pause" xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M128,24A104,104,0,1,0,232,128,104.13,104.13,0,0,0,128,24ZM112,160a8,8,0,0,1-16,0V96a8,8,0,0,1,16,0Zm48,0a8,8,0,0,1-16,0V96a8,8,0,0,1,16,0Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- lightbox -->
        <div id="lightboxWrapper" class="lightbox-wrapper">
            <div class="lightbox-list"></div>
            <a href="#" id="lightboxCloseBtn" class="btn-lightbox">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 0 1-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 0 1-1.414-1.414L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            <div class="lightbox-navigation">
                <a href="#" id="lightboxPrevBtn" class="lightbox-arrow" data-index="0">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                </a>
                <a href="#" id="lightboxNextBtn" class="lightbox-arrow" data-index="0">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        <!-- end lightbox -->
        <!-- startQRModal -->
        <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="height:100%">
                    <div
                        style="width: 100%;aspect-ratio: 16/9; background-size:cover; background-position: center; background-image: url(/images/no-image.jpg);">
                    </div>
                    <div class="text-center py-4 px-4">
                        <div>
                            <div class="mx-auto">
                                <?xml version="1.0" encoding="UTF-8"?>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="180" height="180"
                                    viewBox="0 0 180 180">
                                    <rect x="0" y="0" width="180" height="180" fill="#ffffff" />
                                    <g transform="scale(7.2)">
                                        <g transform="translate(0,0)">
                                            <path fill-rule="evenodd"
                                                d="M8 0L8 1L9 1L9 2L10 2L10 3L11 3L11 1L13 1L13 0L11 0L11 1L9 1L9 0ZM14 0L14 1L15 1L15 0ZM16 0L16 1L17 1L17 0ZM12 2L12 4L11 4L11 5L10 5L10 4L9 4L9 5L10 5L10 8L9 8L9 6L8 6L8 8L9 8L9 10L8 10L8 11L7 11L7 10L6 10L6 11L5 11L5 8L3 8L3 9L4 9L4 12L5 12L5 13L3 13L3 10L2 10L2 8L0 8L0 11L1 11L1 12L0 12L0 17L1 17L1 15L3 15L3 16L2 16L2 17L7 17L7 16L6 16L6 15L8 15L8 18L9 18L9 20L8 20L8 22L9 22L9 20L10 20L10 23L8 23L8 25L9 25L9 24L10 24L10 23L11 23L11 20L10 20L10 19L12 19L12 21L14 21L14 24L13 24L13 25L15 25L15 22L16 22L16 23L17 23L17 22L19 22L19 21L21 21L21 16L22 16L22 18L24 18L24 19L23 19L23 22L20 22L20 23L18 23L18 25L19 25L19 24L21 24L21 25L22 25L22 24L24 24L24 25L25 25L25 18L24 18L24 16L25 16L25 14L24 14L24 13L25 13L25 10L24 10L24 9L25 9L25 8L24 8L24 9L19 9L19 8L18 8L18 9L19 9L19 10L16 10L16 9L17 9L17 6L16 6L16 8L14 8L14 7L15 7L15 6L14 6L14 5L15 5L15 4L16 4L16 5L17 5L17 3L15 3L15 4L14 4L14 2ZM12 4L12 5L11 5L11 7L12 7L12 9L10 9L10 10L9 10L9 11L10 11L10 10L12 10L12 11L13 11L13 13L11 13L11 12L10 12L10 13L9 13L9 14L8 14L8 12L7 12L7 11L6 11L6 12L7 12L7 13L6 13L6 14L3 14L3 15L4 15L4 16L5 16L5 15L6 15L6 14L8 14L8 15L9 15L9 14L10 14L10 15L11 15L11 14L14 14L14 13L16 13L16 12L17 12L17 13L18 13L18 14L19 14L19 15L20 15L20 16L21 16L21 15L20 15L20 13L21 13L21 14L23 14L23 13L24 13L24 12L21 12L21 10L20 10L20 11L19 11L19 13L18 13L18 11L15 11L15 10L14 10L14 11L13 11L13 10L12 10L12 9L14 9L14 8L13 8L13 7L14 7L14 6L13 6L13 7L12 7L12 5L14 5L14 4ZM6 8L6 9L7 9L7 8ZM22 10L22 11L24 11L24 10ZM14 11L14 12L15 12L15 11ZM1 13L1 14L2 14L2 13ZM16 14L16 16L15 16L15 15L12 15L12 16L9 16L9 17L14 17L14 18L12 18L12 19L13 19L13 20L14 20L14 19L16 19L16 16L18 16L18 15L17 15L17 14ZM23 15L23 16L24 16L24 15ZM14 16L14 17L15 17L15 16ZM17 17L17 20L20 20L20 17ZM18 18L18 19L19 19L19 18ZM12 22L12 23L13 23L13 22ZM21 23L21 24L22 24L22 23ZM16 24L16 25L17 25L17 24ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM18 0L18 7L25 7L25 0ZM19 1L19 6L24 6L24 1ZM20 2L20 5L23 5L23 2ZM0 18L0 25L7 25L7 18ZM1 19L1 24L6 24L6 19ZM2 20L2 23L5 23L5 20Z"
                                                fill="#000000" />
                                        </g>
                                    </g>
                                </svg>

                                <div style="margin-top: 10px; text-align: center"></div>
                            </div>
                        </div>
                        <hr
                            style="margin-top: 1rem; margin-bottom: 1rem; border: 0; border-top: 2px dashed rgba(0,0,0,.1);">
                        <div style="margin-bottom: 10px">
                            <div style="color: #b2b2b2;">Nama</div>
                            <div>Nama Tamu</div>
                        </div>
                        <div style="margin-bottom: 10px">
                            <div style="color: #b2b2b2;">Grup</div>
                            <div>VIP</div>
                        </div>
                    </div>
                    <button onclick="closeModal(qrModal)" type="button"
                        class="btn btn-close" ><svg
                            xmlns="http://www.w3.org/2000/svg" height="42px" width="42px" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 18 6M6 6l12 12" />
                        </svg></button>
                </div>
            </div>
        </div>
        <!-- endQRModal -->
        <!-- startRSVPModal -->
        <div class="modal fade" id="rsvpModal" tabindex="-1" role="dialog" aria-labelledby="rsvpModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4" style="height:100%">
                    <!-- rsvp form -->
                    <rsvp-component
                        :lang="{&quot;invitation_code&quot;:&quot;Kode Undangan&quot;,&quot;validate_code&quot;:&quot;Validasi Kode Undangan&quot;,&quot;name&quot;:&quot;Nama&quot;,&quot;group_name&quot;:&quot;Nama Grup&quot;,&quot;phone&quot;:&quot;No Hp \/ WhatsApp&quot;,&quot;attendance&quot;:&quot;Kehadiran?&quot;,&quot;yes&quot;:&quot;Hadir&quot;,&quot;no&quot;:&quot;Tidak Hadir&quot;,&quot;guest&quot;:&quot;Orang&quot;,&quot;guest_count&quot;:&quot;Jumlah Tamu&quot;,&quot;comment&quot;:&quot;Komentar atau Ucapan&quot;,&quot;send&quot;:&quot;Kirim&quot;,&quot;update&quot;:&quot;Kirim&quot;,&quot;captcha_placeholder&quot;:&quot;Ketik Text&quot;}"
                        :invitation_id="143221" name="{{ request()->get('kpd', 'Tamu Undangan') }}" code="" :replace="false" overlay="1"></rsvp-component>
                    <!-- rsvp form -->
                    <button onclick="closeModal(rsvpModal)"
                        type="button" class="btn btn-close" ><svg
                            xmlns="http://www.w3.org/2000/svg" height="42px" width="42px" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18 18 6M6 6l12 12" />
                        </svg></button>
                </div>
            </div>
        </div>
        <!-- endRSVPModal -->
        <div id="waterMark" class="mt-5" style="display: none">
            <div class="wm-music mt-3 text-center animate__animated animate__fadeInUp animate__slower animate__delay-1s"
                style="font-size: 60%">
                <div style="opacity: 0.5"><strong>Music:</strong></div>
                <div style="opacity: 0.5">Every Day I Love You - Boyzone (Piano Cover by Riyandi Kusuma)</div>
            </div>
        </div>
    </main>
    <!-- illegal -->
    <div id="illegal" class="container-mobile"
        style="background: #ffffff; z-index: 9999; min-height: 100vh; display: flex; justify-content: center; align-items: center; display: none">
        <div class="modal-body modal-body d-flex flex-column align-items-center">
            <div class="mb-4 text-center">
                <svg width="90" height="90" fill="none">
                    <path d="M36 28.024A18.05 18.05 0 0025.022 39M59.999 28.024A18.05 18.05 0 0170.975 39"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <ellipse cx="37.5" cy="43.5" rx="4.5" ry="7.5" fill="currentColor"></ellipse>
                    <ellipse cx="58.5" cy="43.5" rx="4.5" ry="7.5" fill="currentColor"></ellipse>
                    <path
                        d="M24.673 75.42a9.003 9.003 0 008.879 5.563m-8.88-5.562A8.973 8.973 0 0124 72c0-7.97 9-18 9-18s9 10.03 9 18a9 9 0 01-8.448 8.983m-8.88-5.562C16.919 68.817 12 58.983 12 48c0-19.882 16.118-36 36-36s36 16.118 36 36-16.118 36-36 36a35.877 35.877 0 01-14.448-3.017"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M41.997 71.75A14.94 14.94 0 0148 70.5c2.399 0 4.658.56 6.661 1.556a3 3 0 003.999-4.066 12 12 0 00-10.662-6.49 11.955 11.955 0 00-7.974 3.032c1.11 2.37 1.917 4.876 1.972 7.217z"
                        fill="currentColor"></path>
                </svg>
                <h2 class="mb-3">Jangan Bikin Aku Sedih</h2>
                <p>Kamu didapati mencoba menghapus watermark secara ilegal.</p>
            </div>
        </div>
    </div>
    <!-- end illegal -->

    <!-- not support modal -->
    <div class="modal fade" id="notSupport" tabindex="-1" role="dialog" aria-labelledby="notSupport" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: .8rem;">
                <div class="modal-body text-center justify-content-center align-items-center">
                    <h2>Pemberitahuan</h2>
                    <p>Browser yang kamu gunakan mungkin kurang kompatibel. Beberapa fungsi undangan ini mungkin tidak
                        dapat berjalan dengan baik. Kami merekomendasikan Chrome. Klik tombol dibawah ini untuk
                        mendownload.</p>
                    <div class="d-flex justify-content-center">
                        <a href="https://apps.apple.com/id/app/google-chrome/id535886823" class="btn p-1"
                            target="_BLANK">
                            <img src="/images/btn_app_store.png" alt="AppStore" height="40px">
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.android.chrome&hl=in&gl=US"
                            class="btn p-1" target="_BLANK">
                            <img src="/images/btn_play_store.png" alt="PlayStore" height="40px">
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-block rounded-pill"
                        onclick="closeModal(notSupport)"
                        >Tetap Akses</button>
                </div>
            </div>
        </div>
    </div>
    <!-- not support modal -->

    <!-- start script -->

    <script src="/themes/theme-app.js?v=160426" type="text/javascript"></script>


    <script src="/themes/themesv2.js?v=160426" type="text/javascript"></script>

    <script type="text/javascript">
        var notSupport = document.getElementById('notSupport');
        function checkBrowser() { 
            if(navigator.userAgent.indexOf("UCBrowser") != -1 || navigator.userAgent.indexOf("MiuiBrowser") != -1 || navigator.userAgent.indexOf("OppoBrowser") != -1) {
                showModal(notSupport);
                if (loader) {
                    loader.style.display = "none";
                }
            }
        }
        checkBrowser()
    </script>
    <!-- end script -->
    <script type="text/javascript">

    </script>
    
    
    
</body>

</html>