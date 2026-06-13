@extends('layouts.landing')

@section('content')

    <!-- Simple Header Page Area -->
    <div style="background-color: #f4f6f9; padding: 30px 0; border-bottom: 1px solid #e5e8ec;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <h1 style="font-size: 24px; font-weight: 700; color: #333; margin: 0; font-family: 'Poppins', sans-serif;">Semua Template</h1>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 justify-content-center justify-content-md-end" style="background: transparent; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #1a7b45; text-decoration: none; font-weight: 500;">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #666;">Semua Template</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- Template Grid Area -->
    <section class="vs-service__layout1 space position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title-area text-center wow animate__fadeInUp" data-wow-delay="0.25s">
                        <span class="sec-subtitle justify-content-center">PILIHAN TEMPLATE</span>
                        <h2 class="sec-title">Eksplorasi Tema Kami</h2>
                        <p class="sec-text">Temukan berbagai pilihan tema undangan digital yang dirancang khusus untuk membuat momen spesial Anda menjadi lebih berkesan.</p>
                    </div>
                </div>
            </div>
            
            @if(isset($groupedTemplates) && $groupedTemplates->count() > 0)
                @foreach($groupedTemplates as $category => $templates)
                <div class="row mt-5 mb-3">
                    <div class="col-12 text-center">
                        <h3 style="color: #1a7b45; font-weight: 700; border-bottom: 2px solid #1a7b45; display: inline-block; padding-bottom: 5px;">{{ $category }}</h3>
                    </div>
                </div>
                <div class="row">
                    @foreach($templates as $template)
                    <div class="col-lg-6 col-md-12 mb-3 wow animate__fadeInUp" data-wow-delay="0.1s">
                        <div class="template-list-item d-flex align-items-center" style="box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-radius: 12px; background: #fff; padding: 15px; border: 1px solid #f0f0f0; transition: transform 0.3s ease;">
                            <div class="template-img-wrap" style="flex-shrink: 0; margin-right: 20px;">
                                <a href="{{ route('templates.preview', $template->slug) }}" target="_blank">
                                    @if($template->thumbnail)
                                        <img src="{{ Storage::url($template->thumbnail) }}" alt="{{ $template->name }}" style="border-radius: 8px; width: 90px; height: 90px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets_landingpage/img/service/service-img-new-1.png') }}" alt="{{ $template->name }}" style="border-radius: 8px; width: 90px; height: 90px; object-fit: cover;">
                                    @endif
                                </a>
                            </div>
                            <div class="template-info" style="flex-grow: 1;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h4 class="mb-0" style="font-size: 16px; font-weight: 700; color: #333;"><a href="{{ route('templates.preview', $template->slug) }}" target="_blank" style="color: inherit;">{{ $template->name }}</a></h4>
                                    @if($template->is_premium)
                                        <span style="background: rgba(26, 123, 69, 0.1); color: #1a7b45; font-size: 11px; padding: 3px 8px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; position: static !important; float: none !important; margin-left: 10px;">
                                            <i class="fas fa-gem" style="font-size: 10px;"></i>Premium
                                        </span>
                                    @endif
                                </div>
                                <p style="color: #777; font-size: 13px; margin-bottom: 10px; line-height: 1.4;">{{ Str::limit($template->description, 65) }}</p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span style="font-size: 12px; color: #999;"><i class="fas fa-folder-open me-1"></i> {{ $template->theme_category ?? 'Pernikahan' }}</span>
                                    <a href="{{ route('templates.preview', $template->slug) }}" target="_blank" class="vs-btn" style="padding: 6px 15px; font-size: 12px; line-height: 1.5; border-radius: 4px;">Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            @else
                <div class="row">
                    <div class="col-12 text-center">
                        <p>Belum ada template tersedia.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
