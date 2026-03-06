@extends('layouts.app')

@section('title', 'Home - Akhlaq Enterprises')

@section('content')
    <!-- Hero Slider Section -->
    <div id="hero-slider" class="relative bg-slate-900 h-[700px] overflow-hidden group">
        <!-- Slides Container -->
        <div class="absolute inset-0 transition-transform duration-700 ease-in-out h-full" id="slider-track">
            
            <!-- Slide 1 -->
            <div class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100" data-slide="0">
                <img src="{{ asset('images/hero.webp') }}" class="w-full h-full object-cover opacity-60 scale-105 animate-slow-zoom" alt="Ocean Trawler" width="1920" height="700" fetchpriority="high">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-black/30"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                    <div class="max-w-5xl mx-auto transform transition-all duration-1000 translate-y-0 opacity-100">
                        <span class="inline-block py-1 px-4 rounded-full bg-blue-600/80 border border-blue-400/50 text-white text-sm font-bold tracking-widest mb-6 backdrop-blur-sm uppercase">Global Exporters</span>
                        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight drop-shadow-2xl">
                            {{ __('common.hero_title') }}
                        </h1>
                        <p class="text-xl md:text-2xl text-slate-200 mb-10 max-w-3xl mx-auto leading-relaxed">
                            {{ __('common.hero_subtitle') }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-5 justify-center">
                            <a href="{{ route('products.index') }}" class="px-8 py-4 bg-blue-600 text-white rounded-full font-bold shadow-lg hover:bg-blue-700 hover:shadow-blue-600/40 transition-all transform hover:-translate-y-1 hover:scale-105 border border-transparent">
                                {{ __('common.explore_products') }}
                            </a>
                            <a href="{{ route('contact') }}" class="px-8 py-4 bg-transparent border-2 border-white/80 text-white rounded-full font-bold hover:bg-white hover:text-slate-900 transition-all transform hover:-translate-y-1 backdrop-blur-sm">
                                {{ __('common.contact_us') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" data-slide="1">
                <img data-src="{{ asset('images/fresh-display.webp') }}" class="w-full h-full object-cover opacity-60 scale-105 lazy-slider" alt="Fresh Seafood Display" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-black/30"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                    <div class="max-w-5xl mx-auto transform transition-all duration-1000 translate-y-10 opacity-0 relative z-10">
                        <span class="inline-block py-1 px-4 rounded-full bg-cyan-600/80 border border-cyan-400/50 text-white text-sm font-bold tracking-widest mb-6 backdrop-blur-sm uppercase">Premium Quality</span>
                        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight drop-shadow-2xl">
                            The Finest Catch for<br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-200 to-white">Culinary Excellence</span>
                        </h1>
                        <p class="text-xl md:text-2xl text-slate-200 mb-10 max-w-3xl mx-auto leading-relaxed">
                            Hand-picked premium selection of fish, shrimp, and crab for the world's best kitchens.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-5 justify-center">
                             <a href="{{ route('products.index') }}" class="px-8 py-4 bg-cyan-600 text-white rounded-full font-bold shadow-lg hover:bg-cyan-700 hover:shadow-cyan-600/40 transition-all transform hover:-translate-y-1 hover:scale-105 border border-transparent">
                                View Catalog
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" data-slide="2">
                <img data-src="{{ asset('images/processing.webp') }}" class="w-full h-full object-cover opacity-60 scale-105 lazy-slider" alt="Processing Facility" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-black/30"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                    <div class="max-w-5xl mx-auto transform transition-all duration-1000 translate-y-10 opacity-0 relative z-10">
                        <span class="inline-block py-1 px-4 rounded-full bg-emerald-600/80 border border-emerald-400/50 text-white text-sm font-bold tracking-widest mb-6 backdrop-blur-sm uppercase">Hygiene & Safety</span>
                        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight drop-shadow-2xl">
                            World-Class Processing<br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-white">Standards</span>
                        </h1>
                        <p class="text-xl md:text-2xl text-slate-200 mb-10 max-w-3xl mx-auto leading-relaxed">
                            HACCP and ISO certified facilities ensuring safety from the source to your plate.
                        </p>
                         <div class="flex flex-col sm:flex-row gap-5 justify-center">
                             <a href="{{ route('about') }}" class="px-8 py-4 bg-emerald-600 text-white rounded-full font-bold shadow-lg hover:bg-emerald-700 hover:shadow-emerald-600/40 transition-all transform hover:-translate-y-1 hover:scale-105 border border-transparent">
                                Learn About Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Slider Controls -->
        <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-md p-3 rounded-full text-white transition-all opacity-0 group-hover:opacity-100 z-20">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-md p-3 rounded-full text-white transition-all opacity-0 group-hover:opacity-100 z-20">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-20">
            <button class="w-3 h-3 rounded-full bg-white transition-all scale-125 shadow-lg shadow-white/50" data-indicator="0"></button>
            <button class="w-3 h-3 rounded-full bg-white/40 hover:bg-white/80 transition-all" data-indicator="1"></button>
            <button class="w-3 h-3 rounded-full bg-white/40 hover:bg-white/80 transition-all" data-indicator="2"></button>
        </div>
    </div>

    <!-- Features Section - Reimagined -->
    <section class="py-24 bg-white dark:bg-slate-800/50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-50 dark:bg-slate-900/50 -skew-x-12 translate-x-32 z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20">
                <span class="text-blue-600 dark:text-blue-400 font-bold tracking-wider uppercase text-sm">Why We Are Leads</span>
                <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white mt-2 mb-4">{{ __('common.why_choose') }}</h2>
                <div class="w-24 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-400 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] dark:shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 dark:border-slate-700 group">
                    <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ __('common.freshness_guaranteed') }}</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ __('common.freshness_desc') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] dark:shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 dark:border-slate-700 group">
                    <div class="w-16 h-16 bg-cyan-50 dark:bg-cyan-900/30 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-cyan-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ __('common.global_standards') }}</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ __('common.global_standards_desc') }}
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] dark:shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 dark:border-slate-700 group">
                    <div class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-emerald-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ __('common.premium_quality') }}</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        {{ __('common.premium_quality_desc') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partner / Certification Logos -->
    <section class="py-16 bg-slate-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-16 grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                <div class="flex flex-col items-center gap-4 group/logo">
                    <div class="w-24 h-16 bg-[#003399] rounded-lg flex items-center justify-center shadow-xl transition-transform group-hover/logo:scale-110">
                        <svg viewBox="0 0 120 80" class="w-full h-full p-2">
                            <rect width="120" height="80" fill="#003399" rx="4"/>
                            <g transform="translate(60,40)">
                                @for($i = 0; $i < 12; $i++)
                                    <path d="M0,-24 L1.5,-19 L6.5,-19 L2.5,-16 L4,-11 L0,-14 L-4,-11 L-2.5,-16 L-6.5,-19 L-1.5,-19 Z" fill="#FFCC00" transform="rotate({{ $i * 30 }})" />
                                @endfor
                            </g>
                        </svg>
                    </div>
                    <span class="text-xs font-bold tracking-[0.2em] text-slate-500 uppercase">EU</span>
                </div>
                <div class="flex flex-col items-center gap-4 group/logo">
                    <div class="w-24 h-16 bg-[#012169] rounded-lg flex items-center justify-center shadow-xl overflow-hidden transition-transform group-hover/logo:scale-110">
                        <svg viewBox="0 0 60 30" class="w-full h-full">
                            <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
                            <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                            <path d="M0,0 L60,30 M60,0 L0,30" stroke="#C8102E" stroke-width="4"/>
                            <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
                            <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold tracking-[0.2em] text-slate-500 uppercase">UK</span>
                </div>
                <div class="flex flex-col items-center gap-4 group/logo">
                    <div class="w-24 h-16 rounded-lg flex items-center justify-center shadow-xl overflow-hidden transition-transform group-hover/logo:scale-110 bg-white dark:bg-slate-700 p-1">
                        <img src="{{ asset('images/about-partner-logo.png') }}" alt="SFDA" class="w-full h-full object-contain" width="96" height="64" loading="lazy">
                    </div>
                    <span class="text-xs font-bold tracking-[0.2em] text-slate-500 uppercase">SFDA</span>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Lazy load slider images
            setTimeout(() => {
                document.querySelectorAll('.lazy-slider[data-src]').forEach(img => {
                    img.src = img.getAttribute('data-src');
                    img.removeAttribute('data-src');
                });
            }, 100);

            const slides = document.querySelectorAll('[data-slide]');
            const indicators = document.querySelectorAll('[data-indicator]');
            const prevBtn = document.getElementById('prev-slide');
            const nextBtn = document.getElementById('next-slide');
            let currentSlide = 0;
            const totalSlides = slides.length;
            let slideInterval;

            function showSlide(index) {
                // Wrap around
                if (index >= totalSlides) index = 0;
                if (index < 0) index = totalSlides - 1;
                
                currentSlide = index;

                // Update slides
                slides.forEach((slide, i) => {
                    if (i === currentSlide) {
                        slide.classList.remove('opacity-0');
                        slide.classList.add('opacity-100', 'z-10');
                        
                        // Animate text content
                        const content = slide.querySelector('div.max-w-5xl');
                        content.classList.remove('translate-y-10', 'opacity-0');
                        content.classList.add('translate-y-0', 'opacity-100');
                    } else {
                        slide.classList.remove('opacity-100', 'z-10');
                        slide.classList.add('opacity-0', 'z-0');
                        
                        // Reset text animation for next time
                        const content = slide.querySelector('div.max-w-5xl');
                        content.classList.remove('translate-y-0', 'opacity-100');
                        content.classList.add('translate-y-10', 'opacity-0');
                    }
                });

                // Update indicators
                indicators.forEach((indicator, i) => {
                    if (i === currentSlide) {
                        indicator.classList.remove('bg-white/40');
                        indicator.classList.add('bg-white', 'scale-125', 'shadow-lg');
                    } else {
                        indicator.classList.add('bg-white/40');
                        indicator.classList.remove('bg-white', 'scale-125', 'shadow-lg');
                    }
                });
            }

            function nextSlide() {
                showSlide(currentSlide + 1);
            }
            
            function stopAutoSlide() {
                clearInterval(slideInterval);
            }
            
            function startAutoSlide() {
                 slideInterval = setInterval(nextSlide, 5000);
            }

            // Event Listeners
            nextBtn.addEventListener('click', () => {
                stopAutoSlide();
                nextSlide();
                startAutoSlide();
            });

            prevBtn.addEventListener('click', () => {
                stopAutoSlide();
                showSlide(currentSlide - 1);
                startAutoSlide();
            });
            
            indicators.forEach((ind, i) => {
                ind.addEventListener('click', () => {
                    stopAutoSlide();
                    showSlide(i);
                    startAutoSlide();
                });
            });

            // Initialize
            startAutoSlide();
            
            // Add custom animation style for slow zoom effect if not present
            if (!document.getElementById('custom-animations')) {
                const style = document.createElement('style');
                style.id = 'custom-animations';
                style.innerHTML = `
                    @keyframes slow-zoom {
                        0% { transform: scale(1); }
                        100% { transform: scale(1.1); }
                    }
                    .animate-slow-zoom {
                        animation: slow-zoom 20s infinite alternate;
                    }
                `;
                document.head.appendChild(style);
            }
        });
    </script>

    <!-- Featured Categories with Video Background -->
    <section class="relative py-32 overflow-hidden">
        <!-- Background Video (loaded after page interactive via JS) -->
        <div class="absolute inset-0 z-0">
            <video id="featured-video" muted loop playsinline class="w-full h-full object-cover" style="background:#0f172a" preload="none">
                <source data-src="{{ asset('videos/featured-bg.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/70 via-slate-900/40 to-slate-900/60"></div>
        </div>
        <script>
            (function() {
                function loadFeaturedVideo() {
                    var v = document.getElementById('featured-video');
                    if (!v) return;
                    var s = v.querySelector('source[data-src]');
                    if (s) { s.src = s.getAttribute('data-src'); s.removeAttribute('data-src'); }
                    v.load(); v.play().catch(function(){});
                }
                if (document.readyState === 'complete') { loadFeaturedVideo(); }
                else { window.addEventListener('load', loadFeaturedVideo); }
            })();
        </script>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-16 gap-6">
                <div class="text-center md:text-left">
                    <span class="inline-block py-1 px-3 rounded-lg bg-blue-500/20 text-blue-400 text-xs font-black tracking-widest uppercase mb-4 border border-blue-500/30">Browse by Category</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tighter">{{ __('common.featured_categories') }}</h2>
                    <p class="text-slate-400 text-lg max-w-xl font-medium">{{ __('common.featured_subtitle') }}</p>
                </div>
                <a href="{{ route('products.index') }}" class="group flex items-center gap-3 px-8 py-4 bg-white/10 hover:bg-white text-white hover:text-slate-900 rounded-2xl font-bold border border-white/20 transition-all duration-300 backdrop-blur-md">
                    {{ __('common.explore_catalog') }}
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group block">
                    <div class="relative aspect-square rounded-2xl border-2 border-white/20 overflow-hidden transition-all duration-300 hover:border-white/50 hover:shadow-2xl hover:shadow-blue-500/20 hover:-translate-y-2 {{ $category->image ? '' : 'bg-slate-700' }}">
                        @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-500 ease-out group-hover:scale-110">
                        @else
                        <span class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-14 h-14 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                        </span>
                        @endif
                        <span class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/55 to-black/30 rounded-2xl"></span>
                        <span class="absolute inset-0 flex items-center justify-center p-4">
                            <span class="rounded-2xl border border-white/25 bg-black/65 px-5 py-2.5 text-center font-sans text-lg sm:text-xl font-semibold leading-snug tracking-wide text-white antialiased shadow-[0_4px_24px_rgba(0,0,0,0.4)] backdrop-blur-md transition-all duration-300 group-hover:border-white/40 group-hover:bg-black/75 group-hover:text-blue-50 group-hover:shadow-[0_8px_32px_rgba(0,0,0,0.5)]" style="text-shadow: 0 0 1px rgba(0,0,0,0.9), 0 1px 3px rgba(0,0,0,0.95); -webkit-font-smoothing: antialiased;">{{ $category->name }}</span>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Excellence Process -->
    <section class="py-24 bg-white dark:bg-slate-800/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <span class="text-blue-600 dark:text-blue-400 font-bold tracking-[0.3em] uppercase text-xs">Uncompromising Standards</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mt-4 mb-6 tracking-tighter text-balance">{{ __('common.quality_lifecycle') }}</h2>
                <p class="text-slate-500 dark:text-slate-300 text-lg max-w-2xl mx-auto">{{ __('common.quality_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative">
                <div class="hidden md:block absolute top-1/4 left-0 w-full h-px bg-slate-100 dark:bg-slate-700 z-0"></div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl shadow-blue-500/30 group-hover:rotate-12 transition-transform duration-500">01</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">{{ __('common.fresh_catch') }}</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">{{ __('common.fresh_catch_desc') }}</p>
                </div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-slate-900 dark:bg-slate-700 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl group-hover:rotate-12 transition-transform duration-500">02</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">{{ __('common.sort_inspect') }}</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">{{ __('common.sort_inspect_desc') }}</p>
                </div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl shadow-blue-500/30 group-hover:rotate-12 transition-transform duration-500">03</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">{{ __('common.flash_frozen') }}</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">{{ __('common.flash_frozen_desc') }}</p>
                </div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-slate-900 dark:bg-slate-700 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl group-hover:rotate-12 transition-transform duration-500">04</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">{{ __('common.global_export') }}</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">{{ __('common.global_export_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="p-8">
                    <span class="block text-5xl md:text-6xl font-black text-blue-500 mb-2">25+</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">{{ __('common.years_experience') }}</span>
                </div>
                <div class="p-8 border-l border-slate-800">
                    <span class="block text-5xl md:text-6xl font-black text-white mb-2">40+</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">{{ __('common.global_destinations') }}</span>
                </div>
                <div class="p-8 border-l border-slate-800">
                    <span class="block text-5xl md:text-6xl font-black text-blue-500 mb-2">15k</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">{{ __('common.tons_shipped') }}</span>
                </div>
                <div class="p-8 border-l border-slate-800">
                    <span class="block text-5xl md:text-6xl font-black text-white mb-2">100%</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">{{ __('common.quality_compliance') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Dynamic Call to Action -->
    <section class="py-24 bg-blue-600 relative overflow-hidden group">
        <!-- Animated Background Rings -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-black/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="text-center md:text-left">
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tighter leading-none">{{ __('common.partner_with_us') }}</h2>
                    <p class="text-slate-400 text-xl max-w-lg font-medium">{{ __('common.partner_desc') }}</p>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('contact') }}" class="group relative inline-flex items-center gap-4 px-12 py-6 bg-blue-600 text-white font-extrabold text-xl rounded-2xl shadow-2xl shadow-blue-600/40 hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-2">
                        {{ __('common.get_started') }}
                        <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
