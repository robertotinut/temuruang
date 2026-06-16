@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Raden');
        $brideName = trim($names[1] ?? 'Ayu');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bapak Kusuma & Ibu Ningrum',
                'bride' => 'Bapak Sudarsono & Ibu Sriwati',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-11-15',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Pendopo Dalem Mangkubumen',
            'address' => $invitation->address ?? 'Jl. Ngasem No. 12, Kraton, Yogyakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Pendopo Dalem Mangkubumen, Yogyakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - 10:00 WIB',
                'note' => $invitation->location ?? 'Pendopo Dalem Mangkubumen'
            ],
            [
                'title' => 'Panggih & Resepsi',
                'time' => '11:00 - 14:00 WIB',
                'note' => $invitation->address ?? 'Pendopo Dalem Mangkubumen'
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
                ['title' => 'Awal Perkenalan', 'date' => 'Maret 2022', 'text' => 'Bermula dari perjumpaan sederhana yang membawa kesan mendalam di hati.'],
                ['title' => 'Lamaran', 'date' => 'Agustus 2025', 'text' => 'Dengan niat suci, dua keluarga besar bersilaturahmi untuk mengikat janji.'],
                ['title' => 'Pernikahan', 'date' => 'November 2026', 'text' => 'Puncak janji suci kami untuk mengarungi bahtera rumah tangga bersama.'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400',
                'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
                'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400'
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800';
        $bg = [
            'cover' => $coverUrl,
            'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400',
            'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
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
                ['name' => 'Keluarga Bpk. Budi', 'status' => 'Hadir', 'message' => 'Nderek mangayubagya, mugi dados keluarga ingkang sakinah, mawaddah, warahmah.'],
                ['name' => 'Siti', 'status' => 'Tidak Hadir', 'message' => 'Pangapunten dereng saged rawuh, namung saged ngaturaken donga pangestu.'],
            ];
        }

        $musicUrl = $invitation->music ? asset('storage/' . $invitation->music) : asset('assets/templates/wedding-11/wp-content/uploads/2026/01/Jawa-03-Niken-Salindry-KUSUMA-WIJAYA.mp3');
    } else {
        // Fallback / Demo values
        $couple = [
            'groom' => 'Raden',
            'bride' => 'Ayu',
            'parents' => [
                'groom' => 'Bapak Kusuma & Ibu Ningrum',
                'bride' => 'Bapak Sudarsono & Ibu Sriwati',
            ],
        ];

        $event = [
            'date_iso' => '2026-11-15',
            'time' => '08:00',
            'location' => 'Pendopo Dalem Mangkubumen',
            'address' => 'Jl. Ngasem No. 12, Kraton, Yogyakarta',
            'maps_url' => 'https://maps.google.com/?q=Yogyakarta',
        ];

        $schedule = [
            ['title' => 'Akad Nikah', 'time' => '08:00 - 10:00', 'note' => 'Pendopo Dalem Mangkubumen'],
            ['title' => 'Panggih & Resepsi', 'time' => '11:00 - 14:00', 'note' => 'Pendopo Dalem Mangkubumen'],
        ];

        $stories = [
            ['title' => 'Awal Perkenalan', 'date' => 'Maret 2022', 'text' => 'Bermula dari perjumpaan sederhana yang membawa kesan mendalam di hati.'],
            ['title' => 'Lamaran', 'date' => 'Agustus 2025', 'text' => 'Dengan niat suci, dua keluarga besar bersilaturahmi untuk mengikat janji.'],
            ['title' => 'Pernikahan', 'date' => 'November 2026', 'text' => 'Puncak janji suci kami untuk mengarungi bahtera rumah tangga bersama.'],
        ];

        $gallery = [
            'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400',
            'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
            'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
            'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400'
        ];

        $bg = [
            'cover' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800',
            'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400',
            'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
        ];

        $wishes = [
            ['name' => 'Keluarga Bpk. Budi', 'status' => 'Hadir', 'message' => 'Nderek mangayubagya, mugi dados keluarga ingkang sakinah, mawaddah, warahmah.'],
            ['name' => 'Siti', 'status' => 'Tidak Hadir', 'message' => 'Pangapunten dereng saged rawuh, namung saged ngaturaken donga pangestu.'],
        ];

        $musicUrl = asset('assets/templates/wedding-11/wp-content/uploads/2026/01/Jawa-03-Niken-Salindry-KUSUMA-WIJAYA.mp3');
    }
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pernikahan Tradisional | {{ $couple['bride'] }} & {{ $couple['groom'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'jawa-dark': '#2C1E16',
                        'jawa-gold': '#C89F5A',
                        'jawa-light-gold': '#E6D5B8',
                        'jawa-cream': '#F9F6F0',
                        'jawa-red': '#8B3A3A',
                    },
                    fontFamily: {
                        serif: ['"Marcellus"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    animation: {
                        'spin-slow': 'spin 15s linear infinite',
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- AOS.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
        
        .batik-pattern {
            background-color: #F9F6F0;
            background-image: 
                radial-gradient(#E6D5B8 2px, transparent 2px),
                radial-gradient(#E6D5B8 2px, transparent 2px);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
        }

        .gunungan-arch {
            clip-path: polygon(50% 0%, 100% 25%, 100% 100%, 0 100%, 0 25%);
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Mobile Bottom Nav styles */
        .bottom-nav {
            box-shadow: 0 -10px 25px -5px rgba(0, 0, 0, 0.05), 0 -8px 10px -6px rgba(0, 0, 0, 0.01);
            padding-bottom: env(safe-area-inset-bottom);
        }
    </style>
</head>
<body 
    x-data="{ 
        isOpen: false, 
        activeSection: 'hero',
        isMuted: false,
        playMusic() {
            let audio = document.getElementById('bg-audio');
            if (audio) {
                audio.muted = this.isMuted;
                audio.play().catch(e => console.log('Audio autoplay blocked'));
            }
        },
        toggleMute() {
            this.isMuted = !this.isMuted;
            let audio = document.getElementById('bg-audio');
            if (audio) {
                audio.muted = this.isMuted;
            }
        },
        observeSections() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.activeSection = entry.target.id;
                    }
                });
            }, { threshold: 0.5 });
            
            document.querySelectorAll('.nav-section').forEach(section => {
                observer.observe(section);
            });
        }
    }"
    x-init="observeSections()"
    class="bg-gray-100 flex justify-center font-sans text-gray-800 relative"
    :class="isOpen ? 'overflow-x-hidden' : 'overflow-hidden h-[100dvh]'"
