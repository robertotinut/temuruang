<?php
$content = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding 01 | Classic Floral Split</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Quicksand:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #947a61;
            --bg-color: #fcfbf9;
            --text-color: #4a4a4a;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Quicksand', sans-serif;
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: var(--font-sans);
            color: var(--text-color);
            background-color: var(--bg-color);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, .serif {
            font-family: var(--font-serif);
            font-weight: 400;
        }

        /* Split Screen Layout */
        .split-layout {
            display: flex;
            min-height: 100vh;
        }

        .split-left {
            width: 50%;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            background: url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=1000&auto=format&fit=crop') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .split-left::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.3);
        }

        .left-content {
            position: relative;
            z-index: 10;
            color: white;
            text-align: center;
            padding: 40px;
            border: 2px solid rgba(255,255,255,0.8);
            margin: 40px;
            background: rgba(0,0,0,0.2);
            backdrop-filter: blur(5px);
        }

        .left-content h1 { font-size: 3.5rem; margin-bottom: 10px; }
        .left-content p { letter-spacing: 3px; text-transform: uppercase; font-size: 0.9rem; }

        .split-right {
            width: 50%;
            margin-left: 50%; /* offset for fixed left */
            background-color: var(--bg-color);
            padding: 80px 10%;
        }

        /* Mobile specific */
        @media (max-width: 991px) {
            .split-layout { flex-direction: column; }
            .split-left {
                width: 100%;
                position: relative;
                height: 100vh;
            }
            .left-content { margin: 20px; padding: 30px; }
            .split-right {
                width: 100%;
                margin-left: 0;
                padding: 60px 20px;
            }
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        .section-title h2 { font-size: 2.5rem; color: var(--primary); }
        .section-title span { display: block; font-size: 0.8rem; letter-spacing: 4px; text-transform: uppercase; margin-bottom: 15px; color: #888; }
        
        .floral-divider {
            width: 100px;
            height: auto;
            margin: 0 auto 20px;
            opacity: 0.7;
        }

        /* Couple */
        .couple-box { text-align: center; margin-bottom: 40px; }
        .couple-img {
            width: 150px; height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 3px solid #eee;
            padding: 5px;
        }
        .couple-box h3 { font-size: 1.8rem; margin-bottom: 10px; color: var(--text-color); }
        
        .ampersand { font-family: var(--font-serif); font-size: 3rem; color: var(--primary); text-align: center; margin: -20px 0 20px; }

        /* Event Cards */
        .event-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 30px;
            border-top: 5px solid var(--primary);
        }
        .event-card h3 { font-size: 1.8rem; margin-bottom: 15px; color: var(--text-color); }
        .btn-floral {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 30px;
            font-size: 0.85rem;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-floral:hover { background: #7a634c; color: #fff; }

        /* RSVP Form */
        .form-control {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            font-family: var(--font-sans);
        }
        .form-control:focus { outline: none; border-color: var(--primary); }
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: var(--font-sans);
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
        }
        
        .section { margin-bottom: 80px; }
    </style>
</head>
<body>

<div class="split-layout">
    
    <!-- Left Fixed Area -->
    <div class="split-left">
        <div class="left-content" data-aos="zoom-in" data-aos-duration="1500">
            <h1>Raka & Nadya</h1>
            <p>12 Desember 2026</p>
        </div>
    </div>

    <!-- Right Scrollable Area -->
    <div class="split-right">
        
        <!-- Opening -->
        <div class="section text-center" data-aos="fade-up">
            <svg class="floral-divider" viewBox="0 0 100 30" fill="var(--primary)"><path d="M50 15c-10-15-30-15-40 0 10 15 30 15 40 0zm0 0c10-15 30-15 40 0-10 15-30 15-40 0z"/></svg>
            <p class="mb-4">Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah semoga ridho-Mu tercurah mengiringi pernikahan putra-putri kami.</p>
        </div>

        <!-- Couple -->
        <div class="section" data-aos="fade-up">
            <div class="section-title">
                <span>The Bride & Groom</span>
                <h2>Mempelai</h2>
            </div>
            
            <div class="couple-box">
                <img src="https://images.unsplash.com/photo-1546525848-3ce03ca516f6?q=80&w=400&auto=format&fit=crop" alt="Bride" class="couple-img">
                <h3>Nadya Maharani</h3>
                <p>Putri pertama dari<br>Bpk. Setiawan & Ibu Ratna</p>
            </div>
            
            <div class="ampersand">&</div>
            
            <div class="couple-box">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=400&auto=format&fit=crop" alt="Groom" class="couple-img">
                <h3>Raka Pratama</h3>
                <p>Putra kedua dari<br>Bpk. Budi & Ibu Siti</p>
            </div>
        </div>

        <!-- Event -->
        <div class="section" data-aos="fade-up">
            <div class="section-title">
                <span>Save The Date</span>
                <h2>Acara Kami</h2>
            </div>

            <div class="event-card">
                <i class="bi bi-heart" style="font-size: 2rem; color: var(--primary); margin-bottom: 10px; display: block;"></i>
                <h3>Akad Nikah</h3>
                <p><strong>Sabtu, 12 Desember 2026</strong></p>
                <p>Pukul 09:00 - Selesai</p>
                <p class="mt-3"><strong>Hotel Mulia Senayan</strong><br>Jl. Asia Afrika, Jakarta</p>
                <a href="#" class="btn-floral">Lihat Peta</a>
            </div>

            <div class="event-card">
                <i class="bi bi-stars" style="font-size: 2rem; color: var(--primary); margin-bottom: 10px; display: block;"></i>
                <h3>Resepsi</h3>
                <p><strong>Sabtu, 12 Desember 2026</strong></p>
                <p>Pukul 19:00 - Selesai</p>
                <p class="mt-3"><strong>Hotel Mulia Senayan</strong><br>Jl. Asia Afrika, Jakarta</p>
                <a href="#" class="btn-floral">Lihat Peta</a>
            </div>
        </div>

        <!-- RSVP -->
        <div class="section" data-aos="fade-up">
            <div class="section-title">
                <span>Kehadiran</span>
                <h2>RSVP</h2>
            </div>
            
            <div style="background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                <form>
                    <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                    <select class="form-control" required>
                        <option value="" disabled selected>Apakah Anda akan hadir?</option>
                        <option value="hadir">Ya, Saya Hadir</option>
                        <option value="tidak">Maaf, Tidak Bisa Hadir</option>
                    </select>
                    <textarea class="form-control" rows="4" placeholder="Pesan dan Doa untuk Mempelai" required></textarea>
                    <button type="button" class="btn-submit">Kirim Pesan</button>
                </form>
            </div>
        </div>
        
        <div class="text-center" style="padding-top: 40px;">
            <p style="font-size: 0.8rem; color: #999;">Made with ♥ by TemuRuang</p>
        </div>

    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, duration: 1000, offset: 50 });
</script>
</body>
</html>
HTML;

file_put_contents('d:/Project/temuruang/resources/views/templates/wedding/wedding-01.blade.php', $content);

$template = \App\Models\Template::where('slug', 'wedding-01')->first();
if ($template) {
    $template->update([
        'name' => 'Wedding 01 (Classic Split-Screen)',
        'description' => 'Layout terbagi dua pada desktop dengan gambar tetap di kiri dan konten yang dapat digulir di kanan.'
    ]);
    echo "wedding-01 redesigned.\n";
}
