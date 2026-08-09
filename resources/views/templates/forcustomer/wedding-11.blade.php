@php
    $guestName = trim(urldecode((string) request()->query('to', request()->query('kpd', ''))));
    $guestName = $guestName !== '' ? $guestName : 'Nama Tamu Undangan';
@endphp
<!DOCTYPE html>

<html class="dark" lang="id"><head>
<meta charset="utf-8"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Undangan Pernikahan Surya &amp; Icha</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Be+Vietnam+Pro:wght@400;600&amp;family=Cormorant+Garamond:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-error": "#690005",
                    "tertiary": "#cfd0b8",
                    "on-secondary": "#422b22",
                    "error-container": "#93000a",
                    "on-tertiary-fixed-variant": "#474836",
                    "antique-gold": "#B8860B",
                    "primary-fixed": "#ffe088",
                    "surface-container-low": "#1c1b1b",
                    "on-secondary-container": "#d4b1a4",
                    "surface-tint": "#e9c349",
                    "secondary-container": "#5d4339",
                    "surface": "#131313",
                    "background": "#131313",
                    "tertiary-fixed": "#e4e4cc",
                    "on-tertiary-fixed": "#1b1d0e",
                    "on-secondary-fixed-variant": "#5a4137",
                    "on-surface": "#e5e2e1",
                    "primary-container": "#d4af37",
                    "on-tertiary": "#303221",
                    "on-primary-fixed-variant": "#574500",
                    "surface-variant": "#353534",
                    "surface-container": "#201f1f",
                    "surface-container-high": "#2a2a2a",
                    "deep-ebony": "#0A0503",
                    "secondary": "#e3bfb2",
                    "tertiary-container": "#b4b49d",
                    "surface-bright": "#393939",
                    "on-primary-container": "#554300",
                    "secondary-fixed-dim": "#e3bfb2",
                    "on-background": "#e5e2e1",
                    "primary": "#f2ca50",
                    "secondary-fixed": "#ffdbce",
                    "error": "#ffb4ab",
                    "surface-dim": "#131313",
                    "on-tertiary-container": "#454634",
                    "on-error-container": "#ffdad6",
                    "surface-container-lowest": "#0e0e0e",
                    "outline": "#99907c",
                    "surface-container-highest": "#353534",
                    "on-primary-fixed": "#241a00",
                    "on-surface-variant": "#d0c5af",
                    "outline-variant": "#4d4635",
                    "inverse-on-surface": "#313030",
                    "tertiary-fixed-dim": "#c8c8b0",
                    "inverse-surface": "#e5e2e1",
                    "on-primary": "#3c2f00",
                    "sepia-text": "#A68966",
                    "primary-fixed-dim": "#e9c349",
                    "inverse-primary": "#735c00",
                    "on-secondary-fixed": "#2a170f"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "spacing": {
                    "margin-mobile": "1.25rem",
                    "gutter": "1rem",
                    "section-gap": "4rem",
                    "element-gap": "1.5rem",
                    "container-max": "480px"
            },
            "fontFamily": {
                    "decorative-script": ["Playfair Display"],
                    "body-md": ["Be Vietnam Pro"],
                    "label-caps": ["Be Vietnam Pro"],
                    "display-hero": ["Playfair Display"],
                    "headline-md": ["Playfair Display"],
                    "display-hero-mobile": ["Playfair Display"],
                    "body-lg": ["Be Vietnam Pro"],
                    "headline-lg": ["Playfair Display"]
            },
            "fontSize": {
                    "decorative-script": ["20px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600"}],
                    "display-hero": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "display-hero-mobile": ["36px", {"lineHeight": "44px", "fontWeight": "700"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
<style>
        body {
            background-color: #0A0503;
            color: #e5e2e1;
            scroll-behavior: smooth;
        }
        .javanese-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 100 100'%3E%3Cline x1='-50' y1='50' x2='50' y2='-50' stroke='%23f2ca50' stroke-width='0.8' opacity='0.08' stroke-dasharray='1 1'/%3E%3Cline x1='0' y1='100' x2='100' y2='0' stroke='%23f2ca50' stroke-width='0.8' opacity='0.08' stroke-dasharray='1 1'/%3E%3Cline x1='50' y1='150' x2='150' y2='50' stroke='%23f2ca50' stroke-width='0.8' opacity='0.08' stroke-dasharray='1 1'/%3E%3Cpath d='M 25,75 C 20,70 18,65 20,60 C 22,55 28,55 30,60 C 32,65 30,70 25,75' fill='%23f2ca50' opacity='0.08'/%3E%3Cpath d='M 75,25 C 70,20 68,15 70,10 C 72,5 78,5 80,10 C 82,15 80,20 75,25' fill='%23f2ca50' opacity='0.08'/%3E%3Cpath d='M 50,50 C 45,45 43,40 45,35 C 47,30 53,30 55,35 C 57,40 55,45 50,50' fill='%23f2ca50' opacity='0.08'/%3E%3Cpath d='M 0,0 C -5,-5 -7,-10 -5,-15 C -3,-20 3,-20 5,-15 C 7,-10 5,-5 0,0' fill='%23f2ca50' opacity='0.08'/%3E%3Cpath d='M 100,100 C 95,95 93,90 95,85 C 97,80 103,80 105,85 C 107,90 105,95 100,100' fill='%23f2ca50' opacity='0.08'/%3E%3Ccircle cx='25' cy='25' r='2' fill='%23f2ca50' opacity='0.15'/%3E%3Cpath d='M 25,21 C 23,21 23,25 25,25 C 27,25 27,21 25,21 Z M 25,29 C 23,29 23,25 25,25 C 27,25 27,29 25,29 Z M 21,25 C 21,23 25,23 25,25 C 25,27 21,27 21,25 Z M 29,25 C 29,23 25,23 25,25 C 25,27 29,27 29,25 Z' fill='%23f2ca50' opacity='0.1'/%3E%3Ccircle cx='75' cy='75' r='2' fill='%23f2ca50' opacity='0.15'/%3E%3Cpath d='M 75,71 C 73,71 73,75 75,75 C 77,75 77,71 75,71 Z M 75,79 C 73,79 73,75 75,75 C 77,75 77,79 75,79 Z M 71,75 C 71,73 75,73 75,75 C 75,77 71,77 71,75 Z M 79,75 C 79,73 75,73 75,75 C 75,77 79,77 79,75 Z' fill='%23f2ca50' opacity='0.1'/%3E%3C/svg%3E");
            opacity: 0.15;
        }
        .ornament-border {
            border-image: linear-gradient(to bottom, #f2ca50, transparent) 1;
        }
        .reveal-section {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            transition: all 1s cubic-bezier(0.5, 0, 0, 1);
        }
        .reveal-section.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 10px rgba(242, 202, 80, 0.4)); }
            50% { filter: drop-shadow(0 0 20px rgba(242, 202, 80, 0.8)); }
        }
        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        @keyframes sway {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(3deg); }
        }
        .animate-sway {
            animation: sway 6s ease-in-out infinite;
        }
        .gold-glow {
            text-shadow: 0 0 10px rgba(242, 202, 80, 0.5);
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .cover-photo {
            object-position: center 38%;
            opacity: 1;
            filter: none;
        }
        .cover-modern-overlay {
            background:
                linear-gradient(to bottom, rgba(0,0,0,.38) 0%, rgba(0,0,0,.30) 22%, rgba(0,0,0,.28) 38%, rgba(0,0,0,.48) 55%, rgba(0,0,0,.58) 72%, rgba(0,0,0,.68) 100%),
                radial-gradient(ellipse at 50% 62%, rgba(0,0,0,.10) 0%, rgba(0,0,0,.18) 40%, rgba(0,0,0,.32) 100%);
        }
        .cover-piece {
            position: absolute;
            pointer-events: none;
            user-select: none;
            z-index: 2;
            opacity: 0;
            filter: drop-shadow(0 12px 14px rgba(0,0,0,.55));
            animation-duration: 1s;
            animation-timing-function: cubic-bezier(.2,.8,.2,1);
            animation-fill-mode: forwards;
        }
        .cover-top-left { top: 0; left: 0; width: 31%; animation: assembleTopLeft 1s 0s both, idleTopLeft 4.5s 1.15s ease-in-out infinite alternate; transform-origin:top left; }
        .cover-top-right { top: 0; right: 0; width: 31%; animation: assembleTopRight 1s 0s both, idleTopRight 5s 1.25s ease-in-out infinite alternate; transform-origin:top right; }
        /* The center asset already contains its own hanging lamp. */
        .cover-top-center { top: 8px; left: 50%; width: 38%; animation: assembleTopCenter 1s .15s both, idleLamp 4s 1.3s ease-in-out infinite alternate; }
        .cover-bottom-left { bottom: 0; left: 0; width: 25%; animation: assembleBottomLeft 1s .3s both, idleBottomLeft 5s 1.4s ease-in-out infinite alternate; transform-origin:bottom left; }
        .cover-bottom-right { bottom: 0; right: 0; width: 25%; animation: assembleBottomRight 1s .3s both, idleBottomRight 5.5s 1.5s ease-in-out infinite alternate; transform-origin:bottom right; }
        .cover-bottom-divider { bottom: 0; left: 50%; width: 55%; animation: assembleDivider 1s .45s both, idleDivider 4.8s 1.55s ease-in-out infinite alternate; }
        .cover-light-wash { position:absolute; inset:0; z-index:1; pointer-events:none; background:radial-gradient(circle at 50% 8%,rgba(255,190,90,.28) 0%,rgba(255,150,50,.10) 35%,transparent 70%); mix-blend-mode:screen; animation:lampGlow 4s ease-in-out infinite; }
        .cover-dust { position:absolute; inset:0; overflow:hidden; z-index:3; pointer-events:none; }
        .cover-dust span { position:absolute; bottom:28%; width:3px; height:3px; border-radius:50%; background:rgba(255,205,90,.75); box-shadow:0 0 6px rgba(255,190,70,.4); animation:goldenFloat linear infinite; }
        .cover-dust span:nth-child(1){left:22%;animation-duration:8s;animation-delay:-2s}.cover-dust span:nth-child(2){left:30%;width:2px;height:2px;animation-duration:10s;animation-delay:-6s}.cover-dust span:nth-child(3){left:38%;animation-duration:7s;animation-delay:-4s}.cover-dust span:nth-child(4){left:46%;width:4px;height:4px;animation-duration:11s;animation-delay:-8s}.cover-dust span:nth-child(5){left:55%;animation-duration:9s;animation-delay:-1s}.cover-dust span:nth-child(6){left:63%;width:2px;height:2px;animation-duration:12s;animation-delay:-7s}.cover-dust span:nth-child(7){left:70%;animation-duration:8s;animation-delay:-3s}.cover-dust span:nth-child(8){left:78%;width:2px;height:2px;animation-duration:10s;animation-delay:-5s}
        .cover-eyebrow-floating {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 4;
            white-space: nowrap;
        }
        .cover-copy {
            z-index: 4;
        }
        .cover-copy {
            width: min(82%, 330px);
            padding: 18px 12px 16px;
            opacity: 1;
            transform: none;
            border-radius: 18px;
            background: transparent;
            backdrop-filter: none;
            margin-bottom: -8px;
        }
        .cover-eyebrow-floating { animation: eyebrowIn .7s ease .75s both; }
        .cover-title { animation: textFadeUp .8s ease .95s both; }
        .cover-recipient { animation: textFade .7s ease 1.15s both; }
        .cover-button { animation: textFadeUp .7s ease 1.3s both; }
        .cover-button:hover { transform: translateY(-2px); box-shadow: 0 16px 40px rgba(242,202,80,.24); }
        .cover-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #f2ca50;
            font-family: "Be Vietnam Pro", sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .22em;
        }
        .cover-eyebrow::before,
        .cover-eyebrow::after {
            content: "";
            width: 28px;
            height: 1px;
            background: rgba(242,202,80,.58);
        }
        .cover-title {
            font-size: clamp(34px, 8vw, 44px);
            line-height: 1.02;
            letter-spacing: 0;
            text-shadow: 0 3px 8px rgba(0,0,0,.75), 0 0 14px rgba(0,0,0,.35);
        }
        .cover-recipient {
            margin: 16px auto 22px;
            color: rgba(255,255,255,.88);
            text-shadow: 0 2px 6px rgba(0,0,0,.95);
            font-size: 15px;
            line-height: 1.65;
        }
        .cover-recipient span {
            display: inline-block;
            color: #ffffff;
            text-shadow: 0 2px 5px rgba(0,0,0,.9);
            font-weight: 700;
            font-size: 19px;
        }
        .cover-button {
            box-shadow: 0 14px 36px rgba(242,202,80,.18);
            position: relative;
            z-index: 5;
            margin-bottom: 46px;
        }
        @keyframes coverPieceIn {
            to { opacity: .96; }
        }
        @keyframes coverLeftIn { from{opacity:0;transform:translateX(-35%)}to{opacity:.96;transform:translateX(0)} }
        @keyframes coverRightIn { from{opacity:0;transform:translateX(35%)}to{opacity:.96;transform:translateX(0)} }
        @keyframes coverTopIn { from{opacity:0;transform:translate(-50%,-28%)}to{opacity:.96;transform:translate(-50%,0)} }
        @keyframes coverBottomIn { from{opacity:0;transform:translateY(30%)}to{opacity:.96;transform:translateY(0)} }
        @keyframes coverDividerIn { from{opacity:0;transform:translate(-50%,35%)}to{opacity:.96;transform:translate(-50%,0)} }
        @keyframes lampFlicker { 0%,100%{opacity:.72} 48%{opacity:.82} 52%{opacity:.68} 55%{opacity:.78} }
        @keyframes dustFloat { from{transform:translateY(5px);opacity:.28} to{transform:translateY(-10px);opacity:.58} }
        @keyframes textFade { from{opacity:0} to{opacity:1} }
        @keyframes textFadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @keyframes eyebrowIn { from{opacity:0;transform:translate(-50%,8px)} to{opacity:1;transform:translate(-50%,0)} }
        #Home { background:radial-gradient(ellipse at 50% 18%,rgba(173,105,35,.16) 0%,rgba(90,45,15,.08) 30%,transparent 60%),linear-gradient(to bottom,#130d09 0%,#090604 100%); }
        #Home { background-image:radial-gradient(ellipse at 50% 12%,rgba(205,142,45,.18),rgba(116,68,24,.08) 32%,transparent 58%),linear-gradient(to bottom,#130d09 0%,#0b0705 45%,#070504 100%); }
        #Home::before { content:""; position:absolute; inset:0; pointer-events:none; opacity:.06; background-image:repeating-linear-gradient(115deg,rgba(180,126,55,.25) 0 1px,transparent 1px 12px); mix-blend-mode:screen; }
        #Home::after { content:""; position:absolute; inset:0; pointer-events:none; background:radial-gradient(ellipse at center,transparent 45%,rgba(0,0,0,.28) 100%); z-index:0; }
        #Home .reveal-section { z-index:2; }
        #Home .reveal-section h2 { color:#e7bd55; text-shadow:0 2px 8px rgba(0,0,0,.8),0 0 14px rgba(221,169,59,.2); animation:homeTitleIn .8s ease .2s both; }
        #Home .reveal-section > p { animation:homeFadeIn .7s ease .1s both; }
        #Home .reveal-section > div:first-child { opacity:.7; }
        #Home .reveal-section > div:nth-of-type(2) { opacity:.75; }
        #Home .reveal-section > div:nth-of-type(3) { animation:homeFadeIn .7s ease .45s both; }
        #Home .grid.grid-cols-4 { position:relative; z-index:2; }
        #Home .grid.grid-cols-4 > div { background:linear-gradient(145deg,rgba(48,32,20,.92),rgba(18,12,8,.95)); border:1px solid rgba(208,164,66,.45); border-radius:14px; box-shadow:inset 0 1px 0 rgba(255,255,255,.04),0 8px 20px rgba(0,0,0,.35); animation:homeCardIn .7s cubic-bezier(.16,1,.3,1) both; }
        #Home .grid.grid-cols-4 > div:nth-child(2){animation-delay:.1s} #Home .grid.grid-cols-4 > div:nth-child(3){animation-delay:.2s} #Home .grid.grid-cols-4 > div:nth-child(4){animation-delay:.3s}
        #Home .grid.grid-cols-4 span:first-child { color:#e7bd55; text-shadow:0 2px 8px rgba(0,0,0,.8); }
        #Home .grid.grid-cols-4 span:last-child { color:#ead9b2; }
        #Home { padding-top:5rem; padding-bottom:4.5rem; }
        #cover { min-height:100svh; padding-bottom:8rem !important; }
        #cover .cover-copy { margin-bottom:32px !important; }
        #cover .cover-bottom-left, #cover .cover-bottom-right, #cover .cover-bottom-divider { bottom:5rem; }
        #Home > svg { display:none; }
        #Home > img.absolute { width:7.5rem; top:3.5rem; opacity:.72; }
        #Home .reveal-section { margin-bottom:1.5rem; }
        .home-monogram { width:76px;height:76px;margin:0 auto 10px; }
        #Home .reveal-section h2 { font-size:clamp(44px,11vw,58px); margin-bottom:1rem; }
        #Home .reveal-section > div:nth-of-type(3) { margin-top:1rem!important; margin-bottom:1rem!important; }
        #Home .grid.grid-cols-4 { gap:.5rem; padding-left:.5rem; padding-right:.5rem; }
        #Home .grid.grid-cols-4 > div { padding-top:1rem; padding-bottom:1rem; border-radius:14px; }
        #Home .home-bottom-ornament { width:250px; margin-top:1.5rem; }
        nav.fixed { border-radius:22px 22px 0 0!important; padding-top:1rem!important; padding-bottom:1rem!important; }
        .home-light-beam { position:absolute; top:0; left:50%; transform:translateX(-50%); width:78%; height:48%; pointer-events:none; background:radial-gradient(ellipse at 50% 0%,rgba(255,205,120,.35),rgba(202,130,44,.18) 24%,rgba(125,70,22,.06) 46%,transparent 68%),linear-gradient(90deg,transparent 0%,rgba(238,178,83,.04) 35%,rgba(255,210,125,.16) 50%,rgba(238,178,83,.04) 65%,transparent 100%),linear-gradient(to bottom,rgba(255,190,90,.12),transparent 70%); filter:blur(14px); z-index:1; animation:homeGlow 5s ease-in-out infinite; }
        .home-dust { position:absolute; inset:0; overflow:hidden; pointer-events:none; z-index:1; }
        .home-dust i { position:absolute; bottom:18%; width:3px; height:3px; border-radius:50%; background:rgba(255,205,90,.55); box-shadow:0 0 6px rgba(255,190,70,.3); animation:homeDust 10s linear infinite; }
        .home-dust i:nth-child(1){left:18%;animation-delay:-3s}.home-dust i:nth-child(2){left:29%;width:2px;height:2px;animation-duration:12s;animation-delay:-8s}.home-dust i:nth-child(3){left:41%;animation-duration:9s;animation-delay:-4s}.home-dust i:nth-child(4){left:55%;width:2px;height:2px;animation-duration:13s;animation-delay:-10s}.home-dust i:nth-child(5){left:68%;animation-duration:11s;animation-delay:-6s}.home-dust i:nth-child(6){left:80%;width:2px;height:2px;animation-duration:9s;animation-delay:-2s}.home-dust i:nth-child(7){left:88%;animation-duration:12s;animation-delay:-7s}.home-dust i:nth-child(8){left:24%;width:2px;height:2px;animation-duration:10s;animation-delay:-5s}.home-dust i:nth-child(9){left:35%;animation-duration:14s;animation-delay:-11s}.home-dust i:nth-child(10){left:48%;width:2px;height:2px;animation-duration:8s;animation-delay:-1s}.home-dust i:nth-child(11){left:60%;animation-duration:12s;animation-delay:-9s}.home-dust i:nth-child(12){left:73%;width:2px;height:2px;animation-duration:10s;animation-delay:-6s}.home-dust i:nth-child(13){left:83%;animation-duration:13s;animation-delay:-4s}.home-dust i:nth-child(14){left:44%;width:4px;height:4px;animation-duration:11s;animation-delay:-7s}.home-dust i:nth-child(15){left:64%;width:2px;height:2px;animation-duration:9s;animation-delay:-3s}.home-dust i:nth-child(16){left:52%;animation-duration:14s;animation-delay:-12s}
        .home-monogram { position:relative; width:120px; height:120px; margin:0 auto 16px; display:flex; align-items:center; justify-content:center; }
        .home-monogram::before { content:""; position:absolute; inset:0; border:1.5px solid rgba(226,184,75,.55); border-radius:50%; }
        .home-monogram::after { content:""; position:absolute; inset:5px; border:1px solid rgba(226,184,75,.25); border-radius:50%; }
        .home-monogram .monogram-wreath { position:absolute; inset:-8px; pointer-events:none; }
        .home-monogram .monogram-text { position:relative; z-index:1; font-family:'Cormorant Garamond',Georgia,serif; font-size:44px; font-weight:400; font-style:italic; color:#e2b84b; letter-spacing:0.04em; line-height:1; text-shadow:0 2px 12px rgba(0,0,0,.7),0 0 18px rgba(226,184,75,.3); }
        .home-monogram .monogram-amp { font-family:'Cormorant Garamond',Georgia,serif; font-size:24px; font-weight:300; font-style:italic; color:rgba(226,184,75,.65); margin:0 1px; vertical-align:middle; }
        #Couple > div { position:relative; z-index:1; }
        #Home .reveal-section h2 { font-family:'Cormorant Garamond','Times New Roman',serif; font-weight:500; letter-spacing:-.02em; }
        #Home .home-bottom-ornament { display:block;width:100%;max-width:360px;height:auto;margin:1.25rem auto 0;opacity:.86;animation:homeFadeIn .8s ease 1.2s both; }
        #Home .home-bottom-corner { position:absolute; bottom:3.7rem; width:5.5rem; height:auto; opacity:.78; z-index:2; pointer-events:none; }
        #Home .home-bottom-corner.left { left:-.5rem; }
        #Home .home-bottom-corner.right { right:-.5rem; transform:scaleX(-1); }
        #Home .grid.grid-cols-4 > div { min-height:100px; padding-top:.8rem; padding-bottom:.7rem; border-radius:12px; }
        #Home .grid.grid-cols-4 span:first-child { font-family:'Cormorant Garamond',Georgia,serif; font-size:clamp(34px,9vw,42px); font-weight:500; }
        header.fixed { background:rgba(24,15,9,.94)!important; border-bottom-color:rgba(210,165,65,.28)!important; }
        header.fixed .text-primary, header.fixed .material-symbols-outlined { color:#e7bd55!important; }
        nav.fixed { background:rgba(20,14,10,.95)!important; border-top-color:rgba(210,165,65,.25)!important; }
        nav.fixed a { color:#c8b99b!important; } nav.fixed a.text-primary, nav.fixed a:hover { color:#e7bd55!important; }
        @keyframes homeTitleIn { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @keyframes homeFadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:translateY(0)} }
        @keyframes homeCardIn { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        @keyframes homeGlow { 0%,100%{opacity:.55}50%{opacity:.9} } @keyframes homeDust { 0%{transform:translate3d(0,25px,0) scale(.7);opacity:0}25%{opacity:.5}75%{opacity:.25}100%{transform:translate3d(8px,-120px,0) scale(1);opacity:0} } @keyframes homeMonoIn { from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)} } @keyframes homeMonoPulse { 0%,100%{filter:drop-shadow(0 0 0 rgba(226,184,75,0))}50%{filter:drop-shadow(0 0 8px rgba(226,184,75,.22))} }
        @keyframes assembleTopLeft { from{opacity:0;transform:translate(-45px,-25px) scale(.96)} to{opacity:1;transform:translate(0,0) scale(1)} }
        @keyframes assembleTopRight { from{opacity:0;transform:translate(45px,-25px) scale(.96)} to{opacity:1;transform:translate(0,0) scale(1)} }
        @keyframes assembleTopCenter { from{opacity:0;transform:translate(-50%,-45px) scale(.95)} to{opacity:1;transform:translate(-50%,0) scale(1)} }
        @keyframes assembleBottomLeft { from{opacity:0;transform:translate(-35px,35px) scale(.96)} to{opacity:1;transform:translate(0,0) scale(1)} }
        @keyframes assembleBottomRight { from{opacity:0;transform:translate(35px,35px) scale(.96)} to{opacity:1;transform:translate(0,0) scale(1)} }
        @keyframes assembleDivider { from{opacity:0;transform:translate(-50%,40px) scale(.95)} to{opacity:1;transform:translate(-50%,0) scale(1)} }
        @keyframes idleTopLeft { from{transform:translateY(0) rotate(-.7deg)} to{transform:translateY(3px) rotate(.7deg)} }
        @keyframes idleTopRight { from{transform:translateY(0) rotate(.7deg)} to{transform:translateY(3px) rotate(-.7deg)} }
        @keyframes idleLamp { from{transform:translateX(-50%) translateY(0)} to{transform:translateX(-50%) translateY(2px)} }
        @keyframes idleBottomLeft { from{transform:translateY(0) rotate(-.5deg)} to{transform:translateY(-2px) rotate(.5deg)} }
        @keyframes idleBottomRight { from{transform:translateY(0) rotate(.5deg)} to{transform:translateY(-2px) rotate(-.5deg)} }
        @keyframes idleDivider { from{transform:translateX(-50%) translateY(0)} to{transform:translateX(-50%) translateY(-3px)} }
        @keyframes goldenFloat { 0%{transform:translate3d(0,30px,0) scale(.7);opacity:0} 20%{opacity:.6} 70%{opacity:.35} 100%{transform:translate3d(8px,-120px,0) scale(1);opacity:0} }
        @keyframes lampGlow { 0%,100%{opacity:.15} 50%{opacity:.3} }
        @keyframes ornamentTopLeft { from{transform:translateY(0) rotate(-.8deg)} to{transform:translateY(4px) rotate(.8deg)} }
        @keyframes ornamentTopRight { from{transform:translateY(0) rotate(.8deg)} to{transform:translateY(4px) rotate(-.8deg)} }
        @keyframes ornamentLamp { from{transform:translateX(-50%) translateY(0)} to{transform:translateX(-50%) translateY(3px)} }
        @keyframes ornamentBottomLeft { from{transform:translateY(0) rotate(-.6deg)} to{transform:translateY(-3px) rotate(.6deg)} }
        @keyframes ornamentBottomRight { from{transform:translateY(0) rotate(.6deg)} to{transform:translateY(-3px) rotate(-.6deg)} }
        @keyframes ornamentDivider { from{transform:translateX(-50%) translateY(0)} to{transform:translateX(-50%) translateY(-3px)} }
        @keyframes coverTextIn {
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmerGold {
            0% { transform: translateX(-100%) rotate(25deg); }
            100% { transform: translateX(200%) rotate(25deg); }
        }
        .gold-shimmer-effect {
            position: relative;
            overflow: hidden;
        }
        .gold-shimmer-effect::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 215, 0, 0.15) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(25deg);
            animation: shimmerGold 6s infinite ease-in-out;
            pointer-events: none;
        }
        .gold-card-shadow {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6), 0 0 20px rgba(212, 175, 55, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }
        .gallery-card {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .gallery-card:hover {
            transform: translateY(-4px);
            border-color: rgba(226, 184, 75, 0.7);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6), 0 0 20px rgba(226, 184, 75, 0.25);
        }
    </style>
