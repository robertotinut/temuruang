<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TemuRuang - Platform Undangan Digital</title>
    <meta name="author" content="TemuRuang">
    <meta name="description" content="Platform Undangan Digital Terbaik">
    <meta name="keywords" content="Platform Undangan Digital Terbaik">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="{{ asset('assets_landingpage/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets_landingpage/img/favicon.ico') }}" type="image/x-icon">

    <!--==============================
	  Google Fonts
	============================== --> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fuzzy+Bubbles:wght@400;700&family=Poppins:wght@400;500;600;700;800&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets_landingpage/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets_landingpage/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets_landingpage/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('assets_landingpage/css/slick.min.css') }}">
    <!-- animate js -->
    <link rel="stylesheet" href="{{ asset('assets_landingpage/css/animate.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets_landingpage/css/style.css') }}">

</head>

<body>


    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->



    <!--********************************
   		Code Start From Here 
	******************************** -->



    <!--==============================
	Preloader
	==============================-->
    <div class="preloader">
        <button class="vs-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
        <img src="{{ asset('assets/images/logo-white.png') }}" alt="logo">
        <span class="loader"></span>
        </div>
    </div>
    <!--==============================
    Mobile Menu
    ============================== -->
    <div class="vs-menu-wrapper">
        <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="undangan" style="width:60%"></a>
            </div>
            
<div class="vs-mobile-menu">
    <ul>
        <li><a href="{{ url('/#home') }}">Home</a></li>
        <li><a href="{{ url('/#template') }}">Template</a></li>
        <li><a href="{{ url('/#pricing') }}">Pricing</a></li>
        <!-- <li><a href="{{ route('login') }}">Login</a></li> -->
        <li><a href="{{ route('register') }}">Register</a></li>
    </ul>
</div>
        </div>
    </div>
    <!--==============================
    Popup Search Box
    ============================== -->
    <div class="popup-search-box d-none d-lg-block  ">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
        <input type="text" class="border-theme" placeholder="What are you looking for">
        <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>
    <!--==============================
    Header Area
    ==============================-->
    <header class="vs-header header-layout1">
        <div class="header-top">
            <div class="main-container2">
                <div class="row justify-content-md-between justify-content-center align-items-center">
                    <div class="col-auto d-md-block d-none">
                        <div class="header-links">
                            <ul>
                                <li><i class="far fa-envelope"></i><a href="mailto:roberto.bagas7@gmail.com">roberto.bagas7@gmail.com</a></li>
                                <li class="d-lg-inline d-none"><i class="far fa-clock"></i>Layanan 24 Jam</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="social-style1">
                            <span class="social-title">Follow Us On :</span>
                            <div class="social-icon">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <div class="menu-area">
                    <div class="main-container2">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto">
                                <div class="header-logo">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('assets/images/logo-2-white.png') }}" alt="logo" >
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                
<nav class="main-menu menu-style1 d-none d-lg-block">
    <ul>
        <li><a href="{{ url('/#home') }}">Home</a></li>
        <li><a href="{{ url('/#template') }}">Template</a></li>
        <li><a href="{{ url('/#pricing') }}">Pricing</a></li>
        <!-- <li><a href="{{ route('login') }}">Login</a></li> -->
        <li><a href="{{ route('register') }}">Register</a></li>
    </ul>
