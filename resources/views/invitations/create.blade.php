@extends('layouts.app')
@section('title', 'Pilih Template Undangan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Pilih Template Undangan</h4>
            <div class="page-title-right">
                <a href="{{ route('invitations.index') }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="alert alert-info" role="alert">
            <h5 class="alert-heading"><i class="mdi mdi-information-outline me-1"></i> Cara Membuat Undangan</h5>
            <p class="mb-0">Pilih template yang Anda sukai di bawah ini. Anda akan diarahkan ke WhatsApp Admin untuk memberikan detail acara. Admin kami yang akan membuatkan dan mengatur undangan Anda hingga siap digunakan!</p>
        </div>
    </div>

    @foreach($templates as $template)
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="product-img position-relative text-center">
                    @if($template->thumbnail)
                        <a href="{{ route('templates.preview', $template->slug) }}" target="_blank" class="d-inline-block overflow-hidden rounded-3 shadow-sm border">
                            <img src="{{ Storage::url($template->thumbnail) }}?v={{ file_exists(storage_path('app/public/' . $template->thumbnail)) ? filemtime(storage_path('app/public/' . $template->thumbnail)) : 1 }}" alt="{{ $template->name }}" class="img-fluid mx-auto d-block" style="width: 180px; height: 318px; object-fit: cover; object-position: top center;">
                        </a>
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-3" style="height: 318px;">
                            <i class="mdi mdi-image-off font-size-24 text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="mt-4 text-center">
                    <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">{{ $template->name }}</a></h5>
                    
                    <p class="text-muted">
                        <i class="mdi mdi-tag-outline me-1"></i> {{ $template->eventType->name ?? 'General' }}
                    </p>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('templates.preview', $template->slug) }}" target="_blank" class="btn btn-outline-secondary btn-sm w-50">
                            <i class="mdi mdi-eye me-1"></i> Preview
                        </a>
                        @php
                            $adminPhone = env('ADMIN_WHATSAPP', '6281234567890');
                            $message = "Halo Admin TemuRuang, saya ingin membuat undangan baru menggunakan template *{$template->name}*. Mohon diinfokan data apa saja yang perlu saya lengkapi.";
                            $waLink = "https://wa.me/{$adminPhone}?text=" . urlencode($message);
                        @endphp
                        <a href="{{ $waLink }}" target="_blank" class="btn btn-primary btn-sm w-50">
                            <i class="mdi mdi-whatsapp me-1"></i> Pilih
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
