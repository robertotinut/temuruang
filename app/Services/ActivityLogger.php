<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ActivityLogger
{
    public static function defaultSettings(): array
    {
        return [
            'telegram_enabled' => '0',
            'telegram_bot_token' => '',
            'telegram_chat_id' => '',
            'telegram_bot_username' => '',
            'telegram_notify_register' => '1',
            'telegram_notify_login' => '1',
            'telegram_notify_template_view' => '1',
        ];
    }

    /**
     * Record an activity in the database and optionally send a Telegram notification.
     */
    public static function log(
        string $eventType,
        string $subject,
        string $description,
        ?int $userId = null,
        ?int $templateId = null,
        ?Request $request = null,
        array $extraTelegramLines = []
    ): ?ActivityLog {
        try {
            $req = $request ?? request();
            $ip = $req ? $req->ip() : null;
            $ua = $req ? Str::limit((string) $req->userAgent(), 500, '') : null;
            $url = $req ? Str::limit((string) $req->fullUrl(), 500, '') : null;
            $resolvedUserId = $userId ?? (Auth::check() ? Auth::id() : null);

            $log = ActivityLog::create([
                'event_type' => $eventType,
                'user_id' => $resolvedUserId,
                'template_id' => $templateId,
                'subject' => $subject,
                'description' => $description,
                'ip_address' => $ip,
                'user_agent' => $ua,
                'url' => $url,
                'is_telegram_sent' => false,
            ]);

            $settings = SystemSetting::getMany(static::defaultSettings());
            if (($settings['telegram_enabled'] ?? '0') === '1') {
                $token = trim((string) ($settings['telegram_bot_token'] ?? ''));
                $chatId = trim((string) ($settings['telegram_chat_id'] ?? ''));

                $shouldSend = match ($eventType) {
                    'register' => ($settings['telegram_notify_register'] ?? '1') === '1',
                    'login' => ($settings['telegram_notify_login'] ?? '1') === '1',
                    'template_view' => ($settings['telegram_notify_template_view'] ?? '1') === '1',
                    default => true,
                };

                if ($shouldSend && $token !== '' && $chatId !== '') {
                    $title = match ($eventType) {
                        'register' => '🟢 <b>REGISTRASI USER BARU</b>',
                        'login' => '🔵 <b>LOGIN USER</b>',
                        'template_view' => '🟣 <b>AKSES PREVIEW TEMPLATE</b>',
                        default => '🔔 <b>AKTIVITAS SISTEM</b>',
                    };

                    $lines = [
                        $title,
                        '━━━━━━━━━━━━━━━━━━━━',
                        '📌 <b>Subjek:</b> ' . e($subject),
                        '📝 <b>Info:</b> ' . e($description),
                    ];

                    foreach ($extraTelegramLines as $line) {
                        $lines[] = $line;
                    }

                    $lines[] = '🌐 <b>IP:</b> <code>' . e($ip ?? '-') . '</code>';
                    $lines[] = '🕒 <b>Waktu:</b> ' . now()->timezone('Asia/Makassar')->format('d M Y, H:i:s') . ' WITA';

                    $res = static::sendTelegramMessage($token, $chatId, implode("\n", $lines));
                    if ($res['ok'] ?? false) {
                        $log->update(['is_telegram_sent' => true]);
                    }
                }
            }

            return $log;
        } catch (\Throwable $e) {
            \Log::warning('ActivityLogger error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Send an HTML message via Telegram Bot API.
     */
    public static function sendTelegramMessage(string $token, string $chatId, string $htmlText): array
    {
        try {
            $response = Http::timeout(5)
                ->withoutVerifying()
                ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $htmlText,
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => true,
                ]);

            $json = $response->json() ?? [];
            if ($response->successful() && ($json['ok'] ?? false)) {
                return ['ok' => true, 'data' => $json['result'] ?? []];
            }

            return [
                'ok' => false,
                'message' => $json['description'] ?? ('HTTP ' . $response->status()),
            ];
        } catch (\Throwable $e) {
            return [
                'ok' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Auto-detect Bot info & latest Chat ID from Telegram getMe + getUpdates.
     */
    public static function detectTelegramChat(string $token): array
    {
        try {
            $meRes = Http::timeout(6)->withoutVerifying()->get("https://api.telegram.org/bot{$token}/getMe");
            $meJson = $meRes->json() ?? [];
            if (!$meRes->successful() || !($meJson['ok'] ?? false)) {
                return [
                    'ok' => false,
                    'message' => 'Bot Token tidak valid: ' . ($meJson['description'] ?? 'Gagal menghubungi API Telegram'),
                ];
            }

            $botUsername = '@' . ($meJson['result']['username'] ?? 'Bot');
            $botName = $meJson['result']['first_name'] ?? 'Telegram Bot';

            $updRes = Http::timeout(6)->withoutVerifying()->get("https://api.telegram.org/bot{$token}/getUpdates", [
                'limit' => 20,
            ]);
            $updJson = $updRes->json() ?? [];
            $updates = $updJson['result'] ?? [];

            $foundChat = null;
            for ($i = count($updates) - 1; $i >= 0; $i--) {
                $u = $updates[$i];
                $chat = $u['message']['chat']
                    ?? $u['edited_message']['chat']
                    ?? $u['my_chat_member']['chat']
                    ?? $u['channel_post']['chat']
                    ?? null;
                if ($chat && isset($chat['id'])) {
                    $foundChat = $chat;
                    break;
                }
            }

            if (!$foundChat) {
                return [
                    'ok' => false,
                    'bot_username' => $botUsername,
                    'bot_name' => $botName,
                    'message' => "Bot {$botName} ({$botUsername}) berhasil terhubung, namun belum ada pesan masuk. Silakan buka aplikasi Telegram, cari {$botUsername}, klik START atau kirim pesan 'Halo', lalu klik tombol Deteksi ini lagi!",
                ];
            }

            $chatTitle = trim(($foundChat['title'] ?? '') ?: (($foundChat['first_name'] ?? '') . ' ' . ($foundChat['last_name'] ?? '')));
            if (!empty($foundChat['username'])) {
                $chatTitle .= " (@{$foundChat['username']})";
            }

            return [
                'ok' => true,
                'bot_username' => $botUsername,
                'bot_name' => $botName,
                'chat_id' => (string) $foundChat['id'],
                'chat_title' => $chatTitle,
                'message' => "Berhasil terdeteksi! Bot: {$botName} ({$botUsername}) -> Tujuan Chat: {$chatTitle} [ID: {$foundChat['id']}]",
            ];
        } catch (\Throwable $e) {
            return [
                'ok' => false,
                'message' => 'Gagal menghubungi Telegram API: ' . $e->getMessage(),
            ];
        }
    }
}
