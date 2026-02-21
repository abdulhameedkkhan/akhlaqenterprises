@extends('layouts.app')

@section('title', __('gallery.page_title'))

@section('content')
    <!-- Premium Header -->
    <div class="relative bg-slate-950 py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-600/20 rounded-full blur-[100px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block py-1 px-4 rounded-lg bg-blue-500/10 text-blue-400 text-xs font-black tracking-[0.3em] uppercase border border-blue-500/20 mb-6">{{ __('gallery.hero_title') }}</span>
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tighter leading-none mb-6">
                {{ __('gallery.hero_title') }}
            </h1>
            <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto font-medium leading-relaxed">
                {{ __('gallery.hero_subtitle') }}
            </p>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="bg-white dark:bg-slate-900 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Tabs -->
            <div class="flex flex-wrap justify-center gap-4 mb-20" id="gallery-filters">
                <button class="px-8 py-3 rounded-full font-bold transition-all border-2 border-slate-900 bg-slate-900 text-white shadow-xl shadow-slate-900/20 filter-btn active" data-category="all">
                    {{ __('gallery.show_all') }}
                </button>
                @foreach($galleryItems as $category => $items)
                    <button class="px-8 py-3 rounded-full font-bold transition-all border-2 border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:border-blue-200 filter-btn" data-category="{{ Str::slug($category) }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>

            <!-- Masonry Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
                @foreach($galleryItems as $category => $items)
                    @foreach($items as $item)
                        <div class="gallery-item group relative overflow-hidden rounded-[2rem] bg-slate-100 aspect-[4/3] transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/20" data-category="{{ Str::slug($category) }}">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" width="400" height="300" loading="lazy">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-x-0 bottom-0 p-8 translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 bg-gradient-to-t from-slate-950 via-slate-950/80 to-transparent">
                                <span class="text-blue-400 text-xs font-bold uppercase tracking-widest mb-2 block">{{ $category }}</span>
                                <h3 class="text-xl font-bold text-white mb-2">{{ $item->title }}</h3>
                                <p class="text-slate-300 text-sm leading-relaxed mb-4 line-clamp-2">
                                    {{ $item->description }}
                                </p>
                                <button class="flex items-center gap-2 text-white font-bold text-sm group/btn" onclick="openLightbox('{{ asset($item->image) }}', {{ json_encode($item->title) }})">
                                    {{ __('gallery.view_full_screen') }}
                                    <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

    <!-- Lightbox (Simplified) -->
    <div id="lightbox" class="fixed inset-0 z-[100] hidden bg-slate-950/95 backdrop-blur-xl flex items-center justify-center p-4">
        <button class="absolute top-10 right-10 text-white/50 hover:text-white transition-colors" onclick="closeLightbox()">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="max-w-5xl w-full">
            <img id="lightbox-img" src="" class="w-full h-auto rounded-3xl shadow-2xl border border-white/10">
            <h3 id="lightbox-title" class="text-white text-2xl font-bold mt-6 text-center"></h3>
        </div>
    </div>

    <script>
        // Filter Logic
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-slate-900', 'dark:bg-blue-600', 'text-white', 'shadow-xl', 'shadow-slate-900/20', 'active', 'border-slate-900');
                    b.classList.add('bg-slate-50', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300', 'border-slate-100', 'dark:border-slate-700');
                });
                btn.classList.add('bg-slate-900', 'text-white', 'shadow-xl', 'shadow-slate-900/20', 'active');
                btn.classList.remove('bg-slate-50', 'dark:bg-slate-800', 'text-slate-600', 'dark:text-slate-300', 'border-slate-100', 'dark:border-slate-700');

                const category = btn.dataset.category;
                
                galleryItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 10);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 500);
                    }
                });
            });
        });

        // Lightbox Logic
        function openLightbox(src, title) {
            const lb = document.getElementById('lightbox');
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-title').innerText = title;
            lb.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection
