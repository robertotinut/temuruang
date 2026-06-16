@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Arjuna Putra Pratama');
        $brideName = trim($names[1] ?? 'Srikandi Larasati');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Suherman & Ibu Ratna',
                'bride' => 'Bapak Wijaya & Ibu Sari',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2024-12-12',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Masjid Raya Al-Jabbar',
            'address' => $invitation->address ?? 'Bandung, Jawa Barat',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Masjid Raya Al-Jabbar Bandung'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Masjid Raya Al-Jabbar, Bandung'
            ],
            [
                'title' => 'Resepsi',
                'time' => '11:00 - 14:00 WIB',
                'note' => $invitation->address ?? 'Grand Ballroom Hilton, Bandung'
            ]
        ];

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                asset('assets/templates/wedding-15/images/image_4.jpg'),
                asset('assets/templates/wedding-15/images/image_5.jpg'),
                asset('assets/templates/wedding-15/images/image_6.jpg'),
                asset('assets/templates/wedding-15/images/image_7.jpg'),
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : asset('assets/templates/wedding-15/images/image_1.jpg');
        $bg = [
            'cover' => $coverUrl,
            'groom' => asset('assets/templates/wedding-15/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-15/images/image_3.jpg'),
        ];
    } else {
        $couple = [
            'groom' => 'Arjuna Putra Pratama',
            'bride' => 'Srikandi Larasati',
            'parents' => [
                'groom' => 'Bapak Suherman & Ibu Ratna',
                'bride' => 'Bapak Wijaya & Ibu Sari',
            ],
        ];

        $event = [
            'date_iso' => '2024-12-12',
            'time' => '08:00',
            'location' => 'Masjid Raya Al-Jabbar',
            'address' => 'Bandung, Jawa Barat',
            'maps_url' => 'https://maps.google.com/?q=Masjid+Raya+Al-Jabbar+Bandung',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00 WIB', 'note' => 'Masjid Raya Al-Jabbar, Bandung'],
            ['title' => 'Resepsi', 'time' => '11:00 - 14:00 WIB', 'note' => 'Grand Ballroom Hilton, Bandung'],
        ];

        $gallery = [
            asset('assets/templates/wedding-15/images/image_4.jpg'),
            asset('assets/templates/wedding-15/images/image_5.jpg'),
            asset('assets/templates/wedding-15/images/image_6.jpg'),
            asset('assets/templates/wedding-15/images/image_7.jpg'),
        ];

        $bg = [
            'cover' => asset('assets/templates/wedding-15/images/image_1.jpg'),
            'groom' => asset('assets/templates/wedding-15/images/image_2.jpg'),
            'bride' => asset('assets/templates/wedding-15/images/image_3.jpg'),
        ];
    }
@endphp
<!DOCTYPE html>
<html class="dark scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>{{ $couple['bride'] }} &amp; {{ $couple['groom'] }} | Siger Noir Wedding</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,700;0,800;1,400&amp;family=Outfit:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            background-color: #1d100e;
            color: #f7ddd8;
            overflow-x: hidden;
        }
        body.is-locked {
            overflow: hidden;
            height: 100vh;
        }
        .batik-overlay {
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
            opacity: 0.05;
        }
        .text-glow-gold {
            text-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
        }
        .glass-card {
            background: rgba(128, 0, 0, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-anim { animation: floating 4s ease-in-out infinite; }
        
        #mobile-menu {
            position: fixed;
            top: 0;
            bottom: 0;
            width: 100%;
            max-width: 480px;
            left: 50%;
            transform: translateX(100%);
            z-index: 60;
            transition: transform 0.5s ease-in-out;
        }
        #mobile-menu.open {
            transform: translateX(-50%);
        }
    </style>
