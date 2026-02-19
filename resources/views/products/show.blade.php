@extends('layouts.app')

@section('title', $product->name . ' - Akhlaq Enterprises')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-slate-100 dark:bg-slate-800 pt-8 pb-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-slate-500 dark:text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Products</a>
            <span class="mx-2">/</span>
            <span class="text-slate-900 dark:text-white font-semibold">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Details -->
    <div class="py-12 bg-white dark:bg-slate-800/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Image Gallery -->
                <div class="space-y-6">
                    <div class="relative aspect-square bg-slate-50 dark:bg-slate-800 rounded-[2.5rem] overflow-hidden border border-slate-100 dark:border-slate-700 shadow-xl group/main">
                        <img src="{{ asset($product->image) }}" id="main-product-image" 
                             class="object-contain w-full h-full p-8 transition-all duration-700 ease-out transform group-hover/main:scale-110 active:scale-105 cursor-zoom-in"
                             alt="{{ $product->name }}" loading="eager" fetchpriority="high">
                        
                        <!-- Floating Controls -->
                        <div class="absolute bottom-6 right-6 flex gap-2">
                             <div class="bg-white/90 backdrop-blur-md p-3 rounded-2xl shadow-lg border border-slate-100 text-slate-800 opacity-0 group-hover/main:opacity-100 transition-opacity duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                             </div>
                        </div>
                    </div>
                    
                    @php
                        $galleryImages = collect($product->gallery ?? [])
                            ->filter(fn($img) => !empty(trim($img ?? '')) && file_exists(public_path($img)))
                            ->values();
                    @endphp
                    @if($galleryImages->count() > 0)
                    <div class="flex gap-4 px-2 overflow-x-auto pb-4 custom-scrollbar">
                        <!-- Main Thumbnail -->
                        <button class="shrink-0 w-24 h-24 rounded-2xl border-2 border-blue-600 p-2 bg-white shadow-md transition-all thumbnail-btn active-thumb" 
                                onclick="changeProductImage('{{ asset($product->image) }}', this)">
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-contain" loading="eager">
                        </button>
                        
                        @foreach($galleryImages as $img)
                        <button class="shrink-0 w-24 h-24 rounded-2xl border-2 border-transparent hover:border-blue-200 p-2 bg-white shadow-sm hover:shadow-md transition-all thumbnail-btn" 
                                onclick="changeProductImage('{{ asset($img) }}', this)">
                            <img src="{{ asset($img) }}" class="w-full h-full object-contain" loading="lazy">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                <script>
                    function changeProductImage(src, el) {
                        const mainImg = document.getElementById('main-product-image');
                        
                        // Fade out
                        mainImg.style.opacity = '0.3';
                        mainImg.style.transform = 'scale(0.95)';
                        
                        setTimeout(() => {
                            mainImg.src = src;
                            mainImg.style.opacity = '1';
                            mainImg.style.transform = 'scale(1)';
                        }, 200);

                        // Update Active State
                        document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                            btn.classList.remove('border-blue-600', 'shadow-md', 'active-thumb');
                            btn.classList.add('border-transparent', 'shadow-sm');
                        });
                        el.classList.add('border-blue-600', 'shadow-md', 'active-thumb');
                        el.classList.remove('border-transparent', 'shadow-sm');
                    }
                </script>

                <!-- Info -->
                <div class="flex flex-col">
                    <div class="mb-6">
                        <span class="inline-block py-1 px-3 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 text-xs font-bold tracking-wide uppercase mb-4">{{ $product->category->name }}</span>
                        <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">{{ $product->name }}</h1>
                        <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <div class="border-t border-b border-slate-100 dark:border-slate-700 py-6 mb-8">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4 text-lg">Product Specifications</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8">
                            @if($product->specifications && is_array($product->specifications))
                                @foreach($product->specifications as $key => $value)
                                    <div>
                                        <span class="block text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400 font-semibold">{{ $key }}</span>
                                        <span class="block text-slate-900 dark:text-white font-medium">{{ $value }}</span>
                                    </div>
                                @endforeach
                            @endif
                            <div>
                                <span class="block text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400 font-semibold">Availability</span>
                                <span class="block text-green-600 dark:text-green-400 font-medium">In Stock (Seasonal)</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <h3 class="font-bold text-slate-900 dark:text-white mb-4">Interested in this product?</h3>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('contact') }}" class="flex-1 bg-blue-600 text-white text-center font-bold py-4 px-8 rounded-xl shadow-lg hover:bg-blue-700 hover:shadow-blue-600/30 transition-all transform hover:-translate-y-0.5">
                                Request Quote
                            </a>
                            <a href="https://wa.me/923332394825?text=I'm interested in {{ urlencode($product->name) }}" target="_blank" class="flex-1 bg-green-500 text-white text-center font-bold py-4 px-8 rounded-xl shadow-lg hover:bg-green-600 hover:shadow-green-500/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-3.138-5.437-2.1-11.938 2.383-16.421 4.664-4.665 12.23-4.666 16.892 0 4.664 4.665 4.665 12.23 0 16.892-4.368 4.369-10.743 5.568-16.195 2.766L.057 24zm9.782-12.074c-1.35-1.928-2.614-2.735-3.003-2.854-.385-.12-1.011-.476-1.58.077-.92.894-1.218 2.023-.559 3.033.437.671 2.913 4.293 6.643 6.324 3.731 2.03 5.488 1.582 6.138 1.156.65-.426 1.428-1.579 1.62-2.316.19-.738.163-1.638-.19-1.815-.353-.177-2.073-1.023-2.39-1.173-.317-.15-.547-.225-.777.15-.23.375-.909 1.173-1.115 1.413-.207.24-.413.27-.766.094-.353-.176-1.49-.55-2.835-1.75l-.014-.012z"/></svg>
                                WhatsApp Inquiry
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="py-16 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-8">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden group hover:shadow-lg transition-all">
                        <div class="h-40 bg-slate-100 dark:bg-slate-700 relative overflow-hidden">
                             <img src="{{ asset($related->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="{{ $related->name }}" loading="lazy">
                        </div>
                        <div class="p-4">
                             <h3 class="font-bold text-slate-900 dark:text-white mb-1">
                                <a href="{{ route('products.show', $related->slug) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $related->name }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $related->category->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