>
<!-- Hidden Audio Player -->
<audio id="bg-audio" loop preload="auto">
    <source src="{{ $musicUrl }}" type="audio/mpeg">
</audio>

<!-- MAIN APP CONTAINER -->
<div class="w-full max-w-md min-h-[100dvh] relative bg-jawa-cream shadow-2xl flex flex-col pb-24">
    
    <!-- COVER SCREEN -->
    <div 
        class="fixed inset-y-0 left-1/2 -translate-x-1/2 w-full max-w-md z-50 bg-jawa-dark flex flex-col items-center justify-center py-8 px-6 transition-transform duration-[1500ms] ease-in-out overflow-y-auto hide-scrollbar"
        :class="isOpen ? '-translate-y-full pointer-events-none' : 'translate-y-0'"
    >
        <!-- Top Ornament -->
        <div class="text-jawa-gold w-24 h-24 opacity-80 mb-2 shrink-0">
            <svg viewBox="0 0 100 100" class="fill-current w-full h-full">
                <path d="M50 0 L90 80 Q50 100 10 80 Z" opacity="0.2"/>
                <circle cx="50" cy="60" r="15" fill="none" stroke="currentColor" stroke-width="2"/>
                <path d="M50 25 C60 45 75 50 50 75 C25 50 40 45 50 25 Z" fill="none" stroke="currentColor" stroke-width="1.5"/>
            </svg>
        </div>

        <div class="text-center relative z-10 w-full">
            <p class="text-jawa-gold text-[10px] tracking-[0.3em] uppercase mb-2">Pawingahan Ageng</p>
            <h1 class="font-serif text-3xl text-jawa-cream mb-4 leading-tight">{{ $couple['bride'] }} <br> <span class="text-xl text-jawa-gold">&amp;</span> <br> {{ $couple['groom'] }}</h1>
            
            <div class="relative w-40 h-56 mx-auto my-4 border-2 border-jawa-gold p-1.5 gunungan-arch bg-jawa-dark shrink-0">
                <img src="{{ $bg['cover'] }}" class="w-full h-full object-cover gunungan-arch opacity-80" alt="Cover">
            </div>

            <div class="bg-jawa-dark/50 border border-jawa-gold/30 rounded-xl p-3 backdrop-blur-sm mx-auto w-3/4 mb-5 shrink-0">
                <p class="text-jawa-light-gold text-[9px] uppercase tracking-widest mb-1">Katur Dhumateng</p>
                <h3 class="font-serif text-base text-jawa-cream">{{ request('to', request('kpd', 'Tamu Undangan')) }}</h3>
            </div>

            <button 
                @click="isOpen = true; playMusic(); setTimeout(() => { AOS.init({ duration: 1000, once: true }); }, 500);"
                class="bg-jawa-gold text-jawa-dark px-8 py-3 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-jawa-light-gold transition-colors duration-300 shadow-[0_0_15px_rgba(200,159,90,0.4)] shrink-0"
            >
                Buka Undangan
            </button>
        </div>
        
        <!-- Bottom Pattern -->
        <div class="absolute bottom-0 left-0 w-full h-32 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at center, #C89F5A 1px, transparent 1px); background-size: 10px 10px;"></div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="w-full flex-1 relative" id="main-scroll" x-show="isOpen" x-transition:enter="transition-opacity duration-1000 delay-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        
        <div class="absolute inset-0 batik-pattern opacity-50 z-0 pointer-events-none h-[300%]"></div>

        <!-- Music Button -->
        <button 
            @click="toggleMute()" 
            class="fixed top-4 right-4 z-40 w-10 h-10 bg-jawa-dark/80 backdrop-blur-md border border-jawa-gold/50 rounded-full flex items-center justify-center text-jawa-gold shadow-lg"
        >
            <svg x-show="!isMuted" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
            <svg x-show="isMuted" x-cloak class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l6 6 1.27-1.27L4.27 3zM14 7h4V3h-6v5.18l2 2z"/></svg>
        </button>

        <!-- 1. HERO SECTION -->
        <section id="hero" class="nav-section min-h-screen flex flex-col items-center justify-center relative z-10 px-6 py-12 text-center">
            <div data-aos="zoom-in" data-aos-duration="1500" class="w-32 h-32 mb-6 relative">
                <div class="absolute inset-0 border-2 border-dashed border-jawa-gold rounded-full animate-spin-slow"></div>
                <div class="absolute inset-2 border border-jawa-dark rounded-full flex items-center justify-center bg-jawa-cream">
                    <span class="font-serif text-3xl text-jawa-dark">{{ substr($couple['bride'], 0, 1) }}&{{ substr($couple['groom'], 0, 1) }}</span>
                </div>
            </div>

            <p data-aos="fade-up" class="text-xs tracking-[0.2em] uppercase text-jawa-dark mb-2 font-semibold">Pernikahan Tradisional</p>
            <h2 data-aos="fade-up" data-aos-delay="200" class="font-serif text-5xl text-jawa-dark mb-6">{{ $couple['bride'] }} <br><span class="text-3xl text-jawa-gold my-2 block">&amp;</span> {{ $couple['groom'] }}</h2>
            <p data-aos="fade-up" data-aos-delay="400" class="text-sm font-serif text-jawa-dark/80 italic mb-8 max-w-[280px]">
                "Mbangun kromo ingkang satuhu, mugi tansah rahayu wilujeng nir ing sambikala."
            </p>

            <div data-aos="fade-up" data-aos-delay="600" class="w-full bg-white/60 backdrop-blur-md rounded-2xl p-4 border border-jawa-gold/30 shadow-sm">
                <p class="text-[10px] uppercase tracking-widest font-bold text-jawa-dark mb-3 border-b border-jawa-gold/20 pb-2">Menuju Hari Bahagia</p>
                <div class="flex justify-center gap-4 text-jawa-dark"
                     x-data="{
                        target: new Date('{{ $event['date_iso'] }}T{{ $event['time'] }}').getTime(),
                        days: '00', hours: '00', minutes: '00', seconds: '00',
                        init() {
                            setInterval(() => {
                                let now = new Date().getTime();
                                let distance = this.target - now;
                                if(distance < 0) return;
                                this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                                this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                                this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                                this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                            }, 1000);
                        }
                     }"
                >
                    <div class="text-center"><div class="font-serif text-2xl font-bold" x-text="days"></div><div class="text-[8px] uppercase tracking-wider">Hari</div></div>
                    <div class="font-serif text-2xl text-jawa-gold">:</div>
                    <div class="text-center"><div class="font-serif text-2xl font-bold" x-text="hours"></div><div class="text-[8px] uppercase tracking-wider">Jam</div></div>
                    <div class="font-serif text-2xl text-jawa-gold">:</div>
                    <div class="text-center"><div class="font-serif text-2xl font-bold" x-text="minutes"></div><div class="text-[8px] uppercase tracking-wider">Menit</div></div>
                    <div class="font-serif text-2xl text-jawa-gold">:</div>
                    <div class="text-center"><div class="font-serif text-2xl font-bold" x-text="seconds"></div><div class="text-[8px] uppercase tracking-wider">Detik</div></div>
                </div>
            </div>
        </section>

        <!-- 2. MEMPELAI SECTION -->
        <section id="mempelai" class="nav-section py-16 px-6 relative z-10 bg-white/40 backdrop-blur-sm border-y border-jawa-gold/20">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="font-serif text-3xl text-jawa-dark border-b border-jawa-dark pb-2 inline-block">Sang Mempelai</h2>
            </div>

            <!-- Bride -->
            <div class="text-center mb-12" data-aos="fade-right">
                <div class="w-36 h-48 mx-auto mb-4 relative p-1 border-2 border-jawa-gold bg-white">
                    <div class="absolute -top-2 -left-2 w-4 h-4 bg-jawa-dark"></div>
                    <div class="absolute -bottom-2 -right-2 w-4 h-4 bg-jawa-dark"></div>
                    <img src="{{ $bg['bride'] }}" alt="Bride" class="w-full h-full object-cover filter sepia-[0.3]">
                </div>
                <h3 class="font-serif text-2xl font-bold text-jawa-dark mb-1">{{ $couple['bride'] }}</h3>
                <p class="text-xs text-jawa-dark/70 mb-2">Putri dari<br><span class="font-semibold">{{ $couple['parents']['bride'] }}</span></p>
            </div>

            <div class="flex justify-center my-8" data-aos="zoom-in">
                <svg class="w-12 h-12 text-jawa-gold" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>

            <!-- Groom -->
            <div class="text-center" data-aos="fade-left">
                <div class="w-36 h-48 mx-auto mb-4 relative p-1 border-2 border-jawa-gold bg-white">
                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-jawa-dark"></div>
                    <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-jawa-dark"></div>
                    <img src="{{ $bg['groom'] }}" alt="Groom" class="w-full h-full object-cover filter sepia-[0.3]">
                </div>
                <h3 class="font-serif text-2xl font-bold text-jawa-dark mb-1">{{ $couple['groom'] }}</h3>
                <p class="text-xs text-jawa-dark/70 mb-2">Putra dari<br><span class="font-semibold">{{ $couple['parents']['groom'] }}</span></p>
            </div>
        </section>

        <!-- 3. ACARA SECTION -->
        <section id="acara" class="nav-section py-16 px-6 relative z-10 text-center">
            <div class="mb-12" data-aos="fade-up">
                <h2 class="font-serif text-3xl text-jawa-dark border-b border-jawa-dark pb-2 inline-block">Rangkaian Acara</h2>
            </div>

            <div class="space-y-6 text-left">
                @foreach($schedule as $index => $sch)
                <div class="bg-jawa-dark text-jawa-cream p-6 rounded-tl-3xl rounded-br-3xl relative overflow-hidden shadow-lg" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="absolute top-0 right-0 w-24 h-24 opacity-10">
                        <svg viewBox="0 0 100 100" class="fill-current"><circle cx="50" cy="50" r="40"/><circle cx="50" cy="50" r="30" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                    </div>
                    
                    <h3 class="font-serif text-2xl text-jawa-gold mb-4">{{ $sch['title'] }}</h3>
                    
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-6 h-6 rounded-full bg-jawa-gold/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-jawa-gold fill-current" viewBox="0 0 24 24"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</p>
                            <p class="text-xs text-jawa-cream/70">{{ $sch['time'] }} WIB</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3 mb-5">
                        <div class="w-6 h-6 rounded-full bg-jawa-gold/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3 h-3 text-jawa-gold fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold">{{ $sch['note'] ?? $event['location'] }}</p>
                            @if($index === count($schedule) - 1)
                            <p class="text-xs text-jawa-cream/70 mt-1">{{ $event['address'] }}</p>
                            @endif
                        </div>
                    </div>

                    @if($index === count($schedule) - 1)
                    <a href="{{ $event['maps_url'] }}" target="_blank" class="block text-center bg-jawa-gold text-jawa-dark py-3 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-white transition-colors w-full">Petunjuk Lokasi</a>
                    @endif
                </div>
                @endforeach
            </div>
        </section>

        <!-- 4. GALERI SECTION -->
        @if(!empty($gallery))
        <section id="galeri" class="nav-section py-16 px-6 relative z-10 bg-white/40 backdrop-blur-sm border-y border-jawa-gold/20 text-center">
            <div class="mb-12" data-aos="fade-up">
                <h2 class="font-serif text-3xl text-jawa-dark border-b border-jawa-dark pb-2 inline-block">Galeri Bahagia</h2>
            </div>

            <div class="grid grid-cols-2 gap-3" data-aos="fade-up" data-aos-delay="200">
                @foreach($gallery as $index => $img)
                <div class="aspect-[3/4] relative group overflow-hidden {{ $index === 0 || $index === 3 ? 'rounded-tl-3xl rounded-br-3xl' : 'rounded-tr-3xl rounded-bl-3xl' }} border border-jawa-gold/30">
                    <img src="{{ $img }}" alt="Gallery" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 filter sepia-[0.2]">
                    <div class="absolute inset-0 bg-jawa-dark/20 group-hover:bg-transparent transition-colors duration-500"></div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- 5. RSVP SECTION -->
        <section id="rsvp" class="nav-section py-16 px-6 relative z-10">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="font-serif text-3xl text-jawa-dark border-b border-jawa-dark pb-2 inline-block">RSVP & Ucapan</h2>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-jawa-gold/30 mb-8" data-aos="fade-up"
                 x-data="{
                    name: '', status: 'Hadir', message: '',
                    wishes: @json($wishes),
                    submitWish() {
                        if(!this.name || !this.message) return;
                        this.wishes.unshift({ name: this.name, status: this.status, message: this.message });
                        this.name = ''; this.message = '';
                        alert('Matur nuwun, ucapan sampun kintun.');
                    }
                 }"
            >
                <form @submit.prevent="submitWish" class="space-y-4 text-left">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-jawa-dark mb-1">Nama Tamu</label>
                        <input type="text" x-model="name" required class="w-full border-b-2 border-jawa-gold/50 bg-transparent py-2 text-sm focus:outline-none focus:border-jawa-dark">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-jawa-dark mb-1">Kehadiran</label>
                        <select x-model="status" class="w-full border-b-2 border-jawa-gold/50 bg-transparent py-2 text-sm focus:outline-none focus:border-jawa-dark">
                            <option>Hadir</option>
                            <option>Tidak Hadir</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-jawa-dark mb-1">Doa / Ucapan</label>
                        <textarea x-model="message" required rows="3" class="w-full border-b-2 border-jawa-gold/50 bg-transparent py-2 text-sm focus:outline-none focus:border-jawa-dark resize-none"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-jawa-dark text-jawa-cream py-3 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-jawa-gold transition-colors mt-2">Kirim Ucapan</button>
                </form>

                <!-- Ucapan List -->
                <div class="mt-8 border-t border-jawa-gold/20 pt-6 text-left">
                    <h3 class="font-serif text-lg text-jawa-dark mb-4">Papan Pangucap</h3>
                    <div class="space-y-4 max-h-60 overflow-y-auto pr-2 hide-scrollbar">
                        <template x-for="(wish, index) in wishes" :key="index">
                            <div class="bg-jawa-cream p-4 rounded-xl border border-jawa-gold/20">
                                <div class="flex justify-between items-center mb-2">
                                    <h4 class="font-bold text-sm text-jawa-dark" x-text="wish.name"></h4>
                                    <span class="text-[9px] px-2 py-1 rounded-full uppercase tracking-wider font-bold"
                                          :class="wish.status === 'Hadir' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                          x-text="wish.status"></span>
                                </div>
                                <p class="text-xs text-jawa-dark/80 italic" x-text="'&quot;' + wish.message + '&quot;'"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 px-6 text-center text-jawa-dark border-t border-jawa-gold/20 relative pb-32">
            <h2 class="font-serif text-2xl mb-2">{{ $couple['bride'] }} & {{ $couple['groom'] }}</h2>
            <p class="text-[10px] uppercase tracking-widest text-jawa-dark/60">Terima kasih atas doa & restu<br>Matur Nuwun</p>
        </footer>

    </div>

    <!-- MOBILE APP BOTTOM NAVIGATION BAR -->
    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md z-50 transition-transform duration-500" 
         :class="isOpen ? 'translate-y-0' : 'translate-y-full'">
        <div class="bg-white/95 backdrop-blur-md rounded-t-3xl bottom-nav border-t border-jawa-gold/20 px-6 py-2 flex justify-between items-center text-[10px] font-bold text-gray-400 uppercase tracking-wider">
            
            <a @click="document.getElementById('hero').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-2 gap-1 transition-colors duration-300" :class="activeSection === 'hero' ? 'text-jawa-dark' : 'hover:text-jawa-gold'">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                <span>Home</span>
            </a>
            
            <a @click="document.getElementById('mempelai').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-2 gap-1 transition-colors duration-300" :class="activeSection === 'mempelai' ? 'text-jawa-dark' : 'hover:text-jawa-gold'">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                <span>Couple</span>
            </a>
            
            <a @click="document.getElementById('acara').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-2 gap-1 transition-colors duration-300" :class="activeSection === 'acara' ? 'text-jawa-dark' : 'hover:text-jawa-gold'">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
                <span>Event</span>
            </a>
            
            <a @click="document.getElementById('galeri').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-2 gap-1 transition-colors duration-300" :class="activeSection === 'galeri' ? 'text-jawa-dark' : 'hover:text-jawa-gold'">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22 16V4c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm-11-4l2.03 2.71L16 11l4 5H8l3-4zM2 6v14c0 1.1.9 2 2 2h14v-2H4V6H2z"/></svg>
                <span>Gallery</span>
            </a>

            <a @click="document.getElementById('rsvp').scrollIntoView({behavior: 'smooth'})" class="cursor-pointer flex flex-col items-center p-2 gap-1 transition-colors duration-300" :class="activeSection === 'rsvp' ? 'text-jawa-dark' : 'hover:text-jawa-gold'">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12zM7 9h10v2H7zm0-3h10v2H7zm0 6h7v2H7z"/></svg>
                <span>RSVP</span>
            </a>
        </div>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>
