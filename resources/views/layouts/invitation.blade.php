<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? 'Undangan' }} | TemuRuang</title>
    <meta name="description" content="{{ $description ?? 'Undangan digital' }}" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        :root{
            --tr-bg:#07080b;
            --tr-ink:#f7f7fb;
            --tr-muted:rgba(247,247,251,.72);
            --tr-muted2:rgba(247,247,251,.58);
            --tr-line:rgba(247,247,251,.10);
            --tr-gold:#d7b45a;
            --tr-glass: rgba(12,13,18,.62);
            --tr-shadow: 0 24px 70px rgba(0,0,0,.55);
        }
        html, body{ height:100%; }
        body{
            color:var(--tr-ink);
            background: var(--tr-bg);
            overflow-x:hidden;
        }
        .tr-serif{ font-family: ui-serif, Georgia, "Times New Roman", Times, serif; }
        .tr-sans{ font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif; }

        /* Mobile-first canvas */
        .tr-canvas{
            width: min(430px, 100%);
            margin: 0 auto;
            min-height: 100vh;
            position: relative;
            background: var(--tr-bg);
            isolation: isolate;
        }
        .tr-canvas::before{
            content:"";
            position:absolute;
            inset:-120px -60px;
            background:
                radial-gradient(closest-side, rgba(215,180,90,.12), transparent 62%),
                radial-gradient(closest-side, rgba(247,247,251,.06), transparent 60%);
            filter: blur(26px);
            opacity: .55;
            z-index: 0;
            pointer-events:none;
        }
        .tr-canvas::after{
            content:"";
            position:absolute;
            inset:0;
            background: linear-gradient(180deg, rgba(7,8,11,.0), rgba(7,8,11,.55) 65%, rgba(7,8,11,.95));
            z-index: 0;
            pointer-events:none;
        }

        /* Fullscreen sections */
        .tr-snap{
            height: 100vh;
            overflow-y: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: y proximity;
            scrollbar-width: none;
        }
        .tr-snap::-webkit-scrollbar{ width:0; height:0; }

        .tr-page{
            scroll-snap-align: start;
            min-height: 100vh;
            position: relative;
            display:flex;
            align-items:center;
            padding: 54px 18px;
        }
        .tr-page::after{
            content:"";
            position:absolute;
            inset:0;
            background: var(--bg) center/cover no-repeat;
            filter: grayscale(1) contrast(1.08) brightness(.74);
            transform: scale(1.06);
            transition: transform 1.2s cubic-bezier(.2,.9,.2,1);
            z-index: 0;
        }
        .tr-page.is-active::after{
            transform: scale(1.02);
        }
        .tr-page::before{
            content:"";
            position:absolute;
            inset:0;
            background: linear-gradient(180deg, rgba(0,0,0,.74), rgba(0,0,0,.28) 42%, rgba(0,0,0,.88));
            pointer-events:none;
            z-index: 1;
        }
        .tr-page > .tr-inner{
            position: relative;
            width: 100%;
            z-index: 2;
        }

        /* Modern enter transitions */
        .tr-anim{
            opacity: 0;
            transform: translateY(18px) scale(.985);
            transition: opacity .75s cubic-bezier(.2,.9,.2,1), transform .75s cubic-bezier(.2,.9,.2,1);
            will-change: opacity, transform;
        }
        .tr-anim.is-in{ opacity: 1; transform: translateY(0) scale(1); }
        .tr-anim.tr-stagger{ transition-delay: var(--d, 0ms); }

        @media (prefers-reduced-motion: reduce) {
            .tr-anim{ opacity:1; transform:none; transition:none; }
            .tr-snap{ scroll-behavior:auto; }
        }

        .tr-kicker{
            color: var(--tr-muted);
            text-transform: uppercase;
            letter-spacing: .18em;
            font-size: .72rem;
        }
        .tr-title{ letter-spacing: 0; line-height: 1.03; }
        .tr-gold{ color: var(--tr-gold); }
        .tr-muted{ color: var(--tr-muted) !important; }
        .tr-muted2{ color: var(--tr-muted2) !important; }
        .tr-onimg{
            text-shadow: 0 12px 26px rgba(0,0,0,.55), 0 2px 8px rgba(0,0,0,.65);
        }

        .tr-card{
            background: var(--tr-glass);
            border: 1px solid var(--tr-line);
            border-radius: 16px;
            box-shadow: var(--tr-shadow);
            backdrop-filter: blur(14px);
        }
        .tr-card, .tr-card *{ color: var(--tr-ink); }

        /* Phone-like bezel for desktop preview */
        .tr-device{
            position: relative;
            border-radius: 28px;
            border: 1px solid rgba(247,247,251,.14);
            box-shadow: 0 30px 90px rgba(0,0,0,.70);
            overflow: hidden;
            background: #0b0c10;
        }
        .tr-safe{
            padding: 10px;
        }
        .tr-divider{
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--tr-line), transparent);
        }

        .tr-frame{
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(247,247,251,.14);
            box-shadow: 0 24px 70px rgba(0,0,0,.55);
            background: #0a0b10;
        }
        .tr-frame img{
            width:100%;
            height:auto;
            display:block;
            filter: grayscale(1) contrast(1.06) brightness(.92);
            transform: scale(1.02);
        }
        .tr-frame .tr-frame-overlay{
            position:absolute;
            inset:0;
            background: linear-gradient(180deg, rgba(0,0,0,.05), rgba(0,0,0,.62));
        }

        .tr-countdown .tr-num{
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1;
        }
        .tr-countdown .tr-lbl{
            font-size: .70rem;
            color: var(--tr-muted);
            margin-top: 6px;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        /* Custom controls (avoid "Bootstrap-y" look) */
        .tr-btn{
            appearance:none;
            border: 1px solid rgba(247,247,251,.16);
            background: rgba(247,247,251,.08);
            color: var(--tr-ink);
            border-radius: 14px;
            padding: 12px 14px;
            width: 100%;
            font-weight: 600;
            letter-spacing: .01em;
            transition: transform .18s ease, background .18s ease, border-color .18s ease;
        }
        .tr-btn:active{ transform: translateY(1px) scale(.995); }
        .tr-btn.primary{
            background: linear-gradient(135deg, rgba(215,180,90,.95), rgba(255,255,255,.92));
            color: #111827;
            border-color: rgba(255,255,255,.42);
        }
        .tr-btn.ghost{ background: rgba(247,247,251,.04); }

        .tr-input, .tr-textarea{
            width: 100%;
            border-radius: 14px;
            border: 1px solid rgba(247,247,251,.14);
            background: rgba(7,8,11,.58);
            color: var(--tr-ink);
            padding: 12px 12px;
            outline: none;
        }
        .tr-input::placeholder, .tr-textarea::placeholder{ color: rgba(247,247,251,.55); }
        .tr-textarea{ resize:none; }

        /* Bootstrap alert readability on dark */
        .alert{
            border-radius: 14px;
            border: 1px solid rgba(247,247,251,.14);
            background: rgba(12,13,18,.70);
            color: var(--tr-ink);
        }
        .alert-success{
            border-color: rgba(34,197,94,.35);
            background: rgba(34,197,94,.12);
        }

        .tr-seg{
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .tr-pill{
            border-radius: 999px;
            padding: 10px 12px;
            border: 1px solid rgba(247,247,251,.14);
            background: rgba(247,247,251,.06);
            color: var(--tr-ink);
            font-weight: 700;
        }
        .tr-pill.on{
            background: rgba(34,197,94,.20);
            border-color: rgba(34,197,94,.35);
        }
        .tr-pill.off{
            background: rgba(239,68,68,.20);
            border-color: rgba(239,68,68,.35);
        }

        /* Side dots nav */
        .tr-dots{
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            display:flex;
            flex-direction: column;
            gap: 10px;
            z-index: 10;
        }
        .tr-dot{
            width: 10px; height: 10px;
            border-radius: 999px;
            border: 1px solid rgba(247,247,251,.40);
            background: rgba(247,247,251,.08);
            padding:0;
        }
        .tr-dot[aria-current="true"]{
            background: var(--tr-gold);
            border-color: var(--tr-gold);
            box-shadow: 0 0 0 7px rgba(215,180,90,.14);
        }

        /* Floating utility button */
        .tr-fab{
            position: absolute;
            left: 12px;
            bottom: 14px;
            z-index: 12;
            display:flex;
            gap: 10px;
        }
        .tr-fab button{
            width: 44px; height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(247,247,251,.14);
            background: rgba(12,13,18,.65);
            color: var(--tr-ink);
            box-shadow: 0 18px 40px rgba(0,0,0,.45);
        }

        /* Modal tweaks for dark canvas */
        .modal-content{ border-radius: 16px; }
    </style>

    @stack('styles')
</head>
<body>
    @yield('content')

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
