@php
    // If $invitation is passed, map its properties and relations
    if (isset($invitation)) {
        // Parse groom and bride from invitation title (e.g. "Arjuna & Srikandi")
        $names = explode('&', $invitation->title);
        $groomName = trim($names[0] ?? 'Arjuna Sasrabahu');
        $brideName = trim($names[1] ?? 'Srikandi Larasati');

        $couple = [
            'groom' => $groomName,
            'bride' => $brideName,
            'parents' => [
                'groom' => $invitation->description ?? 'Bpk. Sumantri & Ibu Citrawati', // Fallback
                'bride' => 'Bpk. Drupada & Ibu Gandawati',
            ],
        ];

        $event = [
            'date_iso' => $invitation->event_date ? $invitation->event_date->format('Y-m-d') : '2026-11-24',
            'time' => $invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00',
            'location' => $invitation->location ?? 'Masjid Agung Keraton, Yogyakarta',
            'address' => $invitation->address ?? 'Jl. Ngasem No. 12, Kraton, Yogyakarta',
            'maps_url' => $invitation->google_maps_url ?? 'https://maps.google.com/?q=' . urlencode($invitation->location ?? 'Masjid Agung Keraton Yogyakarta'),
        ];

        $schedule = [
            [
                'title' => 'Akad Nikah',
                'time' => ($invitation->event_time ? \Carbon\Carbon::parse($invitation->event_time)->format('H:i') : '08:00') . ' - Selesai',
                'note' => $invitation->location ?? 'Masjid Agung Keraton, Yogyakarta'
            ],
            [
                'title' => 'Resepsi',
                'time' => '11:00 - Selesai',
                'note' => $invitation->address ?? 'Pendopo Agung Royal Ambarrukmo'
            ]
        ];

        if (isset($invitation->stories) && $invitation->stories->count() > 0) {
            $stories = [];
            foreach ($invitation->stories as $story) {
                $stories[] = [
                    'title' => $story->title,
                    'date' => $story->event_date ? $story->event_date->translatedFormat('F Y') : '',
                    'text' => $story->description,
                ];
            }
        } else {
            $stories = [
                ['title' => 'Pertemuan Pertama', 'date' => 'Maret 2022', 'text' => 'Di suatu sore yang tenang di pelataran Keraton...'],
                ['title' => 'Ikatan Janji', 'date' => 'Agustus 2025', 'text' => 'Membulatkan tekad untuk melangkah bersama...'],
                ['title' => 'Menuju Pelaminan', 'date' => 'November 2026', 'text' => 'Mempersiapkan hari bahagia di bawah restu orang tua...'],
            ];
        }

        if (isset($invitation->galleries) && $invitation->galleries->count() > 0) {
            $gallery = [];
            foreach ($invitation->galleries as $gal) {
                $gallery[] = asset('storage/' . $gal->image_path);
            }
        } else {
            $gallery = [
                'https://lh3.googleusercontent.com/aida-public/AB6AXuCQeTewQtvHySvmtC8uPD-H03m903CU6IV4nzKnPXW0oLuqNSWVCS4waw92NFRogXZSWwpdBxWBpso0k6C4eYvWBT_TGtFwlsNvLjZJ9HpdymfvEVJCL4e0LBcwiovb9fcGiiQ-eNXU4jqCdwlwQE59lZh_WLJAWdUjnp8SPYTsqxLrJGuiL0fVO9yacil1rwwjDQRz3LUlMi_0wbTm7oC6Js71Tx_TYI2LOU-TTmd_g3Z2mSwL40loEWmu5eUzG46FUaSBm1FO_Fws',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuDR-ZXF7tvBbc42_9-AKu0FO_SBM3O6GvOsPK6NvvkuuOZ3aoIiZM1AFkP8y6Dp04r1VMYZlkCAYbQdSLpuDTjoPifdedYXOyDlK5NiROYnRYCH6nig-hzer0DyVeaQBpYTUr8OZHLSXOw1kqwuYFGWCrzWcZYipjZKV0qePWBHXTcDVIH-8w03n3S6XNLxlMzDvmGV-ZkbztXH-Oh14fC9zMWTtWkL1s7hc4kHbMB9RkOGxHJfOVBJKe1pRxH8Ez1cOTymkzWW-Iwo',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuCeD3IxuFL1p9jupihf9wHnuJiXXRkM8_VqA3XYWjSoQ6xk3AcNuiBuBc6MgVZyV4H4_JaWoa_xf1ZHxElq2qRExoI8ShFh4WbCzg9yCiETDAg_rj1ZlCp15dk5ljQeeIjF9Bz5aflRAc88AJCx2aelrKvc-nBeo9TlrTlpkxuOng1p9xmMXmnHeCfYHdIcOAC2i4msOEghcgqNqDcEAVQZF6zLYpNNBkSwXkGcP2Zg7Nr8ruzSfPAtBz1aObHAl3KC5SyPGhSI_eWK',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuADsQZ1VJVFCSx7Ft3RFVTm0xC4BCS1nQgmReXoAYYpRfdZi-CYg1aBfpSCJWVWkmABNPG0pH_NtKGix1aRbR3manmsV2E5GOcOuHcJ3gOnnqa76mQdCn2nGnOqaE-f7_2PTLRG_W1GrOfk0wX7EJASasz64eGG-VmDKxP6UODvUVDRpttJPfeZzylib233fr0rW99ojgxEqPuXHoXrqMe_CvysxUCPYWJMhB5CAImjvTCByDE21xt0mQ8aTLBQ1HTIAh0evpVXdYxE',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuBDy78ALENtrGfVN-URyI-gOd1JE-4uqlDMU6V-7XIvDyKprf2zNNB4pnOqoxF1VCIjhwlhuaAzRYvUqJkgIYNAK3C5teWroCi5VLlqJzhUy02AoBKIHXpLT7AymipkP4qUK9JcMdKAIhv12Lh3QYEZkb54SFFA5tmFiZJmzJLxKzVmcHdkGYrplAVAK9uMAxiJcnFv0pbQDoA41TvWJzdem6l1H2nV9ea5TVEn05LWxhElFFb4joWR7gMBxa_ts_0mjHiiBG-z2jsy',
                'https://lh3.googleusercontent.com/aida-public/AB6AXuAwnVjgvLAclOeYiYxnkG176xKlDTx0vfJwGQMkW6B5Fi9XSQ6umHgrN-oGYgQWojMU1EI1lPFNFxmST1lAhrTrDeDTucdpyD-d66jmFoXdze782J32uL3EgXdrDPOnSIu2Xitcw5GKmRVl-L2_cZwEMW-SK8pnzMu1-F63luvi2HmX3mv8hM4Jebwng9PiEMUC1F9UXBiZWgTdG8P-7Znme5WCSMdJVx-XGIcVupCtcMoS7bIzQ401FryTz7b3LLOPybKpLI13XVi5'
            ];
        }

        $coverUrl = $invitation->cover_image ? asset('storage/' . $invitation->cover_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCBOKw2vXCBD9bm0wXdjEeAl0Rc4RVRpc3CrQZ7iMfzptMlsHXuS9MCZN47e6tuJarxMoibqHCSZBbx6e2zAdoNZFRuUmf-DJ0lQY6ZThr_zFOMBpbalNGkIIsL9uAFMS3E_FkloOovaPtl6KuKNMu2ZPLD6mF3zxt5IhNyjpoNyaxD8mTxj66a8S1Ip8y7Dc4IZdTTUMgBhSzNnMQLMgcXzF2Iq2nCl7HKRczLyVxRTL2XpufwehIcusZCzOJ9GJUeT_5wag5or9Am';
        $bg = [
            'cover' => $coverUrl,
            'groom' => $coverUrl,
            'bride' => $coverUrl,
        ];
    } else {
        $couple = $couple ?? [
            'groom' => 'Arjuna Sasrabahu',
            'bride' => 'Srikandi Larasati',
            'parents' => [
                'groom' => 'Bpk. Sumantri & Ibu Citrawati',
                'bride' => 'Bpk. Drupada & Ibu Gandawati',
            ],
        ];

        $event = $event ?? [
            'date_iso' => '2026-11-24',
            'time' => '08:00',
            'location' => 'Masjid Agung Keraton, Yogyakarta',
            'address' => 'Jl. Ngasem No. 12, Kraton, Yogyakarta',
            'maps_url' => 'https://maps.google.com/?q=Masjid+Agung+Kraton+Yogyakarta',
        ];

        $schedule = $schedule ?? [
            ['title' => 'Akad Nikah', 'time' => '08.00 - 10.00 WIB', 'note' => 'Masjid Agung Keraton, Yogyakarta'],
            ['title' => 'Resepsi', 'time' => '11.00 - Selesai', 'note' => 'Pendopo Agung Royal Ambarrukmo'],
        ];

        $stories = $stories ?? [
            ['title' => 'Pertemuan Pertama', 'date' => 'Maret 2022', 'text' => 'Di suatu sore yang tenang di pelataran Keraton...'],
            ['title' => 'Ikatan Janji', 'date' => 'Agustus 2025', 'text' => 'Membulatkan tekad untuk melangkah bersama...'],
            ['title' => 'Menuju Pelaminan', 'date' => 'November 2026', 'text' => 'Mempersiapkan hari bahagia di bawah restu orang tua...'],
        ];

        $gallery = $gallery ?? [
            'https://lh3.googleusercontent.com/aida-public/AB6AXuCQeTewQtvHySvmtC8uPD-H03m903CU6IV4nzKnPXW0oLuqNSWVCS4waw92NFRogXZSWwpdBxWBpso0k6C4eYvWBT_TGtFwlsNvLjZJ9HpdymfvEVJCL4e0LBcwiovb9fcGiiQ-eNXU4jqCdwlwQE59lZh_WLJAWdUjnp8SPYTsqxLrJGuiL0fVO9yacil1rwwjDQRz3LUlMi_0wbTm7oC6Js71Tx_TYI2LOU-TTmd_g3Z2mSwL40loEWmu5eUzG46FUaSBm1FO_Fws',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDR-ZXF7tvBbc42_9-AKu0FO_SBM3O6GvOsPK6NvvkuuOZ3aoIiZM1AFkP8y6Dp04r1VMYZlkCAYbQdSLpuDTjoPifdedYXOyDlK5NiROYnRYCH6nig-hzer0DyVeaQBpYTUr8OZHLSXOw1kqwuYFGWCrzWcZYipjZKV0qePWBHXTcDVIH-8w03n3S6XNLxlMzDvmGV-ZkbztXH-Oh14fC9zMWTtWkL1s7hc4kHbMB9RkOGxHJfOVBJKe1pRxH8Ez1cOTymkzWW-Iwo',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuCeD3IxuFL1p9jupihf9wHnuJiXXRkM8_VqA3XYWjSoQ6xk3AcNuiBuBc6MgVZyV4H4_JaWoa_xf1ZHxElq2qRExoI8ShFh4WbCzg9yCiETDAg_rj1ZlCp15dk5ljQeeIjF9Bz5aflRAc88AJCx2aelrKvc-nBeo9TlrTlpkxuOng1p9xmMXmnHeCfYHdIcOAC2i4msOEghcgqNqDcEAVQZF6zLYpNNBkSwXkGcP2Zg7Nr8ruzSfPAtBz1aObHAl3KC5SyPGhSI_eWK',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuADsQZ1VJVFCSx7Ft3RFVTm0xC4BCS1nQgmReXoAYYpRfdZi-CYg1aBfpSCJWVWkmABNPG0pH_NtKGix1aRbR3manmsV2E5GOcOuHcJ3gOnnqa76mQdCn2nGnOqaE-f7_2PTLRG_W1GrOfk0wX7EJASasz64eGG-VmDKxP6UODvUVDRpttJPfeZzylib233fr0rW99ojgxEqPuXHoXrqMe_CvysxUCPYWJMhB5CAImjvTCByDE21xt0mQ8aTLBQ1HTIAh0evpVXdYxE',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBDy78ALENtrGfVN-URyI-gOd1JE-4uqlDMU6V-7XIvDyKprf2zNNB4pnOqoxF1VCIjhwlhuaAzRYvUqJkgIYNAK3C5teWroCi5VLlqJzhUy02AoBKIHXpLT7AymipkP4qUK9JcMdKAIhv12Lh3QYEZkb54SFFA5tmFiZJmzJLxKzVmcHdkGYrplAVAK9uMAxiJcnFv0pbQDoA41TvWJzdem6l1H2nV9ea5TVEn05LWxhElFFb4joWR7gMBxa_ts_0mjHiiBG-z2jsy',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuAwnVjgvLAclOeYiYxnkG176xKlDTx0vfJwGQMkW6B5Fi9XSQ6umHgrN-oGYgQWojMU1EI1lPFNFxmST1lAhrTrDeDTucdpyD-d66jmFoXdze782J32uL3EgXdrDPOnSIu2Xitcw5GKmRVl-L2_cZwEMW-SK8pnzMu1-F63luvi2HmX3mv8hM4Jebwng9PiEMUC1F9UXBiZWgTdG8P-7Znme5WCSMdJVx-XGIcVupCtcMoS7bIzQ401FryTz7b3LLOPybKpLI13XVi5'
        ];

        $bg = $bg ?? [
            'cover' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCBOKw2vXCBD9bm0wXdjEeAl0Rc4RVRpc3CrQZ7iMfzptMlsHXuS9MCZN47e6tuJarxMoibqHCSZBbx6e2zAdoNZFRuUmf-DJ0lQY6ZThr_zFOMBpbalNGkIIsL9uAFMS3E_FkloOovaPtl6KuKNMu2ZPLD6mF3zxt5IhNyjpoNyaxD8mTxj66a8S1Ip8y7Dc4IZdTTUMgBhSzNnMQLMgcXzF2Iq2nCl7HKRczLyVxRTL2XpufwehIcusZCzOJ9GJUeT_5wag5or9Am',
            'groom' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCBOKw2vXCBD9bm0wXdjEeAl0Rc4RVRpc3CrQZ7iMfzptMlsHXuS9MCZN47e6tuJarxMoibqHCSZBbx6e2zAdoNZFRuUmf-DJ0lQY6ZThr_zFOMBpbalNGkIIsL9uAFMS3E_FkloOovaPtl6KuKNMu2ZPLD6mF3zxt5IhNyjpoNyaxD8mTxj66a8S1Ip8y7Dc4IZdTTUMgBhSzNnMQLMgcXzF2Iq2nCl7HKRczLyVxRTL2XpufwehIcusZCzOJ9GJUeT_5wag5or9Am',
            'bride' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDPdM7ukg3lxjSbTbU8LTkmtVUe3Wlu1ACfW6QNHIVHpbbByEoIZvfkxTXJK43dGBPwEuoKvMjn_AXFcTYhU6-_gD_mkp8OxvVmSKpw_asZWgdPR10FaCpubc9JNmDQIhT5_db_VsvGTU55bb_7ahWg_YPwPsyMa-fGc5jUUYzhRRkruCc86mlsMbIVpefG-_566-w9rNpQpVr14woOZDAjM63LzoqYPDS87qTUDpwslAXlgE1RK4VXygmXJvH2WGJmdnLsgvrz7vkQ',
        ];
    }
@endphp
<!DOCTYPE html>
<html class="scroll-smooth bg-zinc-950" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <title>Krama Inggil | {{ $couple['groom'] }} &amp; {{ $couple['bride'] }} Wedding</title>
    
    <!-- Scripts & Stylesheets -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed-variant": "#8f0f07",
                        "on-primary": "#ffffff",
                        "primary-container": "#d4af37",
                        "on-surface": "#281717",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#241a00",
                        "inverse-surface": "#3f2b2b",
                        "surface-container-highest": "#fcdbda",
                        "inverse-on-surface": "#ffedec",
                        "surface-container-low": "#fff0ef",
                        "on-tertiary-fixed": "#1b1d0e",
                        "tertiary-fixed": "#e4e4cc",
                        "on-secondary-fixed": "#410000",
                        "on-error-container": "#93000a",
                        "on-tertiary-fixed-variant": "#474836",
                        "secondary-container": "#fe624e",
                        "primary-fixed": "#ffe088",
                        "error": "#ba1a1a",
                        "surface-container-high": "#ffe1e0",
                        "on-background": "#281717",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#454634",
                        "surface-tint": "#735c00",
                        "on-tertiary": "#ffffff",
                        "primary": "#735c00",
                        "background": "#fff8f7",
                        "on-primary-container": "#554300",
                        "primary-fixed-dim": "#e9c349",
                        "secondary-fixed-dim": "#ffb4a8",
                        "tertiary-container": "#b4b49d",
                        "secondary": "#b22b1d",
                        "surface": "#fff8f7",
                        "tertiary": "#5e604d",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-variant": "#fcdbda",
                        "secondary-fixed": "#ffdad4",
                        "surface-container": "#ffe9e8",
                        "outline-variant": "#d0c5af",
                        "surface-bright": "#fff8f7",
                        "surface-dim": "#f3d3d2",
                        "on-primary-fixed-variant": "#574500",
                        "outline": "#7f7663",
                        "on-surface-variant": "#4d4635",
                        "inverse-primary": "#e9c349",
                        "on-secondary-container": "#650000",
                        "tertiary-fixed-dim": "#c8c8b0"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "16px",
                        "section-gap": "60px",
                        "margin-mobile": "16px",
                        "unit": "8px",
                        "container-max": "480px"
                    },
                    "fontFamily": {
                        "display-lg-mobile": ["Playfair Display"],
                        "label-caps": ["Plus Jakarta Sans"],
                        "display-lg": ["Playfair Display"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "headline-sm": ["Playfair Display"],
                        "body-md": ["Plus Jakarta Sans"],
                        "headline-md": ["Playfair Display"]
                    },
                    "fontSize": {
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "fontWeight": "700"}],
                        "label-caps": ["11px", {"lineHeight": "14px", "letterSpacing": "0.1em", "fontWeight": "700"}],
                        "display-lg": ["44px", {"lineHeight": "52px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "headline-sm": ["22px", {"lineHeight": "28px", "fontWeight": "600"}],
                        "body-md": ["15px", {"lineHeight": "22px", "fontWeight": "400"}],
                        "headline-md": ["28px", {"lineHeight": "36px", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        .batik-overlay {
            background-image: url("https://www.transparenttextures.com/patterns/batik.png");
            opacity: 0.05;
        }

        .kawung-border {
            border: 12px solid transparent;
            border-image: radial-gradient(circle, #d4af37 20%, transparent 20%) 12;
            border-image-repeat: repeat;
        }

        .gold-shimmer {
            background: linear-gradient(45deg, #735c00 25%, #d4af37 50%, #735c00 75%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }

        @keyframes shimmer {
            to { background-position: 200% center; }
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .gunungan-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
            position: relative;
            margin: 30px 0;
        }

        .gunungan-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff8f7;
            padding: 0 10px;
            color: #d4af37;
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
            0%, 100% { filter: drop-shadow(0 0 8px rgba(212, 175, 55, 0.4)); }
            50% { filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.8)); }
        }

        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }

        .gold-glow {
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.5);
        }

        @keyframes sway {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(3deg); }
        }

        .animate-sway {
            animation: sway 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="max-w-[480px] mx-auto relative overflow-hidden shadow-2xl bg-background text-on-surface selection:bg-primary-container selection:text-on-primary-container font-body-md text-body-md border-x border-primary/10">

    <!-- COVER SECTION (Fixed Fullscreen Overlay inside the frame) -->
    <section class="h-screen w-full fixed inset-0 z-[60] overflow-hidden flex flex-col items-center justify-center text-center transition-all duration-1000 bg-black max-w-[480px] mx-auto" id="cover">
        <!-- WebGL Interactive Shader Background -->
        <div class="absolute inset-0 w-full h-full" style="display:block;">
            <canvas height="1024" id="shader-canvas-ANIMATION_2" style="display:block;width:100%;height:100%" width="1280"></canvas>
            <script>
                (function() {
                  const canvas = document.getElementById('shader-canvas-ANIMATION_2');

                  function syncSize() {
                    const w = canvas.clientWidth  || 1280;
                    const h = canvas.clientHeight || 720;
                    if (canvas.width !== w || canvas.height !== h) {
                      canvas.width  = w;
                      canvas.height = h;
                    }
                  }
                  if (typeof ResizeObserver !== 'undefined') {
                    new ResizeObserver(syncSize).observe(canvas);
                  }
                  syncSize();

                  const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
                  if (!gl) return;
                  const vs = `attribute vec2 a_position;
                varying vec2 v_texCoord;
                void main() {
                  v_texCoord = a_position * 0.5 + 0.5;
                  gl_Position = vec4(a_position, 0.0, 1.0);
                }`;
                  const fs = `precision highp float;
                varying vec2 v_texCoord;
                uniform float u_time;
                uniform vec2 u_resolution;

                void main() {
                    vec2 uv = v_texCoord;
                    
                    // Create a flowing, silk-like motion
                    float wave = sin(uv.x * 3.0 + u_time * 0.5) * 0.1;
                    wave += sin(uv.y * 2.0 + u_time * 0.8) * 0.05;
                    
                    // Deep Maroon and Gold palette
                    vec3 color1 = vec3(0.5, 0.0, 0.0); // Maroon
                    vec3 color2 = vec3(0.83, 0.68, 0.21); // Gold
                    vec3 color3 = vec3(0.2, 0.05, 0.05); // Deep Dark Maroon
                    
                    float noise = sin(uv.x * 10.0 + wave * 20.0) * cos(uv.y * 10.0 + u_time);
                    float mixFactor = smoothstep(-1.0, 1.0, noise);
                    
                    vec3 color = mix(color3, color1, mixFactor);
                    color = mix(color, color2, pow(mixFactor, 3.0) * 0.3);
                    
                    // Subtle batik-like pattern overlay
                    float pattern = sin(uv.x * 50.0 + wave * 100.0) * sin(uv.y * 50.0);
                    color += pattern * 0.02;
                    
                    gl_FragColor = vec4(color, 1.0);
                }`;
                  function cs(type, src) {
                    const s = gl.createShader(type);
                    gl.shaderSource(s, src);
                    gl.compileShader(s);
                    return s;
                  }
                  const prog = gl.createProgram();
                  gl.attachShader(prog, cs(gl.VERTEX_SHADER, vs));
                  gl.attachShader(prog, cs(gl.FRAGMENT_SHADER, fs));
                  gl.linkProgram(prog);
                  gl.useProgram(prog);
                  const buf = gl.createBuffer();
                  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
                  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 1,-1, -1,1, 1,1]), gl.STATIC_DRAW);
                  const pos = gl.getAttribLocation(prog, 'a_position');
                  gl.enableVertexAttribArray(pos);
                  gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);
                  const uTime = gl.getUniformLocation(prog, 'u_time');
                  const uRes = gl.getUniformLocation(prog, 'u_resolution');
                  const uMouse = gl.getUniformLocation(prog, 'u_mouse');

                  let mouse = { x: canvas.width / 2, y: canvas.height / 2 };
                  window.addEventListener('mousemove', (event) => {
                    const rect = canvas.getBoundingClientRect();
                    if (rect.width && rect.height) {
                      const nx = (event.clientX - rect.left) / rect.width;
                      const ny = 1.0 - (event.clientY - rect.top) / rect.height;
                      mouse.x = nx * canvas.width;
                      mouse.y = ny * canvas.height;
                    }
                  });

                  function render(t) {
                    if (typeof ResizeObserver === 'undefined') syncSize();
                    gl.viewport(0, 0, canvas.width, canvas.height);
                    if (uTime) gl.uniform1f(uTime, t * 0.001);
                    if (uRes) gl.uniform2f(uRes, canvas.width, canvas.height);
                    if (uMouse) gl.uniform2f(uMouse, mouse.x, mouse.y);
                    gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                    requestAnimationFrame(render);
                  }
                  render(0);
                })();
            </script>
        </div>
        
        <div class="absolute inset-0 bg-black/45 backdrop-blur-[2px]"></div>
        <div class="relative z-10 text-center px-gutter flex flex-col items-center justify-center h-full">
            <p class="font-label-caps text-[11px] text-primary-fixed mb-4 tracking-[0.3em] uppercase">SERAT SEDHAHAN</p>
            <h1 class="font-display-lg text-display-lg-mobile text-white mb-6 leading-tight">
                <span class="gold-shimmer block">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</span>
            </h1>
            <p class="font-body-lg text-sm text-white/90 mb-10 max-w-xs leading-relaxed">
                Mugi gusti mberkahi, kersanipun nyawijiaken katresnan kulo lan panjenengan.
            </p>
            <button class="bg-secondary text-on-secondary px-10 py-3.5 rounded-full font-label-caps text-xs hover:scale-105 active:scale-95 transition-all duration-300 shadow-[0_0_20px_rgba(178,43,29,0.4)] border border-primary-container" onclick="openInvitation()">
                Buka Undangan
            </button>
        </div>
        
        <!-- Decorative Batik Side Borders -->
        <div class="absolute left-0 top-0 h-full w-6 batik-overlay border-r border-primary/20"></div>
        <div class="absolute right-0 top-0 h-full w-6 batik-overlay border-l border-primary/20"></div>
    </section>

    <!-- MAIN CONTENT CONTAINER (Hidden initially for animation) -->
    <div class="opacity-0 transition-opacity duration-[1200ms] relative" id="main-content">
        
        <!-- TOP APP BAR -->
        <header class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] z-50 bg-surface/85 backdrop-blur-md border-b border-primary/10 flex justify-between items-center px-gutter py-4">
            <span class="font-display-lg text-base text-primary font-bold">{{ $couple['groom'] }} &amp; {{ $couple['bride'] }}</span>
            <div class="flex gap-4">
                <button onclick="toggleAudio()" class="active:scale-95 transition-all duration-150">
                    <span class="material-symbols-outlined text-primary text-xl" id="music-icon-header">volume_up</span>
                </button>
                <button onclick="toggleAutoscroll()" class="active:scale-95 transition-all duration-150">
                    <span class="material-symbols-outlined text-primary text-xl" id="autoscroll-icon">play_arrow</span>
                </button>
            </div>
        </header>

        <!-- Welcome Section -->
        <section class="pt-28 pb-12 px-gutter text-center max-w-md mx-auto reveal active" id="home">
            <span class="material-symbols-outlined text-primary text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">spa</span>
            <h2 class="font-headline-md text-2xl text-primary mb-4 italic">Sugeng Rawuh</h2>
            <p class="font-body-md text-sm text-on-surface-variant leading-relaxed px-2">
                "Kanthi asmaning Gusti Ingkang Moho Welas lan Moho Asih, kulo nedi donga pangestunipun panjenengan sedoyo ing dinten kromo kulo."
            </p>
            <div class="gunungan-divider">
                <span class="material-symbols-outlined gunungan-icon text-lg">architecture</span>
            </div>
        </section>

        <!-- Couple Section (Vertical Layout for mobile preview with premium traditional ornaments) -->
        <section class="py-16 px-gutter bg-surface-container-low relative overflow-hidden" id="couple">
            <div class="batik-overlay absolute inset-0"></div>
            
            <!-- Traditional Gunungan Background Ornament (Adapted from wedding-11) -->
            <svg class="absolute bottom-0 right-[-65px] w-[260px] h-[400px] text-primary/10 opacity-30 z-0 pointer-events-none animate-sway" viewBox="0 0 120 180" fill="none" stroke="currentColor" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M 60,10 C 48,25 40,40 30,55 C 10,80 25,85 25,105 C 25,120 15,130 15,150 C 15,155 20,160 25,160 L 55,160 L 55,175 L 65,175 L 65,160 L 95,160 C 100,160 105,155 105,150 C 105,130 95,120 95,105 C 95,85 110,80 90,55 C 80,40 72,25 60,10 Z" stroke-width="1.2"/>
                <path d="M 60,16 C 50,30 43,44 34,58 C 16,81 29,86 29,104 C 29,117 20,126 20,144 C 20,149 24,154 29,154 L 91,154 C 96,154 100,149 100,144 C 100,126 91,117 91,104 C 91,86 104,81 86,58 C 77,44 70,30 60,16 Z" stroke-width="0.6" stroke-dasharray="1.5 1.5" opacity="0.6"/>
                <path d="M 45,154 L 45,135 L 75,135 L 75,154" stroke-width="1"/>
                <path d="M 40,135 L 50,122 L 70,122 L 80,135 Z" fill="currentColor" fill-opacity="0.1" stroke-width="1"/>
                <path d="M 50,122 L 60,112 L 70,122" stroke-width="0.8"/>
                <path d="M 52,154 L 52,142 C 52,139 68,139 68,142 L 68,154" stroke-width="0.6"/>
                <line x1="60" y1="135" x2="60" y2="154" stroke-width="0.6"/>
                <path d="M 60,112 L 60,40" stroke-width="1.2"/>
                <path d="M 60,100 C 48,95 38,98 32,108 C 28,115 32,122 40,118 C 45,115 48,108 48,108" stroke-width="0.6"/>
                <path d="M 60,100 C 72,95 82,98 88,108 C 92,115 88,122 80,118 C 75,115 72,108 72,108" stroke-width="0.6"/>
                <path d="M 60,85 C 45,78 35,82 30,95 C 26,102 32,108 38,102 C 44,96 46,90 46,90" stroke-width="0.6"/>
                <path d="M 60,85 C 75,78 85,82 90,95 C 94,102 88,108 82,102 C 76,96 74,90 74,90" stroke-width="0.6"/>
                <path d="M 60,70 C 48,60 38,65 35,78 C 32,84 38,90 42,84 C 46,78 48,73 48,73" stroke-width="0.6"/>
                <path d="M 60,70 C 72,60 82,65 85,78 C 88,84 82,90 78,84 C 74,78 72,73 72,73" stroke-width="0.6"/>
                <circle cx="60" cy="70" r="14" stroke="currentColor" stroke-width="0.4" stroke-dasharray="1 2" opacity="0.6"/>
            </svg>

            <div class="max-w-md mx-auto relative z-10 space-y-16">
                <!-- Groom -->
                <div class="flex flex-col items-center text-center reveal">
                    <div class="relative w-60 h-72 mb-4 rounded-t-full border-4 border-primary/30 p-1.5 overflow-hidden bg-surface shadow-xl animate-float">
                        <img class="w-full h-full object-cover rounded-t-full grayscale hover:grayscale-0 transition-all duration-700" src="{{ $bg['groom'] }}" alt="{{ $couple['groom'] }}">
                        <div class="absolute -bottom-2 -left-2 w-16 h-16 bg-primary/20 rotate-45 border border-primary/35"></div>
                    </div>
                    <div class="bg-surface/90 backdrop-blur-sm px-6 py-4 shadow-lg border border-primary/15 rounded-2xl max-w-[280px]">
                        <h3 class="font-display-lg text-lg text-primary font-bold">{{ $couple['groom'] }}</h3>
                        <p class="font-body-md text-xs text-on-surface-variant mt-1">Putra saking {{ $couple['parents']['groom'] }}</p>
                    </div>
                </div>

                <!-- Spacer Ornament -->
                <div class="flex justify-center my-2 opacity-60">
                    <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">favorite</span>
                </div>

                <!-- Bride -->
                <div class="flex flex-col items-center text-center reveal" style="transition-delay: 100ms;">
                    <div class="relative w-60 h-72 mb-4 rounded-t-full border-4 border-primary/30 p-1.5 overflow-hidden bg-surface shadow-xl animate-float" style="animation-delay: 1.5s;">
                        <img class="w-full h-full object-cover rounded-t-full grayscale hover:grayscale-0 transition-all duration-700" src="{{ $bg['bride'] }}" alt="{{ $couple['bride'] }}">
                        <div class="absolute -bottom-2 -right-2 w-16 h-16 bg-primary/20 -rotate-45 border border-primary/35"></div>
                    </div>
                    <div class="bg-surface/90 backdrop-blur-sm px-6 py-4 shadow-lg border border-primary/15 rounded-2xl max-w-[280px]">
                        <h3 class="font-display-lg text-lg text-primary font-bold">{{ $couple['bride'] }}</h3>
                        <p class="font-body-md text-xs text-on-surface-variant mt-1">Putri saking {{ $couple['parents']['bride'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kisah Asmara Section (Left-aligned timeline) -->
        <section class="py-12 px-gutter bg-background relative overflow-hidden" id="story">
            <div class="batik-overlay absolute inset-0"></div>
            <div class="max-w-md mx-auto relative z-10">
                <h2 class="font-display-lg text-2xl text-center text-primary mb-12 reveal">Kisah Asmara</h2>
                <div class="space-y-10 relative before:absolute before:left-6 before:top-2 before:bottom-2 before:w-0.5 before:bg-primary-container/40">
                    @foreach($stories as $index => $story)
                        @php
                            $icon = 'favorite';
                            if ($index == 1) $icon = 'diamond';
                            if ($index >= 2) $icon = 'auto_awesome';
                        @endphp
                        <div class="relative pl-14 reveal" style="transition-delay: {{ $index * 200 }}ms;">
                            <div class="absolute left-1.5 top-0 w-9 h-9 bg-secondary rounded-full border-2 border-primary-container flex items-center justify-center z-10 shadow-sm">
                                <span class="material-symbols-outlined text-white text-xs">{{ $icon }}</span>
                            </div>
                            <div class="text-left bg-surface/80 backdrop-blur-sm p-5 rounded-2xl border border-primary-container/20 shadow-sm">
                                <span class="text-[10px] text-secondary font-bold uppercase tracking-wider">{{ $story['date'] ?? '' }}</span>
                                <h3 class="font-headline-sm text-primary text-base mt-0.5">{{ $story['title'] }}</h3>
                                <p class="text-body-md text-on-surface-variant mt-2 text-xs leading-relaxed">{{ $story['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Event Details Section (Vertical Stacking) -->
        <section class="py-12 px-gutter bg-background" id="event">
            <div class="max-w-md mx-auto space-y-8">
                <h2 class="font-display-lg text-2xl text-center text-primary mb-10 reveal active">Wanci Resepsi</h2>
                
                @foreach($schedule as $index => $sch)
                    @php
                        $isResepsi = $index > 0;
                    @endphp
                    @if(!$isResepsi)
                        <!-- Akad Nikah -->
                        <div class="bg-surface-container-high p-8 rounded-2xl border-t-4 border-primary-container shadow-md hover:shadow-xl transition-all reveal active">
                            <div class="flex justify-between items-start mb-4">
                                <span class="material-symbols-outlined text-3xl text-primary" style="font-variation-settings: 'FILL' 1;">temple_buddhist</span>
                                <div class="text-right">
                                    <p class="font-label-caps text-[10px] text-secondary mb-0.5 uppercase tracking-widest">{{ $sch['title'] }}</p>
                                    <p class="font-headline-sm text-sm font-bold text-gray-800">{{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') : 'Minggu, 24 Nov 2024' }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 mb-6 text-xs">
                                <div class="flex items-center gap-3 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    <span>{{ $sch['time'] }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    <span class="leading-normal">{{ $sch['note'] }}</span>
                                </div>
                            </div>
                            <a class="block text-center py-2.5 border border-primary text-primary font-label-caps text-xs rounded-full hover:bg-primary hover:text-white transition-all font-semibold" href="{{ $event['maps_url'] ?? '#' }}" target="_blank">Lihat Lokasi</a>
                        </div>
                    @else
                        <!-- Resepsi -->
                        <div class="bg-secondary p-8 rounded-2xl border-t-4 border-primary-container shadow-md hover:shadow-xl transition-all text-white reveal active" style="transition-delay: 100ms;">
                            <div class="flex justify-between items-start mb-4">
                                <span class="material-symbols-outlined text-3xl text-primary-fixed-dim" style="font-variation-settings: 'FILL' 1;">celebration</span>
                                <div class="text-right">
                                    <p class="font-label-caps text-[10px] text-primary-fixed mb-0.5 uppercase tracking-widest">{{ $sch['title'] }}</p>
                                    <p class="font-headline-sm text-sm font-bold text-white">{{ isset($event['date_iso']) ? \Carbon\Carbon::parse($event['date_iso'])->translatedFormat('l, d F Y') : 'Minggu, 24 Nov 2024' }}</p>
                                </div>
                            </div>
                            <div class="space-y-3 mb-6 text-xs text-secondary-fixed">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    <span>{{ $sch['time'] }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    <span class="leading-normal">{{ $sch['note'] }}</span>
                                </div>
                            </div>
                            <a class="block text-center py-2.5 border border-primary-fixed text-primary-fixed font-label-caps text-xs rounded-full hover:bg-white hover:text-secondary transition-all font-semibold" href="{{ $event['maps_url'] ?? '#' }}" target="_blank">Lihat Lokasi</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>

        <!-- Gallery Section (1 column stacked for mobile, clickable lightbox preview) -->
        <section class="py-12 px-gutter bg-surface-container-low overflow-hidden" id="gallery">
            <div class="max-w-md mx-auto">
                <h2 class="font-display-lg text-2xl text-center text-primary mb-10 reveal active">Momen Katresnan</h2>
                
                @if(isset($gallery) && count($gallery) > 0)
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($gallery as $index => $img)
                            @php
                                $imgUrl = '';
                                if (is_string($img)) {
                                    $imgUrl = $img;
                                } elseif (is_array($img)) {
                                    $imgUrl = isset($img['image_path']) ? asset('storage/' . $img['image_path']) : (isset($img['file_path']) ? asset('storage/' . $img['file_path']) : '');
                                } elseif (is_object($img)) {
                                    $imgUrl = isset($img->image_path) ? asset('storage/' . $img->image_path) : (isset($img->file_path) ? asset('storage/' . $img->file_path) : '');
                                }
                            @endphp
                            @if($imgUrl)
                                <div class="reveal aspect-[3/4] relative group overflow-hidden rounded-xl border border-primary-container/20 shadow-sm" style="transition-delay: {{ $index * 100 }}ms;">
                                    <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105 cursor-zoom-in filter sepia-[0.15]" src="{{ $imgUrl }}" alt="Momen {{ $index + 1 }}" onclick="openLightbox(this.src)"/>
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500 pointer-events-none"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-3">
                        @php
                            $defaultGallery = [
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuCQeTewQtvHySvmtC8uPD-H03m903CU6IV4nzKnPXW0oLuqNSWVCS4waw92NFRogXZSWwpdBxWBpso0k6C4eYvWBT_TGtFwlsNvLjZJ9HpdymfvEVJCL4e0LBcwiovb9fcGiiQ-eNXU4jqCdwlwQE59lZh_WLJAWdUjnp8SPYTsqxLrJGuiL0fVO9yacil1rwwjDQRz3LUlMi_0wbTm7oC6Js71Tx_TYI2LOU-TTmd_g3Z2mSwL40loEWmu5eUzG46FUaSBm1FO_Fws',
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuDR-ZXF7tvBbc42_9-AKu0FO_SBM3O6GvOsPK6NvvkuuOZ3aoIiZM1AFkP8y6Dp04r1VMYZlkCAYbQdSLpuDTjoPifdedYXOyDlK5NiROYnRYCH6nig-hzer0DyVeaQBpYTUr8OZHLSXOw1kqwuYFGWCrzWcZYipjZKV0qePWBHXTcDVIH-8w03n3S6XNLxlMzDvmGV-ZkbztXH-Oh14fC9zMWTtWkL1s7hc4kHbMB9RkOGxHJfOVBJKe1pRxH8Ez1cOTymkzWW-Iwo',
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuCeD3IxuFL1p9jupihf9wHnuJiXXRkM8_VqA3XYWjSoQ6xk3AcNuiBuBc6MgVZyV4H4_JaWoa_xf1ZHxElq2qRExoI8ShFh4WbCzg9yCiETDAg_rj1ZlCp15dk5ljQeeIjF9Bz5aflRAc88AJCx2aelrKvc-nBeo9TlrTlpkxuOng1p9xmMXmnHeCfYHdIcOAC2i4msOEghcgqNqDcEAVQZF6zLYpNNBkSwXkGcP2Zg7Nr8ruzSfPAtBz1aObHAl3KC5SyPGhSI_eWK',
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuADsQZ1VJVFCSx7Ft3RFVTm0xC4BCS1nQgmReXoAYYpRfdZi-CYg1aBfpSCJWVWkmABNPG0pH_NtKGix1aRbR3manmsV2E5GOcOuHcJ3gOnnqa76mQdCn2nGnOqaE-f7_2PTLRG_W1GrOfk0wX7EJASasz64eGG-VmDKxP6UODvUVDRpttJPfeZzylib233fr0rW99ojgxEqPuXHoXrqMe_CvysxUCPYWJMhB5CAImjvTCByDE21xt0mQ8aTLBQ1HTIAh0evpVXdYxE',
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuBDy78ALENtrGfVN-URyI-gOd1JE-4uqlDMU6V-7XIvDyKprf2zNNB4pnOqoxF1VCIjhwlhuaAzRYvUqJkgIYNAK3C5teWroCi5VLlqJzhUy02AoBKIHXpLT7AymipkP4qUK9JcMdKAIhv12Lh3QYEZkb54SFFA5tmFiZJmzJLxKzVmcHdkGYrplAVAK9uMAxiJcnFv0pbQDoA41TvWJzdem6l1H2nV9ea5TVEn05LWxhElFFb4joWR7gMBxa_ts_0mjHiiBG-z2jsy',
                                'https://lh3.googleusercontent.com/aida-public/AB6AXuAwnVjgvLAclOeYiYxnkG176xKlDTx0vfJwGQMkW6B5Fi9XSQ6umHgrN-oGYgQWojMU1EI1lPFNFxmST1lAhrTrDeDTucdpyD-d66jmFoXdze782J32uL3EgXdrDPOnSIu2Xitcw5GKmRVl-L2_cZwEMW-SK8pnzMu1-F63luvi2HmX3mv8hM4Jebwng9PiEMUC1F9UXBiZWgTdG8P-7Znme5WCSMdJVx-XGIcVupCtcMoS7bIzQ401FryTz7b3LLOPybKpLI13XVi5'
                            ];
                        @endphp
                        @foreach($defaultGallery as $index => $imgUrl)
                            <div class="reveal aspect-[3/4] relative group overflow-hidden rounded-xl border border-primary-container/20 shadow-sm mb-2" style="transition-delay: {{ $index * 100 }}ms;">
                                <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-105 cursor-zoom-in filter sepia-[0.15]" src="{{ $imgUrl }}" onclick="openLightbox(this.src)"/>
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-500 pointer-events-none"></div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- RSVP Section -->
        <section class="py-12 px-gutter bg-background relative overflow-hidden" id="rsvp">
            <div class="max-w-md mx-auto relative z-10">
                <div class="kawung-border bg-surface-container-low p-8 rounded-2xl shadow-xl text-center reveal active">
                    <h2 class="font-display-lg text-xl text-primary mb-2">Konfirmasi Kehadiran</h2>
                    <p class="font-body-md text-xs text-on-surface-variant mb-8">Mugi panjenengan sedoyo saged rawuh ing dinten kromo kulo.</p>
                    <form class="space-y-6 text-left text-xs">
                        <div class="relative">
                            <input class="peer w-full bg-transparent border-0 border-b border-primary-container py-2 focus:ring-0 focus:border-primary transition-all placeholder-transparent" placeholder=" " type="text"/>
                            <label class="absolute left-0 top-2 text-on-surface-variant/60 transition-all peer-focus:-top-4 peer-focus:text-[10px] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-[10px]">Nama Lengkap</label>
                        </div>
                        <div class="relative">
                            <select class="peer w-full bg-transparent border-0 border-b border-primary-container py-2 focus:ring-0 focus:border-primary transition-all appearance-none">
                                <option value="hadir">Saged Rawuh (Hadir)</option>
                                <option value="tidak">Mboten Saged Rawuh (Tidak Hadir)</option>
                            </select>
                            <label class="absolute left-0 -top-4 text-[10px] text-primary">Status Kehadiran</label>
                        </div>
                        <div class="relative">
                            <input class="peer w-full bg-transparent border-0 border-b border-primary-container py-2 focus:ring-0 focus:border-primary transition-all placeholder-transparent" placeholder=" " type="number"/>
                            <label class="absolute left-0 top-2 text-on-surface-variant/60 transition-all peer-focus:-top-4 peer-focus:text-[10px] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-[10px]">Jumlah Tamu</label>
                        </div>
                        <div class="relative">
                            <textarea class="peer w-full bg-transparent border-0 border-b border-primary-container py-2 focus:ring-0 focus:border-primary transition-all placeholder-transparent resize-none" placeholder=" " rows="3"></textarea>
                            <label class="absolute left-0 top-2 text-on-surface-variant/60 transition-all peer-focus:-top-4 peer-focus:text-[10px] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-top-4 peer-[:not(:placeholder-shown)]:text-[10px]">Ucapan &amp; Pandonga</label>
                        </div>
                        <button class="w-full bg-primary text-on-primary py-3 rounded-full font-label-caps text-[11px] hover:bg-on-primary-fixed-variant transition-all shadow-md active:scale-95 uppercase tracking-widest font-bold" type="submit">Kirim Konfirmasi</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer Shell -->
        <footer class="w-full relative overflow-hidden bg-secondary dark:bg-on-secondary-fixed-variant border-t-4 border-primary-container py-12 px-gutter text-center flex flex-col items-center gap-3">
            <span class="font-display-lg text-on-secondary text-xl tracking-widest">{{ $couple['bride'] }} &amp; {{ $couple['groom'] }}</span>
            <p class="font-body-md text-xs text-secondary-fixed/80 max-w-xs leading-normal">
                "Matur nuwun dhumateng rawuhipun panjenengan sedoyo ing dinten kromo kulo."
            </p>
            <div class="flex gap-4 mt-2 text-xs">
                <a class="text-secondary-fixed/80 hover:text-primary-fixed transition-opacity" href="#">Privacy</a>
                <a class="text-secondary-fixed/80 hover:text-primary-fixed transition-opacity" href="#">Contact</a>
                <a class="text-secondary-fixed/80 hover:text-primary-fixed transition-opacity" href="#">Guestbook</a>
            </div>
            <p class="font-body-md text-secondary-fixed/60 mt-6 text-[10px]">
                © {{ date('Y') }} The Royal Wedding. Crafted with Keraton Elegance.
            </p>
        </footer>

        <!-- Bottom Navigation (Mobile Only) -->
        <nav id="bottom-nav" class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-[480px] flex justify-around items-center px-4 pb-4 pt-2 bg-surface dark:bg-surface-container-highest shadow-[0_-4px_10px_rgba(115,92,0,0.1)] z-50 rounded-t-3xl border-t border-primary/10 transition-transform duration-500 translate-y-full">
            <a class="flex flex-col items-center justify-center text-outline p-1.5 hover:text-primary transition-all active:scale-110" href="#home">
                <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">home</span>
                <span class="font-label-caps text-[9px] mt-0.5">Home</span>
            </a>
            <a class="flex flex-col items-center justify-center text-outline p-1.5 hover:text-primary transition-all active:scale-110" href="#couple">
                <span class="material-symbols-outlined text-xl">favorite</span>
                <span class="font-label-caps text-[9px] mt-0.5">Couple</span>
            </a>
            <a class="flex flex-col items-center justify-center text-outline p-1.5 hover:text-primary transition-all active:scale-110" href="#story">
                <span class="material-symbols-outlined text-xl">history_edu</span>
                <span class="font-label-caps text-[9px] mt-0.5">Kisah</span>
            </a>
            <a class="flex flex-col items-center justify-center text-outline p-1.5 hover:text-primary transition-all active:scale-110" href="#event">
                <span class="material-symbols-outlined text-xl">calendar_today</span>
                <span class="font-label-caps text-[9px] mt-0.5">Event</span>
            </a>
            <a class="flex flex-col items-center justify-center text-outline p-1.5 hover:text-primary transition-all active:scale-110" href="#gallery">
                <span class="material-symbols-outlined text-xl">photo_library</span>
                <span class="font-label-caps text-[9px] mt-0.5">Gallery</span>
            </a>
            <a class="flex flex-col items-center justify-center text-outline p-1.5 hover:text-primary transition-all active:scale-110" href="#rsvp">
                <span class="material-symbols-outlined text-xl">mail</span>
                <span class="font-label-caps text-[9px] mt-0.5">RSVP</span>
            </a>
        </nav>
    </div>

    <!-- Lightbox Modal for Photo Preview -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-primary text-4xl font-bold transition-colors">&times;</button>
        <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain rounded-xl border-2 border-primary/40 shadow-2xl" src="" alt="Preview" onclick="event.stopPropagation()"/>
    </div>

    <!-- Background Music Player -->
    <audio id="bg-music" loop="">
        <source src="{{ $music_url ?? 'https://invite.leafitation.com/wp-content/uploads/2026/01/Jawa-03-Niken-Salindry-KUSUMA-WIJAYA.mp3' }}" type="audio/mpeg"/>
    </audio>

    <script>
        // Open Invitation Action & Page Transition
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const bottomNav = document.getElementById('bottom-nav');
            const audio = document.getElementById('bg-music');

            // Allow body to scroll
            document.body.classList.remove('overflow-hidden');
            document.body.classList.add('overflow-x-hidden');

            // Slide up cover
            cover.style.transform = 'translateY(-100%)';
            
            setTimeout(() => {
                cover.classList.add('hidden');
                mainContent.classList.remove('opacity-0');
                bottomNav.classList.remove('translate-y-full');
                
                // Play audio and start autoscroll
                audio.play();
                toggleAutoscroll();
            }, 800);
        }

        // Lightbox Logic for Photo Preview
        function openLightbox(src) {
            const lightbox = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lightbox.classList.remove('hidden');
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
            }, 10);
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('opacity-0');
            setTimeout(() => {
                lightbox.classList.add('hidden');
            }, 300);
        }

        // Audio Toggle
        let isPlaying = true;
        function toggleAudio() {
            const audio = document.getElementById('bg-music');
            const iconHeader = document.getElementById('music-icon-header');
            if (isPlaying) {
                audio.pause();
                if(iconHeader) iconHeader.innerText = 'volume_off';
            } else {
                audio.play();
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

        // Pause autoscroll on manual user scroll, with a delay to ignore initial page transition touches
        let allowInterrupt = false;
        setTimeout(() => {
            allowInterrupt = true;
        }, 2500);

        ['wheel', 'touchmove'].forEach(evt => 
            window.addEventListener(evt, () => {
                if (allowInterrupt && isScrolling) toggleAutoscroll();
            }, { passive: true })
        );

        // Smooth scroll navigation
        document.querySelectorAll('nav a, header a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#') {
                    const targetSection = document.querySelector(targetId);
                    if (targetSection) {
                        // Pause autoscroll if scrolling manually to section
                        if (isScrolling) toggleAutoscroll();
                        targetSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Intersection Observer for Scroll Reveal
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal').forEach(el => {
            revealObserver.observe(el);
        });

        // Form Submission Interaction
        const formEl = document.querySelector('form');
        if (formEl) {
            formEl.addEventListener('submit', (e) => {
                e.preventDefault();
                const btn = e.target.querySelector('button');
                const originalText = btn.innerText;
                btn.innerText = 'Ngirim...';
                btn.disabled = true;
                
                setTimeout(() => {
                    btn.innerText = 'Matur Nuwun!';
                    btn.style.backgroundColor = '#735c00';
                    e.target.reset();
                    setTimeout(() => {
                        btn.innerText = originalText;
                        btn.disabled = false;
                        btn.style.backgroundColor = '';
                    }, 3000);
                }, 1500);
            });
        }
    </script>
</body>
</html>