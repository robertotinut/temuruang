@php
    $couple = $couple ?? [
        'groom' => 'Haris',
        'bride' => 'Anisa',
        'parents' => [
            'groom' => 'Bapak Surono & Ibu Sri Mulyani',
            'bride' => 'Bapak Budi & Ibu Siti',
        ],
    ];

    $event = $event ?? [
        'date_iso' => '2026-12-12',
        'time' => '09:00',
        'location' => 'Omah Kawangan',
        'address' => 'Depan Asrama Brimob Boyolali, Kawangan, Boyolali',
        'maps_url' => 'https://maps.google.com/?q=Boyolali',
    ];

    $schedule = $schedule ?? [
        ['title' => 'Akad Nikah', 'time' => '09:00 - 10:30', 'note' => 'Lokasi Acara, Omah Kawangan'],
        ['title' => 'Resepsi Pernikahan', 'time' => '11:00 - 15:00', 'note' => 'Lokasi Acara, Omah Kawangan'],
    ];

    $stories = $stories ?? [
        ['title' => 'Pertama Bertemu', 'date' => '09 Jan 2021', 'text' => 'Kami dipertemukan oleh seorang teman dekat, lalu mulai bertukar cerita dan merasa cocok.'],
        ['title' => 'Mengikat Janji', 'date' => '25 Agt 2022', 'text' => 'Kami sepakat untuk melangkah ke jenjang yang lebih serius dengan pertunangan disaksikan keluarga.'],
        ['title' => 'Hari Bahagia', 'date' => '12 Des 2026', 'text' => 'Kami mengikat janji suci kami dalam ikatan pernikahan yang sah dan memulai babak baru.'],
    ];

    $gallery = $gallery ?? [
        'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=400',
        'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400',
        'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=400',
        'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400'
    ];

    $bg = $bg ?? [
        'cover' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800',
        'groom' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400',
        'bride' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=400',
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan | {{ $couple['bride'] }} & {{ $couple['groom'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS v3 -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rustic-blue': '#2b4c7e',
                        'rustic-gold': '#c5a880',
                        'rustic-cream': '#fbf9f5',
                    },
                    fontFamily: {
                        serif: ['"Cormorant Garamond"', 'serif'],
                        sans: ['"Montserrat"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js v3 -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS.js -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS Styles -->
    <style>
        [x-cloak] { display: none !important; }
        
        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Wishes list scrollbar */
        #wishes-container::-webkit-scrollbar {
            width: 4px;
        }
        #wishes-container::-webkit-scrollbar-track {
            background: transparent;
        }
        #wishes-container::-webkit-scrollbar-thumb {
            background: #c5a880;
            border-radius: 4px;
        }

        /* Pulsing ring animation for cover button */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.96);
                box-shadow: 0 0 0 0 rgba(197, 168, 128, 0.6);
            }
            70% {
                transform: scale(1.02);
                box-shadow: 0 0 0 12px rgba(197, 168, 128, 0);
            }
            100% {
                transform: scale(0.96);
                box-shadow: 0 0 0 0 rgba(197, 168, 128, 0);
            }
        }
        .btn-pulse {
            animation: pulse-ring 2s infinite ease-in-out;
        }

        /* Custom decorative background overlay pattern */
        .navy-floral-pattern {
            background-color: #fbf9f5;
            background-image: radial-gradient(#2b4c7e 0.5px, transparent 0.5px), radial-gradient(#2b4c7e 0.5px, #fbf9f5 0.5px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            opacity: 0.02;
        }
    </style>
</head>
<body 
    x-data="{ 
        isOpen: false, 
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
        }
    }"
    class="bg-[#111c2e] font-sans antialiased text-gray-800 flex justify-center items-center min-h-screen overflow-x-hidden"
    :class="isOpen ? 'overflow-y-auto' : 'overflow-hidden h-screen'"
