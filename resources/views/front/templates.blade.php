@extends('layouts.landing')

@section('content')

    <!-- Simple Header Page Area -->
    <div style="background-color: #f4f6f9; padding: 30px 0; border-bottom: 1px solid #e5e8ec;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <h1 style="font-size: 24px; font-weight: 700; color: #333; margin: 0; font-family: 'Poppins', sans-serif;">Semua Template</h1>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 justify-content-center justify-content-md-end" style="background: transparent; padding: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #1a7b45; text-decoration: none; font-weight: 500;">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #666;">Semua Template</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Grid Area -->
    <section class="vs-service__layout1 space position-relative" style="background: #fafbfd; padding: 60px 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title-area text-center wow animate__fadeInUp" data-wow-delay="0.25s">
                        <span class="sec-subtitle justify-content-center" style="color: #1a7b45; font-weight: 600; letter-spacing: 2px;">PILIHAN TEMPLATE</span>
                        <h2 class="sec-title" style="font-family: 'Poppins', sans-serif; font-weight: 800; color: #222;">Eksplorasi Tema Kami</h2>
                        <p class="sec-text" style="color: #666; font-size: 15px;">Temukan berbagai pilihan tema undangan digital yang dirancang khusus untuk membuat momen spesial Anda menjadi lebih berkesan.</p>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Controls -->
            <div class="filter-controls-wrap mb-5" style="background: #ffffff; border-radius: 16px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid #f0f2f5;">
                <!-- Search Bar -->
                <div class="row mb-4 justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="position-relative">
                            <input type="text" id="search-input" placeholder="Cari nama template... (misal: Jawa, Emerald, Modern)" 
                                   style="width: 100%; padding: 12px 20px 12px 45px; border-radius: 30px; border: 1.5px solid #e2e8f0; font-size: 14px; outline: none; transition: all 0.3s ease; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                            <i class="fas fa-search" style="position: absolute; left: 18px; top: 16px; color: #a0aec0; font-size: 15px;"></i>
                            <button id="clear-search" style="position: absolute; right: 15px; top: 12px; border: none; background: none; color: #a0aec0; display: none; cursor: pointer;">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Event Type Filters -->
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <span style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">Kategori Acara</span>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="filter-btn active" data-filter="all">
                                <i class="fas fa-th-large"></i> Semua Acara
                            </button>
                            <button class="filter-btn" data-filter="Pernikahan">
                                <i class="fas fa-heart"></i> Pernikahan
                            </button>
                            <button class="filter-btn" data-filter="Ulang Tahun">
                                <i class="fas fa-birthday-cake"></i> Ulang Tahun
                            </button>
                            <button class="filter-btn" data-filter="Seminar">
                                <i class="fas fa-graduation-cap"></i> Seminar
                            </button>
                            <button class="filter-btn" data-filter="Reuni">
                                <i class="fas fa-users"></i> Reuni
                            </button>
                            <button class="filter-btn" data-filter="Wisuda">
                                <i class="fas fa-user-graduate"></i> Wisuda
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sub-Theme Filters (Shown dynamically for Pernikahan) -->
                <div id="sub-theme-wrapper" class="row mt-4 pt-3 border-top" style="display: none; border-color: #f1f5f9 !important;">
                    <div class="col-12 text-center">
                        <span style="font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 10px;">Tema Desain Pernikahan</span>
                        <div class="d-flex flex-wrap justify-content-center gap-1">
                            <button class="sub-filter-btn active" data-subfilter="all">Semua Tema</button>
                            <button class="sub-filter-btn" data-subfilter="Tradisional (Jawa, Sunda, dll)">
                                <i class="fas fa-crown me-1 text-warning"></i> Tradisional / Adat
                            </button>
                            <button class="sub-filter-btn" data-subfilter="Modern & Elegan">Modern & Elegan</button>
                            <button class="sub-filter-btn" data-subfilter="Minimalis & Klasik">Minimalis & Klasik</button>
                            <button class="sub-filter-btn" data-subfilter="Rustic & Nature">Rustic & Nature</button>
                            <button class="sub-filter-btn" data-subfilter="Vintage & Retro">Vintage & Retro</button>
                            <button class="sub-filter-btn" data-subfilter="Religi / Islami">Religi / Islami</button>
                            <button class="sub-filter-btn" data-subfilter="Unik & Kreatif">Unik & Kreatif</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Templates Grid -->
            @if(isset($templates) && $templates->count() > 0)
                <div class="row g-4" id="templates-grid">
                    @foreach($templates as $template)
                        @php
                            $evtName = $template->eventType ? $template->eventType->name : 'Lainnya';
                            $themeCat = $template->theme_category ?? '';
                        @endphp
                        <div class="col-lg-6 col-md-12 template-card" 
                             data-event-type="{{ $evtName }}"
                             data-theme="{{ $themeCat }}"
                             data-name="{{ strtolower($template->name) }}"
                             data-desc="{{ strtolower($template->description) }}"
                             style="transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
                            
                            <div class="template-list-item d-flex align-items-center" 
                                 style="box-shadow: 0 4px 20px rgba(0,0,0,0.03); border-radius: 16px; background: #fff; padding: 18px; border: 1px solid #f0f2f5; transition: all 0.3s ease; height: 100%;">
                                
                                <div class="template-img-wrap" style="flex-shrink: 0; margin-right: 20px; position: relative;">
                                    <a href="{{ route('templates.preview', $template->slug) }}" target="_blank" class="d-block overflow-hidden" style="border-radius: 10px;">
                                        @if($template->thumbnail)
                                            <img src="{{ Storage::url($template->thumbnail) }}" alt="{{ $template->name }}" 
                                                 class="template-thumb" style="width: 100px; height: 100px; object-fit: cover; transition: transform 0.4s ease;">
                                        @else
                                            <img src="{{ asset('assets_landingpage/img/service/service-img-new-1.png') }}" alt="{{ $template->name }}" 
                                                 class="template-thumb" style="width: 100px; height: 100px; object-fit: cover; transition: transform 0.4s ease;">
                                        @endif
                                    </a>
                                </div>

                                <div class="template-info" style="flex-grow: 1; min-width: 0;">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <h4 class="mb-0 text-truncate" style="font-size: 17px; font-weight: 700; color: #2d3748; font-family: 'Poppins', sans-serif;">
                                            <a href="{{ route('templates.preview', $template->slug) }}" target="_blank" style="color: inherit; text-decoration: none;" class="hover-primary">
                                                {{ $template->name }}
                                            </a>
                                        </h4>
                                        @if($template->is_premium)
                                            <span style="background: linear-gradient(135deg, rgba(26, 123, 69, 0.12), rgba(26, 123, 69, 0.05)); color: #1a7b45; font-size: 11px; padding: 3px 9px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; flex-shrink: 0; border: 1px solid rgba(26, 123, 69, 0.15);">
                                                <i class="fas fa-gem" style="font-size: 10px;"></i>Premium
                                            </span>
                                        @else
                                            <span style="background: #f1f5f9; color: #64748b; font-size: 11px; padding: 3px 9px; border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; flex-shrink: 0;">
                                                Free
                                            </span>
                                        @endif
                                    </div>

                                    <p style="color: #64748b; font-size: 13.5px; margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px;">
                                        {{ $template->description }}
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-1.5" style="min-width: 0;">
                                            <span style="font-size: 11.5px; color: #94a3b8; background: #f8fafc; padding: 2px 8px; border-radius: 4px; display: inline-block; white-space: nowrap;" class="text-truncate">
                                                <i class="fas fa-tag me-1"></i>{{ $evtName }}
                                            </span>
                                            @if($themeCat)
                                                <span style="font-size: 11.5px; color: #1a7b45; background: rgba(26, 123, 69, 0.06); padding: 2px 8px; border-radius: 4px; display: inline-block; white-space: nowrap; font-weight: 500;" class="text-truncate">
                                                    <i class="fas fa-palette me-1"></i>{{ $themeCat }}
                                                </span>
                                            @endif
                                        </div>
                                        <a href="{{ route('templates.preview', $template->slug) }}" target="_blank" class="vs-btn" 
                                           style="padding: 7px 18px; font-size: 12px; line-height: 1.5; border-radius: 30px; font-weight: 600; text-transform: none; letter-spacing: 0.5px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(26, 123, 69, 0.15);">
                                            Preview
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                <div id="empty-state" class="row justify-content-center py-5" style="display: none;">
                    <div class="col-md-6 text-center">
                        <div class="mb-4" style="font-size: 60px; color: #cbd5e1;">
                            <i class="fas fa-search-minus"></i>
                        </div>
                        <h4 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #475569;">Template Tidak Ditemukan</h4>
                        <p style="color: #94a3b8;">Kami tidak menemukan template yang cocok dengan filter atau kata kunci pencarian Anda. Silakan coba filter atau kata kunci lainnya.</p>
                        <button id="reset-filters" class="vs-btn mt-3" style="padding: 10px 25px; border-radius: 30px;">Reset Filter</button>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <p style="color: #94a3b8; font-size: 16px;">Belum ada template tersedia saat ini.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Custom Styling & JavaScript Filters -->
    <style>
        .filter-btn {
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            padding: 10px 22px;
            border-radius: 30px;
            color: #4a5568;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
            font-family: 'Poppins', sans-serif;
        }
        .filter-btn i {
            font-size: 13px;
            opacity: 0.8;
        }
        .filter-btn:hover {
            border-color: #1a7b45;
            color: #1a7b45;
            transform: translateY(-2px);
        }
        .filter-btn.active {
            background: #1a7b45;
            color: #ffffff;
            border-color: #1a7b45;
            box-shadow: 0 8px 20px rgba(26, 123, 69, 0.25);
        }

        .sub-filter-btn {
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            padding: 6px 16px;
            border-radius: 20px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }
        .sub-filter-btn:hover {
            border-color: #1a7b45;
            color: #1a7b45;
            background: #ffffff;
        }
        .sub-filter-btn.active {
            background: rgba(26, 123, 69, 0.08);
            color: #1a7b45;
            border-color: #1a7b45;
            box-shadow: 0 2px 6px rgba(26, 123, 69, 0.05);
        }

        .template-list-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(26, 123, 69, 0.08) !important;
            border-color: rgba(26, 123, 69, 0.2) !important;
        }
        .template-list-item:hover .template-thumb {
            transform: scale(1.06);
        }
        .hover-primary {
            transition: color 0.2s ease;
        }
        .hover-primary:hover {
            color: #1a7b45 !important;
        }

        #search-input:focus {
            border-color: #1a7b45 !important;
            box-shadow: 0 0 0 3px rgba(26, 123, 69, 0.15) !important;
        }

        /* Subtle enter animation */
        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(15px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .template-card.show {
            animation: cardFadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const clearSearchBtn = document.getElementById('clear-search');
            const filterBtns = document.querySelectorAll('.filter-btn');
            const subFilterBtns = document.querySelectorAll('.sub-filter-btn');
            const subThemeWrapper = document.getElementById('sub-theme-wrapper');
            const templateCards = document.querySelectorAll('.template-card');
            const emptyState = document.getElementById('empty-state');
            const resetFiltersBtn = document.getElementById('reset-filters');
            const templatesGrid = document.getElementById('templates-grid');

            let activeMainFilter = 'all';
            let activeSubFilter = 'all';
            let searchKeyword = '';

            // Initial setup - make cards show with animation class
            templateCards.forEach(card => card.classList.add('show'));

            // Search input handler
            searchInput.addEventListener('input', function(e) {
                searchKeyword = e.target.value.toLowerCase().trim();
                
                if (searchKeyword.length > 0) {
                    clearSearchBtn.style.display = 'block';
                } else {
                    clearSearchBtn.style.display = 'none';
                }
                
                applyFilters();
            });

            // Clear search button handler
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchKeyword = '';
                clearSearchBtn.style.display = 'none';
                searchInput.focus();
                applyFilters();
            });

            // Main event category filter handler
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.remove('animate__fadeInUp'); // Remove WOW class if any
                    this.classList.add('active');
                    
                    activeMainFilter = this.getAttribute('data-filter');
                    
                    // Reset sub-theme filter when switching main category
                    activeSubFilter = 'all';
                    subFilterBtns.forEach(sb => {
                        sb.classList.remove('active');
                        if(sb.getAttribute('data-subfilter') === 'all') {
                            sb.classList.add('active');
                        }
                    });

                    // Show sub-theme filter ONLY when "Semua Acara" or "Pernikahan" is selected
                    if (activeMainFilter === 'all' || activeMainFilter === 'Pernikahan') {
                        fadeIn(subThemeWrapper);
                    } else {
                        fadeOut(subThemeWrapper);
                    }

                    applyFilters();
                });
            });

            // Sub-theme filter handler
            subFilterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    subFilterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    activeSubFilter = this.getAttribute('data-subfilter');
                    applyFilters();
                });
            });

            // Reset filters handler
            resetFiltersBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchKeyword = '';
                clearSearchBtn.style.display = 'none';
                
                filterBtns.forEach(b => b.classList.remove('active'));
                const allBtn = Array.from(filterBtns).find(b => b.getAttribute('data-filter') === 'all');
                if(allBtn) allBtn.classList.add('active');
                
                activeMainFilter = 'all';
                activeSubFilter = 'all';
                
                subFilterBtns.forEach(b => b.classList.remove('active'));
                const subAllBtn = Array.from(subFilterBtns).find(b => b.getAttribute('data-subfilter') === 'all');
                if(subAllBtn) subAllBtn.classList.add('active');
                
                fadeOut(subThemeWrapper);
                applyFilters();
            });

            // Filter logic executor
            function applyFilters() {
                let matchCount = 0;

                templateCards.forEach(card => {
                    const eventType = card.getAttribute('data-event-type');
                    const theme = card.getAttribute('data-theme');
                    const name = card.getAttribute('data-name');
                    const desc = card.getAttribute('data-desc');

                    // 1. Check main event type filter
                    const matchesMain = (activeMainFilter === 'all' || eventType === activeMainFilter);

                    // 2. Check sub-theme filter (relevant for Pernikahan)
                    const matchesSub = (activeSubFilter === 'all' || theme === activeSubFilter);

                    // 3. Check search query keyword
                    const matchesSearch = (searchKeyword === '' || name.includes(searchKeyword) || desc.includes(searchKeyword) || theme.toLowerCase().includes(searchKeyword));

                    if (matchesMain && matchesSub && matchesSearch) {
                        card.style.display = 'block';
                        // Trigger CSS animation reflow
                        card.classList.remove('show');
                        void card.offsetWidth; 
                        card.classList.add('show');
                        matchCount++;
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('show');
                    }
                });

                // Handle Empty State visibility
                if (matchCount === 0) {
                    emptyState.style.display = 'block';
                    templatesGrid.style.display = 'none';
                } else {
                    emptyState.style.display = 'none';
                    templatesGrid.style.display = 'flex';
                }
            }

            // Animation helper functions
            function fadeIn(element) {
                if (element.style.display === 'none' || element.style.display === '') {
                    element.style.opacity = 0;
                    element.style.display = 'block';
                    element.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    element.style.transform = 'translateY(-10px)';
                    // Trigger reflow
                    void element.offsetWidth;
                    element.style.opacity = 1;
                    element.style.transform = 'translateY(0)';
                }
            }

            function fadeOut(element) {
                if (element.style.display !== 'none' && element.style.display !== '') {
                    element.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                    element.style.opacity = 0;
                    element.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        element.style.display = 'none';
                    }, 200);
                }
            }
        });
    </script>

@endsection