</head>
<body class="max-w-[480px] mx-auto relative overflow-hidden shadow-2xl bg-deep-ebony">
<!-- COVER SECTION -->
<section class="h-screen w-full relative overflow-hidden flex flex-col items-center justify-end pb-10 text-center z-50 transition-all duration-1000" id="cover">

<div class="absolute inset-0 z-0">
<img class="cover-photo w-full h-full object-cover" data-alt="Foto pembukaan pasangan pengantin" src="{{ asset('assets/templates/wedding-11/pembukaan-image.jpeg') }}"/>
</div>
<div class="cover-modern-overlay absolute inset-0"></div>
<div class="cover-light-wash"></div>
<div class="cover-dust"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
<img class="cover-piece cover-top-left" src="{{ asset('assets/templates/wedding-11/newassets/NEW/pojok%20kiri%20atas.png') }}" alt="" />
<img class="cover-piece cover-top-right" src="{{ asset('assets/templates/wedding-11/newassets/NEW/pojok%20kanan%20atas.png') }}" alt="" />
<img class="cover-piece cover-top-center" src="{{ asset('assets/templates/wedding-11/newassets/NEW/atas%20tengah.png') }}" alt="" />
<img class="cover-piece cover-bottom-left" src="{{ asset('assets/templates/wedding-11/newassets/NEW/pojok%20kiri%20bawah.png') }}" alt="" />
<img class="cover-piece cover-bottom-right" src="{{ asset('assets/templates/wedding-11/newassets/NEW/pojok%20kiri%20kanan.png') }}" alt="" />
<img class="cover-piece cover-bottom-divider" src="{{ asset('assets/templates/wedding-11/newassets/NEW/hiasan%20tengah%201.png') }}" alt="" />
<p class="cover-eyebrow cover-eyebrow-floating">THE WEDDING OF</p>
<div class="cover-copy relative z-10 flex flex-col items-center">
<h1 class="cover-title font-display-hero-mobile text-primary gold-glow mb-2">Surya &amp; Icha</h1>
<p class="cover-recipient font-body-md">Kepada Bapak/Ibu/Saudara/i:<br/><span>{{ $guestName }}</span></p>
<button class="cover-button bg-primary px-8 py-3 rounded-full flex items-center gap-3 text-on-primary font-bold tracking-widest text-xs border border-primary-fixed duration-300 hover:scale-105 active:scale-95" onclick="openInvitation()">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">mail</span>
                BUKA UNDANGAN
            </button>
