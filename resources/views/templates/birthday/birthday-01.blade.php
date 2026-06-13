<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Ulang Tahun - Sweet 17</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --color-pink: #FF006E;
            --color-yellow: #FFBE0B;
            --color-blue: #3A86FF;
            --color-purple: #8338EC;
            --color-orange: #FB5607;
            
            --font-heading: 'Fredoka One', cursive;
            --font-body: 'Nunito', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background-color: #fdfaf6;
            color: #333;
            overflow-x: hidden;
            padding-bottom: 70px;
        }

        h1, h2, h3 {
            font-family: var(--font-heading);
            font-weight: normal;
        }

        /* Confetti Animation */
        .confetti-container {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            pointer-events: none;
            z-index: 100;
            overflow: hidden;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--color-pink);
            opacity: 0;
            animation: fall linear infinite;
        }

        .confetti:nth-child(2n) { background-color: var(--color-yellow); }
        .confetti:nth-child(3n) { background-color: var(--color-blue); }
        .confetti:nth-child(4n) { background-color: var(--color-purple); }
        .confetti:nth-child(5n) { background-color: var(--color-orange); }

        @keyframes fall {
            0% { transform: translateY(-100px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(110vh) rotate(720deg); opacity: 1; }
        }

        /* Hero */
        #hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background-color: #fce4ec;
            background-image: radial-gradient(circle, #fff 20%, transparent 20%), radial-gradient(circle, #fff 20%, transparent 20%);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            padding: 20px;
        }

        .hero-content {
            background: rgba(255, 255, 255, 0.9);
            padding: 3rem 2rem;
            border-radius: 30px;
            box-shadow: 0 15px 30px rgba(255, 0, 110, 0.1);
            border: 4px dashed var(--color-pink);
            max-width: 600px;
            width: 100%;
        }

        .age-badge {
            background: var(--color-yellow);
            color: #fff;
            font-size: 1.5rem;
            font-family: var(--font-heading);
            display: inline-block;
            padding: 10px 20px;
            border-radius: 50px;
            transform: rotate(-10deg);
            margin-bottom: 10px;
            box-shadow: 3px 3px 0 var(--color-orange);
        }

        .hero-title {
            font-size: 3.5rem;
            color: var(--color-purple);
            margin: 1rem 0;
            line-height: 1.1;
            text-shadow: 3px 3px 0 rgba(131, 56, 236, 0.2);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--color-blue);
        }

        /* About / Message */
        #about {
            padding: 80px 20px;
            text-align: center;
            background: var(--color-blue);
            color: #fff;
            position: relative;
        }
        
        #about::before {
            content: '';
            position: absolute;
            top: -20px; left: 0; right: 0; height: 40px;
            background: var(--color-blue);
            border-radius: 50% 50% 0 0;
        }

        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            border: 8px solid var(--color-yellow);
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .about-text {
            font-size: 1.3rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Event Details */
        #event {
            padding: 80px 20px;
            text-align: center;
            background: var(--color-yellow);
            position: relative;
        }

        .section-title {
            font-size: 3rem;
            color: #fff;
            text-shadow: 3px 3px 0 var(--color-orange);
            margin-bottom: 2rem;
        }

        .event-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            flex: 1;
            min-width: 300px;
            box-shadow: 0 15px 0 var(--color-orange);
            border: 4px solid var(--color-orange);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 0 var(--color-orange);
        }

        .card h3 {
            font-size: 1.8rem;
            color: var(--color-pink);
            margin-bottom: 1rem;
        }

        .btn-party {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 10px 25px;
            background: var(--color-pink);
            color: #fff;
            text-decoration: none;
            font-family: var(--font-heading);
            border-radius: 50px;
            font-size: 1.2rem;
            transition: 0.3s;
            box-shadow: 0 5px 0 #c20054;
        }

        .btn-party:hover {
            transform: translateY(3px);
            box-shadow: 0 2px 0 #c20054;
        }

        /* Nav */
        .bottom-nav {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 70px;
            background: #fff;
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 999;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
            border-top: 3px solid var(--color-pink);
        }

        .nav-item {
            color: #ccc;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.8rem;
            font-family: var(--font-heading);
            transition: 0.3s;
        }

        .nav-item.active {
            color: var(--color-pink);
            transform: scale(1.1);
        }

        .nav-item:hover {
            color: var(--color-purple);
        }

        .nav-item i {
            font-size: 1.5rem;
            margin-bottom: 2px;
        }
    </style>
