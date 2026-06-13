@extends('layouts.app')
@section('title', 'Pembayaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-8 mt-5">
        <div class="card overflow-hidden">
            <div class="bg-primary-subtle">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h5 class="text-primary">Instruksi Pembayaran</h5>
                            <p>Scan QRIS di bawah untuk menyelesaikan pembayaran.</p>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            
            <div class="card-body pt-0">
                <div class="p-2 mt-4">
                    {{-- Order Info --}}
                    <h5 class="font-size-15 text-uppercase text-center mb-3">Order: #{{ $order->order_number }}</h5>
                    
                    <div class="table-responsive mb-3">
                        <table class="table table-nowrap align-middle table-sm border-top mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" class="w-25">Paket</th>
                                    <td>{{ $order->package->name }} ({{ $order->package->duration_days }} Hari)</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $order->user->email }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Amount --}}
                    <div class="alert alert-warning text-center mb-4" role="alert">
                        <small class="d-block mb-1">Total Pembayaran</small>
                        <h3 class="mb-0" id="payment-amount">Rp {{ number_format($order->amount, 0, ',', '.') }}</h3>
                    </div>

                    {{-- QRIS Section --}}
                    <div class="text-center mb-4">
                        <div class="d-inline-block p-3 border rounded bg-white" style="max-width: 320px;">
                            <img src="{{ asset('images/QRIS.PNG') }}" alt="QRIS TemuRuang" class="img-fluid" style="max-width: 280px;">
                        </div>
                        <p class="text-muted mt-2 mb-0" style="font-size: 12px;">
                            Scan menggunakan aplikasi e-wallet (GoPay, OVO, Dana, ShopeePay, dll)
                        </p>
                    </div>

                    {{-- Steps --}}
                    <div class="alert alert-info mb-4" role="alert">
                        <h6 class="alert-heading mb-2"><i class="mdi mdi-information-outline me-1"></i>Cara Pembayaran:</h6>
                        <ol class="mb-0 ps-3" style="font-size: 13px;">
                            <li>Buka aplikasi e-wallet atau m-banking Anda</li>
                            <li>Pilih menu <strong>Scan QR / QRIS</strong></li>
                            <li>Scan kode QR di atas</li>
                            <li>Masukkan nominal <strong>Rp {{ number_format($order->amount, 0, ',', '.') }}</strong></li>
                            <li>Selesaikan pembayaran</li>
                            <li>Klik tombol <strong>"Konfirmasi via WhatsApp"</strong> di bawah</li>
                        </ol>
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="text-center">
                        <p class="text-muted mb-2" style="font-size: 13px;">Setelah transfer, wajib klik tombol di bawah ini untuk konfirmasi pembayaran Anda.</p>
                        <a href="{{ $waLink }}" target="_blank" class="btn btn-success btn-lg w-100 waves-effect waves-light mb-2">
                            <i class="mdi mdi-whatsapp me-1"></i> Konfirmasi via WhatsApp
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-link text-muted mt-1">Nanti Saja (Kembali ke Dashboard)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
