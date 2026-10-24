@extends('layouts.app')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-sm-0 font-size-18">Log Aktivitas & Bot Telegram</h4>
                <p class="text-muted mb-0 font-size-13 mt-1">Pantau setiap orang yang melihat template, login, atau daftar akun secara real-time di web maupun via Telegram Bot.</p>
            </div>
            <div class="page-title-right mt-2 mt-sm-0">
                @php
                    $isBotActive = ($settings['telegram_enabled'] ?? '0') === '1'
                        && !empty($settings['telegram_bot_token'])
                        && !empty($settings['telegram_chat_id']);
                @endphp
                <span class="badge {{ $isBotActive ? 'bg-success' : 'bg-warning text-dark' }} font-size-12 px-3 py-2 rounded-pill">
                    <i class="mdi {{ $isBotActive ? 'mdi-check-circle' : 'mdi-alert-circle' }} me-1"></i>
                    Status Bot: {{ $isBotActive ? 'TERHUBUNG & AKTIF' : 'BELUM AKTIF' }}
                </span>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-block-helper me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Summary Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted mb-2 lh-1 d-block text-uppercase fw-bold font-size-11">Total Views (Tampil ×5)</span>
                        <h3 class="mb-1 fw-bold text-primary">{{ number_format($stats['total_template_views_display'], 0, ',', '.') }}</h3>
                        <div class="text-nowrap">
                            <span class="badge bg-soft-primary text-primary">Asli DB: {{ number_format($stats['total_template_views_real'], 0, ',', '.') }}x klik</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <div class="avatar-md rounded-circle bg-soft-primary text-primary d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-eye-outline font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted mb-2 lh-1 d-block text-uppercase fw-bold font-size-11">Log Pendaftaran Baru</span>
                        <h3 class="mb-1 fw-bold text-success">{{ number_format($stats['total_registers'], 0, ',', '.') }}</h3>
                        <div class="text-nowrap">
                            <span class="text-muted font-size-12">Akun baru terdaftar</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <div class="avatar-md rounded-circle bg-soft-success text-success d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-account-plus-outline font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted mb-2 lh-1 d-block text-uppercase fw-bold font-size-11">Log Aktivitas Login</span>
                        <h3 class="mb-1 fw-bold text-info">{{ number_format($stats['total_logins'], 0, ',', '.') }}</h3>
                        <div class="text-nowrap">
                            <span class="text-muted font-size-12">Sesi login tercatat</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <div class="avatar-md rounded-circle bg-soft-info text-info d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-login font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <span class="text-muted mb-2 lh-1 d-block text-uppercase fw-bold font-size-11">Total Semua Log</span>
                        <h3 class="mb-1 fw-bold text-dark">{{ number_format($stats['total_logs'], 0, ',', '.') }}</h3>
                        <div class="text-nowrap">
                            <span class="text-muted font-size-12">Riwayat aktivitas tersimpan</span>
                        </div>
                    </div>
                    <div class="flex-shrink-0 text-end">
                        <div class="avatar-md rounded-circle bg-soft-warning text-warning d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-history font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Telegram Bot Dynamic Configuration Panel -->
