@extends('layouts.auth')
@section('title', 'Lupa Password')
@section('content')

<div class="text-center">
    <h5 class="mb-0">Reset Password</h5>
    <p class="text-muted mt-2">Lupa password Anda? Tidak masalah. Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password.</p>
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="alert alert-success mt-4" role="alert">
        {{ session('status') }}
    </div>
@endif

<form class="mt-4 pt-2" method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email terdaftar">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 text-center">
        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Kirim Link Reset Password</button>
    </div>
</form>

<div class="mt-5 text-center">
    <p class="text-muted mb-0">Ingat password Anda? <a href="{{ route('login') }}" class="text-primary fw-semibold"> Masuk di sini </a> </p>
</div>

@endsection
