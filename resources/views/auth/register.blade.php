@extends('layouts.auth')
@section('title', 'Daftar')
@section('content')

<div class="text-center">
    <h5 class="mb-0">Daftar Akun Baru</h5>
    <p class="text-muted mt-2">Dapatkan akun gratis TemuRuang sekarang.</p>
</div>
<form class="mt-4 pt-2" method="POST" action="{{ route('register') }}">
    @csrf
    
    <div class="mb-3">
        <label class="form-label" for="name">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
    </div>

    <div class="mb-3 text-center">
        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Daftar</button>
    </div>

    <div class="mt-4 text-center">
        <p class="text-muted mb-0">Atau daftar dengan</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger w-100 waves-effect waves-light d-flex align-items-center justify-content-center">
            <i class="mdi mdi-google font-size-18 me-2"></i> Daftar dengan Google
        </a>
    </div>
</form>

<div class="mt-5 text-center">
    <p class="text-muted mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-semibold"> Masuk di sini </a> </p>
</div>

@endsection