</div>
</section>
<!-- CONTENT WRAPPER (Hidden initially) -->
<div class="opacity-0 transition-opacity duration-1000 relative" id="main-content">
<div class="javanese-pattern absolute inset-0 z-0 pointer-events-none opacity-20"></div>
<!-- TOP APP BAR -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/30 flex justify-between items-center px-margin-mobile py-4 max-w-container-max mx-auto">
<span class="font-decorative-script text-decorative-script text-primary">Surya &amp; Icha</span>
<div class="flex gap-4">
<button onclick="toggleAudio()" class="active:scale-95 duration-150 transition-transform hover:scale-110">
<span class="material-symbols-outlined text-primary" id="music-icon-header">volume_up</span>
</button>
<button onclick="toggleAutoscroll()" class="active:scale-95 duration-150 transition-transform hover:scale-110">
<span class="material-symbols-outlined text-primary" id="autoscroll-icon">play_arrow</span>
</button>
</div>
</header>
<!-- HERO & COUNTDOWN -->
<section class="pt-32 pb-16 px-margin-mobile relative overflow-hidden" id="Home">
<div class="home-light-beam"></div><div class="home-dust"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
<img class="absolute top-20 left-0 w-20 opacity-30 pointer-events-none z-10" src="{{ asset('assets/templates/wedding-11/newassets/NEW/pojok%20kiri%20atas.png') }}" alt="" />
<img class="absolute top-20 right-0 w-20 opacity-30 pointer-events-none z-10" src="{{ asset('assets/templates/wedding-11/newassets/NEW/pojok%20kanan%20atas.png') }}" alt="" />
<!-- Royal Glow Background -->
<div class="absolute -top-20 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary/10 via-transparent to-transparent z-0 pointer-events-none"></div>

<!-- Traditional Javanese Gunungan (Right-aligned, cut off, matching screenshot) -->
<svg class="absolute bottom-0 right-[-65px] w-[260px] h-[400px] text-primary opacity-[0.25] z-0 pointer-events-none animate-sway" viewBox="0 0 120 180" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round">
    <!-- Outer Border Path of Gunungan -->
    <path d="M 60,10 C 48,25 40,40 30,55 C 10,80 25,85 25,105 C 25,120 15,130 15,150 C 15,155 20,160 25,160 L 55,160 L 55,175 L 65,175 L 65,160 L 95,160 C 100,160 105,155 105,150 C 105,130 95,120 95,105 C 95,85 110,80 90,55 C 80,40 72,25 60,10 Z" stroke-width="1.2"/>
    
    <!-- Inner border (double outline for Javanese carving feel) -->
    <path d="M 60,16 C 50,30 43,44 34,58 C 16,81 29,86 29,104 C 29,117 20,126 20,144 C 20,149 24,154 29,154 L 91,154 C 96,154 100,149 100,144 C 100,126 91,117 91,104 C 91,86 104,81 86,58 C 77,44 70,30 60,16 Z" stroke-width="0.6" stroke-dasharray="1.5 1.5" opacity="0.6"/>

    <!-- Gapura (Gate) at the bottom -->
    <path d="M 45,154 L 45,135 L 75,135 L 75,154" stroke-width="1"/>
    <!-- Joglo Roof of Gapura -->
    <path d="M 40,135 L 50,122 L 70,122 L 80,135 Z" fill="currentColor" fill-opacity="0.1" stroke-width="1"/>
    <path d="M 50,122 L 60,112 L 70,122" stroke-width="0.8"/>
    <!-- Door arches/lines -->
    <path d="M 52,154 L 52,142 C 52,139 68,139 68,142 L 68,154" stroke-width="0.6"/>
    <line x1="60" y1="135" x2="60" y2="154" stroke-width="0.6"/>
    
    <!-- Meru / Tree of Life (Pohon Hayat) structure rising from gate -->
    <path d="M 60,112 L 60,40" stroke-width="1.2"/>
    
    <!-- Branches curving out gracefully -->
    <!-- Level 1 -->
    <path d="M 60,100 C 48,95 38,98 32,108 C 28,115 32,122 40,118 C 45,115 48,108 48,108" stroke-width="0.6"/>
    <path d="M 60,100 C 72,95 82,98 88,108 C 92,115 88,122 80,118 C 75,115 72,108 72,108" stroke-width="0.6"/>
    
    <!-- Level 2 -->
    <path d="M 60,85 C 45,78 35,82 30,95 C 26,102 32,108 38,102 C 44,96 46,90 46,90" stroke-width="0.6"/>
    <path d="M 60,85 C 75,78 85,82 90,95 C 94,102 88,108 82,102 C 76,96 74,90 74,90" stroke-width="0.6"/>
    
    <!-- Level 3 -->
    <path d="M 60,70 C 48,60 38,65 35,78 C 32,84 38,90 42,84 C 46,78 48,73 48,73" stroke-width="0.6"/>
    <path d="M 60,70 C 72,60 82,65 85,78 C 88,84 82,90 78,84 C 74,78 72,73 72,73" stroke-width="0.6"/>

    <!-- Level 4 -->
    <path d="M 60,55 C 50,45 42,50 40,60 C 38,65 44,70 46,65 C 48,60 50,57 50,57" stroke-width="0.6"/>
    <path d="M 60,55 C 70,45 78,50 80,60 C 82,65 76,70 74,65 C 72,60 70,57 70,57" stroke-width="0.6"/>

    <!-- Traditional Javanese Wings (Sayap Gunungan) on the sides -->
    <path d="M 28,95 C 24,90 24,80 32,82 C 36,83 38,88 36,92 Z" fill="currentColor" fill-opacity="0.15"/>
    <path d="M 92,95 C 96,90 96,80 88,82 C 84,83 82,88 84,92 Z" fill="currentColor" fill-opacity="0.15"/>
    
    <!-- Central Halo/Sun representing divine blessing -->
    <circle cx="60" cy="70" r="14" stroke="currentColor" stroke-width="0.4" stroke-dasharray="1 2" opacity="0.6"/>
    <circle cx="60" cy="70" r="10" stroke="currentColor" stroke-width="0.4" opacity="0.4"/>
</svg>

<!-- Scattered Decorative Javanese Flowers (Floating, matching screenshot) -->
<div class="absolute top-24 left-16 text-primary/30 pointer-events-none animate-float z-10">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12,0 C12.8,4 16,4 16,6 C16,8 14,8 12,8 C10,8 8,8 8,6 C8,4 11.2,4 12,0 Z M12,24 C11.2,20 8,20 8,18 C8,16 10,16 12,16 C14,16 16,16 16,18 C16,20 12.8,20 12,24 Z M0,12 C4,11.2 4,8 6,8 C8,8 8,10 8,12 C8,14 8,16 6,16 C4,16 4,12.8 0,12 Z M24,12 C20,12.8 20,16 18,16 C16,16 16,14 16,12 C16,10 16,8 18,8 C20,8 20,11.2 24,12 Z M3.5,3.5 C6.3,4.9 6.3,7.8 7.7,9.1 C9.1,10.5 7.7,11.9 6.3,10.5 C4.9,9.1 2.1,9.1 3.5,3.5 Z M20.5,20.5 C17.7,19.1 17.7,16.2 16.3,14.9 C14.9,13.5 16.3,12.1 17.7,13.5 C19.1,14.9 21.9,14.9 20.5,20.5 Z M3.5,20.5 C4.9,17.7 7.8,17.7 9.1,16.3 C10.5,14.9 11.9,16.3 10.5,17.7 C9.1,19.1 9.1,21.9 3.5,20.5 Z M20.5,3.5 C19.1,6.3 19.1,9.2 17.7,10.5 C16.3,11.9 17.7,13.3 19.1,11.9 C20.5,10.5 23.3,10.5 20.5,3.5 Z" />
    </svg>
