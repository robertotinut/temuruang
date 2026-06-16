@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    @if(Auth::user()->isOwner() || Auth::user()->isAdmin())
        <!-- Admin/Owner Stats -->
        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total User</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_user'] }}">{{ $stats['total_user'] }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="mdi mdi-account-group font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Customer</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_customer'] }}">{{ $stats['total_customer'] }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-account-heart font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Invitation</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_invitation'] }}">{{ $stats['total_invitation'] }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-warning rounded-3">
                                    <i class="mdi mdi-email-open-outline font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total RSVP</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_rsvp'] }}">{{ $stats['total_rsvp'] }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-danger rounded-3">
                                    <i class="mdi mdi-account-check font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Customer Stats -->
        <div class="col-xl-4 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Undangan Saya</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_invitation'] }}">{{ $stats['total_invitation'] }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="mdi mdi-email-open-outline font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total RSVP</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_rsvp'] }}">{{ $stats['total_rsvp'] }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-warning rounded-3">
                                    <i class="mdi mdi-account-check font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Tamu Hadir</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $stats['total_guest'] ?? 0 }}">{{ $stats['total_guest'] ?? 0 }}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="avatar-sm flex-shrink-0 float-end">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-account-group font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@if(!Auth::user()->isOwner() && !Auth::user()->isAdmin())
<div class="row mt-2">
    <div class="col-12">
        @if($activeSubscription)
            <div class="alert alert-success text-center p-4" role="alert">
                <h4 class="alert-heading font-size-18 mb-2">Paket Aktif: {{ $activeSubscription->package->name }}</h4>
                <p class="mb-0">Masa berlaku sampai: <strong>{{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('d F Y') }}</strong></p>
            </div>
        @else
            <div class="alert alert-danger text-center p-4" role="alert">
                <h4 class="alert-heading font-size-18 mb-2"><i class="mdi mdi-alert-circle-outline"></i> Anda belum memiliki paket aktif</h4>
                <p class="mb-0">Silakan berlangganan salah satu paket di bawah ini untuk mulai membuat undangan tanpa batas.</p>
            </div>
        @endif
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex align-items-center mb-4">
            <h4 class="card-title flex-grow-1">Daftar Harga Paket</h4>
        </div>
    </div>
    
    @foreach($packages ?? [] as $package)
    <div class="col-xl-4 col-md-6">
        <div class="card plan-box">
            <div class="card-body p-4 text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title bg-primary-subtle text-primary rounded-circle font-size-20">
                            <i class="mdi mdi-crown"></i>
                        </span>
                    </div>
                </div>
                <h5 class="font-size-15">{{ $package->name }}</h5>
                <h2 class="mb-4">Rp {{ number_format($package->price, 0, ',', '.') }} <span class="font-size-13 text-muted">/ {{ $package->duration_days }} Hari</span></h2>
                
                <ul class="list-unstyled mb-4 text-start font-size-14" style="padding-left: 20px; color: #74788d; line-height: 1.8;">
                    <li><i class="mdi mdi-check text-success me-2"></i> Masa Aktif {{ $package->duration_days }} Hari</li>
                    <li><i class="mdi mdi-check text-success me-2"></i> <strong>Galeri Foto Tanpa Batas</strong></li>
                    <li><i class="mdi mdi-check text-success me-2"></i> Fitur RSVP & Google Maps</li>
                    <li><i class="mdi mdi-check text-success me-2"></i> Buku Tamu & Ucapan Digital</li>
                    
                    @if($package->name === 'Basic')
                        <li><i class="mdi mdi-check text-success me-2"></i> Pilih Maks. <strong>2 Template Premium</strong></li>
                        <li><i class="mdi mdi-check text-success me-2"></i> Revisi Maks. <strong>2 Kali</strong> per Template</li>
                        <li><i class="mdi mdi-check text-success me-2"></i> Musik Pengiring Standar</li>
                        <li class="text-danger"><i class="mdi mdi-alert-outline me-2"></i> Dengan Watermark TemuRuang</li>
                    @elseif($package->name === 'Plus')
                        <li><i class="mdi mdi-check text-success me-2"></i> Pilih Maks. <strong>10 Template Premium</strong> (Recommended)</li>
                        <li><i class="mdi mdi-check text-success me-2"></i> Revisi Maks. <strong>5 Kali</strong> per Template</li>
                        <li><i class="mdi mdi-check text-success me-2"></i> <strong>Musik Latar Kustom (MP3)</strong></li>
                        <li><i class="mdi mdi-check text-success me-2"></i> <strong>Tanpa Watermark TemuRuang</strong></li>
                    @else
                        <li><i class="mdi mdi-check text-success me-2"></i> Pilih Maks. <strong>20 Template Premium</strong></li>
                        <li><i class="mdi mdi-check text-success me-2"></i> <strong>Revisi Tanpa Batas (Unlimited)</strong></li>
                        <li><i class="mdi mdi-check text-success me-2"></i> Musik Latar Kustom (MP3)</li>
                        <li><i class="mdi mdi-check text-success me-2"></i> Tanpa Watermark TemuRuang</li>
                        <li><i class="mdi mdi-check text-success me-2"></i> Efek Salju & Stardust Premium</li>
                    @endif
                </ul>

                <div class="text-center">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mt-2 w-100">Beli Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
