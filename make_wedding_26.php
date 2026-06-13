<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 26 | Minimalist Line Art</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #ffffff;
            --text-color: #2c2c2c;
            --border-color: #e0e0e0;
            --font-script: 'Alex Brush', cursive;
            --font-sans: 'Jost', sans-serif;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: var(--font-sans);
            font-weight: 300;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 450px;
            margin: 0 auto;
            border-left: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            min-height: 100vh;
            position: relative;
        }

        .script { font-family: var(--font-script); font-size: 3.5rem; color: var(--text-color); }
        h1, h2, h3 { font-weight: 400; text-align: center; }

        /* Thin borders decoration */
        .border-box {
            border: 1px solid var(--border-color);
            padding: 30px;
            margin: 20px;
            position: relative;
        }
        .border-box::before, .border-box::after {
            content: ''; position: absolute; width: 10px; height: 10px; border: 1px solid var(--text-color);
        }
        .border-box::before { top: -5px; left: -5px; background: white; }
        .border-box::after { bottom: -5px; right: -5px; background: white; }

        /* Hero */
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .hero-img-container {
            width: 250px;
            height: 350px;
            border: 1px solid var(--border-color);
            padding: 10px;
            margin-bottom: 30px;
            position: relative;
        }
        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(20%) grayscale(40%);
        }
        .date-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            font-size: 0.85rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .date-line span { width: 40px; height: 1px; background: var(--text-color); }

        /* Section */
        .section { padding: 60px 20px; }
        
        .title-line { text-align: center; margin-bottom: 40px; }
        .title-line span { display: block; font-size: 0.7rem; letter-spacing: 4px; text-transform: uppercase; margin-bottom: 10px; }
        
        /* Arch Image */
        .arch-img {
            width: 160px;
            height: 220px;
            object-fit: cover;
            border-radius: 80px 80px 0 0;
            border: 1px solid var(--border-color);
            padding: 5px;
        }
        .couple-block { text-align: center; margin-bottom: 40px; }
        .couple-block h3 { margin-top: 15px; font-size: 1.5rem; letter-spacing: 2px; }
        .couple-block p { font-size: 0.85rem; color: #888; margin-top: 5px; }

        .line-divider { width: 1px; height: 80px; background: var(--border-color); margin: 0 auto 40px; }

        /* Event Details */
        .event-detail { text-align: center; margin-bottom: 50px; }
        .event-detail h3 { font-family: var(--font-script); font-size: 2.5rem; margin-bottom: 15px; }
        .event-detail p { font-size: 0.9rem; line-height: 1.6; margin-bottom: 5px; }
        .btn-outline {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 30px;
            border: 1px solid var(--text-color);
            color: var(--text-color);
            text-decoration: none;
            font-size: 0.75rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .btn-outline:hover { background: var(--text-color); color: white; }

        /* Form */
        input, select, textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: none;
            border-bottom: 1px solid var(--border-color);
            font-family: var(--font-sans);
            font-size: 0.85rem;
            background: transparent;
        }
        input:focus, select:focus, textarea:focus { outline: none; border-bottom-color: var(--text-color); }
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--text-color);
            color: white;
            border: none;
            font-family: var(--font-sans);
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 0.8rem;
            cursor: pointer;
            margin-top: 10px;
        }

    </style>
</head>
<body>

<div class="container">
    
    <!-- Hero -->
    <section class="hero">
        <div class="hero-img-container" data-aos="fade-down" data-aos-duration="1500">
            <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=600&auto=format&fit=crop" class="hero-img" alt="Cover">
        </div>
        <div data-aos="fade-up" data-aos-delay="300">
            <h1 class="script">Nadya & Raka</h1>
            <div class="date-line">
                <span></span> 12 . 12 . 2026 <span></span>
            </div>
        </div>
    </section>

    <div class="line-divider"></div>

    <!-- Couple -->
    <section class="section">
        <div class="title-line" data-aos="fade-up">
            <span>The Groom & Bride</span>
        </div>
        
        <div class="couple-block" data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop" class="arch-img" alt="Bride">
            <h3>NADYA</h3>
            <p>Daughter of Mr. Setiawan & Mrs. Ratna</p>
        </div>

        <div class="script" style="text-align:center; margin:-20px 0 20px; font-size: 2.5rem; color:#ccc;">and</div>

        <div class="couple-block" data-aos="fade-up">
            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop" class="arch-img" alt="Groom">
            <h3>RAKA</h3>
            <p>Son of Mr. Budi & Mrs. Siti</p>
        </div>
    </section>

    <!-- Event -->
    <section class="section" style="background-color: #fafafa;">
        <div class="border-box" data-aos="fade-up">
            <div class="title-line">
                <span>Save The Date</span>
            </div>
            
            <div class="event-detail">
                <h3>Matrimony</h3>
                <p>Saturday, December 12th 2026</p>
                <p>09:00 AM</p>
                <p style="margin-top: 15px; font-size: 0.8rem; color:#777;">Hotel Mulia, Jakarta</p>
                <a href="#" class="btn-outline">View Map</a>
            </div>

            <div class="line-divider" style="height:40px;"></div>

            <div class="event-detail" style="margin-bottom: 0;">
                <h3>Reception</h3>
                <p>Saturday, December 12th 2026</p>
                <p>19:00 PM</p>
                <p style="margin-top: 15px; font-size: 0.8rem; color:#777;">Hotel Mulia, Jakarta</p>
                <a href="#" class="btn-outline">View Map</a>
            </div>
        </div>
    </section>

    <!-- RSVP -->
    <section class="section">
        <div class="title-line" data-aos="fade-up">
            <span>Join Us</span>
            <h2 class="script" style="margin-top:10px;">Rsvp</h2>
        </div>
        
        <div style="padding: 0 20px;" data-aos="fade-up">
            <form>
                <input type="text" placeholder="Full Name" required>
                <select required>
                    <option value="" disabled selected>Attendance</option>
                    <option value="yes">Will Attend</option>
                    <option value="no">Cannot Attend</option>
                </select>
                <textarea rows="3" placeholder="Wishes" required></textarea>
                <button type="button" class="btn-submit">Submit</button>
            </form>
        </div>
    </section>

    <div style="text-align: center; padding: 40px; border-top: 1px solid var(--border-color);">
        <p style="font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase;">Temuruang &copy; 2026</p>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1200, offset: 50 });
</script>
</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-26.blade.php', $content);

$et = \App\Models\EventType::where('name', 'Pernikahan')->first();
if ($et) {
    \App\Models\Template::firstOrCreate(
        ['slug' => 'wedding-26'],
        [
            'event_type_id' => $et->id,
            'name' => 'Wedding 26 (Minimalist Line Art)',
            'description' => 'Desain putih bersih dengan garis-garis tepi yang tipis (line art), font script yang indah, dan banyak ruang kosong (negative space) untuk kesan eksklusif.',
            'is_premium' => true,
            'is_active' => true
        ]
    );
    echo "wedding-26 template created and inserted.\n";
}