</div>
<div class="absolute top-[230px] left-8 text-primary/45 pointer-events-none animate-float z-10">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12,0 C12.8,4 16,4 16,6 C16,8 14,8 12,8 C10,8 8,8 8,6 C8,4 11.2,4 12,0 Z M12,24 C11.2,20 8,20 8,18 C8,16 10,16 12,16 C14,16 16,16 16,18 C16,20 12.8,20 12,24 Z M0,12 C4,11.2 4,8 6,8 C8,8 8,10 8,12 C8,14 8,16 6,16 C4,16 4,12.8 0,12 Z M24,12 C20,12.8 20,16 18,16 C16,16 16,14 16,12 C16,10 16,8 18,8 C20,8 20,11.2 24,12 Z M3.5,3.5 C6.3,4.9 6.3,7.8 7.7,9.1 C9.1,10.5 7.7,11.9 6.3,10.5 C4.9,9.1 2.1,9.1 3.5,3.5 Z M20.5,20.5 C17.7,19.1 17.7,16.2 16.3,14.9 C14.9,13.5 16.3,12.1 17.7,13.5 C19.1,14.9 21.9,14.9 20.5,20.5 Z M3.5,20.5 C4.9,17.7 7.8,17.7 9.1,16.3 C10.5,14.9 11.9,16.3 10.5,17.7 C9.1,19.1 9.1,21.9 3.5,20.5 Z M20.5,3.5 C19.1,6.3 19.1,9.2 17.7,10.5 C16.3,11.9 17.7,13.3 19.1,11.9 C20.5,10.5 23.3,10.5 20.5,3.5 Z" />
    </svg>
</div>
<div class="absolute top-[280px] right-24 text-primary/40 pointer-events-none animate-float z-10">
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12,0 C12.8,4 16,4 16,6 C16,8 14,8 12,8 C10,8 8,8 8,6 C8,4 11.2,4 12,0 Z M12,24 C11.2,20 8,20 8,18 C8,16 10,16 12,16 C14,16 16,16 16,18 C16,20 12.8,20 12,24 Z M0,12 C4,11.2 4,8 6,8 C8,8 8,10 8,12 C8,14 8,16 6,16 C4,16 4,12.8 0,12 Z M24,12 C20,12.8 20,16 18,16 C16,16 16,14 16,12 C16,10 16,8 18,8 C20,8 20,11.2 24,12 Z M3.5,3.5 C6.3,4.9 6.3,7.8 7.7,9.1 C9.1,10.5 7.7,11.9 6.3,10.5 C4.9,9.1 2.1,9.1 3.5,3.5 Z M20.5,20.5 C17.7,19.1 17.7,16.2 16.3,14.9 C14.9,13.5 16.3,12.1 17.7,13.5 C19.1,14.9 21.9,14.9 20.5,20.5 Z M3.5,20.5 C4.9,17.7 7.8,17.7 9.1,16.3 C10.5,14.9 11.9,16.3 10.5,17.7 C9.1,19.1 9.1,21.9 3.5,20.5 Z M20.5,3.5 C19.1,6.3 19.1,9.2 17.7,10.5 C16.3,11.9 17.7,13.3 19.1,11.9 C20.5,10.5 23.3,10.5 20.5,3.5 Z" />
    </svg>
</div>
<div class="absolute top-[430px] left-20 text-primary/30 pointer-events-none animate-float z-10">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12,0 C12.8,4 16,4 16,6 C16,8 14,8 12,8 C10,8 8,8 8,6 C8,4 11.2,4 12,0 Z M12,24 C11.2,20 8,20 8,18 C8,16 10,16 12,16 C14,16 16,16 16,18 C16,20 12.8,20 12,24 Z M0,12 C4,11.2 4,8 6,8 C8,8 8,10 8,12 C8,14 8,16 6,16 C4,16 4,12.8 0,12 Z M24,12 C20,12.8 20,16 18,16 C16,16 16,14 16,12 C16,10 16,8 18,8 C20,8 20,11.2 24,12 Z M3.5,3.5 C6.3,4.9 6.3,7.8 7.7,9.1 C9.1,10.5 7.7,11.9 6.3,10.5 C4.9,9.1 2.1,9.1 3.5,3.5 Z M20.5,20.5 C17.7,19.1 17.7,16.2 16.3,14.9 C14.9,13.5 16.3,12.1 17.7,13.5 C19.1,14.9 21.9,14.9 20.5,20.5 Z M3.5,20.5 C4.9,17.7 7.8,17.7 9.1,16.3 C10.5,14.9 11.9,16.3 10.5,17.7 C9.1,19.1 9.1,21.9 3.5,20.5 Z M20.5,3.5 C19.1,6.3 19.1,9.2 17.7,10.5 C16.3,11.9 17.7,13.3 19.1,11.9 C20.5,10.5 23.3,10.5 20.5,3.5 Z" />
    </svg>
</div>

<div class="text-center mb-section-gap relative z-10 reveal-section">

<div class="home-monogram">
    <svg class="monogram-wreath" viewBox="0 0 140 140" fill="none">
        <!-- Left laurel branch -->
        <path d="M38 110 C32 100 28 88 28 75 C28 62 32 50 38 40" stroke="#c9a84c" stroke-width="0.8" fill="none" opacity="0.6"/>
        <ellipse cx="32" cy="48" rx="5" ry="9" transform="rotate(-25 32 48)" fill="#c9a84c" opacity="0.18"/>
        <ellipse cx="28" cy="58" rx="5" ry="9" transform="rotate(-15 28 58)" fill="#c9a84c" opacity="0.15"/>
        <ellipse cx="26" cy="70" rx="5" ry="8" transform="rotate(-5 26 70)" fill="#c9a84c" opacity="0.15"/>
        <ellipse cx="28" cy="82" rx="5" ry="9" transform="rotate(10 28 82)" fill="#c9a84c" opacity="0.15"/>
        <ellipse cx="32" cy="93" rx="5" ry="9" transform="rotate(20 32 93)" fill="#c9a84c" opacity="0.18"/>
        <!-- Right laurel branch -->
        <path d="M102 110 C108 100 112 88 112 75 C112 62 108 50 102 40" stroke="#c9a84c" stroke-width="0.8" fill="none" opacity="0.6"/>
        <ellipse cx="108" cy="48" rx="5" ry="9" transform="rotate(25 108 48)" fill="#c9a84c" opacity="0.18"/>
        <ellipse cx="112" cy="58" rx="5" ry="9" transform="rotate(15 112 58)" fill="#c9a84c" opacity="0.15"/>
        <ellipse cx="114" cy="70" rx="5" ry="8" transform="rotate(5 114 70)" fill="#c9a84c" opacity="0.15"/>
        <ellipse cx="112" cy="82" rx="5" ry="9" transform="rotate(-10 112 82)" fill="#c9a84c" opacity="0.15"/>
        <ellipse cx="108" cy="93" rx="5" ry="9" transform="rotate(-20 108 93)" fill="#c9a84c" opacity="0.18"/>
        <!-- Bottom cross -->
        <line x1="62" y1="118" x2="78" y2="118" stroke="#c9a84c" stroke-width="0.8" opacity="0.4"/>
        <line x1="70" y1="112" x2="70" y2="124" stroke="#c9a84c" stroke-width="0.8" opacity="0.4"/>
    </svg>
    <span class="monogram-text">S<span class="monogram-amp">&amp;</span>I</span>
</div>
<p class="font-label-caps text-label-caps text-primary tracking-[0.35em] mb-5 drop-shadow-md" style="font-family:'Cormorant Garamond',serif;font-size:14px;font-weight:500;letter-spacing:0.35em;">THE WEDDING OF</p>
<h2 class="text-primary mb-8 gold-glow animate-pulse-glow" style="font-family:'Cormorant Garamond',serif;font-size:clamp(42px,11vw,56px);font-weight:500;font-style:italic;line-height:1.15;letter-spacing:-0.01em;">Surya &amp; Icha</h2>

<!-- Date Section with ornament -->
<div class="flex flex-col items-center gap-2 my-6">
    <!-- Top line with center ornament -->
    <div class="flex justify-center items-center gap-3 mb-1">
        <div class="w-20 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="#c9a84c">
            <path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.7"/>
            <circle cx="10" cy="10" r="2.5" fill="#c9a84c" opacity="0.9"/>
        </svg>
        <div class="w-20 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>

    <!-- Date -->
    <p style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:500;color:#e2b84b;letter-spacing:0.18em;text-shadow:0 2px 8px rgba(0,0,0,.6);">29 . 08 . 2026</p>

    <!-- Bottom line with center ornament -->
    <div class="flex justify-center items-center gap-3 mt-1">
        <div class="w-20 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="#c9a84c">
            <path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.7"/>
            <circle cx="10" cy="10" r="2.5" fill="#c9a84c" opacity="0.9"/>
        </svg>
        <div class="w-20 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
</div>

<!-- Countdown Timer -->
<div class="grid grid-cols-4 gap-3 px-3 mt-4">
    <div style="background:linear-gradient(160deg,rgba(48,32,18,.95),rgba(20,14,8,.98));border:1px solid rgba(208,164,66,.5);border-radius:16px;box-shadow:inset 0 1px 0 rgba(255,255,255,.04),0 8px 24px rgba(0,0,0,.4);" class="py-4 px-2 flex flex-col items-center">
        <span style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,8.5vw,40px);font-weight:500;color:#e7bd55;text-shadow:0 2px 8px rgba(0,0,0,.7);" id="days">00</span>
        <span class="text-[9px] font-bold tracking-wider mt-1" style="color:#c8b99b;">HARI</span>
    </div>
    <div style="background:linear-gradient(160deg,rgba(48,32,18,.95),rgba(20,14,8,.98));border:1px solid rgba(208,164,66,.5);border-radius:16px;box-shadow:inset 0 1px 0 rgba(255,255,255,.04),0 8px 24px rgba(0,0,0,.4);" class="py-4 px-2 flex flex-col items-center">
        <span style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,8.5vw,40px);font-weight:500;color:#e7bd55;text-shadow:0 2px 8px rgba(0,0,0,.7);" id="hours">00</span>
        <span class="text-[9px] font-bold tracking-wider mt-1" style="color:#c8b99b;">JAM</span>
    </div>
    <div style="background:linear-gradient(160deg,rgba(48,32,18,.95),rgba(20,14,8,.98));border:1px solid rgba(208,164,66,.5);border-radius:16px;box-shadow:inset 0 1px 0 rgba(255,255,255,.04),0 8px 24px rgba(0,0,0,.4);" class="py-4 px-2 flex flex-col items-center">
        <span style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,8.5vw,40px);font-weight:500;color:#e7bd55;text-shadow:0 2px 8px rgba(0,0,0,.7);" id="minutes">00</span>
        <span class="text-[9px] font-bold tracking-wider mt-1" style="color:#c8b99b;">MENIT</span>
    </div>
    <div style="background:linear-gradient(160deg,rgba(48,32,18,.95),rgba(20,14,8,.98));border:1px solid rgba(208,164,66,.5);border-radius:16px;box-shadow:inset 0 1px 0 rgba(255,255,255,.04),0 8px 24px rgba(0,0,0,.4);" class="py-4 px-2 flex flex-col items-center">
        <span style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,8.5vw,40px);font-weight:500;color:#e7bd55;text-shadow:0 2px 8px rgba(0,0,0,.7);" id="seconds">00</span>
        <span class="text-[9px] font-bold tracking-wider mt-1" style="color:#c8b99b;">DETIK</span>
    </div>
</div>
<img class="home-bottom-ornament" src="{{ asset('assets/templates/wedding-11/newassets/NEW/hiasan%20tengah%201.png') }}" alt="" />
</div>
</section>
<!-- QUOTE -->
<section class="py-12 px-margin-mobile relative overflow-hidden" style="background:linear-gradient(to bottom, #090604 0%, #120c08 50%, #090604 100%);">
    <div class="javanese-pattern absolute inset-0 opacity-10"></div>
    <div class="relative z-10 text-center flex flex-col items-center reveal-section">
        <div class="w-full max-w-[420px] mx-auto p-6 md:p-8 rounded-2xl relative" style="background:linear-gradient(165deg,rgba(30,20,12,.88),rgba(12,8,4,.95));border:1.5px solid rgba(208,164,66,.35);box-shadow:0 15px 35px rgba(0,0,0,.6), 0 0 20px rgba(212,175,55,.1);">
            <!-- Top Islamic / Javanese Ornament -->
            <div class="flex justify-center items-center gap-3 mb-4 opacity-80">
                <div class="w-12 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
                <svg width="18" height="18" viewBox="0 0 20 20" fill="#c9a84c">
                    <path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.85"/>
                    <circle cx="10" cy="10" r="2" fill="#c9a84c"/>
                </svg>
                <div class="w-12 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
            </div>

            <!-- Bismillah text -->
            <p style="font-family:'Cormorant Garamond',serif;font-size:20px;font-style:italic;color:#e7bd55;letter-spacing:0.05em;margin-bottom:14px;text-shadow:0 2px 10px rgba(0,0,0,.8);">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>

            <!-- Decorative quote icon -->
            <span class="text-3xl text-primary/40 block -mb-2" style="font-family:serif;">❝</span>

            <p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-style:italic;color:#d5ccc0;line-height:1.8;margin-bottom:14px;text-shadow:0 1px 4px rgba(0,0,0,.8);">
                "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
            </p>

            <span class="text-3xl text-primary/40 block -mt-4 mb-3" style="font-family:serif;">❞</span>

            <div class="inline-block px-4 py-1 rounded-full" style="background:rgba(208,164,66,.1);border:1px solid rgba(208,164,66,.3);">
                <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#e7bd55;letter-spacing:0.2em;">QS. AR-RUM: 21</p>
            </div>
        </div>
    </div>
