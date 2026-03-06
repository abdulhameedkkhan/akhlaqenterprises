@extends('layouts.app')

@section('title', __('products.page_title'))

@section('content')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    <!-- Premium Video Hero (Industry Specific) -->
    <div class="relative py-32 overflow-hidden group">
        <!-- Main Background Video (deferred load) -->
        <video id="products-video" muted loop playsinline class="absolute inset-0 w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[20s] ease-out" style="background:#0f172a" preload="none">
            <source data-src="{{ asset('videos/products-bg.mp4') }}" type="video/mp4">
        </video>
        <script>
            (function() {
                function loadProductsVideo() {
                    var v = document.getElementById('products-video');
                    if (!v) return;
                    var s = v.querySelector('source[data-src]');
                    if (s) { s.src = s.getAttribute('data-src'); s.removeAttribute('data-src'); }
                    v.load(); v.play().catch(function(){});
                }
                if (document.readyState === 'complete') { loadProductsVideo(); }
                else { window.addEventListener('load', loadProductsVideo); }
            })();
        </script>
        
        <!-- Premium Overlays -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/60 to-transparent"></div>
        <div class="absolute inset-0 bg-blue-900/10 backdrop-blur-[1px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center">
            <div class="max-w-2xl space-y-6">
                <span class="inline-block py-1 px-4 rounded-lg bg-blue-600/30 text-blue-400 text-xs font-black tracking-[0.3em] uppercase border border-blue-500/30 animate-fade-in">{{ __('products.catalog_badge') }}</span>
                <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none animate-slide-up">
                    {{ __('products.hero_title') }}<br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">{{ __('products.excellence') }}</span>
                </h1>
                <p class="text-slate-400 text-lg md:text-xl font-medium leading-relaxed animate-fade-in transition-all duration-700">
                    {{ __('products.hero_subtitle') }}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Unified Premium Filter Bar -->
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl border border-slate-200 dark:border-slate-700 shadow-2xl rounded-[2rem] p-8 mb-12 transition-all hover:shadow-blue-500/10">
            <!-- Search Section -->
            <div class="mb-10">
                <label class="block text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 ml-1">{{ __('products.find_seafood') }}</label>
                <div class="relative group max-w-xl">
                    <input type="text" id="search-input" 
                        placeholder="{{ __('products.search_placeholder') }}" 
                        class="w-full pl-12 pr-4 py-4 bg-slate-50 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 border-2 border-slate-100 dark:border-slate-600 rounded-2xl focus:bg-white dark:focus:bg-slate-600 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-slate-700 placeholder:text-slate-400 font-semibold shadow-inner">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Categories (horizontal scroll, image as background, text on top) -->
            <label class="block text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-4 ml-1">{{ __('products.categories_label') }}</label>
            <div class="flex items-center gap-3 overflow-x-auto pb-4 custom-scrollbar snap-x snap-mandatory">
                <label class="shrink-0 snap-start cursor-pointer block">
                    <input type="radio" name="category" value="all" checked class="hidden peer">
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-xl border-2 border-slate-200 dark:border-slate-600 bg-slate-200 dark:bg-slate-600 overflow-hidden transition-all hover:border-blue-200 hover:shadow-lg hover:scale-[1.02] peer-checked:border-blue-600 peer-checked:shadow-xl peer-checked:shadow-blue-600/30 peer-checked:ring-4 peer-checked:ring-blue-400/30">
                        <span class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        </span>
                        <span class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent rounded-xl"></span>
                        <span class="absolute inset-0 flex items-center justify-center p-1.5">
                            <span class="rounded-xl border border-white/20 bg-black/65 px-2.5 py-1 text-center font-sans text-xs sm:text-sm font-semibold leading-snug tracking-wide text-white antialiased shadow-[0_2px_12px_rgba(0,0,0,0.45)] backdrop-blur-md" style="text-shadow: 0 0 1px rgba(0,0,0,0.8), 0 1px 2px rgba(0,0,0,0.9); -webkit-font-smoothing: antialiased;">{{ __('products.all_products') }}</span>
                        </span>
                    </div>
                </label>

                @foreach($categories as $category)
                <label class="shrink-0 snap-start cursor-pointer block">
                    <input type="radio" name="category" value="{{ $category->id }}" class="hidden peer">
                    <div class="relative w-24 h-24 sm:w-28 sm:h-28 rounded-xl border-2 border-slate-200 dark:border-slate-600 overflow-hidden transition-all hover:border-blue-200 hover:shadow-lg hover:scale-[1.02] peer-checked:border-blue-600 peer-checked:shadow-xl peer-checked:shadow-blue-600/30 peer-checked:ring-4 peer-checked:ring-blue-400/30 {{ $category->image ? '' : 'bg-slate-200 dark:bg-slate-600' }}">
                        @if($category->image)
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover object-center">
                        @else
                        <span class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                        </span>
                        @endif
                        <span class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent rounded-xl"></span>
                        <span class="absolute inset-0 flex items-center justify-center p-1.5">
                            <span class="rounded-xl border border-white/20 bg-black/65 px-2.5 py-1 text-center font-sans text-xs sm:text-sm font-semibold leading-snug tracking-wide text-white antialiased shadow-[0_2px_12px_rgba(0,0,0,0.45)] backdrop-blur-md peer-checked:border-blue-400/40 peer-checked:bg-black/75" style="text-shadow: 0 0 1px rgba(0,0,0,0.8), 0 1px 2px rgba(0,0,0,0.9); -webkit-font-smoothing: antialiased;">{{ $category->name }}</span>
                        </span>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Product Grid Area (Full Width) -->
        <div class="relative">
            <div id="loading-spinner" class="hidden absolute top-0 left-1/2 -translate-x-1/2 z-10 transition-all">
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm p-4 rounded-full shadow-xl border border-slate-100 dark:border-slate-700">
                    <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @include('products.partials.list')
            </div>

            <!-- Load More -->
            @if($products->hasMorePages())
                <div class="mt-20 text-center" id="load-more-container">
                    <button id="load-more-btn" data-next-url="{{ $products->nextPageUrl() }}" 
                        class="group relative inline-flex items-center gap-3 px-12 py-4 bg-slate-900 text-white font-bold rounded-2xl overflow-hidden transition-all hover:bg-blue-600 hover:shadow-2xl hover:shadow-blue-600/40">
                        <span class="relative z-10">{{ __('products.load_more') }}</span>
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </div>
            @endif
            
            <div id="no-results" class="hidden text-center py-24 bg-slate-50 dark:bg-slate-800 rounded-[3rem] border-2 border-dashed border-slate-200 dark:border-slate-700">
                <div class="w-24 h-24 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 dark:text-white mb-2">Ocean is empty for this criteria</h3>
                <p class="text-slate-500 dark:text-slate-400 text-lg">Try adjusting your filters or search terms.</p>
            </div>
        </div>
    </div>

    <!-- AJAX Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const categoryInputs = document.querySelectorAll('input[name="category"]');
            const productList = document.getElementById('product-list');
            const loadMoreContainer = document.getElementById('load-more-container');
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadingSpinner = document.getElementById('loading-spinner');
            const noResults = document.getElementById('no-results');

            let searchTimeout;
            let currentUrl = '{{ route("products.index") }}';

            function fetchProducts(url, append = false) {
                loadingSpinner.classList.remove('hidden');
                if (!append) {
                    productList.classList.add('opacity-50');
                }

                const params = new URLSearchParams();
                if (searchInput.value) params.append('search', searchInput.value);
                
                const selectedCategory = document.querySelector('input[name="category"]:checked').value;
                if (selectedCategory !== 'all') params.append('category', selectedCategory);

                // If handling load more, we use the provided full URL which already has page param,
                // but we need to merge current filters if they aren't there. 
                // However, the cleanest way for 'Load More' with filters is to rely on the controller returning the correct next_page_url with filters, 
                // OR we construct it manually. Laravel's paginate appends query params if we tell it to.
                // For simplicity here: Load More just grabs the next page for the *current* filter state.
                
                let fetchUrl = url;
                if (!url.includes('?')) {
                    fetchUrl = url + '?' + params.toString();
                } else if (!append) {
                    // Resetting filters means we are starting from page 1 usually
                     fetchUrl = currentUrl + '?' + params.toString();
                } else {
                    // Start of append (Load More). 
                    // Laravel pagination links usually don't carry extra params unless `appends` is used in Blade.
                    // But here we are doing AJAX.
                    // Let's just append current filters to the next_page_url if meaningful
                    if(searchInput.value) fetchUrl += '&search=' + encodeURIComponent(searchInput.value);
                    if(selectedCategory !== 'all') fetchUrl += '&category=' + encodeURIComponent(selectedCategory);
                }

                fetch(fetchUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (append) {
                        productList.insertAdjacentHTML('beforeend', data.html);
                    } else {
                        productList.innerHTML = data.html;
                        // Determine helper visibility
                        if (data.html.trim() === '') {
                             noResults.classList.remove('hidden');
                        } else {
                             noResults.classList.add('hidden');
                        }
                    }

                    if (data.next_page_url) {
                        loadMoreContainer.classList.remove('hidden');
                        loadMoreBtn.setAttribute('data-next-url', data.next_page_url);
                        loadMoreBtn.innerHTML = 'Load More';
                        loadMoreBtn.disabled = false;
                    } else {
                        loadMoreContainer.classList.add('hidden');
                    }
                })
                .catch(error => console.error('Error:', error))
                .finally(() => {
                    loadingSpinner.classList.add('hidden');
                    productList.classList.remove('opacity-50');
                });
            }

            // Search Filter
            searchInput.addEventListener('input', () => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    fetchProducts(currentUrl);
                }, 500);
            });

            // Category Filter
            categoryInputs.forEach(input => {
                input.addEventListener('change', () => {
                    fetchProducts(currentUrl);
                });
            });

            // Load More
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const nextUrl = this.getAttribute('data-next-url');
                    this.innerHTML = 'Loading...';
                    this.disabled = true;
                    fetchProducts(nextUrl, true);
                });
            }
        });
    </script>
@endsection
