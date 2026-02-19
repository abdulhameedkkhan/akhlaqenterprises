@foreach($products as $product)
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden group hover:shadow-xl dark:hover:shadow-slate-900/60 transition-all duration-300 flex flex-col h-full animate-fade-in">
        <div class="h-56 bg-white dark:bg-slate-700 relative overflow-hidden flex items-center justify-center p-4">
            <img src="{{ asset($product->image) }}" class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-700" alt="{{ $product->name }}" loading="lazy">
            <div class="absolute top-4 right-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold text-slate-700 dark:text-slate-300 shadow-sm">
                {{ $product->category->name }}
            </div>
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
        </div>
        <div class="p-6 flex-grow flex flex-col">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                <a href="{{ route('products.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 mt-auto">
                {{ $product->description }}
            </p>
            
            <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center">
                 <a href="{{ route('products.show', $product->slug) }}" class="text-blue-600 dark:text-blue-400 font-semibold text-sm hover:underline">
                    View Details
                </a>
                <span class="text-xs text-slate-400 dark:text-slate-500">Available</span>
            </div>
        </div>
    </div>
@endforeach
