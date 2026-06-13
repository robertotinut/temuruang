@extends('layouts.auth')
@section('title', 'Login')
@section('content')

<div class="text-center">
    <h5 class="mb-0">Selamat Datang!</h5>
    <p class="text-muted mt-2">Masuk untuk melanjutkan ke TemuRuang.</p>
</div>

@if (session('error'))
    <div class="alert alert-danger mt-3" role="alert">
        {{ session('error') }}
    </div>
@endif
<form class="mt-4 pt-2" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <div class="d-flex align-items-start">
            <div class="flex-grow-1">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="flex-shrink-0">
                <div class="">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted">Lupa password?</a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="input-group auth-pass-inputgroup">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password" aria-label="Password" aria-describedby="password-addon">
            <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">
                    Ingat saya
                </label>
            </div>  
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Masuk</button>
    </div>

    <div class="mt-4 text-center">
        <p class="text-muted mb-0">Atau masuk dengan</p>
    </div>

    <div class="mt-3">
        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger w-100 waves-effect waves-light d-flex align-items-center justify-content-center">
            <i class="mdi mdi-google font-size-18 me-2"></i> Masuk dengan Google
        </a>
    </div>
</form>

<div class="mt-5 text-center">
    <p class="text-muted mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-semibold"> Daftar sekarang </a> </p>
</div>

@endsection
