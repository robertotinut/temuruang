@php
    $title = 'Wedding 01';
    $description = 'Preview template undangan nikahan (statis)';

    // Static sample data (V1)
    $couple = [
        'groom' => 'Raka',
        'bride' => 'Nadya',
        'parents' => [
            'groom' => 'Putra Bpk. A & Ibu B',
            'bride' => 'Putri Bpk. C & Ibu D',
        ],
    ];

    $event = [
        'date_iso' => '2026-12-12',
        'time' => '10:00',
        'location' => 'Gedung Serbaguna Harmoni',
        'address' => 'Jl. Melati No. 10, Jakarta',
        'maps_url' => 'https://maps.google.com/?q=Jakarta',
    ];

    $schedule = [
        ['title' => 'Akad Nikah', 'time' => '10:00 - 11:00', 'note' => 'Ruang Utama'],
        ['title' => 'Resepsi', 'time' => '11:00 - 14:00', 'note' => 'Ballroom'],
    ];

    $stories = [
        ['title' => 'Pertama Bertemu', 'date' => '2021', 'text' => 'Kami bertemu tanpa rencana, lalu jadi kebiasaan.'],
        ['title' => 'Lamaran', 'date' => '2025', 'text' => 'Keluarga bertemu, niat baik disampaikan, dan restu dirangkum.'],
        ['title' => 'Hari Bahagia', 'date' => '2026', 'text' => 'Kami memulai bab baru, dengan doa dari orang-orang tersayang.'],
    ];

    $gallery = [
        asset('assets/images/small/img-1.jpg'),
        asset('assets/images/small/img-2.jpg'),
        asset('assets/images/small/img-3.jpg'),
        asset('assets/images/small/img-4.jpg'),
        asset('assets/images/small/img-5.jpg'),
        asset('assets/images/small/img-6.jpg'),
    ];

    // Temporary backgrounds (replace later with real assets)
    $bg = [
        'cover' => asset('assets/images/bg-3.jpg'),
        'quote' => asset('assets/images/bg-2.jpg'),
        'couple' => asset('assets/images/bg-1.jpg'),
        'event' => asset('assets/images/bg-3.jpg'),
        'story' => asset('assets/images/bg-2.jpg'),
        'gallery' => asset('assets/images/bg-1.jpg'),
        'gift' => asset('assets/images/bg-3.jpg'),
        'rsvp' => asset('assets/images/bg-2.jpg'),
        'closing' => asset('assets/images/bg-1.jpg'),
    ];
@endphp

@extends('layouts.invitation', ['title' => $title, 'description' => $description])

