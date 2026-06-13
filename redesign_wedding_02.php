<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 02 | Modern Brutalism</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&family=Syne:wght@600;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg: #F4F4F0;
            --text: #111111;
            --accent: #FF3B00; /* Bright Orange/Red */
            --border: 3px solid #111;
            --font-head: 'Syne', sans-serif;
            --font-body: 'Space Grotesk', sans-serif;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: var(--font-body);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 480px;
            margin: 0 auto;
            border-left: var(--border);
            border-right: var(--border);
            min-height: 100vh;
            background: #fff;
            position: relative;
        }

        h1, h2, h3 { font-family: var(--font-head); font-weight: 800; text-transform: uppercase; line-height: 0.9; }

        /* Marquee */
        .marquee {
            width: 100%;
            background: var(--accent);
            color: #fff;
            padding: 15px 0;
            overflow: hidden;
            white-space: nowrap;
            border-bottom: var(--border);
            font-family: var(--font-head);
            font-size: 1.5rem;
        }
        .marquee span {
            display: inline-block;
            animation: marquee 10s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Hero */
        .hero {
            padding: 40px 20px;
            border-bottom: var(--border);
            text-align: center;
            background: #fff;
        }
        .hero h1 { font-size: 4rem; word-break: break-all; margin-bottom: 20px; }
        .hero .date { font-size: 2rem; font-weight: 700; background: var(--text); color: #fff; display: inline-block; padding: 10px 20px; border-radius: 50px; }

        .hero-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-bottom: var(--border);
            filter: grayscale(100%) contrast(1.2);
        }

        /* Section */
        .section {
            padding: 40px 20px;
            border-bottom: var(--border);
        }
        .section-title {
            font-size: 3rem;
            margin-bottom: 30px;
            text-align: right;
            word-wrap: break-word;
        }

        /* Profiles */
        .profile {
            display: flex;
            align-items: center;
            border: var(--border);
            margin-bottom: 20px;
            background: var(--bg);
        }
        .profile img {
            width: 120px; height: 120px;
            object-fit: cover;
            border-right: var(--border);
            filter: grayscale(100%);
        }
        .profile-info { padding: 15px; }
        .profile h3 { font-size: 1.5rem; margin-bottom: 5px; }
        .profile p { font-size: 0.8rem; font-weight: 700; text-transform: uppercase; }

        .ampersand { font-size: 4rem; text-align: center; margin: 20px 0; color: var(--accent); }

        /* Events */
        .event-card {
            border: var(--border);
            padding: 20px;
            margin-bottom: 20px;
            background: #fff;
            position: relative;
            box-shadow: 8px 8px 0 var(--text);
            transition: transform 0.2s;
        }
        .event-card:hover { transform: translate(4px, 4px); box-shadow: 4px 4px 0 var(--text); }
        .event-card h3 { font-size: 2rem; margin-bottom: 10px; color: var(--accent); }
        .event-card p { font-size: 1rem; margin-bottom: 5px; font-weight: 700; }
        
        .btn-brutal {
            display: block;
            width: 100%;
            padding: 15px;
            background: var(--text);
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-family: var(--font-head);
            font-size: 1.2rem;
            margin-top: 20px;
            border: var(--border);
            transition: 0.3s;
        }
        .btn-brutal:hover { background: var(--accent); color: var(--text); }

        /* RSVP */
        .form-control {
            width: 100%;
            padding: 15px;
            border: var(--border);
            margin-bottom: 15px;
            font-family: var(--font-body);
            font-weight: 700;
            background: var(--bg);
        }
        .form-control:focus { outline: none; background: #fff; box-shadow: 4px 4px 0 var(--accent); }
        
        .footer { padding: 30px; text-align: center; background: var(--text); color: #fff; }
    </style>
</head>
<body>

<div class="container">
    
    <div class="marquee">
        <span>NADYA & RAKA &bull; WE ARE GETTING MARRIED &bull; 12.12.2026 &bull; </span>
    </div>

    <section class="hero">
        <h1 style="font-size: 5rem;">N & R</h1>
        <div class="date">12 DEC 2026</div>
    </section>

    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800&auto=format&fit=crop" alt="Couple" class="hero-img">

    <section class="section">
        <h2 class="section-title">THE<br>COUPLE</h2>
        
        <div class="profile">
            <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop" alt="Bride">
            <div class="profile-info">
                <h3>NADYA</h3>
                <p>DAUGHTER OF MR. SETIAWAN</p>
            </div>
        </div>
        
        <div class="ampersand">+</div>
        
        <div class="profile" style="flex-direction: row-reverse;">
            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop" alt="Groom" style="border-right: none; border-left: var(--border);">
            <div class="profile-info" style="text-align: right;">
                <h3>RAKA</h3>
                <p>SON OF MR. BUDI</p>
            </div>
        </div>
    </section>

    <section class="section" style="background: var(--accent);">
        <h2 class="section-title" style="color: #fff; border-bottom: 3px solid #fff; padding-bottom: 10px;">THE<br>EVENT</h2>
        
        <div class="event-card">
            <h3>AKAD</h3>
            <p>12 DEC 2026</p>
            <p>09:00 AM</p>
            <hr style="border: 1px solid var(--text); margin: 15px 0;">
            <p>HOTEL MULIA, JAKARTA</p>
            <a href="#" class="btn-brutal">MAPS -></a>
        </div>

        <div class="event-card">
            <h3>RECEPTION</h3>
            <p>12 DEC 2026</p>
            <p>07:00 PM</p>
            <hr style="border: 1px solid var(--text); margin: 15px 0;">
            <p>HOTEL MULIA, JAKARTA</p>
            <a href="#" class="btn-brutal">MAPS -></a>
        </div>
    </section>

    <section class="section">
        <h2 class="section-title">R S V P</h2>
        <form>
            <input type="text" class="form-control" placeholder="FULL NAME" required>
            <select class="form-control" required>
                <option value="" disabled selected>ATTENDING?</option>
                <option value="yes">YES</option>
                <option value="no">NO</option>
            </select>
            <textarea class="form-control" rows="4" placeholder="MESSAGE" required></textarea>
            <button type="button" class="btn-brutal" style="background: var(--accent); color: #fff;">SUBMIT</button>
        </form>
    </section>

    <div class="footer">
        <h3 style="font-size: 2rem;">TEMURUANG</h3>
        <p style="font-family: var(--font-body); font-weight: 700; margin-top: 10px;">DIGITAL INVITATION</p>
    </div>

</div>

</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-02.blade.php', $content);

$template = \App\Models\Template::where('slug', 'wedding-02')->first();
if ($template) {
    $template->update([
        'name' => 'Wedding 02 (Modern Brutalism)',
        'description' => 'Desain berani, tipografi raksasa, kontras tinggi, dan teks berjalan ala desain brutalism.'
    ]);
    echo "wedding-02 redesigned.\n";
}
