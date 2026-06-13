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
    <title>The Wedding of {{ $couple['bride'] }} & {{ $couple['groom'] }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
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
                        script: ['"Pinyon Script"', 'cursive'],
                        display: ['"Playfair Display"', 'serif'],
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
        
        html {
            scroll-behavior: smooth;
        }

        /* Wishes feed scrollbar styling */
        #wishes-container::-webkit-scrollbar {
            width: 4px;
        }
        #wishes-container::-webkit-scrollbar-track {
            background: transparent;
        }
        #wishes-container::-webkit-scrollbar-thumb {
            background: #000;
            border-radius: 4px;
        }

        /* Ambient Room Backdrop - Photorealistic framing for desktop */
        .ambient-backdrop {
            background: radial-gradient(circle at center, rgba(230, 222, 214, 0.4) 0%, rgba(200, 190, 180, 0.6) 100%),
                        url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200') center/cover no-repeat;
        }

        /* Signature repeating black and white stripe bars */
        .stripe-bar {
            height: 20px;
            background: repeating-linear-gradient(90deg, #000, #000 12px, #fff 12px, #fff 24px);
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            width: 100%;
        }

        /* 3D Envelope Animation styles */
        .envelope-wrapper {
            position: relative;
            width: 290px;
            height: 180px;
            background: #eaeaea;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            perspective: 1000px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .envelope-paper {
            position: absolute;
            left: 12px;
            right: 12px;
            top: 6px;
            bottom: 6px;
            background: #fff;
            border: 1px solid #eee;
            z-index: 2;
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s;
            transform: translateY(0);
            padding: 15px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            border-radius: 2px;
        }

        .envelope-front-pocket {
            position: absolute;
            inset: 0;
            background: #111;
            clip-path: polygon(0 42%, 50% 100%, 100% 42%, 100% 100%, 0 100%);
            z-index: 4;
            border-top: 1px solid #222;
            border-radius: 0 0 4px 4px;
            box-shadow: inset 0 2px 5px rgba(255,255,255,0.05);
        }

        .envelope-side-flaps {
            position: absolute;
            inset: 0;
            background: #161616;
            clip-path: polygon(0 0, 42% 50%, 0 100%, 100% 100%, 58% 50%, 100% 0);
            z-index: 3;
            border-radius: 4px;
        }

        .envelope-flap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #1e1e1e;
            clip-path: polygon(0 0, 50% 50%, 100% 0);
            transform-origin: top;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 5;
            border-bottom: 1.5px solid #222;
            border-radius: 4px 4px 0 0;
        }

        .envelope-wrapper.open .envelope-flap {
            transform: rotateX(180deg);
            z-index: 1;
        }

        .envelope-wrapper.open .envelope-paper {
            transform: translateY(-95px);
            z-index: 6;
        }

        /* Polaroid layout rotations and transition hover triggers */
        .polaroid-card {
            background: #fff;
            padding: 8px 8px 20px 8px;
            border: 1px solid rgba(0,0,0,0.08);
            box-shadow: 0 8px 25px rgba(0,0,0,0.18);
            transition: all 0.4s ease;
        }
        .polaroid-card:hover {
            transform: rotate(0deg) scale(1.05) !important;
            z-index: 30 !important;
        }

        /* Pulsing loop animation for gold wax seal button */
        @keyframes seal-pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); }
            50% { transform: translate(-50%, -50%) scale(1.08); }
        }
        .seal-pulse {
            animation: seal-pulse 2s infinite ease-in-out;
        }
    </style>
</head>
<body 
    x-data="{ 
        isOpen: false, 
        isEnvelopeOpened: false,
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
    class="ambient-backdrop font-sans antialiased text-gray-900 flex justify-center items-center min-h-screen overflow-x-hidden p-0 sm:p-4"
    :class="isOpen ? 'overflow-y-auto' : 'overflow-hidden h-screen'"
