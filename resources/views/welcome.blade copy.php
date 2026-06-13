<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>TemuRuang - Premium Digital Invitation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Platform Undangan Digital Premium & Interaktif" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-glow: #ff4d4d;
            --secondary-glow: #ff9933;
            --bg-dark: #0f172a;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            color: #f8fafc;
            overflow-x: hidden;
        }
        /* Glassmorphism Navbar */
        .navbar {
            background: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            transition: all 0.3s ease;
        }
        .navbar-brand img {
            height: 35px;
        }
        .nav-link {
            color: #cbd5e1 !important;
            font-weight: 400;
            transition: color 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff !important;
        }
        /* Hero Section */
        .hero {
            position: relative;
            padding: 160px 0 100px;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--primary-glow) 0%, rgba(255,77,77,0) 70%);
            opacity: 0.15;
            filter: blur(60px);
            z-index: -1;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--secondary-glow) 0%, rgba(255,153,51,0) 70%);
            opacity: 0.15;
            filter: blur(60px);
            z-index: -1;
        }
        .text-gradient {
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(229, 46, 113, 0.3);
            color: #fff;
        }
        .btn-glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            color: #fff;
            backdrop-filter: blur(10px);
        }
        .btn-glass:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        /* Floating Animation */
        .floating-img {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        /* Premium Cards */
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s ease;
        }
        .glass-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.15);
        }
        .template-img-wrapper {
            height: 240px;
            overflow: hidden;
        }
        .template-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .glass-card:hover .template-img-wrapper img {
            transform: scale(1.05);
        }
        /* Pricing */
        .pricing-badge {
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .section-title {
            font-weight: 700;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/logo-white.png') }}" alt="TemuRuang">
            </a>
            <button class="navbar-toggler btn-glass p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="mdi mdi-menu text-white font-size-24"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#templates">Templates</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                </ul>
                <div class="d-flex gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-gradient px-4 rounded-pill">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-glass px-4 rounded-pill">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-gradient px-4 rounded-pill">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 leading-tight">
                        Undangan Digital<br>
                        <span class="text-gradient">Lebih Elegan & Modern</span>
                    </h1>
                    <p class="lead text-secondary mb-5" style="color: #94a3b8 !important;">
                        Ciptakan kesan pertama yang tak terlupakan untuk momen spesial Anda dengan undangan digital interaktif, ramah lingkungan, dan dapat diakses di mana saja.
                    </p>
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="{{ route('register') }}" class="btn btn-gradient btn-lg rounded-pill px-5">Buat Sekarang</a>
                        <a href="#templates" class="btn btn-glass btn-lg rounded-pill px-5">Lihat Template</a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <img src="{{ asset('assets/images/verification-img.png') }}" class="img-fluid floating-img" alt="Hero Illustration">
                </div>
            </div>
        </div>
    </section>

    <!-- Templates -->
    <section id="templates" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">Pilihan <span class="text-gradient">Template</span></h2>
                <p class="text-secondary" style="color: #94a3b8 !important;">Desain eksklusif yang dirancang khusus untuk memukau tamu Anda.</p>
            </div>
            <div class="row g-4">
                @forelse($templates as $template)
                <div class="col-lg-4 col-md-6">
                    <div class="glass-card h-100">
                        <div class="template-img-wrapper position-relative">
                            @if($template->thumbnail)
                                <img src="{{ asset('storage/' . $template->thumbnail) }}" alt="{{ $template->name }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-dark">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            @if($template->is_premium)
                                <div class="position-absolute top-0 end-0 m-3 pricing-badge">
                                    <i class="mdi mdi-star"></i> Premium
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="mb-2">{{ $template->name }}</h4>
                            <p class="text-secondary mb-0" style="color: #94a3b8 !important; font-size: 0.9rem;">
                                {{ Str::limit($template->description, 80) }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Template belum tersedia saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="py-5" style="background: rgba(15, 23, 42, 0.3);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title display-5">Paket <span class="text-gradient">Harga</span></h2>
                <p class="text-secondary" style="color: #94a3b8 !important;">Pilih paket yang paling sesuai dengan kebutuhan acara Anda.</p>
            </div>
            <div class="row justify-content-center g-4">
                @forelse($packages as $package)
                <div class="col-lg-4 col-md-6">
                    <div class="glass-card h-100 p-5 text-center position-relative">
                        <h4 class="mb-3">{{ $package->name }}</h4>
                        <h1 class="display-5 fw-bold text-white mb-4">
                            <span style="font-size: 1.5rem;">Rp</span>{{ number_format($package->price, 0, ',', '.') }}
                        </h1>
                        <ul class="list-unstyled mb-5 text-start" style="color: #cbd5e1;">
                            <li class="mb-3"><i class="mdi mdi-check-circle text-success me-2 font-size-18 align-middle"></i> {{ $package->max_template ?? 'Semua' }} Pilihan Template</li>
                            <li class="mb-3"><i class="mdi mdi-check-circle text-success me-2 font-size-18 align-middle"></i> {{ $package->max_guest ?? 'Unlimited' }} Tamu (RSVP)</li>
                            <li class="mb-3"><i class="mdi mdi-check-circle text-success me-2 font-size-18 align-middle"></i> {{ $package->max_gallery ?? 'Unlimited' }} Foto Galeri</li>
                            <li class="mb-3"><i class="mdi mdi-check-circle text-success me-2 font-size-18 align-middle"></i> Fitur Story / Timeline</li>
                            <li class="mb-3"><i class="mdi mdi-check-circle text-success me-2 font-size-18 align-middle"></i> Buku Tamu Digital</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-glass rounded-pill w-100 py-2">Pilih Paket</a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Paket harga belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4" style="background: rgba(0,0,0,0.2); border-top: 1px solid var(--glass-border);">
        <div class="container text-center">
            <p class="mb-0 text-secondary" style="color: #94a3b8 !important;">
                &copy; <script>document.write(new Date().getFullYear())</script> TemuRuang. Dibangun dengan <i class="mdi mdi-heart text-danger"></i>
            </p>
        </div>
    </footer>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