</head>
<body>

    <div class="confetti-container" id="confettiContainer"></div>

    <div id="hero">
        <div class="hero-content" data-aos="zoom-in" data-aos-duration="1000">
            <span class="age-badge">Sweet 17th</span>
            <h1 class="hero-title">Olivia's<br>Birthday Party</h1>
            <p class="hero-subtitle">You're invited to celebrate!</p>
            <div style="margin-top: 2rem;">
                <img src="https://cdn-icons-png.flaticon.com/512/1125/1125381.png" alt="Cake" style="width: 80px; animation: bounce 2s infinite;">
            </div>
        </div>
    </div>

    <div id="about">
        <div data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1517457497678-b1c411516e91?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Birthday Girl" class="profile-img">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; text-shadow: 2px 2px 0 var(--color-purple);">Let's Party!</h2>
            <p class="about-text">
                "It's time to eat cake, dance, and make some noise! I can't wait to celebrate my 17th birthday with all my favorite people. Don't forget to wear your best colorful outfit!"
            </p>
        </div>
    </div>

    <div id="event">
        <h2 class="section-title" data-aos="zoom-in">Where & When</h2>
        <div class="event-cards">
            <div class="card" data-aos="flip-left" data-aos-delay="100">
                <i class="fas fa-calendar-star" style="font-size: 3rem; color: var(--color-blue); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--color-blue);">Date & Time</h3>
                <p style="font-size: 1.2rem; font-weight: 700; margin-bottom: 10px;">Sunday, 12 December 2026</p>
                <p style="font-size: 1.2rem; font-weight: 700;">16:00 - Drop!</p>
            </div>
            <div class="card" data-aos="flip-right" data-aos-delay="300">
                <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: var(--color-pink); margin-bottom: 1rem;"></i>
                <h3>Location</h3>
                <p style="font-size: 1.2rem; font-weight: 700; margin-bottom: 10px;">The Wonderland Cafe</p>
                <p style="color: #666;">Jl. Bunga Melati No. 17, Jakarta</p>
                <a href="#" class="btn-party">View Map <i class="fas fa-map-marked-alt"></i></a>
            </div>
        </div>
    </div>

    <audio id="bgMusic" loop>
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-13.mp3" type="audio/mpeg">
    </audio>

    <nav class="bottom-nav">
        <a href="#hero" class="nav-item active"><i class="fas fa-gift"></i><span>Home</span></a>
        <a href="#about" class="nav-item"><i class="fas fa-user"></i><span>About</span></a>
        <a href="#event" class="nav-item"><i class="fas fa-clock"></i><span>Time</span></a>
        <a href="javascript:void(0)" class="nav-item" id="musicToggle"><i class="fas fa-music" id="musicIcon"></i><span>Play</span></a>
    </nav>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
        
        // Confetti script
        const container = document.getElementById('confettiContainer');
        for (let i = 0; i < 40; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
            confetti.style.animationDelay = Math.random() * 5 + 's';
            
            // Random shapes
            if (Math.random() > 0.5) confetti.style.borderRadius = '50%';
            
            container.appendChild(confetti);
        }

        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            if(item.id !== 'musicToggle') {
                item.addEventListener('click', function() {
                    navItems.forEach(n => { if(n.id !== 'musicToggle') n.classList.remove('active') });
                    this.classList.add('active');
                });
            }
        });

        // Music Logic
        const musicToggle = document.getElementById('musicToggle');
        const musicIcon = document.getElementById('musicIcon');
        const bgMusic = document.getElementById('bgMusic');
        let isPlaying = false;

        musicToggle.addEventListener('click', () => {
            if (isPlaying) {
                bgMusic.pause();
                musicIcon.classList.remove('fa-pause');
                musicIcon.classList.add('fa-play');
            } else {
                bgMusic.play();
                musicIcon.classList.remove('fa-play');
                musicIcon.classList.add('fa-pause');
            }
            isPlaying = !isPlaying;
        });
    </script>
</body>
</html>
