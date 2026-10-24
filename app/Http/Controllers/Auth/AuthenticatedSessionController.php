<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view with anti-bot tokens.
     */
    public function create(Request $request): View
    {
        $numA = random_int(2, 9);
        $numB = random_int(1, 9);
        $request->session()->put('login_captcha_answer', $numA + $numB);

        return view('auth.login', [
            'captchaQuestion' => "{$numA} + {$numB}",
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::check()) {
            $user = Auth::user();
            \App\Services\ActivityLogger::log(
                eventType: 'login',
                subject: $user->name . ' (' . $user->email . ')',
                description: 'Login berhasil melalui Form Email & Password (Role: ' . $user->role . ').',
                userId: $user->id,
                templateId: null,
                request: $request,
                extraTelegramLines: [
                    '👤 <b>Role:</b> ' . e($user->role),
                    '🔑 <b>Metode:</b> Email & Password',
                ]
            );
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