</section>
<!-- COUPLE PROFILE -->
<section class="pt-section-gap pb-28 px-margin-mobile flex flex-col gap-14" id="Couple" style="background-color:#160d08; background-image:url('{{ asset('assets/templates/wedding-11/newassets/NEW/bg part mempelai.png') }}'); background-position:center top; background-size:cover; background-repeat:no-repeat;">
<!-- Groom -->
<div class="flex flex-col items-center text-center reveal-section">
<div class="relative w-56 h-64 mb-6 rounded-t-full border-2 p-1.5 overflow-hidden animate-float" style="border-color:rgba(208,164,66,.45);background:rgba(42,42,42,.6);">
<img class="w-full h-full object-cover rounded-t-full grayscale hover:grayscale-0 transition-all duration-700" data-alt="Foto mempelai pria" src="{{ asset('assets/templates/wedding-11/cowok-image.jpeg') }}"/>
<div class="absolute bottom-0 left-0 right-0 h-12" style="background:linear-gradient(to top,rgba(22,13,8,.7),transparent);"></div>
</div>
<h3 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;font-style:italic;color:#e2b84b;margin-bottom:6px;text-shadow:0 2px 8px rgba(0,0,0,.6);">Pamunkas Surya Merdeka</h3>
<p style="font-family:'Cormorant Garamond',serif;font-size:15px;color:#c8b99b;margin-bottom:8px;">Anak dari</p>
<p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:500;color:#e5e2e1;">Bapak Maliyat Kustur &amp; Ibu Sudarmi</p>
</div>
<!-- Bride -->
<div class="flex flex-col items-center text-center reveal-section">
<div class="relative w-56 h-64 mb-6 rounded-t-full border-2 p-1.5 overflow-hidden animate-float" style="border-color:rgba(208,164,66,.45);background:rgba(42,42,42,.6);">
<img class="w-full h-full object-cover rounded-t-full grayscale hover:grayscale-0 transition-all duration-700" data-alt="Foto mempelai wanita" src="{{ asset('assets/templates/wedding-11/cewek-image.jpeg') }}"/>
<div class="absolute bottom-0 left-0 right-0 h-12" style="background:linear-gradient(to top,rgba(22,13,8,.7),transparent);"></div>
</div>
<h3 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;font-style:italic;color:#e2b84b;margin-bottom:6px;text-shadow:0 2px 8px rgba(0,0,0,.6);">Icha Alifia Yokendy Putri</h3>
<p style="font-family:'Cormorant Garamond',serif;font-size:15px;color:#c8b99b;margin-bottom:8px;">Anak dari</p>
<p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:500;color:#e5e2e1;">Bapak Yoyok Kristianto &amp; Ibu Eni Sa'adah</p>
</div>
</section>
<!-- EVENT SECTION -->
<section class="relative overflow-hidden" id="Event" style="background-color:#0e0906;background-image:url('{{ asset('assets/templates/wedding-11/newassets/NEW/bg agenda.png') }}');background-position:center top;background-size:cover;background-repeat:no-repeat;padding:4rem 1.25rem 4.5rem;">

<div class="text-center mb-10 reveal-section relative z-10">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,9vw,42px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 12px rgba(0,0,0,.7),0 0 20px rgba(226,184,75,.25);margin-bottom:8px;" class="animate-pulse-glow">Agenda Bahagia</h2>
    <div class="flex justify-center items-center gap-3 mt-2 opacity-70">
        <div class="w-16 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="14" height="14" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.8"/></svg>
        <div class="w-16 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
</div>

<div class="flex flex-col gap-8 relative z-10">
    <!-- Akad -->
    <div class="reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.4);border-radius:20px;padding:28px 20px;box-shadow:0 12px 40px rgba(0,0,0,.5),inset 0 1px 0 rgba(255,255,255,.03);">
        <div class="text-center">
            <!-- Candi Bentar Icon -->
            <svg class="mx-auto mb-5 filter drop-shadow-lg" width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#e7bd55" stroke-width="1.2" style="filter:drop-shadow(0 4px 12px rgba(226,184,75,.3));">
                <path d="M 16,54 L 16,22 L 20,18 L 24,22 L 24,54 Z" fill="#e7bd55" fill-opacity="0.15"/>
                <path d="M 14,54 L 26,54" stroke-width="1.8"/>
                <path d="M 18,22 L 22,22 M 18,30 L 22,30 M 18,38 L 22,38 M 18,46 L 22,46"/>
                <path d="M 48,54 L 48,22 L 44,18 L 40,22 L 40,54 Z" fill="#e7bd55" fill-opacity="0.15"/>
                <path d="M 38,54 L 50,54" stroke-width="1.8"/>
                <path d="M 46,22 L 42,22 M 46,30 L 42,30 M 46,38 L 42,38 M 46,46 L 42,46"/>
                <path d="M 14,26 L 26,26 M 38,26 L 50,26" stroke-width="0.8"/>
                <path d="M 32,28 C 28,24 28,18 32,18 C 36,18 36,24 32,28 Z" fill="#e7bd55" fill-opacity="0.25"/>
                <circle cx="32" cy="23" r="1.5" fill="#e7bd55"/>
            </svg>

            <h4 style="font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:600;font-style:italic;color:#e7bd55;margin-bottom:16px;text-shadow:0 2px 8px rgba(0,0,0,.6),0 0 14px rgba(226,184,75,.2);">Akad Nikah</h4>
            
            <!-- Date row -->
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="material-symbols-outlined" style="font-size:16px;color:#c9a84c;opacity:.7;" data-icon="event">event</span>
                <p style="font-family:'Cormorant Garamond',serif;font-size:15px;font-weight:500;color:#e5e2e1;">Sabtu, 29 Agustus 2026</p>
            </div>
            <!-- Time row -->
            <div class="flex items-center justify-center gap-2 mb-5">
                <span class="material-symbols-outlined" style="font-size:16px;color:#c9a84c;opacity:.7;" data-icon="schedule">schedule</span>
                <p style="font-family:'Cormorant Garamond',serif;font-size:15px;font-weight:500;color:#e7bd55;">Pukul 08.00 WIB</p>
            </div>
            
            <!-- Location -->
            <div style="border-top:1px solid rgba(208,164,66,.2);padding-top:14px;margin-bottom:16px;">
                <div class="flex items-start justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:18px;color:#c9a84c;margin-top:2px;" data-icon="location_on">location_on</span>
                    <div class="text-left">
                        <p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:600;color:#e5e2e1;">Wisma Indah 2 K6/40</p>
                        <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:12px;color:#a09888;margin-top:2px;">Gunung Anyar Tambak, Surabaya</p>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,rgba(208,164,66,.15),rgba(208,164,66,.25));border:1.5px solid rgba(208,164,66,.6);color:#e7bd55;font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:700;letter-spacing:0.12em;padding:10px 18px;border-radius:50px;text-decoration:none;transition:all .3s;box-shadow:0 4px 16px rgba(0,0,0,.3);" href="https://maps.app.goo.gl/yzAQ9oycNHSSnprn7" target="_blank" rel="noopener" onmouseover="this.style.background='linear-gradient(135deg,#d4af37,#b8960b)';this.style.color='#1a1208'" onmouseout="this.style.background='linear-gradient(135deg,rgba(208,164,66,.15),rgba(208,164,66,.25))';this.style.color='#e7bd55'">
                    <span class="material-symbols-outlined" style="font-size:14px;" data-icon="location_on">location_on</span>
                    LIHAT LOKASI
                </a>
                <a style="display:inline-flex;align-items:center;gap:6px;background:rgba(10,5,3,.6);border:1.5px solid rgba(208,164,66,.4);color:#e7bd55;font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:700;letter-spacing:0.12em;padding:10px 18px;border-radius:50px;text-decoration:none;transition:all .3s;" href="https://www.google.com/calendar/render?action=TEMPLATE&text=Akad+Nikah+Surya+%26+Icha&dates=20260829T010000Z/20260829T040000Z&details=Akad+Nikah+Surya+%26+Icha+di+Wisma+Indah+2+K6%2F40%2C+Surabaya&location=Wisma+Indah+2+K6%2F40%2C+Gunung+Anyar+Tambak%2C+Surabaya" target="_blank" rel="noopener" onmouseover="this.style.borderColor='#e7bd55';this.style.background='rgba(208,164,66,.15)'" onmouseout="this.style.borderColor='rgba(208,164,66,.4)';this.style.background='rgba(10,5,3,.6)'">
                    <span class="material-symbols-outlined" style="font-size:14px;" data-icon="calendar_add_on">calendar_add_on</span>
                    SIMPAN TANGGAL
                </a>
            </div>
        </div>
    </div>

    <!-- Resepsi -->
    <div class="reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.4);border-radius:20px;padding:28px 20px;box-shadow:0 12px 40px rgba(0,0,0,.5),inset 0 1px 0 rgba(255,255,255,.03);">
        <div class="text-center">
            <!-- Payung Agung Icon -->
            <svg class="mx-auto mb-5 filter drop-shadow-lg" width="64" height="64" viewBox="0 0 64 64" fill="none" stroke="#e7bd55" stroke-width="1.2" style="filter:drop-shadow(0 4px 12px rgba(226,184,75,.3));">
                <line x1="32" y1="58" x2="32" y2="10" stroke-width="1.8"/>
                <path d="M 12,42 C 12,38 52,38 52,42 L 48,45 C 48,43 16,43 16,45 Z" fill="#e7bd55" fill-opacity="0.15"/>
                <path d="M 18,30 C 18,27 46,27 46,30 L 43,33 C 43,31 21,31 21,33 Z" fill="#e7bd55" fill-opacity="0.25"/>
                <path d="M 24,18 C 24,15 40,15 40,18 L 38,20 C 38,19 26,19 26,20 Z" fill="#e7bd55" fill-opacity="0.35"/>
                <path d="M 32,5 L 30,10 L 34,10 Z" fill="#e7bd55"/>
                <circle cx="16" cy="45" r="1.5" fill="#e7bd55"/>
                <circle cx="24" cy="45" r="1.5" fill="#e7bd55"/>
                <circle cx="32" cy="45" r="1.5" fill="#e7bd55"/>
                <circle cx="40" cy="45" r="1.5" fill="#e7bd55"/>
                <circle cx="48" cy="45" r="1.5" fill="#e7bd55"/>
            </svg>

            <h4 style="font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:600;font-style:italic;color:#e7bd55;margin-bottom:16px;text-shadow:0 2px 8px rgba(0,0,0,.6),0 0 14px rgba(226,184,75,.2);">Resepsi Pernikahan</h4>
            
            <!-- Date row -->
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="material-symbols-outlined" style="font-size:16px;color:#c9a84c;opacity:.7;" data-icon="event">event</span>
                <p style="font-family:'Cormorant Garamond',serif;font-size:15px;font-weight:500;color:#e5e2e1;">Minggu, 6 September 2026</p>
            </div>
            <!-- Time row -->
            <div class="flex items-center justify-center gap-2 mb-5">
                <span class="material-symbols-outlined" style="font-size:16px;color:#c9a84c;opacity:.7;" data-icon="schedule">schedule</span>
                <p style="font-family:'Cormorant Garamond',serif;font-size:15px;font-weight:500;color:#e7bd55;">Pukul 13.00 WIB - selesai</p>
            </div>
            
            <!-- Location -->
            <div style="border-top:1px solid rgba(208,164,66,.2);padding-top:14px;margin-bottom:16px;">
                <div class="flex items-start justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:18px;color:#c9a84c;margin-top:2px;" data-icon="location_on">location_on</span>
                    <div class="text-left">
                        <p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:600;color:#e5e2e1;">RM. Tenda Biru</p>
                        <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:12px;color:#a09888;margin-top:2px;">Jombor, Sukoharjo</p>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-3">
                <a style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,rgba(208,164,66,.15),rgba(208,164,66,.25));border:1.5px solid rgba(208,164,66,.6);color:#e7bd55;font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:700;letter-spacing:0.12em;padding:10px 18px;border-radius:50px;text-decoration:none;transition:all .3s;box-shadow:0 4px 16px rgba(0,0,0,.3);" href="https://maps.app.goo.gl/YR59uUjYsMXk2Fi47?g_st=aw" target="_blank" rel="noopener" onmouseover="this.style.background='linear-gradient(135deg,#d4af37,#b8960b)';this.style.color='#1a1208'" onmouseout="this.style.background='linear-gradient(135deg,rgba(208,164,66,.15),rgba(208,164,66,.25))';this.style.color='#e7bd55'">
                    <span class="material-symbols-outlined" style="font-size:14px;" data-icon="location_on">location_on</span>
                    LIHAT LOKASI
                </a>
                <a style="display:inline-flex;align-items:center;gap:6px;background:rgba(10,5,3,.6);border:1.5px solid rgba(208,164,66,.4);color:#e7bd55;font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:700;letter-spacing:0.12em;padding:10px 18px;border-radius:50px;text-decoration:none;transition:all .3s;" href="https://www.google.com/calendar/render?action=TEMPLATE&text=Resepsi+Pernikahan+Surya+%26+Icha&dates=20260906T060000Z/20260906T100000Z&details=Resepsi+Pernikahan+Surya+%26+Icha+di+RM.+Tenda+Biru%2C+Jombor%2C+Sukoharjo&location=RM.+Tenda+Biru%2C+Jombor%2C+Sukoharjo" target="_blank" rel="noopener" onmouseover="this.style.borderColor='#e7bd55';this.style.background='rgba(208,164,66,.15)'" onmouseout="this.style.borderColor='rgba(208,164,66,.4)';this.style.background='rgba(10,5,3,.6)'">
                    <span class="material-symbols-outlined" style="font-size:14px;" data-icon="calendar_add_on">calendar_add_on</span>
                    SIMPAN TANGGAL
                </a>
            </div>
        </div>
    </div>