>

    <!-- Hidden Audio Player -->
    <audio id="bg-audio" loop preload="auto">
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3" type="audio/mpeg">
    </audio>

    <!-- Floating Music Toggle Button -->
    <div 
        x-show="isOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        class="fixed bottom-6 right-6 z-40"
    >
        <button 
            @click="toggleMute()" 
            class="w-12 h-12 bg-white/90 backdrop-blur-md border border-rustic-gold/30 rounded-full shadow-lg flex items-center justify-center transition-colors duration-300"
            :class="isMuted ? 'text-gray-400' : 'text-rustic-blue hover:text-rustic-gold'"
        >
            <!-- Playing Icon -->
            <svg x-show="!isMuted" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
            </svg>
            <!-- Muted Icon -->
            <svg x-show="isMuted" x-cloak class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l6 6 1.27-1.27L4.27 3zM14 7h4V3h-6v5.18l2 2z"/>
            </svg>
        </button>
    </div>

    <!-- COVER SCREEN (Fullscreen overlay sliding out) -->
    <div 
        class="fixed inset-y-0 left-1/2 w-full max-w-md h-screen bg-rustic-cream z-50 flex flex-col justify-between items-center py-14 px-8 shadow-2xl transition-all duration-[1200ms] ease-in-out transform -translate-x-1/2"
        :class="isOpen ? '-translate-y-full pointer-events-none' : 'translate-y-0'"
    >
        <!-- Top Floral Accent -->
        <div class="absolute top-0 left-0 w-48 h-48 text-rustic-blue/15 pointer-events-none select-none">
            <svg viewBox="0 0 100 100" class="w-full h-full fill-current">
                <path d="M0,0 Q35,10 55,55 Q10,35 0,0" />
                <path d="M0,0 Q15,40 55,55 Q40,15 0,0" opacity="0.6" />
                <circle cx="20" cy="20" r="1.5" class="text-rustic-gold/40" />
                <circle cx="35" cy="15" r="1" class="text-rustic-gold/40" />
            </svg>
        </div>

        <!-- Header -->
        <div class="text-center relative z-10 mt-4">
            <p class="text-[10px] uppercase tracking-[0.25em] text-rustic-gold font-sans font-bold mb-2">The Wedding Invitation</p>
            <h1 class="font-serif text-4xl text-rustic-blue font-light tracking-wide">{{ $couple['bride'] }} & {{ $couple['groom'] }}</h1>
        </div>

        <!-- Arch Frame Profile Cover -->
        <div class="relative w-44 h-64 my-6 z-10">
            <!-- Decorative Back Border -->
            <div class="absolute inset-0 border border-rustic-gold rounded-t-full -translate-x-2 translate-y-2 pointer-events-none"></div>
            <!-- Inner Arch Image -->
            <div class="w-full h-full rounded-t-full overflow-hidden border border-rustic-gold/40 bg-white p-1.5 shadow-md">
                <img src="{{ $bg['cover'] }}" class="w-full h-full object-cover rounded-t-full" alt="Wedding Cover">
            </div>
        </div>

        <!-- Guest Info & Trigger Button -->
        <div class="w-full text-center relative z-10 flex flex-col items-center mb-4">
            <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-2 font-sans font-medium">Kepada Yth. Bapak/Ibu/Saudara/i</p>
            
            <!-- Glassmorphism Guest Card -->
            <div class="bg-white/40 backdrop-blur-md border border-white/40 shadow-sm px-6 py-3.5 rounded-2xl w-full max-w-[280px] mb-6">
                <h3 class="font-serif text-lg text-rustic-blue font-bold tracking-wide">
                    {{ request('to', request('kpd', 'Nama Tamu Undangan')) }}
                </h3>
            </div>
            
            <button 
                @click="
                    isOpen = true; 
                    playMusic();
                    setTimeout(() => { AOS.init({ duration: 1000, once: true }); }, 200);
                "
                class="btn-pulse px-8 py-3.5 bg-rustic-blue text-white rounded-full font-sans text-[10px] tracking-widest uppercase font-semibold border border-rustic-gold/30 hover:bg-rustic-blue/90 transition duration-300 shadow-md cursor-pointer"
            >
                Buka Undangan
            </button>
        </div>

        <!-- Bottom Floral Accent -->
        <div class="absolute bottom-0 right-0 w-48 h-48 text-rustic-blue/15 pointer-events-none select-none rotate-180">
            <svg viewBox="0 0 100 100" class="w-full h-full fill-current">
                <path d="M0,0 Q35,10 55,55 Q10,35 0,0" />
                <path d="M0,0 Q15,40 55,55 Q40,15 0,0" opacity="0.6" />
                <circle cx="20" cy="20" r="1.5" class="text-rustic-gold/40" />
                <circle cx="35" cy="15" r="1" class="text-rustic-gold/40" />
            </svg>
        </div>
    </div>

    <!-- MAIN INVITATION FRAME CONTAINER (Mockup Device Phone Container) -->
    <div class="w-full max-w-md min-h-screen bg-rustic-cream shadow-2xl relative flex flex-col justify-start">
        
        <!-- Subtle Pattern Overlay background -->
        <div class="absolute inset-0 navy-floral-pattern pointer-events-none z-0"></div>

        <!-- HALAMAN HERO SECTION -->
        <div class="py-20 px-8 text-center relative z-10 min-h-screen flex flex-col justify-center items-center">
            <!-- Leaf SVG Ornament top -->
            <div class="text-rustic-blue/10 w-24 h-12 mb-6">
                <svg viewBox="0 0 100 50" class="w-full h-full fill-current mx-auto">
                    <path d="M50,0 Q20,10 0,40 Q40,30 50,50 Q60,30 100,40 Q80,10 50,0" />
                </svg>
            </div>

            <!-- Inisial Monogram -->
            <div class="w-24 h-24 border border-rustic-gold/40 rounded-full flex items-center justify-center relative mb-8 shadow-sm bg-white/20 backdrop-blur-sm">
                <!-- Inner dotted line border -->
                <div class="absolute inset-1.5 border border-dashed border-rustic-gold/30 rounded-full"></div>
                <span class="font-serif text-3xl text-rustic-blue tracking-wide">A & H</span>
            </div>

            <p class="text-[10px] uppercase tracking-[0.25em] text-rustic-gold font-sans font-bold mb-2">The Marriage Of</p>
            <h2 class="font-serif text-4xl text-rustic-blue font-light tracking-wide mb-6">Anisa & Haris</h2>

            <!-- Verse / Poetic Quote -->
            <div data-aos="fade-up" class="px-4 text-center max-w-xs mx-auto mt-4 mb-10">
                <p class="font-serif italic text-[13px] text-gray-600 leading-relaxed">
                    "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
                </p>
                <p class="text-[9px] font-sans uppercase tracking-widest text-rustic-gold mt-3 font-bold">- Q.S. Ar-Rum: 21 -</p>
            </div>

            <!-- Countdown Timer Card -->
            <div 
                x-data="{
                    expiry: new Date('{{ $event['date_iso'] }}T09:00:00').getTime(),
                    days: '00',
                    hours: '00',
                    minutes: '00',
                    seconds: '00',
                    init() {
                        setInterval(() => {
                            let now = new Date().getTime();
                            let diff = this.expiry - now;
                            if (diff < 0) return;
                            this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
                            this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                            this.minutes = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                            this.seconds = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                        }, 1000);
                    }
                }"
                class="w-full mt-4"
                data-aos="fade-up"
                data-aos-delay="200"
            >
                <p class="text-[10px] uppercase tracking-widest text-rustic-gold font-sans font-bold mb-4">Menuju Hari Bahagia</p>
                <div class="grid grid-cols-4 gap-3 max-w-[290px] mx-auto">
                    <!-- Days -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl py-3.5 px-2 shadow-sm border border-rustic-gold/15 text-center flex flex-col justify-center">
                        <span x-text="days" class="text-xl font-serif font-bold text-rustic-blue">00</span>
                        <span class="text-[9px] uppercase font-sans tracking-widest text-gray-400 mt-1">Hari</span>
                    </div>
                    <!-- Hours -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl py-3.5 px-2 shadow-sm border border-rustic-gold/15 text-center flex flex-col justify-center">
                        <span x-text="hours" class="text-xl font-serif font-bold text-rustic-blue">00</span>
                        <span class="text-[9px] uppercase font-sans tracking-widest text-gray-400 mt-1">Jam</span>
                    </div>
                    <!-- Minutes -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl py-3.5 px-2 shadow-sm border border-rustic-gold/15 text-center flex flex-col justify-center">
                        <span x-text="minutes" class="text-xl font-serif font-bold text-rustic-blue">00</span>
                        <span class="text-[9px] uppercase font-sans tracking-widest text-gray-400 mt-1">Menit</span>
                    </div>
                    <!-- Seconds -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-2xl py-3.5 px-2 shadow-sm border border-rustic-gold/15 text-center flex flex-col justify-center">
                        <span x-text="seconds" class="text-xl font-serif font-bold text-rustic-blue">00</span>
                        <span class="text-[9px] uppercase font-sans tracking-widest text-gray-400 mt-1">Detik</span>
                    </div>
                </div>
            </div>
            
            <!-- Bottom arrow navigation hint -->
            <div class="mt-16 text-gray-400 text-xs flex flex-col items-center gap-1 animate-bounce">
                <span>Scroll ke Bawah</span>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                </svg>
            </div>
        </div>

        <!-- SEKSI PROFIL MEMPELAI (The Couple) -->
        <div class="py-20 px-8 bg-white/40 backdrop-blur-sm relative z-10 border-t border-b border-rustic-gold/10" id="mempelai">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-rustic-gold font-sans font-bold mb-2 block">Introducing</span>
                <h2 class="font-serif text-3xl text-rustic-blue">Kedua Mempelai</h2>
                <div class="w-16 h-[1px] bg-rustic-gold mx-auto mt-4"></div>
            </div>

            <!-- Mempelai Wanita (Bride) -->
            <div class="text-center mb-16">
                <!-- Arch shaped photo container with absolute offsets -->
                <div class="relative w-44 h-64 mx-auto mb-6" data-aos="fade-up">
                    <div class="absolute inset-0 border border-rustic-gold rounded-t-full -translate-x-2.5 translate-y-2.5 pointer-events-none"></div>
                    <div class="w-full h-full rounded-t-full overflow-hidden border border-rustic-gold bg-white p-1.5 shadow-sm relative z-10">
                        <img src="{{ $bg['bride'] }}" class="w-full h-full object-cover rounded-t-full transition-transform duration-700 hover:scale-105" alt="{{ $couple['bride'] }}">
                    </div>
                </div>

                <h3 class="font-serif text-3xl text-rustic-blue font-bold mt-4 tracking-wide" data-aos="fade-up">
                    {{ $couple['bride'] }}
                </h3>
                <p class="text-[9px] text-rustic-gold uppercase tracking-[0.2em] font-sans font-bold mt-1.5 mb-3" data-aos="fade-up" data-aos-delay="100">
                    Mempelai Wanita
                </p>
                <p class="text-xs text-gray-500 font-serif italic max-w-xs mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Putri tercinta dari pasangan:<br>
                    <span class="font-sans font-bold text-gray-700 not-italic text-[10px] uppercase tracking-wider block mt-1">{{ $couple['parents']['bride'] }}</span>
                </p>
            </div>

            <!-- Ampersand -->
            <div class="text-5xl font-serif text-rustic-gold/40 my-12 text-center" data-aos="zoom-in">
                &
            </div>

            <!-- Mempelai Pria (Groom) -->
            <div class="text-center">
                <!-- Arch shaped photo container with offset -->
                <div class="relative w-44 h-64 mx-auto mb-6" data-aos="fade-up">
                    <div class="absolute inset-0 border border-rustic-gold rounded-t-full translate-x-2.5 translate-y-2.5 pointer-events-none"></div>
                    <div class="w-full h-full rounded-t-full overflow-hidden border border-rustic-gold bg-white p-1.5 shadow-sm relative z-10">
                        <img src="{{ $bg['groom'] }}" class="w-full h-full object-cover rounded-t-full transition-transform duration-700 hover:scale-105" alt="{{ $couple['groom'] }}">
                    </div>
                </div>

                <h3 class="font-serif text-3xl text-rustic-blue font-bold mt-4 tracking-wide" data-aos="fade-up">
                    {{ $couple['groom'] }}
                </h3>
                <p class="text-[9px] text-rustic-gold uppercase tracking-[0.2em] font-sans font-bold mt-1.5 mb-3" data-aos="fade-up" data-aos-delay="100">
                    Mempelai Pria
                </p>
                <p class="text-xs text-gray-500 font-serif italic max-w-xs mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Putra tercinta dari pasangan:<br>
                    <span class="font-sans font-bold text-gray-700 not-italic text-[10px] uppercase tracking-wider block mt-1">{{ $couple['parents']['groom'] }}</span>
                </p>
            </div>
        </div>

        <!-- SEKSI KISAH CINTA (Our Journey) -->
        @if(!empty($stories))
        <div class="py-20 px-8 relative z-10" id="kisah">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-rustic-gold font-sans font-bold mb-2 block">Our Story</span>
                <h2 class="font-serif text-3xl text-rustic-blue">Kisah Cinta Kami</h2>
                <div class="w-16 h-[1px] bg-rustic-gold mx-auto mt-4"></div>
            </div>

            <div class="max-w-sm mx-auto relative pl-6 border-l border-rustic-gold/30 space-y-8 text-left">
                @foreach($stories as $index => $s)
                <div class="relative" data-aos="fade-up">
                    <!-- Timeline Node circle -->
                    <div class="absolute -left-[31px] top-1.5 w-4 h-4 rounded-full bg-rustic-cream border-2 border-rustic-blue flex items-center justify-center z-10 shadow-sm">
                        <div class="w-1.5 h-1.5 rounded-full bg-rustic-gold"></div>
                    </div>
                    
                    <div class="bg-white/80 backdrop-blur-sm p-5 rounded-2xl shadow-sm border border-rustic-gold/15">
                        <span class="text-[9px] text-rustic-gold font-sans font-bold uppercase tracking-wider block mb-1">{{ $s['date'] }}</span>
                        <h3 class="font-serif text-base text-rustic-blue font-bold mb-2">{{ $s['title'] }}</h3>
                        <p class="text-xs text-gray-600 leading-relaxed font-sans">{{ $s['text'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SEKSI DETAIL ACARA & AKSES MAPS -->
        <div class="py-20 px-8 bg-[#f5f1e8]/70 backdrop-blur-sm relative z-10 border-t border-b border-rustic-gold/10" id="acara">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-rustic-gold font-sans font-bold mb-2 block">Events</span>
                <h2 class="font-serif text-3xl text-rustic-blue">Agenda Acara</h2>
                <div class="w-16 h-[1px] bg-rustic-gold mx-auto mt-4"></div>
            </div>

            <div class="space-y-8 max-w-sm mx-auto">
                <!-- Akad Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-rustic-gold/15 relative overflow-hidden" data-aos="fade-up">
                    <!-- Subtle border corner flourish decoration -->
                    <div class="absolute top-0 left-0 w-12 h-12 border-t-2 border-l-2 border-rustic-gold/15 rounded-tl-2xl"></div>
                    
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-10 h-10 rounded-full bg-rustic-cream flex items-center justify-center text-rustic-blue border border-rustic-gold/20 shadow-sm">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg text-rustic-blue font-bold tracking-wide">Akad Nikah</h3>
                            <p class="text-[9px] text-rustic-gold uppercase tracking-widest font-sans font-bold">Sakral & Suci</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3 text-xs text-gray-600 font-sans">
                        <div class="flex gap-2">
                            <span class="font-semibold text-rustic-blue w-20">Tanggal:</span>
                            <span class="flex-1">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-semibold text-rustic-blue w-20">Waktu:</span>
                            <span class="flex-1">Pukul {{ $schedule[0]['time'] ?? '09:00 - 10:30' }} WIB</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-semibold text-rustic-blue w-20">Lokasi:</span>
                            <span class="flex-1">{{ $schedule[0]['note'] ?? $event['location'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Resepsi Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-rustic-gold/15 relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <!-- Corner accent -->
                    <div class="absolute top-0 left-0 w-12 h-12 border-t-2 border-l-2 border-rustic-gold/15 rounded-tl-2xl"></div>

                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-10 h-10 rounded-full bg-rustic-cream flex items-center justify-center text-rustic-blue border border-rustic-gold/20 shadow-sm">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg text-rustic-blue font-bold tracking-wide">Resepsi</h3>
                            <p class="text-[9px] text-rustic-gold uppercase tracking-widest font-sans font-bold">Walimatul Ursy</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3 text-xs text-gray-600 font-sans">
                        <div class="flex gap-2">
                            <span class="font-semibold text-rustic-blue w-20">Tanggal:</span>
                            <span class="flex-1">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-semibold text-rustic-blue w-20">Waktu:</span>
                            <span class="flex-1">Pukul {{ $schedule[1]['time'] ?? '11:00 - 15:00' }} WIB</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-semibold text-rustic-blue w-20">Lokasi:</span>
                            <span class="flex-1">{{ $schedule[1]['note'] ?? $event['location'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Venue Map Details Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-rustic-gold/15 text-center" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="font-serif text-base text-rustic-blue font-bold mb-2">Lokasi Utama</h4>
                    <p class="text-xs text-gray-700 font-bold mb-1">{{ $event['location'] }}</p>
                    <p class="text-[10px] text-gray-500 mb-5 leading-relaxed px-2 font-sans">{{ $event['address'] }}</p>
                    
                    <a 
                        href="{{ $event['maps_url'] }}" 
                        target="_blank" 
                        rel="noopener"
                        class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 w-full bg-rustic-blue hover:bg-rustic-gold text-white font-sans text-[10px] tracking-widest uppercase font-bold rounded-xl transition-all duration-500 shadow-sm border border-rustic-gold/20 cursor-pointer"
                    >
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        Lihat Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- SEKSI GALERI FOTO (Gallery) -->
        @if(!empty($gallery))
        <div class="py-20 px-8 relative z-10" id="galeri">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-rustic-gold font-sans font-bold mb-2 block">Our Gallery</span>
                <h2 class="font-serif text-3xl text-rustic-blue">Galeri Kebahagiaan</h2>
                <div class="w-16 h-[1px] bg-rustic-gold mx-auto mt-4"></div>
            </div>

            <!-- Grid photos with gold offsets -->
            <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto" data-aos="fade-up">
                @foreach($gallery as $index => $img)
                <div class="overflow-hidden rounded-2xl border border-rustic-gold/20 shadow-sm aspect-[4/5] bg-white p-1">
                    <img src="{{ $img }}" class="w-full h-full object-cover rounded-xl transition-transform duration-700 hover:scale-105" alt="Gallery {{ $index }}">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SEKSI RSVP FORM & BUKU TAMU -->
        <div 
            class="py-20 px-8 bg-white/40 backdrop-blur-sm relative z-10 border-t border-rustic-gold/10" 
            id="rsvp" 
            x-data="{
                name: '',
                status: 'Hadir',
                message: '',
                wishes: [
                    { name: 'Rian & Dini', status: 'Hadir', message: 'Selamat ya Anisa dan Haris! Lancar sampai hari H ya. Semoga menjadi keluarga sakinah, mawaddah, warahmah.', time: '1 jam yang lalu' },
                    { name: 'Kurniawan', status: 'Hadir', message: 'Happy wedding brother! Selamat menempuh perjalanan baru. Semoga bahagia selamanya!', time: '3 jam yang lalu' },
                    { name: 'Siti Rahma', status: 'Tidak Hadir', message: 'Selamat berbahagia untuk kalian berdua! Mohon maaf saya sekeluarga berhalangan hadir langsung.', time: 'Kemarin' }
                ],
                submitWish() {
                    if (this.name.trim() === '' || this.message.trim() === '') return;
                    this.wishes.unshift({
                        name: this.name,
                        status: this.status,
                        message: this.message,
                        time: 'Baru saja'
                    });
                    this.name = '';
                    this.message = '';
                    alert('Terima kasih! RSVP dan doa restu Anda telah berhasil dikirim.');
                }
            }"
        >
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-rustic-gold font-sans font-bold mb-2 block">RSVP & Guestbook</span>
                <h2 class="font-serif text-3xl text-rustic-blue">Buku Tamu & RSVP</h2>
                <div class="w-16 h-[1px] bg-rustic-gold mx-auto mt-4"></div>
            </div>

            <!-- RSVP Form Card -->
            <div class="max-w-sm mx-auto bg-white rounded-2xl p-6 shadow-sm border border-rustic-gold/15 mb-10" data-aos="fade-up">
                <form @submit.prevent="submitWish()">
                    <div class="mb-5">
                        <label class="block text-[9px] font-sans font-bold text-rustic-gold uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <input 
                            type="text" 
                            x-model="name"
                            required
                            placeholder="Tulis nama Anda di sini"
                            class="w-full bg-transparent border-b border-rustic-gold/30 focus:border-rustic-blue py-2 text-xs font-sans placeholder-gray-300 focus:outline-none transition-colors duration-300 text-gray-700"
                        >
                    </div>
                    
                    <div class="mb-5">
                        <label class="block text-[9px] font-sans font-bold text-rustic-gold uppercase tracking-wider mb-1">Konfirmasi Kehadiran</label>
                        <select 
                            x-model="status"
                            required
                            class="w-full bg-transparent border-b border-rustic-gold/30 focus:border-rustic-blue py-2 text-xs font-sans focus:outline-none transition-colors duration-300 text-gray-700"
                        >
                            <option value="Hadir">Saya Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan Hadir</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-[9px] font-sans font-bold text-rustic-gold uppercase tracking-wider mb-1">Doa Restu & Ucapan</label>
                        <textarea 
                            x-model="message"
                            required
                            rows="3"
                            placeholder="Tulis ucapan selamat & doa restu tulus Anda..."
                            class="w-full bg-transparent border-b border-rustic-gold/30 focus:border-rustic-blue py-2 text-xs font-sans placeholder-gray-300 focus:outline-none transition-colors duration-300 resize-none text-gray-700"
                        ></textarea>
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full py-3.5 bg-rustic-blue hover:bg-rustic-gold text-white font-sans text-[10px] tracking-widest uppercase font-bold rounded-xl transition-all duration-500 shadow-sm cursor-pointer"
                    >
                        Kirim Konfirmasi
                    </button>
                </form>
            </div>

            <!-- Wishes Feed (Guestbook Feed) -->
            <div class="max-w-sm mx-auto" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-serif text-lg text-rustic-blue font-bold mb-5 text-left border-b border-rustic-gold/10 pb-2">Doa & Ucapan</h3>
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1 text-left" id="wishes-container">
                    <template x-for="wish in wishes" :key="wish.name + wish.time">
                        <div class="bg-white p-4 rounded-xl border border-rustic-gold/10 text-left relative overflow-hidden shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-serif font-bold text-rustic-blue text-sm" x-text="wish.name"></span>
                                <span class="text-[8px] uppercase tracking-wider px-2.5 py-0.5 rounded-full font-bold" 
                                      :class="wish.status === 'Hadir' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200'"
                                      x-text="wish.status"></span>
                            </div>
                            <p class="text-xs text-gray-600 leading-relaxed font-sans" x-text="wish.message"></p>
                            <span class="text-[8px] text-gray-400 mt-2 block" x-text="wish.time"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- DYNAMIC FOOTER SECTION -->
        <div class="py-16 px-8 bg-[#111c2e] text-center relative z-10 text-white border-t border-rustic-gold/20">
            <!-- Dotted Ring monogram overlay -->
            <div class="w-16 h-16 border border-rustic-gold/30 rounded-full flex items-center justify-center relative mb-6 mx-auto">
                <div class="absolute inset-1 border border-dashed border-rustic-gold/20 rounded-full"></div>
                <span class="font-serif text-lg text-rustic-gold tracking-wide">A & H</span>
            </div>
            
            <p class="font-serif italic text-sm text-gray-300 leading-relaxed max-w-xs mx-auto mb-6">
                Merupakan kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.
            </p>
            
            <h3 class="font-serif text-2xl text-rustic-gold font-light tracking-wide mb-2">Anisa & Haris</h3>
            <p class="text-[8px] uppercase tracking-widest text-gray-500 font-sans">© 2026 TemuRuang. All Rights Reserved.</p>
        </div>

    </div>

    <!-- AOS.js script inclusion & initialization -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for user interaction to run complete AOS trigger
            // This guarantees page layout renders beautifully once cover slides up
        });
    </script>
</body>
</html>
