<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view with anti-bot tokens.
     */
    public function create(Request $request): View
    {
        $numA = random_int(2, 9);
        $numB = random_int(2, 9);
        $request->session()->put('register_captcha_answer', $numA + $numB);

        return view('auth.register', [
            'captchaQuestion' => "{$numA} + {$numB}",
            'formTimestamp' => encrypt(now()->timestamp),
        ]);
    }

    /**
     * Handle an incoming registration request with multi-layer anti-bot validation.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $throttleKey = 'register-attempt:' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 4)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'name' => "Terlalu banyak percobaan pendaftaran. Silakan tunggu {$seconds} detik lagi.",
            ]);
        }

        // 1. Honeypot Check (bots fill hidden fields automatically)
        if ($request->filled('website_url')) {
            RateLimiter::hit($throttleKey, 900);
            throw ValidationException::withMessages([
                'name' => 'Pendaftaran ditolak karena terdeteksi aktivitas otomatis.',
            ]);
        }

        // 2. Minimum Fill-Time Check (bots submit in < 3 seconds or forge timestamps)
        try {
            $renderedAt = (int) decrypt((string) $request->input('_form_ts'));
            $elapsed = now()->timestamp - $renderedAt;
            if ($elapsed < 3 || $elapsed > 3600) {
                RateLimiter::hit($throttleKey, 600);
                throw ValidationException::withMessages([
                    'name' => 'Pengisian form terlalu cepat atau sesi form telah kedaluwarsa. Silakan ulangi.',
                ]);
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            RateLimiter::hit($throttleKey, 600);
            throw ValidationException::withMessages([
                'name' => 'Token keamanan form tidak valid. Silakan muat ulang halaman dan coba lagi.',
            ]);
        }

        // 3. Verify Dynamic Math Security Challenge
        $expectedCaptcha = $request->session()->pull('register_captcha_answer');
        if ($expectedCaptcha === null || (int) $request->input('security_answer') !== (int) $expectedCaptcha) {
            RateLimiter::hit($throttleKey, 600);
            throw ValidationException::withMessages([
                'security_answer' => 'Jawaban verifikasi keamanan (penjumlahan) belum tepat. Silakan coba lagi.',
            ]);
        }

        // 4. Strict Name & Email Validation against Spam / Bot Patterns
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:80',
                'regex:/^[a-zA-Z\s\.\'\-]+$/u',
                function (string $attribute, mixed $value, Closure $fail) {
                    $val = trim((string) $value);
                    // Block URLs, domains, or known bot signatures in Name
                    if (preg_match('/(http|www\.|\.com|\.net|\.org|\.id|\.info|\.xyz|t666|burning\s+red)/i', $val)) {
                        $fail('Nama lengkap tidak boleh mengandung alamat web atau karakter spam.');
                        return;
                    }
                    // Block gibberish random strings (e.g. UopmhgNZZOWOIYIof)
                    foreach (preg_split('/\s+/', $val) as $word) {
                        if (strlen($word) > 14 && preg_match_all('/[A-Z]/', substr($word, 1)) >= 2) {
                            $fail('Format nama lengkap tidak valid.');
                            return;
                        }
                        if (strlen($word) >= 8 && !preg_match('/[aiueoAIUEO]/', $word)) {
                            $fail('Format nama lengkap tidak valid.');
                            return;
                        }
                    }
                },
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:120',
                'unique:' . User::class,
                function (string $attribute, mixed $value, Closure $fail) {
                    $email = strtolower(trim((string) $value));
                    [$local, $domain] = array_pad(explode('@', $email, 2), 2, '');

                    // Block plus-alias spam (e.g. morlundiskakasa+g7@gmail.com) and excessive dot-stuffing (e.g. e.rob.a.k.o.va@gmail.com)
                    if (str_contains($local, '+') || substr_count($local, '.') >= 3) {
                        $fail('Gunakan alamat email utama yang valid tanpa karakter alias (+) atau titik berlebih.');
                        return;
                    }

                    // Block known disposable / botnet domains
                    if (preg_match('/\.(info|xyz|top|click|ru|tk|ml|ga|cf|gq)$/i', $domain) || str_contains($domain, 'immenseignite')) {
                        $fail('Domain email ini tidak diizinkan untuk pendaftaran.');
                        return;
                    }
                },
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        RateLimiter::hit($throttleKey, 900);

        $user = User::create([
            'name' => trim($request->name),
            'email' => strtolower(trim($request->email)),
            'password' => Hash::make($request->password),
            'role' => 'Customer',
        ]);

        event(new Registered($user));

        Auth::login($user);

        \App\Services\ActivityLogger::log(
            eventType: 'register',
            subject: $user->name . ' (' . $user->email . ')',
            description: 'Pendaftaran akun baru berhasil melalui Form Registrasi.',
            userId: $user->id,
            templateId: null,
            request: $request,
            extraTelegramLines: [
                '📧 <b>Email:</b> ' . e($user->email),
                '🔑 <b>Metode:</b> Form Register',
            ]
        );

        return redirect(route('dashboard', absolute: false));
    }
}