</nav>
                            </div>
                            <div class="col-auto d-lg-none">
                                <button class="vs-menu-toggle d-inline-block">
                                    <i class="fal fa-bars"></i>                                           
                               </button>
                            </div>
                            <div class="col-auto d-lg-block d-none">
                                <div class="header-inner">
                                    <div class="header-icons">
                                        <button class="searchBoxTggler"><i class="fal fa-search"></i></button>
                                        <a class="icon-btn" href="#"><i class="fa-solid fa-phone"></i></a>
                                    </div>
                                    <div class="contact-content">
                                        <p class="contact-text">Call Helpline</p>
                                        <h6 class="contact-title"><a href="tel:+012325621563">+62 858 5454 3488</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--********************************
			Start Main Content
	  ******************************** -->

      @yield('content')

  <!--********************************
			End Main Content
	******************************** -->
 
    <!--==============================
			Footer Area
	==============================-->
    <footer class="footer-wrapper  footer-layout1">
        <div class="widget-area position-relative" data-bg-src="{{ asset('assets_landingpage/img/bg/footer-bg-1-1.jpg') }}">
            <div class="container">
                <div class="row g-4 justify-content-xl-center">
                    <div class="col-xl-4 col-md-6">
                        <div class="widget footer-widget">
                            <div class="vs-widget-about">
                                <div class="footer-logo">
                                    <a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo-white.png') }}" alt="logo"></a>
                                </div>
                                <p class="footer-text">
                                    Platform pembuatan undangan digital yang mudah, cepat, elegan, dan ramah lingkungan.
                                </p>
                                <div class="contact-box">
                                    <span class="icon"><img src="{{ asset('assets_landingpage/img/icon/call-icon.svg') }}" alt="icon"></span>
                                    <div class="contact-content">
                                        
                                        <h6 class="contact-title"><a href="#">+62 858 5454 3488</a></h6>
                                        <p class="contact-text">Layanan Pelanggan</p>
                                    </div>
                                </div>
                                
                                <div class="social-style1">
                                    <span class="social-title">Ikuti Kami :</span>
                                    <div class="social-icon">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-6 ">
                        <div class="widget widget_categories  footer-widget">
                            <h3 class="widget_title">Tautan Bermanfaat</h3>
                            <ul>
                                <li><a href="#">Pusat Bantuan</a></li>
                                <li><a href="#">Tentang Kami</a></li>
                                <li><a href="#">Hubungi Kami</a></li>
                                <li><a href="#">Syarat & Ketentuan</a></li>
                                <li><a href="#">Kebijakan Privasi</a></li>
                                <li><a href="#">Pilihan Tema</a></li>
                                <li><a href="#">Paket Harga</a></li>
                                <li><a href="#">Testimoni</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="widget footer-widget">
                            <h3 class="widget_title">Berlangganan</h3>
                            <p class="footer-text mb-4">Dapatkan info promo dan update tema undangan terbaru langsung ke email Anda.</p>
                            <form action="#" class="newsletter-form">
                                <input type="email" class="form-control mb-3" placeholder="Masukkan Email Anda" required style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                                <button type="submit" class="vs-btn w-100" style="padding: 12px; font-size: 14px;">Subscribe Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="common-line shape-mockup d-none d-xxl-block" style="top: -7px;">
                <img src="{{ asset('assets_landingpage/img/shapes/line-shep.png') }}" alt="shapes">
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row justify-content-xl-between justify-content-center align-items-center">
                    <div class="col-auto">
                        <p class="copyright-text"><i class="fal fa-copyright"></i> Copyright 2026 - TemuRuang. All rights reserved.</p>
                    </div>
                    <div class="col-auto">
                        <div class="copyright-img">
                            <a href="#"><img src="{{ asset('assets_landingpage/img/default/payment-img.svg') }}" alt="payment img"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
    <!-- Scroll To Top -->
    <button class="back-to-top" id="backToTop" aria-label="Back to Top">
        <span class="progress-circle">
                <svg viewBox="0 0 100 100">
                    <circle class="bg" cx="50" cy="50" r="40"></circle>
                    <circle class="progress" cx="50" cy="50" r="40"></circle>
                </svg>
                <span class="progress-percentage" id="progressPercentage">0%</span>
        </span>
    </button>

    <!--********************************
			Code End  Here 
	******************************** -->

    <!--==============================
        All Js File
    ============================== -->
    <!-- Jquery -->
    <script src="{{ asset('assets_landingpage/js/vendor/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets_landingpage/js/bootstrap.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('assets_landingpage/js/slick.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('assets_landingpage/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- imagesloaded -->
    <script src="{{ asset('assets_landingpage/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Gsap -->
    <script src="{{ asset('assets_landingpage/js/gsap.min.js') }}"></script>
    <!-- ScrollTrigger -->
    <script src="{{ asset('assets_landingpage/js/ScrollTrigger.min.js') }}"></script>
    <!-- Gsap ScrollTo Plugin -->
    <script src="{{ asset('assets_landingpage/js/gsap-scroll-to-plugin.js') }}"></script>
    <!-- Split Text -->
    <script src="{{ asset('assets_landingpage/js/SplitText.js') }}"></script>
    <!-- lenis -->
    <script src="{{ asset('assets_landingpage/js/lenis.min.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('assets_landingpage/js/wow.min.js') }}"></script>
    <!-- Main Js File -->
    <script src="{{ asset('assets_landingpage/js/main.js') }}"></script>


</body>

</html>
