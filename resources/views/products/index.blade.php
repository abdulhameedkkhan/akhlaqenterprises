@extends('layouts.app')

@section('title', 'All Products - Akhlaq Enterprises')

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
        <!-- Main Background Video -->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover scale-105 group-hover:scale-100 transition-transform duration-[20s] ease-out">
            <source src="{{ asset('videos/products-bg.mp4') }}" type="video/mp4">
        </video>
        
        <!-- Premium Overlays -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/60 to-transparent"></div>
        <div class="absolute inset-0 bg-blue-900/10 backdrop-blur-[1px]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center">
            <div class="max-w-2xl space-y-6">
                <span class="inline-block py-1 px-4 rounded-lg bg-blue-600/30 text-blue-400 text-xs font-black tracking-[0.3em] uppercase border border-blue-500/30 animate-fade-in">Global Export Catalog</span>
                <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none animate-slide-up">
                    Sea-To-Table <br> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Excellence.</span>
                </h1>
                <p class="text-slate-400 text-lg md:text-xl font-medium leading-relaxed animate-fade-in transition-all duration-700">
                    Sourced directly from the Arabian Sea, processed with global hygiene standards, and shipped worldwide with total transparency.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Unified Premium Filter Bar -->
        <div class="bg-white/80 backdrop-blur-xl border border-slate-200 shadow-2xl rounded-[2rem] p-8 mb-12 transition-all hover:shadow-blue-500/10">
            <div class="flex flex-col lg:flex-row gap-8 items-center">
                <!-- Search Section -->
                <div class="w-full lg:w-1/3">
                    <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1">Find Seafood</label>
                    <div class="relative group">
                        <input type="text" id="search-input" 
                            placeholder="Search fresh catch..." 
                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-slate-700 placeholder:text-slate-400 font-semibold shadow-inner">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Divider (Desktop Only) -->
                <div class="hidden lg:block w-px h-16 bg-slate-200 mx-2"></div>

                <!-- Categories Section -->
                <div class="w-full lg:w-2/3 overflow-hidden">
                    <label class="block text-sm font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1">Categories</label>
                    <div class="flex items-center gap-3 overflow-x-auto pb-4 custom-scrollbar snap-x">
                        <!-- All Categories Pill -->
                        <label class="shrink-0 snap-start">
                            <input type="radio" name="category" value="all" checked class="hidden peer">
                            <div class="px-6 py-3 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-600 font-bold cursor-pointer transition-all hover:border-blue-200 peer-checked:bg-blue-600 peer-checked:border-blue-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-blue-600/30">
                                All Products
                            </div>
                        </label>

                        @foreach($categories as $category)
                        <label class="shrink-0 snap-start">
                            <input type="radio" name="category" value="{{ $category->id }}" class="hidden peer">
                            <div class="px-6 py-3 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-600 font-bold cursor-pointer transition-all hover:border-blue-200 peer-checked:bg-blue-600 peer-checked:border-blue-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-blue-600/30">
                                {{ $category->name }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid Area (Full Width) -->
        <div class="relative">
            <div id="loading-spinner" class="hidden absolute top-0 left-1/2 -translate-x-1/2 z-10 transition-all">
                <div class="bg-white/80 backdrop-blur-sm p-4 rounded-full shadow-xl border border-slate-100">
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
                        <span class="relative z-10">Load More Treasures</span>
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </div>
            @endif
            
            <div id="no-results" class="hidden text-center py-24 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-2">Ocean is empty for this criteria</h3>
                <p class="text-slate-500 text-lg">Try adjusting your filters or search terms.</p>
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