</head>
<body class="bg-background text-on-surface selection:bg-siger-gold selection:text-ink-black max-w-[480px] w-full mx-auto relative shadow-2xl border-x border-siger-gold/10 min-h-screen is-locked">

    <!-- 1. Cover Section -->
    <section class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] flex items-center justify-center overflow-hidden" id="cover">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover brightness-[0.3]" src="{{ $bg['cover'] }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
            <div class="absolute inset-0 batik-overlay"></div>
        </div>
        <div class="relative z-10 text-center px-margin-mobile flex flex-col items-center justify-center">
            <div class="flex justify-center mb-8 float-anim">
                <span class="material-symbols-outlined text-siger-gold !text-6xl" style="font-variation-settings: 'FILL' 1;">crown</span>
            </div>
            <p class="font-label-caps text-label-caps text-siger-gold tracking-[0.3em] uppercase mb-4">The Wedding of</p>
            <h1 class="font-display-hero-mobile text-display-hero-mobile text-off-white mb-2 leading-none">
                {{ $couple['groom'] }} &amp; {{ $couple['bride'] }}
            </h1>
            <p class="font-headline-md text-headline-md text-siger-gold mb-12 italic">
                {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d . m . Y') }}
            </p>
            
            <div class="mb-10 w-full max-w-xs p-6 glass-card rounded-xl">
                <p class="font-body-md text-on-surface-variant mb-2 italic text-xs">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                <h3 class="font-headline-md text-siger-gold border-b border-siger-gold/20 pb-2 text-lg">
                    {{ request()->get('kpd', 'Tamu Undangan') }}
                </h3>
            </div>

            <button class="inline-block bg-siger-gold text-ink-black px-12 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-off-white transition-all transform hover:-translate-y-1" id="btn-open-invitation" onclick="openInvitation()">
                Buka Undangan
            </button>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <div id="main-content" style="display: none;">
        <!-- Top Navigation -->
        <nav class="fixed top-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-50 bg-surface/80 backdrop-blur-xl border-b border-siger-gold/20 flex justify-between items-center px-margin-mobile py-4 transition-all duration-500 opacity-0" id="top-nav">
            <div class="font-headline-md text-headline-md text-siger-gold tracking-widest uppercase">Siger Noir</div>
            <button class="text-siger-gold" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </nav>

        <!-- Mobile Menu Overlay -->
        <div class="bg-ink-black flex flex-col items-center justify-center gap-8" id="mobile-menu">
            <button class="absolute top-6 right-6 text-siger-gold" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">close</span>
            </button>
            <a class="font-display-hero-mobile text-display-hero-mobile text-siger-gold" href="#mempelai" onclick="toggleMobileMenu()">Mempelai</a>
            <a class="font-display-hero-mobile text-display-hero-mobile text-siger-gold" href="#acara" onclick="toggleMobileMenu()">Acara</a>
            <a class="font-display-hero-mobile text-display-hero-mobile text-siger-gold" href="#cerita" onclick="toggleMobileMenu()">Cerita</a>
            <a class="font-display-hero-mobile text-display-hero-mobile text-siger-gold" href="#kado" onclick="toggleMobileMenu()">Kirim Kado</a>
        </div>

        <!-- Hero Section -->
        <section class="relative h-[80vh] w-full flex items-center justify-center overflow-hidden pt-20" id="home">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover brightness-[0.3]" src="{{ $bg['cover'] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-transparent"></div>
                <div class="absolute inset-0 batik-overlay"></div>
            </div>
            <div class="relative z-10 text-center px-margin-mobile">
                <span class="section-subtitle">Save The Date</span>
                <h2 class="font-display-hero-mobile text-off-white my-4">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</h2>
                <div class="script-divider">The Wedding Ceremony</div>
                <h4 style="font-family: var(--font-serif); font-size: 1rem; font-weight: 400; margin-top: 15px;">
                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d.m.y') }}
                </h4>
            </div>
        </section>

        <!-- 2. Profile Section -->
        <section class="py-section-gap relative overflow-hidden bg-ink-black" id="mempelai">
            <div class="absolute top-0 right-0 w-1/3 h-full batik-overlay -z-10"></div>
            <div class="container mx-auto px-margin-mobile">
                <div class="flex flex-col gap-16 items-center">
                    <!-- Groom -->
                    <div class="w-full text-center">
                        <div class="relative mb-10 inline-block">
                            <img class="w-64 h-80 object-cover grayscale brightness-75 hover:grayscale-0 transition-all duration-700 mx-auto" src="{{ $bg['groom'] }}"/>
                            <div class="absolute -top-4 -right-4 w-full h-full border-2 border-siger-gold -z-10"></div>
                        </div>
                        <h2 class="font-headline-lg-mobile text-siger-gold mb-2">{{ $couple['groom'] }}</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant italic mb-6">Putra dari {{ $couple['parents']['groom'] }}</p>
                        <a class="text-siger-gold flex items-center justify-center gap-2 hover:underline" href="#">
                            <span class="font-label-caps text-label-caps uppercase">@arjunapp</span>
                            <span class="material-symbols-outlined !text-sm">open_in_new</span>
                        </a>
                    </div>
                    
                    <div class="py-4">
                        <span class="font-display-hero-mobile text-headline-lg text-siger-gold/30 italic">&amp;</span>
                    </div>
                    
                    <!-- Bride -->
                    <div class="w-full text-center">
                        <div class="relative mb-10 inline-block">
                            <img class="w-64 h-80 object-cover grayscale brightness-75 hover:grayscale-0 transition-all duration-700 mx-auto" src="{{ $bg['bride'] }}"/>
                            <div class="absolute -bottom-4 -left-4 w-full h-full border-2 border-siger-gold -z-10"></div>
                        </div>
                        <h2 class="font-headline-lg-mobile text-siger-gold mb-2">{{ $couple['bride'] }}</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant italic mb-6">Putri dari {{ $couple['parents']['bride'] }}</p>
                        <a class="text-siger-gold flex items-center justify-center gap-2 hover:underline" href="#">
                            <span class="material-symbols-outlined !text-sm">open_in_new</span>
                            <span class="font-label-caps text-label-caps uppercase">@srikandi_ls</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Event & Countdown Section -->
        <section class="py-section-gap bg-deep-maroon relative" id="acara">
            <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                <span class="material-symbols-outlined absolute -top-10 -left-10 !text-[300px] text-white rotate-12">admin</span>
                <span class="material-symbols-outlined absolute -bottom-10 -right-10 !text-[300px] text-white -rotate-12">admin</span>
            </div>
            <div class="container mx-auto px-margin-mobile relative z-10">
                <div class="text-center mb-16">
                    <p class="font-label-caps text-label-caps text-off-white/70 uppercase tracking-[0.4em] mb-4">The Big Day</p>
                    <h2 class="font-display-hero-mobile text-off-white text-center">Save the Date</h2>
                </div>
                
                <!-- Countdown -->
                <div class="flex justify-center gap-3 mb-24">
                    <div class="glass-card p-4 w-20 text-center">
                        <span class="block font-headline-lg-mobile text-siger-gold" id="days">00</span>
                        <span class="font-label-caps text-[9px] uppercase text-off-white">Hari</span>
                    </div>
                    <div class="glass-card p-4 w-20 text-center">
                        <span class="block font-headline-lg-mobile text-siger-gold" id="hours">00</span>
                        <span class="font-label-caps text-[9px] uppercase text-off-white">Jam</span>
                    </div>
                    <div class="glass-card p-4 w-20 text-center">
                        <span class="block font-headline-lg-mobile text-siger-gold" id="minutes">00</span>
                        <span class="font-label-caps text-[9px] uppercase text-off-white">Menit</span>
                    </div>
                    <div class="glass-card p-4 w-20 text-center">
                        <span class="block font-headline-lg-mobile text-siger-gold" id="seconds">00</span>
                        <span class="font-label-caps text-[9px] uppercase text-off-white">Detik</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-12">
                    <!-- Akad -->
                    <div class="bg-ink-black/40 p-8 border border-siger-gold/30 hover:border-siger-gold transition-colors group text-center">
                        <h3 class="font-headline-md text-siger-gold mb-6 border-b border-siger-gold/20 pb-4">{{ $schedule[0]['title'] }}</h3>
                        <div class="space-y-4 font-body-md text-on-surface text-sm">
                            <div class="flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-siger-gold">calendar_today</span>
                                <p>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            </div>
                            <div class="flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-siger-gold">schedule</span>
                                <p>Tabuh {{ $schedule[0]['time'] }}</p>
                            </div>
                            <div class="flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-siger-gold">location_on</span>
                                <p>{{ $schedule[0]['note'] }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Resepsi -->
                    <div class="bg-ink-black/40 p-8 border border-siger-gold/30 hover:border-siger-gold transition-colors group text-center">
                        <h3 class="font-headline-md text-siger-gold mb-6 border-b border-siger-gold/20 pb-4">{{ $schedule[1]['title'] }}</h3>
                        <div class="space-y-4 font-body-md text-on-surface text-sm">
                            <div class="flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-siger-gold">calendar_today</span>
                                <p>{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            </div>
                            <div class="flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-siger-gold">schedule</span>
                                <p>Tabuh {{ $schedule[1]['time'] }}</p>
                            </div>
                            <div class="flex items-center justify-center gap-3">
                                <span class="material-symbols-outlined text-siger-gold">location_on</span>
                                <p>{{ $schedule[1]['note'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-16 text-center">
                    <a class="inline-flex items-center justify-center gap-4 bg-siger-gold text-ink-black px-10 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-off-white transition-all w-full text-xs" href="{{ $event['maps_url'] }}" target="_blank">
                        <span class="material-symbols-outlined">map</span>
                        Buka Google Maps
                    </a>
                </div>
            </div>
        </section>

        <!-- 4. Gallery, RSVP & Gift Section -->
        <section class="py-section-gap bg-background" id="cerita">
            <div class="container mx-auto px-margin-mobile">
                <div class="mb-24">
                    <h2 class="font-headline-lg-mobile text-siger-gold mb-12 text-center">Gallery Moments</h2>
                    
                    <div class="grid grid-cols-2 gap-4 auto-rows-[160px]">
                        @foreach ($gallery as $index => $img)
                        @php
                            $span = '';
                            if ($index == 0) $span = 'col-span-2 row-span-2';
                            elseif ($index == 3) $span = 'col-span-2';
                        @endphp
                        <div class="overflow-hidden rounded-xl hover:scale-105 transition-all duration-500 shadow-md cursor-zoom-in {{ $span }}" onclick="openLightbox('{{ $img }}')">
                            <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="{{ $img }}" alt="Gallery Image {{ $index+1 }}"/>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- RSVP Form & Gift -->
                <div class="flex flex-col gap-20">
                    <div id="rsvp">
                        <h2 class="font-headline-lg-mobile text-siger-gold mb-8 text-center">Konfirmasi Kehadiran</h2>
                        <form class="space-y-8 glass-card p-8 rounded-2xl" id="rsvp-form" onsubmit="submitRsvp(event)">
                            <div>
                                <label class="block font-label-caps text-[10px] text-siger-gold uppercase mb-2">Nama Lengkap</label>
                                <input id="nama" class="w-full bg-transparent border-0 border-b border-siger-gold/30 focus:ring-0 focus:border-siger-gold text-on-surface p-2 text-sm" placeholder="Masukkan nama Anda" type="text" required/>
                            </div>
                            <div>
                                <label class="block font-label-caps text-[10px] text-siger-gold uppercase mb-2">Kehadiran</label>
                                <select id="kehadiran" class="w-full bg-transparent border-0 border-b border-siger-gold/30 focus:ring-0 focus:border-siger-gold text-on-surface p-2 text-sm">
                                    <option class="bg-background text-on-surface" value="Hadir">Hadir</option>
                                    <option class="bg-background text-on-surface" value="Tidak Hadir">Berhalangan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-label-caps text-[10px] text-siger-gold uppercase mb-2">Pesan Untuk Mempelai</label>
                                <textarea id="pesan" class="w-full bg-transparent border-0 border-b border-siger-gold/30 focus:ring-0 focus:border-siger-gold text-on-surface p-2 text-sm" placeholder="Tuliskan harapan dan doa..." rows="4" required></textarea>
                            </div>
                            <button class="w-full bg-siger-gold text-ink-black py-4 font-label-caps text-xs uppercase tracking-[0.2em] hover:bg-off-white transition-all rounded-full" type="submit">Kirim Reservasi</button>
                        </form>
                        
                        <div class="mt-8">
                            <div id="wishList" class="bg-ink-black/50 rounded-2xl p-6 overflow-y-auto max-h-[350px] border border-siger-gold/20 space-y-4">
                                <div class="bg-surface-container-low p-5 rounded-xl border border-siger-gold/10">
                                    <p class="font-body-md text-siger-gold font-semibold text-sm">Fajar (Hadir)</p>
                                    <p class="text-xs text-on-surface-variant italic mt-1">"Lancar jaya berkah melimpah sakinah warahmah selamanya!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Digital Gift -->
                    <div id="kado">
                        <h2 class="font-headline-lg-mobile text-siger-gold mb-8 text-center">Kirim Kado</h2>
                        <p class="font-body-md text-on-surface-variant mb-10 italic text-center text-sm">Tanpa mengurangi rasa hormat, bagi Bapak/Ibu/Rekan yang ingin mengirimkan hadiah tanda kasih, dapat melalui nomor rekening di bawah ini:</p>
                        
                        @if(isset($invitation) && isset($invitation->bankAccounts) && $invitation->bankAccounts->count() > 0)
                            <div class="space-y-6">
                                @foreach($invitation->bankAccounts as $bank)
                                <div class="bg-ink-black border border-siger-gold/20 p-8 flex justify-between items-center group hover:border-siger-gold transition-all">
                                    <div>
                                        <p class="font-label-caps text-label-caps text-siger-gold uppercase mb-1">{{ strtoupper($bank->bank_name) }}</p>
                                        <p class="font-headline-md text-off-white tracking-wider text-lg">{{ $bank->account_number }}</p>
                                        <p class="font-body-md text-on-surface-variant text-xs">a.n {{ strtoupper($bank->account_name) }}</p>
                                    </div>
                                    <button class="text-siger-gold hover:scale-110 transition-transform" onclick="copyAccount('{{ $bank->account_number }}', this)">
                                        <span class="material-symbols-outlined">content_copy</span>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="space-y-6">
                                <div class="bg-ink-black border border-siger-gold/20 p-8 flex justify-between items-center group hover:border-siger-gold transition-all">
                                    <div>
                                        <p class="font-label-caps text-label-caps text-siger-gold uppercase mb-1">Bank BCA</p>
                                        <p class="font-headline-md text-off-white tracking-wider text-lg">8801 234 567</p>
                                        <p class="font-body-md text-on-surface-variant text-xs">a.n Arjuna Putra Pratama</p>
                                    </div>
                                    <button class="text-siger-gold hover:scale-110 transition-transform" onclick="copyAccount('8801 234 567', this)">
                                        <span class="material-symbols-outlined">content_copy</span>
                                    </button>
                                </div>
                                <div class="bg-ink-black border border-siger-gold/20 p-8 flex justify-between items-center group hover:border-siger-gold transition-all">
                                    <div>
                                        <p class="font-label-caps text-label-caps text-siger-gold uppercase mb-1">Bank Mandiri</p>
                                        <p class="font-headline-md text-off-white tracking-wider text-lg">123 00 0123 4567</p>
                                        <p class="font-body-md text-on-surface-variant text-xs">a.n Srikandi Larasati</p>
                                    </div>
                                    <button class="text-siger-gold hover:scale-110 transition-transform" onclick="copyAccount('123 00 0123 4567', this)">
                                        <span class="material-symbols-outlined">content_copy</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-ink-black py-section-gap relative overflow-hidden text-center flex flex-col items-center">
            <div class="container mx-auto px-margin-mobile text-center flex flex-col items-center">
                <div class="mb-12">
                    <span class="material-symbols-outlined text-siger-gold !text-6xl" style="font-variation-settings: 'FILL' 1;">favorite</span>
                </div>
                <h2 class="font-display-hero-mobile text-siger-gold leading-none mb-8">Hatur Nuhun</h2>
                <div class="w-32 h-px bg-siger-gold mb-12"></div>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto mb-20 italic text-sm">
                    "Kasep eta mah bawaan orok, pinter mah kudu diajar, soleh mah kudu dibiasakeun. Mugia urang sadaya aya dina lindungan Allah SWT."
                </p>
                <p class="font-label-caps text-label-caps text-siger-gold/50 uppercase tracking-widest text-[10px]">
                    © 2024 Siger Noir Wedding. All Rights Reserved.
                </p>
            </div>
            <!-- Decorative Line Cutting through -->
            <div class="absolute top-1/2 left-0 w-full h-px bg-siger-gold/10 -z-10 rotate-12"></div>
        </footer>
        
        <!-- Spacer for bottom menu -->
        <div class="h-28"></div>
    </div>

    <!-- Bottom Navigation Bar (Mobile & Desktop Centered) -->
    <nav class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[432px] z-50 flex justify-around items-center py-3 px-4 bg-ink-black/80 backdrop-blur-md border border-siger-gold/20 rounded-full shadow-lg transform translate-y-32 transition-transform duration-500" id="bottom-nav">
        <a class="flex flex-col items-center text-siger-gold" href="#cover" onclick="smoothScroll(event, '#cover')">
            <span class="material-symbols-outlined text-[20px]">home</span>
            <span class="font-label-caps text-[9px] mt-1">Home</span>
        </a>
        <a class="flex flex-col items-center text-on-surface-variant/70" href="#mempelai" onclick="smoothScroll(event, '#mempelai')">
            <span class="material-symbols-outlined text-[20px]">favorite</span>
            <span class="font-label-caps text-[9px] mt-1">Profil</span>
        </a>
        <a class="flex flex-col items-center text-on-surface-variant/70" href="#acara" onclick="smoothScroll(event, '#acara')">
            <span class="material-symbols-outlined text-[20px]">event</span>
            <span class="font-label-caps text-[9px] mt-1">Acara</span>
        </a>
        <a class="flex flex-col items-center text-on-surface-variant/70" href="#cerita" onclick="smoothScroll(event, '#cerita')">
            <span class="material-symbols-outlined text-[20px]">photo_library</span>
            <span class="font-label-caps text-[9px] mt-1">Galeri</span>
        </a>
    </nav>

    <!-- Floating Action Controls -->
    <div class="fixed bottom-24 left-1/2 translate-x-[170px] z-[45] flex flex-col gap-3 transform translate-y-32 transition-transform duration-500" id="floating-controls">
        <!-- Music Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-deep-maroon/90 text-siger-gold border border-siger-gold/30 flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAudio()">
            <span class="material-symbols-outlined" id="music-icon">volume_up</span>
        </button>
        <!-- Autoscroll Toggle Button -->
        <button class="w-10 h-10 rounded-full bg-deep-maroon/90 text-siger-gold border border-siger-gold/30 flex items-center justify-center shadow-lg active:scale-95 transition-transform" onclick="toggleAutoscroll()">
            <span class="material-symbols-outlined" id="autoscroll-icon">play_arrow</span>
        </button>
    </div>

    <!-- Hidden Audio element for background music -->
    <audio id="bg-music" loop>
        <source src="{{ asset('musics/sunda-music.mp3') }}" type="audio/mpeg"/>
    </audio>

    <!-- Lightbox Modal for Photo Preview -->
    <div id="lightbox" class="fixed inset-y-0 max-w-[480px] w-full left-1/2 -translate-x-1/2 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-siger-gold text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-siger-gold/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <script>
        // Open Invitation Logic
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const navHeader = document.getElementById('top-nav');
            const bottomNav = document.getElementById('bottom-nav');
            const floatingControls = document.getElementById('floating-controls');
            const audio = document.getElementById('bg-music');

            document.body.classList.remove('is-locked');
            mainContent.style.display = 'block';

            cover.style.transition = 'all 1.5s cubic-bezier(0.65, 0, 0.35, 1)';
            cover.style.transform = 'translateY(-100%)';

            setTimeout(() => {
                cover.classList.add('hidden');
                navHeader.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-32');
                floatingControls.classList.remove('translate-y-32');
                
                audio.play().then(() => {
                    isPlaying = true;
                    document.getElementById('music-icon').innerText = 'volume_up';
                }).catch(err => console.log('Audio play blocked:', err));

                startAutoscroll();
            }, 500);
        }

        // Audio Toggle
        let isPlaying = false;
        function toggleAudio() {
            const audio = document.getElementById('bg-music');
            const icon = document.getElementById('music-icon');
            if (isPlaying) {
                audio.pause();
                icon.innerText = 'volume_off';
            } else {
                audio.play();
                icon.innerText = 'volume_up';
            }
            isPlaying = !isPlaying;
        }

        // Autoscroll Logic
        let isScrolling = false;
        let scrollInterval;
        function toggleAutoscroll() {
            const icon = document.getElementById('autoscroll-icon');
            if (isScrolling) {
                clearInterval(scrollInterval);
                icon.innerText = 'play_arrow';
            } else {
                scrollInterval = setInterval(() => {
                    window.scrollBy(0, 1);
                }, 30);
                icon.innerText = 'pause';
            }
            isScrolling = !isScrolling;
        }

        function startAutoscroll() {
            isScrolling = true;
            document.getElementById('autoscroll-icon').innerText = 'pause';
            scrollInterval = setInterval(() => {
                window.scrollBy(0, 1);
            }, 30);
        }

        function stopAutoscroll() {
            if (isScrolling) {
                clearInterval(scrollInterval);
                document.getElementById('autoscroll-icon').innerText = 'play_arrow';
                isScrolling = false;
            }
        }

        ['wheel', 'touchstart', 'touchmove'].forEach(evt => 
            window.addEventListener(evt, () => {
                stopAutoscroll();
            }, { passive: true })
        );

        // Copy Account Logic
        function copyAccount(number, btn) {
            navigator.clipboard.writeText(number);
            const originalText = btn.innerHTML;
            btn.innerHTML = 'COPIED!';
            setTimeout(() => {
                btn.innerHTML = originalText;
            }, 2000);
        }

        // RSVP Submit
        function submitRsvp(e) {
            e.preventDefault();
            const name = document.getElementById('nama').value;
            const presence = document.getElementById('kehadiran')?.value || 'Hadir';
            const msg = document.getElementById('pesan').value;

            const card = document.createElement('div');
            card.className = 'bg-surface-container-low p-5 rounded-xl border border-siger-gold/10';
            card.innerHTML = `<p class="font-body-md text-siger-gold font-semibold text-sm">${name} (${presence})</p><p class="text-xs text-on-surface-variant italic mt-1">"${msg}"</p>`;
            
            document.getElementById('wishList').prepend(card);
            document.getElementById('rsvp-form').reset();
            alert("Hatur nuhun, ucapan parantos kakintun!");
        }

        // Lightbox Logic
        function openLightbox(src) {
            stopAutoscroll();
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
            }, 10);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('opacity-0');
            setTimeout(() => {
                lightbox.classList.add('hidden');
            }, 300);
        }

        // Smooth Scroll
        function smoothScroll(e, selector) {
            e.preventDefault();
            stopAutoscroll();
            document.querySelector(selector).scrollIntoView({
                behavior: 'smooth'
            });

            document.querySelectorAll('#bottom-nav a').forEach(a => {
                a.className = "flex flex-col items-center text-on-surface-variant/70";
            });
            e.currentTarget.className = "flex flex-col items-center text-siger-gold";
        }

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        }

        // Countdown Timer
        const weddingDate = new Date("{{ $event['date_iso'] }}T{{ $event['time'] }}:00").getTime();
        
        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = weddingDate - now;
            if (distance <= 0) return;
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById("days").innerText = days.toString().padStart(2, '0');
            document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
        };
        
        setInterval(updateCountdown, 1000);

        // Scroll Active Nav Link Highlight
        window.addEventListener('scroll', () => {
            let current = "";
            const sections = document.querySelectorAll("main, section");
            sections.forEach((section) => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute("id");
                }
            });

            document.querySelectorAll('#bottom-nav a').forEach((a) => {
                a.className = "flex flex-col items-center text-on-surface-variant/70";
                const href = a.getAttribute("href");
                if (href === `#${current}`) {
                    a.className = "flex flex-col items-center text-siger-gold";
                }
            });
        });
    </script>
</body>
</html>