>

    <!-- Hidden Audio Player -->
    <audio id="bg-audio" loop preload="auto">
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3" type="audio/mpeg">
    </audio>

    <!-- Floating Sound Button -->
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
            class="w-12 h-12 bg-white border-2 border-black rounded-full shadow-xl flex items-center justify-center transition-colors duration-300"
            :class="isMuted ? 'text-gray-400' : 'text-black hover:bg-black hover:text-white'"
        >
            <svg x-show="!isMuted" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
            </svg>
            <svg x-show="isMuted" x-cloak class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M4.27 3L3 4.27l9 9v.28c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4v-1.73l6 6 1.27-1.27L4.27 3zM14 7h4V3h-6v5.18l2 2z"/>
            </svg>
        </button>
    </div>

    <!-- COVER SCREEN (Interactive 3D Envelope Opening) -->
    <div 
        class="fixed inset-y-0 left-1/2 w-full max-w-md h-screen bg-rustic-cream z-50 flex flex-col justify-between items-center py-12 px-6 shadow-2xl transition-all duration-[1300ms] ease-in-out transform -translate-x-1/2"
        :class="isOpen ? '-translate-y-full pointer-events-none' : 'translate-y-0'"
    >
        <!-- Top Black Bar decoration -->
        <div class="w-full flex flex-col items-center">
            <div class="w-full h-8 bg-black flex items-center justify-center relative overflow-hidden">
                <span class="text-[8px] tracking-[0.3em] text-white font-bold uppercase">The Wedding of</span>
            </div>
            <!-- Striped Separator -->
            <div class="stripe-bar"></div>
        </div>

        <!-- Center Envelope Card Area -->
        <div class="flex flex-col items-center justify-center my-auto">
            <!-- Instructions -->
            <p class="text-[9px] uppercase tracking-[0.25em] text-gray-500 font-sans font-bold mb-6">Tap Wax Seal to Open</p>
            
            <!-- 3D Envelope Wrapper -->
            <div 
                class="envelope-wrapper" 
                :class="isEnvelopeOpened ? 'open' : ''"
                @click="
                    if(!isEnvelopeOpened) {
                        isEnvelopeOpened = true;
                        playMusic();
                        setTimeout(() => {
                            isOpen = true;
                            setTimeout(() => { AOS.init({ duration: 1000, once: true }); }, 300);
                        }, 2200);
                    }
                "
            >
                <!-- Inner Paper Invitation Card -->
                <div class="envelope-paper">
                    <span class="text-[8px] uppercase tracking-widest text-gray-400 font-bold">You are Invited</span>
                    <h3 class="font-serif text-base text-black font-bold tracking-wide mt-1">Anisa & Haris</h3>
                    <div class="w-6 h-[1px] bg-black mx-auto my-2"></div>
                    <span class="font-sans text-[7px] text-gray-500 uppercase tracking-widest">Read Details</span>
                </div>

                <!-- Envelope Flap (Top triangle) -->
                <div class="envelope-flap"></div>
                <!-- Envelope Side Flaps -->
                <div class="envelope-side-flaps"></div>
                <!-- Envelope Front Pocket (Bottom triangle) -->
                <div class="envelope-front-pocket"></div>

                <!-- Golden Wax Seal button in center -->
                <div 
                    x-show="!isEnvelopeOpened"
                    class="seal-pulse absolute top-[52%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-rustic-gold text-white font-bold flex items-center justify-center border border-white/30 shadow-lg z-10 transition duration-300 hover:scale-105"
                >
                    <svg class="w-5 h-5 fill-current text-white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                </div>
            </div>
            
            <!-- Guest info beneath envelope -->
            <div class="mt-8 text-center flex flex-col items-center">
                <span class="text-[8px] uppercase tracking-widest text-gray-400 font-bold block mb-1">Dear Special Guest</span>
                <!-- Glassmorphism Container -->
                <div class="bg-white/70 border border-black/5 shadow-sm py-2 px-6 rounded-lg max-w-[240px]">
                    <span class="font-serif text-sm text-black font-bold">
                        {{ request('to', request('kpd', 'Nama Tamu Undangan')) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Bottom Stripe separator -->
        <div class="w-full flex flex-col items-center">
            <div class="stripe-bar"></div>
            <div class="w-full h-8 bg-black flex items-center justify-center">
                <span class="font-script text-lg text-white">Anisa & Haris</span>
            </div>
        </div>
    </div>

    <!-- MAIN INVITATION FRAME CONTAINER (Mockup Device Phone Container) -->
    <div class="w-full max-w-md min-h-screen bg-rustic-cream shadow-2xl relative flex flex-col justify-start overflow-x-hidden border-x border-black/10">

        <!-- HEADER SECTION (High contrast white card with black double borders) -->
        <div class="py-16 px-8 flex flex-col items-center bg-white relative z-10">
            <!-- Monogram icon -->
            <div class="w-16 h-16 border-2 border-double border-black rounded-full flex items-center justify-center mb-6">
                <span class="font-serif text-lg font-bold text-black tracking-widest">A & H</span>
            </div>

            <!-- Double-Border Title Card -->
            <div class="border-4 double border-black p-6 text-center w-full max-w-[320px]" data-aos="fade-up">
                <span class="text-[9px] uppercase tracking-[0.3em] text-gray-400 font-bold block mb-1">Save the Date for</span>
                <h2 class="font-serif text-3xl font-light text-black tracking-wide leading-tight">Anisa & Haris</h2>
                <div class="w-10 h-[1.5px] bg-black mx-auto my-3"></div>
                <span class="font-sans text-[8px] uppercase tracking-[0.2em] text-black font-bold block">12 December 2026</span>
            </div>

            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-8 animate-pulse">Scroll Down to Reveal Details</p>
        </div>

        <!-- STRIPE BAR SEPARATOR -->
        <div class="stripe-bar"></div>

        <!-- HERO SECTION (Black Background, Polaroid collage, and description text) -->
        <div class="py-20 px-8 bg-[#0a0a0a] text-white relative z-10 flex flex-col">
            
            <div class="text-left mb-10" data-aos="fade-right">
                <span class="text-[9px] uppercase tracking-[0.25em] text-rustic-gold font-bold">Introduction</span>
                <h3 class="font-serif text-3xl text-white tracking-wide mt-1">Our Love Story</h3>
                <div class="w-12 h-[1px] bg-rustic-gold mt-3"></div>
            </div>

            <!-- Double column structure: Polaroid Left, Text Right -->
            <div class="grid grid-cols-12 gap-4 items-start mb-10">
                <!-- polaroids on left -->
                <div class="col-span-5 relative h-64 flex items-center justify-center">
                    <!-- Polaroid 1 (Deepest) -->
                    <div class="polaroid-card absolute w-28 -rotate-12 -translate-x-3 -translate-y-8 z-10" data-aos="fade-right" data-aos-delay="100">
                        <img src="{{ $gallery[0] }}" class="w-full aspect-square object-cover mb-1.5 grayscale hover:grayscale-0 transition duration-300">
                        <span class="text-[7px] text-gray-400 font-serif block text-center italic">First Meet</span>
                    </div>

                    <!-- Polaroid 2 (Middle) -->
                    <div class="polaroid-card absolute w-28 rotate-6 translate-x-3 translate-y-6 z-20" data-aos="fade-right" data-aos-delay="300">
                        <img src="{{ $gallery[1] }}" class="w-full aspect-square object-cover mb-1.5 grayscale hover:grayscale-0 transition duration-300">
                        <span class="text-[7px] text-gray-400 font-serif block text-center italic">Engagement</span>
                    </div>

                    <!-- Polaroid 3 (Top) -->
                    <div class="polaroid-card absolute w-28 -rotate-3 translate-y-[-10px] translate-x-[5px] z-15" data-aos="fade-right" data-aos-delay="200">
                        <img src="{{ $gallery[2] }}" class="w-full aspect-square object-cover mb-1.5 grayscale hover:grayscale-0 transition duration-300">
                        <span class="text-[7px] text-gray-400 font-serif block text-center italic">Prewedding</span>
                    </div>
                </div>

                <!-- Text explanation on right -->
                <div class="col-span-7 pl-2 text-left" data-aos="fade-left">
                    <p class="text-xs text-gray-300 leading-relaxed font-sans mb-4">
                        Dipertemukan oleh takdir, dipersatukan oleh komitmen cinta suci. Kami bersiap mengikat janji suci kami untuk meniti langkah baru sebagai pasangan sehidup sesurga.
                    </p>
                    <p class="font-serif italic text-xs text-rustic-gold leading-relaxed">
                        "Dan di antara tanda-tanda kebesaran-Nya ialah Dia menciptakan pasangan untukmu agar kamu cenderung dan merasa tenteram..."
                    </p>
                </div>
            </div>

            <!-- Countdown Timer Card (Modern Stark outline style) -->
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
                class="w-full mt-6 border-t border-b border-white/10 py-6"
                data-aos="fade-up"
            >
                <span class="text-[8px] uppercase tracking-widest text-rustic-gold font-bold block mb-4">Timer Event</span>
                <div class="grid grid-cols-4 gap-3 max-w-[270px] mx-auto">
                    <!-- Days -->
                    <div class="bg-transparent border border-white/20 rounded-xl py-2 px-1 text-center">
                        <span x-text="days" class="text-xl font-serif font-bold text-white">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-400 block mt-0.5">Hari</span>
                    </div>
                    <!-- Hours -->
                    <div class="bg-transparent border border-white/20 rounded-xl py-2 px-1 text-center">
                        <span x-text="hours" class="text-xl font-serif font-bold text-white">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-400 block mt-0.5">Jam</span>
                    </div>
                    <!-- Minutes -->
                    <div class="bg-transparent border border-white/20 rounded-xl py-2 px-1 text-center">
                        <span x-text="minutes" class="text-xl font-serif font-bold text-white">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-400 block mt-0.5">Menit</span>
                    </div>
                    <!-- Seconds -->
                    <div class="bg-transparent border border-white/20 rounded-xl py-2 px-1 text-center">
                        <span x-text="seconds" class="text-xl font-serif font-bold text-rustic-gold">00</span>
                        <span class="text-[8px] uppercase tracking-wider text-gray-400 block mt-0.5">Detik</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- STRIPE BAR SEPARATOR -->
        <div class="stripe-bar"></div>

        <!-- SEKSI PROFIL MEMPELAI (The Couple) -->
        <div class="py-20 px-8 bg-white relative z-10 flex flex-col" id="mempelai">
            
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1 block">Introducing</span>
                <h2 class="font-serif text-3xl text-black">Kedua Mempelai</h2>
                <div class="w-12 h-[1.5px] bg-black mx-auto mt-4"></div>
            </div>

            <!-- Mempelai Wanita -->
            <div class="flex flex-col items-center mb-16">
                <!-- Portrait border frame for photo -->
                <div class="relative w-44 h-60 border-4 double border-black p-1 bg-white shadow-sm mb-6" data-aos="fade-up">
                    <img src="{{ $bg['bride'] }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                </div>
                
                <h3 class="font-serif text-3xl font-bold text-black tracking-wide" data-aos="fade-up">{{ $couple['bride'] }}</h3>
                <span class="text-[9px] uppercase tracking-widest text-rustic-gold font-bold mt-1 block" data-aos="fade-up" data-aos-delay="100">Mempelai Wanita</span>
                <p class="text-xs text-gray-500 font-serif italic max-w-xs mt-3 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Putri tercinta dari:<br>
                    <span class="font-sans font-bold text-black not-italic text-[10px] uppercase tracking-wider block mt-1">{{ $couple['parents']['bride'] }}</span>
                </p>
            </div>

            <!-- Divider -->
            <div class="w-20 h-[1px] bg-black/10 mx-auto my-6" data-aos="zoom-in"></div>

            <!-- Mempelai Pria -->
            <div class="flex flex-col items-center">
                <!-- Portrait border frame for photo -->
                <div class="relative w-44 h-60 border-4 double border-black p-1 bg-white shadow-sm mb-6" data-aos="fade-up">
                    <img src="{{ $bg['groom'] }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-500">
                </div>
                
                <h3 class="font-serif text-3xl font-bold text-black tracking-wide" data-aos="fade-up">{{ $couple['groom'] }}</h3>
                <span class="text-[9px] uppercase tracking-widest text-rustic-gold font-bold mt-1 block" data-aos="fade-up" data-aos-delay="100">Mempelai Pria</span>
                <p class="text-xs text-gray-500 font-serif italic max-w-xs mt-3 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                    Putra tercinta dari:<br>
                    <span class="font-sans font-bold text-black not-italic text-[10px] uppercase tracking-wider block mt-1">{{ $couple['parents']['groom'] }}</span>
                </p>
            </div>

        </div>

        <!-- STRIPE BAR SEPARATOR -->
        <div class="stripe-bar"></div>

        <!-- SEKSI DETAIL ACARA & AKSES MAPS -->
        <div class="py-20 px-8 bg-[#0a0a0a] text-white relative z-10" id="acara">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-rustic-gold font-bold mb-1 block">Details</span>
                <h2 class="font-serif text-3xl text-white">Agenda Acara</h2>
                <div class="w-12 h-[1px] bg-rustic-gold mx-auto mt-4"></div>
            </div>

            <div class="space-y-8 max-w-sm mx-auto">
                <!-- Akad Card -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative overflow-hidden text-left" data-aos="fade-up">
                    <div class="absolute top-0 right-0 w-16 h-16 border-r border-t border-rustic-gold/20 rounded-tr-2xl"></div>
                    
                    <h3 class="font-serif text-xl text-white font-bold tracking-wide mb-1">Akad Nikah</h3>
                    <span class="text-[9px] text-rustic-gold uppercase tracking-widest font-bold block mb-4">Sacred Covenant</span>
                    
                    <div class="space-y-2 text-xs text-gray-300 font-sans">
                        <div class="flex gap-2">
                            <span class="font-bold text-white w-20">Tanggal:</span>
                            <span class="flex-1">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-bold text-white w-20">Pukul:</span>
                            <span class="flex-1">Pukul {{ $schedule[0]['time'] ?? '09:00 - 10:30' }} WIB</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-bold text-white w-20">Tempat:</span>
                            <span class="flex-1">{{ $schedule[0]['note'] ?? $event['location'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Resepsi Card -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative overflow-hidden text-left" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute top-0 right-0 w-16 h-16 border-r border-t border-rustic-gold/20 rounded-tr-2xl"></div>

                    <h3 class="font-serif text-xl text-white font-bold tracking-wide mb-1">Resepsi</h3>
                    <span class="text-[9px] text-rustic-gold uppercase tracking-widest font-bold block mb-4">Celebration Dinner</span>
                    
                    <div class="space-y-2 text-xs text-gray-300 font-sans">
                        <div class="flex gap-2">
                            <span class="font-bold text-white w-20">Tanggal:</span>
                            <span class="flex-1">{{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-bold text-white w-20">Pukul:</span>
                            <span class="flex-1">Pukul {{ $schedule[1]['time'] ?? '11:00 - 15:00' }} WIB</span>
                        </div>
                        <div class="flex gap-2">
                            <span class="font-bold text-white w-20">Tempat:</span>
                            <span class="flex-1">{{ $schedule[1]['note'] ?? $event['location'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Maps Link Card -->
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="font-serif text-lg text-white mb-1">Lokasi Pernikahan</h4>
                    <p class="text-xs text-rustic-gold font-bold mb-1">{{ $event['location'] }}</p>
                    <p class="text-[10px] text-gray-400 mb-5 leading-relaxed font-sans px-2">{{ $event['address'] }}</p>
                    
                    <a 
                        href="{{ $event['maps_url'] }}" 
                        target="_blank" 
                        rel="noopener"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 w-full bg-white hover:bg-rustic-gold text-black hover:text-white font-sans text-[10px] tracking-widest uppercase font-bold rounded-xl transition-all duration-300 border border-white/10 cursor-pointer"
                    >
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        Lihat Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- STRIPE BAR SEPARATOR -->
        <div class="stripe-bar"></div>

        <!-- SEKSI RSVP FORM & GUESTBOOK FEED -->
        <div 
            class="py-20 px-8 bg-white relative z-10" 
            id="rsvp" 
            x-data="{
                name: '',
                status: 'Hadir',
                message: '',
                wishes: [
                    { name: 'Keluarga Wijaya', status: 'Hadir', message: 'Selamat ya Haris dan Anisa! Semoga acaranya sukses dan menjadi keluarga sakinah mawaddah warahmah.', time: '2 jam yang lalu' },
                    { name: 'Putra & Sisca', status: 'Hadir', message: 'Happy Wedding guys! Doa terbaik selalu menyertai perjalanan baru kalian berdua.', time: '4 jam yang lalu' },
                    { name: 'Sarah Amanda', status: 'Tidak Hadir', message: 'Selamat berbahagia! Mohon maaf belum bisa berpartisipasi langsung di Boyolali.', time: 'Kemarin' }
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
                    alert('Terima kasih! RSVP dan doa ucapan Anda berhasil dikirim.');
                }
            }"
        >
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-1 block">RSVP</span>
                <h2 class="font-serif text-3xl text-black">Buku Tamu & RSVP</h2>
                <div class="w-12 h-[1.5px] bg-black mx-auto mt-4"></div>
            </div>

            <!-- Modern Form layout -->
            <div class="max-w-sm mx-auto bg-white border-2 border-black p-6 shadow-sm mb-10 text-left" data-aos="fade-up">
                <form @submit.prevent="submitWish()">
                    <div class="mb-5">
                        <label class="block text-[9px] font-sans font-bold text-black uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <input 
                            type="text" 
                            x-model="name"
                            required
                            placeholder="Tulis nama lengkap Anda"
                            class="w-full bg-transparent border-b-2 border-black py-2 text-xs font-sans placeholder-gray-300 focus:outline-none focus:border-rustic-gold transition duration-300 text-gray-800"
                        >
                    </div>
                    
                    <div class="mb-5">
                        <label class="block text-[9px] font-sans font-bold text-black uppercase tracking-wider mb-1">Konfirmasi Kehadiran</label>
                        <select 
                            x-model="status"
                            required
                            class="w-full bg-transparent border-b-2 border-black py-2 text-xs font-sans focus:outline-none focus:border-rustic-gold transition duration-300 text-gray-800"
                        >
                            <option value="Hadir">Saya Akan Hadir</option>
                            <option value="Tidak Hadir">Berhalangan Hadir</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-[9px] font-sans font-bold text-black uppercase tracking-wider mb-1">Doa Restu Anda</label>
                        <textarea 
                            x-model="message"
                            required
                            rows="3"
                            placeholder="Tulis doa ucapan selamat Anda..."
                            class="w-full bg-transparent border-b-2 border-black py-2 text-xs font-sans placeholder-gray-300 focus:outline-none focus:border-rustic-gold transition duration-300 resize-none text-gray-800"
                        ></textarea>
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full py-4 bg-black hover:bg-rustic-gold text-white font-sans text-[9px] tracking-widest uppercase font-bold transition duration-300 cursor-pointer"
                    >
                        Kirim Konfirmasi
                    </button>
                </form>
            </div>

            <!-- Wishes list -->
            <div class="max-w-sm mx-auto text-left" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-serif text-lg text-black font-bold mb-4 pb-2 border-b border-black/10">Doa Dari Kerabat</h3>
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1" id="wishes-container">
                    <template x-for="wish in wishes" :key="wish.name + wish.time">
                        <div class="bg-white p-4 border border-black/10 text-left relative shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-serif font-bold text-black text-sm" x-text="wish.name"></span>
                                <span class="text-[8px] uppercase tracking-wider px-2 py-0.5 rounded font-bold border" 
                                      :class="wish.status === 'Hadir' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200'"
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
        <div class="py-16 px-8 bg-black text-center text-white relative z-10">
            <div class="w-12 h-12 border border-white/20 rounded-full flex items-center justify-center mb-6 mx-auto">
                <span class="font-serif text-xs text-white">A & H</span>
            </div>
            <p class="font-serif italic text-sm text-gray-300 max-w-xs mx-auto mb-6">
                Suatu kehormatan bagi kami atas kehadiran doa dan restu dari kerabat sekalian.
            </p>
            <h3 class="font-serif text-2xl text-white font-light tracking-wide mb-1">Anisa & Haris</h3>
            <p class="text-[8px] uppercase tracking-widest text-gray-500 font-sans">© 2026 TemuRuang. All Rights Reserved.</p>
        </div>

    </div>

    <!-- AOS.js script inclusion -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Keep AOS initialized after layout loads fully
        });
    </script>
</body>
</html>