<div class="row">
    <div class="col-12">
        <div class="card border-primary border-opacity-25 shadow-sm">
            <div class="card-header bg-primary bg-gradient text-white d-flex flex-wrap align-items-center justify-content-between gap-2 py-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-sm rounded bg-white bg-opacity-25 d-flex align-items-center justify-content-center text-white">
                        <i class="mdi mdi-send font-size-20"></i>
                    </div>
                    <div>
                        <h5 class="card-title text-white mb-0">Pengaturan Koneksi Bot Telegram (Dinamis)</h5>
                        <small class="text-white-50">Hubungkan Bot Telegram kamu dalam 1 menit agar setiap yang lihat template, login, atau daftar langsung masuk ke HP kamu!</small>
                    </div>
                </div>
                <button class="btn btn-light btn-sm fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#telegramGuideCollapse" aria-expanded="false">
                    <i class="mdi mdi-help-circle-outline me-1"></i> Cara Buat & Connect Bot Telegram
                </button>
            </div>

            <div class="collapse show" id="telegramGuideCollapse">
                <div class="card-body bg-light border-bottom py-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded border h-100">
                                <span class="badge bg-primary mb-2">Langkah 1</span>
                                <h6 class="fw-bold mb-1">Buat Bot di @BotFather</h6>
                                <p class="text-muted font-size-12 mb-0">Buka Telegram, cari <b>@BotFather</b>, ketik <code>/newbot</code>, beri nama bebas, lalu salin <b>HTTP API Token</b> yang diberikan.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded border h-100">
                                <span class="badge bg-info mb-2">Langkah 2</span>
                                <h6 class="fw-bold mb-1">Chat Bot Kamu & Klik Deteksi</h6>
                                <p class="text-muted font-size-12 mb-0">Tempel Token di kolom bawah, buka bot baru kamu di Telegram lalu klik <b>START</b> (atau kirim pesan "Halo"), lalu klik tombol <b>"Deteksi Chat ID Otomatis"</b>.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-white rounded border h-100">
                                <span class="badge bg-success mb-2">Langkah 3</span>
                                <h6 class="fw-bold mb-1">Simpan & Kirim Test</h6>
                                <p class="text-muted font-size-12 mb-0">Centang <b>Aktifkan Bot Telegram</b>, pilih event yang mau dikirim, klik <b>Simpan Pengaturan</b>, lalu coba tombol <b>Kirim Pesan Test</b>!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('master.activity-logs.telegram.update') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <label class="form-label fw-bold">1. Telegram Bot API Token <span class="text-danger">*</span></label>
                            <input type="text" id="telegram_bot_token" name="telegram_bot_token"
                                value="{{ old('telegram_bot_token', $settings['telegram_bot_token'] ?? '') }}"
                                placeholder="Contoh: 7123456789:AAHxyzAbc1234567890_token_bot_kamu"
                                class="form-control font-monospace">
                            <div class="form-text">Token rahasia yang didapat dari <b>@BotFather</b> di Telegram.</div>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label fw-bold">2. Telegram Chat ID Tujuan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="telegram_chat_id" name="telegram_chat_id"
                                    value="{{ old('telegram_chat_id', $settings['telegram_chat_id'] ?? '') }}"
                                    placeholder="Contoh: 123456789 atau -100123456789"
                                    class="form-control font-monospace">
                                <button type="button" id="btnDetectChat" onclick="detectTelegramChatId()" class="btn btn-info text-white fw-bold">
                                    <i class="mdi mdi-radar me-1"></i> Deteksi Chat ID Otomatis
                                </button>
                            </div>
                            <div id="detectStatusMsg" class="form-text">Kirim pesan apa saja ke bot kamu di Telegram, lalu klik <b>Deteksi Chat ID Otomatis</b>.</div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">3. Pengaturan Notifikasi yang Dikirim ke Telegram</h6>
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <div class="form-check form-switch p-3 border rounded bg-soft-primary border-primary border-opacity-25 h-100">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="sw_enabled" name="telegram_enabled" value="1"
                                    {{ ($settings['telegram_enabled'] ?? '0') === '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold text-primary" for="sw_enabled">
                                    Aktifkan Bot Telegram
                                    <small class="d-block text-muted fw-normal mt-1">Master switch pengiriman notif ke Telegram</small>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-check form-switch p-3 border rounded bg-light h-100">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="sw_register" name="telegram_notify_register" value="1"
                                    {{ ($settings['telegram_notify_register'] ?? '1') === '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="sw_register">
                                    🎉 Notif Register Baru
                                    <small class="d-block text-muted fw-normal mt-1">Saat ada user daftar akun baru</small>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-check form-switch p-3 border rounded bg-light h-100">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="sw_login" name="telegram_notify_login" value="1"
                                    {{ ($settings['telegram_notify_login'] ?? '1') === '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="sw_login">
                                    🔐 Notif User Login
                                    <small class="d-block text-muted fw-normal mt-1">Saat user/admin masuk ke sistem</small>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6">
                            <div class="form-check form-switch p-3 border rounded bg-light h-100">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="sw_view" name="telegram_notify_template_view" value="1"
                                    {{ ($settings['telegram_notify_template_view'] ?? '1') === '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="sw_view">
                                    👀 Notif Lihat Template
                                    <small class="d-block text-muted fw-normal mt-1">Setiap pengunjung membuka preview template</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary fw-bold px-4">
                            <i class="mdi mdi-content-save-check-outline me-1"></i> Simpan Pengaturan Bot Telegram
                        </button>

                        <button type="submit" form="formTestTelegram" class="btn btn-success fw-bold">
                            <i class="mdi mdi-send-check-outline me-1"></i> Kirim Pesan Test ke Telegram Sekarang
                        </button>
                    </div>
                </form>

                <form id="formTestTelegram" action="{{ route('master.activity-logs.telegram.test') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Activity Logs Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <h5 class="card-title mb-0">Riwayat Log Aktivitas Web</h5>
                    <small class="text-muted">Mencatat IP Address, Browser/Perangkat, User, dan Waktu akses secara otomatis.</small>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-1">
                    @php $currentType = request('type', ''); @endphp
                    <a href="{{ route('master.activity-logs.index') }}"
                       class="btn btn-sm {{ $currentType === '' ? 'btn-dark' : 'btn-outline-secondary' }}">
                        Semua
                    </a>
                    <a href="{{ route('master.activity-logs.index', ['type' => 'template_view']) }}"
                       class="btn btn-sm {{ $currentType === 'template_view' ? 'btn-primary' : 'btn-outline-primary' }}">
                        👀 View Template
                    </a>
                    <a href="{{ route('master.activity-logs.index', ['type' => 'register']) }}"
                       class="btn btn-sm {{ $currentType === 'register' ? 'btn-success' : 'btn-outline-success' }}">
                        🎉 Register
                    </a>
                    <a href="{{ route('master.activity-logs.index', ['type' => 'login']) }}"
                       class="btn btn-sm {{ $currentType === 'login' ? 'btn-info text-white' : 'btn-outline-info' }}">
                        🔐 Login
                    </a>

                    @if($logs->total() > 0)
                        <form action="{{ route('master.activity-logs.clear') }}" method="POST" onsubmit="return confirm('Bersihkan semua riwayat log aktivitas? (Jumlah counter view pada template TIDAK akan terhapus)');" class="d-inline ms-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-soft-danger">
                                <i class="mdi mdi-delete-sweep-outline me-1"></i> Bersihkan Log
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 170px;">Waktu</th>
                                <th style="width: 150px;">Tipe</th>
                                <th>Aktivitas & Detail</th>
                                <th style="width: 220px;">User / Pengunjung</th>
                                <th style="width: 240px;">IP & Perangkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark font-size-13">{{ $log->created_at->format('d M Y, H:i:s') }}</div>
                                        <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        @if($log->event_type === 'template_view')
                                            <span class="badge bg-soft-primary text-primary font-size-12 px-2 py-1">
                                                👀 View Template
                                            </span>
                                        @elseif($log->event_type === 'register')
                                            <span class="badge bg-soft-success text-success font-size-12 px-2 py-1">
                                                🎉 Register Akun
                                            </span>
                                        @elseif($log->event_type === 'login')
                                            <span class="badge bg-soft-info text-info font-size-12 px-2 py-1">
                                                🔐 Login
                                            </span>
                                        @else
                                            <span class="badge bg-light text-dark font-size-12 px-2 py-1">
                                                {{ $log->event_type }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $log->subject ?? $log->title }}</div>
                                        @if($log->description)
                                            <div class="text-muted font-size-12 mt-1">{{ $log->description }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->user)
                                            <div class="fw-bold text-dark font-size-13">{{ $log->user->name }}</div>
                                            <small class="text-muted">{{ $log->user->email }}</small>
                                        @else
                                            <span class="badge bg-light text-secondary">Pengunjung (Guest)</span>
                                        @endif
                                    </td>
                                    <td>
                                        <code class="fw-bold text-dark">{{ $log->ip_address ?? '-' }}</code>
                                        <div class="text-muted font-size-11 text-truncate" style="max-width: 230px;" title="{{ $log->user_agent }}">
                                            {{ \Illuminate\Support\Str::limit($log->user_agent, 55) }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="mdi mdi-clipboard-text-Search-outline d-block font-size-24 mb-2"></i>
                                        Belum ada riwayat aktivitas yang tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($logs->hasPages())
                    <div class="mt-4">
                        {{ $logs->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
async function detectTelegramChatId() {
    const tokenInput = document.getElementById('telegram_bot_token');
    const chatInput = document.getElementById('telegram_chat_id');
    const statusMsg = document.getElementById('detectStatusMsg');
    const btn = document.getElementById('btnDetectChat');

    const token = tokenInput.value.trim();
    if (!token) {
        statusMsg.className = 'form-text text-danger fw-bold';
        statusMsg.textContent = '⚠️ Masukkan Bot Token dari @BotFather terlebih dahulu!';
        tokenInput.focus();
        return;
    }

    const originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i> Mendeteksi...';
    statusMsg.className = 'form-text text-primary fw-bold';
    statusMsg.textContent = 'Sedang menghubungi server Telegram...';

    try {
        const res = await fetch("{{ route('master.activity-logs.telegram.detect') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ telegram_bot_token: token, bot_token: token })
        });
        const data = await res.json();

        if (data.ok && data.chat_id) {
            chatInput.value = data.chat_id;
            statusMsg.className = 'form-text text-success fw-bold';
            statusMsg.textContent = '✅ ' + data.message + ' — Jangan lupa klik Simpan Pengaturan!';
        } else {
            statusMsg.className = 'form-text text-danger fw-bold';
            statusMsg.textContent = '❌ ' + (data.message || 'Gagal mendeteksi Chat ID.');
        }
    } catch (e) {
        statusMsg.className = 'form-text text-danger fw-bold';
        statusMsg.textContent = '❌ Terjadi kesalahan koneksi saat menghubungi server.';
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalHtml;
    }
}
</script>
@endsection