@section('content')
    <div class="tr-canvas">
        <nav class="tr-dots" aria-label="Navigasi section">
            <button class="tr-dot" type="button" data-jump="cover" aria-label="Cover"></button>
            <button class="tr-dot" type="button" data-jump="quote" aria-label="Quote"></button>
            <button class="tr-dot" type="button" data-jump="couple" aria-label="Couple"></button>
            <button class="tr-dot" type="button" data-jump="event" aria-label="Event"></button>
            <button class="tr-dot" type="button" data-jump="story" aria-label="Story"></button>
            <button class="tr-dot" type="button" data-jump="gallery" aria-label="Gallery"></button>
            <button class="tr-dot" type="button" data-jump="gift" aria-label="Gift"></button>
            <button class="tr-dot" type="button" data-jump="rsvp" aria-label="RSVP"></button>
            <button class="tr-dot" type="button" data-jump="closing" aria-label="Closing"></button>
        </nav>

        <div class="tr-snap" id="tr-snap">
            <section class="tr-page" id="cover" style="background:url('{{ $bg['cover'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="tr-kicker mb-3 tr-sans">The Wedding Of</div>
                        <h1 class="tr-title tr-serif display-4 mb-2">{{ $couple['groom'] }} <span class="tr-gold">&</span> {{ $couple['bride'] }}</h1>
                        <div class="tr-sans" style="color:var(--tr-muted);">
                            {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('d. m. y') }}
                        </div>
                        <div class="tr-divider my-4"></div>
                        <div class="tr-sans small" style="color:var(--tr-muted);">Dear</div>
                        <div class="tr-sans fw-semibold mb-3">Nama Tamu</div>
                        <button class="btn btn-light w-100 py-2" type="button" id="btn-open">Buka Undangan</button>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="quote" style="background:url('{{ $bg['quote'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim tr-card p-4">
                        <div class="tr-kicker mb-2 tr-sans">Bismillah</div>
                        <h2 class="tr-title tr-serif h3 mb-3">"Dan segala sesuatu Kami ciptakan berpasang-pasangan agar kamu mengingat (kebesaran Allah)."</h2>
                        <div class="tr-sans" style="color:var(--tr-muted);">QS. Az-Zariyat: 49</div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="couple" style="background:url('{{ $bg['couple'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="text-center mb-4">
                            <div class="tr-kicker tr-sans">The Bride & The Groom</div>
                        </div>
                        <div class="tr-card p-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-12 text-center">
                                    <div class="tr-serif h2 mb-1">{{ $couple['bride'] }}</div>
                                    <div class="tr-sans small" style="color:var(--tr-muted);">{{ $couple['parents']['bride'] }}</div>
                                </div>
                                <div class="col-12"><div class="tr-divider"></div></div>
                                <div class="col-12 text-center">
                                    <div class="tr-serif h2 mb-1">{{ $couple['groom'] }}</div>
                                    <div class="tr-sans small" style="color:var(--tr-muted);">{{ $couple['parents']['groom'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="event" style="background:url('{{ $bg['event'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="text-center mb-4">
                            <div class="tr-kicker tr-sans">Wedding Event</div>
                            <h2 class="tr-title tr-serif h1 mb-0">Akad & Resepsi</h2>
                        </div>

                        <div class="tr-card p-4 mb-3">
                            <div class="text-center">
                                <div class="tr-serif h3 mb-1">Akad Nikah</div>
                                <div class="tr-sans" style="color:var(--tr-muted);">
                                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                                </div>
                                <div class="tr-sans" style="color:var(--tr-muted);">Pukul: {{ $schedule[0]['time'] }}</div>
                            </div>
                        </div>

                        <div class="tr-card p-4 mb-3">
                            <div class="text-center">
                                <div class="tr-serif h3 mb-1">Resepsi</div>
                                <div class="tr-sans" style="color:var(--tr-muted);">
                                    {{ \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') }}
                                </div>
                                <div class="tr-sans" style="color:var(--tr-muted);">Pukul: {{ $schedule[1]['time'] }}</div>
                            </div>
                        </div>

                        <div class="tr-card p-4">
                            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                <div class="tr-sans small" style="color:var(--tr-muted);">
                                    <i class="mdi mdi-map-marker-outline me-1"></i> {{ $event['location'] }}
                                </div>
                                <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn btn-outline-light btn-sm">Lihat Lokasi</a>
                            </div>
                            <div class="tr-divider my-3"></div>
                            <div class="tr-sans small" style="color:var(--tr-muted);">{{ $event['address'] }}</div>
                            <span id="tr-target" data-target="{{ $event['date_iso'] }}T{{ $event['time'] }}:00+07:00" style="display:none;"></span>
                            <div class="tr-divider my-3"></div>
                            <div class="row g-2 tr-countdown">
                                <div class="col-3 text-center"><div class="tr-num" id="cd-days">0</div><div class="tr-lbl">Hari</div></div>
                                <div class="col-3 text-center"><div class="tr-num" id="cd-hours">0</div><div class="tr-lbl">Jam</div></div>
                                <div class="col-3 text-center"><div class="tr-num" id="cd-mins">0</div><div class="tr-lbl">Menit</div></div>
                                <div class="col-3 text-center"><div class="tr-num" id="cd-secs">0</div><div class="tr-lbl">Detik</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="story" style="background:url('{{ $bg['story'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="text-center mb-4">
                            <div class="tr-kicker tr-sans">Love Story</div>
                            <h2 class="tr-title tr-serif h1 mb-0">Perjalanan</h2>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            @foreach ($stories as $s)
                                <div class="tr-card p-4">
                                    <div class="d-flex align-items-start justify-content-between gap-2">
                                        <div>
                                            <div class="tr-serif h4 mb-1">{{ $s['title'] }}</div>
                                            <div class="tr-sans small" style="color:var(--tr-muted);">{{ $s['date'] }}</div>
                                        </div>
                                        <i class="mdi mdi-heart-outline tr-gold fs-4"></i>
                                    </div>
                                    <div class="tr-divider my-3"></div>
                                    <div class="tr-sans" style="color:var(--tr-muted);">{{ $s['text'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="gallery" style="background:url('{{ $bg['gallery'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="text-center mb-4">
                            <div class="tr-kicker tr-sans">Our Gallery</div>
                            <h2 class="tr-title tr-serif h1 mb-0">Gallery</h2>
                        </div>
                        <div class="tr-card p-3">
                            <div class="row g-2">
                                @foreach ($gallery as $img)
                                    <div class="col-6">
                                        <a href="{{ $img }}" target="_blank" rel="noopener" class="d-block">
                                            <img src="{{ $img }}" alt="Gallery" style="width:100%; aspect-ratio: 1/1; object-fit:cover; border-radius:10px;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="gift" style="background:url('{{ $bg['gift'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="text-center mb-4">
                            <div class="tr-kicker tr-sans">Wedding Gift</div>
                            <h2 class="tr-title tr-serif h1 mb-0">Kirim Hadiah</h2>
                        </div>
                        <div class="tr-card p-4">
                            <div class="tr-sans" style="color:var(--tr-muted);">Bagi keluarga/teman yang ingin mengirimkan hadiah, dapat melalui rekening berikut.</div>
                            <div class="tr-divider my-3"></div>
                            <div class="d-flex align-items-center justify-content-between gap-2">
                                <div>
                                    <div class="tr-sans small" style="color:var(--tr-muted);">BCA</div>
                                    <div class="tr-serif h4 mb-0">1234 5678 90</div>
                                    <div class="tr-sans small" style="color:var(--tr-muted);">a.n {{ $couple['groom'] }}</div>
                                </div>
                                <button class="btn btn-outline-light btn-sm" type="button" id="btn-copy-rek">Copy</button>
                            </div>
                            <div class="small mt-2" id="copy-rek-status" style="display:none; color:var(--tr-muted);">Tersalin.</div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="rsvp" style="background:url('{{ $bg['rsvp'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim">
                        <div class="text-center mb-4">
                            <div class="tr-kicker tr-sans">Ucapkan Sesuatu</div>
                            <h2 class="tr-title tr-serif h1 mb-0">RSVP & Ucapan</h2>
                        </div>

                        <div class="tr-card p-4 mb-3">
                            <div class="row g-3 tr-sans">
                                <div class="col-6"><button type="button" class="btn btn-success w-100" id="btn-hadir">Hadir</button></div>
                                <div class="col-6"><button type="button" class="btn btn-outline-danger w-100" id="btn-tidak-hadir">Tidak Hadir</button></div>
                                <div class="col-12"><input class="form-control" id="rsvp-name" placeholder="Nama" /></div>
                                <div class="col-12"><textarea class="form-control" id="rsvp-message" rows="3" placeholder="Ucapan"></textarea></div>
                                <div class="col-12"><button class="btn btn-light w-100" type="button" id="btn-rsvp-submit">Kirim</button></div>
                                <div class="col-12">
                                    <div class="alert alert-success mb-0" id="rsvp-ok" style="display:none;">Terkirim (dummy).</div>
                                </div>
                            </div>
                        </div>

                        <div class="tr-card p-4">
                            <div class="tr-sans fw-semibold mb-2">Komentar</div>
                            <div id="guestbook-list" class="d-flex flex-column gap-3 tr-sans">
                                <div class="border-bottom pb-3" style="border-color:var(--tr-line) !important;">
                                    <div class="fw-semibold">Ayu</div>
                                    <div style="color:var(--tr-muted);">Selamat ya, lancar sampai hari H.</div>
                                    <div class="small" style="color:var(--tr-muted);">Baru saja</div>
                                </div>
                                <div class="border-bottom pb-3" style="border-color:var(--tr-line) !important;">
                                    <div class="fw-semibold">Dimas</div>
                                    <div style="color:var(--tr-muted);">Semoga sakinah mawaddah warahmah.</div>
                                    <div class="small" style="color:var(--tr-muted);">1 jam lalu</div>
                                </div>
                                <div>
                                    <div class="fw-semibold">Nisa</div>
                                    <div style="color:var(--tr-muted);">Bahagia terus berdua.</div>
                                    <div class="small" style="color:var(--tr-muted);">Kemarin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tr-page" id="closing" style="background:url('{{ $bg['closing'] }}') center/cover no-repeat;">
                <div class="tr-inner">
                    <div class="tr-anim text-center">
                        <div class="tr-kicker tr-sans mb-3">Terima Kasih</div>
                        <h2 class="tr-title tr-serif display-5 mb-3">{{ $couple['groom'] }} <span class="tr-gold">&</span> {{ $couple['bride'] }}</h2>
                        <div class="tr-sans" style="color:var(--tr-muted);">Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.</div>
                        <div class="tr-divider my-4"></div>
                        <div class="tr-sans small" style="color:var(--tr-muted);">Copyright {{ date('Y') }} TemuRuang - Wedding 01</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const snap = document.getElementById('tr-snap');
        const btnOpen = document.getElementById('btn-open');
        const dots = Array.from(document.querySelectorAll('.tr-dot'));
        const pages = Array.from(document.querySelectorAll('.tr-page'));

        // Gate: disable scrolling until "Buka Undangan"
        if (snap) snap.style.overflowY = 'hidden';
        if (btnOpen) {
            btnOpen.addEventListener('click', function () {
                if (!snap) return;
                snap.style.overflowY = 'auto';
                const quote = document.getElementById('quote');
                if (quote) quote.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Dots navigation
        dots.forEach((btn) => {
            btn.addEventListener('click', function () {
                const id = btn.getAttribute('data-jump');
                if (!id) return;
                const el = document.getElementById(id);
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Intersection: enter animation + active dot
        const io = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (!e.isIntersecting) return;
                const page = e.target;
                const id = page.getAttribute('id');
                dots.forEach((d) => d.setAttribute('aria-current', String(d.getAttribute('data-jump') === id)));
                page.querySelectorAll('.tr-anim').forEach((el) => el.classList.add('is-in'));
            });
        }, { root: snap, threshold: 0.55 });

        pages.forEach((p) => io.observe(p));

        // Countdown
        const targetEl = document.getElementById('tr-target');
        const targetIso = targetEl ? targetEl.getAttribute('data-target') : null;
        const $days = document.getElementById('cd-days');
        const $hours = document.getElementById('cd-hours');
        const $mins = document.getElementById('cd-mins');
        const $secs = document.getElementById('cd-secs');
        function pad(n){ return String(n).padStart(2, '0'); }
        function tick(){
            if (!targetIso) return;
            const target = new Date(targetIso).getTime();
            const now = Date.now();
            const diffMs = Math.max(0, target - now);
            const sec = Math.floor(diffMs / 1000);
            const days = Math.floor(sec / 86400);
            const hours = Math.floor((sec % 86400) / 3600);
            const mins = Math.floor((sec % 3600) / 60);
            const secs = sec % 60;
            if ($days) $days.textContent = days;
            if ($hours) $hours.textContent = pad(hours);
            if ($mins) $mins.textContent = pad(mins);
            if ($secs) $secs.textContent = pad(secs);
        }
        tick();
        setInterval(tick, 1000);

        // Copy bank account (demo)
        const btnCopyRek = document.getElementById('btn-copy-rek');
        const copyRekStatus = document.getElementById('copy-rek-status');
        if (btnCopyRek) {
            btnCopyRek.addEventListener('click', async function () {
                try {
                    await navigator.clipboard.writeText('1234567890');
                    if (copyRekStatus) {
                        copyRekStatus.style.display = 'block';
                        setTimeout(() => copyRekStatus.style.display = 'none', 1400);
                    }
                } catch (e) {}
            });
        }

        // RSVP demo: append comment on send
        let attendanceStatus = 'Hadir';
        const btnHadir = document.getElementById('btn-hadir');
        const btnTidak = document.getElementById('btn-tidak-hadir');
        if (btnHadir) btnHadir.addEventListener('click', () => { attendanceStatus = 'Hadir'; btnHadir.className = 'btn btn-success w-100'; btnTidak.className = 'btn btn-outline-danger w-100'; });
        if (btnTidak) btnTidak.addEventListener('click', () => { attendanceStatus = 'Tidak Hadir'; btnTidak.className = 'btn btn-danger w-100'; btnHadir.className = 'btn btn-outline-success w-100'; });

        const btnRsvp = document.getElementById('btn-rsvp-submit');
        const rsvpOk = document.getElementById('rsvp-ok');
        const gbList = document.getElementById('guestbook-list');
        if (btnRsvp) {
            btnRsvp.addEventListener('click', function () {
                if (rsvpOk) {
                    rsvpOk.style.display = 'block';
                    setTimeout(() => rsvpOk.style.display = 'none', 1600);
                }

                const name = (document.getElementById('rsvp-name')?.value || '').trim() || 'Tamu';
                const msg = (document.getElementById('rsvp-message')?.value || '').trim();
                if (!msg || !gbList) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'border-bottom pb-3';
                wrapper.style.borderColor = 'var(--tr-line)';
                wrapper.innerHTML = `
                    <div class="fw-semibold"></div>
                    <div style="color:var(--tr-muted);"></div>
                    <div class="small" style="color:var(--tr-muted);">Baru saja</div>
                `;
                wrapper.children[0].textContent = name + ' - ' + attendanceStatus;
                wrapper.children[1].textContent = msg;
                gbList.prepend(wrapper);
            });
        }
    })();
</script>
@endpush

