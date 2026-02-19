@extends('layouts.app')

@section('title', 'Home - Akhlaq Enterprises')

@section('content')
    <!-- Hero Slider Section -->
    <div id="hero-slider" class="relative bg-slate-900 h-[700px] overflow-hidden group">
        <!-- Slides Container -->
        <div class="absolute inset-0 transition-transform duration-700 ease-in-out h-full" id="slider-track">
            
            <!-- Slide 1 -->
            <div class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-100" data-slide="0">
                <img src="{{ asset('images/hero.webp') }}" class="w-full h-full object-cover opacity-60 scale-105 animate-slow-zoom" alt="Ocean Trawler" loading="eager" fetchpriority="high">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-black/30"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                    <div class="max-w-5xl mx-auto transform transition-all duration-1000 translate-y-0 opacity-100">
                        <span class="inline-block py-1 px-4 rounded-full bg-blue-600/80 border border-blue-400/50 text-white text-sm font-bold tracking-widest mb-6 backdrop-blur-sm uppercase">Global Exporters</span>
                        <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold text-white tracking-tight mb-8 leading-tight drop-shadow-2xl">
                            Freshness from the Ocean,<br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-cyan-400">Delivered to the World</span>
                        </h1>
                        <p class="text-xl md:text-2xl text-slate-200 mb-10 max-w-3xl mx-auto leading-relaxed">
                            Pioneering sustainable seafood export with unmatched quality and reliability since 2000.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-5 justify-center">
                            <a href="{{ route('products.index') }}" class="px-8 py-4 bg-blue-600 text-white rounded-full font-bold shadow-lg hover:bg-blue-700 hover:shadow-blue-600/40 transition-all transform hover:-translate-y-1 hover:scale-105 border border-transparent">
                                Explore Our Products
                            </a>
                            <a href="{{ route('contact') }}" class="px-8 py-4 bg-transparent border-2 border-white/80 text-white rounded-full font-bold hover:bg-white hover:text-slate-900 transition-all transform hover:-translate-y-1 backdrop-blur-sm">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 opacity-0" data-slide="1">
                <img src="{{ asset('images/fresh-display.webp') }}" class="w-full h-full object-cover opacity-60 scale-105" alt="Fresh Seafood Display" loading="lazy">
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
                <img src="{{ asset('images/processing.webp') }}" class="w-full h-full object-cover opacity-60 scale-105" alt="Processing Facility" loading="lazy">
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
                <h2 class="text-4xl font-extrabold text-slate-900 dark:text-white mt-2 mb-4">Why Choose Akhlaq Enterprises?</h2>
                <div class="w-24 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-400 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] dark:shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 dark:border-slate-700 group">
                    <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Freshness Guaranteed</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        Our rapid logistics and immediate processing ensure that the ocean's freshness is locked in from the moment of catch to delivery.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] dark:shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 dark:border-slate-700 group">
                    <div class="w-16 h-16 bg-cyan-50 dark:bg-cyan-900/30 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-cyan-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Global Standards</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        Compliant with international food safety regulations including HACCP, ISO, and EU standards, ensuring risk-free global trade.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] dark:shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-slate-100 dark:border-slate-700 group">
                    <div class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-emerald-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Premium Quality</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        We don't just sell seafood; we sell an experience. Strict quality control means you only get the best, every single time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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

    <!-- Featured Products Preview with Video Background -->
    <section class="relative py-32 overflow-hidden">
        <!-- Background Video (loaded after page interactive via JS) -->
        <div class="absolute inset-0 z-0">
            <video id="featured-video" muted loop playsinline class="w-full h-full object-cover" style="background:#0f172a" preload="none">
                <source data-src="{{ asset('videos/featured-bg.mp4') }}" type="video/mp4">
            </video>
            <!-- Lighter Overlay for better visibility -->
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
                    <span class="inline-block py-1 px-3 rounded-lg bg-blue-500/20 text-blue-400 text-xs font-black tracking-widest uppercase mb-4 border border-blue-500/30">Harvest of the Day</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-4 tracking-tighter">Our Featured Products</h2>
                    <p class="text-slate-400 text-lg max-w-xl font-medium">Exceptional quality seafood selected for global export standards.</p>
                </div>
                <a href="{{ route('products.index') }}" class="group flex items-center gap-3 px-8 py-4 bg-white/10 hover:bg-white text-white hover:text-slate-900 rounded-2xl font-bold border border-white/20 transition-all duration-300 backdrop-blur-md">
                    Explore Full Catalog 
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $item)
                <!-- Product Card -->
                <div class="group bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 overflow-hidden hover:bg-white transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/20 hover:-translate-y-3">
                    <div class="h-64 relative overflow-hidden m-4 rounded-[2rem] bg-white flex items-center justify-center p-6">
                        <img src="{{ asset($item->image) }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-700" alt="{{ $item->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="p-8 pt-2">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-black text-2xl text-white group-hover:text-slate-900 transition-colors tracking-tight">{{ $item->name }}</h3>
                        </div>
                        <p class="text-slate-400 group-hover:text-slate-600 text-base mb-6 font-medium leading-relaxed line-clamp-2">
                             {{ $item->description }}
                        </p>
                        <a href="{{ route('products.show', $item->slug) }}" class="inline-flex items-center text-blue-400 group-hover:text-blue-600 font-black text-sm uppercase tracking-widest">
                            Details <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-20 text-center md:hidden">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-500/30">
                    See More Selections <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Excellence Process -->
    <section class="py-24 bg-white dark:bg-slate-800/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <span class="text-blue-600 dark:text-blue-400 font-bold tracking-[0.3em] uppercase text-xs">Uncompromising Standards</span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mt-4 mb-6 tracking-tighter text-balance">The Akhlaq Quality Lifecycle</h2>
                <p class="text-slate-500 dark:text-slate-300 text-lg max-w-2xl mx-auto">From the deep blue Arabian Sea to markets across the globe, we ensure every step maintains the highest standards of seafood.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative">
                <div class="hidden md:block absolute top-1/4 left-0 w-full h-px bg-slate-100 dark:bg-slate-700 z-0"></div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl shadow-blue-500/30 group-hover:rotate-12 transition-transform duration-500">01</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">Fresh Catch</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">Direct sourcing from verified local vessels at the Karachi Fish Harbour.</p>
                </div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-slate-900 dark:bg-slate-700 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl group-hover:rotate-12 transition-transform duration-500">02</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">Sort & Inspect</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">Stringent quality grading by experts to ensure only premium grade products move forward.</p>
                </div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl shadow-blue-500/30 group-hover:rotate-12 transition-transform duration-500">03</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">Flash Frozen</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">Rapid blast freezing at -40°C to lock in nutrients and natural flavor.</p>
                </div>

                <div class="relative z-10 text-center group">
                    <div class="w-20 h-20 bg-slate-900 dark:bg-slate-700 rounded-3xl flex items-center justify-center text-white text-2xl font-black mx-auto mb-8 shadow-xl group-hover:rotate-12 transition-transform duration-500">04</div>
                    <h3 class="font-bold text-xl text-slate-900 dark:text-white mb-3">Global Export</h3>
                    <p class="text-slate-500 dark:text-slate-300 text-sm leading-relaxed px-4">Seamless cold-chain logistics ensures safe arrival at any port worldwide.</p>
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
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Years Experience</span>
                </div>
                <div class="p-8 border-l border-slate-800">
                    <span class="block text-5xl md:text-6xl font-black text-white mb-2">40+</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Global Destinations</span>
                </div>
                <div class="p-8 border-l border-slate-800">
                    <span class="block text-5xl md:text-6xl font-black text-blue-500 mb-2">15k</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Tons Shipped</span>
                </div>
                <div class="p-8 border-l border-slate-800">
                    <span class="block text-5xl md:text-6xl font-black text-white mb-2">100%</span>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Quality Compliance</span>
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
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tighter leading-none">Partner with the<br><span class="text-blue-500">Industry Leaders.</span></h2>
                    <p class="text-slate-400 text-xl max-w-lg font-medium">Get a customized quote for your bulk seafood requirements today. We provide worldwide shipping with guaranteed freshness. </p>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('contact') }}" class="group relative inline-flex items-center gap-4 px-12 py-6 bg-blue-600 text-white font-extrabold text-xl rounded-2xl shadow-2xl shadow-blue-600/40 hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:-translate-y-2">
                        Get Started Now
                        <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
