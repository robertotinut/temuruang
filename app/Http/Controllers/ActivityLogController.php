<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\SystemSetting;
use App\Models\Template;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $filterType = $request->query('type', 'all');

        $query = ActivityLog::with(['user', 'template'])->latest();
        if (in_array($filterType, ['template_view', 'login', 'register'], true)) {
            $query->where('event_type', $filterType);
        }

        $logs = $query->paginate(25)->withQueryString();
        $settings = SystemSetting::getMany(ActivityLogger::defaultSettings());

        $totalRealViews = (int) Template::sum('views_count');
        $stats = [
            'total_real_views' => $totalRealViews,
            'total_display_views' => $totalRealViews * 5,
            'total_template_views_real' => $totalRealViews,
            'total_template_views_display' => $totalRealViews * 5,
            'total_logins' => ActivityLog::where('event_type', 'login')->count(),
            'total_registers' => ActivityLog::where('event_type', 'register')->count(),
            'total_logs' => ActivityLog::count(),
        ];

        return view('master.activity_logs.index', compact('logs', 'settings', 'stats', 'filterType'));
    }

    public function updateTelegram(Request $request)
    {
        $request->validate([
            'telegram_bot_token' => ['nullable', 'string', 'max:255'],
            'telegram_chat_id' => ['nullable', 'string', 'max:100'],
        ]);

        $token = trim((string) $request->input('telegram_bot_token', ''));
        $chatId = trim((string) $request->input('telegram_chat_id', ''));

        SystemSetting::setValue('telegram_enabled', $request->has('telegram_enabled') ? '1' : '0');
        SystemSetting::setValue('telegram_bot_token', $token);
        SystemSetting::setValue('telegram_chat_id', $chatId);
        SystemSetting::setValue('telegram_notify_register', $request->has('telegram_notify_register') ? '1' : '0');
        SystemSetting::setValue('telegram_notify_login', $request->has('telegram_notify_login') ? '1' : '0');
        SystemSetting::setValue('telegram_notify_template_view', $request->has('telegram_notify_template_view') ? '1' : '0');

        if ($token !== '' && $chatId === '') {
            $detected = ActivityLogger::detectTelegramChat($token);
            if ($detected['ok'] ?? false) {
                SystemSetting::setValue('telegram_chat_id', $detected['chat_id']);
                SystemSetting::setValue('telegram_bot_username', $detected['bot_username'] ?? '');
                return redirect()->route('master.activity-logs.index')
                    ->with('success', 'Pengaturan disimpan & Chat ID otomatis terdeteksi: ' . $detected['message']);
            }
        }

        return redirect()->route('master.activity-logs.index')
            ->with('success', 'Pengaturan Bot Telegram & Notifikasi berhasil disimpan.');
    }

    public function detectTelegram(Request $request)
    {
        $token = trim((string) ($request->input('telegram_bot_token') ?: $request->input('bot_token') ?: SystemSetting::getValue('telegram_bot_token', '')));
        if ($token === '') {
            return response()->json([
                'ok' => false,
                'message' => 'Masukkan Bot Token dari @BotFather terlebih dahulu.',
            ]);
        }

        $result = ActivityLogger::detectTelegramChat($token);
        if ($result['ok'] ?? false) {
            SystemSetting::setValue('telegram_bot_token', $token);
            SystemSetting::setValue('telegram_chat_id', $result['chat_id']);
            SystemSetting::setValue('telegram_bot_username', $result['bot_username'] ?? '');
            SystemSetting::setValue('telegram_enabled', '1');
        } elseif (!empty($result['bot_username'])) {
            SystemSetting::setValue('telegram_bot_token', $token);
            SystemSetting::setValue('telegram_bot_username', $result['bot_username']);
        }

        return response()->json($result);
    }

    public function testTelegram(Request $request)
    {
        $token = trim((string) ($request->input('telegram_bot_token') ?: SystemSetting::getValue('telegram_bot_token', '')));
        $chatId = trim((string) ($request->input('telegram_chat_id') ?: SystemSetting::getValue('telegram_chat_id', '')));

        if ($token === '' || $chatId === '') {
            return redirect()->route('master.activity-logs.index')
                ->with('error', 'Harap isi Bot Token dan Chat ID terlebih dahulu (atau gunakan tombol Deteksi Otomatis).');
        }

        $msg = implode("\n", [
            '✅ <b>KONEKSI BOT TELEGRAM TEMURUANG BERHASIL!</b>',
            '━━━━━━━━━━━━━━━━━━━━',
            'Halo Admin! Bot Telegram ini sudah terhubung dengan website <b>TemuRuang</b>.',
            '',
            'Notifikasi real-time yang aktif akan dikirimkan ke chat ini setiap kali ada:',
            '• 🟢 Registrasi User Baru',
            '• 🔵 Login User',
            '• 🟣 Pengunjung Membuka / Preview Template',
            '',
            '🕒 <b>Waktu Test:</b> ' . now()->timezone('Asia/Makassar')->format('d M Y, H:i:s') . ' WITA',
        ]);

        $res = ActivityLogger::sendTelegramMessage($token, $chatId, $msg);

        if ($res['ok'] ?? false) {
            return redirect()->route('master.activity-logs.index')
                ->with('success', 'Pesan test berhasil dikirim ke Telegram Anda! Silakan cek aplikasi Telegram.');
        }

        return redirect()->route('master.activity-logs.index')
            ->with('error', 'Gagal mengirim pesan ke Telegram: ' . ($res['message'] ?? 'Unknown error'));
    }

    public function clearLogs()
    {
        ActivityLog::truncate();

        return redirect()->route('master.activity-logs.index')
            ->with('success', 'Seluruh riwayat log aktivitas berhasil dibersihkan.');
    }
}
