<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Seminar - Tech Innovators Summit</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #0B3954;
            --secondary-color: #087E8B;
            --accent-color: #FF5A5F;
            --bg-light: #F5F5F5;
            --text-dark: #333333;
            
            --font-heading: 'Montserrat', sans-serif;
            --font-body: 'Open Sans', sans-serif;
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
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
            padding-bottom: 70px;
        }

        h1, h2, h3, h4 {
            font-family: var(--font-heading);
            color: var(--primary-color);
        }

        /* Hero */
        #hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            background: linear-gradient(135deg, rgba(11, 57, 84, 0.9), rgba(8, 126, 139, 0.9)), url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            color: #fff;
            padding: 0 20px;
        }

        .event-badge {
            background: var(--accent-color);
            color: #fff;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #fff;
            line-height: 1.2;
        }

        .hero-date {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .hero-date span {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-register {
            display: inline-block;
            padding: 15px 40px;
            background-color: var(--accent-color);
            color: #fff;
            text-decoration: none;
            font-family: var(--font-heading);
            font-weight: 700;
            border-radius: 5px;
            font-size: 1.1rem;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(255, 90, 95, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 90, 95, 0.6);
            background-color: #ff4046;
        }

        /* Speakers */
        #speakers {
            padding: 100px 20px;
            background: #fff;
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 4rem;
            font-size: 1.1rem;
        }

        .speaker-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .speaker-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .speaker-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .speaker-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            filter: grayscale(20%);
            transition: 0.3s;
        }

        .speaker-card:hover .speaker-img {
            filter: grayscale(0%);
        }

        .speaker-info {
            padding: 20px;
        }

        .speaker-name {
            font-size: 1.3rem;
            margin-bottom: 5px;
        }

        .speaker-role {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .speaker-social {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .speaker-social a {
            color: #999;
            transition: 0.3s;
        }

        .speaker-social a:hover {
            color: var(--primary-color);
        }

        /* Schedule */
        #schedule {
            padding: 100px 20px;
            background: var(--bg-light);
        }

        .schedule-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .schedule-item {
            display: flex;
            background: #fff;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
            overflow: hidden;
            border-left: 5px solid var(--secondary-color);
        }

        .schedule-time {
            background: var(--primary-color);
            color: #fff;
            padding: 30px 20px;
            min-width: 150px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .schedule-time span {
            font-weight: 700;
            font-size: 1.2rem;
            font-family: var(--font-heading);
        }

        .schedule-content {
            padding: 30px;
            flex-grow: 1;
        }

        .schedule-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .schedule-speaker {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            font-size: 0.9rem;
        }

        .schedule-speaker img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
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
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        .nav-item {
            color: #999;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: var(--font-heading);
            transition: 0.3s;
        }

        .nav-item.active, .nav-item:hover {
            color: var(--primary-color);
        }

        .nav-item i {
            font-size: 1.4rem;
            margin-bottom: 4px;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .hero-date { flex-direction: column; gap: 10px; }
            .schedule-item { flex-direction: column; }
            .schedule-time { padding: 15px; min-width: auto; }
        }
    </style>
</head>
<body>

    <div id="hero">
        <div data-aos="fade-up" data-aos-duration="1000">
            <span class="event-badge">Tech Conference 2026</span>
            <h1 class="hero-title">Future of<br>Artificial Intelligence</h1>
            <div class="hero-date">
                <span><i class="far fa-calendar-alt"></i> 15 November 2026</span>
                <span><i class="far fa-clock"></i> 08:00 - 17:00 WIB</span>
                <span><i class="fas fa-map-marker-alt"></i> Grand Hyatt, Jakarta</span>
            </div>
            <a href="#register" class="btn-register">Register Now</a>
        </div>
    </div>

    <div id="speakers">
        <h2 class="section-title" data-aos="fade-up">Keynote Speakers</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Learn from the brightest minds in the industry</p>
        
        <div class="speaker-grid">
            <div class="speaker-card" data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Speaker 1" class="speaker-img">
                <div class="speaker-info">
                    <h3 class="speaker-name">Dr. Jonathan Vance</h3>
                    <p class="speaker-role">Head of AI Research, TechCorp</p>
                    <div class="speaker-social">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="speaker-card" data-aos="fade-up" data-aos-delay="300">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Speaker 2" class="speaker-img">
                <div class="speaker-info">
                    <h3 class="speaker-name">Sarah Jenkins, Ph.D</h3>
                    <p class="speaker-role">Chief Data Scientist, DataX</p>
                    <div class="speaker-social">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="speaker-card" data-aos="fade-up" data-aos-delay="400">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Speaker 3" class="speaker-img">
                <div class="speaker-info">
                    <h3 class="speaker-name">Michael Chang</h3>
                    <p class="speaker-role">CEO, Neural Web Solutions</p>
                    <div class="speaker-social">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="schedule">
        <div class="schedule-container">
            <h2 class="section-title text-center" style="text-align: center; margin-bottom: 3rem;" data-aos="fade-up">Event Agenda</h2>
            
            <div class="schedule-item" data-aos="fade-left" data-aos-delay="100">
                <div class="schedule-time">
                    <span>08:00</span>
                    <span style="font-size: 0.9rem; font-weight: normal; margin-top: 5px;">09:00</span>
                </div>
                <div class="schedule-content">
                    <h3 class="schedule-title">Registration & Morning Coffee</h3>
                    <p style="color: #666; font-size: 0.95rem;">Check-in and networking with other attendees in the main lobby.</p>
                </div>
            </div>

            <div class="schedule-item" data-aos="fade-left" data-aos-delay="200">
                <div class="schedule-time" style="background: var(--secondary-color);">
                    <span>09:00</span>
                    <span style="font-size: 0.9rem; font-weight: normal; margin-top: 5px;">10:30</span>
                </div>
                <div class="schedule-content">
                    <h3 class="schedule-title">The Evolution of Machine Learning</h3>
                    <p style="color: #666; font-size: 0.95rem; margin-bottom: 15px;">Exploring the rapid advancements in neural networks over the past decade.</p>
                    <div class="schedule-speaker">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Dr. Vance">
                        <span><strong>Dr. Jonathan Vance</strong></span>
                    </div>
                </div>
            </div>
            
            <div class="schedule-item" data-aos="fade-left" data-aos-delay="300">
                <div class="schedule-time" style="background: var(--secondary-color);">
                    <span>11:00</span>
                    <span style="font-size: 0.9rem; font-weight: normal; margin-top: 5px;">12:30</span>
                </div>
                <div class="schedule-content">
                    <h3 class="schedule-title">Ethics in Generative AI</h3>
                    <p style="color: #666; font-size: 0.95rem; margin-bottom: 15px;">Navigating the complex moral landscape of artificial intelligence.</p>
                    <div class="schedule-speaker">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Sarah Jenkins">
                        <span><strong>Sarah Jenkins, Ph.D</strong></span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <nav class="bottom-nav">
        <a href="#hero" class="nav-item active"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="#speakers" class="nav-item"><i class="fas fa-microphone"></i><span>Speakers</span></a>
        <a href="#schedule" class="nav-item"><i class="fas fa-list-alt"></i><span>Agenda</span></a>
        <a href="#register" class="nav-item"><i class="fas fa-ticket-alt"></i><span>RSVP</span></a>
    </nav>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true });
        
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(n => n.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>
