<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 24 | Editorial Style</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Icons & Animation -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        /* CSS Reset & Variables */
        :root {
            --bg-light: #F9F8F6;
            --text-dark: #2A2A2A;
            --accent: #A8896C;
            --serif: 'Cormorant Garamond', serif;
            --sans: 'Montserrat', sans-serif;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            background-color: #1a1a1a;
            color: var(--text-dark);
            font-family: var(--sans);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Mobile Wrapper */
        .wrapper {
            max-width: 430px;
            margin: 0 auto;
            background-color: var(--bg-light);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
            padding-bottom: 70px; /* Space for bottom nav */
        }

        /* Typography */
        h1, h2, h3, h4, .serif { font-family: var(--serif); font-weight: 400; }
        .text-accent { color: var(--accent); }
        .text-center { text-align: center; }
        .subtitle { 
            font-size: 0.75rem; 
            letter-spacing: 0.2em; 
            text-transform: uppercase; 
            color: var(--accent);
            margin-bottom: 10px;
        }

        /* Hero Section - Parallax */
        .hero {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800&auto=format&fit=crop') center/cover no-repeat fixed;
            color: white;
            text-align: center;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.6));
        }
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 20px;
        }
        .hero h1 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin: 15px 0;
            font-style: italic;
        }
        .date-badge {
            display: inline-block;
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            padding: 10px 0;
            font-size: 0.85rem;
            letter-spacing: 0.15em;
        }

        /* Section Global */
        .section { padding: 80px 30px; }
        
        /* Couple Section - Editorial Overlap */
        .couple-section {
            background: var(--bg-light);
            border-radius: 30px 30px 0 0;
            margin-top: -40px;
            position: relative;
            z-index: 10;
            text-align: center;
        }
        .person { margin-bottom: 40px; }
        .person-img {
            width: 160px;
            height: 220px;
            object-fit: cover;
            border-radius: 80px 80px 0 0;
            margin-bottom: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .person h2 { font-size: 2.2rem; margin-bottom: 5px; color: var(--text-dark); }
        .person p { font-size: 0.8rem; color: #666; line-height: 1.5; }
        .ampersand { font-size: 3.5rem; color: #E5D5C5; margin: -20px 0 20px; line-height: 1; }

        /* Event Section - Minimal Cards */
        .event-section {
            background-color: #fff;
        }
        .event-card {
            border: 1px solid #EAEAEA;
            padding: 30px;
            margin-bottom: 20px;
            position: relative;
        }
        .event-card::before {
            content: '';
            position: absolute;
            top: 10px; left: 10px; right: 10px; bottom: 10px;
            border: 1px solid var(--accent);
            opacity: 0.3;
            pointer-events: none;
        }
        .event-title { font-size: 1.8rem; margin-bottom: 15px; color: var(--accent); }
        .event-detail { font-size: 0.9rem; margin-bottom: 10px; line-height: 1.6; }
        .btn-outline {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 25px;
            border: 1px solid var(--text-dark);
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: all 0.3s;
        }
        .btn-outline:hover { background: var(--text-dark); color: white; }

        /* RSVP Form */
        .rsvp-section { background: var(--bg-light); }
        .form-control {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            background: transparent;
            font-family: var(--sans);
            font-size: 0.9rem;
        }
        .form-control:focus { outline: none; border-color: var(--accent); }
        .btn-solid {
            width: 100%;
            padding: 15px;
            background: var(--accent);
            color: white;
            border: none;
            font-family: var(--sans);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 430px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-around;
            padding: 12px 0;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
            z-index: 100;
        }
        .nav-item {
            text-align: center;
            color: #999;
            text-decoration: none;
            font-size: 0.7rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            transition: color 0.3s;
        }
        .nav-item i { font-size: 1.2rem; }
        .nav-item.active { color: var(--accent); }
    </style>
</head>
<body>

<div class="wrapper">
    
    <!-- Hero -->
    <section class="hero" id="home">
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
            <div class="subtitle text-white">The Wedding Of</div>
            <h1>Raka<br>&<br>Nadya</h1>
            <div class="date-badge mt-3">12 . 12 . 2026</div>
        </div>
    </section>

    <!-- Couple -->
    <section class="section couple-section" id="couple">
        <div data-aos="fade-up">
            <div class="subtitle">Bride & Groom</div>
            <h2 class="serif mb-5 text-accent" style="font-size: 2rem;">Om Swastiastu</h2>
            
            <div class="person">
                <img src="https://images.unsplash.com/photo-1606800052052-a08af7148866?q=80&w=400&auto=format&fit=crop" class="person-img" alt="Bride">
                <h2>Nadya</h2>
                <p>Putri pertama dari<br>Bpk. Made & Ibu Wayan</p>
            </div>
            
            <div class="ampersand serif">&</div>
            
            <div class="person">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop" class="person-img" alt="Groom">
                <h2>Raka</h2>
                <p>Putra kedua dari<br>Bpk. Ketut & Ibu Nyoman</p>
            </div>
        </div>
    </section>

    <!-- Event -->
    <section class="section event-section text-center" id="event">
        <div data-aos="fade-up">
            <div class="subtitle">Save The Date</div>
            <h2 class="serif mb-4" style="font-size: 2.5rem;">Acara Kami</h2>
            
            <div class="event-card">
                <h3 class="event-title serif">Akad Nikah</h3>
                <div class="event-detail">
                    <strong>Sabtu, 12 Desember 2026</strong><br>
                    09:00 WITA - Selesai
                </div>
                <div class="event-detail mt-3">
                    <strong>Gedung Harmoni Bali</strong><br>
                    Jl. Melati No. 10, Denpasar
                </div>
                <a href="#" class="btn-outline"><i class="bi bi-geo-alt"></i> Maps</a>
            </div>

            <div class="event-card">
                <h3 class="event-title serif">Resepsi</h3>
                <div class="event-detail">
                    <strong>Sabtu, 12 Desember 2026</strong><br>
                    18:00 WITA - Selesai
                </div>
                <div class="event-detail mt-3">
                    <strong>Gedung Harmoni Bali</strong><br>
                    Jl. Melati No. 10, Denpasar
                </div>
                <a href="#" class="btn-outline"><i class="bi bi-geo-alt"></i> Maps</a>
            </div>
        </div>
    </section>

    <!-- RSVP -->
    <section class="section rsvp-section text-center" id="rsvp">
        <div data-aos="fade-up">
            <div class="subtitle">Kehadiran</div>
            <h2 class="serif mb-4" style="font-size: 2.5rem;">RSVP</h2>
            <p class="mb-4" style="font-size: 0.85rem; color: #666;">Merupakan suatu kehormatan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir memberikan doa restu.</p>
            
            <form>
                <input type="text" class="form-control" placeholder="Nama Anda" required>
                <select class="form-control" required>
                    <option value="">Apakah Anda akan hadir?</option>
                    <option value="1">Ya, Saya Hadir</option>
                    <option value="0">Maaf, Tidak Bisa Hadir</option>
                </select>
                <textarea class="form-control" rows="3" placeholder="Pesan & Doa" required></textarea>
                <button type="button" class="btn-solid">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- Bottom Nav -->
    <nav class="bottom-nav">
        <a href="#home" class="nav-item active">
            <i class="bi bi-house-door"></i>
            <span>Home</span>
        </a>
        <a href="#couple" class="nav-item">
            <i class="bi bi-heart"></i>
            <span>Couple</span>
        </a>
        <a href="#event" class="nav-item">
            <i class="bi bi-calendar-event"></i>
            <span>Event</span>
        </a>
        <a href="#rsvp" class="nav-item">
            <i class="bi bi-envelope-paper"></i>
            <span>RSVP</span>
        </a>
    </nav>

</div>

<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS animation
    AOS.init({ once: true, offset: 50 });

    // Highlight bottom nav on scroll
    const sections = document.querySelectorAll("section");
    const navItems = document.querySelectorAll(".nav-item");

    window.addEventListener("scroll", () => {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= sectionTop - 150) {
                current = section.getAttribute("id");
            }
        });

        navItems.forEach((item) => {
            item.classList.remove("active");
            if (item.getAttribute("href").includes(current)) {
                item.classList.add("active");
            }
        });
    });
</script>
</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-24.blade.php', $content);

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::firstOrCreate(
        ['slug' => 'wedding-24'],
        [
            'event_type_id' => $et->id,
            'name' => 'Wedding 24 (Editorial Long-Scroll)',
            'description' => 'Layout yang sangat berbeda: long scroll tanpa snap, desain ala majalah, navigasi menu di bawah, dan font Serif besar.',
            'is_premium' => true,
            'is_active' => true
        ]
    );
    echo "wedding-24 template created and inserted.\n";
}