</div>
</section>
<!-- LOVE STORY -->
<section class="relative overflow-hidden" id="Story" style="background-color:#0e0906;background-image:url('{{ asset('assets/templates/wedding-11/newassets/NEW/bg kisah cinta.png') }}');background-position:center top;background-size:cover;background-repeat:no-repeat;padding:4rem 1.25rem 4.5rem;">

<div class="text-center mb-8 reveal-section relative z-10">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,9vw,42px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 12px rgba(0,0,0,.7),0 0 20px rgba(226,184,75,.25);margin-bottom:8px;" class="animate-pulse-glow">Kisah Cinta</h2>
    <div class="flex justify-center items-center gap-3 mt-2 opacity-70">
        <div class="w-16 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="14" height="14" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.8"/></svg>
        <div class="w-16 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
    <p style="font-family:'Cormorant Garamond',serif;font-size:15px;font-style:italic;color:#a09888;margin-top:14px;line-height:1.7;">Setiap langkah, setiap cerita,<br/>membawa kami sampai di titik ini.</p>
</div>

<div class="relative ml-5 pl-7 space-y-8 z-10" style="border-left:2px solid transparent;border-image:linear-gradient(to bottom,#c9a84c,rgba(201,168,76,.25) 75%,transparent) 1 100%;">

    <!-- Story 1 -->
    <div class="relative reveal-section">
        <div class="absolute -left-[38px] top-3 w-7 h-7 rounded-full flex items-center justify-center z-10" style="background:#0e0906;border:1.5px solid rgba(201,168,76,.6);box-shadow:0 0 10px rgba(226,184,75,.4);">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z"/></svg>
        </div>
        <div style="background:linear-gradient(165deg,rgba(30,20,12,.88),rgba(12,8,4,.94));border:1px solid rgba(208,164,66,.3);border-radius:16px;padding:20px;box-shadow:0 8px 28px rgba(0,0,0,.4);">
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.2em;margin-bottom:6px;opacity:.7;">CHAPTER I</p>
            <h4 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;font-style:italic;color:#e7bd55;margin-bottom:10px;">Once Upon A Time</h4>
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:13px;color:#b8b0a4;line-height:1.75;">Sebelum saling mengenal, kami hanyalah dua orang asing yang menjalani hidup di dunia masing-masing. Kami tidak pernah tahu bahwa langkah-langkah kecil yang kami ambil saat itu perlahan sedang membawa kami menuju satu tujuan yang sama.</p>
        </div>
    </div>

    <!-- Story 2 -->
    <div class="relative reveal-section">
        <div class="absolute -left-[38px] top-3 w-7 h-7 rounded-full flex items-center justify-center z-10" style="background:#0e0906;border:1.5px solid rgba(201,168,76,.6);box-shadow:0 0 10px rgba(226,184,75,.4);">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z"/></svg>
        </div>
        <div style="background:linear-gradient(165deg,rgba(30,20,12,.88),rgba(12,8,4,.94));border:1px solid rgba(208,164,66,.3);border-radius:16px;padding:20px;box-shadow:0 8px 28px rgba(0,0,0,.4);">
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.2em;margin-bottom:6px;opacity:.7;">CHAPTER II</p>
            <h4 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;font-style:italic;color:#e7bd55;margin-bottom:10px;">The Journey</h4>
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:13px;color:#b8b0a4;line-height:1.75;margin-bottom:10px;">Tidak semua kisah dimulai dengan keyakinan. Kadang, ia bertumbuh melalui pertanyaan, perbedaan, dan pilihan-pilihan yang tidak selalu mudah.</p>
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:13px;color:#b8b0a4;line-height:1.75;">Kami pernah berada di titik ketika jarak terasa panjang, perbedaan terasa besar, dan keraguan terdengar lebih keras daripada harapan. Namun, di setiap musim yang kami lalui, selalu ada satu keputusan yang terus kami ambil—memilih untuk tetap berjalan ke arah yang sama.</p>
        </div>
    </div>

    <!-- Story 3 -->
    <div class="relative reveal-section">
        <div class="absolute -left-[38px] top-3 w-7 h-7 rounded-full flex items-center justify-center z-10" style="background:#0e0906;border:1.5px solid rgba(201,168,76,.6);box-shadow:0 0 10px rgba(226,184,75,.4);">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z"/></svg>
        </div>
        <div style="background:linear-gradient(165deg,rgba(30,20,12,.88),rgba(12,8,4,.94));border:1px solid rgba(208,164,66,.3);border-radius:16px;padding:20px;box-shadow:0 8px 28px rgba(0,0,0,.4);">
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.2em;margin-bottom:6px;opacity:.7;">CHAPTER III</p>
            <h4 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;font-style:italic;color:#e7bd55;margin-bottom:10px;">The Promise</h4>
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:13px;color:#b8b0a4;line-height:1.75;">Seiring waktu, kami menyadari bahwa tujuan dari perjalanan ini bukan lagi sekadar memilih arah. Namun, harapan yang dulu kami simpan dalam doa bertumbuh menjadi langkah yang siap kami jalani—Bersama, Selamanya.</p>
        </div>
    </div>

    <!-- Story 4 -->
    <div class="relative reveal-section">
        <div class="absolute -left-[38px] top-3 w-7 h-7 rounded-full flex items-center justify-center z-10" style="background:#0e0906;border:1.5px solid rgba(201,168,76,.6);box-shadow:0 0 10px rgba(226,184,75,.4);">
            <svg width="12" height="12" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z"/></svg>
        </div>
        <div style="background:linear-gradient(165deg,rgba(30,20,12,.88),rgba(12,8,4,.94));border:1px solid rgba(208,164,66,.3);border-radius:16px;padding:20px;box-shadow:0 8px 28px rgba(0,0,0,.4);">
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.2em;margin-bottom:6px;opacity:.7;">CHAPTER IV</p>
            <h4 style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;font-style:italic;color:#e7bd55;margin-bottom:10px;">Forever Begins</h4>
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:13px;color:#b8b0a4;line-height:1.75;">Hari ini, dengan hati yang penuh syukur, kami melangkah sebagai satu—dan percaya bahwa Sang Maha Cinta tak pernah salah dalam menuliskan takdir-Nya.</p>
        </div>
    </div>

</div>
</section>

<!-- GALLERY -->
<section class="py-section-gap px-margin-mobile relative overflow-hidden" id="Gallery">
<!-- Background Glow -->
<div class="absolute top-0 right-0 w-[400px] h-[400px] bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary/5 via-transparent to-transparent z-0 pointer-events-none"></div>

<div class="text-center mb-10 reveal-section relative z-10">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,9vw,42px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 12px rgba(0,0,0,.7),0 0 20px rgba(226,184,75,.25);margin-bottom:8px;" class="animate-pulse-glow">Galeri Foto</h2>
    <div class="flex justify-center items-center gap-3 mt-2 opacity-70">
        <div class="w-16 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="14" height="14" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.8"/></svg>
        <div class="w-16 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
</div>

