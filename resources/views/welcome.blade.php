@extends('layouts.landing')

@section('content')
        <!-- Hero Area -->
        <section id="home" class="vs-hero__layout1" data-wow-delay="0.25s" aria-hidden="true">
              <div class="vs-hero__item" data-bg-src="{{ asset('assets_landingpage/img/bg/hero-bg-1.jpg') }}">
                <div class="main-container3 position-relative z-index">
                    <div class="row justify-content-end align-items-center">
                        <div class="col-lg-6 position-relative">
                            <div class="vs-hero__content">
                                <div class="vs-hero__subtitle wow animate__fadeInUp" data-wow-delay="0.90s"><span class="icon"><img src="{{ asset('assets_landingpage/img/icon/satisfaction-icon.svg') }}" alt="Hero Icon"></span>100% Satisfaction</div>
                                <h1 class="vs-hero__title wow animate__fadeInUp" data-wow-delay="0.85s">Undangan Digital <span class="vs-hero__title--highlight">Untuk</span> Acara Anda</h1>
                                <a class="vs-btn2 wow animate__fadeInUp" data-wow-delay="0.95s" href="#">Lihat Template<i class="far fa-long-arrow-right"></i></a>
                                <span class="dot-shape"></span>
                            </div> 
                            <span class="shape-mockup hero-shep2 moving" style="left: -110px; bottom: -30px;"><img src="{{ asset('assets_landingpage/img/shapes/clean1.png') }}" alt="hero element"></span>
                        </div>
                        <div class="col-lg-6">
                            <div class="vs-hero__image position-relative">
                                <div class="main-img vs-carousel" data-fade="true" data-autoplay="true">
                                    <div class="slide-item">
                                        <img src="{{ asset('assets_landingpage/img/hero/slider-1.png') }}" alt="Hero Image" style="border-radius: 10px; width: 100%;">
                                    </div>
                                    <div class="slide-item">
                                        <img src="{{ asset('assets_landingpage/img/hero/slider-2.png') }}" alt="Hero Image" style="border-radius: 10px; width: 100%;">
                                    </div>
                                </div>
                              <span class="shape-mockup hero-shep3 custome-sheap1 wow animate__zoomIn" data-wow-delay="0.90s" style="left: -50px; bottom: 0;"><img src="{{ asset('assets_landingpage/img/shapes/hero-shep-1-1.svg') }}" alt="hero element"></span>
                              <span class="shape-mockup hero-shep4 custome-sheap1 wow animate__zoomIn" data-wow-delay="0.80s" style="left: -130px; bottom: 0;"><img src="{{ asset('assets_landingpage/img/shapes/hero-shep-1-2.svg') }}" alt="hero element"></span>
                              <span class="shape-mockup hero-shep5 spin d-lg-block d-none" style="left: 75px; top: 90px;"><img src="{{ asset('assets_landingpage/img/shapes/circle-1.png') }}" alt="hero element"></span>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="bubbles d-lg-block d-none">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
            </div>
            <span class="shape-mockup wow animate__fadeInLeft" data-wow-delay="0.80s" style="left: 0px; top: 60px;"><img src="{{ asset('assets_landingpage/img/shapes/hero-sheap3.png') }}" alt="Hero element"></span>
        </section>
        <!-- Hero Area End -->
        <!-- Counter Area -->
        <div class="vs-counter__layout1 position-relative">
            <div class="main-container4">
                <div class="row align-items-center justify-content-sm-center">
                    <div class="col-md-auto">
                        <div class="vs-counter__inner">
                            <div class="play-video">
                                <a href="https://www.youtube.com/watch?v=moYayPRgaY0" class="play-btn2 popup-video"><i class="fas fa-play"></i></a>
                            </div>
                            <div class="vs-counter__content">
                                <div class="wow animate__fadeInUp" data-wow-delay="0.25s">
                                    <div class="title-area title-anime animation-style1">
                                      <span class="sec-subtitle justify-content-center title-anime__title">TENTANG TEMURUANG</span>
                                      <h2 class="sec-title title-anime__title">UNDANGAN DIGITAL TERBAIK</h2>
                                    </div>
                                </div>
                            </div>
                            <span class="shape-mockup  custom-sheap" style="left: -35%; top: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/counter-shep2.png') }}" alt="counter element"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="counter-style1">
                            <div class="row g-5 z-index-common justify-content-lg-between justify-content-center align-items-center ">
                                <div class="col-xl-auto col-lg-6 col-6">
                                    <div class="media-style">
                                        <div class="media-inner">
                                            <span class="counter-icon"><img src="{{ asset('assets_landingpage/img/icon/counter-icon-1-1.svg') }}" alt="icon"></span>
                                            <div class="media-counter">
                                                <div class="media-count">
                                                    <h2 class="media-title h3 counter-number" data-count="950">00</h2>
                                                    <span class="count-icon">+</span>
                                                </div>
                                                <p class="media-text">Happpy client</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-auto col-lg-6 col-6">
                                    <div class="media-style">
                                        <div class="media-inner">
                                            <span class="counter-icon"><img src="{{ asset('assets_landingpage/img/icon/counter-icon-1-2.svg') }}" alt="icon"></span>
                                            <div class="media-counter">
                                                <div class="media-count">
                                                    <h2 class="media-title h3 counter-number" data-count="45">00</h2>
                                                    <span class="count-icon">+</span>
                                                </div>
                                                <p class="media-text">Award Winner</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-auto col-lg-6 col-6">
                                    <div class="media-style">
                                        <div class="media-inner">
                                            <span class="counter-icon"><img src="{{ asset('assets_landingpage/img/icon/counter-icon-1-3.svg') }}" alt="icon"></span>
                                            <div class="media-counter">
                                                <div class="media-count">
                                                    <h2 class="media-title h3 counter-number" data-count="400">00</h2>
                                                    <span class="count-icon">+</span>
                                                </div>
                                                <p class="media-text">Completed Project</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-auto col-lg-6 col-6">
                                    <div class="media-style">
                                        <div class="media-inner">
                                            <span class="counter-icon"><img src="{{ asset('assets_landingpage/img/icon/counter-icon-1-4.svg') }}" alt="icon"></span>
                                            <div class="media-counter">
                                                <div class="media-count">
                                                    <h2 class="media-title h3 counter-number" data-count="100">00</h2>
                                                    <span class="count-icon">+</span>
                                                </div>
                                                <p class="media-text">Team Member</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="shape-mockup" style="left: 0; top: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/counter-bg-shep1.png') }}" alt="counter element"></span>
        </div>
        <!-- Counter Area End -->
        <!-- About Area  -->
         <section class="about-layout1 space-top">
            <div class="container">
                <div class="row gx-60 g-5 justify-content-center">
                    <div class="col-xl-6">
                        <div class="img-box1 wow animate__fadeInUp" data-wow-delay="0.55s">
                                <div class="img-icon">
                                    <img src="{{ asset('assets_landingpage/img/icon/about-icon1.svg') }}" alt="icon">
                                    <span class="icon-shep">
                                        <img src="{{ asset('assets_landingpage/img/shapes/about-icon-shape1.png') }}" alt="shape" class="spin">
                                    </span>
                                </div>
                            <div class="img1">
                                <a href="#"><img src="{{ asset('assets_landingpage/img/about/about-img-new-1.png') }}" alt="About Image" style="border-radius: 10px; width: 100%;"></a>
                            </div>
                            <div class="img2">
                                <a href="#"><img src="{{ asset('assets_landingpage/img/about/about-img-new-2.png') }}" alt="About Image" style="border-radius: 10px; width: 100%;"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="about-content">
                            <div class="wow animate__fadeInUp" data-wow-delay="0.25s">
                                <div class="title-area title-anime animation-style2">
                                  <span class="sec-subtitle left-shape justify-content-center title-anime__title">TENTANG TEMURUANG</span>
                                  <h2 class="sec-title title-anime__title">Platform <span class="title-highlight">Undangan Digital</span> Anda</h2>
                                </div>
                                <p class="about-text">
                                    Buat undangan digital impian Anda dengan mudah dan cepat. Platform kami menyediakan berbagai fitur menarik dan kemudahan untuk membuat momen spesial Anda menjadi lebih berkesan tanpa perlu repot.
                                </p>
                            </div>
                            <div class="about-box1 wow animate__fadeInUp" data-wow-delay="0.25s">
                                <div class="about-item">
                                    <span class="item-icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/about-icon2.svg') }}" alt="icon">
                                    </span>
                                    <h2 class="item-title h6">Ramah Lingkungan</h2>
                                    <p class="item-text">Tanpa kertas fisik, bantu selamatkan bumi dan pohon untuk masa depan yang lebih baik.</p>
                                </div>
                                <div class="about-item">
                                    <span class="item-icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/about-icon3.svg') }}" alt="icon">
                                    </span>
                                    <h2 class="item-title h6">Desain Eksklusif</h2>
                                    <p class="item-text">Pilihan template premium yang elegan dan bisa disesuaikan dengan tema acara Anda.</p>
                                </div>
                            </div>
                            <div class="about-inner wow animate__fadeInUp" data-wow-delay="0.25s">
                                <a class="vs-btn2" href="#">Lihat Detail <i class="far fa-long-arrow-right"></i></a>
                                <div class="author-box">
                                    <img src="{{ asset('assets_landingpage/img/about/author-img.jpg') }}" alt="author image">
                                    <div class="author-content">
                                        <h2 class="title h5">Tim TemuRuang</h2>
                                        <p class="desi">Customer Support</p>
                                    </div>
                                </div>
                            </div>
                            <div class="about-notice wow animate__fadeInUp" data-wow-delay="0.30s">
                                <span class="notice-icon"><img src="{{ asset('assets_landingpage/img/icon/about-icon4.svg') }}" alt="icon"></span>
                                <p class="notice-text">Jadikan momen spesial Anda lebih berkesan dengan undangan interaktif.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="shape-mockup z-index-n1 d-lg-block d-none" style="left: 52px; top: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/about-shape-1-1.png') }}" alt="counter element"></span>
            <span class="shape-mockup z-index-n1 d-xl-block d-none" style="right: 0; top: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/about-shape-1-2.png') }}" alt="counter element"></span>
         </section>
        <!-- About Area End -->
        <!-- Service Area  -->
         <section id="template" class="vs-service__layout1 space position-relative">
            <div class="container custome-space-bottom">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="title-area text-center wow animate__fadeInUp title-anime animation-style5" data-wow-delay="0.25s">
                            <span class="sec-subtitle justify-content-center title-anime__title"> PILIHAN TEMPLATE</span>
                            <h2 class="sec-title title-anime__title">Template Premium Kami</h2>
                        </div>
                    </div>
                </div>
                <div class="row vs-carousel" data-slide-show="4" data-ml-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-autoplay="true" data-arrows="true">
                    <div class="col-lg-3 wow animate__fadeInUp" data-wow-delay="0.25s">
                        <div class="vs-service__style1">
                            <div class="vs-service__img">
                                <a href="#">
                                    <img src="{{ asset('assets_landingpage/img/service/service-img-new-1.png') }}" alt="Serevice Image" style="border-radius: 10px; width: 100%;">
                                </a>
                            </div>
                            <div class="vs-service__body">
                                <div class="vs-service__header">
                                    <div class="vs-service__content">
                                        <p class="vs-service__subtitle">Template</p>
                                        <h2 class="vs-service__title h6"><a href="#">Tema Floral</a></h2>
                                    </div>
                                    <div class="vs-service__icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/service-icon-1-1.svg') }}" alt="Service Icon">
                                    </div>
                                </div>
                                <p class="vs-service__text">Desain bernuansa bunga yang elegan untuk momen spesial Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 wow animate__fadeInUp" data-wow-delay="0.45s">
                        <div class="vs-service__style1">
                            <div class="vs-service__img">
                                <a href="#">
                                    <img src="{{ asset('assets_landingpage/img/service/service-img-new-2.png') }}" alt="Serevice Image" style="border-radius: 10px; width: 100%;">
                                </a>
                            </div>
                            <div class="vs-service__body">
                                <div class="vs-service__header">
                                    <div class="vs-service__content">
                                        <p class="vs-service__subtitle">Template</p>
                                        <h2 class="vs-service__title h6"><a href="#">Tema Klasik</a></h2>
                                    </div>
                                    <div class="vs-service__icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/service-icon-1-2.svg') }}" alt="Service Icon">
                                    </div>
                                </div>
                                <p class="vs-service__text">Kesan mewah dan abadi dengan sentuhan tipografi klasik.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 wow animate__fadeInUp" data-wow-delay="0.65s">
                        <div class="vs-service__style1">
                            <div class="vs-service__img">
                                <a href="#">
                                    <img src="{{ asset('assets_landingpage/img/service/service-img-new-3.png') }}" alt="Serevice Image" style="border-radius: 10px; width: 100%;">
                                </a>
                            </div>
                            <div class="vs-service__body">
                                <div class="vs-service__header">
                                    <div class="vs-service__content">
                                        <p class="vs-service__subtitle">Template</p>
                                        <h2 class="vs-service__title h6"><a href="#">Tema Modern</a></h2>
                                    </div>
                                    <div class="vs-service__icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/service-icon-1-3.svg') }}" alt="Service Icon">
                                    </div>
                                </div>
                                <p class="vs-service__text">Tampilan bersih dan minimalis sesuai dengan tren masa kini.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 wow animate__fadeInUp" data-wow-delay="0.85s">
                        <div class="vs-service__style1">
                            <div class="vs-service__img">
                                <a href="#">
                                    <img src="{{ asset('assets_landingpage/img/service/service-img-new-4.png') }}" alt="Serevice Image" style="border-radius: 10px; width: 100%;">
                                </a>
                            </div>
                            <div class="vs-service__body">
                                <div class="vs-service__header">
                                    <div class="vs-service__content">
                                        <p class="vs-service__subtitle">Template</p>
                                        <h2 class="vs-service__title h6"><a href="#">Tema Rustic</a></h2>
                                    </div>
                                    <div class="vs-service__icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/service-icon-1-4.svg') }}" alt="Service Icon">
                                    </div>
                                </div>
                                <p class="vs-service__text">Kehangatan nuansa alam dan vintage yang sangat mempesona.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 wow animate__fadeInUp" data-wow-delay="0.95s">
                        <div class="vs-service__style1">
                            <div class="vs-service__img">
                                <a href="#">
                                    <img src="{{ asset('assets_landingpage/img/service/service-img-new-1.png') }}" alt="Serevice Image" style="border-radius: 10px; width: 100%;">
                                </a>
                            </div>
                            <div class="vs-service__body">
                                <div class="vs-service__header">
                                    <div class="vs-service__content">
                                        <p class="vs-service__subtitle">Template</p>
                                        <h2 class="vs-service__title h6"><a href="#">Tema Minimalis</a></h2>
                                    </div>
                                    <div class="vs-service__icon">
                                        <img src="{{ asset('assets_landingpage/img/icon/service-icon-1-4.svg') }}" alt="Service Icon">
                                    </div>
                                </div>
                                <p class="vs-service__text">Simpel, fokus pada informasi penting dengan tata letak rapi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 wow animate__fadeInUp" data-wow-delay="0.55s">
                    <a href="{{ url('/templates') }}" class="vs-btn">Lihat Yang Lain</a>
                </div>
            </div>
            <span class="shape-mockup z-index-n1 d-xl-block d-none" style="right: 0; top: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/service-shape-1.png') }}" alt="counter element"></span>
            <span class="shape-mockup z-index-n1 custom-sheap" style="right: 0; bottom: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/service-shape-2.png') }}" alt="counter element"></span>
            <span class="shape-mockup z-index-n1 d-xl-block d-none" style="left: 0; bottom: 0px;" ><img src="{{ asset('assets_landingpage/img/shapes/service-shape-3.png') }}" alt="counter element"></span>
         </section>
        <!-- Service Area End  -->
        <!-- Team Area  -->
         <section id="pricing" class="vs-team__layout1 bg-linear space-bottom" style="padding-top: 20px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="title-area text-center wow animate__fadeInUp title-anime animation-style5" data-wow-delay="0.25s">
                            <span class="sec-subtitle justify-content-center title-anime__title">PAKET HARGA</span>
                            <h2 class="sec-title title-anime__title">Pilih Paket Sesuai Kebutuhan</h2>
                        </div>
                    </div>
                </div>
                <div class="row vs-carousel paket-slider" data-slide-show="3" data-ml-slide-show="3" data-lg-slide-show="3" data-md-slide-show="2" data-sm-slide-show="2" data-autoplay="false" data-arrows="false">
                    <!-- Paket Basic -->
                    <div class="col-xl-3 wow animate__fadeInUp" data-wow-delay="0.25s">
                        <div class="vs-team__style1" style="box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; background: #fff; padding: 40px 20px; text-align: center;">
                            <div class="vs-team__content">
                                <h2 class="vs-team__title" style="font-size: 24px; margin-bottom: 15px;">Basic</h2>
                                <h3 style="color: #1a7b45; font-size: 32px; font-weight: 700; margin-bottom: 25px;">Rp 49.000</h3>
                                <ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #666; font-size: 16px;">
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Masa Aktif 1 Bulan</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Tema Standard</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Galeri Foto (Maks 5)</li>
                                    <li style="margin-bottom: 12px; color: #ccc;"><i class="fa fa-times mr-2"></i> Custom Nama Tamu</li>
                                </ul>
                                <a href="#" class="vs-btn2" style="padding: 15px 30px; font-size: 15px; border-radius: 5px;">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
                    <!-- Paket Standard -->
                    <div class="col-xl-3 wow animate__fadeInUp" data-wow-delay="0.35s">
                        <div class="vs-team__style1" style="box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; background: #fff; padding: 40px 20px; text-align: center;">
                            <div class="vs-team__content">
                                <h2 class="vs-team__title" style="font-size: 24px; margin-bottom: 15px;">Standard</h2>
                                <h3 style="color: #1a7b45; font-size: 32px; font-weight: 700; margin-bottom: 25px;">Rp 99.000</h3>
                                <ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #666; font-size: 16px;">
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Masa Aktif 3 Bulan</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Tema Premium</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Galeri Foto (Maks 15)</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Custom Nama Tamu</li>
                                </ul>
                                <a href="#" class="vs-btn2" style="padding: 15px 30px; font-size: 15px; border-radius: 5px;">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
                    <!-- Paket Premium -->
                    <div class="col-xl-3 wow animate__fadeInUp" data-wow-delay="0.45s">
                        <div class="vs-team__style1" style="box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; background: #fff; padding: 40px 20px; text-align: center; border: 2px solid #1a7b45;">
                            <div class="vs-team__content">
                                <span style="background: #1a7b45; color: #fff; padding: 5px 15px; border-radius: 20px; font-size: 12px; margin-bottom: 15px; display: inline-block;">Paling Laris</span>
                                <h2 class="vs-team__title" style="font-size: 24px; margin-bottom: 15px;">Premium</h2>
                                <h3 style="color: #1a7b45; font-size: 32px; font-weight: 700; margin-bottom: 25px;">Rp 149.000</h3>
                                <ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #666; font-size: 16px;">
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Masa Aktif 6 Bulan</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Semua Tema</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Galeri Foto (Maks 30)</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Fitur RSVP & Maps</li>
                                </ul>
                                <a href="#" class="vs-btn2" style="padding: 15px 30px; font-size: 15px; border-radius: 5px;">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
                    <!-- Paket Exclusive -->
                    <div class="col-xl-3 wow animate__fadeInUp" data-wow-delay="0.55s">
                        <div class="vs-team__style1" style="box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-radius: 10px; background: #fff; padding: 40px 20px; text-align: center;">
                            <div class="vs-team__content">
                                <h2 class="vs-team__title" style="font-size: 24px; margin-bottom: 15px;">Exclusive</h2>
                                <h3 style="color: #1a7b45; font-size: 32px; font-weight: 700; margin-bottom: 25px;">Rp 249.000</h3>
                                <ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #666; font-size: 16px;">
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Masa Aktif 1 Tahun</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Semua Tema Eksklusif</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Galeri Foto Unlimited</li>
                                    <li style="margin-bottom: 12px;"><i class="fa fa-check text-success mr-2"></i> Prioritas Support 24/7</li>
                                </ul>
                                <a href="#" class="vs-btn2" style="padding: 15px 30px; font-size: 15px; border-radius: 5px;">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Custom Navigation Arrows -->
                <div class="text-center mt-4 wow animate__fadeInUp" data-wow-delay="0.45s">
                    <div class="icon-arraw slick-prev" data-slick-prev=".paket-slider" style="display: inline-block; margin-right: 10px; cursor: pointer;">
                        <button class="icon-btn2" style="background: #1a7b45; color: white; border: none; border-radius: 50%; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="icon-arraw slick-next" data-slick-next=".paket-slider" style="display: inline-block; cursor: pointer;">
                        <button class="icon-btn2" style="background: #1a7b45; color: white; border: none; border-radius: 50%; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="text-center mt-5 wow animate__fadeInUp" data-wow-delay="0.55s">
                    <a href="{{ url('/pricing') }}" class="vs-btn">Lihat Semua Paket</a>
                </div>
            </div>
            <span class="shape-mockup d-xl-block d-none" style="right: 0; top: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/service-shape-1.png') }}" alt="team element"></span>
            <span class="shape-mockup d-xl-block d-none z-index-n1" style="left: 0; bottom: 0px;"><img src="{{ asset('assets_landingpage/img/shapes/team-shep1.png') }}" alt="team element"></span>
         </section>
        <!-- Testimonial Area  -->
         <section class="vs-testi__layout1 space" data-bg-src="{{ asset('assets_landingpage/img/bg/testi-bg-new.png') }}">
            <div class="container">
                <div class="row gx-60 g-5">
                    <div class="col-xl-5">
                        <div class="vs-testi__form1 wow animate__fadeInUp" data-wow-delay="0.45s">
                            <div class="title-area text-left  wow animate__fadeInUp" data-wow-delay="0.25s">
                                <span class="sec-subtitle text-white left-shape justify-content-center">BANTUAN</span>
                                <h2 class="sec-title text-white">Hubungi Kami</h2>
                            </div>
                            <div class="vs-comment-form">
                                <div id="respond">
                                    <form action="mail.php" method="post" class="ajax-contact">
                                        <div class="row gx-3">
                                            <div class="col-md-6 form-group">
                                                <input name="fname" type="text" class="form-control" placeholder="Nama Anda *" required="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input name="email" type="email" class="form-control" placeholder="Email *" required="">                                                
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input name="number" type="number" class="form-control" placeholder="No HP/WA *" required="">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <select name="subject" id="subject">
                                                    <option selected="" disabled="" hidden="">Pilih Kebutuhan</option>
                                                    <option value="Tanya Paket">Pertanyaan Paket</option>
                                                    <option value="Bantuan Teknis">Bantuan Teknis</option>
                                                    <option value="Custom Tema">Pesan Tema Custom</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="col-12  form-group mt-1 mb-20">
                                                <textarea name="message" class="form-control" placeholder="Pesan Anda"
                                                    required=""></textarea>
                                            </div>
                                            <div class="col-12 form-group mb-0">
                                                <button class="vs-btn" type="submit">Kirim Pesan</button>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="form-messages mb-0 mt-3"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="vs-testi__inner">
                            <div class="title-area text-left wow animate__fadeInUp title-anime animation-style5" data-wow-delay="0.25s">
                                <span class="sec-subtitle  left-shape justify-content-center title-anime__title">TESTIMONIAL</span>
                                <h2 class="sec-title text-white title-anime__title">Apa Kata Mereka</h2>
                                <p class="sec-text">Kesan dan pesan dari para pengguna yang telah mempercayakan undangan spesialnya kepada TemuRuang.</p>
                            </div>
                            <div class="vs-testi__items wow animate__fadeInUp" data-wow-delay="0.35s">
                                <div class="vs-carousel testi-slider" data-autoplay="true" data-fade="true">
                                    <div class="vs-testi__style1">
                                        <span class="vs-testi__icon"><i class="fas fa-quote-left"></i></span>
                                        <div class="vs-testi__top">
                                            <div class="vs-testi__image">
                                                <img class="img1" src="{{ asset('assets_landingpage/img/testimonial/testi-new-1.png') }}" alt="testimonials" style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="vs-testi__author">
                                                <div class="star-rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <h3 class="vs-testi__title">Anisa & Bima</h3>
                                            </div>
                                        </div>
                                        <div class="vs-testi__content">
                                            <p class="vs-testi__text">
                                                “ Desain undangannya sangat elegan dan fitur RSVP-nya sangat membantu kami mendata tamu yang hadir. Terima kasih TemuRuang! ”
                                            </p>
                                        </div>
                                    </div>
                                    <div class="vs-testi__style1">
                                        <span class="vs-testi__icon"><i class="fas fa-quote-left"></i></span>
                                        <div class="vs-testi__top">
                                            <div class="vs-testi__image">
                                                <img class="img1" src="{{ asset('assets_landingpage/img/testimonial/testi-new-2.png') }}" alt="testimonials" style="border-radius: 50%; width: 80px; height: 80px; object-fit: cover;">
                                            </div>
                                            <div class="vs-testi__author">
                                                <div class="star-rating">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                                <h3 class="vs-testi__title">Rizki & Nanda</h3>
                                            </div>
                                        </div>
                                        <div class="vs-testi__content">
                                            <p class="vs-testi__text">
                                                “ Sangat mudah digunakan! Hanya dalam beberapa menit, undangan digital kami sudah siap disebar. Harga paketnya juga sangat terjangkau. ”
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-arraw wow animate__fadeInUp" data-wow-delay="0.45s">
                                <div class="icon-arraw slick-prev" data-slick-prev=".testi-slider">
                                    <button class="icon-btn2">
                                        <img src="{{ asset('assets_landingpage/img/icon/arraw-right.svg') }}" alt="icon">
                                    </button>
                                </div>
                                <div class="icon-arraw slick-next" data-slick-next=".testi-slider">
                                    <button class="icon-btn2">
                                        <img src="{{ asset('assets_landingpage/img/icon/arraw-left.svg ') }}" alt="icon">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="common-line shape-mockup d-none d-xxl-block" style="top: -7px;">
                <img src="{{ asset('assets_landingpage/img/shapes/line-shep.png') }}" alt="shapes">
            </div>
         </section>
        <!-- Testimonial Area End  -->

@endsection