<div class="grid grid-cols-2 gap-3.5 relative z-10 w-full px-4">
    <!-- Photo 1 (Featured Top - Full Width) -->
    <div class="col-span-2 p-1.5 gallery-card rounded-2xl relative overflow-hidden group cursor-pointer reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);" onclick="openLightbox('{{ asset('assets/templates/wedding-32/g-1.jpeg') }}')">
        <div class="w-full aspect-[4/5] overflow-hidden rounded-xl relative">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Pre-wedding photo Surya & Icha 1" src="{{ asset('assets/templates/wedding-32/g-1.jpeg') }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-40 group-hover:opacity-20 transition-opacity"></div>
            <div class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-black/60 backdrop-blur-md border border-[#e7bd55]/50 flex items-center justify-center text-[#e7bd55] opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all">
                <span class="material-symbols-outlined text-sm">fullscreen</span>
            </div>
        </div>
    </div>
    
    <!-- Photo 2 (Square - Left) -->
    <div class="p-1.5 gallery-card rounded-2xl relative overflow-hidden group cursor-pointer reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);" onclick="openLightbox('{{ asset('assets/templates/wedding-32/g-2.jpeg') }}')">
        <div class="w-full aspect-square overflow-hidden rounded-xl relative">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Pre-wedding photo Surya & Icha 2" src="{{ asset('assets/templates/wedding-32/g-2.jpeg') }}"/>
            <div class="absolute bottom-2 right-2 w-6 h-6 rounded-full bg-black/60 backdrop-blur-md border border-[#e7bd55]/50 flex items-center justify-center text-[#e7bd55] opacity-80 group-hover:opacity-100 transition-all">
                <span class="material-symbols-outlined text-xs">fullscreen</span>
            </div>
        </div>
    </div>

    <!-- Photo 3 (Square - Right) -->
    <div class="p-1.5 gallery-card rounded-2xl relative overflow-hidden group cursor-pointer reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);" onclick="openLightbox('{{ asset('assets/templates/wedding-32/g-3.jpeg') }}')">
        <div class="w-full aspect-square overflow-hidden rounded-xl relative">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Pre-wedding photo Surya & Icha 3" src="{{ asset('assets/templates/wedding-32/g-3.jpeg') }}"/>
            <div class="absolute bottom-2 right-2 w-6 h-6 rounded-full bg-black/60 backdrop-blur-md border border-[#e7bd55]/50 flex items-center justify-center text-[#e7bd55] opacity-80 group-hover:opacity-100 transition-all">
                <span class="material-symbols-outlined text-xs">fullscreen</span>
            </div>
        </div>
    </div>

    <!-- Photo 4 (Square - Left) -->
    <div class="p-1.5 gallery-card rounded-2xl relative overflow-hidden group cursor-pointer reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);" onclick="openLightbox('{{ asset('assets/templates/wedding-32/g-4.jpeg') }}')">
        <div class="w-full aspect-square overflow-hidden rounded-xl relative">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Pre-wedding photo Surya & Icha 4" src="{{ asset('assets/templates/wedding-32/g-4.jpeg') }}"/>
            <div class="absolute bottom-2 right-2 w-6 h-6 rounded-full bg-black/60 backdrop-blur-md border border-[#e7bd55]/50 flex items-center justify-center text-[#e7bd55] opacity-80 group-hover:opacity-100 transition-all">
                <span class="material-symbols-outlined text-xs">fullscreen</span>
            </div>
        </div>
    </div>

    <!-- Photo 5 (Square - Right) -->
    <div class="p-1.5 gallery-card rounded-2xl relative overflow-hidden group cursor-pointer reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);" onclick="openLightbox('{{ asset('assets/templates/wedding-32/g-5.jpeg') }}')">
        <div class="w-full aspect-square overflow-hidden rounded-xl relative">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Pre-wedding photo Surya & Icha 5" src="{{ asset('assets/templates/wedding-32/g-5.jpeg') }}"/>
            <div class="absolute bottom-2 right-2 w-6 h-6 rounded-full bg-black/60 backdrop-blur-md border border-[#e7bd55]/50 flex items-center justify-center text-[#e7bd55] opacity-80 group-hover:opacity-100 transition-all">
                <span class="material-symbols-outlined text-xs">fullscreen</span>
            </div>
        </div>
    </div>

    <!-- Photo 6 (Featured Bottom - Full Width) -->
    <div class="col-span-2 p-1.5 gallery-card rounded-2xl relative overflow-hidden group cursor-pointer reveal-section" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);" onclick="openLightbox('{{ asset('assets/templates/wedding-32/g-6.jpeg') }}')">
        <div class="w-full aspect-[16/10] overflow-hidden rounded-xl relative">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Pre-wedding photo Surya & Icha 6" src="{{ asset('assets/templates/wedding-32/g-6.jpeg') }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-40 group-hover:opacity-20 transition-opacity"></div>
            <div class="absolute bottom-3 right-3 w-8 h-8 rounded-full bg-black/60 backdrop-blur-md border border-[#e7bd55]/50 flex items-center justify-center text-[#e7bd55] opacity-80 group-hover:opacity-100 group-hover:scale-110 transition-all">
                <span class="material-symbols-outlined text-sm">fullscreen</span>
            </div>
        </div>
    </div>
</div>
</section>
<!-- RSVP & WISHES -->
<section class="relative overflow-hidden" id="Wishes" x-data="rsvpComponent(@js(isset($invitation) ? $invitation->guestBooks->sortByDesc('created_at')->take(20)->map(fn($guestBook) => ['name' => $guestBook->guest_name, 'status' => 'Ucapan & Doa', 'message' => $guestBook->message])->values() : []))" style="background-color:#0e0906;padding:4rem 1.25rem 3rem;">

<!-- Konfirmasi Kehadiran -->
<div class="text-center mb-8 reveal-section relative z-10">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(28px,8vw,38px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 12px rgba(0,0,0,.7),0 0 20px rgba(226,184,75,.25);margin-bottom:8px;">Konfirmasi Kehadiran</h2>
    <div class="flex justify-center items-center gap-3 mt-2 opacity-70">
        <div class="w-16 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="14" height="14" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.8"/></svg>
        <div class="w-16 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
</div>

<div class="reveal-section mb-12" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);border-radius:20px;padding:28px 22px;box-shadow:0 12px 40px rgba(0,0,0,.5);">
<form class="flex flex-col gap-5" id="rsvp-form" @submit.prevent="submitRSVP">
<div>
<label style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.18em;display:block;margin-bottom:8px;">NAMA LENGKAP</label>
<input style="width:100%;background:rgba(10,5,3,.8);border:1px solid rgba(208,164,66,.25);border-radius:12px;padding:14px 16px;color:#e5e2e1;font-family:'Be Vietnam Pro',sans-serif;font-size:14px;outline:none;transition:border-color .3s;" placeholder="Masukkan nama anda" type="text" x-model="rsvpName" onfocus="this.style.borderColor='rgba(208,164,66,.6)'" onblur="this.style.borderColor='rgba(208,164,66,.25)'"/>
</div>
<div>
<label style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.18em;display:block;margin-bottom:8px;">JUMLAH YANG HADIR</label>
<input style="width:100%;background:rgba(10,5,3,.8);border:1px solid rgba(208,164,66,.25);border-radius:12px;padding:14px 16px;color:#e5e2e1;font-family:'Be Vietnam Pro',sans-serif;font-size:14px;outline:none;transition:border-color .3s;" min="1" placeholder="Contoh: 2" type="number" x-model="rsvpCount" onfocus="this.style.borderColor='rgba(208,164,66,.6)'" onblur="this.style.borderColor='rgba(208,164,66,.25)'"/>
</div>
<div>
<label style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.18em;display:block;margin-bottom:8px;">STATUS KEHADIRAN</label>
<select style="width:100%;background:rgba(10,5,3,.8);border:1px solid rgba(208,164,66,.25);border-radius:12px;padding:14px 16px;color:#e5e2e1;font-family:'Be Vietnam Pro',sans-serif;font-size:14px;outline:none;transition:border-color .3s;" x-model="rsvpAttend" onfocus="this.style.borderColor='rgba(208,164,66,.6)'" onblur="this.style.borderColor='rgba(208,164,66,.25)'">
<option>Hadir</option>
<option>Tidak Hadir</option>
<option>Masih Ragu</option>
</select>
</div>
<button style="background:linear-gradient(135deg,#d4af37,#b8960b);color:#1a1208;font-family:'Be Vietnam Pro',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.18em;padding:14px;border-radius:50px;border:none;cursor:pointer;transition:all .3s;box-shadow:0 6px 20px rgba(212,175,55,.25);" type="submit" :disabled="submittingRsvp || !rsvpName || !rsvpCount" x-text="submittingRsvp ? 'MENGIRIM...' : 'KIRIM KEHADIRAN'" onmouseover="this.style.boxShadow='0 8px 28px rgba(212,175,55,.4)'" onmouseout="this.style.boxShadow='0 6px 20px rgba(212,175,55,.25)'"></button>
</form>
</div>

<!-- Kirim Ucapan & Doa -->
<div class="text-center mb-8 reveal-section relative z-10">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(28px,8vw,38px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 12px rgba(0,0,0,.7);margin-bottom:8px;">Kirim Ucapan &amp; Doa</h2>
    <div class="flex justify-center items-center gap-3 mt-2 opacity-70">
        <div class="w-16 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="14" height="14" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.8"/></svg>
        <div class="w-16 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
</div>

<div class="reveal-section mb-10" style="background:linear-gradient(165deg,rgba(30,20,12,.92),rgba(12,8,4,.96));border:1.5px solid rgba(208,164,66,.35);border-radius:20px;padding:28px 22px;box-shadow:0 12px 40px rgba(0,0,0,.5);">
<form class="flex flex-col gap-5" @submit.prevent="submitWish">
<div>
<label style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.18em;display:block;margin-bottom:8px;">NAMA LENGKAP</label>
<input style="width:100%;background:rgba(10,5,3,.8);border:1px solid rgba(208,164,66,.25);border-radius:12px;padding:14px 16px;color:#e5e2e1;font-family:'Be Vietnam Pro',sans-serif;font-size:14px;outline:none;transition:border-color .3s;" placeholder="Masukkan nama anda" type="text" x-model="name" onfocus="this.style.borderColor='rgba(208,164,66,.6)'" onblur="this.style.borderColor='rgba(208,164,66,.25)'"/>
</div>
<div>
<label style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;font-weight:600;color:#c9a84c;letter-spacing:0.18em;display:block;margin-bottom:8px;">PESAN &amp; DOA</label>
<textarea style="width:100%;background:rgba(10,5,3,.8);border:1px solid rgba(208,164,66,.25);border-radius:12px;padding:14px 16px;color:#e5e2e1;font-family:'Be Vietnam Pro',sans-serif;font-size:14px;outline:none;transition:border-color .3s;resize:vertical;" placeholder="Tuliskan ucapan dan doa anda..." rows="4" x-model="message" onfocus="this.style.borderColor='rgba(208,164,66,.6)'" onblur="this.style.borderColor='rgba(208,164,66,.25)'"></textarea>
</div>
<button style="background:linear-gradient(135deg,#d4af37,#b8960b);color:#1a1208;font-family:'Be Vietnam Pro',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.18em;padding:14px;border-radius:50px;border:none;cursor:pointer;transition:all .3s;box-shadow:0 6px 20px rgba(212,175,55,.25);" type="submit" :disabled="submittingWish || !name || !message" x-text="submittingWish ? 'MENGIRIM...' : 'KIRIM UCAPAN'" onmouseover="this.style.boxShadow='0 8px 28px rgba(212,175,55,.4)'" onmouseout="this.style.boxShadow='0 6px 20px rgba(212,175,55,.25)'"></button>
</form>
</div>

<!-- Ucapan & Doa List -->
<div class="text-center mb-6 reveal-section relative z-10">
    <h3 style="font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:500;font-style:italic;color:#e7bd55;">Ucapan &amp; Doa</h3>
</div>
<div class="space-y-4 max-h-[420px] overflow-y-auto hide-scrollbar pr-1">
<template x-for="wish in wishes" :key="wish.name + '-' + wish.message">
<div style="background:linear-gradient(165deg,rgba(30,20,12,.85),rgba(12,8,4,.92));border:1px solid rgba(208,164,66,.2);border-radius:16px;padding:18px 20px;box-shadow:0 4px 16px rgba(0,0,0,.3);position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;width:3px;height:100%;background:linear-gradient(to bottom,#d4af37,rgba(212,175,55,.2));border-radius:3px;"></div>
    <div class="flex items-center gap-2 mb-2">
        <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,rgba(208,164,66,.2),rgba(208,164,66,.1));border:1px solid rgba(208,164,66,.35);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <span class="material-symbols-outlined" style="font-size:14px;color:#c9a84c;" data-icon="person">person</span>
        </div>
        <div>
            <p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-weight:600;color:#e7bd55;line-height:1.2;" x-text="wish.name"></p>
            <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:10px;color:#8a8070;font-style:italic;" x-text="wish.status"></p>
        </div>
    </div>
    <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:13px;color:#b8b0a4;line-height:1.7;padding-left:36px;" x-text="wish.message"></p>
</div>
</template>
</div>
</section>
<!-- WEDDING GIFT -->
<section class="py-section-gap px-margin-mobile relative overflow-hidden" id="Gift">
<div class="text-center mb-10 reveal-section relative z-10">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(32px,9vw,42px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 12px rgba(0,0,0,.7),0 0 20px rgba(226,184,75,.25);margin-bottom:8px;" class="animate-pulse-glow">Kado Pernikahan</h2>
    <div class="flex justify-center items-center gap-3 mt-2 opacity-70">
        <div class="w-16 h-px" style="background:linear-gradient(to right,transparent,#c9a84c)"></div>
        <svg width="14" height="14" viewBox="0 0 20 20" fill="#c9a84c"><path d="M10 0 L12 8 L20 10 L12 12 L10 20 L8 12 L0 10 L8 8 Z" opacity="0.8"/></svg>
        <div class="w-16 h-px" style="background:linear-gradient(to left,transparent,#c9a84c)"></div>
    </div>
    <p style="font-family:'Cormorant Garamond',serif;font-size:15px;font-style:italic;color:#a09888;margin-top:14px;max-width:360px;margin-left:auto;margin-right:auto;line-height:1.7;">Doa restu Anda merupakan karunia terindah bagi kami. Namun jika ingin memberikan tanda kasih secara cashless, dapat melalui:</p>
</div>

<div class="flex flex-col items-center justify-center reveal-section relative z-10">
    <!-- Luxury Gold Digital Bank Card -->
    <div class="w-full max-w-[360px] rounded-2xl p-6 relative gold-card-shadow gold-shimmer-effect overflow-hidden" style="background:linear-gradient(135deg,#2c1c0c 0%,#170e06 45%,#26180a 100%);border:1.5px solid rgba(212,175,55,.45);">
        <!-- Subtle Pattern -->
        <div class="absolute inset-0 opacity-10 pointer-events-none javanese-pattern"></div>
        
        <!-- Card Top Bar: Chip & Bank Name -->
        <div class="flex justify-between items-center mb-6 relative z-10">
            <!-- EMV Gold Chip & Contactless -->
            <div class="flex items-center gap-2.5">
                <div class="w-11 h-8 rounded-md bg-gradient-to-br from-[#f2ca50] via-[#d4af37] to-[#8c7322] p-0.5 shadow-md flex items-center justify-center relative overflow-hidden">
                    <div class="w-full h-full border border-black/20 rounded-[4px] relative flex flex-col justify-around py-0.5">
                        <div class="w-full h-px bg-black/30"></div>
                        <div class="w-full h-px bg-black/30"></div>
                        <div class="absolute inset-x-2 inset-y-1 border border-black/20 rounded-sm"></div>
                    </div>
                </div>
                <!-- Contactless Icon -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#e7bd55" stroke-width="2" stroke-linecap="round" class="opacity-70">
                    <path d="M8.5 16.5a5 5 0 0 1 0-7"/>
                    <path d="M12 19a8.5 8.5 0 0 0 0-14"/>
                    <path d="M15.5 21.5a12 12 0 0 0 0-19"/>
                </svg>
            </div>
            
            <!-- Bank Logo Text -->
            <div class="text-right">
                <span style="font-family:'Be Vietnam Pro',sans-serif;font-size:18px;font-weight:900;letter-spacing:0.1em;color:#e7bd55;text-shadow:0 2px 6px rgba(0,0,0,.8);">BCA</span>
                <p style="font-size:8px;letter-spacing:0.2em;color:#c9a84c;opacity:.7;margin-top:-2px;">DIGITAL CARD</p>
            </div>
        </div>

        <!-- Account Number -->
        <div class="mb-4 relative z-10">
            <p style="font-size:9px;letter-spacing:0.2em;color:#a09888;margin-bottom:4px;font-family:'Be Vietnam Pro',sans-serif;">NOMOR REKENING</p>
            <p class="tracking-[0.18em] font-semibold text-2xl md:text-3xl text-[#f2ca50] drop-shadow-md select-all" id="acc-number" style="font-family:'Cormorant Garamond',monospace;">8265 3224 7</p>
        </div>

        <!-- Cardholder Name & Action -->
        <div class="flex justify-between items-end pt-3 border-t border-[#d4af37]/20 relative z-10">
            <div>
                <p style="font-size:8px;letter-spacing:0.2em;color:#a09888;font-family:'Be Vietnam Pro',sans-serif;">ATAS NAMA</p>
                <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:12px;font-weight:700;letter-spacing:0.08em;color:#e5e2e1;">PAMUNKAS SURYA MERDEKA</p>
            </div>
            
            <button class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold transition-all shadow-md active:scale-95" style="background:linear-gradient(135deg,#d4af37,#b8960b);color:#1a1208;box-shadow:0 4px 14px rgba(212,175,55,.3);" onclick="copyAccount('826532247', this)">
                <span class="material-symbols-outlined text-sm">content_copy</span>
                <span>SALIN</span>
            </button>
        </div>
    </div>
</div>
</section>

<!-- FOOTER -->
<footer class="pt-section-gap pb-32 px-margin-mobile text-center relative overflow-hidden" style="background:linear-gradient(to top,#060402 0%,#0e0906 100%);">
    <div class="javanese-pattern absolute inset-x-0 h-32 bottom-20 opacity-5 pointer-events-none"></div>
    <div class="relative z-10 max-w-[400px] mx-auto reveal-section">
        <!-- Closing Monogram -->
        <div class="w-14 h-14 rounded-full mx-auto mb-6 flex items-center justify-center relative" style="border:1.5px solid rgba(208,164,66,.45);background:rgba(20,13,7,.7);">
            <div class="w-11 h-11 rounded-full absolute border border-primary/25"></div>
            <span style="font-family:'Cormorant Garamond',serif;font-size:20px;font-style:italic;color:#e7bd55;">S&amp;I</span>
        </div>

        <p style="font-family:'Cormorant Garamond',serif;font-size:16px;font-style:italic;color:#c8b99b;line-height:1.75;margin-bottom:20px;">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami sekeluarga, apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu kepada kedua mempelai.
        </p>

        <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(38px,10vw,48px);font-weight:500;font-style:italic;color:#e7bd55;text-shadow:0 2px 14px rgba(0,0,0,.8),0 0 20px rgba(226,184,75,.3);margin-bottom:12px;">Matur Nuwun</h2>
        
        <p style="font-family:'Be Vietnam Pro',sans-serif;font-size:11px;font-weight:700;letter-spacing:0.25em;color:#e7bd55;margin-bottom:6px;">SURYA &amp; ICHA — 2026</p>
        <p style="font-family:'Cormorant Garamond',serif;font-size:13px;font-style:italic;color:#8a8070;">The Wedding of Surya &amp; Icha</p>
    </div>
</footer>

<!-- Toast Notification Popup -->
<div id="toast" class="fixed bottom-24 left-1/2 -translate-x-1/2 z-[100] bg-[#1a1208]/95 border border-[#d4af37]/60 text-[#e7bd55] px-5 py-3 rounded-full shadow-[0_10px_30px_rgba(0,0,0,0.8),0_0_15px_rgba(212,175,55,0.3)] backdrop-blur-md flex items-center gap-2 text-xs font-semibold tracking-wide transition-all duration-300 opacity-0 pointer-events-none translate-y-4">
    <span class="material-symbols-outlined text-sm text-[#e7bd55]">check_circle</span>
    <span id="toast-message">Nomor rekening berhasil disalin!</span>
</div>
<!-- BOTTOM NAV BAR -->
<nav class="fixed bottom-0 left-0 right-0 w-full max-w-container-max mx-auto bg-surface-container/90 backdrop-blur-lg border-t border-outline-variant/50 shadow-lg flex justify-around items-center py-3 px-2 z-50 rounded-t-full overflow-hidden">
<div class="javanese-pattern absolute inset-0 z-0 pointer-events-none opacity-25"></div>
<div class="relative z-10 w-full flex justify-around items-center">
<a class="flex flex-col items-center justify-center text-primary font-bold transition-transform duration-200 scale-110" href="#Home">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-label-caps text-[10px]">Home</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:opacity-100" href="#Couple">
<span class="material-symbols-outlined" data-icon="favorite">favorite</span>
<span class="font-label-caps text-[10px]">Couple</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:opacity-100" href="#Event">
<span class="material-symbols-outlined" data-icon="event">event</span>
<span class="font-label-caps text-[10px]">Event</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:opacity-100" href="#Gallery">
<span class="material-symbols-outlined" data-icon="collections">collections</span>
<span class="font-label-caps text-[10px]">Gallery</span>
</a>
<a class="flex flex-col items-center justify-center text-on-surface-variant opacity-70 hover:opacity-100" href="#Wishes">
<span class="material-symbols-outlined" data-icon="auto_stories">auto_stories</span>
<span class="font-label-caps text-[10px]">Wishes</span>
</a>
</div>
</nav>
</div>
<!-- Hidden Audio element for background music -->
<audio id="bg-music" loop="">
<source src="{{ asset('assets/templates/wedding-11/newassets/NEW/JALARANING TRESNA - CINDI CINTYA FEAT ILHAM PRADANA (OFFICIAL MUSIC VIDEO).mp3') }}" type="audio/mpeg"/>
</audio>

<!-- Lightbox Modal for Photo Preview -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-primary text-4xl font-bold transition-colors">&times;</button>
    <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-primary/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
</div>

<script>
        document.addEventListener('alpine:init', () => {
            const rsvpUrl = @json(isset($invitation) ? route('invitation.rsvp.store', ['invitation' => $invitation->slug]) : null);
            const guestBookUrl = @json(isset($invitation) ? route('invitation.guest-book.store', ['invitation' => $invitation->slug]) : null);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            Alpine.data('rsvpComponent', (initialWishes) => ({
                wishes: initialWishes || [],
                name: '',
                message: '',
                rsvpName: '',
                rsvpCount: 1,
                rsvpAttend: 'Hadir',
                submittingRsvp: false,
                submittingWish: false,
                async sendRequest(url, payload) {
                    if (!url) {
                        throw new Error('Fitur ini hanya aktif pada undangan yang sudah terhubung.');
                    }

                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify(payload)
                    });

                    const result = await response.json().catch(() => ({}));
                    if (!response.ok) {
                        const validationMessage = result.errors ? Object.values(result.errors).flat()[0] : null;
                        throw new Error(validationMessage || result.message || 'Data gagal dikirim.');
                    }

                    return result;
                },
                async submitRSVP() {
                    if (!this.rsvpName) return;
                    this.submittingRsvp = true;

                    try {
                        await this.sendRequest(rsvpUrl, {
                            guest_name: this.rsvpName,
                            guest_count: Number(this.rsvpCount),
                            attendance_status: this.rsvpAttend
                        });
                        showToast('✓ Konfirmasi kehadiran berhasil dikirim!');
                        this.rsvpName = '';
                        this.rsvpCount = 1;
                        this.rsvpAttend = 'Hadir';
                    } catch (error) {
                        showToast(error.message || 'Gagal mengirim konfirmasi.');
                    } finally {
                        this.submittingRsvp = false;
                    }
                },
                async submitWish() {
                    if (!this.name || !this.message) return;
                    this.submittingWish = true;

                    try {
                        const result = await this.sendRequest(guestBookUrl, {
                            guest_name: this.name,
                            message: this.message
                        });
                        this.wishes.unshift(result.wish || { name: this.name, status: 'Ucapan & Doa', message: this.message });
                        this.name = '';
                        this.message = '';
                        showToast('✓ Terima kasih atas ucapan & doa Anda!');
                    } catch (error) {
                        showToast(error.message || 'Gagal mengirim ucapan.');
                    } finally {
                        this.submittingWish = false;
                    }
                }
            }));
        });

        // Toast Notification System
        let toastTimeout;
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMsg = document.getElementById('toast-message');
            if (toast && toastMsg) {
                toastMsg.textContent = message;
                toast.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                toast.classList.add('opacity-100', 'translate-y-0');
                
                clearTimeout(toastTimeout);
                toastTimeout = setTimeout(() => {
                    toast.classList.remove('opacity-100', 'translate-y-0');
                    toast.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                }, 2800);
            }
        }

        // Open Invitation Logic
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const audio = document.getElementById('bg-music');

            document.body.classList.remove('overflow-hidden');
            document.body.classList.add('overflow-x-hidden');

            cover.style.transform = 'translateY(-100%)';
            setTimeout(() => {
                cover.classList.add('hidden');
                mainContent.classList.remove('opacity-0');
                if (audio) {
                    audio.play().catch(() => {});
                }
                startCountdown();
                // Active autoscroll by default
                toggleAutoscroll();
            }, 800);
        }

        // Audio Toggle
        let isPlaying = true;
        function toggleAudio() {
            const audio = document.getElementById('bg-music');
            const iconHeader = document.getElementById('music-icon-header');
            if (!audio) return;
            if (isPlaying) {
                audio.pause();
                if(iconHeader) iconHeader.innerText = 'volume_off';
            } else {
                audio.play().catch(() => {});
                if(iconHeader) iconHeader.innerText = 'volume_up';
            }
            isPlaying = !isPlaying;
        }

        // Autoscroll Logic
        let isScrolling = false;
        let scrollInterval;
        function toggleAutoscroll() {
            const icon = document.getElementById('autoscroll-icon');
            if (isScrolling) {
                clearInterval(scrollInterval);
                if(icon) icon.innerText = 'play_arrow';
            } else {
                scrollInterval = setInterval(() => {
                    window.scrollBy(0, 1);
                }, 30);
                if(icon) icon.innerText = 'pause';
            }
            isScrolling = !isScrolling;
        }

        // Stop autoscroll on manual user scroll
        ['wheel', 'touchmove'].forEach(evt => 
            window.addEventListener(evt, () => {
                if (isScrolling) toggleAutoscroll();
            }, { passive: true })
        );

        // Countdown Logic
        function startCountdown() {
            const weddingDate = new Date("Aug 29, 2026 08:00:00").getTime();
            const x = setInterval(function() {
                const now = new Date().getTime();
                const distance = weddingDate - now;

                if (distance < 0) {
                    clearInterval(x);
                    const dEl = document.getElementById("days");
                    const hEl = document.getElementById("hours");
                    const mEl = document.getElementById("minutes");
                    const sEl = document.getElementById("seconds");
                    if (dEl) dEl.innerHTML = "00";
                    if (hEl) hEl.innerHTML = "00";
                    if (mEl) mEl.innerHTML = "00";
                    if (sEl) sEl.innerHTML = "00";
                } else {
                    const dEl = document.getElementById("days");
                    const hEl = document.getElementById("hours");
                    const mEl = document.getElementById("minutes");
                    const sEl = document.getElementById("seconds");
                    if (dEl) dEl.innerHTML = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                    if (hEl) hEl.innerHTML = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                    if (mEl) mEl.innerHTML = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                    if (sEl) sEl.innerHTML = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                }
            }, 1000);
        }

        // Copy Account Logic
        function copyAccount(number, btn) {
            navigator.clipboard.writeText(number).then(() => {
                showToast('✓ Nomor rekening BCA (' + number + ') berhasil disalin!');
            }).catch(() => {
                // Fallback
                const temp = document.createElement('input');
                temp.value = number;
                document.body.appendChild(temp);
                temp.select();
                document.execCommand('copy');
                document.body.removeChild(temp);
                showToast('✓ Nomor rekening BCA berhasil disalin!');
            });
            
            if (btn) {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<span class="material-symbols-outlined text-sm">done</span><span>TERSALIN</span>';
                btn.style.background = '#e7bd55';
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.style.background = 'linear-gradient(135deg,#d4af37,#b8960b)';
                }, 2000);
            }
        }

        // Scroll Reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.08 });

        document.querySelectorAll('.reveal-section').forEach(section => {
            observer.observe(section);
        });

        // Simple smooth scroll for nav
        document.querySelectorAll('nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetEl = document.querySelector(targetId);
                if (targetEl) {
                    targetEl.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
                
                // Update active state
                document.querySelectorAll('nav a').forEach(a => {
                    a.className = "flex flex-col items-center justify-center text-on-surface-variant opacity-70";
                });
                this.className = "flex flex-col items-center justify-center text-primary font-bold transition-transform duration-200 scale-110";
            });
        });

        // Lightbox Logic
        function openLightbox(src) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            if (lightbox && img) {
                img.src = src;
                lightbox.classList.remove('hidden');
                setTimeout(() => {
                    lightbox.classList.remove('opacity-0');
                }, 10);
            }
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            if (lightbox) {
                lightbox.classList.add('opacity-0');
                setTimeout(() => {
                    lightbox.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</body></html>

